<!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
<div class="pull-right" id="process-message"></div>
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Share Dividend & TD Interest Report</h3>
                         


    

                                             <div class="col-lg-6">
                                                <div class="input-group">
                                                    <select class="custom-select col-12" name="prs_item" id="prs_item">
                                            <option value="0" selected disabled>Select an Account...</option>
                                            <option value="1">Share Dividend</option>
                                            <option value="2">TD Interest</option>
                                            
                                        </select>
        <input type="text" name="accid" id="accid" hidden>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                                                    <span class="input-group-btn">
                          <button class="btn btn-info prsrep_btn" id="prsrep_btn" type="button">Submit</button>
                        </span>

                        <!-- <span> 
                            <div id="load" class="pull-right hidden" style="margin-top:20px;margin-left: 20px;" ><div id="circle">
  <div class="loader">
    <div class="loader">
        <div class="loader">
           <div class="loader">

           </div>
        </div>
    </div>
  </div>
</div> 
</div></span> -->

                                                </div>
                                            </div>

    <hr>
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> DIVIDEND & TD INTEREST PROCESSED RESULTS
        
        
         <?php if ($this->session->userdata('role') == 'admin'): ?>
              <!--  data-toggle="modal" data-target="#modalAddReceipt"-->   
                    
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
    <table id="shrtdTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Member#</th>
                                            <th>Member Name</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>No of Days</th>
                                            <th>Total Amount</th>
                                            <th>Interest %</th>
                                            <th>Int. Amount</th>
                                            
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
var manageshrtdTable;
var prsitemname;         
$(document).ready(function(){
window.base_url = <?php echo json_encode(base_url('admin/dividend/')); ?>;
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




$("#prs_item").on('change',function(){
    var prsitem = $("#prs_item").val();
    prsitemname=$("#prs_item :selected").text();
    console.log(prsitemname);
$("#accid").val(prsitem);
});


$("#prs_btn").on('click',function(){
console.log('process btn clicked');
if($("#prs_item").val()!=0)
{
$("#load").removeClass('hidden');
$(this).addClass("disabled");
var prsitem = $("#prs_item").val();
$("#accid").val(prsitem);

}
else
{
    alert('Select the Process Item from the dropdown');
}
});

 urlstr = base_url + 'fetchShrTdItems';
 fetchurl = urlstr.replace("undefined","");

$("#prs_item").load(fetchurl)

//{"data":[{"rw":1,"td_name":"SURETY SHARE","td_amount":"2400940.00","curr_timestamp":"2021-10-11 16:50:36"},{"rw":2,"td_name":"THRIFT DEPOSIT","td_amount":"5004345.00","curr_timestamp":"2021-10-11 16:48:45"}]}






    $("#processForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');

        $.ajax({
            url: url,
            type: type,
            data: form.serialize(),
            dataType: 'json',
            success:function(response) {
              //  console.log(response);
                if(response.success == true) {                      
$("#load").addClass('hidden');
$("#prs_btn").removeClass("disabled");

                        $("#process-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#process-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


$("#processForm").trigger("reset");
manageshrtdTable.ajax.reload(null, false);
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

/////

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


//$data['data'][]=array("mem_id"=>$mem_id, "mem_name"=>$mem_acname, "fdate"=>$rvalue["from_date"],"tdate"=> $rvalue["to_date"],"nod"=>$rvalue["nod"],"trans_amt"=>$rvalue["trans_amt"],"int_pc"=>$rvalue["int_pc"],"int_amt"=>$rvalue["int_amount"]);


$("#prsrep_btn").on('click',function(){


    console.log('Search Clicked');
 urlstr = base_url + 'dividendtdreport';
 url = urlstr.replace("undefined","");
 var accid = $("#accid").val();
//console.log('fmDate ' + fmDate + ' toDate ' + toDate);
manageshrtdTable = $("#shrtdTable").dataTable().fnDestroy();
 manageshrtdTable =  $("#shrtdTable").dataTable( 
  {
    "ajax"    : url+'?accid='+accid, //+'?fdate=' + fmDate + '&tdate=' + toDate, //+ 'fetchReceiptSearch',
   
"columns": [
            {"title": "Member #",
            "data": "mem_id",
            "visible": false },
            { "data": "mem_name","title":"Member Name","visible":false},
            { "data": "fdate","title":"From Date" },
            { "data": "tdate","title":"To Date"  },
            { "data": "nod","title":"No of Days"  },
            { "data": "trans_amt","title":"Trans Amount"  },
            { "data": "int_pc","title":"Int %"  },
            { "data": "int_amt","title":"Amount"  }

        ],
    "drawCallback": function (settings) {
        var api = this.api();
        var rows = api.rows({
            page: 'current'
        }).nodes();
        var last = null;
        api.column(0, {
            page: 'current'
        }).data().each(function (group, i) {
            if (last !== group) {
                var rowData = api.row(i).data(); 
             //   console.log(rowData);
                $(rows).eq(i).before(
                $("<tr></tr>", {
                    "class": "group",
                    "data-id": group
                }).append($("<td></td>", {
                    "colspan": 5,
                    "class": "pocell",
                    "text": "Mem # " + group + " | " + rowData['mem_name']
                })).append($("<td></td>", {
                    "id": "e" + group,
                    "class": "pocell text-right",
                                      
                    "text": "0.00"
                })));
               /* .append($("<td></td>", {
                    "id": "p" + group,
                    "class": "noCount",
                    "text": "0.00"
                })).append($("<td></td>", {
                    "id": "b" + group,
                    "class": "noCount",
                    "text": "0.00"
                })).prop('outerHTML'));*/
                last = group;
            }
            val = api.row(api.row($(rows).eq(i)).index()).data();
            totamt = val.int_amt;
          //  console.log(totamt);
            $("#e" + val.mem_id).text(parseFloat($("#e" + val.mem_id).text()) + parseFloat(totamt));
          //  $("#p" + val.mem_id).text(parseFloat($("#p" + val.mem_id).text()) + parseFloat(val.int_amt));
           // $("#b" + val.mem_id).text(parseFloat($("#b" + val.mem_id).text()) + parseFloat(val.int_amt));
        });
    },
    "footerCallback": function (row, data, start, end, display) {
        var api = this.api();
      /*  $(api.column(5).footer()).html(
            api.column(5).data().reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            })
        );*
        $(api.column(7).footer()).html(
            api.column(7).data().reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            })
        );
/*        $(api.column(8).footer()).html(
            api.column(8).data().reduce(function (a, b) {
                return parseFloat(a) + parseFloat(b);
            })
        );*/
    },

'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
      "width": "4%"
 },
 {
      "targets": [5,7],
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

 title: system_name + '\n' + prsitemname + ' Report ',
  customize: function(doc) {
    doc.styles.title = {
      color: 'red',
      fontSize: '40',
      background: 'blue',
      alignment: 'center'

    }   


  },

               exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                },   
          
            orientation: 'portrait', // 'landscape',


            customize: function (doc) {
                  var rowCount = doc.content[1].table.body.length;
for (i = 1; i < rowCount; i++) {
//doc.content[1].table.body[i][5].alignment = 'right';
doc.content[1].table.body[i][6].alignment = 'center';
doc.content[1].table.body[i][5].alignment = 'right';
//doc.content[1].table.body[i][6].alignment = 'right';
doc.content[1].table.body[i][7].alignment = 'right';
//doc.content[1].table.body[i][8].alignment = 'right';
//doc.content[1].table.body[i][9].alignment = 'right';
};


      doc.pageMargins = [30,10,10,20];
        doc.defaultStyle.fontSize = 7;
        doc.styles.tableHeader.fontSize = 12;
        doc.styles.title.fontSize = 14; 
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();

      doc['footer']=(function(page, pages) {
            return {
                columns: [
                    'Dividend & TD Interest Report',
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                },
      }

        ]






}); 
    
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
                                manageshrtdTable.ajax.reload(null, false);
                                                                
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

                            manageshrtdTable.ajax.reload(null, false);                  
                            //console.log(response);
                            if(response.success == true) {    
                     manageshrtdTable.ajax.reload(null, false);                  
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


function shrtd_data()
{
    console.log('Search Clicked');
 urlstr = base_url + 'getProcessedData';
 url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();
//  date("d-m-Y", strtotime($originalDate));
//console.log('fmDate ' + fmDate + ' toDate ' + toDate);
manageshrtdTable = $("#shrtdTable").dataTable().fnDestroy();
 manageshrtdTable =  $('#shrtdTable').DataTable( 
  {
    "ajax"    : url, //+'?fdate=' + fmDate + '&tdate=' + toDate, //+ 'fetchReceiptSearch',
   
"columns": [
            { "data": "rw" },
            { "data": "td_name" },
            { "data": "td_amount" },
            { "data": "curr_timestamp" }
        ],

'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
      "width": "4%"
 },
 {
      "targets": [2,3],
      "className": "text-right"
 },

 ]



}); 
    
   





}

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



</style>






<style>

html,body{
       width: 100%;
     height: 100%;
}

 body {
     background: #0d161f;
}

#circle {
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
  width: 50px;
    height: 50px;  
}

.loader {
    width: calc(100% - 0px);
  height: calc(100% - 0px);
  border: 8px solid #162534;
  border-top: 8px solid #09f;
  border-radius: 50%;
  animation: rotate 5s linear infinite;
}

@keyframes rotate {
100% {transform: rotate(360deg);}
} 


.modal {
  text-align: center;
}

@media screen and (min-width: 768px) { 
  .modal:before {
    display: inline-block;
    vertical-align: middle;
    content: " ";
    height: 100%;
  }
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
tr.group, tr.group:hover {
    background-color: #ddd !important;
}
.pocell {
    font-weight:bold;
}
</style>


<script type="text/javascript">
 $('#toggle').click(function() {
  $('.circle-loader').toggleClass('load-complete');
  $('.checkmark').toggle();
}); 
</script>