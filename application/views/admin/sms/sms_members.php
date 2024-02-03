


                
                <!-- .row -->
                <div class="container">
                <div class="row">
<div id="add-sms-message"></div>
<form action="sendMobileSms" method="POST" id="sendSms">
<table class="table" id="sms_screen">

<tr>
<td>                  
<div>
 <h5 class="box-title">Members List - <?php echo count($membersmobile);?></h5>

         <select multiple id="public-methods" name="public-methods[]">
                                    <?php 
                foreach ($membersmobile as $key => $value) {
                    if($value['mobile_no']=="")
                    {
                     echo '<option value="'.$value['mobile_no'].'" disabled>'.$value['member_name'].'</option>';
                    }
                    else 
                    {
                    echo '<option value="'.$value['mobile_no'].'">'.$value['member_name'].'</option>';    
                    }
                    
                }?>
                                    </select>
       
                                    <div class="button-box m-t-20"> <a id="select-all" class="btn btn-danger btn-outline" href="#">Select all</a> <a id="deselect-all" class="btn btn-info btn-outline" href="#">Deselect all</a> 
                                        <a id="refresh" class="btn btn-warning btn-outline" href="#">refresh</a> </div>
 </div>                        
</td>    
<td>
<span><label id="mcount"></label></span>
<textarea id="mobilenumbers" name="mobilenumbers" class="form-control" style="height: 200px; width: 130px;"></textarea>
 <br><br>   
</td>
<td style="vertical-align: text-top;">
    <br>
    <span><label>SMS Templates</label></span>
    <select class="form-control" multiple="multiple" id="smstemplates" style="height: 200px;" name="smstemplates">
        
    </select>
   <br><br> 
</td>
<td>
<span><label>SMS Text</label></span>
<textarea id="message_text" cols="form-control my-5" style="height: 210px;" name="message_text" class="form-control"></textarea>
<ul id="sms-counter">
  <li>Encoding: <span class="encoding"></span></li>
  <li>Length: <span class="length"></span></li>
  <li>Messages: <span class="messages"></span></li>
  <li>Per Message: <span class="per_message"></span></li>
  <li>Remaining: <span class="remaining"></span></li>
</ul>


<span id='remainingC'></span>    
<br><br>    
</td>
</tr>    

</table>
<div style="text-align: center;">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

    <button id="refresh_btn"  class="btn btn-warning pull-right">Reset</button> &nbsp; &nbsp;
    <button type="submit" class="btn btn-success pull-right">Submit</button>
   </div> 
<hr>
<br>
</form>

</div>
</div>




<script>
$(document).ready(function(){    
var manageMemberTable; 
var urlstr = base_url + 'fetchSmsTemplates';
var url = urlstr.replace("undefined","");
//var url = $("#base_url").val();
$('#smstemplates').load(url, function() {
    
}); // /.fetching the selected class's section date                 


$("#smstemplates").change(function(){
  console.log($(this).val());
  var id = $(this).val();
  console.log(id[0]);
var urlstr = base_url + 'fetchSmsTemplateById';
var url = urlstr.replace("undefined","");

        $.ajax({
            url: url+'/'+id[0],
           // type: type,
           // data: form.serialize(),
            dataType: 'json',

            success:function(response) {
console.log(response);
$('#message_text').val('');
//  $('#message_text').val(response);
  document.getElementById('message_text').value=response;
$('#message_text').countSms('#sms-counter');
//$('#message_text').select();
}
});

});

});

$(function(){

  $('#message_text').countSms('#sms-counter');

});


    $("#sendSms").unbind('submit').bind('submit', function() {
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
                        $("#add-sms-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#add-sms-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
$("#sendSms").trigger("reset");

/*setTimeout(function(){// wait for 5 secs(2)
           location.reload(); // then reload the page.(3)
    }, 500); 

  */                    //  $("#addSalesInvoiceTable:not(:first)").remove();
                       // $('.form-group').removeClass('has-error').removeClass('has-success');
                       // $('.text-danger').remove();     
                        //addSalesInvoiceTable.ajax.reload(null,false);
                      //  manageInvoiceTable.ajax.reload(null, false);
                      //  getInvoiceno();
manageMemberTable.ajax.reload(null,false);
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



</script>