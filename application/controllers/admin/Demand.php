<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demand extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
    }


    public function index()
    {
        $data = array();
    

        $data['page_title'] = 'User';
        $data['country'] = $this->common_model->select('country');
        $data['power'] = $this->common_model->get_all_power('soc_user_power');
        $data['main_content'] = $this->load->view('admin/demand/demand_rep', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

public function gendemand()
{
        $data = array();
        $data['page_title'] = 'Monthly Demand Generation Process';
//        $data['dmdrec_data'] = $this->common_model->getDmdRec();
        $data['main_content'] = $this->load->view('admin/demand/gen_demand', $data, TRUE);
        $this->load->view('admin/index', $data);

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
                $option .= '<option value="0" selected disabled>Select a Divsions</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

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
  $count=1;
  foreach ($itemmast as $key => $value) {
    # code...
  

       $tbl .= '<tr><td><b>' . $value["item_name"] . '</b></td>
        <td><input type="text" id="'. strtolower($value["item_name"])  .'_amt"  name="'. strtolower($value["item_name"])  .'_amt" placeholder="0.00" style="text-align:right;"  class="form-control calc" </td>
         </tr>';
     
$count++;
   }
  $tbl .='<tr><td>Total</td><td><b><input  id="totAmt" name="totAmt" style="text-align:right;" class="form-control" type="text" readonly></b> </td></tr></table>';

 echo $tbl;

}




public function deletedemandRec()
{
    $id = $this->uri->segment(4);
            $validator = array('success' => false, 'messages' => array());


    $delete = $this->common_model->deletedemand($id);
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


    public function fetchDemandData()
    {
  //  $compId=$this->session->userdata['id']; 
  //  $isItc=$this->session->userdata['isItc'];   
    
   // $sdate="2019-08-01";
   // $edate="2019-08-05";

    $monthyear=$this->input->get('month_year');
    
        $rw=1;
        $demandfilterData = $this->common_model->fetchDemandDatefilter($monthyear);
        
        $result = array('data' => array());
        foreach($demandfilterData as $key => $value) { 

$id=$value['id'];

$divid = $value['division_id'];

$subdivid = $value['subdivision_id'];
$secid = $value['section_id'];
$dsgid = $value['designation_id'];
$deptid = $value['dept_id'];

$divisionList = $this->common_model->get_divisionbyid($divid);
//var_dump($membersList);
if(count($divisionList)>0)
{

 //var_dump($membersList);
foreach ($divisionList as  $dvalue) 
 {
     $division_name =$dvalue['division_name'];
 }
    
}
else 
{
$division_name="UNKNOWN";
}


$subdivisionList = $this->common_model->get_subdivisionbyid($subdivid);
//var_dump($membersList);
if(count($subdivisionList)>0)
{

 //var_dump($membersList);
foreach ($subdivisionList as  $sdvalue) 
 {
     $subdivision_name =$sdvalue['subdivision_name'];
 }
    
}
else 
{
$subdivision_name="UNKNOWN";
}


$departmentList = $this->common_model->get_departmentbyid($deptid);
//var_dump($membersList);
if(count($departmentList)>0)
{

 //var_dump($membersList);
foreach ($departmentList as  $dptvalue) 
 {
     $department_name =$dptvalue['department_name'];
 }
    
}
else 
{
$department_name="UNKNOWN";
}


$sectionList = $this->common_model->get_sectionbyid($secid);
//var_dump($membersList);
if(count($sectionList)>0)
{

 //var_dump($membersList);
foreach ($sectionList as  $secvalue) 
 {
     $section_name =$secvalue['section_name'];
 }
    
}
else 
{
$section_name="UNKNOWN";
}



$designationList = $this->common_model->get_designationbyid($dsgid);
//var_dump($membersList);
if(count($designationList)>0)
{

 //var_dump($membersList);
foreach ($designationList as  $dsgvalue) 
 {
     $designation_name =$dsgvalue['designation'];
 }
    
}
else 
{
$designation_name="UNKNOWN";
}


            //<li><a href="#" data-toggle="modal" data-target="#printInvoiceModal" onclick="viewInvoice('. $value['id'] .')">View</a></li> 
            //$pdfbtn ='<div classs="btn-group"><a href="#" onclick="topdf('. $value['id'] .')"><i class="fa fa-car"></a></i></div>';
   
 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#edit-demand-modal" onclick="updateDemands(' . $id . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deleteDemand(' . $id . ')"><i class="fa fa-trash"></i>
      </button>

  
</div>'; 


    $result['data'][$key] = array(
                //$rw,
                "division_name"=>$division_name,
                "member_id"=>$value['member_id'],
                "member_name"=>$value['member_name'],
                "designation"=>$designation_name,
                "section_name"=>$section_name,
                "insurance_amount"=>$value['insurance_amount'],
                "thrift_amount"=>$value['thrift_amount'],
                "principle_amount"=>$value['principle_amount'],
                "interest_amount"=>$value['interest_amount'],
               // "misc_amount"=>$value['misc_amount'],
                
                "total_amount"=>$value['total_amount'],

                "action" => $button
                );  
            $rw=$rw+1;
            
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


$status=$this->common_model->demandData('soc_demandtemp_tbl',$data,$mmyy);
  //  print_r(json_encode($data));
                
                //$ins_data = $this->common_model->insertDemand($fmdate,$todate,$data,$mmyy);
            //    var_dump(json_encode($data));
  //  $status = $this->db->query($query);         
                 
                    
        
  //return ($status === true ? true : false);   
 

                
            $validator = array('success' => false, 'messages' => array());


            
            if($status === true) {
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





   public function  fetchLedgerAccounts()
    {
        
            $data = $this->common_model->get_ldgacclist();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                        $option .= '<option value="'.$value['id'].'">'.$value['account_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>All Ledger Accounts</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

}




    public function all_application_list()
    {
        $data['page_title'] = 'All Loan Applications';
        $data['applications'] = $this->common_model->get_all_loanapplications();
        $data['country'] = $this->common_model->select('country');
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/report/loanapplications', $data, TRUE);
        $this->load->view('admin/index', $data);
    }




    public function demand_process(){
        $data = array();
        $data['page_title'] = 'Monthly Demand Process';
        $data['dmdrec_data'] = $this->common_model->getDmdRec();
        $data['main_content'] = $this->load->view('admin/report/monthly_demandprocess', $data, TRUE);
        $this->load->view('admin/index', $data);
    }




    public function payment_report(){
        $data = array();
        $data['page_title'] = 'Payment Report';
        $data['main_content'] = $this->load->view('admin/report/payment_report', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function demand_rep(){
        $data = array();
        $data['page_title'] = 'Demand Report';
        $data['main_content'] = $this->load->view('admin/demand/demand_rep', $data, TRUE);
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


    public function fetchledgerJson()
    {

        $data= array();
            $acct_id = $this->input->get('selacc');

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

$openBal = $this->common_model->fetchledgerOp($value['member_id']);
        foreach($openBal as $key => $opvalue) { 
    $db_tot=0;
    $cr_tot=0;


      $os_balresult = $opvalue['loan_outstanding']; 
  
}

            $fmdate = $this->input->get('fdate');
            $todate = $this->input->get('tdate');

 $subData = $this->common_model->fetchLedgerSubData($value['id'],$fmdate,$todate,$acct_id);

if($acct_id=="0") {
    $a_id=$value['id'];
}
else {
    $a_id=$acct_id;
}
$bal_tot=0;

  $bal_tot = $os_balresult;
        foreach($subData as $key => $svalue) { 

       if($svalue['account_id']==$a_id){
        $cr_amount=0;
        $db_amount = $svalue['trans_amount'];
        $db_tot = $db_tot+$db_amount;
        $account_name = $svalue['cash_bank'];
       }


       if($svalue['cash_bank_id']==$a_id){
        $db_amount=0;
        $cr_amount = $svalue['trans_amount'];
        $cr_tot = $cr_tot+$cr_amount;
        $account_name = $svalue['account_name'];
       }

    $bal_tot = $os_balresult+$db_tot-($cr_tot);

      $sresult[] = array(
            "acc_id" => $svalue['account_id'],
            "acc_name" => $account_name,
            "trans_date" => $svalue['trans_date'],
            "cash_bank_id" => $svalue['cash_bank_id'],
            "cash_bank" => $svalue['cash_bank'],
            "db_amount" => $db_amount,
            "cr_amount" => $cr_amount,
            'debittot' => $db_tot,
       //   'credittot' => number_format($bal_tot, 2, '.', ',') $cr_tot,
            "bal_tot" =>  number_format($bal_tot, 2, '.', ',') 
        ); 
 
}
  

$result[] = array(
    'id'=>$value['id'],
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
        



    public function createDemand()
    {
            $validator = array('success' => false, 'messages' => array());

            
            $create = $this->common_model->insertMDemand();                    
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




   public function all_Demand_list()
    {
        $data['page_title'] = 'All Demands';
        $data['Demands'] = $this->common_model->get_all_Demand();
       //  $data['Demand'] = $this->common_model->select('Demand_tbl');
       // $data['count'] = $this->common_model->get_Demand_total();
        $data['main_content'] = $this->load->view('admin/Demand/Demands', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //-- update users info
    public function update($id)
    {
        if ($_POST) {

            $data = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'mobile' => $_POST['mobile'],
                'country' => $_POST['country'],
                'role' => $_POST['role']
            );
            $data = $this->security->xss_clean($data);

            $powers = $this->input->post('role_action');
            if (!empty($powers)) {
                $this->common_model->delete_user_role($id, 'soc_user_role');
                foreach ($powers as $value) {
                   $role_data = array(
                        'user_id' => $id,
                        'action' => $value
                    ); 
                   $role_data = $this->security->xss_clean($role_data);
                   $this->common_model->insert($role_data, 'soc_user_role');
                }
            }

            $this->common_model->edit_option($data, $id, 'soc_user');
            $this->session->set_flashdata('msg', 'Information Updated Successfully');
            redirect(base_url('admin/user/all_user_list'));

        }
		
        $data['user'] = $this->common_model->get_single_user_info($id);
        $data['user_role'] = $this->common_model->get_user_role($id);
        $data['power'] = $this->common_model->select('soc_user_power');
        $data['country'] = $this->common_model->select('country');
        $data['main_content'] = $this->load->view('admin/user/edit_user', $data, TRUE);
		$data['page_title'] = 'Edit Users';
        $this->load->view('admin/index', $data);
        
    }

    
    //-- active user
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id,'user');
        $this->session->set_flashdata('msg', 'User active Successfully');
        redirect(base_url('admin/user/all_user_list'));
    }

    //-- deactive user
    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id,'user');
        $this->session->set_flashdata('msg', 'User deactive Successfully');
        redirect(base_url('admin/user/all_user_list'));
    }

    //-- delete user
    public function delete($id)
    {
        $this->common_model->delete($id,'soc_user'); 
        $this->session->set_flashdata('msg', 'User deleted Successfully');
        redirect(base_url('admin/user/all_user_list'));
    }


    public function power()
    {   
		$data['page_title'] = 'Add User Role';
        $data['powers'] = $this->common_model->get_all_power('soc_user_power');
        $data['main_content'] = $this->load->view('admin/user/user_power', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //-- add user power
    public function add_power()
    {   
        if (isset($_POST)) {
            $data = array(
                'name' => $_POST['name'],
                'power_id' => $_POST['power_id']
            );
            $data = $this->security->xss_clean($data);
            
            //-- check duplicate power id
            $power = $this->common_model->check_exist_power($_POST['power_id']);
            if (empty($power)) {
                $user_id = $this->common_model->insert($data, 'soc_user_power');
                $this->session->set_flashdata('msg', 'Power added Successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Power id already exist, try another one');
            }
            redirect(base_url('admin/user/power'));
        }
        
    }

    //--update user power
    public function update_power()
    {   
        if (isset($_POST)) {
            $data = array(
                'name' => $_POST['name']
            );
            $data = $this->security->xss_clean($data);
            
            $this->session->set_flashdata('msg', 'Power updated Successfully');
            $user_id = $this->common_model->edit_option($data, $_POST['id'], 'soc_user_power');
            redirect(base_url('admin/user/power'));
        }
        
    }

    public function delete_power($id)
    {
        $this->common_model->delete($id,'soc_user_power'); 
        $this->session->set_flashdata('msg', 'Power deleted Successfully');
        redirect(base_url('admin/user/power'));
    }


public function updateDiv() {
            $validator = array('success' => false, 'messages' => array());

$div_id = $this->input->post('editdivid');
$div_name = $this->input->post('editdivname');

            $create =  $this->common_model->updateDivData($div_id,$div_name);
            if($create === true) {
                $validator['success'] = true;
                $validator['messages'] = "Successfully udated";
                
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Error while inserting the information into the database";
            }           
echo json_encode($validator);
    }




public function getDemandMainData()
{
$outdata=array();    
$finyear=$this->session->userdata('finyear');
$data = $this->common_model->getDmdMain($finyear);
//var_dump($data);
if($data)
{
    foreach ($data as $key => $dvalue) {
     $dmd_rec_id = $dvalue['id'];
     $divid=$dvalue['div_id'];
     $division_name=$dvalue['division_name'];
     $demand_date=$dvalue['demand_date'];
     $mmyyyy=$dvalue['mmyyyy'];
//     $outdata['data'][]=$dvalue;


$mem_cnt = $this->common_model->getDmdCount($dmd_rec_id,$finyear);
if($mem_cnt)
{
     $cnt=$mem_cnt;
 
}


$subdmd_data = $this->common_model->getDmdSubData($divid,$dmd_rec_id,$finyear);
if($subdmd_data)
{
    foreach ($subdmd_data as $key => $sdvalue) {
 //   $cnt = $sdvalue['cnt'];
    $tot_amt = $sdvalue['tot_amt'];        

    }
}

$btn='<button type="button" class="btn btn-primary"  href="#" data-toggle="modal" data-backdrop="static" data-keyboard="true" data-target="#edit-demand-modal" onclick="updateTransid(' . $dmd_rec_id . ')"><i class="fa fa-edit"></i></button>&nbsp;<button type="button" class="btn btn-danger" href="#" onclick="deleteTransid('. $dmd_rec_id . ')"><i class="fa fa-times"></i></button>';

$outdata['data'][]=array("division_name"=>$division_name,"demand_date"=>$demand_date,"mmyyyy"=>$mmyyyy,"nom"=>(int)$cnt,"tot_amt"=>$tot_amt,"finyear"=>$finyear, "action"=>$btn);

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


//Update demand data on soc 

public function updateDemandData()
{

 $validator = array('success' => false, 'messages' => array());
$data =  json_decode($this->input->post('json'),TRUE);
$upd_data=array();
$dmd_main=array();
$rid = $this->input->post('recid');
//$divid= $this->input->post('div_id');
//var_dump($mmyy . $divid);
//$mdate = date("Y-m-d",strtotime("01-" . $mmyy));
//$curr_date = new DateTime($mdate)
//$date = new DateTime($mdate);
//$curr_month = $date->format("mY");
$finyear=$this->session->userdata('finyear');
//$date->sub(new DateInterval('P1M')); // P -> Period 1 Month
//$last_month= $date->format("mY");

$getMainDmdData=$this->common_model->getMainDataDmd($rid);
if($getMainDmdData)
{
    foreach ($getMainDmdData as $key => $mdvalue) {
        $mm_yy = $mdvalue['mmyyyy'];
        $div_id=$mdvalue['div_id'];
        $rec_id= $mdvalue['id'];
        $mdate=$mdvalue['demand_date'];

    }
}


if($data)
{
    foreach ($data as $key => $jvalue) {

     $memid= $jvalue['mem_id'];
     $thf=$jvalue['thrift'];
     $emi=$jvalue['principle'];
     $interest=$jvalue['interest'];
     $insurance=$jvalue['insurance'];
     $mmyyyy=$jvalue['mmyy'];

$getImpAccData= $this->common_model->getDmdFlagData();
if($getImpAccData)
{
    foreach ($getImpAccData as $impacc) {

        $tls = $impacc['tls_flag'];
        
 if($tls=='T')
 {

    $acclink = $impacc['acclink_id'];
    $ins_data[]=array("div_id"=>$div_id,"member_id"=>$memid,"acclink_id"=>$acclink,"trans_amount"=>$thf,"mmyyyy"=>$mmyyyy,"trans_date"=>$mdate,"fyear"=>$finyear,"dmdmain_id"=>$rec_id);
 }
 if($tls=='L')
 {
    $acclink = $impacc['acclink_id'];
    $ins_data[]=array("div_id"=>$div_id,"member_id"=>$memid,"acclink_id"=>$acclink,"trans_amount"=>$emi,"mmyyyy"=>$mmyyyy,"trans_date"=>$mdate,"fyear"=>$finyear,"dmdmain_id"=>$rec_id);
 }
 if($tls=='I')
 {
    $acclink = $impacc['acclink_id'];
    $ins_data[]=array("div_id"=>$div_id,"member_id"=>$memid,"acclink_id"=>$acclink,"trans_amount"=>$interest,"mmyyyy"=>$mmyyyy,"trans_date"=>$mdate,"fyear"=>$finyear,"dmdmain_id"=>$rec_id);
 }

 if($tls=='N')
 {
    $acclink = $impacc['acclink_id'];
    $ins_data[]=array("div_id"=>$div_id,"member_id"=>$memid,"acclink_id"=>$acclink,"trans_amount"=>$insurance,"mmyyyy"=>$mmyyyy,"trans_date"=>$mdate,"fyear"=>$finyear,"dmdmain_id"=>$rec_id);
 }

} // Loop





}

    }



}
//$this->db->where('mmyyyy',$mm_yy);
//$status=$this->db->update_batch('soc_demand_2021_tbl', $upd_data, 'id');
//$this->db->update_batch('soc_demand_2021_tbl', $upd_data);

if($ins_data)
{
    $cond  = ['dmdmain_id' => $rec_id, 'div_id' => $div_id];
    $query = $this->db->where($cond);
    $delsts= $this->db->delete('soc_demand_2021_tbl');
//echo $delsts;

$status=$this->db->insert_batch('soc_demand_2021_tbl', $ins_data);

//echo $status;
    if($status) 
    {
      $msg= array("success"=>true,"messages"=>"Record(s) updated successfully");
     echo json_encode($msg);
    }
    else
    {
     $msg= array("success"=>false,"messages"=>"Update action unsuccessfull...");
     echo json_encode($msg);
    }

}

//echo json_encode($ins_data);
}




//Insert Demand data on soc_demand_2021_tbl
public function insertDemandData()
{

 $validator = array('success' => false, 'messages' => array());
$data =  json_decode($this->input->post('json'),TRUE);
$ins_data=array();
$dmd_main=array();
$mmyy = $this->input->post('mm_yy');
$divid= $this->input->post('div_id');
//var_dump($mmyy . $divid);
$mdate = date("Y-m-d",strtotime("01-" . $mmyy));
//$curr_date = new DateTime($mdate)
$date = new DateTime($mdate);
$curr_month = $date->format("mY");
$finyear=$this->session->userdata('finyear');
$date->sub(new DateInterval('P1M')); // P -> Period 1 Month
$last_month= $date->format("mY");



$dmd_main=array("div_id"=>$divid,"demand_date"=>$mdate,"mmyyyy"=>$last_month,"fyear"=>$finyear);

if($dmd_main)
{
    $last_ins_id = $this->common_model->ins_dmdmain($dmd_main);
//echo json_encode($dmd_main);
//$last_ins_id=0;

}

//var_dump($data);

if($data)
{
    foreach ($data as $key => $jvalue) {

     $memid= $jvalue['mem_id'];
     $thf=$jvalue['thrift'];
     $emi=$jvalue['surety'];
     $interest=$jvalue['interest'];
     $insurance=$jvalue['insurance'];
     $mmyyyy=$jvalue['mmyy'];

$getImpAccData= $this->common_model->getDmdFlagData();
if($getImpAccData)
{
    foreach ($getImpAccData as $impacc) {

        $tls = $impacc['tls_flag'];
        
 if($tls=='T')
 {
    if($thf>0){
    $acclink = $impacc['acclink_id'];
    $ins_data[]=array("div_id"=>$divid,"member_id"=>$memid,"acclink_id"=>$acclink,"trans_amount"=>$thf,"mmyyyy"=>$mmyyyy,"trans_date"=>$mdate,"fyear"=>$finyear,"dmdmain_id"=>$last_ins_id);
 }
 }
 if($tls=='L')
 {
    if($emi>0)
    {
    $acclink = $impacc['acclink_id'];
    $ins_data[]=array("div_id"=>$divid,"member_id"=>$memid,"acclink_id"=>$acclink,"trans_amount"=>$emi,"mmyyyy"=>$mmyyyy,"trans_date"=>$mdate,"fyear"=>$finyear,"dmdmain_id"=>$last_ins_id);
 }
}
 if($tls=='I')
 {
    if($interest>0)
    {
    $acclink = $impacc['acclink_id'];
    $ins_data[]=array("div_id"=>$divid,"member_id"=>$memid,"acclink_id"=>$acclink,"trans_amount"=>$interest,"mmyyyy"=>$mmyyyy,"trans_date"=>$mdate,"fyear"=>$finyear,"dmdmain_id"=>$last_ins_id);
 }
}


 if($tls=='N')
 {
    if($insurance>0)
    {
    $acclink = $impacc['acclink_id'];
    $ins_data[]=array("div_id"=>$divid,"member_id"=>$memid,"acclink_id"=>$acclink,"trans_amount"=>$insurance,"mmyyyy"=>$mmyyyy,"trans_date"=>$mdate,"fyear"=>$finyear,"dmdmain_id"=>$last_ins_id);
 }
}
} // Loop



}

    }



}

if($ins_data)
{
$status=$this->db->insert_batch('soc_demand_2021_tbl', $ins_data);

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
}

//echo json_encode($ins_data);
}


public function get_editDemandData()
{
$id= $this->input->get('id');

$getDmdMain = $this->common_model->getMainDataDmd($id);
if($getDmdMain)
{
    foreach ($getDmdMain as $key => $dmvalue) {
        
        $dmd_date=$dmvalue['demand_date'];
        $div_id=$dmvalue['div_id'];
        $mmyy=$dmvalue['mmyyyy'];
        $fyear=$dmvalue['fyear'];

    } //Loop

} //Main DMD IF 
$subqry='';
$getImpAccData= $this->common_model->getDmdFlagData();
if($getImpAccData)
{
    foreach ($getImpAccData as $impacc) 
    {
        $ac_head=strtolower($impacc['import_account']);
 $subqry .= "SUM(CASE WHEN dm.acclink_id=" . $impacc['acclink_id'] . " THEN dm.trans_amount ELSE 0 END)`". $ac_head ."`,";
}
$subqry = rtrim($subqry, ',');

//var_dump($subqry);
}

$getSubDmd = $this->common_model->getDmdSubAllData($div_id,$id,$fyear,$subqry);
if($getSubDmd)
{
    foreach ($getSubDmd as $key => $sdvalue) {

     $data[]=$sdvalue;

    }
}
echo json_encode($data);




}


public function get_DemandData()
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
$dcb_thf=0;
$dcb_loan=0;
$dcb_insu=0;
$dcb_interest=0;
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





$getImpAccData= $this->common_model->getDmdFlagData();
if($getImpAccData)
{
    foreach ($getImpAccData as $impacc) {

        $tls = $impacc['tls_flag'];
        $acclink = $impacc['acclink_id'];
 if($tls=='T')
 {
$getDcbData = $this->common_model->getDcbDataByMem($mem_id,$acclink,$prev_month);
if($getDcbData)
{
    foreach ($getDcbData as  $tvalue) {
        // code...
        $dcb_thf=$tvalue['trans_amount'];
    }
}
else
{
    $dcb_thf=0;
}
}


 if($tls=='L')
 {
$getDcbData = $this->common_model->getDcbDataByMem($mem_id,$acclink,$prev_month);
if($getDcbData)
{
    foreach ($getDcbData as  $lvalue) {
        // code...
        $dcb_loan=$lvalue['trans_amount'];
    }
}
else
{
    $dcb_loan=0;
}
}
 if($tls=='I')
 {
$getDcbData = $this->common_model->getDcbDataByMem($mem_id,$acclink,$prev_month);
if($getDcbData)
{
    foreach ($getDcbData as  $ivalue) {
        // code...
        $dcb_interest=$ivalue['trans_amount'];
    }
}
else
{
    $dcb_interest=0;
}
}
 if($tls=='N')
 {
$getDcbData = $this->common_model->getDcbDataByMem($mem_id,$acclink,$prev_month);
if($getDcbData)
{
    foreach ($getDcbData as  $nvalue) {
        // code...
        $dcb_insu=$nvalue['trans_amount'];
    }
}
else
{
    $dcb_insu=0;
}
}
       

    } //impacc loop
}


        $thf_mon=$thf_mon+ $dcb_thf;
        $emi_mon=$emi_mon+$dcb_loan;
        $interest_mon=$interest_mon+$dcb_interest;
        $insr_mon=$insr_mon+$dcb_insu;

$tot_thf=$tot_thf+$thf_mon;
$tot_emi=$tot_emi+$emi_mon;
$tot_int=$tot_int+$interest_mon;
$tot_insu=$tot_insu+$insr_mon;


$data[]=array("mem_id"=>$mem_id,"mem_name"=>$mem_name,"thf_mon"=>$thf_mon,"emi_mon"=>$emi_mon,"int_mon"=>$interest_mon,"ins_mon"=>$insr_mon,"mmyy"=>$last_month);

/*

$tbl.='<tr>';
$tbl.='<td>'. $rw . '</td>';
$tbl.='<td>'. $mem_id . ' - ' . $mem_name .'</td>';
$tbl.='<td><input style="text-align:right;" class="form-control thrift" onfocus="getCalcThf('. $i .')" onkeyup="getCalcThf('. $i .')" value="'. number_format($thf_mon,2,'.','') .'"  id="thrift'. $i .'" name="thrift['.$i.']"></td>';
$tbl.='<td><input  style="text-align:right;" class="form-control loan"  onfocus="getCalcLoan('. $i .')" onkeyup="getCalcLoan('. $i .')" value="'. number_format($emi_mon,2,'.','') .'"   id="loan'. $i .'" name="loan['.$i.']"></td>';
$tbl.='<td><input  style="text-align:right;" class="form-control interest"  onfocus="getCalcInterest('. $i .')" onkeyup="getCalcInterest('. $i .')"  value="'. number_format($interest_mon,2,'.','') .'"  id="interest'. $i .'" name="interest['.$i.']"></td>';
$tbl.='<td><input  style="text-align:right;" class="form-control insurance"  onfocus="getCalcInsu('. $i .')" onkeyup="getCalcInsu('. $i .')"  value="'. number_format($insr_mon,2,'.','') .'"  id="insurance'. $i .'" name="insurance['.$i.']"></td>';
$tbl.='</tr>'; 
*/
$i++;
$rw++;
$thf_mon=0;
$interest_mon=0;
$emi_mon=0;

$insr_mon=0;
    } // Memebr Loop
    
}

//$tbl.='<tfoot>';
//$tbl.='<td colspan="2">Total</td><td style="text-align:right;font-weight:bold;">'.number_format($tot_thf,2,'.','').'</td><td  style="text-align:right;font-weight:bold;">'.number_format($tot_emi,2,'.','').'</td><td  style="text-align:right;font-weight:bold;">'.number_format($tot_int,2,'.','').'</td><td  style="text-align:right;font-weight:bold;">'.number_format($tot_insu,2,'.','').'</td>';
//$tbl.='</tbody>';
$tbl.='</table>';

//$tbl.='<div class="row"><div class="col-md-12"><div class="col-md-4"><div>Total</div></div><div class="col-md-2"><div id="tot_thf" style="text-align:right;" >'.number_format($tot_thf,2,'.','').'</div></div><div id="tot_emi"  class="col-md-2"><div style="text-align:right;" >'.number_format($tot_emi,2,'.','').'</div></div><div class="col-md-2"><div  id="tot_int" style="text-align:right;" >'.number_format($tot_int,2,'.','') .'</div></div><div class="col-md-2"><div id="tot_ins"  style="text-align:right;" >'.number_format($tot_insu,2,'.','') .'</div></div></div></div>';

//echo $tbl;
echo json_encode($data);

}

public function fetchDmdRecData()
{
  $mmyy = $this->input->get('month_year');
  $dmdData = $this->common_model->getDemandData($mmyy);
$result = array('data' => array());
  foreach ($dmdData as $key => $dvalue) {
    $mem_id = $dvalue['member_id'];
//print_r($mem_id . "\n");
 $recData = $this->common_model->getRecoveryDataByid($mmyy,$mem_id);
 $rtot=0;
 $dtot=0;

//print_r(count($recData));

 if(count($recData)>0) {


   foreach ($recData as $key => $rvalue) {


      $trans_ref = $rvalue['trans_ref'];
      $trans_date= $rvalue['recovery_date'];
      $thrift = $rvalue['thrift_amount'];
      $principle = $rvalue['principle_amount'];
      $interest = $rvalue['interest_amount'];
      $insurance = $rvalue['insurance_amount'];
      $misc = $rvalue['misc_amount'];
      $rtot= $thrift+$principle+$interest+$insurance+$misc;
     # code...
    }
 

   }
 
   else 
    {
     $trans_ref = "";// $rvalue['trans_ref'];
      $trans_date= "";// $rvalue['trans_date'];
      $thrift = 0; // $rvalue['thrift_amount'];
      $principle = 0; //$rvalue['principle_amount'];
      $interest = 0; //$rvalue['interest_amount'];
      $insurance = 0; //$rvalue['insurance_amount'];
      $misc = 0; //$rvalue['misc_amount'];

      $rtot= $thrift+$principle+$interest+$insurance+$misc;
    }
//print_r("hhh" . $mem_id . "\n");


$dtot = $dvalue['thrift_amount']+ $dvalue['principle_amount']+$dvalue['interest_amount']+$dvalue['insurance_amount'];

  $result['data'][] = array(
   'memberid' => $mem_id,
   'membername'=> $dvalue['member_name'],
   'demanddate' => $dvalue['demand_date'],
   'dmd_thrift' => $dvalue['thrift_amount'],
   'dmd_principle' => $dvalue['principle_amount'],
   'dmd_interest' => $dvalue['interest_amount'],
   'dmd_insurance'=> $dvalue['insurance_amount'],
   'dmd_total' => $dtot,

   'recoverydate' => $trans_date,
   'recoveryref' => $trans_ref,
   'rec_thrift'=> $thrift,
   'rec_principle' => $principle,
   'rec_interest' => $interest,
   'rec_insurance' => $insurance,
   'rec_misc' => $misc,
   'rec_total' => $rtot

  );

    # code...
  }

echo json_encode($result);

}



    public function dmdrec_report(){ 
        $data = array(); 
        $data['page_title'] = 'Demand Recovery Report';
        

        $data['main_content'] = $this->load->view('admin/demand/dmdrecovery_report', $data, TRUE);
        $this->load->view('admin/index', $data);
    }




}