<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- Include the above in your HEAD tag -->

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>memarea/assets/css/style.css">

<div class="main">
    
    
    <div class="container">
<center>
<div class="middle">
      <div id="login">

        <!--<form action="forms/loginprocess.php" method="get">-->
       
            <form class="form-horizontal form-material" class="php-login-form" id="login-form" action="<?php echo base_url('auth/log'); ?>" method="post"> 
<!--
          <form action="forms/loginprocess.php" method="post" role="form" class="php-login-form"> -->
          <h3 style="color: #fff;">Member Login</h3>
          <fieldset class="clearfix">

            <p ><span class="fa fa-user"></span><input type="text" autocomplete="off" id="username" name="username" Placeholder="Username" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
            <p><span class="fa fa-lock"></span><input type="password" id="password" name="password" Placeholder="Password" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
<div class="form-group">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
      

    <span id="captchaImage" ><?php if(isset($captchaImage)) 
echo $captchaImage; ?> 
                    <a class="btn loadCaptcha" href="javascript:void(0);" title="Refresh Captcha Access code" >
<i class="fa fa-refresh"></i></a></span>
</div>

 <div class="form-group">
 <input type="text" class="form-control form-control-lg" placeholder="Captcha" name="captcha" id="captcha" captcha>
 </div> 

            </div>

             <div>
                                <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="#">Forgot
                                password?</a></span>
                                <span style="width:50%; text-align:right;  display: inline-block;"><input class="btn_signin btn btn-success" type="submit" value="Sign In"></span>
                            </div>
       
              <div class="my-3">
                <div class="loading" style="display: none;">Loading</div>
                <div class="error-message" style="display: none; margin-top: 70px; background-color:red;color:#fff;"></div>
                <div class="sent-message" style="display: none; margin-top: 70px; background-color:green;color:#fff;">Success!</div>
              </div>

          </fieldset>
<div class="clearfix"></div>
        </form>

        <div class="clearfix"></div>

      </div> <!-- end login -->
      <div class="logo"><img src="<?php echo base_url(); ?>memarea/assets/img/ebecs_logo.png">
          
          <div class="clearfix"></div>
      </div>
      
      </div>
</center>
    </div>

</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>--
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
<script src="<?php echo base_url(); ?>memarea/assets/js/validate.js"></script>


<style>
@charset "utf-8";


@import url//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css);



div.main{
    background: #0264d6; /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover,  #0264d6 1%, #1c2b5a 100%); /* FF3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(1%,#0264d6), color-stop(100%,#1c2b5a)); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); /* Opera 12+ */
background: -ms-radial-gradient(center, ellipse cover,  #0264d6 1%,#1c2b5a 100%); /* IE10+ */
background: radial-gradient(ellipse at center,  #0264d6 1%,#1c2b5a 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0264d6', endColorstr='#1c2b5a',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
height:calc(100vh);
width:100%;
}

[class*="fontawesome-"]:before {
  font-family: 'FontAwesome', sans-serif;
}

/* ---------- GENERAL ---------- */

* {
  box-sizing: border-box;
    margin:0px auto;

  &:before,
  &:after {
    box-sizing: border-box;
  }

}

body {
   
    color: #606468;
  font: 87.5%/1.5em 'Open Sans', sans-serif;
  margin: 0;
}

a {
  color: #eee;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

input {
  border: none;
  font-family: 'Open Sans', Arial, sans-serif;
  font-size: 14px;
  line-height: 1.5em;
  padding: 0;
  -webkit-appearance: none;
}

p {
  line-height: 1.5em;
}

.clearfix {
  *zoom: 1;

  &:before,
  &:after {
    content: ' ';
    display: table;
  }

  &:after {
    clear: both;
  }

}

.container {
  left: 50%;
  position: fixed;
  top: 50%;
  transform: translate(-50%, -50%);
}

/* ---------- LOGIN ---------- */

#login form{
  width: 250px;
}
#login, .logo{
    display:inline-block;
    width:40%;
}

.logo img {
  margin-top: 110px;
  width: 500px;
  padding-left: 20px;
  padding-right: 20px;
  border-radius: 20px;
}


#login{
border-right:1px solid #fff;
  padding: 0px 22px;
  width: 59%;
}
.logo{
color:#fff;
font-size:50px;
  line-height: 125px;
}

#login form span.fa {
  background-color: #fff;
  border-radius: 3px 0px 0px 3px;
  color: #000;
  display: block;
  float: left;
  height: 50px;
    font-size:24px;
  line-height: 50px;
  text-align: center;
  width: 50px;
}

#login form input {
  height: 50px;
}
fieldset{
    padding:0;
    border:0;
    margin: 0;

}
#login form input[type="text"], input[type="password"] {
  background-color: #fff;
  border-radius: 0px 3px 3px 0px;
  color: #000;
  margin-bottom: 1em;
  padding: 0 16px;
  width: 200px;
}

#login form input[type="submit"] {
  border-radius: 3px;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  background-color: #000000;
  color: #eee;
  font-weight: bold;
  /* margin-bottom: 2em; */
  text-transform: uppercase;
  padding: 5px 10px;
  height: 30px;
}

#login form input[type="submit"]:hover {
  background-color: #d44179;
}

#login > p {
  text-align: center;
}

#login > p span {
  padding-left: 5px;
}
.middle {
  display: flex;
  width: 600px;
}  
</style>


<script>
  var rand_captcha ='';

$( document ).ready(function() {
  
$("#captcha_in").val('');
    rand_captcha = Math.random();
  $("#captcha").attr("src","captcha.php?r=" + rand_captcha);



$(".refresh_btn").on('click',function(){
    console.log(rand_captcha);
//console.log('RefBtn Clicked');
$("#captcha_in").val('');
  
    rand_captcha = Math.random();
    $("#captcha").attr("src","captcha.php?r=" + rand_captcha);
});







});



/*    console.log( "ready!" );

$(".btn_signin").on('click',function(){
console.log('Login Clicked');
window.location.replace("profile.html");

});

});*/


</script>
