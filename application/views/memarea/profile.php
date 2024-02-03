<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>EBECS-C2073 | VELLORE</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <!--<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha - v4.1.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>

    <div class="main-body">
    
          <!-- Breadcrumb -->
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <!--<h1 class="logo me-auto"><a href="index.html">Arsha</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.html" class="logo me-auto"><img src="assets/img/ebecs_logo.png" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active pull-left" href="#hero">Dashboard</a></li>
        <!--  <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link   scrollto" href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li> -->
       
            <li class="dropdown"><a class="getstarted scrollto" href="#"><span><?php echo $_SESSION['username']; ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">My Profile</a></li>
              <li><a href="logout.php">Logout</a></li>
                
              
            </ul>
          </li>

          <!--<li><a class="getstarted scrollto" href="login.php">Logout</a></li> -->
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
          <!-- /Breadcrumb -->

<section id="hero" class="d-flex align-items-center">
  <div class="container">
    <div class="row">

      <div class="col-md-4 row">
              <div class="card">
                <div class="card-body">
                  <div>
                  <h4 style="float: left;">Member</h4>
                  <h4 style="float: right;" id="m_no" name="m_no"></h4></div>
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4 id="m_name" name="m_name"></h4>
                      <p class="text-secondary mb-1" id="m_desg" name="m_desg" ></p>
                      <p class="text-muted font-size-sm" id="m_loc" name="m_loc" ></p>
                      <!--<button class="btn btn-primary">Follow</button>
                      <button class="btn btn-outline-primary">Message</button>-->
                    </div>
                  </div>
                </div>
              </div>
        
      </div>
      <div class="col-md-4 row">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <h6 class="mb-0">Member Shares</h6>
                    </div>
                    <div class="col-sm-6 text-secondary"  id="m_shares" name="m_shares">
                      
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      <h6 class="mb-0">Member Thrift</h6>
                    </div>
                    <div class="col-sm-6 text-secondary"  id="m_thrift" name="m_thrift" >
                      
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      <h6 class="mb-0">Member Loan</h6>
                    </div>
                    <div class="col-sm-6 text-secondary"  id="m_loan" name="m_loan" >
                      
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      <h6 class="mb-0">Surety Shares</h6>
                    </div>
                    <div class="col-sm-6 text-secondary"   id="s_shares" name="s_shares" >
                      
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      <h6 class="mb-0">Surety Thrift</h6>
                    </div>
                    <div class="col-sm-6 text-secondary"  id="s_thrift" name="s_thrift" >
                      
                    </div>
                  </div>
                </div>
              </div>


        
      </div>
      <div class="col-md-4 row">
              <div class="card">
                <div class="card-body">
                  <div>
                  <h4 style="float: left;">Surety</h4>
                  <h4 style="float: right;" id="s_no" name="s_no"></h4></div>
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4 id="sm_name" name="sm_name"></h4>
                      <p class="text-secondary mb-1" id="sm_desg" name="sm_desg" ></p>
                      <p class="text-muted font-size-sm" id="sm_loc" name="sm_loc" ></p>
                      <!--<button class="btn btn-primary">Follow</button>
                      <button class="btn btn-outline-primary">Message</button>-->
                    </div>
                  </div>
                </div>
              </div>
       
      </div>

    </div>
  </div>
</section>


<!--
    <section id="hero" class="d-flex align-items-center">
      <div class="container">
          <div class="row gutters-sm">
            <div class="col-md-4">

              <div class="card">
                <div class="card-body">
                  <div>
                  <h4 style="float: left;">Member</h4>
                  <h4 style="float: right;" id="m_no" name="m_no"></h4></div>
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4 id="m_name" name="m_name"></h4>
                      <p class="text-secondary mb-1" id="m_desg" name="m_desg" ></p>
                      <p class="text-muted font-size-sm" id="m_loc" name="m_loc" ></p>
                      <!--<button class="btn btn-primary">Follow</button>
                      <button class="btn btn-outline-primary">Message</button>-
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"  id="mf_name" name="mf_name">
                      
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"  id="m_email" name="m_email" >
                      
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"  id="m_phone" name="m_phone" >
                      
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"   id="m_mobile" name="m_mobile" >
                      
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"  id="m_address" name="m_address" >
                      
                    </div>
                  </div>
                </div>
              </div>



            </div>

            <div class="col-md-4">

              <div class="card">
                <div class="card-body">
                  <div>
                  <h4 style="float: left;">Surety</h4>
                  <h4 style="float: right;" id="s_no" name="s_no"></h4></div>
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4 id="sm_name" name="sm_name"></h4>
                      <p class="text-secondary mb-1" id="sm_desg" name="sm_desg" ></p>
                      <p class="text-muted font-size-sm" id="sm_loc" name="sm_loc" ></p>
                      <!--<button class="btn btn-primary">Follow</button>
                      <button class="btn btn-outline-primary">Message</button>--
                    </div>
                  </div>
                </div>
              </div>

            </div>
            
</div>



</section>
-->
<section>

  <h3 style="text-align: center;">CREDIT LEDGER</h3>

<div class="container row">
<div class="responsive">
  <table class="styled-table center" id="ldgtbl">

<caption style="caption-side:top; text-align: left;">Financial Year &nbsp;
    <select id="fyear" name="fyear">
    </select>
</caption>
    <thead>
    <th>S.No.</th>
    <th>Date</th>
    <th>Ref#</th>
    <th colspan="3" style="text-align: center;">Thrift</th>
    <th colspan="3" style="text-align: center;">Shares</th>
    <th colspan="3" style="text-align: center;">Repayment</th>
    <th colspan="2" style="text-align: center;">New Loans</th>
    <tr>
    <th></th><th></th><th></th>
    <th>Receipt</th>
    <th>Payments</th>
    <th>Total</th>
    <th>Receipt</th>
    <th>Payments</th>
    <th>Total</th>
    <th>Principle</th>
    <th>Interest</th>
    <th>Insurance</th>
    <th>Loan Issued</th>
    <th>Outstanding</th>
    </tr>
    </thead>
    <tbody>
      
    </tbody>  
    
  </table>
</div>  
</div>

</section>






  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
<!--  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>-->

<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>


<script>
$(document).ready(function() {


load_data();


}); // Document



function load_data()
{
    

let json = '{"memberdetails":{"m_no":"12345","mname":"Viay Amirtharaj","mdesignation":"CEO","mlocation":"Chennai","s_no":"13456","sname":"Jenifer V","sdesignation":"Engineer","slocation":"Chennai","finyear":[{"fyear":"2020-21"},{"fyear":"2019-20"}],"ledgerdetails":[{"date":"2020-04-01","refid":"1234","rcpt_thrift":1500.00,"pyt_thrift":0.00,"thrift_total":1500.00,"rcpt_shares":2000.00,"pyt_shares":1000.00,"share_total":1000.00,"principle":13250.00,"interest": 3250.00,"insurance":4200.00,"loan_issued":0.00,"loan_outstanding":5201.00},{"date":"2020-04-15","refid":"1234","rcpt_thrift":1500.00,"pyt_thrift":0.00,"thrift_total":1500.00,"rcpt_shares":2000.00,"pyt_shares":1000.00,"share_total":1000.00,"principle":13250.00,"interest": 3250.00,"insurance":4200.00,"loan_issued":1000000.00,"loan_outstanding":995201.00},{"date":"2020-05-01","refid":"1234","rcpt_thrift":1500.00,"pyt_thrift":0.00,"thrift_total":1500.00,"rcpt_shares":2000.00,"pyt_shares":1000.00,"share_total":1000.00,"principle":13250.00,"interest": 3250.00,"insurance":4200.00,"loan_issued":1000000.00,"loan_outstanding":985201.00}]}}';

let jsonData = JSON.parse(json);


document.getElementById("m_no").innerHTML = jsonData.memberdetails.m_no;
document.getElementById("m_name").innerHTML = jsonData.memberdetails.mname;
document.getElementById("m_desg").innerHTML = jsonData.memberdetails.mdesignation;
document.getElementById("m_loc").innerHTML = jsonData.memberdetails.mlocation;

document.getElementById("s_no").innerHTML = jsonData.memberdetails.s_no;
document.getElementById("sm_name").innerHTML = jsonData.memberdetails.sname;
document.getElementById("sm_desg").innerHTML = jsonData.memberdetails.sdesignation;
document.getElementById("sm_loc").innerHTML = jsonData.memberdetails.slocation;


/*
document.getElementById("mf_name").innerHTML = jsonData.memberdetails.name;
document.getElementById("m_email").innerHTML = jsonData.memberdetails.email;
document.getElementById("m_mobile").innerHTML = jsonData.memberdetails.mobile;
document.getElementById("m_address").innerHTML = jsonData.memberdetails.address;
*/
let options='';
var $dropdown = $("#fyear");
jsonData.memberdetails.finyear.forEach(function(item){
  console.log('ID: ' + item.fyear);
     $dropdown.append($("<option />").val(item.fyear).text(item.fyear));
   
});


//Ledger Json
let tbl='';
let sn=1;
jsonData.memberdetails.ledgerdetails.forEach(function(ldg){
  //console.log('ID: ' + ldg.fyear);

tbl += '<tr><td style="text-align:center;">' + sn + '</td><td>' + ldg.date + '</td><td>' + ldg.refid + '</td><td style="text-align:right;">' + ldg.rcpt_thrift.toFixed(2) +  '</td>' + '</td><td style="text-align:right;">' + ldg.pyt_thrift.toFixed(2) +  '</td>' + '</td><td style="text-align:right;">' + ldg.thrift_total.toFixed(2) +  '</td><td style="text-align:right;">' + ldg.rcpt_shares.toFixed(2) +   '</td><td style="text-align:right;">' + ldg.pyt_shares.toFixed(2) +   '</td><td style="text-align:right;">' + ldg.share_total.toFixed(2) +  '</td><td style="text-align:right;">' + ldg.principle.toFixed(2) +  '</td><td style="text-align:right;">' + ldg.interest.toFixed(2)  + '</td><td style="text-align:right;">' + ldg.insurance.toFixed(2) + '</td><td style="text-align:right;">' + ldg.loan_issued.toFixed(2) +  '</td>'  + '</td><td style="text-align:right;">' + ldg.loan_outstanding.toFixed(2) +  '</td>'  +  '</tr>';
sn++;

   
});


$("#ldgtbl").append(tbl);

}






</script>






</body>

