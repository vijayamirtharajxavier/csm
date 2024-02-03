<?php
session_start();

if(isset($_POST['username'])) {

$username = $_POST['username'];
$password = $_POST['password'];
$captcha_in = isset($_POST['captcha_in']);
$_SESSION['username'] = $username;
//var_dump($username . $password . $captcha_in);

$msg = '';
  
// If user has given a captcha!
if (strlen($captcha_in) > 0)
  
    // If the captcha is valid
    if ($_POST['captcha_in'] == $_SESSION['captcha'])
        $msg = 'OK';
    else
        $msg = 'CAPTCHA FAILED!!!';



echo $msg;

}