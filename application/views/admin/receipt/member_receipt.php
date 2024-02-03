<?php 



 ?>

<div class="container">
	<h3></h3>

	<br/>
	<div class="card">
		<div class="card-header" style="background-color:skyblue;">New Receipts<span class="pull-right"><div><a href="<?php echo base_url('admin/receipt/viewall_mem_receipt');?>"> Veiw All Receipts</a></div></span> </div>
		<div class="add-receipt-message"></div>
		<div class="card-body">
			<form method="post" id="insert_form">

				<div class="form-group">
					<div class="row">
						
						<div class="col-md-12">
							<div class="col-md-3">
								<label>Month</label>
								<input type="text" class="form-control" name="rcpt_month" id="rcpt_month">
							</div>

							<div class="col-md-3">
								<label>Receipt Date</label>
								<input type="date" name="rcpt_date" class="form-control" id="rcpt_date">
							</div>

							<div class="col-md-6">
								<label>Select Bank / Cash</label>
							  <select id="cash_bank" name="cash_bank" class="form-control custom-select cash_bank"></select>
	
							</div>


						</div>
					</div>
				</div>


    <div class="table-resposive" style="height: 205px; overflow:auto">
        <div id="editdmdTbl"  style="height: 90%; overflow:auto">

<!--				<div class="table-responsive" style="height:280px;">-->
					<table   id="item_table">
						<tr>
						<th>Member Name</th>
						<th>Receipt#</th>
						<th>Bank Ref#</th>
						<th>Narration</th>
						<th>Amount</th>
						<th>Thrift</th>
						<th>Principle</th>
						<th>Interest</th>
						<th>Insurance</th>
						<th>Others</th>
						<th>Total</th>
						<th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fa fa-plus"></i></button></th>
						</tr>
					</table>
				</div>
			</div>
			 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

						<div class="pull-right">
						<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Save">
					</div>

			</form>
		</div>
	</div>

</div>























<style>
.table-responsive {
  overflow-y: visible !important;
}


.selectpicker{
	margin-top: inherit;
	z-index: -1;
}
</style>

<script>

$(document).ready(function(){
var count = 0;
var row_total=0;
var thf_amt=0;
var emi_amt=0;
var ins_amt=0;
var int_amt=0;
var oth_amt=0;


$('#rcpt_month').datepicker({
    format: 'mm-yyyy',
    startView: "months", 
    minViewMode: "months"
}).on('changeDate', function(e){
    $(this).datepicker('hide');
});


var urlstr = base_url+'fetchCashBankAccounts';
var url=urlstr.replace("undefined","");

$("#cash_bank").load(url);


function add_input_field(count)
{
	var html = '';
	html += '<tr id="row'+count+'">';
	html +='<td><select style="width:300px;" name="member_name[]" class="form-control selectpicker" data-live-search="true" data-container="body"><option value="">Select a Member</option><?php echo $ldg_acc; ?></select></td>';
	html += '<td><input type="text" name="item_rcptno[]" placeholder="Receipt #" class="form-control item_rcptno" /></td>';
	html += '<td><input type="text" name="item_bankref[]" placeholder="Bank Ref#" class="form-control item_bankref" /></td>';
	html += '<td><input type="text" name="item_narration[]" placeholder="Narration" class="form-control item_narration" /></td>';
	html += '<td><input  style="text-align:right;" type="text" name="item_amount[]" placeholder="0.00" class="form-control item_amount" /></td>';

	html += '<td><input  style="text-align:right;" type="text" value="0" placeholder="0.00" name="item_thrift[]" class="form-control item_thrift txt" /></td>';		

	html += '<td><input style="text-align:right;" type="text" value="0"  placeholder="0.00" name="item_principle[]" class="form-control item_principle txt" /></td>';		

	html += '<td><input style="text-align:right;" type="text" value="0"   placeholder="0.00" name="item_interest[]" class="form-control  item_interest txt" /></td>';		
	html += '<td><input  style="text-align:right;" type="text" value="0"  placeholder="0.00"  name="item_insurance[]" class="form-control  item_insurance txt" /></td>';		
	html += '<td><input style="text-align:right;" type="text"  value="0"  placeholder="0.00" name="item_others[]" class="form-control  item_others txt" /></td>';		
	html += '<td><input readonly style="text-align:right;" type="text"  value="0"  placeholder="0.00" name="item_total[]" class="form-control item_total" /></td>';		



var remove_button ='';
if(count>0)
{
	remove_button ='<button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fa fa-minus"></i></button>';

}
html +='<td>'+remove_button+'</td>';
html +='</tr>';

return html;
}

$('#item_table').append(add_input_field(0));
$('.selectpicker').selectpicker('refresh');

$(document).on('click','.add',function(){
count++;

$('#item_table').append(add_input_field(count));
$('.selectpicker').selectpicker('refresh');

});


$(document).on('click','.remove',function(){
$(this).closest('tr').remove();

});



$(document).on('change','.member_name',function(){

$('.member_name').trigger('change');
$('.selectpicker').selectpicker('refresh');

})


$('#insert_form').on('submit', function(event){

		event.preventDefault();

		var error = '';


		count = 1;

		$("select[name='member_name[]']").each(function(){

			if($(this).val() == '')
			{

				error += "<li>Select Member at "+count+" Row</li>";

			}

			count = count + 1;

		});

	var form_data = $(this).serialize();

		if(error == '')
		{

			$.ajax({

				url:"insertMemberReceipt",

				method:"POST",
    dataType:"json",

				data:form_data,

				beforeSend:function()
	    		{

	    			$('#submit_button').attr('disabled', 'disabled');

	    		},

				success:function(response)
				{
console.log(response);

                if(response.success == true) {                      
                  
                        $("#add-receipt-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  

						$('#item_table').find('tr:gt(0)').remove();

						$('#error').html('<div class="alert alert-success">'+ data.messages +'</div>');

						$('#item_table').append(add_input_field(0));

						$('.selectpicker').selectpicker('refresh');

						$('#submit_button').attr('disabled', false);

$("#add-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


}
    else
    {
                        $("#update-receipt-message").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');
$("#update-receipt-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


    }



/*
					if(data == 'ok')
					{
console.log('success if');
						$('#item_table').find('tr:gt(0)').remove();

						$('#error').html('<div class="alert alert-success">'+ data.messages +'</div>');

						$('#item_table').append(add_input_field(0));

						$('.selectpicker').selectpicker('refresh');

						$('#submit_button').attr('disabled', false);
					}

*/
				}
			});

		}
		else
		{
			$('#error').html('<div class="alert alert-danger"><ul>'+error+'</ul></div>');
		}

	});
	 


$(document).on('keyup keydown','.txt',function(){
console.log('test');
    var tbl = $('#item_table');
    tbl.find('tr').each(function () {
        $(this).find('input[type=text]').bind("keyup", function () {
        	
            calculateSum();
        });

});

});


}); //Document



    function calculateSum() {
        var tbl = $('#item_table');
        tbl.find('tr').each(function () {
            var sum = 0;
            $(this).find('.txt').not('.item_total').each(function () {
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
console.log('test2' + sum);
            $(this).find('.item_total').val(sum.toFixed(2));
            $(this).find('.item_amount').val(sum.toFixed(2));
        });
    }

</script>


<style>

#item_table th {  

white-space:nowrap;
text-align: center;
  background: royalblue;
  color: white;
  position: sticky;
  top: 0; /* Don't forget this, required for the stickiness */
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}
#item_table td {  
width: auto;
}


</style>