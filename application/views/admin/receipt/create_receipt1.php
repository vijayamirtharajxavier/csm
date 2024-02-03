                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><i class="fa fa-plus"></i> New Receipt</div>

<div id="add-rct-message"></div>
                                    

                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    
                                        <div class="form-body">
                                            <h3 class="box-title">Receipt Voucher</h3>


                                         </div>      

                                            <hr>


                            <form action="createReceipt" method="post" class="form-horizontal" id="createReceiptForm">
                               <div class="col-md-3">
                                <div class="form-group">
                                    <label>Receipt Number
                                    </label>
                                 
                                        <input type="text"  value="<?php echo $receipt_id;  ?>" id="receipt_id" name="receipt_id" class="form-control" autocomplete="off"  readonly>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                
                                <div class="form-group">
                                    <label class="col-md-6">Receipt Date
                                    </label>
                                        <input type="date" id="recdate" name="recdate" autocomplete="off"  class="form-control mydatepicker">
                                </div>
                                </div>

                                <div class="col-md-3">
                                <div class="form-group" id="ajxremote">
                                    <label class="col-md-6" >Member Name
                                    </label>
                                 <input type="text" id="memberName" name="memberName" autocomplete="off" class="form-control typeahead" placeholder="Member Name" required>
                                 
                                </div>
                                </div>
                                
                                <div class="col-md-3">
                                
                                <div class="form-group">
                                    <label class="col-md-6">Total Amount
                                    </label>
                                        <input type="text" id="receipt_amt" name="receipt_amt" autocomplete="off"  class="form-control" placeholder="0.00" style="text-align: right;">
                                </div>
                                </div>

                                 <input type="text" id="memberNumber" name="memberNumber" hidden>
                                

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Received as</label>
                                                    <select class="custom-select col-6 form-control" id="cash_bank" name="cash_bank">
                                                    <option selected>Choose...</option>    
                                                    </select>
                                                    </div>
                                                </div>

                                <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-6">Narration
                                    </label>
                                        <input type="text" id="narration" name="narration" class="form-control mydatepicker" placeholder="Narration"  autocomplete="off" >
                                </div>
                                </div>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">


                    <button type="submit" class="btn btn-info btn-rounded btn-sm waves-effect waves-light m-r-10">Submit</button>
                    <button type="submit" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">Cancel</button>
                            

</form>
     </div> 
     </div>
     </div>
     </div>
     </div>


<script type="text/javascript">

    $(document).ready(function(){
    var urlstr = base_url + 'fetchLdgAccounts';
var url = urlstr.replace("undefined","");

    $("#cash_bank").load(url);








    $("#createReceiptForm").unbind('submit').bind('submit', function() {
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
                        $("#add-rct-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          response.messages + 
                        '</div>');


  
$("#add-rct-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
setTimeout(function(){// wait for 5 secs(2)
           location.reload(); // then reload the page.(3)
    }, 500); 

                      //  $("#addSalesInvoiceTable:not(:first)").remove();
                       // $('.form-group').removeClass('has-error').removeClass('has-success');
                       // $('.text-danger').remove();     
                        //addSalesInvoiceTable.ajax.reload(null,false);
                      //  manageInvoiceTable.ajax.reload(null, false);
                      //  getInvoiceno();

                      //  $("#createInvoiceForm")[0].reset();             
                      //  $(".appended-exp-row").remove();
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




}); // .change in section



</script>