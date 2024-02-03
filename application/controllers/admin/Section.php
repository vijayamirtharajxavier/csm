<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Section extends CI_Controller {

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
        $data['main_content'] = $this->load->view('admin/user/add', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


public function deleteSecRec()
{
    $id = $this->uri->segment(4);
            $validator = array('success' => false, 'messages' => array());


    $delete = $this->common_model->deleteSec($id);
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

    public function fetchSectionsData()
    {
  //  $compId=$this->session->userdata['id']; 
   // $isItc=$this->session->userdata['isItc'];   
        $rw=1;
        $SectionallData = $this->common_model->get_all_Section();
        
        $result = array('data' => array());
        foreach($SectionallData as $key => $value) { 
       // $invno = "'" . $value['invoice_no'] . "'";
        $id = $value['id'];
   
 $button ='<div class="dropdown">
  <button type="button" class="btn btn-info btn-circle btn-xs"  href="#" data-toggle="modal" data-target="#edit-Section-modal" onclick="updateSections(' . $id . ')"><i class="fa fa-edit"></i>
      </button>

  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs"  href="#" data-toggle="modal"  onclick="deleteSection(' . $id . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 

//      <a  target="_blank" href="'. $id .'" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs trigger-btn" role="button"  data-toggle="modal" data-original-title="Delete"><i class="fa fa-times"></i></a> 
 
    $result['data'][$key] = array(
              //  $rw,
                $value['id'],
                $value['section_name'],
                //$pdfbtn,
                $button
            );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
    }


    public function createSection()
    {
            $validator = array('success' => false, 'messages' => array());


            $create = $this->common_model->insertNSection();                    
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




   public function all_section_list()
    {
        $data['page_title'] = 'All Sections';
        $data['sections'] = $this->common_model->get_all_Section();
       //  $data['Section'] = $this->common_model->select('Section_tbl');
       // $data['count'] = $this->common_model->get_Section_total();
        $data['main_content'] = $this->load->view('admin/section/sections', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


public function updateSec() {
            $validator = array('success' => false, 'messages' => array());

$sec_id = $this->input->post('editsecid');
$sec_name = $this->input->post('editsecname');

            $create =  $this->common_model->updateSecData($sec_id,$sec_name);
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






//Update Invoice
    public function fetchSectionsUpdate() 
    {
    //  $id=this->input->post("invNo");
        $id = $this->uri->segment(4);
       
       // $compId=$this->session->userdata['id'];
        
         $SectionSelectedData = $this->common_model->get_sectionbyid($id);
foreach ($SectionSelectedData as $key => $secvalue) {

$table='<label>Section Name</label>
        <span><input type="editsecname" name="editsecname" autocomplete="off"  style="text-transform: uppercase"  value="'.$secvalue['section_name'].'" placeholder="Section Name" class="form-control" required></span>
        <input type="hidden" name="editsecid" id="editsecid"  value="'.$secvalue['id'].'">';

}
          echo $table;


    
    }



}