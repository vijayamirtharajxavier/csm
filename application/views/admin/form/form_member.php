<!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">New Member Form</h3>
                            <p class="text-muted m-b-30 font-13"> Members Basick Demographics </p>
                            <form class="form" method="POST">
                                <div class="form-group row">

                                            <div class="col-lg-6">
                                                <div class="input-group">
                         
                                                    <span class="input-group-addon">Member ID#</span>
                                                    <input id="memberNumber" name="memberNumber" type="text" value="<?php echo $lastmember_id; ?>" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group" id="ajxremote">
                                                    
                                                    <span class="input-group-addon">Member Name</span>
                                                    <input id="memberName" name="memberName" type="text" autocomplete="off" class="typeahead form-control" aria-label="Text input with checkbox">
                                                </div>
                                            </div>
                                      <div class="col-lg-6">
                                            

                                                <div class="input-group">
                                                   <span class="input-group-addon">
                                                        GENDER
                                                    </span>
                                        <select id="memberGender" name="memberGender" class="custom-select col-6 form-control" id="inlineFormCustomSelect">
                                            <option selected>Choose...</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Transgender</option>
                                        </select>                                                </div>
                                    </div>
                                    <div class="col-lg-6">
                                            

                                                <div class="input-group">
                                                   <span class="input-group-addon">
                                                        MARITAL STS
                                                    </span>
                                        <select id="maritalStatus" name="maritalStatus" class="custom-select col-6 form-control" id="inlineFormCustomSelect">
                                            <option selected>Choose...</option>
                                            <option value="1">UnMarried</option>
                                            <option value="2">Married</option>
                                            <option value="3">Widow</option>
                                            <option value="3">Widower</option>
                                            <option value="3">Divorcee</option>
                                        </select>
                                                </div>
                                    </div>
                                     


                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">DOB
                                                  </span>
                                                  
                                                     <input autocomplete="off"  class="form-control" type="date" name="dbirth" id="dbirth" onchange="dob_handler(event);">

                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Age
                                                  </span>
                                                  
                                                    <input class="form-control form-group" type="text" id="age" name="age" readonly>
                                    
                                                </div>
                                            </div>                                            
                                            <div class="col-lg-3">
                                            

                                                <div class="input-group">
                                                   <span class="input-group-addon">
                                                        DOJ
                                                    </span>
                                                     <input  autocomplete="off" class="form-control" type="date" name="doj" id="doj" onchange="doj_handler(event);">

                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">NYS
                                                  </span>
                                                  
                                                    <input id="nys" namd="nys" class="form-control form-group" type="text" readonly>
                                    
                                                </div>
                                            </div>                       
                                            
                                            
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Religion</span>
                                                    <select name="religion" class="custom-select col-6 form-control" id="religion">
                                                    <option selected>Choose...</option> 
                                                    <option value="1">Hindu</option>
                                                    <option value="2">Christian</option>
                                                    <option value="3">Muslim</option>

                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Caste</span>
                                                    <select name="caste" class="custom-select col-6 form-control" id="caste">
                                                    <option selected>Choose...</option>
                                                    <option value="1">SC</option>
                                                    <option value="2">ST</option>
                                                    <option value="3">BC</option>
                                                    <option value="4">MBC</option>
                                                    <option value="4">OBC</option>
                                                    <option value="5">FC</option>
                                                    </select>
                                                    
                                                </div>

                                             </div>  
                                                                                 


                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Division</span>
                                                    <select name="division" class="custom-select col-6 form-control" id="division">
                                                    <option selected>Select a Division</option>    
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Sub Division</span>
                                                    <select name="subdivision" class="custom-select col-6 form-control" id="subdivision">
                                                    <option selected>Sub Division</option>    
                                                    </select>
                                                    
                                                </div>

                                             </div>  
                                                                                 
                                                                   
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Department</span>
                                                    <select name="department" class="custom-select col-6 form-control" id="department">
                                                    <option selected>Department</option>    
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Section</span>
                                                    <select name="section" class="custom-select col-6 form-control" id="section">
                                                    <option selected>Section</option>    
                                                    </select>
                                                    
                                                </div>

                                               
                                            </div>                                                               
                                            
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Designation</span>
                                                    <select name="designation" class="custom-select col-6 form-control" id="designation">
                                                    <option selected>Designation</option>    
                                                    </select>
                                                   
                                                </div>

                                               
                                            </div>                                                                                    
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    
                                                    <span class="input-group-addon">Mobile</span>
                                                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 
                                                    <input  autocomplete="off" id="mobile" name="mobile" type="text" class="form-control" aria-label="Text input with checkbox">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Land Line</span>
                                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                                                    <input autocomplete="off"  id="landline" name="landline" type="text" class="form-control" aria-label="Text input with checkbox">
                                                </div>
                                              
                                            </div>                                                
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">E-mail </span>
                                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
                                                    <input autocomplete="off"  id="email" name="email" type="text" class="form-control" aria-label="Text input with checkbox">
                                                </div>
                                              
                                            </div>                                                                                    
                                            
                          

                                     <div class="col-lg-12">
                                        <div class="input-group">
                                        <input type="checkbox" id="fhname" name="fhname" class="js-switch" checked />         
                                        
                                        
                                    <input  autocomplete="off" type="text" id="fh_Name" name="fh_Name" class="form-control" placeholder="Father / Husband Name">
                                                
                                    </div>          
                                    </div>                                                

                                            

                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Nominee Name</span>
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                                                    <input autocomplete="off"  type="text" class="form-control" aria-label="Text input with checkbox">
                                                </div>
                                              
                                            </div>                                                
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Relationship </span>
                                                    
                                                    <input autocomplete="off"  type="text" class="form-control" aria-label="Text input with checkbox">
                                                </div>
                                              
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Residential Address </span>
                                                    
                                                    <input autocomplete="off"  id="resaddr" name="resaddr" type="text" class="form-control" aria-label="Text input with checkbox">
                                                </div>
                                              
                                            </div>

<hr>

<div class="col-lg-4">
      <form id="form1" runat="server">
    <input type='file' id="photoFile" name="photoFile" />
    <img width="100px" height="130px" id="image_upload_preview" src="<?php echo base_url();?>optimum/images/noimage.jpg" alt="user" alt="your image" />
</form>
</div>

<div class="col-lg-4">
      <form id="form1" runat="server">
    <input type='file' id="signFile" name="signFile" />
    <img width="100px" height="100px" id="image_upload_preview" src="<?php echo base_url();?>optimum/images/no-sign.png" alt="Signature" alt="your image" />
</form>
</div>


<div class="col-lg-4">
      <form id="form1" runat="server">
    <input type='file' id="idproofFile" name="idproofFile" />
    <img width="150px" height="100px" id="image_upload_preview" src="<?php echo base_url();?>optimum/images/idproof.jpg" alt="ID Proof" alt="your image" />
</form>
</div>

</div>
                        
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
                <div class="row">


                                    
                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Member's Bank Details</h3>
                            <p class="text-muted m-b-30 font-13"> Savings Bank Details </p>
                            <div  class="form-horizontal">
                            <div class="form-group">
                                
                                    
                                    
                                        <div class="form-group">
                                            <span class="input-group-addon">Bank Name</span>
                                                 <input autocomplete="off"  id="bnkName" name="bnkName" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>
                                        <div class="form-group">
                                            <span class="input-group-addon">Branch</span>
                                                 <input autocomplete="off"  id="bnkBranch" name="bnkBranch" type="text" class="form-control">

                                            
                                        </div> 
                                        <div class="form-group">
                                            <span class="input-group-addon">Account Name</span>
                                                 <input autocomplete="off"  id="accName" name="accName" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div> 
                                        <div class="form-group">
                                            <span class="input-group-addon">Account Number</span>
                                                 <input autocomplete="off"  id="accNumber" name="accNumber" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div> 
                                        <div class="form-group">
                                            <span class="input-group-addon">IFS Code</span>
                                                 <input autocomplete="off"  id="ifscode" name="ifscode" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>                                      
                                        <div class="form-group">
                                            <span class="input-group-addon">Branch Address</span>
                                                 <input autocomplete="off"  id="bnkAddr" name="bnkAddr" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>                                          
                            </div>
                                                                  
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Society Details</h3>
                            <p class="text-muted m-b-30 font-13"> Surety Information</p>
                            <div class="form-horizontal">
                                <div class="form-group">
 


                                       <div class="form-group" id="ajxremote">
                                            <span class="highlight"></span> 
                                       <span class="input-group-addon">Surety Name</span>


                                        
                                            <input autocomplete="off"  id="surety_name" name="surety_name" onchange="snamechange();" type="text" class="form-control form-control-success typeahead" required>
                                        
                                        </div>

                                                                                  
                                    <div class="form-group">
                                    <span class="input-group-addon">Surety Number</span>
                                    <input  autocomplete="off" id="surety_id" name="surety_id" name="surety_id" type="text" class="typeahead form-control" readonly>

                                    </div>                                          

                                        <div class="form-group">
                                            <span class="input-group-addon">Share Capital</span>
                                                 <input  autocomplete="off" id="mSuretyCapital" name="mSuretyCapital" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>                                          
                                        <div class="form-group">
                                            <span class="input-group-addon">Thrift Deposit</span>
                                                 <input autocomplete="off"  id="mThriftDeposit" name="mThriftDeposit" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>                                          
                                        <div class="form-group">
                                            <span class="input-group-addon">Loan Amount</span>
                                                 <input  autocomplete="off" id="mLoanAmt" name="mLoanAmt" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>                                          
                                        <div class="form-group">
                                            <span class="input-group-addon">Rate of Interest</span>
                                                 <input  autocomplete="off" id="roi" name="roi" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>                                          
                                        <div class="form-group">
                                            <span class="input-group-addon">No of Installments</span>
                                                 <input autocomplete="off"  id="noi" name="noi" type="text" class="form-control" aria-label="Text input with checkbox">

                                            
                                        </div>                                          
                                        <div class="form-group">
                                            <span class="input-group-addon">Principle Amount</span>
                                                 <input  autocomplete="off" id="principleAmt" name="principleAmt" type="text" class="form-control" aria-label="Text input with checkbox">

                                        </div>  
                                        <div class="form-group">
                                            <span class="input-group-addon">Installment Amount</span>
                                                 <input autocomplete="off"  id="insAmt" name="insAmt" type="text" class="form-control" aria-label="Text input with checkbox">

                                        </div>                                                 
                                </div>
                                        </div>   

       
                        </div>
                    </div>
                                        <button type="submit" class="btn btn-success btn-rounded btn-sm waves-effect waves-light m-r-10">Submit</button>
                                        <button type="submit" class="btn btn-inverse btn-rounded btn-sm waves-effect waves-light">Cancel</button>

</form>
                </div>
   
<style type="text/css">
    body {
    background: whitesmoke;
    font-family: 'Open Sans', sans-serif;
}

.container {
    max-width: 960px;
    margin: 30px auto;
    padding: 20px;
}

h1 {
    font-size: 20px;
    text-align: center;
    margin: 20px 0 20px;
    small {
        display: block;
        font-size: 15px;
        padding-top: 8px;
        color: gray;
    }
}

.avatar-upload {
    position: relative;
    max-width: 205px;
    margin: 50px auto;
    .avatar-edit {
        position: absolute;
        right: 12px;
        z-index: 1;
        top: 10px;
        input {
            display: none;
            + label {
                display: inline-block;
                width: 34px;
                height: 34px;
                margin-bottom: 0;
                border-radius: 100%;
                background: #FFFFFF;
                border: 1px solid transparent;
                box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
                cursor: pointer;
                font-weight: normal;
                transition: all .2s ease-in-out;
                &:hover {
                    background: #f1f1f1;
                    border-color: #d6d6d6;
                }
                &:after {
                    content: "\f040";
                    font-family: 'FontAwesome';
                    color: #757575;
                    position: absolute;
                    top: 10px;
                    left: 0;
                    right: 0;
                    text-align: center;
                    margin: auto;
                }
            }
        }
    }
    .avatar-preview {
        width: 192px;
        height: 192px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    }
}


.switchery {
  width: 200px; // your width
}
.switchery:before {
  content: "Father Name"; // your text
  color: #333;
  position: absolute;
  left: 40px;
  top: 50%;
  transform: translateY(-50%);
}
.js-switch:checked + .switchery:before {
  color: #fff;
  left: 70px;
}

.js-switch:checked + .switchery:before {
  color: #fff;
  content: "Husband Name";
  width:100px;
  left:40px;
}

</style>                

   <script type="text/javascript">
    function snamechange() 
{
    console.log('onchange event');
}


var elem = document.querySelector('.js-switch');
var init = new Switchery(elem);

    </script>