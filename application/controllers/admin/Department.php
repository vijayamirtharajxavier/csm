<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');



    }




public function deleteDptRec()
{
    $id = $this->uri->segment(4);
            $validator = array('success' => false, 'messages' => array());


    $delete = $this->common_model->deleteDpt($id);
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

    public function fetchDepartmentData()
    {
  //  $compId=$this->session->userdata['id']; 
   // $isItc=$this->session->userdata['isItc'];   
        $rw=1;
        $DepartmentallData = $this->common_model->get_all_Department();
        
        $result = array('data' => array());
        foreach($DepartmentallData as $key => $value) { 
       // $invno = "'" . $value['invoice_no'] . "'";
        $id = $value['id'];
   
 $button ='<div class="dropdown">
  <button type="button" class="btn btn-info btn-circle btn-xs"  href="#" data-toggle="modal" data-target="#edit-department-modal" onclick="updateDepartments(' . $id . ')"><i class="fa fa-edit"></i>
      </button>

  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs"  href="#" data-toggle="modal"  onclick="deleteDepartment(' . $id . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 

//      <a  target="_blank" href="'. $id .'" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs trigger-btn" role="button"  data-toggle="modal" data-original-title="Delete"><i class="fa fa-times"></i></a> 
 
    $result['data'][$key] = array(
              //  $rw,
                $value['id'],
                $value['department_name'],
                //$pdfbtn,
                $button
            );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
    }


    public function createDepartment()
    {
            $validator = array('success' => false, 'messages' => array());


            $create = $this->common_model->insertNDepartment();                    
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




   public function all_Department_list()
    {
        
        $data['page_title'] = 'All Departments';
        $data['Departments'] = $this->common_model->get_all_Department();
       //  $data['Department'] = $this->common_model->select('Department_tbl');
       // $data['count'] = $this->common_model->get_Department_total();
        $data['main_content'] = $this->load->view('admin/department/departments', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    

public function updateDpt() {
            $validator = array('success' => false, 'messages' => array());

$dpt_id = $this->input->post('editdptid');
$dpt_name = $this->input->post('editdptname');

            $create =  $this->common_model->updateDptData($dpt_id,$dpt_name);
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
    public function fetchDepartmentUpdate() 
    {
    //  $id=this->input->post("invNo");
        $id = $this->uri->segment(4);
       
       // $compId=$this->session->userdata['id'];
        
         $DepartmentSelectedData = $this->common_model->get_departmentbyid($id);
foreach ($DepartmentSelectedData as $key => $dptvalue) {

$table='<label>Department Name</label>
        <span><input type="editdptname" name="editdptname" autocomplete="off"  style="text-transform: uppercase"  value="'.$dptvalue['department_name'].'" placeholder="Department Name" class="form-control" required></span>
        <input type="hidden" name="editdptid" id="editdptid"  value="'.$dptvalue['id'].'">';

}
          echo $table;


    
    }



}