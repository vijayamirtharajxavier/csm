





<div class="col-md-12">
<div class="col-md-8">
<div class="row">
<div class="col-md-3">
   <div class="form-group">
  <label class="control-label">Appln #</label>
  <input class="form-control" type="text" value="<?php echo $lastapp_id; ?>"  id="appNumber" name="appNumber"  readonly>
  </div>      
</div>

<div class="col-md-3">
<div class="form-group">
<label>Member#</label>
    <select class="form-control" id="memberNumber" name="memberNumber" required></select>
</div>    
</div>

<div class="col-md-3">
<div class="form-group">
<label>Father / Spouse Name</label>
    <input type="text" class="form-control" placeholder="
Father / Spouse Name
" name="fahuName" id="fahuName">
    
</div>    
</div>

<div class="col-md-3">
<div class="form-group">
<label>Surety Member#</label>
    <select class="form-control" id="smemberNumber"  name="smemberNumber" required></select>
    
</div>    
</div>
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

    </div>  <!-- LeftSide Div -->

<!-- Right Side Table -->
<div class="col-md-4">

<div class="table-responsive">
<table class="table table-condensed" > 
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
      <a href="" class="btn btn-info btn-rounded  pull-right" style="color:white; margin-top: -10px;" data-toggle="modal" data-target="#modalPayslip">
    Payslip Details</a>

</div>
</div>
<div class="col-md-8">

    <div class="form-group">
            <button type="submit" id="createAppn" class="btn btn-rounded btn-sm btn-success"> <i class="fa fa-check"></i> Save</button>
                  <button type="button" class="btn btn-rounded btn-sm btn-danger">Cancel</button>
    
</div>
</div>
</div>




</div>


</div>

                                               
 
<div class="modal fade" id="modalPayslip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
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
    @media screen and (min-width: 992px) {

        .modal-lg {

          width: 950px; /* New width for large modal */

        }

    }



input[type="text"], textarea {

  background-color : #56fcf4; 

}



</style>

<script type="text/javascript">

    $(document).ready(function(){
var urlstr = base_url + 'fetchDesignation';
var url = urlstr.replace("undefined","");

    $("#designation").load(url);




var urlstr = base_url + 'fetchMemberlist';
var url = urlstr.replace("undefined","");

/*$("#memberName").load(url);
$('#memberName').select2({tags: "true",
  placeholder: "Member Name",
  allowClear: true});

$("#smemberName").load(url);
$('#smemberName').select2({tags: "true",
  placeholder: "Member Name",
  allowClear: true});
*/

    $("#memberNumber").load(url);
$('#memberNumber').select2({tags: "true",
  placeholder: "Number"});

    $("#smemberNumber").load(url);
$('#smemberNumber').select2({tags: "true",
  placeholder: "Number",allowClear: true});


/*
$('#memberName').on('change',function(){

    var e = document.getElementById("memberName");
     selval = e.options[e.selectedIndex].value;
     ldgname = e.options[e.selectedIndex].text;
    console.log("aaaaa "+selval + "ldgname : " + ldgname);

*/
/*

$('#memberNumber').val(selval).trigger('change.select2');



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
    console.log(data[0].dob);
    console.log(data[index].fahu_name);
    $('#fahuName').val(data[index].fahu_name);
$('#memName').val(data[index].member_name);    
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
$('#nys').val(noy +" Yrs");

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

*/

/*
$('#smemberName').on('change',function(){

    var e = document.getElementById("smemberName");
     selval = e.options[e.selectedIndex].value;
     ldgname = e.options[e.selectedIndex].text;
    console.log("aaaaa "+selval + "ldgname : " + ldgname);
$('#smemName').val(ldgname);
$('#smemberNumber').val(selval).trigger('change.select2');




});
*/


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

//payslip calc
/*
function payCalc() {
 var bas_pay = document.getElementById('baspay').value,
//bas_pay =  $('#baspay').val();
da_pay =document.getElementById('da').value,
hra_pay =document.getElementById('hra').value,
spl_pay = document.getElementById('splpay').value,
ir_pay = document.getElementById('irpay').value,
ma_pay = document.getElementById('mapay').value,

gpfsub_ded =document.getElementById('gpfsub').value,
gpfloan_ded =document.getElementById('gpfloan').value,
fbs_ded = document.getElementById('fbs').value,
fa_ded = document.getElementById('fa').value,
hba_ded =document.getElementById('hba').value,
ca_ded = document.getElementById('ca').value,
lic_ded =document.getElementById('lic').value,
othr_ded = document.getElementById('other').value;


var tot_ern = Number(bas_pay)+Number(da_pay)+Number(hra_pay)+Number(spl_pay)+Number(ir_pay)+Number(ma_pay) ;
var tot_ded = Number(gpfsub_ded)+Number(gpfloan_ded)+Number(fbs_ded)+Number(fa_ded)+Number(hba_ded)+Number(ca_ded)+Number(lic_ded)+Number(othr_ded);
var net_pay = Number(tot_ern)-Number(tot_ded);
console.log(bas_pay);
$("#modalPayslip").find("#totern").val(Number(tot_ern));
$("#modalPayslip").find("#totded").val(Number(tot_ded));
$("#modalPayslip").find("#netpay").val(Number(net_pay));

}
*/

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
                        $("#add-appn-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#add-appn-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
$("#createLoanApplicationForm").trigger("reset");

/*setTimeout(function(){// wait for 5 secs(2)
           location.reload(); // then reload the page.(3)
    }, 500); 

  */                    //  $("#addSalesInvoiceTable:not(:first)").remove();
                       // $('.form-group').removeClass('has-error').removeClass('has-success');
                       // $('.text-danger').remove();     
                        //addSalesInvoiceTable.ajax.reload(null,false);
                      //  manageInvoiceTable.ajax.reload(null, false);
                      //  getInvoiceno();

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




}); // .change in section



</script>                


<style type="text/css">

* {
  font-family: sans-serif; /* Change your font family */
}

.content-table {
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 0.9em;
  min-width: 400px;
  border-radius: 5px 5px 0 0;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.content-table thead tr th {
  background-color: #009879;
  color: #ffffff;
  text-align: left;
  font-weight: bold;
}

.content-table th,
.content-table td {
  padding: 12px 15px;
}

.content-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.content-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.content-table tbody tr:last-of-type {
  border-bottom: 2px solid #009879;
}

.content-table tbody tr.active-row {
  font-weight: bold;
  color: #009879;
}




/* Table Layout */

table.vitamins {
    margin: 20px 0 0 0;
    border-collapse: collapse;
    border-spacing: 0;
    /*background: #212125;*/
    color: #fff;
}

table.vitamins th, table.vitamins td {
    text-align: center;
}

table.vitamins thead {
    line-height: 12px;
    background: #2e63e7;
    text-transform: uppercase;
}

table.vitamins thead th {
    color: #fff;
    padding: 10px;
    letter-spacing: 1px;
    vertical-align: bottom;
}

table.vitamins thead th:nth-child(1) {
    width: 20%;
    text-align: left;
    padding-left: 20px;
}

table.vitamins thead th:nth-child(2) {
    width: 30%;
}

table.vitamins thead th:nth-child(3) {
    width: 35%;
}

table.vitamins thead th:nth-child(4) {
    width: 15%;
}

table.vitamins tbody {
    font-size: 1em;
    line-height: 15px;
}

table.vitamins tbody tr {
    border-top: 2px solid rgba(109, 176, 231, 0.8);
    transition: background 0.6s, color 0.6s;
}

table.vitamins tbody tr:nth-child(even) {
    background: rgba(255, 255, 255, 0.2);
}

table.vitamins tbody tr:hover {
    color: #000;
    background: rgba(255, 255, 255, 0.7);
    font-weight: 900;
}

table.vitamins tbody td {
    padding: 12px;
}

table.vitamins tbody tr:hover td:first-child {
    background: rgba(0,0,0,0);
}

table.vitamins tbody td:first-child {
    text-align: left;
    padding-left: 20px;
    font-weight: 700;
    background: rgba(109, 176, 231, 0.35);
    transition: backgrounf 0.6s;
}

table.vitamins tfoot {
    font-size: 0.8em;
}

table.vitamins tfoot tr {
    border-top: 2px solid #2e63e7;
}

table.vitamins tfoot td {
    color: rgba(255,255,215,0.6);
    text-align: left;
    line-height: 15px;
    padding: 15px 20px;
}


</style>