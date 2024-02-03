<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms extends CI_Controller {

    public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
       $this->db->cache_delete($this->router->fetch_class(), $this->router->fetch_method());
        $this->db->simple_query('SET NAMES \'utf-8\'');
     //  $this->db->simple_query('SET NAMES \'utf-8\'');

    }

    public function index(){
      if($this->session->userdata('role')=="admin") { 
        $data = array();
        $data['page_title'] = 'Calender';
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    else
    {
      echo "Access Denied!!!";
    }
    }
	

    public function sms_members(){
      if($this->session->userdata('role')=="admin") { 
        $data = array();
        $data['page_title'] = 'SMS';
        $data['membersmobile'] = $this->common_model->get_memberslist();
        $data['main_content'] = $this->load->view('admin/sms/sms_members', $data, TRUE);
        $this->load->view('admin/index', $data);
      }
      else {
        echo "Access Denied !!!";
      }
    }

    public function fetchSmsTemplateById() 
    {
    //  $id=this->input->post("invNo");
     if($this->session->userdata('role')=="admin") {  
        $id = $this->uri->segment(4);
     $data = $this->common_model->get_smstemplatebyid($id);
 

        if($data) {
                foreach ($data as $key => $value) {
        $smsMsg= $value['template_message'];
    }
}

     echo json_encode($smsMsg);
   }
   else {
    echo "Access Denied !!!";
   }     
    }


public function getMsgid()
{
  if($this->session->userdata('role')=="admin") { 
    $smsdata = $this->common_model->get_smsmsgData(); 

    foreach ($smsdata as $key => $value) {
        # code...

        $msgid = $value['sms_msgid'];
        $this->deliveryStatus($msgid);
    }
  }
  else {
    echo "Access Denied !!!";
  }
}


//Delivery Report
public function deliveryStatus($msgid)
{
if($this->session->userdata('role')=="admin") { 
        $smsdata=$this->common_model->get_smssettings();
   
        foreach ($smsdata as $key => $value) {
        $senderId= $value['sendername'];// "abcd"; /* Sender ID */
        $serverUrl= $value['api_url'];
        $authKey= $value['api_authkey'];
        $username=$value['username'];
        $this->getSmsSTS($username,$msgid,$serverUrl,$authKey);    


}

}
else {
  echo "Access Denied !!!";
}
}


public function getSmsSTS($username,$msgid,$serverUrl,$authKey)
{
if($this->session->userdata('role')=="admin") { 
//http://login.aquasms.com/getDLR?username=jvainfotech&msgid= &apikey=xxxxxxxxxx
          $getData = 'username=' . $username . '&msgid='. $msgid . '&apikey='.$authKey;

          $url = 'http://' . $serverUrl . '/getDLR?' . $getData ;


          $ch = curl_init();
          curl_setopt_array($ch, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYHOST => 0,
           CURLOPT_SSL_VERIFYPEER => 0

          ));

          /* get response */
          /* Print error if any */
          if(curl_errno($ch))
          {
          echo 'error:' . curl_error($ch); 
  }
else
{
              $output = curl_exec($ch);
   // $oput = json_decode($output,true);
//$json = '{"foo-bar": 12345}';
//var_dump($output);
$obj = json_decode($output,true);
//var_dump($obj);
$smssts=0;
foreach ($obj as $value) {
$dlr_sts=$obj[0]['dlr_status']; // 12345     
//var_dump($dlr_sts);
if($dlr_sts=="DELIVRD") {
 $smssts =1;
$upd_qry = array('sms_status'=>$smssts);
$this->db->where('sms_msgid',$msgid);
$status = $this->db->update('soc_smsdata_tbl', $upd_qry);
}

if($dlr_sts=="UNDELIV") {
 $smssts =2;
$upd_qry = array('sms_status'=>$smssts);
$this->db->where('sms_msgid',$msgid);
$status = $this->db->update('soc_smsdata_tbl', $upd_qry);
}

}

}

}
else {
  echo "Access Denied !!!";
}

}





public function sendMobileSms() {
  if($this->session->userdata('role')=="admin") { 
 $status="";
        $mobileNumber= $this->input->post('mobilenumbers');// $params['to']; /*Separate mobile no with commas */
        $message= $this->input->post('message_text');// $params['message']; /* message */
        $smsdata=$this->common_model->get_smssettings();
   
        foreach ($smsdata as $key => $value) {
        $senderId= $value['sendername'];// "abcd"; /* Sender ID */
        $serverUrl= $value['api_url'];
        $authKey= $value['api_authkey'];
        $username=$value['username'];
        }
        $route="1";

if(strlen($mobileNumber)>1)
{
 $exp_mobileno = explode(',', $mobileNumber);

        foreach ($exp_mobileno as $mobileno) {
            $validator = array('success' => false, 'messages' => array());
            $create =$this->sendsmsGET($username,$mobileno,$senderId,$route,$message,$serverUrl,$authKey);    
    }

    
}
else
{


           $validator = array('success' => false, 'messages' => array());
            $create =$this->sendsmsGET($username,$mobileNumber,$senderId,$route,$message,$serverUrl,$authKey);        
}
  
            if($create === true) {
                $validator['success'] = true;
                $validator['messages'] = "Successfully Sent";
                
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Error while Sending SMS";
            }           
echo json_encode($validator);
}
else {
  echo "Access Denied !!!";
}
}

 public function sendsmsGET($username,$mobileNumber,$senderId,$routeId,$message,$serverUrl,$authKey)
      {
    if($this->session->userdata('role')=="admin") { 
          $route = "default";
          $getData = 'username=' . $username . '&message='.urlencode($message) . '&sendername=' . $senderId . '&smstype=TRANS' . '&numbers='.$mobileNumber .'&apikey='.$authKey;
          $url = 'http://' . $serverUrl . '/sendSMS?' . $getData ;


          $ch = curl_init();
          curl_setopt_array($ch, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYHOST => 0,
           CURLOPT_SSL_VERIFYPEER => 0

          ));

          /* get response */
          /* Print error if any */
          if(curl_errno($ch))
          {
          echo 'error:' . curl_error($ch); 
          }
else
{
              $output = curl_exec($ch);
   // $oput = json_decode($output,true);
//$json = '{"foo-bar": 12345}';
//var_dump($output);
$obj = json_decode($output,true);
//var_dump($obj);
foreach ($obj as $value) {
$msg_id=$obj[1]['msgid']; // 12345     
    # code
}
/*
          $strstrip = str_replace('[{"msgid":"', "", $output);
          $strst = str_replace('"}]', "", $strstrip);
          $outd = explode(',', $strst);
          $msg_id=$outd[1];
*/


$ins_sms = array('sms_to'=>$mobileNumber,'sms_text'=> $message,'sms_date'=>date('Y-m-d'),'sms_msgid'=>$msg_id);
 $status = $this->db->insert('soc_smsdata_tbl', $ins_sms);

}
//$this->getMsgid();
 return ($status === true ? true : false);           

          curl_close($ch);
          //return $output; 
         // var_dump($output);

}
else {
  echo "Access Denied!!!";
}
}



   public function smsReport()
   {
    if($this->session->userdata('role')=="admin") { 
        $data = array();
        $data['page_title'] = 'SMS Datewise Report';

$this->getMsgid();

        $data['main_content'] = $this->load->view('admin/sms/sms_report', $data, TRUE);
        $this->load->view('admin/index', $data);

   }
else {
  echo "Access Denied !!!";
}
}

   public function smsfetchReport()
   {
    
   $result=array();
        $fdate= $this->uri->segment(4);
        $tdate= $this->uri->segment(5);


$smsdata=$this->common_model->get_smsdata($fdate,$tdate);
if($this->session->userdata('role')=="admin") { 
//var_dump($smsdata);
$rw=1;
//        $name = "UNKNOWN NAME";
//$mname="";

foreach($smsdata as $key => $value) { 
       // $invno = "'" . $value['invoice_no'] . "'";
$mno = $value['sms_to'];
//print_r($mno);
$membersList = $this->common_model->get_memberbymobileno($mno);
//var_dump($membersList);
if(count($membersList)>0)
{

 //var_dump($membersList);
foreach ($membersList as  $mvalue) 
 {
     $mname =$mvalue['member_name'];
 }
    
}
else 
{
$mname="UNKNOWN";
}

$dt = $value['update_timestamp'];
   
        $id = $value['id'];
   
 $button ='<div class="dropdown btn-group">

  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs"  href="#" data-toggle="modal"  onclick="deleteMember(' . $id . ')"><i class="fa fa-times"></i>
      </button></div>'; 

if($value['sms_status']==0)
{
    $status='<td> <img src='. trim(base_url()) .'optimum/images/smspending.gif alt="Pending" class="img-circle" width="50px;"><span class="hidden">Submitted</span></td>';

}

if($value['sms_status']==1)
{
    $status='<td class="user-img"> <img src='. trim(base_url()) .'optimum/images/delivered.png alt="Delivered" class="img-circle" width="40px;"><span class="hidden">Delivered</span></td>';
}


if($value['sms_status']==2)
{
    $status='<td class="user-img"> <img src='. trim(base_url()) .'optimum/images/undelivered.png alt="Un=Delivered" class="img-circle" width="40px;"><span class="hidden">Un-Delivered</span></td>';
}

$dateTS = date("d-m-Y h:i", strtotime($dt));

    $result['data'][$key] = array(
                $rw,
                $dateTS,
                $mname,
                $value['sms_to'],
                $value['sms_text'],
                $status
                //$button
            );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);


}
else {
  echo "Access Denied !!!";
}
    }




    public function fetchSmsTemplates()
    {
    if($this->session->userdata('role')=="admin") { 
            $data = $this->common_model->get_smstemplates();
            $option="";
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                //$option .= '<option value="0" selected disabled>SELECT A TEMPLATE</option>';  
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['template_name'].'</option>';  

                    
                }

                 // /foreach
             //   $option .= '<option selected value=0>Choose</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    }
    else {
      echo "Access Denied !!!";
    }
    }


    

    public function  fetchMembersList()
    {
     if($this->session->userdata('role')=="admin") {  
            $data = $this->common_model->get_memberslist();
            $option="";
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    if($value['mobile_no']=="")
                    {
                        $option .= '<option value="'.$value['mobile_no'].'" disabled>'.$value['member_name'].'</option>';
                    }
                    else 
                    {
                    $option .= '<option value="'.$value['mobile_no'].'">'.$value['member_name'].'</option>';    
                    }
                    
                }
                 // /foreach
             //   $option .= '<option selected value=0>Choose</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
}
else {
  echo "Access Denied !!!";
}            
         // /if
    }



}