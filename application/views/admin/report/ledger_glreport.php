                <!-- /.row -->
<!-- .row -->
<div class="row">
    <div class="white-box col-md-12 col-lg-12 col-xs-12">
        <div class="form-group">
            <form method="post">
            <h3 class="box-title">
            <div class="col-md-6">
          Select Ledger Account for<select id="ldgrSelect" name="ldgrSelect"  class="custom-select col-6 form-control">
<option selected>Choose...</option>
                
            </select>
        </div>
   <div class="col-md-6">             

Select Division <select id="divisionSelect" name="divisionSelect"  class="custom-select col-6 form-control">
<option selected>Choose...</option>
                
            </select>
            </div>

    Period from <input class="form-control" type="date" name="fmDate" id="fmDate"> to <input type="date" class="form-control" name="toDate" id="toDate"><button type="button" id="ldgSearch">Submit</button> </h3>
            
                
</form>


</div>

</div>
</div>

<p>
<div id="ledger"></div>

    
</p>
<br><br>




<script type="text/javascript">
$(document).ready(function() {
var resp="";
var ldgname;
var urlstr = base_url + 'fetchLedgerAccounts';
var url = urlstr.replace("undefined","");

    $("#ldgrSelect").load(url);
$('#ldgrSelect').select2();



var urlstr = base_url + 'fetchDivision';
var url = urlstr.replace("undefined","");

    $("#divisionSelect").load(url);
$('#divisionSelect').select2();



var selval="0";
    console.log(selval);


$('#ldgrSelect').on('change',function(){

    var e = document.getElementById("ldgrSelect");
     selval = e.options[e.selectedIndex].value;
     ldgname = e.options[e.selectedIndex].text;
    console.log("aaaaa "+selval + "ldgname : " + ldgname);
});

var divval="0";
var divname="";
$('#divisionSelect').on('change',function(){

    var e = document.getElementById("divisionSelect");
     divval = e.options[e.selectedIndex].value;
     divname = e.options[e.selectedIndex].text;
    console.log("aaaaa "+divval + "ldgname : " + divname);
});



$('#ldgSearch').on('click',function(){


  urlstr = base_url + 'fetchglledgerJson';
 url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();
  
        console.log('Ledger Account');

 $.ajax({
        url: url+'?fdate=' + fmDate + '&tdate=' + toDate + '&selacc=' + selval + '&divid=' + divval, //+ 'fetchReceiptSearch',
        dataType: 'json',
        type: 'get',
        cache:false,
        success: function(data){
        var event_data = '';
console.log(data);
  $.each(data, function(index) {


 acc_id = data[index].id;
                event_data += '<div class="row"><h3 class="box-title">General Ledger Account for  ' + ldgname + ' - ( Period from '+ fmDate +' to '+ toDate +' ) </h3>';  
                event_data += '<table id="glTbl" class="table table-striped table-bordered table-sm">';
                event_data += '<thead><th>Trans Ref#</th>';
                event_data += '<th>Date</th>';
                event_data += '<th>Reference</th>';
                event_data += '<th>Particulars</th>';
                event_data += '<th style="text-align:right">Debit</th>';
                event_data += '<th style="text-align:right">Credit</th>';
                event_data += '<th style="text-align:right">Balance</th></thead>';  
                event_data += '<tbody>';  

                event_data += '<tr>';
                event_data += '<td colspan="4">OPENING BALANCE</td>';
                event_data += '<td></td><td></td><td style="text-align:right"><strong>'+data[index].openingbalance+'</strong></td>';
                event_data += '</tr>';
                var op_bal = Number(data[index].openingbalance);
                var slen = data[index].ledgerdetails.length;
              if(slen>0) {
              //  console.log(slen);
                var accountName='';
                var balance=0.00;
                var db_tot =0.00;
                var cr_tot = 0.00;

                for (var i =0; i<slen;  i++) {
                var dbAmt=0.00;
                var crAmt=0.00;
                
                console.log(i);

                event_data += '<tr>';
                event_data += '<td>'+data[index].ledgerdetails[i].trans_id+'</td>';
                event_data += '<td>'+data[index].ledgerdetails[i].trans_date+'</td>';
                event_data += '<td>'+data[index].ledgerdetails[i].cheque_ref+'</td>';
                event_data += '<td>'+data[index].ledgerdetails[i].acc_name+'</td>';
                if(data[index].ledgerdetails[i].debit!=0) {
                    dbAmt = data[index].ledgerdetails[i].debit;
                }
                else {
                    dbAmt="";
                }
                event_data += '<td style="text-align:right">'+dbAmt+'</td>';
                 
                 if(data[index].ledgerdetails[i].credit!=0) {
                crAmt = data[index].ledgerdetails[i].credit;
                
                } else {
                    crAmt ="";
                }
event_data += '<td style="text-align:right">'+crAmt+'</td>';
                db_tot += Number(dbAmt);
                cr_tot += Number(crAmt);

                //balance=Number(data[index].ledgerdetails[i].thrift)+Number(data[index].ledgerdetails[i].principle)+Number(data[index].ledgerdetails[i].interest);
              //  event_data += '<td style="text-align:right">'+data[index].ledgerdetails[i].bal_tot+'</td>';
 //               event_data += '<td>'+data[index].action+'</td>';
                balance = Number(op_bal)+Number(db_tot)-Number(cr_tot);
              event_data += '<td style="text-align:right; font:bold">'+data[index].ledgerdetails[i].bal +'</td></tr>';
 db_tot=0;
 cr_tot=0;
                console.log(data[index].closingbal);
                
               
            }


        }
        balance=0.00;

                event_data += '<tr>';
                event_data += '<td colspan="3">CLOSING BALANCE</td>';
                event_data += '<td></td><td style="text-align:right"><strong>'+data[index].dbTot +'</strong></td><td style="text-align:right"><strong>'+data[index].crTot +'</strong></td><td style="text-align:right"><strong>'+data[index].closingbal +'</strong></td>';
                event_data += '</tr>';
                event_data += '</tbody>';
                event_data += '</table>';
                event_data += '</div><div class="clear"></div><div class="clear"></div><div class="clear"></div><div class="clear"></div>';


});
console.log(event_data);
$('#ledger').html("");
$('#ledger').html(event_data);

 //manageldgrepTable = $("#ldgrep").dataTable();
}
});

});


 
});
</script>


<style type="text/css">
#glTbl {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  overflow-x: auto;
}

#glTbl td, #glTbl th {
  border: 1px solid #ddd;
  padding: 8px;
}

#glTbl tr:nth-child(even){background-color: #f2f2f2;}

#glTbl tr:hover {background-color: #ddd;}

#glTbl th {
  /*padding-top: 12px;
  padding-bottom: 12px; */
  text-align: left;
  background-color: #4CAF50;
  color: white;

  }

tbody {
    

    overflow: auto;
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