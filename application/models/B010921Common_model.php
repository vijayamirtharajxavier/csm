<?php
class Common_model extends CI_Model {
private $_batchImport;
    //-- insert function

	public function insert($data,$table){
        $this->db->insert($table,$data);        
        return $this->db->insert_id();
    }

public function del_Jventry($jvm)
{
  $this->db->where('month', $jvm);
  $this->db->delete('soc_journalentry_tbl');
  $this->db->where('month', $jvm);
  $this->db->delete('soc_transaction_tbl');
  $this->db->where('month_year', $jvm);
  $this->db->delete('soc_thrift_tbl');
  $this->db->where('month_year', $jvm);
  $this->db->delete('soc_principle_tbl');
  $this->db->where('mmyy', $jvm);
  $this->db->delete('soc_itemtrans_tbl');
   
}

  public function insertNDivision(){
    $divname = $this->input->post('divname');

$div_id = $this->get_settings_id();

foreach ($div_id as $key => $row) {
  $divid = $row['division_id'];
  $divNum = $row['division_prefix'] . $divid;// . '/' . $row['year'];
}

    $data = array('division_name' => strtoupper($divname),'division_id'=>$divNum);

         $status = $this->db->insert('soc_division_tbl', $data);         

        $nxtdiv=$divid+1;
        
        

        //$next_invno = sprintf("%03d", $nxtInvno);
        $update_rct = array('division_id'=>$nxtdiv);

     
   return ($status === true ? true : false);   

    }

  public function insertNSDivision(){
    $divname = $this->input->post('sdivname');
    $data = array('subdivision_name' => strtoupper($divname));

         $status = $this->db->insert('soc_division_tbl', $data);         

     
   return ($status === true ? true : false);   

    }



  public function insertNDepartment(){
    $dptname = $this->input->post('dptname');
    $data = array('department_name' => strtoupper($dptname));

         $status = $this->db->insert('soc_department_tbl', $data);         

     
   return ($status === true ? true : false);   

    }


  public function insertNLedger(){
    $ldgname = $this->input->post('ldgname');
    $ldgaccttype = $this->input->post('ldgaccttype');
    $ldgalink = $this->input->post('ldgacctlink');
    $importaccode = $this->input->post('importaccode');
    $opbalance = $this->input->post('opbalance');

    if($ldgalink!="0") {
      $data = array('account_name' => strtoupper($ldgname),'account_type'=>$ldgaccttype, 'acclink_id'=>$ldgacctlink,'import_account'=>$importaccode,'op_balance'=>$opbalance);     
    $status = $this->db->insert('soc_ledgermaster_tbl', $data);         
    }
    else {
    $data = array('account_name' => strtoupper($ldgname),'account_type'=>$ldgaccttype);
    $status = $this->db->insert('soc_ledgermaster_tbl', $data);
 $insert_id = $this->db->insert_id();
  
  $upd = array('acclink_id' =>$insert_id);
  $this->db->where('id',$insert_id);
  $this->db->update('soc_ledgermaster_tbl',$upd);
   }
              

     
   return ($status === true ? true : false);   

    }

public function updateMember() {
  
$mNum = $this->input->post('editmemberNumber');
$mGen=$this->input->post('editmemberGender');
$mdob=$this->input->post('editdob');
$mdoj=$this->input->post('editdoj');
$mMarital=$this->input->post('editmaritalStatus');
$mName=$this->input->post('editmemberName');
//$mPhoto=$data['userfile'];
$mMobile=$this->input->post('editmobile');
$mLandline=$this->input->post('editlandline');
$mResaddr=$this->input->post('editresaddr');
$divid =$this->input->post('editdivision');
//$mSubdivision=$this->input->post('editsubdivision_id');
$mDept=$this->input->post('editdepartment_id');
$mSection=$this->input->post('editsection_id');
$mDesg=$this->input->post('editdesignation_id');
$mEmail=$this->input->post('editemail');
$mOffId=$this->input->post('editoffidcard');
$mOthId=$this->input->post('editothidcard');
$mChkFH=$this->input->post('editcheck_fh');
$mFHName=$this->input->post('editfh_Name');
$mSuretyName=$this->input->post('editsurety_name');
$mSuretyNum=$this->input->post('editsurety_id');
$mSuretyCap=$this->input->post('editmSuretyCapital');
$mThriftop=$this->input->post('editmthriftopbal');
$mLoanOutstanding=$this->input->post('editloanoutstanding');
$mRoi=$this->input->post('editroi');
$mNoi=$this->input->post('editnoi');
$mLoanOp=$this->input->post('editloanopbal');
$mInsAmt=$this->input->post('editinsAmt');
$mPrincipleAmt = $this->input->post('editprinamt');
$memstf = $this->input->post('editmemstf');
$mReligion=$this->input->post('editreligion_id');
$mCaste=$this->input->post('editcaste_id');
$mSubCaste=$this->input->post('editsubcaste_id');
$trfmon = $this->input->post('edittrfmon');
$accsts = $this->input->post('editaccsts');

$upd_member=array('member_name'=>$mName,'father_husband'=>$mChkFH,'fahu_name'=>$mFHName,'gender'=>$mGen,'marital'=>$mMarital,'dob'=>$mdob,'doj'=>$mdoj,'religion'=>$mReligion,'caste'=>$mCaste,'subcaste'=>$mSubCaste,'division_id'=>$divid,'dept_id'=>$mDept,'section_id'=>$mSection,'designation_id'=>$mDesg,'mobile_no'=>$mMobile,'landline_no'=>$mLandline,'email_id'=>$mEmail,'resident_add'=>$mResaddr,'surety_id'=>$mSuretyNum,'thrift_monthly' => $trfmon, 'surety_name'=>$mSuretyName,'share_capital'=>$mSuretyCap,'thrift_opbal'=>$mThriftop,'rate_of_interest'=>$mRoi,'no_installment'=>$mNoi,'principle_amount'=>$mPrincipleAmt,'loan_outstanding' =>$mLoanOutstanding,'member_staff'=> $memstf,'account_close'=>$accsts);

$this->db->where('member_id',$mNum);
$status = $this->db->update('soc_members_tbl', $upd_member);         
//print_r($upd_member);
     
return ($status === true ? true : false);   


}


public function insertMember(){
/*
foreach ($data as $item => $value)
/*{
$mPhoto= str_replace("C:/xampp/htdocs/ctmp/","",$value['full_path']);
}
*/


$mNum = $this->input->post('memberNumber');
$mGen=$this->input->post('memberGender');
$mdob=$this->input->post('dbirth');
$mdoj=$this->input->post('doj');
$mMarital=$this->input->post('maritalStatus');
$mName=$this->input->post('memberName');
//$mPhoto=$data['userfile'];
$mMobile=$this->input->post('mobile');
$mLandline=$this->input->post('landline');
$mResaddr=$this->input->post('resaddr');
$mDivision =$this->input->post('division_id');
//$mSubdivision=$this->input->post('subdivision_id');
$mDept=$this->input->post('department_id');
$mSection=$this->input->post('section_id');
$mDesg=$this->input->post('designation_id');
$mEmail=$this->input->post('email');
$mOffId=$this->input->post('offidcard');
$mOthId=$this->input->post('othidcard');
$mChkFH=$this->input->post('check_fh');
$mFHName=$this->input->post('fh_Name');
/*
$mBnkName=$this->input->post('bnkName');
$mBnkBranch=$this->input->post('bnkBranch');
$mAccName=$this->input->post('accName');
$mAccNum=$this->input->post('accNumber');
$mIfscode=$this->input->post('ifscode');
$mBnkAddr=$this->input->post('bnkAddr');
*/
$mSuretyName=$this->input->post('surety_name');
$mSuretyNum=$this->input->post('surety_id');
$mSuretyCap=$this->input->post('mSuretyCapital');
$mThriftop=$this->input->post('mthriftopbal');
$mLoanOutstanding=$this->input->post('loanoutstanding');
$mRoi=$this->input->post('roi');
$mNoi=$this->input->post('noi');
$mLoanOp=$this->input->post('loanopbal');
$mInsAmt=$this->input->post('insAmt');
$mPrincipleAmt = $this->input->post('prinamt');
$memstf = $this->input->post('memstf');
$mReligion=$this->input->post('religion_id');
$mCaste=$this->input->post('caste_id');
$mSubCaste=$this->input->post('subcaste_id');
$trfmon = $this->input->post('trfmon');
$accsts= $this->input->post('accsts');


/*
if($mChkFH=="On") 
{
  $fh="0";
}
else {
  $fh="1";
}
*/

$ins_member=array('member_id'=>$mNum,'member_name'=>$mName,'father_husband'=>$mChkFH,'fahu_name'=>$mFHName,'gender'=>$mGen,'marital'=>$mMarital,'dob'=>$mdob,'doj'=>$mdoj,'religion'=>$mReligion,'caste'=>$mCaste,'subcaste'=>$mSubCaste,'division_id'=>$mDivision,'dept_id'=>$mDept,'section_id'=>$mSection,'designation_id'=>$mDesg,'mobile_no'=>$mMobile,'landline_no'=>$mLandline,'email_id'=>$mEmail,'resident_add'=>$mResaddr,'surety_id'=>$mSuretyNum,'thrift_monthly' => $trfmon, 'surety_name'=>$mSuretyName,'share_capital'=>$mSuretyCap,'thrift_opbal'=>$mThriftop,'rate_of_interest'=>$mRoi,'no_installment'=>$mNoi,'principle_amount'=>$mPrincipleAmt,'loan_outstanding' =>$mLoanOutstanding,'account_close'=>$accsts);

//,'photo_path'=>$mPhoto,'bank_name'=>$mBnkName,'branch_name'=>$mBnkBranch,'account_name'=>$mAccName,'account_no'=>$mAccNum,'ifscode'=>$mIfscode,'branch_addr'=>$mBnkAddr,




  //  $memImg = $this->input->post('member_picture');

    //$data = array('subdivision_name' => strtoupper($divname));

//print_r($ins_member);

  $status = $this->db->insert('soc_members_tbl', $ins_member);         

     
   return ($status === true ? true : false);   

    }



function get_LastLoanDate($accId=null)
{
  $sql="SELECT max(trans_date) `trans_date` FROM soc_trans_tbl WHERE account_id=? and cr_account_id=(SELECT acclink_id FROM soc_ledgermaster_tbl WHERE import_account=?)";
  $query = $this->db->query($sql,array($accId,"Principle"));
  return $query->result_array();
}


function get_thriftdepositbyid($mid)
{
  
       $sql = "SELECT   sum(thrift_deposit) `dep_thrift`,(sum(thrift_deposit)+sum(thrift_opbal)) `tot_thrift`,sum(share_capital) `tot_sharecapital`, sum(loan_outstanding) `out_loan` ,sum(loan_opbal) `out_oploan`,(sum(loan_outstanding)+sum(loan_opbal)) `totoutstanding`   FROM soc_members_tbl WHERE member_id=?";
        $query = $this->db->query($sql,array($mid));
        return $query->result_array();

}


function get_thriftdeposit()
{
  
       $sql = "SELECT  sum(thrift_deposit) `dep_thrift`,(sum(thrift_deposit)+sum(thrift_opbal)) `tot_thrift`,sum(share_capital) `tot_sharecapital`, sum(loan_outstanding) `out_loan` ,sum(loan_opbal) `out_oploan`,(sum(loan_outstanding)+sum(loan_opbal)) `totoutstanding`   FROM soc_members_tbl";
        $query = $this->db->query($sql);
        return $query->result_array();
   
}

/*function getRecData($sqlqry=null)
{
  $sql=$sqlqry;

  $query = $this->db->query($sql);
  //print_r($query);//
  return $query->result_array();
}
*/
function get_totInterest()
{
  
       $sql = "SELECT sum(trans_amount) `tot_interest` FROM `soc_itemtrans_tbl` WHERE item_id=2";
        $query = $this->db->query($sql);
        return $query->result_array();
   
}


    //-- edit function
    function edit_option($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    } 



  public function insertNSection(){
    $secname = $this->input->post('secname');
    $data = array('section_name' => strtoupper($secname));

         $status = $this->db->insert('soc_section_tbl', $data);         

     
   return ($status === true ? true : false);   

    }


  public function insertNDesignation(){
    $dsgname = $this->input->post('dsgname');
    $data = array('designation' => strtoupper($dsgname));

         $status = $this->db->insert('soc_designation_tbl', $data);         

     
   return ($status === true ? true : false);   

    }


function updateDivData($id,$divname)
{
  $data = array();
  $data = array('division_name'=>strtoupper($divname));
  $this->db->where('id',$id);

//  $this->db->update('soc_division_tbl',$data);
       $status = $this->db->update('soc_division_tbl', $data);         

     
   return ($status === true ? true : false);   


}



function updatedsgData($id,$dsgname)
{
  $data = array();
  $data = array('designation'=>strtoupper($dsgname));
  $this->db->where('id',$id);

//  $this->db->update('soc_division_tbl',$data);
       $status = $this->db->update('soc_designation_tbl', $data);         

     
   return ($status === true ? true : false);   


}


function updateSDivData($id,$divname)
{
  $data = array();
  $data = array('subdivision_name'=>strtoupper($divname));
  $this->db->where('id',$id);

//  $this->db->update('soc_division_tbl',$data);
       $status = $this->db->update('soc_division_tbl', $data);         

     
   return ($status === true ? true : false);   


}

function updateSecData($id,$secname)
{
  $data = array();
  $data = array('section_name'=>strtoupper($secname));
  $this->db->where('id',$id);

//  $this->db->update('soc_division_tbl',$data);
       $status = $this->db->update('soc_section_tbl', $data);         

     
   return ($status === true ? true : false);   


}




function Journalupdate()
{
  $data = array();

$ejid = $this->input->post('recid');
$ejdate = $this->input->post('editjvdate');
//$lastmonth = date("Y-m-d", strtotime("-1 months"));
//$mm_yy = date('Y-m-d', strtotime(str_replace('-','/', $lastmonth)));// date("Y-m-d", strtotime("-1 months", $ejdate));
//$mmyy = date("mY", strtotime($mm_yy));
//$mmyy = date("mY", strtotime($mm_yy));

        $db_type = $this->input->post('editdb');
        $cr_type = $this->input->post('editcr');
        $debitaccNumber = $this->input->post('editdebitaccountNumber');
        $creditaccNumber = $this->input->post('editcreditaccountNumber');
        $debitAmount = $this->input->post('editdbtransamount');
        $creditAmount = $this->input->post('editcrtransamount');
        $jvNarration = $this->input->post('editjvnarration');

        if($debitAmount!=0){
            $dc = "D";          
        }

        if($creditAmount!=0){
            $dc = "C";          
        }
    

  $update_jvTbl = array('trans_date' => $ejdate,
  'account_id'  => $debitaccNumber,
  'trans_amount' => $debitAmount,
  'cr_account_id'  => $creditaccNumber,
  'trans_narration' => $jvNarration
    );
  //print_r($update_jvTbl);
  //print_r($ejid . '--' . $ejdate . 'mm ' . $mmyy);
$finyear=$this->session->userdata('finyear');
         $this->db->where(array('id'=>$ejid,'trans_date'=>$ejdate,'fyear' => $finyear));
         $status= $this->db->update('soc_trans_tbl', $update_jvTbl);
        //$jv_tbl_id = $this->db->insert_id();           



          /*          for($x = 0; $x <= count($this->input->post('edititemamount'))-1; $x++) {
                        //echo count($this->input->post('itemamount'));
                       // echo $x;
                        $itmamt = $this->input->post('edititemamount')[$x];

                        $itmnm = $this->input->post('edititemname')[$x];

                        $itemid = $this->input->post('edititemid')[$x];
                     $update_item_data = array(
                       // 'item_id' => $this->input->post('edititemid')[$x],
                           // 'item_name'  => $this->input->post('edititemname')[$x],
                            'trans_amount' => $itmamt, //$this->input->post('itemamount')[$x],
                           // 'trans_ref' => $jvNum,
                           // 'trans_refid' => $jv_tbl_id,
                            'trans_date' => $ejdate,
                            'trans_type' => "JOUR",
                            'cash_bank' => $debitaccNumber,
                            'account_id'  => $creditaccNumber,
                            'account_name' => $creditaccName,
                            'mmyy' => $mmyy
                        );
                 // echo $update_item_data;
                 //    print_r($update_item_data);
                   //  print_r($itemid);
                    
                     $this->db->where(array('trans_ref'=>$ejid,'trans_date'=>$ejdate,'item_id'=>$itemid));
                        $status = $this->db->update('soc_itemtrans_tbl', $update_item_data);
                    }*/

     
   return ($status === true ? true : false);   


}


function updateDptData($id,$dptname)
{
  $data = array();
  $data = array('department_name'=>strtoupper($dptname));
  $this->db->where('id',$id);

//  $this->db->update('soc_division_tbl',$data);
       $status = $this->db->update('soc_department_tbl', $data);         

     
   return ($status === true ? true : false);   


}


function updateLdgtData()
{
  $ldg_id = $this->input->post('editldgid');
$ldg_name = $this->input->post('editldgname');
$ldg_accttype = $this->input->post('editldgaccttype');
$ldg_acctlink = $this->input->post('editldgacctlink');
$ldg_importcode = $this->input->post('editldgimportaccode');
$ldg_opbal = $this->input->post('editldgopbalance');
  $data = array();
  $data = array('account_name'=>strtoupper($ldg_name),'account_type'=>$ldg_accttype,'acclink_id'=>$ldg_acctlink,'import_account'=> $ldg_importcode,'op_balance'=>$ldg_opbal);

  $this->db->where('id',$ldg_id);
  $status = $this->db->update('soc_ledgermaster_tbl', $data);         

     
   return ($status === true ? true : false);   


}


    //-- update function
    function update($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    } 

    //-- delete function
    function delete($id,$table){
        $this->db->delete($table, array('id' => $id));
        return;
    }

    //-- user role delete function
    function delete_user_role($id,$table){
        $this->db->delete($table, array('user_id' => $id));
        return;
    }

function fetchitembyjno($jno=null)
{
  if($jno)
  {
    $ttype = "JOUR";
    $sql="select item_name,trans_amount from soc_itemtrans_tbl where trans_type=? and trans_ref=?";
    $query = $this->db->query($sql, array($ttype,$jno));
    return $query->result_array();
  }
}

function fetchJournalfilterbydate($stDt=null,$enDt=null)
{
  $finyear=$this->session->userdata('finyear');
        $sql = "SELECT * FROM soc_trans_tbl where db_cr<>'CR' and  trans_date>=? and trans_date<=? and trans_type='JOUR' and fyear=?";
        $query = $this->db->query($sql, array($stDt,$enDt,$finyear));
        return $query->result_array();
}


function fetchglJournalfilterbydate($stDt=null,$enDt=null)
{
        $sql = "SELECT debitaccount_number,journal_date,debit_accountname,credit_accountname,sum(debit_amount) debit_amount,sum(credit_amount) credit_amount FROM soc_journalentry_tbl where  journal_date>=? and journal_date<=? group by debitaccount_number,journal_date";
        $query = $this->db->query($sql, array($stDt,$enDt));
        return $query->result_array();
}


        public function fetchJournalDatefilter($stDt=null,$enDt=null)
    {
     $finyear=$this->session->userdata('finyear');
        $sql = "SELECT * FROM soc_trans_tbl where  journal_date>=? and journal_date<=? and trans_type='JOUR' and fyear=?";
        $query = $this->db->query($sql, array($stDt,$enDt,$finyear));
      //  print_r($query);
        return $query->result_array();
    }


        public function fetchReceiptDatefilter($stDt=null,$enDt=null)
    {
     
      $finyear=$this->session->userdata('finyear');
        
//        $sql = "SELECT r.id, r.receipt_number,r.receipt_date,r.account_id,r.account_name,r.receipt_amount,r.narration,l.account_name as 
  //      `cash_bank` FROM soc_receipt_tbl r, soc_ledgermaster_tbl l where r.cash_bank=l.id and r.receipt_date>=? and r.receipt_date<=? and r.delflag=0 ORDER by r.receipt_date desc";


         // WHERE  receipt_date>= %?% and  receipt_date<= %?% ORDER BY  receipt_date asc receipt_number asc";
        
        $sql = "SELECT r.id, r.trans_id,r.trans_date,r.account_id,r.cr_account_id,l.account_name,r.trans_amount,r.trans_narration FROM soc_trans_tbl r, soc_ledgermaster_tbl l where r.account_id=l.id and r.trans_date>=? and r.trans_date<=? and r.delflag=0 and (r.trans_type='RCPT'  and r.fyear=?) ORDER by r.trans_date desc";


        $query = $this->db->query($sql, array($stDt,$enDt,$finyear));
         //$query = $this->db->query($sql);
        //$query = $this->db->query($sql, array($stDt,$enDt,$compId));
        //$this->output->enable_profiler(TRUE); 
        return $query->result_array();
    }


        public function fetchContraDatefilter($stDt=null,$enDt=null)
    {
     $finyear=$this->session->userdata('finyear');
      
        
        $sql = "SELECT * FROM soc_trans_tbl  where trans_type='CNTR' and trans_date>=? and trans_date<=? and delflag=0 and fyear=? ORDER by trans_date";

        $query = $this->db->query($sql, array($stDt,$enDt,$finyear));
        return $query->result_array();
    }


        public function fetchPaymentDatefilter($stDt=null,$enDt=null)
    {
     $finyear=$this->session->userdata('finyear');
    $sql = "SELECT * FROM soc_trans_tbl  where (trans_type='CNTR' or trans_type='PYMT') and trans_date>=? and trans_date<=? and delflag=0 and fyear=? ORDER by trans_date";
      
        $query = $this->db->query($sql, array($stDt,$enDt,$finyear));
        return $query->result_array();
    }


function get_memberid($memid=null)
{
  $sql="select * from soc_members_tbl where member_id=?";
  $query= $this->db->query($sql,array($memid));
  return $query->result_array();

}

        public function getRecoveryDataByid($mmyy=null,$memid=null)
    {
     
        

        $sql = "SELECT * FROM soc_recovery_tbl where month_year=? and member_id=? ORDER by member_id";
        $query = $this->db->query($sql, array($mmyy,$memid));
        return $query->result_array();
    }


   public function getDemandData($mmyy=null)
   {
    $sql="SELECT d.*,m.member_name FROM `soc_demandtemp_tbl` d, soc_members_tbl m WHERE d.member_id=m.member_id and d.month_year=? ORDER by d.member_id";
        $query = $this->db->query($sql, array($mmyy));
        return $query->result_array();
   
   }

        public function fetchDemandData($mmyy=null)
    {
     
        

        $sql = "SELECT d.*,m.member_name FROM soc_demandtemp_tbl d,soc_members_tbl m where  d.member_id=m.member_id  and d.month_year=?";
        $query = $this->db->query($sql, array($mmyy));
        return $query->result_array();
    }



        public function fetchDemandDataById($dmid=null)
    {
     
     if($dmid) {

        

        $sql = "SELECT d.*,m.member_name FROM soc_demandtemp_tbl d,soc_members_tbl m where d.id=? and d.member_id=m.member_id";
        $query = $this->db->query($sql,array($dmid));
//$this->output->enable_profiler(TRUE); 
            return $query->row_array();
       // return $query->result_array();

     }

         // WHERE  receipt_date>= %?% and  receipt_date<= %?% ORDER BY  receipt_date asc receipt_number asc";

        $query = $this->db->query($sql, array($mmyy));
        return $query->result_array();
    }


      public function deleteDiv($id)
      {
        $delflag=1;

        $upd_array= array('delflag'=>$delflag);
        $this->db->where('id',$id);
        $status = $this->db->update('soc_division_tbl', $upd_array);         

     
   return ($status === true ? true : false);   

      }

      public function deleterct($id)
      {
        $delflag=1;

        //$upd_rct= array('delflag'=>$delflag);
        $upd_trns= array('delflag'=>$delflag);
        $this->db->where('id',$id);
        //$status = $this->db->update('soc_receipt_tbl', $upd_rct);
        //$this->db->where('trans_refid',$id);         
        $status = $this->db->update('soc_trans_tbl', $upd_trns);
        return ($status === true ? true : false);   

      }




      public function deletepay($id)
      {
        $delflag=1;

        //$upd_rct= array('delflag'=>$delflag);
        $upd_trns= array('delflag'=>$delflag);
        $this->db->where('id',$id);
        //$status = $this->db->update('soc_payment_tbl', $upd_rct);
       // $this->db->where('trans_refid',$id);         
        $status = $this->db->update('soc_trans_tbl', $upd_trns);         

     
   return ($status === true ? true : false);   

      }

      public function updateReceipt($id)
      {
$finyear=$this->session->userdata('finyear');
        date_default_timezone_set("Asia/Calcutta"); 
        
        $editrctDate =$rctDate = date("Y-m-d", strtotime($this->input->post('editrecdate'))); 
        $editcr_account_id = $this->input->post('editaccountNumber');
        $editaccName = $this->input->post('editaccountName');
        $editrctAmount = $this->input->post('editreceipt_amt');
        $editaccount_id = $this->input->post('editcash_bank');
        $edititem_name = $this->input->post('edititemName');
        $edittransrefid = $this->input->post('edittrans_refid');
        $editrctNarration = $this->input->post('editnarration');

$upd_trnsdata = array(
'trans_date'=> $editrctDate,
'account_id' => $editaccount_id,
'trans_amount' => $editrctAmount,
'cr_account_id'=> $editcr_account_id,
'trans_refid' =>$edittransrefid,
'trans_narration' => $editrctNarration);

$this->db->where('id',$id);
$status= $this->db->update('soc_trans_tbl', $upd_trnsdata);
return ($status === true ? true : false);   
}



public function updateContra($id)
{
$finyear=$this->session->userdata('finyear');
        date_default_timezone_set("Asia/Calcutta"); 
        $editpayDate = $this->input->post('editpaydate');
        $editaccNumber = $this->input->post('editaccountNumber');
        $editaccName = $this->input->post('editaccountName');
        $editpayAmount = $this->input->post('editpayment_amt');
        $editcash_bank = $this->input->post('editcash_bank');
        $edititem_name = $this->input->post('edititemName');
        $editpayNarration = $this->input->post('editnarration');
        $edittransrefid = $this->input->post('edittrans_refid');

$upd_trnsdata = array(
'trans_date'=> $editpayDate,
'account_id' => $editcash_bank,
'trans_amount' => $editpayAmount,
'cr_account_id'=> $editaccNumber,
'trans_refid' =>$edittransrefid,
'trans_narration' => $editpayNarration);

$this->db->where('id',$id);
$status= $this->db->update('soc_trans_tbl', $upd_trnsdata);

    
   return ($status === true ? true : false);   

      }




      public function updatePayment($id)
      {
        date_default_timezone_set("Asia/Calcutta"); 
$finyear=$this->session->userdata('finyear');
        $editpayDate = $this->input->post('editpaydate');
        $editaccNumber = $this->input->post('editaccountNumber');
        $editaccName = $this->input->post('editaccountName');
        $editpayAmount = $this->input->post('editpayment_amt');
        $editcash_bank = $this->input->post('editcash_bank');
        $edititem_name = $this->input->post('edititemName');
        $edittransrefid = $this->input->post('edittrans_refid');
        $editpayNarration = $this->input->post('editnarration');

//$rct_id = $this->get_settings_id();

$upd_trnsdata = array(
'trans_date'=> $editpayDate,
'account_id' => $editcash_bank,
'trans_amount' => $editpayAmount,
'cr_account_id'=> $editaccNumber,
'trans_refid' => $edittransrefid,
'trans_narration' => $editpayNarration);

$this->db->where('id',$id);
$status= $this->db->update('soc_trans_tbl', $upd_trnsdata);
return ($status === true ? true : false);   
}



public function deletemem($id)
{
        $delflag=1;

        $upd_array= array('delflag'=>$delflag);
        $this->db->where('id',$id);
        $status = $this->db->update('soc_members_tbl', $upd_array);         
    
   return ($status === true ? true : false);   
}



public function deletedemand($id)
 {
        $delflag=1;

        $upd_array= array('delflag'=>$delflag);
        $this->db->where('id',$id);
        $status = $this->db->update('soc_demandtemp_tbl', $upd_array);         

     
   return ($status === true ? true : false);   

      }

      public function deleteSDiv($id)
      {
        $delflag=1;

        $upd_array= array('delflag'=>$delflag);
        $this->db->where('id',$id);
        $status = $this->db->update('soc_division_tbl', $upd_array);         

     
   return ($status === true ? true : false);   

      }

      public function deleteSec($id)
      {
        $delflag=1;

        $upd_array= array('delflag'=>$delflag);
        $this->db->where('id',$id);
        $status = $this->db->update('soc_section_tbl', $upd_array);         

       return ($status === true ? true : false);   

      }


      public function deleteDsg($id)
      {
        $delflag=1;

        $upd_array= array('delflag'=>$delflag);
        $this->db->where('id',$id);
        $status = $this->db->update('soc_designation_tbl', $upd_array);         

       return ($status === true ? true : false);   

      }


      public function deleteDpt($id)
      {
        $delflag=1;

        $upd_array= array('delflag'=>$delflag);
        $this->db->where('id',$id);
        $status = $this->db->update('soc_department_tbl', $upd_array);         

       return ($status === true ? true : false);   

      }


        public function fetchDemandDatefilter($mmyy=null)
    {
     
        $sql = "SELECT m.*,d.id,d.member_id,d.demand_date,d.thrift_amount,d.principle_amount,d.interest_amount,d.insurance_amount,d.misc_amount,d.month_year,(d.thrift_amount+d.insurance_amount+d.principle_amount+d.interest_amount+d.misc_amount) as total_amount FROM soc_demandtemp_tbl d,soc_members_tbl m WHERE m.member_id=d.member_id and d.delflag=0 and d.month_year=?";


         // WHERE  receipt_date>= %?% and  receipt_date<= %?% ORDER BY  receipt_date asc receipt_number asc";

        $query = $this->db->query($sql, array($mmyy));
        return $query->result_array();
    }

       public function fetchJournalSubData($trans_ref)
       {
        $sql = "SELECT * FROM soc_itemtrans_tbl WHERE trans_ref=?";
        $query = $this->db->query($sql, array($trans_ref));
        return $query->result_array();
       }

        public function fetchJournalAllData($stDt=null,$enDt=null)
    {
     
       
        
        $sql = "SELECT * FROM soc_journalentry_tbl where journal_date>=? and journal_date<=?";
        $query = $this->db->query($sql,array($stDt,$enDt));
        return $query->result_array();
    }

        public function fetchPaymentAllData()
    {
     
         $finyear=$this->session->userdata('finyear');
        $sql = "SELECT p.id,p.payment_number,p.payment_date,p.account_id,p.account_name,p.payment_amount,p.narration,l.account_name as 
        `cash_bank` FROM soc_trans_tbl p, soc_ledgermaster_tbl l where p.cash_bank=l.id and p.delflag=0 and fyear=?  ORDER BY p.id DESC";

         $query = $this->db->query($sql,array($finyear));
        return $query->result_array();
    }

       public function fetchContraAllData()
    {
     $finyear=$this->session->userdata('finyear');
         
        $sql = "SELECT * FROM soc_trans_tbl where delflag=0 and fyear=?  ORDER BY id DESC";

         $query = $this->db->query($sql,array($finyear));
        return $query->result_array();
    }

        public function fetchReceiptAllData()
    {
     
       
        
        $sql = "SELECT r.id, r.receipt_number,r.receipt_date,r.account_id,r.account_name,r.receipt_amount,r.narration,l.account_name as 
        `cash_bank`  FROM soc_receipt_tbl r, soc_ledgermaster_tbl l where r.cash_bank=l.id and r.delflag=0 ORDER BY r.id DESC";


         // WHERE  receipt_date>= %?% and  receipt_date<= %?% ORDER BY  receipt_date asc receipt_number asc";

        //$query = $this->db->query($sql, array($cid,$stDt,$enDt));
        
         $query = $this->db->query($sql);
        //$query = $this->db->query($sql, array($stDt,$enDt,$compId));
        //$this->output->enable_profiler(TRUE); 
        return $query->result_array();
    }

public function get_combo($cflag=null)
{
      $sql = "SELECT * FROM fatherspouse_tbl where common_flag=?";
        $query=$this->db->query($sql,array($cflag));
        return $query->result_array();

}

        public function getMembers_data()
    {
     
        $sql = "SELECT * FROM soc_members_tbl where delflag=0";
        $query=$this->db->query($sql);
        return $query->result_array();
    }

        public function getMembers_dataById($memid=null)
    {
     
        $sql = "SELECT * FROM soc_members_tbl where member_id=? and delflag=0";
        $query=$this->db->query($sql,array($memid));
        return $query->result_array();
    }


    public function update_demand($params)
    {
        date_default_timezone_set("Asia/Calcutta"); 
//print_r($dmdata);
        $x=0;
       $id=$params['id'];

        $update_demand_data = array('thrift_amount'=>$params['edit_thrift'],
            'principle_amount'=>$params['edit_principle'],
            'interest_amount' =>$params['edit_interest'],
            'insurance_amount' => $params['edit_insurance'],
            'misc_amount' => $params['edit_misc']);

   //var_dump($params);


         $this->db->where('id',$id );
         $status = $this->db->update('soc_demandtemp_tbl', $update_demand_data);         

     
   return ($status === true ? true : false);   
     }

public function getRctSubAllData($memid=null,$divid=null,$rec_id=null,$finyear=null,$sqry=null)
{
  $sql="SELECT rv.member_id,rv.mmyyyy,rv.division_id,m.member_name, " . $sqry . "  FROM 
soc_recovery_2021_tbl rv, soc_members_tbl m WHERE rv.member_id=m.member_id and rv.db_cr='RV' and sflag='R' and record_link_id=?  and rv.fyear=? and rv.division_id=? and rv.member_id=? GROUP BY rv.member_id";
  $query = $this->db->query($sql,array($rec_id,$finyear,$divid,$memid));
 // $this->output->enable_profiler(TRUE);
 return $query->result_array();

}


public function getRctRcvData($rec_id=null,$finyear=null,$sqry=null)
{
  $sql="SELECT rv.member_id,rv.mmyyyy,rv.division_id, " . $sqry . "  FROM 
soc_recovery_2021_tbl rv WHERE  rv.db_cr='RJ' and sflag='R' and record_link_id=?  and rv.fyear=?  GROUP BY rv.member_id";
  $query = $this->db->query($sql,array($rec_id,$finyear));
 // $this->output->enable_profiler(TRUE);
 return $query->result_array();

}


public function getDmdSubAllData($divid=null,$rec_id=null,$finyear=null,$sqry=null)
{
  $sql="SELECT dm.id,dm.member_id,dm.mmyyyy,dm.div_id,m.member_name, " . $sqry . "  FROM soc_demand_2021_tbl dm, soc_members_tbl m WHERE dm.member_id=m.member_id and dm.dmdmain_id=?  and dm.fyear=? and dm.div_id=? GROUP BY dm.member_id";
  $query = $this->db->query($sql,array($rec_id,$finyear,$divid));
 return $query->result_array();

}



public function getDmdCount($rid=null,$finyear=null)
{
$sql = "SELECT * FROM soc_demand_2021_tbl WHERE dmdmain_id=? and fyear=? group by member_id";
$query=$this->db->query($sql,array($rid,$finyear));
return $query->num_rows();
}



public function getMemCount($rid=null,$finyear=null)
{
$sql = "SELECT * FROM soc_recovery_2021_tbl WHERE record_link_id=? and fyear=? group by member_id";
$query=$this->db->query($sql,array($rid,$finyear));
return $query->num_rows();
}

public function getRctSubData($rec_id=null,$finyear=null)
{
  $sql="SELECT SUM(CASE WHEN record_link_id=? and db_cr='RV' THEN trans_amount ELSE 0 END)`tot_amt` FROM soc_recovery_2021_tbl WHERE db_cr='RV' and record_link_id=? and fyear=?";

  //$sql="SELECT count(id)`cnt`,SUM(CASE WHEN record_link_id=? and db_cr='RV' THEN trans_amount ELSE 0 END)`tot_amt` FROM soc_recovery_2021_tbl WHERE db_cr='RV' and record_link_id=?  and fyear=? ";
          $query = $this->db->query($sql,array($rec_id,$rec_id,$finyear));
 //$this->output->enable_profiler(TRUE);
        return $query->result_array();     

}


public function getDRctSubData($rec_id=null,$finyear=null)
{
  $sql="SELECT SUM(CASE WHEN record_link_id=? and db_cr='RJ' THEN trans_amount ELSE 0 END)`tot_amt` FROM soc_recovery_2021_tbl WHERE db_cr='RJ' and record_link_id=? and fyear=?";

  //$sql="SELECT count(id)`cnt`,SUM(CASE WHEN record_link_id=? and db_cr='RV' THEN trans_amount ELSE 0 END)`tot_amt` FROM soc_recovery_2021_tbl WHERE db_cr='RV' and record_link_id=?  and fyear=? ";
          $query = $this->db->query($sql,array($rec_id,$rec_id,$finyear));
 //$this->output->enable_profiler(TRUE);
        return $query->result_array();     

}


public function getDmdSubData($divid=null,$rec_id=null,$finyear=null)
{
  $sql="SELECT count(id)/4 `cnt`,SUM(CASE WHEN dmdmain_id=? THEN trans_amount ELSE 0 END)`tot_amt` FROM soc_demand_2021_tbl WHERE div_id=? and dmdmain_id=?  and fyear=? ";
          $query = $this->db->query($sql,array($rec_id,$divid,$rec_id,$finyear));
 //$this->output->enable_profiler(TRUE);
        return $query->result_array();     

}


public function getMainReceiptData($id=null,$dmf=null)
{
  $sql="SELECT * FROM soc_receipt_2021_tbl where id=? AND dm_flag=?";
  $query=$this->db->query($sql,array($id,$dmf));
  return $query->result_array();
}



public function getMainDataDmd($id)
{
  $sql="select * from soc_demandmain_tbl where id=?";
  $query=$this->db->query($sql,array($id));
  return $query->result_array();
}


public function getRctMain($finyear=null,$dmf=null)
{
  $sql="SELECT * FROM `soc_receipt_2021_tbl` WHERE fyear=? AND dm_flag=?";
  $query = $this->db->query($sql,array($finyear,$dmf));
 //$this->output->enable_profiler(TRUE);
        return $query->result_array();     

}


public function getDmdMain($finyear=null)
{
  $sql="SELECT dmd.id, dmd.div_id,d.division_name,dmd.demand_date,dmd.mmyyyy,dmd.fyear,dmd.createdon FROM `soc_demandmain_tbl` dmd,soc_division_tbl d WHERE d.id=dmd.div_id and dmd.fyear=?";
        $query = $this->db->query($sql,array($finyear));
 //$this->output->enable_profiler(TRUE);
        return $query->result_array();     

}

public function ins_receipt($data)
{
   $this->db->insert('soc_receipt_2021_tbl', $data);
   $insert_id = $this->db->insert_id();

   return  $insert_id;

}
  
public function ins_dmdmain($data){
   $this->db->insert('soc_demandmain_tbl', $data);
   $insert_id = $this->db->insert_id();

   return  $insert_id;
}

    public function insertDemand($fdt = null, $edt=null, $dmdata=null, $mmyy=null)
    {
        date_default_timezone_set("Asia/Calcutta"); 
//print_r($dmdata);
        $x=0;
//var_dump($dmdata);
      //  for($x = 0; $x <= count($dmdata)-1; $x++) {
               
               $ins_demand_data=array();

$data = json_encode($dmdata);
//print_r($data);
foreach($dmdata as $key => $row) {
    //Build multiple insert query 
    $query .= "INSERT INTO `soc_demandtemp_tbl` set 
          `member_id`  = '".$row['member_id']."',
          `demand_date`  = '".$edt."', 
          `thrift_amount`   = ".$row[$x]["thrift"].",
          `principle_amount` = ".$row[$x]["principle"].", 
          `interest_amount`    = ".$row[$x]["interest"].",
          `month_year`    = '".$mmyy."';";
$x++;
}

//print_r($query);
//print_r(json_encode($ins_demand_data));
    //     $status = $this->db->query($query);         
                 
                    
        
   return ($status === true ? true : false);   
     }




    public function insertMDemand()
    {
        date_default_timezone_set("Asia/Calcutta"); 
$x=0;

$dDate = $this->input->post('demanddate');
$dmemberNumber=$this->input->post('memberNumber');
$dmemberName=$this->input->post('membername');

$thrift =$this->input->post('thrift_amt');
$insurance =$this->input->post('insurance_amt');
$interest =$this->input->post('interest_amt');
$principle =$this->input->post('principle_amt');
$misc =$this->input->post('misc_amt');




$dmd_date = strtotime($dDate);
$mmyy = date('mY', $dmd_date);

/*
$tableRow = $this->input->post('tableRow');
//$_POST['tableRow'];
foreach($tableRow as $row){
    //echo $row['dataName'].' '.$row['status'].'<br/>';
  print_r($row);
}
*/



$ins_demand_data=array('demand_date'=>$dDate,'member_id'=>$dmemberNumber,'thrift_amount'=>$thrift,'principle_amount'=>$principle,'interest_amount'=>$interest,'insurance_amount'=>$insurance,'misc_amount'=>$misc,'month_year'=> $mmyy);


       $status = $this->db->insert('soc_demandtemp_tbl', $ins_demand_data);         

        
   return ($status === true ? true : false);   
     }





public function get_smssettings()
{
   $delflag=0;
       $sql = "SELECT * FROM soc_sms_settings_tbl where setdefault=1 and  delflag =?";
        $query = $this->db->query($sql,array($delflag));
        return $query->result_array();     
  
}

  //-- get single user info
    function get_smstemplatebyid($id){
   $delflag=0;
       $sql = "SELECT * FROM soc_smstemplates_tbl where id=? and delflag =?";
        $query = $this->db->query($sql,array($id,$delflag));
        return $query->result_array();     
    }


public function get_noticeboard()
{
  $delflag=0;
       $sql = "SELECT * FROM soc_events_tbl where delflag=" . $delflag;
        $query = $this->db->query($sql);
        return $query->result_array();     

}

public function get_smsmsgData()
{
  $delflag=0;
       $sql = "SELECT * FROM soc_smsdata_tbl where sms_status=0";
        $query = $this->db->query($sql);
        return $query->result_array();     

}


public function get_smsdata($fdate,$tdate)
{
  $delflag=0;
  
       
  $sql = "SELECT * FROM soc_smsdata_tbl  where  sms_date>=? and sms_date<=?";
        $query = $this->db->query($sql,array($fdate,$tdate));
      
         return $query->result_array();     
}



public function get_smstemplates()
{
  $delflag=0;
       $sql = "SELECT * FROM soc_smstemplates_tbl where delflag=" . $delflag;
        $query = $this->db->query($sql);
        return $query->result_array();     

}


    //-- select function
   public function get_members($memid = null){
         $sql = "SELECT * FROM soc_members_tbl where member_id=?";
        $query = $this->db->query($sql,array($memid));
//       print_r($query);
        return $query->result_array();     
    }


function insertSmsDb()
{
        $mobileNumber= $this->input->post('mobilenumbers');// $params['to']; /*Separate mobile no with commas */
        $message= $this->input->post('message_text');// $params['message']; /* message */

$exp_mobileno= explode(',', $mobileNumber);

$length = count($exp_mobileno);
//var_dump($length);
foreach ($exp_mobileno as $value) {
   # code...
 
$ins_sms = array('sms_to'=>$value,'sms_text'=> $message,'sms_date'=>date('Y-m-d'));
 $status = $this->db->insert('soc_smsdata_tbl', $ins_sms);
 
}
//var_dump($ins_sms);
return ($status === true ? true : false);   

}
    

public function insertCJournal($data=null)
    {


$jv_id = $this->get_settings_id();

foreach ($jv_id as $key => $row) {
  $jvid = $row['journal_id'];
  $jvNum = $row['journal_prefix'] . $jvid . '/' . $row['year'];
}

        //Application Data
        date_default_timezone_set("Asia/Calcutta"); 
       // $jvNum = $this->input->post('journal_id');
    $jvDate=date("Y-m-d", strtotime($this->input->post('jvdate')));

        //$jvDate = $this->input->post('jvdate');

    $data_ins = array();
                        $j_id = $jvNum;
                        $j_dt = $jvDate;

$jvnar = $this->input->post('jvnarration');


                    for($x = 0; $x <= count($this->input->post('transamount'))-1; $x++) {
                        //echo count($this->input->post('itemamount'));
                       // echo $x;
                        $dbcr = $this->input->post('dbcr')[$x];
                        if($dbcr=="CR"){
                          $cracc_id = $this->input->post('accountname')[$x];
                        }

}



                    for($x = 0; $x <= count($this->input->post('transamount'))-1; $x++) {
                        //echo count($this->input->post('itemamount'));
                       // echo $x;
                        $dbcr = $this->input->post('dbcr')[$x];

                        $acc_id = $this->input->post('accountname')[$x];
                        $trnamt = $this->input->post('transamount')[$x];

$getdiv_id = $this->get_DivId($acc_id);
if($getdiv_id)
{
 foreach ($getdiv_id as $key => $dvalue) {
   $div_id = $dvalue["division_id"];
 }
}
else {
  $getdiv_id = $this->get_DivId($cracc_id);
  if($getdiv_id)
  {
  foreach ($getdiv_id as $key => $dvalue) {
  $div_id = $dvalue["division_id"];
  }
}
else {
  $div_id="0";
}
}

$finyear=$this->session->userdata('finyear');
if($dbcr=="DB") {       
$data_ins[] = array("db_cr"=> $dbcr,"trans_type"=>"JOUR","cr_account_id"=> $cracc_id,"account_id"=>$acc_id,"trans_amount"=>$trnamt,"trans_id"=>$j_id,"trans_date"=>$j_dt,"trans_narration"=>$jvnar,"division_id"=>$div_id,"fyear"=>$finyear);
}


}


//print_r($data_ins);
        //$status= $this->db->insert('soc_trans_tbl', $data_ins);
$status =$this->db->insert_batch("soc_trans_tbl", $data_ins);

$nxtjv=$jvid+1;
        
       $finyear=$this->session->userdata('finyear'); 

        //$next_invno = sprintf("%03d", $nxtInvno);
        $update_jv = array('journal_id'=>$nxtjv);
            
        $this->db->where('fyear', $finyear);
        $status =    $this->db->update('soc_settings_tbl', $update_jv);     
        return ($status === true ? true : false);   

}


function get_DivId($acid)
{
 $sql="select * from soc_members_tbl where member_id=?";
 $query = $this->db->query($sql,array($acid));
//print_r($query);
return $query->result_array();

}




    public function insertJournal($data=null)
    {


$jv_id = $this->get_settings_id();

foreach ($jv_id as $key => $row) {
  $jvid = $row['journal_id'];
  $jvNum = $row['journal_prefix'] . $jvid . '/' . $row['year'];
}

        //Application Data
        date_default_timezone_set("Asia/Calcutta"); 
       // $jvNum = $this->input->post('journal_id');
        $jvDate = $this->input->post('journal_date');
$sampleDate = '2019-01-02';
$lastmonth = date("Y-m-d", strtotime("-1 months"));
$mm_yy =date('Y-m-d', strtotime(str_replace('-','/', $lastmonth)));// date("Y-m-d", strtotime("-1 months", $ejdate));

//$mm_yy =date('Y-m-d', strtotime(str_replace('-','/', $jvDate)));// date("Y-m-d", strtotime("-1 months", $ejdate));
$mmyy = date("mY", strtotime("- months",$mm_yy));

//$mmyy = date("mY", strtotime($jvDate));

  
        $debitaccNumber = $this->input->post('debitaccountNumber');
        $debitaccName = $this->input->post('debitaccountName');
        $debitAmount = $this->input->post('debit_amt');

        $creditaccNumber = $this->input->post('creditaccountNumber');
        $creditaccName = $this->input->post('creditaccountName');
        $creditAmount = $this->input->post('credit_amt');

        $creditmemberNumber = $this->input->post('creditmemberNumber');
        $jvNarration = $this->input->post('jvnarration');

        if($debitAmount!=0){
            $dc = "D";          
        }

        if($creditAmount!=0){
            $dc = "C";          
        }
    

  $insert_jvTbl = array('journal_number' => $jvNum,
    'journal_date' => $jvDate,
  'debitaccount_number'  => $debitaccNumber,
  'debit_accountname' => $debitaccName,
  'debit_amount' => $debitAmount,

  'creditaccount_number'  => $creditaccNumber,
  'credit_accountname' => $creditaccName,
  'credit_amount' => $creditAmount,
  'journal_narration' => $jvNarration
  );

        $status= $this->db->insert('soc_journalentry_tbl', $insert_jvTbl);
        $jv_tbl_id = $this->db->insert_id();           

        for($x = 0; $x <= count($this->input->post('itemamount'))-1; $x++) {
                        //echo count($this->input->post('itemamount'));
                       // echo $x;
                        $itmamt = $this->input->post('itemamount')[$x];

                        $itmnm = $this->input->post('itemname')[$x];


                     $update_item_data = array(
                        'item_id' => $this->input->post('itemid')[$x],
                            'item_name'  => $this->input->post('itemname')[$x],
                            'trans_amount' => $itmamt, //$this->input->post('itemamount')[$x],
                            'trans_ref' => $jvNum,
                            'trans_refid' => $jv_tbl_id,
                            'trans_date' => $jvDate,
                            'trans_type' => "JOUR",
                            'cash_bank' => $debitaccNumber,
                            'account_id'  => $creditaccNumber,
                            'account_name' => $creditaccName,
                            'mmyy' => $mmyy
                        );
                  // echo $update_item_data;
                        $status = $this->db->insert('soc_itemtrans_tbl', $update_item_data);
                    }

                            
            


$insert_trabsactionTbl = array(
  'trans_refid' => $jv_tbl_id,
'trans_ref' => $jvNum,
    'trans_date' => $jvDate,
    'trans_type' => "JOURNAL",
  'account_id'  => $debitaccNumber,
  'account_name' => $debitaccName,
  'trans_amount' => $debitAmount,
  'cash_bank' => $creditaccName,
  'cash_bank_id' => $creditaccNumber,
  'trans_remarks' => $jvNarration
);
       //$status= $this->db->insert('soc_transaction_tbl', $insert_trabsactionTbl);
         
        
      //  $currJv = explode('/', $jvNum); //$this->input->post('appnNumber');

        $nxtjv=$jvid+1;
        
        

        //$next_invno = sprintf("%03d", $nxtInvno);
        $update_jv = array('journal_id'=>$nxtjv);
        $finyear=$this->session->userdata('finyear');    
            $this->db->where('fyear', $finyear);
            $this->db->update('soc_settings_tbl', $update_jv);     
        return ($status === true ? true : false);   
        
    }
    

    
    public function insertofficenote()
    {
        //Application Data
        date_default_timezone_set("Asia/Calcutta"); 
        $offnoteNum = $this->input->post('officenote_id');
        $offnoteDate = $this->input->post('officenote_date');
        $loanappid = $this->input->post('loanappn_id');
        $b_memberid = $this->input->post('bmember_id');
    //    $b_membername = $this->input->post('bmember_name');
        $s_memberid = $this->input->post('smember_id');
     //   $s_membername = $this->input->post('smember_name');
        $res_id = $this->input->post('resolution_number');
        $res_date = $this->input->post('resolution_date');
        $chq_number = $this->input->post('cheque_number');
        $chq_date = $this->input->post('cheque_date');
        $chq_name = $this->input->post('cheque_name');
        $r_words = $this->input->post('rupees_words');
        $sts = $this->input->post('ofstatus');

$ofdata = array();
$data = array();
$ofdata = $this->input->post('duetoamount');

        for($rw = 0; $rw <= count($this->input->post('duetoamount'))-1; $rw++) {
            $data[] = $this->input->post('duetoamount')[$rw];
         }            

        $mt_lout = $data[0];
        $mt_lint = $data[1];
        $mshr_cap = $data[2];
        $sshr_cap = $data[3];
        $fxd_dep = $data[4];
        $drs_dep = $data[5];
        $oth_amt = $data[6];
        $tot_due = $mt_lout+$mt_lint+$mshr_cap+$sshr_cap+$fxd_dep+$drs_dep+$oth_amt;


        $amt_sanctioned = $this->input->post('amt_sanctioned');
        $roi_pc = $this->input->post('roi_pc');
        $amt_dueadj = $tot_due;
        $bal_amt = $amt_sanctioned-$tot_due;

$finyear=$this->session->userdata('finyear');


  $insert_officenoteTbl = array('officenote_id' => $offnoteNum,
    'onote_date' => $offnoteDate,
  'loan_appno'  => $loanappid,
  'member_id' => $b_memberid,
  //'member_name' => $b_membername,
  'sur_member_id' => $s_memberid,  
  //'sur_member_name' => $s_membername,
  'loan_sanctioned' => $amt_sanctioned,
  'roi_pc' => $roi_pc,
  'res_number' => $res_id,
  'res_date' => $res_date,
  'amount_adjusted' => $amt_dueadj,
  'mt_loanoutstanding' => $mt_lout,
  'mt_loaninterest' => $mt_lint,
  'mt_sharecapital' => $mshr_cap,
  'sur_sharecapital' => $sshr_cap,
  'fxd_deposit' => $fxd_dep,
  'drs_deposit' => $drs_dep,
  'other_amount' => $oth_amt,
  'chq_amt' => $bal_amt,
  'chq_issued' => $chq_name,
  'chq_no' => $chq_number,
  'chq_date' => $chq_date,
  'amt_inrupees' => $r_words,
  'status' => $sts,
  'fyear' =>$finyear
  );

$upd_of_sts = array('status'=>$sts);
            $this->db->where('officenote_id',$offnoteNum);
            $this->db->where('fyear',$finyear);
            $this->db->update('soc_officenote_trans_tbl',$upd_of_sts);


$upd_ln_sts = array('app_status'=>$sts);
            $this->db->where('app_number',$loanappid);
            $this->db->where('fyear',$finyear);
            $this->db->update('soc_loanapplication_tbl',$upd_ln_sts);

$sett = $this->get_settings_id();
     foreach ($sett as $key=> $row)
       {
        $officenote_id = $row['officenote_id'] . '/' . $row['year'];
        $jv_id = $row['journal_id'] . '/' . $row['year'];

       }

 $memberid = $this->get_ldgAccById($b_memberid);
 
     foreach ($memberid as $key=> $row)
       {
        $debit_id = $row['id'];
        $debit_name = $row['account_name'];
       }

 $loanaccid="9";
 $loanaccname = "LOAN ACCOUNT";    
 $narr = 'LOAN BALANCE DUE ADJUSTED THROUGH BY OFFICE NOTE REF #' . $offnoteNum . '/ Dated :' . $offnoteDate;


$ins_jv = array('journal_number'=>$jv_id,'journal_date'=>$offnoteDate,'debitaccount_number'=>$debit_id, 'debit_accountname'=>$debit_name,'debit_amount'=> $amt_dueadj,'creditaccount_number'=>$loanaccid,'credit_accountname'=> $loanaccname,'credit_amount'=>$amt_dueadj,'journal_narration'=> $narr);





$update_memberTbl = array('surety_id'=>$s_memberid,'share_capital'=>$mshr_cap,
    'loan_amount'=>$amt_sanctioned,'rate_of_interest'=>$roi_pc,'loan_outstanding'=>$amt_sanctioned);
            


        $update_surmemberTbl = array('share_capital'=>$sshr_cap);
            
        $status= $this->db->insert('soc_officenote_trans_tbl', $insert_officenoteTbl);
     //   $status= $this->db->insert('soc_journalentry_tbl', $ins_jv);

        $offnote_tbl_id = $this->db->insert_id();           


       
        $currJVid = explode('/', $jv_id); //$this->input->post('appnNumber');

        $nxtjvId=$currJVid[0]+1;
        

         
        
        $currOffnoteid = explode('/', $offnoteNum); //$this->input->post('appnNumber');

        $nxtId=$currOffnoteid[0]+1;
        


        //$next_invno = sprintf("%03d", $nxtInvno);
        $update_offnote = array('officenote_id'=>$nxtId);
            



$finyear=$this->session->userdata('finyear');

            $this->db->where('fyear', $finyear);
            $this->db->update('soc_settings_tbl', $update_offnote);
            $this->db->where('member_id',$b_memberid);
            $this->db->update('soc_members_tbl',$update_memberTbl);


            $this->db->where('member_id',$s_memberid);
            $this->db->update('soc_members_tbl',$update_surmemberTbl);





$sett = $this->get_settings_id();
     foreach ($sett as $key=> $row)
       {
        $officenote_id = $row['officenote_id'] . '/' . $row['year'];
        $jv_id = $row['journal_id'] . '/' . $row['year'];

       }

 $memberid = $this->get_ldgAccById($b_memberid);
 
     foreach ($memberid as $key=> $row)
       {
        $debit_id = $row['id'];
        $debit_name = $row['account_name'];
       }
$finyear=$this->session->userdata('finyear');

 $loanaccid="9";
 $loanaccname = "LOAN ACCOUNT";    
 $narr = 'LOAN RENEWED THROUGH BY OFFICE NOTE REF #' . $offnoteNum . '/ Dated :' . $offnoteDate;


$ins_lnjv = array('journal_number'=>$jv_id,'journal_date'=>$offnoteDate,'creditaccount_number'=>$debit_id, 'credit_accountname'=>$debit_name,'debit_amount'=> $amt_sanctioned,'debitaccount_number'=>$loanaccid,'debit_accountname'=> $loanaccname,'credit_amount'=>$amt_sanctioned,'journal_narration'=> $narr);

$status= $this->db->insert('soc_journalentry_tbl', $ins_lnjv);


        $currJVid = explode('/', $jv_id); //$this->input->post('appnNumber');

        $nxtjvId=$currJVid[0]+1;
        
        $update_sett = array('journal_id'=>$nxtjvId);
            





            $this->db->where('fyear', $finyear);
        
            $this->db->update('soc_settings_tbl', $update_sett);




        return ($status === true ? true : false);   
  


    }
    

    function get_statuslist() {
        $this->db->select();
        $this->db->from('status_tbl');
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;

    }    

    function get_all_loanapplications(){
        $this->db->select('l.*');
        //$this->db->select('c.name as country, c.id as country_id');
        $this->db->from('soc_loanapplication_tbl l');
        //$this->db->join('country c','c.id = o.country','LEFT');
        $this->db->order_by('l.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }



    public function insertReceipt()
    {
        //Application Data
        date_default_timezone_set("Asia/Calcutta"); 
        
        $rctDate = date("Y-m-d", strtotime($this->input->post('recdate')));
        $accNumber = $this->input->post('accountNumber');
        $accName = $this->input->post('accountName');
        $rctAmount = $this->input->post('receipt_amt');
        $cash_bank = $this->input->post('cash_bank');
        $item_name = $this->input->post('itemName');
        $transrefid = $this->input->post('trans_refid');
        $rctNarration = $this->input->post('narration');

$rct_id = $this->get_settings_id();

foreach ($rct_id as $key => $row) {
  $rctid = $row['receipt_id'];
  $rctNum = $row['receipt_prefix'] . $rctid . '/' . $row['year'];
}
           
    //   $status= $this->db->insert('soc_receipt_tbl', $insert_receiptTbl);
        //$rct_tbl_id = $this->db->insert_id();           

$div_id="0";
$getdiv_id = $this->get_DivId($accNumber);
if($getdiv_id)
{
 foreach ($getdiv_id as $key => $dvalue) {
   $div_id = $dvalue["division_id"];
 }
}
else {
  $getdiv_id = $this->get_DivId($cash_bank);
  foreach ($getdiv_id as $key => $dvalue) {
  $div_id = $dvalue["division_id"];
  }
}
$finyear=$this->session->userdata('finyear');
         
$insert_trabsactionTbl = array(
'trans_id'=> $rctNum,
//'trans_ref' => $rctNum,
    'trans_date' => $rctDate,
    'trans_type' => "RCPT",
    'db_cr' => 'DB',
    'division_id'=> $div_id,
  'account_id'  => $cash_bank,
  //'account_name' => $accName,
  'trans_amount' => $rctAmount,
  //'cash_bank' => $item_name,
  'cr_account_id' => $accNumber,
  //'item_name' => $item_name,
  'trans_refid' =>$transrefid,
  'trans_narration' => $rctNarration,
  'fyear' => $finyear
);

            
       $status= $this->db->insert('soc_trans_tbl', $insert_trabsactionTbl);

        
       // $currRct = explode('/', $rctNum); //$this->input->post('appnNumber');

        $nxtRct=$rctid+1;
        


        //$next_invno = sprintf("%03d", $nxtInvno);
        $update_rct = array('receipt_id'=>$nxtRct);
      $finyear=$this->session->userdata('finyear');      
             $this->db->where('fyear', $finyear);
             $this->db->update('soc_settings_tbl', $update_rct);     
        return ($status === true ? true : false);   
        
    }
    




    public function insertPayment()
    {
        //Application Data
        date_default_timezone_set("Asia/Calcutta"); 
       // $payNum = $this->input->post('payment_id');
        $payDate = date("Y-m-d", strtotime($this->input->post('paydate')));
        $accNumber = $this->input->post('accountNumber');
        $accName = $this->input->post('accountName');
        $payAmount = $this->input->post('payment_amt');
        $cash_bank = $this->input->post('cash_bank');
        $item_name = $this->input->post('itemName');
        $transrefid = $this->input->post('trans_refid');
        $payNarration = $this->input->post('narration');
        $chq_ref = $this->input->post('chequeNumber') ;
        $bank_detail = $this->input->post('chequeNumber');
        $trans_type = $this->input->post('tr_type');

$pay_id = $this->get_settings_id();

foreach ($pay_id as $key => $row) {
  $payid = $row['payment_id'];
  $payNum = $row['payment_prefix'] . $payid . '/' . $row['year'];
}


                 $memData = $this->getCashBankName($accNumber);
               //print_r($memData);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }

$finyear=$this->session->userdata('finyear');
 $insert_transactionTbl=array("db_cr"=> "DB","trans_type"=> $trans_type,"cheque_ref"=>$chq_ref . "/" . $bank_detail ,"cr_account_id"=> $accNumber,"account_id"=>$cash_bank,"trans_amount"=>$payAmount,"division_id"=>$divid, "trans_id"=>$payNum,"trans_date"=>$payDate,"trans_refid"=>$transrefid, "trans_narration"=> $payNarration,"fyear"=>$finyear);

            
       $status= $this->db->insert('soc_trans_tbl', $insert_transactionTbl);

        $nxtPay=$payid+1;
        


        //$next_invno = sprintf("%03d", $nxtInvno);
        $update_pay= array('payment_id'=>$nxtPay);
$finyear=$this->session->userdata('finyear');            
             $this->db->where('fyear', $finyear);
        
            $this->db->update('soc_settings_tbl', $update_pay);     
        return ($status === true ? true : false);   
        
    }
    


    public function insertLAppn()
    {
      $finyear=$this->session->userdata('finyear');
        //Application Data
        date_default_timezone_set("Asia/Calcutta"); 
        $appNum = $this->input->post('appNumber');
        $mName = $this->input->post('memName');
        $mNumber = $this->input->post('memberNumber');
        $smName = $this->input->post('smemName');
        $smNumber = $this->input->post('smemberNumber');
        $mDob = $this->input->post('dob');
        $mFahuName = $this->input->post('fahuName');
        $mLoanAmt = $this->input->post('loanAmt');
        $mLoanPurpose = $this->input->post('loanPurpose');
        $mLoanRepay = $this->input->post('loanRepay');
        $mLoanInstallment = $this->input->post('loanInstallment');
        $mDesg = $this->input->post('designation');
        //$mDor = $this->input->post('dor');

        $moffStreet = $this->input->post('offStreet');
        $moffCity = $this->input->post('offCity');
        $moffState = $this->input->post('offState');
        $moffPincode = $this->input->post('offPincode');
        $aDor = $this->input->post('dor');
        $roi = $this->input->post('roi');
        //$aStatus = $this->input->post('')


//Payslip Data
//Earnings
     $mBasic = $this->input->post('baspay');
     $mDa = $this->input->post('da');
     $mHra = $this->input->post('hra');
     $mSplpay = $this->input->post('splpay');
     $mIr = $this->input->post('irpay');
     $mMa = $this->input->post('mapay');
//Deductions     
     $mGpfsub = $this->input->post('gpfsub');
     $mGpfloan = $this->input->post('gpfloan');
     $mfbs = $this->input->post('fbs');
     $mFa = $this->input->post('fa');
     $mHba = $this->input->post('hba');
     $mCa = $this->input->post('ca');
     $mSocrec = $this->input->post('socrec');
     $mLic = $this->input->post('lic');
     $mOther = $this->input->post('other');

     $mTotErn = $this->input->post('totern');
     $mTotDed = $this->input->post('totded');
     $mNetPay = $this->input->post('netpay');



  $insert_loanappnTbl = array('app_number' => $appNum,
  'member_id'  => $mNumber,
  'member_name' => $mName,
  //'surety_number'  => $smNumber,
  //'surety_name' => $smName,

  'member_fahuname' => $mFahuName,
  //'fh_flag'  => $fh_flag,
  'member_dob'  => $mDob,
  'loan_amount'  => $mLoanAmt,
  'loan_purpose'  =>$mLoanPurpose,
  'repay_period'  =>$mLoanRepay,
  'installment_amount'  =>$mLoanInstallment,
  'designation_id'  =>$mDesg,
  'off_address'  => $moffStreet,
  'off_state'  => $moffState,
  'off_city'  =>$moffCity,
  'off_pincode'  =>$moffPincode,
  'roi'=> $roi,
  //'contact_number' => varchar(20) NOT NULL,
  'basic_amt'  =>$mBasic,
  'da_amt'  => $mDa,
  'hra_amt'  =>$mHra,
  'splpay_amt' => $mSplpay,
  'ir_amt'  => $mIr,
  'ma_amt'  =>$mMa,
  'gpfsub_amt' => $mGpfsub,
  'gpfloan_amt' => $mGpfloan,
  'fbs_amt' => $mfbs,
  'fa_amt'  =>$mFa,
  'hba_amt' => $mHba,
  'ca_amt'  =>$mCa,
  'lic_amt' => $mLic,
  'socrec_amt' => $mSocrec,
  'other_amt' => $mOther,
  'earn_amt' => $mTotErn,
  'ded_amt' => $mTotDed,
  'net_amt' => $mNetPay,
'fyear'=>$fyear);
  //'dor' => $mDor);

//print_r($insert_loanappnTbl);
            
       $status= $this->db->insert('soc_loanapplication_tbl', $insert_loanappnTbl);
        $lappn_tbl_id = $this->db->insert_id();           
         
        
        $currAppno = explode('/', $appNum); //$this->input->post('appnNumber');

        $nxtAppno=$currAppno[0]+1;
        


        //$next_invno = sprintf("%03d", $nxtInvno);
        $update_appno = array('app_number'=>$nxtAppno);
            
         $this->db->where('fyear', $finyear);
            $this->db->update('soc_settings_tbl', $update_appno);     
        return ($status === true ? true : false);   
        
        //  $this->output->enable_profiler(TRUE);
        
        
    }



 function Phoneselect()
 {
  $this->db->order_by('member_id', 'ASC');
  $query = $this->db->get('soc_members_tbl');
  return $query;
 }




    //-- select function
    function select($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- select by id
    function select_option($id,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 

    //-- check user role power
    function check_power($type){
        $this->db->select('ur.*');
        $this->db->from('user_role ur');
        $this->db->where('ur.user_id', $this->session->userdata('id'));
        $this->db->where('ur.action', $type);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    public function check_email($email){
        $this->db->select('*');
        $this->db->from('soc_user');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }

    public function check_exist_power($id){
        $this->db->select('*');
        $this->db->from('soc_user_power');
        $this->db->where('power_id', $id); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }


    //-- get all power
    function get_all_power($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('power_id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- get logged user info
    function get_user_info(){
        $this->db->select('u.*');
        $this->db->select('c.name as country_name');
        $this->db->from('soc_user u');
        $this->db->join('soc_country c','c.id = u.country','LEFT');
        $this->db->where('u.id',$this->session->userdata('id'));
        $this->db->order_by('u.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- get single user info
    function get_single_user_info($id){
        $this->db->select('u.*');
        $this->db->select('c.name as country_name');
        $this->db->from('soc_user u');
        $this->db->join('soc_country c','c.id = u.country','LEFT');
        $this->db->where('u.id',$id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    //-- get single user info
    function get_user_role($id){
        $this->db->select('ur.*');
        $this->db->from('soc_user_role ur');
        $this->db->where('ur.user_id',$id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }





    //-- get all users with type 2
    function get_all_user(){
        $this->db->select('u.*');
        $this->db->select('c.name as country, c.id as country_id');
        $this->db->from('soc_user u');
        $this->db->join('soc_country c','c.id = u.country','LEFT');
        $this->db->order_by('u.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

function delJournal($id=null)
{
  $this->db->where('id',$id);
 $status = $this->db->delete('soc_trans_tbl');
 return ($status === true ? true : false);  
}

    //-- get all users with type 2
    function get_all_division(){
        $this->db->select('d.*');
        $this->db->select('d.division_name as division, d.id as division_id');
        $this->db->where('delflag',0);
        $this->db->from('soc_division_tbl d');
      //  $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->order_by('d.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


function get_OpBal($fyear=null)
{
  $this->db->select('*');
  $this->db->from('soc_openingbalance_tbl');
  $this->db->where('delflag',0);
  $this->db->where('bank_cash',0);
  $this->db->where('fyear',$fyear);
  $query = $this->db->get();
  $query = $query->result_array();
  return $query;
}

function getOpBal($acid=null,$fyear=null)
{
  $this->db->select('*');
  $this->db->from('soc_openingbalance_tbl');
  $this->db->where('delflag',0);
  $this->db->where('acclink_id',$acid);
  $this->db->where('fyear',$fyear);
  $query = $this->db->get();
  $query = $query->result_array();
  return $query;
}

    function get_all_sdivision(){
        $this->db->select('d.*');
        $this->db->select('d.division_name, d.id');
        $this->db->where('delflag',0);
        $this->db->from('soc_division_tbl d');
      //  $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->order_by('d.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    function get_all_Section(){
        $this->db->select('s.*');
        $this->db->select('s.section_name, s.id');
        $this->db->where('delflag',0);
        $this->db->from('soc_section_tbl s');
      //  $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->order_by('s.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


    function get_all_Member(){
        $this->db->select('m.*');
        $this->db->select('ds.designation');
        $this->db->select('dp.department_name');
        $this->db->select('sc.section_name');
        $this->db->select('dv.division_name');
        $this->db->select('sdv.subdivision_name');
        $this->db->where('m.delflag',0);
        $this->db->from('soc_members_tbl m');
        $this->db->join('soc_designation_tbl ds','m.designation_id = ds.id','LEFT');
        $this->db->join('soc_department_tbl dp','m.dept_id = dp.id','LEFT');
        $this->db->join('soc_section_tbl sc','m.section_id = sc.id','LEFT');
        $this->db->join('soc_division_tbl dv','m.division_id = dv.id','LEFT');
        $this->db->join('soc_subdivision_tbl sdv','m.subdivision_id = sdv.id','LEFT');


        $this->db->order_by('m.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


    function get_all_Designation(){
        $this->db->select('d.*');
        $this->db->select('d.designation, d.id');
        $this->db->where('d.delflag',0);
        $this->db->from('soc_designation_tbl d');
      //  $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->order_by('d.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


    function get_all_Department(){
        $this->db->select('d.*');
        $this->db->select('d.department_name, d.id');
        $this->db->where('d.delflag',0);
        $this->db->from('soc_department_tbl d');
      //  $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->order_by('d.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }



    function get_all_Ledger(){
        $this->db->select('l.*');
       // $this->db->select('l.account_name, l.id');
        $this->db->where('l.delflag',0);
        $this->db->from('soc_ledgermaster_tbl l');
      //  $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->order_by('l.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


public function getAccBal($isBank=null,$accid=null,$fdate=null,$tdate=null,$finyear=null)
{

if($isBank=="1")
{

$sql="SELECT SUM(CASE When (account_id=? and (trans_type='JOUR' or trans_type='RCPT' ) or cr_account_id=? and ( trans_type='CNTR' or trans_type='PYMT') ) Then trans_amount Else 0 End ) as `debit`, SUM(CASE When (cr_account_id=? and (trans_type='JOUR' or trans_type='RCPT' ) or account_id=? and ( trans_type='CNTR' or trans_type='PYMT' ) ) Then trans_amount Else 0 End ) as `credit` FROM `soc_trans_tbl` WHERE (account_id=? or cr_account_id=?) and trans_date>=? and trans_date<=? and fyear=?";
}
else {

$sql="SELECT SUM(CASE When (account_id=? and (trans_type='JOUR' or trans_type='PYMT' ) or cr_account_id=? and ( trans_type='CNTR' or trans_type='RCPT') ) Then trans_amount Else 0 End ) as `debit`, SUM(CASE When (cr_account_id=? and (trans_type='JOUR' or trans_type='PYMT' ) or account_id=? and ( trans_type='CNTR' or trans_type='RCPT' ) ) Then trans_amount Else 0 End ) as `credit` FROM `soc_trans_tbl` WHERE (account_id=? or cr_account_id=?) and trans_date>=? and trans_date<=? and fyear=?";
}


  $query = $this->db->query($sql,array($accid,$accid,$accid,$accid,$accid,$accid,$fdate,$tdate,$finyear));
//$this->output->enable_profiler(TRUE);
  return $query->result_array();
}

public function getBankCash()
{
  $sql="SELECT * from soc_ledgermaster_tbl where delflag=0 and bank_cash<>0 order by acclink_id";
  $query = $this->db->query($sql);
  return $query->result_array();

}

public function getAllLedger()
{
  $sql="SELECT * FROM soc_ledgermaster_tbl where  delflag=0 order by bank_cash DESC, acclink_id";
  $query = $this->db->query($sql);
  return $query->result_array();
}


public function getCashBankName($cbid=null)
{
  $sql="SELECT * FROM soc_ledgermaster_tbl where acclink_id=? and delflag=0";
  $query = $this->db->query($sql,array($cbid));
  return $query->result_array();
}

public function getDcbOpBal($memid=null)
{
  $finyear=$this->session->userdata('finyear');
  $sql = "SELECT share_capital,thrift_opbal,loan_opbal from soc_membersopbal_tbl where member_id=? and delflag=0 and fyear=?";
  $query = $this->db->query($sql,array($memid,$finyear));
  return $query->result_array();
}


public function fetchRecoveryData($thfid=null,$memid=null,$finyear=null)

{
 //$sql="select * from soc_trans_tbl where trans_date>=? and trans_date<=? and account_id=? and cr_account_id=? order by trans_date";
//$finyear=$this->session->userdata('finyear');

if($thfid=="539")
{

 $sql="select SUM(CASE WHEN month(trans_date) = '4' THEN COALESCE(trans_amount,0) END) 'apr', SUM(CASE WHEN month(trans_date) = '5' THEN COALESCE(trans_amount,0) END) 'may', SUM(CASE WHEN month(trans_date) = '6' THEN COALESCE(trans_amount,0) END) 'jun', SUM(CASE WHEN month(trans_date) = '7' THEN COALESCE(trans_amount,0) END) 'jul', SUM(CASE WHEN month(trans_date) = '7' THEN COALESCE(trans_amount,0) END) 'jul', SUM(CASE WHEN month(trans_date) = '8' THEN COALESCE(trans_amount,0) END) 'aug', SUM(CASE WHEN month(trans_date) = '9' THEN COALESCE(trans_amount,0) END) 'sep', SUM(CASE WHEN month(trans_date) = '10' THEN COALESCE(trans_amount,0) END) 'oct', SUM(CASE WHEN month(trans_date) = '11' THEN COALESCE(trans_amount,0) END) 'nov', SUM(CASE WHEN month(trans_date) = '12' THEN COALESCE(trans_amount,0) END) 'dec', SUM(CASE WHEN month(trans_date) = '1' THEN COALESCE(trans_amount,0) END) 'jan', SUM(CASE WHEN month(trans_date) = '2' THEN COALESCE(trans_amount,0) END) 'feb', SUM(CASE WHEN month(trans_date) = '3' THEN COALESCE(trans_amount,0) END) 'mar' from soc_trans_tbl where  (account_id=? or account_id='535')  and cr_account_id=? and fyear=? order by trans_date";
}
else
{

 $sql="select SUM(CASE WHEN month(trans_date) = '4' THEN COALESCE(trans_amount,0) END) 'apr', SUM(CASE WHEN month(trans_date) = '5' THEN COALESCE(trans_amount,0) END) 'may', SUM(CASE WHEN month(trans_date) = '6' THEN COALESCE(trans_amount,0) END) 'jun', SUM(CASE WHEN month(trans_date) = '7' THEN COALESCE(trans_amount,0) END) 'jul', SUM(CASE WHEN month(trans_date) = '7' THEN COALESCE(trans_amount,0) END) 'jul', SUM(CASE WHEN month(trans_date) = '8' THEN COALESCE(trans_amount,0) END) 'aug', SUM(CASE WHEN month(trans_date) = '9' THEN COALESCE(trans_amount,0) END) 'sep', SUM(CASE WHEN month(trans_date) = '10' THEN COALESCE(trans_amount,0) END) 'oct', SUM(CASE WHEN month(trans_date) = '11' THEN COALESCE(trans_amount,0) END) 'nov', SUM(CASE WHEN month(trans_date) = '12' THEN COALESCE(trans_amount,0) END) 'dec', SUM(CASE WHEN month(trans_date) = '1' THEN COALESCE(trans_amount,0) END) 'jan', SUM(CASE WHEN month(trans_date) = '2' THEN COALESCE(trans_amount,0) END) 'feb', SUM(CASE WHEN month(trans_date) = '3' THEN COALESCE(trans_amount,0) END) 'mar' from soc_trans_tbl where account_id=? and cr_account_id=? and fyear=? order by trans_date";
}

 $query = $this->db->query($sql,array($thfid,$memid,$finyear));
 
 return $query->result_array();
}


public function getRC_Data($acctid=null,$fdate=null,$tdate=null)
{
  $finyear=$this->session->userdata('finyear');
 $sql="SELECT t.cr_account_id,t.account_id,t.db_cr,t.trans_date,t.trans_id,t.trans_type,SUM(CASE WHEN t.cr_account_id=?  THEN COALESCE(t.trans_amount,'0') END) 'credit',SUM(CASE WHEN t.account_id=? THEN COALESCE(t.trans_amount,'0') END) 'debit' FROM soc_trans_tbl t WHERE  t.trans_date>=? and t.trans_date<=? and db_cr='DB' and t.fyear=? order by account_id";

  $query = $this->db->query($sql,array($acctid,$acctid,$fdate,$tdate,$finyear));
 // print_r($query);

  return $query->result_array();

}

public function fetchofficenoteDatefilter($fdate=null,$tdate=null,$fyear=null)
{
$sql="select * from soc_officenote_trans_tbl where onote_date>=? and onote_date<=? and fyear=?";
$query = $this->db->query($sql,array($fdate,$tdate,$fyear));
//$this->output->enable_profiler(TRUE);
return $query->result_array();
}

public function ledg_op($acctid=null,$edate=null,$finyear=null)
{
  //$finyear=$this->session->userdata('finyear');
  $sql="SELECT SUM(CASE WHEN t.account_id=?  AND (t.trans_type='JOUR' or t.trans_type='RCPT') THEN COALESCE(t.trans_amount,'0') END) 'op_debit',SUM(CASE WHEN t.cr_account_id=?  AND (t.trans_type='JOUR' or t.trans_type='PYMT') THEN COALESCE(t.trans_amount,'0') END) 'op_credit' FROM soc_trans_tbl t WHERE t.trans_date<? AND t.db_cr='DB' and t.fyear=?";
  $query = $this->db->query($sql,array($acctid,$acctid,$edate,$finyear));
//$this->output->enable_profiler(TRUE);
  return $query->result_array();

}


public function getRec_Data($acctid=null,$memid=null,$finyear=null)
{
  if($memid)
  {
//$finyear=$this->session->userdata('finyear');
  if($acctid=="539")
 {
   $sql="SELECT t.cr_account_id,t.account_id,t.db_cr,t.trans_date,t.trans_id,t.trans_type,SUM(CASE WHEN (t.cr_account_id=? AND (t.account_id=?  or t.account_id='535')) THEN COALESCE(t.trans_amount,'0') END) 'credit',SUM(CASE WHEN (t.account_id=? AND t.cr_account_id=?) THEN COALESCE(t.trans_amount,'0') END) 'debit' FROM soc_trans_tbl t WHERE  t.trans_type='JOUR' and db_cr='DB' and fyear=? order by account_id" ;
 }
else
 {
   $sql="SELECT t.cr_account_id,t.account_id,t.db_cr,t.trans_date,t.trans_id,t.trans_type,SUM(CASE WHEN (t.cr_account_id=? AND t.account_id=?) THEN COALESCE(t.trans_amount,'0') END) 'credit',SUM(CASE WHEN (t.account_id=? AND t.cr_account_id=?) THEN COALESCE(t.trans_amount,'0') END) 'debit' FROM soc_trans_tbl t WHERE  t.trans_type='JOUR' and db_cr='DB' and fyear=? order by account_id" ;
 }
  
  $query = $this->db->query($sql,array($memid,$acctid,$memid,$acctid,$finyear));
 // print_r($query);
  return $query->result_array();
  }

}




public function getTrfPaidData($acctid=null,$memid=null)
{
  $finyear=$this->session->userdata('finyear');
  if($memid)
  {
   $sql="SELECT t.cr_account_id, MAX(CASE WHEN t.cr_account_id = ? THEN COALESCE(t.trans_amount,0) END) 'payment'
 FROM soc_trans_tbl t WHERE t.account_id=? and t.fyear=? group by t.account_id order by account_id" ;
 
 
  $query = $this->db->query($sql,array($acctid,$memid,$finyear));
  return $query->result_array();
  }

}

public function getTrfData($acctid=null,$memid=null)
{
  if($memid)
  {

$finyear=$this->session->userdata('finyear');
if($acctid=="539")
{
    $sql="SELECT t.cr_account_id, SUM(CASE WHEN t.account_id = ? or t.account_id='535' THEN COALESCE(t.trans_amount,0) END) 'deposit'
 FROM soc_trans_tbl t WHERE t.cr_account_id=? and t.db_cr='DB' and t.fyear=? group by t.cr_account_id order by cr_account_id" ;
 } 
elseif ($acctid=="538") {
    $sql="SELECT t.cr_account_id, SUM(CASE WHEN t.account_id = ? THEN COALESCE(t.trans_amount,0) END) 'deposit'
 FROM soc_trans_tbl t WHERE t.cr_account_id=? and t.fyear=? group by t.cr_account_id  order by cr_account_id" ;
  }
elseif ($acctid=="533") {
    $sql="SELECT t.cr_account_id, SUM(CASE WHEN t.account_id = ? THEN COALESCE(t.trans_amount,0) END) 'deposit'
 FROM soc_trans_tbl t WHERE t.cr_account_id=? and t.fyear=? group by t.cr_account_id order by cr_account_id" ;
  }

  $query = $this->db->query($sql,array($acctid,$memid,$finyear));
  return $query->result_array();
  }


}

public function getDcbData()
{
  
$sql ="select * from soc_members_tbl where member_staff=0 order by member_id";

  $query = $this->db->query($sql);
  //print_r($query);
  return $query->result_array();
}



public function getDcbDatabyId($accid=null)
{
  $sql="SELECT * from soc_itemtrans_tbl where account_id=? and delflag=0 ORDER by item_id ASC";
  $query = $this->db->query($sql,array($accid));
  return $query->result_array();
}


    function get_receiptbyid($id)
    {
      $finyear=$this->session->userdata('finyear');
       $delflag=0;
        $sql = "SELECT * FROM soc_trans_tbl where id=? and delflag=? and fyear=?";
        $query = $this->db->query($sql,array($id,$delflag,$finyear));
       //print_r($query);
        return $query->result_array();

        
    }


    function get_paymentbyid($id)
    {
      $finyear=$this->session->userdata('finyear');
       $delflag=0;
        $sql = "SELECT * FROM soc_payment_tbl where id=? and delflag=? and fyear=?";
        $query = $this->db->query($sql,array($id,$delflag,$finyear));
       //print_r($query);
        return $query->result_array();

        
    }

 function get_itemtrans($id) 
 {    
        $delflag=0;
        $sql = "SELECT * FROM soc_itemtrans_tbl where trans_ref=? and delflag=?";
        $query = $this->db->query($sql,array($id,$delflag));
      //print_r($query);
        return $query->result_array();

 }


function getImpAcc($impacc)
{
        $delflag=0;
        $sql = "SELECT * FROM soc_ledgermaster_tbl where import_account=? and delflag=?";
        $query = $this->db->query($sql,array(trim($impacc),$delflag));
       //print_r($query);
        //$this->output->enable_profiler(TRUE);
        return $query->result_array();

}

function getCldgData()
{
  $delflag=0;
  $sql = "SELECT * FROM soc_ledgermaster_tbl where cldg_flag=1 AND delflag=? order by print_pos";
  $query = $this->db->query($sql,$delflag);
  return $query->result_array();
}

function getAccHead($accid)
{
        $delflag=0;
        $sql = "SELECT * FROM soc_ledgermaster_tbl where acclink_id=? and delflag=?";
        $query = $this->db->query($sql,array($accid,$delflag));
       //print_r($query);
        return $query->result_array();

}


function getImpAccHead()
{
        $delflag=0;
        $sql = "SELECT * FROM soc_ledgermaster_tbl where import_account<>'' and bank_cash=0 and delflag=? order by print_pos";
        $query = $this->db->query($sql,array($delflag));
       //print_r($query);
        return $query->result_array();

}



function get_account_listbyname($name)
{
        $spltname = explode('-', $name);
        $nm=trim($spltname[1]);
        $delflag=0;
        $sql = "SELECT * FROM soc_ledgermaster_tbl where account_name=? and delflag=?";
        $query = $this->db->query($sql,array($nm,$delflag));
       //print_r($query);
        return $query->result_array();

}


function get_account_byname($name)
{
       // $spltname = explode('-', $name);
        //$nm=trim($spltname[1]);
        $delflag=0;
        $sql = "SELECT * FROM soc_ledgermaster_tbl where account_name=? and delflag=?";
        $query = $this->db->query($sql,array($name,$delflag));
       //print_r($query);
        return $query->result_array();

}

function get_accountid_bymemberid($mid)
{
        $delflag=0;
        $sql = "SELECT * FROM soc_ledgermaster_tbl where id=? and delflag=?";
        $query = $this->db->query($sql,array($mid,$delflag));
       //print_r($query);
        return $query->result_array();

}

function getMAImpData($acid=null,$finyear=null,$qry=null)
{
  //$mn = substr($mon, 1,2);
  
  $sql="SELECT l.acclink_id,l.account_name," . $qry . "  FROM `soc_temptrans_tbl` t,soc_ledgermaster_tbl l WHERE l.acclink_id=t.account_id and (t.account_id=? or t.cr_account_id=?)";

//var_dump($sql);

  //$sql= $qry; //"SELECT * from soc_trans_tbl where month(trans_date)=? and fyear=?";
  $query= $this->db->query($sql,array($acid,$acid));
  return $query->result_array();
}



function getImpData($acid=null,$finyear=null,$atype=null,$qry=null)
{
  //$mn = substr($mon, 1,2);
  
  
$sql="SELECT " . $qry . "  FROM `soc_temptrans_tbl` ORDER BY trans_date";


//  $sql="SELECT l.acclink_id,l.account_name," . $qry . "  FROM `soc_trans_tbl`,soc_ledgermaster_tbl l WHERE l.acclink_id=account_id and (account_id=? or cr_account_id=?) and month(trans_date)='04'";


  //$sql= $qry; //"SELECT * from soc_trans_tbl where month(trans_date)=? and fyear=?";
  $query= $this->db->query($sql);
  return $query->result_array();
}



public function getDmdRec()
{

  $sql2="SELECT COUNT(1) totdmdrec,month(demand_date) mnth,SUM(thrift_amount)+SUM(principle_amount)+SUM(interest_amount)+SUM(insurance_amount)+sum(misc_amount) dmd_tot FROM `soc_demandtemp_tbl` GROUP by month_year";
 $query1= $this->db->query($sql2);
$result2 = $query1->result_array(); 

  $sql="SELECT IFNULL(COUNT(1),0) totrec,month(recovery_date) mnth,IFNULL(SUM(thrift_amount),0)+IFNULL(SUM(principle_amount),0)+IFNULL(SUM(interest_amount),0)+IFNULL(SUM(insurance_amount),0)+IFNULL(sum(misc_amount),0) rec_tot FROM `soc_recovery_tbl` GROUP by month_year";
  $query2= $this->db->query($sql);
$result1 = $query2->result_array(); 


 $out = array();
  

  foreach ($result2 as $key => $value) {
    if(isset($result1[$key]))
    {
    $out[] = (object) array_merge((array) $result1[$key], (array) $value);
  }
  else
  {
    $out[] = $value;
  }
}

  
  return json_encode($out);


//$query = array_merge($result1,$result2);
  //return $query;
}
    

function get_journalbyid($id)
    {
      $finyear=$this->session->userdata('finyear');
       $delflag=0;
        $sql = "SELECT * FROM soc_trans_tbl where id=? and delflag=? and fyear=?";
        $query = $this->db->query($sql,array($id,$delflag,$finyear));
       //print_r($query);
        return $query->result_array();

    }



    function get_divisionbyid($id)
    {
      if($id) {
       $delflag=0;
        $sql = "SELECT * FROM soc_division_tbl where id=? and delflag=?";
        $query = $this->db->query($sql,array($id,$delflag));
       //print_r($query);
        return $query->result_array();
    }
}

        
    
    //-- get all users with type 2
    function get_designationbyid($id)
    {
       $delflag=0;
        $sql = "SELECT * FROM soc_designation_tbl where id=? and delflag=?";
        $query = $this->db->query($sql,array($id,$delflag));
       //print_r($query);
        return $query->result_array();

        
    }

    //-- get all users with type 2

    function get_departmentbyid($id)
    {
       $delflag=0;
        $sql = "SELECT * FROM soc_department_tbl where id=? and delflag=?";
        $query = $this->db->query($sql,array($id,$delflag));
       //print_r($query);
        return $query->result_array();

        
    }

    
    function get_Ledgerbyid($id)
    {
       $delflag=0;
        $sql = "SELECT * FROM soc_ledgermaster_tbl where id=? and delflag=? limit 1";
        $query = $this->db->query($sql,array($id,$delflag));
       //print_r($query);
        return $query->result_array();

        
    }


    function get_subdivisionbyid($id)
    {
       $delflag=0;
        $sql = "SELECT * FROM soc_subdivision_tbl where id=? and delflag=?";
        $query = $this->db->query($sql,array($id,$delflag));
       //print_r($query);
        return $query->result_array();

        
    }


    function get_sectionbyid($id)
    {
       $delflag=0;
        $sql = "SELECT * FROM soc_section_tbl where id=? and delflag=?";
        $query = $this->db->query($sql,array($id,$delflag));
       //print_r($query);
        return $query->result_array();

        
    }



   function get_settings_id() {
        $finyear=$this->session->userdata('finyear');
        $this->db->select('*');
        $this->db->where('fyear',$finyear);
        $this->db->from('soc_settings_tbl');
        $query = $this->db->get();
       return $query = $query->result_array();  

   }


   function get_tempsettings_id($finyear) {
        //$finyear=$this->session->userdata('finyear');
        $this->db->select('*');
        $this->db->where('fyear',$finyear);
        $this->db->from('soc_tempsettings_tbl');
        $query = $this->db->get();
       return $query = $query->result_array();  

   }


   function get_journal_id(){
        $finyear=$this->session->userdata('finyear');
        $this->db->select('*');
        $this->db->where('fyear',$finyear);
        $this->db->from('soc_settings_tbl');
        $query = $this->db->get();
       return $query = $query->result_array();  
    }


   function get_officenotedueto(){
        $finyear=$this->session->userdata('finyear');
        $this->db->select('*');
        //$this->db->where('fyear',$finyear);
        $this->db->from('soc_officenote_master_tbl');
        $query = $this->db->get();
       return $query = $query->result_array();  

    }


function get_loandetails($lnid=null)
{
  $sql="SELECT * FROM soc_loanapplication_tbl where app_number=?";
  $query = $this->db->query($sql,array($lnid));
  return $query->result_array();
}



function get_ondues($accid=null,$onid=null,$opfld=null)
{
  $finyear=$this->session->userdata('finyear');
  $sql="SELECT m." . $opfld .  " `opbal`, SUM(CASE WHEN t.account_id=? THEN t.trans_amount else 0 END)AS `debit`,SUM(CASE WHEN t.cr_account_id=? THEN t.trans_amount else 0 END) AS `credit` FROM `soc_trans_tbl` t,soc_members_tbl m WHERE (t.account_id=? or t.cr_account_id=?) and m.member_id=? and t.fyear=? ";

        $query = $this->db->query($sql,array($onid,$onid,$accid,$accid,$accid,$finyear));
        return $query->result_array();
}

   function get_memberslist()
   {
    $finyear=$this->session->userdata('finyear');
      $this->db->select('*');
        $this->db->from('soc_members_tbl');
       // $this->db->where('fyear',$finyear);
        $query = $this->db->get();
       return $query = $query->result_array();  

   }


   function get_subaccount(){
        
        $this->db->select('*');
        $this->db->from('soc_itemmaster_tbl');
        $query = $this->db->get();
       return $query = $query->result_array();  

    }


   function getItemMaster(){
        
        $this->db->select('*'); 
        $this->db->from("soc_itemmaster_tbl where acclink_id<>''");
        $query = $this->db->get();
       return $query = $query->result_array();  

    }



   function getItemNamebyId($id){
        
        $this->db->select('*');
        $this->db->from('soc_itemmaster_tbl');
        $this->db->where('id',$id);
        $query = $this->db->get();
       return $query->result_array();  

    }


   function get_app_id(){
        $finyear=$this->session->userdata('finyear');
        $this->db->select('*');
        $this->db->where('fyear',$finyear);
        $this->db->from('soc_settings_tbl');
        
        
        $query = $this->db->get();
       return $query = $query->result_array();  
        //return $query->row()->app_number;
        //print_r($query);
       // return $query;

    }

  function get_member_byid($id)
  {
       $delflag=0;
        $sql = "SELECT * FROM soc_members_tbl where id=? and delflag=?";
        $query = $this->db->query($sql,array($id,$delflag));
       //print_r($query);
        return $query->result_array();

  }
    //-- get last member id
    function get_member_id(){
        $finyear=$this->session->userdata('finyear');
        $this->db->select('s.member_id');
        $this->db->where('fyear',$finyear);
        $this->db->from('soc_settings_tbl s');
        
        
        $query = $this->db->get();
       // $query = $query->result_array();  
        return $query->row()->member_id;
        //print_r($query);
        //return $query;

    }


   function get_subcaste()
    {
        
        
        $sql = "SELECT * FROM soc_subcaste_tbl where delflag=0";
        $query = $this->db->query($sql);
       //print_r($query);
        return $query->result_array();
       

    }



   function get_caste()
    {
        
        
        $sql = "SELECT * FROM soc_caste_tbl where delflag=0";
        $query = $this->db->query($sql);
       //print_r($query);
        return $query->result_array();
       

    }


   function get_religion()
    {
        
        
        $sql = "SELECT * FROM soc_religion_tbl where delflag=0";
        $query = $this->db->query($sql);
       //print_r($query);
        return $query->result_array();
       

    }

    function getDivMemData($divid=null,$mon=null,$finyear=null)
    {

        
        $sql="SELECT * FROM `soc_temptrans_tbl` WHERE (cr_account_id=? ) or (cr_account_id=? )";
        $query = $this->db->query($sql,array($divid,$divid));
        return $query->result_array();

      
    }




    function get_division()
    {
        
        
        $sql = "SELECT * FROM soc_division_tbl where delflag=0";
        $query = $this->db->query($sql);
       //print_r($query);
        return $query->result_array();
       

    }


    function get_subdivision()
    {
        
        
        $sql = "SELECT * FROM soc_division_tbl where delflag=0";
        $query = $this->db->query($sql);
      // print_r($query);
        return $query->result_array();
       

    }

    function get_department()
    {
        
        
        $sql = "SELECT * FROM soc_department_tbl";
        $query = $this->db->query($sql);
      // print_r($query);
        return $query->result_array();
       

    }

    function get_ldgAccById($memid)
    {
        $sql="SELECT * FROM soc_ledgermaster_tbl where acclink_id=?";
        $query = $this->db->query($sql, array($memid));
        return $query->result_array();

    }

    function get_ldgAcc()
    {
        
        $sql = "SELECT * FROM soc_ledgermaster_tbl where account_type<>0";
        $query = $this->db->query($sql);
      // print_r($query);
        return $query->result_array();
    }


    function get_section()
    {
        
        
        $sql = "SELECT * FROM soc_section_tbl";
        $query = $this->db->query($sql);
      // print_r($query);
        return $query->result_array();
       

    }

    function get_designation()
    {
        
        
        $sql = "SELECT * FROM soc_designation_tbl";
        $query = $this->db->query($sql);
      // print_r($query);
        return $query->result_array();
       

    }

    function search_blog($title){
        $this->db->like('blog_title', $title , 'both');
        $this->db->order_by('blog_title', 'ASC');
        $this->db->limit(10);
        return $this->db->get('blog')->result();
    }


function getRctFlagData()
{
  $sql ="SELECT * FROM `soc_ledgermaster_tbl` WHERE rct_flag=1 GROUP BY acclink_id ORDER BY print_pos";
  $query = $this->db->query($sql);
  return $query->result_array();

}

function getDmdFlagData()
{
  $sql ="SELECT * FROM `soc_ledgermaster_tbl` WHERE dmd_flag=1 GROUP BY acclink_id ORDER BY print_pos";
  $query = $this->db->query($sql);
  return $query->result_array();
}


function getDcbDataByMem($memid=null,$acclink=null,$mmyy=null)
{
 $sql="SELECT * FROM soc_dcb_2021_tbl where member_id=? and acclink_id=? and mmyyyy=?";
 $query = $this->db->query($sql,array($memid,$acclink,$mmyy));
 return $query->result_array();
}

function get_ldgacclist() 
{
    
        $sql = "SELECT * FROM soc_ledgermaster_tbl where (account_type<>'1' and account_type<>'2')";
        $query = $this->db->query($sql);
      // print_r($query);
        return $query->result_array();
       
}


function get_dcbldgacclist() 
{
    
        $sql = "SELECT * FROM soc_ledgermaster_tbl where  (account_type<>'1' and account_type<>'2')";
        $query = $this->db->query($sql);
      // print_r($query);
        return $query->result_array();
       
}


function get_cbacclist() 
{
    
        $sql = "SELECT * FROM soc_ledgermaster_tbl where bank_cash<>0";
        $query = $this->db->query($sql);
      // print_r($query);
        return $query->result_array();
       
}

    
function get_accttype() 
{
    
        $sql = "SELECT * FROM soc_ledgercat_tbl";
        $query = $this->db->query($sql);
      // print_r($query);
        return $query->result_array();
       
}


function get_mlist($term){
   $this->db->select('member_name');
    $this->db->where('member_name', $term);
    $query = $this->db->get('soc_members_tbl');
    return $query->result(); 
}

function fetchledgerOp($osBal=null)
{
      $sql = "SELECT * FROM soc_ledgermaster_tbl WHERE acclink_id=?";
        $query = $this->db->query($sql, array($osBal));
        return $query->result_array();

}

function getcrLedger_data()
{
$sql = "SELECT * FROM soc_ledgermaster_tbl where cldg_flag=1  ORDER by acclink_id ASC";
$query = $this->db->query($sql);
return $query->result_array();
}

function getcrLedgerDate_data($actid=null,$fdate=null,$tdate=null)
{
$sql = "SELECT * FROM soc_trans_tbl where (account_id=? or cr_account_id=?) and trans_date>=? and trans_date<=? ORDER by trans_date ASC";
$query = $this->db->query($sql,array($actid,$actid,$fdate,$tdate));
return $query->result_array();
}


function getcrData($mqry,$fdate,$tdate,$acct_id)
{

$sql="SELECT trans_date" . $mqry . " FROM `soc_trans_tbl` WHERE trans_date>=? AND trans_date<=? and  (account_id=? or cr_account_id=?)  and trans_type='JOUR' GROUP by trans_date order by trans_date";
$query = $this->db->query($sql,array($fdate,$tdate,$acct_id,$acct_id));
return $query->result_array();



}

function getMembyDivId($divid=null)
{
  $sql="SELECT * FROM soc_members_tbl where division_id=? and account_close=0 ORDER BY member_id";
  $query = $this->db->query($sql,array($divid));
  return $query->result_array();
}


function getLedger_data($accid=null)
{
  $ltype = "DB";
  if($accid=="0")
  {
        $sql = "SELECT * FROM soc_ledgermaster_tbl  ORDER by acclink_id ASC";
        $query = $this->db->query($sql);


  }
 else {
   //$sql = "SELECT * FROM soc_ledgermaster_tbl WHERE account_type=? and acclink_id=?";
   $sql = "SELECT * FROM soc_ledgermaster_tbl WHERE acclink_id=?";
   
   $query = $this->db->query($sql, array($accid));
 
 }    

//print_r($query);
        return $query->result_array();
 }


function getDBTransData($fdate=null)
{
  $finyear=$this->session->userdata('finyear');
//    $sql="SELECT * FROM soc_trans_tbl WHERE trans_date>=? and trans_date<=? and fyear=? order by trans_date";

$sql="SELECT t.db_cr,t.trans_id,t.cheque_ref,t.cheque_bank,t.trans_refid,t.trans_type,t.trans_date,t.account_id,t.cr_account_id,t.trans_amount FROM `soc_trans_tbl` t WHERE  t.trans_date>=? AND t.trans_date<=? and t.fyear=? ORDER by t.trans_date";

    $query = $this->db->query($sql, array($fdate,$fdate,$finyear));
 return $query->result_array(); 

}

function getTransData($accId=null,$fdate=null,$tdate=null)
{
  $finyear=$this->session->userdata('finyear');
  if($accId=="0")
  {
    
    $sql="SELECT * FROM soc_trans_tbl WHERE trans_date>=? and trans_date<=? and fyear=? order by trans_date";
    $query = $this->db->query($sql, array($fdate,$tdate,$finyear));

  }
  else 
  {
    $sql="SELECT * FROM soc_trans_tbl WHERE (account_id=? or cr_account_id=?) and trans_date>=? and trans_date<=? and fyear=? order by trans_date";
    $query = $this->db->query($sql, array($accId,$accId,$fdate,$tdate,$finyear));

  }
 return $query->result_array(); 
}




function getTransOpData($accId=null,$fdate=null,$tdate=null)
{
  $finyear=$this->session->userdata('finyear');
  if($accId=="0")
  {
    $sql="SELECT * FROM soc_trans_tbl WHERE  trans_date<? and fyear=? order by trans_date";
    $query = $this->db->query($sql, array($fdate,$finyear));

  }
  else 
  {
    $sql="SELECT * FROM soc_trans_tbl WHERE (account_id=? or cr_account_id=?)  and trans_date<? and fyear=? order by trans_date";
    $query = $this->db->query($sql, array($accId,$accId,$fdate,$finyear));

  }
  //print_r($query);
 return $query->result_array(); 
}


function fetchGLedger($ld_id=null,$fdt=null,$tdt=null,$acct_id=null,$divid=null,$finyear=null)
{
//  $finyear=$this->session->userdata('finyear');

if($divid=="0") {

$sql = "SELECT * FROM soc_trans_tbl where trans_date>=? and trans_date<=? and fyear=? and (account_id=? or cr_account_id=?)";
 //$sql="SELECT t.* FROM soc_trans_tbl t where (t.account_id=? AND (t.db_cr='DM' or t.db_cr='DB') AND t.trans_date>=? and t.trans_date<=?) or (t.cr_account_id=? AND (t.db_cr='RV' or t.db_cr='RJ') AND t.trans_date>=? and t.trans_date<=?) and fyear=? order by  t.trans_date,t.trans_id";
$query = $this->db->query($sql, array($fdt,$tdt,$finyear,$ld_id,$ld_id)); 

     //$query = $this->db->query($sql, array($ld_id,$fdt,$tdt,$ld_id,$fdt,$tdt,$finyear));

}
else {
$sql = "SELECT * FROM soc_trans_tbl where division_id=? and trans_date>=? and trans_date<=? and fyear=? and (account_id=? or  cr_account_id=?)";



// $sql="SELECT t.* FROM soc_trans_tbl t where (t.division_id=? and t.account_id=? AND (t.db_cr='DM' OR t.db_cr='RJ' ) AND t.trans_date>=? and t.trans_date<=?) or (t.division_id=? and t.cr_account_id=? AND ( t.db_cr='RV' OR t.db_cr='DB' ) AND t.trans_date>=? and t.trans_date<=?) and fyear=?  order by t.trans_id,t.trans_date";


     $query = $this->db->query($sql, array($divid,$fdt,$tdt,$finyear,$ld_id,$ld_id));

}
//$this->output->enable_profiler(TRUE); 
 return $query->result_array();

}


function fetchGLedgerCB($ld_id=null,$fdt=null,$tdt=null)
{
$finyear=$this->session->userdata('finyear');
$sql="SELECT t.* FROM soc_trans_tbl t where  (t.account_id=? or t.cr_account_id=?) AND t.trans_date>=? and t.trans_date<=? and fyear=? order by t.trans_id,t.trans_date";
$query = $this->db->query($sql, array($ld_id,$ld_id,$fdt,$tdt,$finyear));

//$this->output->enable_profiler(TRUE); 
 return $query->result_array();

}



function fetchLedgerGLSubData($ld_id = null,$fdt=null, $tdt=null)
{

  if($ld_id=="0")
  {
     // $sql = "SELECT * FROM soc_transaction_tbl WHERE  (account_id=? or cash_bank_id=?) and trans_date>=? and trans_date<=?";
   $sql="SELECT t.cash_bank, t.trans_date,l.account_name, SUM(CASE WHEN t.item_name = 'THRIFT' THEN COALESCE(t.trans_amount,0) END) 'THRIFT'
 , SUM(CASE WHEN t.item_name = 'PRINCIPLE' THEN  COALESCE(t.trans_amount,0) END) 'PRINCIPLE'
 , SUM(CASE WHEN t.item_name = 'INTEREST' THEN  COALESCE(t.trans_amount,0) END) 'INTEREST'
  
FROM 
 soc_itemtrans_tbl t, soc_ledgermaster_tbl l
 WHERE t.trans_date>=? AND t.trans_date<=? AND l.acclink_id=t.cash_bank
GROUP BY t.cash_bank,t.trans_date
ORDER BY t.cash_bank, t.trans_date ASC"; 
        $query = $this->db->query($sql, array($fdt,$tdt));

  }
  else {


   $sql="SELECT t.cash_bank, t.trans_date,l.account_name, SUM(CASE WHEN t.item_name = 'THRIFT' THEN COALESCE(t.trans_amount,0) END) 'THRIFT'
 , SUM(CASE WHEN t.item_name = 'PRINCIPLE' THEN  COALESCE(t.trans_amount,0) END) 'PRINCIPLE'
 , SUM(CASE WHEN t.item_name = 'INTEREST' THEN  COALESCE(t.trans_amount,0) END) 'INTEREST'
  
FROM 
 soc_itemtrans_tbl t, soc_ledgermaster_tbl l
 WHERE t.cash_bank=? and t.trans_date>=? AND t.trans_date<=? AND l.acclink_id=t.cash_bank
GROUP BY t.cash_bank,t.trans_date
ORDER BY t.cash_bank, t.trans_date ASC"; 
        $query = $this->db->query($sql, array($ld_id,$fdt,$tdt));
      //$query = $this->db->query($sql, array($actid,$actid,$fdt,$tdt));
  }
        return $query->result_array();

 
 }     

function fetchLedgerSubData($ld_id = null,$fdt=null, $tdt=null,$actid=null)
{

  if($actid=="0")
  {
      $sql = "SELECT * FROM soc_transaction_tbl WHERE  (account_id=? or cash_bank_id=?) and trans_date>=? and trans_date<=?";
        $query = $this->db->query($sql, array($ld_id,$ld_id,$fdt,$tdt));

  }
  else {


      $sql = "SELECT * FROM soc_transaction_tbl WHERE  (account_id=? or cash_bank_id=?) and trans_date>=? and trans_date<=? order by trans_date,trans_id";
      $query = $this->db->query($sql, array($actid,$actid,$fdt,$tdt));
  }

       //
    /// print_r($sql);
        return $query->result_array();

}



function fetchcreditLedgerData($finyear=null,$actid=null,$sql_qry=null)
{
$sql="SELECT trans_date," . $sql_qry . "trans_id FROM soc_trans_tbl WHERE fyear=? and (account_id=? or cr_account_id=?) and trans_type='JOUR'  ORDER BY trans_date";
$query = $this->db->query($sql, array($finyear,$actid,$actid));
return $query->result_array();

}




function fetchcreditLedgerSubData($ld_id = null,$fdt=null, $tdt=null,$actid=null)
{
$finyear=$this->session->userdata('finyear');
  if($actid=="0")
  {
    
$sql ="SELECT t.account_id,t.cr_account_id,t.db_cr,t.trans_amount,t.trans_date,t.trans_id,t.cheque_ref,t.division_id,t.trans_type,l.account_name,l.import_account FROM `soc_trans_tbl` t, soc_ledgermaster_tbl l, soc_division_tbl d  WHERE  t.division_id=d.id and t.cr_account_id=l.acclink_id  AND l.cldg_flag=1 and t.trans_date>=? AND t.trans_date<=? and t.fyear=? group by t.trans_id order by t.trans_date";

      $query = $this->db->query($sql, array($fdt,$tdt,$finyear));

  }
  else {

$sql ="SELECT t.account_id,t.cr_account_id,t.db_cr,t.trans_amount,t.trans_date,t.trans_id,t.cheque_ref,t.division_id,t.trans_type,l.account_name,d.division_name,l.import_account FROM `soc_trans_tbl` t, soc_ledgermaster_tbl l, soc_division_tbl d WHERE t.division_id=d.id and t.account_id=l.acclink_id AND l.cldg_flag=1  and t.trans_date>=? AND t.trans_date<=? AND (t.account_id=? or t.cr_account_id=?)  and t.trans_type='JOUR' and fyear=? group by t.trans_id order by t.trans_date";
  
$query = $this->db->query($sql, array($fdt,$tdt,$ld_id,$ld_id,$finyear));
  }
  return $query->result_array();

}



function get_memberbymobileno($mno)
{
      $delflag=0;
      $sql = "SELECT * FROM soc_members_tbl WHERE mobile_no=? and delflag=?";
      $query = $this->db->query($sql, array($mno,$delflag));
return $query->result_array();
}

    function get_Memberbyid($keyword)
    
    {

      $query = $this->db->select('*')->from('soc_members_tbl')->where("member_name LIKE '%$keyword%'");
       $query = $this->get()->result_array();
       
       return  $query;
        //$this->db->like("member_name", $keyword,'both');
        //return $this->db->get('soc_members_tbl')->result_array();
    }




    function get_fylist()
    {
    $sql = "SELECT * FROM soc_finyear_tbl order by active desc";
    $query = $this->db->query($sql);
    return $query->result_array();
   }


    function get_account_list($qry)
    
    {

  $sql="select * from soc_ledgermaster_tbl where concat_ws(' - ',acclink_id,account_name) like '%$qry%'   and account_type<>'BK' and account_type<>'CS'";    
  //$sql = "SELECT * FROM soc_ledgermaster_tbl where (concate(acclink_id,' - ',account_name)) LIKE '%$qry%')   and account_type<>'BK' and account_type<>'CS' ";
  
    //print_r($qry);
//$sql = "SELECT * FROM soc_ledgermaster_tbl where (acclink_id LIKE '%$qry%' or account_name LIKE '%$qry%' )  and account_type<>'BK' and account_type<>'CS' ";
    $query = $this->db->query($sql);
   //print_r($query);
    return $query->result_array();
    }



    function get_member_list($qry)
    
    {
       // var_dump($query);
      //  $replacements="%2F";
       // $string ="/";
   //$qry = str_replace($query, $replacements, $string);
//var_dump($qry);
    $sql = "SELECT * FROM soc_members_tbl where member_name LIKE '%$qry%'";
    $query = $this->db->query($sql);
    //print_r($query);
    return $query->result_array();

    }


    function get_lnapp_list()
    
    {
    $sql = "SELECT * FROM soc_loanapplication_tbl";
    $query = $this->db->query($sql);
    return $query->result_array();

    }




    function get_application_list($query)
    
    {
    

    $sql = "SELECT l.*,m.surety_id,m.surety_name,m.share_capital as `mshare_capital`,s.share_capital as `sshare_capital`,m.loan_outstanding,m.rate_of_interest FROM soc_loanapplication_tbl l,soc_members_tbl m, soc_members_tbl s where l.app_number LIKE '%$query%' and l.member_id=m.member_id and s.member_id=m.surety_id";
    $query = $this->db->query($sql);
    return $query->result_array();

    }


   

    function get_member_listbyId($query)
    
    {
    

    $sql = "SELECT * FROM soc_members_tbl where member_id LIKE '%$query%'";
    $query = $this->db->query($sql);
    return $query->result_array();

    }



    function get_memberlist()
    
    {

    $query = $this->db->get('soc_members_tbl');
//        return $query->result();
/*        $this->db->select('*');    
        $this->db->like('member_name', $query, 'both');
        $this->db->or_like('member_id', $query, 'both');
       $query= $this->db->get('soc_members_tbl');
  */      
        //$sql = "SELECT member_id,member_name FROM soc_members_tbl";
        //$query = $this->db->query($sql);
      // print_r($query);
        return $query->result_array();
       

    }
    //-- count active, inactive and total user
    function get_user_total(){
        $this->db->select('*');
        $this->db->select('count(*) as total');
        $this->db->select('(SELECT count(u.id)
                            FROM soc_user u
                            WHERE (u.status = 1)
                            )
                            AS active_user',TRUE);

        $this->db->select('(SELECT count(u.id)
                            FROM soc_user u
                            WHERE (u.status = 0)
                            )
                            AS inactive_user',TRUE);

        $this->db->select('(SELECT count(u.id)
                            FROM soc_user u
                            WHERE (u.role = "admin")
                            )
                            AS admin',TRUE);

        $this->db->from('soc_user');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }



    function get_member_total(){
        $this->db->select('*');
        $this->db->select('count(*) as total');
        $this->db->select('(SELECT count(soc_members_tbl.id)
                            FROM soc_members_tbl 
                            WHERE (soc_members_tbl.status = 0)
                            )
                            AS active_member',TRUE);

        $this->db->select('(SELECT count(soc_members_tbl.id)
                            FROM soc_members_tbl 
                            WHERE (soc_members_tbl.status = 1)
                            )
                            AS inactive_member',TRUE);

        $this->db->select('(SELECT count(soc_members_tbl.id)
                            FROM soc_user 
                            WHERE (soc_members_tbl.surety_flag = "Y")
                            )
                            AS suretygiven',TRUE);

        $this->db->from('soc_members_tbl');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //-- image upload function with resize option
    function upload_image($max_size){
            
            //-- set upload path
            $config['upload_path']  = "./assets/images/";
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['max_size']     = '92000';
            $config['max_width']    = '92000';
            $config['max_height']   = '92000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("photo")) {

                
                $data = $this->upload->data();

                //-- set upload path
                $source             = "./assets/images/".$data['file_name'] ;
                $destination_thumb  = "./assets/images/thumbnail/" ;
                $destination_medium = "./assets/images/medium/" ;
                $main_img = $data['file_name'];
                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_medium   = $max_size ;
                $limit_thumb    = 200 ;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
                    $percent_medium = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = ' 100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                ////// Making MEDIUM /////////////
                $img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $mid = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                //-- set upload path
                $images = 'assets/images/medium/'.$mid;
                $thumb  = 'assets/images/thumbnail/'.$thumb_nail;
                unlink($source) ;

                return array(
                    'images' => $images,
                    'thumb' => $thumb
                );
            }
            else {
                echo "Failed! to upload image" ;
            }
            
    }



function selectdata()
{
 
        $this->db->from('soc_journalentry_tbl');
        $query = $this->db->get();
        //$query = $query->array();  
        return $query->result_array();
        
}

function getDivId($divname)
{
       $this->db->from('soc_division_tbl');
        $this->db->where('division_name',$divname);
        $query = $this->db->get();
        //$query = $query->array();  
        return $query->result_array();
   
}



function insDemand()
{
  $this->db->insert_batch('soc_demand_2021_tbl',$dmdData);
}


function insertExcel()
{
  $this->db->insert_batch('soc_journalentry_tbl',$jvdata);
}


public function demandData($tbl,$data,$mmyy) 
  {
//    $sql="delete from soc_demandtemp_tbl where month_year=?";
    
    $this->db->where('month_year', $mmyy);
    $this->db->delete($tbl);

    $status =$this->db->insert_batch($tbl, $data);
   // print_r($status);
    if($status>0) 
    {
      return true;
    }
    else
    {
      return false;
    }
//return ($status === true ? true : false);  
  }


 
public function setBatchImport($batchImport) 
{
        $this->_batchImport = $batchImport;
}
 
    // save data
    public function importData($tbl,$data) 
    {
        //$data = $this->_batchImport;
    $status = $this->db->insert_batch($tbl, $data);
       // print_r($data);
       return ($status === true ? true : false);   
    }



public function getImportHeads($itype=null)
{
  $sql="SELECT * FROM soc_import_headlist_tbl where predefine=0 and import_type=?";
  $query= $this->db->query($sql,array($itype));
  return $query->result_array();  
}



public function getThrift($mmyy)
{
$filter="THRIFT";
$sql="select * from soc_itemtrans_tbl where mmyy=? and item_name=? and trans_amount<>0";
$query = $this->db->query($sql,array($mmyy,$filter));
return $query->result_array();
}


public function getPrinciple($mmyy)
{
$filter="PRINCIPLE";
$sql="select * from soc_itemtrans_tbl where mmyy=? and item_name=? and trans_amount<>0 ";
$query = $this->db->query($sql,array($mmyy,$filter));
//$this->output->enable_profiler(TRUE); 
return $query->result_array();

}

public function getSumThrift()
{
$sql="SELECT t.member_id,(sum(t.trans_amount)+m.thrift_opbal) smthrift FROM `soc_thrift_tbl` t,soc_members_tbl m WHERE t.member_id=m.member_id GROUP BY t.member_id";
//$sql="select member_id,sum(trans_amount) smthrift from soc_thrift_tbl GROUP BY member_id";
$query = $this->db->query($sql);
return $query->result_array();

}


public function getSumPrinciple()
{

$sql="SELECT p.member_id,m.loan_opbal,(m.loan_opbal-sum(p.trans_amount)) smprinciple FROM `soc_principle_tbl` p,soc_members_tbl m WHERE p.member_id=m.member_id GROUP BY p.member_id";
$query = $this->db->query($sql);
//$this->output->enable_profiler(TRUE); 
return $query->result_array();

}



public function getRecData($mmyy)
{
  $sql='select itm.account_id,itm.account_name,itm.trans_ref,itm.trans_date,sum(case when item_name = "THRIFT" then trans_amount else 0 end) as thrift,sum(case when item_name = "INTEREST" then trans_amount else 0 end) as interest, sum(case when item_name = "PRINCIPLE" then trans_amount else 0 end) as principle, sum(case when item_name = "INSURANCE" then trans_amount else 0 end) as insurance,itm.mmyy from soc_itemtrans_tbl itm,soc_members_tbl mem,soc_ledgermaster_tbl ldg WHERE itm.account_id=mem.member_id and itm.cash_bank=ldg.acclink_id and itm.mmyy=?  GROUP by itm.account_id';
  
    $query = $this->db->query($sql,array($mmyy));
    //print_r($query);
    return $query->result_array();

}

public function insertRecovery($tbl,$data,$mmyy)
{
    $this->db->where('month_year', $mmyy);
    $this->db->delete($tbl);
    
    $status =$this->db->insert_batch($tbl, $data);
   // print_r($status);
    if($status>0) 
    {
      return $status=true;
    }
    else
    {
      return $status=false;
    }
 
}


public function updateSettings($tbl,$data)
{
   return $this->db->update($tbl,$data);
}


}