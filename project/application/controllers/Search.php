<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller{
    private function _map(){
        $url = 'https://api.ipgeolocation.io/ipgeo?apiKey=e197c02df7b345ad961cb7f95a22743a&ip=';
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_URL,$url);
        $output = curl_exec($curl);
        $propertities=json_decode($output,true);
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
    function index(){
        $data['map'] = $this -> _map();
        $this->load->view('template/sidebar', $data);
        $this->load->view('search');
    }
    function fetch(){
        $output='';
        $query = '';
        $this->load->model('Search_model');
        if($this->input->post('query'))
        {
            $query = $this->input->post('query');
        }
        $data - $this->Search_model->fetch_tutorials($query);
        $output.= '<table class ="form-group avatar-button">
                    <tr>
                    <th>Tutorials</th>
                    </tr>';
        if($data->num_rows()>0){
            foreach($data->result() as $row)
            {
                $output.= '<tr>
                                <td>'.$row->TutorialPath.' </td>
                           </tr>';
            }

        }
        else{
            $output .= '<tr>
                        <td>No Tutorial</td>
                        </tr>';

        }
        $output.='</table>';
        echo $output;

    }


}
