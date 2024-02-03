<!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">DCB Report</h3>


                            <div class="pull-right">
                                <label>Select a Month</label>  
                            <input id="monthYear" name="monthYear">
                            <button id="search" type="submit" class="btn btn-primary btn-rounded">Search</button>
                            </div>

                            
                            <hr>
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> DCB Report
        
        
         <?php if ($this->session->userdata('role') == 'admin'): ?>
                    <!--<a href="<?php //echo base_url('admin/journal/create_journal') ?>" class="btn btn-info btn-sm pull-right" ><i class="fa fa-plus"></i>&nbsp;New Journal</a> &nbsp;  -->
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
                                <table id="dcbTable" class="display table">
                                    <thead>

                                        <tr>
                                          
                                            <th>Member#</th>
                                            <th>Member Name</th>
                                            <th>Particulars</th>
                                            <th>Thrift Opening</th>
                                            <th>Thrift Deposits</th>
                                            <th>Thrift Closing</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

                <!-- /.row -->




<!-- Modal -->

<div id="add-journal-modal" class="fade modal" role="dialog">

    <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Journal</h4>
      </div>
      

        <div id="add-journal-message"></div>
        <form action="createJournal" method="post" class="form-horizontal" id="createJournalForm">
      <div class="modal-body">
    


                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><i class="fa fa-document"></i> Journal</div>

<div id="add-jv-message"></div>
                                    

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    
                                        <div class="form-body">
                                            <h3 class="box-title">Journal Voucher</h3>


                                         </div>      

                                            <hr>




<table class="table">
  <tbody>
  <tr>
    <td>
                                    <div class="form-group">
                                    <label for="example-text">Journal Number
                                    </label>
                                        <input type="text"  value="<?php echo $journal_id;  ?>" id="journal_id" name="journal_id" class="form-control" autocomplete="off"  readonly>
                                    </div>

</td><td>                                <div class="form-group">
                                    <label >Journal Date
                                    </label>
                                        <input type="date" id="journal_date" name="journal_date" autocomplete="off"  class="form-control mydatepicker">
                                </div>
                              </td><td rowspan="5">             
                                  <table id="tblJournal">
                                  <th>Account Name</th>
                                  <th style="text-align: right;">Amount</th>
                                  <tbody>
                                 <?php $x=0; foreach ($subacc as $key=> $svalue)

                                  {  ?>
                                    <input type="text" id="itemid<?php echo $x ?>" value="<?php echo $svalue['id'] ?>" name="itemid[<?php echo $x ?>]" hidden>
                                    <input type="tex" id="itemname<?php echo $x ?>" value="<?php echo $svalue['item_name'] ?>" name="itemname[<?php echo $key ?>]" hidden>
                                  <tr><td><b><?php echo $svalue['item_name'] ?></b> 
                                    
                                    </td>  <td>
                                    <input type="text" id="itemamount<?php echo $x ?>" name="itemamount[<?php echo $x ?>]"  placeholder="0.00" style="text-align: right;" class="form-control subamt" autocomplete="off">
                                    </td>
                                  </tr>
<?php 

       // $data['subacclist'] = $srow['item_name'];
       $x++; } ?>
                                        
                                  </tbody>
                                </table>
</td>
  </tr>
  <tr>
    <td>                                <div class="form-group">
                                    <label  >Debit To
                                    </label>
                                 <input type="text" id="debitaccountName" name="debitaccountName" autocomplete="off" class="form-control typeahead" placeholder="Account Name" required>
                                 
                                </div>
</td>
<td>                                <div class="form-group">
                                    <label  for="paydate">Total Amount
                                    </label>
                                        <input type="text" id="debit_amt" name="debit_amt" autocomplete="off"  class="form-control dramt" placeholder="0.00" style="text-align: right;" required>
                                </div>
</td>
    
  </tr>
  <tr>
    <td>                                <div class="form-group" id="creditldgr">
                                    <label class="col-md-6" >Credit to
                                    </label>
                                 <input type="text" id="creditaccountName" name="creditaccountName" autocomplete="off" class="form-control typeahead" placeholder="Account Name" required>
                                 
                                </div>
</td>
<td>                                <div class="form-group">
                                    <label class="col-md-6" for="paydate">Total Amount
                                    </label>
                                        <input type="text" id="credit_amt" name="credit_amt" autocomplete="off"  class="form-control cramt" placeholder="0.00" style="text-align: right;" required>
                                </div>
</td>
  </tr>
  <tr><td colspan="3">
                               <div class="form-group">
                                    <label class="col-md-6" for="paydate">Narration
                                    </label>
                                        <input type="text" id="jvnarration" name="jvnarration" class="form-control mydatepicker" placeholder="Narration"  autocomplete="off" >
                                </div>
     
  </td></tr>
  </tbody>
</table>


                                 <input type="text" id="debitaccountNumber" name="debitaccountNumber" hidden>
                                 <input type="text" id="creditaccountNumber" name="creditaccountNumber" hidden>
                                 <input type="text" id="creditmemberNumber" name="creditmemberNumber" hidden>

                                 <input type="text" id="itemName" name="itemName" hidden>

 
                            
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

     </div> 
     </div>
     </div>
     </div>
     </div>


    

    </div>
        
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
      <!-- /modal-body -->
    <div class="modal-footer">
        <button type="submit" id="update_btn" class="btn btn-success" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
 </form>
    </div>
  </div>
</div>





<div id="edit-journal-modal" class="fade modal" role="dialog">

    <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Journal</h4>
      </div>
      

        <div id="edit-journal-message"></div>
        <form action="update_journal" method="post" class="form-horizontal" id="editjournalForm">
      <div class="modal-body">
        <div id="show-edit-journal-result"></div>
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








<script>
var manageDcbTable;
var total=0;         
$(document).ready(function(){
window.base_url = <?php echo json_encode(base_url('admin/report/')); ?>;


$('#search').on('click',function() {

    console.log('Search Clicked');
    var urlstr = base_url + 'fetchdcb';
 var url = urlstr.replace("undefined","");
 var month_year= $('#monthYear').val();
 var mm_yy = month_year.replace("-","");
console.log(month_year);
var system_name = "<?php echo $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;?>" ;

//console.log('fmDate ' + fmDate + ' toDate ' + toDate);
//$("#manageDemandTable").dataTable().fnDestroy();
 //manageDcbTable = $("#dcbTable").dataTable().fnDestroy();
//manageDcbTable =  $('#dcbTable').DataTable(); 
 console.log(url);               
manageDcbTable = $("#dcbTable").dataTable().fnDestroy();
 manageDcbTable =  $("#dcbTable").dataTable({
    "ajax"    : url, // +'?month_year=' + mm_yy, 
    //+ 'fetchReceiptSearch',
   
"columns": [
            { "data": "memberid" },
            { "data": "membername" },
            { "data": "cb_name" },
            { "data": "op_thrift" },
            { "data": "thrift" },
            { "data": "thriftclosing" }
        ],

'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
      "width": "4%"
 },
 {
      "targets": [5,6,7,8,9,10,11],
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

 title: system_name + '\n' + 'DCB Report for the period Month of '+ $('#monthYear').val(),
  customize: function(doc) {
    doc.styles.title = {
      color: 'red',
      fontSize: '30',
      background: 'blue',
      alignment: 'center'

    }   


  },

               exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5,6,7,8,9,10,11 ]
                },   
          
            orientation:'landscape', //'portrait', // 'landscape',


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
doc.content[1].table.body[i][10].alignment = 'right';
doc.content[1].table.body[i][11].alignment = 'right';
};


      doc.pageMargins = [20,10,10,10];
        doc.defaultStyle.fontSize = 11;
        doc.styles.tableHeader.fontSize = 8;
        doc.styles.title.fontSize = 10; 
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();

      doc['footer']=(function(page, pages) {
            return {
                columns: [
                    'DCB Report for the period Month of '+ $('#monthYear').val(),
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


$("#monthYear").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});









}); //--document ready

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
