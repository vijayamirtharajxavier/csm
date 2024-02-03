<?php include 'layout/css.php'; 
$system_title = $this->db->get_where('soc_settings', array('type' => 'system_title'))->row()->description;
?>

    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    
    <div id="wrapper"> 
        


        <!-- Navigation -->
        <nav class="navbar navbar-light light-blue lighten-4  navbar-static-top m-b-0">
            <div class="navbar-header"> 


  <!-- Collapse button -->
  <button class="navbar-toggler toggler-example  navbar-top-links hidden-sm hidden-md hidden-lg" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
    <span class="dark-blue-text"><i class="fa fa-bars fa-4x"></i></span></button>

             <?php if($this->session->userdata('role')=="admin") { ?>

                <div class="top-left-part"><a class="logo" href="<?php echo base_url('admin/dashboard/') ?>"><b><img src="<?php echo base_url();?>optimum/small.png" alt="Codeig" /></b><span class="hidden-xs"><?php echo $system_title; ?></span></a></div>
             <?php } ?>


             <?php if($this->session->userdata('role')=="user") { ?>

                <div class="top-left-part"><a class="logo" href="<?php echo base_url('admin/dashboard/userhome') ?>"><b><img src="<?php echo base_url();?>optimum/small.png" alt="Codeig" /></b><span class="hidden-xs"><?php echo $system_title; ?></span></a></div>
             <?php } ?>

               
<div class="collapse navbar-collapse" id="navbarSupportedContent1">

                <ul class="nav navbar-top-links navbar-left">
                                <?php if($this->session->userdata('role')=="user") { ?>

                            
                     <li> <a  href="<?php echo base_url('admin/dashboard/userhome') ?>"><i class="fa fa-fax"></i>
                    Dashboard</a></li>

                        <?php } if($this->session->userdata('role')=="admin") { ?>
                            
                     <li> <a  href="<?php echo base_url('admin/dashboard/') ?>"><i class="fa fa-fax"></i>
                    Dashboard</a></li>



                     <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fax"></i>
                    Master
          <div class=""><span class=""></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="<?php echo base_url('admin/division/all_division_list') ?>"><i class="ti-user"></i>  DIVISION</a></li>
                           <!-- <li><a href="<?php echo base_url('admin/subdivision/all_sdivision_list') ?>"><i class="ti-email"></i>  SUB DIVISION</a></li> -->
                            <li><a href="<?php echo base_url('admin/department/all_department_list') ?>"><i class="ti-settings"></i>  DEPARTMENT</a></li>
                            <li><a href="<?php echo base_url('admin/section/all_section_list') ?>"><i class="ti-settings"></i>  SECTION</a></li>
                            <li><a href="<?php echo base_url('admin/designation/all_designation_list') ?>"><i class="ti-settings"></i>  DESIGNATION</a></li>

                            <li><a href="<?php echo base_url('admin/member/all_member_list') ?>"><i class="ti-user"></i>  ALL MEMBERS</a></li>

                            <li><a href="<?php echo base_url('admin/ledger/all_Ledger_list') ?>"><i class="ti-settings"></i>  LEDGER MASTER</a></li>
                            
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                   <!--  <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fax"></i>
                    Members
          <div class=""><span class=""></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">

                            <li><a href="<?php echo base_url('admin/member/all_member_list') ?>"><i class="ti-user"></i>  ALL MEMBERS</a></li>
                            
                          <!--
                            <li><a href="<?php echo base_url('admin/member/excelimport') ?>"><i class="ti-user"></i>  Member Mobile Bulk update</a></li> --
                            
                        </ul>
                        <!-- /.dropdown-user --
                    </li>-->
<!--
                     <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fax"></i>
                    Staffs
          <div class=""><span class=""></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="<?php echo base_url('admin/staff/all_staff_list') ?>"><i class="ti-user"></i>  ALL STAFFS</a></li>
                            
                            
                        </ul>
                         /.dropdown-user --
                    </li> -->

                     <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fax"></i>
                    Loan
          <div class=""><span class=""></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="<?php echo base_url('admin/officenote/all_loanappln') ?>"><i class="ti-user"></i>  LOAN APPLICATIONS</a></li>
                            <li><a href="<?php echo base_url('admin/officenote/all_officenote') ?>"><i class="ti-user"></i>  ALL OFFICE NOTES</a></li>                            
                         <!--   <li><a href="<?php echo base_url('admin/officenote/create_officenote') ?>"><i class="ti-user"></i>  OFFICE NOTE</a></li>
                            <li><a href="<?php echo base_url('admin/form/form_application') ?>"><i class="ti-email"></i>  NEW APPLICATION</a></li>
                        -->
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>

                     <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fax"></i>
                    Accounts
          <div class=""><span class=""></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                          
<li><a href="<?php echo base_url('admin/receipt/div_receipt') ?>"><i class="ti-user"></i>  DIVISION RECEIPTS</a></li>

<li><a href="<?php echo base_url('admin/receipt/viewall_mem_receipt') ?>"><i class="ti-user"></i>  VIEW ALL MEMBER'S DIRECT RECEIPTS</a></li>

<li><a href="<?php echo base_url('admin/receipt/mem_receipt') ?>"><i class="ti-user"></i>  NEW MEMBER'S DIRECT RECEIPTS</a></li>
<div class="divider"></div>
<li><a href="<?php echo base_url('admin/payment/oth_payment') ?>"><i class="ti-user"></i> BULK EXPENSES PAYMENT</a></li>                        
<li><a href="<?php echo base_url('admin/payment/all_payments') ?>"><i class="ti-user"></i>  ALL PAYMENTS / CONTRA</a></li>
<li><a href="<?php echo base_url('admin/journal/all_journal') ?>"><i class="ti-user"></i> ALL JOURNALS </a></li>
<div class="divider"></div>
<li><a href="<?php echo base_url('admin/dividend/dividendtdprocess') ?>"><i class="ti-user"></i> DIVIDEND & TD INTEREST PROCESS</a></li>           
<div class="divider"></div>
<li><a href="<?php echo base_url('admin/payment/ac_payment') ?>"><i class="ti-control-backward"></i> ACCOUNT CLOSURE</a></li>           

<!--
                            <li><a href="<?php echo base_url('admin/receipt/all_receipt') ?>"><i class="ti-user"></i>  ALL RECEIPTS</a></li>
                            <li><a href="<?php echo base_url('admin/payment/all_payments') ?>"><i class="ti-user"></i>  ALL PAYMENTS / CONTRA</a></li>
                        <li><a href="<?php echo base_url('admin/payment/all_payment') ?>"><i class="ti-user"></i> SINGLE EXPENSES PAYMENT</a></li>                            
                            <li><a href="<?php echo base_url('admin/journal/all_journal') ?>"><i class="ti-user"></i> ALL JOURNALS </a></li>
                           <li><a href="<?php echo base_url('admin/journal/create_contraJournal') ?>"><i class="ti-user"></i> JOURNAL ENTRY</a></li>

                            <li><a href="<?php echo base_url('admin/journal/allinoneimport'); ?>"><i class="ti-user"></i>  EXCEL IMPORTS TO JV</a>
                        </li>
                            -->
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>


                     <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fax"></i>
                    Demand Process
          <div class=""><span class=""></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="<?php echo base_url('admin/report/demand_rep') ?>"><i class="ti-user"></i>   DEMAND REPORT</a></li>
                          <!--  <li><a href="<?php echo base_url('admin/demand/dmdrec_report') ?>"><i class="ti-user"></i>  Demand & Recovery Report</a></li>
                            <li><a href="<?php echo base_url('admin/demand/demand_process') ?>"><i class="ti-user"></i>  PROCESS DEMAND</a></li> -->
                                                         
                           <li><a href="<?php echo base_url('admin/demand/gendemand');?>"><i class="ti-dribbble"></i>&nbsp;Demand Generation</a></li>
                            
                            
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>



                     <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fax"></i>
                    Reports
          <div class=""><span class=""></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="<?php echo base_url('admin/report/dcb_report') ?>"><i class="ti-user"></i>  DCB Report</a></li>
                            <li><a href="<?php echo base_url('admin/report/cashbank_daybook') ?>"><i class="ti-user"></i>  CASH / BANK BOOK </a></li>

                            <li><a href="<?php echo base_url('admin/report/creditledger_report') ?>"><i class="ti-user"></i>  CREDIT LEDGER REPORT</a></li>
                            
                            <li><a href="<?php echo base_url('admin/report/daybook') ?>"><i class="ti-user"></i>  DAYBOOK </a></li>

                            <li><a href="<?php echo base_url('admin/report/ledger_glreport') ?>"><i class="ti-user"></i>  GL REPORT</a></li>
                            <li><a href="<?php echo base_url('admin/report/trialbalance') ?>"><i class="ti-user"></i>  TRIAL BALANCE REPORT</a></li>
                            <div class="divider"></div>
<li><a href="<?php echo base_url('admin/dividend/dividendtdprocessrep') ?>"><i class="ti-user"></i> DIVIDEND & TD INTEREST REPORT</a></li>           
<li><a href="<?php echo base_url('admin/dividend/dividendtdsumrep') ?>"><i class="ti-user"></i> DIVIDEND & TD INTEREST SUMMARY REPORT</a></li>           
                            
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>


                   <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fax"></i>
                    SMS
          <div class=""><span class=""></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="<?php echo base_url('admin/sms/sms_members') ?>"><i class="ti-user"></i>  SMS TO MEMBERS</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i>  GENERAL SMS</a></li>
                            <li><a href="<?php echo base_url('admin/sms/smsReport') ?>"><i class="ti-email"></i>  SMS REPORTS</a></li>
                            
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>



                 <!-- <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fax"></i>
                    IMPORTS
          <div class=""><span class=""></span><span class="point"></span></div>
          </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="<?php echo base_url('admin/report/allinoneimport'); ?>"><i class="ti-user"></i>  EXCEL IMPORTS TO JV</a>
                        </li>
                            
                        </ul>
                        <-- /.dropdown-user --
                    </li> -->


                       <?php } ?>
                       <li><select id="fyear" name="fyear" style="margin-top:15px;">
                      </select></li>


                </ul>         
                 

                    <!-- /.dropdown -->

                    
            <ul class="nav light-green navbar-top-links navbar-right pull-right">
                    <li class="dropdown pull-right" >
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo base_url();?>optimum/logo.png" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $this->session->userdata('name'); ?></b> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">


                         <!--   <li><a href="javascript:void(0)"><i class="ti-user"></i>  My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i>  Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i>  Account Setting</a></li> -->
                <?php if($this->session->userdata('role')=="user") { ?>

                    <li><a href="" type="button" class="openmodal" data-toggle="modal" data-target="#feedbackModal"><i class="fa fa-comments"></i> Feedback</a></li>
                <?php }?>

                        
                            <li><a href="<?php echo base_url('admin/notification/') ?>"><i class="fa fa-cog"></i>  Notification</a></li>
                            <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-power-off"></i>  Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                        <!--<li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>-->

                </ul>
                
                
            </div>




</div>
</nav>

	   
	    <!-- Page Content -->
        <div id="container">
            <div class="container-fluid">
                
			<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php if($this->session->userdata('role')=="user") { echo 'Member : ' . $this->session->userdata('name') . "`s - " . $page_title;  } else { echo 'Admin : ' . $this->session->userdata('name') . "`s - " . $page_title;  }  ?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                                <?php if($this->session->userdata('role')=="admin") { ?>

                            <li><a href="<?php echo base_url();?>admin/dashboard/">Home</a></li>
                        <?php } if($this->session->userdata('role')=="user") { ?>
                            <li><a href="<?php echo base_url();?>admin/dashboard/userhome">Home</a></li>

                       <?php } ?>
                            <li class="active"> <?php echo $page_title; ?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->

<div class="container-fluid">
<?php echo $main_content; ?>  
                </div>  
</div>			
</div>       

				<!--  row    -->

          <div class="footer" style="text-align: center;">
            <?php include 'layout/footer.php'; ?>
          </div> 

</div>    
          
</div>
                <!-- /.row -->
    
<!--Division for Modal-->
<div id="feedbackModal" class="modal fade" role="dialog">
    <!--Modal-->
    <div class="modal-dialog">
        <!--Modal Content-->
        <div class="modal-content">
            <!-- Modal Header-->
            <div class="modal-header">
                <h3>Feedback / Service Request</h3>
                <!--Close/Cross Button--> <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
            </div> <!-- Modal Body-->
            <div class="modal-body text-center"> <i class="far fa-file-alt fa-4x mb-3 animated rotateIn icon1"></i>
                <div class="email-success-message"></div>
                <h3>Your opinion matters</h3>
                <h5>Help us improve our service? <strong>Give us your feedback.</strong></h5>
                <hr>
                <h6>Sender Details</h6>


</div> <!-- Radio Buttons for Rating-->
<form id="emailForm" method="post" action="<?php echo base_url();?>admin/EmailController/send" enctype="multipart/form-data">
<div class="col-md-12 text-center form-group justify-content-md-center" >
<input type="text" required name="memberName" value="<?php echo $this->session->userdata('name'); ?>" placeholder="Your Name" id="memberName" > <span style="color:red">*</span>

 <input type="email" required  name="memberEmail" placeholder="Email Address" id="memberEmail"> <span style="color:red">*</span>
 
<input type="text" required name="mobile" placeholder="Mobile Number" id="mobile"> <span style="color:red">*</span>

</div>


            <div class="col-md-12 text-center justify-content-md-center">
            <select id="reqType" name="reqType" required>
                <option selected disabled>Select a Request</option>
                <option value="Service Request">Service Request</option>
                <option value="Feedback">Feedback</option>
            </select><span style="color:red">*</span>
            </div>

            <!--
            <div class="form-check mb-4"> <input name="feedback" type="radio"> <label class="ml-3">Very good</label> </div>
            <div class="form-check mb-4"> <input name="feedback" type="radio"> <label class="ml-3">Good</label> </div>
            <div class="form-check mb-4"> <input name="feedback" type="radio"> <label class="ml-3">Mediocre</label> </div>
            <div class="form-check mb-4"> <input name="feedback" type="radio"> <label class="ml-3">Bad</label> </div>
            <div class="form-check mb-4"> <input name="feedback" type="radio"> <label class="ml-3">Very Bad</label> </div>
            <!--Text Message-->
            <div class="text-center">
                <h4>How may help you?</h4>
            </div> 
            <div class="text-center">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            
            <textarea id="message" required name="message" type="textarea" placeholder="Your Message" rows="3"></textarea> <span style="color:red">*</span>
            </div>
            <!-- Modal Footer-->
            <div class="modal-footer"> <button type="submit" class="btn btn-primary">Send <i class="fa fa-paper-plane"></i> </button> <button class="btn btn-outline-primary" data-dismiss="modal">Cancel</button> </div>
            </form>
        </div>
        
    </div>
</div>


            <!-- /.container-fluid -->
   <?php include 'layout/js.php'; ?>
      
      
        <!-- /#page-wrapper -->
    

    <!-- /#wrapper -->
    <!-- jQuery -->
   


<script>
$(document).ready(function($) {

//$("#fyear").url("<?php echo base_url();?>admin/dashboard/getFyear"); 

$.ajax({ url: "<?php echo base_url();?>admin/dashboard/getFyear",
    success: function(result)
    {
    //    window.location.reload(false);
    $("#fyear").append(result);
    }
  //  headers: {'X-Requested-With': 'XMLHttpRequest'}
});




$("#fyear").on('change',function(){
var newfinyear = $("#fyear").val();

console.log(newfinyear);
$.ajax({ url: "<?php echo base_url();?>admin/dashboard/changeFinyear?newfinyear=" + newfinyear ,success: function(result){
window.location.reload(false); 
  }
  //  headers: {'X-Requested-With': 'XMLHttpRequest'}
});

});


    $("#emailForm").unbind('submit').bind('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');

        $.ajax({
            url: url,
            type: type,
            data: form.serialize(),
            dataType: 'json',
            success:function(response) {
                if(response == "1") {                      
                        $("#email-success-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                          "Thank you, We have received your Message. We will get back to you soon." + 
                        '</div>');


  
$("#email-success-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);

});


$("#emailForm").trigger("reset");
//manageReceiptTable.ajax.reload(null, false);
                    }   
                    else {                                  
                        
                        $.each(response, function(index, value) {
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




});//Docuement
</script>

