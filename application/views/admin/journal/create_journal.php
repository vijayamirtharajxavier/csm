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
                            <div class="panel-heading"><i class="fa fa-document"></i> Journal</div>

<div id="add-jv-message"></div>
                                    

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    
                                        <div class="form-body">
                                            <h3 class="box-title">Journal Voucher</h3>


                                         </div>      

                                            <hr>



<form action="createJournal" method="post" class="form-horizontal" id="createJournalForm">
<table class="table">
  <tbody>
  <tr>
    <td>
                                    <div class="form-group">
                                    <label for="example-text">Journal Number
                                    </label>
                                        <input type="text"  value="<?php echo $journal_id;  ?>" id="journal_id" name="journal_id" class="form-control" autocomplete="off"  readonly>
                                    </div>

</td><td>                                <div class="form-group">
                                    <label >Journal Date
                                    </label>
                                        <input type="date" id="journal_date" name="journal_date" autocomplete="off"  class="form-control mydatepicker">
                                </div>
                              </td><td rowspan="5">             
                                  <table id="tblJournal">
                                  <th>Account Name</th>
                                  <th style="text-align: right;">Amount</th>
                                  <tbody>
                                 <?php $x=0; foreach ($subacc as $key=> $svalue)

                                  {  ?>
                                    <input type="text" id="itemid<?php echo $x ?>" value="<?php echo $svalue['id'] ?>" name="itemid[<?php echo $x ?>]" hidden>
                                    <input type="tex" id="itemname<?php echo $x ?>" value="<?php echo $svalue['item_name'] ?>" name="itemname[<?php echo $key ?>]" hidden>
                                  <tr><td><b><?php echo $svalue['item_name'] ?></b> 
                                    
                                    </td>  <td>
                                    <input type="text" id="itemamount<?php echo $x ?>" name="itemamount[<?php echo $x ?>]"  placeholder="0.00" style="text-align: right;" class="form-control subamt" autocomplete="off">
                                    </td>
                                  </tr>
<?php 

       // $data['subacclist'] = $srow['item_name'];
       $x++; } ?>
                                        
                                  </tbody>
                                </table>
</td>
  </tr>
  <tr>
    <td>                                <div class="form-group">
                                    <label  >Debit To
                                    </label>
                                 <input type="text" id="debitaccountName" name="debitaccountName" autocomplete="off" class="form-control typeahead" placeholder="Account Name" required>
                                 
                                </div>
</td>
<td>                                <div class="form-group">
                                    <label  for="paydate">Total Amount
                                    </label>
                                        <input type="text" id="debit_amt" name="debit_amt" autocomplete="off"  class="form-control dramt" placeholder="0.00" style="text-align: right;" required>
                                </div>
</td>
    
  </tr>
  <tr>
    <td>                                <div class="form-group" id="creditldgr">
                                    <label class="col-md-6" >Credit to
                                    </label>
                                 <input type="text" id="creditaccountName" name="creditaccountName" autocomplete="off" class="form-control typeahead" placeholder="Account Name" required>
                                 
                                </div>
</td>
<td>                                <div class="form-group">
                                    <label class="col-md-6" for="paydate">Total Amount
                                    </label>
                                        <input type="text" id="credit_amt" name="credit_amt" autocomplete="off"  class="form-control cramt" placeholder="0.00" style="text-align: right;" required>
                                </div>
</td>
  </tr>
  <tr><td colspan="3">
                               <div class="form-group">
                                    <label class="col-md-6" for="paydate">Narration
                                    </label>
                                        <input type="text" id="jvnarration" name="jvnarration" class="form-control mydatepicker" placeholder="Narration"  autocomplete="off" >
                                </div>
     
  </td></tr>
  </tbody>
</table>


                                 <input type="text" id="debitaccountNumber" name="debitaccountNumber" hidden>
                                 <input type="text" id="creditaccountNumber" name="creditaccountNumber" hidden>
                                 <input type="text" id="creditmemberNumber" name="creditmemberNumber" hidden>

                                 <input type="text" id="itemName" name="itemName" hidden>

 


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
});

$("#createJournalForm").trigger("reset");                 
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

  $("#journalTbl tbody tr").remove();
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
  $('#createJournalForm').trigger("reset");
    $('#createJournalForm').trigger("reload");
});

});

</script>


