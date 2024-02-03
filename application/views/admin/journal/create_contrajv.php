 <!-- /.row -->
  <!-- Nav tabs -->
 <!-- <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#member_rct">Member Journal</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#division_rct">Division Journal</a>
    </li>
  </ul> -->

  <!-- Tab panes -->
  


    


                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><i class="fa fa-document"></i> Contra Journal</div>

<div id="add-jv-message"></div>
                                    

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <!--
                                        <div class="form-body">
                                            <h3 class="box-title">Contra Journal Voucher</h3>


                                         </div>      -->

                                          



<form action="createCJournal" method="post" class="form-horizontal" id="createJournalForm">


<div class="row">
  <div class="col-md-12">

<!--
<table>
  <td><label>JV # &nbsp;</label></td><td><input type="text" style="width:100px" value="<?php echo $journal_id;  ?>" id="journal_id" name="journal_id" autocomplete="off" readonly ></td>

<td>&nbsp;  <label>JV Date &nbsp;</label></td><td><input required type="date" name="jvdate" id="jvdate"></td>
</table>
  </div> -->
<br>
<hr>
<div class="row col-md-6">
        <div class="form-group">

          <div class="input-group ">
          <label class="control-label">Date</label>
  
            <input type="text" class="form-control" id="jvdate" name="jvdate" autocomplete="off" placeholder="dd-mm-yyyy" required>
            <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-calendar" id="dtp"></i></span>
              </div>
          </div>
        </div>
</div>

  <div class="col-md-12">
    <table class="scroll table-responsive card-list-table"  id="jvtbl">
    <thead>
      <th>DB/CR</th>
      <th style="width: 100%">ACCOUNT NAME</th>
      <th>AMOUNT</th>
      <th>ACTION</th>
    </thead>
      <tbody>
    <tr>
    <td><select  onchange="getval(this)" name="dbcr[]" id="dbcr1">
      <option value="DB">DB</option>
      
    </select></td> 
    <td><select  id="accountname1" name="accountname[]" style="width: 100%;" required>
      
    </select></td>
    <td><input type="Number" name="transamount[]" required id="transamount1" class="amt" placeholder="0.00" style="text-align: right; width: 100px;"></td>
    <td><div class="btn-group"><button type="button" class="btn btn-info btn-circle btn-xs center-block" onclick="add_btn()"><i class="fa fa-plus"></i></button></div>
      
    </tr>
      
      </tbody>

    </table>
                               <div class="form-group">
                                    <label class="col-md-6" for="paydate">Narration
                                    </label>
                                        <input type="text" id="jvnarration" name="jvnarration" class="form-control mydatepicker" placeholder="Narration"  autocomplete="off" >
                                </div>

  </div>
</div>


<button type="submit" class="btn btn-info btn-rounded btn-sm waves-effect waves-light m-r-10">Submit</button>
<button type="button" id="btn_reset" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">Cancel</button>
                           
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
</form>
     </div> 
     </div>
     </div>
     </div>
     </div>













<script type="text/javascript">

    $(document).ready(function(){

var urlstr = base_url + 'fetchLedgerAccounts';
var url = urlstr.replace("undefined","");

$("#accountname1").load(url);
$('#accountname1').select2();
    var arrHead = new Array();
    arrHead = ['Emp. Name', 'Designation', 'Age',''];      // SIMPLY ADD OR REMOVE VALUES IN THE ARRAY FOR TABLE HEADERS.

$('#dbcr').on('change', function() {
  alert( this.value );
});


   $("#dtp").on('click',function(){
    $("#jvdate").focus();

   $("#jvdate").datepicker({format:"dd-mm-yyyy",  autoclose: true,
   beforeShow: function() {
        setTimeout(function(){
            $('.ui-datepicker').css('z-index', -1);
        }, 0);
    }
}); 
   });
   $("#jvdate").datepicker({format:"dd-mm-yyyy",  autoclose: true,
     beforeShow: function() {
        setTimeout(function(){
            $('.ui-datepicker').css('z-index', -1);
        }, 0);
    }
 });


$('#dbcddr').on('change',function() {

    var btn = $(this);
    btn.prop("disabled", true);
  var id = btn.closest("tr").find("input[name='accountname']").val();
    console.log("id field value:", id);

  });



$("#debitaccountName").typeahead({
    items: 4,
    source: function(request, response) {
    var urlstr = base_url + 'fetchAccountlist';
var url = urlstr.replace("undefined","");



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
                $('#debitaccountNumber').val(item.id);
      
        return item.account_name;
    }
});





$("#creditaccountName").typeahead({
    items: 4,
    source: function(request, response) {
    var urlstr = base_url + 'fetchAccountlist';
var url = urlstr.replace("undefined","");



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
                $('#creditaccountNumber').val(item.id);
                $('#creditmemberNumber').val(item.member_id);
      
        return item.account_name;
    }
});



    var urlstr = base_url + 'fetchLdgAccounts';
var url = urlstr.replace("undefined","");


    $("#cash_bank").load(url);


  $('#cash_bank').change(function(event) {
        $('#itemName').val($('#cash_bank option:selected').text());
    });





    $("#createJournalForm").unbind('submit').bind('submit', function() {
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
window.location.reload();
});
$("#createJournalForm").trigger("reset");   
$("#jvtbl tbody tr").remove();

  
var rowCount = $('#jvtbl tr').length;

var newTableRow = '<tr><td><select onchange="getval(this)" id="dbcr'+rowCount+'" name="dbcr[]"><option value="DB">DB</option><option value="CR">CR</option></select></td><td><select id="accountname'+rowCount+'" name="accountname[]" style="width: 100%"></select></td><td><input type="Number" name="transamount[]" class="amt" id="transamount'+rowCount+'" class="form-control"  style="text-align: right; width:100px;" placeholder="0.00"></td><td><div class="btn-group"><button type="button" class="btn btn-info btn-circle btn-xs center-block" onclick="add_btn()"><i class="fa fa-plus"></i></button></div>';
var newTableRowObj = $(newTableRow);
newTableRowObj.hide();
$('#jvtbl tr:last').after(newTableRowObj);
newTableRowObj.fadeIn("slow");
var urlstr = base_url + 'fetchLedgerAccounts';
var url = urlstr.replace("undefined","");

    $("#accountname"+rowCount).load(url);
$('#accountname'+rowCount).select2();


                    }   
                    else {                                  
                        console.log(response);
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

  //$("#jvtbl tbody tr").remove();
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





function subamtCalc() {

    var subamt_sum = 0;
    var net_pay=0;
    $('.subamt').each(function() {
        subamt_sum+= Number($(this).val());
    });
    

    $("#credit_amt").val(Number(subamt_sum));
    var camt=$("#credit_amt").val();
    var damt=$("#debit_amt").val();

    if (Number(damt)!=Number(camt)) {
      $('#credit_amt').css('border-color', 'red');
      $('#debit_amt').css('border-color', 'red');
    return true;
    }
    else {
      $('#credit_amt').css('border-color', 'green');
      $('#debit_amt').css('border-color', 'green');
      //alert("Equal");
    }


}



$('.subamt').keyup(function(){
 
    var amt = $(this).val();
   console.log(amt);
    subamtCalc();

});



$("#credit_amt, #debit_amt").keyup(function () {
    var camt=$("#credit_amt").val();
    var damt=$("#debit_amt").val();
    if (Number(damt)!=Number(camt)) {
      $('#credit_amt').css('border-color', 'red');
      $('#debit_amt').css('border-color', 'red');
      //$('#Journal_cramt').removeClass('cssText').addClass('has-warning has-feedback m-b-40');
      //$('#Journal_dramt').removeClass('cssText').addClass('has-warning has-feedback m-b-40');
     // alert("Second value should less than first value");
    return true;
    }
    else {
      $('#credit_amt').css('border-color', 'green');
      $('#debit_amt').css('border-color', 'green');
      //alert("Equal");
    }
  })



$('#btn_reset').click(function(){
$("#jvtbl tbody tr").remove();
var rowCount = $('#jvtbl  tr').length;
  $('#createJournalForm').trigger("reset");
    $('#createJournalForm').trigger("reload");

var newTableRow = '<tr><td><select onchange="getval(this)" id="dbcr'+rowCount+'" name="dbcr[]"><option value="DB">DB</option><option value="CR">CR</option></select></td><td><select id="accountname'+rowCount+'" name="accountname[]" style="width: 100%"></select></td><td><input type="Number" name="transamount[]" class="amt" id="transamount'+rowCount+'" class="form-control"  style="text-align: right; width:100px;" placeholder="0.00"></td><td><div class="btn-group"><button type="button" class="btn btn-info btn-circle btn-xs center-block" onclick="add_btn()"><i class="fa fa-plus"></i></button></div>';
var newTableRowObj = $(newTableRow);
newTableRowObj.hide();
$('#jvtbl tr:last').after(newTableRowObj);
newTableRowObj.fadeIn("slow");




var urlstr = base_url + 'fetchLedgerAccounts';
var url = urlstr.replace("undefined","");

    $("#accountname"+rowCount).load(url);
$('#accountname'+rowCount).select2();


});

});


function add_btn()
{
console.log('Click add_row');
var rowCount = $('#jvtbl tr').length;
var newTableRow = '<tr><td><select onchange="getval(this)" id="dbcr'+rowCount+'" name="dbcr[]"><option value="DB">DB</option><option value="CR">CR</option></select></td><td><select id="accountname'+rowCount+'" name="accountname[]" style="width: 100%"></select></td><td><input type="Number" name="transamount[]" class="amt" id="transamount'+rowCount+'" class="form-control"  style="text-align: right; width:100px;" placeholder="0.00"></td><td><div class="btn-group"><button type="button" class="btn btn-info btn-circle btn-xs center-block" onclick="add_btn()"><i class="fa fa-plus"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-circle btn-xs center-block" onclick="del_btn()"><i class="fa fa-times"></i></button></div>';
var newTableRowObj = $(newTableRow);
newTableRowObj.hide();
$('#jvtbl tr:last').after(newTableRowObj);
newTableRowObj.fadeIn("slow");


var urlstr = base_url + 'fetchLedgerAccounts';
var url = urlstr.replace("undefined","");

    $("#accountname"+rowCount).load(url);
$('#accountname'+rowCount).select2();


}




function getval(sel)
{
  var db_cr=sel.value;

var sum = 0;

  //alert(sel.index);
  // var rowId = sel.parentNode.rowIndex;
 // alert($(this).closest('td').parent()[0].sectionRowIndex);
 //alert(sel.rowIndex);
console.log(db_cr);

  if(db_cr=="CR") {
    var rowCount = $('#jvtbl tr').length -1;
  $('.amt').each(function(index) { 
      sum = Number(sum) + Number($(this).val());
      console.log(sum);
        //  $('<p>' + $sum + '</p>').insertAfter('h2:contains(Sum)');
  });
  //rowCount = $('#jvtbl tr').length;
  
  console.log(rowCount);
$('#transamount'+rowCount).val(sum);
}



/*
    $("#debitamount").prop("hidden",true);
$("#creditamount").prop("hidden",false);
  } else {
$("#creditamount").prop("hidden",true);
$("#debitamount").prop("hidden",false);
  } */
 /*  var btn = $(this);
    btn.prop("hidden", true);
  var id = btn.closest("tr").find("select[name='dbcr']").val();
    console.log("id field value:", id); */


}

</script>


<style type="text/css">
#jvtbl {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  overflow-x: auto;
}

#jvtbl td, #jvtbl th {
  border: 1px solid #ddd;
  padding: 8px;
}

#jvtbl tr:nth-child(even){background-color: #f2f2f2;}

#jvtbl tr:hover {background-color: #ddd;}

#jvtbl th {
  /*padding-top: 12px;
  padding-bottom: 12px; */
  text-align: left;
  background-color: #4CAF50;
  color: white;

  }

tbody {
    

    overflow: auto;
}
</style>