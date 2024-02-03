<!-- /row -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <!--                            <h3 class="box-title m-b-0">Cash / Bank Day Book</h3>-->


          <!--  <div class="col-md-3">
                <select id="ldgrSelect" name="ldgrSelect" class="custom-select col-6 form-control">
                    <option selected>Choose...</option>
                </select>
            </div>-->
            <div class="col-md-3">
                <label>From</label>
                <input type="date" name="fmDate" id="fmDate">
            </div>
            <div class="col-md-3">

                <label>To</label>
                <input type="date" name="toDate" id="toDate">
            </div>
            <div class="col-md-3">


                <button id="search" type="button" class="btn btn-primary btn-rounded">Search</button>
            </div>
            <hr>
            <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> Daybook



                </div>

                <div class="panel-body table-responsive">

                    <?php $msg = $this->session->flashdata('msg'); ?>
                    <?php if (isset($msg)): ?>
                    <div class="alert alert-success delete_msg pull" style="width: 100%"> <i
                            class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                                aria-hidden="true">×</span> </button>
                    </div>
                    <?php endif ?>

                    <?php $error_msg = $this->session->flashdata('error_msg'); ?>
                    <?php if (isset($error_msg)): ?>
                    <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i>
                        <?php echo $error_msg; ?> &nbsp;
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                                aria-hidden="true">×</span> </button>
                    </div>
                    <?php endif ?>

<div id="daybook"></div>


                </div>
            </div>
        </div>
    </div>
</div>


<!-- /.row -->










<script>
var managecashbankTable;
$(document).ready(function() {
    window.base_url = <?php echo json_encode(base_url('admin/report/')); ?> ;
    window.logo_url = <?php echo json_encode(base_url()); ?> ;
    //console.log(logo_url);
    var system_name =
        "<?php echo $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;?>";



    $('#search').on('click', function() {

        console.log('Search Clicked');


        urlstr = base_url + 'fetchDaybookSearch';
        url = urlstr.replace("undefined", "");
var fmDate = $('#fmDate').val();
var toDate = $('#toDate').val();
$.ajax(url+'?fdate='+fmDate+'&tdate='+toDate, 
{
    //dataType: 'json', // type of response data
   // timeout: 500,     // timeout milliseconds
    success: function (data,status,xhr) {   // success callback function
     console.log(data);
        $('#daybook').empty();
        $('#daybook').append(data);
    },
    error: function (jqXhr, textStatus, errorMessage) { // error callback 
        $('#daybook').append('Error: ' + errorMessage);
    }
});


});










}); //Document
</script>








