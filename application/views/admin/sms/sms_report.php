                <!-- /.row -->
<!-- .row -->
<div class="row">
    <div class="white-box col-md-12 col-lg-12 col-xs-12">
        <div class="form-group">
            <form method="post">
            <h3 class="box-title">
        Period from <input class="form-control" type="date" name="fmDate" id="fmDate"> 
         to <input type="date" class="form-control" name="toDate" id="toDate"><button type="button" onclick="smsSearch();" >Submit</button> </h3>
            
                
</form>
 </div>
</div>
  
</div>

<table class="table" id="manageSmsTable">
  <thead>
  <th>
    S.No.
  </th>
  <th>
    Date
  </th>
  <th>
    Member Name
  </th>
  <th>
    Mobile No.
  </th>
  <th>
    Message Text
  </th>
  <th>
    Status
  </th>
  </thead>
  <tbody>
    
  </tbody>
</table>

<br>




<script>
    $(document).ready(function() {
var resp="";

console.log('smsrep');



 
 });


function smsSearch(){

  //console.log($(this).val());
  var fDate = $('#fmDate').val();
  var tDate = $('#toDate').val();
//console.log('Test');
 // console.log(id[0]);
var urlstr = base_url + 'smsfetchReport';
var url = urlstr.replace("undefined","");
 // 
var system_name = "<?php echo $this->db->get_where('soc_settings', array('type' => 'system_name'))->row()->description;?>" ;
//*       $("#manageSmsTable").dataTable().fnDestroy();
      manageSmsTable = $("#manageSmsTable").DataTable({
         //'serverSide': true,
         'destroy':true,
            'ajax' : url+'/'+fDate+'/'+tDate, //base_url + 'invoice/fetchMemberData',
            'dataSrc': 'data',
            'type' : 'post', 
            'order' : [],
   // lengthMenu: [[25, 100, -1], [25, 100, "All"]],
   // pageLength: 25,
        dom: 'Bfrtip',
      
        buttons: [
            'copy', 'csv', 'excel',{
            extend: 'pdf',
title: function() {
      return $('#monthYear').val();
    },

 title: system_name + '\n' + 'SMS Report for the period from  ' +$('#fmDate').val() + ' to ' + $('#toDate').val(),
  customize: function(doc) {
    doc.styles.title = {
      color: 'red',
      fontSize: '40',
      background: 'blue',
      alignment: 'center'

    }   


  },

                                     exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                },   
          
            orientation: 'portrait', // 'landscape',


            customize: function (doc) {
                  var rowCount = doc.content[1].table.body.length;
for (i = 1; i < rowCount; i++) {
//doc.content[1].table.body[i][5].alignment = 'right';
//doc.content[1].table.body[i][6].alignment = 'right';
/*doc.content[1].table.body[i][5].alignment = 'right';
doc.content[1].table.body[i][6].alignment = 'right';
doc.content[1].table.body[i][7].alignment = 'right';
doc.content[1].table.body[i][8].alignment = 'right';
doc.content[1].table.body[i][9].alignment = 'right'; */
};


      doc.pageMargins = [20,10,10,10];
        doc.defaultStyle.fontSize = 7;
        doc.styles.tableHeader.fontSize = 8;
        doc.styles.title.fontSize = 10; 
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();

      doc['footer']=(function(page, pages) {
            return {
                columns: [ 
                    'SMS Report for the period from  ' +$('#fmDate').val() + ' to ' + $('#toDate').val() ,
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



            orientation: 'landscape'
          }, 'print'

        ]
});
}

/*
  columnDefs: [
    {
        //targets: 7,
        //className: 'dt-body-right'
    }
  ] *

        });

*/






</script>