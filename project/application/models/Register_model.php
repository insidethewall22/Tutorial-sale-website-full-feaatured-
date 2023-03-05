<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model{
    
    public function __construct(){
        $this->load->database();
        
    }

    function insert($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();

    }


    function verify_email($key)
    {
        $this->db->where('verification_key',$key);
        $this->db->where('is_email_verified','no');
        $query = $this->db->get('users');
        if($query->num_rows() > 0){
            $data = array(
                'is_email_verified' => 'yes'
            );
            $this->db->where('verification_key', $key);
            $this->db->update('users', $data);
            return true;
            }
        else{
            return false;
            }

    }

    function change_email($new_email, $verification_key){
        $this->db->where('name', $_SESSION['username']);
        $query = $this->db->get('users');
        if($query->num_rows() > 0){
            $data = array(
                'email' => $new_email,
                'verification_key' => $verification_key
            );
            $this->db->where('name', $_SESSION['username']);
            $this->db->update('users', $data);
        }

    }
}


?>