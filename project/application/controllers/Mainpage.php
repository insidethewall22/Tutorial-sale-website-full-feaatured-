<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mainpage extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Avatar_model');
    }

    public function index(){
        if(!$this->session->userdata('logged_in')){
            redirect(site_url('login'));
        }
        $data = array("keyword"=>null, "records"=>null);
        $keyword = $this->input->get('keyword');
        if(isset($keyword)){
            $data['keyword'] = $keyword;
            $data['records'] = $this->Avatar_model->course_search($keyword);
        }
        $data['result'] = $this->Avatar_model->fetch_all_products();
        $data['map'] = $this -> _map();
        $this->load->view('template/sidebar', $data);
        $this->load->view('mainpage',$data);
        
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




    
}