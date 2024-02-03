<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
 
require_once 'vendor/autoload.php';

class Journal extends CI_Controller {

    public function __construct(){
        parent::__construct();
        check_login_user(); 
        $this->load->model('common_model');
       // $this->load->library('excel');
        
       // $this->excel = new PHPExcel();   

    }
    

public function impExcel()
{


 if(isset($_FILES["file"]["name"]))
  {
$file = $_FILES["file"]["name"];
//var_dump($file);

/*
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
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
$jvmonth = $allDataInSheet[2]['I'];*/
}
 
//load the excel library
$this->load->library('excel');
$objReader = PHPExcel_IOFactory::createReader($file);
$objPHPExcel = $objReader->load($inputFileName); 
//read file from path
//$objPHPExcel = PHPExcel_IOFactory::createReader($file);
 
//get only the Cell Collection
$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
 
//extract to a PHP readable array format
foreach ($cell_collection as $cell) {
    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
 
    //The header will/should be in row 1 only. of course, this can be modified to suit your need.
    if ($row == 1) {
        $header[$row][$column] = $data_value;
 

    } else {
        $arr_data[$row][$column] = $data_value;
 


    }
}

var_dump($header);
var_dump($arr_data);


 
//send the data in an array format
$data['header'] = $header;
$data['values'] = $arr_data;  
}

    public function index(){
        $data = array(); 
        $data['page_title'] = 'Dashboard';
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data); 
    }

    public function Journal_invoice(){
        $data = array();
        $data['page_title'] = 'Journal Invoice';
        $data['main_content'] = $this->load->view('admin/journal/journal_invoice', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


  public function allinoneimport()
  {
    $data = array(); 
        $data['page_title'] = 'Import Data';
        

        $data['main_content'] = $this->load->view('admin/journal/import_view', $data, TRUE);
        $this->load->view('admin/index', $data);

  }


    public function all_Journal(){
        $data = array();
        $data['page_title'] = 'All Journals';
        $data['subacc'] = $this->common_model->get_subaccount();
        $setid = $this->common_model->get_settings_id();
 
            foreach ($setid as $key=> $row)
       {
        $data['journal_id'] = $row['journal_id'] . '/' . $row['year'];
        }


        $data['main_content'] = $this->load->view('admin/journal/all_journal', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function gl_Journal(){
        $data = array();
        $data['page_title'] = 'All Journals';
        //$data['subacc'] = $this->common_model->fetchLedgerGLSubData($ $ld_id = null,$fdt=null, $tdt=null,$actid=null);
        $setid = $this->common_model->get_settings_id();
 
            foreach ($setid as $key=> $row)
       {
        $data['journal_id'] = $row['journal_id'] . '/' . $row['year'];
        }


        $data['main_content'] = $this->load->view('admin/journal/gl_journal', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


public function getDivMem()
{
$mon = $this->input->get("paymon");
$finyear=$this->session->userdata('finyear');
$data=array();
$dmdata=array();

      $divdata = $this->common_model->get_division();
      if($divdata)
      {
        foreach ($divdata as $key => $divvalue) {
        $divid = $divvalue['division_id'];
        $divname = $divvalue['division_name'];

$divmemData = $this->common_model->getDivMemData($divid,$mon,$finyear);
     if($divmemData)
     {
      foreach ($divmemData as $key => $dmvalue) {
        
$ldgdata = $this->common_model->fetchledgerOp($dmvalue['account_id']);
if($ldgdata)
{
  foreach ($ldgdata as $key => $lgvalue) {
    $accname= $lgvalue['account_name'];
  }
}

        $dmdata[] = array("account_id"=>$dmvalue['account_id'],"cr_account_id"=>$dmvalue['cr_account_id'],"account_name"=>$accname, "trans_amount"=>$dmvalue['trans_amount'],"trans_type"=>$dmvalue['trans_type']);    //array("divid"=>$divid,"divname"=>$divname);
      }

     }

     $data[]=array("divid"=>$divid,"divname"=>$divname,"members"=>$dmdata);
     $dmdata=array();
      }
    }
//echo(json_encode(["last_page"=>30, "data"=>$data]));
echo json_encode($data);


}



public function getMemAcc()
{
$mon = $this->input->get("mon");
$finyear=$this->session->userdata('finyear');
$rpt="";
$tot=0;
$tbl="";
$tblhead="";
$itmData=$this->common_model->getImpAccHead();
if($itmData)
{
  foreach ($itmData as $key => $itmvalue) {
   
$rpt .= "SUM(CASE WHEN (cr_account_id='" . $itmvalue['acclink_id'] . "' and trans_type='JOUR') THEN trans_amount else 0 END)AS `". $itmvalue['import_account'] ."`,";

$tblhead .= "<th>". $itmvalue['account_name'] ."</th>";
  }

}
$rcpfilter = rtrim($rpt, ',');
$data=array();
$memmast = $this->common_model->get_memberlist();
if($memmast)
{
  foreach ($memmast as $key => $memvalue) {
    
$acid = $memvalue['member_id'];


$rctData=$this->common_model->getMAImpData($acid,$finyear,$rcpfilter);
//var_dump($rctData);
if($rctData)
{
 //print_r($rctData); 
//$itmData=$this->common_model->getItemMaster();  
  $ctbl="";
foreach ($rctData as $key => $value) {
  # code...

$memid= $value['acclink_id'];
$memname=$value['account_name'];

foreach ($itmData as $key => $imvalue) {
//print_r($itmData);
$ac = $imvalue['import_account'];
$accname = $memvalue['member_name'];
//print_r($ac);
$tot = $tot+ $value[$ac];

$ctbl  .= "<td style='text-align:right'>" . number_format($value[$ac],2) . "</td>";

//$data[]= array("memid"=>$value['acclink_id'],"memname"=>$value['account_name']);

}


$tbl  .= "<tr><td>" . $accname . "<td>" . $ctbl ."<td style='text-align:right'>". number_format($tot,2)  ."</td></tr>";

$tot=0;
}
}

  }
$thead ="<th colspan='2'>NAME</th>" . $tblhead . "<th>TOTAL</th>";
echo $thead;
echo $tbl;

}




$tbl ='';
$tot=0;
/*$rctData=$this->common_model->getMAImpData($mon,$finyear,$sql);

if($rctData)
{
  foreach ($rctData as $key => $rctvalue) {
    
  foreach ($cbkDate as $key => $cbvalue) {
  
$ac = $cbvalue['import_account'];
$accname = $cbvalue['account_name'];
$tot = $tot+ $rctvalue[$ac];

$tbl  .= "<tr><td>" . $accname . "<td><td style='text-align:right'>" . number_format($rctvalue[$ac],2) . "</td></tr>";

  }


  }
}
$tbl .="<tr><td style='font-weight:bold'>TOTAL<td><td style='text-align:right;font-weight:bold'>" . number_format($tot,2) . "</td></tr>";
echo $tbl;

*/
  //echo "Successfully " . $mon;
}





public function getPayment()
{
  $mon = $this->input->get("paymon");
$finyear=$this->session->userdata('finyear');
$rpt="";
$cbkDate=$this->common_model->getBankCash();
if($cbkDate)
{
  foreach ($cbkDate as $key => $cbvalue) {
   
$rpt .= "SUM(CASE WHEN account_id='" . $cbvalue['acclink_id'] . "' and (trans_type='PYMT' or trans_type='CNTR') THEN trans_amount else 0 END)AS `". $cbvalue['import_account'] ."`,";
  }

}

$rcpfilter = rtrim($rpt, ',');

//$sql="SELECT " . $rcpfilter . "  FROM `soc_trans_tbl` WHERE month(trans_date)='04' AND trans_type='PYMT' ORDER BY trans_date";
//print_r($sql);

$tbl ='';
$tot=0;
$acct_type="PYMT";
$rctData=$this->common_model->getImpData($mon,$finyear,$acct_type,$rcpfilter);

if($rctData)
{
  foreach ($rctData as $key => $rctvalue) {
    
  foreach ($cbkDate as $key => $cbvalue) {
  
  $ac = $cbvalue['import_account'];

  $accname = $cbvalue['account_name'];
 $tot = $tot+ $rctvalue[$ac];
  $tbl  .= "<tr><td>" . $accname . "<td><td style='text-align:right'>" . number_format($rctvalue[$ac],2) . "</td></tr>";

  }


  }
}
$tbl .="<tr><td style='font-weight:bold'>TOTAL<td><td style='text-align:right;font-weight:bold'>" . number_format($tot,2) . "</td></tr>";
echo $tbl;
  //echo "Successfully " . $mon;
}



public function getReceipt()
{
  $mon = $this->input->get("rctmon");
$finyear=$this->session->userdata('finyear');
$rpt="";
$tot=0;
$cbkDate=$this->common_model->getBankCash();
if($cbkDate)
{
  foreach ($cbkDate as $key => $cbvalue) {
   
$rpt .= "SUM(CASE WHEN account_id='" . $cbvalue['acclink_id'] . "' and trans_type='RCPT' THEN trans_amount else 0 END)AS `". $cbvalue['import_account'] ."`,";
  }

}

$rcpfilter = rtrim($rpt, ',');

//$sql="SELECT " . $rcpfilter . "  FROM `soc_trans_tbl` WHERE month(trans_date)='04' AND trans_type='RCPT' ORDER BY trans_date";
//print_r($sql);

$tbl ='';
$acct_type="RCPT";
$rctData=$this->common_model->getImpData($mon,$finyear,$acct_type,$rcpfilter);

if($rctData)
{
  foreach ($rctData as $key => $rctvalue) {
    



  foreach ($cbkDate as $key => $cbvalue) {
  
  $ac = $cbvalue['import_account'];

  $accname = $cbvalue['account_name'];
 $tot = $tot+ $rctvalue[$ac];

  $tbl  .= "<tr><td>" . $accname . "<td><td style='text-align:right'>" . number_format($rctvalue[$ac],2) . "</td></tr>";

  }


  }
}
$tbl .="<tr><td style='font-weight:bold'>TOTAL<td><td style='text-align:right; font-weight:bold;'>" . number_format($tot,2) . "</td></tr>";

echo $tbl;
  //echo "Successfully " . $mon;
}


    public function fetchJournalSearch()
    {

    $fdt=$this->input->get('fdate');
    $tdt=$this->input->get('tdate');
    
        $rw=1;
        $JournalfilterData = $this->common_model->fetchJournalDatefilter($fdt,$tdt);
        $sresult = array();
        $result =array();
        foreach($JournalfilterData as $key => $value) { 


            //<li><a href="#" data-toggle="modal" data-target="#printInvoiceModal" onclick="viewInvoice('. $value['id'] .')">View</a></li> 
            //$pdfbtn ='<div classs="btn-group"><a href="#" onclick="topdf('. $value['id'] .')"><i class="fa fa-car"></a></i></div>';


 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#edit-Payment-modal" onclick="updatejournal("' . $value['id'] . '")"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deletejournal("' . $value['id'] . '")"><i class="fa fa-times"></i>
      </button>

  
</div>'; 


    $trnref = "";
    $trnamt = "";
    $itmnam = "";

       $subData = $this->common_model->fetchJournalSubData($value['journal_number']);
 
       foreach($subData as $key => $svalue) { 
        $trnref = $svalue['trans_ref'];
        $trnamt = $svalue['trans_amount'];
        $itmnam = $svalue['item_name'];

       $sresult[] = array(
            "trans_ref" => $svalue['trans_ref'],
            "item_name" => $svalue['item_name'],
            "item_amount" => $svalue['trans_amount']
        ); 
 }


    $result[] = array(
                //$rw,
                "division_id" => $value['debitaccount_number'],
                "journal_number"=>$value['journal_number'],
                "journal_date"=>$value['journal_date'],
                "debit_accountname"=>$value['debit_accountname'],
                "credit_accountname"=>$value['credit_accountname'],
                "debit_amount"=>$value['debit_amount'],
                "credit_amount"=>$value['credit_amount'],
                "narration"=>$value['journal_narration'],
                "action" => $button
                ,"subdata" => $sresult);  
            $rw=$rw+1;
    
  $sresult='';
        }
  $sresult='';

        echo json_encode($result);
    }
        


    public function fetchJournalData()
    {
    $sdt=$this->input->post('fdate');
    $edt=$this->input->post('tdate');
        $rw=1;
        $JournalallData = $this->common_model->fetchJournalAllData($sdt,$edt);
        
        $result = array('data' => array());

        foreach($JournalallData as $key => $value) { 
//$invno = "'" . $value['invoice_no'] . "'";
$jvid = "'" . $value['journal_number'] . "'";

 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#edit-Payment-modal" onclick="updateJournal(' .$value['id'] . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deleteJournal(' . $jvid . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 

   $result['data'][$key] = array(
                //$rw,
                "division_id" => $value['debitaccount_number'],
                "journal_number"=>$value['journal_number'],
                "journal_date"=>$value['journal_date'],
                "debit_accountname"=>$value['debit_accountname'],
                "credit_accountname"=>$value['credit_accountname'],
                "debit_amount"=>$value['debit_amount'],
                "credit_amount"=>$value['credit_amount'],
                "journal_narration"=>$value['journal_narration'],
                "action" => $button

            );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);
    }
        


  public function  fetchLdgAccounts()
    {
        
            $data = $this->common_model->get_ldgAcc();
            //$sectionData = $this->model_section->fetchSectionDataByClass($classId);
            if($data) {
                foreach ($data as $key => $value) {
                    $option .= '<option value="'.$value['id'].'">'.$value['account_name'].'</option>';
                }
                 // /foreach
                $option .= '<option selected value=0>Select Account</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
 
}

    public function createCJournal()
    {
            $validator = array('success' => false, 'messages' => array());
            $data = array();
         //   $creditmemberNumber = $this->input->post('accountname');
    
           // $member_data = $this->common_model->get_members($creditmemberNumber);
           // foreach ($member_data as $key => $value) {
          //  $data['loan_outstand'] = $value['loan_outstanding']; 
          //  $data['thrift_deposit'] = $value['thrift_deposit'];   
           // }
            $create = $this->common_model->insertCJournal($data);                    
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



    public function createJournal()
    {
            $validator = array('success' => false, 'messages' => array());
            $data = array();
            $creditmemberNumber = $this->input->post('creditmemberNumber');
    
            $member_data = $this->common_model->get_members($creditmemberNumber);
            foreach ($member_data as $key => $value) {
            $data['loan_outstand'] = $value['loan_outstanding']; 
            $data['thrift_deposit'] = $value['thrift_deposit'];   
            }
            $create = $this->common_model->insertJournal($data);                    
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



    public function createContraJV()
    {
            $validator = array('success' => false, 'messages' => array());
            $data = array();
            $creditmemberNumber = $this->input->post('creditmemberNumber');
    
            $member_data = $this->common_model->get_members($creditmemberNumber);
            foreach ($member_data as $key => $value) {
            $data['loan_outstand'] = $value['loan_outstanding']; 
            $data['thrift_deposit'] = $value['thrift_deposit'];   
            }
            $create = $this->common_model->insertcnJournal($data);                    
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
            
         // /if
    }






    public function update_journal()
    {
            $validator = array('success' => false, 'messages' => array());
            $data = array();
/*            $editcreditmemberNumber = $this->input->post('editcreditmemberNumber');
    
            $member_data = $this->common_model->get_members($editcreditmemberNumber);
            foreach ($member_data as $key => $value) {
            $data['loan_outstand'] = $value['loan_outstanding']; 
            $data['thrift_deposit'] = $value['thrift_deposit'];   
            }*/

            $create = $this->common_model->Journalupdate();                    
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
  





//Update Invoice
    
public function fetchjournalUpdate() 
    
{
    //  $id=this->input->post("invNo");
 $id = $this->uri->segment(4);
//print_r($id);
     
       // $compId=$this->session->userdata['id'];
        
$journalSelectedData = $this->common_model->get_journalbyid($id);
$x=1;
foreach ($journalSelectedData as $key => $jouvalue) {
$itmtransData = $this->common_model->get_itemtrans($jouvalue['trans_id']);  

$acid = $jouvalue['account_id'];
$acnamedata = $this->common_model->get_ldgAccById($acid);
if($acnamedata)
{
foreach ($acnamedata as $key => $acvalue) {
    $accname = $acid .' - ' .  $acvalue['account_name'];

}
}
else 
{
    $accname="";
}
$cracid = $jouvalue['cr_account_id'];

$cracnamedata = $this->common_model->get_ldgAccById($cracid);
if($cracnamedata)
{
foreach ($cracnamedata as $key => $cracvalue) {
    $craccname = $cracid .' - ' . $cracvalue['account_name'];

}
}
else 
{
    $craccname="";
}



$tbl ='<div class="row col-md-6">
        <div class="form-group">

          <div class="input-group ">
          <label class="control-label">Date</label>
            
            <input type="text" class="form-control" id="editjvdate" value="' . $jouvalue["trans_date"] . '" name="editjvdate" autocomplete="off" placeholder="dd-mm-yyyy" required>
            <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-calendar" id="dtp"></i></span>
              </div>
          </div>
        </div>
</div>

  <div class="col-md-12">
    <table class="scroll table-responsive card-list-table"  id="jvtbl">
    <thead>
      <th>DB/CR</th>
      <th style="width: 100%">ACCOUNT NAME</th>
      <th>AMOUNT</th>
      
    </thead>
      <tbody>';

    
    
    $tbl .='<tr>

    <td><select  onchange="getval(this)" name="editdb" id="editdb">
      <option value="DB">DB</option>
      
    </select></td> 
    <input id="recid" name="recid" value="' . $id . '" hidden />
    <td> <input type="text" class="form-control typeahead" value="'. $accname .' "  id="editdbaccountname" name="editdbaccountname"  style="width: 100%;" required></td>';
    /*<select  id="editdbaccountname" name="editdbaccountname"  style="width: 100%;" required>';
    $option="";
$ldgdata= $this->common_model->getAllLedger();
$x = 1;
if($ldgdata)
{
foreach ($ldgdata as $key => $lvalue) {

if($acid==$lvalue["acclink_id"])
 {

 $tbl .='<option selected value=' . $lvalue["acclink_id"] . '>' . $lvalue["account_name"] . '</option>';
}
 else {
   $tbl .='<option value=' . $lvalue["acclink_id"] . '>' . $lvalue["account_name"] . '</option>';
 }




 }
 
}
*/

 $tbl .=   '<td><input type="Number" name="editdbtransamount" value="' . $jouvalue["trans_amount"] . '" required id="editdbtransamount" class="amt" placeholder="0.00" style="text-align: right; width: 100px;"></td>
    <td>

    </tr>';

    
    $tbl .='<tr>

    <td><select  onchange="getval(this)" name="editcr" id="editcr">
      <option value="CR">CR</option>
      
    </select></td> 
    <td><input type="text" class="form-control typeahead" value="'. $craccname .' "  id="editcraccountname" name="editcraccountname"  style="width: 100%;" required></td>';
/*    <select  id="editcraccountname" name="editcraccountname"  style="width: 100%;" required>';

    $option="";
$ldgdata= $this->common_model->getAllLedger();
if($ldgdata)
{
foreach ($ldgdata as $key => $lvalue) {

if($cracid==$lvalue["acclink_id"])
 {
 $tbl .='<option selected value=' . $lvalue["acclink_id"] . '>' . $lvalue["account_name"] . '</option>';
}
 else {
   $tbl .='<option value=' . $lvalue["acclink_id"] . '>' . $lvalue["account_name"] . '</option>';
 }
 }
 
}
 $tbl .=   '</select></td>';
 */
  $tbl .= '<td><input type="Number" name="editcrtransamount" value="' . $jouvalue["trans_amount"] . '" required id="editcrtransamount" class="amt" placeholder="0.00" style="text-align: right; width: 100px;"></td>
    <td>
      
    </tr>';
$x++;
      
$tbl .='</tbody>

    </table>
                               <div class="form-group">
                                    <label class="col-md-6" for="paydate">Narration
                                    </label>
                                        <input type="text" id="editjvnarration" name="editjvnarration" value =" ' . $jouvalue["trans_narration"] .' " class="form-control mydatepicker" placeholder="Narration"  autocomplete="off" >
                                </div>

  </div>
</div>';


}
          echo $tbl;
    
}



public function updatesubAccount()
{
     $subacc = $this->common_model->get_subaccount();
	 
	 $tbl='<table id="journalTbl" class="table" border="1"><th>Sub Account Name</th><th>Amount</th><tbody>';
        foreach ($subacc as $key=> $svalue)
        {

        	$tbl .= '<tr><td><input type="text"  value="'.$svalue['item_name'].'"
        	  id="itemname' .$key .'" name="itemname['. $key .']"  class="form-control" readonly>  
                                    </td>  <td>
                                    <input type="text" id="itemamount' .$key .'" name="itemamount['. $key .']"  placeholder="0.00" style="text-align: right;" class="form-control subamt">
                                    </td>
                                  </tr>';


       // $data['subacclist'] = $srow['item_name'];
        }
        $tbl .= '</tbody></table>';
   echo $tbl;	 


}


 public function getSettings() {

      $setid = $this->common_model->get_settings_id();
 
            foreach ($setid as $key=> $row)
       {
        $data = $row;
//        $data['journal_id'] = $row['journal_id'] . '/' . $row['year'];
        }
        echo json_encode($data);

 }


    public function create_Journal(){
        $data = array();
        $data['page_title'] = 'New Journal';
     $data['subacc'] = $this->common_model->get_subaccount();
      $setid = $this->common_model->get_settings_id();
 
            foreach ($setid as $key=> $row)
       {
        $data['journal_id'] = $row['journal_id'] . '/' . $row['year'];
        }






        $data['main_content'] = $this->load->view('admin/Journal/create_Journal', $data, TRUE);
        $this->load->view('admin/index', $data);
    }



    public function create_contraJournal(){
        $data = array();
        $data['page_title'] = 'New Contra Journal';
      $data['subacc'] = $this->common_model->get_subaccount();
      $setid = $this->common_model->get_settings_id();
 
      foreach ($setid as $key=> $row)
       {
        $data['journal_id'] = $row['journal_id'] . '/' . $row['year'];
       }






        $data['main_content'] = $this->load->view('admin/journal/create_contrajv', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


public function fetchAccountlistbyname()
{
   $qry = $this->input->get('itemkeyword'); 
    $query  = $this->common_model->get_account_listbyname($qry);
        $data = array();
        foreach ($query as $key => $value) 
        {
    //$data[] = array('id' => $value->member_id, 'text' => $value->member_name, 'dob' => $value->dob);
           // $data[]= $value->member_name;
     $data[]=$value;
        }
        echo json_encode($data); 

}

    public function  fetchAccountlist()
    {
   $qry = $this->input->get('qry'); 
    $query  = $this->common_model->get_account_list($qry);
        $data = array();
        foreach ($query as $key => $value) 
        {
    //$data[] = array('id' => $value->member_id, 'text' => $value->member_name, 'dob' => $value->dob);
           // $data[]= $value->member_name;
     $data[]=$value;
        }
        echo json_encode($data); 
    }            


public function fetchJournalentryData()
{

    $fdt=$this->input->get('fdate');
    $tdt=$this->input->get('tdate');
    
        $rw=1;
        $JournalfilterbyDate = $this->common_model->fetchJournalfilterbydate($fdt,$tdt);
//print_r($JournalfilterbyDate);
        $sresult = array();
        $result =array();

        foreach($JournalfilterbyDate as $key => $value) { 

$acid = $value['account_id'];
$acnamedata = $this->common_model->get_ldgAccById($acid);
if($acnamedata)
{
foreach ($acnamedata as $key => $acvalue) {
    $accname = $acvalue['account_name'];

}
}
else 
{
    $accname="";
}
$cracid = $value['cr_account_id'];

$cracnamedata = $this->common_model->get_ldgAccById($cracid);
if($cracnamedata)
{
foreach ($cracnamedata as $key => $cracvalue) {
    $craccname = $cracvalue['account_name'];

}
}
else 
{
    $craccname="";
}
            //<li><a href="#" data-toggle="modal" data-target="#printInvoiceModal" onclick="viewInvoice('. $value['id'] .')">View</a></li> 
            //$pdfbtn ='<div classs="btn-group"><a href="#" onclick="topdf('. $value['id'] .')"><i class="fa fa-car"></a></i></div>';


 $button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#edit-journal-modal" onclick="updateJournal(' . "'" . $value['id'] . "'" . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deleteJournal(' . $value['id'] . ')"><i class="fa fa-times"></i>
      </button>

  
</div>'; 
 
    $result['data'][] = array(
                //$rw,
            //    "division_id" => $value['debitaccount_number'],
                "journal_number"=>$value['trans_id'],
                "journal_date"=>$value['trans_date'],
                "debit_accountname"=>$accname,
                "credit_accountname"=>$craccname,
                "debit_amount"=>$value['trans_amount'],
                "credit_amount"=>$value['trans_amount'],
               // "narration"=>$value['narration'],
               "action" => $button
                );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);



}


public function fetchglJournalentryData()
{

    $fdt=$this->input->get('fdate');
    $tdt=$this->input->get('tdate');
    
        $rw=1;
        $JournalfilterbyDate = $this->common_model->fetchglJournalfilterbydate($fdt,$tdt);
//print_r($JournalfilterbyDate);
        $sresult = array();
        $result =array();

        foreach($JournalfilterbyDate as $key => $value) { 


            //<li><a href="#" data-toggle="modal" data-target="#printInvoiceModal" onclick="viewInvoice('. $value['id'] .')">View</a></li> 
            //$pdfbtn ='<div classs="btn-group"><a href="#" onclick="topdf('. $value['id'] .')"><i class="fa fa-car"></a></i></div>';


 /*$button ='<div class="btn-group">
  <button type="button" class="btn btn-info btn-circle btn-xs center-block" href="#" data-toggle="modal" data-target="#edit-journal-modal" onclick="updateJournal(' . "'" . $value['id'] . "'" . ')"><i class="fa fa-edit"></i>
      </button>
&nbsp;
  <button type="button" data-target="#deleteModal" class="btn btn-danger btn-circle btn-xs center-block " 
 href="#" data-toggle="modal"  onclick="deleteJournal(' . $value['id'] . ')"><i class="fa fa-times"></i>
      </button>

  
</div>';  */
 
    $result['data'][$key] = array(
                //$rw,
                "division_id" => $value['debitaccount_number'],
//                "journal_number"=>$value['journal_number'],
                "journal_date"=>$value['journal_date'],
                "debit_accountname"=>$value['debit_accountname'],
                "credit_accountname"=>$value['credit_accountname'],
                "debit_amount"=>$value['debit_amount'],
                "credit_amount"=>$value['credit_amount']
               // "narration"=>$value['narration'],
              //  "action" => $button
                );  
            $rw=$rw+1;
            
        }
        echo json_encode($result);



}



function deleteJvRec()
{
  $id= $this->uri->segment(4);
            $validator = array('success' => false, 'messages' => array());
            $data = array();
            //$creditmemberNumber = $this->input->post('creditmemberNumber');
    
            //$member_data = $this->common_model->get_members($creditmemberNumber);
            $delete = $this->common_model->delJournal($id);
                                
            if($delete === true) {
                $validator['success'] = true;
                $validator['messages'] = "Successfully deleted";
                
            }
            else {
                $validator['success'] = false;
                $validator['messages'] = "Error while deleting the information into the database";
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
                $option .= '<option selected value=0>SELECT AN ACCOUNT</option>';
            }
            else {
                $option = '<option value="">No Data</option>';
            } // /else empty section

            echo $option;
            
         // /if
    

}


function fetchItemData()
{
    $tbl="";

    $jnumber = $this->input->get('jvno');
    $fdate = $this->input->get('fdate');
    $tdate = $this->input->get('tdate');

    $itemdata = $this->common_model->fetchLedgerGLSubData($jnumber,$fdate,$tdate);

    $tbl .= '<table  border="1"><tbody>';

    // print_r($itemdata);
    for ($i=0; $i <count($itemdata) ; $i++) { 
        # code...
   // }
   // foreach ($itemdata as  $value) {

     //print_r($value['item_name']);
        $tbl .= '<tr><td>THRIFT</td><td style="text-align:right;">' . $itemdata[$i]["THRIFT"] . '</td><tr><td>PRINCIPLE</td><td style="text-align:right;">' . $itemdata[$i]["PRINCIPLE"] . '</td><tr><td>INTEREST</td><td style="text-align:right;">' . $itemdata[$i]["INTEREST"] . '</td>  </tr>';
/*
    $result['data'][$key] = array(
                //$rw,
                "itemName"=>$value['item_name'],
                "itemAmount"=>$value['trans_amount']
                );  
  */         
            
        }
        $tbl .= '</tbody></table>';
        echo  $tbl;
        //echo json_encode($result);
 }


  function excelimport()
  {
         $data = array();
        $data['page_title'] = 'Excel Export to Journals';


        $data['main_content'] = $this->load->view('admin/journal/jv_import', $data, TRUE);
        $this->load->view('admin/index', $data);

  }

   function fetch()
   {
    $data = $this->common_model->selectdata();
      //print_r($data);
    $output = '<h3 align="center">Total Data - ' . count($data) . '</h3>
    <table class="table">
    <tr>
    <th>Journal Date</th>
    <th>Journal Number</th>
    <th>Account Name </th>
    <th>Debit Amount</th>
    <th>Credit Amount</th>
    </tr>';


for ($i=0; $i < count($data); $i++) 
//foreach ($data as $row) {
{
  $output .='
  <tr>
  <td>'. $data[$i]["journal_date"] .'</td>
  <td>'. $data[$i]["journal_number"] .'</td>
  <td>'. $data[$i]["debit_accountname"] .'</td>
  <td>'. $data[$i]["debit_amount"] .'</td>
  </tr>
  <tr>
  <td></td><td></td>
  <td>'. $data[$i]["credit_accountname"] .'</td>
  <td></td><td>'. $data[$i]["credit_amount"] .'</td>
  </tr>';

 }
  $output .= '</table>';

  echo $output;
   }

//Import to TransactionTable

function importDivDBJV($jvacc,$col)
{
//print_r($jvacc . $col);
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
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
$jvmonth = $allDataInSheet[2]['I'];
}

                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }


                //$getImpAccData = $this->common_model->getImpAcc($jvacc);
               // print_r($getImpAccData);

               /* if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['id'];
                    }
                    */

$jvamt=0;
$tot_dbamt=0;
    //print_r($jvmonth);
               for ($i=2; $i <=$arrayCount; $i++) { 
                // print_r($allDataInSheet[$i]['A']);
                 $divname = $allDataInSheet[$i]['A'];
                 $memaccid = $allDataInSheet[$i]['B'];
                 $jvamt = $allDataInSheet[$i][$col];

                 $divNameData = $this->common_model->getDivId($divname);
                 //print_r($divNameData);
                 foreach ($divNameData as $key => $dvalue) {
                  $divid = $dvalue['division_id'];
                  $division_id = $dvalue['id'];
                 }

                 $jmonth = $allDataInSheet[$i]['I'];
                 $mm = substr($jmonth, 0,2);
                 $yy = substr($jmonth, 2,4);
                 
                 $dd = "16";
                 $jvdate = $yy . '-' . $mm . '-' . $dd;

                 $jv_date = date("Y-m-d", strtotime("+1 months",strtotime($jvdate)));
                 //print_r($jvamt);
                 
                 if($jvamt<>0)
                 {

                $journal_id= "DVB-" . $jvprefix . $jvid . '/' . $row['year'];
$data_ins[] = array("db_cr"=> "DB","trans_type"=>"JOUR","cr_account_id"=>$divid,"account_id"=>$memaccid,"trans_amount"=>$jvamt,"trans_id"=>$journal_id,"division_id" =>$division_id, "trans_date"=>$jv_date,"mm_year"=>$jmonth,"trans_narration"=> $jvacc . " Recovery amount Credited to respective member account for the month of  " . $mm . "` " . $yy);

$tot_dbamt = $tot_dbamt+$jvamt;

  $jvid =$jvid+1;
            
}
 
                }


/*$data_ins[] = array("db_cr"=> "CR","trans_type"=>"JOUR","cr_account_id"=> $accId,"account_id"=>$accId,"trans_amount"=>$tot_dbamt,"trans_id"=>$journal_id,"division_id" =>$divid,"trans_date"=>$jv_date,"mm_year"=>$jmonth,"trans_narration"=> $jvacc . " Recovery amount Credited to respective member account for the month of  " . $mm . "` " . $yy);
*/

//print_r($data_ins);
if($data_ins)
{ $nxtjvid = $jvid+1;
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->common_model->importData('soc_trans_tbl',$data_ins); 
$this->common_model->updateSettings('soc_settings_tbl',$upd_settingsid);
}
$data_ins=array();
$tot_dbamt=0;
//}  //Div Debit & Member Credit    

}

function opbalupdate()
{

  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);

$jvamt=0;
$tot_dbamt=0;
    
               for ($i=2; $i <=$arrayCount; $i++) { 
                // print_r($allDataInSheet[$i]['A']);
                 $memaccid = $allDataInSheet[$i]['A'];
                 $loan_op = $allDataInSheet[$i]['C'];
                 $roi = $allDataInSheet[$i]['D'];
                 $share_op = $allDataInSheet[$i]['E'];
                 $thrift_op = $allDataInSheet[$i]['F'];



$data_upd[] = array("member_id"=>$memaccid, "loan_opbal"=> $loan_op,"share_capital"=>$share_op,"rate_of_interest"=>$roi,"thrift_opbal"=>$thrift_op);

   }
    if($data_upd)
    {
    $this->db->update_batch('soc_members_tbl', $data_upd, 'member_id');
    }

//print_r($data_upd);
$data_upd=array();

//}  //Interest Import to trans-tbl

 }


function importDIVMJV($jvacc,$col)
{

  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
//$rctdate = $allDataInSheet[2]['B'];

}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);

          $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }

$data_ins=array();
$jvamt=0;
$tot_dbamt=0;
$divid=0;
    
               for ($i=2; $i <=$arrayCount; $i++) { 


$tdate = $allDataInSheet[$i]['A'];

$dbAcc = $allDataInSheet[$i]['B'];
//print_r($dbAcc);


    $getImpAccData = $this->common_model->get_account_listbyname($dbAcc);
              // print_r($getImpAccData);

                if($getImpAccData)
                {
                  
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['acclink_id'];
                    }
            }
            else 
            {
                $accId=$dbAcc;
            }

//$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['A'];
//$chq_ref = $allDataInSheet[$i]['C'];
$memId = $allDataInSheet[$i]['C'];
$trnAmt = $allDataInSheet[$i]['E'];
//$narration = $allDataInSheet[$i]['F'];
//$trans_type = $allDataInSheet[$i]['H'];
$trans_type="JOUR";

$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);



    $memData = $this->common_model->getCashBankName($memId);
               //print_r($memData);
        foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }


                 //$jv_date = date("Y-m-d", strtotime("+1 months",strtotime($jvdate)));
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= 'DM-' . $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=> $trans_type,"cr_account_id"=> $accId,"account_id"=>$memId,"trans_amount"=>$trnAmt,"division_id"=>$divid, "trans_id"=>$journal_id,"trans_date"=>$rct_date,"trans_narration"=> "Division Recovery credited to member");

$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }

//print_r($data_ins);

$nxtjvid = $jvid+1;
$upd_settingsid = array('payment_id'=>$nxtjvid);

$this->common_model->importData('soc_trans_tbl',$data_ins); 

$this->common_model->updateSettings('soc_settings_tbl',$upd_settingsid);

$data_ins=array();
$tot_dbamt=0;


} //importDIVMJV


function importJV($jvacc,$col)
{


  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
$jvmonth = $allDataInSheet[2]['I'];
//$deljvData = $this->common_model->del_Jventry($jvmonth);
//print_r($jvmonth);
//print_r($deljvData);
}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);

                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }


                $getImpAccData = $this->common_model->getImpAcc($jvacc);
            //    print_r($getImpAccData);

                if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['id'];
                    }
$jvamt=0;
$tot_dbamt=0;
    
               for ($i=2; $i <=$arrayCount; $i++) { 
                // print_r($allDataInSheet[$i]['A']);
                 $divname = $allDataInSheet[$i]['A'];
                 $memaccid = $allDataInSheet[$i]['B'];
                 $jvamt = $allDataInSheet[$i][$col];
                 $divNameData = $this->common_model->getDivId($divname);
                 foreach ($divNameData as $key => $dvalue) {
                  $divid = $dvalue['id'];
                     # code...
                 }
//print_r($divNameData);
                 //$totamt = $allDataInSheet[$i]['H'];

                 $jmonth = $allDataInSheet[$i]['I'];
                 $mm = substr($jmonth, 0,2);
                 $yy = substr($jmonth, 2,4);
                 
                 $dd = "16";
                 $jvdate = $yy . '-' . $mm . '-' . $dd;

                 $jv_date = date("Y-m-d", strtotime("+1 months",strtotime($jvdate)));
//  print_r($jvamt);
                 if($jvamt<>0)
                 {

                $journal_id= $jvprefix . $jvid . '/' . $row['year'];
//print_r($jv_date);
$data_ins[] = array("db_cr"=> "DB","trans_type"=>"JOUR","cr_account_id"=>$memaccid,"account_id"=>$accId,"trans_amount"=>$jvamt,"trans_id"=>"RVC-" .$journal_id,"division_id" =>$divid, "trans_date"=>$jv_date,"mm_year"=>$jmonth,"trans_narration"=> $jvacc . " Recovery amount Credited to respective member account for the month of  " . $mm . "` " . $yy);

$tot_dbamt = $tot_dbamt+$jvamt;

  $jvid =$jvid+1;
            


                }
 
                }


/*$data_ins[] = array("db_cr"=> "CR","trans_type"=>"JOUR","cr_account_id"=> $accId,"account_id"=>$accId,"trans_amount"=>$tot_dbamt,"trans_id"=>$journal_id,"division_id" =>$divid,"trans_date"=>$jv_date,"mm_year"=>$jmonth,"trans_narration"=> $jvacc . " Recovery amount Credited to respective member account for the month of  " . $mm . "` " . $yy);
*/
//print_r($data_ins);
if($data_ins)
{ $nxtjvid = $jvid+1;
//$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->common_model->importData('soc_trans_tbl',$data_ins); 
//$this->common_model->updateSettings('soc_settings_tbl',$upd_settingsid);
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);

}
$data_ins=array();
$tot_dbamt=0;
}  //Interest Import to trans-tbl

} //Function



function importPYMT($jvacc,$col)
{
//print_r($jvacc);
$finyear=$this->session->userdata('finyear');
$sheetname="Payments";
var_dump($sheetname);
  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                //$reader->setLoadSheetsOnly($sheetname);
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
         //     print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
//$rctdate = $allDataInSheet[2]['B'];

}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);

                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['payment_prefix'];
                    $jvid= $row['payment_id'];
                    
                    }

$data_ins=array();
$jvamt=0;
$tot_dbamt=0;
$divid=0;
    
               for ($i=2; $i <=$arrayCount; $i++) { 

$dbAcc = $allDataInSheet[$i]['A'];
//print_r($dbAcc);


                $getImpAccData = $this->common_model->getImpAcc($dbAcc);
           //    print_r($getImpAccData);

                if($getImpAccData)
                {
                  
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['id'];
                    }
}

//$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['B'];
$chq_ref = $allDataInSheet[$i]['C'];
$crAcc = $allDataInSheet[$i]['D'];
$trnAmt = $allDataInSheet[$i]['F'];
$narration = $allDataInSheet[$i]['G'];
$trans_type = $allDataInSheet[$i]['H'];


$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);



                 $memData = $this->common_model->getCashBankName($crAcc);
               //print_r($memData);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }


                 //$jv_date = date("Y-m-d", strtotime("+1 months",strtotime($jvdate)));
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=> $trans_type,"cheque_ref"=>$chq_ref,"cr_account_id"=> $crAcc,"account_id"=>$accId,"trans_amount"=>$trnAmt,"division_id"=>$divid, "trans_id"=>$journal_id,"trans_date"=>$rct_date,"trans_narration"=> $narration .  " through reference #" . $chq_ref);



$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }

//print_r($data_ins);

$nxtjvid = $jvid+1;

$this->common_model->importData('soc_temptrans_tbl',$data_ins); 

//$this->common_model->updateSettings('soc_tempsettings_tbl',$upd_settingsid);

$upd_settingsid = array('payment_id'=>$nxtjvid);

$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);

$data_ins=array();
$tot_dbamt=0;
//}  //Interest Import to trans-tbl

} //PYMT Function


public function cbImpReceipt()
{
  $status="";
  $itype=2;
  if(isset($_FILES["file"]["name"]))
  {
//print_r("Import......Receipt");


              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
$rctdate = $allDataInSheet[2]['C'];
$dbAcc = $allDataInSheet[2]['A'];
$rctNo = $allDataInSheet[2]['B'];
$rctdate = $allDataInSheet[2]['C'];
$crAcc = $allDataInSheet[2]['D'];
$trnAmt = $allDataInSheet[2]['F'];


$thfacc = trim($allDataInSheet[1]['J']);
$priacc = trim($allDataInSheet[1]['K']);
$intacc = trim($allDataInSheet[1]['L']);
$shracc = trim($allDataInSheet[1]['M']);
$misacc = trim($allDataInSheet[1]['N']);
$insacc = trim($allDataInSheet[1]['O']);
$sliaacc = trim($allDataInSheet[1]['P']);
$sastacc = trim($allDataInSheet[1]['Q']);
$othacc = trim($allDataInSheet[1]['R']);


$status= $this->importRCT($dbAcc,"A");


$ImportHeads=$this->common_model->getImportHeads($itype);
if($ImportHeads)
{
  foreach ($ImportHeads as $key => $imvalue) {
    # code...
//var_dump($imvalue['import_account']);

    $status = $this->importRJV($imvalue['import_account'],$imvalue['coloumn_letter']);



  }
}


/*
$status= $this->importRJV($thfacc,"J");
$status= $this->importRJV($priacc,"K");
$status= $this->importRJV($intacc,"L");
$status= $this->importRJV($shracc,"M");
$status= $this->importRJV($misacc,"N");
$status= $this->importRJV($insacc,"O");
$status= $this->importRJV($othacc,"P");
$status= $this->importRJV($othacc,"Q");
$status= $this->importRJV($othacc,"R");
*/
}


echo $status;

}





//Import Payments

public function cbImpPayment()
{
  $status="";
  if(isset($_FILES["file"]["name"]))
  {
//print_r("Import......Payments");
$itype=1;

              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             // print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
$rctdate = $allDataInSheet[2]['C'];





$dbAcc = $allDataInSheet[2]['A'];
$rctNo = $allDataInSheet[2]['B'];
$rctdate = $allDataInSheet[2]['C'];
$crAcc = $allDataInSheet[2]['D'];
$trnAmt = $allDataInSheet[2]['F'];
$narration = $allDataInSheet[2]['G'];

/*
$thfacc = trim($allDataInSheet[1]['I']);
$priacc = trim($allDataInSheet[1]['J']);
$intacc = trim($allDataInSheet[1]['K']);
$shracc = trim($allDataInSheet[1]['L']);
$misacc = trim($allDataInSheet[1]['M']);
$insacc = trim($allDataInSheet[1]['N']);
$sliaacc = trim($allDataInSheet[1]['O']);
$sastacc = trim($allDataInSheet[1]['P']);
$othacc = trim($allDataInSheet[1]['Q']);
*/

/*
$this->importRJV($thfacc,"I");
$this->importRJV($priacc,"J");
$this->importRJV($intacc,"K");
$this->importRJV($shracc,"L");
$this->importRJV($misacc,"M");
$this->importRJV($insacc,"N");
$this->importRJV($othacc,"O");
$this->importRJV($othacc,"P");
$this->importRJV($othacc,"Q");
*



$loanacc = trim($allDataInSheet[1]['H']);
$lnadjacc = trim($allDataInSheet[1]['I']);
$mshracc = trim($allDataInSheet[1]['J']);
$sshracc = trim($allDataInSheet[1]['K']);
$trfacc = trim($allDataInSheet[1]['L']);
$intacc = trim($allDataInSheet[1]['M']);

$this->importLOAN($loanacc,"H");

$this->importLOANADJ($lnadjacc,"I");
$this->importLOANMSHR($mshracc,"J");
$this->importLOANSSHR($sshracc,"K");
$this->importLOANTHF($trfacc,"L");
$this->importLOANINT($intacc,"M");

*/


$status = $this->importPYT($dbAcc,"A");



$ImportHeads=$this->common_model->getImportHeads($itype);
if($ImportHeads)
{
  foreach ($ImportHeads as $key => $imvalue) {
    # code...
    $status = $this->importPJV($imvalue['import_account'],$imvalue['coloumn_letter']);
  }
}
/*
$tdIntacc = trim($allDataInSheet[1]['N']);
$divacc = trim($allDataInSheet[1]['O']);
$status = $this->importPJV($tdIntacc,"N");

$status = $this->importPJV($divacc,"O");

$shracc = trim($allDataInSheet[1]['L']);
$thfacc = trim($allDataInSheet[1]['M']);
$status = $this->importPJV($shracc,"L");
$status = $this->importPJV($thfacc,"M");
*/

}

echo $status;

}


//Import Account Closures

public function cbImpAClosure()
{
  $status="";
  if(isset($_FILES["file"]["name"]))
  {
//print_r("Import......Payments");


              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
$rctdate = $allDataInSheet[2]['C'];
$shracc = trim($allDataInSheet[1]['O']);
$thfacc = trim($allDataInSheet[1]['P']);
$status = $this->importPJV($shracc,"O");
$status = $this->importPJV($thfacc,"P");


}

echo $status;

}



//Import Loan/Adj

public function cbImpLoan()
{
$finyear=$this->session->userdata('finyear');


  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);


$jvmonth = $allDataInSheet[2]['I'];
                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }


$loanacc = trim($allDataInSheet[1]['H']);
$lnadjacc = trim($allDataInSheet[1]['I']);
$mshracc = trim($allDataInSheet[1]['J']);
$sshracc = trim($allDataInSheet[1]['K']);
$trfacc = trim($allDataInSheet[1]['L']);
$intacc = trim($allDataInSheet[1]['M']);
/*
$this->importLOAN($loanacc,"H");
*/
$status = $this->importLOANADJ($lnadjacc,"I");
$status = $this->importLOANMSHR($mshracc,"J");
$status = $this->importLOANSSHR($sshracc,"K");
$status = $this->importLOANTHF($trfacc,"L");
$status = $this->importLOANINT($intacc,"M");

  }              


echo $status;


}





function importPJV($jvacc,$col)
{
$finyear=$this->session->userdata('finyear');

$data_ins=array();
  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
//$rctdate = $allDataInSheet[2]['B'];
//$deljvData = $this->common_model->del_Jventry($jvmonth);
//print_r($jvmonth);
//print_r($deljvData);
}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);

                 $setid = $this->common_model->get_tempsettings_id($finyear);
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }
                $getImpAccData = $this->common_model->getImpAcc($jvacc);
           //     print_r($getImpAccData);

                if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['acclink_id'];
                    }


    }
$jvamt=0;
$tot_dbamt=0;


               for ($i=2; $i <=$arrayCount; $i++) { 



//$dbAcc = $allDataInSheet[$i]['A'];
$rctNo = $allDataInSheet[$i]['B'];

$rctdate = $allDataInSheet[$i]['C'];
$crAcc = $allDataInSheet[$i]['D'];
//$chq_ref = $allDataInSheet[$i]['G'];

//$chq_bank = $allDataInSheet[$i]['I'];


$trnAmt = $allDataInSheet[$i][$col];

$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);

                 $memData = $this->common_model->getCashBankName($crAcc);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= "P-" . $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=>"JOUR","cr_account_id"=>$accId,"account_id"=>$crAcc,"trans_amount"=>$trnAmt,"trans_id"=>$journal_id,"division_id" =>$divid, "trans_date"=>$rct_date,"fyear"=>$finyear,"trans_narration"=> $jvacc . " paid to member account");



$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }


//print_r($data_ins);


$nxtjvid = $jvid+1;
//$upd_settingsid = array('journal_id'=>$nxtjvid,"fyear"=>$finyear);

//$this->common_model->importData('soc_trans_tbl',$data_ins); 

//$this->common_model->importData('soc_temptrans_tbl',$data_ins); 

//$upd_settingsid = array('journal_id'=>$nxtjvid);
var_dump($data_ins);
$rjv_status="";
if($data_ins)
{
$rjv_status = $this->common_model->importData('soc_temptrans_tbl',$data_ins); 
//$this->common_model->updateSettings('soc_tempsettings_tbl',$upd_settingsid);
//$this->common_model->updateSettings('soc_settings_tbl',$upd_settingsid);
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);


}
else
{
  $rjv_status='true';
}
$data_ins=array();
$tot_dbamt=0;

echo $rjv_status;
}  // Import R-JV to trans-tbl




public function cbImp__Payment()
{
  $sheetname="Payments";
  if(isset($_FILES["file"]["name"]))
  {
//print_r("Import......Receipt");


              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    
                    $reader->setReadDataOnly(true);
                    
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                //$reader->setLoadSheetsOnly($sheetname);
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
              //print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
$rctdate = $allDataInSheet[2]['C'];




$dbAcc = $allDataInSheet[2]['A'];
$rctNo = $allDataInSheet[2]['B'];
$rctdate = $allDataInSheet[2]['C'];
$crAcc = $allDataInSheet[2]['D'];
$trnAmt = $allDataInSheet[2]['F'];
$narration = $allDataInSheet[2]['G'];
/*
$thfacc = trim($allDataInSheet[1]['I']);
$priacc = trim($allDataInSheet[1]['J']);
$intacc = trim($allDataInSheet[1]['K']);
$shracc = trim($allDataInSheet[1]['L']);
$misacc = trim($allDataInSheet[1]['M']);
$insacc = trim($allDataInSheet[1]['N']);
$sliaacc = trim($allDataInSheet[1]['O']);
$sastacc = trim($allDataInSheet[1]['P']);
$othacc = trim($allDataInSheet[1]['Q']);

*/

$this->importPYMT($dbAcc,"A");


$this->importPJV($thfacc,"I");


/*
$this->importRJV($thfacc,"I");
$this->importRJV($priacc,"J");
$this->importRJV($intacc,"K");
$this->importRJV($shracc,"L");
$this->importRJV($misacc,"M");
$this->importRJV($insacc,"N");
$this->importRJV($othacc,"O");
$this->importRJV($othacc,"P");
$this->importRJV($othacc,"Q");
*/
}

}




function importRCT($jvacc,$col)
{
//print_r($jvacc);
$finyear=$this->session->userdata('finyear');
  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
$rctdate = $allDataInSheet[2]['C'];

}

                 $setid = $this->common_model->get_tempsettings_id($finyear);
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['receipt_prefix'];
                    $jvid= $row['receipt_id'];
                    
                    }

  $data_ins=array();
$jvamt=0;
$tot_dbamt=0;
    
               for ($i=2; $i <=$arrayCount; $i++) { 




$dbAcc = $allDataInSheet[$i]['A'];



                $getImpAccData = $this->common_model->getImpAcc($dbAcc);
             //   print_r($getImpAccData);

                if($getImpAccData)
                {
                  
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['id'];
                    }
                }

$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['C'];
$crAcc = $allDataInSheet[$i]['D'];
$trnAmt = $allDataInSheet[$i]['F'];
$chq_ref = $allDataInSheet[$i]['G'];
$chq_bank = $allDataInSheet[$i]['I'];
$trn_type = $allDataInSheet[$i]['H'];

$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);



                 $memData = $this->common_model->getCashBankName($crAcc);
               //print_r($memData);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }


                 //$jv_date = date("Y-m-d", strtotime("+1 months",strtotime($jvdate)));
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=>$trn_type,"trans_refid"=>$rctNo,"cheque_ref"=>$chq_ref,"cheque_bank"=>$chq_bank, "cr_account_id"=> $crAcc,"account_id"=>$accId,"trans_amount"=>$trnAmt,"trans_id"=>$journal_id,"division_id" =>$divid, "trans_date"=>$rct_date,"fyear"=>$finyear, "trans_narration"=> $dbAcc . " Received through receipt # " . $rctNo . " towards recovery of member account");



$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }

//print_r($data_ins);

$nxtjvid = $jvid+1;
//$upd_settingsid = array('receipt_id'=>$nxtjvid,"fyear"=>$finyear);

//$this->common_model->importData('soc_trans_tbl',$data_ins); 

$rct_status = $this->common_model->importData('soc_temptrans_tbl',$data_ins); 

//$this->common_model->updateSettings('soc_tempsettings_tbl',$upd_settingsid);
$upd_settingsid = array('receipt_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);

$data_ins=array();
$tot_dbamt=0;
//}  //Interest Import to trans-tbl

echo $rct_status;

} //RCPT Function




function importPYT($jvacc,$col)
{
//print_r($jvacc);
$finyear=$this->session->userdata('finyear');
  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
$rctdate = $allDataInSheet[2]['C'];

}

                 $setid = $this->common_model->get_tempsettings_id($finyear);
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['payment_prefix'];
                    $jvid= $row['payment_id'];
                    
                    }

  $data_ins=array();
$jvamt=0;
$tot_dbamt=0;
    
               for ($i=2; $i <=$arrayCount; $i++) { 




$dbAcc = $allDataInSheet[$i]['A'];



                $getImpAccData = $this->common_model->getImpAcc($dbAcc);
             //   print_r($getImpAccData);

                if($getImpAccData)
                {
                  
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['id'];
                    }
                }

$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['C'];
$crAcc = $allDataInSheet[$i]['D'];
$trnAmt = $allDataInSheet[$i]['F'];
$narration = $allDataInSheet[$i]['G'];
$trn_type = $allDataInSheet[$i]['H'];


$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);



                 $memData = $this->common_model->getCashBankName($crAcc);
               //print_r($memData);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }


                 //$jv_date = date("Y-m-d", strtotime("+1 months",strtotime($jvdate)));
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=>$trn_type,"cheque_ref"=>$rctNo, "cr_account_id"=> $crAcc,"account_id"=>$accId,"trans_amount"=>$trnAmt,"trans_id"=>$journal_id,"division_id" =>$divid,"fyear"=>$finyear, "trans_date"=>$rct_date,"trans_narration"=> $narration);



$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }

//print_r($data_ins);

$nxtjvid = $jvid+1;
//$upd_settingsid = array('payment_id'=>$nxtjvid,"fyear"=>$finyear);

//$this->common_model->importData('soc_trans_tbl',$data_ins); 
if($data_ins)
{
$py_status= $this->common_model->importData('soc_temptrans_tbl',$data_ins); 

//$this->common_model->updateSettings('soc_tempsettings_tbl',$upd_settingsid);
$upd_settingsid = array('payment_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);

$data_ins=array();
$tot_dbamt=0;
//}  //Interest Import to trans-tbl

echo $py_status;
}
else
{
  $py_status=false;
}
} //PYT Function


function importRJV($jvacc,$col)
{
$finyear=$this->session->userdata('finyear');

$data_ins=array();
  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
//$rctdate = $allDataInSheet[2]['B'];
//$deljvData = $this->common_model->del_Jventry($jvmonth);
//print_r($jvmonth);
//print_r($deljvData);
}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);

                 $setid = $this->common_model->get_tempsettings_id($finyear);
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }
                $getImpAccData = $this->common_model->getImpAcc($jvacc);
           //     print_r($getImpAccData);

                if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['id'];
                    }


    }
$jvamt=0;
$tot_dbamt=0;


               for ($i=2; $i <=$arrayCount; $i++) { 



$dbAcc = $allDataInSheet[$i]['A'];
$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['C'];
$crAcc = $allDataInSheet[$i]['D'];
$chq_ref = $allDataInSheet[$i]['G'];
$chq_bank = $allDataInSheet[$i]['I'];


$trnAmt = $allDataInSheet[$i][$col];

$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);

                 $memData = $this->common_model->getCashBankName($crAcc);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= "R-" . $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=>"JOUR","trans_refid"=>$rctNo, "cr_account_id"=>$crAcc,"account_id"=>$accId,"trans_amount"=>$trnAmt,"trans_id"=>$journal_id,"division_id" =>$divid, "trans_date"=>$rct_date,"fyear"=>$finyear,"trans_narration"=> $jvacc . " Received through receipt # " . $rctNo . " towards recovery of member account");



$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }


//print_r($data_ins);


$nxtjvid = $jvid+1;
//$upd_settingsid = array('journal_id'=>$nxtjvid,"fyear"=>$finyear);

//$this->common_model->importData('soc_trans_tbl',$data_ins); 

//$this->common_model->importData('soc_temptrans_tbl',$data_ins); 

//$upd_settingsid = array('journal_id'=>$nxtjvid);
$rjv_status="";
if($data_ins)
{
$rjv_status = $this->common_model->importData('soc_temptrans_tbl',$data_ins); 
//$this->common_model->updateSettings('soc_tempsettings_tbl',$upd_settingsid);
//$this->common_model->updateSettings('soc_settings_tbl',$upd_settingsid);
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);


}
else
{
  $rjv_status='true';
}
$data_ins=array();
$tot_dbamt=0;

echo $rjv_status;
}  // Import R-JV to trans-tbl


function importDIVRCT($jvacc,$col)
{
//print_r($jvacc);
$finyear=$this->session->userdata('finyear');

  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
$rctdate = $allDataInSheet[2]['C'];

}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);

                 $setid = $this->common_model->get_tempsettings_id($finyear);
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['receipt_prefix'];
                    $jvid= $row['receipt_id'];
                    
                    }

  $data_ins=array();
$jvamt=0;
$tot_dbamt=0;
    
               for ($i=2; $i <=$arrayCount; $i++) { 




$dbAcc = $allDataInSheet[$i]['A'];



                $getImpAccData = $this->common_model->getImpAcc($dbAcc);
             //   print_r($getImpAccData);

                if($getImpAccData)
                {
                  
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['id'];
                    }
}

$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['C'];
$crAcc = $allDataInSheet[$i]['D'];
$trnAmt = $allDataInSheet[$i]['F'];
$chq_ref = $allDataInSheet[$i]['G'];
$chq_bank = $allDataInSheet[$i]['H'];


$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);



                 $memData = $this->common_model->getCashBankName($crAcc);
               //print_r($memData);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }


                 //$jv_date = date("Y-m-d", strtotime("+1 months",strtotime($jvdate)));
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=>"RCPT","trans_refid"=>$rctNo,"cheque_ref"=>$chq_ref,"cheque_bank"=>$chq_bank, "account_id"=> $crAcc,"cr_account_id"=>$accId,"trans_amount"=>$trnAmt,"trans_id"=>$journal_id,"fyear"=>$finyear,"division_id" =>$divid, "trans_date"=>$rct_date,"trans_narration"=> $dbAcc . " Received through receipt # " . $rctNo . " towards recovery of member account");



$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }

//print_r($data_ins);

$nxtjvid = $jvid+1;
//$upd_settingsid = array('receipt_id'=>$nxtjvid);
//$upd_settingsid = array('journal_id'=>$nxtjvid,"fyear"=>$finyear);
$this->common_model->importData('soc_temptrans_tbl',$data_ins); 

//$this->common_model->updateSettings('soc_tempsettings_tbl',$upd_settingsid);
$upd_settingsid = array('receipt_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);

$data_ins=array();
$tot_dbamt=0;
//}  //Interest Import to trans-tbl

} //RCPT DIV Function



function importRDIVJV($jvacc,$col)
{
$finyear=$this->session->userdata('finyear');


  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
//$rctdate = $allDataInSheet[2]['B'];
//$deljvData = $this->common_model->del_Jventry($jvmonth);
//print_r($jvmonth);
//print_r($deljvData);
}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);

                 $setid = $this->common_model->get_tempsettings_id($finyear);
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }
                $getImpAccData = $this->common_model->getImpAcc($jvacc);
               // print_r($getImpAccData);

                if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['id'];
                    }


    }
$jvamt=0;
$tot_dbamt=0;


               for ($i=2; $i <=$arrayCount; $i++) { 



$dbAcc = $allDataInSheet[$i]['A'];
$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['C'];
$crAcc = $allDataInSheet[$i]['D'];
$chq_ref = $allDataInSheet[$i]['G'];
$chq_bank = $allDataInSheet[$i]['H'];

$trnAmt = $allDataInSheet[$i][$col];

$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);

                 $memData = $this->common_model->getCashBankName($crAcc);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= "D-" . $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=>"JOUR","trans_refid"=>$rctNo, "account_id"=>$crAcc,"cr_account_id"=>$accId,"trans_amount"=>$trnAmt,"fyear"=>$finyear,"trans_id"=>$journal_id,"division_id" =>$divid, "trans_date"=>$rct_date,"trans_narration"=> $jvacc . " Received through receipt # " . $rctNo . " towards recovery of member account");



$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }


//print_r($data_ins);

$nxtjvid = $jvid+1;
//$upd_settingsid = array('journal_id'=>$nxtjvid);
//$upd_settingsid = array('journal_id'=>$nxtjvid,"fyear"=>$finyear);

$this->common_model->importData('soc_temptrans_tbl',$data_ins); 
//$this->common_model->updateSettings('soc_tempsettings_tbl',$upd_settingsid);
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);

$data_ins=array();
$tot_dbamt=0;


}  // Import R-DivJV to trans-tbl



function importLOAN($jvacc,$col)
{
$finyear=$this->session->userdata('finyear');


  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
//$rctdate = $allDataInSheet[2]['B'];
//$deljvData = $this->common_model->del_Jventry($jvmonth);
//print_r($jvmonth);
//print_r($deljvData);

}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);

  $setid = $this->common_model->get_tempsettings_id($finyear);
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }
  $getImpAccData = $this->common_model->getImpAcc($jvacc);
               // print_r($getImpAccData);

                if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['id'];
                    }

$jvamt=0;
$tot_dbamt=0;
   } 
               for ($i=2; $i <=$arrayCount; $i++) { 

//$dbAcc = $allDataInSheet[$i]['A'];
//$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['B'];
//$crAcc = $allDataInSheet[$i]['D'];
$crAcc =$allDataInSheet[$i]['D'];
//$chq_ref = $allDataInSheet[$i]['G'];
//$chq_bank = $allDataInSheet[$i]['H'];

$trnAmt = $allDataInSheet[$i][$col];

$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);

$memData = $this->common_model->getCashBankName($crAcc);
      foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id="LN-" . $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=>"JOUR", "account_id"=>$crAcc,"cr_account_id"=>$accId,"trans_amount"=>$trnAmt,"fyear"=>$finyear, "trans_id"=>$journal_id,"division_id" =>$divid, "trans_date"=>$rct_date,"trans_narration"=> $jvacc . " Surety Loan Issued to member account");


$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }



$nxtjvid = $jvid+1;
//$upd_settingsid = array('journal_id'=>$nxtjvid);

if($data_ins)
{
$status= $this->common_model->importData('soc_temptrans_tbl',$data_ins); 
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);
//print_r($data_ins);
}
else
{
  $status="LOAN - NO DATA";
}
$data_ins=array();
$tot_dbamt=0;


}  //LOAN Interest Import to trans-tbl




function importLOANADJ($jvacc,$col)
{
$finyear=$this->session->userdata('finyear');


  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
//$rctdate = $allDataInSheet[2]['B'];
//$deljvData = $this->common_model->del_Jventry($jvmonth);
//print_r($jvmonth);
//print_r($deljvData);

}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);
$setid = $this->common_model->get_tempsettings_id($finyear);
  
  //               $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }
                $getImpAccData = $this->common_model->getImpAcc($jvacc);
               // print_r($getImpAccData);

                if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['acclink_id'];
                    }

$jvamt=0;
$tot_dbamt=0;
 }   
               for ($i=2; $i <=$arrayCount; $i++) { 

//$dbAcc = $allDataInSheet[$i]['A'];
//$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['B'];
//$crAcc = $allDataInSheet[$i]['D'];
$crAcc =$allDataInSheet[$i]['D'];
//$chq_ref = $allDataInSheet[$i]['G'];
//$chq_bank = $allDataInSheet[$i]['H'];

$trnAmt = $allDataInSheet[$i][$col];

$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);

                 $memData = $this->common_model->getCashBankName($crAcc);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=>"JOUR", "cr_account_id"=>$crAcc,"account_id"=>$accId,"trans_amount"=>$trnAmt,"fyear"=>$finyear, "trans_id"=>"ADJ-" . $journal_id,"division_id" =>$divid, "trans_date"=>$rct_date,"trans_narration"=> $jvacc . " against member loan account");



$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }


//print_r($data_ins);

$nxtjvid = $jvid+1;
if($data_ins)
{
$status=$this->common_model->importData('soc_temptrans_tbl',$data_ins); 
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);
}
else
{
  $status="LN ADJ - NO DATA";
}
$data_ins=array();
$tot_dbamt=0;


}  //Loan ADJ Import to trans-tbl




function importLOANMSHR($jvacc,$col)
{

$finyear=$this->session->userdata('finyear');

  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
//$rctdate = $allDataInSheet[2]['B'];
//$deljvData = $this->common_model->del_Jventry($jvmonth);
//print_r($jvmonth);
//print_r($deljvData);

}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);
$setid = $this->common_model->get_tempsettings_id($finyear);
  
  //               $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }
                $getImpAccData = $this->common_model->getImpAcc($jvacc);
               // print_r($getImpAccData);

                if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['acclink_id'];
                    }

$jvamt=0;
 }   
$tot_dbamt=0;

               for ($i=2; $i <=$arrayCount; $i++) { 

//$dbAcc = $allDataInSheet[$i]['A'];
//$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['B'];
$dbAcc = "533";
//$crAcc = $allDataInSheet[$i]['D'];
$crAcc =$allDataInSheet[$i]['D'];
//$chq_ref = $allDataInSheet[$i]['G'];
//$chq_bank = $allDataInSheet[$i]['H'];

$trnAmt = $allDataInSheet[$i][$col];

$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);

                 $memData = $this->common_model->getCashBankName($crAcc);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=>"JOUR", "cr_account_id"=>$crAcc,"account_id"=> $dbAcc,"fyear"=>$finyear, "trans_amount"=>$trnAmt,"trans_id"=>"ADJ-" . $journal_id,"division_id" =>$divid, "trans_date"=>$rct_date,"trans_narration"=>  "Member Share");



$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }


//print_r($data_ins);

$nxtjvid = $jvid+1;
if($data_ins)
{
$status = $this->common_model->importData('soc_temptrans_tbl',$data_ins); 
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);
}
else
{
  $status="M SHR - NO DATA";
}
$data_ins=array();
$tot_dbamt=0;
echo $status;

}  //Loan Mem Share Import to trans-tbl






function importLOANSSHR($jvacc,$col)
{
$finyear=$this->session->userdata('finyear');


  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
//$rctdate = $allDataInSheet[2]['B'];
//$deljvData = $this->common_model->del_Jventry($jvmonth);
//print_r($jvmonth);
//print_r($deljvData);

}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);
$setid = $this->common_model->get_tempsettings_id($finyear);

//                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }
                $getImpAccData = $this->common_model->getImpAcc($jvacc);
               // print_r($getImpAccData);

                if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['acclink_id'];
                    }

$jvamt=0;
 }   
$tot_dbamt=0;

               for ($i=2; $i <=$arrayCount; $i++) { 

//$dbAcc = $allDataInSheet[$i]['A'];
//$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['B'];
$dbAcc = "533";
//$crAcc = $allDataInSheet[$i]['D'];
$crAcc =$allDataInSheet[$i]['F'];
//$chq_ref = $allDataInSheet[$i]['G'];
//$chq_bank = $allDataInSheet[$i]['H'];

$trnAmt = $allDataInSheet[$i][$col];

$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);

                 $memData = $this->common_model->getCashBankName($crAcc);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=>"JOUR", "cr_account_id"=>$crAcc,"account_id"=>$dbAcc,"trans_amount"=>$trnAmt,"fyear"=>$finyear, "trans_id"=>"ADJ-" . $journal_id,"division_id" =>$divid, "trans_date"=>$rct_date,"trans_narration"=>  "Share contributed by Member to Surety Member");



$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }


//print_r($data_ins);

$nxtjvid = $jvid+1;

if($data_ins)
{
$status = $this->common_model->importData('soc_temptrans_tbl',$data_ins); 
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);
}
else
{
  $status="S.SHR - NO DATA";
}
$data_ins=array();
$tot_dbamt=0;
echo $status;

}  //Loan Surety Share Import to trans-tbl


function importLOANTHF($jvacc,$col)
{
$finyear=$this->session->userdata('finyear');


  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
//$rctdate = $allDataInSheet[2]['B'];
//$deljvData = $this->common_model->del_Jventry($jvmonth);
//print_r($jvmonth);
//print_r($deljvData);

}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);
$setid = $this->common_model->get_tempsettings_id($finyear);

//                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }
                $getImpAccData = $this->common_model->getImpAcc($jvacc);
               // print_r($getImpAccData);

                if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['acclink_id'];
                    }

$jvamt=0;
$tot_dbamt=0;
 }   
               for ($i=2; $i <=$arrayCount; $i++) { 

//$dbAcc = $allDataInSheet[$i]['A'];
//$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['B'];
//$crAcc = $allDataInSheet[$i]['D'];
$crAcc =$allDataInSheet[$i]['D'];
//$chq_ref = $allDataInSheet[$i]['G'];
//$chq_bank = $allDataInSheet[$i]['H'];

$trnAmt = $allDataInSheet[$i][$col];

$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);

                 $memData = $this->common_model->getCashBankName($crAcc);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=>"JOUR", "cr_account_id"=>$crAcc,"account_id"=>$accId,"fyear"=>$finyear, "trans_amount"=>$trnAmt,"trans_id"=>"ADJ-" . $journal_id,"division_id" =>$divid, "trans_date"=>$rct_date,"trans_narration"=> $jvacc . " recovered from member ");



$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }


//print_r($data_ins);

$nxtjvid = $jvid+1;

if($data_ins)
{
$status = $this->common_model->importData('soc_temptrans_tbl',$data_ins); 
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);
}
else
{
  $status="THF - NO DATA";
}
$data_ins=array();
$tot_dbamt=0;

echo $status;
}  //THRIFT Import to trans-tbl



function importLOANINT($jvacc,$col)
{
$finyear=$this->session->userdata('finyear');


  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);

}

                 $setid = $this->common_model->get_tempsettings_id($finyear);
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }
                $getImpAccData = $this->common_model->getImpAcc($jvacc);
               // print_r($getImpAccData);

                if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['acclink_id'];
                    }

$jvamt=0;
$tot_dbamt=0;
 }   
               for ($i=2; $i <=$arrayCount; $i++) { 

//$dbAcc = $allDataInSheet[$i]['A'];
//$rctNo = $allDataInSheet[$i]['B'];
$rctdate = $allDataInSheet[$i]['B'];
//$crAcc = $allDataInSheet[$i]['D'];
$crAcc =$allDataInSheet[$i]['D'];
//$chq_ref = $allDataInSheet[$i]['G'];
//$chq_bank = $allDataInSheet[$i]['H'];

$trnAmt = $allDataInSheet[$i][$col];

$UNIX_DATE = ($rctdate - 25569) * 86400;
$rct_date = gmdate("Y-m-d", $UNIX_DATE);

                 $memData = $this->common_model->getCashBankName($crAcc);
                 foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }
                 $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=>"JOUR", "cr_account_id"=>$crAcc,"account_id"=>$accId,"fyear"=>$finyear, "trans_amount"=>$trnAmt,"trans_id"=>"ADJ-" . $journal_id,"division_id" =>$divid, "trans_date"=>$rct_date,"trans_narration"=> $jvacc . " recovered from member against loan");



$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }


//print_r($data_ins);

$nxtjvid = $jvid+1;

if($data_ins)
{
$status = $this->common_model->importData('soc_temptrans_tbl',$data_ins); 
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);
}
else 
{
  $status="INT - NO DATA";
}
$data_ins=array();
$tot_dbamt=0;
echo $status;

}  //INTEREST Import to trans-tbl


function recovery_DivJv()
{
$finyear=$this->session->userdata('finyear');

  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);


//$jvmonth = $allDataInSheet[2]['A'];

                 $setid = $this->common_model->get_tempsettings_id($finyear);
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }


$divacc = trim($allDataInSheet[1]['A']);
$memid = trim($allDataInSheet[1]['B']);
$totamt = trim($allDataInSheet[1]['H']);


//$this->TempimportDIVMJV($totamt,"H");
$this->TempimportDIVMJV($divacc,"A");

}        



} //recoveryDIVJv


function recoveryJv()
{
$finyear=$this->session->userdata('finyear');

  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);


$jvmonth = $allDataInSheet[2]['I'];

                 $setid = $this->common_model->get_tempsettings_id($finyear);
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }


$divacc = trim($allDataInSheet[1]['A']);

$insacc = trim($allDataInSheet[1]['D']);
$thfacc = trim($allDataInSheet[1]['E']);
$priacc = trim($allDataInSheet[1]['F']);
$intacc = trim($allDataInSheet[1]['G']);

//$this->importDivDBJV($divacc,"H");



$this->TempimportJV($insacc,"D");
$this->TempimportJV($thfacc,"E");
$this->TempimportJV($priacc,"F");
$this->TempimportJV($intacc,"G");
}               



} // Recovery JV





function recoveryImport()
{
var_dump("RecoveryImport");

$this->recoveryJv();

$this->recovery_DivJv();


} //RecoveryImport




function TempimportDIVMJV($jvacc,$col)
{
$finyear=$this->session->userdata('finyear');
  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
//$rctdate = $allDataInSheet[2]['B'];

}


//                 $intacc = trim($allDataInSheet[1]['G']);
//$thfacc = trim($allDataInSheet[1]['E']);

                 $setid = $this->common_model->get_tempsettings_id($finyear);
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }


$data_ins=array();
$jvamt=0;
$tot_dbamt=0;
$divid=0;
    
               for ($i=2; $i <=$arrayCount; $i++) { 


//$tdate = $allDataInSheet[$i]['A'];

$divname = $allDataInSheet[$i]['A'];
print_r($divname);

                 $divNameData = $this->common_model->get_account_byname($divname);
                 if($divNameData)
                 {
                 foreach ($divNameData as $key => $dvalue) {
                  $accId = $dvalue['id'];
                     # code...
                 }
               }
               else
               {
                $accId=0;
               }

/*                $getImpAccData = $this->common_model->getImpAcc($dbAcc);
            //    print_r($getImpAccData);



                if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['id'];
                    }
               } 
               else
               {
                $accId=0;
               } */
  /*  $getImpAccData = $this->common_model->get_account_listbyname($dbAcc);
              // print_r($getImpAccData);

                if($getImpAccData)
                {
                  
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['acclink_id'];
                    }
            }
            else 
            {
                $accId=$dbAcc;
            }
*/
//$rctNo = $allDataInSheet[$i]['B'];
//$rctdate = $allDataInSheet[$i]['A'];
//$chq_ref = $allDataInSheet[$i]['C'];
$memId = $allDataInSheet[$i]['B'];
$trnAmt = $allDataInSheet[$i]['H'];
//$narration = $allDataInSheet[$i]['F'];
//$trans_type = $allDataInSheet[$i]['H'];
$trans_type="JOUR";

//$UNIX_DATE = ($rctdate - 25569) * 86400;
//$rct_date = gmdate("Y-m-d", $UNIX_DATE);

                 $jmonth = $allDataInSheet[$i]['I'];
                 $mm = substr($jmonth, 0,2);
                 $yy = substr($jmonth, 2,4);
                 
                 $dd = "16";
                 $jvdate = $yy . '-' . $mm . '-' . $dd;

                 $jv_date = date("Y-m-d", strtotime("+1 months",strtotime($jvdate)));



    $memData = $this->common_model->getCashBankName($memId);
               //print_r($memData);
        foreach ($memData as $key => $mvalue) {
                  $divid = $mvalue['division_id'];
                     # code...
                 }


                 //$jv_date = date("Y-m-d", strtotime("+1 months",strtotime($jvdate)));
               //  $jv_date = date("Y-m-d", strtotime($rctdate));
                if($trnAmt<>0)
                 {

                $journal_id= 'DM-' . $jvprefix . $jvid . '/' . $row['year'];

$data_ins[] = array("db_cr"=> "DB","trans_type"=> $trans_type,"cr_account_id"=> $accId,"account_id"=>$memId,"trans_amount"=>$trnAmt,"division_id"=>$divid, "trans_id"=>$journal_id,"trans_date"=>$jv_date,"trans_narration"=> "Division Recovery credited to member","mm_year"=>$jmonth, "fyear"=>$finyear);

$tot_dbamt = $tot_dbamt+$trnAmt;

  $jvid++;
            
                }
 
                }

//print_r($data_ins);

$nxtjvid = $jvid+1;
$this->common_model->importData('soc_temptrans_tbl',$data_ins); 
//$this->common_model->updateSettings('soc_settings_tbl',$upd_settingsid);
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);
/*
$upd_settingsid = array('journal_id'=>$nxtjvid);

$this->common_model->importData('soc_temptrans_tbl',$data_ins); 

$this->common_model->updateSettings('soc_tempsettings_tbl',$upd_settingsid);
*/
$data_ins=array();
$tot_dbamt=0;


} //importDIVMJV








function TempimportJV($jvacc,$col)
{

$finyear=$this->session->userdata('finyear');
  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
$jvmonth = $allDataInSheet[2]['I'];
//$deljvData = $this->common_model->del_Jventry($jvmonth);
//print_r($jvmonth);
//print_r($deljvData);
}


                 $setid = $this->common_model->get_tempsettings_id($finyear);
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }

                $getImpAccData = $this->common_model->getImpAcc($jvacc);
            //    print_r($getImpAccData);



                if($getImpAccData)
                {
                    $data_ins=array();
                    foreach ($getImpAccData as $key => $iaccvalue) {
                        $accId = $iaccvalue['acclink_id'];
                    }
$jvamt=0;
$tot_dbamt=0;
    
               for ($i=2; $i <=$arrayCount; $i++) { 
                // print_r($allDataInSheet[$i]['A']);
                 $divname = $allDataInSheet[$i]['A'];
                 $memaccid = $allDataInSheet[$i]['B'];
                 $jvamt = $allDataInSheet[$i][$col];

                 $divNameData = $this->common_model->getDivId($divname);
                 foreach ($divNameData as $key => $dvalue) {
                  $divid = $dvalue['id'];
                     # code...
                 }
//print_r($divNameData);
                 //$totamt = $allDataInSheet[$i]['H'];

                 $jmonth = $allDataInSheet[$i]['I'];
                 $mm = substr($jmonth, 0,2);
                 $yy = substr($jmonth, 2,4);
                 
                 $dd = "16";
                 $jvdate = $yy . '-' . $mm . '-' . $dd;

                 $jv_date = date("Y-m-d", strtotime("+1 months",strtotime($jvdate)));
//  print_r($jvamt);
                 if($jvamt<>0)
                 {

                $journal_id= $jvprefix . $jvid . '/' . $row['year'];
//print_r($jv_date);
$data_ins[] = array("db_cr"=> "DB","trans_type"=>"JOUR","cr_account_id"=>$memaccid,"account_id"=>$accId,"trans_amount"=>$jvamt,"trans_id"=>"RVC-" .$journal_id,"division_id" =>$divid, "trans_date"=>$jv_date,"mm_year"=>$jmonth,"fyear"=>$finyear,"trans_narration"=> $jvacc . " Recovery amount Credited to respective member account for the month of  " . $mm . "` " . $yy);

$tot_dbamt = $tot_dbamt+$jvamt;

  $jvid =$jvid+1;
            


                }
 
                } //Forloop

//print_r($data_ins);
if($data_ins)
{ 
  $nxtjvid = $jvid+1;
$this->common_model->importData('soc_temptrans_tbl',$data_ins); 
//$this->common_model->updateSettings('soc_settings_tbl',$upd_settingsid);
$upd_settingsid = array('journal_id'=>$nxtjvid);
$this->db->where("fyear",$finyear);
$this->db->update('soc_tempsettings_tbl', $upd_settingsid);


}
$data_ins=array();
$tot_dbamt=0;


} //GetImpAccData  //Interest Import to trans-tbl



} // TempImportJV





function importTrans()
{

 $trtype = $this->input->post("transtype");
$finyear=$this->session->userdata('finyear');


if($trtype=="JOUR")
{

  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);


$jvmonth = $allDataInSheet[2]['I'];
                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }


$divacc = trim($allDataInSheet[1]['A']);

$insacc = trim($allDataInSheet[1]['D']);
$thfacc = trim($allDataInSheet[1]['E']);
$priacc = trim($allDataInSheet[1]['F']);
$intacc = trim($allDataInSheet[1]['G']);

//$this->importDivDBJV($divacc,"H");



$this->importJV($insacc,"D");
$this->importJV($thfacc,"E");
$this->importJV($priacc,"F");
$this->importJV($intacc,"G");

//$principleData = $this->common_model->getPrinciple($jvmonth);

//$principlearray = array();

//$thriftData = $this->common_model->getThrift($jvmonth);
//$thriftarray = array();
/*
foreach ($thriftData as $key => $tvalue) {
  # code...trans_refid,member_id,trans_date,trans_amount,month
$thriftarray[]= array("trans_refid"=>$tvalue["trans_ref"],"member_id"=>$tvalue["account_id"],"trans_date"=>$tvalue["trans_date"],"trans_amount"=>$tvalue["trans_amount"],"month_year"=>$jvmonth);
} 
*/
//$sumThriftData = $this->common_model->getSumThrift();
}              

} //JOURNAL


// DIV to MEM

if($trtype=="DIVMEM")
{

  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);


$jvmonth = $allDataInSheet[2]['A'];
                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }


$divacc = trim($allDataInSheet[1]['B']);
$memid = trim($allDataInSheet[1]['C']);
$totamt = trim($allDataInSheet[1]['E']);
/*
$insacc = trim($allDataInSheet[1]['D']);
$thfacc = trim($allDataInSheet[1]['E']);
$priacc = trim($allDataInSheet[1]['F']);
$intacc = trim($allDataInSheet[1]['G']);
*/
//$this->importDivDBJV($divacc,"H");



$this->importDIVMJV($totamt,"D");
/*$this->importJV($thfacc,"E");
$this->importJV($priacc,"F");
$this->importJV($intacc,"G");
*/
//$principleData = $this->common_model->getPrinciple($jvmonth);

//$principlearray = array();

//$thriftData = $this->common_model->getThrift($jvmonth);
//$thriftarray = array();
/*
foreach ($thriftData as $key => $tvalue) {
  # code...trans_refid,member_id,trans_date,trans_amount,month
$thriftarray[]= array("trans_refid"=>$tvalue["trans_ref"],"member_id"=>$tvalue["account_id"],"trans_date"=>$tvalue["trans_date"],"trans_amount"=>$tvalue["trans_amount"],"month_year"=>$jvmonth);
} 
*/
//$sumThriftData = $this->common_model->getSumThrift();
}              

} // DIV-MEM




if($trtype=="OPUPD")
{
  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);

                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['receipt_prefix'];
                    $jvid= $row['receipt_id'];
                    
                    }


$this->opbalupdate();


    }              

}


if($trtype=="RCPT")
{

  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);


$dbAcc = $allDataInSheet[2]['A'];
$rctNo = $allDataInSheet[2]['B'];
$rctdate = $allDataInSheet[2]['C'];
$crAcc = $allDataInSheet[2]['D'];
$trnAmt = $allDataInSheet[2]['F'];


$chq_ref = $allDataInSheet[2]['G'];
$chq_bank = $allDataInSheet[2]['I'];
$trn_type = $allDataInSheet[2]['H'];



                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['receipt_prefix'];
                    $jvid= $row['receipt_id'];
                    
                    }


$thfacc = trim($allDataInSheet[1]['J']);
$priacc = trim($allDataInSheet[1]['K']);
$intacc = trim($allDataInSheet[1]['L']);
$shracc = trim($allDataInSheet[1]['M']);
$misacc = trim($allDataInSheet[1]['N']);
$insacc = trim($allDataInSheet[1]['O']);
$sliaacc = trim($allDataInSheet[1]['P']);
$sastacc = trim($allDataInSheet[1]['Q']);
$othacc = trim($allDataInSheet[1]['R']);


//$this->importRCT($dbAcc,"A");

$this->importRJV($thfacc,"J");
$this->importRJV($priacc,"K");
$this->importRJV($intacc,"L");
$this->importRJV($shracc,"M");
$this->importRJV($misacc,"N");
$this->importRJV($insacc,"O");
$this->importRJV($othacc,"P");
$this->importRJV($othacc,"Q");
$this->importRJV($othacc,"R");


    }              

}  //RECEIPT



if($trtype=="DIVJV")
{

  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);


$dbAcc = $allDataInSheet[2]['A'];
$rctNo = $allDataInSheet[2]['B'];
$rctdate = $allDataInSheet[2]['C'];
$crAcc = $allDataInSheet[2]['D'];
$trnAmt = $allDataInSheet[2]['F'];


$chq_ref = $allDataInSheet[2]['G'];
$chq_bank = $allDataInSheet[2]['H'];




                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['receipt_prefix'];
                    $jvid= $row['receipt_id'];
                    
                    }


$thfacc = trim($allDataInSheet[1]['I']);
$priacc = trim($allDataInSheet[1]['J']);
$intacc = trim($allDataInSheet[1]['K']);
$shracc = trim($allDataInSheet[1]['L']);
$misacc = trim($allDataInSheet[1]['M']);
$insacc = trim($allDataInSheet[1]['N']);
$sliaacc = trim($allDataInSheet[1]['O']);
$sastacc = trim($allDataInSheet[1]['P']);
$othacc = trim($allDataInSheet[1]['Q']);


$this->importDIVRCT($dbAcc,"A");

$this->importRDIVJV($thfacc,"I");
$this->importRDIVJV($priacc,"J");
$this->importRDIVJV($intacc,"K");
$this->importRDIVJV($shracc,"L");
$this->importRDIVJV($misacc,"M");
$this->importRDIVJV($insacc,"N");
$this->importRDIVJV($sliaacc,"O");
$this->importRDIVJV($sastacc,"P");
$this->importRDIVJV($othacc,"Q");


    }              

}  //RECEIPT DIV JV





if($trtype=="PYMT")
{

  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);


//$jvmonth = $allDataInSheet[2]['I'];
                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }


$bnkacc = trim($allDataInSheet[1]['A']);
$thfacc = trim($allDataInSheet[1]['E']);
$priacc = trim($allDataInSheet[1]['F']);
$intacc = trim($allDataInSheet[1]['G']);

$this->importPYMT($bnkacc,"A");
/*
$this->importPYMT($thfacc,"B");
$this->importPYMT($priacc,"C");
$this->importPYMT($intacc,"D");*/

$principleData = $this->common_model->getPrinciple($jvmonth);

$principlearray = array();

$thriftData = $this->common_model->getThrift($jvmonth);
$thriftarray = array();

foreach ($thriftData as $key => $tvalue) {
  # code...trans_refid,member_id,trans_date,trans_amount,month
$thriftarray[]= array("trans_refid"=>$tvalue["trans_ref"],"member_id"=>$tvalue["account_id"],"trans_date"=>$tvalue["trans_date"],"trans_amount"=>$tvalue["trans_amount"],"month_year"=>$jvmonth);
}

  $sumThriftData = $this->common_model->getSumThrift();
    }              

}  //PYMT


if($trtype=="LOAN")
{

  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);


$jvmonth = $allDataInSheet[2]['I'];
                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }


$loanacc = trim($allDataInSheet[1]['H']);
$lnadjacc = trim($allDataInSheet[1]['I']);
$mshracc = trim($allDataInSheet[1]['J']);
$sshracc = trim($allDataInSheet[1]['K']);
$trfacc = trim($allDataInSheet[1]['L']);
$intacc = trim($allDataInSheet[1]['M']);

$this->importLOAN($loanacc,"H");

$this->importLOANADJ($lnadjacc,"I");
$this->importLOANMSHR($mshracc,"J");
$this->importLOANSSHR($sshracc,"K");
$this->importLOANTHF($trfacc,"L");
$this->importLOANINT($intacc,"M");


/*
$this->importPYMT($thfacc,"B");
$this->importPYMT($priacc,"C");
$this->importPYMT($intacc,"D");*/

$principleData = $this->common_model->getPrinciple($jvmonth);

$principlearray = array();

$thriftData = $this->common_model->getThrift($jvmonth);
$thriftarray = array();

foreach ($thriftData as $key => $tvalue) {
  # code...trans_refid,member_id,trans_date,trans_amount,month
$thriftarray[]= array("trans_refid"=>$tvalue["trans_ref"],"member_id"=>$tvalue["account_id"],"trans_date"=>$tvalue["trans_date"],"trans_amount"=>$tvalue["trans_amount"],"month_year"=>$jvmonth);
}

  $sumThriftData = $this->common_model->getSumThrift();
    }              

}  //LOAN



function import()
{
  if(isset($_FILES["file"]["name"]))
  {



              $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $reader->setReadDataOnly(true);
//$spreadsheet = $reader->load("05featuredemo.xlsx");
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
             //  print_r($allDataInSheet);
                // array Count
                $arrayCount = count($allDataInSheet);
               // print_r($arrayCount);
$jvmonth = $allDataInSheet[2]['I'];
$deljvData = $this->common_model->del_Jventry($jvmonth);
//print_r($jvmonth);
//print_r($deljvData);
                 $setid = $this->common_model->get_settings_id();
                    foreach ($setid as $key=> $row)
                    {
                    $jvprefix = $row['journal_prefix'];
                    $jvid= $row['journal_id'];
                    
                    }



               for ($i=2; $i <=$arrayCount; $i++) { 
                // print_r($allDataInSheet[$i]['A']);
                 $divname = $allDataInSheet[$i]['A'];
                 $memaccid = $allDataInSheet[$i]['B'];
                 $memname = $allDataInSheet[$i]['C'];

                 $insamt = $allDataInSheet[$i]['D'];
                 $thfamt = $allDataInSheet[$i]['E'];
                 $priamt = $allDataInSheet[$i]['F'];
                 $intamt = $allDataInSheet[$i]['G'];


                 $totamt = $allDataInSheet[$i]['H'];

                 $jmonth = $allDataInSheet[$i]['I'];
                 $mm = substr($jmonth, 0,2);
                 $yy = substr($jmonth, 2,4);
                 
                 $dd = "15";
                 $jvdate = $yy . '-' . $mm . '-' . $dd;

                 $jv_date = date("Y-m-d", strtotime("+1 months",strtotime($jvdate)));
                 //$jv_date = date("Y-m-d", strtotime("-1 months"));

                 //print_r($jmonth);
                 //print_r($jv_date);

                 $divdata = $this->common_model->getDivId($divname);
                 foreach ($divdata as $value) {
                   $divaccid = $value['division_id'];
                 }
                 if($totamt<>0)
                 {

                $journal_id= $jvprefix . $jvid . '/' . $row['year'];

                 $jvdata[] = array(
                  'journal_number'=>$journal_id,
                  'journal_date'=>$jv_date,
                  'month' => $jmonth,
                  'debitaccount_number'=>$divaccid,
                  'debit_accountname'=>$divname,
                  'debit_amount'=>$totamt,
                  'creditaccount_number'=>$memaccid,
                  'credit_accountname'=>$memname,
                  'credit_amount'=>$totamt,
                  'journal_narration' =>"Recovery amount Credited to respective account for the month of  " . $mm . "` " . $yy 

                );
               
                }
                 $itmarr = array(
                  $thfamt,
                  $intamt,
                  $priamt,
                  $insamt);
                 

                //for ($x=0; $x <count($itmarr) ; $x++) { 
                //print_r($itmarr);
                 $id=1;
                for ($x=0; $x <count($itmarr) ; $x++) { 
                 
                  $itemmastData = $this->common_model->getItemNamebyId($id);
                  foreach ($itemmastData as $value) {
                    $itemName= $value['item_name'];
                  }

                  if($totamt) {
                 $itemtrans[] = array(
                  'trans_date'=>$jv_date,
                  'trans_ref'=>$journal_id,
                  'trans_amount'=>$itmarr[$x],
                  'trans_type'=>'JOUR',
                  'account_id'=>$memaccid,
                  'account_name'=>$memname,
                  'cash_bank'=>$divaccid,
                  'item_id' => $id,
                  'item_name' => $itemName,
                  'mmyy' => $mm . $yy

                 );
               }
                 $id++;
                 
               }
               if($totamt<>0)
               {
               $jvid++;
             }
               }

      //   print_r($itmarr);
//print_r($itemtrans);
              
//$journal_id= $jvid . '/' . $row['year'];               

$nxtjvid = $jvid+1;
$upd_settingsid = array('journal_id'=>$nxtjvid);


$data['journalData'] = $jvdata;
$data['itemtransData'] = $itemtrans;

                //    $data['dataInfo'] = $fetchData;
                    //$this->common_model->setBatchImport($jvdata);
                    $this->common_model->importData('soc_journalentry_tbl',$jvdata);
                   // $this->common_model->setBatchImport($itemtrans);
                    $this->common_model->importData('soc_itemtrans_tbl',$itemtrans);

                    $this->common_model->updateSettings('soc_settings_tbl',$upd_settingsid);


//print_r($jvmonth);
$thriftData = $this->common_model->getThrift($jvmonth);
//print_r($thriftData);
$principleData = $this->common_model->getPrinciple($jvmonth);

$thriftarray = array();
$principlearray = array();

foreach ($thriftData as $key => $tvalue) {
  # code...trans_refid,member_id,trans_date,trans_amount,month
$thriftarray[]= array("trans_refid"=>$tvalue["trans_ref"],"member_id"=>$tvalue["account_id"],"trans_date"=>$tvalue["trans_date"],"trans_amount"=>$tvalue["trans_amount"],"month_year"=>$jvmonth);
}

//print_r($thriftarray);
foreach ($principleData as $key => $pvalue) {
$principlearray[]= array("trans_refid"=>$pvalue["trans_ref"],"member_id"=>$pvalue["account_id"],"trans_date"=>$pvalue["trans_date"],"trans_amount"=>$pvalue["trans_amount"],"month_year"=>$jvmonth);
}
//print_r($principlearray);

foreach ($thriftarray as $data_thrift) {
    $insert_query = $this->db->insert_string('soc_thrift_tbl', $data_thrift);
    $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
    $this->db->query($insert_query);
}



foreach ($principlearray as $data_principle) {
    $insert_query = $this->db->insert_string('soc_principle_tbl', $data_principle);
    $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
    $this->db->query($insert_query);
}

 // $this->common_model->insertRecovery('soc_thrift_tbl',$thriftarray,$jmonth);
  //$this->common_model->insertRecovery('soc_principle_tbl',$principlearray,$jmonth);



//Update Thrift & Priciple OP_Closing Balance to Memebers Table
 $trfData= array();
 $prnData= array();
  $sumThriftData = $this->common_model->getSumThrift();

foreach ($sumThriftData as $key => $smtvalue) {
  $trfData[] = array("member_id"=>$smtvalue['member_id'],"thrift_deposit" => $smtvalue["smthrift"]);
}

    $this->db->update_batch('soc_members_tbl', $trfData, 'member_id');

  $sumPrincipleData = $this->common_model->getSumPrinciple();
//print_r($sumPrincipleData);

foreach ($sumPrincipleData as $key => $prnvalue) {
  $prnData[] = array("member_id"=>$prnvalue["member_id"],"loan_outstanding" => $prnvalue["smprinciple"]);
}
$this->db->update_batch('soc_members_tbl', $prnData, 'member_id');


  $recoveryData = $this->common_model->getRecData($jvmonth);

    foreach ($recoveryData as $key => $value) {
      # code...
#(member_id,member_name,trans_ref,recovery_date,thrift_amount,interest_amount,principle_amount,insurance_amount,month_year) select 
      #itm.account_id,itm.account_name,itm.trans_ref,itm.trans_date
      $recData[] = array('member_id'=>$value['account_id'],'member_name'=>$value['account_name'],'trans_ref'=>$value['trans_ref'],'recovery_date'=>$value['trans_date'],'thrift_amount'=>$value['thrift'],'interest_amount'=>$value['interest'],'principle_amount'=>$value['principle'],'insurance_amount'=>$value['insurance'],'month_year'=>$value['mmyy']);
    }

    $this->common_model->insertRecovery('soc_recovery_tbl',$recData,$jvmonth);


             //   $this->load->view('spreadsheet/display', $data);
            }              


}



    // checkFileValidation
  function checkFileValidation($string) {
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
 
}
}
