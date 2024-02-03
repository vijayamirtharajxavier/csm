<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// *************************************************************************
// *                                                                       *
// * Optimum LinkupComputers                              *
// * Copyright (c) Optimum LinkupComputers. All Rights Reserved                     *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@optimumlinkupsoftware.com                                 *
// * Website: https://optimumlinkup.com.ng								   *
// * 		  https://optimumlinkupsoftware.com							   *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// *                                                                       *
// *************************************************************************

//LOCATION : application - controller - Dashboard.php

class Dashboard extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
        $this->load->model('common_model');
    }

public function getFyear()
{
$option='';
$finyear=$this->session->userdata('finyear');
$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
                           foreach ($getFyear as $key => $fyr) {
                            $fin_year=$fyr['fin_year'];
                            if($fin_year==$finyear)
                            {
                          $option .= '<option selected value="'. $fin_year.'" >' . $fin_year . '</option>';                                
                           } else {
                         $option .= '<option value="'. $fin_year.'" >' . $fin_year . '</option>';                                
                            }
                           }


echo $option;
}

}


    /****************Function login**********************************
     * @type            : Function
     * @function name   : index
     * @description     : This redirect to dashboard automatically 
     *                    
     *                       
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
	 
    public function index(){
       if($this->session->userdata('role')=="admin")
       {




        $data = array();




        $data['page_title'] = 'Dashboard';
        //$data['count'] = $this->common_model->get_user_total();
        $data['count'] = $this->common_model->get_member_total();
        $data['noticemessage'] = $this->common_model->get_noticeboard();

        $totInterest = $this->common_model->get_totInterest();

        foreach ($totInterest as $key => $value) {
          
          $interest_tot = $this->moneyFormatIndia(intval($value['tot_interest']));
          $data['totInterest'] = $interest_tot ;
        }

        $sumdata = $this->common_model->get_thriftdeposit();
        foreach ($sumdata as $key => $value) {

$thrift_tot = $this->moneyFormatIndia(floatval($value['tot_thrift']));
$tot_share = $this->moneyFormatIndia(floatval($value['tot_sharecapital']));

$tot_loanopbal = $this->moneyFormatIndia(floatval($value['out_oploan']));
$tot_loanout = $this->moneyFormatIndia(floatval($value['out_loan']));

$tot_outstanding = $this->moneyFormatIndia(floatval($value['totoutstanding']));


          $data['thrift_deposit'] = $thrift_tot ;
          $data['share_capital'] = $tot_share;
          $data['loan_out'] = $tot_outstanding;
        }

        $smsdata=$this->common_model->get_smssettings();
        foreach ($smsdata as $key => $value) {
        //$senderId= $value['sendername'];// "abcd"; /* Sender ID */
        $serverUrl= $value['api_url'];
        $authKey= $value['api_authkey'];
        $username=$value['username'];
        }

          $getData = 'username=' . $username . '&apikey='.$authKey;
          $url = 'http://' . $serverUrl . '/getSMSCredit?' . $getData ;
         
//          var_dump($url);


          $ch = curl_init();
          curl_setopt_array($ch, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYHOST => 0,
           CURLOPT_SSL_VERIFYPEER => 0

          ));

          /* get response */
          $output = curl_exec($ch);
          /* Print error if any */
          if(curl_errno($ch))
          {
            $err = explode(curl_error($ch), ":");
            if($err[0]=="Could not resolve host");
            {
              $smsCount = "Service Offline";
            }
          echo 'error:' . curl_error($ch); 
          }
          curl_close($ch);
          //return $output; 
         // var_dump($output);
          $strstrip = str_replace("[", "", $output);
          $outd = explode(',', $strstrip);
          $smsCount = $outd[0];
          $data['smscredit']=$smsCount;

$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}


        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);


        $this->load->view('admin/index', $data);
    }
    else
    {
      $this->userhome();
   //     $data = array();
  //      $data['main_content'] = $this->load->view('admin/userhome', $data, TRUE);
//      //  $this->load->view('admin/index', $data);
    }
    }



//User Dashboard

    public function userhome()
    {
    if($this->session->userdata('role')=="user")  
    {
        $data = array();
        $data['page_title'] = ' Dashboard';
        //$data['count'] = $this->common_model->get_user_total();
        $memberid = $this->session->userdata('memberid');
        //$data['count'] = $this->common_model->get_member_totalbyid($memberid);
        $data['noticemessage'] = $this->common_model->get_noticeboard();

        $totInterest = $this->common_model->get_totInterest();

        foreach ($totInterest as $key => $value) {
          
          $interest_tot = $this->moneyFormatIndia(intval($value['tot_interest']));
          $data['totInterest'] = $interest_tot ;
        }

$finyear=$this->session->userdata('finyear');
$acct_id=$this->session->userdata('memberid');
$tot_thf=0;
$tot_shr=0;
$tot_prn=0;
$tot_interest=0;
$tot_loanout=0;
$tot_ins=0;
$tot_share=0;
$rtot_thfp=0;
$rtot_thfr=0;
$rtot_shrp=0;
$rtot_shrr=0;
$rtot_insr=0;
$rtot_intr=0;
$rtot_prnp=0;
$rtot_prnr=0;
$bal_tot=0;
$main_data='';

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
$sql_qry .=" SUM(CASE WHEN account_id='". $dcb_id ."' THEN COALESCE(trans_amount,0) ELSE 0 END)`". $imp_acnm . "_r" ."`,SUM(CASE WHEN cr_account_id='". $dcb_id ."' THEN trans_amount ELSE 0 END)`". $imp_acnm . "_p" ."`,";

  }
//var_dump($sql_qry);
}


$subData = $this->common_model->fetchcreditLedgerData($finyear,$acct_id,$sql_qry);
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


}





        $sumdata = $this->common_model->get_thriftdepositbyid($memberid);
        foreach ($sumdata as $key => $value) {

$thrift_tot = $this->moneyFormatIndia(intval($value['tot_thrift']));
$tot_share = $this->moneyFormatIndia(intval($value['tot_sharecapital']));
$tot_loanout = $this->moneyFormatIndia(intval($value['out_loan']));

          $data['thrift_deposit'] = $thrift_tot ;
          $data['share_capital'] = $tot_share;
          $data['loan_out'] = $tot_loanout;
        }

$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}



$crLdger = $this->getCrLdger();
if($crLdger)
{

//$data['crledger'] = $crLdger;
$tot_thrift_p=0;
$tot_thrift_r=0;
$tot_share_p=0;
$tot_share_r=0;
$tot_principle_p=0;
$tot_principle_r=0;
$cb_thrift=0;
$cb_share=0;
$cb_prn=0;
$records =json_decode($crLdger,true);
//$cnt = count($records['ledgerdetails']);
//echo $cnt;
foreach ($records as $key => $crvalue) {
  // code...
$arrcnt= count($crvalue['ledgerdetails']['data']);



for ($i=0; $i <$arrcnt ; $i++) { 
  // code...

  //echo $crvalue['ledgerdetails']['data'][$i]['thrift_r'];
  $tot_thrift_r = $tot_thrift_r + $crvalue['ledgerdetails']['data'][$i]['thrift_r'];
  $tot_thrift_p = $tot_thrift_p + $crvalue['ledgerdetails']['data'][$i]['thrift_p'];

  $tot_share_r = $tot_share_r + $crvalue['ledgerdetails']['data'][$i]['share_r'];
  $tot_share_p = $tot_share_p + $crvalue['ledgerdetails']['data'][$i]['share_p'];

  $tot_principle_r = $tot_principle_r + $crvalue['ledgerdetails']['data'][$i]['principle_r'];
  $tot_principle_p = $tot_principle_p + $crvalue['ledgerdetails']['data'][$i]['principle_p'];

}


}
$cb_thrift=$thrift_opbal+ $tot_thrift_r-$tot_thrift_p;
$cb_share=$share_opbal+ $tot_share_r-$tot_share_p;
$cb_prn =$os_balresult+ $tot_principle_p-$tot_principle_r;


$data['cb_thrift'] = $cb_thrift;
$data['cb_share'] = $cb_share;
$data['cb_prn'] = $cb_prn;


}

 $data['main_content'] = $this->load->view('admin/userhome', $data, TRUE);


        $this->load->view('admin/index', $data);
    
} else {
  $this->index();
}

    }




public function fetchcreditledgerSearchPDF()
{
$finyear=$this->session->userdata('finyear');
$data= array();
$sresult = array();
$acct_id =  $this->session->userdata('memberid');//$this->input->post('ldgrSelect');
$os_balresult=0;
//var_dump($acct_id);
$memDetail = $this->common_model->get_memberid($acct_id);
if($memDetail)
{
        foreach($memDetail as $key => $memvalue) { 
    $db_tot=0;
    $cr_tot=0;
      $memberid = $memvalue['member_id'];
      $membername=$memvalue['member_name'];
      $suretyid = $memvalue['surety_id'];
}
}
else
{
  $memberid='';
  $membername='';
  $suretyid='';
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
  $suretyid='';
  $suretyname='';
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

//$tdate = date_create($value['trans_date']);
//echo date_format($date, 'Y-m-d H:i:s');

//$tdate = DateTime($value['trans_date']);

//$dt= date_format(strtotime($value['trans_date'],"d-m-Y"));


$main_data .= '<tr>';
$main_data .= '<td class="datewidth">' . $value["trans_date"] .'</td><td  class="transwidth">'. $value['trans_id'] .'</td>';
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
/*
 $event_data .= '<div id="printable"><div class="card text-center"><div class="card-header" id="crldgrep"> <h4>CREDIT LEDGER</h4>   </div>  <div class="card-body"> <div><label>Member Name</label><span> <b>' . $memb style="border:none;"ername .'</b> <span></div> <div class="smnm"><label>Surety Name</label> <div><b>'. $suretyname .'</b></div></div><br><div><label>Member Number</label><span><b> '. $memberid .'</b></span></div><div class="smn"><label>Surety Number</label><div> <b>' .$suretyid .'</b></div></div><br><div><label>Share Capital</label><span><b>'. $share_opbal . '</b></span></div><div class="smn"><label>F.Y : </label><div><b> '. $finyear .' </div></div>';

$event_data .= '<div class="row head"><div class="col-md-3 left">Member Name<span><div class="col-md-3">'. $membername .'</span></div></div> <div class="col-md-3 right">Surety Member Name<div class="col-md-3">'. $suretyname .'</div></div> </div>';
*/
 
 $event_data .= '<div><table border="0" id="headtable"> <tbody><tr><td style="border:none;">Member Name</td><td style="border:none;">:</td><td style="border:none;">'. $membername .'</td><td colspan="2" width="50%" style="border:none;"></td> <td style="border:none;">Surety Member Name</td><td style="border:none;">:</td><td style="border:none;">'. $suretyname .'</td></tr><tr><td style="border:none;">Member #</td><td style="border:none;">:</td><td style="border:none;">'. $memberid .'</td><td colspan="2" style="border:none;"></td> <td style="border:none;">Surety Member #</td><td style="border:none;">:</td><td style="border:none;">'. $suretyid .'</td></tr><tr><td style="border:none;">Share Capital</td><td style="border:none;">:</td><td style="border:none;">'. $share_opbal .'</td><td colspan="2" style="border:none;"></td> <td style="border:none;">F.Y.</td><td style="border:none;">:</td><td style="border:none;">'. $finyear .'</td></tr></tbody>';
 $event_data .='</table></div>';

 
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



function changeFinyear()
{
$nfinyear= $this->input->get('newfinyear');
//var_dump($nfinyear);
 $this->session->set_userdata('finyear', $nfinyear);
$finyear = $this->session->userdata('finyear');
//var_dump($finyear);
return $finyear;
}




public function getCrLdger()
{
$finyear=$this->session->userdata('finyear');
$data= array();
$sresult = array();
$acct_id = $this->session->userdata('memberid');
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
      $suretyid = "";
      $suretyname = "";

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
$sresult['data'][] = array("trans_date"=>$value["trans_date"],"trans_ref"=>$value["trans_id"],"thrift_r"=>$thrift_r,"thrift_p"=>$thrift_p,"tot_thf"=>$tot_thf, "principle_r"=>$principle_r, "principle_p"=>$principle_p,"tot_prn"=>$tot_prn,"share_r"=>$share_r,"share_p"=>$share_p,"tot_shr"=>$tot_shr, "interest_r"=>$interest_r,"tot_interest"=>$tot_interest,"tot_ins"=>$tot_ins, "insurance_r"=>$insurance_r);
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
return json_encode($data);
//echo json_encode($data);

}

public function fetchcreditledgerSearch()
{
$finyear=$this->session->userdata('finyear');
$data= array();
$sresult = array();
$acct_id = $this->session->userdata('memberid');
$os_balresult=0;

$memDetail = $this->common_model->get_memberid($acct_id);
if($memDetail)
{
        foreach($memDetail as $key => $memvalue) { 
    $db_tot=0;
    $cr_tot=0;
      $memberid = $memvalue['member_id'];
      $membername=$memvalue['member_name'];
      $suretyid = $memvalue['surety_id'];
}
}
else
{
  $membername='';
  $suretyid='';
  $memberid='';
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
  $suretyid='';
  $suretyname='';
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
//return json_encode($data);
echo json_encode($data);

}







/****************Function login**********************************
     * @type            : Function
     * @function name   : backup
     * @description     : Force database to be downloaded. 
     *                    if user or admin click on download button.
     *                       
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
	 


function moneyFormatIndia($num) {
    $explrestunits = "" ;
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}


    public function backup($fileName='db_backup.zip'){
        $this->load->dbutil();
        $backup =& $this->dbutil->backup();
        $this->load->helper('file');
        write_file(FCPATH.'/downloads/'.$fileName, $backup);
        $this->load->helper('download');
        force_download($fileName, $backup);
    }

public function dbbackup()
{
            $this->load->database();

            // Load the DB utility class
            $this->load->dbutil();

            // Backup your entire database and assign it to a variable
            $backup = $this->dbutil->backup();

            // Load the file helper and write the file to your server
            $this->load->helper('file');
            write_file('mybackup.gz', $backup);

            // Load the download helper and send the file to your desktop
            $this->load->helper('download');
            //force_download('mybackup.gz', $backup);
        }


}