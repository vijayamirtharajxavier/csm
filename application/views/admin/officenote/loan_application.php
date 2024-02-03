





<div class="col-md-12">
    <div id="add-loanapp-message" class="pull-right"></div>

<div class="panel panel-info">
                            <div class="panel-heading"> Loan Application
 <!--          
  <a href="" class="btn btn-danger btn-rounded  pull-right" style="margin-top: -10px;" data-toggle="modal" data-target="#modalPayslip">
    Payslip Details</a><span class="pull-right">
-->

</div>
<div class="col-md-7">
<div class="row">

<form action="createLApplication" method="post" class="form-horizontal" id="createLoanApplicationForm">
<div class="col-md-3">
   <div class="form-group">
       <input type="text" id="addupdflag" name="addupdflag" hidden>
       <input type="text" id="recid" name="recid" hidden>
  <label class="control-label">Appln #</label>
  <input class="form-control" readonly type="text" value="<?php echo $app_number ?>"  id="appNumber" name="appNumber">
  </div>      
</div>

<div class="col-md-6">
<div class="form-group">
<label>Member#</label>
    <select class="form-control" style="width: 100%;" id="memberNumber" name="memberNumber" required></select>
</div>    
</div>

<div class="col-md-3">
<div class="form-group">
<label>Father / Spouse </label>
    <input type="text" class="form-control" placeholder="
Father / Spouse Name
" name="fahuName" id="fahuName">
    
</div>    
</div> 
<!--
<div class="col-md-3">
<div class="form-group">
<label>Surety Member#</label>
    <select class="form-control" id="smemberNumber"  name="smemberNumber" required></select>
    
</div>    
</div> -->
</div>

<div class="row">
<div class="col-md-2">
    <div class="form-group">
                                 <label class="control-label">DOB</label>
                           
                                <input type="text" class="form-control" id="dob" name="dob"  readonly>


    </div>
</div>
<div class="col-md-2"><div class="form-group">
             <label class="control-label">Age</label>
                                                    
                                                
                                                        <input type="text" id="age" placeholder="Age" name="age" class="form-control" readonly>
                                               
</div></div>
<div class="col-md-3"><div class="form-group">
             <label class="control-label">Date of Join </label>
                                                
                                                        <input type="text" id="doj" placeholder="DoJ" name="doj" class="form-control" readonly>

</div></div>
<div class="col-md-2"><div class="form-group">
           <label class="control-label">NOYS</label>
                                                
                                                        <input type="text" id="nys" placeholder="NyS" name="nys" class="form-control" readonly>
                                             
</div></div>
<div class="col-md-3"><div class="form-group">
       <label class="control-label">Remain Serv.</label>
                                                        <input type="text" id="rys" name="rys" placeholder="RyS" class="form-control" readonly>
                                                     
</div></div>


</div>
<!--
<div class="row">


<div class="col-md-3">
    <div class="form-group">
                                                        <label class="control-label">Designation</label>
                                                    <select class="custom-select col-6 form-control" id="designation" name="designation">
                                                    <option selected>Choose...</option>    
                                                    </select>
                                                     
</div>
</div>


    <div class="col-md-3">
        <div class="form-group">
            
                                                        <label>Street</label>
                                                        <input id="offStreet" placeholder="Street/Area"  autocomplete="off" name="offStreet" type="text" class="form-control">
            
        </div>

    </div>

<div class="col-md-2">
<div class="form-group">
                                                         <label>City</label>
                                                        <input id="offCity" placeholder="City" name="offCity" autocomplete="off"  type="text" class="form-control">
   

</div>
</div>

<div class="col-md-2">
    <div class="form-group">
          <label>State</label>
                                                        <input type="text" id="offState" placeholder="State" name="offState"  autocomplete="off" class="form-control">
                                                   
    </div>
</div>





<div class="col-md-2">
    <div class="form-group">
              <label>Post Code</label>
                                                        <input type="text" placeholder="Pincode" id="offPincode"  autocomplete="off" name="offPincode" class="form-control">
    </div>
</div>
</div>
-->
<div class="row">
    
                                        <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Purpose</label>
                                                        <input type="text" id="loanPurpose" autocomplete="off" name="loanPurpose" class="form-control" placeholder="Marriage / Education">
                                                  </div>      
                                                </div>      

                                               <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Loan Amount</label>
                                                        <input type="text" id="loanAmt" name="loanAmt" class="form-control typeahead" placeholder="0.00" autocomplete="off" style="text-align:right;" required>
                                                       <!-- <span class="help-block"> This is inline help </span> </div>-->
                                                </div>
                                                </div>

                                                <!--/span-->
                                               
                                               <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">N O I</label>
                                                        <input type="text" id="loanRepay" name="loanRepay" class="form-control "  autocomplete="off" placeholder="No of Ins"  style="text-align:right;" required>
                                                       <!-- <span class="help-block"> This is inline help </span> </div>-->
                                                </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">EMI</label>
                                                        <input autocomplete="off" type="text" id="loanInstallment" name="loanInstallment" class="form-control" placeholder="0.00"  style="text-align:right;"required >
                                                  </div>      
                                                </div>

                                               <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">R O I %</label>
                                                        <input type="text" id="roi" name="roi" class="form-control " placeholder="%" autocomplete="off" style="text-align:right;" required>
                                                       <!-- <span class="help-block"> This is inline help </span> </div>-->
                                                </div>
                                             </div>



</div>


</div>

    </div>  <!-- LeftSide Div -->

<!-- Right Side Table -->
<div class="col-md-5">

<div  class="table-responsive">
<table id="lapplnTable" class="table-condensed" > 
    <thead>
        <th>Action</th>
        <th>App#</th>
        <th>Mem#</th>
        <th>Mem Name</th>
        <th>Loan Amount</th>
        <th>Purpose of Loan</th>
        <th>Principle</th>
        <th>Payslip</th>
        <th>Status</th>
    </thead>
    <tbody>

    </tbody>
</table>
</div>

</div>































<div class="col-md-12">
    
<div class="col-md-4">
    <div class="form-group pull-left">
      <a href="" class="btn btn-info btn-rounded btn-lg pull-right" style="color:white; margin-top: -10px;" data-toggle="modal" data-target="#modalPayslip">
    Payslip Details</a>

</div>
</div>
<div class="col-md-8">

    <div class="form-group">
            <button type="submit" id="createAppn" class="btn btn-rounded btn-sm btn-success"> <i class="fa fa-check"></i> Save</button>
    
</div>
</div>
<form>

</div>




</div>


</div>

                                               
 
<div class="modal fade" id="modalPayslip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Payslip Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body" >
        <h2>Earnings</h2>
                                            <div class="col-md-4">
                                                <div class="input-group">
                         
                                                    <span class="input-group-addon">Basic Pay</span>
                                                    <input autocomplete="off" id="baspay" name="baspay" type="text" class="form-control earn" placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">D.A.</span>
                                                    <input id="da" name="da"  autocomplete="off"  type="text" class=" earn form-control" placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="input-group">
                         
                                                    <span class="input-group-addon">H.R.A</span>
                                                    <input id="hra" name="hra"  autocomplete="off"  type="text" class=" earn form-control"  placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Spl.Pay.</span>
                                                    <input id="splpay" name="splpay"  autocomplete="off"  type="text" class=" earn form-control"  placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                         
                                                    <span class="input-group-addon">I.R.</span>
                                                    <input id="irpay" name="irpay"  autocomplete="off"  type="text" class=" earn form-control" placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">M.A.</span>
                                                    <input id="mapay" name="mapay"  autocomplete="off"  type="text" class=" earn form-control"  placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>


        <h2>Deductions</h2>
                                            <div class="col-md-4">
                                                <div class="input-group">
                         
                                                    <span class="input-group-addon">GPF Sub.</span>
                                                    <input id="gpfsub"  autocomplete="off" name="gpfsub"  type="text" class="deduct form-control" placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">GPF Loan</span>
                                                    <input id="gpfloan" name="gpfloan"  autocomplete="off"  type="text" class="deduct form-control"  placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="input-group">
                         
                                                    <span class="input-group-addon">FBS</span>
                                                    <input id="fbs" name="fbs"  type="text"  autocomplete="off" class="deduct form-control" placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">F.A.</span>
                                                    <input id="fa" name="fa"  type="text"  autocomplete="off" class="deduct form-control"  placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                         
                                                    <span class="input-group-addon">H.B.A.</span>
                                                    <input id="hba" name="hba"  type="text"  autocomplete="off" class="deduct form-control" placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">C.A.</span>
                                                    <input id="ca" name="ca"  type="text"  autocomplete="off" class="deduct form-control"  placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">LIC</span>
                                                    <input id="lic" name="lic"  type="text" autocomplete="off"  class="deduct form-control"  placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Society Recov.</span>
                                                    <input id="socrec" name="socrec"  type="text" autocomplete="off"  class="deduct form-control"  placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Others</span>
                                                    <input id="other" name="other"  type="text" autocomplete="off"  class="deduct form-control"  placeholder="0.00" style="text-align:right;">
                                                </div>
                                            </div>


<h2>Total</h2>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Total Earnings</span>
                                                    <input id="totern" name="totern"  type="text" class="totern form-control"  placeholder="0.00" style="text-align:right;" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Total Recov.</span>
                                                    <input id="totded" name="totded"  type="text" class="form-control"  placeholder="0.00" style="text-align:right;" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Nett Pay</span>
                                                    <input id="netpay" name="netpay"  type="text" class="form-control"  placeholder="0.00" style="text-align:right;" readonly>
                                                </div>
                                            </div>

      </div>





    </div>
  </div>
                                
                                                <!--/span-->
                                            
                                            <!--/row-->
                                          
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                                <!--/span--
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <select class="form-control">
                                                            <option>--Select your Country--</option>
                                                            <option>India</option>
                                                            <option>Sri Lanka</option>
                                                            <option>USA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <--/span-->
                                                
                                            </div>


                                        




                                            </form>
                                    
                                </div>
                        
                            </div>
                             
                        </div>

                    </div>
                
                <!--./row-->


                <!-- .row -->


<style type="text/css">

input[type="text"], textarea {

  background-color : #56fcf4; 

}

#smemberNumber
{
    width: 100% !important;
}

table{
    white-space:nowrap;
}

</style>

<script type="text/javascript">
var managelapplnTable;       
var addupd_flag="0";
$("#addupdflag").val(addupd_flag);
window.base_url = <?php echo json_encode(base_url('admin/officenote/')); ?>;
var system_name = "<?php echo $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;?>" ;

function getLoanapps()
{
    

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

]

   

}); 





}




    $(document).ready(function(){

getLoanapps();


$('#memberNumber').on('change',function(){

var e = document.getElementById("memberNumber");
 selval = e.options[e.selectedIndex].value;
selid = e.options[e.selectedIndex].index;
console.log(selid);

 ldgname = e.options[e.selectedIndex].text;
//   console.log("aaaaa "+selval + "ldgname : " + ldgname);
// $("#memberName").select2('data', { id:selval, text: ldgname});


$('#memberName').val(selval);
$('#memberName').trigger('change.select2');
//$('#memberName').val(selid);


urlstr = base_url + 'fetchMemberId';
url = urlstr.replace("undefined","");

$.ajax({
    url: url+'?memid=' + selval, //+ 'fetchReceiptSearch',
    dataType: 'json',
    type: 'get',
    cache:false,
    success: function(data){
    var event_data = '';
console.log(data);
$.each(data, function(index) {
console.log(data[index].fahu_name);
$('#fahuName').val(data[index].fahu_name);
$('#memName').val(data[index].member_name);
$('#designation').val(data[index].designation_id);
$('#designation').trigger('change.select2');
$('#smemberNumber').val(data[index].surety_id);
$('#smemberNumber').trigger('change.select2');

$('#dob').val(data[index].dob);

$('#doj').val(data[index].doj);

const curdt = new Date();
const date1 = new Date(data[index].doj);
const date2 = new Date(data[index].dob);
const diffTime = Math.abs(date2 - date1);
console.log(diffTime);
const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
console.log(diffTime + " milliseconds");
console.log(diffDays + " days");
var noy = Math.round(diffDays/365);
$('#nys').val(noy+ " Yrs");

diffT = Math.abs(curdt - date2);
const dDays = Math.ceil(diffT / (1000 * 60 * 60 * 24)); 
var age=Math.round(dDays/365);
var retage=59;
var remainservice = Math.round(retage-age);
$('#rys').val(remainservice + " Yrs");
$('#age').val(age + ' yrs');
});
}
});

});



var urlstr = base_url + 'fetchDesignation';
var url = urlstr.replace("undefined","");

    $("#designation").load(url);




var urlstr = base_url + 'fetchMemberlist';
var url = urlstr.replace("undefined","");

    $("#memberNumber").load(url);
$('#memberNumber').select2({tags: "true",
  placeholder: "Number"});

    $("#smemberNumber").load(url);
$('#smemberNumber').select2({tags: "true",
  placeholder: "Number",allowClear: true});













var urlstr = base_url + 'fetchDesignation';
var url = urlstr.replace("undefined","");

    $("#designation").load(url);




var urlstr = base_url + 'fetchMemberlist';
var url = urlstr.replace("undefined","");
    $("#memberNumber").load(url);
$('#memberNumber').select2({tags: "true",
  placeholder: "Number"});

    $("#smemberNumber").load(url);
$('#smemberNumber').select2({tags: "true",
  placeholder: "Number",allowClear: true});



$('#smemberNumber').on('change',function(){

    var e = document.getElementById("smemberNumber");
     selval = e.options[e.selectedIndex].value;
     ldgname = e.options[e.selectedIndex].text;
    console.log("aaaaa "+selval + "ldgname : " + ldgname);

//$('#smemberName').val(selval).trigger('change.select2');




});






$('#memberNumber').on('change',function(){

    var e = document.getElementById("memberNumber");
     selval = e.options[e.selectedIndex].value;
selid = e.options[e.selectedIndex].index;
console.log(selid);

     ldgname = e.options[e.selectedIndex].text;
 //   console.log("aaaaa "+selval + "ldgname : " + ldgname);
// $("#memberName").select2('data', { id:selval, text: ldgname});


 $('#memberName').val(selval);
 $('#memberName').trigger('change.select2');
//$('#memberName').val(selid);


  urlstr = base_url + 'fetchMemberId';
 url = urlstr.replace("undefined","");

 $.ajax({
        url: url+'?memid=' + selval, //+ 'fetchReceiptSearch',
        dataType: 'json',
        type: 'get',
        cache:false,
        success: function(data){
        var event_data = '';
console.log(data);
  $.each(data, function(index) {
    console.log(data[index].fahu_name);
    $('#fahuName').val(data[index].fahu_name);
$('#memName').val(data[index].member_name);
$('#designation').val(data[index].designation_id);
  $('#designation').trigger('change.select2');
$('#smemberNumber').val(data[index].surety_id);
$('#smemberNumber').trigger('change.select2');

    $('#dob').val(data[index].dob);

    $('#doj').val(data[index].doj);

const curdt = new Date();
const date1 = new Date(data[index].doj);
const date2 = new Date(data[index].dob);
const diffTime = Math.abs(date2 - date1);
console.log(diffTime);
const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
console.log(diffTime + " milliseconds");
console.log(diffDays + " days");
var noy = Math.round(diffDays/365);
$('#nys').val(noy+ " Yrs");

 diffT = Math.abs(curdt - date2);
const dDays = Math.ceil(diffT / (1000 * 60 * 60 * 24)); 
var age=Math.round(dDays/365);
var retage=59;
var remainservice = Math.round(retage-age);
$('#rys').val(remainservice + " Yrs");
$('#age').val(age + ' yrs');
});
}
});

});



function edCalc() {

    var earn_sum = 0;
    var net_pay=0;
    $('.earn').each(function() {
        earn_sum+= Number($(this).val());
    });
    $("#modalPayslip").find("#totern").val(Number(earn_sum));


    var ded_sum = 0;

    $('.deduct').each(function() {
        ded_sum+= Number($(this).val());
    });
    $("#modalPayslip").find("#totded").val(Number(ded_sum));

net_pay=Number(earn_sum-ded_sum);
    $("#modalPayslip").find("#netpay").val(Number(net_pay));

}


$('.earn').keyup(function(){

edCalc();


});



$('.deduct').keyup(function(){

  edCalc();
    
});




var today = new Date();
var date = today.getDate() +'/'+ (today.getMonth()+1) + '/' + today.getFullYear();
console.log(date);
$('#dor').val(date);




    $("#createLoanApplicationForm").unbind('submit').bind('submit', function() {
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
                        $("#add-loanapp-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#add-loanapp-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
$("#memberNumber").val("");
$('#memberNumber').trigger('change.select2');

$("#createLoanApplicationForm").trigger("reset");

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







    $('#modalPayslip').on('show.bs.modal', function () {
        edCalc();
    
    });




}); // .change in section


function updateAppln(id)
{
    console.log(id);

    addupd_flag="1";
    $("#addupdflag").val(addupd_flag);
    $("#recid").val(id);
    var urlstr = base_url + 'fetchDesignation';
var url = urlstr.replace("undefined","");

    $("#designation").load(url);
   
    var urlstr = base_url + 'fetchMemberlist';
var url = urlstr.replace("undefined","");
    $("#memberNumber").load(url);
$('#memberNumber').select2({tags: "true",
  placeholder: "Number"});

    $("#smemberNumber").load(url);
$('#smemberNumber').select2({tags: "true",
  placeholder: "Number",allowClear: true});


    urlstr = base_url + 'get_applnDatabyid';
 url = urlstr.replace("undefined","");

 $.ajax({
        url: url+'?appid=' + id, //+ 'fetchReceiptSearch',
        dataType: 'json',
        type: 'get',
        cache:false,
        success: function(data){
        var event_data = '';
console.log(data);
  $.each(data, function(index) {
    console.log(data[index].app_number);
 $('#appNumber').val(data[index].app_number);
    $('#fahuName').val(data[index].member_fahuname);
    $('#dob').val(data[index].member_dob);

//$('#memName').val(data[index].member_name);
$('#designation').val(data[index].designation_id);
  $('#designation').trigger('change.select2');
 

$('#offStreet').val(data[index].off_address);  
$('#offCity').val(data[index].off_city);  
$('#offState').val(data[index].off_state);
$('#offPincode').val(data[index].off_pincode);  
$('#loanPurpose').val(data[index].loan_purpose);  
$('#doj').val(data[index].member_doj);
$('#baspay').val(data[index].basic_amt);
$('#ca').val(data[index].ca_amt);
$('#da').val(data[index].da_amt);
$('#ded').val(data[index].ded_amt);
$('#dor').val(data[index].dor);
$('#earn').val(data[index].earn_amt);
$('#fa').val(data[index].fa_amt);
$('#fbs').val(data[index].fbs_amt);
$('#fh_flag').val(data[index].fh_flag);
$('#gpfloan').val(data[index].gpfloan_amt);
$('#gpfsub').val(data[index].gpfsub_amt);
$('#hba').val(data[index].hba_amt);
$('#hra').val(data[index].hra_amt);
$('#loanInstallment').val(data[index].installment_amount);
$('#irpay').val(data[index].ir_amt);
$('#lic').val(data[index].lic_amt);
$('#loanAmt').val(data[index].loan_amount);
$('#mapay').val(data[index].ma_amt);
$('#net').val(data[index].net_amt);
$('#off_address').val(data[index].off_address);
$('#off_city').val(data[index].off_city);
$('#off_pincode').val(data[index].off_pincode);
$('#off_state').val(data[index].off_state);
$('#other').val(data[index].other_amt);
$('#loanRepay').val(data[index].repay_period);
$('#roi').val(data[index].roi);
$('#socrec').val(data[index].socrec_amt);
$('#splpay').val(data[index].splpay_amt);
$('#memberNumber').val(data[index].member_id);
$('#memberNumber').trigger('change.select2');

const curdt = new Date();
const date1 = new Date(data[index].member_doj);
const date2 = new Date(data[index].member_dob);
const diffTime = Math.abs(date2 - date1);
console.log(diffTime);
const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
console.log(diffTime + " milliseconds");
console.log(diffDays + " days");
var noy = Math.round(diffDays/365);
$('#nys').val(noy+ " Yrs");

 diffT = Math.abs(curdt - date2);
const dDays = Math.ceil(diffT / (1000 * 60 * 60 * 24)); 
var age=Math.round(dDays/365);
var retage=59;
var remainservice = Math.round(retage-age);
$('#rys').val(remainservice + " Yrs");
$('#age').val(age + ' yrs');

  });
        }
 });

}


</script>                


