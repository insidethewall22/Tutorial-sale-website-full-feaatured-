<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductUpload extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Avatar_model');
    
    }
    public function index()
	{
        if(!$this->session->userdata('logged_in')){
            redirect(site_url('login'));
        }
        $this->load->view('productUpload');
        
    }

    public function store(){
        $product_name = $this->input->post('productName');
        $product_description = $this->input->post('description');
        $product_price = $this->input->post('price');
        $user_name = $_SESSION['username'];
        $product_path = $this->_tutorials_upload('product');
        $image_path = $this->_tutorials_upload('image');
        if(!$this->upload->do_upload('product') || !$this->upload->do_upload('image') ){
            $this->session->set_flashdata('failure','The file uploaded fail!');
            $this->load->view('productUpload');
        } else{
            $info = array(
                'productName' => $product_name,
                'UserName' => $user_name,
                'description' => $product_description,
                'imagePath' => $image_path,
                'productPath' => $product_path,
                'price' =>  $product_price
            );
            $table = 'products';
            $this->Avatar_model->upload_products($table, $info);
            $this->session->set_flashdata('success', 'The product has been updated!');
            $this->load->view('productUpload');
        }

    }

    private function _tutorials_upload($name){
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'mp4|jpeg|png|gif|jpg';
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

}