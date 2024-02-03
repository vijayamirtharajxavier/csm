<?php
class Login_model extends CI_Model {

    public function edit_option_md5($action, $id, $table){
        $this->db->where('md5(id)',$id);
        $this->db->update($table,$action);
        return;
    }

    //-- check post email
    public function check_email($email){
        $this->db->select('*');
        $this->db->from('soc_user');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }


    // check valid user by id
    public function validate_id($id){
        $this->db->select('*');
        $this->db->from('soc_user');
        $this->db->where('md5(id)', $id); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query -> num_rows() == 1){                 
            return $query->result();
        }
        else{
            return false;
        }
    }



    //-- check valid user
    function validate_user(){            
        
        $this->db->select('u.*,c.*');
        $this->db->from('soc_user u,soc_company_tbl c');
        $this->db->where('u.email', $this->input->post('user_name')); 
        $this->db->where('u.password', md5($this->input->post('password')));
        $this->db->limit(1);
        $query = $this->db->get();   
        
        if($query->num_rows() == 1){                 
           return $query->result();
        }
        else{
            return false;
        }
    }



}