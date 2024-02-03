                <!-- /.row -->
<!-- .row -->
<div class="row">
    <div class="white-box col-md-12 col-lg-12 col-xs-12">
        <div class="form-group">
            <form method="post">
            <h3 class="box-title">
            
          Select Ledger Account for<select id="ldgrSelect" name="ldgrSelect"  class="custom-select col-6 form-control">
<option selected>Choose...</option>
                
            </select>Period from <input class="form-control" type="date" name="fmDate" id="fmDate"> 
         to <input type="date" class="form-control" name="toDate" id="toDate"><button type="button" id="ldgSearch">Submit</button> </h3>
            
                
</form>
 </div></div></div>

<div id="ledger">

</div>




<script type="text/javascript">
    $(document).ready(function() {
var resp="";

var urlstr = base_url + 'fetchLedgerAccounts';
var url = urlstr.replace("undefined","");

    $("#ldgrSelect").load(url);
$('#ldgrSelect').select2();
var selval="0";
    console.log(selval);


$('#ldgrSelect').on('change',function(){

    var e = document.getElementById("ldgrSelect");
     selval = e.options[e.selectedIndex].value;
    console.log(selval);
});




$('#ldgSearch').on('click',function(){

//console.log(ldgrSelect);


//$('#ldgrSelect').load(url);


  urlstr = base_url + 'fetchledgerJson';
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
  $.each(data, function(index) {


 acc_id = data[index].id;
                event_data += '<div class="row"><div class="col-md-12 col-lg-12 col-xs-12"><div class="white-box"><h3 class="box-title">General Ledger Account for  ' + data[index].accname + ' - ( Period from '+ fmDate +' to '+ toDate +' ) </h3><div class="flot-chart"><div class="sales-bars-chart" style="height: 320px;">';  
                event_data += '<table class="table table-striped" id="ldgrep">';
                event_data += '<th>Date</th>';
                event_data += '<th>Particulars</th>';
                event_data += '<th style="text-align:right">Debit</th>';
                event_data += '<th style="text-align:right">Credit</th>';
                event_data += '<th style="text-align:right">Balance</th>';  
                event_data += '<tbody>';  

                event_data += '<tr>';
                event_data += '<td colspan="2">OPENING BALANCE</td>';
                event_data += '<td></td><td></td><td style="text-align:right">'+data[index].openingbalance+'</td>';
                event_data += '</tr>';
                var op_bal = Number(data[index].openingbalance);
                var slen = data[index].ledgerdetails.length;
              if(slen>0) {
              //  console.log(slen);
                var accountName='';
                var balance=0.00;
                for (var i =0; i<slen;  i++) {
                var dbAmt=0.00;
                var crAmt=0.00;
                
                console.log(i);
                /*
                if (data[index].ledgerdetails[i].acc_id==acc_id && data[index].ledgerdetails[i].dbcr=="db" && data[index].ledgerdetails[i].trans_type=="JOURNAL") {
                  dbAmt=0.00;
                  accountName='';
                  accountName = data[index].ledgerdetails[i].acc_name;
                  dbAmt =  data[index].ledgerdetails[i].trans_amount;

                }

                if (data[index].ledgerdetails[i].cash_bank_id==acc_id && data[index].ledgerdetails[i].dbcr=="cr" && data[index].ledgerdetails[i].trans_type=="RECEIPT") {
                  crAmt=0.00;
                  accountName='';
                  accountName = data[index].ledgerdetails[i].acc_name;

                  crAmt =  data[index].ledgerdetails[i].trans_amount;
                   }

               /* if (data[index].ledgerdetails[i].acc_id==acc_id) {
                  crAmt=0.00;
                  accountName='';
                  accountName = data[index].ledgerdetails[i].acc_name;

                  crAmt =  data[index].ledgerdetails[i].cr_amount;
                   }     */          

                event_data += '<tr>';
                event_data += '<td>'+data[index].ledgerdetails[i].trans_date+'</td>';
                //event_data += '<td>'+accountName+'</td>';
                
                event_data += '<td>THRIFT</td><td style="text-align:right">'+data[index].ledgerdetails[i].thrift+'</td></tr>';
                
                event_data += '<tr><td></td><td>SURITY LOAN</td><td style="text-align:right">'+data[index].ledgerdetails[i].principle+'</td></tr>';
                event_data += '<tr><td></td><td>INTEREST</td><td style="text-align:right">'+data[index].ledgerdetails[i].interest+'</td></tr>';
               
                balance=Number(data[index].ledgerdetails[i].thrift)+Number(data[index].ledgerdetails[i].principle)+Number(data[index].ledgerdetails[i].interest);
              //  event_data += '<td style="text-align:right">'+data[index].ledgerdetails[i].bal_tot+'</td>';
 //               event_data += '<td>'+data[index].action+'</td>';
               event_data += '<tr><td></td><td></td><td style="text-align:right; font:bold">'+balance+'</td></tr>';

                console.log(data[index].closingbal);
                
               
            }


        }
        balance=0.00;

                event_data += '<tr>';
                event_data += '<td colspan="2">CLOSING BALANCE</td>';
                event_data += '<td></td><td></td><td style="text-align:right">'+data[index].closingbal +'</td>';
                event_data += '</tr>';
                event_data += '</tbody>';
                event_data += '</table>';
                event_data += '</div> </div> </div></div></div>';


});

$('#ledger').html(event_data);


}
});

});


 
 });
</script>