<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class User_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }



    // Log in
    public function login($username, $password){
        // Validate
        $this->db->where('name', $username);
        $result = $this->db->get('users');

        if($result->num_rows() == 1){
            foreach($result->result() as $row)
            {
                if($row->is_email_verified == 'yes'){
                    //$store_password = $this->encrypt->decode($row->password);
                    //if($password != $store_password){
                    if(!password_verify($password,$row->password)){
                        return false;
                    }
                }
                else{
                    return false;
                }
            }
            return true;
            
        } 
        else {
            return false;
        }
    }

    public function validateEmail($email)
    {
        $query = $this->db->query("SELECT * FROM users WHERE email='$email'");
        if($query->num_rows()==1){
            $results = $query->result_array();
            return $results[0];
        }else{
            return false;
        }
    }

    public function  updatePasswordhash($data, $email){
        $this->db->where('email', $email);
        $this->db->update('users', $data);
    }

    public function getHash($hash){
        $query = $this->db->query("SELECT * FROM users WHERE hash_key ='$hash'");
        if($query->num_rows()==1){
            return $query->row();

        }else{
            return false;

        }
    }

    public function updatePassword($data, $hash){
        $this->db->where('hash_key', $hash);
        $this->db->update('users', $data);

        

    }

}
?>