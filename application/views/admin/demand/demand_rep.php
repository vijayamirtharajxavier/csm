
<?php 
$system_name = $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('soc_settings', array('type' => 'system_title'))->row()->description;
?>

<!-- /row -->
                <div class="row">
                    <div class="col-sm-12">

           <div class="panel panel-info">

                <div class="panel-heading"> <i class="fa fa-list"></i> All Demand
                
                
                 <?php if ($this->session->userdata('role') == 'admin'): ?>
                 
                    <a href="" id="addDmd" class="btn btn-info btn-sm pull-right"  data-toggle="modal" data-target="#modalAddDemand"><i class="fa fa-plus"></i>&nbsp;New Demand</a> &nbsp;
                <?php else: ?>
                    <!-- check logged user role permissions -->

                    <?php if(check_power(1)):?>
                        <a href="<?php echo base_url('admin/userhome') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp;New User</a>
                    <?php endif; ?>
                <?php endif ?>
                
                </div>

                        <div class="white-box">
                            <h3 class="box-title m-b-0">Monthly Demand / Recover Report</h3>


                            <div class="pull-right">
                                <label>Select a Month</label>  
                            <input id="monthYear" name="monthYear">
                            <button id="search" type="submit" class="btn btn-primary btn-rounded">Search</button>
                            </div>
                            
                            <hr>
                            <div class="table-responsive">
                                <table id="manageDemandTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>DIVISION</th>
                                            <th>MEM.#</th>
                                            <th>MEMBER NAME</th>
                                            <th>DESG</th>
                                            <th>SEC</th>
                                            <th>INS.</th>
                                            <th>THRIFT</th>
                                            <th>PRINCIPLE</th>
                                            <th>INTEREST</th>
                                            <th>Total</th>
                                            <th style="width: 130px;">Action</th>
                                            
                                        </tr>
                                    </thead>
                                    </tbody>
                                </table>
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




<!-- Modal -->

<!-- Modal -->
<div id="modalAddDemand" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Demand</h4>
      </div>
      <div id="add-demand-message"></div>

      <form action="createDemand" method="post" id="createNewDemand">
      <div class="modal-body">

        <table class="table">
            <tr>
            <td>   <label>Demand Date</label>
        <span><input type="date" autocomplete="off"   id="demanddate"  name="demanddate" placeholder="dd/mm/yyyy" class="form-control" required></span>
     </td>
     <td>
        <input id="memberNumber" name="memberNumber" type="text" hidden >
        <label>Member Name</label>
        <span><input type="text" autocomplete="off"   id="membername"  name="membername" placeholder="Member Name" class="form-control typeahead" required></span>
         
     </td>
     </tr>
    </table>

     <div id="additemaccountTbl"></div>
    
    

      </div>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

      <div class="modal-footer">
        <button type="submit" id="save_btn" class="btn btn-success" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>


    </div>

  </div
>
</div>

<!-- edit customer -->
<div class="modal fade" id="edit-demand-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" style="width:1050px; height:450px" role="document">
    <div class="modal-content" >
      
      <div class="modal-header">
      <h4 class="pull-left">Edit Demand</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <!-- <h4 class="modal-title">Edit Demand</h4>-->
        
      </div>
<!--      <div class="modal-body" style="height: 550px;overflow-y: scroll;"> -->
<div id="edit-demand-message"></div>
        <div class="modal-body">
        <form action="updateDemand" method="post" class="form-horizontal" id="editDemandForm">  
        <div id="show-edit-demand-result"></div>
          
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
        
      <div class="modal-footer">
        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
       <!-- <button type="button" class="btn btn-default" onclick="addCustomereditRow()">Add Row</button>-->
        <button type="submit" id="btn_save" class="btn btn-primary">Save changes</button>      
      </div>      
        </form>  
      </div><!-- /modal-body -->

      
    </div>
  </div>
</div>

</div>
<!-- End Modal -->



<script>
var manageDemandTable;
var total=0;         
$(document).ready(function(){


    var urlstr = base_url + 'fetchMemberlist';
var url = urlstr.replace("undefined","");

var memberNames = new Array();
var memberIds = new Object();



$("#membername").typeahead({
    items: 4,
    source: function(request, response) {
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
                $('#memberNumber').val(item.member_id);
      
        return item.member_name;
    }
});






$('#addDmd').on('click',function(){
    var urlstr = base_url + 'fetchItemMastData';
var url = urlstr.replace("undefined","");

    $.ajax({
        url: url,
//        method:"POST",
 //       data:{ id: id },
        //dataType:"json",
        success:function (response) 
        {
           // console.log(response);
            $("#additemaccountTbl").html(response);
}
});


//getCalc($('#additemaccountTbl').find('.calc'));

});


 
$("body").on('keyup', ".calc", calculate);  



/*
console.log('demand rep');


    var urlstr = base_url + 'fetchDemandData';
var url = urlstr.replace("undefined","");

 manageDemandTable = $('#manageDemandTable').DataTable( {
        "ajax": url, //'../ajax/data/arrays.txt'
"columns": [
            { "data": "division_name" },
            { "data": "member_id" },
            { "data": "member_name" },
            { "data": "designation" },
            { "data": "section_name" },
            { "data": "insurance_amount" },
            { "data": "thrift_amount" },
            { "data": "principle_amount" },
            { "data": "interest_amount" },
            { "data": "total_amount" },
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
      "className": "text-right",
 }],      
    } );

*/


$('#search').on('click',function() {

    console.log('Search Clicked');
    var urlstr = base_url + 'fetchDemandData';
 var url = urlstr.replace("undefined","");
 var month_year= $('#monthYear').val();
 var mm_yy = month_year.replace("-","");
console.log(month_year);
var system_name = "<?php echo $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;?>" ;

//console.log('fmDate ' + fmDate + ' toDate ' + toDate);
//$("#manageDemandTable").dataTable().fnDestroy();
 manageDemandTable = $("#manageDemandTable").dataTable().fnDestroy();
 manageDemandTable =  $('#manageDemandTable').DataTable( 
  {
    "ajax"    : url+'?month_year=' + mm_yy, //+ 'fetchReceiptSearch',
   
"columns": [
            { "data": "division_name" },
            { "data": "member_id" },
            { "data": "member_name" },
            { "data": "designation" },
            { "data": "section_name" },
            { "data": "insurance_amount", render: $.fn.dataTable.render.number(',', '.', 2, '')  },
            { "data": "thrift_amount", render: $.fn.dataTable.render.number(',', '.', 2, '')  },
            { "data": "principle_amount", render: $.fn.dataTable.render.number(',', '.', 2, '')  },
            { "data": "interest_amount", render: $.fn.dataTable.render.number(',', '.', 2, '')  },
        //    { "data": "misc_amount" },
            { "data": "total_amount", render: $.fn.dataTable.render.number(',', '.', 2, '')  },
            { "data": "action" }
        ],

'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
      "width": "4%"
 },
 {
      "targets": [5,6,7,8,9],
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

 title: system_name + '\n' + 'Demand Report for the month of ' +$('#monthYear').val(),
  customize: function(doc) {
    doc.styles.title = {
      color: 'red',
      fontSize: '40',
      background: 'blue',
      alignment: 'center'

    }   


  },

                                     exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                },   
          
            orientation: 'portrait', // 'landscape',


            customize: function (doc) {
                  var rowCount = doc.content[1].table.body.length;
for (i = 1; i < rowCount; i++) {
//doc.content[1].table.body[i][5].alignment = 'right';
//doc.content[1].table.body[i][6].alignment = 'right';
doc.content[1].table.body[i][5].alignment = 'right';
doc.content[1].table.body[i][6].alignment = 'right';
doc.content[1].table.body[i][7].alignment = 'right';
doc.content[1].table.body[i][8].alignment = 'right';
doc.content[1].table.body[i][9].alignment = 'right';
};


      doc.pageMargins = [20,10,10,10];
        doc.defaultStyle.fontSize = 7;
        doc.styles.tableHeader.fontSize = 8;
        doc.styles.title.fontSize = 10; 
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();

      doc['footer']=(function(page, pages) {
            return {
                columns: [
                    'Demand Report for the month of ' +$('#monthYear').val(),
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                },
      }

        ]


}); 
    
   


});


$("#monthYear").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});




$("#createNewDemand").unbind('submit').bind('submit', function() {
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
                        $("#add-demand-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#add-demand-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


$("#createNewDemand").trigger("reset");
manageDemandTable.ajax.reload(null, false);
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







}); //--document ready


function updateDemands(id = null) 
{
    if(id) {
    
invflag=1;
        //console.log(id);
var furl;
//var invNo = id ;
 // furl = "invoice/fetchInvoiceDataForUpdate/";
    var urlstr = base_url + 'fetchDemandUpdate';
var url = urlstr.replace("undefined","");
//console.log(url);
    $.ajax({
        url: url+'/'+id,
//        method:"POST",
 //       data:{ id: id },
        //dataType:"json",
        success:function (response) 
        {
          //  console.log(response);
            $("#show-edit-demand-result").html(response);
 var $outp = response;          
 //console.log($outp);

            $("#editmemNo").val(id);
            
                //$("#editTotalAmount").attr('disabled', true);
                /*SUBMIT FORM*/
                
                $("#editDemandForm").unbind('submit').bind('submit', function() {                  
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
                                $("#edit-demand-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');    
                                manageDemandTable.ajax.reload(null, false);  
$("#edit-demand-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});             
                                
                                $('.form-group').removeClass('has-error').removeClass('has-success');
                                $('.text-danger').remove(); 
                               // $("#addSalesInvoiceTable:not(:first)").remove();                                
                                //createTypeahead($td.find('input.edititemSearch'));
                                //manageExpeneseTable.ajax.reload(null, false);
                              //  manageDemandTable.ajax.reload(null, false);
                                                                
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


function deleteDemand(id) 
{
 //   console.log(id);

$('#delRec').on('click',function() {
   // var id = $this.val();
console.log('delete '+ id);
//var deletememRec = id;
$('#deleteModal').modal('hide');
    var urlstr = base_url + 'deletedemandRec';
var url = urlstr.replace("undefined","");
//console.log(url);
    $.ajax({
        url: url+'/'+id,
        success:function (response) 
        {
         
//manageDemandTable.ajax.reload(null, false);
                            //console.log(response);
                            if(response.success === true) {
                            console.log(response);    
                            manageDemandTable.ajax.reload(null, false);                  
                                $("#delete-Demand-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');

    $('#deleteModal').modal('hide');
                                      
$("#delete-Demand-message").fadeTo(2000, 500).slideUp(500, function(){
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




var calculate = function addCalc()
{
    var total =0;

    $('.calc').each(function() {
        total+= Number($(this).val());
    });
    console.log(total);
$('#additemaccountTbl').find('#totAmt').val(total);
}




function myCalc()
{
 
 var thrift_amt = document.getElementById('editthrift_amt').value;
  var principal_amt = document.getElementById('editprinciple_amt').value; 
    var interest_amt = document.getElementById('editinterest_amt').value; 
    var insurance_amt = document.getElementById('editinsurance_amt').value; 
    var misc_amt = document.getElementById('editmisc_amt').value; 
var tot_amt  = parseFloat(thrift_amt)+parseFloat(principal_amt)+parseFloat(interest_amt)+parseFloat(insurance_amt)+parseFloat(misc_amt);
$('#tot_amt').val(tot_amt);


/*
var thrift = $('#show-edit-demand-result').find('#editthrift_amt').val();
var principal = $('#editprincipal_amt').val();
var interest = $('#editinterest_amt').val();
var tot_amt = parseFloat(thrift)+parseFloat(principal)+parseFloat(interest);
*/
//console.log(tot_amt);
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

</style>
