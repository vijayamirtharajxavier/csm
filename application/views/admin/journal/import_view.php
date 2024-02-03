

    <div class="container">

<div id="journal-message"></div>
<div class="py-2">

<!--<form method="POST" id="import_form" enctype="multipart/form-data" > -->
    <form method="POST" id="import_form" >
<!--<div class="col-md-12"><label>Select Excel File</label>
<input type="file" name="file" id="file" required accept=".xls, .xlsx" />
<span><input type="submit" name="import" value="Import" class="btn btn-info" /></span>
</div>-->
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

<div class="form-inline">&nbsp;&nbsp;Month :&nbsp;<input type="text" class="form-control from" placeholder="Select a Month" required ><button id="loadData" type="button" class="btn btn-primary" ><i class="fa fa-refresh"></i></button>
</div>

        <!--<input class="form-control" type="text" id="impdate" name="impdate" placeholder="Select a Month" >
--

    </span> -
</div> -->


    </form>
        <br />
<!--        <div id="journal_data" class="table-responsive">-->
            
  

    <div class="d-flex flex-row flex-nowrap pb-2">


  <div class="card-box">
        <div class="card-header" style="background-color: green; color: white;font-weight: bold;">RECEIPTS
            <div class="pull-right">
                <a href="#" onclick="openReceipt()" type="file" name="file" id="file" required accept=".xls, .xlsx" ><i style="color: white;"  class="fa fa-upload"></i></a>&nbsp;&nbsp;
                <a href="#" onclick="rctResult()"><i style="color: white;"  class="fa fa-refresh"></i></a>
            </div>
        </div>
        <div class="card card-body">
<div id="receipt_data" class="table-responsive">
<div id="loader" class="rloader"></div>

<table id="receiptTbl" class="table table-bordered">
    <tbody>
    </tbody>
</table>
</div>

</div>

</div>&nbsp;&nbsp;

 <div class="card-box">
<div class="card-header"  style="background-color: blue; color: white;font-weight: bold;">PAYMENTS
        
            <div class="pull-right">
                <a href="#" onclick="openPayment()" ><i style="color: white;" class="fa fa-upload"></i></a>&nbsp;&nbsp;
                <a href="#" onclick="payResult()"><i style="color: white;" class="fa fa-refresh"></i></a>
            </div>
            </div>        
<div class="card card-body">
<div id="payment_data" class="table-responsive">
<div id="loader" class="ploader"></div>

<table id="paymentTbl" class="table table-bordered">
<tbody></tbody>
</table>
</div>

</div>

</div>&nbsp;&nbsp;

</div>




<div class="d-flex flex-row flex-nowrap pb-2">
     

<!--
      <div class="card-box">
        <div class="card-header" style="background-color: grey; color: white;font-weight: bold;">DIVSION TO MEMBER
        </div>
        <div class="card card-body">
<div class="table-responsive" style="height: 200px; overflow: auto;">
<!--    <div id="divmemTbl"></div>     --
<div id="loader" class="dloader"></div>

<table id="divmemTbl" class="table">
    <tbody></tbody>
</table>    
</div>
<!--</table>--


</div>

        </div>&nbsp;&nbsp; -->

 <div class="card-box">
        <div class="card-header" style="background-color: orange; color: white;font-weight: bold;">NEW SURETY LOAN/ADJUSTED
            <div class="pull-right">
                <a href="#" onclick="openLoan()" type="file" name="file" id="file" required accept=".xls, .xlsx" ><i style="color: white;"  class="fa fa-upload"></i></a>&nbsp;&nbsp;
                <a href="#" onclick="loanResult()"><i style="color: white;"  class="fa fa-refresh"></i></a>
            </div>
        </div>
        <div class="card card-body">
<div id="loan_data" class="table-responsive">
<div id="loader" class="lloader"></div>

<table id="loanTbl" class="table table-bordered">
    <tbody>
    </tbody>
</table>
</div>

</div>

</div>&nbsp;&nbsp;


 <div class="card-box">
<div class="card-header" style="background-color: red; color: white;font-weight: bold;">ACCOUNT CLOSURE
            <div class="pull-right">
                <a href="#" onclick="openAccountClosure()" type="file" name="file" id="file" required accept=".xls, .xlsx" ><i style="color: white;"  class="fa fa-upload"></i></a>&nbsp;&nbsp;
                <a href="#" onclick="accountclosureResult()"><i style="color: white;"  class="fa fa-refresh"></i></a>
            </div>
        </div>
        <div class="card card-body">
<div id="loan_data" class="table-responsive">
<div id="loader" class="aloader"></div>

<table id="loanTbl" class="table table-bordered">
    <tbody>
    </tbody>
</table>
</div>

</div>

</div>&nbsp;&nbsp;

</div>

<div class="d-flex flex-row flex-nowrap">
 <div class="card-box">
     <div class="card-header"  style="background-color: grey; color: white;font-weight: bold;">RECOVERY JOURNAL DATA IMPORT
        
            <div class="pull-right">
                <a href="#" onclick="openRecovery()" ><i style="color: white;" class="fa fa-upload"></i></a>&nbsp;&nbsp;
                <a href="#" onclick="divResult()"><i style="color: white;" class="fa fa-refresh"></i></a>
            </div>
            </div>        
       
                
<div class="card card-body">
<div id="memacc_data" class="table-responsive" style="height: 200px; overflow: auto;">
    
<div id="loader" class="maloader"></div>

<table id="memaccTbl" class="table">
    <tbody>
    </tbody>
</table>
</div>

</div>

</div>

</div>
    
    
<!-- Receipt Import -->

<div class="pull-right"><button submit="button" class="btn btn-danger">Reset</button>
&nbsp;&nbsp;    <button submit="button" class="btn btn-success">Proceed to Save</button> </div>
</div>


<div class="form-popup" id="myReceipt">
 <form method="POST" action="cbImpReceipt" id="rimport_form"  class="form-container"  enctype="multipart/form-data">
  <!--<form action="cbImpReceipt" class="form-container"> -->
<div class="col-md-12"><label>Select Excel File for Receipt</label>
<input type="file" name="file" id="file" required accept=".xls, .xlsx"/>  
<!--<input type="file" name="rctfile" id="rctfile" required accept=".xls, .xlsx" />-->
</div>
              
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
<button type="submit" name="import" class="button btn btn-primary btn-txt"><i style="color: white;" class="rbtn_loading fa fa-upload"></i> &nbsp;&nbsp;Import </button>   
    
    <button type="button" class="btn cancel" onclick="closeReceipt()">Cancle</button>
  </form>
</div>


<!-- Payment Import -->

<div class="form-popup" id="myPayment">
 <!--<form method="POST" action="cbImpPayment" id="pimport_form"  class="form-container"  enctype="multipart/form-data"> -->
 <form method="POST" action="cbImpPayment" id="pimport_form"  class="form-container"  enctype="multipart/form-data">

<div class="col-md-12"><label>Select Excel File for Payment</label>
<input type="file" name="file" id="file" required accept=".xls, .xlsx"/>  
<!--<input type="file" name="rctfile" id="rctfile" required accept=".xls, .xlsx" />-->
</div>
              
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
<button type="submit" name="import" class="btn btn-primary" ><i class="fa fa-upload" id="pbtn_loading"></i>&nbsp;&nbsp;Import </button>   
    
    <button type="button" class="btn cancel" onclick="closePayment()">Cancle</button>
  </form>
</div>



<div class="form-popup" id="myLoan">
 <form method="POST" action="cbImpLoan" id="limport_form"  class="form-container"  enctype="multipart/form-data">
  <!--<form action="cbImpReceipt" class="form-container"> -->
<div class="col-md-12"><label>Select Excel File for Loan/Adj</label>
<input type="file" name="file" id="file" required accept=".xls, .xlsx"/>  
<!--<input type="file" name="rctfile" id="rctfile" required accept=".xls, .xlsx" />-->
</div>
              
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
<button type="submit" name="import" class="button btn btn-primary btn-txt"><i style="color: white;" class="btn_loading fa fa-spinner fa-spin hide"></i> &nbsp;Import </button>   
    
    <button type="button" class="btn cancel" onclick="closeLoan()">Cancle</button>
  </form>
</div>


<div class="form-popup" id="myAclosure">
 <form method="POST" action="cbImpAClosure" id="limport_form"  class="form-container"  enctype="multipart/form-data">
  <!--<form action="cbImpReceipt" class="form-container"> -->
<div class="col-md-12"><label>Select Excel File for Account Closure</label>
<input type="file" name="file" id="file" required accept=".xls, .xlsx"/>  
<!--<input type="file" name="rctfile" id="rctfile" required accept=".xls, .xlsx" />-->
</div>
              
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
<button type="submit" name="import" class="button btn btn-primary btn-txt"><i style="color: white;" class="btn_loading fa fa-spinner fa-spin hide"></i> &nbsp;Import </button>   
    
    <button type="button" class="btn cancel" onclick="closeAclosure()">Cancle</button>
  </form>
</div>



<!-- Recover Import -->
<div class="form-popup" id="myRecovery">
  <form method="POST" action="recoveryImport" class="form-container"  enctype="multipart/form-data" >

<div class="col-md-12"><label>Select Excel File for Recovery</label>
<input type="file" name="file" id="file" required accept=".xls, .xlsx" />

</div>

        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

<button type="submit" name="import" class="btn btn-primary" ><i id="rbtn_loading" class="fa fa-spinner fa-spin" style="display: none;"></i> Import &nbsp; </button>
    <button type="button" class="btn cancel" onclick="closeRecovery()">Cancel</button>
  </form>
</div>


<script type="text/javascript">

$(document).ready(function() {



    $("#rimport_form").unbind('submit').bind('submit', function(e) {
   // e.preventDefault();
    $(".rbtn_loading").removeClass('fa fa-upload');  
    $(".rbtn_loading").addClass('fa fa-spinner fa-spin');
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');
        var formData = new FormData(this);

//aloader.style.display = "block";
        $.ajax({
            url: url,
            type: type,
            data: formData, //.serialize(),
               processData: false,
    contentType: false,
            dataType: 'json',
            success:function(response) {
              console.log(response);
    $(".rbtn_loading").addClass('fa fa-upload');  
    $(".rbtn_loading").removeClass('fa fa-spinner fa-spin');

                if(response.success == true) {                      

$("#rimport_form").trigger("reset");
closePayment();
payResult();

//managepaymentlistTable.ajax.reload(null, false);
//$("#InvoiceItems tbody tr").remove(); 
//$("#cname").html("");
                    }   
                    else {                                  

                        $("#error-import-message").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


$("#error-import-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});
                        
                                                
                    } // /else
            } // /.success
        }); // /.ajax funciton
        return false;
    });



/*  
$("#rimport_form").submit(function(event){
  console.log('clicked submit button');
    // cancels the form submission
    event.preventDefault();
    submitForm();
});



function submitForm(){
    // Initiate Variables With Form Content
  //  var name = $("#name").val();
   // var email = $("#email").val();
   // var subject = $("#subject").val();
   // var message = $("#message").val();
 //console.log(name + email + subject + message);
    $.ajax({
        type: "POST",
        url: "cbImpReceipt",
        //data: "name=" + name + "&email=" + email + "&subject=" + subject + "&message=" + message,
        success : function(text){
            if (text == "true"){
                formSuccess();
            }
        }
    });
}
function formSuccess(){
                                $("#journal-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  text + 
                                '</div>');      

  $("#rimport_form")[0].reset();
    $( "#btn_loading" ).addClass( "hide" );
}


/*
$('.button').on('click',function(){
$(".btn_loading").removeClass("hide");
$(".button").attr("disabled",true);
$(".btn-txt").text("Importing Data from Excel...");




});
*/


 $('.from').datepicker({
    autoclose: true,
    minViewMode: 1,
    format: 'mm/yyyy'
}).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.to').datepicker('setStartDate', startDate);
    }); 

rloader = document.querySelector(".rloader");
ploader = document.querySelector(".ploader");
lloader = document.querySelector(".lloader");
maloader = document.querySelector(".maloader");
aloader = document.querySelector(".aloader");

rloader.style.display = "none";
ploader.style.display = "none";
lloader.style.display = "none";
maloader.style.display = "none";
aloader.style.display = "none";

$("#loadData").on('click',function(){
    
var loadmonth = $('.from').val();
//console.log('Load Data' + loadmonth);

 var result = false;
  dValue = loadmonth.split('/');
  console.log(dValue);
  
  var pattern = /^\d{2}$/;
  var patterny = /^\d{4}$/;
  var mon = dValue[0] + dValue[1];
  if (dValue[0] < 1 || dValue[0] > 12)

      result = true;
//          loader = document.querySelector(".loader");
 //       loader.style.display = "block";



  if (!pattern.test(dValue[0]) || !patterny.test(dValue[1]))
      result = true;

  if (dValue[2])
      result = true;

  if (result) { 
console.log(result);
    alert("Please enter a valid date in MM/YYYY format."); 
  $(".from").val("");
  $(".from").focus();

    }

rctResult();
payResult();
divResult();
memResult();





});






});  //Document Ready




function rctResult()
{
var loadmonth = $('.from').val();
console.log('Load Data' + loadmonth);
rloader.style.display = "block";
  dValue = loadmonth.split('/');
  mon = dValue[0] + dValue[1];

     urlstr = base_url + 'getReceipt';
 url = urlstr.replace("undefined","");

    console.log('Receipt Result for ' + mon);

 var request = new XMLHttpRequest();

    // Instantiating the request object

    //request.open("GET", "rctReceipt.php?rctmon="+mon);
    request.open("GET", url + "?rctmon=" +  mon); // "rctReceipt.php?rctmon="+mon);

    // Defining event listener for readystatechange event
    request.onreadystatechange = function() {
        // Check if the request is compete and was successful
        if(this.readyState === 4 && this.status === 200) {
            rloader.style.display = "none";
            // Inserting the response from server into an HTML element
            document.getElementById("receiptTbl").innerHTML = this.responseText;
            //$("#receiptTbl tbody").append(this.response);
        }
    };

    // Sending the request to the server
    request.send();    
}


function payResult()
{
    console.log('Payment Result');
var loadmonth = $('.from').val();
console.log('Load Data' + loadmonth);
ploader.style.display = "block";
  dValue = loadmonth.split('/');
  mon = dValue[0] + dValue[1];

     urlstr = base_url + 'getPayment';
 url = urlstr.replace("undefined","");

    console.log('Payment Result for ' + mon);

 var request = new XMLHttpRequest();

    // Instantiating the request object

    //request.open("GET", "rctReceipt.php?rctmon="+mon);
    request.open("GET", url + "?paymon=" +  mon); // "rctReceipt.php?rctmon="+mon);

    // Defining event listener for readystatechange event
    request.onreadystatechange = function() {
        // Check if the request is compete and was successful
        if(this.readyState === 4 && this.status === 200) {
            ploader.style.display = "none";
            // Inserting the response from server into an HTML element
            document.getElementById("paymentTbl").innerHTML = this.responseText;
        }
    };

    // Sending the request to the server
    request.send();        
}


function divResult()
{
    console.log('Div To Mem Result');
var loadmonth = $('.from').val();
console.log('Load Data' + loadmonth);
lloader.style.display = "block";
  dValue = loadmonth.split('/');
  mon = dValue[0] + dValue[1];

     urlstr = base_url + 'getDivMem';
 url = urlstr.replace("undefined","");

    console.log('Division Result for ' + mon);
var tbl=[];
var ttype='';
$.getJSON(url+"?divmon=" + mon,  function( data ) { // "ajax/test.json", function( data ) {
  var items = [];
  var subitems=[];
console.log(data);
var cnt= data.length;
var dbtot=0;
var crtot=0;
console.log(cnt);
for (var rw = 0; rw <cnt; rw++) {
    

tbl +="<tr><td style='font-weight:bold; background-color:purple; color:white; '>"+data[rw].divid+"</td><td style='font-weight:bold; background-color:purple; color:white; '>"+data[rw].divname+"</td><td style='font-weight:bold; background-color:purple; color:white;''></td><td style='font-weight:bold; background-color:purple; color:white;''></td></tr>";
    $.each(data[rw].members,function(k,v) {
        console.log(data[rw]);
        console.log("ID: " + v.account_id);
    ttype= v.trans_type;
    

    if(ttype=="RCPT")
    {
    tbl +="<tr><td>"+v.account_id+"</td><td>"+ v.account_name +" </td> <td style='text-align:right'>"+v.trans_amount+"</td><td></td></tr>";
    dbtot += parseFloat(v.trans_amount);
    }
    if(ttype=="JOUR")
    {
     tbl +="<tr><td>"+v.account_id+"</td><td>"+ v.account_name +" </td><td></td><td style='text-align:right'>"+v.trans_amount+"</td></tr>";  
     crtot += parseFloat(v.trans_amount); 
    }    
        
    });
 tbl +="<tr><td style='font-weight:bold; background-color:grey; color:white; ' colspan='2'>Total </td><td style='text-align:right;font-weight:bold; background-color:grey; color:white; '>"+ dbtot +"</td><td style='text-align:right;font-weight:bold; background-color:grey; color:white; '>"+ crtot+"</td></tr>";  
dbtot=0;
crtot=0;
}
lloader.style.display = "none";
console.log(tbl);
$("#divmemTbl tbody").html(tbl);

});


}


function memResult()
{
    console.log('Mem to Thrift Result');
var loadmonth = $('.from').val();
console.log('Load Data' + loadmonth);
maloader.style.display = "block";
  dValue = loadmonth.split('/');
  mon = dValue[0] + dValue[1];

     urlstr = base_url + 'getMemAcc';
 url = urlstr.replace("undefined","");

    console.log('Mem to Acc Result for ' + mon);

 var request = new XMLHttpRequest();

    // Instantiating the request object

    //request.open("GET", "rctReceipt.php?rctmon="+mon);
    request.open("GET", url + "?memmon=" +  mon); // "rctReceipt.php?rctmon="+mon);

    // Defining event listener for readystatechange event
    request.onreadystatechange = function() {
        // Check if the request is compete and was successful
        if(this.readyState === 4 && this.status === 200) {
                maloader.style.display = "none";
            // Inserting the response from server into an HTML element
            document.getElementById("memaccTbl").innerHTML = this.responseText;
        }
    };

    // Sending the request to the server
    request.send();        
}


function openReceipt() {
  document.getElementById("myReceipt").style.display = "block";
}

function closeReceipt() {
  document.getElementById("myReceipt").style.display = "none";
}

function openLoan() {
  document.getElementById("myLoan").style.display = "block";
}

function closeLoan() {
  document.getElementById("myLoan").style.display = "none";
}

function openAccountClosure() {
  document.getElementById("myAclosure").style.display = "block";
}

function closeAclosure() {
  document.getElementById("myAclosure").style.display = "none";
}

function openPayment() {
  document.getElementById("myPayment").style.display = "block";
}

function closePayment() {
  document.getElementById("myPayment").style.display = "none";
}



function openRecovery() {
  document.getElementById("myRecovery").style.display = "block";
}

function closeRecovery() {
  document.getElementById("myRecovery").style.display = "none";
}






function progress_bar_process(percentage, timer)
  {
   $('.progress-bar').css('width', percentage + '%');
   if(percentage > 100)
   {
    clearInterval(timer);
    $('#import_form')[0].reset();
    $('#process').css('display', 'none');
    $('.progress-bar').css('width', '0%');
    
    $('#success_message').html("<div class='alert alert-success'>Data Saved</div>");
    setTimeout(function(){
     $('#recovery-process-message').html('Imported data Successfully');
    }, 5000);
   }
}

</script>



<style type="text/css">
.hide {
  display: none;
}



.card-box {
    min-height: 50%;
    min-width: 50%;
    padding-right: 10px;
    /*margin-right: 15px;*/
    overflow: auto;
}    


/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  
  top: 0;
  margin-top: 90px;

  right: 450px; 
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=file], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

#loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  top: 50%;
  margin-left: 50%;
  margin-right: 50%;
  bottom: 50%;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
th {
  background: white;
  position: sticky;
  top: 0;
}
</style>