                                                                                                                                                                    <?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Stripe Library for CodeIgniter 3.x
 *
 * Library for Stripe payment gateway. It helps to integrate Stripe payment gateway
 * in CodeIgniter application.
 *
 * This library requires the Stripe PHP bindings and it should be placed in the third_party folder.
 * It also requires Stripe API configuration file and it should be placed in the config directory.
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      CodexWorld
 * @license     http://www.codexworld.com/license/
 * @link        http://www.codexworld.com
 * @version     2.0
 */
class Stripe {

    var $CI;
    var $api_error;

    function __construct() {
        $this->api_error = '';
        $this->CI = & get_instance();

        // Include the Stripe PHP bindings library
        require APPPATH . 'third_party/stripe-php-master/init.php';
        if ($this->CI->config->item('payment_mode') == 1) {
        // Set API key
        \Stripe\Stripe::setApiKey($this->CI->config->item('stripe_live_secret_key'));
        } else {
        \Stripe\Stripe::setApiKey($this->CI->config->item('stripe_sandbox_secret_key'));
        }
    }

    function addCustomer($email, $token) {
        try {
            // Add customer to stripe
            $customer = \Stripe\Customer::create(array(
                        'email' => $email,
                        'source' => $token
            ));
            return $customer;
        } catch (Exception $e) {
            $this->api_error = $e->getJsonBody();
            return false;
        }
    }
    

    function createintent($amount,$currency){
        try {
            $main_amount = round($amount,2);
            $itemPriceCents = $main_amount * 100;
            $currency = strtolower($currency);

            // Add customer to stripe
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $itemPriceCents,
                'currency' => $currency,
            ]);
            return $intent;
        } catch (Exception $e) {
            $this->api_error = $e->getJsonBody();
            return false;
        }
    }

    function getintent($intent_id){
        try {
         

            if ($this->CI->config->item('payment_mode') == 1) {
                // Set API key
                $secret_key = $this->CI->config->item('stripe_live_secret_key');
            } else {
                $secret_key = $this->CI->config->item('stripe_sandbox_secret_key');
            }
            $stripe = new \Stripe\StripeClient(
            $secret_key
            );

            // Add customer to stripe
            $intent = $stripe->paymentIntents->retrieve(
                $intent_id,
                []
              );
            return $intent;
        } catch (Exception $e) {
            $this->api_error = $e->getJsonBody();
            return false;
        }
    }
 

    function createCharge($customerId, $itemName, $itemPrice, $currency, $orderID) {
        // Convert price to cents
        $main_amount = round($itemPrice,2);
        $itemPriceCents = $main_amount * 100;
        $currency = strtolower($currency);
        try {
            // Charge a credit or a debit card
            $charge = \Stripe\Charge::create(array(
                    'customer' => $customerId,
                    'amount' => $itemPriceCents,
                    'currency' => $currency,
                    'description' => $itemName,
                    'metadata' => array(
                        'order_id' => $orderID
                    )
            ));

            // Retrieve charge details
            $chargeJson = $charge->jsonSerialize();
            return $chargeJson;
        } catch (Exception $e) {
            $this->api_error = $e->getJsonBody();
            return false;
        }
    }

}
