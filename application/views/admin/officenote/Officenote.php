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
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="<?php echo base_url('officenote/get_onoteDatabyid/'); ?>"'. $duvalue['id'] .'" data-toggle="modal" data-target="#modalEditOffnote" onclick="updateOffnote(' . $duvalue['id'] . ')"><i class="fa fa-edit"></i>
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


public function get_onoteDatabyid()
{

$finyear=$this->session->userdata('finyear');
$id = $this->uri->segment(3);

     $duetoacc = $this->common_model->fetchofficenotebyid($finyear,$id);
     //$this->common_model->fetchofficenote();
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

$data['onotedata'] = $duvalue;
$data['status'] = $sts;
 
//$onotedata['data'][] = array("officenote_id"=>$duvalue['officenote_id'],"loan_appno"=>$duvalue['loan_appno'],"onote_date"=>$duvalue['onote_date'],"bank_cash"=>$duvalue['bank_cash'],"member_name"=>$mem_name,"surety_name"=>$smem_name,"loan_sanctioned"=>$duvalue['loan_sanctioned'],"roi_pc"=>$duvalue['roi_pc'],"res_number"=>$duvalue['res_number'],"res_date"=>$duvalue['res_date'],"amount_adjusted"=>$duvalue['amount_adjusted'],"mt_loanoutstanding"=>$duvalue['mt_loanoutstanding'],"mt_loaninterest"=>$duvalue['mt_loaninterest'],"mt_sharecapital"=>$duvalue['mt_sharecapital'],"sur_sharecapital"=>$duvalue['sur_sharecapital'],"fxd_deposit"=>$duvalue['fxd_deposit'],"drs_deposit"=>$duvalue['drs_deposit'],"other_amount"=>$duvalue['other_amount'],"chq_amt"=>$duvalue['chq_amt'],"chq_date"=>$duvalue['chq_date'], "chq_issued"=>$duvalue['chq_issued'],"chq_no"=>$duvalue['chq_no'],"amt_inrupees"=>$duvalue['amt_inrupees'],"status"=>$sts,"fyear"=>$duvalue['fyear'],"action"=>$button);


       $data['officenote_id'] = $duvalue['officenote_id'];
        }
     $data['duetoacc'] = $this->common_model->get_officenotedueto();

     //   $data['officenotes'] = $this->common_model->fetchofficenote($finyear);
   //     $data['main_content'] = $this->load->view('admin/officenote/all_officenote', $data, TRUE);
  //        $data['main_content'] = $this->load->view('admin/officenote/alloffnotes', $data, TRUE);
//        $this->load->view('admin/index', $data);
 
return $data;

//echo json_encode($onotedata);
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