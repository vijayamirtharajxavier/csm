<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
    }


    public function index()
    {
        $data = array();

        $data['page_title'] = 'Notification';
     //   $data['notifications'] = $this->common_model->get_allnotification();
//        $data['power'] = $this->common_model->get_all_power('soc_user_power');
        $data['main_content'] = $this->load->view('admin/notification/scroll_message', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

public function getAllNotifications()
{

    $catdata = '[{"value":"1","text":"General Body Meeting"},{"value":"2","text":"AnnualDay Function"},{"value":"3","text":"Retirement Message"},{"value":"4","text":"Wishing Message"},{"value":"5","text":"Other Notifications"}]';
    // array("value"=>0,"text"=>"PENDING","value"=>1,"text"=>"APPROVED","value"=>2,"text"=>"REJECTED");
    $stsoption="";

    
    $data=array();
    $allnotifications = $this->common_model->get_allnotification();
    if($allnotifications)
    {
        foreach ($allnotifications as $key => $nfvalue) {
            if($nfvalue['delflag']==0)
            {
                $sts="Active";
                $sts_btn = '<input type="checkbox" checked data-toggle="toggle" data-onstyle="success">';

            }
            else
            {
                $sts="In-Active";
                $sts_btn = '<input type="checkbox" data-toggle="toggle" data-onstyle="success">';

            }
  /*          
            $catdata_decode = json_decode($catdata,TRUE);
            
            foreach ($catdata_decode as $key => $stsvalue) {
                # code...
                if($stsvalue['value']==$nfvalue['category_id'])
                    {
                        $stsoption .= '<option selected value="'.$stsvalue['value'].'">'.$stsvalue['text'].'</option>'; 
                    }
                    else 
                     { 
                        $stsoption .= '<option  value="'.$stsvalue['value'].'">'.$stsvalue['text'].'</option>'; 
                
                        //        $stsoption .= '<option value="'.$statusdata['value'].'">'.$statusdata['text'].'</option>'; 
                    }
            
            
            
            }
*/


            $button ='<div class="btn-group">
            <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="" data-toggle="modal" data-target="#modalEditLoanAppn" onclick="updateEvent(' . $nfvalue['id'] . ')"><i class="fa fa-edit"></i>
                </button>
          &nbsp;
            <button type="button"  class="btn btn-danger btn-circle btn-xs center-block " 
           href="#"  onclick="deleteEvent(' . $nfvalue['id'] . ')"><i class="fa fa-times"></i>
                </button>
           
          </div>'; 
          
            $data['data'][]=array("category_id"=>$nfvalue['category_id'],"category_name"=>$nfvalue['category_name'],"event_date"=>$nfvalue['event_date'],"from_date"=>$nfvalue['from_date'],"to_date"=>$nfvalue['to_date'],"event_name"=>$nfvalue['event_name'],"status"=>$sts_btn,"action"=>$button);

        }

        echo json_encode($data);
    }
}



public function createNotification()
{
    $validator = array('success' => false, 'messages' => array());
    $data = array();
    $create = $this->common_model->insertupdateEventNotification();                    
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

public function fetchEventCategory()
{

    $catoption='';
    $data = $this->common_model->get_eventcategory();
    //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
    if($data) {
        foreach ($data as $key => $value) {
             $catoption .= '<option value="'.$value['id'].'">'.$value['category_name'].'</option>'; 
        }
         // /foreach
       // $bank_option .= '<option selected value=0>Select Account</option>';
    }
    else {
        $catoption = '<option value="">No Data</option>';
    } // /else empty section
    $catoption .= ' <option value="0" selected disabled >Select a Category</option>';
 echo $catoption;
}


public function del_eventDatabyid()
{
    $id=$this->input->get('eventid');
    $deldata = $this->common_model->delEvent($id);
    if($deldata==true)
    {
      $msg = array("success"=>true,"message"=>"Successfully Deleted");
        echo json_encode($msg);
    }
    else
    {
        $msg = array("success"=>false,"message"=>"Error while deleting..");
        echo json_encode($msg);

    }
   
}

public function get_eventDatabyid()
{
    $id= $this->input->get('eventid');
 
    $data=array();
    $allnotifications = $this->common_model->get_allnotificationbyid($id);
    if($allnotifications)
    {
        foreach ($allnotifications as $key => $nfvalue) {
            if($nfvalue['delflag']==0)
            {
                $sts="Active";
            }
            else
            {
                $sts="In-Active";
            }

 
    $data[]=array("category_id"=>$nfvalue['category_id'],"category_name"=>$nfvalue['category_name'],"event_date"=>$nfvalue['event_date'],"from_date"=>$nfvalue['from_date'],"to_date"=>$nfvalue['to_date'],"event_name"=>$nfvalue['event_name'],"status"=>$sts);
        }
    
    echo json_encode($data);
    }

}


}