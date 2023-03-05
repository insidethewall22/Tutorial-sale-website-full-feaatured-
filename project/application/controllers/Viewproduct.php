<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewproduct extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Avatar_model');
        $data = array();
        $this->load->library('form_validation');
    
    }
    public function index(){
        if(!$this->session->userdata('logged_in')){
            redirect(site_url('login'));
        }
    }
    public function view_product($id){
        $table = 'products';
        $data['result'] = $this->Avatar_model->id_find($id, $table);
        $this->load->view('view_product', $data);
    }

    public function rate(){
        if (isset($_POST['like'])) {
            $product_id = $_POST['productid'];
            $result = $this->Avatar_model->updateRate('favourite', $product_id, 'liked');
            foreach($result as $key => $value){
                $data = $value['favourite'];
                echo 'Like <img class="priceicon" src="'.base_url('assets/img/thumbup.png').'"width="20">'.$data;
            }
        }
        if (isset($_POST['deleteLike'])) {
            $product_id = $_POST['productid'];
            $result = $this->Avatar_model->deleteRate('favourite', $product_id, 'liked');
            foreach($result as $key => $value){
                $data = $value['favourite'];
                echo 'Like <img class="priceicon" src="'.base_url('assets/img/thumbup.png'). '"width="20">'.$data;
            }
        }

        if (isset($_POST['dislike'])) {
            $product_id = $_POST['productid'];
            $result = $this->Avatar_model->updateRate('dislike', $product_id, 'hate');
            foreach($result as $key => $value){
                $data = $value['dislike'];
                echo 'Dislike <img class="priceicon" src="'.base_url('assets/img/thumbdown.png').'"width="20">'.$data;
            }
        }
        if (isset($_POST['deleteDisLike'])) {
            $product_id = $_POST['productid'];
            $result = $this->Avatar_model->deleteRate('dislike', $product_id, 'hate');
            foreach($result as $key => $value){
                $data = $value['dislike'];
                echo 'Dislike <img class="priceicon" src="'.base_url('assets/img/thumbdown.png'). '"width="20">'.$data;
            }
        }  
    }

    public function addCart(){
        $product_id = $_POST['productid'];
            $info = array(
                'product_id' => $product_id,
                'user_id' => $_SESSION['userid'],
            );
            if($this->Avatar_model->check_cart($product_id, $_SESSION['userid'])){
                $this->Avatar_model->upload_products('cart', $info);
                echo "Successful! go check your <a href='" .base_url('account'). "'>Shop Cart</a>
                <img class='priceicon' src='".base_url("assets/img/shopping cart.png"). "'width='30'> ";
            } else{
                echo "Sorry! This item exists in your 
                <a href='" .base_url('account'). "' class='cartWeb'>Shop Cart</a> 
                <img class='priceicon' src='".base_url("assets/img/shopping cart.png"). "'width='30'> ";
            }
        
    }

    public function addComment($id){
        $comment = $this->input->post('comment');
        $this->form_validation->set_rules('comment', 'comment', 'required');
        $product_id = $id;
        if($this->form_validation->run()){
            $info = array(
                'product_id' => $product_id,
                'comment' => $comment,
                'user_id' => $_SESSION['userid'],
                'user_name' => $_SESSION['username'],
                'user_email' => $_SESSION['email']
            );
            $this->Avatar_model->upload_products('comment',$info);
            $this->session->set_flashdata('success', 'Comment uploaded success!');
            redirect('viewproduct/view_product/'.$id);
            
        }else{
            $this->session->set_flashdata('comment_empty', 'Comment cannot be empty!');
            redirect('viewproduct/view_product/'.$id);
        }
        
    }

    public function fetchComment(){
        $start = $this->input->post('start');
        $limit = $this->input->post('limit');
        $product_id = $this->input->post('productid');
        $output = '';
        $comments = $this->Avatar_model->comment($product_id,$limit,$start);
        foreach($comments as $key => $comment){
            $output .='<div class="alert alert-info">
            <p class="line">Post by:'.$comment['user_name']. '</p>
            <p class="line">Post at: '.$comment['created_at'].'</p> 
            <hr>
            <p class="line content">Comment:'.$comment['comment'].'</p> 
            <p class="line">Email: '.$comment['user_email'] .'</p>
            </div>
            <br>';
        }
        echo $output;
        
    }

    



}