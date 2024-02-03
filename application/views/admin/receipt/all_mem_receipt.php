
<?php 
$system_name = $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('soc_settings', array('type' => 'system_title'))->row()->description;
?>

<!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                <div id="delete-receipt-message"  style="color: white;font-weight: bold;"></div>

           <div class="panel panel-info">

                <div class="panel-heading"> <i class="fa fa-list"></i> Member's Direct Receipts
                
                 <?php if ($this->session->userdata('role') == 'admin'): ?>
                 
                    <a href="<?php echo base_url('admin/receipt/mem_receipt');?>" id="addRcpt" class="btn btn-info btn-sm pull-right"  ><i class="fa fa-plus"></i>&nbsp;New Receipt</a> &nbsp;
                <?php else: ?>
                    <!-- check logged user role permissions -->

                    <?php if(check_power(1)):?>
                        <a href="<?php echo base_url('admin/userhome') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp;New User</a>
                    <?php endif; ?>
                <?php endif ?>
                
                </div>

                        <div class="white-box">
                            <h3 class="box-title m-b-0">Members Direct Receipts Report</h3>


                            <div class="pull-right">
                                <label>DIVISION</label>
                                <select id="divisionlist"  class="custom-select col-6 form-control"></select>
                                <label>Select a Month</label>  
                            <input id="monthYear" name="monthYear">
                            <button id="search_btn" type="button" class="btn btn-primary btn-rounded">Search</button>
                            </div>
                            
                            <hr>
                            <div class="table-responsive">
                                <table id="manageReceiptTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>DIVISION</th>
                                            <th>RCTP DATE</th>
                                            <th>DEBIT ACCOUNT </th>
                                            <th>CREDIT ACCOUNT</th>
                                            <th>AMOUNT</th>
                                            <th>FIN.YEAR</th>
                                            <th style="width: 120px;">ACTION</th>
                                            
                                        </tr>
                                    </thead>
                                    </tbody>
                                </table>
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




<!-- Modal -->

<!-- Modal -->
<div id="modalAddReceipt" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Client Receipt</h4>
      </div>
      <div id="add-receipt-message" style="color: white;font-weight: bold;"></div>

      <form action="createDemand" method="post" id="createNewReceipt">
      <div class="modal-body">

<div class="row">
<div class="input-group" style="text-align:center;background: grey;color: white;">
    <div class="col-md-3"><label> Month</label></div>
    <div class="col-md-3"><label>Date</label></div>
    <div class="col-md-3"><label>Bank/Cash</label></div>
    <div class="col-md-3"><label>Amount</label></div>
</div>    
</div>

<div class="row">
<div class="input-group">
 <input id="month_Year" placeholder="Select a Month" class="month_Year" name="month_Year" required>
  <input id="rcpt_date" name="rcpt_date"  type="date" class="rcpt_date form-control">
  <select id="cash_bank" name="cash_bank" class="form-control custom-select cash_bank"></select>
  <input placeholder="Amount"  id="rcpt_amount" name="rcpt_amount"  style="text-align:right;"  type="text" class="rcpt_amount form-control">
        
<?php  
$csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
        );
?>


</div>

</div>
<div class="row">
<div class="input-group" style="text-align:center;background: grey;color: white;">
    <div class="col-md-3"><label>Division</label></div>
    <div class="col-md-3"><label>Receipt Ref#</label></div>
    <div class="col-md-3"><label>Bank/Cash</label></div>
    <div class="col-md-3"><label>Members</label></div>
    <div class="col-md-3"><label>Narration</label></div>
</div>    
</div>

<div class="row">
<div class="input-group">

 <select id="division_list" class="form-control division_list" style="width:200px;"></select>
  <input placeholder="Receipt Ref"  id="rcpt_ref" name="rcpt_ref"  type="text" class="rcpt_ref form-control">

  <input placeholder="Bank/Cash Reference"  id="bank_ref" name="bank_ref"  type="text" class="bank_ref form-control">

  <input placeholder="Narration"  id="rcpt_narration" name="rcpt_narration"  type="text" class="rcpt_narration form-control">

        
<?php  
$csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
        );
?>


</div>

</div>



    <div class="card">

    <div class="resposive" style="height: 305px; overflow:auto">
        <div id="dmdTbl"  style="height: 90%; overflow:auto">

<input type="text" hidden id="mon_yr" name="mon_yr">
<input type="text" hidden id="div_id" name="div_id">

<table id="crcpt_tbl" style="white-space:nowrap;">
    <thead><th>#</th><th>Member#</th><th>Member Name</th><th>Thrift</th><th>Loan</th><th>Interest</th><th>Insurance</th><th>Others</th><th>Total</th><th>MMYYYY</th></thead><tbody></tbody>


</table>

        </div>
    
<div class="input-group">

  <div class="input-group-prepend">
    <span class="input-group-text" id="">THF:</span>
  </div>
  <input readonly="readonly" id="tot_thf" name="tot_thf" style="text-align:right;" type="text" class="tot_thf form-control">
  <div class="input-group-prepend">
    <span class="input-group-text">LOAN</span>
  </div>
  <input readonly="readonly" id="tot_emi" name="tot_emi"  style="text-align:right;" type="text" class="tot_emi form-control">

  <div class="input-group-prepend">
    <span class="input-group-text" id="">INT:</span>
  </div>
  <input readonly="readonly" id="tot_int" name="tot_int"  style="text-align:right;" createNewReceipt type="text" class="tot_int form-control">
  <div class="input-group-prepend">
    <span class="input-group-text" id="">INS:</span>
  </div>
  <input  readonly="readonly" id="tot_ins" name="tot_ins"  style="text-align:right;" type="text" class="tot_ins form-control">
  <div class="input-group-prepend">
    <span class="input-group-text" id="">OTH:</span>
  </div>
  <input  readonly="readonly" id="tot_oth" name="tot_oth"  style="text-align:right;" type="text" class="tot_oth form-control">


 <div class="input-group-prepend">
    <span class="input-group-text" id="">TOTAL</span>
  </div>
  <input  readonly id="tot_grand" onchange="getCalcGrand();" name="tot_grand"  style="text-align:right;" type="text" class="tot_grand form-control">

</div>


    </div>
    </div>
 

    
    

      </div>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

      <div class="modal-footer">
        <button type="button" id="save_btn" class="btn btn-success" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>


    </div>

  </div>
</div>

<!-- edit modal-->

<!--//Edit Modal -->


<div id="edit-directreceipt-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Receipt</h4>
      </div>
      <div id="update-receipt-message" style="color: white;font-weight: bold;"></div>

      <form method="post" id="form_updateDReceipt">
      <div class="modal-body">

<div class="row">
<div class="input-group" style="text-align:center;background: grey;color: white;">
    <div class="col-md-3"><label>Month</label></div>
    <div class="col-md-3"><label>Date</label></div>
    <div class="col-md-3"><label>Bank/Cash</label></div>
</div>    
</div>

<div class="row">
<div class="input-group">
 <input id="emonth_Year" disabled placeholder="Select a Month" class="month_Year" name="emonth_Year" required>
  <input id="ercpt_date" name="ercpt_date"  type="date" class="rcpt_date form-control">
  <select id="ecash_bank" name="ecash_bank" class="form-control custom-select cash_bank"></select>
        
<?php  
$csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
        );
?>


</div>

</div>

        <div class="card-body">
            <!--<form method="post" id="insert_form"> -->

<div style="height:400px; overflow-x:scroll;">

   <!-- <div class="table-resposive" style="height: 205px; overflow:auto"> -->
        <div id="editdmdTbl"  style="height: 90%; overflow:auto">

<!--                <div class="table-responsive" style="height:280px;">-->
                    <table   id="item_table" colspace="100%">
                        <tr>
                        <th>Member Name</th>
                        <th>Receipt#</th>
                        <th>Bank Ref#</th>
                        <th>Narration</th>
                        <th>Amount</th>
                        <th>Thrift</th>
                        <th>Principle</th>
                        <th>Interest</th>
                        <th>Insurance</th>
                        <th>Others</th>
                        <th style="width:100px;">Total</th>
                        <!--<th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fa fa-plus"></i></button></th>-->
                        </tr>
                    </table>
                </div>
            </div>
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                  <!--      <div class="pull-right">
                        <input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Save">
                    </div> -->
<input type="text" id="erec_id" name="erec_id" hidden>
<input type="text" id="emon_yr" name="emon_yr" hidden>

           <!-- </form>-->
        </div>


   
    

      </div>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

      <div class="modal-footer">
        <input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Update">
 <!--       <button type="submit" id="update_btn" class="btn btn-success" >Update</button>-->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>


    </div>

  </div>
</div>




<!-- edit customer -->






<!-- End Modal -->

<style>



#item_table th {
text-align: center;
  background: green;
  color: white;
  position: sticky;
  top: 0; /* Don't forget this, required for the stickiness */
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}

#item_table  td {
   /* width: 100px;*/
    white-space: nowrap;
}
.modal-lg {
    max-width: 80%;
}
.table-responsive {
  overflow-y: visible !important;
}
</style>

<script>
var manageReceiptTable;
var calculated_total_sum = 0;
var sum_thrift=0;
var sum_loan=0;
var sum_interest=0;
var sum_others=0;
var sum_insurance=0;
var total=0;      
var grand_tot=0;
var ins_mon=0;
var tot_thf=0;
var tot_emi=0;
var tot_int=0;
var tot_ins=0;
var tot_oth=0;
var row_tot=0;
var myear;






function deleteTransid(id = null) 
{
if(id) 
{
 if (confirm("Are you sure?")) {
        // your deletion code

urlstr =base_url + "deleteReceiptDatabyid";
var url = urlstr.replace("undefined","");
    $.ajax({
        url: url+"?id="+id,
        dataType: 'JSON',
        success:function (response) 
        {
          
              console.log(response);
                if(response.success == true) {                      
                  
                        $("#delete-receipt-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#delete-receipt-message").fadeTo(3000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});
$("#createNewReceipt").trigger("reset");
manageReceiptTable.ajax.reload(null, false);

}
    else
    {
                        $("#delete-receipt-message").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');
$("#add-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


    }

}
});


    }
    return false;

}

}




function updateTransid(id)
{

    console.log('Update Direct Receipt' + id);
$("#erec_id").val(id);


        tot_thf=0;
        tot_emi=0;
        tot_int=0;
        tot_ins=0;
        tot_oth=0;


urlstr =base_url + "get_editDReceiptData";
var url = urlstr.replace("undefined","");
    $.ajax({
        url: url+"?id="+id+"&dmf=0",
        dataType: 'JSON',
        success:function (response) 
        {
     //     console.log(response);
            var len = response.items.length;
        //console.log(len);
          var rw=1;
          var tr_str;
          var r_date =response[0].rct_date; 
          var trans_amount = response[0].trans_amount;
          var trans_refid = response[0].trans_refid;
          var cheque_ref = response[0].cheque_ref;
          var trans_narration = response[0].trans_narration;
          var db_acc = response[0].debit_account;
          var d_id = response[0].div_id;
          myear = response[0].mmyy;

         // console.log("m-year " + myear);
$(".cash_bank").val(db_acc).change();
$(".edivision_list").val(d_id).change();
$("#ediv_id").val(d_id);
$("#emon_yr").val(myear);
$(".rcpt_date").val(r_date);
$(".rcpt_amount").val(trans_amount);
$(".rcpt_ref").val(response[0].trans_refid);
$(".rcpt_date").val(response[0].rct_date);
$(".bank_ref").val(cheque_ref);
$(".rcpt_narration").val(trans_narration);
$(".month_Year").val(myear);
$("#editcrcpt_tbl tbody").empty();
//console.log('items' + response[0].items[0].thrift);

 for(var i=0; i<len; i++){
  var mem_id = response.items[i].member_id;
 // console.log(mem_id);
  var mem_name = response.items[i].member_name;
  //  console.log(mem_name);
        var recid = response.items[i].id;
        var ethf_mon= parseFloat(response.items[i].thrift);
        var eemi_mon=parseFloat(response.items[i].principle);
        var eint_mon=parseFloat(response.items[i].interest);
        var eins_mon=parseFloat(response.items[i].insurance);
        var eoth_mon=parseFloat(response.items[i].others);
        var trans_refid=response.items[i].receipt_ref;
        var trans_narration=response.items[i].trans_narration;
        var cheque_ref = response.items[i].cheque_ref;
        row_tot=parseFloat(ethf_mon+eemi_mon+eint_mon+eins_mon+eoth_mon);
        var emmyy=response.items[i].mmyyyy;
        //echo $intrest_mon;
        tot_thf=tot_thf+ethf_mon;
        tot_emi=tot_emi+eemi_mon;
        tot_int=tot_int+eint_mon;
        tot_ins=tot_ins+eins_mon;
        tot_oth=tot_oth+eoth_mon;
                
    var html = '';
    html += '<tr id="row'+i+'">';
    html +='<td><select style="width:300px;" name="member_name[]" class="form-control selectpicker" data-live-search="true"><option value="">Select a Member</option><?php echo $ldg_acc; ?></select></td>';
    html += '<td><input type="text" name="item_rcptno[]" value="'+trans_refid+'" placeholder="Receipt #" class="form-control item_rcptno" /></td>';
    html += '<td><input type="text" name="item_bankref[]" value="'+cheque_ref+'" placeholder="Bank Ref#" class="form-control item_bankref" /></td>';
    html += '<td><input type="text" name="item_narration[]" value="'+trans_narration+'" placeholder="Narration" class="form-control item_narration" /></td>';
    html += '<td><input  style="text-align:right;" value="'+row_tot+'"  type="text" name="item_amount[]" placeholder="0.00" class="form-control item_amount" /></td>';

    html += '<td><input  style="text-align:right;" value="'+ ethf_mon +'" type="text"  placeholder="0.00" name="item_thrift[]" class="form-control item_thrift txt" /></td>';     

    html += '<td><input style="text-align:right;" type="text"  value="'+ eemi_mon +'"   placeholder="0.00" name="item_principle[]" class="form-control item_principle txt" /></td>';       

    html += '<td><input style="text-align:right;" type="text"  value="'+ eint_mon +'"    placeholder="0.00" name="item_interest[]" class="form-control  item_interest txt" /></td>';       
    html += '<td><input  style="text-align:right;" type="text"  value="'+ eins_mon +'"   placeholder="0.00"  name="item_insurance[]" class="form-control  item_insurance txt" /></td>';        
    html += '<td><input style="text-align:right;" type="text"  value="'+ eoth_mon +'"   placeholder="0.00" name="item_others[]" class="form-control  item_others txt" /></td>';       
    html += '<td><input readonly style="text-align:right;" type="text"   value="'+ row_tot +'"   placeholder="0.00" name="item_total[]" class="form-control item_total" /></td>';     




rw++;
 
}
$('#item_table').find('tr:gt(0)').remove();
$("#item_table tbody").append(html);
$('.selectpicker').val(mem_id).trigger('change');
$('.selectpicker').selectpicker('refresh');

}

});



}


    function calculateSum() {
        var tbl = $('#item_table');
        tbl.find('tr').each(function () {
            var sum = 0;
            $(this).find('.txt').not('.item_total').each(function () {
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
//console.log('test2' + sum);
            $(this).find('.item_total').val(sum.toFixed(2));
            $(this).find('.item_amount').val(sum.toFixed(2));
        });
    }


$(document).ready(function(){


var urlstr = base_url+'fetchCashBankAccounts';
var url=urlstr.replace("undefined","");

$("#cash_bank").load(url);


$("#ecash_bank").load(url);


$("#month_Year").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});

$(document).on('keyup keydown','.txt',function(){
//console.log('test');
    var tbl = $('#item_table');
    tbl.find('tr').each(function () {
        $(this).find('input[type=text]').bind("keyup", function () {
            
            calculateSum();
        });

});

});



$('.table-responsive').on('#edit-directreceipt-modal show.bs.dropdown', function () {
     $('.table-responsive').css( "overflow", "inherit" );
});

$('.table-responsive').on('#edit-directreceipt-modal hide.bs.dropdown', function () {
     $('.table-responsive').css( "overflow", "auto" );
})





$('#form_updateDReceipt').on('submit', function(event){

        event.preventDefault();


//$("#update_btn").on("click",function(){
  var newFormData = [];
var urlstr = base_url + 'updateDirectReceipt';
var url = urlstr.replace("undefined","");
var rec_id=$("#erec_id").val();
//var div_id=$("#ediv_id").val();
//var mmyyyy=$("#emon_yr").val();

//var div_id = document.getElementById("ediv_id").value;
var mm_yy = document.getElementById("emonth_Year").value;


var rdate = document.getElementById("ercpt_date").value;
var rcash_bank = document.getElementById("ecash_bank").value;

/*var ramount = document.getElementById("ercpt_amount").value;
var rref = document.getElementById("ercpt_ref").value;
var rbankref = document.getElementById("ercpt_bank_ref").value;
var rnarr = document.getElementById("ercpt_narration").value;
var g_tot = document.getElementById("tot_grand").value;
*/
//console.log('divid ' + div_id + 'emon ' + mm_yy +'amt'+ramount);


    var form_data = $(this).serialize();

var dmf=1;
//var cct = $.cookie('csrf_cookie_name');
    var CFG = {
        url: '<?php echo $this->config->item('base_url');?>',
        token: '<?php echo $this->security->get_csrf_token_name(); ?>'};
    var cct = "<?php echo $csrf ['hash']; ?>";
/*
  jQuery('#item_table tr:not(:first)').each(function(i) {
    var tb = jQuery(this);
    var obj = {};
    tb.find('input').each(function() {
      obj[this.name] = this.value;
    });

    obj['row'] = i;
    newFormData.push(obj);
  });

*/

 // console.log(newFormData);
  //document.getElementById('output').innerHTML = JSON.stringify(newFormData);
  event.preventDefault(); 

            $.ajax({

                url:"updateMemberDReceipt",

                method:"POST",
                    dataType:"json",

                data:form_data,

                beforeSend:function()
                {

                    $('#submit_button').attr('disabled', 'disabled');

                },

                success:function(response)
                {
console.log(response);


                if(response.success == true) {                      
                  
                        $("#update-receipt-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  

                   //     $('#item_table').find('tr:gt(0)').remove();

                     //   $('#error').html('<div class="alert alert-success">'+ data.messages +'</div>');

                      //  $('#item_table').append(add_input_field(0));

                       // $('.selectpicker').selectpicker('refresh');

                        $('#submit_button').attr('disabled', false);

$("#update-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


}
    else
    {
                        $("#update-receipt-message").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');
$("#update-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


    }

/*
console.log(data);
   $('#submit_button').attr('disabled', false);

                        $('#update-receipt-message').html('<div class="alert alert-success"> Updated data Successfully</div>');

                    if(data == "ok")
                    {
                        $('#update-receipt-message').html('<div class="alert alert-success"> Updated data Successfully</div>');

console.log('success if');
                      //  $('#item_table').find('tr:gt(0)').remove();

//                        $('#item_table').append(add_input_field(0));

  //                      $('.selectpicker').selectpicker('refresh');

                        $('#submit_button').attr('disabled', false);
                    }
                    */

                }
            });

/*
$.ajax({
    url:url,
    data:{rdate:rdate,rcash_bank:rcash_bank,ramount:ramount,rref:rref,rbankref:rbankref,rnarr:rnarr, mm_yy:mm_yy,div_id:div_id,dmf:dmf,recid:rec_id,json:JSON.stringify(newFormData),'<?php echo $this->security->get_csrf_token_name(); ?>': cct},
    method:"post",
    dataType:"json",
    success:function(response)
    {
              console.log(response);
                if(response.success == true) {                      
                  
                        $("#update-receipt-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#update-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});
}
    else
    {
                        $("#update-receipt-message").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');
$("#update-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


    }

    }
});
*/



});


$("#save_btn").on("click",function(){
  var newFormData = [];
var urlstr = base_url + 'insertDivReceipt';
var url = urlstr.replace("undefined","");
var div_id = document.getElementById("div_id").value;
var mm_yy = document.getElementById("mon_yr").value;
var rdate = document.getElementById("rcpt_date").value;
var rcash_bank = document.getElementById("cash_bank").value;
var ramount = document.getElementById("rcpt_amount").value;
var rref = document.getElementById("rcpt_ref").value;
var rbankref = document.getElementById("bank_ref").value;
var rnarr = document.getElementById("rcpt_narration").value;
var g_tot = document.getElementById("tot_grand").value;


if(parseFloat(ramount)!=parseFloat(g_tot))
{
 alert('There is mismatch in Amount between Division Receipt & Members');
}
else{
//console.log( div_id);
//var cct = $.cookie('csrf_cookie_name');
    var CFG = {
        url: '<?php echo $this->config->item('base_url');?>',
        token: '<?php echo $this->security->get_csrf_token_name(); ?>'};
    var cct = "<?php echo $csrf ['hash']; ?>";

  jQuery('#crcpt_tbl tr:not(:first)').each(function(i) {
    var tb = jQuery(this);
    var obj = {};
    tb.find('input').each(function() {
      obj[this.name] = this.value;
    });
    obj['row'] = i;
    newFormData.push(obj);
  });
 // console.log(newFormData);
  //document.getElementById('output').innerHTML = JSON.stringify(newFormData);
  event.preventDefault(); 



$.ajax({
    url:url,
    data:{rdate:rdate,rcash_bank:rcash_bank,ramount:ramount,rref:rref,rbankref:rbankref,rnarr:rnarr, mm_yy:mm_yy,div_id:div_id, json:JSON.stringify(newFormData),'<?php echo $this->security->get_csrf_token_name(); ?>': cct},
    method:"post",
    dataType:"json",
    success:function(response)
    {
              console.log(response);
                if(response.success == true) {                      
                  
                        $("#add-receipt-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


$("#crcpt_tbl tbody").empty();
$("division_list").val(0).change();
 $("#createNewReceipt").trigger("reset"); 
$("#add-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});
}
    else
    {
                        $("#add-receipt-message").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');
$("#add-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


    }
    
}

    
});
}

});





var urlstr = base_url + 'fetchDivision';
var url = urlstr.replace("undefined","");

    $("#divisionlist").load(url);
$('#divisionlist').select2();


    $("#division_list").load(url);
$('#division_list').select2();

 $("#division_list").select2({
    dropdownParent: $("#modalAddReceipt") 
  });


    $("#edivision_list").load(url);
$('#edivision_list').select2();

 $("#edivision_list").select2({
    dropdownParent: $("#edit-receipt-modal") 
  });



    var urlstr = base_url + 'fetchMemberlist';
var url = urlstr.replace("undefined","");

var memberNames = new Array();
var memberIds = new Object();
var tbl='';







//console.log('demand rep');

$("#search_btn").on("click",function(){



    var urlstr = base_url + 'getDirectMemberReceiptData';
var url = urlstr.replace("undefined","");

 manageReceiptTable = $('#manageReceiptTable').DataTable( {
        "ajax": url, //'../ajax/data/arrays.txt'
        "destroy":true, 
        "dataSrc": "data",
    "language": {
      "emptyTable": "No data available in table"
    },

"columns": [
            { "data": "division_name" },
            { "data": "trans_date" },
            { "data": "db_name" },
            { "data": "cr_name" },
            { "data": "tot_amt" },
            { "data": "finyear" },
            { "data": "action" }
        ],
'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
      "width": "4%"
 },
 {
      "targets": 4,
      "className": "text-right",
 }],      
    } );



});










}); //--document ready




function deleteDemand(id) 
{
 //   console.log(id);

$('#delRec').on('click',function() {
   // var id = $this.val();
console.log('delete '+ id);
//var deletememRec = id;
$('#deleteModal').modal('hide');
    var urlstr = base_url + 'deletedemandRec';
var url = urlstr.replace("undefined","");
//console.log(url);
    $.ajax({
        url: url+'/'+id,
        success:function (response) 
        {
         
//manageReceiptTable.ajax.reload(null, false);
                            //console.log(response);
                            if(response.success === true) {
                            console.log(response);    
                            manageReceiptTable.ajax.reload(null, false);                  
                                $("#delete-receipt-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');

    $('#deleteModal').modal('hide');
                                      
$("#delete-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
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
