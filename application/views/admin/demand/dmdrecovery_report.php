<!-- /row -->
<?php  setlocale(LC_MONETARY, 'en_IN'); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Demand & Recovery Report</h3>


                            <div class="pull-right">
                                <label>Select a Month</label>  
                            <input id="monthYear" name="monthYear">
                            <button id="search" type="submit" class="btn btn-primary btn-rounded">Search</button>
                            </div>

                            
                            <hr>
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> Demand & Recovery Report
        
        
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
                                <table id="dmdrecTable" class="display table">
                                    
                                        <thead>
                                        <tr>
                                          <th colspan="8" style="text-align: center;">DEMAND</th>
                                          <th colspan="8" style="text-align: center;">RECOVERY</th>
                                        </tr>
                                        <tr>
                                            <th>Member#</th>
                                            <th>Member Name</th>
                                            <th>Demand Date</th>
                                            <th>Thrift</th>
                                            <th>Principle</th>
                                            <th>Interest</th>
                                            <th>Insurance</th>
                                            <th>Total</th>
                                            <th>Recovery Date</th>
                                            <th>Recovery Ref#</th>
                                            <th>Thrift</th>
                                            <th>Principle</th>
                                            <th>Interest</th>
                                            <th>Insurance</th>
                                            <th>Misc</th>
                                            <th>Total</th>

                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                      
                                    </tbody>
                            <tfoot align="right">
        <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
    </tfoot>        
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

                <!-- /.row -->




<!-- Modal -->




<script>
var manageDcbTable;
var total=0;         
$(document).ready(function(){
window.base_url = <?php echo json_encode(base_url('admin/demand/')); ?>;


$('#search').on('click',function() {

    console.log('Search Clicked');
    var urlstr = base_url + 'fetchDmdRecData';
 var url = urlstr.replace("undefined","");
 var month_year= $('#monthYear').val();
 var mm_yy = month_year.replace("-","");
console.log(month_year);
var system_name = "<?php echo $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;?>" ;

//console.log('fmDate ' + fmDate + ' toDate ' + toDate);
//$("#manageDemandTable").dataTable().fnDestroy();
 //manageDcbTable = $("#dcbTable").dataTable().fnDestroy();
//manageDcbTable =  $('#dcbTable').DataTable(); 
  // Append a caption to the table before the DataTables initialisation
    $('#dmdrecTable').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
 
                
manageDcbTable = $("#dmdrecTable").dataTable().fnDestroy();
 manageDcbTable =  $('#dmdrecTable').DataTable( 
  {
    "ajax"    : url+'?month_year=' + mm_yy, //+ 'fetchReceiptSearch',
         'order' : [],

"columns": [

            { "data": "memberid" },
            { "data": "membername" },
            { "data": "demanddate" },
            { "data": "dmd_thrift", render: $.fn.dataTable.render.number('','.', 2)  },
            { "data": "dmd_principle", render: $.fn.dataTable.render.number('', '.', 2)  },
            { "data": "dmd_interest" , render: $.fn.dataTable.render.number('', '.', 2) },
            { "data": "dmd_insurance", render: $.fn.dataTable.render.number('', '.', 2)  },
            { "data": "dmd_total", render: $.fn.dataTable.render.number('', '.', 2)  },
            { "data": "recoverydate" },
            { "data": "recoveryref" },
            { "data": "rec_thrift", render: $.fn.dataTable.render.number('', '.', 2)  },
            { "data": "rec_principle", render: $.fn.dataTable.render.number('', '.', 2)  },
            { "data": "rec_interest" , render: $.fn.dataTable.render.number('', '.', 2) },
            { "data": "rec_insurance", render: $.fn.dataTable.render.number('', '.', 2)  },
            { "data": "rec_misc", render: $.fn.dataTable.render.number('', '.', 2)  },
            { "data": "rec_total", render: $.fn.dataTable.render.number('', '.', 2)  }
        ],


'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
      "width": "4%"
 },
  {
      "targets": 1, // your case first column
      "className": "text-left",
      "width": "20%"
 },

 {
      "targets": [3,4,5,6,7,10,11,12,13,14,15],
      "className": "text-right"
 },

 ], 
"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

//$amount = '100000';

/*$amount = money_format('%!i', $amount);
echo $amount;
*/
//var numFormat = $.fn.dataTable.render.money_format( '%!i'  ).display;
 var numFormat = $.fn.dataTable.render.number( '', '.', 2,  ).display;
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // computing column Total of the complete result 
            var trfTotal = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
        var priTotal = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            var intTotal = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
         var insTotal = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
         var totTotal = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // computing column Total of the complete result 
            var rtrfTotal = api
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
        var rpriTotal = api
                .column( 11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            var rintTotal = api
                .column( 12 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
         var rinsTotal = api
                .column( 13 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
         var rmisTotal = api
                .column( 14 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
         var rtotTotal = api
                .column( 15 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                        
                
            // Update footer by showing the total with the reference of the column index 
        $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 3 ).footer() ).html(numFormat(trfTotal));
            $( api.column( 4 ).footer() ).html(numFormat(priTotal));
            $( api.column( 5 ).footer() ).html(numFormat(intTotal));
            $( api.column( 6 ).footer() ).html(numFormat(insTotal));
            $( api.column( 7 ).footer() ).html(numFormat(totTotal));
            $( api.column( 10 ).footer() ).html(numFormat(rtrfTotal));
            $( api.column( 11 ).footer() ).html(numFormat(rpriTotal));
            $( api.column( 12 ).footer() ).html(numFormat(rintTotal));
            $( api.column( 13 ).footer() ).html(numFormat(rinsTotal));
            $( api.column( 14 ).footer() ).html(numFormat(rmisTotal));
            $( api.column( 15 ).footer() ).html(numFormat(rtotTotal));
        }, 
//drawCallback:function(){var api = this.api();  $( api.table().footer() ).html(api.column( [3,4,5,6,7,10,11,12,13,14,15], {page:'current'} ).data().sum());},
        dom: 'Bfrtip',
       
        buttons: [
            'copy', 'csv',{extend: 'excel',footer:true,

customize: function( xlsx ) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
 $('row c[r^="D"]', sheet).attr( 's', '25' );
                $('row c[r^="D"]', sheet).attr( 's', '52' );
                $('row c[r^="E"]', sheet).attr( 's', '52' );
                $('row c[r^="F"]', sheet).attr( 's', '52' );
                $('row c[r^="G"]', sheet).attr( 's', '52' );
                $('row c[r^="H"]', sheet).attr( 's', '52' );

                $('row c[r^="K"]', sheet).attr( 's', '52' );
                $('row c[r^="L"]', sheet).attr( 's', '52' );
                $('row c[r^="M"]', sheet).attr( 's', '52' );
                $('row c[r^="N"]', sheet).attr( 's', '52' );
                $('row c[r^="O"]', sheet).attr( 's', '52' );
                $('row c[r^="P"]', sheet).attr( 's', '52' );


               // $('row c[r*="10"]', sheet).attr( 's', '25' );
               // $('row c[r^="G5"]', sheet).attr('s', ['51', '56']);

            },
            title: 'RECOVERY AGAINST DEMAND FOR THE MONTH OF_' + mm_yy

        },{
            extend: 'pdf',footer:true,


title: function() {
      return $('#monthYear').val();
    },

 title: system_name + '\n' + 'Recovery against Demand Report for the Month of '+ $('#monthYear').val(),
  customize: function(doc) {
    doc.styles.title = {
      color: 'red',
      fontSize: '30',
      background: 'blue',
      alignment: 'center'

    }   


  },

               exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5,6,7,8,9,10,11,12,13,14,15 ]
                },   
          
            orientation:  'landscape', //'portrait',


            customize: function (doc) {
                  var rowCount = doc.content[1].table.body.length;
for (i = 1; i < rowCount; i++) {
doc.content[1].table.body[i][3].alignment = 'right';
doc.content[1].table.body[i][4].alignment = 'right';
doc.content[1].table.body[i][5].alignment = 'right';
doc.content[1].table.body[i][6].alignment = 'right';
doc.content[1].table.body[i][7].alignment = 'right';
//doc.content[1].table.body[i][8].alignment = 'right';
//doc.content[1].table.body[i][9].alignment = 'right';
doc.content[1].table.body[i][10].alignment = 'right';
doc.content[1].table.body[i][11].alignment = 'right';
doc.content[1].table.body[i][12].alignment = 'right';
doc.content[1].table.body[i][13].alignment = 'right';
doc.content[1].table.body[i][14].alignment = 'right';
doc.content[1].table.body[i][15].alignment = 'right';

};


      doc.pageMargins = [20,10,10,20];
        doc.defaultStyle.fontSize = 7;
        doc.styles.tableHeader.fontSize = 7;
        
        doc.styles.tableFooter.fontSize = 7; 
        doc.styles.title.fontSize = 10; 
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();

      doc['footer']=(function(page, pages) {
            return {
                columns: [
                    'Recovery against Demand Report for the Month of '+ $('#monthYear').val(),
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
                    columns: [ 0, 1, 2, 3, 4, 5,6,7,8,9,10,11,12,13,14,15 ]
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
