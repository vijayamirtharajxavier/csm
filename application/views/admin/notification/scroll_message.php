<div id="add-notification-message" class="pull-right"></div>

<div class="col-md-12">
<div class="col-md-4">

<form action="createNotification" method="post" class="form-horizontal" name="createNotificationForm" id="createNotificationForm">
  <div class="row">
<div class="col-md-6 mb-3">
<div class="form-group">
    <label for="fromdate">From Date</label>
    <input type="date" class="form-control" id="fmDate" name="fmDate" placeholder="dd/mm/yyyy">
</div>
</div>
<div class="col-md-6 mb-3">
<div class="form-group">

<label for="fromdate">To Date</label>
    <input type="date" class="form-control" id="toDate"  name="toDate" placeholder="dd/mm/yyyy">
  </div>
</div>
  </div>
 <input type="text" id="addupdflag" name="addupdflag" hidden >
 <input type="text" id="recid" name="recid" hidden >
  <div class="form-group">
    <label for="exampleFormControlSelect1">Notification Category</label>
    <select class="form-control" name="category_id" id="category_id">
   
    </select>
  </div>

 
   
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Notification Message Content</label>
    <textarea class="form-control" name="notification_content" id="notification_content" rows="5"></textarea>
  </div>
  
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
  <div class="center">
  <button type="submit" class="btn btn-success" style="text-align: center;"><i class="fa fa-save"></i> Save</button>

  </div>

</form>



</div>
<div id="deleteModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
              <!--  <div class="icon-box">
                    <i class="fa fa-times"></i>
                </div>   -->           
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

<div class="col-md-8">
   <div class="table-responsive">
       <table id="ncTbl" class="table table-stripped" style="white-space:nowrap;">
       <thead>
        <th>Action</th>
        <th>From Date</th>
        <th>To Date</th>
        <th>Category</th>
        <th>Scrolling Message</th>
        <th>is Active?</th>
        </thead>
        <tbody></tbody>
       </table>
   </div> 
</div>
</div>



<script>

//$('#fmDate').mask('00/00/0000');

//$('#toDate').mask('00/00/0000');
var managencTbl;
var addupd_flag="0";
$("#addupdflag").val(addupd_flag);

$(document).ready(function(){
  console.log('Loaded');
getAllnotification();

var urlstr = base_url + 'fetchEventCategory';
var url = urlstr.replace("undefined","");

$("#category_id").load(url);





$("#createNotificationForm").unbind('submit').bind('submit', function() {
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

       /*           $.toast({        loaderBg: '#5475ed',
                    
        icon: 'info',
        hideAfter: 3500,
        stack: 6,
 position:'top-right', priority : 'success', title : 'Notice', message : response.message}); 
      */               
                        $("#add-notification-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


                        managencTbl.ajax.reload(null, false);

$("#add-notification-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
//$("#memberNumber").val("");
//$('#memberNumber').trigger('change.select2');

$("#createNotificationForm").trigger("reset");

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





}); //Documents

function deleteEvent(id)
{
  //console.log("id:"+id);
  urlstr = base_url + 'del_eventDatabyid';
url = urlstr.replace("undefined","");

  $.ajax({
    url: url+'?eventid=' + id, //+ 'fetchReceiptSearch',
    dataType: 'json',
    type: 'get',
    cache:false,
    success: function(response){
     // console.log(data);
      if(response.success==true)
      {
        managencTbl.ajax.reload(null, false);
      }
//    var event_data = '';
//console.log(data);
    }
  });

}


function updateEvent(id)
{
 // console.log(id);

addupd_flag="1";
$("#addupdflag").val(addupd_flag);
$("#recid").val(id);
var urlstr = base_url + 'fetchEventCategory';
var url = urlstr.replace("undefined","");

$("#category_id").load(url);


urlstr = base_url + 'get_eventDatabyid';
url = urlstr.replace("undefined","");

$.ajax({
    url: url+'?eventid=' + id, //+ 'fetchReceiptSearch',
    dataType: 'json',
    type: 'get',
    cache:false,
    success: function(data){
    var event_data = '';
//console.log(data);
$.each(data, function(index) {
console.log(data[index].event_date);
$('#fmDate').val(data[index].from_date);
$('#toDate').val(data[index].to_date);
$('#category_id').val(data[index].category_id);
$('#category_id').trigger('change.select2');
$('#memName').val(data[index].member_name);
$('#notification_content').val(data[index].event_name);


});
    }






});

}

function getAllnotification()
{
  urlstr = base_url + 'getAllNotifications';
url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();
//  date("d-m-Y", strtotime($originalDate));
//console.log('fmDate ' + fmDate + ' toDate ' + toDate);
managencTbl = $("#ncTbl").dataTable().fnDestroy();
managencTbl =  $('#ncTbl').DataTable( 
  {
    "ajax"    : url, //+'?fdate=' + fmDate + '&tdate=' + toDate, //+ 'fetchPaymentSearch',
   
"columns": [ { "data": "action" },
            { "data": "from_date" },
            { "data": "to_date" },
            { "data": "category_name" },
            { "data": "event_name" },
            { "data": "status" }
           
        ],

    });

}


</script>

<style>
  input[type="text"], textarea {

background-color : #56fcf4; 
width: 10em;

}

</style>
