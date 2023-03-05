<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model{
    function fetch_tutorials($query)
    {
        $this->db->select("*");
        $this->db->form("tutorials");
        if($query != '')
        {
            $this->db->like('TutorialPath', $query);
        }
        return $this->db->get()
    }

}
?>