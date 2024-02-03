
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
                <div class="panel-heading"> <i class="fa fa-list"></i> All Applications
				
				
				 <?php if ($this->session->userdata('role') == 'admin'): ?>
                    <a href="<?php echo base_url('admin/form/form_application') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp;New Application</a> &nbsp;

                    <a href="<?php echo base_url('admin/officenote/create_officenote') ?>" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp;New Office Note</a>
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


							<table id="appTbl" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Application #</th>
                                    <th>Member Id</th>
                                    <th>Member Name</th>
                                    <th>Father/Husband Name</th>
                                    
                                    <th>Loan Amount</th>
                                    <th>Purpose of Loan</th>
                                    <th>Principle</th>
                                    <th>Payslip</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Application #</th>
                                    <th>Member Id</th>
                                    <th>Member Name</th>
                                    <th>Father/Husband Name</th>
                                    
                                    <th>Loan Amount</th>
                                    <th>Purpose of Loan</th>
                                    <th>Principle</th>
                                    <th>Payslip</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            
                            <tbody>
                            <?php foreach ($applications as $application): ?>
                                
                                <tr>

                                    <td><?php echo $application['app_number']; ?></td>
                                    <td><?php echo $application['member_id']; ?></td>
                                    <td><?php echo $application['member_name']; ?></td>
                                    <td><?php echo $application['member_fahuname']; ?></td>
                                    
                                    <td><?php echo $application['loan_amount']; ?></td>
                                    <td><?php echo $application['loan_purpose']; ?></td>
                                    <td><?php echo $application['installment_amount']; ?></td>
                                    <td><?php echo $application['net_amt']; ?></td>
                                    

                                    <td>
                                        <?php if ($application['app_status'] == 0): ?>
                                            <div class="label label-table label-primary">Pending</div>
                                        <?php endif ?>
                                        <?php if($application['app_status']==2):?>
                                            <div class="label label-table label-success">Approved</div>
                                        <?php endif ?>

                                        <?php if($application['app_status']==3):?>
                                            <div class="label label-table label-info">Process</div>
                                        <?php endif ?>
                                        <?php if($application['app_status']==1):?>
                                            <div class="label label-table label-danger">Rejected</div>
                                        <?php endif ?>



                                    </td>
                                    <td class="text-nowrap">

                                        <?php if ($this->session->userdata('role') == 'admin'): ?>
										
										<a href="<?php echo base_url('admin/officenote/update/'.$application['id']) ?>"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button></a>
																				
											<a href="<?php echo base_url('admin/officenote/delete/'.$application['id']) ?>" onClick="return doconfirm();" data-toggle="tooltip" data-original-title="Delete"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>


                                            <?php endif; ?>
											
                                </tr>

                            <?php endforeach ?>

                            </tbody>


                        </table>
                    </div>
					
					
            </div>
        </div>
    </div>

 </div>

    <!-- End Page Content -->