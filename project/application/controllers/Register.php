<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->load->model('Register_model');

    }

    function index(){
        $this->load->view('register');

    }

    function validation(){
        $this->form_validation->set_rules('username', 'Name', 'required|trim|is_unique[users.name]');
        $this->form_validation->set_rules('useremail', 'Email Address', 
        'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('userpassword', 'Password', 'required|trim|min_length[6]|max_length[15]|alpha_numeric');
        if($this->form_validation->run())
        {
            $verification_key = md5(rand());
           // $encrypted_password = $this->encrypt->encode($this->input->post('userpassword'));
            $encrypted_password = password_hash($this->input->post('userpassword'),PASSWORD_DEFAULT); // encrypt password by hash function
            $data = array(
                'name' => $this->input->post('username'),
                'email' => $this->input->post('useremail'),
                'password' => $encrypted_password,
                'verification_key' => $verification_key
            );
            $id = $this->Register_model->insert($data);
            if($id > 0) {
                $subject = "Please verify email for login";
                $message = "<p>Hi ".$this->input->post('username')."</p>
                <p>This is email verification mail from Register system. For complete registration process and login into system. First you want to verify you email 
                by click this <a href='".base_url()."register/verify_email/".$verification_key."'>link to login</a>.</p>";
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
                if($this->email->send())
                {
                    // display sucess message
                    $this->session->set_flashdata('message', 'verification mail has been sent, please check.');
                    redirect('register');
                }

            }

        }else {
            $this->index();
        }

    }

    function verify_email()
    {
        if($this->uri->segment(3))
        {
            $verification_key = $this->uri->segment(3);
            if($this->Register_model->verify_email($verification_key))
            {
                $data['message'] = '<h1 align="center">Your Email has been successfully verified, 
                now you can login from <a href="'.base_url().'login">here</a></h1>';
                $this->load->view('email_verification', $data);
            }
            else
            {
                $data['message'] = '<h1 align="center">Your Email address is unverified or the link has expired. </h1>'.$verification_key;
                $this->load->view('email_verification', $data);
            }
        }
    }
}
?>