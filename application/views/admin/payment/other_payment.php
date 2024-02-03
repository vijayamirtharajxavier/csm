<?php 



 ?>

<div class="container">
	<h3></h3>

	<br/>
	<div class="card">
		<div class="card-header" style="background-color:skyblue;">Other Payments<span class="pull-right"><div><a href="<?php echo base_url('admin/payment/alloth_payment');?>"> Veiw All Oth Payments</a></div></span> </div>
		<div class="add-payment-message"></div>
		<div class="card-body">
  <!--  <form action="createOthPayment" method="post" class="form-horizontal" id="updateOfficenoteForm">-->
			<form method="post" id="insert_form">

				<div class="form-group">
					<div class="row">
						
						<div class="col-md-12">

							<div class="col-md-2">
								<label>Payment Date</label>
								<input type="date" autocomplete="off" name="pymt_date" class="form-control" id="pymt_date">
							</div>

							<div class="col-md-10">
								<label>Select Bank / Cash</label>
							  <select id="cash_bank" name="cash_bank" class="form-control custom-select cash_bank" required></select>
	
							</div>


						</div>
					</div>
				</div>


    <div class="table-resposive" style="height: 205px; overflow:auto">
        <div id="editpytTbl"  style="height: 90%; overflow:auto">

<!--				<div class="table-responsive" style="height:280px;">-->
					<table   id="item_table">
						<tr>
						<th>Ledger Account Name</th>
						<th>Payment Ref#</th>
						<th>Bank / Cash Ref#</th>
						<th>Narration</th>
						<th>Amount</th>
						<th>Journal Account Name</th>
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
	html +='<td><select style="width:300px;" name="account_name['+count+']" class="form-control selectpicker" data-live-search="true" data-container="body"><option value="" disabled>Select an Account</option><?php echo $ldg_acc; ?></select></td>';
	html += '<td><input autocomplete="off"  type="text" name="item_pymtno['+count+']" placeholder="Payment Ref #" class="form-control item_pymtno" /></td>';
	html += '<td><input autocomplete="off"  type="text" name="item_bankref['+count+']" placeholder="Bank Ref#" class="form-control item_bankref" /></td>';
	html += '<td><input autocomplete="off"  type="text" name="item_narration['+count+']" placeholder="Narration" class="form-control item_narration" /></td>';
	html += '<td><input  autocomplete="off"  style="text-align:right;" type="text" name="item_amount['+count+']" placeholder="0.00" class="form-control item_amount" /></td>';
	html +='<td><select  autocomplete="off" style="width:300px;" name="jaccount_name['+count+']" class="form-control selectpicker" data-live-search="true" data-container="body"><option value="" disabled>Select a Contra</option><?php echo $ldg_acc; ?></select></td>';




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



$(document).on('change','.account_name',function(){

$('.account_name').trigger('change');
$('.selectpicker').selectpicker('refresh');

})

$(document).on('change','.jaccount_name',function(){

$('.jaccount_name').trigger('change');
$('.selectpicker').selectpicker('refresh');

})

$('#insert_form').on('submit', function(event){

		event.preventDefault();

		var error = '';


		count = 1;

		$("select[name='account_name[]']").each(function(){

			if($(this).val() == '')
			{

				error += "<li>Select Account at "+count+" Row</li>";

			}

			count = count + 1;

		});



	var form_data = $(this).serialize();

		if(error == '')
		{

			$.ajax({

				url:"insertAccountPayment",

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
                  
                        $("#add-payment-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');
						$('#submit_button').attr('enabled', 'enabled');


  

						$('#item_table').find('tr:gt(0)').remove();

						$('#error').html('<div class="alert alert-success">'+ data.messages +'</div>');

						$('#item_table').append(add_input_field(0));

						$('.selectpicker').selectpicker('refresh');

						$('#submit_button').attr('disabled', false);

$("#add-payment-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


}
    else
    {
                        $("#update-payment-message").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');
$("#update-payment-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


    }


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