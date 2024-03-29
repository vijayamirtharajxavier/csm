<!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Receipts Details</h3>
                         


<div class="pull-right">
  <div class="col-md-4">
        <div class="form-group">
          <div class="input-group input-group-lg">
            <label class="control-label">From</label>
            <input type="text" class="form-control" id="fmDate" name="fmDate" autocomplete="off" placeholder="dd-mm-yyyy" required>
            <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-calendar" id="fdtp"></i></span>
              </div>
          </div>
        </div>
</div>
<div class="col-md-4">
        <div class="form-group">
          
          <div class="input-group input-group-lg">
            <label class="control-label">To</label>
            <input type="text" class="form-control" id="toDate" name="toDate" autocomplete="off" placeholder="dd-mm-yyyy" required>
            <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-calendar" id="tdtp"></i></span>
              </div>
          </div>
        </div>
</div>
<!--

       
                                <label>From</label>  
                            <input type="text" name="fmDate" id="fmDate" placeholder="mm/dd/yyyy">
                            
                            

                            
                            
                                <label>To</label>  
                            <input type="text" name="toDate" id="toDate" placeholder="mm/dd/yyyy">
                            
    -->                        
                            
                            <button id="search" type="submit" class="btn btn-primary btn-rounded">Search</button>
                            </div>
    <hr>
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> All Receipts
        
        
         <?php if ($this->session->userdata('role') == 'admin'): ?>
              <!--  data-toggle="modal" data-target="#modalAddReceipt"-->   
                    <a href="" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#modalAddReceipt"><i class="fa fa-plus"></i>&nbsp;New Receipt</a> &nbsp;
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
                                <table id="receiptTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Receit No</th>
                                            <th>Receipt Date</th>
                                            <th>Cash / Bank</th>
                                            <th>Account Name</th>
                                            
                                            <th>Recipt Amount</th>
                                            <th>Narration</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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



<!-- Print Receipt-->

<div id="print-receipt-modal" class="fade modal" role="dialog">

    <div class="modal-dialog modal-lg ">
    <div class="modal-content" >
      
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Print Receipt</h4>
      
      </div>
      
      <div class="modal-body">
      
    <!--<div id="show-print-receipt-result"></div>-->

  <div id="invoice-POS">
    
    <center id="top">
      <div class="logo" id="logo" class="img-fluid p-10"></div>
      <div class="info"> 
        <h2><strong><div id="comname"></strong></div></h2>
        <h6 id="comadd" class="text-center" style="font-size: .7em; margin-top: -10px;"></h6>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <p id="rcptnum" class="pull-left" style="font-size: .7em;"></p>
    <p id="dt" class="pull-right" style="font-size: .7em;"></p>
    <br>

   <div id="mid">
      <div class="info">
    
        <h2>Contact Info</h2>
        <p> 
            Address : street city, state 0000</br>
            Email   : JohnDoe@gmail.com</br>
            Phone   : 555-555-5555</br>
        </p> 
      </div>
    </div><!--End Invoice Mid-->
    <div class="row">
    <div id="recdfrom" class="p-3" style="text-align: left;"></div>
    
    <div id="sumof" class="p-3" style="text-align: left;"></div>
    </div>

    <div id="bot">

          <div id="table">
            <table>
              <tr class="tabletitle">
                <td class="item"><h2>Item</h2></td>
                <td class="Hours"><h2>Qty</h2></td>
                <td class="Rate"><h2>Sub Total</h2></td>
              </tr>

              <tr class="service">
                <td class="tableitem"><p class="itemtext">Communication</p></td>
                <td class="tableitem"><p class="itemtext">5</p></td>
                <td class="tableitem"><p class="itemtext">$375.00</p></td>
              </tr>

              <tr class="service">
                <td class="tableitem"><p class="itemtext">Asset Gathering</p></td>
                <td class="tableitem"><p class="itemtext">3</p></td>
                <td class="tableitem"><p class="itemtext">$225.00</p></td>
              </tr>

              <tr class="service">
                <td class="tableitem"><p class="itemtext">Design Development</p></td>
                <td class="tableitem"><p class="itemtext">5</p></td>
                <td class="tableitem"><p class="itemtext">$375.00</p></td>
              </tr>

              <tr class="service">
                <td class="tableitem"><p class="itemtext">Animation</p></td>
                <td class="tableitem"><p class="itemtext">20</p></td>
                <td class="tableitem"><p class="itemtext">$1500.00</p></td>
              </tr>

              <tr class="service">
                <td class="tableitem"><p class="itemtext">Animation Revisions</p></td>
                <td class="tableitem"><p class="itemtext">10</p></td>
                <td class="tableitem"><p class="itemtext">$750.00</p></td>
              </tr>


              <tr class="tabletitle">
                <td></td>
                <td class="Rate"><h2>tax</h2></td>
                <td class="payment"><h2>$419.25</h2></td>
              </tr>

              <tr class="tabletitle">
                <td></td>
                <td class="Rate"><h2>Total</h2></td>
                <td class="payment"><h2>$3,644.25</h2></td>
              </tr>

            </table>
          </div><!--End Table-->

          <div id="legalcopy">
            <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices. 
            </p>
          </div>

        </div><!--End InvoiceBot-->
  </div><!--End Invoice-->


    </div>
  </div>
</div>
</div>




<!-- Edit Receipt-->

<div id="edit-receipt-modal" class="fade modal" role="dialog">

    <div class="modal-dialog modal-lg ">
    <div class="modal-content" >
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Receipt</h4>
      </div>
      

        <div id="edit-receipt-message"></div>
        <form action="Receiptupdate" method="post" class="form-horizontal" id="editReceiptForm">
      <div class="modal-body">
        <div id="show-edit-receipt-result"></div>
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
 


<!-- Modal -->
<div id="modalAddReceipt" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Receipt</h4>
      </div>
      <div id="add-rct-message"></div>

      <form action="createReceipt" method="post" class="form-horizontal" id="createReceiptForm">
      <div class="modal-body">
                        <div class="panel panel-info">
                            <div class="panel-heading"><i class="fa fa-document"></i> Receipt</div>
             

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    

                            
                                <div class="row">
                                <div class="col-md-4">
                   
        <div class="form-group">
          <label class="control-label">Date</label>
          <div class="input-group input-group-lg">
            <input type="text" class="form-control" id="recdate" name="recdate" autocomplete="off" placeholder="dd-mm-yyyy" required>
            <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-calendar" id="dtp"></i></span>
              </div>
          </div>
        </div>


          </div>

  

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Received as</label>
                                                    <select class="custom-select col-6 form-control" id="cash_bank" name="cash_bank">
                                                       
                                                    </select>
                                                    </div>
                                                </div>

                              
                                 <input type="text" id="accountNumber" name="accountNumber" hidden>
                                 <input type="text" id="itemName" name="itemName" hidden>

                                <div class="col-md-4">
                                <div class="form-group" id="ldgremote">
                                    <label class="col-md-6" >Received From
                                    </label>
                                 <input type="text" id="accountName" name="accountName" autocomplete="off" class="form-control typeahead" placeholder="Account Name" required>
                                 
                                </div>
                                </div>
</div>
    <div class="row">
                                <div class="col-md-4">
                                
                                <div class="form-group">
                                    <label class="col-md-6" for="paydate">Total Amount
                                    </label>
                                        <input type="text" id="receipt_amt" name="receipt_amt" autocomplete="off"  class="form-control" placeholder="0.00" style="text-align: right;">
                                </div>
                                </div>
                                <div class="col-md-4">
                                  <label class="col-md-6" for="paydate">Receipt#
                                    </label>
                                        <input type="text" id="trans_refid" name="trans_refid" class="form-control" placeholder="Receipt Reference #"  autocomplete="off" >

                                </div>
                                <div class="col-md-4">
                                
                                <div class="form-group">
                                    <label class="col-md-6" for="paydate">Narration
                                    </label>
                                        <input type="text" id="narration" name="narration" class="form-control" placeholder="Narration"  autocomplete="off" >
                                </div>
                                </div>
                            </div>


     </div> 
     </div>
     </div>
      </div>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

      <div class="modal-footer">
        <button type="submit" class="btn btn-info btn-rounded btn-sm waves-effect waves-light m-r-10" >Save</button>
        <button type="button" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light" data-dismiss="modal">Close</button>
      </div>
      </form>

    </div>
</div>
</div>



<script>
var manageReceiptTable;         
$(document).ready(function(){
window.base_url = <?php echo json_encode(base_url('admin/receipt/')); ?>;
window.logo_url = <?php echo json_encode(base_url()); ?>;
//console.log(logo_url);
var system_name = "<?php echo $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;?>" ;

   $("#fdtp").on('click',function(){
    $("#fmDate").focus();
   $("#fmDate").datepicker({format:"dd-mm-yyyy",  autoclose: true}); 
   });

   $("#tdtp").on('click',function(){
    $("#toDate").focus();
   $("#toDate").datepicker({format:"dd-mm-yyyy",  autoclose: true}); 
   });

   $( "#fmDate" ).datepicker({format:"dd-mm-yyyy",  autoclose: true});
   $( "#toDate" ).datepicker({format:"dd-mm-yyyy",  autoclose: true});


   $("#dtp").on('click',function(){
    $("#recdate").focus();
   $("#recdate").datepicker({format:"dd-mm-yyyy",  autoclose: true}); 
   });
   $("#recdate").datepicker({format:"dd-mm-yyyy",  autoclose: true});
console.log('rect rep');
    var urlstr = base_url + 'fetchLdgAccounts';
var url = urlstr.replace("undefined","");

    $("#cash_bank").load(url);


  $('#cash_bank').change(function(event) {
        $('#itemName').val($('#cash_bank option:selected').text());
    
    });



    var urlstr = base_url + 'fetchReceiptData';
var url = urlstr.replace("undefined","");
 manageReceiptTable = $("#receiptTable").dataTable().fnDestroy();
 


$('#search').on('click',function() {

    console.log('Search Clicked');
 urlstr = base_url + 'fetchReceiptSearch';
 url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();
//  date("d-m-Y", strtotime($originalDate));
//console.log('fmDate ' + fmDate + ' toDate ' + toDate);
manageReceiptTable = $("#receiptTable").dataTable().fnDestroy();
 manageReceiptTable =  $('#receiptTable').DataTable( 
  {
    "ajax"    : url+'?fdate=' + fmDate + '&tdate=' + toDate, //+ 'fetchReceiptSearch',
   
"columns": [
            { "data": "receipt_number" },
            { "data": "receipt_date" },
            { "data": "account_name" },
            { "data": "cash_bank" },
            { "data": "receipt_amount" },
            { "data": "narration" },
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

 title: system_name + '\n' + 'Receipts Report for the period from '+ $('#fmDate').val() + ' to '+ $('#toDate').val(),
  customize: function(doc) {
    doc.styles.title = {
      color: 'red',
      fontSize: '40',
      background: 'blue',
      alignment: 'center'

    }   


  },

               exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                },   
          
            orientation: 'portrait', // 'landscape',


            customize: function (doc) {
                  var rowCount = doc.content[1].table.body.length;
/*for (i = 1; i < rowCount; i++) {
//doc.content[1].table.body[i][5].alignment = 'right';
//doc.content[1].table.body[i][6].alignment = 'right';
doc.content[1].table.body[i][5].alignment = 'right';
doc.content[1].table.body[i][6].alignment = 'right';
doc.content[1].table.body[i][7].alignment = 'right';
doc.content[1].table.body[i][8].alignment = 'right';
doc.content[1].table.body[i][9].alignment = 'right';
};
*/

      doc.pageMargins = [20,10,10,10];
        doc.defaultStyle.fontSize = 7;
        doc.styles.tableHeader.fontSize = 8;
        doc.styles.title.fontSize = 10; 
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();

      doc['footer']=(function(page, pages) {
            return {
                columns: [
                    'Receipts Report for the period from '+ $('#fmDate').val() + ' to '+ $('#toDate').val(),
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
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                },
      }

        ]




}); 
    
   


});







    $("#createReceiptForm").unbind('submit').bind('submit', function() {
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
                        $("#add-rct-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#add-rct-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


$("#createReceiptForm").trigger("reset");
manageReceiptTable.ajax.reload(null, false);
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



    var urlstr = base_url + 'fetchAccountlist';
var url = urlstr.replace("undefined","");

var productNames = new Array();
var productIds = new Object();
/*$.getJSON( 'url', null,
       function ( jsonData )
        {
            $.each( jsonData, function ( index, product )
            {
                productNames.push( product.account_name );
                productIds[product.account_name] = product.id;
            } );
            $( '#accountNamec' ).typeahead( { source:productNames } );
       });
*/


$("#accountName").typeahead({

    source: function (query, process) {
        return $.get(base_url + 'fetchAccountlist', { qry: query }, function (data) {
      //     console.log(data);

            productNames=new Array();;
 $.each( JSON.parse(data), function ( index, product )
            {
              var accnamelist = product.acclink_id + ' - ' + product.account_name;
                productNames.push(accnamelist);

//                productNames.push( product.account_name );
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
    $('#accountNumber').val(items['acclink_id']);
//    $('#debitmemberNumber').val(items['acclink_id']);
    return items['id'];
   });

});

    }
   // autoSelect: true,
    
});









}); //Document


function createCashBank($ddown)
{
$ddown.on('change', function (e) {
//    console.log(this.value);
   // console.log($('#editcash_bank option:selected').text());
$('#edititemName').val($('#editcash_bank option:selected').text());
//console.log($('#edititemName').val());

});
}


function createCustTypeahead($els) {
console.log('you are in right track'+ $els);

var token =  $('#csrftoken').attr('value'); 

var productNames = new Array();
var productIds = new Object();




$els.typeahead({

    source: function (query, process) {
        return $.get(base_url + 'fetchAccountlist', { qry: query }, function (data) {
      //     console.log(data);

            productNames=new Array();;
 $.each( JSON.parse(data), function ( index, product )
            {
              var accnamelist = product.acclink_id + ' - ' + product.account_name;
                productNames.push(accnamelist);

//                productNames.push( product.account_name );
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
    $('#editaccountNumber').val(items['acclink_id']);
//    $('#debitmemberNumber').val(items['acclink_id']);
    return items['id'];
   });

});

    }
   // autoSelect: true,
    
});

}






function printReceipts(id = null) 
{
  console.log('ReceiptPrint' + id);
    if(id) {
    
invflag=1;
        //console.log(id);
var furl;
//var invNo = id ;
 // furl = "invoice/fetchInvoiceDataForUpdate/";
    var urlstr = base_url + 'ReceiptPrint';
var url = urlstr.replace("undefined","");
//console.log(url);
    $.ajax({
        url: url+'/'+id,
//        method:"POST",
 //       data:{ id: id },
        //dataType:"json",
        success:function (response) 
        {
           console.log(response);
           var obj = JSON.parse(response);
           console.log(obj);
           console.log(obj.cpSName);
           // $("#show-print-receipt-result").html(response);
            //$("#show-print-receipt-result").find("#comname").val(obj.cpSName);
            document.getElementById("comname").innerHTML=obj.cpSName;
            document.getElementById("logo").innerHTML='<img class="img-fluid mt-2" style="width:50px;height:50px;" src="'+ logo_url + obj.logopath + obj.logoimg+'">';
            document.getElementById("comadd").innerHTML=obj.cpAdd;
            document.getElementById("rcptnum").innerHTML= "Receipt # " + obj.receiptNumber;
            document.getElementById("dt").innerHTML="Receipt Date " + obj.receiptDate;
            document.getElementById("recdfrom").innerHTML= "Received with thanks from Mr./Ms./M/s. " + obj.accountName;
            document.getElementById("sumof").innerHTML= "The sum of Rupees " + obj.receiptAmount + "/-";

             + " towards " + obj.narration;




//createCustTypeahead($('#show-edit-receipt-result').find('#editaccountName'));
//createCashBank($('#show-edit-receipt-result').find('#editcash_bank'));
 var $outp = response;          
 //console.log($outp);
          //  $("#editDivNo").val(id);
            

            } // /success
        }); // /.ajax
    } // /.if
} // /.update epxense function





function updateReceipts(id = null) 
{
    if(id) {
    
invflag=1;
        //console.log(id);
var furl;
//var invNo = id ;
 // furl = "invoice/fetchInvoiceDataForUpdate/";
    var urlstr = base_url + 'fetchReceiptUpdate';
var url = urlstr.replace("undefined","");
//console.log(url);
    $.ajax({
        url: url+'?id='+id,
//        method:"POST",
 //       data:{ id: id },
        //dataType:"json",
        success:function (response) 
        {
          //  console.log(response);
            $("#show-edit-receipt-result").html(response);
createCustTypeahead($('#show-edit-receipt-result').find('#editaccountName'));
createCashBank($('#show-edit-receipt-result').find('#editcash_bank'));
 var $outp = response;          
 //console.log($outp);
          //  $("#editDivNo").val(id);
            
                //$("#editTotalAmount").attr('disabled', true);
                /*SUBMIT FORM*/
                
                $("#editReceiptForm").unbind('submit').bind('submit', function() {                  
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
                                $("#edit-receipt-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');      
$("#edit-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});             
                                
                                $('.form-group').removeClass('has-error').removeClass('has-success');
                                $('.text-danger').remove(); 
                               // $("#addSalesInvoiceTable:not(:first)").remove();                                
                                //createTypeahead($td.find('input.edititemSearch'));
                                //manageExpeneseTable.ajax.reload(null, false);
                                manageReceiptTable.ajax.reload(null, false);
                                                                
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


function deleteReceipt(id) 
{

 //   console.log(id);
  

$('#delRec').on('click',function() {
   // var id = $this.val();
console.log('delete '+ id);
$('#deleteModal').modal('hide');

    var urlstr = base_url + 'deleterctRec';
var url = urlstr.replace("undefined","");
//console.log(url);
    $.ajax({
        url: url+'/'+id,
        dataType: 'JSON',
        success:function (response) 
        {

                            manageReceiptTable.ajax.reload(null, false);                  
                            //console.log(response);
                            if(response.success == true) {    
                     manageReceiptTable.ajax.reload(null, false);                  
                                $("#delete-receipt-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');

    $('#deleteModal').modal('hide');
                                      
$("#delete-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
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
.modal-body{overflow-y: inherit;}



/*********Print Receipt*******/
#invoice-POS{
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding:2mm;
  margin: 0 auto;
  width: 84mm;
  background: #FFF;
  
  
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}


#invoice-POS h1{
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2{font-size: .9em;}
#invoice-POS h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
 
#top, #mid,#bot{ /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}

#top{min-height: 100px;}
#mid{min-height: 80px;} 
#bot{ min-height: 50px;}


#invoice-POS #logo img {
  width: 50px;
}

#invoice-POS #top .logo{
  float: left;
  height: 60px;
  width: 50px;
}
.clientlogo{
  float: left;
  height: 40px;
  width: 40px;
  border-radius: 50px;
}
.info{
  display: block;
  /*//float:left; */
  margin-left: 0;
}
.title{
  float: right;
}
.title p{text-align: right;} 
table{
  width: 100%;
  border-collapse: collapse;
}
td{
 padding: 5px 0 5px 15px;
border: 1px solid #EEE 
}
.tabletitle{
  padding: 5px;
  font-size: .5em;
  background: #EEE;
}
.service{border-bottom: 1px solid #EEE;}
.item{width: 24mm;}
.itemtext{font-size: .5em;}

#legalcopy{
  margin-top: 5mm;
}

  
  
}

/*********Print Receipt End*********/

</style>
