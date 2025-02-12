<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * ClictoPay
 * This Class is used for the packing api. https://www.3dbinpacking.com
 */
class Clicpay
{
    private $CI;
    private $fields = array();
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    /**
     * Method addField
     * This Function add paramter dynamically. 
     * @param $field $field [This is the name of the attribute.]
     * @param $value $value [This is the value of the attribute.]
     *
     * @return void
     */
    public function addField($field, $value)
    {
        $this->fields[$field] = $value;
    }



    

    function generateFormURL()
    {

        // condition for payment gateway endpoint in case of devmode or production mode
        if ($this->CI->config->item('payment_mode') == 1) {
            $url = 'https://ipay.clictopay.com/payment/rest/register.do';
        } else {
            $url = 'https://test.clictopay.com/payment/rest/register.do';
        }
        $amount = 1000 * $this->fields['amount'];
        $curr = strtoupper($this->fields['currency']);
        $currencycode = $this->getcurrencycode($curr);

        $retunrurl = base_url() . 'payment/createChargeForclictopay';
       $url .= "?currency=" . $currencycode . "&amount=" . $amount . "&language=en&orderNumber=" . $this->fields['orderNumber'] . "&password=" . $this->CI->config->item('ctp_password') . "&returnUrl=" . $retunrurl . "&userName=" . $this->CI->config->item('ctp_apiuserName') . "&pageView=DESKTOP";


        $responce = $this->execute($url);
        // echo "<pre>";
        // echo $url;
        // print_r($responce);
        // exit;

        if (isset($responce['orderId']) && isset($responce['formUrl']) && !empty($responce['formUrl'])) {

            $aResult = array(
                'orderId'  => $responce['orderId'],
                'formUrl'  => $responce['formUrl'],
                'status' => 'success'
            );
        } else {

            $aResult = array(
                'status' => 'error',
                'responce' => $responce
            );
        }
        return $aResult;
        exit;
    }


    function execute($url)
    {

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $responce = json_decode(curl_exec($curl), true);
        curl_close($curl);
        return  $responce;
    }

    function getOrderstatus()
    {
        $ctp_orderid =  $this->fields['orderid'];
        // print_r($curl_post_data);
        // condition for payment gateway endpoint in case of devmode or production mode
        if ($this->CI->config->item('payment_mode') == 1) {
            $url = 'https://ipay.clictopay.com/payment/rest/getOrderStatus.do';
        } else {
            $url = 'https://test.clictopay.com/payment/rest/getOrderStatus.do';
        }
        $url .= "?orderId=" . $ctp_orderid . "&password=" . $this->CI->config->item('ctp_password') . "&userName=" . $this->CI->config->item('ctp_apiuserName');
        $responce = $this->execute($url);
        if ($responce['OrderStatus'] == "2" && $responce['ErrorCode'] == "0") {

            $aResult = array(
                'responce' => $responce,
                'status' => 'success'
            );
        } else {

            $aResult = array(
                'status' => 'error',
                'responce' => $responce
            );
        }
        return $aResult;
        exit;
    }

    function getcurrencycode($currencycode)
    {

        $listofcodes  = array("INR" => "356", "CAD" => "124", "USD" => "840", "TND" => "788");
        return  $listofcodes[$currencycode];
    }
}
