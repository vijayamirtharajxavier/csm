<?php defined('BASEPATH') OR exit('No direct script access allowed');
  
 class SendsmsController extends MY_Controller 
 {
    public function __construct()
    {
        parent:: __construct();
    }
      public function index()
      {
        $params['to'] = "123456"; /* Separate mobile number(s) with commas */
        $params['message'] = "Hello,\nWelcome to TechAllType.Your account now active.You can now login to the account.";
        $this->user_model->sendMobileSms($params);
      }
 
}
?>