<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// *************************************************************************
// *                                                                       *
// * Optimum LinkupComputers                              *
// * Copyright (c) Optimum LinkupComputers. All Rights Reserved                     *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@optimumlinkupsoftware.com                                 *
// * Website: https://optimumlinkup.com.ng								   *
// * 		  https://optimumlinkupsoftware.com							   *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// *                                                                       *
// *************************************************************************

//LOCATION : application - controller - Auth.php

class Auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
       $this->load->model('common_model');

        $this->load->model('login_model');
    $this->load->helper('captcha');
    }


    public function index(){
        $data = array();
        $data['page'] = 'Auth';
        $this->load->view('admin/login', $data);
    }

 


 /****************Function login**********************************
     * @type            : Function
     * @function name   : log
     * @description     : Authenticatte when uset try lo login. 
     *                    if autheticated redirected to logged in user dashboard.
     *                    Also set some session date for logged in user.   
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
    public function log(){

        if($_POST){ 
            $query = $this->login_model->validate_user();
            $finyear = $this->input->post('fy');
            //-- if valid
            if($query){
                $data = array();
                foreach($query as $row){
                $userRole = $row->role; 
                    $data = array(
                        'id' => $row->id,
                        'name' => $row->first_name,
                        'email' =>$row->email,
                        'role' =>$row->role,
                        'memberid'=> $row->member_id,
                        'company_name' => $row->company_name,
                        'short_name' => $row->short_name,
                        'company_add' => $row->company_address,
                        'logopath' => $row->logopath,
                        'logoimg' => $row->logoname,
                        'finyear' => $finyear,
                        'is_login' => TRUE
                    );
                    $this->session->set_userdata($data);
                    if($userRole=="admin") {
                    $url = base_url('admin/dashboard');
                    }
                    if($userRole=="user") {
                    $url = base_url('admin/dashboard/');
                    }

                }
            if($userRole=="admin") {
				redirect(base_url() . 'admin/dashboard', 'refresh');
            }
            else 
            if($userRole=="user") {
             redirect(base_url() . 'admin/dashboard/userhome', 'refresh');   
            }
            }else{
               redirect(base_url() . 'auth', 'refresh');
            }
            
        }else{
            $this->load->view('auth',$data);
        }
    }

 /*****************Function logout**********************************
     * @type            : Function
     * @function name   : logout
     * @description     : Log Out the logged in user and redirected to Login page  
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
    
    function logout(){
        $this->session->sess_destroy();
        $data = array();
        $data['page'] = 'logout';
        $this->load->view('admin/login', $data);
    }





function fetchFinancialYear() {
$option="";
$getFindata = $this->common_model->get_fylist();
  
  if($getFindata)
  {
    foreach ($getFindata as $key => $value) {
        $option .= '<option value="'.$value['fin_year'].'">'. $value["fin_year"] .'</option>';
        
    }
    echo $option;

  }

}

}
?>