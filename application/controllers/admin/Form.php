<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form extends CI_Controller {

    public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');

    }

    public function index(){
        $data = array();
        $data['page_title'] = 'Calender';
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
	
	 public function form_basic(){
        $data = array();
        $data['page_title'] = 'Basic Form';
        $data['main_content'] = $this->load->view('admin/form/form_basic', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    
     public function form_member(){
        $data = array();
      //  $data['lastmember_id'] = $this->common_model->get_settings_id();
        $setid = $this->common_model->get_settings_id();

            foreach ($setid as $key=> $row)
       {
        $data['lastmember_id'] = $row['member_id'] . '/' . $row['year'];
        }

        $data['page_title'] = "Member's Form";
        $data['main_content'] = $this->load->view('admin/form/form_member', $data, TRUE);
        $this->load->view('admin/index', $data);
    }




    public function createNMember()
    {
            $validator = array('success' => false, 'messages' => array());


            $create = $this->common_model->insertNMember();                    
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
  


    public function createLApplication()
    {
            $validator = array('success' => false, 'messages' => array());


            $create = $this->common_model->insertLAppn();                    
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
  
    public function  fetchDivision()
    {
            $data = $this->common_model->get_division();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['division_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Choose</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /iffde
    }


    public function  fetchsubDivision($div_id = null)
    {
        if($div_id) {
            $data = $this->common_model->get_subdivision($div_id);
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['subdivision_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Select Sub Division</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    }

}

function get_autocomplete(){
    if (isset($_GET['term'])) {
        $result = $this->blog_model->get_memberlist($_GET['term']);
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'member_name'         => $row->member_name,
                    'member_id'   => $row->member_id,
                    'dob' => $row->dob
             );
                echo json_encode($arr_result);
        }
    }
}



    public function  fetchMemberlist($query = null)
    {

           $data = $this->common_model->get_member_list($query);
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                        $option .= '<option value="'.$value['member_id'].'">'. $value["member_id"] . " - " . $value['member_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0></option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
 }
    


    public function  fetchMemberlistbyId($query = null)
    {
   // $qry = $this->uri->segment(3); 
    $query  = $this->common_model->get_member_listbyId($query);
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

    public function  fetchMember($query = null)
    {
     
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
    
    public function  fetchMemberId()
    {
        $data = array();
     $keyword=$this->input->get('memid');
    $data  = $this->common_model->get_memberid($keyword);
        
        echo json_encode($data); 
    }            





    public function  fetchDepartment()
    {
        
            $data = $this->common_model->get_department();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['department_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Select Department</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

}
 
   public function  fetchSection()
    {
        
            $data = $this->common_model->get_section();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['section_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Select Section</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

}
 
   public function  fetchDesignation()
    {
        
            $data = $this->common_model->get_designation();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['designation'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Select Designation</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

}

     public function form_staff(){
        $data = array();
        $data['page_title'] = 'Staff Form';
        $data['main_content'] = $this->load->view('admin/form/form_staff', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    
     public function form_application(){
        $data = array();
        $setid = $this->common_model->get_settings_id();

            foreach ($setid as $key=> $row)
       {
        $data['lastapp_id'] = $row['app_number'] . '/' . $row['year'];
        }

        $data['page_title'] = 'Basic Form';
        $data['main_content'] = $this->load->view('admin/form/form_application', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function form_layout(){
        $data = array();
        $data['page_title'] = 'Form Layout';
        $data['main_content'] = $this->load->view('admin/form/form_layout', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_addon(){
        $data = array();
        $data['page_title'] = 'Form Addon';
        $data['main_content'] = $this->load->view('admin/form/form_addon', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_material(){
        $data = array();
        $data['page_title'] = 'Form Material';
        $data['main_content'] = $this->load->view('admin/form/form_material', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_float(){
        $data = array();
        $data['page_title'] = 'Form Float';
        $data['main_content'] = $this->load->view('admin/form/form_float', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
	
	 public function file_upload(){
        $data = array();
        $data['page_title'] = 'Form Upload';
        $data['main_content'] = $this->load->view('admin/form/file_upload', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_mask(){
        $data = array();
        $data['page_title'] = 'Form Mask';
        $data['main_content'] = $this->load->view('admin/form/form_mask', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_cropping(){
        $data = array();
        $data['page_title'] = 'Form Cropping';
        $data['main_content'] = $this->load->view('admin/form/form_cropping', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_validation(){
        $data = array();
        $data['page_title'] = 'Form Validation';
        $data['main_content'] = $this->load->view('admin/form/form_validation', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

 public function form_dropzone(){
        $data = array();
        $data['page_title'] = 'Form Dropzone';
        $data['main_content'] = $this->load->view('admin/form/form_dropzone', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_picker(){
        $data = array();
        $data['page_title'] = 'Form Picker';
        $data['main_content'] = $this->load->view('admin/form/form_picker', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_icheck(){
        $data = array();
        $data['page_title'] = 'Form Icheck';
        $data['main_content'] = $this->load->view('admin/form/form_icheck', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_wizard(){
        $data = array();
        $data['page_title'] = 'Form Wizard';
        $data['main_content'] = $this->load->view('admin/form/form_wizard', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

 public function form_typehead(){
        $data = array();
        $data['page_title'] = 'Form Typehead';
        $data['main_content'] = $this->load->view('admin/form/form_typehead', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_editable(){
        $data = array();
        $data['page_title'] = 'Form Editable';
        $data['main_content'] = $this->load->view('admin/form/form_editable', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_summernote(){
        $data = array();
        $data['page_title'] = 'Form Summernote';
        $data['main_content'] = $this->load->view('admin/form/form_summernote', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function form_wysihtml5(){
        $data = array();
        $data['page_title'] = 'Form Wysihtml5';
        $data['main_content'] = $this->load->view('admin/form/form_wysihtml5', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
	
	public function form_tinymyce(){
        $data = array();
        $data['page_title'] = 'Form Tinymyce';
        $data['main_content'] = $this->load->view('admin/form/form_tinymyce', $data, TRUE);
        $this->load->view('admin/index', $data);
    }



}