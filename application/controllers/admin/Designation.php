<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Designation extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
    }




public function deletedsgRec()
{
    $id = $this->uri->segment(4);
            $validator = array('success' => false, 'messages' => array());


    $delete = $this->common_model->deletedsg($id);
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

    public function fetchDesignationData()
    {
  //  $compId=$this->session->userdata['id']; 
   // $isItc=$this->session->userdata['isItc'];   
        $rw=1;
        $DesignationallData = $this->common_model->get_all_Designation();
        
        $result = array('data' => array());
        foreach($DesignationallData as $key => $value) { 
       // $invno = "'" . $value['invoice_no'] . "'";
        $id = $value['id'];
   
 $button ='<div class="dropdown">
  <button type="button" class="btn btn-info btn-circle btn-xs"  href="#" data-toggle="modal" data-target="#edit-Designation-modal" onclick="updateDesignations(' . $id . ')"><i class="fa fa-edit"></i>
      </button>

  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs"  href="#" data-toggle="modal"  onclick="deleteDesignation(' . $id . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 

//      <a  target="_blank" href="'. $id .'" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs trigger-btn" role="button"  data-toggle="modal" data-original-title="Delete"><i class="fa fa-times"></i></a> 
 
    $result['data'][$key] = array(
              //  $rw,
                $value['id'],
                $value['designation'],
                //$pdfbtn,
                $button
            );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
    }


    public function createDesignation()
    {
            $validator = array('success' => false, 'messages' => array());


            $create = $this->common_model->insertNDesignation();                    
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




   public function all_designation_list()
    {
        
        $data['page_title'] = 'All Designations';
        $data['designations'] = $this->common_model->get_all_Designation();
       //  $data['Designation'] = $this->common_model->select('Designation_tbl');
       // $data['count'] = $this->common_model->get_Designation_total();
        $data['main_content'] = $this->load->view('admin/designation/designations', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    

public function updatedsg() {
            $validator = array('success' => false, 'messages' => array());

$dsg_id = $this->input->post('editdsgid');
$dsg_name = $this->input->post('editdsgname');

            $create =  $this->common_model->updatedsgData($dsg_id,$dsg_name);
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
    public function fetchDesignationUpdate() 
    {
    //  $id=this->input->post("invNo");
        $id = $this->uri->segment(4);
       
       // $compId=$this->session->userdata['id'];
        
         $DesignationSelectedData = $this->common_model->get_designationbyid($id);
foreach ($DesignationSelectedData as $key => $dsgvalue) {

$table='<label>Designation Name</label>
        <span><input type="editdsgname" name="editdsgname" autocomplete="off"  style="text-transform: uppercase"  value="'.$dsgvalue['designation'].'" placeholder="Designation Name" class="form-control" required></span>
        <input type="hidden" name="editdsgid" id="editdsgid"  value="'.$dsgvalue['id'].'">';

}
          echo $table;


    
    }



}