
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> All Members
				
				
				 <?php if ($this->session->userdata('role') == 'admin'): ?>
                 
                    <a href="" class="btn btn-info btn-sm pull-right"  data-toggle="modal" data-target="#add-Member-modal"><i class="fa fa-plus"></i>&nbsp;New Member</a> &nbsp;
                <?php else: ?>
                    <!-- check logged user role permissions -->

                    <?php if(check_power(1)):?>
                        <a href="<?php echo base_url('admin/user') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp;New User</a>
                    <?php endif; ?>
                <?php endif ?>
				
				</div>
				
                <div class="panel-body table-responsive">
				
				 <?php $msg = $this->session->flashdata('msg'); ?>
            <?php if (isset($msg)): ?>
                <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>

            <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>

                <table id="manageMemberTable">
                            <thead>
                                <tr><th>Member #</th>
                                    <th>Member Name</th>
                                    <th>Member Mobile</th>
                                    <th>DOB</th>
                                    <th>DOJ</th>
                                    <th>DIV</th>
                                    <th>DESG</th>
                                    
                                    <th>Loan Outstanding</th>
                                    <th>Share O/P</th>
                                    <th>Thrift O/P</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Member #</th>
                                    <th>Member Name</th>
                                    <th>Member Mobile</th>
                                    <th>DOB</th>
                                    <th>DOJ</th>
                                    <th>DIV</th>
                                    <th>DSG</th>
                                    
                                    <th>Loan Outstanding</th>
                                    <th>Share O/P</th>
                                    <th>Thrift O/P</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                    
                </table>

                    </div>
					
					
            </div>
        </div>
    </div>

 </div>

    <!-- End Page Content -->


<!-- Edit Member -->

<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="modalAddMember" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Member</h4>
      </div>
      <div id="add-member-message"></div>

      <form action="createMember" method="post" id="--createNewmem">
      <div class="modal-body">
        <label>Member Name</label>
        <span><input type="text" autocomplete="off"  style="text-transform: uppercase" id="memname" name="memname" placeholder="Member Name" class="form-control" required></span>
      </div>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

      <div class="modal-footer">
        <button type="submit" id="save_btn" class="btn btn-success" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>


    </div>

  </div>
</div>



<!-- Add Member Modal -->
<div class="modal fade" id="add-Member-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                </button>
                 <h4 class="modal-title" id="myModalLabel">Add Member Details</h4>

            </div>
      <div id="add-member-message"></div>
      


      <form action="do_upload" method="POST" enctype="multipart/form-data" id="createNewmem">

            <div class="modal-body">
            
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="myTabs">
                        <li role="presentation" class="active settingshead">
                        <a href="#basdetailsTab" data-toggle="tab">Basic Details</a>

                        </li>
                        <li role="presentation" class="settingshead">
                <a href="#officedetailsTab" data-toggle="tab">Office Details</a>

                        </li>
                        <li role="presentation" class="settingshead">
            <a href="#nomineedetailsTab" data-toggle="tab">Nominee Details</a>

                        </li>
                        <li role="presentation" class="settingshead">
            <a href="#bankdetailsTab" data-toggle="tab">Bank Details</a>

                        </li>
                        <li role="presentation" class="settingshead">
            <a href="#suretydetailsTab" data-toggle="tab">Surety Details</a>

                        </li>


                    </ul>
                    <!-- Tab panes -->
 <div class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="basdetailsTab">



<table class="table">
    <tr>
        <td>                         
                            <div class="input-group">
                                 <span class="input-group-addon">Member ID#</span>
                                  <input id="memberNumber" class="form-control"  name="memberNumber" type="text" value="<?php echo $lastmember_id; ?>" readonly>
                            </div>
                            <div class="input-group">         
                                       <span class="input-group-addon">
                                                        GENDER
                                                    </span>
                                        <select id="memberGender" name="memberGender" class="custom-select col-6 form-control" id="inlineFormCustomSelect">
                                            <option selected>Choose...</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Transgender</option>
                                        </select>                                                
                             </div>           

<div class="input-group">
<span class="input-group-addon">DOB
                                                  </span>
                                                  
                                                     <input autocomplete="off"  class="form-control" type="date" name="dbirth" id="dbirth" onchange="dob_handler(event);">

                                                    <span class="input-group-addon">Age
                                                  </span>
                                                  
                                                    <input class="form-control form-group" type="text" id="age" name="age" readonly>
 </div>


</td>
        <td>
                                        <div class="input-group">
                                         <span class="input-group-addon">Name</span>
                                        <input id="memberName" name="memberName" type="text" autocomplete="off" class="typeahead form-control" aria-label="Text input with checkbox">
                                       </div>
                                       <div class="input-group">
                                               <span class="input-group-addon">
                                                        MARITAL STS
                                                    </span>
                                        <select id="maritalStatus" name="maritalStatus" class="custom-select col-6 form-control" id="inlineFormCustomSelect">
                                            <option selected>Choose...</option>
                                            <option value="1">UnMarried</option>
                                            <option value="2">Married</option>
                                            <option value="3">Widow</option>
                                            <option value="3">Widower</option>
                                            <option value="3">Divorcee</option>
                                        </select>
                                    </div>

<div class="input-group">
                                                   <span class="input-group-addon">
                                                        DOJ
                                                    </span>
                                                     <input  autocomplete="off" class="form-control" type="date" name="doj" id="doj" onchange="doj_handler(event);">

                                                    <span class="input-group-addon">NYS
                                                  </span>
                                                  
                                                    <input id="nys" namd="nys" class="form-control" type="text" readonly>
    
</div>

</td>
        <td>

    <div class="picture-container">
        <div class="picture">
            <img src="<?php echo base_url();?>optimum/images/nopic.jpg" class="picture-src" id="wizardPicturePreview" title="">
            <input type="file" id="userfile" name="userfile" class="">
        </div>
         <h6 class="">Choose Picture</h6>

    </div>            
        </td>
    </tr>
  <tr> 
<td>
    <div class="input-group">
                                                    <span class="input-group-addon">Mobile</span>
                                                    <input  autocomplete="off" id="mobile" name="mobile" type="text" class="form-control">
                                                    
        
    </div>


</td>
<td>
 <div class="input-group">
                                                    <span class="input-group-addon">Land Line</span>

                                                    <input autocomplete="off"  id="landline" name="landline" type="text" class="form-control">
                                                    <br>
     
 </div>   
</td>
</tr>
<tr>



    <td colspan="3">
<div class="input-group">
<span class="input-group-addon">Residential Address </span>
<input autocomplete="off"  id="resaddr" name="resaddr" type="text" class="form-control">
</div>
</td>
</tr>

</table>
  
</div>   


<div role="tabpanel" class="tab-pane fade" id="officedetailsTab">



<table class="table">
    <tr>
        <td>
<div class="input-group">
                                                     <span class="input-group-addon">Division</span>
                                                    <select name="division" class="custom-select col-6 form-control" id="division">
                                                    <option selected>Select a Division</option>    
                                                    </select>
</div>      
        </td>
        <td>
<div class="input-group">            
                                                           <span class="input-group-addon">Sub Division</span>
                                                    <select name="subdivision" class="custom-select col-6 form-control" id="subdivision">
                                                    <option selected>Sub Division</option>    
                                                    </select>
</div>     
        </td>
        <td>
<div class="input-group">    
                                                      <span class="input-group-addon">Department</span>
                                                    <select name="department" class="custom-select col-6 form-control" id="department">
                                                    <option selected>Department</option>    
                                                    </select>
</div>          
        </td>
    </tr>
    <tr>
        <td>
<div class="input-group">
                                                 <span class="input-group-addon">Section</span>
                                                    <select name="section" class="custom-select col-6 form-control" id="section">
                                                    <option selected>Section</option>    
                                                    </select>
</div>               
        </td>
        <td>
<div class="input-group">
                                            <span class="input-group-addon">Designation</span>
                                                    <select name="designation" class="custom-select col-6 form-control" id="designation">
                                                    <option selected>Designation</option>    
                                                    </select>
</div>                    
        </td>
        <td>
<div class="input-group">
                                                     <span class="input-group-addon">E-mail </span>
                                                    
                                                    <input autocomplete="off"  id="email" name="email" type="text" class="form-control" aria-label="Text input with checkbox">
</div>           
        </td>
    </tr>


  <tr>
        <td>
<div class="input-group">
                                                     <span class="input-group-addon">Religion</span>
                                                    <select name="religion" class="custom-select col-6 form-control" id="religion">
                                                    <option selected>Select a Religion</option>    
                                                    </select>
</div>      
        </td>
        <td>
<div class="input-group">            
                                                           <span class="input-group-addon">Caste</span>
                                                    <select name="caste" class="custom-select col-6 form-control" id="caste">
                                                    <option selected>Select a Caste</option>    
                                                    </select>
</div>     
        </td>
        <td>
<div class="input-group">    
                                                      <span class="input-group-addon">Sub Caste</span>
                                                    <select name="subcaste" class="custom-select col-6 form-control" id="subcaste">
                                                    <option selected>Sub Caste</option>    
                                                    </select>
</div>          
        </td>
    </tr>
  


<tr>
    <td>
            <div class="picture-container">
        <div class="picture-id">
            <img src="<?php echo base_url();?>optimum/images/nopicid.jpg"  class="pictureid-src" id="offidcardPreview" title="">
            <input type="file" id="offidcard" class="">
        </div>
         <h6 class="">Choose Office ID Card</h6>

    </div>            

    </td>
    <td>
            <div class="picture-container">
        <div class="picture-oid">
            <img src="<?php echo base_url();?>optimum/images/nopicid.jpg" class="pictureoid-src" id="othidcardPreview" title="">
            <input type="file" id="othidcard" class="">
        </div>
         <h6 class="">Choose Other ID Proof</h6>

    </div>            

    </td>

</tr>
</table>

</div>

<div role="tabpanel" class="tab-pane fade" id="nomineedetailsTab">
<table class="table">
    <tr>
    <td>
<div class="input-group">
    <input type="checkbox" class="form-horizontal" data-width="150" data-height="40" checked data-toggle="toggle" data-on="Father" id="check_fh" name="check_fh" data-off="Husband" data-onstyle="success" data-offstyle="danger"/>
    
    <input  autocomplete="off" type="text" id="fh_Name" name="fh_Name" class="form-control" placeholder="Father / Husband Name"/>
</div>        
      
</td>
    </tr>

<table class="table" id="nomineeTbl">
<thead>
<th>Nominee Name &nbsp; <button id="nomineeBtn" class="btn btn-primary"><i class="fa fa-plus"></i></button></th>
<th>Date of Birth</th>
<th>Relationship</th>
<th>Action</th>
</thead>
<tbody>

         <?php $arrayNumber = 0; for($x = 1; $x <= 1; $x++) { ?>
          <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
        <td class="form-horizontal">
              <div class="input-group">
                  <input class="form-control" type="text" id="nominee[][nominee_name]" autocomplete="off" name="nominee[][nominee_name]" placeholder="Nominee Name">
<!--<ul class="dropdown-menu txtitemname" style="margin-left:15px;margin-right:0px;" role="menu" aria-labelledby="dropdownMenu"  id="DropdownItem"></ul> -->
              </div>
            </td>




<td><input class="form-control" type="date" name="nominee[][nominee_dob]" id="nominee[][nominee_dob]"></td>
<td><select class="form-control" id="nominee[][nominee_relation]" name="nominee[][nominee_relation]">
    <option value="1">Spouse</option>  
    <option value="1">Son</option>
    <option value="1">Un-Married Daughter</option>    
</select>

</td>
<td></td>
</tr>
 <?php $arrayNumber++; } ?>
</tbody>
</table>

</table>
</div>

<div role="tabpanel" class="tab-pane fade" id="bankdetailsTab">

<table id="bankdetailsTbl" class="table">
    <tr>
        <td>
          <div class="input-group">
            <span class="input-group-addon">Bank Name</span>
            <input autocomplete="off"  id="bnkName" name="bnkName" type="text" class="form-control" aria-label="Text input with checkbox">
          </div>
        </td>
<td>
<div class="input-group">
    <span class="input-group-addon">Branch</span>
    <input autocomplete="off"  id="bnkBranch" name="bnkBranch" type="text" class="form-control">
</div> 
                                            
</td>
<td>
<div class="input-group">
    <span class="input-group-addon">Account Name</span>
    <input autocomplete="off"  id="accName" name="accName" type="text" class="form-control">
</div> 
    
</td>
</tr>    
<tr>

<td>
<div class="input-group">
    <span class="input-group-addon">Account Number</span>
    <input autocomplete="off"  id="accNumber" name="accNumber" type="text" class="form-control">
</div> 
    
</td>
<td>
<div class="input-group">
    <span class="input-group-addon">IFS Code</span>
    <input autocomplete="off"  id="ifscode" name="ifscode" type="text" class="form-control">
</div> 
    
</td>

<td>
<div class="input-group">
    <span class="input-group-addon">Branch Address</span>
    <input autocomplete="off"  id="bnkAddr" name="bnkAddr" type="text" class="form-control">
</div> 
    
</td>

    </tr>
</table>

</div>     


<div role="tabpanel" class="tab-pane fade" id="suretydetailsTab">
<table class="table" id="suretyTbl">
 <tr>
     <td>
                                       <div class="input-group" id="ajxremote">
                                            <span class="highlight"></span> 
                                       <span class="input-group-addon">Surety Name</span>
         

                                        
                                            <input autocomplete="off"  id="surety_name" name="surety_name" onchange="snamechange();" type="text" class="form-control form-control-success typeahead" required>
                                        
                                        </div>
     </td>

<td>
                                                                                  
                                    <div class="input-group">
                                    <span class="input-group-addon">Surety Number</span>
                                    <input  autocomplete="off" id="surety_id" name="surety_id" name="surety_id" type="text" class="typeahead form-control" readonly>

                                    </div>                                          
</td>
<td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Share Capital</span>
                                                 <input  autocomplete="off" id="mSuretyCapital" name="mSuretyCapital" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>       
</td>
</tr>
<tr>
<td>                                                                           
                                        <div class="input-group">
                                            <span class="input-group-addon">Thrift Deposit</span>
                                                 <input autocomplete="off"  id="mThriftDeposit" name="mThriftDeposit" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>                                          
 </td>
<td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Loan Amount</span>
                                                 <input  autocomplete="off" id="mLoanAmt" name="mLoanAmt" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>                                          
</td>
<td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Rate of Interest</span>
                                                 <input  autocomplete="off" id="roi" name="roi" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>                                          
</td>
</tr>
<tr>
<td>
                                        <div class="input-group">
                                            <span class="input-group-addon">No of Installments</span>
                                                 <input autocomplete="off"  id="noi" name="noi" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>                                          
</td>
<td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Principle Amount</span>
                                                 <input  autocomplete="off" id="principleAmt" name="principleAmt" type="text" class="form-control" aria-label="Text input with checkbox">

                                        </div>  
</td>
<td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Installment Amount</span>
                                                 <input autocomplete="off"  id="insAmt" name="insAmt" type="text" class="form-control" aria-label="Text input with checkbox">

                                        </div>                                                 
</td>
</tr>
</table>

</div>     


                    </div>
                </div>
            </div>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="form_submit()" class="btn btn-primary save">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal HTML -->







<!-- Modal Edit Member -->

<!-- Modal -->
<div class="modal fade" id="edit-Member-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>

                </button>
                 <h4 class="modal-title" id="myModalLabel">Edit Member Details</h4>

            </div>
            <div class="modal-body">

<!---Stard Edit Modal--->

<!--End Edit Modal-->


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save">Save changes</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal HTML -->

<div id="deleteModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa fa-times"></i>
                </div>              
                <h4 class="modal-title">Are you sure?</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete this record? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                <button type="button" id="delRec" class="btn btn-danger"  data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>  



<script type="text/javascript">
    var manageMemberTable;
 $(document).ready(function(){

      var tr = $('#nomineeTbl').closest('tr'); // tbody tr");
      var trid = $(this).closest('tr').attr('id'); 
      //count = trid.substring(3);
      count = $(tr).attr('trid');


var urlstr = base_url + 'fetchReligion';
var url = urlstr.replace("undefined","");
//var url = $("#base_url").val();
$('#religion').load(url, function() {
    
}); // /.fetching the selected class's section date                 

var urlstr = base_url + 'fetchCaste';
var url = urlstr.replace("undefined","");
//var url = $("#base_url").val();
$('#caste').load(url, function() {
    
}); // /.fetching the selected class's section date                 

var urlstr = base_url + 'fetchSubcaste';
var url = urlstr.replace("undefined","");
//var url = $("#base_url").val();
$('#subcaste').load(url, function() {
    
}); // /.fetching the selected class's section date                 




var urlstr = base_url + 'fetchDivision';
var url = urlstr.replace("undefined","");
//var url = $("#base_url").val();
$('#division').load(url, function() {
    
}); // /.fetching the selected class's section date                 

var urlstr = base_url + 'fetchsubDivision';
var url = urlstr.replace("undefined","");
//var url = $("#base_url").val();
$('#subdivision').load(url, function() {
    
}); // /.fetching the selected class's section date                 

var urlstr = base_url + 'fetchDepartment';
var url = urlstr.replace("undefined","");
//var url = $("#base_url").val();
$('#department').load(url, function() {
    
}); // /.fetching the selected class's section date                 

var urlstr = base_url + 'fetchsection';
var url = urlstr.replace("undefined","");
//var url = $("#base_url").val();
$('#section').load(url, function() {
    
}); // /.fetching the selected class's section date                 


var urlstr = base_url + 'fetchdesignation';
var url = urlstr.replace("undefined","");
//var url = $("#base_url").val();
$('#designation').load(url, function() {
    
}); // /.fetching the selected class's section date                 



$("#nomineeBtn").on('click',function(){

    var tableLength = $("#nomineeTbl tbody tr").length;
console.log(tableLength);
    var tableRow;
    var arrayNumber;
    //alert(tableLength);
    var frw=1;
    if(tableLength > 0) {
        
            tableRow = $("#nomineeTbl tbody tr:first").attr('id');
            arrayNumber = $("#nomineeTbl tbody tr:first").attr('class');
        console.log('tblrw'+tableRow);
        count = tableRow.substring(3);  
        console.log('countfff'+count);
        //count = Number(count) + 1;
        console.log('count'+count);
        arrayNumber = Number(arrayNumber) + 1;  
       frw=frw+1;       
    } else {
        // no table row
        count = 1;
        arrayNumber = 0;
    }
    
    var etr2 = '<tr id="row'+count+'" class="'+arrayNumber+'">'+                                    

'<tr><td><input class="form-control" type="text" autocomplete="off" placeholder="Nominee Name" name="nominee[][nominee_name]" id="nominee[][nominee_name]"></td><td><input class="form-control" type="date" name="nominee[][nominee_dob]" id="nominee[][nominee_dob]"></td><td><select class="form-control" id="nominee[][nominee_relation" name="nominee[][nominee_relation"><option value="1">Spouse</option> <option value="2">Son</option><option value="3">Un-Married Daughter</option></select></td><td><button type="button" class="btn btn-danger delete"><i class="fa fa-trash"></i></button></td></tr>';
        
    if(tableLength > 0) {                           
    var $td = $(etr2);
        $("#nomineeTbl tbody tr:last").after($td);
        $('#nominee_name' + count).focus();

        } else {                
        $("#nomineeTbl tbody").append(tr);
    }               

});


//createTypeahead($td.find('input.edititemSearch'));
$("#delete-row").on('click',function(){
    
     $(this).parents("tr").remove();
    $(this).remove();
    return false;
});


$("#offidcard").change(function() {
 readURLOID(this);
});


$("#othidcard").change(function() {
 readURLOTHID(this);
});
// Prepare the preview for profile picture
    $("#userfile").change(function(){
        readURL(this);
    });



$(".nav-tabs a").click(function(){
     $(this).tab('show');
 });

    $('#save_btn').on('click',function(){
        //alert('Save Btn Clicked');
   var memname = $('#memname').val();



    });
MemberList()






function readURLOTHID(input) {
    console.log('othimg');
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#othidcardPreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}        
        
function readURLOID(input) {
    console.log('offimg');
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#offidcardPreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}        


        
function readURL(input) {
    console.log('img');
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}        



  });  



function form_submit() {
console.log('ImageFormSubmit');
var urlstr = base_url + 'createMember';
var url = urlstr.replace("undefined","");

    document.getElementById("createNewmem").submit();
   }    


    $(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
//        $(".add-new").removeAttr("disabled");
    });


function removeNomineeRow(rw=null)
{
    console.log('delete-row clicked' + rw);
    if(rw) {
                $(this).parents("tr").remove();

//        $("#nomineeTbl #row"+rw).remove();   
       // calculateTotalAmount();
    }
}


function MemberList() {
    //console.log('invoicelistfet')
    var urlstr = base_url + 'fetchMemberData';
var url = urlstr.replace("undefined","");
var system_name = "<?php echo $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;?>" ;

        manageMemberTable = $("#manageMemberTable").DataTable({
            'ajax' : url, //base_url + 'invoice/fetchMemberData',
            'order' : [],

  /*columnDefs: [
    {
        targets: [7,8,9],
        className: 'dt-body-right'
    }
  ],

*/

  /*              $value['member_id'],
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
                $value['thrift_deposit'],
                //$pdfbtn,
                $button




"columns": [
            
            { "data": "member_id" },
            { "data": "member_name" },
            { "data": "mobile_no" },
            { "data": "dob" },
            { "data": "doj" },
            { "data": "division_name" },
            { "data": "designation" },
            { "data": "loan_outstanding" },
            { "data": "share_capital" },
            { "data": "thrift_deposit" },
            { "data": "action" }
        ],
*/
'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
      "width": "4%"
 },
 {
      "targets": [7,8,9],
      "className": "text-right"
 },
/*
 { "targets": -1, "data": null, "defaultContent": "<input id='btnDetails' class='btn btn-success' width='25px' value='Get Details' />"
        } 
*/
        ],      
        dom: 'Bfrtip',
       
        buttons: [
            'copy', 'csv', 'excel',{
            extend: 'pdf',


title: function() {
      return $('#monthYear').val();
    },

 title: system_name + '\n' + 'Member List',
  customize: function(doc) {
    doc.styles.title = {
      color: 'red',
      fontSize: '40',
      background: 'blue',
      alignment: 'center'

    }   


  },

                    
             
 exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                },   
          
            orientation: 'portrait',

            customize: function (doc) {
                  var rowCount = doc.content[1].table.body.length;
for (i = 1; i < rowCount; i++) {
//doc.content[1].table.body[i][5].alignment = 'right';
//doc.content[1].table.body[i][6].alignment = 'right';
doc.content[1].table.body[i][7].alignment = 'right';
doc.content[1].table.body[i][8].alignment = 'right';
doc.content[1].table.body[i][9].alignment = 'right';
};

      doc.pageMargins = [20,10,10,10];
        doc.defaultStyle.fontSize = 7;
        doc.styles.tableHeader.fontSize = 7;
        doc.styles.title.fontSize = 8; 
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();

      doc['footer']=(function(page, pages) {
            return {
                columns: [
                    'Members List',
                    {
                        // This is the right column
                        alignment: 'right',
                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                    }
                ],
                margin: [10, 0]
            }
        });

},


          }, {extend: 'print',

  

                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                },

            orientation: 'landscape',

      }

        ]



        }); 
}



    $("#createNewmem").unbind('submit').bind('submit', function() {
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');

        $.ajax({
            url: url,
            type: type,
            data: form.serialize(),
            dataType: 'json',
            success:function(response) {
                if(response.success == true) {                      
                        $("#add-mem-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#add-mem-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
$("#createNewmem").trigger("reset");

/*setTimeout(function(){// wait for 5 secs(2)
           location.reload(); // then reload the page.(3)
    }, 500); 

  */                    //  $("#addSalesInvoiceTable:not(:first)").remove();
                       // $('.form-group').removeClass('has-error').removeClass('has-success');
                       // $('.text-danger').remove();     
                        //addSalesInvoiceTable.ajax.reload(null,false);
                      //  manageInvoiceTable.ajax.reload(null, false);
                      //  getInvoiceno();
manageMemberTable.ajax.reload(null,false);
                      //  $("#createInvoiceForm")[0].reset();             
                      //  $(".appended-exp-row").remove();
                    }   
                    else {                                  
                        
                        $.each(response.messages, function(index, value) {
                            var key = $("#" + index);

                            key.closest('.form-group')
                            .removeClass('has-error')
                            .removeClass('has-success')
                            .addClass(value.length > 0 ? 'has-error' : 'has-success')
                            .find('.text-danger').remove();                         

                            key.after(value);
                        });
                                                

                    } // /else
            } // /.success
        }); // /.ajax funciton
        return false;
    });

function updateMembers(id = null) 
{
    if(id) {
    
invflag=1;
        //console.log(id);
var furl;
//var invNo = id ;
 // furl = "invoice/fetchInvoiceDataForUpdate/";
    var urlstr = base_url + 'fetchMemberUpdate';
var url = urlstr.replace("undefined","");
//console.log(url);
    $.ajax({
        url: url+'/'+id,
//        method:"POST",
 //       data:{ id: id },
        //dataType:"json",
        success:function (response) 
        {
          //  console.log(response);
            $("#show-edit-Member-result").html(response);
 var $outp = response;          
 //console.log($outp);

            $("#editmemNo").val(id);
            
                //$("#editTotalAmount").attr('disabled', true);
                /*SUBMIT FORM*/
                
                $("#editMemberForm").unbind('submit').bind('submit', function() {                  
                    var form = $(this);
                    var data = {'id' : id};
                //  console.log(data);
                    var data = form.serialize()+'&'+ $.param(data);
                    var url = form.attr('action');
                    var type = form.attr('method');
                //  console.log('url-'+ url+"/"+id);
                    var invNo= "&id=" + id ;
                    $.ajax({
                        url: url,
                        type: type,
                        data: data,
                        dataType: 'json',
                        success:function(response) {
                            //console.log(response);
                            if(response.success == true) {                      
                                $("#edit-Member-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');      
$("#edit-Member-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});             
                                
                                $('.form-group').removeClass('has-error').removeClass('has-success');
                                $('.text-danger').remove(); 
                               // $("#addSalesInvoiceTable:not(:first)").remove();                                
                                //createTypeahead($td.find('input.edititemSearch'));
                                //manageExpeneseTable.ajax.reload(null, false);
                                manageMemberTable.ajax.reload(null, false);
                                                                
                            }   
                            else {                                  
                            //  console.response;
                                $.each(response.messages, function(index, value) {
                                    var key = $("#" + index);

                                    key.closest('.form-group')
                                    .removeClass('has-error')
                                    .removeClass('has-success')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                    .find('.text-danger').remove();                         

                                    key.after(value);
                                });
                                                        
                            } // /else
                            
                        } // /.success
                    }); // /.ajax
                    return false;
                }); // /.submit edit expenses form
                
            } // /success
        }); // /.ajax
    } // /.if
} // /.update epxense function



function deleteMember(id) 
{
 //   console.log(id);

$('#delRec').on('click',function() {
   // var id = $this.val();
console.log('delete '+ id);
var deletememRec = id;
$('#deleteModal').modal('hide');
    var urlstr = base_url + 'deletememRec';
var url = urlstr.replace("undefined","");
//console.log(url);
    $.ajax({
        url: url+'/'+id,
        success:function (response) 
        {
manageMemberTable.ajax.reload(null, false);
                            //console.log(response);
                            if(response.success == true) {    
                            manageMemberTable.ajax.reload(null, false);                  
                                $("#delete-Member-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');

    $('#deleteModal').modal('hide');
                                      
$("#delete-Member-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});             
                                
                                $('.form-group').removeClass('has-error').removeClass('has-success');
                                $('.text-danger').remove(); 
                               // $("#addSalesInvoiceTable:not(:first)").remove();                                
                                //createTypeahead($td.find('input.edititemSearch'));
                                //manageExpeneseTable.ajax.reload(null, false);
                                
                                                                
                            }   
                            else {                                  
                            //  console.response;
                                $.each(response.messages, function(index, value) {
                                    var key = $("#" + index);

                                    key.closest('.form-group')
                                    .removeClass('has-error')
                                    .removeClass('has-success')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                    .find('.text-danger').remove();                         

                                    key.after(value);
                                });
                                                        
                            } // /else
                            
                        } // /.success
                    }); // /.ajax
                    return false;
                }); // /.submit edit expenses form
                
            } // /success


function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}


</script>

<style type="text/css">
    body {
        font-family: 'Varela Round', sans-serif;
    }
    .modal-confirm {        
        color: #636363;
        width: 400px;
    }
    .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
        text-align: center;
        font-size: 14px;
    }
    .modal-confirm .modal-header {
        border-bottom: none;   
        position: relative;
    }
    .modal-confirm h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -10px;
    }
    .modal-confirm .close {
        position: absolute;
        top: -5px;
        right: -2px;
    }
    .modal-confirm .modal-body {
        color: #999;
    }
    .modal-confirm .modal-footer {
        border: none;
        text-align: center;     
        border-radius: 5px;
        font-size: 13px;
        padding: 10px 15px 25px;
    }
    .modal-confirm .modal-footer a {
        color: #999;
    }       
    .modal-confirm .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 50%;
        z-index: 9;
        text-align: center;
        border: 3px solid #f15e5e;
    }
    .modal-confirm .icon-box i {
        color: #f15e5e;
        font-size: 46px;
        display: inline-block;
        margin-top: 13px;
    }
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
        background: #60c7c1;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        min-width: 120px;
        border: none;
        min-height: 40px;
        border-radius: 3px;
        margin: 0 5px;
        outline: none !important;
    }
    .modal-confirm .btn-info {
        background: #c1c1c1;
    }
    .modal-confirm .btn-info:hover, .modal-confirm .btn-info:focus {
        background: #a8a8a8;
    }
    .modal-confirm .btn-danger {
        background: #f15e5e;
    }
    .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
        background: #ee3535;
    }
    .trigger-btn {
        display: inline-block;
        margin: 100px auto;
    }


/*Profile Pic Start*/
.picture-container{
    position: relative;
    cursor: pointer;
    text-align: center;
}


.picture-oid{
    width: 156px;
    height: 156px;
    background-color: #999999;
    border: 4px solid #CCCCCC;
    color: #FFFFFF;
   /* border-radius: 80%;*/
    margin: 0px auto;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
}

.picture-oid:hover{
    border-color: #2ca8ff;
}
.content.ct-wizard-green .picture-oid:hover{
    border-color: #05ae0e;
}
.content.ct-wizard-blue .picture-oid:hover{
    border-color: #3472f7;
}
.content.ct-wizard-orange .picture-oid:hover{
    border-color: #ff9500;
}
.content.ct-wizard-red .picture-oid:hover{
    border-color: #ff3b30;
}

.picture-oid input[type="file"] {
    cursor: pointer;
    display: block;
    height: 100%;
    left: 0;
    opacity: 0 !important;
    position: absolute;
    top: 0;
    width: 100%;
}

.pictureoid-src{
    width: 100%;
    
}



.picture-id{
    width: 156px;
    height: 156px;
    background-color: #999999;
    border: 4px solid #CCCCCC;
    color: #FFFFFF;
   /* border-radius: 80%;*/
    margin: 0px auto;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
}

.picture-id:hover{
    border-color: #2ca8ff;
}
.content.ct-wizard-green .picture-id:hover{
    border-color: #05ae0e;
}
.content.ct-wizard-blue .picture-id:hover{
    border-color: #3472f7;
}
.content.ct-wizard-orange .picture-id:hover{
    border-color: #ff9500;
}
.content.ct-wizard-red .picture-id:hover{
    border-color: #ff3b30;
}

.picture-id input[type="file"] {
    cursor: pointer;
    display: block;
    height: 100%;
    left: 0;
    opacity: 0 !important;
    position: absolute;
    top: 0;
    width: 100%;
}

.pictureid-src{
    width: 100%;
    
}


.picture{
    width: 106px;
    height: 106px;
    background-color: #999999;
    border: 4px solid #CCCCCC;
    color: #FFFFFF;
    border-radius: 50%;
    margin: 0px auto;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
}

.picture:hover{
    border-color: #2ca8ff;
}
.content.ct-wizard-green .picture:hover{
    border-color: #05ae0e;
}
.content.ct-wizard-blue .picture:hover{
    border-color: #3472f7;
}
.content.ct-wizard-orange .picture:hover{
    border-color: #ff9500;
}
.content.ct-wizard-red .picture:hover{
    border-color: #ff3b30;
}
.picture input[type="file"] {
    cursor: pointer;
    display: block;
    height: 100%;
    left: 0;
    opacity: 0 !important;
    position: absolute;
    top: 0;
    width: 100%;
}

.picture-src{
    width: 100%;
    
}
/*Profile Pic End*/


.my-custom-scrollbar {
position: relative;
height: 200px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}

</style>
