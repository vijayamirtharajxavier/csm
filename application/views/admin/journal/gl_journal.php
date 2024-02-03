<!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Journal Entry Details</h3>


                            <div class="pull-right">
                                <label>From</label>  
                            <input type="date" name="fmDate" id="fmDate">
                            
                            

                            
                            
                                <label>To</label>  
                            <input type="date" name="toDate" id="toDate">
                            
                            
                            <button id="search_btn" type="button" class="btn btn-primary btn-rounded">Submit</button>
                           <!-- <button id="search" type="submit" class="btn btn-primary btn-rounded">Search</button>-->
                            </div>
                            
                            <hr>
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> All Journal Entry`s
        
        
         <?php if ($this->session->userdata('role') == 'admin'): ?>
                    <a href="" class="btn btn-info btn-sm pull-right"  data-toggle="modal" data-target="#add-journal-modal"><i class="fa fa-plus"></i>&nbsp;New Journal</a> &nbsp;
                 
                    <!--<a href="<?php //echo base_url('admin/journal/create_journal') ?>" class="btn btn-info btn-sm pull-right" ><i class="fa fa-plus"></i>&nbsp;New Journal</a> &nbsp;  -->
                <?php else: ?>
                    <!-- check logged user role permissions -->

                    <?php if(check_power(1)):?>
                        <a href="<?php echo base_url('admin/user') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp;New User</a>
                    <?php endif; ?>
                <?php endif ?>
        
        </div>
        
                <div class="panel-body table-responsive">
        
         <?php $msg = $this->session->flashdata('msg'); ?>
            <?php if (isset($msg)): ?>
                <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>

            <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>


                            <div class="table-responsive">
                                <table id="journalTable" class="display table">
                                    <thead>

                                        <tr>
                                          <th></th>
                                           <th>Division</th>
                                            
                                            <th>Journal Date</th>
                                            <th>Debit Account Name</th>
                                            <th>Credit Account Name</th>
                                            <th>Debit Amount</th>
                                            <th>Credit Amount</th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

                <!-- /.row -->




<!-- Modal -->

<div id="add-journal-modal" class="fade modal" role="dialog">

    <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Journal</h4>
      </div>
      

        <div id="add-journal-message"></div>
        <form action="createJournal" method="post" class="form-horizontal" id="createJournalForm">
      <div class="modal-body">
    


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

 
                            
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

     </div> 
     </div>
     </div>
     </div>
     </div>


    

    </div>
        
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
      <!-- /modal-body -->
    <div class="modal-footer">
        <button type="submit" id="update_btn" class="btn btn-success" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
 </form>
    </div>
  </div>
</div>





<div id="edit-journal-modal" class="fade modal" role="dialog">

    <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Journal</h4>
      </div>
      

        <div id="edit-journal-message"></div>
        <form action="update_journal" method="post" class="form-horizontal" id="editjournalForm">
      <div class="modal-body">
        <div id="show-edit-journal-result"></div>
    </div>
        
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
      <!-- /modal-body -->
    <div class="modal-footer">
        <button type="submit" id="update_btn" class="btn btn-success" >Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
 </form>
    </div>
  </div>
</div>





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








<script>
         
$(document).ready(function(){

var table;
/*
$('#journalTable tbody').on( 'click', 'td', function () {
    
     console.log(table.cell( this ).data());
} );
*/



var urlstr = base_url + 'fetchAccountlist';
var url = urlstr.replace("undefined","");

var productNames = new Array();
var productIds = new Object();


window.base_url = <?php echo json_encode(base_url('admin/journal/')); ?>;

$("#debitaccountName").typeahead({

    source: function (query, process) {
        return $.get(base_url + 'fetchAccountlist', { qry: query }, function (data) {
      //     console.log(data);

            productNames=new Array();;
 $.each( JSON.parse(data), function ( index, product )
            {
                productNames.push( product.account_name );
            //    $('#debitaccountNumber').val(product.id);

              //  productIds[product.account_name] = product.id;
            } );
            return process(productNames);
        });
    },afterSelect: function(item) {
        //value = the selected object
        //e.g.: {State: "South Dakota", Capital: "Pierre"}
  //      console.log(item);
    var urlstr = base_url + 'fetchAccountlistbyname';
    var url = urlstr.replace("undefined","");
        return $.get(base_url + 'fetchAccountlistbyname', { itemkeyword: item }, function (response) {
           // console.log(items);

$.map(JSON.parse(response),function(items){
//console.log(items['id']);
    $('#debitaccountNumber').val(items['acclink_id']);
    $('#debitmemberNumber').val(items['acclink_id']);
    return items['id'];
   });

});

    }
   // autoSelect: true,
    
});




$("#creditaccountName").typeahead({

    source: function (query, process) {
        return $.get(base_url + 'fetchAccountlist', { qry: query }, function (data) {
      //     console.log(data);

            productNames=new Array();;
 $.each( JSON.parse(data), function ( index, product )
            {
                productNames.push( product.account_name );
             //   $('#creditaccountNumber').val(product.id);

              //  productIds[product.account_name] = product.id;
            } );
            return process(productNames);
        });
    },afterSelect: function(item) {
        //value = the selected object
        //e.g.: {State: "South Dakota", Capital: "Pierre"}
  //      console.log(item);
    var urlstr = base_url + 'fetchAccountlistbyname';
    var url = urlstr.replace("undefined","");
        return $.get(base_url + 'fetchAccountlistbyname', { itemkeyword: item }, function (response) {
           // console.log(items);

$.map(JSON.parse(response),function(items){
//console.log(items['id']);
    $('#creditaccountNumber').val(items['acclink_id']);
    $('#creditmemberNumber').val(items['acclink_id']);
    return items['id'];
   });

});

    }
   // autoSelect: true,
    
});



$('.subamt').keyup(function(){
 
    var amt = $(this).val();
   console.log(amt);
    addsubamtCalc();

});



$('.dramt').keyup(function(){
 
    var amt = $(this).val();
   console.log(amt);
    addsubamtCalc();

});




$('.cramt').keyup(function(){
 
    var amt = $(this).val();
   console.log(amt);
    addsubamtCalc();

});





/*
console.log('rect rep');
    var urlstr = base_url + 'fetchJournalData';
var url = urlstr.replace("undefined","");
*/
  // Add event listener for opening and closing details
   $('#journalTable tbody').on('click', 'td.details-control', function () {
    console.log('clicked tbody');
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
        }
        else {
          // Open this row
          row.child( format(row.data()) ).show();
          tr.addClass('shown');
        }
    });




$('#search_btn').on('click',function() {
 urlstr = base_url + 'fetchglJournalentryData';
 url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();

//var table = $('#journalTable').DataTable( {

 table = $('#journalTable').DataTable({
       // "ajax": url, //'../ajax/data/arrays.txt'
         //'order' : [],
    'destroy' : true,
    'ajax': base_url + 'fetchglJournalentryData'+'?fdate=' + fmDate + '&tdate=' + toDate,
    'columns': [
        {
            
            'className':'details-control',
            'orderable':false,
            'data': null,
            'defaultContent': ''
        },
        { "data": "division_id" },
      //  { "data": "journal_number" },
        { "data": "journal_date" },
        { "data": "debit_accountname" },
        { "data": "credit_accountname" },
        { "data": "debit_amount", render: $.fn.dataTable.render.number(',', '.', 2, '')  },
        { "data": "credit_amount", render: $.fn.dataTable.render.number(',', '.', 2, '')  }
        //{ "data": "action" }


    ],

    'order': [[2, 'asc']]
},    {
                "targets": [ 1 ],
                "visible": false
            } );






$('#journalTable tbody').on('click', 'td.details-control', function () {
 console.log('teststesetestasetatete');
    var tr = $(this).closest('tr');
    var row = table.row( tr );
 
    if ( row.child.isShown() ) {
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        row.child( format(row.data()) ).show();
        tr.addClass('shown');
    }
} );

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


get_Settings_id();


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


});






function addsubamtCalc() {

    var subamt_sum = 0;
    var net_pay=0;
    $('.subamt').each(function() {
        subamt_sum+= Number($(this).val());
    });
    

    $("#credit_amt").val(Number(subamt_sum));
    var camt=$("#credit_amt").val();
    var damt=$("#debit_amt").val();


var bal = parseFloat(damt)-parseFloat(camt);
console.log(bal);
console.log(parseFloat(damt)-parseFloat(camt));
    if (Number(bal)!=0) {
      $('#credit_amt').css('border-color', 'red');
      $('#debit_amt').css('border-color', 'red');
   // return true;
    }
    else {
      $('#credit_amt').css('border-color', 'green');
      $('#debit_amt').css('border-color', 'green');
      //alert("Equal");
    }



}

function get_Settings_id()
{
   urlstr = base_url + 'getSettings';
 url = urlstr.replace("undefined","");
    $.ajax( {
        url: url,//'/api/staff/details',
       // dataType: 'json',
        success: function ( json ) {
//        console.log(json);
var obj = JSON.parse(json);

$('#journal_id').val(obj['journal_id'] +'/'+ obj['year']);


      //   var jid = json['journal_id'];
       //  console.log(jid);
        }
    } );

}


function format (rowData) {
 //console.log('rowData' + rowData);

   urlstr = base_url + 'fetchItemData';
 url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();

    var div = $('<div/>')
        .addClass( 'loading' )
        .text( 'Loading...' );
 
    $.ajax( {
        url: url,//'/api/staff/details',
        data: {
            jvno: rowData.division_id,fdate: fmDate,tdate: toDate
        },
       // dataType: 'json',
        success: function ( json ) {
         // console.log(json);
            div
                .html(json)
                .removeClass( 'loading' );
        }
    } );
 
    return div;
}





function debitAcctTypeahead($els) {
console.log('you are in right track'+ $els);

    var urlstr = base_url + 'fetchAccountlist';
var url = urlstr.replace("undefined","");

var productNames = new Array();
var productIds = new Object();




$els.typeahead({

    source: function (query, process) {
        return $.get(base_url + 'fetchAccountlist', { qry: query }, function (data) {
      //     console.log(data);

            productNames=new Array();;
 $.each( JSON.parse(data), function ( index, product )
            {
                productNames.push( product.account_name );
              //  $('#editdebitaccountNumber').val(product.id);

              //  productIds[product.account_name] = product.id;
            } );
            return process(productNames);
        });
    },afterSelect: function(item) {
        //value = the selected object
        //e.g.: {State: "South Dakota", Capital: "Pierre"}
  //      console.log(item);
    var urlstr = base_url + 'fetchAccountlistbyname';
    var url = urlstr.replace("undefined","");
        return $.get(base_url + 'fetchAccountlistbyname', { itemkeyword: item }, function (response) {
           // console.log(items);

$.map(JSON.parse(response),function(items){
//console.log(items['id']);
    $('#editdebitaccountNumber').val(items['acclink_id']);
    $('#editdebitmemberNumber').val(items['acclink_id']);
    return items['id'];
   });

});

    }
   // autoSelect: true,
    
});
}



function creditAcctTypeahead($els) {
//console.log('you are in right track'+ $els);

    var urlstr = base_url + 'fetchAccountlist';
var url = urlstr.replace("undefined","");

var productNames = new Array();
var productIds = new Object();




$els.typeahead({

    source: function (query, process) {
        return $.get(base_url + 'fetchAccountlist', { qry: query }, function (data) {
      //     console.log(data);

            productNames=new Array();;
 $.each( JSON.parse(data), function ( index, product )
            {
                productNames.push( product.account_name );
             //   $('#editcreditaccountNumber').val(product.id);

              //  productIds[product.account_name] = product.id;
            } );
            return process(productNames);
        });
    },afterSelect: function(item) {
        //value = the selected object
        //e.g.: {State: "South Dakota", Capital: "Pierre"}
  //      console.log(item);
    var urlstr = base_url + 'fetchAccountlistbyname';
    var url = urlstr.replace("undefined","");
        return $.get(base_url + 'fetchAccountlistbyname', { itemkeyword: item }, function (response) {
           // console.log(items);

$.map(JSON.parse(response),function(items){
//console.log(items['id']);
    $('#editcreditaccountNumber').val(items['acclink_id']);
    $('#editcreditmemberNumber').val(items['acclink_id']);
    return items['id'];
   });

});

    }
   // autoSelect: true,
    
});



}


function calculateAmt() {



$("#show-edit-journal-result").find('.subamt').keyup(function(){
 
    var amt = $(this).val();
   console.log(amt);
    subamtCalc();

});

}




function subamtCalc() {





console.log('calC');
    var subamt_sum = 0;
    var net_pay=0;
    $("#show-edit-journal-result").find('.subamt').each(function() {
        subamt_sum+= Number($(this).val());
    });
    

    $("#editcredit_amt").val(Number(subamt_sum));
    var camt=$("#editcredit_amt").val();
    var damt=$("#editdebit_amt").val();

var bal = parseFloat(damt)-parseFloat(camt);
console.log(bal);
console.log(parseFloat(damt)-parseFloat(camt));
    if (Number(bal)!=0) {
      $("#show-edit-journal-result").find('#editcredit_amt').css('border-color', 'red');
      $("#show-edit-journal-result").find('#editdebit_amt').css('border-color', 'red');
   // return true;
    }
    else {
      $("#show-edit-journal-result").find('#editcredit_amt').css('border-color', 'green');
      $("#show-edit-journal-result").find('#editdebit_amt').css('border-color', 'green');
      //alert("Equal");
    }


}





$("#show-edit-journal-result").find("#editcredit_amt, #editdebit_amt").keyup(function () {
    var camt=$("#show-edit-journal-result").find("#editcredit_amt").val();
    var damt=$("#show-edit-journal-result").find("#editdebit_amt").val();
    if (Number(damt)!=Number(camt)) {
      $("#show-edit-journal-result").find('#editcredit_amt').css('border-color', 'red');
      $("#show-edit-journal-result").find('#editdebit_amt').css('border-color', 'red');
      //$('#Journal_cramt').removeClass('cssText').addClass('has-warning has-feedback m-b-40');
      //$('#Journal_dramt').removeClass('cssText').addClass('has-warning has-feedback m-b-40');
     // alert("Second value should less than first value");
    return true;
    }
    else {
      $("#show-edit-journal-result").find('#editcredit_amt').css('border-color', 'green');
      $("#show-edit-journal-result").find('#editdebit_amt').css('border-color', 'green');
      //alert("Equal");
    }
  })



function updateJournal(id = null) 
{
    if(id) {
    
invflag=1;
  //      console.log(id);
var furl;
//var invNo = id ;
 // furl = "invoice/fetchInvoiceDataForUpdate/";
    var urlstr = base_url + 'fetchjournalUpdate';
var url = urlstr.replace("undefined","");
//console.log(url);
    $.ajax({
        url: base_url + 'fetchjournalUpdate'+'/'+id,
//        method:"POST",
 //       data:{ id: id },
        //dataType:"json",
        success:function (response) 
        {
          //  console.log(response);
          
            $("#show-edit-journal-result").html(response);
 debitAcctTypeahead($('#show-edit-journal-result').find('#editdebitaccountName'));
 creditAcctTypeahead($('#show-edit-journal-result').find('#editcreditaccountName'));
 calculateAmt($('#show-edit-journal-result').find('.subamt'));
 
 var $outp = response;          
 //console.log($outp);

            $("#editJournalNo").val(id);
            
                //$("#editTotalAmount").attr('disabled', true);
                /*SUBMIT FORM*/
                
                $("#editjournalForm").unbind('submit').bind('submit', function() {                  
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
                                $("#edit-journal-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');      
$("#edit-journal-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});             
                                
                                $('.form-group').removeClass('has-error').removeClass('has-success');
                                $('.text-danger').remove(); 
                               // $("#addSalesInvoiceTable:not(:first)").remove();                                
                                //createTypeahead($td.find('input.edititemSearch'));
                                //manageExpeneseTable.ajax.reload(null, false);
                                managejournalTable.ajax.reload(null, false);
                                                                
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



function deleteJournal(id) 
{
 //   console.log(id);

$('#delRec').on('click',function() {
   // var id = $this.val();
console.log('delete '+ id);

$('#deleteModal').modal('hide');
    var urlstr = base_url + 'deleteJvRec';
var url = urlstr.replace("undefined","");
//console.log(url);
    $.ajax({
        url: base_url + 'deleteJvRec'+'/'+id,
        dataType: 'json',
        success:function (response) 
        {
managejournalTable.ajax.reload(null, false);
                            //console.log(response);
                            if(response.success == true) {    
                            managejournalTable.ajax.reload(null, false);                  
                                $("#delete-journal-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');

    $('#deleteModal').modal('hide');
                                      
$("#delete-journal-message").fadeTo(2000, 500).slideUp(500, function(){
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

        


</script>




<style type="text/css">
  td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_close.png') no-repeat center center;
}
</style>                
