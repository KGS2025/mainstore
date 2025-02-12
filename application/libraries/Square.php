<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Packing
 * This Class is used for the packing api. https://www.3dbinpacking.com
 */
class Square
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

    /**
     * Method createCustomer
     * This Function hit the api and return the result accordingly. 
     * @return void
     */
    public function createCustomer()
    {
        try {

            $accesstoken         = $this->fields['access_token'];
            $uniquekey           = time() . '-' . mt_rand();
            $postdata = array(
                'email_address'      => $this->fields['email_address'],
                'idempotency_key'   => $uniquekey,
                'company_name'         => $this->fields['company_name'],
                "reference_id"      => $this->fields['reference_id']
            );

            $headers = array("Authorization: Bearer " . $accesstoken, 'Content-Type:application/json');
            $curl_post_data = json_encode($postdata);
            // condition for payment gateway endpoint in case of devmode or production mode
            if ($this->fields['payment_mode'] == 1) {
                $url = 'https://connect.squareup.com/v2/customers';
            } else {
                $url = 'https://connect.squareupsandbox.com/v2/customers';
            }

            // curl request to generate token
            $curl_handle = curl_init($url);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl_handle, CURLOPT_POST, true);
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $curl_post_data);
            $response = json_decode(curl_exec($curl_handle), true);
            curl_close($curl_handle);


            if (isset($response['customer']['id']) && $response['customer']['id']) {

                // if token generated successfully than this code will work
                $aResult = array(
                    'customer_id'  => $response['customer']['id'],
                    'status' => 'success',
                    'detail' => $response['customer']
                );
                return $aResult;
                exit;
            } else {
                $errors = $response['errors'][0];
                // if token will not generated succesfully than this code will work
                $aResult = array('errors' => $errors, 'status' => 'error');
                return $aResult;
                exit;
            }
        } catch (Exception $ex) {
            return array($ex, 403);
            exit;
        }
    }


    /**
     * Method createCard
     * This Function hit the api and return the result accordingly. 
     * @return void
     */
    public function createCard()
    {
        try {

            $accesstoken         = $this->fields['access_token'];
            $uniquekey           = time() . '-' . mt_rand();
            $postdata = array(
                'card' => array("customer_id" => $this->fields['customer_id']),
                'idempotency_key'   => $uniquekey,
                'source_id'         => $this->fields['card_token'],
            );

            $headers = array("Authorization: Bearer " . $accesstoken, 'Content-Type:application/json');
            $curl_post_data = json_encode($postdata);
            // condition for payment gateway endpoint in case of devmode or production mode
            if ($this->fields['payment_mode'] == 1) {
                $url = 'https://connect.squareup.com/v2/cards';
            } else {
                $url = 'https://connect.squareupsandbox.com/v2/cards';
            }

            // curl request to generate token
            $curl_handle = curl_init($url);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl_handle, CURLOPT_POST, true);
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $curl_post_data);
            $response = json_decode(curl_exec($curl_handle), true);
            curl_close($curl_handle);


            if (isset($response['card']['id']) && $response['card']['id']) {

                // if token generated successfully than this code will work
                $aResult = array(
                    'card_id'  => $response['card']['id'],
                    'status' => 'success',
                    'detail' => $response['card']
                );
                return $aResult;
                exit;
            } else {
                $errors = $response['errors'][0];
                // if token will not generated succesfully than this code will work
                $aResult = array('errors' => $errors, 'status' => 'error');
                return $aResult;
                exit;
            }
        } catch (Exception $ex) {
            return array($ex, 403);
            exit;
        }
    }



    /**
     * Method deleteCard
     * This Function hit the api and return the result accordingly. 
     * @return void
     */
    public function deleteCard()
    {
        try {

            $accesstoken  = $this->fields['access_token'];
            $postdata = array(
                'card_id' => $this->fields['card_id']
            );

            $headers = array("Authorization: Bearer " . $accesstoken, 'Content-Type:application/json');
            $curl_post_data = json_encode($postdata);
            // condition for payment gateway endpoint in case of devmode or production mode
            if ($this->fields['payment_mode'] == 1) {
                $url = 'https://connect.squareup.com/v2/cards/' . $this->fields['card_id'] . '/disable';
            } else {
                $url = 'https://connect.squareupsandbox.com/v2/cards/' . $this->fields['card_id'] . '/disable';
            }

            // curl request to generate token
            $curl_handle = curl_init($url);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl_handle, CURLOPT_POST, true);
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $curl_post_data);
            $response = json_decode(curl_exec($curl_handle), true);
            curl_close($curl_handle);
            if (isset($response['card']['id']) && $response['card']['id']) {

                // if token generated successfully than this code will work
                $aResult = array(
                    'card_id'  => $response['card']['id'],
                    'status' => 'success',
                );
                return $aResult;
                exit;
            } else {
                $errors = $response['errors'][0];
                // if token will not generated succesfully than this code will work
                $aResult = array('errors' => $errors, 'status' => 'error');
                return $aResult;
                exit;
            }
        } catch (Exception $ex) {
            return array($ex, 403);
            exit;
        }
    }
}
