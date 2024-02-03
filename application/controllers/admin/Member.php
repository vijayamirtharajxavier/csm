<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
 
require_once 'vendor/autoload.php';

class Member extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
        $this->load->helper('form');
    }




public function deletememRec()
{
    $id = $this->uri->segment(4);
            $validator = array('success' => false, 'messages' => array());


    $delete = $this->common_model->deletemem($id);
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

    public function  fetchSubcaste()
    {
            $data = $this->common_model->get_subcaste();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['subcaste_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Choose</option>';
            }
            else {
                $option = '<option >No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    }

    public function  fetchCaste()
    {
            $data = $this->common_model->get_caste();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['caste_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Choose</option>';
            }
            else {
                $option = '<option >No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    }

    public function  fetchReligion()
    {
            $data = $this->common_model->get_religion();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['religion'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Choose</option>';
            }
            else {
                $option = '<option >No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
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
                $option = '<option >No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    }


    public function  fetchsubDivision()
    {
        
            $data = $this->common_model->get_subdivision();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['subdivision_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Select Sub Division</option>';
            }
            else {
                $option = '<option >No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

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
                $option = '<option >No Data</option>';
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
                $option = '<option >No Data</option>';
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
                $option = '<option >No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

}


    public function fetchMemberData()
    {
  //  $compId=$this->session->userdata['id']; 
   // $isItc=$this->session->userdata['isItc'];   
        $rw=1;
        $MemberallData = $this->common_model->get_all_Member();
        
        $result = array('data' => array());
        foreach($MemberallData as $key => $value) { 
       // $invno = "'" . $value['invoice_no'] . "'";
        $id = $value['id'];
   
 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#edit-Member-modal" onclick="updateMembers(' . $id . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deleteMember(' . $id . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 

//      <a  target="_blank" href="'. $id .'" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs trigger-btn" role="button"  data-toggle="modal" data-original-title="Delete"><i class="fa fa-times"></i></a> 

    $result['data'][$key] = array(
              //  $rw,
                $value['member_id'],
                $value['member_name'],
                $value['mobile_no'],
                $value['dob'],
                $value['doj'],
                $value['division_name'],
              //  $value['department_name'],
              //  $value['section_name'],
                $value['designation'],
              //  $value['loan_amount'],
                $value['loan_outstanding'],
                $value['share_capital'],
                $value['thrift_opbal'],
                //$pdfbtn,
                $button
            );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
    }

        public function do_upload()
        {
                $config['upload_path']          = './uploads/members/';
                $config['allowed_types']        = 'gif|jpg|png|pdf';
                $config['max_size']             = 10000;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 800;
 // $config['encrypt_name'] = TRUE;
 // $new_name = time().$_FILES["userfile"]['name'];
 // $config['filename'] = $new_name;
//  $this->upload->initialize($config);
 // $this->load->library('upload', $config);
  //$this->upload->do_upload('filename');
 // $new_filename=$this->upload->data('filename');


                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        //$this->load->view('admin/upload_form', $error);
                        var_dump($error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
//$data['userfile'] = $upload_data['file_name'];
//                        $this->load->view('admin/upload_success', $data);
  
            $validator = array('success' => false, 'messages' => array());

//$memberFile = $_POST('userfile');

    //       $flupload = $this->do_upload();

            $create = $this->common_model->insertMember($data);                    
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
        }





function phoneimport()
{
  if(isset($_FILES["file"]["name"]))
  {
              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
              print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);

               for ($i=2; $i <=$arrayCount; $i++) { 
                // print_r($allDataInSheet[$i]['A']);
                 $memberNum = $allDataInSheet[$i]['A'];
                 $mobileNum = $allDataInSheet[$i]['B'];
                 
     $data[] = array(
      
      'mobile_no'   => $mobileNum
     );
    
    $this->db->where('member_id',$memberNum);
     $update = $this->db->update('members_tbl',$data);
     
    }
   


   return ($status === true ? true : false); 
   //$this->excel_import_model->insert($data);
   echo 'Data Imported successfully';

  } 

}



    // checkFileValidation
    public function checkFileValidation($string) {
      $file_mimes = array('text/x-comma-separated-values', 
        'text/comma-separated-values', 
        'application/octet-stream', 
        'application/vnd.ms-excel', 
        'application/x-csv', 
        'text/x-csv', 
        'text/csv', 
        'application/csv', 
        'application/excel', 
        'application/vnd.msexcel', 
        'text/plain', 
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
      );
      if(isset($_FILES['file']['name'])) {
            $arr_file = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);
            if(($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['file']['type'], $file_mimes)){
                return true;
            }else{
                $this->form_validation->set_message('checkFileValidation', 'Please choose correct file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
            return false;
        }
    }



 function importPhonenumbers()
 {
  if(isset($_FILES["file"]["name"]))
  {
   $path = $_FILES["file"]["tmp_name"];
   $object = PHPExcel_IOFactory::load($path);
   foreach($object->getWorksheetIterator() as $worksheet)
   {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    for($row=2; $row<=$highestRow; $row++)
    {
     $member_no = $worksheet->getCellByColumnAndRow(0, $row)->getValue(); 
     $member_mobile = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
     $data[] = array(
      
      'mobile_no'   => $member_mobile
     );
    
    $this->db->where('member_id',$member_no);
     $update = $this->db->update('members_tbl',$data);
     
    }
   


   }

   return ($status === true ? true : false); 
   //$this->excel_import_model->insert($data);
   echo 'Data Imported successfully';
  } 

 }


 function phonefetch()
 {
  $data = $this->common_model->Phoneselect();
  $output = '
  <h3 align="center">Total Data - '.$data->num_rows().'</h3>
  <table class="table table-striped table-bordered">
   <tr>
    <th>MEMBER NO</th>
    <th>MEMBER NAME</th>
    <th>DOB</th>
    <th>DOJ</th>
    <th>MOBILE NO</th>
   </tr>
  ';
  foreach($data->result() as $row)
  {
   $output .= '
   <tr>
   <td>'.$row->member_id.'</td>
    <td>'.$row->member_name.'</td>
    <td>'.$row->dob.'</td>
    <td>'.$row->doj.'</td>
    <td>'.$row->mobile_no.'</td>
    
   </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }





  function excelimport()
  {
         $data = array();
        $data['page_title'] = 'Update Mobile Numbers';


        $data['main_content'] = $this->load->view('admin/members/member_phonelist', $data, TRUE);
        $this->load->view('admin/index', $data);

  }






public function fileupload()
{

    $this->load->view('admin/upload_form');
}

    public function createMember()
    {
            $validator = array('success' => false, 'messages' => array());

//$memberFile = $_POST('userfile');

    //       $flupload = $this->do_upload();

            $create = $this->common_model->insertMember();                    
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


    public function updateMember()
    {
            $validator = array('success' => false, 'messages' => array());

            $create = $this->common_model->updateMember();  


            if($create === true) {
                $validator['success'] = true;
                $validator['messages'] = "Successfully updated";
                
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Error while inserting the information into the database";
            }           
echo json_encode($validator);
    }



   public function all_Member_list()
    {
        $setid = $this->common_model->get_settings_id();

            foreach ($setid as $key=> $row)
       {
        $data['lastmember_id'] = $row['member_id']; // . '/' . $row['year'];
        }

        $data['page_title'] = 'All Members';
        $data['Members'] = $this->common_model->get_all_Member();
       //  $data['Member'] = $this->common_model->select('Member_tbl');
       // $data['count'] = $this->common_model->get_Member_total();
        $data['main_content'] = $this->load->view('admin/members/members', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    

public function updatemem() {
            $validator = array('success' => false, 'messages' => array());

$mem_id = $this->input->post('editmemid');
$mem_name = $this->input->post('editmemname');

            $create =  $this->common_model->updatememData($mem_id,$mem_name);
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
    public function fetchMemberUpdate() 
    {
    //  $id=this->input->post("invNo");
        $id = $this->uri->segment(4);
       
       // $compId=$this->session->userdata['id'];
    $reloption="";    

    $MemberSelectedData = $this->common_model->get_member_byid($id);
foreach ($MemberSelectedData as $key => $memvalue) {

    $rel_id= $memvalue["religion"];
    $reldata = $this->common_model->get_religion();

    //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
    if($reldata) {
        foreach ($reldata as $key => $value) {
            if($rel_id==$value["id"]) {
                
                $reloption .= '<option selected value="'.$value['id'].'">'.$value['religion'].'</option>';
            }
            else 
            {
                $reloption .= '<option value="'.$value['id'].'">'.$value['religion'].'</option>';
            }
        }
         // /foreach
       // $reloption .= '<option selected value=0>Choose</option>';
    }
    else {
        $reloption = '<option >No Data</option>';
    } // /else empty section

    $divoption="";
    $divdata = $this->common_model->get_division();
    
    if($divdata) {
        $divoption .= '<option disabled value="0">Select a Division</option>';
        foreach ($divdata as $value) {
          $divid=$memvalue['division_id'];
           if($divid==$value["id"]) {
            $divoption .= '<option selected value="'.$value['id'].'">'.$value['division_name'].'</option>';
        }
        else
        {
        $divoption .= '<option value="'.$value['id'].'">'.$value['division_name'].'</option>';
        }

}
 
    


    }
    else {
        $divoption = '<option >No Data</option>';
    } // /else empty section

$secoption ="";
$data = $this->common_model->get_section();
//$sectionData = $this->model_section->fetchSectionDataByClass($classId);
if($data) {
    $secoption .= '<option disabled value="0">Select a Section</option>';
    foreach ($data as $key => $value) {
        $secid = $memvalue["section_id"];
        if($secid==$value["id"]) {
       
        $secoption .= '<option selected value="'.$value['id'].'">'.$value['section_name'].'</option>';
    }
    else {
        $secoption .= '<option value="'.$value['id'].'">'.$value['section_name'].'</option>';
    }
     // /foreach
    //$option .= '<option selected value=0>Select Section</option>';
}
}
else {
    $secoption = '<option >No Data</option>';
} // /else empty section


$dsgoption="";        
$data = $this->common_model->get_designation();
//$sectionData = $this->model_section->fetchSectionDataByClass($classId);
if($data) {
    $dsgoption .= '<option disabled value="0">Select a Designation</option>';
    foreach ($data as $key => $value) {
        $dsgid=$memvalue["designation_id"];
        if($dsgid==$value['id']) {
        $dsgoption .= '<option selected value="'.$value['id'].'">'.$value['designation'].'</option>';
    }
    else {
        $dsgoption .= '<option value="'.$value['id'].'">'.$value['designation'].'</option>';
    }
     // /foreach
}
}
else {
    $dsgoption = '<option >No Data</option>';
} // /else empty section




$casteoption="";
$data = $this->common_model->get_caste();
//$sectionData = $this->model_section->fetchSectionDataByClass($classId);
if($data) {
    $casteoption .= '<option disabled value="0">Select a Caste</option>';
    foreach ($data as $key => $value) {
        $casteid= $memvalue['caste'];
        if($casteid==$value['id']) {
        $casteoption .= '<option selected value="'.$value['id'].'">'.$value['caste_name'].'</option>';
    }
    else {
        $casteoption .= '<option value="'.$value['id'].'">'.$value['caste_name'].'</option>';
    }
     // /foreach
}
}
else {
    $casteoption = '<option >No Data</option>';
} // /else empty section




$subcasteoption="";
$data = $this->common_model->get_subcaste();
//$sectionData = $this->model_section->fetchSectionDataByClass($classId);
if($data) {
    $subcasteoption .= '<option disabled value="0">Select a SubCaste</option>';
    foreach ($data as $key => $value) {
        $subcasteid = $memvalue["subcaste"];
        if($subcasteid==$value["id"]) {
        $subcasteoption .= '<option selected value="'.$value['id'].'">'.$value['subcaste_name'].'</option>';
    }
     // /foreach
    else {
        $subcasteoption .= '<option value="'.$value['id'].'">'.$value['subcaste_name'].'</option>';
    }
}
}
else {
    $subcasteoption = '<option >No Data</option>';
} // /else empty section







$dptoption="";        
    $dptdata = $this->common_model->get_department();
    //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
    if($dptdata) {
        $dptoption .= '<option disabled value="0">Select a Department</option>';
        foreach ($dptdata as $key => $value) {
            $dptid = $memvalue["dept_id"];
            if($dptid==$value["id"]) {
            $dptoption .= '<option selected value="'.$value['id'].'">'.$value['department_name'].'</option>';
        }
        else {
            $dptoption .= '<option  value="'.$value['id'].'">'.$value['department_name'].'</option>';
        }
         // /foreach
    }
    
    }
    else {
        $option = '<option >No Data</option>';
    } // /else empty section

    
    

$fhoption=""; 
$checkflag="1";       
    $fhdata = $this->common_model->get_combo($checkflag);
    //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
    if($fhdata) {
       $fhoption .= '<option disabled value="0">Select a Spouse/Husbund</option>'; 
        foreach ($fhdata as $key => $fhvalue) {
            $fhid = $memvalue["father_husband"];
            if($fhid==$fhvalue["flag"]) {
            $fhoption .= '<option selected value="'.$fhvalue['flag'].'">'.$fhvalue['name'].'</option>';
        }
        else {
            $fhoption .= '<option  value="'.$fhvalue['flag'].'">'.$fhvalue['name'].'</option>';
        }
         // /foreach
    }
    
    }
 
$checkflag="2"; 
$genoption="";      
    $gendata = $this->common_model->get_combo($checkflag);
    //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
    if($gendata) {
        foreach ($gendata as $key => $genvalue) {
            $genid = $memvalue["gender"];
            if($genid==$genvalue["flag"]) {
            $genoption .= '<option selected value="'.$genvalue['flag'].'">'.$genvalue['name'].'</option>';
        }
        else {
            $genoption .= '<option  value="'.$genvalue['flag'].'">'.$genvalue['name'].'</option>';
        }
         // /foreach
    }
    
    }

$checkflag="3"; 
$maroption="";      
    $mardata = $this->common_model->get_combo($checkflag);
    //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
    if($mardata) {
        foreach ($mardata as $key => $marvalue) {
            $marid = $memvalue["marital"];
            if($marid==$marvalue["flag"]) {
            $maroption .= '<option selected value="'.$marvalue['flag'].'">'.$marvalue['name'].'</option>';
        }
        else {
            $maroption .= '<option  value="'.$marvalue['flag'].'">'.$marvalue['name'].'</option>';
        }
         // /foreach
    }
    
    }


$checkflag="4"; 
$memoption="";      
    $memdata = $this->common_model->get_combo($checkflag);
    //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
    if($memdata) {
        foreach ($memdata as $key => $mvalue) {
            $memid = $memvalue["member_staff"];
            if($memid==$mvalue["flag"]) {
            $memoption .= '<option selected value="'.$mvalue['flag'].'">'.$mvalue['name'].'</option>';
        }
        else {
            $memoption .= '<option  value="'.$mvalue['flag'].'">'.$mvalue['name'].'</option>';
        }
         // /foreach
    }
    
    }





$accstsoption="";      
//    $memdata = $this->common_model->get_accsts($);
    //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            $accsts = $memvalue["account_close"];

//$accstsoption .= '<option value=0>Active</option><option value=1>Close</option>';

        if($accsts==0) {
            $accstsoption .='<option selected value=0>Active</option>';
            $accstsoption .='<option value=1>Close</option>';
  
        }
        else {
            $accstsoption .='<option selected value=1>Close</option>';
            $accstsoption .='<option value=0>Active</option>';
        }
         // /foreach

    
    $dob = date("Y-m-d", strtotime($memvalue['dob']));
    $doj = date("Y-m-d", strtotime($memvalue['doj']));

//print_r($doj);

$table='<div class="form-row container"> <div class="col-md-4 mb-3"><label for="editmemberName">Member No & Name</label> <div class="input-group"><input type="text" class="form-control" id="editmemberNumber" name="editmemberNumber" value="' . $memvalue["member_id"] . '"
><div class="input-group-append"> <span><input type="text" class="form-control" name="editmemberName"
            id="editmemberName" placeholder="Member Name" value="'. $memvalue["member_name"] . '"></span></div>
</div>
</div>
<div class="col-md-4"><label for="editfh_Name">Father`s/Spouse name</label>
    <div class="input-group"><input type="text" class="form-control" value="'. $memvalue["fahu_name"] . '" name="editfh_Name" id="editfh_Name"
            placeholder="Father`s / Spouse name">
        <div class="input-group-append"><span><select class="prepand form-control" name="editcheck_fh"
                    id="editcheck_fh">
      "'. $fhoption .'"                </select> </span></div>
    </div>
</div>
<div class="col-md-2"><label for="editmemberGender">Gender</label>

<select class="prepand form-control" name="editmemberGender"
                    id="editmemberGender">
      "'. $genoption .'"</select>
</div>
<div class="col-md-2"><label for="maritalStatus">Gender</label>

<select class="prepand form-control" name="maritalStatus"
                    id="maritalStatus">
      "'. $maroption .'"</select>
</div>
<div class="col-md-2"><label for="maritalStatus">Marital </label> <select class="prepand form-control"
        name="editmaritalStatus" id="editmaritalStatus">
        <option value="0">Married</option>
        <option value="1">UnMarried</option>
        <option value="2">Divorce</option>
        <option value="3">Divorcee</option>
    </select> </div>
</div> <!-- Row 2 -->
<div class="form-row container">
    <div class="col-md-3 mb-3">
    <label for="dbirth">Date of Birth</label>
    <input type="date" class="form-control" value="' . $dob . '" id="editdob" name="editdob"> 
    </div>
      
    
    <div class="col-md-3 mb-3">
    <label for="djoin">Date of Join</label>
       <input type="date"  value="'. $doj .'" class="form-control" id="editdoj" name="editdoj">
      </div>
    
    <div class="col-md-3 mb-3"><label for="mobile">Mobile No.</label>
        <div class="input-group"><input type="text" class="form-control" value="' . $memvalue["mobile_no"]. ' "  name="editmobile" id="editmobile"
                name="editmobile" placeholder="Mobile Number" ></div>
    </div>
    <div class="col-md-3 mb-3"><label for="landline">Landline / PP</label>
        <div class="input-group"><input type="text" class="form-control" value="' . $memvalue["landline_no"]. ' "  id="editlandline" name="editlandline"
                placeholder="Landline Number" ></div>
    </div>
</div> <!-- Row 3 -->
<div class="form-row container">
    <div class="col-md-3 mb-3"><label for="editresaddr">Resident Address</label><input type="text"
            class="form-control" name="editresaddr" value="' . $memvalue["resident_add"] . '" id="editresaddr" placeholder="Address..."></div>
    <div class="col-md-3 mb-3"><label for="editaadhar">Aadhar Number</label>
        <div class="input-group"><input type="text" value="' . $memvalue["aadhar_id"] . '" class="form-control" id="editaadhar" name="editaadhar"
                placeholder="Aadhar Number" ></div>
    </div>
    <div class="col-md-3 mb-3"><label for="editpan">PAN Number</label>
        <div class="input-group"><input type="text"  value="' . $memvalue["pan_no"] . '" class="form-control" id="editpan" name="editpan"
                placeholder="PAN Number" ></div>
    </div>
    <div class="col-md-3 mb-3"><label for="validationServer02">E-Mail Address</label>
        <div class="input-group"><input type="email" value="' . $memvalue["email_id"] . '" class="form-control" id="editemail" name="editemail"
                placeholder="email address"></div>
    </div>
</div> <!-- Row 4 -->
<div class="form-row container">
    <div class="col-md-3 mb-3"><label for="employee_id">Employee ID</label><input type="text"
            class="form-control" name="editemp_id" value="' . $memvalue["employee_id"] . '" id="editemp_id" placeholder="Employee ID"></div>
    <div class="col-md-3 mb-3"><label for="division">Division</label><select name="editdivision" class="form-control"
            id="editdivision">
            ' . $divoption .' </select>
<input type="text" name="editdivision_id" id="editdivision_id" hidden>
<input type="text" name="editdesignation_id" id="editdesignation_id" hidden><input type="text" name="editsection_id"
    id="editsection_id" hidden><input type="text" name="editdepartment_id" id="editdepartment_id" hidden><input
    type="text" name="editreligion_id" id="editreligion_id" hidden><input type="text" name="editcaste_id"
    id="editcaste_id" hidden><input type="text" name="editeditsubcaste_id" id="editsubcaste_id" hidden> </div>
<div class="col-md-3 mb-3"><label for="validationServer02">Department</label><select name="editeditdepartment"
        class="form-control" id="editdepartment">
        '. $dptoption .'
    </select></div>
<div class="col-md-3 mb-3"><label for="validationServer02">Designation</label><select name="editdesignation"
        class="form-control" id="editdesignation">
        '. $dsgoption .'
    </select></div>
</div> <!-- Row 5 -->
<div class="form-row container">
    <div class="col-md-3 mb-3"><label for="validationServer02">Section</label><select name="editsection"
            class="form-control" id="editsection">
            '. $secoption .'
        </select></div>
    <div class="col-md-3 mb-3"><label for="validationServer02">Religion</label><select name="editreligion"
            class="form-control" id="editreligion">
            '. $reloption .'
        </select></div>
    <div class="col-md-3 mb-3"><label for="caste">Caste</label><select name="editcaste" class="form-control"
            id="editcaste">
            '. $casteoption .'
        </select></div>
    <div class="col-md-3 mb-3"><label for="validationServer02">Sub Caste</label><select name="editsubcaste"
            class="form-control" id="editsubcaste">
            '. $subcasteoption .'
        </select></div>
</div> <!-- Row 6 -->
<div class="form-row container">
    <div class="col-md-4 mb-3"><label for="suretyid">Surety Link</label>
        <div class="input-group"><input type="text" class="form-control" value="'. $memvalue["surety_id"] . '" id="editsurety_id"
                name="editsurety_id">
            <div class="input-group-append"> <span><input type="text" class="form-control"
                        name="editsurety_name" id="editsurety_name" placeholder="Surety name" value="' .
                $memvalue["surety_name"] . '"></span></div>
        </div>
    </div>

    <div class="col-md-2 mb-3"><label for="mSuretyCapital">Share Capital Op</label><input type="text"
            class="form-control" id="editmSuretyCapital"  value="' . $memvalue["share_capital"] . '" name="editmSuretyCapital"></div>
    <div class="col-md-2 mb-3"><label for="mthriftopbal">Thrift OpBalance</label><input type="text"
            class="form-control" id="editmthriftopbal"  value="' . $memvalue["thrift_opbal"] . '" name="editmthriftopbal"></div>
    <div class="col-md-2 mb-3"><label for="loanopbal">Loan Op Balance</label><input type="text"
            class="form-control" id="editloanopbal"  value="' . $memvalue["loan_opbal"] . '" name="editloanopbal"></div>
    <div class="col-md-2 mb-3"><label for="loanoutstanding">Loan Outstanding</label><input type="text"
            class="form-control" id="editloanoutstanding"  value="' . $memvalue["loan_outstanding"] . '" name="editloanoutstanding"></div>
</div> <!-- Row 7 -->
<div class="form-row container">
    <div class="col-md-2 mb-3"><label for="validationServer02">Thrift Monthly</label><input type="text"
            class="form-control" name="edittrfmon" value="' . $memvalue["thrift_monthly"] . '" id="edittrfmon" placeholder="Thrift Monthly" >
    </div>
    <div class="col-md-2 mb-3"><label for="validationServer02">Rate of Interest</label><input type="text"
            class="form-control" id="editroi" value="' . $memvalue["rate_of_interest"] . '" name="editroi"></div>
    <div class="col-md-2 mb-3"><label for="validationServer02">No of Installments</label><input type="text"
            class="form-control" id="editnoi" value="' . $memvalue["no_installment"] . '" name="editnoi"></div>
    <div class="col-md-2 mb-3"><label for="validationServer02">Principle Amount</label><input type="text"
            class="form-control" id="editprinamt" value="' . $memvalue["principle_amount"] . '" name="editprinamt"></div>
<div class="col-md-2"><label for="editmemstf">Gender</label>

<select class="prepand form-control" name="editmemstf"
                    id="editmemstf">
      "'. $memoption .'"</select>
</div>
<div class="col-md-2"><label for="editaccstf">Account Status</label>

<select class="prepand form-control" name="editaccsts"
                    id="editaccsts">' . $accstsoption . ' </select>
</div>

</div>' ;


} echo $table; } }