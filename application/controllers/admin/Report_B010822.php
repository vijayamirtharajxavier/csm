<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct(){
        parent::__construct();
        check_login_user(); 
                $this->load->model('common_model');

$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}

    }
    



    public function index(){ 
        $data = array(); 

$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}

        $data['page_title'] = 'Dashboard';
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function dcb_report(){ 
        $data = array(); 

$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}

        $data['page_title'] = 'DCB Report';
        

        $data['main_content'] = $this->load->view('admin/report/all_dcbdata', $data, TRUE);
        $this->load->view('admin/index', $data);
    }



    public function all_rcbreport(){ 
        $data = array(); 
        $data['page_title'] = 'DCB Report';

$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}
        

        $data['main_content'] = $this->load->view('admin/report/all_rcbreport', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function trialbalance(){ 
        $data = array(); 
        $data['page_title'] = 'Trial Balance Report';
        

$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}

        $data['main_content'] = $this->load->view('admin/report/trialbalance', $data, TRUE);
        $this->load->view('admin/index', $data);
    }






public function fetchTBData()
{
  
    $fdt=date("Y-m-d", strtotime($this->input->get('fdate')));
    $tdt=date("Y-m-d", strtotime($this->input->get('tdate')));
  $finyear=$this->session->userdata('finyear');

  $allLdgData = $this->common_model->getAllLedger();
  
  $ldata = array();
 if($allLdgData)
 {
 $opbal=0;
 $debit=0;
 $credit=0; 
foreach ($allLdgData as $key => $ldvalue) {
    


$acid=$ldvalue["acclink_id"];
//$opbal=$ldvalue["op_balance"];
$isbnk=$ldvalue["bank_cash"];

$opData = $this->common_model->getOpBal($acid,$finyear);
//print_r($opData);
if($opData)
{
  foreach ($opData as $key => $opvalue) {
    $opbal=$opvalue["openingbalance"];
  }
}
else {
  $opbal=0;
}


$ldgbal=$this->common_model->getAccBal($isbnk,$acid,$fdt,$tdt,$finyear);
//print_r($finyear);
if($ldgbal)
{
foreach ($ldgbal as $key => $blvalue) {

  $debit= $blvalue["debit"];
  $credit=$blvalue["credit"];
  $bal = $opbal+ $debit-$credit;
//  print_r($opbal);
}
}
if($debit!=0 || $credit!=0)
{
    $ldata['data'][]=array(
      
      "accname"=>$acid . ' - ' . $ldvalue["account_name"],
      "opbalance"=>$opbal,
      "debit"=>$debit,
      "credit"=>$credit,
      "balance"=>$bal
    );
  }


}
  echo json_encode($ldata);
 }

}



public function fetchDemandById()
{
    $demand_id = $this->input->get('id');


        if($demand_id) { 

            $DemandData = $this->common_model->fetchDemandDataById($demand_id);

//var_dump($DemandData['member_name']);
//$stateselected = $DemandData['bill_state'];
//$ldgrp_selected= $DemandData['acct_type'];

$tbl = '<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><i class="fa fa-document"></i> Edit Demand</div>

<div id="add-demand-message"></div>
                                    

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    
                                        <div class="form-body">
                                            <h3 class="box-title">Demand Details</h3>


                                         </div>      

                                            <hr>

                               <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text">Member Name
                                    </label>
 
            <input type="text" tabindex="0" class="form-control" id="editmemberName" name="editmemberName" value="'.$DemandData['member_name'].'"  autocomplete="off"  required /> </div>
        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                
                                <div class="form-group">
                                    <label class="col-md-6" style="text-align:right;">Trift 
                                    </label>
            <input type="text" class="form-control" id="editThrift" name="editThrift" value="'.$DemandData['thrift_amount'].'"    autocomplete="off" placeholder="0.00" style="text-align:right"; />
                                </div>
                                </div>


                                <div class="col-md-3">
                                
                                <div class="form-group">
                                    <label class="col-md-6" style="text-align:right;">Principle 
                                    </label>
            <input type="text" class="form-control" id="editPrinciple" name="editPrinciple" value="'.$DemandData['principle_amount'].'"    autocomplete="off"  placeholder="0.00" style="text-align:right";  />
                                </div>
                                </div>
  
                                <div class="col-md-3">
                                
                                <div class="form-group">
                                    <label class="col-md-6" style="text-align:right;">Interest 
                                    </label>
            <input type="text" class="form-control" id="editInterest" name="editInterest" value="'.$DemandData['interest_amount'].'"    autocomplete="off"  placeholder="0.00" style="text-align:right"; />
                                </div>
                                </div>
                                <div class="col-md-3">
                                
                                <div class="form-group">
                                    <label class="col-md-6" style="text-align:right;">Insurance
                                    </label>
            <input type="text" class="form-control" id="editInsurance" name="editInsurance" value="'.$DemandData['insurance_amount'].'"    autocomplete="off"  placeholder="0.00" style="text-align:right";  />
                                </div>
                                </div>

        <input type="text" id="demand_id" name="demand_id" value="'.$demand_id.'" hidden  />                         

     </div> 
     </div>
     </div>
     </div>
     </div>';
 
 echo $tbl;


}

}




    public function updateDemand()

    {

         
        
            $validator = array('success' => false, 'messages' => array());
            $data = array();


  $params["member_name"] = $this->input->post("editmemberName");
  $params["edit_thrift"] = $this->input->post("editthrift_amt");
  $params["edit_principle"] = $this->input->post("editprinciple_amt");
  $params["edit_interest"] = $this->input->post("editinterest_amt");
  $params["edit_insurance"] = $this->input->post("editinsurance_amt");
  $params["edit_misc"] = $this->input->post("editmisc_amt");
  $params["id"] = $this->input->post("demand_id");

       

  //var_dump($params);
           // $demand_data = $this->common_model->update_demand($d_id);

            $demand = $this->common_model->update_demand($params);                    
    
            if($demand === true) {
                $validator['success'] = true;
                $validator['messages'] = "Successfully updated...";
                
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Error while updating the information into the database";
            }           
echo json_encode($validator);
    }





    public function  fetchMemberlist()
    {

   $qry = $this->input->get('qry'); 
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
         // /if



   public function fetchItemMastData()
   {
  $tbl ="";
  $itemmast = $this->common_model->get_subaccount();

$tbl .='<table id="itemmastTbl" class="table"><th><b>Account Name</b></th><th><b>Amount</b></th>';
  
  foreach ($itemmast as $key => $value) {
    # code...
  

       $tbl .= '<tr><td><b>' . $value["item_name"] . '</b></td>
        <td><input type="text" id="'. strtolower($value["item_name"])  .'_amt" name="'. strtolower($value["item_name"])  .'_amt" placeholder="0.00" style="text-align:right;"  class="form-control calc" </td>
         </tr>';
     

   }
  $tbl .='<tr><td>Total</td><td><b><input  id="totAmt" name="totAmt" style="text-align:right;" class="form-control" type="text" readonly></b> </td></tr></table>';

 echo $tbl;

}



public function fetchrcb()

{
$result= array();
  //$monthyear=$this->input->get('month_year');
 //$acct_id = $this->input->get('account');
  $dcbdata = $this->common_model->get_all_Ledger();
//print_r($dcbdata);

  //  $mem_id = $this->input->get('memberid');
 //   $acc_id = $this->input->get('accountid');
    $fdate = $this->input->get('fdate');
    $tdate = $this->input->get('tdate');
//print_r($fdate);
if(count($dcbdata)>0)
{

$paid=0;
$deposit=0;
$rcttot =0;

$tbl = '';
$opbal =0;
$closingbal=0;
foreach ($dcbdata as $key => $value) {

$acctid = $value['acclink_id'];
$acctname = $value['account_name'];

$finyear=$this->session->userdata('finyear');

$opData = $this->common_model->getOpBal($acctid,$finyear);
//var_dump($opData);

//print_r($opData);
if($opData)
{
  foreach ($opData as $key => $opvalue) {
    $opbal=$opvalue["openingbalance"];
  }
}
else {
  $opbal=0;
}


//$acctop = $value['op_balance'];
$acctop=$opbal;
$closingbal = $acctop;


$trndata = $this->common_model->getRC_Data($acctid,$fdate,$tdate);
foreach ($trndata as $key => $rcvalue) {
  # code...

$db = $rcvalue['debit'];
$cr = $rcvalue['credit'];

$closingbal = $closingbal + $db - $cr;

if($closingbal<0)
{
  $cbal = number_format((float)abs($closingbal), 2, '.', ',') . " Cr";
}
else if($closingbal>0) {
  $cbal =  number_format((float)$closingbal, 2, '.', ',') . " Db";
}
else 
{
 $cbal =  number_format((float)$closingbal, 2, '.', ',') . " "; 
}

if($db<>0 || $cr<>0 )
{
     $result['data'][]  = array("acctid"=>$acctid,"acctname"=>$acctname,"opening"=>number_format($acctop,2,'.',''),"receipt"=>number_format($db,2,'.',''),"issues"=>number_format($cr,2,'.',''), "closing"=>$cbal);
}
}


/*
$trndata = $this->common_model->getRec_Data($acct_id,$memberid);
//print_r($trndata);
if($trndata>0)
{
foreach ($trndata as $key => $tvalue) {
  # thrift repaid

  //$paid = $tpvalue['payment'];
if($tvalue['debit']<>0)
{
$paid = $paid + $tvalue['debit'];
}

if($tvalue['credit']<>0)
{
$deposit = $deposit + $tvalue['credit'];
}

}

}

if($acct_id=="539") {
$opbal = $value['loan_opbal'];
$closingbal = ($opbal + $paid) - $deposit ;
$db = $deposit;
$cr = $paid;


     $result['data'][]  = array("acctid"=>$acctid,"acctname"=>$acctname,"opening"=>$acctop"deposit"=>number_format($db,2,'.',''),"payment"=>number_format($cr,2,'.',''), "closing"=>number_format($closingbal,2,'.',''));

}



if($acct_id=="538") {
$opbal = $value['thrift_opbal'];
$db = $deposit;
$cr = $paid;

$closingbal = ($opbal + $deposit) - $paid;

     $result['data'][]  = array("memberid"=>$memberid,"membername"=>$membername,"opening"=>$opbal, "apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec,"jan"=>$jan,"feb"=>$feb,"mar"=>$mar, "deposit"=>number_format($db,2,'.',''),"payment"=>number_format($cr,2,'.',''), "closing"=>number_format($closingbal,2,'.',''));


}
if($acct_id=="533") {
$opbal = $value['share_capital'];
$db = $paid;
$cr = $deposit;
$closingbal = ($opbal + $deposit) - $paid;




     $result['data'][]  = array("memberid"=>$memberid,"membername"=>$membername,"opening"=>$opbal, "apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec,"jan"=>$jan,"feb"=>$feb,"mar"=>$mar, "deposit"=>number_format($cr,2,'.',''),"payment"=>number_format($db,2,'.',''), "closing"=>number_format($closingbal,2,'.',''));

}

*/



$deposit=0;
$paid=0;
}


}


echo json_encode($result);

}






public function fetchdcb()

{
$result= array();
  //$monthyear=$this->input->get('month_year');
 $acct_id = $this->input->get('account');
//  $dcbdata = $this->common_model->getDcbData();
//print_r($dcbdata);
$finyear=$this->session->userdata('finyear');

$opData = $this->common_model->get_OpBal($finyear);
/*//print_r($opData);
if($opData)
{
  foreach ($opData as $key => $opvalue) {
    $opbal=$opvalue["openingbalance"];
  }
}
else {
  $opbal=0;
}
*/
  //  $mem_id = $this->input->get('memberid');
 //   $acc_id = $this->input->get('accountid');
 //   $fdate = $this->input->get('fdate');
 //   $tdate = $this->input->get('tdate');
//print_r($fdate);
if(count($opData)>0)
{

$paid=0;
$deposit=0;
$rcttot =0;

$tbl = '';
$opbal =0;
$closingbal=0;
foreach ($opData as $key => $value) {

$memberid = $value['acclink_id'];
$membername = $value['account_name'];


$itemdata = $this->common_model->fetchRecoveryData($acct_id,$memberid,$finyear);
//print_r($itemdata);
foreach ($itemdata as $key => $rvalue) {
  # recovery data
$apr = $rvalue['apr'];
$may = $rvalue['may'];
$jun = $rvalue['jun'];
$jul = $rvalue['jul'];
$aug = $rvalue['aug'];
$sep = $rvalue['sep'];
$oct = $rvalue['oct'];
$nov = $rvalue['nov'];
$dec = $rvalue['dec'];
$jan = $rvalue['jan'];
$feb = $rvalue['feb'];
$mar = $rvalue['mar'];

$rcttot= $apr+$may+$jun+$jul+$aug+$sep+$oct+$nov+$dec+$jan+$feb+$mar;

}


$trndata = $this->common_model->getRec_Data($acct_id,$memberid,$finyear);
//print_r($trndata);
if($trndata>0)
{
foreach ($trndata as $key => $tvalue) {
  # thrift repaid

  //$paid = $tpvalue['payment'];
if($tvalue['debit']<>0)
{
$paid = $paid + $tvalue['debit'];
}

if($tvalue['credit']<>0)
{
$deposit = $deposit + $tvalue['credit'];
}

}

}

if($acct_id) {
$opbal = $value['loan_opbal'];
$closingbal = ($opbal + $paid) - $deposit ;
$db = $deposit;
$cr = $paid;


     $result['data'][]  = array("memberid"=>$memberid,"membername"=>$membername,"opening"=>$opbal, "apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec,"jan"=>$jan,"feb"=>$feb,"mar"=>$mar, "deposit"=>number_format($db,2,'.',''),"payment"=>number_format($cr,2,'.',''), "closing"=>number_format($closingbal,2,'.',''));

}



if($acct_id=="538") {
$opbal = $value['thrift_opbal'];
$db = $deposit;
$cr = $paid;

$closingbal = ($opbal + $deposit) - $paid;

     $result['data'][]  = array("memberid"=>$memberid,"membername"=>$membername,"opening"=>$opbal, "apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec,"jan"=>$jan,"feb"=>$feb,"mar"=>$mar, "deposit"=>number_format($db,2,'.',''),"payment"=>number_format($cr,2,'.',''), "closing"=>number_format($closingbal,2,'.',''));


}
if($acct_id=="533") {
$opbal = $value['share_capital'];
$db = $paid;
$cr = $deposit;
$closingbal = ($opbal + $deposit) - $paid;




     $result['data'][]  = array("memberid"=>$memberid,"membername"=>$membername,"opening"=>$opbal, "apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec,"jan"=>$jan,"feb"=>$feb,"mar"=>$mar, "deposit"=>number_format($cr,2,'.',''),"payment"=>number_format($db,2,'.',''), "closing"=>number_format($closingbal,2,'.',''));

}





$deposit=0;
$paid=0;
}

//print_r($result);
/*

     $result['data'][$key]  = array(
                //$rw,
                "memberid"=>$memberid,
                "membername"=>$membername,
//                "tr_ref"=>$tr_ref,
 //               "tr_date"=>$tr_date,
                "cb_name"=>$cb_name,
 //               "op_sharecapital"=>$op_sharecapital,
                "op_thrift"=>$op_thrift,
              //  "op_principle"=>$loan_op,
                "thrift"=>$thriftDep,
                "thriftclosing" => $thriftclosing
              //  "interest"=>$interest,
              //  "principle"=>$principle,
              //  "insurance"=>$insurance
                );  
            





} */


}


echo json_encode($result);

}



    public function fetchDemandData()
    {
  //  $compId=$this->session->userdata['id']; 
  //  $isItc=$this->session->userdata['isItc'];   
    
   // $sdate="2019-08-01";
   // $edate="2019-08-05";
$div_id=$this->input->get('div_id');
$monthyear=$this->input->get('month_year');
    
$dmdacclist = $this->common_model->dmd_accounts();
$mid_sql="";
$start_sql ="SELECT d.mmyyyy, dv.division_name, d.div_id,m.employee_id,d.member_id,m.member_name,dsg.designation";
if($dmdacclist)
{
    foreach($dmdacclist as $davalue)
    {
        $dacc = $davalue['id'];
        $dacc_name=strtolower($davalue['import_account']);
$mid_sql .=",SUM(CASE WHEN d.acclink_id='". $dacc ."' THEN d.trans_amount ELSE 0 END)`" . $dacc_name . "`";

    }

$end_sql= " FROM `soc_demand_2021_tbl` d, soc_members_tbl m,soc_designation_tbl dsg,soc_division_tbl dv WHERE dv.id=d.div_id and m.designation_id=dsg.id and d.member_id=m.member_id and d.div_id=" . $div_id . " AND  d.mmyyyy='" . $monthyear . "'  GROUP By d.member_id ORDER BY d.member_id ";

$final_sql = $start_sql . $mid_sql . $end_sql;
//var_dump($final_sql);

$rw=1;
$dmd_data = $this->common_model->dmd_data($final_sql);
        
        $result = array('data' => array());

    foreach($dmd_data as $key => $value) { 
        $total_amount = $value['insurance'] + $value['thrift']+$value['principle'] + $value['interest'];

    $result['data'][$key] = array(
                //$rw,
                "division_name"=>$value['division_name'],
                "employee_id"=>$value['employee_id'],
                "member_id"=>$value['member_id'],
                "member_name"=>$value['member_name'],
                "designation"=>$value['designation'],
                
                "insurance_amount"=>$value['insurance'],
                "thrift_amount"=>$value['thrift'],
                "principle_amount"=>$value['principle'],
                "interest_amount"=>$value['interest'],
                "total_amount"=>$total_amount

               // "action" => $button
                );  
            $rw=$rw+1;
            
        }
    }
        echo json_encode($result);
    }
        



 

   public function fetchDemandUpdate() 
    {
    //  $id=this->input->post("invNo");
        $id = $this->uri->segment(4);
       
       // $compId=$this->session->userdata['id'];
        
         $DemandSelectedData = $this->common_model->fetchDemandDataById($id);
         
         
if ($DemandSelectedData) {

$thriftamt = $DemandSelectedData['thrift_amount'];
$principleamt=$DemandSelectedData['principle_amount'];
$interestamt = $DemandSelectedData['interest_amount'];
$tot_amt = $thriftamt+$principleamt+$interestamt;

$table = '<table id="dmdMTbl" class="table"><tr><td><input type="text" id="demand_id" name="demand_id" value="'.$DemandSelectedData["id"].'" hidden  />Member Name<input type="text" id="editMemberName" readonly name="editMemberName" autocomplete="off" class="form-control" value="'. $DemandSelectedData["member_name"].'" /></td></tr><table id="dmdTbl" class="table"><tr><th>S.No.</th><th>Account Head</th><th>Amount</th></tr><tbody><tr><td>1</td><td>THRIFT</td><td><input type="text" style="text-align:right;" class="form-control amt" id="editthrift_amt" name="editthrift_amt" autocomplete="off" onkeyup="myCalc();" value="'. $DemandSelectedData["thrift_amount"] .'"/></td></tr><tr><td>2</td><td>PRINCIPLE</td><td><input style="text-align:right;"  class="form-control amt"  id="editprinciple_amt"  name="editprinciple_amt"  onkeyup="myCalc();" autocomplete="off" value="'. $DemandSelectedData["principle_amount"] .'"/></td></tr><tr><td>3</td><td>INTEREST</td><td><input type="text" style="text-align:right;" class="form-control amt"  id="editinterest_amt" name="editinterest_amt" autocomplete="off" onkeyup="myCalc();"  value="'. $DemandSelectedData["interest_amount"] .'"/></td></tr><tr><td>4</td><td>INSURANCE</td><td><input type="text" style="text-align:right;" class="form-control amt"  id="editinsurance_amt" name="editinsurance_amt" autocomplete="off" onkeyup="myCalc();"  value="'. $DemandSelectedData["insurance_amount"] .'"/></td></tr><tr><td>3</td><td>MISC</td><td><input type="text" style="text-align:right;" class="form-control amt"  id="editmisc_amt" name="editmisc_amt" onkeyup="myCalc();"  autocomplete="off"  value="'. $DemandSelectedData["misc_amount"] .'"/></td></tr><tr><td colspan="2">Total</td><td><input class="form-control" readonly style="text-align:right;" type="text" id="tot_amt" name="tot_amt" value="'.  number_format($tot_amt, 2, '.', ',') .' "/></td></tr></tbody></table></table>';



/*$table='<label>Member Name</label>
        <span><input type="text" id="editmemname" name="editmemname" autocomplete="off"  value="'.$dvalue['member_name'].'" placeholder="Member Name" class="form-control" required></span>
        <input type="text" hidden name="editmemid" id="editmemid"  value="'.$dvalue['id'].'">';
*/

  // print_r($DemandSelectedData['member_name']);     
}
          echo $table;


    
    }



    public function processDemand()
    {
 
$query="";
    $fmdate=$this->input->get('dMonth');
    
    $todate =  date("Y-m-t", strtotime($fmdate));
    $mmyy = date("mY", strtotime($fmdate));
            $validator = array('success' => false, 'messages' => array());

            $members_data = $this->common_model->getMembers_data();  
            $mdata = array();
          


            $data = array();
            if($members_data) {
                $x=0;
//var_dump($members_data);
               foreach ($members_data as  $mvalue) {
                $lout = $mvalue['loan_outstanding'];
                $lint = $mvalue['rate_of_interest'];

                  $interestamt = (($lout*$lint/100)/12);
                $data[] = array(
               /* 'member_id' => $mvalue['member_id'],
                'thrift' => $mvalue['thrift_monthly'],
                'principle' => $mvalue['principle_amount'],
                'interest' => $interestamt*/
                
                        'demand_date' => $todate,
                        'member_id'=> $mvalue['member_id'],
                        'thrift_amount'=>strval($mvalue['thrift_monthly']),
                        'principle_amount'=>strval($mvalue['principle_amount']),
                        'interest_amount'=> strval($interestamt),
                        'month_year' => $mmyy





                );

   $query .= "INSERT INTO `soc_demandtemp_tbl` set 
          `member_id`  = '".$mvalue['member_id']."',
          `demand_date`  = '".$todate."', 
          `thrift_amount`   = ".$mvalue['thrift_monthly'].",
          `principle_amount` = ".$mvalue['principle_amount'].", 
          `interest_amount`    = ".$interestamt.",
          `month_year`    = '".$mmyy."';";

                
                  $x++;
               
                }

   // print_r($query);
                
                //$ins_data = $this->common_model->insertDemand($fmdate,$todate,$data,$mmyy);
            //    var_dump(json_encode($data));
    $status = $this->db->query($query);         
                 
                    
        
  return ($status === true ? true : false);   
 

                
            $validator = array('success' => false, 'messages' => array());


            
            if($ins_data === true) {
                $validator['success'] = true;
                $validator['messages'] = "Process Completed Successfully";
                
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Error while inserting the information into the database";
            }           
echo json_encode($validator);
    }
    
    }    



public function fetchSelectLedgerAccounts()
{
            $data = $this->common_model->get_ldgacclist();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
//                        $option .= '<option value="'.$value['acclink_id'].'">'.$value['account_name'].'</option>';
                 $ldgData[] = array("id"=>$value["acclink_id"],"text"=> $svalue["account_name"]);
                }
                 // /foreach
//                $option .= '<option selected value=0>All Ledger Accounts</option>';
            }
            else {
                $ldgData = '<option value="">No Data</option>';
            } // /else empty section

            echo json_encode($ldgData);

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
                $option .= '<option selected value=0>SELECT AN ACCOUNT</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

}



   public function  fetchLedgerAccounts()
    {
        $option="";
            $data = $this->common_model->get_dcbldgacclist();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
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

   public function  fetchDivision()
    {
        $option="";
            $data = $this->common_model->get_division();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                        $option .= '<option value="'.$value['id'].'">'. $value["division_name"] .'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>All Divsions</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

}



    public function all_application_list()
    {

$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}

        $data['page_title'] = 'All Loan Applications';
        $data['applications'] = $this->common_model->get_all_loanapplications();
        $data['country'] = $this->common_model->select('soc_country');
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/report/loanapplications', $data, TRUE);
        $this->load->view('admin/index', $data);
    }




    public function demand_process(){
        $data = array();

$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}

        $data['page_title'] = 'Monthly Demand Process';
        $data['main_content'] = $this->load->view('admin/report/monthly_demandprocess', $data, TRUE);
        $this->load->view('admin/index', $data);
    }




    public function payment_report(){
        $data = array();
        
$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}

        $data['page_title'] = 'Payment Report';
        $data['main_content'] = $this->load->view('admin/report/payment_report', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function demand_rep(){
        $data = array();
        $data['page_title'] = 'Demand Report';
        $data['main_content'] = $this->load->view('admin/report/demand_rep', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function income_report(){
        $data = array();
        $data['page_title'] = 'Income Report';
        $data['main_content'] = $this->load->view('admin/report/income_report', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function ledger_report(){
        $data = array();
        $data['page_title'] = 'Ledger Report';
        $data['main_content'] = $this->load->view('admin/report/ledger_report', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function ledger_glreport(){
        $data = array();
        $data['page_title'] = 'General Ledger Report';
        $data['main_content'] = $this->load->view('admin/report/ledger_glreport', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function creditledger_report(){
        $data = array();
        $data['page_title'] = 'Ledger Report';
        $data['main_content'] = $this->load->view('admin/report/creditledger_rep', $data, TRUE);
        $this->load->view('admin/index', $data);
    }



    public function cashbank_daybook(){
        $data = array();
        $data['page_title'] = 'Cash / Bank Report';
        $data['main_content'] = $this->load->view('admin/report/cash_bank', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function daybook(){
        $data = array();
        $data['page_title'] = 'DayBook Report';
        $data['main_content'] = $this->load->view('admin/report/all_daybook', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function fetchledgerJson()
    {

        $data= array();
    //    $acct_id = $this->uri->segment(5);
            $acct_id = $this->input->get('selacc');
 //$acct_id = $this->input->post('ldgrSelect');
        
        
        $data = $this->common_model->getLedger_data($acct_id);  
  // print_r($data);     
 $os_balresult=0;
        $result =array();
        foreach($data as $key => $value) { 

    $cr_amount = 0;
    $db_amount = 0;
    $db_tot=0;
    $cr_tot=0;
    $bal_tot=0;
    $itmnam = "";

$openBal = $this->common_model->fetchledgerOp($value['acclink_id']);
        foreach($openBal as $key => $opvalue) { 
    $db_tot=0;
    $cr_tot=0;


   //   $os_balresult = $opvalue['loan_opbal']; 
  
}

            $fmdate = $this->input->get('fdate');
            $todate = $this->input->get('tdate');

 $subData = $this->common_model->fetchLedgerGLSubData($value['acclink_id'],$fmdate,$todate,$acct_id);
//print_r($subData);
if($acct_id=="0") {
    $a_id=$value['acclink_id'];
}
else {
    $a_id=$acct_id;
}
$bal_tot=0;

  //$bal_tot = $os_balresult;
        foreach($subData as $key => $svalue) { 
/*
       if($svalue['account_id']==$a_id && $svalue["trans_type"]=="RECEIPT"){
        $cr_amount=0;
        $db_amount=0;
        $db_amount = $svalue['trans_amount'];
        $db_tot = $db_tot+$db_amount;
        $account_name = $svalue['cash_bank'];
       }


       if($svalue['cash_bank_id']==$a_id && $svalue["trans_type"]=="JOURNAL"){
        $cr_amount=0;
        $db_amount=0;
        $db_amount = $svalue['trans_amount'];
        $db_tot = $db_tot+$db_amount;
        $account_name = $svalue['cash_bank'];
       }

       if($svalue['account_id']==$a_id && $svalue["trans_type"]=="JOURNAL"){
        $db_amount=0;
        $cr_amount=0;
        $cr_amount = $svalue['trans_amount'];
        $cr_tot = $cr_tot+$cr_amount;
        $account_name = $svalue['cash_bank'];
       }
       if($svalue['cash_bank_id']==$a_id && $svalue["trans_type"]=="PAYAMENT"){
        $db_amount=0;
        $cr_amount=0;
        $cr_amount = $svalue['trans_amount'];
        $cr_tot = $cr_tot+$cr_amount;
        $account_name = $svalue['account_name'];
       }*/


  //  $bal_tot = $os_balresult+$db_tot-($cr_tot);

      $sresult[] = array(
            "acc_name" => $svalue['account_name'],
            "trans_date" => $svalue['trans_date'],
            "cash_bank" => $svalue['cash_bank'],
          //  "trans_amount" => $svalue['trans_amount'], // $db_amount,
           // "cr_amount" => $cr_amount,
          //  'debittot' => $db_tot,
            "thrift"=> $svalue["THRIFT"],
            "principle"=> $svalue["PRINCIPLE"],
            "interest"=> $svalue["INTEREST"]
            
       //   'credittot' => number_format($bal_tot, 2, '.', ',') $cr_tot,
            //"bal_tot" =>  number_format($trans_amount, 2, '.', ',') 
        ); 
 
}
  

$result[] = array(
   // 'id'=>$value['id'],
    'accname'=> $value['account_name'],
    'openingbalance' => number_format((float)$os_balresult, 2, '.', ','),
    'ledgerdetails'=> $sresult,
    'closingbal' => number_format((float)$bal_tot, 2, '.', ',')
);


$bal_tot=0;
  $sresult='';
       $os_balresult='';
}
  $sresult='';

        echo json_encode($result);
}


function getAccName($accId)
{

$getAccNameData=$this->common_model->getAccHead($accId);
if($getAccNameData)
{
    foreach ($getAccNameData as $key => $anvalue) {
        // code...
        $ac_name = $anvalue['account_name'];
    }
return $ac_name;
}
else
{
    $ac_name='';
    return $ac_name;
}
}


function getBankCashCode($accId)
{

$getAccNameData=$this->common_model->getAccHead($accId);
if($getAccNameData)
{
    foreach ($getAccNameData as $key => $anvalue) {
        // code...
        $bc_code = $anvalue['bank_cash'];
    }
return $bc_code;
}
else
{
    $bc_code='';
    return $bc_code;
}
}

public function fetchDaybookSearch()
{
    $fdate = $this->input->get('fdate');
    $tdate = $this->input->get('tdate');
$day_ctot_db=0;
$day_ctot_cr=0;
$day_btot_db=0;
$day_btot_cr=0;
$day_cl_bal=0;
$day_grand_ctot_db=0;
$day_grand_ctot_cr=0;
$day_grand_btot_db=0;
$day_grand_btot_cr=0;
$day_op_bal =0;
$tot_rcpt=0;
$tbl='';
$finyear=$this->session->userdata('finyear');
$cash_id = "1";
$acct_id = $cash_id;
$opData = $this->common_model->getOpBal($cash_id,$finyear);
//print_r($opData);
if($opData)
{
  foreach ($opData as $key => $opvalue) {
    $opbal=$opvalue["openingbalance"];
   $acc_name=$opvalue['account_name'];

  }
}
else {
  $opbal=0;
   $acc_name='';

}

$opBal=$opbal;
 //  $opBal = $ovalue['op_balance'];
  // $acc_name=$opvalue['account_name'];


$dbamt=0;
$cramt=0;
$dbTot=0;
$crTot=0;
$bal_tot=0;

$odbamt=0;
$ocramt=0;
$odbTot=0;
$ocrTot=0;
$obal_tot=0;

$data_ins=array();

$transOpData = $this->common_model->getTransOpData($acct_id,$fdate,$tdate);

//print_r($transOpData);

foreach ($transOpData as $key => $opvalue) {
  # code...
$trans_type = $opvalue['trans_type'];

if(trim($trans_type)=="RCPT" && $opvalue["account_id"]==$acct_id)
{
  $odbamt = $opvalue["trans_amount"];
  //print_r($dbamt ."db");
  
}

if(trim($trans_type)=="RCPT" && $opvalue["cr_account_id"]==$acct_id)
{
  $ocramt = $opvalue["trans_amount"];
  
}

if(trim($trans_type)=="PYMT" && $opvalue["account_id"]==$acct_id)
{
  $ocramt = $opvalue["trans_amount"];
  
}

if(trim($trans_type)=="PYMT" && $opvalue["cr_account_id"]==$acct_id)
{
  $odbamt = $opvalue["trans_amount"];
  
}

if(trim($trans_type)=="JOUR" && $opvalue["account_id"]==$acct_id)
{
  $odbamt = $opvalue["trans_amount"];
  
}

if(trim($trans_type)=="JOUR" && $opvalue["cr_account_id"]==$acct_id)
{
  $ocramt = $opvalue["trans_amount"];
  
}


if(trim($trans_type)=="CNTR" && $opvalue["cr_account_id"]==$acct_id)
{
  $odbamt = $opvalue["trans_amount"];
  
}

if(trim($trans_type)=="CNTR" && $opvalue["account_id"]==$acct_id)
{
  $ocramt = $opvalue["trans_amount"];
  
}


        $odbTot =$odbTot + $odbamt;
        $ocrTot =$ocrTot + $ocramt;

//print_r("db" .$odbTot);
//print_r("cr" .$ocrTot);
$odbamt=0;
$ocramt=0;

}

$obal_tot =  $obal_tot+ $odbTot-$ocrTot;
$opBal = $opBal + $obal_tot;
//$opBal=0;
//print_r($bal_tot . "=" . $odbTot . "=" . $ocrTot);
$odbTot=0;
$ocrTot=0;










$tbl.='<style>caption {
    padding: 10px;
    font-weight:bold;
    caption-side: top;
}caption span
{    
    float:right; 

    /*background:red;*/
}th {
border-bottom: 1pt solid black;border-top: 1pt solid black;
}
@media print {
    #printarea* { display:block; };
}
</style>';

$tbl.='<div id="main"><div id="printarea">';

$tbl.='<table id="daybookTable" class="table-condensed" style="white-space:nowrap;">';
$tbl.='<caption>Dr <span>Cr</span> </caption>';
$tbl.='<tr><th>Receipt#</th><th width="100%">Particulars</th><th></th><th></th><th>L.F.#</th><th>Cash</th><th>Adjusted</th><th>Total</th><th>Voucher#</th><th width="100%">Particulars</th><th></th><th></th><th>L.F.#</th><th>Cash</th><th>Adjusted</th><th>Total</th></tr>';

$tbl.='<tbody><tr>';

// Set timezone
    date_default_timezone_set('UTC');

    // Start date
    $date = $fdate;
    // End date
    $end_date = $tdate;

$day_grand_ctot_db =$opBal;


    while (strtotime($date) <= strtotime($end_date)) {
 //               echo "$date\n";
$day_ctot_db=0;
$day_ctot_cr=0;
$day_btot_db=0;
$day_btot_cr=0;
$day_cl_bal=0;

$day_grand_ctot_cr=0;
$tbl.='<tr></tr>';
$tbl.='<td colspan="15" style="text-align:center;font-weight:bold;">>>>>>>>>> '. $date .' <<<<<<<<<<</td>';
$tbl.='<tr></tr>';

$getTransData = $this->common_model->getDBTransData($date);
if($getTransData)
{

    foreach ($getTransData as  $trvalue) {
        // code...
$db_accid=$trvalue['account_id'];
$cr_accid=$trvalue['cr_account_id'];
$db_cr=$trvalue['db_cr'];

//echo $rbc;
$tbl.='<tr>';

if($trvalue['trans_type']=="RCPT")
{
$acc_name=$this->getAccName($cr_accid);
$bc_cd=$this->getBankCashCode($db_accid);
$acc_cname=$this->getAccName($db_accid);

//$tbl.='<td>'. $trvalue['trans_date'] .'</td>';
$tbl.='<td>'. $trvalue['trans_refid'] .'</td>';
//$tbl.='<td>'. $acc_name  .'</td>';
$tbl.='<td colspan="2"><div style="color:red;margin-bottom:-25px;font-weight:bold;">'. $acc_cname  .'</div><br><div style="font-size:12px;">' . $cr_accid . ' - ' . $acc_name  .'</div></td>';

if($bc_cd==1)
{
    $tbl.='<td></td><td></td><td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';
    $day_ctot_db=$day_ctot_db+$trvalue['trans_amount'];
}
else
{
    
    $tbl.='<td></td><td></td><td></td><td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';
    $day_btot_db=$day_btot_db+$trvalue['trans_amount'];

}
} //Receipt





if($trvalue['trans_type']=="PYMT")
{
$bc_cd=$this->getBankCashCode($db_accid);
if($bc_cd==1)
{

if($db_cr=="DB")
{
$acc_name=$this->getAccName($cr_accid);
$acc_cname=$this->getAccName($db_accid);
//$tbl.='<td>'. $trvalue['trans_date'] .'</td>';
$tbl.='<td>'. $trvalue['trans_refid'] .'</td>';
$tbl.='<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2"><div style="color:red;margin-bottom:-25px;font-weight:bold;">'.  $acc_cname  .'</div><br><div style="font-size:12px;">' . $cr_accid . ' - ' . $acc_name . ' - '. $trvalue['cheque_ref'] .'</div></td>';

    $tbl.='<td></td><td></td><td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';
    $day_ctot_cr=$day_ctot_cr+$trvalue['trans_amount'];

}

}
else
{
if($db_cr=="DB")
{
$acc_name=$this->getAccName($cr_accid);
$acc_cname=$this->getAccName($db_accid);

$tbl.='<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>'. $trvalue['trans_refid'] .'</td><td><div style="color:red;margin-bottom:-25px;font-weight:bold;">'.  $acc_cname  .'</div><br><div style="font-size:12px;">' . $cr_accid . ' - ' . $acc_name . ' - '. $trvalue['cheque_ref'] .'</div></td>';
    $tbl.='<td></td><td></td><td></td><td></td><td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';
    $day_btot_cr=$day_btot_cr+$trvalue['trans_amount'];

}

//        $day_btot_cr=$day_btot_cr+$trvalue['trans_amount'];


}

} //PYMT

if($trvalue['trans_type']=="CNTR")
{
$bc_cd=$this->getBankCashCode($db_accid);
if($bc_cd==1)
{

if($db_cr=="DB")
{
$acc_name=$this->getAccName($cr_accid);
$acc_cname=$this->getAccName($db_accid);
//$tbl.='<td>'. $trvalue['trans_date'] .'</td>';
//$tbl.='<td>'. $trvalue['trans_refid'] .'</td>';
$tbl.='<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2"><div style="color:red;margin-bottom:-25px;font-weight:bold;">'.  $acc_name  .'</div><br><div style="font-size:12px;">' . $acc_cname . ' - '. $trvalue['cheque_ref'] .'</div></td>';
    $tbl.='<td></td><td></td><td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';
    $day_ctot_cr=$day_ctot_cr+$trvalue['trans_amount'];

}

}
else
{
if($db_cr=="DB")
{
$acc_name=$this->getAccName($cr_accid);
$acc_cname=$this->getAccName($db_accid);
$tbl.='<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2"><div style="color:red;margin-bottom:-25px;font-weight:bold;">'.  $acc_name  .'</div><br><div style="font-size:12px;">' . $acc_cname . ' - '. $trvalue['cheque_ref'] .'</div></td>';
    $tbl.='<td></td><td></td><td></td><td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';
    $day_btot_cr=$day_btot_cr+$trvalue['trans_amount'];

}

//        $day_btot_cr=$day_btot_cr+$trvalue['trans_amount'];


}

} //CNTR

if($trvalue['trans_type']=="JOUR")
{

$bc_cd=$this->getBankCashCode($db_accid);


if($bc_cd<>1)
{

if($db_cr=="RJ")
{
$acc_name=$this->getAccName($db_accid);
$acc_cname=$this->getAccName($cr_accid);
$tbl.='<td></td><td><div style="color:red;margin-bottom:-25px;font-weight:bold;">'.  $acc_name  .'</div><br><div style="font-size:12px;">' . $cr_accid . ' - ' . $acc_cname . '</div></td>';
$tbl.='<td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';

}

if($db_cr=="DM")
{
$acc_name=$this->getAccName($db_accid);
$acc_cname=$this->getAccName($cr_accid);

$tbl.='<td></td><td><div style="color:red;margin-bottom:-25px;font-weight:bold;">'.  $acc_name  .'</div><br><div style="font-size:12px;">' . $cr_accid . ' - ' . $acc_cname . '</div></td>';
$tbl.='</td><td><td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';

}
if($db_cr=="RV")
{
$acc_name=$this->getAccName($db_accid);
$acc_cname=$this->getAccName($cr_accid);
//$tbl.='</td><td>'. $trvalue['trans_date'] .'</td>';
//$tbl.='<td>'. $trvalue['trans_refid'] .'</td>';
$tbl.='<td></td><td><div style="color:red;margin-bottom:-25px;font-weight:bold;">'.  $acc_name  .'</div><br><div style="font-size:12px;">' . $cr_accid . ' - ' . $acc_cname . '</div></td>';
$tbl.='<td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';
//$day_btot_db=$day_btot_db+$trvalue['trans_amount'];

}

if($db_cr=="PJ")
{
$acc_name=$this->getAccName($db_accid);
$acc_cname=$this->getAccName($cr_accid);

$tbl.='<td></td><td></td><td></td><td></td><td></td><td></td><td>'. $trvalue['trans_date'] .'</td>';
$tbl.='<td>'. $trvalue['trans_refid'] .'</td>';
$tbl.='<td><div style="color:red;margin-bottom:-25px;font-weight:bold;">'.  $acc_name  .'</div><br><div style="font-size:12px;">' . $cr_accid . ' - ' . $acc_cname . '</div></td>';
$tbl.='<td></td><td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';
$day_btot_cr=$day_btot_cr+$trvalue['trans_amount'];

}


if($db_cr=="LN")
{
$acc_name=$this->getAccName($cr_accid);
$acc_cname=$this->getAccName($db_accid);

$tbl.='<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2"><div style="color:red;margin-bottom:-25px;font-weight:bold;">'.  $acc_name  .' - NEW</div><br><div style="font-size:12px;">' . $db_accid . ' - ' . $acc_cname . ' - '. $trvalue['cheque_ref'] .'</div></td>';
    $tbl.='<td></td><td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';
    $day_btot_cr=$day_btot_cr+$trvalue['trans_amount'];

}


if($db_cr=="AD")
{
$acc_name=$this->getAccName($db_accid);
$acc_cname=$this->getAccName($cr_accid);
$tbl.='<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2"><div style="color:red;margin-bottom:-25px;font-weight:bold;">'.  $acc_name  .' - ADJ</div><br><div style="font-size:12px;">' . $cr_accid . ' - ' . $acc_cname . ' - '. $trvalue['cheque_ref'] .'</div></td>';
    $tbl.='<td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';
    $day_btot_cr=$day_btot_cr+$trvalue['trans_amount'];

}


if($db_cr=="DB")
{
$acc_name=$this->getAccName($db_accid);
$acc_cname=$this->getAccName($cr_accid);

//$tbl.='</td><td>'. $trvalue['trans_date'] .'</td>';
$tbl.='<td>'. $trvalue['trans_refid'] .'</td>';
$tbl.='<td><div style="color:red;margin-bottom:-25px;font-weight:bold;">'.  $acc_name  .'</div><br><div style="font-size:12px;">' . $cr_accid . ' - ' . $acc_cname . '</div></td>';
$tbl.='<td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';
//$day_btot_db=$day_btot_db+$trvalue['trans_amount'];

}

if($db_cr=="CR")
{
$acc_name=$this->getAccName($db_accid);
$acc_cname=$this->getAccName($cr_accid);

$tbl.='<td></td><td></td><td></td><td></td><td></td><td></td><td>'. $trvalue['trans_date'] .'</td>';
$tbl.='<td>'. $trvalue['trans_refid'] .'</td>';
$tbl.='<td><div style="color:red;margin-bottom:-25px;font-weight:bold;">'.  $acc_name  .'</div><br><div style="font-size:12px;">' . $cr_accid . ' - ' . $acc_cname . '</div></td>';
$tbl.='<td></td><td></td><td></td><td></td><td style="text-align:right;">'. $trvalue['trans_amount']  .'</td>';
$day_btot_cr=$day_btot_cr+$trvalue['trans_amount'];

}







}



} //JOUR



 $tbl.='</tr>';


 //   $data['data'][]=array("trans_date"=>$trvalue['trans_date'],"dbname"=>$dbacc_name,"crname"=>$cracc_name,"trans_amount"=>$trvalue['trans_amount'],"trans_id"=>$trvalue['trans_refid']); 

 }


}
$tbl.='<tr><td></td><td colspan="4" style="font-weight:bold;">Total</td><td style="font-weight:bold;text-align:right;">'. number_format((float)$day_ctot_db, 2, '.', '') .'</td><td style="font-weight:bold;text-align:right;">'. number_format((float)$day_btot_db, 2, '.', '') .'</td><td></td>';

$tbl.='<td></td><td colspan="4" style="font-weight:bold;">Total</td><td style="font-weight:bold;text-align:right;">'. number_format((float)$day_ctot_cr, 2, '.', '') .'</td><td style="font-weight:bold;text-align:right;">'. number_format((float)$day_btot_cr, 2, '.', '') .'</td></tr>';



//$day_grand_ctot_db=$day_grand_ctot_db+$day_ctot_db;
//$day_grand_ctot_cr=$day_grand_ctot_cr;//+$day_ctot_cr;
$day_grand_ctot_db=$day_ctot_db+$opBal;
if($day_grand_ctot_db>$day_ctot_cr)
{
//$day_grand_ctot_cr=$day_grand_ctot_db;
$day_cl_bal=$day_grand_ctot_db-$day_ctot_cr;
$day_grand_ctot_cr=$day_ctot_cr+$day_cl_bal;
}
else
{
//$day_grand_ctot_db=$day_grand_ctot_cr;
$day_cl_bal=$day_grand_ctot_cr-$day_ctot_cr;
$day_grand_ctot_db=$day_ctot_db+$day_cl_bal;

}

//$day_cl_bal=$day_ctot_db-$day_ctot_cr;
$tbl.='<tr><td></td><td colspan="4"><strong>Opening Balance</strong></td><td style="font-weight:bold;text-align:right;"><b>'. number_format((float)$opBal, 2, '.', '') .'</b></td><td></td><td></td><td></td><td colspan="4"><strong>Closing Balance</strong></td><td style="font-weight:bold;text-align:right;"><b>'. number_format((float)$day_cl_bal, 2, '.', '') .'</b></td></tr>';


$tbl.='<tr><td></td><td colspan="4" style="font-weight:bold;">Grand Total</td><td style="font-weight:bold;text-align:right;">'.  number_format((float)$day_grand_ctot_db, 2, '.', '') .'</td><td style="font-weight:bold;text-align:right;">'. number_format((float)$day_grand_btot_db, 2, '.', '') .'</td><td></td>';

$tbl.='<td></td><td colspan="4" style="font-weight:bold;">Grand Total</td><td style="font-weight:bold;text-align:right;">'. number_format((float)$day_grand_ctot_cr, 2, '.', '') .'</td><td style="font-weight:bold;text-align:right;">'. number_format((float)$day_grand_btot_cr, 2, '.', '') .'</td></tr>';



 $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
$opBal=$day_cl_bal;
$day_btot_cr=0;
$day_btot_db=0;
$day_ctot_cr=0;
$day_ctot_db=0;
$tbl.='<tr></tr>';
} //Date Loop
$day_grand_ctot_db=0;
$day_grand_ctot_cr=0;
$day_grand_btot_cr=0;
$day_grand_btot_db=0;

$tbl.='</tr></tbody></table></div></div>';
//    echo json_encode($data);
echo $tbl;

}  //fetchDaybook








public function fetchCashBankSearch()
{
    $acct_id = $this->input->get('account');
    $fdate = $this->input->get('fdate');
    $tdate = $this->input->get('tdate');
//Opening Balance of Account
$opBalData = $this->common_model->getLedger_data($acct_id);

foreach ($opBalData as $key => $ovalue) {


$finyear=$this->session->userdata('finyear');

$opData = $this->common_model->getOpBal($acct_id,$finyear);
//print_r($opData);
if($opData)
{
  foreach ($opData as $key => $opvalue) {
    $opbal=$opvalue["openingbalance"];
  }
}
else {
  $opbal=0;
}

$opBal=$opbal;
 //  $opBal = $ovalue['op_balance'];
   $acc_name=$ovalue['account_name'];
}

//$account_id="0";
// Data
$dbamt=0;
$cramt=0;
$dbTot=0;
$crTot=0;
$bal_tot=0;

$odbamt=0;
$ocramt=0;
$odbTot=0;
$ocrTot=0;
$obal_tot=0;

$data_ins=array();

$transOpData = $this->common_model->getTransOpData($acct_id,$fdate,$tdate);

//print_r($transOpData);

foreach ($transOpData as $key => $opvalue) {
  # code...
$trans_type = $opvalue['trans_type'];

if(trim($trans_type)=="RCPT" && $opvalue["account_id"]==$acct_id)
{
  $odbamt = $opvalue["trans_amount"];
  //print_r($dbamt ."db");
  
}

if(trim($trans_type)=="RCPT" && $opvalue["cr_account_id"]==$acct_id)
{
  $ocramt = $opvalue["trans_amount"];
  
}

if(trim($trans_type)=="PYMT" && $opvalue["account_id"]==$acct_id)
{
  $ocramt = $opvalue["trans_amount"];
  
}

if(trim($trans_type)=="PYMT" && $opvalue["cr_account_id"]==$acct_id)
{
  $odbamt = $opvalue["trans_amount"];
  
}

if(trim($trans_type)=="JOUR" && $opvalue["account_id"]==$acct_id)
{
  $odbamt = $opvalue["trans_amount"];
  
}

if(trim($trans_type)=="JOUR" && $opvalue["cr_account_id"]==$acct_id)
{
  $ocramt = $opvalue["trans_amount"];
  
}


if(trim($trans_type)=="CNTR" && $opvalue["cr_account_id"]==$acct_id)
{
  $odbamt = $opvalue["trans_amount"];
  
}

if(trim($trans_type)=="CNTR" && $opvalue["account_id"]==$acct_id)
{
  $ocramt = $opvalue["trans_amount"];
  
}


        $odbTot =$odbTot + $odbamt;
        $ocrTot =$ocrTot + $ocramt;

//print_r("db" .$odbTot);
//print_r("cr" .$ocrTot);
$odbamt=0;
$ocramt=0;

}

      $obal_tot =  $obal_tot+ $odbTot-$ocrTot;
$opBal = $opBal + $obal_tot;
//$opBal=0;
//print_r($bal_tot . "=" . $odbTot . "=" . $ocrTot);
$odbTot=0;
$ocrTot=0;

$transData = $this->common_model->getTransData($acct_id,$fdate,$tdate);
$trans_ref="";
//print_r($transData);

$bal_tot = $bal_tot+$opBal;
foreach ($transData as $key => $tvalue) {

$trans_date = $tvalue['trans_date'];

$trans_ref = "Ref# :" . $tvalue['trans_refid'] . ' / Cheq# : ' . $tvalue['cheque_ref'] . '/' . $tvalue['cheque_bank'];
$trans_id = $tvalue['trans_id'];
$trans_type = $tvalue['trans_type'];
$narration = $tvalue['trans_narration'];

if(trim($trans_type)=="RCPT" && $tvalue["account_id"]==$acct_id)
{
  $dbamt = $tvalue["trans_amount"];
  //print_r($dbamt ."db");
  $account_id= $tvalue["cr_account_id"];
}



if(trim($trans_type)=="RCPT" && $tvalue["cr_account_id"]==$acct_id)
{
  $cramt = $tvalue["trans_amount"];
  $account_id= $tvalue["account_id"];
}

if(trim($trans_type)=="PYMT" && $tvalue["account_id"]==$acct_id)
{
  $cramt = $tvalue["trans_amount"];
  $account_id= $tvalue["cr_account_id"];
}

if(trim($trans_type)=="PYMT" && $tvalue["cr_account_id"]==$acct_id)
{
  $dbamt = $tvalue["trans_amount"];
  $account_id= $tvalue["account_id"];
}



if(trim($trans_type)=="JOUR" && $tvalue["account_id"]==$acct_id)
{
  $dbamt = $tvalue["trans_amount"];
  $account_id= $tvalue["cr_account_id"];
}

if(trim($trans_type)=="JOUR" && $tvalue["cr_account_id"]==$acct_id)
{
  $cramt = $tvalue["trans_amount"];
  $account_id= $tvalue["account_id"];
}


if(trim($trans_type)=="CNTR" && $tvalue["cr_account_id"]==$acct_id)
{
  $dbamt = $tvalue["trans_amount"];
  $account_id= $tvalue["account_id"];
}

if(trim($trans_type)=="CNTR" && $tvalue["account_id"]==$acct_id)
{
  $cramt = $tvalue["trans_amount"];
  $account_id= $tvalue["cr_account_id"];
}


$accountNData = $this->common_model->getLedger_data($account_id);
//print_r($accountNData);
foreach ($accountNData as $key => $avalue) {
  $account_name = $avalue['account_name'];
}



        $dbTot =$dbTot + $dbamt;
        $crTot =$crTot + $cramt;

          $bal_tot = $bal_tot + $dbamt-$cramt;
//print_r($bal_tot);


if($bal_tot<0)
{
  $bal_amt = number_format((float)abs($bal_tot), 2, '.', ',') . "Db";
}
else if($bal_tot>0) {
  $bal_amt =  number_format((float)$bal_tot, 2, '.', ',') . "Cr";
}
else 
{
 $bal_amt =  number_format((float)$bal_tot, 2, '.', ','); 
}


          if($dbamt<>0 || $cramt<>0)
          {

$data_ins[] = array("trans_type"=>$trans_type,"account_name"=>$account_name, "trans_date"=>$trans_date,"trans_id"=>$trans_id,"trans_ref"=>$trans_ref,"debit"=>$dbamt,"credit"=>$cramt,"narration"=>$narration, "bal"=>$bal_amt);


}

      $dbamt=0;
      $cramt=0;
}



//print_r($bal_tot);
$result[] = array(
   // 'id'=>$value['id'],
    'accname'=> $acc_name,
    'openingbalance' => number_format((float)$opBal, 2, '.', ','),
    'ledgerdetails'=> $data_ins,
    'dbTot' => number_format((float)$dbTot, 2, '.', ','),
    'crTot' => number_format((float)$crTot, 2, '.', ','),
    'closingbal' => number_format((float)$bal_tot, 2, '.', ',')
);


//print_r($result);

echo json_encode($result);
}



public function fetchglledgerbalanceJson()
    {

        $data= array();
    //    $acct_id = $this->uri->segment(5);
            $acct_id = $this->input->get('selacc');
            $div_id = $this->input->get('divid');
//$acct_id = $this->input->post('ldgrSelect');


        
        
//$data = $this->common_model->getLedger_data($acct_id);  
$data = $this->common_model->getAllLedger();  
  // print_r($data);     
        $result =array();
        foreach($data as $key => $value) 
        { 

    $cramt = 0;
    $dbamt = 0;
    $db_tot=0;
    $cr_tot=0;
    $bal_tot=0;
    $itmnam = "";
$acc_name="";

$acctid=$value['acclink_id'];
$finyear=$this->session->userdata('finyear');

$opData = $this->common_model->getOpBal($acctid,$finyear);
//print_r($opData);
if($opData)
{
  foreach ($opData as $key => $opvalue) {
    $opbal=$opvalue["openingbalance"];
    $db_tot=0;
    $cr_tot=0;
    $db_op =0;
    $cr_op=0;
    $bal_op=0;

  }
}
else {
  $opbal=0;
}

$os_balresult = $opbal; 

/*

$openBal = $this->common_model->fetchledgerOp($value['acclink_id']);
//print_r($openBal);
if($openBal)
{
 $os_balresult=0;
 
        foreach($openBal as $key => $opvalue) { 
    $db_tot=0;
    $cr_tot=0;
    $db_op =0;
    $cr_op=0;
    $bal_op=0;

      $os_balresult = $opvalue['op_balance']; 
  
}
}
*/
            //$fmdate = $this->input->get('fdate');
            //$todate = $this->input->get('tdate');
    $fmdate=date("Y-m-d", strtotime($this->input->get('fdate')));
    $todate=date("Y-m-d", strtotime($this->input->get('tdate')));


//print_r($value['acclink_id']);

 $subData = $this->common_model->fetchGLedgerCB($value['acclink_id'],$fmdate,$todate);
//print_r($subData);
if($acct_id=="0") {
    $a_id=$value['acclink_id'];
}
else {
    $a_id=$acct_id;
}


$ldg_op = $this->common_model->ledg_op($a_id,$fmdate);

if($ldg_op)
{
   $bal_op=0;
  foreach ($ldg_op as $key => $lop_value) {
    # code...
    $db_op = $lop_value['op_debit'];
    $cr_op = $lop_value['op_credit'];
  $bal_op = $db_op-$cr_op;
  }
    
    $os_balresult=$os_balresult+$bal_op;

}



$bal_tot=0;
$crTot=0;
$dbTot=0;
  $bal_tot = $os_balresult;
foreach($subData as $key => $svalue) { 



if($svalue['trans_type']=="JOUR" && $svalue['account_id']==$a_id)
{
          $account_id= $svalue['cr_account_id'];

          $dbamt = $svalue['trans_amount'];
          $cramt=0;
}  
 if($svalue['trans_type']=="JOUR" && $svalue['cr_account_id']==$a_id) 
{
          $account_id= $svalue['account_id'];

          $cramt = $svalue['trans_amount'];
          $dbamt=0;
}
  

if($svalue['trans_type']=="RCPT" && $svalue['cr_account_id']==$a_id  && is_numeric($svalue['trans_amount'])) {

          $dbamt = $svalue['trans_amount'];
          $account_id= $svalue['account_id'];
          //$dbamt=0;
        }

if($svalue['trans_type']=="RCPT" && $svalue['account_id']==$a_id  && is_numeric($svalue['trans_amount'])) {

          $cramt = $svalue['trans_amount'];
          $account_id= $svalue['cr_account_id'];
          //$dbamt=0;
        }

if($svalue['trans_type']=="PYMT" && $svalue['account_id']==$a_id  && is_numeric($svalue['trans_amount'])) {

          //$dbamt=0;

          $dbamt = $svalue['trans_amount'];
          $account_id= $svalue['cr_account_id'];


        }


 if($svalue['trans_type']=="PYMT" && $svalue['cr_account_id']==$a_id  && is_numeric($svalue['trans_amount']))
  {
          //$dbamt=0;
          $cramt = $svalue['trans_amount'];
          $account_id= $svalue['account_id'];


  }

 if($svalue['trans_type']=="CNTR" && $svalue['cr_account_id']==$a_id  && is_numeric($svalue['trans_amount']))
  {
          //$dbamt=0;
          $cramt = $svalue['trans_amount'];
          $account_id= $svalue['account_id'];


  }
/*
        $accnameData = $this->common_model->get_accountid_bymemberid($account_id);
        if($accnameData)
        {
        foreach ($accnameData as $key => $dvalue) {
            $acc_name = $dvalue['account_name'];
            $prn_pos = $dvalue['print_pos'];
          }
        }
        else
        {
          $prn_pos="0";
        }

        if($svalue['trans_type']=="PURC" && is_numeric($svalue['trans_amount'])) {

          $dbamt = $svalue['trans_amount'];
          //$dbamt=0;


        }
        */
        $dbTot =$dbTot + $dbamt;
        $crTot =$crTot + $cramt;

          $bal_tot = $bal_tot + $dbamt-$cramt;

if($bal_tot<0)
{
  $bal_amt = number_format((float)abs($bal_tot), 2, '.', ',') . " Cr";
}
else if($bal_tot>0) {
  $bal_amt =  number_format((float)$bal_tot, 2, '.', ',') . " Db";
}
else 
{
 $bal_amt =  number_format((float)$bal_tot, 2, '.', ',') . " " ; 
}


          if($dbamt<>0 || $cramt<>0)
          {
      $sresult[] = array(
            
            "trans_id" => $svalue['trans_id'],
            "trans_type" =>$svalue['trans_type'],
            "trans_date" => $svalue['trans_date'],
            "cr_account_id" => $svalue['cr_account_id'],
            "account_id" => $svalue['account_id'],
            "print_pos" => $prn_pos,
            "acc_name" => $acc_name,
            "cheque_ref" =>$svalue["cheque_ref"],
            "debit"=> $dbamt,
            "credit"=> $cramt,
            "bal" => $bal_amt
        ); 
}
      $dbamt=0;
      $cramt=0;
 
}
  

$result[] = array(
   // 'id'=>$value['id'],
    'accname'=> $acc_name,
    'opbalance' => number_format((float)$os_balresult, 2, '.', ','),
   // 'ledgerdetails'=> $sresult,
    'dbTot' => number_format((float)$dbTot, 2, '.', ','),
    'crTot' => number_format((float)$crTot, 2, '.', ','),
    'closingbal' => number_format((float)$bal_tot, 2, '.', ',')
);


$bal_tot=0;
  $sresult='';
       $os_balresult='';
}
  $sresult='';

        echo json_encode($result);
}



public function fetchglledgerJson()
    {
$finyear=$this->session->userdata('finyear');

        $data= array();
        $sresult=array();
    //    $acct_id = $this->uri->segment(5);
            $acct_id = $this->input->get('selacc');
            $div_id = $this->input->get('divid');
 //$acct_id = $this->input->post('ldgrSelect');
        
        
        $data = $this->common_model->getLedger_data($acct_id);  
  // print_r($data);     
        $result =array();
        foreach($data as $key => $value) { 

    $cramt = 0;
    $dbamt = 0;
    $db_tot=0;
    $cr_tot=0;
    $bal_tot=0;
    $itmnam = "";
$acc_name="";
$acctid=$value["acclink_id"];



$opData = $this->common_model->getOpBal($acctid,$finyear);
//print_r($opData);
if($opData)
{
  foreach ($opData as $key => $opvalue) {
    $opbal=$opvalue["openingbalance"];
    $db_tot=0;
    $cr_tot=0;
    $db_op =0;
    $cr_op=0;
    $bal_op=0;

  }
}
else {
  $opbal=0;
}

$os_balresult = $opbal; 

            $fmdate = $this->input->get('fdate');
            $todate = $this->input->get('tdate');




 $subData = $this->common_model->fetchGLedger($value['acclink_id'],$fmdate,$todate,$acct_id,$div_id,$finyear);
//print_r($subData);
if($acct_id=="0") {
    $a_id=$value['acclink_id'];
}
else {
    $a_id=$acct_id;
}


$ldg_op = $this->common_model->ledg_op($a_id,$fmdate,$finyear);
//print_r($ldg_op);
if($ldg_op)
{
   $bal_op=0;
  foreach ($ldg_op as $key => $lop_value) {
    # code...
    $db_op = $lop_value['op_debit'];
    $cr_op = $lop_value['op_credit'];
  $bal_op = $db_op-$cr_op;
  }
    
    $os_balresult=$os_balresult+$bal_op;

}



$bal_tot=0;
$crTot=0;
$dbTot=0;
  $bal_tot = $os_balresult;
        foreach($subData as $key => $svalue) { 



if($svalue['trans_type']=="JOUR" && $svalue['account_id']==$a_id)
{
          $account_id= $svalue['cr_account_id'];

          $dbamt = $svalue['trans_amount'];
          $cramt=0;
}  
 if($svalue['trans_type']=="JOUR" && $svalue['cr_account_id']==$a_id) 
{
          $account_id= $svalue['account_id'];

          $cramt = $svalue['trans_amount'];
          $dbamt=0;
}
  

        if($svalue['trans_type']=="RCPT" && $svalue['cr_account_id']==$a_id  && is_numeric($svalue['trans_amount'])) {

          $dbamt = $svalue['trans_amount'];
          $account_id= $svalue['account_id'];
          //$dbamt=0;


        }

      if($svalue['trans_type']=="RCPT" && $svalue['account_id']==$a_id  && is_numeric($svalue['trans_amount'])) {

          $cramt = $svalue['trans_amount'];
          $account_id= $svalue['cr_account_id'];
          //$dbamt=0;


        }


      if($svalue['trans_type']=="PYMT" && $svalue['account_id']==$a_id  && is_numeric($svalue['trans_amount'])) {

          //$dbamt=0;

          $dbamt = $svalue['trans_amount'];
          $account_id= $svalue['cr_account_id'];


        }


        if($svalue['trans_type']=="PYMT" && $svalue['cr_account_id']==$a_id  && is_numeric($svalue['trans_amount'])) {
          //$dbamt=0;
          $cramt = $svalue['trans_amount'];
          $account_id= $svalue['account_id'];


        }


        $accnameData = $this->common_model->get_accountid_bymemberid($account_id);
        if($accnameData)
        {
        foreach ($accnameData as $key => $dvalue) {
            $acc_name = $dvalue['account_name'];
            $prn_pos = $dvalue['print_pos'];
          }
        }
        else
        {
          $prn_pos="0";
        }

        if($svalue['trans_type']=="PURC" && is_numeric($svalue['trans_amount'])) {

          $dbamt = $svalue['trans_amount'];
          //$dbamt=0;


        }
        $dbTot =$dbTot + $dbamt;
        $crTot =$crTot + $cramt;

          $bal_tot = $bal_tot + $dbamt-$cramt;

if($bal_tot<0)
{
  $bal_amt = number_format((float)abs($bal_tot), 2, '.', ',') . " Cr";
}
else if($bal_tot>0) {
  $bal_amt =  number_format((float)$bal_tot, 2, '.', ',') . " Db";
}
else 
{
 $bal_amt =  number_format((float)$bal_tot, 2, '.', ',') . " " ; 
}


          if($dbamt<>0 || $cramt<>0)
          {
      $sresult[] = array(
            "trans_id" => $svalue['trans_id'],
            "trans_type" =>$svalue['trans_type'],
            "trans_date" => $svalue['trans_date'],
            "cr_account_id" => $svalue['cr_account_id'],
            "account_id" => $svalue['account_id'],
            "print_pos" => $prn_pos,
            "acc_name" => $acc_name,
            "cheque_ref" =>$svalue["cheque_ref"],
            "debit"=> $dbamt,
            "credit"=> $cramt,
            "bal" => $bal_amt
        ); 
}
      $dbamt=0;
      $cramt=0;
 
}
  

$result[] = array(
   // 'id'=>$value['id'],
    'accname'=> $acc_name,
    'openingbalance' => number_format((float)$os_balresult, 2, '.', ','),
    'ledgerdetails'=> $sresult,
    'dbTot' => number_format((float)$dbTot, 2, '.', ','),
    'crTot' => number_format((float)$crTot, 2, '.', ','),
    'closingbal' => number_format((float)$bal_tot, 2, '.', ',')
);


$bal_tot=0;
  $sresult=array();
       $os_balresult='';
}
  $sresult=array();

        echo json_encode($result);
}



function fetchItemData()
{
    $tbl="";

    $mem_id = $this->input->get('memberid');
    $acc_id = $this->input->get('accountid');
    $fdate = $this->input->get('fmDate');
    $tdate = $this->input->get('toDate');

    $itemdata = $this->common_model->fetchRecoveryData($fdate,$tdate,$acc_id,$mem_id);

    $tbl .= '<table  border="1"><tbody>';

   // print_r($itemdata);
    for ($i=0; $i <count($itemdata) ; $i++) { 
        # code...
 
        $tbl .= '<tr><td>THRIFT</td><td style="text-align:right;">' . $itemdata[$i]["trans_date"] . '</td><td style="text-align:right;">' . $itemdata[$i]["trans_amount"] . '</td><tr>';
            
$tbl .='<tr><td></td></tr>';

        }
       
        $tbl .= '</tbody></table>';
       echo  $tbl;
       // echo json_encode($tbl);
 }

public function pdfrep()
{
  //print_r(APPPATH);
 // print_r(base_url());
 // $this->load->library('Fpdf_gen');

$this->fpdf->SetFont('Arial','B',30);

  $this->fpdf->cell(40,10,'My PDF');
  echo $this->fpdf->output('pdfOutput.pdf','D');
}


public function fetchCrLedgerPrint()
{
  //Get Dates 
 $acct_id = $this->input->get('selacc');
$event_data="";
  $fmdate = $this->input->get('fdate');
  $todate = $this->input->get('tdate');

     $prin_col_tot = 0;
     $trfrct_col_tot = 0;
     $trfpay_col_tot = 0;
     $shrrct_col_tot= 0;
     $shrpay_col_tot= 0;
     $interestrct_col_tot = 0;
     $insurancerct_col_tot= 0;
     $loanpaid_col_tot= 0;
     $cl_bal = 0;

$openBal = $this->common_model->getMembers_dataById($acct_id);
        foreach($openBal as $key => $opvalue) { 
    $db_tot=0;
    $cr_tot=0;
      $memberid = $opvalue['member_id'];
      $membername=$opvalue['member_name'];
      $suretyid = $opvalue['surety_id'];
//      $suretyname = $opvalue['surety_name'];
     /* $share_opbal = $opvalue['share_capital'];
      $thrift_opbal = $opvalue['thrift_opbal'];
      $os_balresult = $opvalue['loan_opbal'];
      */ 
      $roi= $opvalue['rate_of_interest'];
      $lnacctno=$opvalue['ln_account_no'];
      $ldgr_folio_no=$opvalue['ldgr_folio_no'];
      $monthlyrepay=$opvalue['principle_amount'];
      $noi=$opvalue['no_installment'];
//      $date_of_lastloan=$opvalue['date_last_loan'];
      if($opvalue["date_last_loan"]!=NULL)
      {
      $date_of_lastloan= date("d-m-Y",strtotime($opvalue['date_last_loan']));
    }
    else
    {
     $date_of_lastloan=""; 
    }


}


$opbal_Data = $this->common_model->getOpBal($acct_id,$finyear);

if($opbal_Data)
{
  foreach ($opbal_Data as $key => $op_value) {
      $share_opbal = $op_value['share_capital'];
      $thrift_opbal = $op_value['thrift_opbal'];
      $os_balresult = $op_value['loan_opbal']; 
  }
}
else {
$share_opbal=0;
$thrift_opbal=0;
$os_balresult=0;
}


//Surety Data
$suretyData= $this->common_model->getMembers_dataById($suretyid);
if($suretyData)
{
  foreach ($suretyData as $key => $svalue) {
    # code...
    $suretyname=$svalue["member_name"];
  }
}

 
ECHO '<link rel="stylesheet" type="text/css" href="'. base_url() . 'optimum/css/bootstrap.min.css">';

ECHO '<link rel="stylesheet" type="text/css" href="'. base_url() . 'optimum/css/crledger.css">';
/*
<style type="text/css">
    .pagebreak { page-break-before: always;} 
    .bdr {border: none;}
.breakAfter {
    page-break-after: always
}
</style>';
*/


$event_data .= '<div id="printable"><div class="text-center" id="tophead">'. $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description .'</div> <div class="card text-center"><div class="card-header" id="crldgrep"> <h4>CREDIT LEDGER</h4>   </div>  <div class="card-body"> <div class="row"> <div class="col-md-2" style="text-align:left"><label>Member Name</label></div><div class="col-md-2" style="text-align:left"> <b>' . $membername . '</b> </div> <div class="col-md-2" style="text-align:left"><label>Surety Member Name</label> </div><div class="col-md-2" style="text-align:left"> '. $suretyname .'</div><div class="col-md-2" style="text-align:left"><label>Share Capital</label></div><div class="col-md-2" style="text-align:left">'. $share_opbal .'</div></div><div class="row"><div class="col-md-2" style="text-align:left"><label>Member Number</label></div><div class="col-md-2" style="text-align:left"> '. $memberid .'</div><div class="col-md-2" style="text-align:left"><label>Surety Member Number</label></div><div class="col-md-2" style="text-align:left"> '. $suretyid .'</div><div class="col-md-2" style="text-align:left"><label>Loan Account Number </label></div><div class="col-md-2" style="text-align:left"> '. $lnacctno .'</div><div class="col-md-2" style="text-align:left"><label>Installment Details </label></div><div class="col-md-2" style="text-align:left"> '. $noi .'</div><div class="col-md-2" style="text-align:left"><label>Monthly Repayment</label></div><div class="col-md-2" style="text-align:left"> '. $monthlyrepay .'</div><div class="col-md-2" style="text-align:left"><label>Date of Latest Loan</label></div><div class="col-md-2" style="text-align:left"> '. date("d-m-Y", strtotime($date_of_lastloan)) .'</div><div class="col-md-2" style="text-align:left"><label>Ledger Folio #</label> </div> <div class="col-md-2" style="text-align:left"> '. $ldgr_folio_no .'</div> <div class="col-md-2" style="text-align:left"><label>Rate of Interest (%)</label> </div> <div class="col-md-2" style="text-align:left"> '. $roi .'</div></div></div></div>';


$event_data .= '<div class="card text-center"><div class="card-header"> <h4>LEDGER DETAILS ('. date("m-Y",strtotime($fmdate)).' - ' . date("m-Y",strtotime($todate)) . ')</h4>    </div>  <div class="card-body"><table class="table" border="1" id="crldgrep"><tr><th colspan="2"></th><th colspan="3" style="text-align:center">Thrift Savings</th><th colspan="3" style="text-align:center">Shares</th><th colspan="2" style="text-align:center">Repayment</th><th style="text-align:center">Insurance</th><th colspan="2" style="text-align:center">Loan</th></tr><tr><th style="text-align:center" colspan="2">Date</th><th style="text-align:center">Receipt</th><th style="text-align:center">Payment</th><th style="text-align:center">Total</th><th style="text-align:center">Receipt</th><th style="text-align:center">Payment</th><th style="text-align:center">Total</th><th style="text-align:center">Principle</th><th style="text-align:center">Interest</th><th></th><th style="text-align:center">Loan Issued</th><th style="text-align:center">Loan Balance</th></tr><tbody>  <tr><td colspan="4"><b>OPENING BALANCE</b></td><td style="text-align:right"><b>'. $thrift_opbal .'</b></td><td></td><td></td><td  style="text-align:right"><b>'. $share_opbal .'</b></td><td></td><td></td><td></td><td></td><td style="text-align:right"><b>'. $os_balresult .'</b></td></tr>';



$max_qry="";
 $crldg_data = $this->common_model->getcrLedger_data();  
 if($crldg_data)
 {
   foreach ($crldg_data as $key => $crlvalue) {
     # code...
  $cractid=$crlvalue['id'];
  $fld_head=strtolower($crlvalue['import_account']);

     # code...
$max_qry .=  ",MAX(CASE WHEN account_id='". $acct_id ."' and cr_account_id='". $cractid ."'  THEN trans_amount ELSE 0 END)`". $fld_head ."_d`,MAX(CASE WHEN cr_account_id='". $acct_id ."' and account_id='". $cractid ."' THEN trans_amount ELSE 0 END)`". $fld_head ."_c`";

//$crdata = $this->common_model->getcrData($acct_id,$cractid,$dt,$fld_head,$fmdate,$todate);
//var_dump($crdata);

}


}

  $bal_tot = $os_balresult;
 
$final_data= $this->common_model->getcrData($max_qry,$fmdate,$todate,$acct_id);

              $trf_bal = $thrift_opbal;
              $shr_bal = $share_opbal;
              $loan_bal = $os_balresult;


if($final_data)
{

foreach ($final_data as $key => $svalue) {
  # code...
  //$data['data'][]=$value;
  if($svalue['thrift_c']!=0 || $svalue['thrift_d']!=0 || $svalue['share_d']!=0 || $svalue['share_c']!=0 || $svalue['principle_c']!=0 || $svalue['principle_d']!=0 || $svalue['interest_c']!=0 || $svalue['insurance_c']!=0)
{


              $trf_rct = $svalue['thrift_c'];
              $trf_pay = $svalue['thrift_d'];
              $trf_bal=$trf_bal+$trf_rct-$trf_pay;

              $shr_rct = $svalue['share_c'];
              $shr_pay = $svalue['share_d'];

              $shr_bal=$shr_bal+$shr_rct-$shr_pay;

              $principle_rct = $svalue['principle_c'];
              $loan_paid = $svalue['principle_d'];
              $loan_bal=$loan_bal+$loan_paid-$principle_rct;
              $interest_rct = $svalue['interest_c'];
              $insurance_rct = $svalue['insurance_c'];


         $event_data .= '<td colspan="2">'. $date_of_lastloan .'</td>';
          
          if($trf_rct!=0)
          {
          $event_data .= '<td style="text-align:right;width:100%;">'. number_format($trf_rct,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }
          if($trf_pay!=0)
          {
          $event_data .= '<td style="text-align:right;width:100%;">'.number_format($trf_pay,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }

          $event_data .= '<td style="text-align:right;width:100%;">'. number_format($trf_bal,2) .'</td>';
          if($shr_rct!=0)
          {
          $event_data .= '<td style="text-align:right;width:100%;">'. number_format($shr_rct,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }
          if($shr_pay!=0)
          {
          $event_data .= '<td style="text-align:right;width:100%;">'.number_format($shr_pay,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }

          $event_data .= '<td style="text-align:right;width:100%;">'. number_format($shr_bal,2) .'</td>';

          if($principle_rct!=0)
          {
          $event_data .= '<td style="text-align:right;width:100%;">'. number_format($principle_rct,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }
          if($interest_rct!=0)
          {
          $event_data .= '<td style="text-align:right;width:100%;">'. number_format($interest_rct,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }
          if($insurance_rct!=0)
          {
          $event_data .= '<td style="text-align:right;width:100%;">'. number_format($insurance_rct,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }
          if($loan_paid!=0)
          {

          $event_data .= '<td style="text-align:right;width:100%;">'. number_format($loan_paid,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }

          $event_data .= '<td style="text-align:right;width:100%;">'. number_format($loan_bal,2) .'</td>';

     $prin_col_tot = $prin_col_tot+ $principle_rct;
     $trfrct_col_tot = $trfrct_col_tot+$trf_rct;
     $trfpay_col_tot = $trfpay_col_tot+$trf_pay;
     $shrrct_col_tot= $shrrct_col_tot+$shr_rct;
     $shrpay_col_tot= $shrpay_col_tot+$shr_pay;
     $interestrct_col_tot = $interestrct_col_tot+$interest_rct;
     $insurancerct_col_tot= $insurancerct_col_tot+$insurance_rct;
     $loanpaid_col_tot= $loanpaid_col_tot+$loan_paid;
     $cl_bal = $loan_bal+$loanpaid_col_tot-$prin_col_tot;

$event_data .= '</tr>';



$sresult[] = array("trans_date"=>$svalue["trans_date"],"thrift_paid"=>$svalue["thrift_d"],"thrift_receipt"=>$svalue["thrift_c"],"share_paid"=>$svalue["share_d"],"share_receipt"=>$svalue["share_c"],"loan_paid"=>$svalue["principle_d"],"principle_receipt"=>$svalue["principle_c"],"interest_receipt"=>$svalue["interest_c"],"insurance_receipt"=>$svalue["insurance_c"]);
}
//$bal_tot =$bal_tot - $svalue["trans_amount"];
}

    
}

$event_data .= '<tr><td style="font-weight:bold;" colspan="2">TOTAL</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'. number_format((float)$trfrct_col_tot, 2) .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$trfpay_col_tot, 2) .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$trf_bal, 2) .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$shrrct_col_tot, 2) .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$shrpay_col_tot, 2) .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$shr_bal, 2)  .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$prin_col_tot, 2)  .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$interestrct_col_tot, 2) .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$insurancerct_col_tot, 2)  .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'. number_format((float)$loanpaid_col_tot, 2)  .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'. number_format((float)$loan_bal, 2) .'</td>';

$event_data .= '</tr>';

/*
$result[] = array(
    'id'=>$memberid,
    'accname'=> $membername,
    'memberid'=>$memberid,
    'membername' => $membername,
    'suretyid' => $suretyid,
    'suretyname' => $suretyname,
    'msharecap'=> $share_opbal,
    'loan_openingbalance' => $os_balresult,
    'thrift_openingbalance' =>$thrift_opbal,
    'share_openingbalance' => $share_opbal,
    'ledgerdetails'=> $sresult,
    'closingbal' =>$bal_tot
);
*/



echo $event_data;
  
   


}



//Pdf Credit Ledger
public function fetchCrLedgerPdf()
{
  //Get Dates 
 $acct_id = $this->input->post('ldgrSelect');
$event_data="";
  $fmdate = $this->input->post('fmDate');
  $todate = $this->input->post('toDate');

     $prin_col_tot = 0;
     $trfrct_col_tot = 0;
     $trfpay_col_tot = 0;
     $shrrct_col_tot= 0;
     $shrpay_col_tot= 0;
     $interestrct_col_tot = 0;
     $insurancerct_col_tot= 0;
     $loanpaid_col_tot= 0;
     $cl_bal = 0;
$suretyname="";
$date_of_lastloan="";
$openBal = $this->common_model->getMembers_dataById($acct_id);
        foreach($openBal as $key => $opvalue) { 
    $db_tot=0;
    $cr_tot=0;
      $memberid = $opvalue['member_id'];
      $membername=$opvalue['member_name'];
      $suretyid = $opvalue['surety_id'];
      //$suretyname = $opvalue['surety_name'];
  /*    $share_opbal = $opvalue['share_capital'];
      $thrift_opbal = $opvalue['thrift_opbal'];
      $os_balresult = $opvalue['loan_opbal']; */
      $roi= $opvalue['rate_of_interest'];
      $lnacctno=$opvalue['ln_account_no'];
      $ldgr_folio_no=$opvalue['ldgr_folio_no'];
      $monthlyrepay=$opvalue['principle_amount'];
      $noi=$opvalue['no_installment'];
      /*if($opvalue["date_last_loan"]!=NULL)
      {
      $date_of_lastloan= date("d-m-Y",strtotime($opvalue['date_last_loan']));
    }
    else
    {
     $date_of_lastloan=""; 
    }*/
}


$opbal_Data = $this->common_model->getOpBal($acct_id,$finyear);

if($opbal_Data)
{
  foreach ($opbal_Data as $key => $op_value) {
      $share_opbal = $op_value['share_capital'];
      $thrift_opbal = $op_value['thrift_opbal'];
      $os_balresult = $op_value['loan_opbal']; 
  }
}
else {
$share_opbal=0;
$thrift_opbal=0;
$os_balresult=0;
}


$lastloandate = $this->common_model->get_LastLoanDate($memberid);
if($lastloandate)
{
  foreach ($lastloandate as $key => $lnvalue) {

    $date_of_lastloan= date("d-m-Y",strtotime($lnvalue['trans_date']));
    //$date_of_lastloan=$lnvalue['trans_date'];
  }
}
else
{
  $date_of_lastloan="";
}

if($date_of_lastloan=="NULL")
{
  $date_of_lastloan="";
}

//Surety Data
$suretyData= $this->common_model->getMembers_dataById($suretyid);
if($suretyData)
{
  foreach ($suretyData as $key => $svalue) {
    # code...
    $suretyname=$svalue["member_name"];
  }
}

if($suretyid==0)
{
  $suretyid="";
}

/*
<style type="text/css">
    .pagebreak { page-break-before: always;} 
    .bdr {border: none;}
.breakAfter {
    page-break-after: always
}
</style>';
*/
/*
ECHO  '<link rel="stylesheet" type="text/css" href="' .  base_url() . 'optimum/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="'. base_url() . 'optimum/css/crledger.css">';
#printable { position: absolute; top: 40px; left: 30px; 
*/
if($date_of_lastloan=="01-01-1970")
{
  $date_of_lastloan="";
}


$event_data .='<style>

table th { border: 1px solid black; padding: 2px;

font-size: 10px;
font-weight: bold;

}

table td { border: 1px solid black;  
font-size: 10px;

border-collapse: collapse;
}

#crldgrep td, #crldgrep th {
  border: 1px solid #ddd;
  border-collapse: collapse;
}
.center {
  margin-left: auto;
  margin-right: auto;
}
#crldgrep {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  
  overflow-x: auto;
}

#crmain {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  
  overflow-x: auto;
}
#crldgrep td, #crldgrep th {
  border: 1px solid black;
  
}

</style>';

$event_data .= '<div id="printable"><div class="text-center" id="tophead"><center><h3>'. $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description .'<h3></div><center><h4 style="margin-top:-10px;">CREDIT LEDGER</h4></center>
<table id="crmain" class="center" style="font-size:12px;" height="100%" width="80%">
  <tr>
  <th>Member#</th><th>Member Name</th> <th>Surety Member#</th><th>Surety Member Name</th><th>Loan Account #</th>

  </tr>
  <tr>
    <td style="text-align:center">'. $memberid .'</td>
    <td style="text-align:center">'. $membername .'</td>
    <td style="text-align:center">'. $suretyid .'</td>
    <td style="text-align:center">'. $suretyname .'</td>
    <td style="text-align:center">'. $lnacctno .' </td>
  
  </tr>
  <tr>
  <th>Share Capital</th><th>Ledger Folio #</th><th>Monthly Repayment</th><th>Rate of Interest</th><th>Loan Issued on</th>
  </tr>
  <tr>
    <td style="text-align:center">'. $share_opbal .'</td>
    <td style="text-align:center">'. $ldgr_folio_no .'</td>
    <td style="text-align:center">'. $monthlyrepay .'</td>
    <td style="text-align:center">'. $roi .'</td>
    <td style="text-align:center">'. $date_of_lastloan .'</td>
  </tr>

</table></div>';


$event_data .= '<div class="card text-center"><div class="card-header"> <center><h4>LEDGER DETAILS ('. date("m-Y",strtotime($fmdate)).' - ' . date("m-Y",strtotime($todate)) . ')</h4></center>    </div>  <div class="card-body"><center><table id="crldgrep" class="center" width="100%"><tr><th colspan="2"></th><th colspan="3" style="text-align:center">Thrift Savings</th><th colspan="3" style="text-align:center">Shares</th><th colspan="2" style="text-align:center">Repayment</th><th style="text-align:center">Insurance</th><th colspan="2" style="text-align:center">Loan</th></tr><tr><th style="text-align:center" colspan="2">Date</th><th style="text-align:center">Receipt</th><th style="text-align:center">Payment</th><th style="text-align:center">Total</th><th style="text-align:center">Receipt</th><th style="text-align:center">Payment</th><th style="text-align:center">Total</th><th style="text-align:center">Principle</th><th style="text-align:center">Interest</th><th></th><th style="text-align:center">Loan Issued</th><th style="text-align:center">Loan Balance</th></tr><tbody>  <tr><td colspan="4"><b>OPENING BALANCE</b></td><td style="text-align:right"><b>'. $thrift_opbal .'</b></td><td></td><td></td><td  style="text-align:right"><b>'. $share_opbal .'</b></td><td></td><td></td><td></td><td></td><td style="text-align:right"><b>'. $os_balresult .'</b></td></tr>';



$max_qry="";
 $crldg_data = $this->common_model->getcrLedger_data();  
 if($crldg_data)
 {
   foreach ($crldg_data as $key => $crlvalue) {
     # code...
  $cractid=$crlvalue['id'];
  $fld_head=strtolower($crlvalue['import_account']);

     # code...
$max_qry .=  ",MAX(CASE WHEN account_id='". $acct_id ."' and cr_account_id='". $cractid ."'  THEN trans_amount ELSE 0 END)`". $fld_head ."_d`,MAX(CASE WHEN cr_account_id='". $acct_id ."' and account_id='". $cractid ."' THEN trans_amount ELSE 0 END)`". $fld_head ."_c`";

//$crdata = $this->common_model->getcrData($acct_id,$cractid,$dt,$fld_head,$fmdate,$todate);
//var_dump($crdata);

}


}

  $bal_tot = $os_balresult;
 
$final_data= $this->common_model->getcrData($max_qry,$fmdate,$todate,$acct_id);

              $trf_bal = $thrift_opbal;
              $shr_bal = $share_opbal;
              $loan_bal = $os_balresult;


if($final_data)
{

foreach ($final_data as $key => $svalue) {
  # code...
  //$data['data'][]=$value;
  if($svalue['thrift_c']!=0 || $svalue['thrift_d']!=0 || $svalue['share_d']!=0 || $svalue['share_c']!=0 || $svalue['principle_c']!=0 || $svalue['principle_d']!=0 || $svalue['interest_c']!=0 || $svalue['insurance_c']!=0)
{


              $trf_rct = $svalue['thrift_c'];
              $trf_pay = $svalue['thrift_d'];
              $trf_bal=$trf_bal+$trf_rct-$trf_pay;

              $shr_rct = $svalue['share_c'];
              $shr_pay = $svalue['share_d'];

              $shr_bal=$shr_bal+$shr_rct-$shr_pay;

              $principle_rct = $svalue['principle_c'];
              $loan_paid = $svalue['principle_d'];
              $loan_bal=$loan_bal+$loan_paid-$principle_rct;
              $interest_rct = $svalue['interest_c'];
              $insurance_rct = $svalue['insurance_c'];


         $event_data .= '<tr><td colspan="2" style="width:100%">'. date("d-m-Y",strtotime($svalue["trans_date"])) .'</td>';
          
          if($trf_rct!=0)
          {
          $event_data .= '<td style="text-align:right;width:110%;">'. number_format($trf_rct,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }
          if($trf_pay!=0)
          {
          $event_data .= '<td style="text-align:right;width:110%;">'.number_format($trf_pay,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }

          $event_data .= '<td style="text-align:right;width:110%;">'. number_format($trf_bal,2) .'</td>';
          if($shr_rct!=0)
          {
          $event_data .= '<td style="text-align:right;width:110%;">'. number_format($shr_rct,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }
          if($shr_pay!=0)
          {
          $event_data .= '<td style="text-align:right;width:110%;">'.number_format($shr_pay,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }

          $event_data .= '<td style="text-align:right;width:110%;">'. number_format($shr_bal,2) .'</td>';

          if($principle_rct!=0)
          {
          $event_data .= '<td style="text-align:right;width:110%;">'. number_format($principle_rct,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }
          if($interest_rct!=0)
          {
          $event_data .= '<td style="text-align:right;width:110%;">'. number_format($interest_rct,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }
          if($insurance_rct!=0)
          {
          $event_data .= '<td style="text-align:right;width:110%;">'. number_format($insurance_rct,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }
          if($loan_paid!=0)
          {

          $event_data .= '<td style="text-align:right;width:110%;">'. number_format($loan_paid,2) .'</td>';
          }
          else
          {
            $event_data .='<td></td>';
          }

          $event_data .= '<td style="text-align:right;width:110%;">'. number_format($loan_bal,2) .'</td>';

     $prin_col_tot = $prin_col_tot+ $principle_rct;
     $trfrct_col_tot = $trfrct_col_tot+$trf_rct;
     $trfpay_col_tot = $trfpay_col_tot+$trf_pay;
     $shrrct_col_tot= $shrrct_col_tot+$shr_rct;
     $shrpay_col_tot= $shrpay_col_tot+$shr_pay;
     $interestrct_col_tot = $interestrct_col_tot+$interest_rct;
     $insurancerct_col_tot= $insurancerct_col_tot+$insurance_rct;
     $loanpaid_col_tot= $loanpaid_col_tot+$loan_paid;
     $cl_bal = $loan_bal+$loanpaid_col_tot-$prin_col_tot;

$event_data .= '</tr>';



$sresult[] = array("trans_date"=>$svalue["trans_date"],"thrift_paid"=>$svalue["thrift_d"],"thrift_receipt"=>$svalue["thrift_c"],"share_paid"=>$svalue["share_d"],"share_receipt"=>$svalue["share_c"],"loan_paid"=>$svalue["principle_d"],"principle_receipt"=>$svalue["principle_c"],"interest_receipt"=>$svalue["interest_c"],"insurance_receipt"=>$svalue["insurance_c"]);
}
//$bal_tot =$bal_tot - $svalue["trans_amount"];
}

    
}

$event_data .= '<tr><td style="font-weight:bold;" colspan="2">TOTAL</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'. number_format((float)$trfrct_col_tot, 2) .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$trfpay_col_tot, 2) .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$trf_bal, 2) .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$shrrct_col_tot, 2) .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$shrpay_col_tot, 2) .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$shr_bal, 2)  .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$prin_col_tot, 2)  .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$interestrct_col_tot, 2) .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'.number_format((float)$insurancerct_col_tot, 2)  .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'. number_format((float)$loanpaid_col_tot, 2)  .'</td>';
$event_data .= '<td style="text-align:right;font-weight:bold;width:100%;">'. number_format((float)$loan_bal, 2) .'</td>';

$event_data .= '</tr></tbody></table></center></div>';

/*
$result[] = array(
    'id'=>$memberid,
    'accname'=> $membername,
    'memberid'=>$memberid,
    'membername' => $membername,
    'suretyid' => $suretyid,
    'suretyname' => $suretyname,
    'msharecap'=> $share_opbal,
    'loan_openingbalance' => $os_balresult,
    'thrift_openingbalance' =>$thrift_opbal,
    'share_openingbalance' => $share_opbal,
    'ledgerdetails'=> $sresult,
    'closingbal' =>$bal_tot
);
*/

//echo $event_data;
/*
$data['crd_data']= $event_data;
 //$data['main_content'] = $this->load->view('admin/report/all_dcbdata', $data, TRUE);
$data['main_content'] = $this->load->view('admin/report/crldg_pdf', $data, TRUE);
$this->load->view('admin/index', $data);
*/
//    $this->load->view('admin/report/crldg_pdf',$data,TRUE);
//echo $event_data;
    /* // Get output html
$data['crd_data'] = $event_data;
  $this->load->view('admin/report/crldg_pdf');    
     $html = $this->output->get_output();
  //      var_dump($html);
        // Load pdf library

setPaper(): Sets the paper size & orientation.

    $size (string|array) – 'letter', 'legal', 'A4', etc.
    $orientation (string) – 'portrait' or 'landscape'.


       */
//$html = $event_data;
        $this->load->library('pdf');
        
        // Load HTML content
        $this->dompdf->loadHtml($event_data);
        
        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'portrait');
        
        // Render the HTML as PDF
        $this->dompdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview)
        $this->dompdf->stream($acct_id . "_crldg.pdf", array("Attachment"=>1));

}







    function print_item()
    {
       //     load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
       // retrieve data from model
        $data['all_itemreport'] = $this->itemreport->get_items();
        $data['title'] = "items";
        ini_set('memory_limit', '256M'); 
       // boost the memory limit if it's low ;)
        $html = $this->load->view('report/plist_item', $data, true);
       // render the view into HTML
        $pdf->WriteHTML($html); // write the HTML into the PDF
        $output = 'itemreport' . date('Y_m_d_H_i_s') . '_.pdf';
        $pdf->Output("$output", 'I'); // save to file because we can
        exit();
    }





public function fetchCreditLedgerPrint()
{
  //Get Dates 
 $acct_id = $this->input->get('selacc');

  $fmdate = $this->input->get('fdate');
  $todate = $this->input->get('tdate');
$openBal = $this->common_model->getMembers_dataById($acct_id);
        foreach($openBal as $key => $opvalue) { 
    $db_tot=0;
    $cr_tot=0;
      $memberid = $opvalue['member_id'];
      $membername=$opvalue['member_name'];
      $suretyid = $opvalue['surety_id'];
      $suretyname = $opvalue['surety_name'];
      $share_opbal = $opvalue['share_capital'];
      $thrift_opbal = $opvalue['thrift_opbal'];
      $os_balresult = $opvalue['loan_opbal']; 
  
}

$max_qry="";
 $crldg_data = $this->common_model->getcrLedger_data();  
 if($crldg_data)
 {
   foreach ($crldg_data as $key => $crlvalue) {
     # code...
  $cractid=$crlvalue['id'];
  $fld_head=strtolower($crlvalue['import_account']);

     # code...
$max_qry .=  ",MAX(CASE WHEN account_id='". $acct_id ."' and cr_account_id='". $cractid ."'  THEN trans_amount ELSE 0 END)`". $fld_head ."_d`,MAX(CASE WHEN cr_account_id='". $acct_id ."' and account_id='". $cractid ."' THEN trans_amount ELSE 0 END)`". $fld_head ."_c`";

//$crdata = $this->common_model->getcrData($acct_id,$cractid,$dt,$fld_head,$fmdate,$todate);
//var_dump($crdata);

}


}

  $bal_tot = $os_balresult;
 
$final_data= $this->common_model->getcrData($max_qry,$fmdate,$todate,$acct_id);

if($final_data)
{

foreach ($final_data as $key => $svalue) {
  # code...
  //$data['data'][]=$value;
  if($svalue['thrift_c']!=0 || $svalue['thrift_d']!=0 || $svalue['share_d']!=0 || $svalue['share_c']!=0 || $svalue['principle_c']!=0 || $svalue['principle_d']!=0 || $svalue['interest_c']!=0 || $svalue['insurance_c']!=0)
{
$sresult[] = array("trans_date"=>date("d-m-Y",strtotime($svalue["trans_date"])),"thrift_paid"=>$svalue["thrift_d"],"thrift_receipt"=>$svalue["thrift_c"],"share_paid"=>$svalue["share_d"],"share_receipt"=>$svalue["share_c"],"loan_paid"=>$svalue["principle_d"],"principle_receipt"=>$svalue["principle_c"],"interest_receipt"=>$svalue["interest_c"],"insurance_receipt"=>$svalue["insurance_c"]);
}
//$bal_tot =$bal_tot - $svalue["trans_amount"];
}
    
}



$result[] = array(
    'id'=>$memberid,
    'accname'=> $membername,
    'memberid'=>$memberid,
    'membername' => $membername,
    'suretyid' => $suretyid,
    'suretyname' => $suretyname,
    'msharecap'=> $share_opbal,
    'loan_openingbalance' => $os_balresult,
    'thrift_openingbalance' =>$thrift_opbal,
    'share_openingbalance' => $share_opbal,
    'ledgerdetails'=> $sresult,
    'closingbal' =>$bal_tot
);




echo json_encode($result);
  
   


}


public function fetchcreditledgerSearch()
{
$finyear=$this->session->userdata('finyear');
$data= array();
$sresult = array();
$acct_id = $this->input->get('selacc');
$os_balresult=0;

$memDetail = $this->common_model->get_memberid($acct_id);
        foreach($memDetail as $key => $memvalue) { 
    $db_tot=0;
    $cr_tot=0;
      $memberid = $memvalue['member_id'];
      $membername=$memvalue['member_name'];
      $suretyid = $memvalue['surety_id'];
}

$smemDetail = $this->common_model->get_memberid($suretyid);
if($smemDetail)
{
foreach($smemDetail as $key => $smemvalue) { 
      $suretyid = $smemvalue['member_id'];
      $suretyname = $smemvalue['member_name'];
}
}
else
{
    $suretyname='';
    $suretyid='';
}

$opbal_Data = $this->common_model->getOpBal($acct_id,$finyear);
//var_dump($opbal_Data);
if($opbal_Data)
{
  foreach ($opbal_Data as $key => $op_value) {
      $share_opbal = $op_value['share_capital'];
      $thrift_opbal = $op_value['thrift_opbal'];
      $os_balresult = $op_value['loan_opbal']; 
  }
}
else {
$share_opbal=0;
$thrift_opbal=0;
$os_balresult=0;
}


$cldgData = $this->common_model->getCldgData();
if($cldgData)
$sql_qry="";
{
  foreach ($cldgData as $key => $cldgvalue) {
    # code...
    $dcb_id = $cldgvalue['acclink_id'];
    $imp_acnm = $cldgvalue['import_account'];
$sql_qry .=" (CASE WHEN account_id='". $dcb_id ."' THEN COALESCE(trans_amount,0) ELSE 0 END)`". $imp_acnm . "_r" ."`,(CASE WHEN cr_account_id='". $dcb_id ."' THEN trans_amount ELSE 0 END)`". $imp_acnm . "_p" ."`,";

  }
//var_dump($sql_qry);
}
$tot_thf=0;
$tot_prn=0;
$tot_shr=0;
$tot_interest=0;
$tot_ins=0;
$thrift_r=0;
$thrift_p=0;
$principle_r=0;
$principle_p=0;
$share_r=0;
$share_p=0;
$interest_r=0;
$insurance_r=0;

$bal_tot=0;
$subData = $this->common_model->fetchcreditLedgerData($finyear,$acct_id,$sql_qry);
//var_dump($subData);
  $bal_tot = $os_balresult;
$tot_thf=$thrift_opbal;
$tot_shr=$share_opbal;
$tot_prn=$os_balresult;
if($subData)
{

  foreach ($subData as $key => $value) {
 

foreach ($cldgData as $key => $cvalue) {

$imphead = $cvalue['import_account'];
if($imphead=="THRIFT")
{
  $thrift_r = $value['THRIFT_r'];
  $thrift_p = $value['THRIFT_p'];
  $tot_thf = $tot_thf + $thrift_r - $thrift_p;
}

if($imphead=="PRINCIPLE")
{
  $principle_r = $value["PRINCIPLE_r"];
  $principle_p = $value['PRINCIPLE_p'];
  $tot_prn = $tot_prn +$principle_p- $principle_r;
}


if($imphead=="SHARE")
{
  $share_r = $value['SHARE_r'];
  $share_p = $value['SHARE_p'];
  $tot_shr = $tot_shr + $share_r-$share_p;
}


if($imphead=="INTEREST")
{
  $interest_r = $value['INTEREST_r'];
 $tot_interest = $tot_interest + $interest_r;
}


if($imphead=="INSURANCE")
{
  $insurance_r = $value['INSURANCE_r'];
  $tot_ins = $tot_ins + $insurance_r;
}




//$data['data'][] = $value;



  }
if($thrift_r<>0 || $thrift_p<>0 || $share_r<>0 || $share_p<>0 || $principle_r<>0 || $principle_p<>0 || $interest_r<>0 || $insurance_r<>0)
{
$sresult[] = array("trans_date"=>$value["trans_date"],"trans_ref"=>$value["trans_id"],"thrift_r"=>$thrift_r,"thrift_p"=>$thrift_p,"tot_thf"=>$tot_thf, "principle_r"=>$principle_r, "principle_p"=>$principle_p,"tot_prn"=>$tot_prn,"share_r"=>$share_r,"share_p"=>$share_p,"tot_shr"=>$tot_shr, "interest_r"=>$interest_r,"tot_interest"=>$tot_interest,"tot_ins"=>$tot_ins, "insurance_r"=>$insurance_r);
}

$bal_tot =$bal_tot - $tot_prn;

}
//var_dump($sresult);


$data['data'] = array(
   // 'id'=>$value['id'],
    //'accname'=> $$membername,
    'memberid'=>$memberid,
    'membername' => $membername,
    'suretyid' => $suretyid,
    'suretyname' => $suretyname, 
    'msharecap'=> $share_opbal,
    'loan_openingbalance' => $os_balresult,
    'thrift_openingbalance' =>$thrift_opbal,
    'share_openingbalance' => $share_opbal,
    'ledgerdetails'=> $sresult,
    'closingbal' =>$tot_prn
);


}

echo json_encode($data);

}





public function fetchcreditledgerSearchPDF()
{
$finyear=$this->session->userdata('finyear');
$data= array();
$sresult = array();
$acct_id = $this->input->post('ldgrSelect');
$os_balresult=0;
//var_dump($acct_id);
$memDetail = $this->common_model->get_memberid($acct_id);
        foreach($memDetail as $key => $memvalue) { 
    $db_tot=0;
    $cr_tot=0;
      $memberid = $memvalue['member_id'];
      $membername=$memvalue['member_name'];
      $suretyid = $memvalue['surety_id'];
}

$smemDetail = $this->common_model->get_memberid($suretyid);
foreach($smemDetail as $key => $smemvalue) { 
      $suretyid = $smemvalue['member_id'];
      $suretyname = $smemvalue['member_name'];
}


$opbal_Data = $this->common_model->getOpBal($acct_id,$finyear);
//var_dump($opbal_Data);
if($opbal_Data)
{
  foreach ($opbal_Data as $key => $op_value) {
      $share_opbal = $op_value['share_capital'];
      $thrift_opbal = $op_value['thrift_opbal'];
      $os_balresult = $op_value['loan_opbal']; 
  }
}
else {
$share_opbal=0;
$thrift_opbal=0;
$os_balresult=0;
}


$cldgData = $this->common_model->getCldgData();
if($cldgData)
$sql_qry="";
{
  foreach ($cldgData as $key => $cldgvalue) {
    # code...
    $dcb_id = $cldgvalue['acclink_id'];
    $imp_acnm = $cldgvalue['import_account'];
$sql_qry .=" (CASE WHEN account_id='". $dcb_id ."' THEN COALESCE(trans_amount,0) ELSE 0 END)`". $imp_acnm . "_r" ."`,(CASE WHEN cr_account_id='". $dcb_id ."' THEN trans_amount ELSE 0 END)`". $imp_acnm . "_p" ."`,";

  }
//var_dump($sql_qry);
}
$tot_thf=0;
$tot_prn=0;
$tot_shr=0;
$tot_interest=0;
$tot_ins=0;
$thrift_r=0;
$thrift_p=0;
$principle_r=0;
$principle_p=0;
$share_r=0;
$share_p=0;
$interest_r=0;
$insurance_r=0;
$event_data='';
$main_data='';
$bal_tot=0;
$rtot_prnr=0;
$rtot_thfr=0;
$rtot_thfp=0;
$rtot_prnp=0;
$rtot_intr=0;
$rtot_insr=0;
$rtot_shrp=0;
$rtot_shrr=0;
$subData = $this->common_model->fetchcreditLedgerData($finyear,$acct_id,$sql_qry);
//var_dump($subData);
  $bal_tot = $os_balresult;
$tot_thf=$thrift_opbal;
$tot_shr=$share_opbal;
$tot_prn=$os_balresult;
if($subData)
{

  foreach ($subData as $key => $value) {
 

foreach ($cldgData as $key => $cvalue) {

$imphead = $cvalue['import_account'];
if($imphead=="THRIFT")
{
  $thrift_r = $value['THRIFT_r'];
  $thrift_p = $value['THRIFT_p'];
  $tot_thf = $tot_thf + $thrift_r - $thrift_p;
}

if($imphead=="PRINCIPLE")
{
  $principle_r = $value["PRINCIPLE_r"];
  $principle_p = $value['PRINCIPLE_p'];
  $tot_prn = $tot_prn +$principle_p- $principle_r;
}


if($imphead=="SHARE")
{
  $share_r = $value['SHARE_r'];
  $share_p = $value['SHARE_p'];
  $tot_shr = $tot_shr + $share_r-$share_p;
}


if($imphead=="INTEREST")
{
  $interest_r = $value['INTEREST_r'];
 $tot_interest = $tot_interest + $interest_r;
}


if($imphead=="INSURANCE")
{
  $insurance_r = $value['INSURANCE_r'];
  $tot_ins = $tot_ins + $insurance_r;
}




//$data['data'][] = $value;



  }
if($thrift_r<>0 || $thrift_p<>0 || $share_r<>0 || $share_p<>0 || $principle_r<>0 || $principle_p<>0 || $interest_r<>0 || $insurance_r<>0)
{
$sresult[] = array("trans_date"=>$value["trans_date"],"trans_ref"=>$value["trans_id"],"thrift_r"=>$thrift_r,"thrift_p"=>$thrift_p,"tot_thf"=>$tot_thf, "principle_r"=>$principle_r, "principle_p"=>$principle_p,"tot_prn"=>$tot_prn,"share_r"=>$share_r,"share_p"=>$share_p,"tot_shr"=>$tot_shr, "interest_r"=>$interest_r,"tot_interest"=>$tot_interest,"tot_ins"=>$tot_ins, "insurance_r"=>$insurance_r);

if($thrift_r>0)
{
  $thrift_rct=number_format((float)$thrift_r, 2, '.', '');
$rtot_thfr = $rtot_thfr+$thrift_rct;
}
else
{
  $thrift_rct='';
}


if($thrift_p>0)
{
  $thrift_pay=number_format((float)$thrift_p, 2, '.', '');
$rtot_thfp = $rtot_thfp+$thrift_pay;
}
else
{
  $thrift_pay='';
}


if($share_r>0)
{
$share_rct=number_format((float)$share_r, 2, '.', '');
$rtot_shrr = $rtot_shrr+$share_rct;
}
else
{
  $share_rct='';
}


if($share_p>0)
{
  $share_pay=number_format((float)$share_p, 2, '.', '');
$rtot_shrp = $rtot_shrp+$share_pay;
}
else
{
  $share_pay='';
}


if($interest_r>0)
{
  $interest_rct=number_format((float)$interest_r, 2, '.', '');
$rtot_intr = $rtot_intr+$interest_rct;
}
else
{
  $interest_rct='';
}


if($insurance_r>0)
{
  $insurance_rct=number_format((float)$insurance_r, 2, '.', '');
$rtot_insr = $rtot_insr+$insurance_rct;
}
else
{
  $insurance_rct='';
}

if($principle_r>0)
{
  $principle_rct=number_format((float)$principle_r, 2, '.', '');
$rtot_prnr = $rtot_prnr+$principle_rct;
}
else
{
  $principle_rct='';
}


if($principle_p>0)
{
  $principle_pay=number_format((float)$principle_p, 2, '.', '');
$rtot_prnp = $rtot_prnp+$principle_pay;
}
else
{
  $principle_pay='';
}

$tdate = date_create($value['trans_date']);
//echo date_format($date, 'Y-m-d H:i:s');

//$/tdate = $value['trans_date'];


$dt= date_format($tdate,"d-m-Y");


$main_data .= '<tr>';
$main_data .= '<td class="datewidth">' . $dt .'</td><td  class="transwidth">'. $value['trans_id'] .'</td>';
$main_data .= '<td style="text-align:right" class="amt">' . $thrift_rct .'</td><td style="text-align:right" class="amt">'. $thrift_pay
 .'</td><td style="text-align:right;" class="amt">'.  number_format((float)$tot_thf, 2, '.', '') . '</td>';
$main_data .= '<td style="text-align:right" class="amt">' .  $share_rct .'</td><td style="text-align:right" class="amt">'. $share_pay .'</td><td style="text-align:right;" class="amt">'. number_format((float)$tot_shr, 2, '.', '') . '</td>';
$main_data .= '<td style="text-align:right" class="amt">' . $principle_rct  .'</td><td style="text-align:right" class="amt">'. $interest_rct .'</td><td style="text-align:right" class="amt">'. $insurance_rct . '</td>';
$main_data .= '<td style="text-align:right" class="amt">' . $principle_pay .'</td><td style="text-align:right;width:20px;" class="amt">'.  number_format((float)$tot_prn, 2, '.', '')  . '</td>';

$main_data .= '</tr>';

}

$bal_tot =$bal_tot - $tot_prn;

}
//var_dump($sresult);
//var_dump($main_data);

$data['data'] = array(
   // 'id'=>$value['id'],
    //'accname'=> $$membername,
    'memberid'=>$memberid,
    'membername' => $membername,
    'suretyid' => $suretyid,
    'suretyname' => $suretyname, 
    'msharecap'=> $share_opbal,
    'loan_openingbalance' => $os_balresult,
    'thrift_openingbalance' =>$thrift_opbal,
    'share_openingbalance' => $share_opbal,
    'ledgerdetails'=> $sresult,
    'closingbal' =>$tot_prn
);


}


$main_data .= '<tr>';
$main_data .= '<td colspan="2"><b>CLOSING BALANCE</b></td>';
$main_data .= '<td style="text-align:right;"><b>' .  number_format((float)$rtot_thfr, 2, '.', '') .'</b></td><td style="text-align:right;"><b>'.  number_format((float)$rtot_thfp, 2, '.', '')
 .'</b></td><td style="text-align:right;"><b>'.  number_format((float)$tot_thf, 2, '.', '') . '</td>';
$main_data .= '<td style="text-align:right;"><b>' .   number_format((float)$rtot_shrr, 2, '.', '') .'</b></td><td style="text-align:right;"><b>'. number_format((float)$rtot_shrp, 2, '.', '') .'</b></td><td style="text-align:right;"><b>'. number_format((float)$tot_shr, 2, '.', '') . '</b></td>';
$main_data .= '<td style="text-align:right;"><b>' .  number_format((float)$rtot_prnr, 2, '.', '')  .'</b></td><td style="text-align:right;"><b>'. number_format((float)$rtot_intr, 2, '.', '') .'</b></td><td style="text-align:right;"><b>'.  number_format((float)$rtot_insr, 2, '.', '') . '</b></td>';
$main_data .= '<td style="text-align:right;"><b>' .  number_format((float)$rtot_prnp, 2, '.', '') .'</b></td><td style="text-align:right;"><b>'.  number_format((float)$tot_prn, 2, '.', '')  . '</b></td>';

$main_data .= '</tr>';




$imgpath=base_url('optimum/logo.png');
$ext= pathinfo($imgpath, PATHINFO_EXTENSION);
$data = file_get_contents($imgpath);
$base64 = 'data:image/' . $ext. ';base64,' . base64_encode($data);

$event_data .='<style>


table {
   
    margin: 20px auto;
    table-layout: auto;
}

.datewidth {
  width:40px;
}

.transwidth {
  width:60px;
}
.amt {
  width:45px;
}

h4 {
  text-align:center;
}
table th { border: 1px solid black; padding: 2px;

font-size: 7px;
font-weight: bold;

}

table td { border: 1px solid black;  
font-size: 10px;

border-collapse: collapse;
}

#crldgrep td, #crldgrep th {
  border: 1px solid #ddd;
  border-collapse: collapse;
  
}
.center {
  margin-left: auto;
  margin-right: auto;
}
#crldgrep {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  
  overflow-x: auto;
}

#crmain {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  
  overflow-x: auto;
}
#crldgrep td, #crldgrep th {
  border: 1px solid black;
  
}
img{
    width:45px; 
    height:45px;
    margin-bottom:10px;
}

.heading {
  font-weight:bold;
  font-size:12;
  margin-left:100px;
  margin-top:-45px;
}

.table
{
  item-align:center-block;
}

label {
  float:left;
  padding-right:15px;
  padding-left:10px;
  margin-right:50px;
}
span {
  padding-right:10px;
  float:left;
}
.smnm label{
  margin-left:100px;
}

.smn label{
  margin-left:170px;
}
            footer {
                position: fixed; 
                bottom: -20px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **
                background-color: #03a9f4; */
                color: grey;
                text-align: center;
                line-height: 35px;
            }
.closing{
  font-weight:bold;
}

</style>';
$system_name = $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('soc_settings', array('type' => 'system_title'))->row()->description;
$system_address = $this->db->get_where('soc_settings', array('type' => 'system_title'))->row()->address;

 $event_data .='<img src="'.$base64.'"/>';
 $event_data .='<div class="heading">'. $system_name . '</div>';
 $event_data .= '<footer>'. $system_address .'</footer>';

 $event_data .= '<div id="printable"><div class="card text-center"><div class="card-header" id="crldgrep"> <h4>CREDIT LEDGER</h4>   </div>  <div class="card-body"> <div><label>Member Name</label><span> <b>' . $membername .'</b> <span></div> <div class="smnm"><label>Surety Name</label> <div><b>'. $suretyname .'</b></div></div><br><div><label>Member Number</label><span><b> '. $memberid .'</b></span></div><div class="smn"><label>Surety Number</label><div> <b>' .$suretyid .'</b></div></div><br><div><label>Share Capital</label><span><b>'. $share_opbal . '</b></span></div><div class="smn"><label>F.Y : </label><div><b> '. $finyear .' </div></div>';

$event_data.= '<div class="card text-center"><div class="card-header"> <h4>LEDGER DETAILS</h4>    </div>  <div class="card-body"><table class="table center" border="1" id="crldgrep"><tr><th ></th><th></th><th colspan="3" style="text-align:center">Thrift Savings</th><th colspan="3" style="text-align:center">Shares</th><th colspan="2" style="text-align:center">Repayment</th><th style="text-align:center">Insurance</th><th colspan="2" style="text-align:center">Loan</th></tr><tr><th style="text-align:center">Date</th><th style="text-align:center">Reference #</th><th style="text-align:center">Receipt</th><th style="text-align:center">Payment</th><th style="text-align:center">Total</th><th style="text-align:center">Receipt</th><th style="text-align:center">Payment</th><th style="text-align:center">Total</th><th style="text-align:center">Principle</th><th style="text-align:center">Interest</th><th></th><th style="text-align:center">Loan Issued</th><th style="text-align:center">Loan Balance</th></tr><tbody>  <tr><td colspan="3"><b>OPENING BALANCE</b></td><td></td><td style="text-align:right"><b>'. $thrift_opbal .'</b></td><td></td><td></td><td  style="text-align:right"><b>'. $share_opbal .'</b></td><td></td><td></td><td></td><td></td><td style="text-align:right"><b>'. $os_balresult .'</b></td></tr>';

 $event_data .= $main_data;


//$event_data+= '<tr>';
 //if(data[index].trans_type=="JOUR") {
//                event_data+= '<td>'+data[index].ledgerdetails[i].trans_date+'</td><td>'+trfRef+'</td>';
//}








//var_dump($event_data);
//echo $event_data;
        $this->load->library('pdf');
        
        // Load HTML content
        $this->dompdf->loadHtml($event_data);
        
        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'portrait');
//$canvas = $this->dompdf->get_canvas();
//$font = Font_Metrics::get_font("DejaVu Mono", "bold");
//$canvas->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
        
        // Render the HTML as PDF
        $this->dompdf->render();
      // $this->dompdf->stream("welcome.pdf");
        // Output the generated PDF (1 = download and 0 = preview)
        $this->dompdf->stream($acct_id . "_crldg.pdf", array("Attachment"=>1));

//echo json_encode($data);

}






public function fetchcreditledgerJson()
    {
$finyear=$this->session->userdata('finyear');
        $data= array();
        $sresult = array();
            $acct_id = $this->input->get('selacc');
//print_r($acct_id);
 $data = $this->common_model->getLedger_data($acct_id);  
 $os_balresult=0;
        $result =array();
        foreach($data as $key => $value) { 

    $cr_amount = 0;
    $db_amount = 0;
    $db_tot=0;
    $cr_tot=0;
    $bal_tot=0;
    $itmnam = "";
    $impacc="";

$openBal = $this->common_model->getMembers_dataById($value['acclink_id']);
        foreach($openBal as $key => $opvalue) { 
    $db_tot=0;
    $cr_tot=0;
      $memberid = $opvalue['member_id'];
      $membername=$opvalue['member_name'];
      $suretyid = $opvalue['surety_id'];
      $suretyname = $opvalue['surety_name'];
      /*
      $share_opbal = $opvalue['share_capital'];
      $thrift_opbal = $opvalue['thrift_opbal'];
      $os_balresult = $opvalue['loan_opbal']; */
  
}


$opbal_Data = $this->common_model->getOpBal($acct_id,$finyear);
//var_dump($opbal_Data);
if($opbal_Data)
{
  foreach ($opbal_Data as $key => $op_value) {
      $share_opbal = $op_value['share_capital'];
      $thrift_opbal = $op_value['thrift_opbal'];
      $os_balresult = $op_value['loan_opbal']; 
  }
}
else {
$share_opbal=0;
$thrift_opbal=0;
$os_balresult=0;
}


            $fmdate = $this->input->get('fdate');
            $todate = $this->input->get('tdate');

 $subData = $this->common_model->fetchcreditLedgerSubData($value['acclink_id'],$fmdate,$todate,$acct_id);

if($acct_id=="0") {
    $a_id=$value['acclink_id'];
}
else {
    $a_id=$acct_id;
}
$bal_tot=0;
//print_r($subData);

  $bal_tot = $os_balresult;
        foreach($subData as $key => $svalue) { 


if($svalue['cr_account_id']==$a_id) {
$acid = $svalue['account_id'];
$impacc = $svalue['import_account'];
$accHead = $this->common_model->getAccHead($acid);

foreach ($accHead as $key => $ahvalue) {
  # code...
  $prn_pos = $ahvalue["print_pos"];
  $acc_name = $ahvalue["account_name"];
//print_r($acid);

$sresult[] = array("member_id"=>$svalue["cr_account_id"],"member_name"=>$acc_name,"trans_date"=>$svalue["trans_date"],"trans_ref"=>$svalue["trans_id"],"dbcr"=>"DB","impacc"=>$impacc,"print_pos"=>$prn_pos,"trans_amount"=>$svalue["trans_amount"],"division_name"=>$svalue["division_name"]);

}

}
else {
$acid = $svalue['cr_account_id'];
$accHead = $this->common_model->getAccHead($acid);

foreach ($accHead as $key => $ahvalue) {
  # code...
  $prn_pos = $ahvalue["print_pos"];
  $acc_name = $ahvalue["account_name"];

$sresult[] = array("member_id"=>$svalue["cr_account_id"],"member_name"=>$acc_name,"trans_date"=>$svalue["trans_date"],"trans_ref"=>$svalue["trans_id"], "dbcr"=>"CR","impacc"=>$impacc,"print_pos"=>$prn_pos,"trans_amount"=>$svalue["trans_amount"],"division_name"=>$svalue["division_name"]);

}

}

$bal_tot =$bal_tot - $svalue["trans_amount"];
}


$result[] = array(
    'id'=>$value['id'],
    'accname'=> $value['account_name'],
    'memberid'=>$memberid,
    'membername' => $membername,
    'suretyid' => $suretyid,
    'suretyname' => $suretyname,
    'msharecap'=> $share_opbal,
    'loan_openingbalance' => $os_balresult,
    'thrift_openingbalance' =>$thrift_opbal,
    'share_openingbalance' => $share_opbal,
    'ledgerdetails'=> $sresult,
    'closingbal' =>$bal_tot
);


$bal_tot=0;
  $sresult='';
       $os_balresult='';
}
  $sresult='';

        echo json_encode($result);
}



        
}
