<!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Trial Balance</h3>
                         


<div class="pull-right">
  <div class="col-md-4">
        <div class="form-group">
          <div class="input-group input-group-lg">
            <label class="control-label">From</label>
            <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="dd-mm-yyyy" id="fmDate" name="fmDate" autocomplete="off" placeholder="dd-mm-yyyy" required>
            <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-calendar" id="fdtp"></i></span>
              </div>
          </div>
        </div>
</div>
<div class="col-md-4">
        <div class="form-group">
          
          <div class="input-group input-group-lg">
            <label class="control-label">To</label>
            <input type="text" class="form-control" id="toDate" name="toDate" autocomplete="off" placeholder="dd-mm-yyyy" required>
            <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-calendar" id="tdtp"></i></span>
              </div>
          </div>
        </div>
</div>

                            
                            <button id="sr" type="submit" class="btn btn-primary btn-rounded">Search</button>
                            </div>
    <hr>
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> All Consolidated Ledger Balances
        
        
        
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
                                <table id="tbTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>Particulars</th>
                                            <th>Opening Balance</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

                <!-- /.row -->







<script>
var managetbTable;         
$(document).ready(function(){
window.base_url = <?php echo json_encode(base_url('admin/report/')); ?>;
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

$('#fmDate').mask('00/00/0000');
$('#toDate').mask('00/00/0000');
  

$("#sr").on('click', function(){
  console.log("test");
 urlstr = base_url + 'fetchTBData';
 url = urlstr.replace("undefined","");
 var fmDate= $('#fmDate').val();
 var toDate= $('#toDate').val();
//  date("d-m-Y", strtotime($originalDate));
//console.log('fmDate ' + fmDate + ' toDate ' + toDate);
managetbTable = $("#tbTable").dataTable().fnDestroy();
 managetbTable =  $('#tbTable').DataTable( 
{
  "ajax"    : url+'?fdate=' + fmDate + '&tdate=' + toDate, //+ 'fetchReceiptSearch',
  "ordering": false,  
"columns": [
            { "data": "accname" },
            { "data": "opbalance",  render: $.fn.dataTable.render.number(',', '.', 2, '')  },
            { "data": "debit", render: $.fn.dataTable.render.number(',', '.', 2, '')   },
            { "data": "credit", render: $.fn.dataTable.render.number(',', '.', 2, '')   },
            { "data": "balance", render: $.fn.dataTable.render.number(',', '.', 2, '')   }
        ],

'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-left",
      "width": "100%"
 },
 {
      "targets": [1,2,3,4],
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

 title: system_name + '\n' + 'Trialbalance Report for the period from '+ $('#fmDate').val() + ' to '+ $('#toDate').val(),
  customize: function(doc) {
    doc.styles.title = {
      color: 'red',
      fontSize: '40',
      background: 'blue',
      alignment: 'center'

    }   


  },

               exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                },   
          
            orientation: 'portrait', // 'landscape',


            customize: function (doc) {
                  var rowCount = doc.content[1].table.body.length;

      doc.pageMargins = [20,10,10,10];
        doc.defaultStyle.fontSize = 12;
        doc.styles.tableHeader.fontSize = 8;
        doc.styles.title.fontSize = 7; 
        doc.styles.tableFooter.fontSize=7;
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();
 var rowCount = doc.content[1].table.body.length;
for (i = 1; i < rowCount; i++) {
doc.content[1].table.body[i][1].alignment = 'right';
doc.content[1].table.body[i][2].alignment = 'right';
doc.content[1].table.body[i][3].alignment = 'right';
doc.content[1].table.body[i][4].alignment = 'right';
}
      doc['footer']=(function(page, pages) {
            return {
                columns: [
                    'Trialbalance Report '+ $('#fmDate').val() + ' to '+ $('#toDate').val(),
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
                    columns: [ 0, 1, 2, 3, 4]
                },
      }

        ]




}); 

});


});



</script>

