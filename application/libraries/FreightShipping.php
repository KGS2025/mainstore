<?php
defined('BASEPATH') or exit('No direct script access allowed');
class FreightShipping
{
    private $CI;
    private $fields = array();
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function addField($field, $value)
    {
        $this->fields[$field] = $value;
    }

    public function getratetoken()
    {

        try {
            $curl = curl_init();
            $payload = "grant_type=client_credentials&client_id=" . $this->fields['client_id'] . "&client_secret=" . $this->fields['client_secret'] . "";
            if ($this->CI->config->item('shipping_mode') == "1") {
                $url = "https://external-api.freightcom.com/oauth/token";
            } else {
                $url = "https://apis-sandbox.fedex.com/oauth/token";
            }

            curl_setopt_array($curl, [
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/x-www-form-urlencoded",
                ],
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);
            $fedex_response = json_decode($response);

            if (isset($fedex_response->access_token)) {
                return array("status" => "approved", "access_token" => $fedex_response->access_token);

            } else {
                return array("status" => "fail", "error" => $fedex_response);
            }
        } catch (Exception $ex) {
            return array("status" => "fail");
        }
    }

    /* used for package shipment where Dimensions is less than  total constraint of 165 inches (length + girth, where girth is 2 x width plus 2 x height) */
    public function processRate()
    {
        try {

            if ($this->CI->config->item('shipping_mode') == "1") {
                $url = "https://external-api.freightcom.com/rate";
            } else {
                $url = "https://customer-external-api.ssd-test.freightcom.com/rate";
            }
            $rateData = $this->getratefreightcom();

        //   echo $url."<br>";
        //   echo  json_encode($rateData);
        //   echo $url."<br>";


            /* Curl start to call UPS rating API */
            $shipping_mode = $this->CI->config->item('shipping_mode');
            if (empty($shipping_mode)) {
                $shipping_mode = 0;
            }

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_HTTPHEADER => [
                    "Authorization:" .$this->fields['client_token'],
                    "Content-Type: application/json",
                ],
                CURLOPT_POSTFIELDS => json_encode($rateData),
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_FAILONERROR => false,
                CURLOPT_HTTP200ALIASES => (array) 400,
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpCode >= 400) {
                // The request did not succeed, but we got a HTTP response
                return array("status" => "fail", "error" => "failed to fetch rates");
            }
            $freight_response = json_decode($response);


            if ($freight_response->request_id) {
               // echo $freight_response->request_id;
                    //sleep for 3 seconds
                    sleep(1);

                $rate_data = $this->get_rate_details($freight_response->request_id);

                return $rate_data;
            } else {                return array("status" => "fail", "error" => "failed to fetch rates");
            }

        } catch (Exception $ex) {
            print_r($ex);
        }
    }

    /* used for package shipment where Dimensions is less than  total constraint of 165 inches (length + girth, where girth is 2 x width plus 2 x height) */
    public function get_rate_details($request_id)
    {
        try {

            if ($this->CI->config->item('shipping_mode') == "1") {
                $url = "https://external-api.freightcom.com/rate";
            } else {
                $url = "https://customer-external-api.ssd-test.freightcom.com/rate";
            }

            $payload_url = $url . "/" . $request_id;
            /* Curl start to call UPS rating API */
            $shipping_mode = $this->CI->config->item('shipping_mode');
            if (empty($shipping_mode)) {
                $shipping_mode = 0;
            }

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_HTTPHEADER => [
                    "Authorization:" . $this->fields['client_token'],
                    "Content-Type: application/json",
                ],
                CURLOPT_URL => $payload_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => false,
                CURLOPT_HTTP200ALIASES => (array) 400,
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpCode >= 400) {
                // The request did not succeed, but we got a HTTP response
                return array("status" => "fail", "error" => "failed to fetch rates");
            }
            $freight_response = json_decode($response);

//             echo "<pre>";
//             print_r($freight_response);
// exit;
            if (isset($freight_response->status->done)) {
                return array("status" => "success", "rates" => $freight_response->rates);
            } else {
                return array("status" => "fail", "error" => "failed to fetch rates");
            }

        } catch (Exception $ex) {
            print_r($ex);
        }
    }

    private function getratefreightcom()
    {

        $pickup_date = (int) date('d', strtotime(date("Y-m-d") . ' + 1 days'));
        $pickup_month = (int) date('m', strtotime(date("Y-m-d") . ' + 1 days'));
        $pickup_year = (int) date('Y', strtotime(date("Y-m-d") . ' + 1 days'));

        $package_all = array();

        $total_weight = 0;

        $pac_count = 1;
        foreach ($this->fields['dimensions'] as $dimension) {
            // Set Package Weight
            $weight = round($dimension['weight'], 2);
            $weight_unit = $this->CI->config->item('weight_unit');
            $volumne_unit = $this->CI->config->item('volume_unit');

            if ($volume_unit == "CM") {
                $length = round($dimension['length'] / 2.54,2);
                $width = round($dimension['width'] / 2.54,2);
                $height = round($dimension['height'] / 2.54,2);
            } else {
                $length = round($dimension['length'], 2);
                $width = round($dimension['width'], 2);
                $height = round($dimension['height'], 2);
            }

            if ($weight_unit == "KG") {
                $weight = round($weight / 2.205, 2);
            } else {
                $weight = round($weight, 2);

            }
            $total_weight += round($weight, 2);

            $package = [
                "measurements" => [
                    "weight" => [
                        "unit" => "lb",
                        "value" => $weight,
                    ],
                    "cuboid" => [
                        "unit" => "in",
                        "l" => $length,
                        "w" => $width,
                        "h" => $height,
                    ],
                ],
                "description" => "",
            ];
            array_push($package_all, $package);
            $pac_count++;
        }

        $jayParsedAry = [
            "details" => [
                "origin" => [
                    "name" => $this->fields['shipper_personName'],
                    "contact_name" => $this->fields['shipper_personName'],
                    "address" => [
                        "address_line_1" => $this->fields['shipper_addressline1'],
                        "address_line_2" => $this->fields['shipper_addressline2'],
                        "city" => $this->fields['shipper_city'],
                        "region" => $this->fields['shipper_stateprovincecode'],
                        "country" => $this->fields['shipper_countrycode'],
                        "postal_code" => $this->fields['shipper_postalcode'],
                    ],
                    "phone_number" => [
                        "number" => "9988776655",
                        "extension" => null,
                    ],
                    "residential" => false,
                ],
                "destination" => [
                    "name" => $this->fields['ShipTo_Name'],
                    "contact_name" => $this->fields['ShipTo_Name'],
                    "address" => [
                        "address_line_1" => $this->fields['ShipTo_AddressLine1'],
                        "address_line_2" => $this->fields['ShipTo_AddressLine2'],
                        "city" => $this->fields['ShipTo_City'],
                        "region" => $this->fields['ShipTo_StateProvinceCode'],
                        "country" => $this->fields['ShipTo_CountryCode'],
                        "postal_code" => $this->fields['ShipTo_PostalCode'],
                    ],
                    "phone_number" => [
                        "number" => $this->fields['ShipTo_phone'],
                        "extension" => null,
                    ],
                    "residential" => false,
                    "ready_at" => [
                        "hour" => 20,
                        "minute" => 13,
                    ],
                    "ready_until" => [
                        "hour" => 20,
                        "minute" => 13,
                    ],
                    "signature_requirement" => "not-required",
                ],
                "expected_ship_date" => [
                    "year" => $pickup_year,
                    "month" => $pickup_month,
                    "day" => $pickup_date,
                ],
                "packaging_type" => "package",
                "packaging_properties" => [
                    "packages" => $package_all,
                ],
            ],
            "services" => [
            ],
            "excluded_services" => [
            ],
        ];
        return $jayParsedAry;
    }

    public function processShipment()
    {
        try {

            if ($this->CI->config->item('shipping_mode') == "1") {
                $url = "https://external-api.freightcom.com/shipment";
            } else {
                $url = "https://customer-external-api.ssd-test.freightcom.com/shipment";
            }
            $rateData = $this->getshippingpackage_payload();
            /* Curl start to call UPS rating API */
            $shipping_mode = $this->CI->config->item('shipping_mode');
            if (empty($shipping_mode)) {
                $shipping_mode = 0;
            }
//             echo $url."<br>";
// echo json_encode($rateData);

// echo "<br>";
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_HTTPHEADER => [
                    "Authorization:" . $this->fields['client_token'],
                    "Content-Type: application/json",
                ],
                CURLOPT_POSTFIELDS => json_encode($rateData),
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_FAILONERROR => false,
                CURLOPT_HTTP200ALIASES => (array) 400,
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if ($httpCode >= 400) {
                // The request did not succeed, but we got a HTTP response
                return array("status" => "fail", "error" => "failed to fetch rates");
            }
            $freight_response = json_decode($response);

            //  echo "<pre>";
            //  print_r($freight_response);
            //  echo "<br>";

         
            if ($freight_response->id) {
                // // sleep(9);
                // // $shipping_details = $this->get_shipping_details($freight_response->id);
                // // echo "<pre>";
                // // print_r($shipping_details);
                // // exit;
                // return $freight_response->id;

                return array("status" => "success", "shipment_id" =>$freight_response->id);

            } else {
                return array("status" => "fail", "error" => "failed to fetch rates");
            }

        } catch (Exception $ex) {
            print_r($ex);
        }
    }

    /* used for package shipment where Dimensions is less than  total constraint of 165 inches (length + girth, where girth is 2 x width plus 2 x height) */
    public function get_shipping_details($request_id)
    {
        try {

            if ($this->CI->config->item('shipping_mode') == "1") {
                $url = "https://external-api.freightcom.com/shipment";
            } else {
                $url = "https://customer-external-api.ssd-test.freightcom.com/shipment";
            }

            $payload_url = $url."/".$request_id;
            /* Curl start to call UPS rating API */
            $shipping_mode = $this->CI->config->item('shipping_mode');
            if (empty($shipping_mode)) {
                $shipping_mode = 0;
            }
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_HTTPHEADER => [
                    "Authorization:" . $this->fields['client_token'],
                    "Content-Type: application/json",
                ],
                CURLOPT_URL => $payload_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FAILONERROR => false,
                CURLOPT_HTTP200ALIASES => (array) 400,
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);

            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpCode >= 400) {
                // The request did not succeed, but we got a HTTP response
                return array("status" => "fail", "error" => "failed to fetch rates");
            }
            $freight_response = json_decode($response);
            // echo "<pre>";
            // print_r($freight_response);
            // exit;

            if (isset($freight_response->shipment)) {
                return array("status" => "success", "shipment" => $freight_response->shipment);
            } else {
                return array("status" => "fail", "error" => "failed to fetch rates");
            }

        } catch (Exception $ex) {
            print_r($ex);
        }
    }


    private function getshippingpackage_payload()
    {

        $pickup_date = (int) date('d', strtotime(date("Y-m-d") . ' + 1 days'));
        $pickup_month = (int) date('m', strtotime(date("Y-m-d") . ' + 1 days'));
        $pickup_year = (int) date('Y', strtotime(date("Y-m-d") . ' + 1 days'));


        if ($this->CI->config->item('shipping_mode') == "1") {
            $payment_id = "741nDILhmWm258RBOkKzSxxZVcouptSn";
        } else {
            $payment_id = "yMXcQkQh3PxtiSeMrjH3LgL7FbCkj7li";
        }

        

        $package_all = array();

        $total_weight = 0;

        $pac_count = 1;
        foreach ($this->fields['dimensions'] as $dimension) {
            // Set Package Weight
            $weight = round($dimension['weight'], 2);
            $weight_unit = $this->CI->config->item('weight_unit');
            $volumne_unit = $this->CI->config->item('volume_unit');

            if ($volume_unit == "CM") {
                $length = round($dimension['length'] / 2.54,2);
                $width = round($dimension['width'] / 2.54,2);
                $height = round($dimension['height'] / 2.54,2);
            } else {
                $length = round($dimension['length'], 2);
                $width = round($dimension['width'], 2);
                $height = round($dimension['height'], 2);
            }

            if ($weight_unit == "KG") {
                $weight = round($weight / 2.205, 2);
            } else {
                $weight = round($weight, 2);

            }
            $total_weight += round($weight, 2);

            $package = [
                "measurements" => [
                    "weight" => [
                        "unit" => "lb",
                        "value" => $weight,
                    ],
                    "cuboid" => [
                        "unit" => "in",
                        "l" => $length,
                        "w" => $width,
                        "h" => $height,
                    ],
                ],
                "description" => "package",
            ];
            array_push($package_all, $package);
            $pac_count++;
        }


        $jayParsedAry = [
            "unique_id" => $this->fields['Shipment_order_number'],
            "payment_method_id" => $payment_id,
            "service_id" =>$this->fields['Service_Code'],
            "details" => [
                "origin" => [
                    "name" => $this->fields['shipper_personName'],
                    "address" => [
                        "address_line_1" => $this->fields['shipper_addressline1'],
                        "address_line_2" => $this->fields['shipper_addressline2'],
                        "city" => $this->fields['shipper_city'],
                        "region" => $this->fields['shipper_stateprovincecode'],
                        "country" => $this->fields['shipper_countrycode'],
                        "postal_code" => $this->fields['shipper_postalcode']
                    ],
                    "residential" => true,
                    "tailgate_required" => true,
                    "instructions" => "string",
                    "contact_name" => $this->fields['shipper_personName'],
                    "phone_number" => [
                        "number" => $this->fields['shipper_phoneNumber'],
                        "extension" => "123",
                    ],
                    "email_addresses" => [
                        "user@example.com",
                    ],
                ],
                "destination" => [
                    "name" => $this->fields['ShipTo_Name'],
                    "address" => [
                        "address_line_1" => $this->fields['ShipTo_AddressLine1'],
                        "address_line_2" => $this->fields['ShipTo_AddressLine2'],
                        "city" => $this->fields['ShipTo_City'],
                        "region" => $this->fields['ShipTo_StateProvinceCode'],
                        "country" => $this->fields['ShipTo_CountryCode'],
                        "postal_code" => $this->fields['ShipTo_PostalCode']
                    ],
                    "residential" => true,
                    "tailgate_required" => true,
                    "instructions" => "string",
                    "contact_name" => $this->fields['ShipTo_Name'],
                    "phone_number" => [
                        "number" => $this->fields['ShipTo_phone'],
                        "extension" => "123",
                    ],
                    "email_addresses" => [
                        "user@example.com",
                    ],
                    "ready_at" => [
                        "hour" => 15,
                        "minute" => 6,
                    ],
                    "ready_until" => [
                        "hour" => 15,
                        "minute" => 6,
                    ],
                    "signature_requirement" => "not-required",
                ],
                "expected_ship_date" => [
                    "year" => $pickup_year,
                    "month" => $pickup_month,
                    "day" => $pickup_date
                ],
                "packaging_type" => "package",
                "packaging_properties" => [
                    "packages" => $package_all,
                ],
                "insurance" => [
                    "type" => "internal",
                    "total_cost" => [
                        "currency" => $this->fields['currency'],
                        "value" => (string)round($this->fields['MonetaryValue'] * 100),
                    ],
                ],
            ]
        ];

        return $jayParsedAry;
    }

}
