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
        $data['page_title'] = 'Bank Contra';
        $data['main_content'] = $this->load->view('admin/payment/all_payments', $data, TRUE);
        $this->load->view('admin/index', $data);
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




    public function fetchPaymentUpdate() 
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




    public function fetchPaymentSearch()
    {
  //  $compId=$this->session->userdata['id']; 
  //  $isItc=$this->session->userdata['isItc'];   
    
   // $sdate="2019-08-01";
   // $edate="2019-08-05";

    $fdt=$this->input->get('fdate');
    $tdt=$this->input->get('tdate');
    
        $rw=1;
        $PaymentfilterData = $this->common_model->fetchPaymentDatefilter($fdt,$tdt);
        
        $result = array('data' => array());
        foreach($PaymentfilterData as $key => $value) { 


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
                "Payment_number"=>$value['trans_id'],
                "Payment_date"=>$value['trans_date'],
               // "account_name"=>$value['account_name'],
                "cash_bank"=>$value['cash_bank'],
                "Payment_amount"=>$value['trans_amount'],
                "narration"=>$value['trans_narration'],
                "action" => $button
                );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
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
        




}