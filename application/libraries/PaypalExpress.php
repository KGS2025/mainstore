<?php
defined('BASEPATH') or exit('No direct script access allowed');


class PaypalExpress
{
    private $CI;
    private $fields = array();
    public $test_mode = true;
    public $paypalEnv       = 'sandbox';
    public $paypalURL       = 'https://api.sandbox.paypal.com/v1/';
    public $paypalClientID  = 'ATlfY_BkA-eYjsTOVqLf5y1fpdGmMVbQmN6PjkFpa4bZ3BuYj01ZzuOKLXlvWzHdeABZxnR6DyrQQmaF'; 
    private $paypalSecret   = 'EG_jDxWqdwAvvhUDo9G7_loRJ5b2dj4zhGwzssPKTbKEE9bteS38wfthjryrCgvgO3DNhN7d9Gjv9JuX'; 

    public function __construct()
    {
        $this->CI = &get_instance();   
        
    }
    public function testMode($state){
        $this->test_mode = $state;
        $this->paypalEnv = $this->test_mode?'sandbox':'production'; 
        $this->paypalURL = $this->test_mode?'https://api.sandbox.paypal.com/v1/':'https://api.paypal.com/v1/'; 
    }

    public function setClientId($val){
        $this->paypalClientID = $val;
    }

    public function setSecretKey($val){
        $this->paypalSecret = $val;
    }
         
    public function validate($paymentID, $paymentToken, $payerID, $productID){ 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $this->paypalURL.'oauth2/token'); 
        curl_setopt($ch, CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($ch, CURLOPT_POST, true); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_USERPWD, $this->paypalClientID.":".$this->paypalSecret); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials"); 
        $response = curl_exec($ch); 
        curl_close($ch); 
         
        if(empty($response)){ 
            return false; 
        }else{ 
            $jsonData = json_decode($response); 
            $curl = curl_init($this->paypalURL.'payments/payment/'.$paymentID); 
            curl_setopt($curl, CURLOPT_POST, false); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($curl, CURLOPT_HEADER, false); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($curl, CURLOPT_HTTPHEADER, array( 
                'Authorization: Bearer ' . $jsonData->access_token, 
                'Accept: application/json', 
                'Content-Type: application/xml' 
            )); 
            $response = curl_exec($curl); 
            curl_close($curl); 
             
            // Transaction data 
            $result = json_decode($response); 
             
            return $result; 
        } 
     
    } 
}

