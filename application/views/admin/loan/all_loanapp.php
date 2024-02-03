<!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Loan Application</h3>


<div class="pull-right">
  <div class="col-md-4">
        <div class="form-group">
          
          <div class="input-group input-group-lg">
            <label class="control-label">From</label>
            <input type="text" data-inputmask="'alias': 'date'" class="form-control" id="fmDate" name="fmDate" autocomplete="off" placeholder="dd-mm-yyyy" required>
            <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-calendar" id="fdtp"></i></span>
              </div>
          </div>
        </div>
</div>
<div class="col-md-4">
        <div class="form-group">
          
          <div class="input-group input-group-lg">
            <label class="control-label">To</label>
            <input type="text" data-inputmask="'alias': 'date'" class="form-control" id="toDate" name="toDate" autocomplete="off" placeholder="dd-mm-yyyy" required>
            <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-calendar" id="tdtp"></i></span>
              </div>
          </div>
        </div>
</div>
                            
                            
                            
                     <button id="search" type="submit" class="btn btn-primary btn-rounded">Search</button>
                            </div>
    <hr>
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> All Loan Applications
        
        
         <?php if ($this->session->userdata('role') == 'admin'): ?>
              <!--  data-toggle="modal" data-target="#modalAddPayment"-->   
                    <a href="" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#modalAddLoanAppn"><i class="fa fa-plus"></i>&nbsp;New Loan Appln</a> &nbsp;
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

                            <div class="table-responsive">
                                <table id="lapplnTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                    <th>Action</th>
                                    <th>Application #</th>
                                    <th>Member Id</th>
                                    <th>Member Name</th>
                                    <th>Father/Husband Name</th>
                                    <th>Loan Amount</th>
                                    <th>Purpose of Loan</th>
                                    <th>Principle</th>
                                    <th>Payslip</th>
                                </tr>
                            </thead>
                                          
                                        </tr>
                                    </thead>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

                <!-- /.row -->



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

<!-- Button trigger modal -->

<!-- Modal -->
<div
  class="modal fade"
  id="modalEditLoanAppn"
  tabindex="-1"
  aria-labelledby="editOfficeNoteModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h5 class="modal-title" id="editOfficeNoteModalLabel">Office Note Edit</h5>
             </div>

             <form action="updateOfficenote" method="post" class="form-horizontal" id="updateOfficenoteForm">
             <div id="upd-officenote-message"></div>
             
             <div class="modal-body">
            
<div id="show-result">   </div>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-success">Update changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Add -->

<div id="modalAddLoanAppn" class="modal fade " role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Office Note</h4>
      </div>
      <div id="add-offnote-message"></div>


<form action="createOfficenote" method="post" class="form-horizontal" id="createOfficenoteForm">

      <div class="modal-body">

                          
    


                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    
                                      



<div class="col-md-12">

<div class="col-md-3">
                           <div class="form-group">
                                    <label for="example-text">Off. Note #
                                    </label>
                                        <input type="text"  value="<?php echo $officenote_id;  ?>" id="officenote_id" name="officenote_id" class="form-control" autocomplete="off"  readonly>
                                </div>

</div>

<div class="col-md-3">

                                    <div class="form-group">
                                    <label >Off. Note Date
                                    </label>
                                    
                                        <input type="date" id="officenote_date" name="officenote_date" autocomplete="off"  class="form-control mydatepicker">
                                </div>

</div>

<div class="col-md-3">
      <div class="form-group">
                              <label >Loan App #</label><br>
                                    
                                    <select id="loanappn_id" name="loanappn_id" style="width:100%;"  class="form-control"></select>
                                </div>
</div>


<div class="col-md-3">
    <label >Appl. Status</label>
  <select class="form-control" id="ofstatus" name="ofstatus">
<option value="0">PENDING</option>
<option value="1">APPROVED</option>
<option value="2">REJECTED</option>
</select>

</div>

</div>

<div class="col-md-6">

<div class="row">
<div class="col-md-6">

  <div class="form-group">
                                    <label >Member #
                                    </label>
                                    <select id="bmember_id" name="bmember_id" style="width:100%" class="form-control"></select>

                                </div>
  
  


</div>

<div class="col-md-6">
        
   <div class="form-group">
                                    <label >Surety Member #
                                    </label>
                                    <select style="width:100%"  id="smember_id" name="smember_id"  class="form-control"></select>
                                </div>

</div>
</div>
<div class="row">
<div class="col-md-6">
     <div class="form-group">
                                    <label >Resolution No
                                    </label>
                                        <input type="text" style="width:100%"  id="resolution_number" name="resolution_number" autocomplete="off"  class="form-control " placeholder="Resolution Number">
                                </div>
</div>
    

<div class="col-md-6">
     <div class="form-group">
                                    <label >Resolution Date
                                    </label>
                                        <input type="date" id="resolution_date" name="resolution_date" autocomplete="off"  class="form-control ">
                                </div>
</div>
</div>
<div class="row">
<div class="col-md-6">

  <div class="form-group">
                                    <label >Bank Account 
                                    </label>  <select id="cash_bank" name="cash_bank"  style="width:100%"  class="form-control"></select>
                               
                                </div>
  
  
</div>


<div class="col-md-6">
        
   <div class="form-group">
                                    <label >Cheque issued to
                                    </label>
                                        <input  style="width:100%" type="text" id="cheque_name" name="cheque_name" autocomplete="off"  class="form-control" placeholder="Cheque in the name of">
                                </div>

</div>
</div>
<div class="row">
<div class="col-md-6">

  <div class="form-group">
                                    <label >Cheque Number 
                                    </label>
                                        <input  style="width:100%" type="text" id="cheque_number" name="cheque_number" autocomplete="off"  class="form-control " placeholder="Cheque details">
                                </div>
  
  
  
  


</div>
<div class="col-md-6">

  <div class="form-group">
                                    <label >Cheque Date
                                    </label>
                                        <input type="date" id="cheque_date" name="cheque_date" autocomplete="off"  class="form-control " >
                                </div>
  
  
  
  


</div>
</div>

<div class="col-md-12">
   <div class="form-group">
      <label >Rupees in words</label>
      <input type="text" id="rupees_words" readonly  style="width:100%" name="rupees_words" autocomplete="off"  class="form-control" placeholder="Rupees in words">
    </div>

</div>


</div>







<div class="col-md-6">
    <div class="col-md-12">

                            <table id="tblOfficenote" class="table-striped">
                                  <th>Due to Details</th>
                                  <th style="text-align: right;">Amount</th>
                                  <tbody>
                                 <?php $x=0; foreach ($duetoacc as $key=> $svalue)

                                  {  ?>
                                    <input type="text" id="duetoid<?php echo $x ?>" value="<?php echo $svalue['id'] ?>" name="duetoid[<?php echo $x ?>]" hidden>
                                    <input type="text" id="duetoaccid<?php echo $x ?>" value="<?php echo $svalue['acclink_id'] ?>" name="duetoaccid[<?php echo $x ?>]" hidden>
                                   
                                    <input type="text" id="duetoaccount<?php echo $x ?>" value="<?php echo $svalue['duetoaccount'] ?>" name="duetoaccount[<?php echo $key ?>]" hidden>
                                  <tr><td style="background: blue; color: white; "><b><?php echo $svalue['duetoaccount'] ?></b> 
                                    
                                    </td>  <td>
                                    <input type="text" id="duetoamount<?php echo $x ?>" name="duetoamount[<?php echo $x ?>]"  value="0.00" placeholder="0.00" style="text-align: right;" class="form-control duetoamt" autocomplete="off">
                                    </td>
                                  </tr>
<?php 

       // $data['subacclist'] = $srow['item_name'];
       $x++; } ?>
                                        



                                  </tbody>
<footer>
  <tr>

   
                                    <td style="background: red; color: white;"><b>Total Due To</b>
                                    </td>
                                        <td><input type="text" id="tot_due" name="tot_due" autocomplete="off"  class="form-control typeahead" placeholder="0.00" style="text-align: right;" disabled>
                                </td>
  



</tr>

<tr>
<td  style="background: green; color: white;"><b>Amount Sanctioned</b>
</td>
<td><input type="text" id="amt_sanctioned" name="amt_sanctioned" autocomplete="off"  class="form-control amtsanc" placeholder="0.00" style="text-align: right;">
</td>
</tr>

<tr>
<td  style="background: green; color: white;"><b>Rate of Interest</b>
</td>
<td><input type="text" id="roi_pc" name="roi_pc" autocomplete="off" required  class="form-control amtsanc" placeholder="%" style="text-align: right;">
</td>
</tr>

<tr>
<td  style="background: red; color: white;"><b>Amount Due Adjusted</b></td>
<td><input type="text" id="amt_tobe_adju" name="amt_tobe_adju" autocomplete="off"  class="form-control" placeholder="0.00" style="text-align: right;" disabled></td>
</tr>

<tr>  
<td  style="background: black; color: white;"><b>Balance</b></td>
<td><input type="text" id="bal_amt" name="bal_amt" autocomplete="off"  class="form-control balamt" placeholder="0.00" style="text-align: right;" disabled></td>

</tr>


</footer>

</table>

</div>
    </div>


</div>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
</div>

    <div class="modal-footer">
        <button type="submit" id="save_btn" class="btn btn-success" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

</form>
     </div> 
     </div>
     </div>





<style>
     .modal-body{overflow-y: inherit;}

.ui-autocomplete {
z-index: 100;
}
input[type="text"], textarea {

  background-color : #56fcf4; 
  width: 10em;

}
.modal-dialog {
          width: 1460px;
          height:600px !important;
        }
.modal-content {
    /* 80% of window height */
    height: 60%;
    background-color:#BBD6EC;
}        
.modal-header {
    background-color: #337AB7;
    padding:16px 16px;
    color:#FFF;
    border-bottom:2px dashed #337AB7;
 }

</style>


<script type="text/javascript">
var managelapplnTable;       


window.base_url = <?php echo json_encode(base_url('admin/officenote/')); ?>;
var system_name = "<?php echo $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;?>" ;


    $(document).ready(function(){
    var urlstr = base_url + 'fetchBankCashAccounts';
var url = urlstr.replace("undefined","");

    $("#cash_bank").load(url);


  $('#cash_bank').change(function(event) {
        $('#itemName').val($('#cash_bank option:selected').text());
    });

var urlstr = base_url + 'fetchlnappid';
var url = urlstr.replace("undefined","");

$("#loanappn_id").load(url);
$("#loanappn_id").select2();
$("#editloanappn_id").select2();



var urlstr = base_url + 'fetchMemberlist';
var url = urlstr.replace("undefined","");

$("#bmember_id").load(url);
$("#bmember_id").select2();
$("#editbmember_id").select2();

$("#bmember_name").load(url);
$("#bmember_name").select2();

$("#smember_id").load(url);
$("#smember_id").select2();
$("#show-result").find("#editsmember_id").select2();

$("#smember_name").load(url);
$("#smember_name").select2();


$("#bmember_id").on('change',function(){
$('#bmember_name').val($('#bmember_id option:selected').text());

});


$(document).on('change', '#editbmember_id', function() {
  // Does some stuff and logs the event to the console
console.log('change memid');
});


$("#editbmember_id").select2({
    dropdownParent: $("#editOfficeNoteModal")
  });

$('#editOfficeNoteModal').on('show.bs.modal', function () {
    $("#show-result").find("#editsmember_id").select2();
    $("#show-result").find("#loanappn_id").select2();

    $("#show-result").find("#editsmember_id").select2();
    $("#editbmember_id").trigger('change.select2');
$("#editsmember_id").trigger('change.select2');
$("#editloanappn_id").trigger('change.select2');

var urlstr = base_url + 'fetchlnappid';
var url = urlstr.replace("undefined","");

$("#show-result").find("#loanappn_id").load(url);
$("#show-result").find("#loanappn_id").select2();

    console.log('opened edit modal');
  // do something…
});

$(document).on('keyup','.duetoamt',function(){
    console.log('cacl');
    duetoamtCalc();

});


$(document).on('change', '#editloanappn_id', function() {

//$('#editloanappn_id').on('change',function(){
var nt_id = $("#editloanappn_id").val();



  urlstr = base_url + 'get_ondetails';
 url = urlstr.replace("undefined","");

 $.ajax({
        url: url+'?noteid=' + nt_id, //+ 'fetchReceiptSearch',
        dataType: 'json',
        type: 'get',
        cache:false,
        success: function(data){
        var event_data = '';
console.log(data);
  $.each(data, function(index) {
    console.log(data[0].loan_out);
$('#duetoamount'+0).val(data[0].loan_out);

$('#amt_sanctioned').val(data[0].loan_amt);
$('#roi_pc').val(data[0].roi);
$("#cheque_name").val(data[0].memname);
$("#bmember_id").val(data[0].memid).trigger('change.select2');
$("#smember_id").val(data[0].suretyid).trigger('change.select2');

});
duetoamtCalc();


}

});
});


$(document).on('change', '#editsmember_id', function() {
  // Does some stuff and logs the event to the console
console.log('change smemid');


});

$('#search').on('click',function() {

    console.log('Search Clicked');
urlstr = base_url + 'get_lappnData';
url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();
//  date("d-m-Y", strtotime($originalDate));
//console.log('fmDate ' + fmDate + ' toDate ' + toDate);
managelapplnTable = $("#lapplnTable").dataTable().fnDestroy();
 managelapplnTable =  $('#lapplnTable').DataTable( 
  {


    "ajax"    : url+'?fdate=' + fmDate + '&tdate=' + toDate, //+ 'fetchPaymentSearch',
   
"columns": [ { "data": "action" },
            { "data": "app_number" },
            { "data": "member_id" },
            { "data": "member_name" },
            { "data": "member_fname" },
            { "data": "loan_amount" },
            { "data": "loan_purpose" },
            { "data": "installment_amount" },
            { "data": "net_amt" }
           
        ],

'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
      "width": "4%"
 },
 {
      "targets": 4,
      "className": "text-right"
 },

 ],

        dom: 'Bfrtip',
       
        buttons: [
            'copy', 'csv', 'excel',{
            extend: 'pdf',


title: function() {
      return $('#monthYear').val();
    },

 title: system_name + '\n' + 'Payments Report for the period from '+ $('#fmDate').val() + ' to '+ $('#toDate').val(),
  customize: function(doc) {
    doc.styles.title = {
      color: 'red',
      fontSize: '40',
      background: 'blue',
      alignment: 'center'

    }   


  },

               exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                },   
          
            orientation: 'portrait', // 'landscape',


            customize: function (doc) {
                  var rowCount = doc.content[1].table.body.length;
/*for (i = 1; i < rowCount; i++) {
//doc.content[1].table.body[i][5].alignment = 'right';
//doc.content[1].table.body[i][6].alignment = 'right';
doc.content[1].table.body[i][5].alignment = 'right';
doc.content[1].table.body[i][6].alignment = 'right';
doc.content[1].table.body[i][7].alignment = 'right';
doc.content[1].table.body[i][8].alignment = 'right';
doc.content[1].table.body[i][9].alignment = 'right';
};
*/

      doc.pageMargins = [20,10,10,10];
        doc.defaultStyle.fontSize = 7;
        doc.styles.tableHeader.fontSize = 8;
        doc.styles.title.fontSize = 10; 
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();

      doc['footer']=(function(page, pages) {
            return {
                columns: [
                    'Payments Report for the period from '+ $('#fmDate').val() + ' to '+ $('#toDate').val(),
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
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                },
      }

        ]




}); 
    
   


});





$('#loanappn_id').on('change',function(){
var nt_id = $("#loanappn_id").val();



  urlstr = base_url + 'get_ondetails';
 url = urlstr.replace("undefined","");

 $.ajax({
        url: url+'?noteid=' + nt_id, //+ 'fetchReceiptSearch',
        dataType: 'json',
        type: 'get',
        cache:false,
        success: function(data){
        var event_data = '';
console.log(data);
  $.each(data, function(index) {
    console.log(data[0].loan_out);
$('#duetoamount'+0).val(data[0].loan_out);

$('#amt_sanctioned').val(data[0].loan_amt);
$('#roi_pc').val(data[0].roi);
$("#cheque_name").val(data[0].memname);
$("#bmember_id").val(data[0].memid).trigger('change.select2');
$("#smember_id").val(data[0].suretyid).trigger('change.select2');

});
duetoamtCalc();


}

});
});




$("#updateOfficenoteForm").unbind('submit').bind('submit', function() {
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
                        $("#upd-officenote-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');

  
$("#upd-officenote-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
managelapplnTable.ajax.reload(null, false);
//$("#updateOfficenoteForm").trigger("reset");                 

//setInterval('location.reload()', 2000);
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



    $("#createOfficenoteForm").unbind('submit').bind('submit', function() {
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
                        $("#add-jv-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


                        
$("#add-jv-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
managelapplnTable.ajax.reload(null, false);
$("#createOfficenoteForm").trigger("reset");                 

//setInterval('location.reload()', 2000);
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

//  $("#OfficenoteTbl tbody tr").remove();
invflag=1;
    //console.log(id);
var furl;
//var invNo = id ;

var urlstr = base_url + 'updatesubAccount';
var url = urlstr.replace("undefined","");

    $.ajax({
      url: url, //data: {"invNo": invNo}, //'invoice/fetchInvoiceDataForUpdate/'+invNo,
     // type: 'post',     
      success:function(response) {
      $("#subItems").html(response);

}

}); 




$('.duetoamt').keyup(function(){
 
    var amt = $(this).val();
    duetoamtCalc();

});

$('.amtsanc').keyup(function(){
 
    var bamt = $(this).val();
    duetoamtCalc();

});



var urlstr = base_url + 'fetchStatus';
var url = urlstr.replace("undefined","");
 $("#status").load(url);


 $('#fmDate').mask('00/00/0000');

 $('#toDate').mask('00/00/0000');

});

$(function () {
   $('#modal').modal('toggle');
});


function duetoamtCalc() {
   
    var duetoamt_sum = 0;
    var net_pay=0;
    $('.duetoamt').each(function() {
        duetoamt_sum+= Number($(this).val());
    });
    
    var sanc_amt = $("#amt_sanctioned").val();

    $("#tot_due").val(Number(duetoamt_sum));

    $("#amt_tobe_adju").val(Number(duetoamt_sum));

    var bal_amt = Number(sanc_amt-duetoamt_sum);
     

    $("#bal_amt").val(bal_amt);
    var Inwords = convertNumberToWords(Math.abs(bal_amt));
    $("#rupees_words").val(Inwords);


}


function updateAppln(id)
{
    console.log(id);

  urlstr = base_url + 'get_applnDatabyid';
 url = urlstr.replace("undefined","");



 $.ajax({
        url: url+'?appid=' + id, //+ 'fetchReceiptSearch',
      //  dataType: 'json',
        type: 'get',
        cache:false,
        success: function(data){
        //var event_data = '';
//console.log("data "+data);
$("#show-result").html(data);
duetoamtCalc();

/*
$.each(data, function(index) {
    console.log(data[0].loan_out);



$('#duetoamount'+0).val(data[0].loan_out);

$('#amt_sanctioned').val(data[0].loan_amt);
$('#roi_pc').val(data[0].roi);
$("#cheque_name").val(data[0].memname);
$("#bmember_id").val(data[0].memid).trigger('change.select2');
$("#smember_id").val(data[0].suretyid).trigger('change.select2');

});
*/
duetoamtCalc();


}

});



}


</script>


