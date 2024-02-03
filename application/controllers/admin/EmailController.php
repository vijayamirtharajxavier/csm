<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller {

    public function __construct() {
        parent:: __construct();

        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('email/contact');
    }

    function send() {
        $this->load->config('email');
        $this->load->library('email');
        $message="";
        $from = $this->config->item('smtp_user');
        $to = $this->input->post('to');
        //$subject = $this->input->post('subject');
        $subject = "EBECS - WEB PORTAL : " .  $this->input->post('reqType');

        $message .= $this->input->post('message') . "\r\n";
        $message .= "Email From  " . $this->input->post('memberName') . " : " . $this->input->post('memberEmail') . "\r\n" ;
        $message .= "Contact #  : " . $this->input->post('mobile') . "\r\n";
        $from_email = $this->input->post("memberName") ."<" . $this->input->post('memberEmail') . ">";
        $this->email->set_newline("\r\n");
        $this->email->from($from_email);
       // $this->email->from($from);
        $this->email->to($this->config->item('mail_to'));
        $this->email->bcc($this->config->item('mail_bcc'));
//        $this->email->to($to);

        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo true;
        } else {
            show_error($this->email->print_debugger());
        }
    }
}