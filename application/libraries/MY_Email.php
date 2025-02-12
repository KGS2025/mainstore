<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Email extends CI_Email {

    function __construct($config = array()) {

        
        $config['protocol'] = 'sendmail';
        $config['smtp_host'] = 'mail.kondarsoft.com';
        $config['smtp_port'] = '587';
        $config['smtp_timeout'] = '7';
        $config ['smtp_user'] = "sales@kondarsoft.com";
       	$config ['smtp_pass'] = "vGEx&O_GfiaK";
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not 

        parent::__construct($config);
    }

    public function set_header($header, $value){
        $this->_headers[$header] = $value;
    }

}