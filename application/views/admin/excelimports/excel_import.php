
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> Excel Imports
				
				
				 <?php if ($this->session->userdata('role') == 'admin'): ?>

    <div class="container">
        <br>
        <h3 align="center">Import Journal Entry from Excel!</h3>
        <br />

        <form method="POST" id="import_form" enctype="multipart/form-data" >
            <p><label>Select Excel File</label>
                <input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>
        <br />
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
</div>

					




<script type="text/javascript">
$(document).ready(function(){
load_data();
console.log('ttttt');
    function load_data() 
    {
        $.ajax({
            url:"<?php echo base_url(); ?>excel_import/fetch",
            method:"POST",
            success:function(data){
                console.log(data);
             $('#journal_data').html(data);
            }
        });
    }



});
</style>
