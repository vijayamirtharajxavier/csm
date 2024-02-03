
<?php 
$system_name = $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('soc_settings', array('type' => 'system_title'))->row()->description;
?>

<!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                <div id="delete-demand-message"  style="color: white;font-weight: bold;"></div>

           <div class="panel panel-info">

                <div class="panel-heading"> <i class="fa fa-list"></i> All Demand
                
                 <?php if ($this->session->userdata('role') == 'admin'): ?>
                 
                    <a href="" id="addDmd" class="btn btn-info btn-sm pull-right"  data-toggle="modal" data-target="#modalAddDemand"><i class="fa fa-plus"></i>&nbsp;New Demand</a> &nbsp;
                <?php else: ?>
                    <!-- check logged user role permissions -->

                    <?php if(check_power(1)):?>
                        <a href="<?php echo base_url('admin/userhome') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp;New User</a>
                    <?php endif; ?>
                <?php endif ?>
                
                </div>

                        <div class="white-box">
                            <h3 class="box-title m-b-0">Monthly Demand / Recover Report</h3>


                            <div class="pull-right">
                                <label>DIVISION</label>
                                <select id="divisionlist"  class="custom-select col-6 form-control"></select>
                                <label>Select a Month</label>  
                            <input id="monthYear" name="monthYear">
                            <button id="search_btn" type="button" class="btn btn-primary btn-rounded">Search</button>
                            </div>
                            
                            <hr>
                            <div class="table-responsive">
                                <table id="manageDemandTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>DIVISION</th>
                                            <th>DMD DATE</th>
                                            <th>DMD MONTH </th>
                                            <th>NO MEMBERS</th>
                                            <th>TOTAL</th>
                                            <th>FIN.YEAR</th>
                                            <th style="width: 130px;">ACTION</th>
                                            
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
<div id="modalAddDemand" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Demand</h4>
      </div>
      <div id="add-demand-message" style="color: white;font-weight: bold;"></div>

      <form action="createDemand" method="post" id="createNewDemand">
      <div class="modal-body">

    <div class="row form-group">
        
        <div class="col-md-12">
        <div class="col-md-6">
              
            Month <input id="month_Year" placeholder="Select a Month" class="month_Year" name="month_Year" required>
        </div>
            <div class="col-md-6">
            Division <select id="division_list" class="custom-select form-control division_list" style="width:200px;"></select>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
        
<?php  
$csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
        );
?>

<!--        <span><button type="button" id="btn_load" class="pull-right btn btn-primary btn-circle"><i class="fa fa-reorder"></i></button></span>-->
    </div> </div>
        </div>
    <div class="card">

    <div class="resposive" style="height: 405px; overflow:auto">
        <div id="dmdTbl"  style="height: 90%; overflow:auto">

<input type="text" hidden id="mon_yr" name="mon_yr">
<input type="text" hidden id="div_id" name="div_id">

<table id="dmd_tbl" style="white-space:nowrap;">
    <thead><th>#</th><th>Member#</th><th>Member Name</th><th>Thrift</th><th>Loan</th><th>Interest</th><th>Insurance</th><th>MMYYYY</th></thead><tbody></tbody>


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
<div id="edit-demand-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Demand</h4>
      </div>
      <div id="update-demand-message" style="color: white;font-weight: bold;"></div>

      <form action="createDemand" method="post" id="createNewDemand">
      <div class="modal-body">

    <div class="row form-group">
  <!--      
        <div class="col-md-12">
        <div class="col-md-6">
              
            Month <input id="month_Year" placeholder="Select a Month" class="month_Year" name="month_Year" required>
        </div>
            <div class="col-md-6">
            Division <select id="division_list" class="custom-select form-control division_list" style="width:200px;"></select>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
        
 </div> 
</div>
-->
<?php  
$csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
        );
?>

        </div>
    <div class="card">

    <div class="resposive" style="height: 405px; overflow:auto">
        <div id="editdmdTbl"  style="height: 90%; overflow:auto">

<input type="text" hidden id="mon_yr" name="mon_yr">
<input type="text" hidden id="div_id" name="div_id">
<input type="text" hidden id="rec_id" name="rec_id">

<table id="editdmd_tbl" style="white-space:nowrap;">
    <thead><th>#</th><th>Member#</th><th>Member Name</th><th>Thrift</th><th>Loan</th><th>Interest</th><th>Insurance</th><th>MMYYYY</th></thead><tbody></tbody>


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
#dmd_tbl th {
text-align: center;
  background: green;
  color: white;
  position: sticky;
  top: 0; /* Don't forget this, required for the stickiness */
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}

#editdmd_tbl th {
text-align: center;
  background: green;
  color: white;
  position: sticky;
  top: 0; /* Don't forget this, required for the stickiness */
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}

</style>

<script>
var manageDemandTable;
var calculated_total_sum = 0;
var sum_thrift=0;
var sum_loan=0;
var sum_interest=0;
var sum_insurance=0;
var total=0;      
var grand_tot=0;
var ins_mon=0;
var tot_thf=0;
var tot_emi=0;
var tot_int=0;
var tot_ins=0;



function deleteTransid(id = null) 
{
if(id) 
{
 if (confirm("Are you sure?")) {
        // your deletion code

urlstr =base_url + "deleteDemandDatabyid";
var url = urlstr.replace("undefined","");
    $.ajax({
        url: url+"?id="+id,
        dataType: 'JSON',
        success:function (response) 
        {
          
              console.log(response);
                if(response.success == true) {                      
                  
                        $("#delete-demand-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#delete-demand-message").fadeTo(3000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});
//$("#addReceiptForm").trigger("reset");
manageDemandTable.ajax.reload(null, false);

}
    else
    {
                        $("#delete-demand-message").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');
$("#add-demand-message").fadeTo(2000, 500).slideUp(500, function(){
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
    console.log('UpdateDemand' + id);
//var divid=$("#div_id").val(div_id);
//var $("#mon_yr").val(mm_yy);
$("#rec_id").val(id);
urlstr =base_url + "get_editDemandData";
var url = urlstr.replace("undefined","");
    $.ajax({
        url: url+"?id="+id,
        dataType: 'JSON',
        success:function (response) 
        {
          console.log(response);
            var len = response.length;
            //console.log(len);
          var rw=1;
          var tr_str;
$("#editdmd_tbl tbody").empty();


 for(var i=0; i<len; i++){
  var mem_id = response[i].member_id;
  var mem_name = response[i].member_name;
  //  console.log(mem_name);
        var recid = response[i].id;
        var ethf_mon= parseFloat(response[i].thrift);
        var eemi_mon=parseFloat(response[i].principle);
        var eint_mon=parseFloat(response[i].interest);
        var eins_mon=parseFloat(response[i].insurance);
        var emmyy=response[i].mmyyyy;
        //echo $intrest_mon;
        tot_thf=tot_thf+ethf_mon;
        tot_emi=tot_emi+eemi_mon;
        tot_int=tot_int+eint_mon;
        tot_ins=tot_ins+eins_mon;
                
    tr_str +='<tr>'+
        '<td>'+ rw + '</td>'+

      // '<td><input style="width:80px"; readonly value="'+ recid +'" name="id" id="id'+ i +'"></td>'+
'<td><input name="mem_id" style="text-align:left;" value="'+ mem_id + '" class="form-control"></td>'+
        '<td><input style="text-align:left;" name="mem_name" value="'+ mem_name+'" readonly class="form-control">'+  
        '<td><input style="text-align:right;" class="form-control thrift" onfocus="getCalcEThf('+ i +')" onkeyup="getCalcEThf('+ i + ')" value="'+ ethf_mon.toFixed(2) +'"  id="thrift'+ i +'" name="thrift"></td>'+
        '<td><input style="text-align:right;" class="form-control loan" onfocus="getCalcELoan('+ i +')" onkeyup="getCalcELoan('+ i + ')" value="'+ eemi_mon.toFixed(2) +'"  id="loan'+ i +'" name="principle"></td>'+
        '<td><input style="text-align:right;" class="form-control interest" onfocus="getCalcEInterest('+ i +')" onkeyup="getCalcEInterest('+ i + ')" value="'+ eint_mon.toFixed(2) +'"  id="interest'+ i +'" name="interest"></td>'+
'<td><input style="text-align:right;" class="form-control insurance" onfocus="getCalcEInsu('+ i +')" onkeyup="getCalcEInsu('+ i + ')" value="'+ eins_mon.toFixed(2) +'"  id="insurance'+ i +'" name="insurance"></td>'+
'<td><input style="text-align:center;" class="form-control mmyy" readonly value="'+ emmyy +'"  id="mmyy'+ i +'" name="mmyy"></td>'+
            '</tr>';

rw++;
 
}
 $("#editdmd_tbl tbody").append(tr_str);

$("#etot_thf").val(tot_thf.toFixed(2));
$("#etot_emi").val(tot_emi.toFixed(2));
$("#etot_int").val(tot_int.toFixed(2));
$("#etot_ins").val(tot_ins.toFixed(2));
grand_tot=tot_thf+tot_emi+tot_int+tot_ins;
$("#etot_grand").val(grand_tot.toFixed(2));

}

});



}



function getCalcThf(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var thrift_amt =  $('#dmdTbl').find("#thrift"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(thrift_amt);

calThfSum();
}

function getCalcLoan(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var loan_amt =  $('#dmdTbl').find("#loan"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(loan_amt);

calLoanSum();
}

function getCalcInterest(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var interest_amt =  $('#dmdTbl').find("#interest"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(interest_amt);

calIntSum();
}

function getCalcInsu(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var insurance_amt =  $('#dmdTbl').find("#insurance"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(insurance_amt);

calInsSum();
}


function getCalcEThf(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var thrift_amt =  $('#editdmdTbl').find("#thrift"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(thrift_amt);

calThfESum();
}

function getCalcELoan(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var loan_amt =  $('#editdmdTbl').find("#loan"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(loan_amt);

calLoanESum();
}

function getCalcEInterest(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var interest_amt =  $('#editdmdTbl').find("#interest"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(interest_amt);

calIntESum();
}

function getCalcEInsu(rw) {
  console.log('Row Number ='+rw);
    count = rw;
    
    var insurance_amt =  $('#editdmdTbl').find("#insurance"+count).val();
//    var dis =     $('#show-edit-invoice-result').find("#editdiscpc"+count).val();
console.log(insurance_amt);

calInsESum();
}


//Edit

function calThfESum()
{
sum_thrift=0
          $("#editdmd_tbl .thrift").each(function () {
           var get_thf = $(this).val();
           console.log(get_thf);
           if ($.isNumeric(get_thf)) {
              sum_thrift += parseFloat(get_thf);
              }                  
            });
       console.log(sum_thrift);
      // $('#dmdTbl').find("#dmd_tbl tfoot #tot_thf").html(sum_thrift);
       $(".etot_thf").val(sum_thrift).trigger('change');
     //  grand_tot=grand_tot+sum_thrift;
//console.log(grand_tot);
sum_thrift = 0;
$('#etot_thf').trigger('change');
$('#etot_emi').trigger('change');
$('#etot_int').trigger('change');
$('#etot_ins').trigger('change');

}
function calLoanESum()

{
    sum_loan=0;
          $("#editdmd_tbl .loan").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_loan += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_loan);
      // $('#dmdTbl').find("#dmd_tbl tfoot #tot_emi").html(sum_loan);
       $(".etot_emi").val(sum_loan).trigger('change');
       //grand_tot=grand_tot+sum_loan;
sum_loan= 0;
$('#etot_thf').trigger('change');
$('#etot_emi').trigger('change');
$('#etot_int').trigger('change');
$('#etot_ins').trigger('change');

//console.log(grand_tot);
}

function calIntESum()
{
sum_interest=0;
          $("#editdmd_tbl .interest").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_interest += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_interest);
       //$('#dmdTbl').find("#dmd_tbl tfoot #tot_int").html(sum_interest);
       $(".etot_int").val(sum_interest).trigger('change');
//grand_tot=grand_tot+sum_interest;
$('#etot_thf').trigger('change');
$('#etot_emi').trigger('change');
$('#etot_int').trigger('change');
$('#etot_ins').trigger('change');

sum_interest = 0;
//console.log(grand_tot);

}


function calInsESum()
{
    sum_insurance=0;
          $("#editdmd_tbl .insurance").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_insurance += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_insurance);
       //$('#dmdTbl').find("#dmd_tbl tfoot #tot_ins").html(sum_insurance);
       $(".etot_ins").val(sum_insurance);
//grand_tot=grand_tot+sum_insurance;
$('#etot_thf').trigger('change');
$('#etot_emi').trigger('change');
$('#etot_int').trigger('change');
$('#etot_ins').trigger('change');

sum_insurance = 0;
//console.log(grand_tot);
}



///Add

function calThfSum()
{
sum_thrift=0
          $("#dmd_tbl .thrift").each(function () {
           var get_thf = $(this).val();
           console.log(get_thf);
           if ($.isNumeric(get_thf)) {
              sum_thrift += parseFloat(get_thf);
              }                  
            });
       console.log(sum_thrift);
      // $('#dmdTbl').find("#dmd_tbl tfoot #tot_thf").html(sum_thrift);
       $(".tot_thf").val(sum_thrift).trigger('change');
     //  grand_tot=grand_tot+sum_thrift;
//console.log(grand_tot);
sum_thrift = 0;
$('#tot_thf').trigger('change');
$('#tot_emi').trigger('change');
$('#tot_int').trigger('change');
$('#tot_ins').trigger('change');

}
function calLoanSum()

{
    sum_loan=0;
          $("#dmd_tbl .loan").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_loan += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_loan);
      // $('#dmdTbl').find("#dmd_tbl tfoot #tot_emi").html(sum_loan);
       $(".tot_emi").val(sum_loan).trigger('change');
       //grand_tot=grand_tot+sum_loan;
sum_loan= 0;
$('#tot_thf').trigger('change');
$('#tot_emi').trigger('change');
$('#tot_int').trigger('change');
$('#tot_ins').trigger('change');

//console.log(grand_tot);
}

function calIntSum()
{
sum_interest=0;
          $("#dmd_tbl .interest").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_interest += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_interest);
       //$('#dmdTbl').find("#dmd_tbl tfoot #tot_int").html(sum_interest);
       $(".tot_int").val(sum_interest).trigger('change');
//grand_tot=grand_tot+sum_interest;
$('#tot_thf').trigger('change');
$('#tot_emi').trigger('change');
$('#tot_int').trigger('change');
$('#tot_ins').trigger('change');

sum_interest = 0;
//console.log(grand_tot);

}


function calInsSum()
{
    sum_insurance=0;
          $("#dmd_tbl .insurance").each(function () {
           var get_textbox_value = $(this).val();
           console.log(get_textbox_value);
           if ($.isNumeric(get_textbox_value)) {
              sum_insurance += parseFloat(get_textbox_value);
              }                  
            });
       console.log(sum_insurance);
       //$('#dmdTbl').find("#dmd_tbl tfoot #tot_ins").html(sum_insurance);
       $(".tot_ins").val(sum_insurance);
//grand_tot=grand_tot+sum_insurance;
$('#tot_thf').trigger('change');
$('#tot_emi').trigger('change');
$('#tot_int').trigger('change');
$('#tot_ins').trigger('change');

sum_insurance = 0;
//console.log(grand_tot);
}

$(document).ready(function(){


$("#month_Year").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});

$('#tot_ins').change(function() {
    console.log("It's Changed!");
var totthf = parseFloat($(".tot_thf").val());
var totemi = parseFloat($(".tot_emi").val());
var totint = parseFloat($(".tot_int").val());
var totins = parseFloat($(".tot_ins").val());
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins);
$("#tot_grand").val(grand_tot);
console.log(grand_tot);    
});    
    
$('#etot_ins').change(function() {
    console.log("It's Changed!");
var totthf = parseFloat($(".etot_thf").val());
var totemi = parseFloat($(".etot_emi").val());
var totint = parseFloat($(".etot_int").val());
var totins = parseFloat($(".etot_ins").val());
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins);
$("#etot_grand").val(grand_tot);
console.log(grand_tot);    
});    
    


$('#tot_emi').change(function() {

//$(".tot_emi").on('change',function(){
var totemi = $(".tot_emi").val();
var totthf = $(".tot_thf").val();
var totint = $(".tot_int").val();
var totins = $(".tot_ins").val();
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins);
$("#tot_grand").val(grand_tot);
});


$('#etot_emi').change(function() {

//$(".tot_emi").on('change',function(){
var totemi = $(".etot_emi").val();
var totthf = $(".etot_thf").val();
var totint = $(".etot_int").val();
var totins = $(".etot_ins").val();
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins);
$("#etot_grand").val(grand_tot);
});


$('#tot_int').change(function() {
var totint = $(".tot_int").val();
var totthf = $(".tot_thf").val();
var totemi = $(".tot_emi").val();
var totins = $(".tot_ins").val();
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins);
$("#tot_grand").val(grand_tot);
});

$('#etot_int').change(function() {
var totint = $(".etot_int").val();
var totthf = $(".etot_thf").val();
var totemi = $(".etot_emi").val();
var totins = $(".etot_ins").val();
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins);
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
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins);
$("#tot_grand").val(grand_tot);
});


$('input #etot_ins').bind('change',function(){
//$('#tot_ins').change(function() {
console.log('onchange');
//$(".tot_ins").on('change',function(){
var totins = $(".etot_ins").val();
var totthf = $(".etot_thf").val();
var totint = $(".etot_int").val();
var totemi = $(".etot_emi").val();
grand_tot=0;
grand_tot=parseFloat(totthf+totemi+totint+totins);
$("#etot_grand").val(grand_tot);
});



$("#update_btn").on("click",function(){
  var newFormData = [];
var urlstr = base_url + 'updateDemandData';
var url = urlstr.replace("undefined","");
var rec_id=$("#rec_id").val();
//var cct = $.cookie('csrf_cookie_name');
    var CFG = {
        url: '<?php echo $this->config->item('base_url');?>',
        token: '<?php echo $this->security->get_csrf_token_name(); ?>'};
    var cct = "<?php echo $csrf ['hash']; ?>";

  jQuery('#editdmd_tbl tr:not(:first)').each(function(i) {
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
    data:{recid:rec_id,json:JSON.stringify(newFormData),'<?php echo $this->security->get_csrf_token_name(); ?>': cct},
    method:"post",
    dataType:"json",
    success:function(response)
    {
              console.log(response);
                if(response.success == true) {                      
                  
                        $("#update-demand-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#update-demand-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});
}
    else
    {
                        $("#update-demand-message").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');
$("#update-demand-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


    }

    }
});




});


$("#save_btn").on("click",function(){
  var newFormData = [];
var urlstr = base_url + 'insertDemandData';
var url = urlstr.replace("undefined","");
var div_id = document.getElementById("div_id").value;
var mm_yy = document.getElementById("mon_yr").value;

//  document.getElementById('div_id');
//$("#division_list").val();
//var mm_yy =  jQuery('#mon_yr').val();
//$("#month_Year").val();
console.log( div_id);
//var cct = $.cookie('csrf_cookie_name');
    var CFG = {
        url: '<?php echo $this->config->item('base_url');?>',
        token: '<?php echo $this->security->get_csrf_token_name(); ?>'};
    var cct = "<?php echo $csrf ['hash']; ?>";

  jQuery('#dmd_tbl tr:not(:first)').each(function(i) {
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
    data:{mm_yy:mm_yy,div_id:div_id, json:JSON.stringify(newFormData),'<?php echo $this->security->get_csrf_token_name(); ?>': cct},
    method:"post",
    dataType:"json",
    success:function(response)
    {
              console.log(response);
                if(response.success == true) {                      
                  
                        $("#add-demand-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


$("#dmd_tbl tbody").empty();
$("division_list").val(0);
  
$("#add-demand-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});
}
    else
    {
                        $("#add-demand-message").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');
$("#add-demand-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


    }
    
}

    
});


});





var urlstr = base_url + 'fetchDivision';
var url = urlstr.replace("undefined","");

    $("#divisionlist").load(url);
$('#divisionlist').select2();


    $("#division_list").load(url);
//$('#division_list').select2();

 $("#division_list").select2({
    dropdownParent: $("#modalAddDemand") 
  });


    var urlstr = base_url + 'fetchMemberlist';
var url = urlstr.replace("undefined","");

var memberNames = new Array();
var memberIds = new Object();
var tbl='';








$("#division_list").on('change',function(){
console.log('clicked');

var mm_yy= $("#month_Year").val();
var div_id = $("#division_list").val();
var tot_thf=0;
var tot_emi=0;
var tot_int=0;
var tot_ins=0;
var total=0;      
var grand_tot=0;


$("#div_id").val(div_id);
$("#mon_yr").val(mm_yy);

urlstr =base_url + "get_DemandData";
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
$("#dmd_tbl tbody").empty();


 for(var i=0; i<len; i++){
  var mem_id = response[i].mem_id;
  var mem_name = response[i].mem_name;
  //  console.log(mem_name);
        var thf_mon= response[i].thf_mon;
        var emi_mon=response[i].emi_mon;
        var int_mon=response[i].int_mon;
        var ins_mon=response[i].ins_mon;
        var mmyy=response[i].mmyy;
        //echo $intrest_mon;
        tot_thf=tot_thf+thf_mon;
        tot_emi=tot_emi+emi_mon;
        tot_int=tot_int+int_mon;
        tot_ins=tot_ins+ins_mon;
                
    tr_str +='<tr>'+
        '<td>'+ rw + '</td>'+

//        '<td>'+ mem_id + ' - ' + mem_name +'</td>'+
'<td><input name="mem_id" style="text-align:left;" value="'+ mem_id + '" class="form-control"></td>'+
        '<td><input style="text-align:left;" name="mem_name" value="'+ mem_name+'" readonly class="form-control">'+  
        '<td><input style="text-align:right;" class="form-control thrift" onfocus="getCalcThf('+ i +')" onkeyup="getCalcThf('+ i + ')" value="'+ thf_mon.toFixed(2) +'"  id="thrift'+ i +'" name="thrift"></td>'+
        '<td><input style="text-align:right;" class="form-control loan" onfocus="getCalcLoan('+ i +')" onkeyup="getCalcLoan('+ i + ')" value="'+ emi_mon.toFixed(2) +'"  id="loan'+ i +'" name="surety"></td>'+
        '<td><input style="text-align:right;" class="form-control interest" onfocus="getCalcInterest('+ i +')" onkeyup="getCalcInterest('+ i + ')" value="'+ int_mon.toFixed(2) +'"  id="interest'+ i +'" name="interest"></td>'+
'<td><input style="text-align:right;" class="form-control insurance" onfocus="getCalcInsu('+ i +')" onkeyup="getCalcInsu('+ i + ')" value="'+ ins_mon.toFixed(2) +'"  id="insurance'+ i +'" name="insurance"></td>'+
'<td><input style="text-align:center;" class="form-control mmyy" readonly value="'+ mmyy +'"  id="mmyy'+ i +'" name="mmyy"></td>'+
            '</tr>';

rw++;
 
}
 $("#dmd_tbl tbody").append(tr_str);

$("#tot_thf").val(tot_thf.toFixed(2));
$("#tot_emi").val(tot_emi.toFixed(2));
$("#tot_int").val(tot_int.toFixed(2));
$("#tot_ins").val(tot_ins.toFixed(2));
grand_tot=tot_thf+tot_emi+tot_int+tot_ins;
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



    var urlstr = base_url + 'getDemandMainData';
var url = urlstr.replace("undefined","");

 manageDemandTable = $('#manageDemandTable').DataTable( {
        "ajax": url, //'../ajax/data/arrays.txt'
        "destroy":true, 
        "dataSrc": "data",
    "language": {
      "emptyTable": "No data available in table"
    },

"columns": [
            { "data": "division_name" },
            { "data": "demand_date" },
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
//$("#manageDemandTable").dataTable().fnDestroy();
 manageDemandTable = $("#manageDemandTable").dataTable().fnDestroy();
 manageDemandTable =  $('#manageDemandTable').DataTable( 
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
                        $("#add-demand-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#add-demand-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


$("#createNewDemand").trigger("reset");
manageDemandTable.ajax.reload(null, false);
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



function updateDemands(id = null) 
{
    if(id) {
    
invflag=1;
        //console.log(id);
var furl;
//var invNo = id ;
 // furl = "invoice/fetchInvoiceDataForUpdate/";
    var urlstr = base_url + 'fetchDemandUpdate';
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
            $("#show-edit-demand-result").html(response);
 var $outp = response;          
 //console.log($outp);

            $("#editmemNo").val(id);
            
                //$("#editTotalAmount").attr('disabled', true);
                /*SUBMIT FORM*/
                
                $("#editDemandForm").unbind('submit').bind('submit', function() {                  
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
                                $("#edit-demand-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');    
                                manageDemandTable.ajax.reload(null, false);  
$("#edit-demand-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});             
                                
                                $('.form-group').removeClass('has-error').removeClass('has-success');
                                $('.text-danger').remove(); 
                               // $("#addSalesInvoiceTable:not(:first)").remove();                                
                                //createTypeahead($td.find('input.edititemSearch'));
                                //manageExpeneseTable.ajax.reload(null, false);
                              //  manageDemandTable.ajax.reload(null, false);
                                                                
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
         
//manageDemandTable.ajax.reload(null, false);
                            //console.log(response);
                            if(response.success === true) {
                            console.log(response);    
                            manageDemandTable.ajax.reload(null, false);                  
                                $("#delete-Demand-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');

    $('#deleteModal').modal('hide');
                                      
$("#delete-Demand-message").fadeTo(2000, 500).slideUp(500, function(){
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
  var principal_amt = document.getElementById('editprinciple_amt').value; 
    var interest_amt = document.getElementById('editinterest_amt').value; 
    var insurance_amt = document.getElementById('editinsurance_amt').value; 
    var misc_amt = document.getElementById('editmisc_amt').value; 
var tot_amt  = parseFloat(thrift_amt)+parseFloat(principal_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(misc_amt);
$('#tot_amt').val(tot_amt);


/*
var thrift = $('#show-edit-demand-result').find('#editthrift_amt').val();
var principal = $('#editprincipal_amt').val();
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
