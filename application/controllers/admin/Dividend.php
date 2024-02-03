<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dividend extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        check_login_user(); 
                $this->load->model('common_model');

$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}

    }
    




public function shr_dividend()
{ 
$data = array(); 

$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}

$finyear=$this->session->userdata('finyear');
$prv_finyear=$finyear-1;
$start_date = $finyear-1 . "-04-01";
$end_date = $finyear . "-03-31";
$nod=0;
$dt=$start_date;
$shr_acc="533";
$mem_id ="1680";
$trans_amt=0;
$shr_pc=0;
$td_pc=0;
$shr_op=0;
$shr_div=array();
/*
$int_pc_data = $this->common_model->get_settings_byid($prv_finyear);
if($int_pc_data)
{
    foreach ($int_pc_data as $key => $intvalue) {
        // code...
      $shr_pc = $intvalue['dividend_intpc'];
      $td_pc = $intvalue['td_intpc'];  
    }
}*/

$shr_opdata = $this->common_model->getOpShareTrans($prv_finyear,$mem_id);
if($shr_opdata)
{
    foreach ($shr_opdata as $key => $shropvalue) {
        // code...
        $shr_op = $shropvalue['share_capital'];

    }
}
$trans_amt = $shr_op;
$shr_data = $this->common_model->getShareTrans($start_date,$end_date,$shr_acc,$mem_id);


echo "Opening Balance : $trans_amt <br>";
while($dt <= $end_date) {

echo "The date is: $dt - nod : $nod <br>";    // code...



if($shr_data)
{
    foreach ($shr_data as $key => $shrvalue) {
        // code...
 
if($dt==$shrvalue['trans_date'])
{
$tot_amt=$trans_amt*$nod;
echo "$nod - $trans_amt <br>";
$shr_div[]=array("nod"=>$nod,"trans_amt"=>$trans_amt,"tot_amt"=>$tot_amt);
echo json_encode($shr_div) . "<br>";

    $trans_amt=$trans_amt+$shrvalue['trans_amount'];
$nod=0;

}


    }

}

$dt=strftime("%Y-%m-%d", strtotime("$dt +1 day"));
$nod++;
echo json_encode($shr_div);
}
echo "Total No of Days $nod <br> "; 
echo "$nod <br>";
echo json_encode($shr_div);
//$nod=$nod-1;

}


public function fetchShrTdItems()
{
    $options='';
    $ldgdata = $this->common_model->getShrTd();
   // var_dump($ldgdata);
    if($ldgdata)
    {
     foreach ($ldgdata as $ldvalue) 
      {
            
     $options .= '<option value="'.$ldvalue['acclink_id'].'">'.$ldvalue['account_name'].'</option>';
      
        }
        $options .= '<option selected disabled value="0">Select an Account</option>';


    }
        else 
        {
        $options .= '<option value="0">No Data</option>';
        } // /else empty section
            echo $options;

}


// TD Interest
public function td_interest()
{ 
$data = array(); 

$getFyear = $this->common_model->get_fylist();
if($getFyear)
{
$data['finyear'] = $getFyear;

}
$td_acc = $this->input->post('accid');
//var_dump($accid);

$finyear=$this->session->userdata('finyear');
$prv_finyear=$finyear-1;
$start_date = $finyear-1 . "-04-01";
$end_date = $finyear . "-03-31";
$stdt=$start_date;
$nod=0;
$tnod=0;
$dt=$start_date;
//$td_acc="538";
//$mem_id ="1680";
$trans_amt=0;
$td_op=0;
$tot_amt=0;
$rcpt_amt=0;
$pymt_amt=0;
$shr_pc=0;
$td_pc=0;
$td_div=array();
$ac_date='0000-00-00';
$flag=$td_acc;
$del_existing_td= $this->common_model->delTD($prv_finyear,$flag);


$memlist = $this->common_model->getDcbData();
if($memlist)
{
    foreach ($memlist as $key => $memvalue) {
        // code...
$prv_finyear=$finyear-1;
$start_date = $prv_finyear . "-04-01";
$end_date = $finyear . "-03-31";
$stdt=$start_date;
$nod=0;
$tnod=0;
$dt=$start_date;
//$td_acc="538";
//$mem_id ="1680";
$trans_amt=0;
$td_op=0;
$tot_amt=0;
$rcpt_amt=0;
$pymt_amt=0;
$shr_pc=0;
$td_pc=0;
$td_div=array();
$ac_date='0000-00-00';

$mem_id= $memvalue['member_id'];
$td_div=array();


/*
$int_pc_data = $this->common_model->get_settings_byid($prv_finyear);
if($int_pc_data)
{
    foreach ($int_pc_data as $key => $intvalue) {
        // code...
      $shr_pc = $intvalue['dividend_intpc'];
      $td_pc = $intvalue['td_intpc'];  
    }
}
*/

            $td_accdata = json_decode($this->getAccNamebyid($td_acc),true);
                    $td_acname=$td_accdata['ac_name'];
                    $td_pc=$td_accdata['int_pc'];


$td_opdata = $this->common_model->getOpShareTrans($prv_finyear,$mem_id);
if($td_opdata)
{
    foreach ($td_opdata as $tdopvalue) {
        // code...
        if($td_acc=="533")
        {
        $shr_op = $tdopvalue['share_capital'];

        }
        else {
        $shr_op = $tdopvalue['thrift_opbal'];
        }
    }
}
else
{
    $shr_op=0;
}
$trans_amt = $trans_amt+ $shr_op;
$mem_data = $this->common_model->get_memberid($mem_id);
//var_dump($mem_data);
if($mem_data)
{
    foreach ($mem_data as $key => $mvalue) {
        // code...
        $ac_date=$mvalue['ac_date'];
    }


}


if($ac_date=="0000-00-00")
{
    $end_date=$end_date;
}
else
{
    $end_date=$ac_date;
}

//var_dump($end_date . $ac_date);
$td_data = $this->common_model->getShareTrans($start_date,$end_date,$td_acc,$mem_id);


//echo "Opening Balance : $trans_amt <br>";
while($dt <= $end_date) {

//echo "The date is: $dt - nod : $nod <br>";    // code...



if($td_data)
{
    foreach ($td_data as $key => $tdvalue) {
        // code...
 
if($dt==$tdvalue['trans_date'])
{
$tot_amt=$trans_amt*$nod;
$tot_int = ($tot_amt*$td_pc/100)/365;
$todt=strftime("%Y-%m-%d", strtotime("$dt -1 day"));



//echo "From : $stdt - To : $todt -  $nod - $trans_amt  = $tot_amt  tot_int : $tot_int<br>";


$tnod=$tnod+$nod;
if($trans_amt!=0)
{

$td_div[]=array("member_id"=>$mem_id,"shrtd_flag"=>$flag, "from_date"=>$stdt,"to_date"=>$todt, "nod"=>$nod,"trans_amt"=>$trans_amt,"int_pc"=>$td_pc,"int_amount"=>round($tot_int,0),"fyear"=>$prv_finyear);
}
//$td_div[]=array("from_date"=>$stdt,"to_date"=>$todt, "nod"=>$nod,"trans_amt"=>$trans_amt,"tot_amt"=>$tot_amt);
$stdt=$dt;
//echo json_encode($td_div) . "<br>";
    $rcpt_amt=0;
    $pymt_amt=0;

    $rcpt_amt=$rcpt_amt+$tdvalue['rcpt'];
    $pymt_amt=$pymt_amt+$tdvalue['pymt'];
    $trans_amt=$trans_amt+$rcpt_amt-$pymt_amt;

$nod=0;

}




    }

}

$dt=strftime("%Y-%m-%d", strtotime("$dt +1 day"));

$nod++;
//echo json_encode($td_div) . "<br>";
}
//$nod--;
$tot_amt=$trans_amt*$nod;
$tot_int = ($tot_amt*$td_pc/100)/365;

$dt=strftime("%Y-%m-%d", strtotime("$dt -1 day"));
//echo "Total No of Days $nod <br> "; 
$tnod=$tnod+$nod;
$todt=$dt;
if($trans_amt!=0)
{
$td_div[]=array("member_id"=>$mem_id,"shrtd_flag"=>$flag, "from_date"=>$stdt,"to_date"=>$todt, "nod"=>$nod,"trans_amt"=>$trans_amt,"int_pc"=>$td_pc,"int_amount"=>round($tot_int,0),"fyear"=>$prv_finyear);
}
//echo "From : $stdt - To : $todt -  $nod - $trans_amt  = $tot_amt  tot_int : $tot_int<br>";
//echo json_encode($td_div) . "<br>";
//echo "Total Number of Days :  $tnod <br>";
//$nod=$nod-1;


//Send to Db
if($td_div)
{
$ins_interest = $this->common_model->ins_shrtdint($td_div);
}

} //foreach on Members

//$dt=

    }// IF
echo json_encode($ins_interest);

//var_dump($ins_interest);
//if($ins_interest)
//{
//    $msg="Inserted Data successfully!!!";
//echo json_encode($array($msg));
//}


}

function getAccNamebyid($accId)
{
$ld_data=array();
$getAccNameDatabyid=$this->common_model->getAccHeadbyid($accId);
if($getAccNameDatabyid)
{
    foreach ($getAccNameDatabyid as $key => $anvalue) {
        // code...
        $ac_name = $anvalue['account_name'];
        $ld_data=array("ac_name"=>$anvalue['account_name'],"int_pc"=>$anvalue['int_pc']);
    }
return json_encode($ld_data);
}
else
{
    $ac_name='';
    return $ac_name;
}
}

function getAccName($accId)
{
$ld_data=array();
$getAccNameData=$this->common_model->getAccHead($accId);
if($getAccNameData)
{
    foreach ($getAccNameData as $key => $anvalue) {
        // code...
        $ac_name = $anvalue['account_name'];
        $ld_data=array("ac_name"=>$anvalue['account_name'],"int_pc"=>$anvalue['int_pc']);
    }
return json_encode($ld_data);
}
else
{
    $ac_name='';
    return $ac_name;
}
}

public function getProcessedData()
{
    $data = array();
    $rw=1;
    $shr_td_data = $this->common_model->getShrTDSummary();
    if($shr_td_data)
    {
        foreach ($shr_td_data as $key => $stvalue) {
            // code...

            $td_acc= $stvalue["shrtd_flag"];
            $tot_amt =$stvalue["trans_amt"];
            $td_amt =$stvalue["int_amt"];
            $intpc = $stvalue["int_pc"];
            $td_accdata = json_decode($this->getAccNamebyid($td_acc),true);
           // print_r($td_accdata);
                    $td_acname=$td_accdata['ac_name'];
                    $td_pc=$td_accdata['int_pc'];

            $td_tstamp = $stvalue["curr_timestamp"];

            $data['data'][]=array("rw"=>$rw, "td_name"=>$td_acname,"int_pc"=>$intpc,"tot_amt"=>$tot_amt, "td_amount"=>$td_amt,"curr_timestamp"=>$td_tstamp);
            $rw++;
        }
    }
    echo json_encode($data);
}

public function dividendtdreport()
{
$td_acc = $this->input->get('accid');
$finyear=$this->session->userdata('finyear');
$prv_finyear=$finyear-1;
$data=array();
    $rep_data =$this->common_model->getShrTdData($td_acc,$prv_finyear);
    //var_dump($rep_data);
    if($rep_data)
    {
        $rw=1;
        foreach ($rep_data as $key => $rvalue) {
            // code...
//            $td_acname = $this->getAccName($td_acc);
            $mem_id=$rvalue['member_id'];

            $mem_accdata = json_decode($this->getAccName($mem_id),true);
                    $mem_acname=$mem_accdata['ac_name'];
                    


            $data['data'][]=array("mem_id"=>$mem_id, "mem_name"=>$mem_acname, "fdate"=>$rvalue["from_date"],"tdate"=> $rvalue["to_date"],"nod"=>$rvalue["nod"],"trans_amt"=>$rvalue["trans_amt"],"int_pc"=>$rvalue["int_pc"],"int_amt"=>$rvalue["int_amount"]);

$rw++;
        }
    }
    echo json_encode($data);
}


public function dividendtdsumreport()
{
$td_acc = $this->input->get('accid');
$finyear=$this->session->userdata('finyear');
$prv_finyear=$finyear-1;
$data=array();
    $rep_data =$this->common_model->getShrTdsumData($td_acc,$prv_finyear);
    //var_dump($rep_data);
    if($rep_data)
    {
        $rw=1;
        foreach ($rep_data as $key => $rvalue) {
            // code...
//            $td_acname = $this->getAccName($td_acc);
            $mem_id=$rvalue['member_id'];

            $mem_accdata = json_decode($this->getAccName($mem_id),true);
                    $mem_acname=$mem_accdata['ac_name'];
                    


            $data['data'][]=array("mem_id"=>$mem_id, "mem_name"=>$mem_acname, "nod"=>$rvalue["tnod"],"trans_amt"=>$rvalue["trans_amt"],"int_pc"=>$rvalue["int_pc"],"int_amt"=>$rvalue["int_amount"]);

$rw++;
        }
    }
    echo json_encode($data);
}


public function dividendtdprocess()
{
        $data = array();
        $data['page_title'] = 'Dividend & TD Interest';
        $data['main_content'] = $this->load->view('admin/dividend/dividend_int_process', $data, TRUE);
        $this->load->view('admin/index', $data);


}

public function dividendtdprocessrep()
{
        $data = array();
        $data['page_title'] = 'Dividend & TD Interest';
        $data['main_content'] = $this->load->view('admin/dividend/dividend_int_report', $data, TRUE);
        $this->load->view('admin/index', $data);


}


public function dividendtdsumrep()
{
        $data = array();
        $data['page_title'] = 'Dividend & TD Interest Summary';
        $data['main_content'] = $this->load->view('admin/dividend/dividend_int_summary', $data, TRUE);
        $this->load->view('admin/index', $data);


}


        
}
