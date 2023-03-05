<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Avatar_model');
        $this->load->library('form_validation');
        $this->load->model('Register_model');
        $this->load->library('Pdf');
    }
    private function _map(){
        $url = 'https://api.ipgeolocation.io/ipgeo?apiKey=e197c02df7b345ad961cb7f95a22743a&ip=';
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1); //transform to String
        curl_setopt($curl,CURLOPT_URL,$url); //set required url
        $output = curl_exec($curl);
        $propertities=json_decode($output,true);// transform to array 
        $longitude = $propertities["longitude"];
        $latitude = $propertities["latitude"];
        $this->load->library('googlemaps');
        $config['center']=$latitude.",".$longitude;
        $config['zoom'] = '18';
        $this->googlemaps->initialize($config);
        $marker=array();
        $marker['position'] = $latitude.",".$longitude;
        $data['longitude'] = $longitude;
        $data['latitude']=$latitude;
        $this->googlemaps->add_marker($marker);
        $data['map']=$this->googlemaps->create_map();
        return $data['map'];

    }

    private function dataload(){
        $name = $_SESSION['username'];
        $attribute = 'TutorialPath';
        $data['tutorials'] = $this->Avatar_model->fetch_tutorials($name, $attribute);
        $data['email_error']='';
        $data['error'] = '';
        $data['map'] = $this -> _map();
        $data['products'] = $this->Avatar_model->fetch_products($name);
        $data['tobuy'] = $this->Avatar_model->fetch_cart($_SESSION['userid']);
        $this -> session->set_userdata('toBuy',$data['tobuy']);
        $data['total_price'] = $this->Avatar_model->totalPrice($_SESSION['userid']);
        foreach ($data['total_price'] as $row){
            $this -> session->set_userdata('totalPrice',$row['total']);
        }
        $this->load->view('template/sidebar', $data);
        $this->load->view('account',$data);
    }

	public function index()
	{
        if(!$this->session->userdata('logged_in')){
            redirect(site_url('login'));
        }

        // load page again
        $this -> dataload();		
    }

    public function avatar_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1000;
        $config['max_width'] = 1024;
        $config['max_height'] = 1024;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( !$this->upload->do_upload('userfile')) {

                  // load page again ----- upload tutorials
            $name = $_SESSION['username'];
            $attribute = 'TutorialPath';
            $data['tutorials'] = $this->Avatar_model->fetch_tutorials($name, $attribute);
            $data['map']=$this -> _map();
            $data['email_error']='';
            $data['error'] =  $this->upload->display_errors();
            $data['products'] = $this->Avatar_model->fetch_products($name);
            $data['tobuy'] = $this->Avatar_model->fetch_cart($_SESSION['userid']);
            $data['total_price'] = $this->Avatar_model->totalPrice($_SESSION['userid']);
            $this->load->view('template/sidebar', $data);
            $this->load->view('account',$data);
        } else {
            $username = $_SESSION['username'];
            $avatarpath = $this->upload->data()['full_path'];
            $avatarname = $this->upload->data()['file_name'];
            $this->Avatar_model->upload($avatarname, $avatarpath, $username);
            $this->session->set_flashdata('avatar_success', 'Avatar has been updated!');
            $this->index();
        }
        //$this->index();
    }

    public function email_update()
    {   
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->form_validation->set_rules('useremail', 'Email Address', 
        'required|valid_email|is_unique[users.email]');
        $email = $this->input->post('useremail');
        if($this->form_validation->run()){
            $verification_key = md5($email);
            $subject = "Please verify email for updating new email";
            $message = "<p>Hi ".$_SESSION['username']."</p>
            <p>This is a verification mail from updating system. For complete update process . First you want to verify you email 
            by copy and paste your new verification key: ".$verification_key."  to update</a>.</p>";
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
            $this->email->to($this->input->post('useremail'));
            $this->email->subject($subject);
            $this->email->message($message);
            if($this->email->send()){
                $this->session->set_flashdata('message', 'The verification key has been sent to your email please check!');
                if($this->input->post('verify_number')!= null){
                    $verify_number = $this->input->post('verify_number');
                    if($verify_number != $verification_key)
                    {
                        $this->session->set_flashdata('incorrect_key','The verification key is not correct!');
                        // load page again
                        $this -> dataload();	
                    }
                    else
                    {
                        $new_email = $this->input->post('useremail');
                        $this->Register_model->change_email($new_email,$verify_number);
                        $this->session->set_flashdata('change_success', 'Email has been updated!');
                        $this->session->unset_userdata('message');
                        $email_attribute = "email";
                        $email = $this->Avatar_model->showPath($_SESSION['username'],$email_attribute);
                        $this->session->set_userdata('email', $email);

                        $data['email_error'] = '';
                        redirect(site_url('Account'));
                    }
                }else{
                    $this->index();
                }
            }
            else
            {
                $data['email_error'] = "email not be sent, please check your input.";
                $this->index();
            }
        }
        else{
               // load page again 
               $this -> dataload();	
        }
    }
 



    public function tutorials(){
      $this->load->model('Avatar_model');
      $conuntFiles = count($_FILES['uploadfiles']['name']);
      $numberUploadedFiles = 0;
      $numberErrorFiles = 0;
      for($i=0; $i<$conuntFiles;$i++)
      {
          $_FILES['uploadfile']['name'] = $_FILES['uploadfiles']['name'][$i];
          $_FILES['uploadfile']['type'] = $_FILES['uploadfiles']['type'][$i];
          $_FILES['uploadfile']['size'] = $_FILES['uploadfiles']['size'][$i];
          $_FILES['uploadfile']['tmp_name'] = $_FILES['uploadfiles']['tmp_name'][$i];
          $_FILES['uploadfile']['error'] = $_FILES['uploadfiles']['error'][$i];
          $uploadStatus = $this -> _tutorials_upload('uploadfile');
          if($uploadStatus!=false)
          {
              $numberUploadedFiles++;
              $username = $_SESSION['username'];
              $data = array(
                  'TutorialPath' => $uploadStatus,
                  'UserName' => $username
              );
              $this->Avatar_model->upload_tutorials($data);
          }
          else{
              $numberErrorFiles++;
          }

      }
      $this->session->set_flashdata('filemessage', 'Successful update files:'. $numberUploadedFiles.'and Error loaded file:'.$numberErrorFiles );
      $this -> dataload();	
  }

    private function _tutorials_upload($name){
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'mp4|jpeg|png|gif';
      $config['max_size'] = 100000;
      $config['max_width'] = 1024;
      $config['max_height'] = 1024;
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if($this->upload->do_upload($name))
      {
          $fileData = $this->upload->data();
          return$fileData['full_path'];
      }else{
          return false;
      }
  }

    public function delete_product($id){
      $data =$this->Avatar_model->id_find($id,'products');
      foreach ($data as $row)
       {
        $imageFile= $row['imagePath'];
        $productFile = $row['productPath'];
        if(file_exists($imageFile) && file_exists($productFile)){
            unlink($imageFile);
            unlink($productFile);
        }
       }
      $this->Avatar_model->delete_product($id,'products');
      $this -> dataload();	
    }
    public function pdf_product($id){
        $product_id = $id;
        $html_content = '<h3 align="center">Product Information</h3>';
        $html_content .= $this->Avatar_model->product_pdf($product_id);
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        ob_end_clean();
        $this->pdf->stream("".$product_id.".pdf", array("Attachment"=>0));

    }
    public function delete_cart($id){
        $this->Avatar_model->delete_cart($id,'cart');
        $this -> dataload();


    }







}