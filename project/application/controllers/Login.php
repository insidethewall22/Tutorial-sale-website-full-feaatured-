<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
			$data['error']= "";
		    $this->load->helper('cookie');
			$this->load->view('login', $data);
			

		}
	

	public function check_login()
	{
		$this->load->helper('cookie');
		$this->load->model('User_model');		//load user model
		$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or passwrod or unverified email!! </div> ";
	
		$username = $this->input->post('username'); //getting username from login form
		$password = $this->input->post('password'); //getting password from login form
		$remember = $this->input->post('remember'); // getting remember checkbox from login form
		if (!$this->session->userdata('logged_in'))//check if user already login
            {
				$captcha_response = trim($this->input->post('g-recaptcha-response'));
				if($captcha_response != ''){ // has content
					$keySecret = '6LdHeMUfAAAAAJaf_Nk5oOeI3zduf4FBetdj5XZ1';
					$check = array(
						'secret' => $keySecret,
						'response' => $this->input->post('g-recaptcha-response')

					);
					$startProcess = curl_init();
					curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
					curl_setopt($startProcess, CURLOPT_POST, true);//send http request
					curl_setopt($startProcess,CURLOPT_POSTFIELDS, http_build_query($check));// generate url encoded string and send http request
					curl_setopt($startProcess,CURLOPT_SSL_VERIFYPEER, false); // does not verify ssl
					curl_setopt($startProcess,CURLOPT_RETURNTRANSFER, true);// return string
					$result = curl_exec($startProcess);
					$finalResult = json_decode($result,true);
					if($finalResult['success'] == false)
					{
						$this->session->set_flashdata('fail_validation', 'validation fail, try again');
						redirect(site_url('Login'));

					}
					else{

						if ( $this->User_model->login($username, $password) )//check username and password
						{
							$this->load->model('Avatar_model');
							$avatar_attribute = "avatar_path";
							$avatar_path = $this->Avatar_model->showPath($username, $avatar_attribute); // show string data from users data
							//$file_attribute = 'TutorialPath';
							//$tutorials = $this->Avatar_model->fetch_tutorials($username, $file_attribute); //fe
							$email_attribute = "email";
							$email = $this->Avatar_model->showPath($username,$email_attribute);  // show string data from users data
							$verfication_attribute = "is_email_verified";
							$email_verification = $this->Avatar_model->showPath($username,$verfication_attribute);
							$userid = $this->Avatar_model->showPath($username,"id");
							$user_data = array(
								'userid' => $userid,
								'username' => $username,
								'logged_in' => true, 	//create session variable
								'userpath' =>  $avatar_path,
								'email'    =>  $email,
								'email_verification' => $email_verification
								//'tutorials' => $tutorials
							);
							if($remember) {
								set_cookie("username",$username, '300');
								set_cookie("password",$password, '300');
								set_cookie("remember",$remember, '300');
							}else{
								delete_cookie('username');
								delete_cookie('password');
								delete_cookie('remember');
							}
							$this->session->set_userdata($user_data); //set user status to login in session
							//$this->load->view('template/sidebar');
							//$data['avatar'] = $avatar_path;
							//$this->load->view('home', $data);
							//$this->load->view('home',array('error' => ' ')); // direct user home page
							redirect(site_url('Account'));
						}else
						{
							$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
						}
					}
			    }
				else
				{
					$this->session->set_flashdata('fail_validation', 'validation fail, try again');
					redirect(site_url('Login'));
				}
			} 
		else{
			redirect(site_url('Account'));
			//$this->load->view('template/sidebar');

			//$this->load->view('home', array('error' => ' ')); //if user already logined show main page
		}	
}

	public function logout()
	{
		$this->session->unset_userdata('logged_in'); //delete login status
		redirect('login'); // redirect user back to login
	}

	public function forgetPassword(){
		if($_SERVER['REQUEST_METHOD']=='POST'){

			$this->load->library('form_validation');
			$this->load->model('User_model');
			$this->form_validation->set_rules('email', 'Email', 'required');
			if($this->form_validation->run()){
				$email = $this->input->post('email');
				$validateEmail= $this->User_model->validateEmail($email);
				if($validateEmail != false){
					$row = $validateEmail;
					$user_id = $row['id'];
					$string = time().$user_id.$email;
					$hash = hash('sha256',$string);
					$currentDate = date('Y-m-d H:i');
					$hash_expiry = date('Y-m-d H:i', strtotime($currentDate.' 1days'));
					$data = array(
						'hash_key' => $hash,
						'hash_expiry' => $hash_expiry

					);
					$this -> User_model-> updatePasswordhash($data, $email);
					$resetLink = base_url().'Login/password?hash='.$hash;
					// email send
					$subject = "Please verify email for password change";
					$message = "<p>Hi!</p>
					<p>This is email verification mail from Forget password system. For complete reset process. First you want to verify you email and change password 
					by click this <a href='".$resetLink."'>link to change password</a>.</p>";
					$config = array(
						'protocol' => 'smtp',
						'smtp_host' => 'mailhub.eait.uq.edu.au',
						'smtp_port' => '25',
						'mailtype' => 'html',
						'charset' => 'iso-8859-1',
						'wordwrap' => TRUE,
						'mailtype' => 'html',
						'starttls' => true,
						'newline' => "\r\n"
					);
					$this->email->initialize($config);
					$this->email->from("xiaoyu.ren@uqconnect.edu.au", 'Xiaoyu');
					$this->email->to($this->input->post('email'));
					$this->email->subject($subject);
					$this->email->message($message);

					if($this->email->send()){
						$this->User_model->updatePasswordhash($data, $email);
						$this->session->set_flashdata('success', 'email has been sent, please check ');
						redirect(base_url('Login/forgetPassword'));
					}else{
						
						$this->session->set_flashdata('error', 'email sending error, please try again ');
						$this->load->view('forgetPassword');
					}
				} else {
					$this->session->set_flashdata('error', 'This is not your registered email , please try again ');
					$this->load->view('forgetPassword');

				}
			}
			else{
				$this->session->set_flashdata('error', 'invalid email, please check ');
				$this->load->view('forgetPassword');
			}
		} else{
			$this->load->view('forgetPassword');
		}		
	}

	public function password(){
		$this->load->library('form_validation');
		$this->load->model('User_model');
		if($this->input->get('hash')){
			$hash =  $this->input->get('hash');
			$data['hash'] = $hash;
			$hash_details = $this->User_model->getHash($hash);
			if($hash_details != false){
				$hash_expiry = $hash_details->hash_expiry;
				$currentDate = date('Y-m-d H:i');
				if($currentDate < $hash_expiry){
					if($_SERVER['REQUEST_METHOD']=='POST'){ 
						$this-> form_validation->set_rules ('newPassword', 'New Password', 'required');        // change password
						$this-> form_validation->set_rules ('cPassword', 'Confirm New Password', 'required|matches[newPassword]'); 
						if($this->form_validation->run()){
							$newPassword = password_hash($this->input->post('newPassword'),PASSWORD_DEFAULT);
							$this->load->view('reset_password',$data);
							$changedData = array(
								'password'=> $newPassword,
								'hash_key' => null,
								'hash_expiry' => null
							);
							$this->User_model->updatePassword($changedData, $hash);
							$this->session->set_flashdata('success', 'Password has changed ');
							$this->load->view('reset_password',$data);
						}else{
							
							$this->load->view('reset_password',$data);
						}
                     
					}else{
						$this->load->view('reset_password',$data);
					}

				}else{
					$this->session->set_flashdata('error', 'link is expired ');
					redirect(base_url('Login/forgetPassword'));
				}

			}
			else{
				echo 'invalid link'; exit;
			}

		}else{
			redirect(base_url(Login/forgetPassword));
		}

	}

	
}
?>

