<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receipt extends CI_Controller {

    public function __construct(){
        parent::__construct();
        check_login_user(); 
        $this->load->model('common_model');
    }
    
    public function index(){
        $data = array(); 
        $data['page_title'] = 'Dashboard';
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data); 
    }

    public function div_receipt()
    {
        $data = array();
        $data['page_title'] = 'Division(s) Receipt';
        $data['main_content'] = $this->load->view('admin/receipt/div_receipt', $data, TRUE);
        $this->load->view('admin/index', $data);

    }

    public function viewall_mem_receipt()
    {

        $data = array();
        $data['ldg_acc'] = $this->fetchLdg_Accounts();
        $data['page_title'] = 'View all Members(s) Direct Receipt';
        $data['main_content'] = $this->load->view('admin/receipt/all_mem_receipt', $data, TRUE);
        $this->load->view('admin/index', $data);

    }
    public function mem_receipt()
    {
        $data = array();
        $data['ldg_acc'] = $this->fetchLdg_Accounts();
        $data['page_title'] = 'Members(s) Direct Receipt';
        $data['main_content'] = $this->load->view('admin/receipt/member_receipt', $data, TRUE);
        $this->load->view('admin/index', $data);

    }

    public function Receipt_invoice(){
        $data = array();
        $data['page_title'] = 'Receipt Invoice';
        $data['main_content'] = $this->load->view('admin/receipt/Receipt_invoice', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function all_receipt(){
        $data = array();
        $data['page_title'] = 'All Receipts';
        $data['main_content'] = $this->load->view('admin/receipt/all_receipt', $data, TRUE);
        $this->load->view('admin/index', $data);
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


   public function  fetchCashBankAccounts()
    {
        
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



public function deleterctRec()
{
    $id = $this->uri->segment(4);
            $validator = array('success' => false, 'messages' => array());


    $delete = $this->common_model->deleterct($id);
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

    public function fetchMember()
    {
     
     $qry= $this->uri->segment(4);
    // var_dump($qry);
    $query  = $this->common_model->get_member_list($qry);
        
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
     //   print_r($qry);
   //$qry = $this->uri->segment(4); 
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



    public function fetchReceiptSearch()
    {
  //  $compId=$this->session->userdata['id']; 
  //  $isItc=$this->session->userdata['isItc'];   
    
   // $sdate="2019-08-01";
   // $edate="2019-08-05";
   //$orgDate = "2019-09-15";  
   // $newDate = date("d-m-Y", strtotime($orgDate));  


    $fdt=date("Y-m-d", strtotime($this->input->get('fdate')));
    $tdt=date("Y-m-d", strtotime($this->input->get('tdate')));

    
        $rw=1;
        $receiptfilterData = $this->common_model->fetchReceiptDatefilter($fdt,$tdt);
        //print_r($receiptfilterData);
        $result = array('data' => array());
 foreach($receiptfilterData as $key => $value) { 

 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#edit-receipt-modal" onclick="updateReceipts(' . $value['id'] . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" class="btn btn-warning btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#print-receipt-modal" onclick="printReceipts(' . $value['id'] . ')"><i class="fa fa-print"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deleteReceipt(' . $value['id'] . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 

$cr_accountnamedata= $this->common_model->get_ldgAccById($value['cr_account_id']);

if($cr_accountnamedata) {


foreach ($cr_accountnamedata as $key => $cvalue) {
    # code...
    $craccount_name = $cvalue['account_name'];
}

}
else {
$cr_accountnamedata= $this->common_model->get_ldgAccById($value['account_id']);

foreach ($cr_accountnamedata as $key => $cvalue) {
    # code...
    $craccount_name = $cvalue['account_name'];
}

}

    $result['data'][] = array(
                //$rw,
                "receipt_number"=>$value['trans_id'],
                "receipt_date"=>$value['trans_date'],
                "account_name"=>$value['account_name'],
                "cash_bank"=>$craccount_name,
                "receipt_amount"=>$value['trans_amount'],
                "narration"=>$value['trans_narration'],
                "action" => $button
                );  
            $rw=$rw+1;
            
        }

        echo json_encode($result);
 

  }
        


public function ReceiptPrint()
{
$data=array();
   $id = $this->uri->segment(4);
   $rcptdata = $this->common_model->get_receiptbyid($id);

   $compName = $this->session->userdata('company_name');
   $shortName = $this->session->userdata('short_name');
   $compAdd = $this->session->userdata('company_add');

   $compLogoPath = $this->session->userdata('logopath');
   $compLogoImg = $this->session->userdata('logoimg');

$data['cpName'] = $compName;
$data['cpSName'] = $shortName;
$data['cpAdd'] = $compAdd;
$data['logopath'] = $compLogoPath;
$data['logoimg'] = $compLogoImg;

foreach ($rcptdata as $key => $rctvalue) {
    
    $data['receiptNumber'] = $rctvalue['receipt_number'];
    $data['receiptDate'] = $rctvalue['receipt_date'];
    $data['accountName'] = $rctvalue['account_name'];
    $data['receiptAmount'] = $rctvalue['receipt_amount'];
    $data['narration'] = $rctvalue['narration'];
}


echo json_encode($data);


}



    public function fetchReceiptData()
    {
  //  $compId=$this->session->userdata['id']; 
  //  $isItc=$this->session->userdata['isItc'];   
    
    $sdate="2018-04-01";
    $edate="2019-03-31";
    $sdt=$this->input->post('fdate');
    $edt=$this->input->post('tdate');
        $rw=1;
        $receiptallData = $this->common_model->fetchReceiptAllData();
        
        $result = array('data' => array());

        foreach($receiptallData as $key => $value) { 


 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#edit-receipt-modal" onclick="updateReceipts(' . $value['id'] . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" class="btn btn-warning btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#print-receipt-modal" onclick ="printReceipts(' . $value['id'] . ')"><i class="fa fa-print"></i>
      </button>
&nbsp;

  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deleteReceipt(' . $value['id'] . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 

    $result['data'][$key] = array(
                //$rw,
                "receipt_number"=>$value['receipt_number'],
                "receipt_date"=>$value['receipt_date'],
                "account_name"=>$value['account_name'],
                "cash_bank"=>$value['cash_bank'],
                "receipt_amount"=>$value['receipt_amount'],
                "narration"=>$value['narration'],
                "action" => $button

            );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
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


//Update Invoice
    public function fetchReceiptUpdate() 
    {
        $table='';
    //  $id=this->input->post("invNo");
        $id = $this->input->get('id'); //$this->uri->segment(4);
//print_r($id);
       // $compId=$this->session->userdata['id'];
$cashbankData = $this->common_model->get_ldgAcc();

         $receiptSelectedData = $this->common_model->get_receiptbyid($id);
foreach ($receiptSelectedData as $key => $rctvalue) {

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
    
//print_r($rctvalue['cr_account_id']);

$table='<div class="panel panel-info">
                            <div class="panel-heading"><i class="fa fa-document"></i> Receipt</div>
             

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    

                            
                                <div class="row">
                                <div class="col-md-4">
                                
                                <div class="form-group">
                                    <label class="col-md-6">Receipt Date
                                    </label>
                                        <input type="text" id="editreceiptid" name="editreceiptid" value="'. $id .'" hidden >
                                        <input type="date" id="editrecdate" name="editrecdate" value="'. $rctvalue["trans_date"].'" autocomplete="off"  class="form-control">
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
                                <div class="col-md-4">
                                
                                <div class="form-group">
                                    <label class="col-md-6" for="paydate">Total Amount
                                    </label>
                                        <input type="text" id="editreceipt_amt" name="editreceipt_amt" value="'. $rctvalue["trans_amount"].'"  autocomplete="off"  class="form-control" placeholder="0.00" style="text-align: right;">
                                </div>
                                </div>
                                <div class="col-md-4">
                                  <label class="col-md-6" for="paydate">Receipt#
                                    </label>
                                        <input type="text" id="edittrans_refid" name="edittrans_refid" class="form-control" value="'. $rctvalue["trans_refid"].'" placeholder="Receipt Reference #"  autocomplete="off" >

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



    public function Receiptupdate()
    {
            $validator = array('success' => false, 'messages' => array());

            $id = $this->input->post('editreceiptid');
            $create = $this->common_model->updateReceipt($id);                    
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



    public function createReceipt()
    {
            $validator = array('success' => false, 'messages' => array());


            $create = $this->common_model->insertReceipt();                    
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


public function get_EditReceiptMemberData()
{
$mmyy = $this->input->get('mm_yy');
$divid= $this->input->get('div_id');

$mdate = date("Y-m-d",strtotime("01-" . $mmyy));
//$curr_date = new DateTime($mdate)
$tbl='';
$date = new DateTime($mdate);
$curr_month = $date->format("mY");

$date->sub(new DateInterval('P1M')); // P -> Period 1 Month
$last_month= $date->format("mY");

$date->sub(new DateInterval('P1M')); // P -> Period 1 Month
$prev_month= $date->format("mY");

// Outputs: 2019-02

//echo $curr_month . "\n\r" . $prev_month;

//$tbl .= '<table id="dmd_tbl" class="table-bordered" style="white-space:nowrap;">';
//$tbl.= '<thead><th>#</th><th>Member#</th><th>Thrift</th><th>Loan</th><th>Interest</th><th>Insurance</th></thead>';
$i=0;
$thf_mon=0;
$interest_mon=0;
$emi_mon=0;
$insr_mon=0;
$tot_thf=0;
$tot_emi=0;
$tot_int=0;
$tot_insu=0;
$rw=1;
$getMembyDiv = $this->common_model->getMembyDivId($divid);
if($getMembyDiv)
{
    foreach ($getMembyDiv as $key => $mem) {
        $mem_divid = $mem['division_id'];
        $mem_id = $mem['member_id'];
        $mem_name =$mem['member_name'];
        $thf_mon= $mem['thrift_monthly'];
        $emi_mon=$mem['principle_amount'];
        $ln_out=$mem['loan_outstanding'];
        //echo $ln_out;
        $roi=$mem['rate_of_interest'];
        //echo $roi;
        $interest_mon=(($ln_out*$roi/100)/12);
        //echo $intrest_mon;



$data[]= array("mem_id"=>$mem_id,"mem_name"=>$mem_name,"mmyy"=>$last_month,"thrift"=>0,"principle"=>0,"interest"=>0,"insurance"=>0,"others"=>0);

$i++;
$rw++;
$thf_mon=0;
$interest_mon=0;
$emi_mon=0;

$insr_mon=0;
    } // Memebr Loop
    
}

echo json_encode($data);

}






public function get_ReceiptMemberData()
{
$mmyy = $this->input->get('mm_yy');
$divid= $this->input->get('div_id');

$mdate = date("Y-m-d",strtotime("01-" . $mmyy));
//$curr_date = new DateTime($mdate)
$tbl='';
$date = new DateTime($mdate);
$curr_month = $date->format("mY");

$date->sub(new DateInterval('P1M')); // P -> Period 1 Month
$last_month= $date->format("mY");

$date->sub(new DateInterval('P1M')); // P -> Period 1 Month
$prev_month= $date->format("mY");

// Outputs: 2019-02

//echo $curr_month . "\n\r" . $prev_month;

//$tbl .= '<table id="dmd_tbl" class="table-bordered" style="white-space:nowrap;">';
//$tbl.= '<thead><th>#</th><th>Member#</th><th>Thrift</th><th>Loan</th><th>Interest</th><th>Insurance</th></thead>';
$i=0;
$thf_mon=0;
$interest_mon=0;
$emi_mon=0;
$insr_mon=0;
$tot_thf=0;
$tot_emi=0;
$tot_int=0;
$tot_insu=0;
$rw=1;
$getMembyDiv = $this->common_model->getMembyDivId($divid);
if($getMembyDiv)
{
    foreach ($getMembyDiv as $key => $mem) {
        $mem_divid = $mem['division_id'];
        $mem_id = $mem['member_id'];
        $mem_name =$mem['member_name'];
        $thf_mon= $mem['thrift_monthly'];
        $emi_mon=$mem['principle_amount'];
        $ln_out=$mem['loan_outstanding'];
        //echo $ln_out;
        $roi=$mem['rate_of_interest'];
        //echo $roi;
        $interest_mon=(($ln_out*$roi/100)/12);
        //echo $intrest_mon;



$data[]= array("mem_id"=>$mem_id,"mem_name"=>$mem_name,"mmyy"=>$last_month,"thrift"=>0,"principle"=>0,"interest"=>0,"insurance"=>0,"others"=>0);

$i++;
$rw++;
$thf_mon=0;
$interest_mon=0;
$emi_mon=0;

$insr_mon=0;
    } // Memebr Loop
    
}

echo json_encode($data);

}



public function getDirectMemberReceiptData()
{
$outdata=array();    
$finyear=$this->session->userdata('finyear');
$rdata = $this->common_model->getRctMain($finyear,0);
//var_dump($data);
if($rdata)
{
    foreach ($rdata as $key => $rvalue) {
     $rct_rec_id = $rvalue['id'];
     $db_acc=$rvalue['debit_account'];
     $cr_acc=$rvalue['credit_account'];
     $trans_date=$rvalue['trans_date'];
     $mmyyyy=$rvalue['mmyyyy'];
     $divid=$rvalue['div_id'];


$get_accname=$this->common_model->get_ldgAccById($db_acc);
if($get_accname)
{
    foreach ($get_accname as $dbvalue) {
        // code...
    $db_accname = $dbvalue['acclink_id'] . ' - ' . $dbvalue['account_name'];
    }
    
}
else
{
    $db_accname='';
}


$get_craccname=$this->common_model->get_ldgAccById($cr_acc);
if($get_craccname)
{
    foreach ($get_craccname as $crvalue) {
        // code...
    $cr_accname =  $crvalue['acclink_id'] . ' - ' . $crvalue['account_name'];
    }
    
}
else
{
    $cr_accname='';
}



$mem_cnt = $this->common_model->getMemCount($rct_rec_id,$finyear);
if($mem_cnt)
{
     $cnt=$mem_cnt;
 
}



$subrct_data = $this->common_model->getDRctSubData($rct_rec_id,$finyear);
if($subrct_data)
{
    foreach ($subrct_data as $key => $rctvalue) {
    
    $tot_amt = $rctvalue['tot_amt'];        

    }
}
//Get Division ID
$get_Divid=$this->common_model->get_divisionbyid($divid);

if($get_Divid)
{
    foreach ($get_Divid as $key => $dvalue) {
        $div_code=$dvalue['division_id'];
        $div_name=$dvalue['division_name'];
    }
}
else
{
    $div_code="";
    $div_name="";
}

$btn='<button type="button" class="btn btn-primary"  href="#" data-toggle="modal" data-backdrop="static" data-keyboard="true" data-target="#edit-directreceipt-modal" onclick="updateTransid(' . $rct_rec_id . ')"><i class="fa fa-edit"></i></button>&nbsp;<button type="button" class="btn btn-danger" href="#" onclick="deleteTransid('. $rct_rec_id . ')"><i class="fa fa-trash"></i></button>';

$outdata['data'][]=array("division_name"=>$div_name, "trans_date"=>$trans_date,"db_name"=>$db_accname,"cr_name"=>$cr_accname,"tot_amt"=>$tot_amt,"finyear"=>$finyear, "action"=>$btn);

    }
echo json_encode($outdata);
}
else
{
    $outdata["data"]=[];
    echo json_encode($outdata);
}


}

public function getReceiptMainData()
{
$outdata=array();    
$finyear=$this->session->userdata('finyear');
$rdata = $this->common_model->getRctMain($finyear,1);
//var_dump($data);
if($rdata)
{
    foreach ($rdata as $key => $rvalue) {
     $rct_rec_id = $rvalue['id'];
     $db_acc=$rvalue['debit_account'];
     $cr_acc=$rvalue['credit_account'];
     $trans_date=$rvalue['trans_date'];
     $mmyyyy=$rvalue['mmyyyy'];
     $divid=$rvalue['div_id'];


$mem_cnt = $this->common_model->getMemCount($rct_rec_id,$finyear);
if($mem_cnt)
{
     $cnt=$mem_cnt;
 
}


$subrct_data = $this->common_model->getRctSubData($rct_rec_id,$finyear);
if($subrct_data)
{
    foreach ($subrct_data as $key => $rctvalue) {
//    $cnt = $rctvalue['cnt'];
    $tot_amt = $rctvalue['tot_amt'];        

    }
}
//Get Division ID
$get_Divid=$this->common_model->get_divisionbyid($divid);

if($get_Divid)
{
    foreach ($get_Divid as $key => $dvalue) {
        $div_code=$dvalue['division_id'];
        $div_name=$dvalue['division_name'];
    }
}
else
{
    $div_code="";
    $div_name="";
}

$btn='<button type="button" class="btn btn-primary"  href="#" data-toggle="modal" data-backdrop="static" data-keyboard="true" data-target="#edit-receipt-modal" onclick="updateTransid(' . $rct_rec_id . ')"><i class="fa fa-edit"></i></button>&nbsp;<button type="button" class="btn btn-danger" href="#" onclick="deleteTransid('. $rct_rec_id . ')"><i class="fa fa-trash"></i></button>';

$outdata['data'][]=array("division_name"=>$div_name, "trans_date"=>$trans_date,"mmyyyy"=>$mmyyyy,"nom"=>(int)$cnt,"tot_amt"=>$tot_amt,"finyear"=>$finyear, "action"=>$btn);

    }
echo json_encode($outdata);
}
else
{
    $outdata["data"]=[];
    echo json_encode($outdata);
}
}


//Delete demand records
public function deleteDemandDatabyid()
{
$validator = array('success' => false, 'messages' => array());
$id=$this->input->get('id');    

$status=$this->db->delete('soc_demandmain_tbl', array('id' => $id));

//echo $status;
    if($status) 
    {
      $msg= array("success"=>true,"messages"=>"Demand deleted successfully");
     echo json_encode($msg);
    }
    else
    {
     $msg= array("success"=>false,"messages"=>"Error deleting demand...");
     echo json_encode($msg);
    }


}



//Delete demand records
public function deleteReceiptDatabyid()
{
$validator = array('success' => false, 'messages' => array());
$id=$this->input->get('id');    

$status=$this->db->delete('soc_receipt_2021_tbl', array('id' => $id));

//echo $status;
    if($status) 
    {
      $msg= array("success"=>true,"messages"=>"Receipt deleted successfully");
     echo json_encode($msg);
    }
    else
    {
     $msg= array("success"=>false,"messages"=>"Error deleting demand...");
     echo json_encode($msg);
    }


}



//Edit Direct Receipt Member
public function get_editDReceiptData()
{
$id= $this->input->get('id');
$dm_flag=$this->input->get('dmf');
$div_rct=array();
$mer_arr=array();
$getRctMain = $this->common_model->getMainReceiptData($id,$dm_flag);
if($getRctMain)
{
    foreach ($getRctMain as $key => $drvalue) {
        
        $rct_date=$drvalue['trans_date'];
        $db_acc=$drvalue['debit_account'];
        $div_id=$drvalue['div_id'];
        $mmyy=$drvalue['mmyyyy'];
        $fyear=$drvalue['fyear'];
        $trans_amount=$drvalue['trans_amount'];
        $trans_refid=$drvalue['trans_refid'];
        $cheque_ref=$drvalue['cheque_ref'];
        $trans_narration=$drvalue['trans_narration'];
$mm=substr($mmyy, 0,2);
$yy=substr($mmyy, 2,4);
$mm_yy=$mm . "-" . $yy;
//var_dump($mm_yy);

$mdate = date("Y-m-d",strtotime("01-" . $mm_yy));
//$curr_date = new DateTime($mdate)
$tbl='';
$date = new DateTime($mdate);
$curr_month = $date->format("mY");

$date->add(new DateInterval('P1M')); // P -> Period 1 Month
$next_month= $date->format("m-Y");

$date->sub(new DateInterval('P1M')); // P -> Period 1 Month
$prev_month= $date->format("mY");


    } //Loop

 $div_rct[]=array("debit_account"=>$db_acc, "rct_date"=>$rct_date,"div_id"=>$div_id,"mmyy"=>$next_month,"trans_amount"=>$trans_amount,"trans_refid"=>$trans_refid,"cheque_ref"=>$cheque_ref,"trans_narration"=>$trans_narration);   

} //Main DMD IF 

$subqry='';
$getImpAccData= $this->common_model->getRctFlagData();
if($getImpAccData)
{
    foreach ($getImpAccData as $impacc) 
    {
        $ac_head=strtolower($impacc['import_account']);
 $subqry .= "SUM(CASE WHEN rv.acclink_id=" . $impacc['acclink_id'] . " THEN rv.trans_amount ELSE 0 END)`". $ac_head ."`,";
}
$subqry = rtrim($subqry, ',');

//var_dump($subqry);
}

        $thf=0;
        $prin=0;
        $intr=0;
        $insu=0;
        $oth=0;


/*$getMembyDiv = $this->common_model->getMembyDivId($div_id);
if($getMembyDiv)
{
    foreach ($getMembyDiv as $key => $mem) {
        $mem_divid = $mem['division_id'];
        $mem_id = $mem['member_id'];
        $mem_name =$mem['member_name'];
        $thf=0;
        $prin=0;
        $intr=0;
        $insu=0;
        $oth=0;
       // $thf_mon= $mem['thrift_monthly'];
     //   $emi_mon=$mem['principle_amount'];
   //     $ln_out=$mem['loan_outstanding'];
        //echo $ln_out;
     //   $roi=$mem['rate_of_interest'];
        //echo $roi;
 //       $interest_mon=(($ln_out*$roi/100)/12);
        //echo $intrest_mon;
*/
$getSubRct = $this->common_model->getRctRcvData($id,$fyear,$subqry);
if($getSubRct)
{
   // var_dump($getSubRct);
    foreach ($getSubRct as $key => $rvdvalue) {
     $r_mem_id=$rvdvalue['member_id'];

   //  $data[]=$rvdvalue;
     $mem_id=$rvdvalue['member_id'];
    $thf=$rvdvalue['thrift'];
        $prin=$rvdvalue['principle'];
        $intr=$rvdvalue['interest'];
        $insu=$rvdvalue['insurance'];
        $oth=$rvdvalue['others'];

$data[]= array("member_id"=>$mem_id,"receipt_ref"=>$trans_refid,"cheque_ref"=>$cheque_ref, "trans_narration"=>$trans_narration, "mmyyyy"=>$prev_month,"thrift"=>$thf,"principle"=>$prin,"interest"=>$intr,"insurance"=>$insu,"others"=>$oth);

}
}

    




//$i++;
//$rw++;
$thf_mon=0;
$interest_mon=0;
$emi_mon=0;

$insr_mon=0;
  //  } // Memebr Loop
    
//}

if($data)
{
$mer_arr=array_merge($div_rct,array("items"=>$data));
echo json_encode($mer_arr);
}



}







//Edit Receipt Division
public function get_editReceiptData()
{
$id= $this->input->get('id');
$dm_flag=$this->input->get('dmf');
$div_rct=array();
$mer_arr=array();
$getRctMain = $this->common_model->getMainReceiptData($id,$dm_flag);
if($getRctMain)
{
    foreach ($getRctMain as $key => $drvalue) {
        
        $rct_date=$drvalue['trans_date'];
        $db_acc=$drvalue['debit_account'];
        $div_id=$drvalue['div_id'];
        $mmyy=$drvalue['mmyyyy'];
        $fyear=$drvalue['fyear'];
        $trans_amount=$drvalue['trans_amount'];
        $trans_refid=$drvalue['trans_refid'];
        $cheque_ref=$drvalue['cheque_ref'];
        $trans_narration=$drvalue['trans_narration'];
$mm=substr($mmyy, 0,2);
$yy=substr($mmyy, 2,4);
$mm_yy=$mm . "-" . $yy;
//var_dump($mm_yy);

$mdate = date("Y-m-d",strtotime("01-" . $mm_yy));
//$curr_date = new DateTime($mdate)
$tbl='';
$date = new DateTime($mdate);
$curr_month = $date->format("mY");

$date->add(new DateInterval('P1M')); // P -> Period 1 Month
$next_month= $date->format("m-Y");

$date->sub(new DateInterval('P1M')); // P -> Period 1 Month
$prev_month= $date->format("mY");


    } //Loop

 $div_rct[]=array("debit_account"=>$db_acc, "rct_date"=>$rct_date,"div_id"=>$div_id,"mmyy"=>$next_month,"trans_amount"=>$trans_amount,"trans_refid"=>$trans_refid,"cheque_ref"=>$cheque_ref,"trans_narration"=>$trans_narration);   

} //Main DMD IF 

$subqry='';
$getImpAccData= $this->common_model->getRctFlagData();
if($getImpAccData)
{
    foreach ($getImpAccData as $impacc) 
    {
        $ac_head=strtolower($impacc['import_account']);
 $subqry .= "SUM(CASE WHEN rv.acclink_id=" . $impacc['acclink_id'] . " THEN rv.trans_amount ELSE 0 END)`". $ac_head ."`,";
}
$subqry = rtrim($subqry, ',');

//var_dump($subqry);
}



$getMembyDiv = $this->common_model->getMembyDivId($div_id);
if($getMembyDiv)
{
    foreach ($getMembyDiv as $key => $mem) {
        $mem_divid = $mem['division_id'];
        $mem_id = $mem['member_id'];
        $mem_name =$mem['member_name'];
        $thf=0;
        $prin=0;
        $intr=0;
        $insu=0;
        $oth=0;
       // $thf_mon= $mem['thrift_monthly'];
     //   $emi_mon=$mem['principle_amount'];
   //     $ln_out=$mem['loan_outstanding'];
        //echo $ln_out;
     //   $roi=$mem['rate_of_interest'];
        //echo $roi;
 //       $interest_mon=(($ln_out*$roi/100)/12);
        //echo $intrest_mon;

$getSubRct = $this->common_model->getRctSubAllData($mem_id,$div_id,$id,$fyear,$subqry);
if($getSubRct)
{
   // var_dump($getSubRct);
    foreach ($getSubRct as $key => $rvdvalue) {
     $r_mem_id=$rvdvalue['member_id'];

   //  $data[]=$rvdvalue;
    $thf=$rvdvalue['thrift'];
        $prin=$rvdvalue['principle'];
        $intr=$rvdvalue['interest'];
        $insu=$rvdvalue['insurance'];
        $oth=$rvdvalue['others'];

$data[]= array("member_id"=>$mem_id,"member_name"=>$mem_name,"mmyyyy"=>$prev_month,"thrift"=>$thf,"principle"=>$prin,"interest"=>$intr,"insurance"=>$insu,"others"=>$oth);

}
}
     else
     {
                $thf=0;
        $prin=0;
        $intr=0;
        $insu=0;
        $oth=0;

$data[]= array("member_id"=>$mem_id,"member_name"=>$mem_name,"mmyyyy"=>$prev_month,"thrift"=>$thf,"principle"=>$prin,"interest"=>$intr,"insurance"=>$insu,"others"=>$oth);

     }

    




//$i++;
//$rw++;
$thf_mon=0;
$interest_mon=0;
$emi_mon=0;

$insr_mon=0;
    } // Memebr Loop
    
}









$mer_arr=array_merge($div_rct,array("items"=>$data));
echo json_encode($mer_arr);




}


//Update Div Receipt data on soc 

public function updateDivReceipt()
{
//rdate:rdate,rcash_bank:rcash_bank,ramount:ramount,rref:rref,rbankref:rbankref,rnarr:rnarr
 $validator = array('success' => false, 'messages' => array());
$data =  json_decode($this->input->post('json'),TRUE);
$ins_data=array();
$dmd_main=array();
$dm_data=array();
$rv_data=array();
$rec_id=$this->input->post('recid');
$mmyy = $this->input->post('mm_yy');
$divid= $this->input->post('div_id');
//var_dump($divid);
$r_date = $this->input->post('rdate');
$r_cashbank = $this->input->post('rcash_bank');
$r_amount = $this->input->post('ramount');
$r_ref = $this->input->post('rref');
$r_bankref=$this->input->post('rbankref');
$r_narr=$this->input->post('rnarr');



//var_dump($mmyy . $divid);
$mdate = date("Y-m-d",strtotime("01-" . $mmyy));
//$curr_date = new DateTime($mdate)
$date = new DateTime($mdate);
$curr_month = $date->format("mY");
$finyear=$this->session->userdata('finyear');
$date->sub(new DateInterval('P1M')); // P -> Period 1 Month
$last_month= $date->format("mY");

//Get Division ID
$get_Divid=$this->common_model->get_divisionbyid($divid);

if($get_Divid)
{
    foreach ($get_Divid as $key => $dvalue) {
        $div_id=$dvalue['division_id'];
        $div_name=$dvalue['division_name'];
    }
}
else
{
    $div_id="";
}




                $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['receipt_prefix'];
                    $jvid= $row['receipt_id'];
                    $journal_id= $jvprefix . $jvid . '/' . $row['year'];
                    $trans_id=$journal_id;
                    }


//Division Receipt
$rct_main =array("debit_account"=>$r_cashbank,"credit_account"=>$div_id,"div_id"=>$divid,"db_cr"=>"DB","trans_amount"=>$r_amount,"trans_date"=>$r_date,"trans_id"=>$trans_id,"trans_refid"=>$r_ref,"trans_type"=>"RCPT","cheque_ref"=>$r_bankref,"trans_narration"=>$r_narr,"mmyyyy"=>$last_month, "fyear"=>$finyear,"dm_flag"=>1);
//var_dump($rct_main);
//$dmd_main=array("div_id"=>$divid,"demand_date"=>$mdate,"mmyyyy"=>$last_month,"fyear"=>$finyear);

if($rct_main)
{
$this->db->where('id',$rec_id);
$this->db->where('fyear',$finyear);
$this->db->update('soc_receipt_2021_tbl',$rct_main);

//$last_ins_id = $this->common_model->ins_receipt($rct_main);
//echo json_encode($rct_main);
//$last_ins_id=0;
}


if($data)
{
  //  var_dump($data);
    foreach ($data as $key => $jvalue) {

     $memid= $jvalue['mem_id'];
     $thf=$jvalue['thrift'];
     $emi=$jvalue['principle'];
     $interest=$jvalue['interest'];
     $insurance=$jvalue['insurance'];
     $others=$jvalue['others'];
     $total=$jvalue['erow_tot'];
     $mmyyyy=$jvalue['mmyy'];


//DM JV\
if($total>0)
{
    $narr="Division receipt credited to member account";
$dm_data[]=array("div_id"=>$div_id,"db_cr"=>"DM","division_id"=>$divid, "member_id"=>$memid, "trans_amount"=>(float)$total,"mmyyyy"=>$mmyyyy,"trans_date"=>$r_date,"trans_type"=>"JOUR","fyear"=>$finyear,"trans_narration"=>$narr,"sflag"=>"R","record_link_id"=>$rec_id);
}
//var_dump($dm_data);

//RV JV
$getImpAccData= $this->common_model->getImpAccHead();
//var_dump($getImpAccData);
if($getImpAccData)
{
    foreach ($getImpAccData as $impacc) {

        $tls = $impacc['import_account'];

 if(strtolower($tls)=='thrift')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
    if($thf>0)
    {
    $rv_data[]=array("div_id"=>$div_id,"db_cr"=>"RV","division_id"=>$divid,"acclink_id"=>$acclink, "member_id"=>$memid,"trans_amount"=>$thf,"mmyyyy"=>$mmyyyy,"trans_date"=>$r_date,"trans_type"=>"JOUR","trans_narration"=>$narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$rec_id);
}

 }
 if(strtolower($tls)=='principle')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
 if($emi>0)
 {
    $rv_data[]=array("div_id"=>$div_id,"db_cr"=>"RV","division_id"=>$divid,"acclink_id"=>$acclink, "member_id"=>$memid,"trans_amount"=>$emi,"mmyyyy"=>$mmyyyy,"trans_date"=>$r_date,"trans_type"=>"JOUR","trans_narration"=>$narr,"fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$rec_id);
}
 }
 if(strtolower($tls)=='interest')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
 if($interest>0)
 {
    $rv_data[]=array("div_id"=>$div_id,"db_cr"=>"RV","division_id"=>$divid,"acclink_id"=>$acclink, "member_id"=>$memid,"trans_amount"=>$interest,"mmyyyy"=>$mmyyyy,"trans_date"=>$r_date,"trans_type"=>"JOUR","trans_narration"=>$narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$rec_id);
 }
}
 if(strtolower($tls)=='insurance')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
 if($insurance>0)
 {
    $rv_data[]=array("div_id"=>$div_id,"db_cr"=>"RV","division_id"=>$divid,"acclink_id"=>$acclink, "member_id"=>$memid,"trans_amount"=>$insurance,"mmyyyy"=>$mmyyyy,"trans_date"=>$r_date,"trans_type"=>"JOUR","trans_narration"=>$narr,"fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$rec_id);
 }
}
 if(strtolower($tls)=='others')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
 if($others>0)
 {
    $rv_data[]=array("div_id"=>$div_id,"db_cr"=>"RV","division_id"=>$divid,"acclink_id"=>$acclink, "member_id"=>$memid,"trans_amount"=>$others,"mmyyyy"=>$mmyyyy,"trans_date"=>$r_date,"trans_type"=>"JOUR","trans_narration"=>$narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$rec_id);
 }
}
} // Imp Acchead Loop



}

    } //Data Json loop



}

if($dm_data)
{
$multiClause = array('record_link_id' => $rec_id, 'sflag' => 'R', 'fyear' => $finyear );
$this->db->where($multiClause);
$this->db->delete('soc_recovery_2021_tbl');

//    echo json_encode($dm_data);
$status=$this->db->insert_batch('soc_recovery_2021_tbl', $dm_data);
}

if($rv_data)
{
//    echo json_encode($rv_data);
$status=$this->db->insert_batch('soc_recovery_2021_tbl', $rv_data);
}

    if($status) 
    {
      $msg= array("success"=>true,"messages"=>"Record(s) Updated successfully");
     echo json_encode($msg);
    }
    else
    {
     $msg= array("success"=>false,"messages"=>"Update action unsuccessfull...");
     echo json_encode($msg);
    }


//echo json_encode($ins_data);
}


public function updateMemberDReceipt()
{

 $validator = array('success' => false, 'messages' => array());
//$data =  json_decode($this->input->post('json'),TRUE);
//var_dump($data);  
$rcpt_array=array();
$id = $this->input->post('erec_id');
 $rcpt_date = $this->input->post('ercpt_date');
 $rcpt_month = $this->input->post('emon_yr');
 $r_cashbank = $this->input->post('ecash_bank');
 $mdate = date("Y-m-d",strtotime("01-" . $rcpt_month));
//$curr_date = new DateTime($mdate)
$date = new DateTime($mdate);
$curr_month = $date->format("mY");
$finyear=$this->session->userdata('finyear');
$date->sub(new DateInterval('P1M')); // P -> Period 1 Month
$last_month= $date->format("mY");



    for($count = 0; $count < count($_POST["item_thrift"]); $count++)
    {
$mem_id = $_POST["member_name"][$count];

$thf_amt = $_POST["item_thrift"][$count];
$emi_amt = $_POST["item_principle"][$count];
$int_amt = $_POST["item_interest"][$count];
$ins_amt = $_POST["item_insurance"][$count];
$oth_amt = $_POST["item_others"][$count];
$r_amount=$_POST["item_amount"][$count];
$rcpt_ref=$_POST["item_rcptno"][$count];
$rcpt_bankref=$_POST["item_bankref"][$count];
$rcpt_narr=$_POST["item_narration"][$count];

//Get Division ID
$get_mDivid=$this->common_model->get_DivId($mem_id);

if($get_mDivid)
{
    foreach ($get_mDivid as $key => $dvalue) {
        $div_id=$dvalue['division_id'];
        //$div_name=$dvalue['division_name'];
    }
}
else
{
    $div_id="";
}

//Get Division ID
$get_Divid=$this->common_model->get_divisionbyid($div_id);

if($get_Divid)
{
    foreach ($get_Divid as $key => $dvalue) {
        $divid=$dvalue['division_id'];
        $divname=$dvalue['division_name'];
    }
}
else
{
    $divid="";
}



/*
                $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['receipt_prefix'];
                    $jvid= $row['receipt_id'];
                    $journal_id= $jvprefix . $jvid . '/' . $row['year'];
                    $trans_id=$journal_id;
                    }
*/


$rcpt_array =array("debit_account"=>$r_cashbank,"credit_account"=>$mem_id,"div_id"=>$div_id,"db_cr"=>"DB","trans_amount"=>$r_amount,"trans_date"=>$rcpt_date,"trans_refid"=>$rcpt_ref,"trans_type"=>"RCPT","cheque_ref"=>$rcpt_bankref,"trans_narration"=>$rcpt_narr);


if($rcpt_array)
{
    $this->db->where('id',$id);
    
$upd_sts = $this->db->update('soc_receipt_2021_tbl', $rcpt_array);
}

if($upd_sts)
{
//RV JV
$getImpAccData= $this->common_model->getImpAccHead();
//var_dump($getImpAccData);
if($getImpAccData)
{
    foreach ($getImpAccData as $impacc) {

        $tls = $impacc['import_account'];

 if(strtolower($tls)=='thrift')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
    if($thf_amt>0)
    {

    $rv_data[]=array("div_id"=>$divid,"db_cr"=>"RJ","division_id"=>$div_id,"acclink_id"=>$acclink, "member_id"=>$mem_id,"trans_amount"=>$thf_amt,"mmyyyy"=>$last_month,"trans_date"=>$rcpt_date,"trans_type"=>"JOUR","trans_narration"=>$rcpt_narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$id);
    }


} // Thrift



 if(strtolower($tls)=='principle')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
    if($emi_amt>0)
    {

    $rv_data[]=array("div_id"=>$divid,"db_cr"=>"RJ","division_id"=>$div_id,"acclink_id"=>$acclink, "member_id"=>$mem_id,"trans_amount"=>$emi_amt,"mmyyyy"=>$last_month,"trans_date"=>$rcpt_date,"trans_type"=>"JOUR","trans_narration"=>$rcpt_narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$id);
    }


} // Principle


 if(strtolower($tls)=='interest')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
    if($int_amt>0)
    {

    $rv_data[]=array("div_id"=>$divid,"db_cr"=>"RJ","division_id"=>$div_id,"acclink_id"=>$acclink, "member_id"=>$mem_id,"trans_amount"=>$int_amt,"mmyyyy"=>$last_month,"trans_date"=>$rcpt_date,"trans_type"=>"JOUR","trans_narration"=>$rcpt_narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$id);
    }


} // Interest

 if(strtolower($tls)=='insurance')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
    if($ins_amt>0)
    {

    $rv_data[]=array("div_id"=>$divid,"db_cr"=>"RJ","division_id"=>$div_id,"acclink_id"=>$acclink, "member_id"=>$mem_id,"trans_amount"=>$ins_amt,"mmyyyy"=>$last_month,"trans_date"=>$rcpt_date,"trans_type"=>"JOUR","trans_narration"=>$rcpt_narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$id);
    }


} // Insurance


 if(strtolower($tls)=='others')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
    if($oth_amt>0)
    {

    $rv_data[]=array("div_id"=>$divid,"db_cr"=>"RJ","division_id"=>$div_id,"acclink_id"=>$acclink, "member_id"=>$mem_id,"trans_amount"=>$oth_amt,"mmyyyy"=>$last_month,"trans_date"=>$rcpt_date,"trans_type"=>"JOUR","trans_narration"=>$rcpt_narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$id);
    }


} // Others



} //getImpAcc Loop

} //getImpAcc

} //Last_ins_id Rcpt

}
if($rv_data)
{
//    echo json_encode($rv_data);
$this->db->where('record_link_id',$id);
$this->db->delete('soc_recovery_2021_tbl');    


$status=$this->db->insert_batch('soc_recovery_2021_tbl', $rv_data);
}


    if($status) 
    {
      $msg= array("success"=>true,"messages"=>"Record(s) Updated successfully");
     echo json_encode($msg);
    }
    else
    {
     $msg= array("success"=>false,"messages"=>"Update action unsuccessfull...");
     echo json_encode($msg);
    }

}

public function insertMemberReceipt()
{

 $validator = array('success' => false, 'messages' => array());
//$data =  json_decode($this->input->post('json'),TRUE);
//var_dump($data);  
$rcpt_array=array();
 $rcpt_date = $this->input->post('rcpt_date');
 $rcpt_month = $this->input->post('rcpt_month');
 $r_cashbank = $this->input->post('cash_bank');
 $mdate = date("Y-m-d",strtotime("01-" . $rcpt_month));
//$curr_date = new DateTime($mdate)
$date = new DateTime($mdate);
$curr_month = $date->format("mY");
$finyear=$this->session->userdata('finyear');
$date->sub(new DateInterval('P1M')); // P -> Period 1 Month
$last_month= $date->format("mY");



    for($count = 0; $count < count($_POST["item_thrift"]); $count++)
    {
$mem_id = $_POST["member_name"][$count];

$thf_amt = $_POST["item_thrift"][$count];
$emi_amt = $_POST["item_principle"][$count];
$int_amt = $_POST["item_interest"][$count];
$ins_amt = $_POST["item_insurance"][$count];
$oth_amt = $_POST["item_others"][$count];
$r_amount=$_POST["item_amount"][$count];
$rcpt_ref=$_POST["item_rcptno"][$count];
$rcpt_bankref=$_POST["item_bankref"][$count];
$rcpt_narr=$_POST["item_narration"][$count];

//Get Division ID
$get_mDivid=$this->common_model->get_DivId($mem_id);

if($get_mDivid)
{
    foreach ($get_mDivid as $key => $dvalue) {
        $div_id=$dvalue['division_id'];
        //$div_name=$dvalue['division_name'];
    }
}
else
{
    $div_id="";
}

//Get Division ID
$get_Divid=$this->common_model->get_divisionbyid($div_id);

if($get_Divid)
{
    foreach ($get_Divid as $key => $dvalue) {
        $divid=$dvalue['division_id'];
        $divname=$dvalue['division_name'];
    }
}
else
{
    $divid="";
}




                $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['receipt_prefix'];
                    $jvid= $row['receipt_id'];
                    $journal_id= $jvprefix . $jvid . '/' . $row['year'];
                    $trans_id=$journal_id;
                    }



$rcpt_array =array("debit_account"=>$r_cashbank,"credit_account"=>$mem_id,"div_id"=>$div_id,"db_cr"=>"DB","trans_amount"=>$r_amount,"trans_date"=>$rcpt_date,"trans_id"=>$journal_id,"trans_refid"=>$rcpt_ref,"trans_type"=>"RCPT","cheque_ref"=>$rcpt_bankref,"trans_narration"=>$rcpt_narr,"mmyyyy"=>$last_month, "fyear"=>$finyear,"dm_flag"=>0);


if($rcpt_array)
{
    
$last_ins_id = $this->common_model->ins_receipt($rcpt_array);
$jvid++;
$upd_set=array("receipt_id"=>$jvid);
$this->db->where('fyear',$finyear );
$this->db->update('soc_settings_tbl', $upd_set);
}

if($last_ins_id>0)
{
//RV JV
$getImpAccData= $this->common_model->getImpAccHead();
//var_dump($getImpAccData);
if($getImpAccData)
{
    foreach ($getImpAccData as $impacc) {

        $tls = $impacc['import_account'];

 if(strtolower($tls)=='thrift')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
    if($thf_amt>0)
    {

    $rv_data[]=array("div_id"=>$divid,"db_cr"=>"RJ","division_id"=>$div_id,"acclink_id"=>$acclink, "member_id"=>$mem_id,"trans_amount"=>$thf_amt,"mmyyyy"=>$last_month,"trans_date"=>$rcpt_date,"trans_type"=>"JOUR","trans_narration"=>$rcpt_narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$last_ins_id);
    }


} // Thrift



 if(strtolower($tls)=='principle')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
    if($emi_amt>0)
    {

    $rv_data[]=array("div_id"=>$divid,"db_cr"=>"RJ","division_id"=>$div_id,"acclink_id"=>$acclink, "member_id"=>$mem_id,"trans_amount"=>$emi_amt,"mmyyyy"=>$last_month,"trans_date"=>$rcpt_date,"trans_type"=>"JOUR","trans_narration"=>$rcpt_narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$last_ins_id);
    }


} // Principle


 if(strtolower($tls)=='interest')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
    if($int_amt>0)
    {

    $rv_data[]=array("div_id"=>$divid,"db_cr"=>"RJ","division_id"=>$div_id,"acclink_id"=>$acclink, "member_id"=>$mem_id,"trans_amount"=>$int_amt,"mmyyyy"=>$last_month,"trans_date"=>$rcpt_date,"trans_type"=>"JOUR","trans_narration"=>$rcpt_narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$last_ins_id);
    }


} // Interest

 if(strtolower($tls)=='insurance')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
    if($ins_amt>0)
    {

    $rv_data[]=array("div_id"=>$divid,"db_cr"=>"RJ","division_id"=>$div_id,"acclink_id"=>$acclink, "member_id"=>$mem_id,"trans_amount"=>$ins_amt,"mmyyyy"=>$last_month,"trans_date"=>$rcpt_date,"trans_type"=>"JOUR","trans_narration"=>$rcpt_narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$last_ins_id);
    }


} // Insurance


 if(strtolower($tls)=='others')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
    if($oth_amt>0)
    {

    $rv_data[]=array("div_id"=>$divid,"db_cr"=>"RJ","division_id"=>$div_id,"acclink_id"=>$acclink, "member_id"=>$mem_id,"trans_amount"=>$oth_amt,"mmyyyy"=>$last_month,"trans_date"=>$rcpt_date,"trans_type"=>"JOUR","trans_narration"=>$rcpt_narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$last_ins_id);
    }


} // Others



} //getImpAcc Loop

} //getImpAcc

} //Last_ins_id Rcpt

}
if($rv_data)
{
//    echo json_encode($rv_data);
$status=$this->db->insert_batch('soc_recovery_2021_tbl', $rv_data);
}

if(isset($status))
{
        echo 'ok';
}



/*
    if($status) 
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

//var_dump($rv_data);



}




//Insert Div Receipt data on soc_receipt_2021_tbl
public function insertDivReceipt()
{

 $validator = array('success' => false, 'messages' => array());
$data =  json_decode($this->input->post('json'),TRUE);
$ins_data=array();
$dmd_main=array();
$dm_data=array();
$rv_data=array();
$mmyy = $this->input->post('mm_yy');
$divid= $this->input->post('div_id');
$r_date = $this->input->post('rdate');
$r_cashbank = $this->input->post('rcash_bank');
$r_amount = $this->input->post('ramount');
$r_ref = $this->input->post('rref');
$r_bankref=$this->input->post('rbankref');
$r_narr=$this->input->post('rnarr');



//var_dump($mmyy . $divid);
$mdate = date("Y-m-d",strtotime("01-" . $mmyy));
//$curr_date = new DateTime($mdate)
$date = new DateTime($mdate);
$curr_month = $date->format("mY");
$finyear=$this->session->userdata('finyear');
$date->sub(new DateInterval('P1M')); // P -> Period 1 Month
$last_month= $date->format("mY");

//Get Division ID
$get_Divid=$this->common_model->get_divisionbyid($divid);

if($get_Divid)
{
    foreach ($get_Divid as $key => $dvalue) {
        $div_id=$dvalue['division_id'];
        $div_name=$dvalue['division_name'];
    }
}
else
{
    $div_id="";
}




                $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['receipt_prefix'];
                    $jvid= $row['receipt_id'];
                    $journal_id= $jvprefix . $jvid . '/' . $row['year'];
                    $trans_id=$journal_id;
                    }


//Division Receipt
$rct_main =array("debit_account"=>$r_cashbank,"credit_account"=>$div_id,"div_id"=>$divid,"db_cr"=>"DB","trans_amount"=>$r_amount,"trans_date"=>$r_date,"trans_id"=>$trans_id,"trans_refid"=>$r_ref,"trans_type"=>"RCPT","cheque_ref"=>$r_bankref,"trans_narration"=>$r_narr,"mmyyyy"=>$last_month, "fyear"=>$finyear,"dm_flag"=>1);

//$dmd_main=array("div_id"=>$divid,"demand_date"=>$mdate,"mmyyyy"=>$last_month,"fyear"=>$finyear);

if($rct_main)
{
  $last_ins_id = $this->common_model->ins_receipt($rct_main);
//echo json_encode($rct_main);
//$last_ins_id=0;
$jvid++;
$upd_set=array("receipt_id"=>$jvid);
$this->db->where('fyear',$finyear );
$this->db->update('soc_settings_tbl', $upd_set);
}


if($data)
{
  //  var_dump($data);
    foreach ($data as $key => $jvalue) {

     $memid= $jvalue['mem_id'];
     $thf=$jvalue['thrift'];
     $emi=$jvalue['surety'];
     $interest=$jvalue['interest'];
     $insurance=$jvalue['insurance'];
     $others=$jvalue['others'];
     $total=$jvalue['rowtotal'];
     $mmyyyy=$jvalue['mmyy'];


//DM JV\
if($total>0)
{
    $narr="Division receipt credited to member account";
$dm_data[]=array("div_id"=>$div_id,"db_cr"=>"DM","division_id"=>$divid, "member_id"=>$memid, "trans_amount"=>(float)$total,"mmyyyy"=>$mmyyyy,"trans_date"=>$r_date,"trans_type"=>"JOUR","fyear"=>$finyear,"trans_narration"=>$narr,"sflag"=>"R","record_link_id"=>$last_ins_id);
}
//var_dump($dm_data);

//RV JV
$getImpAccData= $this->common_model->getImpAccHead();
//var_dump($getImpAccData);
if($getImpAccData)
{
    foreach ($getImpAccData as $impacc) {

        $tls = $impacc['import_account'];

 if(strtolower($tls)=='thrift')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
    if($thf>0)
    {
    $rv_data[]=array("div_id"=>$div_id,"db_cr"=>"RV","division_id"=>$divid,"acclink_id"=>$acclink, "member_id"=>$memid,"trans_amount"=>$thf,"mmyyyy"=>$mmyyyy,"trans_date"=>$r_date,"trans_type"=>"JOUR","trans_narration"=>$narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$last_ins_id);
}

 }
 if(strtolower($tls)=='principle')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
 if($emi>0)
 {
    $rv_data[]=array("div_id"=>$div_id,"db_cr"=>"RV","division_id"=>$divid,"acclink_id"=>$acclink, "member_id"=>$memid,"trans_amount"=>$emi,"mmyyyy"=>$mmyyyy,"trans_date"=>$r_date,"trans_type"=>"JOUR","trans_narration"=>$narr,"fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$last_ins_id);
}
 }
 if(strtolower($tls)=='interest')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
 if($interest>0)
 {
    $rv_data[]=array("div_id"=>$div_id,"db_cr"=>"RV","division_id"=>$divid,"acclink_id"=>$acclink, "member_id"=>$memid,"trans_amount"=>$interest,"mmyyyy"=>$mmyyyy,"trans_date"=>$r_date,"trans_type"=>"JOUR","trans_narration"=>$narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$last_ins_id);
 }
}
 if(strtolower($tls)=='insurance')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
 if($insurance>0)
 {
    $rv_data[]=array("div_id"=>$div_id,"db_cr"=>"RV","division_id"=>$divid,"acclink_id"=>$acclink, "member_id"=>$memid,"trans_amount"=>$insurance,"mmyyyy"=>$mmyyyy,"trans_date"=>$r_date,"trans_type"=>"JOUR","trans_narration"=>$narr,"fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$last_ins_id);
 }
}
 if(strtolower($tls)=='others')
 {
    $narr= $tls . ' RECOVERY CREDITED TO RESPECTIVE ACCOUNT';
    $acclink = $impacc['acclink_id'];
 if($others>0)
 {
    $rv_data[]=array("div_id"=>$div_id,"db_cr"=>"RV","division_id"=>$divid,"acclink_id"=>$acclink, "member_id"=>$memid,"trans_amount"=>$others,"mmyyyy"=>$mmyyyy,"trans_date"=>$r_date,"trans_type"=>"JOUR","trans_narration"=>$narr, "fyear"=>$finyear,"sflag"=>"R","record_link_id"=>$last_ins_id);
 }
}
} // Imp Acchead Loop



}

    } //Data Json loop



}

if($dm_data)
{
//    echo json_encode($dm_data);
$status=$this->db->insert_batch('soc_recovery_2021_tbl', $dm_data);
}

if($rv_data)
{
//    echo json_encode($rv_data);
$status=$this->db->insert_batch('soc_recovery_2021_tbl', $rv_data);
}

    if($status) 
    {
      $msg= array("success"=>true,"messages"=>"Record(s) Inserted successfully");
     echo json_encode($msg);
    }
    else
    {
     $msg= array("success"=>false,"messages"=>"Update action unsuccessfull...");
     echo json_encode($msg);
    }


//echo json_encode($ins_data);
}




  
    public function  fetchDivision()
    {
            $data = $this->common_model->get_division();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['division_name'].'</option>';
                }
                 // /foreach
                $option .= '<option disabled selected value=0>Select a Division</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    }


    public function create_Receipt(){
        $data = array();
        $data['page_title'] = 'New Receipt';
      $setid = $this->common_model->get_settings_id();

            foreach ($setid as $key=> $row)
       {
        $rctid = $row['receipt_id'];
        $data['receipt_id'] = $row['receipt_prefix'] . $rctid . '/' . $row['year'];
        }
    
       $data['main_content'] = $this->load->view('admin/Receipt/create_Receipt', $data, TRUE);
      $this->load->view('admin/index', $data);
    }



    public function create_Journal(){
        $data = array();
        $data['page_title'] = 'New Journal';
      $setid = $this->common_model->get_settings_id();

            foreach ($setid as $key=> $row)
       {
        $data['journal_id'] = $row['journal_id'] . '/' . $row['year'];
        }

        $data['main_content'] = $this->load->view('admin/Receipt/create_Journal', $data, TRUE);
        $this->load->view('admin/index', $data);
    }




}