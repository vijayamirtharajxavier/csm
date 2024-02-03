<?php defined('BASEPATH') OR exit('No direct script access allowed');

ini_set("include_path",'/home2/ebecsvellore/php:' . ini_get("include_path"));
require_once "/home2/ebecsvellore/php/Mail.php";


$config = array(
    'protocol' => 'mail', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'mail.ebecsvellore.in', 
    'smtp_port' => 587,
    'mail_to' =>'info@ebecsvellore.in',
    'mail_bcc'=>'vijayamirtharajxavier@gmail.com',
    'mail_from'=>'webmaster@ebecsvellore.in',
    'smtp_user' => 'webmaster@ebecsvellore.in',
    'smtp_pass' => 'g.U*Jg[A}2;,',
    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'text', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);
