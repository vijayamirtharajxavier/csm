<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subdivision extends CI_Controller {

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


public function deleteSDivRec()
{
    $id = $this->uri->segment(4);
            $validator = array('success' => false, 'messages' => array());


    $delete = $this->common_model->deleteSDiv($id);
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

    public function fetchSDivisionData()
    {
  //  $compId=$this->session->userdata['id']; 
   // $isItc=$this->session->userdata['isItc'];   
        $rw=1;
        $sdivisionallData = $this->common_model->get_all_sdivision();
        
        $result = array('data' => array());
        foreach($sdivisionallData as $key => $value) { 
       // $invno = "'" . $value['invoice_no'] . "'";
        $id = $value['id'];
   
 $button ='<div class="dropdown">
  <button type="button" class="btn btn-info btn-circle btn-xs"  href="#" data-toggle="modal" data-target="#edit-sdivision-modal" onclick="updateSDivisions(' . $id . ')"><i class="fa fa-edit"></i>
      </button>

  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs"  href="#" data-toggle="modal"  onclick="deleteSDivision(' . $id . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 

//      <a  target="_blank" href="'. $id .'" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs trigger-btn" role="button"  data-toggle="modal" data-original-title="Delete"><i class="fa fa-times"></i></a> 
 
    $result['data'][$key] = array(
              //  $rw,
                $value['id'],
                $value['subdivision_name'],
                //$pdfbtn,
                $button
            );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
    }


    public function createSDivision()
    {
            $validator = array('success' => false, 'messages' => array());


            $create = $this->common_model->insertNSDivision();                    
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




   public function all_sdivision_list()
    {
        $data['page_title'] = 'All Sub Divisions';
        $data['divisions'] = $this->common_model->get_all_sdivision();
       //  $data['division'] = $this->common_model->select('division_tbl');
       // $data['count'] = $this->common_model->get_division_total();
        $data['main_content'] = $this->load->view('admin/subdivision/subdivisions', $data, TRUE);
        $this->load->view('admin/index', $data);
    }





public function updateSDiv() {
            $validator = array('success' => false, 'messages' => array());

$sdiv_id = $this->input->post('editsdivid');
$sdiv_name = $this->input->post('editsdivname');

            $create =  $this->common_model->updateSDivData($sdiv_id,$sdiv_name);
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
    public function fetchSDivisionUpdate() 
    {
    //  $id=this->input->post("invNo");
        $id = $this->uri->segment(4);
       
       // $compId=$this->session->userdata['id'];
        
         $sdivisionSelectedData = $this->common_model->get_subdivisionbyid($id);
foreach ($sdivisionSelectedData as $key => $sdivvalue) {

$table='<label>Division Name</label>
        <span><input type="editsdivname" name="editsdivname" autocomplete="off"  style="text-transform: uppercase"  value="'.$sdivvalue['subdivision_name'].'" placeholder="Division Name" class="form-control" required></span>
        <input type="hidden" name="editsdivid" id="editsdivid"  value="'.$sdivvalue['id'].'">';

}
          echo $table;


    
    }



}