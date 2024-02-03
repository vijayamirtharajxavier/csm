
<?php 
$system_name = $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('soc_settings', array('type' => 'system_title'))->row()->description;
?>

<!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                <div id="delete-receipt-message"  style="color: white;font-weight: bold;"></div>

           <div class="panel panel-info">

                <div class="panel-heading"> <i class="fa fa-list"></i> All Division Receipts
                
                 <?php if ($this->session->userdata('role') == 'admin'): ?>
                 
                    <a href="" id="addRcpt" class="btn btn-info btn-sm pull-right"  data-toggle="modal" data-target="#modalAddReceipt"><i class="fa fa-plus"></i>&nbsp;New Receipt</a> &nbsp;
                <?php else: ?>
                    <!-- check logged user role permissions -->

                    <?php if(check_power(1)):?>
                        <a href="<?php echo base_url('admin/userhome') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp;New User</a>
                    <?php endif; ?>
                <?php endif ?>
                
                </div>

                        <div class="white-box">
                            <h3 class="box-title m-b-0">Receipts Report</h3>


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
                                            <th>MONTH </th>
                                            <th>NO OF MEMBERS</th>
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
    <div class="col-md-3"><label>Bank/Cash Reference</label></div>
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
  <input readonly="readonly" id="tot_int" name="tot_int"  style="text-align:right;"  type="text" class="tot_int form-control">
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
<!-- Modal -->
<div id="edit-receipt-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Receipt</h4>
      </div>
      <div id="update-receipt-message" style="color: white;font-weight: bold;"></div>

      <form action="createDemand" method="post" id="createNewDemand">
      <div class="modal-body">

<div class="row">
<div class="input-group" style="text-align:center;background: grey;color: white;">
    <div class="col-md-3"><label>Month</label></div>
    <div class="col-md-3"><label>Date</label></div>
    <div class="col-md-3"><label>Bank/Cash</label></div>
    <div class="col-md-3"><label>Amount</label></div>
</div>    
</div>

<div class="row">
<div class="input-group">
 <input id="emonth_Year" disabled placeholder="Select a Month" class="month_Year" name="emonth_Year" required>
  <input id="ercpt_date" name="ercpt_date"  type="date" class="rcpt_date form-control">
  <select id="ecash_bank" name="ecash_bank" class="form-control custom-select cash_bank"></select>
  <input placeholder="Amount"  id="ercpt_amount" name="ercpt_amount"  style="text-align:right;"  type="text" class="rcpt_amount form-control">
        
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
    <div class="col-md-3"><label>Bank/Cash Reference</label></div>
    <div class="col-md-3"><label>Narration</label></div>
</div>    
</div>

<div class="row">
<div class="input-group">

 <select id="edivision_list" disabled name="edivision_list" class="form-control edivision_list" style="width:200px;"></select>
  <input placeholder="Receipt Ref"  id="ercpt_ref" name="ercpt_ref"  type="text" class="rcpt_ref form-control">

  <input placeholder="Bank/Cash Reference"  id="ercpt_bank_ref" name="ercpt_bank_ref"  type="text" class="bank_ref form-control">

  <input placeholder="Narration"  id="ercpt_narration" name="ercpt_narration"  type="text" class="rcpt_narration form-control">

        
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
        <div id="editdmdTbl"  style="height: 90%; overflow:auto">

<input type="text" hidden id="emon_yr" name="emon_yr">
<input type="text" hidden id="ediv_id" name="ediv_id">
<input type="text" hidden id="erec_id" name="erec_id">

<table id="editcrcpt_tbl" style="white-space:nowrap;">
    <thead><th>#</th><th>Member#</th><th>Member Name</th><th>Thrift</th><th>Loan</th><th>Interest</th><th>Insurance</th><th>Others</th><th>Total</th><th>MMYYYY</th></thead><tbody></tbody>


</table>

        </div>
    
<div class="input-group">

  <div class="input-group-prepend">
    <span class="input-group-text" id="">THF:</span>
  </div>
  <input readonly="readonly" id="etot_thf" name="etot_thf" style="text-align:right;" type="text" class="etot_thf form-control">
  <div class="input-group-prepend">
    <span class="input-group-text">LOAN</span>
  </div>
  <input readonly="readonly" id="etot_emi" name="etot_emi"  style="text-align:right;" type="text" class="etot_emi form-control">

  <div class="input-group-prepend">
    <span class="input-group-text" id="">INT:</span>
  </div>
  <input readonly="readonly" id="etot_int" name="etot_int"  style="text-align:right;"  type="text" class="etot_int form-control">
  <div class="input-group-prepend">
    <span class="input-group-text" id="">INS:</span>
  </div>
  <input  readonly="readonly" id="etot_ins" name="etot_ins"  style="text-align:right;" type="text" class="etot_ins form-control">

  <div class="input-group-prepend">
    <span class="input-group-text" id="">OTH:</span>
  </div>
  <input  readonly="readonly" id="etot_oth" name="etot_oth"  style="text-align:right;" type="text" class="etot_oth form-control">

 <div class="input-group-prepend">
    <span class="input-group-text" id="">TOTAL</span>
  </div>
  <input  readonly id="etot_grand" onchange="getCalcEGrand();" name="etot_grand"  style="text-align:right;" type="text" class="etot_grand form-control">

</div>


    </div>
    </div>
 

    
    

      </div>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

      <div class="modal-footer">
        <button type="button" id="update_btn" class="btn btn-success" >Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>


    </div>

  </div>
</div>



<!-- edit customer -->






<!-- End Modal -->

<style>
#crcpt_tbl th {
text-align: center;
  background: green;
  color: white;
  position: sticky;
  top: 0; /* Don't forget this, required for the stickiness */
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}

#editcrcpt_tbl th {
text-align: center;
  background: green;
  color: white;
  position: sticky;
  top: 0; /* Don't forget this, required for the stickiness */
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}
.modal-lg {
    max-width: 80%;
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

    console.log('Update Receipt' + id);
$("#erec_id").val(id);

        tot_thf=0;
        tot_emi=0;
        tot_int=0;
        tot_ins=0;
        tot_oth=0;


urlstr =base_url + "get_editReceiptData";
var url = urlstr.replace("undefined","");
    $.ajax({
        url: url+"?id="+id+"&dmf=1",
        dataType: 'JSON',
        success:function (response) 
        {
          console.log(response);
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

          console.log("m-year " + myear);
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
        row_tot=parseFloat(ethf_mon+eemi_mon+eint_mon+eins_mon+eoth_mon);
        var emmyy=response.items[i].mmyyyy;
        //echo $intrest_mon;
        tot_thf=tot_thf+ethf_mon;
        tot_emi=tot_emi+eemi_mon;
        tot_int=tot_int+eint_mon;
        tot_ins=tot_ins+eins_mon;
        tot_oth=tot_oth+eoth_mon;
                
    tr_str +='<tr>'+
        '<td>'+ rw + '</td>'+

      // '<td><input style="width:80px"; readonly value="'+ recid +'" name="id" id="id'+ i +'"></td>'+
'<td><input name="mem_id" style="text-align:left;" value="'+ mem_id + '" class="form-control"></td>'+
        '<td><input style="text-align:left;" name="mem_name" value="'+ mem_name+'" readonly class="form-control">'+  
        '<td><input style="text-align:right;" class="form-control thrift" onfocus="getCalcEThf('+ i +')" onkeyup="getCalcEThf('+ i + ')" value="'+ ethf_mon.toFixed(2) +'"  id="thrift'+ i +'" name="thrift"></td>'+
        '<td><input style="text-align:right;" class="form-control loan" onfocus="getCalcELoan('+ i +')" onkeyup="getCalcELoan('+ i + ')" value="'+ eemi_mon.toFixed(2) +'"  id="loan'+ i +'" name="principle"></td>'+
        '<td><input style="text-align:right;" class="form-control interest" onfocus="getCalcEInterest('+ i +')" onkeyup="getCalcEInterest('+ i + ')" value="'+ eint_mon.toFixed(2) +'"  id="interest'+ i +'" name="interest"></td>'+
'<td><input style="text-align:right;" class="form-control insurance" onfocus="getCalcEInsu('+ i +')" onkeyup="getCalcEInsu('+ i + ')" value="'+ eins_mon.toFixed(2) +'"  id="insurance'+ i +'" name="insurance"></td>'+
'<td><input style="text-align:right;" class="form-control others" onfocus="getCalcEOth('+ i +')" onkeyup="getCalcEOth('+ i + ')" value="'+ eoth_mon.toFixed(2) +'"  id="others'+ i +'" name="others"></td>'+
'<td><input readonly style="text-align:right;" class="form-control erow_tot" value="'+ row_tot.toFixed(2) +'"  id="erow_tot'+ i +'" name="erow_tot"></td>'+

'<td><input style="text-align:center;" class="form-control mmyy" readonly value="'+ emmyy +'"  id="mmyy'+ i +'" name="mmyy"></td>'+
            '</tr>';

rw++;
 
}
 $("#editcrcpt_tbl tbody").append(tr_str);

$("#etot_thf").val(tot_thf.toFixed(2));
$("#etot_emi").val(tot_emi.toFixed(2));
$("#etot_int").val(tot_int.toFixed(2));
$("#etot_ins").val(tot_ins.toFixed(2));
$("#etot_oth").val(tot_oth.toFixed(2));
grand_tot=tot_thf+tot_emi+tot_int+tot_ins+tot_oth;
$("#etot_grand").val(grand_tot.toFixed(2));

}

});



}



function getCalcThf(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var thrift_amt =  $('#dmdTbl').find("#thrift"+count).val();
    var principle_amt =  $('#dmdTbl').find("#loan"+count).val();
    var interest_amt =  $('#dmdTbl').find("#interest"+count).val();
    var insurance_amt =  $('#dmdTbl').find("#insurance"+count).val();
    var other_amt =  $('#dmdTbl').find("#others"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();

row_tot=parseFloat(thrift_amt)+parseFloat(principle_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(other_amt);
console.log(row_tot);

$("#row_tot"+rw).val(row_tot);
calThfSum();
}

function getCalcLoan(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var thrift_amt =  $('#dmdTbl').find("#thrift"+count).val();
    var principle_amt =  $('#dmdTbl').find("#loan"+count).val();
    var interest_amt =  $('#dmdTbl').find("#interest"+count).val();
    var insurance_amt =  $('#dmdTbl').find("#insurance"+count).val();
    var other_amt =  $('#dmdTbl').find("#others"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(row_tot);
row_tot=parseFloat(thrift_amt)+parseFloat(principle_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(other_amt);

$("#row_tot"+rw).val(row_tot);

calLoanSum();
}

function getCalcInterest(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var thrift_amt =  $('#dmdTbl').find("#thrift"+count).val();
    var principle_amt =  $('#dmdTbl').find("#loan"+count).val();
    var interest_amt =  $('#dmdTbl').find("#interest"+count).val();
    var insurance_amt =  $('#dmdTbl').find("#insurance"+count).val();
    var other_amt =  $('#dmdTbl').find("#others"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(row_tot);
row_tot=parseFloat(thrift_amt)+parseFloat(principle_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(other_amt);
$("#row_tot"+rw).val(row_tot);

calIntSum();
}

function getCalcOth(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var thrift_amt =  $('#dmdTbl').find("#thrift"+count).val();
    var principle_amt =  $('#dmdTbl').find("#loan"+count).val();
    var interest_amt =  $('#dmdTbl').find("#interest"+count).val();
    var insurance_amt =  $('#dmdTbl').find("#insurance"+count).val();
    var other_amt =  $('#dmdTbl').find("#others"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(row_tot);
row_tot=parseFloat(thrift_amt)+parseFloat(principle_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(other_amt);
$("#row_tot"+rw).val(row_tot);

calOthSum();
}


function getCalcInsu(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var thrift_amt =  $('#dmdTbl').find("#thrift"+count).val();
    var principle_amt =  $('#dmdTbl').find("#loan"+count).val();
    var interest_amt =  $('#dmdTbl').find("#interest"+count).val();
    var insurance_amt =  $('#dmdTbl').find("#insurance"+count).val();
    var other_amt =  $('#dmdTbl').find("#others"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(row_tot);
row_tot=parseFloat(thrift_amt)+parseFloat(principle_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(other_amt);
$("#row_tot"+rw).val(row_tot);

calInsSum();
}

function getCalcEThf(rw) {
  console.log('Row Number ='+rw);
  row_tot=0;
    count = rw;
    
    var thrift_amt =  $('#editdmdTbl').find("#thrift"+count).val();
    var principle_amt =  $('#editdmdTbl').find("#loan"+count).val();
    var interest_amt =  $('#editdmdTbl').find("#interest"+count).val();
    var insurance_amt =  $('#editdmdTbl').find("#insurance"+count).val();
    var other_amt =  $('#editdmdTbl').find("#others"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(row_tot);
row_tot=parseFloat(thrift_amt)+parseFloat(principle_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(other_amt);
$("#erow_tot"+rw).val(row_tot);

calThfESum();
}

function getCalcELoan(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    row_tot=0;
    var thrift_amt =  $('#editdmdTbl').find("#thrift"+count).val();
    var principle_amt =  $('#editdmdTbl').find("#loan"+count).val();
    var interest_amt =  $('#editdmdTbl').find("#interest"+count).val();
    var insurance_amt =  $('#editdmdTbl').find("#insurance"+count).val();
    var other_amt =  $('#editdmdTbl').find("#others"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(row_tot);
row_tot=parseFloat(thrift_amt)+parseFloat(principle_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(other_amt);
$("#erow_tot"+rw).val(row_tot);

calLoanESum();
}

function getCalcEInterest(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    row_tot=0;
    var thrift_amt =  $('#editdmdTbl').find("#thrift"+count).val();
    var principle_amt =  $('#editdmdTbl').find("#loan"+count).val();
    var interest_amt =  $('#editdmdTbl').find("#interest"+count).val();
    var insurance_amt =  $('#editdmdTbl').find("#insurance"+count).val();
    var other_amt =  $('#editdmdTbl').find("#others"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(row_tot);
row_tot=parseFloat(thrift_amt)+parseFloat(principle_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(other_amt);
$("#erow_tot"+rw).val(row_tot);

calIntESum();
}

function getCalcEInsu(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    row_tot=0;
    var thrift_amt =  $('#editdmdTbl').find("#thrift"+count).val();
    var principle_amt =  $('#editdmdTbl').find("#loan"+count).val();
    var interest_amt =  $('#editdmdTbl').find("#interest"+count).val();
    var insurance_amt =  $('#editdmdTbl').find("#insurance"+count).val();
    var other_amt =  $('#editdmdTbl').find("#others"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(row_tot);
row_tot=parseFloat(thrift_amt)+parseFloat(principle_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(other_amt);
$("#erow_tot"+rw).val(row_tot);

calInsESum();
}


function getCalcEOth(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    row_tot=0;
    var thrift_amt =  $('#editdmdTbl').find("#thrift"+count).val();
    var principle_amt =  $('#editdmdTbl').find("#loan"+count).val();
    var interest_amt =  $('#editdmdTbl').find("#interest"+count).val();
    var insurance_amt =  $('#editdmdTbl').find("#insurance"+count).val();
    var other_amt =  $('#editdmdTbl').find("#others"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(row_tot);
row_tot=parseFloat(thrift_amt)+parseFloat(principle_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(other_amt);
$("#erow_tot"+rw).val(row_tot);

calOthESum();
}

//Edit

function calThfESum()
{
sum_thrift=0
          $("#editcrcpt_tbl .thrift").each(function () {
           var get_thf = $(this).val();
           console.log(get_thf);
           if ($.isNumeric(get_thf)) {
              sum_thrift += parseFloat(get_thf);
              }                  
            });
       console.log(sum_thrift);
      // $('#dmdTbl').find("#crcpt_tbl tfoot #tot_thf").html(sum_thrift);
       $(".etot_thf").val(sum_thrift).trigger('change');
     //  grand_tot=grand_tot+sum_thrift;
//console.log(grand_tot);
sum_thrift = 0;
$('#etot_thf').trigger('change');
$('#etot_emi').trigger('change');
$('#etot_int').trigger('change');
$('#etot_ins').trigger('change');
$('#etot_oth').trigger('change');
}

function calLoanESum()

{
    sum_loan=0;
          $("#editcrcpt_tbl .loan").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_loan += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_loan);
      // $('#dmdTbl').find("#crcpt_tbl tfoot #tot_emi").html(sum_loan);
       $(".etot_emi").val(sum_loan).trigger('change');
       //grand_tot=grand_tot+sum_loan;
sum_loan= 0;
$('#etot_thf').trigger('change');
$('#etot_emi').trigger('change');
$('#etot_int').trigger('change');
$('#etot_ins').trigger('change');
$('#etot_oth').trigger('change');
//console.log(grand_tot);
}

function calIntESum()
{
sum_interest=0;
          $("#editcrcpt_tbl .interest").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_interest += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_interest);
       //$('#dmdTbl').find("#crcpt_tbl tfoot #tot_int").html(sum_interest);
       $(".etot_int").val(sum_interest).trigger('change');
//grand_tot=grand_tot+sum_interest;
$('#etot_thf').trigger('change');
$('#etot_emi').trigger('change');
$('#etot_int').trigger('change');
$('#etot_ins').trigger('change');
$('#etot_oth').trigger('change');
sum_interest = 0;
//console.log(grand_tot);

}


function calInsESum()
{
    sum_insurance=0;
          $("#editcrcpt_tbl .insurance").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_insurance += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_insurance);
       //$('#dmdTbl').find("#crcpt_tbl tfoot #tot_ins").html(sum_insurance);
       $(".etot_ins").val(sum_insurance);
//grand_tot=grand_tot+sum_insurance;
$('#etot_thf').trigger('change');
$('#etot_emi').trigger('change');
$('#etot_int').trigger('change');
$('#etot_ins').trigger('change');
$('#etot_oth').trigger('change');

sum_insurance = 0;
//console.log(grand_tot);
}


function calOthESum()
{
    sum_others=0;
          $("#editcrcpt_tbl .others").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_others += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_others);
       //$('#dmdTbl').find("#crcpt_tbl tfoot #tot_ins").html(sum_insurance);
       $(".etot_oth").val(sum_others);
//grand_tot=grand_tot+sum_insurance;
$('#etot_thf').trigger('change');
$('#etot_emi').trigger('change');
$('#etot_int').trigger('change');
$('#etot_ins').trigger('change');
$('#etot_oth').trigger('change');

sum_others = 0;
//console.log(grand_tot);
}


///Add

function calThfSum()
{
sum_thrift=0
          $("#crcpt_tbl .thrift").each(function () {
           var get_thf = $(this).val();
           console.log(get_thf);
           if ($.isNumeric(get_thf)) {
              sum_thrift += parseFloat(get_thf);
              }                  
            });
       console.log(sum_thrift);
      // $('#dmdTbl').find("#crcpt_tbl tfoot #tot_thf").html(sum_thrift);
       $(".tot_thf").val(sum_thrift).trigger('change');
     //  grand_tot=grand_tot+sum_thrift;
//console.log(grand_tot);
sum_thrift = 0;
$('#tot_thf').trigger('change');
$('#tot_emi').trigger('change');
$('#tot_int').trigger('change');
$('#tot_ins').trigger('change');
$('#tot_oth').trigger('change');

}
function calLoanSum()

{
    sum_loan=0;
          $("#crcpt_tbl .loan").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_loan += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_loan);
      // $('#dmdTbl').find("#crcpt_tbl tfoot #tot_emi").html(sum_loan);
       $(".tot_emi").val(sum_loan).trigger('change');
       //grand_tot=grand_tot+sum_loan;
sum_loan= 0;
$('#tot_thf').trigger('change');
$('#tot_emi').trigger('change');
$('#tot_int').trigger('change');
$('#tot_ins').trigger('change');
$('#tot_oth').trigger('change');
//console.log(grand_tot);
}

function calIntSum()
{
sum_interest=0;
          $("#crcpt_tbl .interest").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_interest += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_interest);
       //$('#dmdTbl').find("#crcpt_tbl tfoot #tot_int").html(sum_interest);
       $(".tot_int").val(sum_interest).trigger('change');
//grand_tot=grand_tot+sum_interest;
$('#tot_thf').trigger('change');
$('#tot_emi').trigger('change');
$('#tot_int').trigger('change');
$('#tot_ins').trigger('change');
$('#tot_oth').trigger('change');
sum_interest = 0;
//console.log(grand_tot);

}


function calInsSum()
{
    sum_insurance=0;
          $("#crcpt_tbl .insurance").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_insurance += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_insurance);
       //$('#dmdTbl').find("#crcpt_tbl tfoot #tot_ins").html(sum_insurance);
       $(".tot_ins").val(sum_insurance);
//grand_tot=grand_tot+sum_insurance;
$('#tot_thf').trigger('change');
$('#tot_emi').trigger('change');
$('#tot_int').trigger('change');
$('#tot_ins').trigger('change');
$('#tot_oth').trigger('change');
sum_insurance = 0;
//console.log(grand_tot);
}

function calOthSum()
{
    sum_others=0;
          $("#crcpt_tbl .others").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_others += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_others);
       //$('#dmdTbl').find("#crcpt_tbl tfoot #tot_ins").html(sum_insurance);
       $(".tot_oth").val(sum_others);
//grand_tot=grand_tot+sum_insurance;
$('#tot_thf').trigger('change');
$('#tot_emi').trigger('change');
$('#tot_int').trigger('change');
$('#tot_ins').trigger('change');
$('#tot_oth').trigger('change');
sum_others = 0;
//console.log(grand_tot);
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

$("#emonth_Year").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months",
    setDate: myear

});

$('#tot_ins').change(function() {
    console.log("It's Changed!");
var totthf = parseFloat($(".tot_thf").val());
var totemi = parseFloat($(".tot_emi").val());
var totint = parseFloat($(".tot_int").val());
var totins = parseFloat($(".tot_ins").val());
var tototh = parseFloat($(".tot_oth").val());
grand_tot=0;

grand_tot=parseFloat(totthf+totemi+totint+totins+tototh);
$("#tot_grand").val(grand_tot);
console.log(grand_tot);    
});    
    
$('#etot_ins').change(function() {
    console.log("It's Changed!");
var totthf = parseFloat($(".etot_thf").val());
var totemi = parseFloat($(".etot_emi").val());
var totint = parseFloat($(".etot_int").val());
var totins = parseFloat($(".etot_ins").val());
var tototh = parseFloat($(".etot_oth").val());
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins+tototh);
$("#etot_grand").val(grand_tot);
console.log(grand_tot);    
});    
    


$('#tot_emi').change(function() {

//$(".tot_emi").on('change',function(){
var totemi = $(".tot_emi").val();
var totthf = $(".tot_thf").val();
var totint = $(".tot_int").val();
var totins = $(".tot_ins").val();
var tototh = parseFloat($(".tot_oth").val());
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins+tototh);
$("#tot_grand").val(grand_tot);
});


$('#etot_emi').change(function() {

//$(".tot_emi").on('change',function(){
var totemi = $(".etot_emi").val();
var totthf = $(".etot_thf").val();
var totint = $(".etot_int").val();
var totins = $(".etot_ins").val();
var tototh = parseFloat($(".etot_oth").val());
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins+tototh);
$("#etot_grand").val(grand_tot);
});


$('#tot_int').change(function() {
var totint = $(".tot_int").val();
var totthf = $(".tot_thf").val();
var totemi = $(".tot_emi").val();
var totins = $(".tot_ins").val();
var tototh = parseFloat($(".tot_oth").val());
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins+tototh);
$("#tot_grand").val(grand_tot);
});

$('#etot_int').change(function() {
var totint = parseFloat($(".etot_int").val());
var totthf = parseFloat($(".etot_thf").val());
var totemi = parseFloat($(".etot_emi").val());
var totins = parseFloat($(".etot_ins").val());
var tototh = parseFloat($(".etot_oth").val());
grand_tot=0;
grand_tot=totthf+totemi+totint+totins+tototh;
$("#etot_grand").val(grand_tot);
});



$('#etot_oth').change(function() {
var totint = parseFloat($(".etot_int").val());
var totthf = parseFloat($(".etot_thf").val());
var totemi = parseFloat($(".etot_emi").val());
var totins = parseFloat($(".etot_ins").val());
var tototh = parseFloat($(".etot_oth").val());
grand_tot=0;
grand_tot=totthf+totemi+totint+totins+tototh;
$("#etot_grand").val(grand_tot);
});

$('input #tot_ins').bind('change',function(){
//$('#tot_ins').change(function() {
console.log('onchange');
//$(".tot_ins").on('change',function(){
var totins = $(".tot_ins").val();
var totthf = $(".tot_thf").val();
var totint = $(".tot_int").val();
var totemi = $(".tot_emi").val();
var tototh = parseFloat($(".tot_oth").val());
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins+tototh);
$("#tot_grand").val(grand_tot);
});


$('input #etot_ins').bind('change',function(){
//$('#tot_ins').change(function() {
console.log('onchange');
//$(".tot_ins").on('change',function(){
var totint = parseFloat($(".etot_int").val());
var totthf = parseFloat($(".etot_thf").val());
var totemi = parseFloat($(".etot_emi").val());
var totins = parseFloat($(".etot_ins").val());
var tototh = parseFloat($(".etot_oth").val());
grand_tot=0;
grand_tot=totthf+totemi+totint+totins+tototh;
$("#etot_grand").val(grand_tot);
});



$("#update_btn").on("click",function(){
  var newFormData = [];
var urlstr = base_url + 'updateDivReceipt';
var url = urlstr.replace("undefined","");
var rec_id=$("#erec_id").val();
//var div_id=$("#ediv_id").val();
//var mmyyyy=$("#emon_yr").val();

var div_id = document.getElementById("ediv_id").value;
var mm_yy = document.getElementById("emon_yr").value;


var rdate = document.getElementById("ercpt_date").value;
var rcash_bank = document.getElementById("ecash_bank").value;
var ramount = document.getElementById("ercpt_amount").value;
var rref = document.getElementById("ercpt_ref").value;
var rbankref = document.getElementById("ercpt_bank_ref").value;
var rnarr = document.getElementById("ercpt_narration").value;
var g_tot = document.getElementById("tot_grand").value;

console.log('divid ' + div_id + 'emon ' + mm_yy +'amt'+ramount);


var dmf=1;
//var cct = $.cookie('csrf_cookie_name');
    var CFG = {
        url: '<?php echo $this->config->item('base_url');?>',
        token: '<?php echo $this->security->get_csrf_token_name(); ?>'};
    var cct = "<?php echo $csrf ['hash']; ?>";

  jQuery('#editcrcpt_tbl tr:not(:first)').each(function(i) {
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
console.log( div_id);
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




$("#oldedivision_list").on('change',function(){
//console.log('clicked');

var mm_yy= $("#month_Year").val();
var div_id = $("#edivision_list").val();
var etot_thf=0;
var etot_emi=0;
var etot_int=0;
var etot_ins=0;
var etot_oth=0;
var total=0;      
var row_tot=0;
var grand_tot=0;


$("#div_id").val(div_id);
$("#mon_yr").val(mm_yy);

urlstr =base_url + "get_EditReceiptMemberData";
var url = urlstr.replace("undefined","");
    $.ajax({
        url: url+"?mm_yy="+mm_yy+"&div_id="+div_id,
        dataType: 'JSON',
        success:function (response) 
        {
        //  console.log(response);
            var len = response.length;
            //console.log(len);
          var rw=1;
          var tr_str;
$("#crcpt_tbl tbody").empty();


 for(var i=0; i<len; i++){
  var mem_id = response[i].mem_id;
  var mem_name = response[i].mem_name;
  //  console.log(mem_name);
        var thf_mon= response[i].thrift;
        var emi_mon=response[i].principle;
        var int_mon=response[i].interest;
        var ins_mon=response[i].insurance;
        var oth_mon=response[i].others;

        var mmyy=response[i].mmyy;
        //echo $intrest_mon;
        etot_thf=etot_thf+thf_mon;
        etot_emi=etot_emi+emi_mon;
        etot_int=etot_int+int_mon;
        etot_ins=etot_ins+ins_mon;
        etot_oth=etot_oth+oth_mon;
        row_tot=thf_mon+emi_mon+int_mon+ins_mon+oth_mon;        
    tr_str +='<tr>'+
        '<td>'+ rw + '</td>'+

//        '<td>'+ mem_id + ' - ' + mem_name +'</td>'+

'<td><input name="mem_id" style="text-align:left;" value="'+ mem_id + '" class="form-control"></td>'+
        '<td><input style="text-align:left;" name="mem_name" value="'+ mem_name+'" readonly class="form-control">'+  
        '<td><input style="text-align:right;" class="form-control thrift" onfocus="getCalcThf('+ i +')" onkeyup="getCalcThf('+ i + ')" value="'+ thf_mon.toFixed(2) +'"  id="thrift'+ i +'" name="thrift"></td>'+
        '<td><input style="text-align:right;" class="form-control loan" onfocus="getCalcLoan('+ i +')" onkeyup="getCalcLoan('+ i + ')" value="'+ emi_mon.toFixed(2) +'"  id="loan'+ i +'" name="surety"></td>'+
        '<td><input style="text-align:right;" class="form-control interest" onfocus="getCalcInterest('+ i +')" onkeyup="getCalcInterest('+ i + ')" value="'+ int_mon.toFixed(2) +'"  id="interest'+ i +'" name="interest"></td>'+
'<td><input style="text-align:right;" class="form-control insurance" onfocus="getCalcInsu('+ i +')" onkeyup="getCalcInsu('+ i + ')" value="'+ ins_mon.toFixed(2) +'"  id="insurance'+ i +'" name="insurance"></td>'+
'<td><input style="text-align:right;" class="form-control others" onfocus="getCalcOth('+ i +')" onkeyup="getCalcOth('+ i + ')" value="'+ oth_mon.toFixed(2) +'"  id="others'+ i +'" name="others"></td>'+

'<td><input readonly style="text-align:right;" class="form-control row_tot" value="'+ row_tot.toFixed(2) +'"  id="row_tot'+ i +'" name="rowtotal"></td>'+

'<td><input style="text-align:center;" class="form-control mmyy" readonly value="'+ mmyy +'"  id="mmyy'+ i +'" name="mmyy"></td>'+
            '</tr>';

rw++;
 
}
 $("#crcpt_tbl tbody").append(tr_str);

$("#tot_thf").val(parseFloat(etot_thf.toFixed(2)));
$("#tot_emi").val(parseFloat(etot_emi.toFixed(2)));
$("#tot_int").val(parseFloat(etot_int.toFixed(2)));
$("#tot_ins").val(parseFloat(etot_ins.toFixed(2)));
$("#tot_oth").val(parseFloat(etot_oth.toFixed(2)));
grand_tot=parseFloat(etot_thf+etot_emi+etot_int+etot_ins+etot_oth);
$("#tot_grand").val(grand_tot.toFixed(2));

        }

});


});






$("#division_list").on('change',function(){
//console.log('clicked');

var mm_yy= $("#month_Year").val();
var div_id = $("#division_list").val();
var tot_thf=0;
var tot_emi=0;
var tot_int=0;
var tot_ins=0;
var total=0;      
var row_tot=0;
var grand_tot=0;


$("#div_id").val(div_id);
$("#mon_yr").val(mm_yy);

urlstr =base_url + "get_ReceiptMemberData";
var url = urlstr.replace("undefined","");
    $.ajax({
        url: url+"?mm_yy="+mm_yy+"&div_id="+div_id,
        dataType: 'JSON',
        success:function (response) 
        {
        //  console.log(response);
            var len = response.length;
            //console.log(len);
          var rw=1;
          var tr_str;
$("#crcpt_tbl tbody").empty();


 for(var i=0; i<len; i++){
  var mem_id = response[i].mem_id;
  var mem_name = response[i].mem_name;
  //  console.log(mem_name);
        var thf_mon= response[i].thrift;
        var emi_mon=response[i].principle;
        var int_mon=response[i].interest;
        var ins_mon=response[i].insurance;
        var oth_mon=response[i].others;

        var mmyy=response[i].mmyy;
        //echo $intrest_mon;
        tot_thf=tot_thf+thf_mon;
        tot_emi=tot_emi+emi_mon;
        tot_int=tot_int+int_mon;
        tot_ins=tot_ins+ins_mon;
        row_tot=thf_mon+emi_mon+int_mon+ins_mon+oth_mon;        
    tr_str +='<tr>'+
        '<td>'+ rw + '</td>'+

//        '<td>'+ mem_id + ' - ' + mem_name +'</td>'+

'<td><input name="mem_id" style="text-align:left;" value="'+ mem_id + '" class="form-control"></td>'+
        '<td><input style="text-align:left;" name="mem_name" value="'+ mem_name+'" readonly class="form-control">'+  
        '<td><input style="text-align:right;" class="form-control thrift" onfocus="getCalcThf('+ i +')" onkeyup="getCalcThf('+ i + ')" value="'+ thf_mon.toFixed(2) +'"  id="thrift'+ i +'" name="thrift"></td>'+
        '<td><input style="text-align:right;" class="form-control loan" onfocus="getCalcLoan('+ i +')" onkeyup="getCalcLoan('+ i + ')" value="'+ emi_mon.toFixed(2) +'"  id="loan'+ i +'" name="surety"></td>'+
        '<td><input style="text-align:right;" class="form-control interest" onfocus="getCalcInterest('+ i +')" onkeyup="getCalcInterest('+ i + ')" value="'+ int_mon.toFixed(2) +'"  id="interest'+ i +'" name="interest"></td>'+
'<td><input style="text-align:right;" class="form-control insurance" onfocus="getCalcInsu('+ i +')" onkeyup="getCalcInsu('+ i + ')" value="'+ ins_mon.toFixed(2) +'"  id="insurance'+ i +'" name="insurance"></td>'+
'<td><input style="text-align:right;" class="form-control others" onfocus="getCalcOth('+ i +')" onkeyup="getCalcOth('+ i + ')" value="'+ oth_mon.toFixed(2) +'"  id="others'+ i +'" name="others"></td>'+
'<td><input readonly style="text-align:right;" class="form-control row_tot" value="'+ row_tot.toFixed(2) +'"  id="row_tot'+ i +'" name="rowtotal"></td>'+

'<td><input style="text-align:center;" class="form-control mmyy" readonly value="'+ mmyy +'"  id="mmyy'+ i +'" name="mmyy"></td>'+
            '</tr>';

rw++;
 
}
 $("#crcpt_tbl tbody").append(tr_str);

$("#tot_thf").val(tot_thf.toFixed(2));
$("#tot_emi").val(tot_emi.toFixed(2));
$("#tot_int").val(tot_int.toFixed(2));
$("#tot_ins").val(tot_ins.toFixed(2));
$("#tot_oth").val(tot_oth.toFixed(2));
grand_tot=tot_thf+tot_emi+tot_int+tot_ins+tot_oth;
$("#tot_grand").val(grand_tot.toFixed(2));

        }

});


});




$("#membername").typeahead({
    items: 4,
    source: function(request, response) {
        $.ajax({
            url: url, // "/Home/GetBusinessDesriptions",
            dataType: "json",
            data: { qry:request},

            success: function (data) {
                response(data);
            }
        });
    },
    autoSelect: true,
    displayText: function (item) {
                $('#memberNumber').val(item.member_id);
      
        return item.member_name;
    }
});






$('#addDmd').on('click',function(){
    var urlstr = base_url + 'fetchItemMastData';
var url = urlstr.replace("undefined","");

    $.ajax({
        url: url,
//        method:"POST",
 //       data:{ id: id },
        //dataType:"json",
        success:function (response) 
        {
           // console.log(response);
            $("#additemaccountTbl").html(response);
}
});


//getCalc($('#additemaccountTbl').find('.calc'));

});


 
//$("body").on('keyup', ".calc", calculate);  



//console.log('demand rep');

$("#search_btn").on("click",function(){



    var urlstr = base_url + 'getReceiptMainData';
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
            { "data": "mmyyyy" },
            { "data": "nom" },
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





$('#search').on('click',function() {

    console.log('Search Clicked');
    var urlstr = base_url + 'fetchDemandData';
 var url = urlstr.replace("undefined","");
 var month_year= $('#monthYear').val();
 var mm_yy = month_year.replace("-","");
console.log(month_year);
var system_name = "<?php echo $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;?>" ;

//console.log('fmDate ' + fmDate + ' toDate ' + toDate);
//$("#manageReceiptTable").dataTable().fnDestroy();
 manageReceiptTable = $("#manageReceiptTable").dataTable().fnDestroy();
 manageReceiptTable =  $('#manageReceiptTable').DataTable( 
  {
    "ajax"    : url+'?month_year=' + mm_yy, //+ 'fetchReceiptSearch',
   
"columns": [
            { "data": "division_name" },
            { "data": "member_id" },
            { "data": "member_name" },
            { "data": "designation" },
            { "data": "section_name" },
            { "data": "insurance_amount", render: $.fn.dataTable.render.number(',', '.', 2, '')  },
            { "data": "thrift_amount", render: $.fn.dataTable.render.number(',', '.', 2, '')  },
            { "data": "principle_amount", render: $.fn.dataTable.render.number(',', '.', 2, '')  },
            { "data": "interest_amount", render: $.fn.dataTable.render.number(',', '.', 2, '')  },
        //    { "data": "misc_amount" },
            { "data": "total_amount", render: $.fn.dataTable.render.number(',', '.', 2, '')  },
            { "data": "action" }
        ],

'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
      "width": "4%"
 },
 {
      "targets": [5,6,7,8,9],
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

 title: system_name + '\n' + 'Demand Report for the month of ' +$('#monthYear').val(),
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
          
            orientation: 'portrait', // 'landscape',


            customize: function (doc) {
                  var rowCount = doc.content[1].table.body.length;
for (i = 1; i < rowCount; i++) {
//doc.content[1].table.body[i][5].alignment = 'right';
//doc.content[1].table.body[i][6].alignment = 'right';
doc.content[1].table.body[i][5].alignment = 'right';
doc.content[1].table.body[i][6].alignment = 'right';
doc.content[1].table.body[i][7].alignment = 'right';
doc.content[1].table.body[i][8].alignment = 'right';
doc.content[1].table.body[i][9].alignment = 'right';
};


      doc.pageMargins = [20,10,10,10];
        doc.defaultStyle.fontSize = 7;
        doc.styles.tableHeader.fontSize = 8;
        doc.styles.title.fontSize = 10; 
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();

      doc['footer']=(function(page, pages) {
            return {
                columns: [
                    'Demand Report for the month of ' +$('#monthYear').val(),
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
      }

        ]


}); 
    
   


});


$("#monthYear").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});




$("#createNewDemand").unbind('submit').bind('submit', function() {
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
                        $("#add-receipt-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#add-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


$("#createNewDemand").trigger("reset");
manageReceiptTable.ajax.reload(null, false);
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




var calculate = function addCalc()
{
    var total =0;

    $('.calc').each(function() {
        total+= Number($(this).val());
    });
    console.log(total);
$('#additemaccountTbl').find('#totAmt').val(total);
}




function myCalc()
{
 
 var thrift_amt = document.getElementById('editthrift_amt').value;
  var principle_amt = document.getElementById('editprinciple_amt').value; 
    var interest_amt = document.getElementById('editinterest_amt').value; 
    var insurance_amt = document.getElementById('editinsurance_amt').value; 
    var misc_amt = document.getElementById('editmisc_amt').value; 
var tot_amt  = parseFloat(thrift_amt)+parseFloat(principle_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(misc_amt);
$('#tot_amt').val(tot_amt);


/*
var thrift = $('#show-edit-receipt-result').find('#editthrift_amt').val();
var principal = $('#editprinciple_amt').val();
var interest = $('#editinterest_amt').val();
var tot_amt = parseFloat(thrift)+parseFloat(principal)+parseFloat(interest);
*/
//console.log(tot_amt);
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
