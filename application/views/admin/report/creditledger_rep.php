                <!-- /.row -->
<!-- .row -->
<div class="row">
    <div class="white-box col-md-12 col-lg-12 col-xs-12">
        <div class="form-group">
<form method="post" action="fetchcreditledgerSearchPDF" id="crldgrepForm">
            <h3 class="box-title">

<br>
<div class="col-md-12">
  
<div class="col-md-3">
  Select Ledger Account for
<select id="ldgrSelect" name="ldgrSelect"  class="custom-select col-6 form-control">
   <option selected>Choose...</option>
</select>
</div>
<!--
<div class="col-md-3">Period from <input class="form-control" type="date" name="fmDate" id="fmDate"></div>
<div class="col-md-3">to <input type="date" class="form-control" name="toDate" id="toDate"></div>
-->
<div class="col-md-3"><br><button type="button" id="ldgSearch">Submit</button></div>
</div>
 </h3>
            

   <div class="card text-center">
    <div class="card-header" id="crldgrep"> <h4>MEMBER`S YEARLY STATEMENT</h4>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

<div class="pull-right" style="margin-top: -35px;"><button class="btn-sm" type="submit"><i class="fa fa-file-pdf-o red-color"></i></button></div>
</div>

<!--
  <button class="btn-sm btn-primary" type="button" id="cr_ldgPrint"><i class="fa fa-print"></i></button>&nbsp;
                           <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#" id="crldgPrint">Print</a></li>
                                        
                                    </ul>
                                </li>
                            </ul> -->
    </div>  
                
</form>

</div>
</div>
</div>


    <div class="card-body">
      
<div id="ledger"> </div>

    </div>
  </div>




<br>
</div>




<script type="text/javascript">
    $(document).ready(function() {
var resp="";
var system_name = "<?php echo $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;?>" ;
var urlstr = base_url + 'fetchLedgerAccounts';
var url = urlstr.replace("undefined","");


var selval="0";
    console.log(selval);


 $('#ldgrSelect').select2();


var urlstr = base_url + 'fetchLedgerAccounts';
var url = urlstr.replace("undefined","");

    $("#ldgrSelect").load(url);
   // $("#e6").load(url);

$('#ldgrSelect').on('change',function(){

    var e = document.getElementById("ldgrSelect");
     selval = e.options[e.selectedIndex].value;
    console.log(selval);
});


$("#cr_ldgPdf").on("click",function(){
//Pdf Printing
console.log('Pdf Clicked');
  urlstr = base_url + 'fetchCrLedgerPdf';
 url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();
 let syear = new Date(fmDate);
 let s_year = syear.getFullYear();
 let eyear = new Date(toDate);
 let e_year= eyear.getFullYear();

$.ajax({
        url: url+'?fdate=' + fmDate + '&tdate=' + toDate + '&selacc=' + selval, //+ 'fetchReceiptSearch',
        //dataType: 'json',
        type: 'get',
        cache:false,
        success: function(data){
console.log('pdf generated');

var doc = new jsPDF();
var elementHTML = $('#ledger').html();
var specialElementHandlers = {
    '#elementH': function (element, renderer) {
        return true;
    }
};
doc.fromHTML(elementHTML, 15, 15, {
    'width': 170,
    'elementHandlers': specialElementHandlers
});

// Save the PDF
doc.save('sample-document.pdf');



}
});

});



$('#cr_ldgPrint').on('click',function(){
console.log('Clicked crLdgPring');
  urlstr = base_url + 'fetchCrLedgerPrint';
 url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();
 let syear = new Date(fmDate);
 let s_year = syear.getFullYear();
 let eyear = new Date(toDate);
 let e_year= eyear.getFullYear();

        console.log('Ledger Account');
 $.ajax({
        url: url+'?fdate=' + fmDate + '&tdate=' + toDate + '&selacc=' + selval, //+ 'fetchReceiptSearch',
        //dataType: 'json',
        type: 'get',
        cache:false,
        success: function(data){


var w = window.open(url+'?fdate=' + fmDate + '&tdate=' + toDate + '&selacc=' + selval);


 //+ url+ '?fdate='+ fdate + '&tdate=' + tdate +'&desg=' + desg.trim() + '&cid=' + cid.trim() + '&lid='+ lid.trim());

// If the window opened successfully (e.g: not blocked)
if ( w ) {
    w.onload = function() {
        // Do stuff
        console.log('Loadeed successfully');
        w.print();
        //w.close();
    };
}


}
});
}); //Printing Cr Ledg


$('#crldgPrint').on('click',function(){
console.log('Clicked crLdgPring');
  urlstr = base_url + 'fetchCreditLedgerPrint';
 url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();
 let syear = new Date(fmDate);
 let s_year = syear.getFullYear();
 let eyear = new Date(toDate);
 let e_year= eyear.getFullYear();

        console.log('Ledger Account');
 $.ajax({
        url: url+'?fdate=' + fmDate + '&tdate=' + toDate + '&selacc=' + selval, //+ 'fetchReceiptSearch',
        dataType: 'json',
        type: 'get',
        cache:false,
        success: function(data){
          console.log(data);
var event_data = '';
var thriftTotal=0.00;
var principleTotal=0.00;
var t_op = 0.00;
var l_op = 0.00;
var prnadj=0.00;
var opshr=0.00;
var shr_tot=0.00;
let cl_bal=0.00;
let loan_bal=0.00;
var trf_bal=0.00;
let shr_bal =0.00;
  $.each(data, function(index) {
//console.log("O/p DATA : "+data);
opshr = data[index].msharecap;
t_op = data[index].thrift_openingbalance;
 acc_id = data[index].id;
 event_data+= '<div id="printable"><div class="text-center" id="tophead">'+system_name+'</div> <div class="card text-center"><div class="card-header" id="crldgrep"> <h4>CREDIT LEDGER</h4>   </div>  <div class="card-body"> <div class="row"> <div class="col-md-2" style="text-align:left"><label>Member Name</label></div><div class="col-md-2" style="text-align:left"> <b>' + data[index].accname + '</b> </div> <div class="col-md-2" style="text-align:left"><label>Surety Member Name</label> </div><div class="col-md-2" style="text-align:left"> '+ data[index].suretyname +'</div><div class="col-md-2" style="text-align:left"><label>Share Capital</label></div><div class="col-md-2" style="text-align:left">'+ data[index].msharecap +'</div></div><div class="row"><div class="col-md-2" style="text-align:left"><label>Member Number</label></div><div class="col-md-2" style="text-align:left"> '+ data[index].memberid +'</div><div class="col-md-2" style="text-align:left"><label>Surety Member Number</label></div><div class="col-md-2" style="text-align:left"> '+ data[index].suretyid +'</div><div class="col-md-2" style="text-align:left"><label>Receipt </label></div><div class="col-md-2" style="text-align:left"> '+ data[index].suretyid +'</div><div class="col-md-2" style="text-align:left"><label>Installment Details </label></div><div class="col-md-2" style="text-align:left"> '+ data[index].suretyid +'</div><div class="col-md-2" style="text-align:left"><label>Monthly Repayment</label></div><div class="col-md-2" style="text-align:left"> '+ data[index].suretyid +'</div><div class="col-md-2" style="text-align:left"><label>Date of Loan Dispursed</label></div><div class="col-md-2" style="text-align:left"> '+ data[index].suretyid +'</div><div class="col-md-2" style="text-align:left"><label>Loan Account Number</label></div><div class="col-md-2" style="text-align:left"> '+ data[index].suretyid +'</div> <div class="col-md-2" style="text-align:left"><label>Ledger Folio #</label> </div> <div class="col-md-2" style="text-align:left"> '+ data[index].suretyid +'</div></div></div></div>';

event_data+= '<div class="card text-center"><div class="card-header"> <h4>LEDGER DETAILS ('+s_year+' - '+e_year+')</h4>    </div>  <div class="card-body"><table class="table" border="1" id="crldgrep"><tr><th colspan="2"></th><th colspan="3" style="text-align:center">Thrift Savings</th><th colspan="3" style="text-align:center">Shares</th><th colspan="2" style="text-align:center">Repayment</th><th style="text-align:center">Insurance</th><th colspan="2" style="text-align:center">Loan</th></tr><tr><th style="text-align:center" colspan="2">Date</th><th style="text-align:center">Receipt</th><th style="text-align:center">Payment</th><th style="text-align:center">Total</th><th style="text-align:center">Receipt</th><th style="text-align:center">Payment</th><th style="text-align:center">Total</th><th style="text-align:center">Principle</th><th style="text-align:center">Interest</th><th></th><th style="text-align:center">Loan Issued</th><th style="text-align:center">Loan Balance</th></tr><tbody>  <tr><td colspan="3"><b>OPENING BALANCE</b></td><td></td><td style="text-align:right"><b>'+ Number(data[index].thrift_openingbalance).toFixed(2) +'</b></td><td></td><td></td><td  style="text-align:right"><b>'+ Number(data[index].msharecap).toFixed(2) +'</b></td><td></td><td></td><td></td><td></td><td style="text-align:right"><b>'+Number(data[index].loan_openingbalance).toFixed(2)+'</b></td></tr>';

      thriftTotal = parseFloat(t_op);
    //  console.log('Tot - : ' + thriftTotal);
              
                var op_bal = Number(data[index].loan_openingbalance);
                principleTotal = op_bal;
                var slen = data[index].ledgerdetails.length;
shr_tot=Number(opshr);                 
                console.log("len :"+slen);
              if(slen>0) {
              //  console.log(slen);
     prin_col_tot = 0;
     trfrct_col_tot = 0;
     trfpay_col_tot = 0;
     shrrct_col_tot=0;
     shrpay_col_tot=0;
     interestrct_col_tot = 0;
     insurancerct_col_tot=0;
     loanpaid_col_tot=0;
                var trf_amt=0.00;
                
                var int_tot=0.00;
                var shr_amt=0.00;
                var accountName='';
                var trfr_tot=0.00;
                var trfp_tot=0.00;
                var ins_tot=0.00;
                var int_amt=0.00;
                var balance=0.00;
                var shr_pay=0.00;
                var shr_rct=0.00;
                var ins_rct=0.00;
                var ins_tot=0.00;
                
                let loan_paid=0.00;
                let principle_rct=0.00;
                let interest_rct=0.00;
                let insurance_rct=0.00;
              var loaniss_tot=0;
              var prnamt_tot=0;               
              trf_bal = parseFloat(data[index].thrift_openingbalance);
              shr_bal = parseFloat(data[index].msharecap);
              loan_bal = parseFloat(data[index].loan_openingbalance);
              for (var i =0; i<slen;  i++) { 
              
              let trf_rct = parseFloat(data[index].ledgerdetails[i].thrift_receipt);
              let trf_pay = parseFloat(data[index].ledgerdetails[i].thrift_paid);
              trf_bal=trf_bal+trf_rct-trf_pay;

              let shr_rct = parseFloat(data[index].ledgerdetails[i].share_receipt);
              let shr_pay = parseFloat(data[index].ledgerdetails[i].share_paid);

              shr_bal=shr_bal+shr_rct-shr_pay;

              principle_rct = parseFloat(data[index].ledgerdetails[i].principle_receipt);
              loan_paid = parseFloat(data[index].ledgerdetails[i].loan_paid);
              loan_bal=loan_bal+loan_paid-principle_rct;
              interest_rct = parseFloat(data[index].ledgerdetails[i].interest_receipt);
              insurance_rct = parseFloat(data[index].ledgerdetails[i].insurance_receipt);
//if(trf_rct!=0 && trf_pay!=0 && shr_rct!=0 && shr_pay!=0 && principle_rct!=0 && )

          event_data+= '<td colspan="2">'+ data[index].ledgerdetails[i].trans_date+'</td>';
          
          if(trf_rct!=0)
          {
          event_data+= '<td style="text-align:right;">'+ Number(trf_rct).toFixed(2)+'</td>';
          }
          else
          {
            event_data+='<td></td>';
          }
          if(trf_pay!=0)
          {
          event_data+= '<td style="text-align:right;">'+Number(trf_pay).toFixed(2)+'</td>';
          }
          else
          {
            event_data+='<td></td>';
          }

          event_data+= '<td style="text-align:right;">'+Number(trf_bal).toFixed(2)+'</td>';
          if(shr_rct!=0)
          {
          event_data+= '<td style="text-align:right;">'+Number(shr_rct).toFixed(2)+'</td>';
          }
          else
          {
            event_data+='<td></td>';
          }
          if(shr_pay!=0)
          {
          event_data+= '<td style="text-align:right;">'+Number(shr_pay).toFixed(2)+'</td>';
          }
          else
          {
            event_data+='<td></td>';
          }

          event_data+= '<td style="text-align:right;">'+Number(shr_bal).toFixed(2)+'</td>';

          if(principle_rct!=0)
          {
          event_data+= '<td style="text-align:right;">'+Number(principle_rct).toFixed(2)+'</td>';
          }
          else
          {
            event_data+='<td></td>';
          }
          if(interest_rct!=0)
          {
          event_data+= '<td style="text-align:right;">'+Number(interest_rct).toFixed(2)+'</td>';
          }
          else
          {
            event_data+='<td></td>';
          }
          if(insurance_rct!=0)
          {
          event_data+= '<td style="text-align:right;">'+Number(insurance_rct).toFixed(2)+'</td>';
          }
          else
          {
            event_data+='<td></td>';
          }
          if(loan_paid!=0)
          {

          event_data+= '<td style="text-align:right;">'+Number(loan_paid).toFixed(2)+'</td>';
          }
          else
          {
            event_data+='<td></td>';
          }

          event_data+= '<td style="text-align:right;">'+Number(loan_bal).toFixed(2)+'</td>';
     prin_col_tot = prin_col_tot+ principle_rct;
     trfrct_col_tot = trfrct_col_tot+trf_rct;
     trfpay_col_tot = trfpay_col_tot+trf_pay;
     shrrct_col_tot=shrrct_col_tot+shr_rct;
     shrpay_col_tot=shrpay_col_tot+shr_pay;
     interestrct_col_tot = interestrct_col_tot+interest_rct;
     insurancerct_col_tot=insurancerct_col_tot+insurance_rct;
     loanpaid_col_tot=loanpaid_col_tot+loan_paid;
     cl_bal = loan_bal+loanpaid_col_tot-prin_col_tot;
event_data+= '<tr></tr>';
       
}

        }
                
event_data+= '<tr><td style="font-weight:bold;" colspan="2">TOTAL</td>';
event_data+= '<td style="text-align:right;font-weight:bold;">'+Number(trfrct_col_tot).toFixed(2)+'</td>';
event_data+= '<td style="text-align:right;font-weight:bold;">'+Number(trfpay_col_tot).toFixed(2)+'</td>';
event_data+= '<td style="text-align:right;font-weight:bold;">'+Number(trf_bal).toFixed(2)+'</td>';
event_data+= '<td style="text-align:right;font-weight:bold;">'+Number(shrrct_col_tot).toFixed(2)+'</td>';
event_data+= '<td style="text-align:right;font-weight:bold;">'+Number(shrpay_col_tot).toFixed(2)+'</td>';
event_data+= '<td style="text-align:right;font-weight:bold;">'+Number(shr_bal).toFixed(2)+'</td>';
event_data+= '<td style="text-align:right;font-weight:bold;">'+Number(prin_col_tot).toFixed(2)+'</td>';
event_data+= '<td style="text-align:right;font-weight:bold;">'+Number(interestrct_col_tot).toFixed(2)+'</td>';
event_data+= '<td style="text-align:right;font-weight:bold;">'+Number(insurancerct_col_tot).toFixed(2)+'</td>';
event_data+= '<td style="text-align:right;font-weight:bold;">'+Number(loanpaid_col_tot).toFixed(2)+'</td>';
event_data+= '<td style="text-align:right;font-weight:bold;">'+Number(loan_bal).toFixed(2)+'</td>';

event_data+= '</tr>';
                 
//console.log(data[index].ledgerdetails[i].trans_date);
event_data+= '<tr>';








}); //Map
$('#ledger').html(event_data);

} //Success Fun

});



});









$('#ldgSearch').on('click',function(){

  //urlstr = base_url + 'fetchcreditledgerJson';
  urlstr = base_url + 'fetchcreditledgerSearch';
 url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();
   
        console.log('Ledger Account');
 $.ajax({
        url: url+'?fdate=' + fmDate + '&tdate=' + toDate + '&selacc=' + selval, //+ 'fetchReceiptSearch',
        dataType: 'json',
        type: 'get',
        cache:false,
        success: function(data){
        var event_data = '';
console.log(data);
var thriftTotal=0.00;
var principleTotal=0.00;
var t_op = 0.00;
var l_op = 0.00;
var prnadj=0.00;
var opshr=0.00;
var shr_tot=0.00;

  $.each(data, function(index) {
//console.log("O/p DATA : "+data);
opshr = data[index].msharecap;
t_op = data[index].thrift_openingbalance;
 acc_id = data[index].id;
 event_data+= '<div id="printable"><div class="card text-center"><div class="card-header" id="crldgrep"> <h4>CREDIT LEDGER</h4>   </div>  <div class="card-body"> <div class="row"> <div class="col-md-2" style="text-align:left"><label>Member Name</label></div><div class="col-md-2" style="text-align:left"> <b>' + data[index].membername + '</b> </div> <div class="col-md-2" style="text-align:left"><label>Surety Member Name</label> </div><div class="col-md-2" style="text-align:left"> '+ data[index].suretyname +'</div><div class="col-md-2" style="text-align:left"><label>Share Capital</label></div><div class="col-md-2" style="text-align:left">'+ data[index].msharecap +'</div></div><div class="row"><div class="col-md-2" style="text-align:left"><label>Member Number</label></div><div class="col-md-2" style="text-align:left"> '+ data[index].memberid +'</div><div class="col-md-2" style="text-align:left"><label>Surety Member Number</label></div><div class="col-md-2" style="text-align:left"> '+ data[index].suretyid +'</div><div class="col-md-2" style="text-align:left"><label>Page(s) </label></div><div class="col-md-2" style="text-align:left"> 1/1 </div></div></div></div>';

event_data+= '<div class="card text-center"><div class="card-header"> <h4>LEDGER DETAILS</h4>    </div>  <div class="card-body"><table class="table" border="1" id="crldgrep"><tr><th></th><th></th><th colspan="3" style="text-align:center">Thrift Savings</th><th colspan="3" style="text-align:center">Shares</th><th colspan="2" style="text-align:center">Repayment</th><th style="text-align:center">Insurance</th><th colspan="2" style="text-align:center">Loan</th></tr><tr><th style="text-align:center">Date</th><th style="text-align:center">Reference #</th><th style="text-align:center">Receipt</th><th style="text-align:center">Payment</th><th style="text-align:center">Total</th><th style="text-align:center">Receipt</th><th style="text-align:center">Payment</th><th style="text-align:center">Total</th><th style="text-align:center">Principle</th><th style="text-align:center">Interest</th><th></th><th style="text-align:center">Loan Issued</th><th style="text-align:center">Loan Balance</th></tr><tbody>  <tr><td colspan="3"><b>OPENING BALANCE</b></td><td></td><td style="text-align:right"><b>'+ Number(data[index].thrift_openingbalance).toFixed(2) +'</b></td><td></td><td></td><td  style="text-align:right"><b>'+ Number(data[index].msharecap).toFixed(2) +'</b></td><td></td><td></td><td></td><td></td><td style="text-align:right"><b>'+Number(data[index].loan_openingbalance).toFixed(2)+'</b></td></tr>';

//console.log('thrf' + t_op);
      thriftTotal = parseFloat(t_op);
    //  console.log('Tot - : ' + thriftTotal);
              
                var op_bal = Number(data[index].loan_openingbalance);
                principleTotal = op_bal;
                var slen = data[index].ledgerdetails.length;
shr_tot=Number(opshr);                 
                console.log("len :"+slen);
              if(slen>0) {
              //  console.log(slen);
                var rowCount=1;
                var shrrct_col_tot=0;
                var shrpay_col_tot=0;
                var trf_amt=0.00;
                var int_tot=0.00;
                var shr_amt=0.00;
                var accountName='';
                var trfr_tot=0.00;
                var trfp_tot=0.00;
                var ins_tot=0.00;
                var int_amt=0.00;
                var balance=0.00;
                var shr_pay=0.00;
                var shr_rct=0.00;
                var ins_rct=0.00;
                var ins_tot=0.00;
                var prn_amt=0;
                var prn_pay=0;
                var prnp_tot=0;
                var prnr_tot=0;
              var loaniss_tot=0;
              var prnamt_tot=0;                
                for (var i =0; i<slen;  i++) {
                var dbAmt=0.00;
                var crAmt=0.00;
                
               trf_amt=0.00;
               var loaniss_amt=0.00;
               prnadj=0.00;
  //              console.log(i);
        
       //if(data[index].ledgerdetails[i].thrift!=0) {
                var trfRef = data[index].ledgerdetails[i].trans_ref;
                

                   
              //  var loaniss_amt = Number(data[index].ledgerdetails[i].loan_issued);
/*
                var loanadj_amt = Number(data[index].ledgerdetails[i].loan_adj);
                var prn_amt = Number(data[index].ledgerdetails[i].principle);
                if(loanadj_amt!=0)
                {
                  prnadj= loanadj_amt;
                }
                else if(prn_amt!=0)
                {
                  prnadj=prn_amt;
                }
*/
                
                
//console.log(data[index].ledgerdetails[i].trans_date);
event_data+= '<tr>';
 //if(data[index].trans_type=="JOUR") {
//                event_data+= '<td>'+data[index].ledgerdetails[i].trans_date+'</td><td>'+trfRef+'</td>';
//}
if(Number(data[index].ledgerdetails[i].thrift_r)>0)
{
thfr_amt= Number(data[index].ledgerdetails[i].thrift_r).toFixed(2);
}
else
{
thfr_amt= "";
}

event_data+= '<td>'+data[index].ledgerdetails[i].trans_date+'</td><td>'+trfRef+'</td>';

event_data+= '<td style="text-align:right">'+ thfr_amt +'</td>';
if(Number(data[index].ledgerdetails[i].thrift_p)>0)
{
thfp_amt= Number(data[index].ledgerdetails[i].thrift_p).toFixed(2);
}
else
{
thfp_amt= "";
}


trf_amt= Number(data[index].ledgerdetails[i].thrift_r);
trf_pay= Number(data[index].ledgerdetails[i].thrift_p);
                event_data+= '<td style="text-align:right">'+ thfp_amt +'</td>';
               
                event_data+='<td style="text-align:right">'+Number(data[index].ledgerdetails[i].tot_thf).toFixed(2)+'</td>';

if(Number(data[index].ledgerdetails[i].share_r)>0)
{
var shrr_amt= Number(data[index].ledgerdetails[i].share_r).toFixed(2);
}
else
{
var shrr_amt= "";
}


if(Number(data[index].ledgerdetails[i].share_p)>0)
{
var shrp_amt= Number(data[index].ledgerdetails[i].share_p).toFixed(2);
}
else
{
var shrp_amt= "";
}


event_data+= '<td style="text-align:right">'+shrr_amt+'</td>';
                event_data+= '<td style="text-align:right">'+shrp_amt+'</td>';
shr_amt= Number(data[index].ledgerdetails[i].share_r);
shr_pay= Number(data[index].ledgerdetails[i].share_p);
              
                event_data+='<td style="text-align:right">'+Number(data[index].ledgerdetails[i].tot_shr).toFixed(2)+'</td>';

if(Number(data[index].ledgerdetails[i].principle_r)>0)
{
prnr_amt= Number(data[index].ledgerdetails[i].principle_r).toFixed(2);
}
else
{
prnr_amt= "";
}

if(Number(data[index].ledgerdetails[i].principle_p)>0)
{
prnp_amt= Number(data[index].ledgerdetails[i].principle_p).toFixed(2);
}
else
{
prnp_amt= "";
}


if(Number(data[index].ledgerdetails[i].interest_r)>0)
{
intr_amt= Number(data[index].ledgerdetails[i].interest_r).toFixed(2);
}
else
{
intr_amt= "";
}


if(Number(data[index].ledgerdetails[i].insurance_r)>0)
{
insr_amt= Number(data[index].ledgerdetails[i].insurance_r).toFixed(2);
}
else
{
insr_amt= "";
}

               event_data+= '<td style="text-align:right">'+prnr_amt+'</td>';
               event_data+= '<td style="text-align:right">'+intr_amt+'</td>';
               event_data+= '<td style="text-align:right">'+insr_amt+'</td>';

                event_data+= '<td style="text-align:right">'+prnp_amt+'</td>';
prn_amt= Number(data[index].ledgerdetails[i].principle_r);
prn_pay= Number(data[index].ledgerdetails[i].principle_p);
                
                event_data+='<td style="text-align:right">'+Number(data[index].ledgerdetails[i].tot_prn).toFixed(2)+'</td>';
loaniss_tot=loaniss_tot+loaniss_amt;
loaniss_amt = Number(data[index].ledgerdetails[i].principle_p);
shrrct_col_tot = shrrct_col_tot + shr_amt;
shrpay_col_tot = shrpay_col_tot + shr_pay;
shr_bal = Number(data[index].ledgerdetails[i].tot_shr);
//shr_tot = shr_amt+ Number(data[index].ledgerdetails[i].thrift_r);
int_tot = int_tot + Number(data[index].ledgerdetails[i].interest_r);
ins_tot = ins_tot + Number(data[index].ledgerdetails[i].insurance_r);

prnr_tot = prnr_tot + prn_amt;
prnp_tot = prnp_tot + prn_pay;

thriftTotal =  Number(data[index].ledgerdetails[i].tot_thf);
trfr_tot = trfr_tot + Number(trf_amt);
trfp_tot = trfp_tot + Number(trf_pay);

prnamt_tot = Number(data[index].ledgerdetails[i].tot_prn);



                event_data+= '</tr></div></div>';

                event_data += '</tr>';
                console.log(data[index].closingbal);
                
                           loaniss_amt=0.00;
            }

   trf_amt=0.00;

        }
        balance=0.00;

                event_data += '<tr>';
                event_data += '<td colspan="2"><b>CLOSING BALANCE</b></td>';
                event_data += '<td style="text-align:right;"><b>'+ Number(trfr_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+ Number(trfp_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+ Number(thriftTotal).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+Number(shrrct_col_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+Number(shrpay_col_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+Number(shr_bal).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+ Number(prnr_tot).toFixed(2) +'<td style="text-align:right;"><b>'+ Number(int_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+Number(ins_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+ Number(prnp_tot).toFixed(2) +'</b></td><td style="text-align:right;"><b>'+Number(prnamt_tot).toFixed(2) +'</b></td>';
                event_data += '</tr>';
                event_data += '</tbody>';
                event_data += '</table>';
                event_data += '</div></div><hr><br><br></div> ';
trf_tot=0;
console.log(event_data);

});

$('#ledger').html(event_data);


}
});

});


 
 });
</script>


<style type="text/css">
#tophead{
  visibility: hidden; 
}  
@media print
{
body * { visibility: hidden; }
#printable * { visibility: visible; }
#printable { position: absolute; top: 40px; left: 30px; 
font-size: 12px;

}
#tophead
{
  font-size: 30px;
  font-weight: bold;
}
#printable table th { border: 1px solid black; padding: 2px; 
font-size: 15px;
font-weight: bold;

}
#printable table td, table th { border: 1px solid black; padding: 2px;

font-size: 15px;
 }
}
</style>



<style type="text/css">
#crldgrep {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  overflow-x: auto;
}

#crldgrep td, #crldgrep th {
  border: 1px solid #ddd;
  padding: 8px;
}

#crldgrep tr:nth-child(even){background-color: #f2f2f2;}

#crldgrep tr:hover {background-color: #ddd;}

#crldgrep th {
  /*padding-top: 12px;
  padding-bottom: 12px; */
  text-align: left;
  background-color: #4CAF50;
  color: white;

  }

tbody {
    

    overflow: auto;
}
.red-color {
color:red;
}

#flashContent {

  position: absolute;
  left: 200px;
  bottom: 200px;
  z-index: 2;

  width:400px; 
  height:400px; 
  background-color:red;
}
</style>

