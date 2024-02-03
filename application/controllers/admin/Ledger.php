<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ledger extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
       $this->load->model('common_model');
       $this->load->model('login_model');
    }




public function deleteLdgRec()
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

   public function  fetchLedgerAccounts()
    {
        
            $data = $this->common_model->get_ldgacclist();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                        $option .= '<option value="'.$value['acclink_id'].'">'. $value["acclink_id"] . " - " . $value['account_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>SAME AS ABOVE ACCOUNT</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

}


   public function  fetchAccountType()
    {
        
            $data = $this->common_model->get_accttype();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                        $option .= '<option value="'.$value['id'].'">'. $value["cat_name"] . '</option>';
                }
                 // /foreach
              $option .= '<option selected value=0>Select a Accounts Type</option>';
            }
            else {
                $option = '<option value="0">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

}




    public function fetchLedgerData()
    {
  //  $compId=$this->session->userdata['id']; 
   // $isItc=$this->session->userdata['isItc'];   
        $rw=1;
        $LedgerallData = $this->common_model->get_all_Ledger();
        
        $result = array('data' => array());
        foreach($LedgerallData as $key => $value) { 
       // $invno = "'" . $value['invoice_no'] . "'";
        $id = $value['id'];
   
 $button ='<div class="dropdown">
  <button type="button" class="btn btn-info btn-circle btn-xs"  href="#" data-toggle="modal" data-target="#edit-Ledger-modal" onclick="updateLedger(' . $id . ')"><i class="fa fa-edit"></i>
      </button>

  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs"  href="#" data-toggle="modal"  onclick="deleteLedger(' . $id . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 

//      <a  target="_blank" href="'. $id .'" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs trigger-btn" role="button"  data-toggle="modal" data-original-title="Delete"><i class="fa fa-times"></i></a> 
 
    $result['data'][$key] = array(
              //  $rw,
                $value['id'],
                $value['account_name'],
                $value['account_type'],
                $value['acclink_id'],
                $value['op_balance'],
                //$pdfbtn,
                $button
            );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
    }


    public function createLedger()
    {
            $validator = array('success' => false, 'messages' => array());


            $create = $this->common_model->insertNLedger();                    
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




   public function all_Ledger_list()
    {
        $data['page_title'] = 'All Ledgers';
        $data['Ledgers'] = $this->common_model->get_all_Ledger();
       //  $data['Ledger'] = $this->common_model->select('Ledger_tbl');
       // $data['count'] = $this->common_model->get_Ledger_total();
        $data['main_content'] = $this->load->view('admin/ledger/ledger_master', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    

public function updateLdg() {

$validator = array('success' => false, 'messages' => array());

            $create =  $this->common_model->updateLdgtData();
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
    public function fetchLedgerUpdate() 
    {
    //  $id=this->input->post("invNo");
        $id = $this->uri->segment(4);
       
       // $compId=$this->session->userdata['id'];
        
         $LedgerSelectedData = $this->common_model->get_Ledgerbyid($id);
foreach ($LedgerSelectedData as $key => $ldgvalue) {

$table='<label>Ledger Name</label>
        <span><input type="text" autocomplete="off"  style="text-transform: uppercase" value="' . $ldgvalue['account_name'] . '" id="editldgname" name="editldgname" placeholder="Ledger Name" class="form-control" required></span>
<input type="hidden" name="editldgid" id="editldgid"  value="'.$ldgvalue['id'].'">
        <label>Account Type</label>

                                                    <select class="form-control" id="editldgaccttype" style="width: 100%;" name="editldgaccttype" value="'. $ldgvalue["account_type"].'" >';
           $data = $this->common_model->get_accttype();


                                                       foreach ($data as $key => $value) {
                                                        if ($value['id']==$ldgvalue['account_type']) 
                                                       // if($cbvalue["id"]==$rctvalue["cash_bank"])
                                                        {

                                                        $table .='<option selected value=' . $value["id"] . '>' . $value["cat_name"] . '</option>';
                                                        }
                                                        else {
                                                             $table .='<option value=' . $value["id"] . '>' . $value["cat_name"] . '</option>';

                                                        }
                                                           
                                                        }
                                                       
                                                       $table .='</select>';

        $table .='<label>Linked Account</label>
        <select id="editldgacctlink" name="editldgacctlink" class="form-control" style="width: 100%;" value="'. $ldgvalue["acclink_id"].'"><label>';
          $data = $this->common_model->get_all_Ledger();



foreach ($data as $key => $value) {
if ($ldgvalue['acclink_id']==$value['id']) 
                                                       // if($cbvalue["id"]==$rctvalue["cash_bank"])
{

$table .='<option selected value=' . $value["acclink_id"] . '>' . $value["account_name"] . '</option>';
}
else {
$table .='<option value=' . $value["acclink_id"] . '>' . $value["account_name"] . '</option>';

 														       
}
 

}
                                                       
    
         $table .='</select>Import AC Code</label>
<input type="text" name="editldgimportaccode" id="editldgimportaccode" value="'. $ldgvalue["import_account"] .'" class="form-control">

        <label>Opening Balance</label>
<input type="text" name="editldgopbalance" id="editldgopbalance" value="'. $ldgvalue["op_balance"] .'" class="form-control">';

      
}
          echo $table;


    
    }



}
