
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> All Office Note
				
				
				 <?php if ($this->session->userdata('role') == 'admin'): ?>
                    <a href="" class="btn btn-info btn-sm pull-right"  data-toggle="modal" data-target="#modalAddOffnote"><i class="fa fa-plus"></i>&nbsp;New Office Note</a> &nbsp;

                    <a href="<?php echo base_url('admin/user/power') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp;User Power</a>
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


							<table id="example23" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Officenote #</th>
                                    <th>Loan App#</th>
                                    <th>Date</th>
                                    <th>Member Name</th>
                                    <th>Surety Name</th>
                                    <th>Loan Sanctioned</th>
                                    <th>Rate of Interest</th>
                                    <th class="none">Res. Number</th>
                                    <th class="none">Res. Date</th>
                                    <th class="none">Amount Adjusted</th>
                                    <th class="none">Chq. Issued to</th>
                                    <th class="none">Chq. Number</th>
                                    <th class="none">Chq. Date</th>
                                    <th>Chq. Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Officenote #</th>
                                    <th>Loan App#</th>
                                    <th>Date</th>
                                    <th>Member Name</th>
                                    <th>Surety Name</th>
                                    <th>Loan Sanctioned</th>
                                    <th>Rate of Interest</th>
                                    <th>Res. Number</th>
                                    <th>Res. Date</th>
                                    <th>Amount Adjusted</th>
                                    <th>Chq. Issued to</th>
                                    <th>Chq. Number</th>
                                    <th>Chq. Date</th>
                                    <th>Chq. Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            
                            <tbody>
                            <?php foreach ($officenotes as $officenote): ?>
                                
                                <tr>

                                    <td><?php echo $officenote['officenote_id']; ?></td>
                                    <td><?php echo $officenote['loan_appno']; ?></td>
                                    <td><?php echo $officenote['onote_date']; ?></td>
                                    <td><?php echo $officenote['member_name']; ?></td>
                                    <td><?php echo $officenote['sur_member_name']; ?></td>
                                    <td><?php echo $officenote['loan_sanctioned']; ?></td>
                                    <td><?php echo $officenote['roi_pc']; ?></td>
                                    <td><?php echo $officenote['res_number']; ?></td>
                                    <td><?php echo $officenote['res_date']; ?></td>
                                    <td><?php echo $officenote['amount_adjusted']; ?></td>
                                    <td><?php echo $officenote['chq_issued']; ?></td>
                                    <td><?php echo $officenote['chq_no']; ?></td>
                                    <td><?php echo $officenote['chq_date']; ?></td>
                                    <td><?php echo $officenote['chq_amt']; ?></td>
                                    

                                    <td>
                                        <?php if ($officenote['status'] == 0): ?>
                                            <div class="label label-table label-danger">Pending</div>
                                        <?php else: ?>
                                            <div class="label label-table label-success">Approved</div>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-nowrap">

                                        <?php if ($this->session->userdata('role') == 'admin'): ?>
										
										<a href="<?php echo base_url('admin/officenote/update/'.$officenote['id']) ?>"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button></a>
																				
											<a href="<?php echo base_url('admin/officenote/delete/'.$officenote['id']) ?>" onClick="return doconfirm();" data-toggle="tooltip" data-original-title="Delete"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>


                                        <?php else: ?>

                                            <!-- check logged user role permissions -->

                                            <?php if(check_power(2)):?>

<a href="<?php echo base_url('admin/officenote/update/'.$officenote['id']) ?>"><button type="button" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></button></a>

                                            <?php endif; ?>
											
                                            <?php if(check_power(3)):?>
											
												
<a href="<?php echo base_url('admin/officenote/delete/'.$officenote['id']) ?>" onClick="return doconfirm();" data-toggle="tooltip" data-original-title="Delete"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>

                                            <?php endif; ?>

                                        <?php endif ?>

                                        
                                        
                                        <?php if ($officenote['status'] == 1): ?>
																					
<a href="<?php echo base_url('admin/officenote/deactive/'.$officenote['id']) ?>" data-toggle="tooltip" data-original-title="Deactive"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
											
											
                                        <?php else: ?>

<a href="<?php echo base_url('admin/officenote/active/'.$officenote['id']) ?>" data-toggle="tooltip" data-original-title="Activate"><button type="button" class="btn btn-success btn-circle btn-xs"><i class="fa fa-check"></i></button></a>
                                        <?php endif ?>
                                        
                                    </td>
                                </tr>

                            <?php endforeach ?>

                            </tbody>


                        </table>
                    </div>
					
					
            </div>
        </div>
    </div>

 </div>

    <!-- End Page Content -->



  <!-- Modal -->
  
<div id="modalAddOffnote" class="modal fade" role="dialog">
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
                            <div class="panel-heading"><i class="fa fa-document"></i> Office Note</div>
                            

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    
                                        <div class="form-body">
                                            <h3 class="box-title">Officenote Details</h3>


                                         </div>      

                                          




<div class="row">
<div class="col-md-8">
<div class="row">    
<div class="col-md-4">

                                 <div class="form-group">
                                    <label for="example-text">Off. Note #
                                    </label>
                                        <input type="text"  value="<?php echo $officenote_id;  ?>" id="officenote_id" name="officenote_id" class="form-control" autocomplete="off"  readonly>
                                </div>


</div>

<div class="col-md-4">
        
                                    <div class="form-group">
                                    <label >Off. Note Date
                                    </label>
                                    
                                        <input type="date" id="officenote_date" name="officenote_date" autocomplete="off"  class="form-control mydatepicker">
                                </div>

</div>
<div class="col-md-4">
                                <div class="form-group">
                              <label >Loan App #</label>
                                    
                                    <select id="loanappn_id" name="loanappn_id"  class="form-control"></select>
                                </div>
</div>
</div>



<div class="col-md-12">
<div class="col-md-3">

  <div class="form-group">
                                    <label >Member #
                                    </label>
                                    <select id="bmember_id" name="bmember_id"  class="form-control"></select>

                                </div>
  
  


</div>

<div class="col-md-3">
        
   <div class="form-group">
                                    <label >Surety Member #
                                    </label>
                                    <select id="smember_id" name="smember_id"  class="form-control"></select>
                                </div>

</div>
<div class="col-md-3">
     <div class="form-group">
                                    <label >Resolution No
                                    </label>
                                        <input type="text" id="resolution_number" name="resolution_number" autocomplete="off"  class="form-control " placeholder="Resolution Number">
                                </div>
</div>
    

<div class="col-md-3">
     <div class="form-group">
                                    <label >Resolution Date
                                    </label>
                                        <input type="date" id="resolution_date" name="resolution_date" autocomplete="off"  class="form-control ">
                                </div>
</div>






</div>




<div class="col-md-12">

<div class="col-md-3">

  <div class="form-group">
                                    <label >Bank Account 
                                    </label>  <select id="cash_bank" name="cash_bank"  class="form-control"></select>
                               
                                </div>
  
  
  
  


</div>
<div class="col-md-3">
        
   <div class="form-group">
                                    <label >Cheque issued to
                                    </label>
                                        <input type="text" id="cheque_name" name="cheque_name" autocomplete="off"  class="form-control" placeholder="Cheque in the name of">
                                </div>

</div>

<div class="col-md-3">

  <div class="form-group">
                                    <label >Cheque Number 
                                    </label>
                                        <input type="text" id="cheque_number" name="cheque_number" autocomplete="off"  class="form-control " placeholder="Cheque details">
                                </div>
  
  
  
  


</div>
<div class="col-md-3">

  <div class="form-group">
                                    <label >Cheque Date
                                    </label>
                                        <input type="date" id="cheque_date" name="cheque_date" autocomplete="off"  class="form-control " >
                                </div>
  
  
  
  


</div>




</div>

<div class="col-md-12">

<div class="col-md-3">
    <label >Appl. Status</label>
  <select class="form-control" id="ofstatus" name="ofstatus">
<option value="0">PENDING</option>
<option value="1">APPROVED</option>
<option value="2">REJECTED</option>
</select>
</div>
    <div class="col-md-9">
   <div class="form-group">
      <label >Rupees in words</label>
      <input type="text" id="rupees_words" name="rupees_words" autocomplete="off"  class="form-control" placeholder="Rupees in words">
    </div>

</div>







</div>


<div class="col-md-12">
                        <button type="submit" class="btn btn-info btn-rounded btn-sm waves-effect waves-light m-r-10">Submit</button>
                    <button type="button" id="btn_reset" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">Cancel</button>
                            

</div>


</div>


<div class="col-md-4">
                                      <table id="tblOfficenote">
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
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
</div>
</form>
     </div> 
     </div>
     </div>
     </div>
     </div>


</div>
</div>
</div>





<!-- Edit Modal-->

<div id="edit-offnote-modal" class="fade modal" role="dialog">

    <div class="modal-dialog modal-lg ">
    <div class="modal-content" >
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Payment</h4>
      </div>
      

        <div id="edit-Payment-message"></div>
        <form action="Paymentupdate" method="post" class="form-horizontal" id="editPaymentForm">
      <div class="modal-body">
        <div id="show-edit-Payment-result"></div>
    </div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
      <!-- /modal-body -->
    <div class="modal-footer">
        <button type="submit" id="update_btn" class="btn btn-success" >Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
 </form>
    </div>
  </div>
</div>
 












<style type="text/css">
input[type="text"], textarea {

  background-color : #56fcf4; 

}

select {
    width: 20em; /*what ever width you want*/
}

.ui-datepicker, .mydatepicker {
width: 15em; /*what ever width you want*/
}


#officenote_id
{
    width: 15em;
}

</style>











<script type="text/javascript">

    $(document).ready(function(){
    var urlstr = base_url + 'fetchBankCashAccounts';
var url = urlstr.replace("undefined","");

    $("#cash_bank").load(url);


  $('#cash_bank').change(function(event) {
        $('#itemName').val($('#cash_bank option:selected').text());
    });

var urlstr = base_url + 'fetchlnappid';
var url = urlstr.replace("undefined","");

$("#loanappn_id").load(url );
$("#loanappn_id").select2();



var urlstr = base_url + 'fetchMemberlist';
var url = urlstr.replace("undefined","");

$("#bmember_id").load(url );
$("#bmember_id").select2();

$("#bmember_name").load(url );
$("#bmember_name").select2();

$("#smember_id").load(url );
$("#smember_id").select2();

$("#smember_name").load(url );
$("#smember_name").select2();


$("#bmember_id").on('change',function(){
$('#bmember_name').val($('#bmember_id option:selected').text());

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

//$('#duetoamount'+2).val(0);
//$('#duetoamount'+3).val(0);
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

$("#createOfficenoteForm").trigger("reset");                 

setInterval('location.reload()', 2000);
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

  $("#OfficenoteTbl tbody tr").remove();
invflag=1;
    //console.log(id);
var furl;
//var invNo = id ;

var urlstr = base_url + 'updatesubAccount';
var url = urlstr.replace("undefined","");

//console.log('newInvno:'+invNo);
    $.ajax({
      url: url, //data: {"invNo": invNo}, //'invoice/fetchInvoiceDataForUpdate/'+invNo,
     // type: 'post',     
      success:function(response) {
//console.log(response);
      $("#subItems").html(response);

}

}); // .change in section




$('.duetoamt').keyup(function(){
 
    var amt = $(this).val();
 //  console.log(amt);
    duetoamtCalc();

});

$('.amtsanc').keyup(function(){
 
    var bamt = $(this).val();
  // console.log(bamt);
    duetoamtCalc();

});



var urlstr = base_url + 'fetchStatus';
var url = urlstr.replace("undefined","");
//console.log(url);
 $("#status").load(url);




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

</script>




