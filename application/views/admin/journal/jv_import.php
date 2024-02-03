
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> Excel Imports</div>
				
				
				 <?php if ($this->session->userdata('role') == 'admin'): ?>

    <div class="container">
        <br>
        <h3 align="center">Import Journal Entry from Excel!</h3>
        <br />


       <div class="form-group" id="process" style="display:none;">
        <div class="progress">
       <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="height: 35%">
       </div>
      </div>
       </div>


        <form method="POST" id="import_form" enctype="multipart/form-data" >
          
          <label>Select Transaction Type </label>
          <select id="transtype" name="transtype">
            <option value="JOUR">JOURNAL</option>
            <option value="RCPT">RECEIPT</option>
            <option value="DIVJV">DIVISION-JV</option>
            <option value="PYMT">PAYMENT</option>
            <option value="LOAN">LOAN ISS/ADJ</option>
            <option value="CNTR">CONTRA</option>
            <option value="OPUPD">OPENING_BAL-UPD</option>
            <option value="DIVMEM">DIVMEM</option>
          </select>


            <p><label>Select Excel File</label>
                <input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>
        <br />
              
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
    <button type="submit" name="import" class="btn btn-primary" >Import &nbsp; <i id="btn_loading"></i></button>   
<hr>    

<div id="loading"></div>


    </form>
        <br />
        <div id="journal_data" class="table-responsive">
            
        </div>
    </div>

                   <?php endif ?>
				
		</div>
</div>
</div>


					




<script type="text/javascript">
$(document).ready(function(){
/*load_data();
console.log('ttttt');
    function load_data() 
    {
   urlstr = base_url + 'fetch';
   url = urlstr.replace("undefined","");
    $.ajax( {
        url: url,//'/api/staff/details',
       // dataType: 'json',
        success: function ( data ) {

                console.log(data);
             $('#journal_data').html(data);
            }
        });
    }
*/



$('#import_form').on('submit', function(event){
    event.preventDefault();
  $("#btn_loading").addClass('fa fa-refresh fa-spin');
 urlstr = base_url + 'importTrans';
 url = urlstr.replace("undefined","");
 console.log(url);
 
  $('#loading').html('<img src="<?php echo base_url(); ?>optimum/images/dotsloading.gif">');
    $.ajax( {
        url: url,
        type:"POST",
        data:new FormData(this),
        //data:"formData",
        processData:false,
        
        contentType:false,
        cache:false,
beforeSend:function()
     {
      var percentage = 10;
      $('#process').css('display', 'block');

$('#loading').html("Loading");


      var timer = setInterval(function(){
       percentage = percentage + 1;
       progress_bar_process(percentage, timer);
      }, 1000);
     
     },

        success: function ( data ) {
            $('#file').val('');
      //      load_data();
      //      alert("Data Successfully Imported...");
 
$("#btn_loading").removeClass();
 
         $('#loading').html("Successfully Imported...!!!!");

                if(data.success == true) {  
$("#btn_loading").removeClass();

$('#loading').html("Successfully Imported...!!!!");
      
              //  $('#btn_loading').attr('disabled', 'disabled');              
                        $("#recovery-process-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');

       $('.btn').html("Finished");
       $('.btn').attr("disabled",true);
$('#btn_loading').attr('disabled', 'disabled');
                    }   
                    else {                                  
 var timer = setInterval(function(){
       percentage = percentage+50;
       progress_bar_process(percentage, timer);
      }, 1);
     


$("#btn_loading").removeClass();                        
       $('#loading').html("");
                        $.each(response.messages, function(index, value) {
                            var key = $("#" + index);

                            key.closest('.form-group')
                            .removeClass('has-error')
                            .removeClass('has-success')
                            .addClass(value.length > 0 ? 'has-error' : 'has-success')
                            .find('.text-danger').remove();                         

                            key.after(value);
                        });
                                                
                    } // /else      },      

}
});

 //$('.btn').html("Processing");
    /*  setTimeout(function() {
       $("#btn_loading").removeClass();
       
   }, 5000);*/

});


});




function progress_bar_process(percentage, timer)
  {
   $('.progress-bar').css('width', percentage + '%');
   if(percentage > 100)
   {
    clearInterval(timer);
    $('#import_form')[0].reset();
    $('#process').css('display', 'none');
    $('.progress-bar').css('width', '0%');
    
    $('#success_message').html("<div class='alert alert-success'>Data Saved</div>");
    setTimeout(function(){
     $('#recovery-process-message').html('Imported data Successfully');
    }, 5000);
   }
}

 //DocumentReady


</script>