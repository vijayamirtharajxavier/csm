<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import extends CI_Controller {

   public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
		$this->load->library('excel');
	}

   function index()
   {
   	$this->load->view('admin/excelimports/excel_import');
   }	

   function fetch()
   {
   	$data = $this->common_model->selectdata();
      //print_r($data);
   	$output = '<h3 align="center">Total Data - ' . count($data) . '</h3>
   	<table class="table">
   	<tr>
   	<th>Journal Date</th>
   	<th>Journal Number</th>
   	<th>Account Name </th>
   	<th>Debit Amount</th>
   	<th>Credit Amount</th>
   	</tr>';


for ($i=0; $i < count($data); $i++) 
//foreach ($data as $row) {
{
 	$output .='
 	<tr>
 	<td>'. $data[$i]["journal_date"] .'</td>
 	<td>'. $data[$i]["journal_number"] .'</td>
 	<td>'. $data[$i]["debit_accountname"] .'</td>
 	<td>'. $data[$i]["debit_amount"] .'</td>
 	</tr>
 	<tr>
 	<td></td><td></td>
 	<td>'. $data[$i]["credit_accountname"] .'</td>
 	<td>'. $data[$i]["credit_amount"] .'</td>
 	</tr>';

 }
 	$output .= '</table>';

 	echo $output;
   }

}

 