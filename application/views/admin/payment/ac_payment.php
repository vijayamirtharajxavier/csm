<?php 



 ?>

<div class="container">
	<h3></h3>

	<br/>
<form action="insertAccountClose" method="post" class="form-horizontal" id="createAccountCloseForm">
<!--	<form id="insert_form" method="post" >-->
		<div id="add-acpayment-message"></div>

	<div class="card">
	<div class="card-header" style="background-color:royalblue;color: white;">Account Closure<span class="pull-right"><div><a  style="color:white;" href="<?php echo base_url('admin/payment/alloth_payment');?>"> Veiw All Account Closures</a></div></span> 
	</div>
		<div class="card-body">
	
<div class="form-group">
					<div class="row">
						
						<div class="col-md-12">

							<div class="col-md-2">
								<label>AC Date</label>
								<input type="date" autocomplete="off" name="ac_date" class="form-control" id="ac_date">
							</div>

							<div class="col-md-5">
								<label>Select Bank / Cash</label>
							  <select id="cash_bank" name="cash_bank" class="form-control custom-select cash_bank" required></select>
	
							</div>
							<div class="col-md-5">
								<label>Select Member</label>
						<select style="width:300px;" name="member_id" id="member_id" class="form-control selectpicker" data-live-search="true" data-container="body"><option value="" disabled>Select an Account</option><?php echo $ldg_acc; ?></select>		
	
							</div>

</div>
</div>

<div class="row">
<div class="col-md-12">

<div class="col-md-2">
	<label>Cheque #</label>
<input autocomplete="off"  type="text" name="chqno" id="chqno" placeholder="Chq #" class="form-control chqno" />
</div>

<div class="col-md-2">
<label>Cheque Date</label>	
<input autocomplete="off"  type="date" name="chqdate" id="chqdate" placeholder="Cheque Date" class="form-control chqdate" />

</div>
<div class="col-md-2">
	<label>Cheque Amount</label>	

	<input  autocomplete="off"  style="text-align:right;" id="chqamount" type="text" name="chqamount" placeholder="0.00" class="form-control amount" />

</div>

<div class="col-md-6">
	<label>Narration</label>	

	<input autocomplete="off"  type="text" name="narration" id="narration" placeholder="Narration" class="form-control item_narration" />
</div>
</div>
</div>
</div>
</div>
<div class="col-md-12">
	

<div class="col-md-6">
	
<h4>Payments</h4>
    <div class="table-resposive" style="height: 205px; overflow:auto">
        <div id="editpytTbl" style="height: 90%; overflow:auto">

<!--				<div class="table-responsive" style="height:280px;">-->
					<table   id="item_table">
						<tr>
						
						<th>Journal Account Name</th>
						<th>Amount</th>
						<th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fa fa-plus"></i></button></th>
						</tr>
					</table>
		</div>
	</div>
</div>

<div class="col-md-6">
<h4>Receipts</h4>
    <div class="table-resposive" style="height: 205px; overflow:auto">
        <div id="editrcttTbl" style="height: 90%; overflow:auto">

<!--				<div class="table-responsive" style="height:280px;">-->
					<table   id="item_rcttable">
						<tr>
						
						<th>Journal Account Name</th>
						<th>Amount</th>
						<th><button type="button" name="rctadd" class="btn btn-success btn-sm rctadd"><i class="fa fa-plus"></i></button></th>
						</tr>
					</table>
		</div>
	</div>

</div>
</div>
			 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
<div class="col-md-12">
						<div class="pull-right">
						<input type="button" name="reset_button" id="reset_button" class="btn btn-danger" value="Reset">

						<input type="submit" name="submit_button" id="submit_button" class="btn btn-primary" value="Save">
					</div>
</div>

	

</div>


</form>
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
var cnt=0;
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
	html +='<td><select  autocomplete="off" style="width:300px;" name="payaccount_name['+count+']" class="form-control selectpicker" data-live-search="true" data-container="body"><option value="" disabled>Select a Contra</option><?php echo $ldg_acc; ?></select></td>';

	html += '<td><input  autocomplete="off"  style="text-align:right;" type="text" name="item_payamount['+count+']" placeholder="0.00" class="form-control item_payamount" /></td>';
/*
	html +='<td><input autocomplete="off"  type="text" name="item_chqno['+count+']" placeholder="Chq #" class="form-control item_chqno" /></td>';
	html += '<td><input autocomplete="off"  type="text" name="item_chqdate['+count+']" placeholder="Cheque Date" class="form-control item_chqdate" /></td>';
	html += '<td><input autocomplete="off"  type="text" name="item_narration['+count+']" placeholder="Narration" class="form-control item_narration" /></td>';
*/


var remove_button ='';
if(count>0)
{
	remove_button ='<button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fa fa-minus"></i></button>';

}
html +='<td>'+remove_button+'</td>';
html +='</tr>';

return html;
}


function add_rctinput_field(cnt)
{
	var html = '';
	html += '<tr id="row'+cnt+'">';
	html +='<td><select  autocomplete="off" style="width:300px;" name="rctaccount_name['+cnt+']" class="form-control selectpicker" data-live-search="true" data-container="body"><option value="" disabled>Select a Contra</option><?php echo $ldg_acc; ?></select></td>';

	html += '<td><input  autocomplete="off"  style="text-align:right;" type="text" name="item_rctamount['+cnt+']" placeholder="0.00" class="form-control item_rctamount" /></td>';
/*
	html +='<td><input autocomplete="off"  type="text" name="item_chqno['+count+']" placeholder="Chq #" class="form-control item_chqno" /></td>';
	html += '<td><input autocomplete="off"  type="text" name="item_chqdate['+count+']" placeholder="Cheque Date" class="form-control item_chqdate" /></td>';
	html += '<td><input autocomplete="off"  type="text" name="item_narration['+count+']" placeholder="Narration" class="form-control item_narration" /></td>';
*/


var remove_button ='';
if(cnt>0)
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



$('#item_rcttable').append(add_rctinput_field(0));
$('.selectpicker').selectpicker('refresh');

$(document).on('click','.rctadd',function(){
cnt++;

$('#item_rcttable').append(add_rctinput_field(cnt));
$('.selectpicker').selectpicker('refresh');

});


$(document).on('click','.remove',function(){
$(this).closest('tr').remove();

});



$(document).on('change','.account_name',function(){

$('.account_name').trigger('change');
$('.selectpicker').selectpicker('refresh');

})

$(document).on('change','.rctaccount_name',function(){

$('.rctaccount_name').trigger('change');
$('.selectpicker').selectpicker('refresh');

})

$(document).on('change','.payaccount_name',function(){

$('.payaccount_name').trigger('change');
$('.selectpicker').selectpicker('refresh');

})

$('#insert_form').on('submit', function(event){

		event.preventDefault();

		var error = '';


		count = 1;

		$("select[name='payaccount_name[]']").each(function(){

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

				url:"insertAccountClose",

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
                  
                        $("#add-acpayment-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');
						$('#submit_button').attr('enabled', 'enabled');


  

						$('#item_table').find('tr:gt(0)').remove();
						$('#item_rcttable').find('tr:gt(0)').remove();

						$('#error').html('<div class="alert alert-success">'+ data.messages +'</div>');

						$('#item_table').append(add_input_field(0));
						$('#item_rcttable').append(add_rctinput_field(0));

						$('.selectpicker').selectpicker('refresh');

						$('#submit_button').attr('disabled', false);

$("#add-acpayment-message").fadeTo(2000, 500).slideUp(500, function(){
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
	 





    $("#createAccountCloseForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');

        $.ajax({
            url: url,
            type: type,
            data: form.serialize(),
            dataType: 'json',
            success:function(response) {
                if(response.success == true) {                      


$("#member_id").val(0);

$('#member_id').trigger('change');
						cnt=0;
						count=0;
						$('#item_table').find('tr:gt(0)').remove();
						$('#item_rcttable').find('tr:gt(0)').remove();

//						$('#error').html('<div class="alert alert-success">'+ response.messages +'</div>');

						$('#item_table').append(add_input_field(0));
						$('#item_rcttable').append(add_rctinput_field(0));

						$('.selectpicker').selectpicker('refresh');

						$('#submit_button').attr('disabled', false);

                        $("#add-acpayment-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');

$("#createAccountCloseForm").trigger("reset");
  
$("#add-acpayment-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);


});

                    }   
                    else {                                  
                        
                        $.each(response.messages, function(index, value) {
                            var key = $("#" + index);

                            key.closest('.form-group')
                            .removeClass('has-error')
                            .removeClass('has-success')
                            .addClass(value.length > 0 ? 'has-error' : 'has-success')
                            .find('.text-danger').remove();                         

                            key.after(value);
                        });
                                                
                    } // /else
            } // /.success
        }); // /.ajax funciton
        return false;
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
            $(this).find('.item_payamount').val(sum.toFixed(2));
        });
    }

    function rctcalculateSum() {
        var tbl = $('#item_rcttable');
        tbl.find('tr').each(function () {
            var sum = 0;
            $(this).find('.txt').not('.item_total').each(function () {
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
console.log('test2' + sum);
            $(this).find('.item_total').val(sum.toFixed(2));
            $(this).find('.item_rctamount').val(sum.toFixed(2));
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


#item_rcttable th {  

white-space:nowrap;
text-align: center;
  background: purple;
  color: white;
  position: sticky;
  top: 0; /* Don't forget this, required for the stickiness */
  box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}
#item_rcttable td {  
width: auto;
}

</style>