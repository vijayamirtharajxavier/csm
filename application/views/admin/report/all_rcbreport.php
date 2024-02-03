<!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Receipt & Charges</h3>



                               
                            <div class="pull-right">
                                <label>From</label>  
                            <input type="date" name="fmDate" id="fmDate">
                            
                            

                            
                            
                                <label>To</label>  
                            <input type="date" name="toDate" id="toDate">

<!--<select id="ddlYears"></select> -->

                        
                            
                            <button id="search" type="submit" class="btn btn-primary btn-rounded">Search</button>
                            </div>
    <hr>
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> All Receitps & Charges
        
        
         <?php if ($this->session->userdata('role') == 'admin'): ?>
              <!--  data-toggle="modal" data-target="#modalAddPayment"-->   
                    <a href="" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#modalAddPayment"><i class="fa fa-plus"></i>&nbsp;New Payment</a> &nbsp;
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
                                <table id="dcbTable" class="table table-striped">
                                    <thead>
                                        <tr> <th></th>
                                            <th>#</th>
                                            <th>Account</th>
                                            <th>Opening</th>
                                            <th>Receipts</th>
                                            <th>Issues</th>
                                            <th>Total</th>
                                            
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


<!-- Edit Payment-->

<div id="edit-Payment-modal" class="fade modal" role="dialog">

    <div class="modal-dialog modal-lg ">
    <div class="modal-content" >
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Payment</h4>
      </div>
      

        <div id="edit-Payment-message"></div>
        <form action="Paymentupdate" method="post" class="form-horizontal" id="editPaymentForm">
      <div class="modal-body">
        <div id="show-edit-Payment-result"></div>
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
<div id="modalAddPayment" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Payment</h4>
      </div>
      <div id="add-pay-message"></div>

      <form action="createPayment" method="post" class="form-horizontal" id="createPaymentForm">
      <div class="modal-body">
                        <div class="panel panel-info">
                            <div class="panel-heading"><i class="fa fa-document"></i> Payment <div class="pull-right"> <select class="custom-select col-6 form-control" style="margin-top: -8px;"  name="tr_type" id="tr_type">
                             <option value="PYMT" selected>PAYMENT</option><option value="CNTR">CONTRA</option>                          
                                                    </select></div> </div>
             

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    

                            
                                <div class="row">
                                <div class="col-md-4">
                                
                                <div class="form-group">
                                    <label class="col-md-6">Payment Date
                                    </label>
                                        <input type="date" id="paydate" name="paydate" required autocomplete="off"  class="form-control mydatepicker">
                                </div>
                                </div>

  

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Paid as</label>
                                                    <select class="custom-select col-6 form-control" id="cash_bank" name="cash_bank">
                                                       
                                                    </select>
                                                    </div>
                                                </div>

                              
                                 <input type="text" id="accountNumber" name="accountNumber" hidden >
                                 <input type="text" id="itemName" name="itemName" hidden>

                                <div class="col-md-4">
                                <div class="form-group" id="ldgremote">
                                    <label class="col-md-6" >Paid To
                                    </label>
                                 <input type="text" id="accountName" name="accountName" autocomplete="off" class="form-control typeahead" placeholder="Account Name" required>
                                 
                                </div>
                                </div>
</div>

    <div class="row">
      <div class="col-md-6">

                                    <label class="col-md-6" >Reference #
                                    </label>
                                 <input type="text" id="chequeNumber" name="chequeNumber" autocomplete="off" class="form-control typeahead" placeholder="Cheque/NEFT/Ref#">
  </div>
<div class="col-md-6">

                                    <label class="col-md-6" >Bank Details
                                    </label>
                                 <input type="text" id="chequeBank" name="chequeBank" autocomplete="off" class="form-control typeahead" placeholder="Bank Details" >

</div>
  </div>

    <div class="row">
                                <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-6" for="paydate">Total Amount
                                    </label>
                                        <input type="text" id="payment_amt" required="" name="payment_amt" autocomplete="off"  class="form-control" placeholder="0.00" style="text-align: right;">
                                </div>
                                </div>
                                <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-6" for="paydate">Narration
                                    </label>
                                        <input type="text" id="narration" name="narration" class="form-control mydatepicker" placeholder="Narration"  autocomplete="off" >
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
var table;       

var fmDate;
var toDate;


$(document).ready(function(){
window.base_url = <?php echo json_encode(base_url('admin/report/')); ?>;
var system_name = "<?php echo $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;?>" ;

console.log('payt rep');
    var urlstr = base_url + 'fetchLdgAccounts';
var url = urlstr.replace("undefined","");

    $("#cash_bank").load(url);
$('#edititemName').val($('#editcash_bank option:selected').text());

  $('#cash_bank').change(function(event) {
        $('#itemName').val($('#cash_bank option:selected').text());
    
    });


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


   $('#dcbTable tbody').on('click', 'td.details-control', function () {
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



$('#search').on('click',function() {

    console.log('Search Clicked');
 urlstr = base_url + 'fetchrcb'; // 'fetchPaymentSearch';
 url = urlstr.replace("undefined","");
 
 /*var yr= $("#ddlYears").val();
 var nyr = Number($("#ddlYears").val()) + 1;

  fmDate= yr + "-01-01";
  toDate= nyr + "-03-31";

fmDate = "2019-04-01";
toDate = "2019-04-30";
*/
//  date("d-m-Y", strtotime($originalDate));
//console.log('fmDate ' + fmDate + ' toDate ' + toDate);
 //memberid: rowData.memberid, accountid: selval,fmDate:fmDate,toDate:toDate
fmDate = $("#fmDate").val();
toDate = $("#toDate").val();


table = $("#dcbTable").dataTable().fnDestroy();
table = $('#dcbTable').DataTable( 
  {
    "ajax"    : url + '?fdate=' + fmDate + '&tdate=' + toDate, //+ 'fetchPaymentSearch',
   
"columns": [
           {

            "className":"details-control",
            "orderable":false,
            "data": null,
            "defaultContent": ''
          },
            { "data": "acctid" },
            { "data": "acctname" },
            
            { "data": "opening" },
          { "data": "receipt" },

           { "data": "issues" },
           { "data": "closing" }

        ],

'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
      "width": "4%"
 },
 {
      "targets": [3, 4, 5, 6],
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

 title: system_name + '\n' + 'DCB Report for the period from '+ $('#fmDate').val() + ' to '+ $('#toDate').val(),
  customize: function(doc) {
    doc.styles.title = {
      color: 'red',
      fontSize: '40',
      background: 'blue',
      alignment: 'center'

    }   


  },

               exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
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
                    'Payments Report for the period from '+ $('#fmDate').val() + ' to '+ $('#toDate').val(),
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


$('#dcbTable tbody').on('click', 'td.details-control', function () {
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

});







});









function format (rowData) {
 console.log('rowData' + selval + rowData.memberid);

   urlstr = base_url + 'fetchItemData';
 url = urlstr.replace("undefined","");
// var fmDate= $('#fmDate').val();
 //var toDate= $('#toDate').val();
console.log(fmDate);
    var div = $('<div/>')
        .addClass( 'loading' )
        .text( 'Loading...' );
 
    $.ajax( {
        url: url,//'/api/staff/details',
        data: {
            memberid: rowData.memberid, accountid: selval,fmDate:fmDate,toDate:toDate
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









</script>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        //Reference the DropDownList.
        var ddlYears = $("#ddlYears");
 
        //Determine the Current Year.
        var currentYear = (new Date()).getFullYear();
 
        //Loop and add the Year values to DropDownList.
        for (var i = 2019; i <= currentYear; i++) {
            var option = $("<option />");
            option.html(i);
            option.val(i);
            ddlYears.append(option);
        }
    });
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

.ui-autocomplete {
z-index: 100;
}

</style>


<style type="text/css">
  td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_close.png') no-repeat center center;
}
</style>                
