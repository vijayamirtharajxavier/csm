<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('common_model');
        check_login_user(); 
    }
    
    public function index(){
        $data = array(); 
        $data['page_title'] = 'Dashboard';
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data); 
    }

    public function payment_invoice(){
        $data = array();
        $data['page_title'] = 'Payment Invoice';
        $data['main_content'] = $this->load->view('admin/payment/payment_invoice', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function all_payments(){
        $data = array();
        $data['page_title'] = 'All Payments';
        $data['main_content'] = $this->load->view('admin/payment/all_payments', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function all_contra(){
        $data = array();
        $data['page_title'] = 'Bank Contra';
        $data['main_content'] = $this->load->view('admin/payment/all_contras', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function viewall_other_payment()
    {

        $data = array();
        $data['ldg_acc'] = $this->fetchLdg_Accounts();
        $data['page_title'] = 'View all Members(s) Direct Receipt';
        $data['main_content'] = $this->load->view('admin/payment/all_mem_receipt', $data, TRUE);
        $this->load->view('admin/index', $data);

    }
    public function oth_payment()
    {
        $data = array();
        $data['ldg_acc'] = $this->fetchLdg_Accounts();
        $data['page_title'] = 'Other Expenses Payments';
        $data['main_content'] = $this->load->view('admin/payment/other_payment', $data, TRUE);
        $this->load->view('admin/index', $data);

    }
    public function ac_payment()
    {
        $data = array();
        $data['ldg_acc'] = $this->fetchLdg_Accounts();
        $data['page_title'] = 'Account Closure';
        $data['main_content'] = $this->load->view('admin/payment/ac_payment', $data, TRUE);
        $this->load->view('admin/index', $data);

    }

    public function alloth_payment()
    {
        $data = array();
        $data['ldg_acc'] = $this->fetchLdg_Accounts();
        $data['page_title'] = 'All Other Payments';
        $data['main_content'] = $this->load->view('admin/payment/viewall_payments', $data, TRUE);
        $this->load->view('admin/index', $data);

    }

    public function  fetchCashBankAccounts()
    {
        $option="";
            $data = $this->common_model->get_cbacclist();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                        $option .= '<option value="'.$value['acclink_id'].'">'. $value["acclink_id"] . " - " . $value['account_name'].'</option>';
                }
                 // /foreach
                $option .= '<option disabled selected value=0>Select A Bank/Cash Account</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

}

public function insertAccountPayment()
{

 $validator = array('success' => false, 'messages' => array());
//$data =  json_decode($this->input->post('json'),TRUE);
//var_dump($data);  
$pymt_array=array();
 $pymt_date = $this->input->post('pymt_date');
 $debit_id = $this->input->post('cash_bank');
//$curr_date = new DateTime($mdate)
$finyear=$this->session->userdata('finyear');



    for($count = 0; $count < count($_POST["account_name"]); $count++)
    {
$credit_id = $_POST["account_name"][$count];
$jcredit_id=$_POST["jaccount_name"][$count];
$r_amount=$_POST["item_amount"][$count];
$pymt_ref=$_POST["item_pymtno"][$count];
$pymt_bankref=$_POST["item_bankref"][$count];
$pymt_narr=$_POST["item_narration"][$count];


                $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['payment_prefix'];
                    $jvid= $row['payment_id'];
                    $journal_id= $jvprefix . $jvid . '/' . $row['year'];
                    $trans_id=$journal_id;
                    }



$pymt_array =array("debit_account"=>$debit_id,"credit_account"=>$credit_id,"db_cr"=>"DB","trans_amount"=>$r_amount,"trans_date"=>$pymt_date,"trans_id"=>$journal_id,"trans_refid"=>$pymt_ref,"trans_type"=>"PYMT","cheque_ref"=>$pymt_bankref,"trans_narration"=>$pymt_narr, "fyear"=>$finyear,"dm_flag"=>1);

//echo json_encode($pymt_array);
//$last_ins_id=999;
//$pv_data[]=array("db_cr"=>"PJ","acclink_id"=>$jcredit_id, "cr_account_id"=>$credit_id,"trans_amount"=>$r_amount,"trans_date"=>$pymt_date,"trans_type"=>"JOUR","trans_narration"=>$pymt_narr, "fyear"=>$finyear,"sflag"=>"P","record_link_id"=>$last_ins_id);
//echo json_encode($pv_data);


if($pymt_array)
{
$last_ins_id = $this->common_model->ins_payment($pymt_array);
$jvid++;
$upd_set=array("payment_id"=>$jvid);
$this->db->where('fyear',$finyear );
$this->db->update('soc_settings_tbl', $upd_set);
if($jcredit_id!="0")
{

    $setid = $this->common_model->get_settings_id();
    foreach ($setid as $key=> $row)
    {
    $jvprefix = $row['journal_prefix'];
    $jvid= $row['journal_id'];
    $journal_id= $jvprefix . $jvid . '/' . $row['year'];
    $trans_id=$journal_id;
    }
$pv_data=array("db_cr"=>"PJ","cr_account_id"=>$jcredit_id, "account_id"=>$credit_id,"trans_amount"=>$r_amount,"trans_id"=>$journal_id, "trans_date"=>$pymt_date,"trans_type"=>"JOUR","trans_narration"=>$pymt_narr, "fyear"=>$finyear,"pyt_id"=>$last_ins_id,"record_link_id"=>$last_ins_id);
$status=$this->db->insert('soc_trans_tbl',$pv_data);   
$jvid++;
$upd_set=array("journal_id"=>$jvid);
$this->db->where('fyear',$finyear );
$this->db->update('soc_settings_tbl', $upd_set);

}
}

}
/*
    if(isset($status)) 
    {
      $msg= array("success"=>true,"messages"=>"Record(s) Inserted successfully");
     echo json_encode($msg);
    }
    else
    {
     $msg= array("success"=>false,"messages"=>"Update action unsuccessfull...");
     echo json_encode($msg);
    }
*/
 var_dump($status);
 
    return ($status === true ? true : false);   

//var_dump($rv_data);
/*
if($last_ins_id)
{
    $status =true;

}
else {
    $status=false;

}
return $status;
*/
}





public function insertAccountClose()
{

 $validator = array('success' => false, 'messages' => array());
//$data =  json_decode($this->input->post('json'),TRUE);
//var_dump($data);  
$pymt_array=array();
 $ac_date = $this->input->post('ac_date');
 $debit_id = $this->input->post('cash_bank');
 $credit_id = $this->input->post('member_id');
 $cheque_ref = $this->input->post('chqno');
 $cheque_date=$this->input->post('chqdate');
 $cheque_amount = $this->input->post('chqamount');
 $narration = $this->input->post('narration');
//$curr_date = new DateTime($mdate)
$finyear=$this->session->userdata('finyear');


                $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['payment_prefix'];
                    $jvid= $row['payment_id'];
                    $journal_id= $jvprefix . $jvid . '/' . $row['year'];
                    $trans_id=$journal_id;
                    }


$pymt_array =array("debit_account"=>$debit_id,"credit_account"=>$credit_id,"db_cr"=>"DB","trans_amount"=>$cheque_amount,"trans_date"=>$ac_date,"trans_id"=>$journal_id,"trans_refid"=>$cheque_ref,"cheque_ref"=>$cheque_ref,"trans_type"=>"PYMT","cheque_date"=>$cheque_date,"trans_narration"=>$narration, "fyear"=>$finyear,"dmflag"=>0);
//echo json_encode($pymt_array);



if($pymt_array)
{
$last_ins_id = $this->common_model->ins_acpayment($pymt_array);
}


if($last_ins_id)
{
//$last_ins_id = $this->common_model->ins_acpayment($pymt_array);
$jvid++;
$upd_set=array("payment_id"=>$jvid);
$this->db->where('fyear',$finyear );
$this->db->update('soc_settings_tbl', $upd_set);


//Payment
 $len = count($_POST["payaccount_name"]);
if($len>0)
{
    for($count = 0; $count < count($_POST["payaccount_name"]); $count++)
    {
$jcredit_id = $_POST["payaccount_name"][$count];
//$jcredit_id=$_POST["jaccount_name"][$count];
$pay_amount=$_POST["item_payamount"][$count];
//$pymt_ref=$_POST["item_pymtno"][$count];
//$pymt_bankref=$_POST["item_bankref"][$count];
//$acpymt_narr=$_POST["item_narration"][$count];


if($jcredit_id)
{

    $setid = $this->common_model->get_settings_id();
    foreach ($setid as $key=> $row)
    {
    $jvprefix = $row['journal_prefix'];
    $jvid= $row['journal_id'];
    $journal_id= $jvprefix . $jvid . '/' . $row['year'];
    $trans_id=$journal_id;
    }
$pv_data=array("db_cr"=>"PJ","credit_account"=>$jcredit_id, "debit_account"=>$credit_id,"trans_amount"=>$pay_amount,"trans_id"=>$journal_id, "trans_date"=>$ac_date,"trans_type"=>"JOUR","trans_narration"=>$narration, "fyear"=>$finyear,"ac_id"=>$last_ins_id);
$status=$this->db->insert('soc_journal_2021_tbl',$pv_data);   
$jvid++;
$upd_set=array("journal_id"=>$jvid);
$this->db->where('fyear',$finyear );
$this->db->update('soc_settings_tbl', $upd_set);

}


}
}

//Receipt
$len = count($_POST["rctaccount_name"]);
if($len>0)
{

 for($count = 0; $count < count($_POST["rctaccount_name"]); $count++)
    {
$rct_jcredit_id = $_POST["rctaccount_name"][$count];
$rct_amount=$_POST["item_rctamount"][$count];



if($rct_jcredit_id)
{
    $setid = $this->common_model->get_settings_id();
    foreach ($setid as $key=> $row)
    {
    $jvprefix = $row['journal_prefix'];
    $jvid= $row['journal_id'];
    $journal_id= $jvprefix . $jvid . '/' . $row['year'];
    $trans_id=$journal_id;
    }
$pv_data=array("db_cr"=>"RJ","credit_account"=>$credit_id,"debit_account"=>$rct_jcredit_id,"trans_amount"=>$rct_amount,"trans_id"=>$journal_id, "trans_date"=>$ac_date,"trans_type"=>"JOUR","trans_narration"=>$narration, "fyear"=>$finyear,"ac_id"=>$last_ins_id);
$status=$this->db->insert('soc_journal_2021_tbl',$pv_data);   
$jvid++;
$upd_set=array("journal_id"=>$jvid);
$this->db->where('fyear',$finyear );
$this->db->update('soc_settings_tbl', $upd_set);

}


}
}

            if($last_ins_id) {

               $upd_member = array("ac_date"=>$ac_date,"account_close"=>1);
               
               $this->db->where('member_id',$credit_id);
               $this->db->update('soc_members_tbl',$upd_member);
                $validator['success'] = true;
                $validator['messages'] = "Successfully added";
                
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Error while inserting the information into the database";
            }           
echo json_encode($validator);



}



    return ($status === true ? true : false);   

//var_dump($rv_data);



}




    public function  fetchLdg_Accounts()
    {
        $option="";
            $data = $this->common_model->get_dcbldgacclist();
            if($data) {
                foreach ($data as $key => $value) {
                        $option .= '<option value="'.$value['acclink_id'].'">'. $value["acclink_id"] . " - " . $value['account_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Select a Ledger Account</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            return $option;
            
         // /if
    

}


   public function  fetchLedgerAccounts()
    {
        $option="";
            $data = $this->common_model->get_dcbldgacclist();
            if($data) {
                foreach ($data as $key => $value) {
                        $option .= '<option value="'.$value['acclink_id'].'">'. $value["acclink_id"] . " - " . $value['account_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Select a Ledger Account</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

}


public function fetchAccountlistbyname()
{
   $qry = $this->input->get('itemkeyword'); 
    $query  = $this->common_model->get_account_listbyname($qry);
        $data = array();
        foreach ($query as $key => $value) 
        {
    //$data[] = array('id' => $value->member_id, 'text' => $value->member_name, 'dob' => $value->dob);
           // $data[]= $value->member_name;
     $data[]=$value;
        }
        echo json_encode($data); 

}


    public function  fetchAccountlist()
    {
   $qry = $this->input->get('qry'); 
    $query  = $this->common_model->get_account_list($qry);
        $data = array();
        foreach ($query as $key => $value) 
        {
    //$data[] = array('id' => $value->member_id, 'text' => $value->member_name, 'dob' => $value->dob);
           // $data[]= $value->member_name;
     $data[]=$value;
        }
        echo json_encode($data); 
    }            


  public function  fetchLdgAccounts()
    {
        $option='';
            $data = $this->common_model->get_ldgAcc();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['account_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Select Account</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
 
}
 

   public function createPayment()
    {
            $validator = array('success' => false, 'messages' => array());


            $create = $this->common_model->insertPayment();                    
            if($create === true) {
                $validator['success'] = true;
                $validator['messages'] = "Successfully added";
                
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Error while inserting the information into the database";
            }           
echo json_encode($validator);
    }
 

   public function create_payment(){
        $data = array();
        $data['page_title'] = 'New Payment';
      $setid = $this->common_model->get_settings_id();

            foreach ($setid as $key=> $row)
       {
        $payid = $row['payment_id'];
        $data['payment_id'] =$row['payment_prefix'] . $payid . '/' . $row['year'];
        }

        $data['main_content'] = $this->load->view('admin/payment/create_payment', $data, TRUE);
        $this->load->view('admin/index', $data);
    }




    public function fetchContraUpdate() 
    {
    //  $id=this->input->post("invNo");
        $id = $this->uri->segment(4);
        //$id = $this->input->get('id');

       $table="";
       // $compId=$this->session->userdata['id'];
$cashbankData = $this->common_model->get_ldgAcc();

         $paymentSelectedData = $this->common_model->get_receiptbyid($id);
foreach ($paymentSelectedData as $key => $rctvalue) {

    $craccData = $this->common_model->get_ldgAccById($rctvalue["cr_account_id"]);
    if($craccData)
    {
foreach ($craccData as $key => $crvalue) {
       $acname = $crvalue['account_name'];
     } 

     }

     else {
     $acname='';
      }



$table='<div class="panel panel-info">
                            <div class="panel-heading"><i class="fa fa-document"></i> Bank Contra</div>
             

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    

                            
                                <div class="row">
                                <div class="col-md-4">
                                
                                <div class="form-group">
                                    <label class="col-md-6">Payment Date
                                    </label>
                                        <input type="text" id="editpaymentid" name="editpaymentid" value="'. $id .'" hidden >
                                        <input type="date" id="editpaydate" name="editpaydate" value="'. $rctvalue["trans_date"].'" autocomplete="off"  class="form-control">
                                </div>
                                </div>

  

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Received as</label>
                                                    <select class="custom-select col-6 form-control" id="editcash_bank" name="editcash_bank" value="'. $rctvalue["account_id"].'" >';
                                                       foreach ($cashbankData as $key => $cbvalue) {
                                                        if($cbvalue["id"]==$rctvalue["account_id"])
                                                        {
                                                        $table .='<option selected value=' . $cbvalue["id"] . '>' . $cbvalue["account_name"] . '</option>';
                                                        }
                                                        else {
                                                             $table .='<option value=' . $cbvalue["id"] . '>' . $cbvalue["account_name"] . '</option>';

                                                        }
                                                           
                                                        }
                                                       
                                                       $table .='</select></div>
                                                </div>

                              
 

                                 <input type="text" id="editaccountNumber" name="editaccountNumber" value="'. $rctvalue["cr_account_id"].'"  hidden>
                                 <input type="text" id="edititemName" name="edititemName"  value="'. $rctvalue["cr_account_id"].'"  hidden>
                                <div class="col-md-4">
                                <div class="form-group" id="ldgremote">
                                    <label class="col-md-6" >Received From
                                    </label>
                                 <input type="text" id="editaccountName" name="editaccountName"  value="'. $acname .'"  autocomplete="off" class="form-control typeahead editaccountName" placeholder="Account Name" required>
                                 
                                </div>
                                </div>
</div>
    <div class="row">
                                <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-6" for="paydate">Total Amount
                                    </label>
                                        <input type="text" id="editpayment_amt" name="editpayment_amt" value="'. $rctvalue["trans_amount"].'"  autocomplete="off" required class="form-control" placeholder="0.00" style="text-align: right;">
                                </div>
                                </div>
                                <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-6" for="paydate">Narration
                                    </label>
                                        <input type="text" id="editnarration" name="editnarration" class="form-control mydatepicker"  value="'. $rctvalue["trans_narration"] .'" placeholder="Narration"  autocomplete="off" >
                                </div>
                                </div>
                            </div>

  

     </div> 
     </div>
     </div>';

}
          echo $table;


    
    }

    public function fetchPaymentUpdate() 
    {
    //  $id=this->input->post("invNo");
        $id = $this->uri->segment(4);
        //$id = $this->input->get('id');

       $table="";
       // $compId=$this->session->userdata['id'];
$cashbankData = $this->common_model->get_ldgAcc();

         $paymentSelectedData = $this->common_model->get_paymentbyid($id);
foreach ($paymentSelectedData as $key => $rctvalue) {

    $craccData = $this->common_model->get_ldgAccById($rctvalue["credit_account"]);
    if($craccData)
    {
foreach ($craccData as $key => $crvalue) {
       $acname = $crvalue['account_name'];
     } 

     }

     else {
     $acname='';
      }



$table='<div class="panel panel-info">
                            <div class="panel-heading"><i class="fa fa-document"></i> Payment</div>
             

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    

                            
                                <div class="row">
                                <div class="col-md-4">
                                
                                <div class="form-group">
                                    <label class="col-md-6">Payment Date
                                    </label>
                                        <input type="text" id="editpaymentid" name="editpaymentid" value="'. $id .'" hidden >
                                        <input type="date" id="editpaydate" name="editpaydate" value="'. $rctvalue["trans_date"].'" autocomplete="off"  class="form-control">
                                </div>
                                </div>

  

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Paid from </label>
                                                    <select class="custom-select col-6 form-control" id="editcash_bank" name="editcash_bank" value="'. $rctvalue["debit_account"].'" >';
                                                       foreach ($cashbankData as $key => $cbvalue) {
                                                        if($cbvalue["id"]==$rctvalue["debit_account"])
                                                        {
                                                        $table .='<option selected value=' . $cbvalue["id"] . '>' . $cbvalue["account_name"] . '</option>';
                                                        }
                                                        else {
                                                             $table .='<option value=' . $cbvalue["id"] . '>' . $cbvalue["account_name"] . '</option>';

                                                        }
                                                           
                                                        }
                                                       
                                                       $table .='</select></div>
                                                </div>

                              
 

                                 <input type="text" id="editaccountNumber" name="editaccountNumber" value="'. $rctvalue["credit_account"].'"  hidden>
                                 <input type="text" id="edititemName" name="edititemName"  value="'. $rctvalue["credit_account"].'"  hidden>
                                <div class="col-md-4">
                                <div class="form-group" id="ldgremote">
                                    <label class="col-md-6" >Paid to
                                    </label>
                                 <input type="text" id="editaccountName" name="editaccountName"  value="'. $acname .'"  autocomplete="off" class="form-control typeahead editaccountName" placeholder="Account Name" required>
                                 
                                </div>
                                </div>
</div>
    <div class="row">
                                <div class="col-md-4">
                                
                                <div class="form-group">
                                    <label class="col-md-6" for="paydate">Total Amount
                                    </label>
                                        <input type="text" id="editpayment_amt" name="editpayment_amt" value="'. $rctvalue["trans_amount"].'"  autocomplete="off" required class="form-control" placeholder="0.00" style="text-align: right;">
                                </div>
                                </div>
                                <div class="col-md-4">
                                  <label class="col-md-6" for="paydate">Payment #
                                    </label>
                                        <input type="text" id="edittrans_refid" name="edittrans_refid" class="form-control" value="'. $rctvalue["trans_refid"].'" placeholder="Payment Reference #"  autocomplete="off" >

                                </div>

                                <div class="col-md-4">
                                
                                <div class="form-group">
                                    <label class="col-md-6" for="paydate">Narration
                                    </label>
                                        <input type="text" id="editnarration" name="editnarration" class="form-control mydatepicker"  value="'. $rctvalue["trans_narration"] .'" placeholder="Narration"  autocomplete="off" >
                                </div>
                                </div>
                            </div>

  

     </div> 
     </div>
     </div>';

}
          echo $table;


    
    }



    public function Contraupdate()
    {
            $validator = array('success' => false, 'messages' => array());

            $id = $this->input->post('editpaymentid');
            $create = $this->common_model->updateContra($id);                    
            if($create === true) {
                $validator['success'] = true;
                $validator['messages'] = "Successfully updated";
                
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Error while inserting the information into the database";
            }           
echo json_encode($validator);
    }



    public function Paymentupdate()
    {
            $validator = array('success' => false, 'messages' => array());

            $id = $this->input->post('editpaymentid');
            $create = $this->common_model->updatePayment($id);                    
            if($create === true) {
                $validator['success'] = true;
                $validator['messages'] = "Successfully updated";
                
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Error while inserting the information into the database";
            }           
echo json_encode($validator);
    }


public function getalloth_payments()
{
    $data=array();
 

    $fdt=date("Y-m-d", strtotime($this->input->get('fdate')));
    $tdt=date("Y-m-d", strtotime($this->input->get('tdate')));

   
    $finyear=$this->session->userdata('finyear');
$othpaydata = $this->common_model->getallothPayment($fdt,$tdt,$finyear);
if($othpaydata)
{
    foreach ($othpaydata as $key => $opvalue) {
        $cr_id=$opvalue['credit_account'];
        $db_id=$opvalue['debit_account'];

        $craccidData=$this->common_model->get_ldgAccById($cr_id);
        if($craccidData)
        {
            foreach ($craccidData as $key => $cracvalue) {
                # code...
                $craccname=$cracvalue['account_name'];
            }
        }
        else
        {
            $craccname="";
        }


        $dbaccidData=$this->common_model->get_ldgAccById($db_id);
        if($dbaccidData)
        {
            foreach ($dbaccidData as $key => $dbacvalue) {
                # code...
                $dbaccname=$dbacvalue['account_name'];
            }
        }
        else
        {
            $dbaccname="";
        }
        $button ='<div class="btn-group">
        <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#editPaymentmodal" onclick="updatePayment(' . $opvalue['id'] . ')"><i class="fa fa-edit"></i>
            </button>
      &nbsp;
        <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
       href="#" data-toggle="modal"  onclick="deletePayment(' . $opvalue['id'] . ')"><i class="fa fa-times"></i>
            </button>
      
        
      </div>'; 
      
       
      $data['data'][]=array(
          "debit_account"=>$opvalue['debit_account'],
          "dbaccname"=>$dbaccname,
          "credit_account"=>$opvalue['credit_account'],
          "craccname"=>$craccname,
          "trans_amount"=>$opvalue['trans_amount'],
          "trans_date"=>$opvalue['trans_date'],
          "trans_id"=>$opvalue['trans_id'],
          "trans_refid"=>$opvalue['trans_refid'],
          "trans_narr"=>$opvalue['trans_narration'],
          "fyear"=>$opvalue['fyear'],
          "action"=>$button
      );
     //   $data['data'][]=$opvalue;

    }

    echo json_encode($data);
}
else
{
    $data['data'][]='';
    //json_encode();
    echo "[]";
}

}


public function fetchContraSearch()
    {
  //  $compId=$this->session->userdata['id']; 
  //  $isItc=$this->session->userdata['isItc'];   
    
   // $sdate="2019-08-01";
   // $edate="2019-08-05";

    $fdt=$this->input->get('fdate');
    $tdt=$this->input->get('tdate');
    
        $rw=1;
        $PaymentfilterData = $this->common_model->fetchContraDatefilter($fdt,$tdt);
      //  print_r($PaymentfilterData);
        $result = array('data' => array());
        foreach($PaymentfilterData as $key => $value) { 
        
         $acid = $value['account_id'];
            $accidData=$this->common_model->get_ldgAccById($acid);

            if($accidData)
            {
                foreach ($accidData as $key => $acvalue) {
                    # code...
                    $accname = $acvalue['account_name'];
                }
            }
            else
            {
                $accname="";
            }

         $cracid = $value['cr_account_id'];
            $craccidData=$this->common_model->get_ldgAccById($cracid);
            if($craccidData)
            {
                foreach ($craccidData as $key => $cracvalue) {
                    # code...
                    $craccname=$cracvalue['account_name'];
                }
            }
            else
            {
                $craccname="";
            }


 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#edit-contra-modal" onclick="updateContra(' . $value['id'] . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deleteContra(' . $value['id'] . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 

    $result['data'][] = array(
                //$rw,
                "trans_id"=>$value['trans_id'],
                "trans_date"=>$value['trans_date'],
                "dbaccname"=>$accname,
                "craccname"=>$craccname,
                "trans_amount"=>$value['trans_amount'],
                "trans_narration"=>$value['trans_narration'],
                "action" => $button
                );  
            $rw=$rw+1;
        
        }
        echo json_encode($result);
    }


    public function fetchPaymentSearch()
    {
  //  $compId=$this->session->userdata['id']; 
  //  $isItc=$this->session->userdata['isItc'];   
    
   // $sdate="2019-08-01";
   // $edate="2019-08-05";


    $fdt=date("Y-m-d", strtotime($this->input->get('fdate')));
    $tdt=date("Y-m-d", strtotime($this->input->get('tdate')));
    //$fdt=$this->input->get('fdate');
    //$tdt=$this->input->get('tdate');
    
        $rw=1;
        $PaymentfilterData = $this->common_model->fetchPaymentDatefilter($fdt,$tdt);
        
        $result = array('data' => array());
        foreach($PaymentfilterData as $key => $value) { 

         $acid = $value['debit_account'];
            $accidData=$this->common_model->get_ldgAccById($acid);

            if($accidData)
            {
                foreach ($accidData as $key => $acvalue) {
                    # code...
                    $dbaccname = $acvalue['account_name'];
                }
            }
            else
            {
                $dbaccname="";
            }


 $acnamedata = $this->common_model->get_ldgAccById($value["credit_account"]);
 
if($acnamedata)
{
 foreach ($acnamedata as $key => $acvalue) {
     # code...
    $acname = $acvalue['account_name'];
 }
}
else {
    $acname="";
}

 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#editPaymentmodal" onclick="updatePayment(' . $value['id'] . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deletePayment(' . $value['id'] . ')"><i class="fa fa-times"></i>
      </button></div>'; 

    $result['data'][] = array(
                //$rw,
                "Payment_number"=>$value['trans_id'],
                "Payment_date"=>$value['trans_date'],
               // "account_name"=>$value['account_name'],
                "dbaccname" =>$dbaccname,
                "cash_bank"=>$acname,
                "Payment_amount"=>$value['trans_amount'],
                "narration"=>$value['trans_narration'],
                "action" => $button
                );  
            $rw=$rw+1;
            
        }
        if($result)
        {
        echo json_encode($result);
        }
        else
        {
            //$result['data'][] ='';
            echo "[]";
        }
    }
        


public function deletepayRec()
{
    $id = $this->uri->segment(4);
            $validator = array('success' => false, 'messages' => array());


    $delete = $this->common_model->deletepay($id);
            if($delete === true) {
                $validator['success'] = true;
                $validator['messages'] = "Successfully deleted";
                
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Error while inserting the information into the database";
            }           
echo json_encode($validator);



}

public function fetchContraData()
{
    $sdt=$this->input->post('fdate');
    $edt=$this->input->post('tdate');
        $rw=1;
        $PaymentallData = $this->common_model->fetchContraAllData($sdt,$edt);
        
        $result = array('data' => array());

        foreach($PaymentallData as $key => $value) { 


 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#edit-Payment-modal" onclick="updatePayments(' . $value['id'] . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deletePayment(' . $value['id'] . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 


    $result['data'][$key] = array(
                //$rw,
                "Payment_number"=>$value['payment_number'],
                "Payment_date"=>$value['payment_date'],
                "account_name"=>$value['account_name'],
                "cash_bank"=>$value['cash_bank'],
                "Payment_amount"=>$value['payment_amount'],
                "narration"=>$value['narration'],
                "action" => $button

            );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
    }
        






    public function fetchPaymentData()
    {
    
    $sdate="2018-04-01";
    $edate="2019-03-31";
    $sdt=$this->input->post('fdate');
    $edt=$this->input->post('tdate');
        $rw=1;
        $PaymentallData = $this->common_model->fetchPaymentAllData($sdt,$edt);
        
        $result = array('data' => array());

        foreach($PaymentallData as $key => $value) { 


 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#editPaymentmodal" onclick="updatePayments(' . $value['id'] . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deletePayment(' . $value['id'] . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 


    $result['data'][$key] = array(
                //$rw,
                "Payment_number"=>$value['payment_number'],
                "Payment_date"=>$value['payment_date'],
                "account_name"=>$value['account_name'],
                "cash_bank"=>$value['cash_bank'],
                "Payment_amount"=>$value['payment_amount'],
                "narration"=>$value['narration'],
                "action" => $button

            );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
    }
        




}