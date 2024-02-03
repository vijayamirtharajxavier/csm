
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> All Sub Divisions
				
				
				 <?php if ($this->session->userdata('role') == 'admin'): ?>
                 
                    <a href="" class="btn btn-info btn-sm pull-right"  data-toggle="modal" data-target="#modalAddSDivision"><i class="fa fa-plus"></i>&nbsp;New Sub Division</a> &nbsp;
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

                <table id="manageSDivisionTable">
                            <thead>
                                <tr><th>Sub Division #</th>
                                    <th>Sub Dvision Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <tr>
                                    <th>Sub Division #</th>
                                    <th>Sub Dvision Name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                    
                </table>

                    </div>
					
					
            </div>
        </div>
    </div>

 </div>

    <!-- End Page Content -->


<!-- Edit Division -->

<!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="modalAddSDivision" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Sub Division</h4>
      </div>
      <div id="add-sdiv-message"></div>

      <form action="createSDivision" method="post" id="createNewSDiv">
      <div class="modal-body">
        <label>Sub Division Name</label>
        <span><input type="text" autocomplete="off"  style="text-transform: uppercase" id="sdivname"  name="sdivname" placeholder="Sub Division Name" class="form-control" required></span>
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

<!-- Edit Division-->
<!-- edit Invoices -->
<div id="edit-sdivision-modal" class="fade modal" role="dialog">

    <div class="modal-dialog">
    <div class="modal-content" >
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Sub Division</h4>
      </div>
      

        <div id="edit-sdivision-message"></div>
        <form action="updateSDiv" method="post" class="form-horizontal" id="editSDivisionForm">
      <div class="modal-body">
        <div id="show-edit-sdivision-result"></div>
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



<script type="text/javascript">
    var manageSDivisionTable;
 $(document).ready(function(){




    $('#save_btn').on('click',function(){
        //alert('Save Btn Clicked');
   var sdivname = $('#sdivname').val();



    });
divisionList()








  });  

function divisionList() {
    //console.log('invoicelistfet')
    var urlstr = base_url + 'fetchSDivisionData';
var url = urlstr.replace("undefined","");

        manageSDivisionTable = $("#manageSDivisionTable").DataTable({
            'ajax' : url, //base_url + 'invoice/fetchDivisionData',
            'order' : []            
        }); 
}



    $("#createNewSDiv").unbind('submit').bind('submit', function() {
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
                        $("#add-sdiv-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#add-sdiv-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
$("#createNewSDiv").trigger("reset");

/*setTimeout(function(){// wait for 5 secs(2)
           location.reload(); // then reload the page.(3)
    }, 500); 

  */                    //  $("#addSalesInvoiceTable:not(:first)").remove();
                       // $('.form-group').removeClass('has-error').removeClass('has-success');
                       // $('.text-danger').remove();     
                        //addSalesInvoiceTable.ajax.reload(null,false);
                      //  manageInvoiceTable.ajax.reload(null, false);
                      //  getInvoiceno();
manageSDivisionTable.ajax.reload(null,false);
                      //  $("#createInvoiceForm")[0].reset();             
                      //  $(".appended-exp-row").remove();
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


function updateSDivisions(id = null) 
{
    if(id) {
    
invflag=1;
        //console.log(id);
var furl;
//var invNo = id ;
 // furl = "invoice/fetchInvoiceDataForUpdate/";
    var urlstr = base_url + 'fetchSDivisionUpdate';
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
            $("#show-edit-sdivision-result").html(response);
 var $outp = response;          
 //console.log($outp);

            $("#editSDivNo").val(id);
            
                //$("#editTotalAmount").attr('disabled', true);
                /*SUBMIT FORM*/
                
                $("#editSDivisionForm").unbind('submit').bind('submit', function() {                  
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
                                $("#edit-sdivision-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');      
$("#edit-sdivision-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});             
                                
                                $('.form-group').removeClass('has-error').removeClass('has-success');
                                $('.text-danger').remove(); 
                               // $("#addSalesInvoiceTable:not(:first)").remove();                                
                                //createTypeahead($td.find('input.edititemSearch'));
                                //manageExpeneseTable.ajax.reload(null, false);
                                manageSDivisionTable.ajax.reload(null, false);
                                                                
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



function deleteSDivision(id) 
{
 //   console.log(id);

$('#delRec').on('click',function() {
   // var id = $this.val();
console.log('delete '+ id);
$('#deleteModal').modal('hide');
    var urlstr = base_url + 'deleteSDivRec';
var url = urlstr.replace("undefined","");
//console.log(url);
    $.ajax({
        url: url+'/'+id,
        success:function (response) 
        {
manageSDivisionTable.ajax.reload(null, false);
                            //console.log(response);
                            if(response.success == true) {    
                            manageSDivisionTable.ajax.reload(null, false);                  
                                $("#delete-sdivision-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                  response.messages + 
                                '</div>');

    $('#deleteModal').modal('hide');
                                      
$("#delete-sdivision-message").fadeTo(2000, 500).slideUp(500, function(){
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
</style>
