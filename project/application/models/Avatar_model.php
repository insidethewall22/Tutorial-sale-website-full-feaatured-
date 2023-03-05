<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Avatar_model extends CI_Model{
    
    public function __construct(){
      

        $this->load->database();
       
    }

    function upload($avatarname, $avatarpath, $username)
    {
        $this->db->where('name', $username);
        $query = $this->db->get('users');
        if($query->num_rows() > 0){
            $data = array(
                'avatar_name' => $avatarname,
                'avatar_path' => $avatarpath
            );
            $this->db->where('name', $username);
            $query = $this->db->update('users', $data);
        }
    }

    function showPath($username, $attribute){
        $this->db->where('name', $username);
        $this->db->select($attribute);
        $query = $this->db->get('users');
        if($query->num_rows() > 0){
            /*$result = $query -> result(string);
            foreach($result as $row){
		    return $row->avatar_path[0];*/
		$results = $query->result_array();
		return $results[0][$attribute];
                       
        } else{
            return null;
        }
    }

    function upload_tutorials($data){
        $this->db->insert('tutorials',$data);

    }

    function fetch_tutorials($name, $attribute){
        $this->db->where('UserName', $name);
        $this->db->select($attribute);
        $query = $this->db->get('tutorials');
        if($query->num_rows() > 0){
            $results = $query->result_array();
            return $results;
        }
        else{
            return null;
        }
    }

    function upload_products($table,$info){
        $this->db->insert($table, $info);
    }

    function fetch_products($name){
        $this->db->where('UserName', $name);
        $this->db->select('id, productName, price, imagePath, productPath, description');
        $query = $this->db->get('products');
        if($query->num_rows() > 0){
            $results = $query->result_array();
            return $results;
        }
        else{
            return null;
        }
    }

    function fetch_all_products(){
        $this->db->select('productName, price, imagePath, id ');
        $query = $this->db->get('products');
        if($query->num_rows() > 0){
            $results = $query->result_array();
            return $results;
        }
        else{
            return null;
        }
    }
    function id_find($id,$table){
        $this->db->where('id', $id);
        $query=$this->db->get($table);
        $results = $query->result_array();
        return $results;
    }

    function delete_product($id,$table){
        $this->db->where('id', $id);
        $this->db->delete($table);
    }

    function delete_cart($id,$table){
        $this->db->where('order', $id);
        $this->db->delete($table);
    }


    function updateRate($attribute, $productid, $table){
        $this->db->set($attribute, $attribute.'+ 1', FALSE);
        $this->db->where('id', $productid);
        $this->db->update('products');
        $data = array(
            'userid' => $_SESSION['userid'],
            'productid' => $productid
        );
        $this->db->insert($table, $data);

        $this->db->where('id', $productid);
        $query=$this->db->get('products');
        $this->db->select($attribute);
        $result = $query->result_array();
        return $result;


    }

    function deleteRate($attribute, $productid, $table){
        $this->db->set($attribute, $attribute.'- 1', FALSE);
        $this->db->where('id', $productid);
        $this->db->update('products');
        $data = array(
            'userid' => $_SESSION['userid'],
            'productid' => $productid
        );
        $this->db->delete($table, $data);

        $this->db->where('id', $productid);
        $this->db->select($attribute);
        $query=$this->db->get('products');
        $result = $query->result_array();
        return $result;

    }

    function checkLike($user_id, $product_id, $table){
        $this->db->where('userid',$user_id);
        $this->db->where('productid',$product_id);
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            $results = $query->result_array();
            return $results;
        }else{
            return false;
        }
    }

    function fetch_cart($id){
        $query = $this->db->query("SELECT c.order, c.product_id, c.purchased_at, c.user_id, c.payment, p.price, p.productName, p.imagePath 
        FROM cart AS c JOIN products AS p ON c.product_id = p.id WHERE c.user_id = $id
        ");
        $result = $query->result_array();
        if($query->num_rows() > 0){
            return $result;
        }
    }

    function check_cart($product_id, $user_id){
        $this->db->where('product_id',$product_id);
        $this->db->where('user_id',$user_id);
        $this->db->where('payment','no');
        $query = $this->db->get('cart');
        if($query->num_rows() > 0){
            return false;
        }else{
            return true;
        }
    }

    function totalPrice($id){
        $query = $this->db->query("SELECT SUM(p.price) AS total
        FROM cart AS c JOIN products AS p ON c.product_id = p.id
        WHERE c.user_id = $id
        ");
        $result = $query->result_array();
        if($query->num_rows() > 0){
            return $result;
        }else{
            return 0;
        }

    }

    function comment($id,$limit,$start){
        $this->db->select('comment, user_name, user_email, created_at');
        $this->db->where('product_id',$id);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('comment');
        $result = $query->result_array();
        return $result;
    }

    function course_search($keyword){
        $this->db->select('productName, price, imagePath, id ');
        $this->db->like('productName', $keyword);
        $query = $this->db->get('products');
        $result = $query->result_array();
        return $result;

    }

    function product_pdf($product_id){
        $this->db->where('id',$product_id);
        $query = $this->db->get('products');
        $data = $query->result_array();
        $output = '<table width="100%" cellspacing="5" cellpadding="5">';
        foreach($data as $row){
            $output .='
            <tr>
            <td width="25%"><img src="'.$row['imagePath'].'" height= "300px" width="320px"></td>
            <td width="75%">
            <p><b>ID : </b>'.$row['id'].'</p>
             <p><b>Name : </b>'.$row['productName'].'</p>
             <p><b>Description : </b>'.$row['description'].'</p>
             <p><b>Price : </b>'.$row['price'].'$</p>
             <p><b>Author : </b>'.$row['UserName'].'</p>
            </td>
           </tr>
            ';
        }
        $output .= '</table>';
        return $output;


    }


    

    


}


?>
