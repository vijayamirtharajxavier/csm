<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class officenote extends CI_Controller {

    public function __construct(){
        parent::__construct();
        check_login_user(); 
        $this->load->model('common_model');
        $this->load->library('numbertowords');
    }
    
    public function index(){
        $data = array(); 
        $data['page_title'] = 'Dashboard';
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data); 
    }



    public function all_loanappln(){
        $data = array();
        $onotedata=array();
        $finyear=$this->session->userdata('finyear');
                $data['page_title'] = 'New Loan Appln';

      $setid = $this->common_model->get_settings_id();
 
            foreach ($setid as $key=> $row)
       {

        $data['app_number'] =  $row['app_number'] . '/' . $row['year'];
        }
          $data['main_content'] = $this->load->view('admin/officenote/loan_application', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function  fetchDesignation()
    {
        $option='';
        
            $data = $this->common_model->get_designation();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['designation'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Select Designation</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
        
    

}


function fetchlnappid()
{
    $option ="";
   //$qry = $this->uri->segment(3); 
            $data = $this->common_model->get_lnapp_list();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['app_number'].'">'.$value['app_number'] . ' - ' . $value['member_name'] .'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Choose</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;

}

    public function  fetchApplicationlist($aqry = null)
    {
   //$qry = $this->uri->segment(3); 
$qry = $this->input->get('qry');
    $query  = $this->common_model->get_application_list($qry);
        $data = array();
        foreach ($query as $key => $value) 
        {
    //$data[] = array('id' => $value->member_id, 'text' => $value->member_name, 'dob' => $value->dob);
           // $data[]= $value->member_name;
     $data[]=$value;
        }
        echo json_encode($data); 
    }            
         // /if


    public function officenote_invoice(){
        $data = array();
        $data['page_title'] = 'officenote Invoice';
        $data['main_content'] = $this->load->view('admin/officenote/officenote_invoice', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


public function get_onoteData()
{
        $finyear=$this->session->userdata('finyear');

     $duetoacc = $this->common_model->fetchofficenote($finyear);//$this->common_model->fetchofficenote();
if($duetoacc)
{
     foreach ($duetoacc as $key => $duvalue) {
         // code...
        $mem_id = $duvalue['member_id'];
        $smem_id = $duvalue['sur_member_id'];

$mem_data = $this->common_model->getMembers_dataById($mem_id);
if($mem_data)
{
    foreach ($mem_data as $key => $mvalue) {
        // code...
        $mem_name = $mvalue["member_name"];
    }
}


$smem_data = $this->common_model->getMembers_dataById($smem_id);

if($smem_data)
{
    foreach ($smem_data as $key => $smvalue) {
        // code...
        $smem_name = $smvalue["member_name"];
    }

}

if($duvalue['status']=="0")
{
    $sts= "Pending";
}
else if ($duvalue['status']=="1")
{
    $sts="Aproved";
}
else
{
    $sts="Rejected";
}

 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="" data-toggle="modal" data-target="#editOfficeNoteModal" onclick="updateOffnote(' . $duvalue['id'] . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deleteOffnote(' . $duvalue['id'] . ')"><i class="fa fa-times"></i>
      </button>
 
</div>'; 

$onotedata['data'][] = array("officenote_id"=>$duvalue['officenote_id'],"loan_appno"=>$duvalue['loan_appno'],"onote_date"=>$duvalue['onote_date'],"bank_cash"=>$duvalue['bank_cash'],"member_name"=>$mem_name,"surety_name"=>$smem_name,"loan_sanctioned"=>$duvalue['loan_sanctioned'],"roi_pc"=>$duvalue['roi_pc'],"res_number"=>$duvalue['res_number'],"res_date"=>$duvalue['res_date'],"amount_adjusted"=>$duvalue['amount_adjusted'],"mt_loanoutstanding"=>$duvalue['mt_loanoutstanding'],"mt_loaninterest"=>$duvalue['mt_loaninterest'],"mt_sharecapital"=>$duvalue['mt_sharecapital'],"sur_sharecapital"=>$duvalue['sur_sharecapital'],"fxd_deposit"=>$duvalue['fxd_deposit'],"drs_deposit"=>$duvalue['drs_deposit'],"other_amount"=>$duvalue['other_amount'],"chq_amt"=>$duvalue['chq_amt'],"chq_date"=>$duvalue['chq_date'], "chq_issued"=>$duvalue['chq_issued'],"chq_no"=>$duvalue['chq_no'],"amt_inrupees"=>$duvalue['amt_inrupees'],"status"=>$sts,"fyear"=>$duvalue['fyear'],"action"=>$button);

     }




echo json_encode($onotedata);
}

}


public function get_lappnData()
{
    $lappdata=array();
        $finyear=$this->session->userdata('finyear');

     $all_loandata = $this->common_model->fetchloanappln($finyear);//$this->common_model->fetchofficenote();
if($all_loandata)
{
     foreach ($all_loandata as $key => $lnvalue) {
         // code...
        $mem_id = $lnvalue['member_id'];
        //$smem_id = $lnvalue['sur_member_id'];

$mem_data = $this->common_model->getMembers_dataById($mem_id);
if($mem_data)
{
    foreach ($mem_data as $key => $mvalue) {
        // code...
        $mem_name = $mvalue["member_name"];
    }
}



if($lnvalue['app_status']=="0")
{
    $sts= "Pending";
}
else if ($lnvalue['app_status']=="1")
{
    $sts="Aproved";
}
else
{
    $sts="Rejected";
}

 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="" data-toggle="modal" data-target="#modalEditLoanAppn" onclick="updateAppln(' . $lnvalue['id'] . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deleteAppln(' . $lnvalue['id'] . ')"><i class="fa fa-times"></i>
      </button>
 
</div>'; 

//"net_amt"=>$lnvalue['net_amt'],"dor"=>$lnvalue['dor'],"app_status"=>$lnvalue['app_status'], "fyear"=>$lnvalue['fyear'],"action"=>$button);



$lappdata['data'][] = array("app_number"=>$lnvalue['app_number'],"member_id"=>$lnvalue['member_id'], "member_name"=>$mem_name,"member_fname"=>$lnvalue['member_fahuname'],"fh_flag"=>$lnvalue['fh_flag'],"member_dob"=>$lnvalue['member_dob'],"loan_amount"=>$lnvalue['loan_amount'],"roi"=>$lnvalue['roi'],"loan_purpose"=>$lnvalue['loan_purpose'],"repay_period"=>$lnvalue['repay_period'],"installment_amount"=>$lnvalue['installment_amount'],"designation_id"=>$lnvalue['designation_id'],"off_address"=>$lnvalue['off_address'],"off_state"=>$lnvalue['off_state'],"off_city"=>$lnvalue['off_city'],"off_pincode"=>$lnvalue['off_pincode'],"contact_number"=>$lnvalue['contact_number'],"basic_amt"=>$lnvalue['basic_amt'],"da_amt"=>$lnvalue['da_amt'],"hra_amt"=>$lnvalue['hra_amt'], "splpay_amt"=>$lnvalue['splpay_amt'],"ir_amt"=>$lnvalue['ir_amt'],"ma_amt"=>$lnvalue['ma_amt'],"gpfsub_amt"=>$lnvalue['gpfsub_amt'],"gpfloan_amt"=>$lnvalue['gpfloan_amt'],"fbs_amt"=>$lnvalue['fbs_amt'],"fa_amt"=>$lnvalue['fa_amt'],"hba_amt"=>$lnvalue['hba_amt'],"ca_amt"=>$lnvalue['ca_amt'],"lic_amt"=>$lnvalue['lic_amt'],"socrec_amt"=>$lnvalue['socrec_amt'],"other_amt"=>$lnvalue['other_amt'],"earn_amt"=>$lnvalue['earn_amt'],"ded_amt"=>$lnvalue['ded_amt'],"net_amt"=>$lnvalue['net_amt'],"dor"=>$lnvalue['dor'],"app_status"=>$lnvalue['app_status'], "fyear"=>$lnvalue['fyear'],"action"=>$button);

     }

echo json_encode($lappdata);
}

}

public function get_applnDatabyid()
{

$finyear=$this->session->userdata('finyear');
$id = $this->input->get('appid');
$data=array();
$getLoanData = $this->common_model->fetchloanapplnbyid($finyear,$id);
if($getLoanData)
{
foreach ($getLoanData as $lndata) {
    $data[]=$lndata;
}
echo json_encode($data);

}

}


public function createLApplication()
{
        $validator = array('success' => false, 'messages' => array());


        $create = $this->common_model->insertLAppn();                    
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

public function del_onoteDatabyid()
{
    $id = $this->input->get('noteid');
    $deldata = $this->common_model->delOffNote($id);
    if($deldata==true)
    {
      $msg = array("status"=>true,"message"=>"Successfully Deleted");
        echo json_encode($msg);
    }
    else
    {
        $msg = array("status"=>false,"message"=>"Error while deleting..");
        echo json_encode($msg);

    }
}


public function get_onoteDatabyid()
{

$finyear=$this->session->userdata('finyear');
$id = $this->input->get('noteid');
//var_dump($id);
$duetoaccsub = $this->common_model->getontesub($finyear,$id);

     $duetoacc = $this->common_model->fetchofficenotebyid($finyear,$id);
if($duetoacc)
{
     foreach ($duetoacc as $key => $duvalue) {
         // code...
        $mem_id = $duvalue['member_id'];
        $smem_id = $duvalue['sur_member_id'];

$mem_data = $this->common_model->getMembers_dataById($mem_id);
if($mem_data)
{
    foreach ($mem_data as $key => $mvalue) {
        // code...
        $mem_name = $mvalue["member_name"];
    }
}


$smem_data = $this->common_model->getMembers_dataById($smem_id);

if($smem_data)
{
    foreach ($smem_data as $key => $smvalue) {
        // code...
        $smem_name = $smvalue["member_name"];
    }

}

if($duvalue['status']=="0")
{
    $sts= "Pending";
}
else if ($duvalue['status']=="1")
{
    $sts="Aproved";
}
else
{
    $sts="Rejected";
}

$onotedata= $duvalue;
$data['status'] = $sts;
 
//$onotedata['data'][] = array("officenote_id"=>$duvalue['officenote_id'],"loan_appno"=>$duvalue['loan_appno'],"onote_date"=>$duvalue['onote_date'],"bank_cash"=>$duvalue['bank_cash'],"member_name"=>$mem_name,"surety_name"=>$smem_name,"loan_sanctioned"=>$duvalue['loan_sanctioned'],"roi_pc"=>$duvalue['roi_pc'],"res_number"=>$duvalue['res_number'],"res_date"=>$duvalue['res_date'],"amount_adjusted"=>$duvalue['amount_adjusted'],"mt_loanoutstanding"=>$duvalue['mt_loanoutstanding'],"mt_loaninterest"=>$duvalue['mt_loaninterest'],"mt_sharecapital"=>$duvalue['mt_sharecapital'],"sur_sharecapital"=>$duvalue['sur_sharecapital'],"fxd_deposit"=>$duvalue['fxd_deposit'],"drs_deposit"=>$duvalue['drs_deposit'],"other_amount"=>$duvalue['other_amount'],"chq_amt"=>$duvalue['chq_amt'],"chq_date"=>$duvalue['chq_date'], "chq_issued"=>$duvalue['chq_issued'],"chq_no"=>$duvalue['chq_no'],"amt_inrupees"=>$duvalue['amt_inrupees'],"status"=>$sts,"fyear"=>$duvalue['fyear'],"action"=>$button);


       $data['officenote_id'] = $duvalue['officenote_id'];
        }
   //  $data['duetoacc'] = $this->common_model->get_officenotedueto();


$evt_tbl="";
$loandata = $this->common_model->get_lnapp_list();

foreach ($duetoacc as $key => $updvalue) {
    // code...
//var_dump($updvalue);

$option='';
if($loandata) {
    //var_dump($loandata);
       foreach ($loandata as $key => $value) {
        if($updvalue['loan_appno']==$value['app_number'])
        {
           $option .= '<option selected value="'.$value['app_number'].'">'.$value['app_number'] . ' - ' . $value['member_name'] .'</option>';

        }
        else 
        {
           $option .= '<option value="'.$value['app_number'].'">'.$value['app_number'] . ' - ' . $value['member_name'] .'</option>';

        }
       }
        // /foreach
     //  $option .= '<option selected value=0>Choose</option>';
   }
   else {
       $option = '<option value="">No Data</option>';
   } // /else empty section

$mem_option='';
   $data = $this->common_model->get_memberlist();
   //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
   if($data) {
       foreach ($data as $key => $value) {
        if($updvalue['member_id']==$value['member_id'])
        {

               $mem_option .= '<option selected value="'.$value['member_id'].'">'. $value["member_id"] . " - " . $value['member_name'].'</option>';
       }
       else{
        $mem_option .= '<option value="'.$value['member_id'].'">'. $value["member_id"] . " - " . $value['member_name'].'</option>';
       }
        // /foreach
    }
     //  $mem_option .= '<option selected value=0></option>';
   }
   else {
       $mem_option = '<option value="">No Data</option>';
   } // /else empty section


   $smem_option='';
   $data = $this->common_model->get_memberlist();
   //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
   if($data) {
       foreach ($data as $key => $svalue) {
        if($updvalue['sur_member_id']==$svalue['member_id'])
        {

               $smem_option .= '<option selected value="'.$svalue['member_id'].'">'. $svalue["member_id"] . " - " . $svalue['member_name'].'</option>';
       }
       else{
        $smem_option .= '<option value="'.$svalue['member_id'].'">'. $svalue["member_id"] . " - " . $svalue['member_name'].'</option>';
       }
        // /foreach
    }
     //  $mem_option .= '<option selected value=0></option>';
   }
   else {
       $smem_option = '<option value="">No Data</option>';
   } // /else empty section


   $bank_option='';
   $data = $this->common_model->getBankCash();
   //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
   if($data) {
       foreach ($data as $key => $value) {
        if($value['acclink_id']==$updvalue['bank_cash'])
        {
            $bank_option .= '<option selected value="'.$value['acclink_id'].'">'.$value['account_name'].'</option>'; 
        }
        else 
         { 
              $bank_option .= '<option value="'.$value['acclink_id'].'">'.$value['account_name'].'</option>';
        }
       }
        // /foreach
      // $bank_option .= '<option selected value=0>Select Account</option>';
   }
   else {
       $bank_option = '<option value="">No Data</option>';
   } // /else empty section

   //echo $option;
$statusdata=array();


$statusdata = '[{"value":"0","text":"PENDING"},{"value":"1","text":"APPROVED"},{"value":"2","text":"REJECTED"}]';
// array("value"=>0,"text"=>"PENDING","value"=>1,"text"=>"APPROVED","value"=>2,"text"=>"REJECTED");
$stsoption="";

$statusdata_decode = json_decode($statusdata,TRUE);

foreach ($statusdata_decode as $key => $stsvalue) {
    # code...
    if($stsvalue['value']==$updvalue['status'])
        {
            $stsoption .= '<option selected value="'.$stsvalue['value'].'">'.$stsvalue['text'].'</option>'; 
        }
        else 
         { 
            $stsoption .= '<option  value="'.$stsvalue['value'].'">'.$stsvalue['text'].'</option>'; 
    
            //        $stsoption .= '<option value="'.$statusdata['value'].'">'.$statusdata['text'].'</option>'; 
        }



}

$evt_tbl .= '<div class="row"><div class="col-md-12"><div class="panel panel-info"><div class="panel-wrapper collapse in" aria-expanded="true"><div class="panel-body"><div class="col-md-12">';
$evt_tbl .= '<div class="col-md-3"><div class="form-group"><label for="example-text">Off. Note #</label><input type="text"  value="'. $updvalue['officenote_id'] .'" id="edit_officenote_id" name="edit_officenote_id" class="form-control" autocomplete="off"  readonly></div></div>';
$evt_tbl .= '<div class="col-md-3"><div class="form-group"><label >Off. Note Date</label><input type="date" id="edit_officenote_date" value="'. $updvalue['onote_date'] .'" name="edit_officenote_date" autocomplete="off"  class="form-control mydatepicker"></div></div>';
$evt_tbl .= '<input id="edit_id" name="edit_id" value="'. $id .'" hidden >';
$evt_tbl .= '<input id="edit_mem_id" name="mem_id" value="'. $updvalue['member_id'] .'" hidden >';
$evt_tbl .= '<input id="edit_smem_id" name="smem_id" value="'. $updvalue['sur_member_id'] .'" hidden >';
$evt_tbl .= '<div class="col-md-3"><div class="form-group"><label >Loan App No. </label><br>
<select id="edit_loanappn_id" name="edit_loanappn_id" style="width:100%;" class="form-control">'.$option.'</select></div></div>';
$evt_tbl .= '<div class="col-md-3"><label >Appl. Status</label><select class="form-control" id="edit_ofstatus" name="edit_ofstatus">
'. $stsoption .'</select></div></div>';
$evt_tbl .= '<div class="col-md-6"><div class="row"><div class="col-md-6"><div class="form-group"><label >Member No. </label><select id="edit_bmember_id" disabled name="edit_bmember_id" style="width:100%" class="form-control">'. $mem_option .'</select></div></div>';
$evt_tbl .= '<div class="col-md-6"><div class="form-group"><label >Surety Member #</label><select style="width:100%"  id="edit_smember_id" name="edit_smember_id" disabled class="form-control">'. $smem_option .'</select></div></div></div>';

$evt_tbl .= '<div class="row"><div class="col-md-6"><div class="form-group"><label >Resolution No</label><input type="text" style="width:100%"  id="edit_resolution_number" value="'. $updvalue['res_number'] .'"  name="edit_resolution_number" autocomplete="off"  class="form-control " placeholder="Resolution Number"></div></div>';
$evt_tbl .= '<div class="col-md-6"><div class="form-group"><label >Resolution Date</label><input type="date" id="edit_resolution_date" name="edit_resolution_date" value="'. $updvalue['res_date'] .'"  autocomplete="off"  class="form-control "></div></div></div>';

$evt_tbl .= '<div class="row"><div class="col-md-6"><div class="form-group"><label >Bank Account </label><select id="edit_cash_bank" name="edit_cash_bank"  style="width:100%"  class="form-control">'. $bank_option .'</select></div></div>';
$evt_tbl .= '<div class="col-md-6"><div class="form-group"><label >Cheque issued to</label><input  style="width:100%" type="text" id="edit_cheque_name" name="edit_cheque_name" value="'. $updvalue['chq_issued'] .'"  autocomplete="off"  class="form-control" placeholder="Cheque in the name of"></div></div></div>';
$evt_tbl .= '<div class="row"><div class="col-md-6"><div class="form-group"><label >Cheque Number </label><input  style="width:100%" type="text" id="edit_cheque_number" name="edit_cheque_number" value="'. $updvalue['chq_no'] .'"  autocomplete="off"  class="form-control " placeholder="Cheque details"></div></div>';
$evt_tbl .= '<div class="col-md-6"><div class="form-group"><label >Cheque Date</label><input type="date" id="edit_cheque_date" name="edit_cheque_date" value="'. $updvalue['chq_date'] .'"  autocomplete="off"  class="form-control"></div></div></div>';
$evt_tbl .= '<div class="col-md-12"><div class="form-group"><label >Rupees in words</label><input type="text" id="rupees_words" readonly  style="width:100%" name="rupees_words" autocomplete="off"  class="form-control" placeholder="Rupees in words"></div></div></div>';
$evt_tbl .= '<div class="col-md-6"><div class="col-md-12"><table id="tblOfficenote" class="table-striped"><th>Due to Details</th><th style="text-align: right;">Amount</th><tbody>';
                                 $x=0; 
                                 foreach ($duetoaccsub as $key=> $svalue)

                                  {  
                     
//$evt_tbl .= '<input type="text" id="duetoid"'. $x .' value="'. $id .' name="duetoid[' . $x .'] hidden >';
$evt_tbl .= '<input type="text" id="edit_duetoaccid' . $x .'" value="' . $svalue['acclink_id'] .' " name="edit_duetoaccid[' . $x . ']" hidden>';
//$evt_tbl .= '<input type="text" id="duetoaccount'. $x .'" value="'. $svalue['amount'] .'" name="duetoaccount[' . $key .']" hidden>';
$evt_tbl .= '<tr><td style="background: blue; color: white; "><b>'. $svalue['duetoaccount'] .'</b>'; 
$evt_tbl .= '</td><td><input type="text" id="edit_duetoamount'. $x .'" name="edit_duetoamount['. $x .']"  value="'. $svalue['amount'] .'" placeholder="0.00" style="text-align: right;" class="form-control duetoamt" autocomplete="off"></td></tr>';
//$evt_tbl .= '<input type="text" id="duetoamount'. $x .'" name="duetoamount['. $x .']"  value="0.00" placeholder="0.00" style="text-align: right;" class="form-control duetoamt" autocomplete="off"></td></tr>';
$x++; }                  
$evt_tbl .= '</tbody><footer><tr><td style="background: red; color: white;"><b>Total Due To</b>
</td><td><input type="text" id="tot_due" name="tot_due" autocomplete="off"  class="form-control typeahead" placeholder="0.00" style="text-align: right;" disabled>
</td></tr>';
$evt_tbl .= '<tr>
<td  style="background: green; color: white;"><b>Amount Sanctioned</b></td><td><input type="text" id="amt_sanctioned"  value="'. $updvalue['loan_sanctioned'] .'" name="amt_sanctioned" autocomplete="off"  class="form-control amtsanc" placeholder="0.00" style="text-align: right;"></td></tr>';
$evt_tbl .= '<tr>
<td  style="background: green; color: white;"><b>Rate of Interest</b></td><td><input type="text" value="'. $updvalue['roi_pc'] .'"  id="roi_pc" name="roi_pc" autocomplete="off" required  class="form-control amtsanc" placeholder="%" style="text-align: right;"></td></tr>';
$evt_tbl .= '<tr><td  style="background: red; color: white;"><b>Amount Due Adjusted</b></td><td><input type="text" id="amt_tobe_adju" name="amt_tobe_adju" autocomplete="off"  class="form-control" placeholder="0.00" style="text-align: right;" disabled></td></tr>';
$evt_tbl .= '<tr><td  style="background: black; color: white;"><b>Balance</b></td><td><input type="text" id="bal_amt" name="bal_amt" autocomplete="off"  class="form-control balamt" placeholder="0.00" style="text-align: right;" disabled></td></tr>';
$evt_tbl .= '</footer></table></div></div>';

}

echo $evt_tbl;
}

}


    public function all_officenote(){
        $data = array();
        $onotedata=array();
        $finyear=$this->session->userdata('finyear');
                $data['page_title'] = 'New officenote';

      $setid = $this->common_model->get_settings_id();
 
            foreach ($setid as $key=> $row)
       {

        $data['officenote_id'] = $row['officenote_id'] . '/' . $row['year'];
        }
     $data['duetoacc'] = $this->common_model->get_officenotedueto();

     //   $data['officenotes'] = $this->common_model->fetchofficenote($finyear);
   //     $data['main_content'] = $this->load->view('admin/officenote/all_officenote', $data, TRUE);
          $data['main_content'] = $this->load->view('admin/officenote/alloffnotes', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function  fetchAccountlist($query = null)
    {
   // $qry = $this->uri->segment(3); 
    $query  = $this->common_model->get_account_list($query);
        $data = array();
        foreach ($query as $key => $value) 
        {
    //$data[] = array('id' => $value->member_id, 'text' => $value->member_name, 'dob' => $value->dob);
           // $data[]= $value->member_name;
     $data[]=$value;
        }
        echo json_encode($data); 
    }            

    public function fetchStatus()
    {
        $option ='';
          $data = $this->common_model->get_statuslist();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['status_name'].'</option>';
                }
                 // /foreach
                
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;

    }

    public function fetchofficenoteSearch()
    {
  //  $compId=$this->session->userdata['id']; 
  //  $isItc=$this->session->userdata['isItc'];   
    
   // $sdate="2019-08-01";
   // $edate="2019-08-05";

    $fdt=$this->input->get('fdate');
    $tdt=$this->input->get('tdate');
      $finyear=$this->session->userdata('finyear');
      //print_r($finyear);
        $rw=1;
        $officenotefilterData = $this->common_model->fetchofficenoteDatefilter($fdt,$tdt,$finyear);
        
        $result = array('data' => array());
        foreach($officenotefilterData as $key => $value) { 


            //<li><a href="#" data-toggle="modal" data-target="#printInvoiceModal" onclick="viewInvoice('. $value['id'] .')">View</a></li> 
            //$pdfbtn ='<div classs="btn-group"><a href="#" onclick="topdf('. $value['id'] .')"><i class="fa fa-car"></a></i></div>';
 $button ='<div>
  <button type="button" class="btn btn-primary "  data-toggle="tooltip" data-placement="top" title="edit"
    href="#" data-toggle="modal" data-target="#edit-officenote-modal" onclick="updateInvoices(' . $value['officenote_id'] . ')"><i class="fa fa-edit"></i>
      </button>
      <a  target="_blank" href="'. $value['officenote_id'] .'" data-toggle="tooltip" data-placement="top" title="print" class="btn btn-info" role="button"><i class="fa fa-print"></i></a>
      <a  target="_blank" href="'. $value['officenote_id'] .'"  data-toggle="tooltip" data-placement="top" title="delete" class="btn btn-danger" role="button"><i class="fa fa-trash"></i></a>
  
</div>'; 


/*      <a  target="_blank" href="'. $value['officenote_number'] .'" class="btn btn-danger" role="button"><i class="fa fa-print"></i></a>
      <a  target="_blank" href="'. $value['officenote_number'] .'" class="btn btn-info" role="button"><i class="fa fa-film"></i></a>
  
</div>'; 
*/
    $result['data'][$key] = array(
                //$rw,
                "officenote_id"=>$value['officenote_id'],
                "officenote_date"=>$value['onote_date'],
                "member_name"=>$value['member_name'],
                "sur_name"=>$value['sur_member_name'],
                "loansanctioned_amount"=>$value['loan_sanctioned'],
                "loanadjusted_amount"=>$value['amount_adjusted'],
                "mtshr_amount"=>$value['mt_sharecapital'],
                "surshr_amount"=>$value['sur_sharecapital'],
                "chq_amt"=>$value['chq_amt'],
                "action" => $button
                );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
    }
        


    public function fetchofficenoteData()
    {
  //  $compId=$this->session->userdata['id']; 
  //  $isItc=$this->session->userdata['isItc'];   
    
    $sdate="2018-04-01";
    $edate="2019-03-31";
    $sdt=$this->input->post('fdate');
    $edt=$this->input->post('tdate');
        $rw=1;
        $officenoteallData = $this->common_model->fetchofficenoteAllData($sdt,$edt);
        
        $result = array('data' => array());

        foreach($officenoteallData as $key => $value) { 
 $button ='<div>
  <button type="button" class="btn btn-primary "  data-toggle="tooltip" data-placement="top" title="edit"
    href="#" data-toggle="modal" data-target="#edit-officenote-modal" onclick="updateInvoices(' . $value['officenote_number'] . ')"><i class="fa fa-edit"></i>
      </button>
      <a  target="_blank" href="'. $value['officenote_number'] .'" data-toggle="tooltip" data-placement="top" title="print" class="btn btn-info" role="button"><i class="fa fa-print"></i></a>
      <a  target="_blank" href="'. $value['officenote_number'] .'"  data-toggle="tooltip" data-placement="top" title="delete" class="btn btn-danger" role="button"><i class="fa fa-trash"></i></a>
  
</div>'; 


            //<li><a href="#" data-toggle="modal" data-target="#printInvoiceModal" onclick="viewInvoice('. $value['id'] .')">View</a></li> 
            //$pdfbtn ='<div classs="btn-group"><a href="#" onclick="topdf('. $value['id'] .')"><i class="fa fa-car"></a></i></div>';
    $result['data'][$key] = array(
                //$rw,
                "officenote_id"=>$value['officenote_number'],
                "officenote_date"=>$value['officenote_date'],
                "member_name"=>$value['member_name'],
                "cash_bank"=>$value['account_name'],
                "officenote_amount"=>$value['officenote_amount'],
                "narration"=>$value['narration'],
                "action" => $button

            );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
    }
        

  public function  fetchBankCashAccounts()
    {
      $option ="";   
            $data = $this->common_model->getBankCash();
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


  public function  fetchLdgAccounts()
    {
         $option ="";
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


    public function createofficenote()
    {
            $validator = array('success' => false, 'messages' => array());
            $data = array();
            //$creditmemberNumber = $this->input->post('creditmemberNumber');
    
            //$member_data = $this->common_model->get_members($creditmemberNumber);
            //foreach ($member_data as $key => $value) {
            //$data['loan_outstand'] = $value['loan_outstanding'];    
            //}
            $create = $this->common_model->insertofficenote();                    
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
  

    public function updateofficenote()
    {
            $validator = array('success' => false, 'messages' => array());
            $data = array();
            //$creditmemberNumber = $this->input->post('creditmemberNumber');
    
            //$member_data = $this->common_model->get_members($creditmemberNumber);
            //foreach ($member_data as $key => $value) {
            //$data['loan_outstand'] = $value['loan_outstanding'];    
            //}
            $create = $this->common_model->updateofficenote();                    
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
  


    public function  fetchDivision()
    {
         $option ="";
            $data = $this->common_model->get_division();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['division_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Choose</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    }



public function updatesubAccount()
{
     $subacc = $this->common_model->get_subaccount();
	 
	 $tbl='<table id="officenoteTbl" class="table" border="1"><th>Sub Account Name</th><th>Amount</th><tbody>';
        foreach ($subacc as $key=> $svalue)
        {

        	$tbl .= '<tr><td><input type="text"  value="'.$svalue['item_name'].'"
        	  id="itemname' .$key .'" name="itemname['. $key .']"  class="form-control" readonly>  
                                    </td>  <td>
                                    <input type="text" id="itemamount' .$key .'" name="itemamount['. $key .']"  placeholder="0.00" style="text-align: right;" class="form-control subamt">
                                    </td>
                                  </tr>';


       // $data['subacclist'] = $srow['item_name'];
        }
        $tbl .= '</tbody></table>';
   echo $tbl;	 


}


public function get_ondetails()
{
    $ondata=array();
$onote_id = $this->input->get('noteid');
    $lnappdata = $this->common_model->get_loandetails($onote_id);
    if ($lnappdata)
    {
    foreach ($lnappdata as $key => $lnvalue) {

        $memid= $lnvalue['member_id'];
        $memname=$lnvalue['member_name'];
        $roi = $lnvalue['roi'];
        $emi_amt = $lnvalue['installment_amount'];
        $loan_amt= $lnvalue['loan_amount'];

$lnout = $this->common_model->get_memberid($memid);
if($lnout)
{
    foreach ($lnout as  $lndata) {
        $loan_out = $lndata["loan_outstanding"];
        $suretyid = $lndata["surety_id"];
        $suretynm = $lndata["surety_name"];
        // code...
    }
}


$ondata[] = array("memid"=>$memid,"memname"=>$memname,"suretyid"=>$suretyid,"suretynm"=>$suretynm, "loan_out"=>$loan_out,"roi"=>$roi,"emi_amt"=>$emi_amt,"loan_amt"=>$loan_amt); 


        # code...
    }

    echo json_encode($ondata);
}


}




public function oldget_ondetails()
{
$ln=0;
    $onote_id = $this->input->get('noteid');
    $lnappdata = $this->common_model->get_loandetails($onote_id);
    if ($lnappdata)
    {
    foreach ($lnappdata as $key => $lnvalue) {

        $memid= $lnvalue['member_id'];

        # code...
    }
}

$mData = $this->common_model->getMembers_dataById($memid);
foreach ($mData as $key => $mvalue) {
    $roi = $mvalue['rate_of_interest'];
    $suretyid=$mvalue['surety_id'];
}

$ofndata = array();
$loandata = array();
$sharedata=array();
$s_sharedata=array();
 $onmasdata = $this->common_model->get_officenotedueto();
if($onmasdata)
{
 foreach ($onmasdata as $key => $omvalue) {
 //if($omvalue['account_id']<>"")
    if($omvalue['duetoaccount']<>"")
 {
    $acid= $omvalue['id'];
    $fldname= $omvalue['op_fieldname'];
$clbal=0;
$offnoteduedata = $this->common_model->get_ondues($memid,$acid,$fldname);

foreach ($offnoteduedata as $key => $onvalue) {
    $clbal = $onvalue['credit'] - $onvalue['debit']+$onvalue['opbal'];
  // print_r($ln);
    if($ln==0) {
        $intamt = ($clbal*$roi/100);
        $mtloan = $clbal;
        $loandata = array("memid"=>$memid, "loan"=>$mtloan,"roipc"=>$roi, "roi"=>$intamt);
    } 

    if($ln==1) {
        //$intamt = ($clbal*$roi/100);
        $sharecap = $clbal;
        $sharedata = array("mshare"=>$sharecap);
    } 
 
    if($ln==2) {
        //$intamt = ($clbal*$roi/100);
$s_sharedata = $this->common_model->get_ondues($suretyid,$acid,$fldname); 
 //print_r($s_sharedata); 
  foreach ($s_sharedata as $key => $sshr) {
            # code...
         $s_shramt=$sshr['credit'] - $sshr['debit']+$sshr['opbal'];
        
        }      
        //$sharecap = $clbal;
        $s_sharedata = array("smemid"=>$suretyid,"sshare"=>$s_shramt);
    } 
       
}
    //$ofndata[] = array("loan"=>$loandata,"mshare"=> $sharedata);
 

$ln++;

 }
 
 }
//print_r($ofndata);


}
echo json_encode(array_merge($loandata,$sharedata,$s_sharedata));

}




    public function  fetchMemberlist($query = null)
    {
         $option ="";

           $data = $this->common_model->get_member_list($query);
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                        $option .= '<option value="'.$value['member_id'].'">'. $value["member_id"] . " - " . $value['member_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0></option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
 }
    


    public function create_officenote(){
        $data = array();
        $data['page_title'] = 'New officenote';
      $setid = $this->common_model->get_settings_id();
     $data['duetoacc'] = $this->common_model->get_officenotedueto();
 
            foreach ($setid as $key=> $row)
       {
        $data['officenote_id'] = $row['officenote_id'] . '/' . $row['year'];
        }






        $data['main_content'] = $this->load->view('admin/officenote/create_officenote', $data, TRUE);
        $this->load->view('admin/index', $data);
    }






}