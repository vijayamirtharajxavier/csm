
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

        <form method="POST" id="import_form" enctype="multipart/form-data" >
            <p><label>Select Excel File</label>
                <input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>
        <br />
              
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
        <input type="submit" name="import" value="Import" class="btn btn-info" />
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
load_data();
console.log('ttttt');
    function load_data() 
    {
   urlstr = base_url + 'phonefetch';
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

$('#import_form').on('submit', function(event){
    event.preventDefault();

 urlstr = base_url + 'phoneimport';
 url = urlstr.replace("undefined","");
 console.log(url);
    $.ajax( {
        url: url,
        type:"POST",
        data:new FormData(this),
        //data:"formData",
        processData:false,
        
        contentType:false,
        cache:false,
        success: function ( data ) {
            $('#file').val('');
            load_data();
            alert("Data Successfully Imported...");
}
});


});

});
</script>

