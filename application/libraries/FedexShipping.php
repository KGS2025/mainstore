<?php
defined('BASEPATH') or exit('No direct script access allowed');
class FedexShipping
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

    public function generatetoken()
    {

        try {
            $curl = curl_init();
            $payload = "grant_type=client_credentials&client_id=" . $this->fields['client_id'] . "&client_secret=" . $this->fields['client_secret'] . "";
            if ($this->CI->config->item('shipping_mode') == "1") {
                $url = "https://apis.fedex.com/oauth/token";
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
                $url = "https://apis.fedex.com/rate/v1/rates/quotes";
            } else {
                $url = "https://apis-sandbox.fedex.com/rate/v1/rates/quotes";
            }
            $access_token = $this->generatetoken();
            if ($access_token['status'] == "approved") {
                $rateData = $this->getratefedex();

                //  echo json_encode($rateData);
                //  exit;
                /* Curl start to call UPS rating API */
                $shipping_mode = $this->CI->config->item('shipping_mode');
                if (empty($shipping_mode)) {
                    $shipping_mode = 0;
                }

                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Bearer " . $access_token['access_token'],
                        "Content-Type: application/json",
                        "X-locale: en_US",
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
                $fedex_response = json_decode($response);

                if (isset($fedex_response->transactionId)) {
                    return array("status" => "success", "rates" => $fedex_response->output->rateReplyDetails);
                } else {
                    return array("status" => "fail", "error" => "failed to fetch rates");
                }

            } else {
                return array("status" => "fail");
            }
        } catch (Exception $ex) {
            print_r($ex);
        }
    }

    public function processFrightRateFedex()
    {
        try {

            if ($this->CI->config->item('shipping_mode') == "1") {
                $url = "https://apis.fedex.com/rate/v1/freight/rates/quotes";
            } else {
                $url = "https://apis-sandbox.fedex.com/rate/v1/freight/rates/quotes";
            }
            $access_token = $this->generatetoken();
            if ($access_token['status'] == "approved") {
                $rateData = $this->getRatePayloadFreightFedex();

                //  echo json_encode($rateData);
                //  exit;
                /* Curl start to call UPS rating API */
                $shipping_mode = $this->CI->config->item('shipping_mode');
                if (empty($shipping_mode)) {
                    $shipping_mode = 0;
                }

                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Bearer " . $access_token['access_token'],
                        "Content-Type: application/json",
                        "X-locale: en_US",
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
                    return array("status" => "fail", "error" => "failed to fetch rates","response"=>$response);
                }
                $fedex_response = json_decode($response);
                // print_r($fedex_response);exit;
                
                if (isset($fedex_response->transactionId)) {
                    return array("status" => "success", "rates" => $fedex_response->output->rateReplyDetails);
                } else {
                    return array("status" => "fail", "error" => "failed to fetch rates");
                }

            } else {
                return array("status" => "fail");
            }
        } catch (Exception $ex) {
            print_r($ex);
        }
    }

    private function getRatePayloadFreightFedex()
    {

        $date_stamp = date("Y-m-d", strtotime(date("Y-m-d") . ' + 1 days'));
        $package_all = array();

        if (strtoupper($this->fields['ShipTo_CountryCode']) == strtoupper($this->fields['shipper_countrycode'])) {
            $service_type = "FEDEX_FREIGHT_ECONOMY";
        } else {
            $service_type = "FEDEX_FREIGHT_ECONOMY";
        }

        $pac_count = 1;
        $total_weight = 0;
        $lineItem = array();
        $requestedPackageLineItems = array();
        // echo '<pre>'; print_r($this->fields);
        $all_dimensions = array_merge($this->fields['dimensions'],$this->fields['dimensions_freight']);
        foreach ($all_dimensions as $dimension) {
            // Set Package Weight
            $li = array();
            $rp_li = array();
            
            $weight = round($dimension['weight'], 2);
            $weight_unit = $this->CI->config->item('weight_unit');
            // if ($weight_unit == "KG") {
            //   $weight =  round($weight / 2.205,2);

            // }
            $total_weight += round($weight, 2);

            $package = array(
                "groupPackageCount" => $pac_count,
                "weight" => array(
                    "units" => $weight_unit,
                    "value" => $weight,
                ),
            );

            $li["handlingUnits"] = 0;
            $li["subPackagingType"] = "BOX";
            $li["weight"] = array(
                "units"=>$weight_unit,
                "value"=>$weight
            );
            $li["pieces"] = 0;
            $li["freightClass"] = "CLASS_050";
            $li["id"] = $dimension["package_name"];            
            array_push($lineItem,$li);

            $rp_li["subPackagingType"] = "BOX";
            $rp_li["weight"] = $li["weight"];
            $rp_li["associatedFreightLineItems"] = array(array(
                "id" => $dimension["package_name"]
            ));
            array_push($requestedPackageLineItems, $rp_li);

            array_push($package_all, $package);
            $pac_count++;
        }       
        // echo '<pre>';print_r($package_all);exit;
        $live_payload = [
            "accountNumber" => [
                "value" => $this->fields['accountNumber'],
            ],
            "rateRequestControlParameters"=> [
                "returnTransitTimes"=>false,
                "servicesNeededOnRateFailure"=>true,
                "variableOptions"=>"FREIGHT_GUARANTEE",
                "rateSortOrder"=>"SERVICENAMETRADITIONAL"
            ],
            "freightRequestedShipment" => [
                "shipper" => [
                    "address" => [
                        "streetLines"=> [
                            $this->fields['shipper_addressline1'],
                            $this->fields['shipper_addressline2']
                        ],
                        "city"=> $this->fields['shipper_city'],
                        "stateOrProvinceCode"=> $this->fields['shipper_stateprovincecode'],
                        "postalCode"=> $this->fields['shipper_postalcode'],
                        "countryCode"=> $this->fields['shipper_countrycode'],
                        "residential"=> false
                    ]
                ],
                "recipient"=>[
                    "address"=>[
                        "streetLines"=> [
                            $this->fields["ShipTo_AddressLine"][0],
                            $this->fields["ShipTo_AddressLine"][1]
                        ],
                        "city"=> $this->fields['ShipTo_City'],
                        "stateOrProvinceCode"=> $this->fields['ShipTo_StateProvinceCode'],
                        "postalCode"=> $this->fields['ShipTo_PostalCode'],
                        "countryCode"=> $this->fields['ShipTo_CountryCode'],
                        "residential"=> false
                    ]
                    ],
                    "serviceType"=> "FEDEX_FREIGHT_ECONOMY",
                    "preferredCurrency"=> "USD",
                    "shippingChargesPayment"=> [
                        "payor"=>[
                            "responsibleParty"=> [
                                "address"=> [                                    
                                    "streetLines"=> [
                                        $this->fields['shipper_addressline1'],
                                        $this->fields['shipper_addressline2']
                                    ],
                                    "city"=> $this->fields['shipper_city'],
                                    "stateOrProvinceCode"=> $this->fields['shipper_stateprovincecode'],
                                    "postalCode"=> $this->fields['shipper_postalcode'],
                                    "countryCode"=> $this->fields['shipper_countrycode'],
                                    "residential"=> false
                                ],
                                "contact"=> [
                                    "personName"=> $this->fields['shipper_personName'],
                                    "emailAddress"=> "annamarie@usaircraft.com",
                                    "phoneNumber"=> $this->fields['shipper_phoneNumber'],
                                    "companyName"=> $this->fields['shipper_companyName']
                                ],
                                "accountNumber"=> [
                                    "value"=> $this->fields['accountNumber']
                                ]
                            ]
                        ],
                        "paymentType"=> "SENDER"
                    ],
                    "rateRequestType"=> [
                        "LIST"
                    ],
                    "shipDateStamp"=> date('Y-m-d', strtotime('+4 days')),
                    "requestedPackageLineItems"=> $requestedPackageLineItems,
                "totalPackageCount"=> ($pac_count-1),
                "totalWeight"=> $total_weight,
                "freightShipmentDetail"=> [
                    "role"=> "SHIPPER",
                    "accountNumber"=> [
                        "value"=> $this->fields['accountNumber']
                    ],
                    "lineItem"=> $lineItem,
                    "clientDiscountPercent"=> 0,
                    "fedExFreightBillingContactAndAddress"=> [                      
                        "address"=> [                                    
                            "streetLines"=> [
                                $this->fields['shipper_addressline1'],
                                $this->fields['shipper_addressline2']
                            ],
                            "city"=> $this->fields['shipper_city'],
                            "stateOrProvinceCode"=> $this->fields['shipper_stateprovincecode'],
                            "postalCode"=> $this->fields['shipper_postalcode'],
                            "countryCode"=> $this->fields['shipper_countrycode'],
                            "residential"=> false
                        ],
                        "contact"=> [
                            "personName"=> $this->fields['shipper_personName'],
                            "emailAddress"=> "annamarie@usaircraft.com",
                            "phoneNumber"=> $this->fields['shipper_phoneNumber'],
                            "companyName"=> $this->fields['shipper_companyName']
                        ],
                    ],
                    "aliasID"=> "string",
                    "declaredValuePerUnit"=> [
                        "amount"=> "100",
                        "currency"=> $this->CI->config->item('default_currency_code') 
                    ],
                    "totalHandlingUnits"=> 0
                ]  
            ]
        ];
        
        // echo '<pre>';print_r($live_payload);exit;
        

        if ($this->CI->config->item('shipping_mode') == "1") {
            $payload = $live_payload;
        } else {
            $payload = $live_payload;
        }
        
        return $payload;
    }

    private function getratefedex()
    {
        $date_stamp = date("Y-m-d", strtotime(date("Y-m-d") . ' + 1 days'));
        $package_all = array();

        if (strtoupper($this->fields['ShipTo_CountryCode']) == strtoupper($this->fields['shipper_countrycode'])) {
            $service_type = "FEDEX_2_DAY";
        } else {
            $service_type = "INTERNATIONAL_PRIORITY";
        }

        $pac_count = 1;
        foreach ($this->fields['dimensions'] as $dimension) {
            // Set Package Weight
            $weight = round($dimension['weight'], 2);
            $weight_unit = $this->CI->config->item('weight_unit');
            // if ($weight_unit == "KG") {
            //   $weight =  round($weight / 2.205,2);

            // }
            $total_weight += round($weight, 2);

            $package = array(
                "groupPackageCount" => $pac_count,
                "weight" => array(
                    "units" => $weight_unit,
                    "value" => $weight,
                ),
            );

            array_push($package_all, $package);
            $pac_count++;
        }       

        $live_payload = [
            "accountNumber" => [
                "value" => $this->fields['accountNumber'],
            ],
            "requestedShipment" => [
                "shipper" => [
                    "address" => [
                        "postalCode" => $this->fields['shipper_postalcode'],
                        "countryCode" => $this->fields['shipper_countrycode'],
                    ],
                ],
                "recipient" => [
                    "address" => [
                        "postalCode" => $this->fields['ShipTo_PostalCode'],
                        "countryCode" => $this->fields['ShipTo_CountryCode'],
                    ],
                ],
                "shipDateStamp" => $date_stamp,
		"pickupType" => "DROPOFF_AT_FEDEX_LOCATION",
		"preferredCurrency" => $this->CI->config->item('default_currency_code'),
                "serviceType" => $service_type,
                "rateRequestType" => [
                    "LIST"
                ],
                "requestedPackageLineItems" => $package_all,
            ]];

        $sandbox_payload = [
            "accountNumber" => [
                "value" => $this->fields['accountNumber'],
            ],
            "requestedShipment" => [
                "shipper" => [
                    "address" => [
                        "postalCode" => $this->fields['shipper_postalcode'],
                        "countryCode" => $this->fields['shipper_countrycode'],
                    ],
                ],
                "recipient" => [
                    "address" => [
                        "postalCode" => $this->fields['ShipTo_PostalCode'],
                        "countryCode" => $this->fields['ShipTo_CountryCode'],
                    ],
                ],
                "shipDateStamp" => $date_stamp,
		"pickupType" => "DROPOFF_AT_FEDEX_LOCATION",
		"preferredCurrency" => $this->CI->config->item('default_currency_code'),
                "serviceType" => $service_type,
                "rateRequestType" => [                    
                    "ACCOUNT"
                ],
                "requestedPackageLineItems" => $package_all
            ],
        ];

        if ($this->CI->config->item('shipping_mode') == "1") {
            $payload = $live_payload;
        } else {
            $payload = $sandbox_payload;
        }
        return $payload;
    }

    public function processFreightShipment()
    {
        try {
            $version = "v1";
            if ($this->CI->config->item('shipping_mode') == "1") {
                $url = "https://apis.fedex.com/ship/v1/freight/shipments";
            } else {
                $url = "https://apis-sandbox.fedex.com/ship/v1/freight/shipments";
            }
            $access_token = $this->generatetoken();

            if ($access_token['status'] == "approved") {
                $rateData = $this->getFreightShippingPackage_payload();

                //  echo "<pre>";
                //  echo    json_encode($rateData);
                //  die();
                  

                /* Curl start to call UPS rating API */
                $shipping_mode = $this->CI->config->item('shipping_mode');
                if (empty($shipping_mode)) {
                    $shipping_mode = 0;
                }

                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Bearer " . $access_token['access_token'],
                        "Content-Type: application/json",
                        "X-locale: en_US",
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
                    return array("status" => "fail", "error" => "failed to Make shipping");

                    //var_dump($response);
                }
                $fedex_response = json_decode($response);
                //print_r($fedex_response);

                if (isset($fedex_response->transactionId)) {

                    return array("status" => "success", "fedex_response" => $fedex_response->output->transactionShipments[0]);
                } else {
                    return array("status" => "fail", "error" => "failed to Make shipping ");
                }

            } else {
                return array("status" => "fail");

            }
        } catch (Exception $ex) {
            return array("status" => "fail");
        }
    }

    public function cancelShipment($tracking_number)
    {
        
        try {
            $version = "v1";
            if ($this->CI->config->item('shipping_mode') == "1") {
                $url = "https://apis.fedex.com/ship/v1/shipments/cancel";
            } else {
                $url = "https://apis-sandbox.fedex.com/ship/v1/shipments/cancel";
            }
            $access_token = $this->generatetoken();

            if ($access_token['status'] == "approved") {
                $rateData = $this->getCancelShipment_Payload($tracking_number);

                //  echo "<pre>";
                //  echo json_encode($rateData);
                //  exit;
                  

                /* Curl start to call UPS rating API */
                $shipping_mode = $this->CI->config->item('shipping_mode');
                if (empty($shipping_mode)) {
                    $shipping_mode = 0;
                }

                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Bearer " . $access_token['access_token'],
                        "Content-Type: application/json",
                        "X-locale: en_US",
                    ],
                    CURLOPT_POSTFIELDS => json_encode($rateData),
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "PUT",
                    CURLOPT_FAILONERROR => false,
                    CURLOPT_HTTP200ALIASES => (array) 400,
                ]);
                

                $response = curl_exec($curl);
                $error = curl_error($curl);

                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);
            
                if ($httpCode >= 400) {
                    // The request did not succeed, but we got a HTTP response
                    return array("status" => "fail", "error" => "failed to Cancel shipping","msg"=>json_decode($response),"request"=>json_encode($rateData));

                    //var_dump($response);
                }
                $fedex_response = json_decode($response);
                //print_r($fedex_response);

                if (isset($fedex_response->transactionId)) {

                    return array("status" => "success", "fedex_response" => $fedex_response->output);
                } else {
                    return array("status" => "fail", "error" => "failed to Cancel shipping");
                }

            } else {
                return array("status" => "fail to generate token.");

            }
        } catch (Exception $ex) {
            return array("status" => "fail from Exception");
        }
    }

    public function processshipment()
    {
        try {
            $version = "v1";
            if ($this->CI->config->item('shipping_mode') == "1") {
                $url = "https://apis.fedex.com/ship/v1/shipments";
            } else {
                $url = "https://apis-sandbox.fedex.com/ship/v1/shipments";
            }
            $access_token = $this->generatetoken();

            if ($access_token['status'] == "approved") {
                $rateData = $this->getshippingpackage_payload();

                //  echo "<pre>";
                //  echo    json_encode($rateData);
                //  die();
                  

                /* Curl start to call UPS rating API */
                $shipping_mode = $this->CI->config->item('shipping_mode');
                if (empty($shipping_mode)) {
                    $shipping_mode = 0;
                }

                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Bearer " . $access_token['access_token'],
                        "Content-Type: application/json",
                        "X-locale: en_US",
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
                    return array("status" => "fail", "error" => "failed to Make shipping","msg"=>json_decode($response),"request"=>json_encode($rateData));

                    //var_dump($response);
                }
                $fedex_response = json_decode($response);
                //print_r($fedex_response);

                if (isset($fedex_response->transactionId)) {

                    return array("status" => "success", "fedex_response" => $fedex_response->output->transactionShipments[0]);
                } else {
                    return array("status" => "fail", "error" => "failed to Make shipping ");
                }

            } else {
                return array("status" => "fail");

            }
        } catch (Exception $ex) {
            return array("status" => "fail");
        }
    }

    private function getFreightShippingPackage_payload()
    {

        $date_stamp = date("Y-m-d", strtotime(date("Y-m-d") . ' + 2 days'));
        $package_all = array();
        $commodities_all = array();
        $lineItem = array();
        $requestedPackageLineItems = array();
        $item_count = 0;
        $all_dimensions = array_merge($this->fields['dimensions'],$this->fields['dimensions_freight']);
        foreach ($all_dimensions as $dimension) {
            // Set Package Weight
            $item_count++;
            $weight = $dimension['weight'];
            $weight_unit = $this->CI->config->item('weight_unit');
            if ($weight_unit == "KG") {
                $weight = $weight * 2.205;
            }
            $total_weight += $weight;

            $package = array(
                "groupPackageCount" => "1",
                "weight" => array(
                    "units" => "LB",
                    "value" => $weight,
                ),
            );
            $li = array(
                "handlingUnits"=> 1,
                "subPackagingType"=> "BOX",
                "weight"=> array(
                    "units"=> "LB",
                    "value"=> $weight
                ),
                "description"=>"Description: ".$dimension['package_name'],
                "pieces"=> 1,
                "freightClass"=> "CLASS_050",
                "id"=> $dimension['package_name']
            );
            array_push($lineItem, $li);
            $rp_li = array(
                "subPackagingType"=> "BOX",
                "weight"=> array(
                    "units"=> "LB",
                    "value"=> $weight
                ),
                "associatedFreightLineItems"=> array(
                    array(
                        "id"=> $dimension['package_name']
                    )
                )
            );
            array_push($requestedPackageLineItems,$rp_li);
            $commodity = array (                                           
                        "unitPrice" => [
                            "amount"=>1,
                            "currency"=> $this->CI->config->item('default_currency_code')
                        ],
                        "additionalMeasures" => [
                            [
                                "quantity" => $weight,
                                "units"=> "LB"
                            ]
                        ],
                        "numberOfPieces" => 1,
                        "quantity"=> 1,
                        "quantityUnits" => "Ea",
                        "customsValue" => [
                            "amount"=> "1",
                            "currency"=> $this->CI->config->item('default_currency_code')
                        ],
                        "countryOfManufacture"=> "US",                           
                        "description"=> "Description: "+$dimension['package_name'],
                        "name"=> "name: "+$dimension['package_name'],
                        "weight" => [
                            "units"=> "LB",
                            "value"=> $weight
                        ]  
                    );

            array_push($package_all, $package);
            array_push($commodities_all,$commodity);
        }

        if (strtoupper($this->fields['ShipTo_CountryCode']) == strtoupper($this->fields['shipper_countrycode'])) {
            $service_type = "FEDEX_FREIGHT_ECONOMY";
        } else {
            $service_type = "FEDEX_FREIGHT_ECONOMY";

        }

        $shipment_request = [
            "labelResponseOptions" => "LABEL",
            "freightRequestedShipment" => [
                "pickupType"=> "CONTACT_FEDEX_TO_SCHEDULE",
                "serviceType"=> "FEDEX_FREIGHT_ECONOMY",
                "packagingType"=> "YOUR_PACKAGING",
                "totalWeight"=> $total_weight,
                "preferredCurrency"=> $this->CI->config->item('default_currency_code'),
                "shipper"=> [
                    "address"=> [
                        "streetLines"=> [
                            $this->fields['shipper_addressline1'],
                            $this->fields['shipper_addressline2']
                        ],
                        "city"=> $this->fields['shipper_city'],
                        "stateOrProvinceCode"=> $this->fields['shipper_stateprovincecode'],
                        "postalCode"=> $this->fields['shipper_postalcode'],
                        "countryCode"=> $this->fields['shipper_countrycode'],
                        "residential"=> false
                    ],
                    "contact"=> [
                        "personName"=> $this->fields['shipper_personName'],                        
                        "phoneNumber"=> $this->fields['shipper_phoneNumber'],
                        "companyName"=> $this->fields['shipper_companyName']
                    ]
                ],
                "recipient"=> [
                    "address"=> [
                        "streetLines"=> $this->fields['ShipTo_AddressLine'],
                        "city"=> $this->fields['ShipTo_City'],
                        "stateOrProvinceCode"=> $this->fields['ShipTo_StateProvinceCode'],
                        "postalCode"=> $this->fields['ShipTo_PostalCode'],
                        "countryCode"=> $this->fields['ShipTo_CountryCode'],
                        "residential"=> false
                    ],
                    "contact"=> [
                        "personName"=> $this->fields['ShipTo_Name'],
                        "phoneNumber"=> $this->fields['ShipTo_phone']
                    ],
                    "deliveryInstructions"=> "NA"
                ],
                "soldTo"=> [
                    "address"=> [
                        "streetLines"=> $this->fields['ShipTo_AddressLine'],
                        "city"=> $this->fields['ShipTo_City'],
                        "stateOrProvinceCode"=> $this->fields['ShipTo_StateProvinceCode'],
                        "postalCode"=> $this->fields['ShipTo_PostalCode'],
                        "countryCode"=> $this->fields['ShipTo_CountryCode'],
                        "residential"=> false
                    ],
                    "contact"=> [
                        "personName"=> $this->fields['ShipTo_Name'],
                        "phoneNumber"=> $this->fields['ShipTo_phone']
                    ]
                ],
                "shippingChargesPayment"=> [
                    "paymentType"=> "SENDER",
                    "payor"=> [
                        "responsibleParty"=> [
                            "address"=> [
                            "streetLines"=> [
                                    $this->fields['shipper_addressline1'],
                                    $this->fields['shipper_addressline2']
                                ],
                                "city"=> $this->fields['shipper_city'],
                                "stateOrProvinceCode"=> $this->fields['shipper_stateprovincecode'],
                                "postalCode"=> $this->fields['shipper_postalcode'],
                                "countryCode"=> $this->fields['shipper_countrycode'],
                                "residential"=> false
                            ],
                            "contact"=> [
                                "phoneNumber"=> $this->fields['ShipTo_phone']
                            ],
                            "accountNumber"=> [
                                "value"=> $this->fields['accountNumber']
                            ]
                        ]
                    ]
                ],
                "freightShipmentDetail"=> [
                    "role"=> "SHIPPER",
                    "fedExFreightAccountNumber"=> [
                        "value"=> $this->fields['accountNumber']
                    ],
                    "lineItem"=> $lineItem,
                    "fedExFreightBillingContactAndAddress"=> [
                        "address"=> [
                            "streetLines"=> [
                                $this->fields['shipper_addressline1'],
                                $this->fields['shipper_addressline2']
                            ],
                            "city"=> $this->fields['shipper_city'],
                            "stateOrProvinceCode"=> $this->fields['shipper_stateprovincecode'],
                            "postalCode"=> $this->fields['shipper_postalcode'],
                            "countryCode"=> $this->fields['shipper_countrycode'],
                            "residential"=> false
                        ]
                    ],
                    "totalHandlingUnits"=> $item_count
                ],
                "customsClearanceDetail"=> [
                    "regulatoryControls"=> [
                        "NOT_IN_FREE_CIRCULATION",
                        "USMCA"
                    ],
                    "commercialInvoice"=> [
                        "originatorName"=> "originator Name",
                        "comments"=> [
                            "optional comments for the commercial invoice"
                        ],
                        "customerReferences"=> [
                            [
                                "customerReferenceType"=> "INVOICE_NUMBER",
                                "value"=> "3686"
                            ]
                        ]
                    ],
                    "commodities"=> $commodities_all,
                    "totalCustomsValue"=> [
                        "amount"=> count($commodities_all),
                        "currency"=> $this->CI->config->item('default_currency_code')
                    ]                                
                ],
                "labelSpecification"=> [
                    "labelFormatType"=> "COMMON2D",
                    "labelStockType"=> "PAPER_4X6",
                    "labelRotation"=> "NONE",
                    "imageType"=> "PNG"
                ],
                "requestedPackageLineItems"=> $requestedPackageLineItems
            ],            
            "accountNumber" => [
                "value" => $this->fields['accountNumber']
            ]
        ];
        return $shipment_request;
    }

    private function getCancelShipment_Payload($tracking_number){
        $cancel_shipment_request = [
            "emailShipment" => "false",  
            "senderCountryCode" => $this->fields['shipper_countrycode'],
            "deletionControl"=> "DELETE_ALL_PACKAGES",
            "accountNumber" => [
                "value" => $this->fields['accountNumber']
            ],
            "trackingNumber"=> $tracking_number
        ];  
        return $cancel_shipment_request; 
    }
    private function getshippingpackage_payload()
    {

        $date_stamp = date("Y-m-d", strtotime(date("Y-m-d") . ' + 1 days'));
        $package_all = array();
        $commodities_all = array();
        
        foreach ($this->fields['dimensions'] as $dimension) {
            // Set Package Weight
            $weight = $dimension['weight'];
            $weight_unit = $this->CI->config->item('weight_unit');
            if ($weight_unit == "KG") {
                $weight = $weight / 2.205;
            }
            $total_weight += $weight;

            $package = array(
                "groupPackageCount" => "1",
                "weight" => array(
                    "units" => "LB",
                    "value" => $weight,
                ),
            );
            $commodity = array (                                           
                        "unitPrice" => [
                            "amount"=>1,
                            "currency"=> $this->CI->config->item('default_currency_code')
                        ],
                        "additionalMeasures" => [
                            [
                                "quantity" => $weight,
                                "units"=> "LB"
                            ]
                        ],
                        "numberOfPieces" => 1,
                        "quantity"=> 1,
                        "quantityUnits" => "Ea",
                        "customsValue" => [
                            "amount"=> "1",
                            "currency"=> $this->CI->config->item('default_currency_code')
                        ],
                        "countryOfManufacture"=> "US",
                        "cIMarksAndNumbers"=> "87123",                            
                        "description"=> "Description: "+$dimension['package_name'],
                        "name"=> "name: "+$dimension['package_name'],
                        "weight" => [
                            "units"=> "LB",
                            "value"=> $weight
                        ]  
                    );

            array_push($package_all, $package);
            array_push($commodities_all,$commodity);
        }

        if (strtoupper($this->fields['ShipTo_CountryCode']) == strtoupper($this->fields['shipper_countrycode'])) {
            $service_type = "FEDEX_2_DAY";
        } else {
            $service_type = "INTERNATIONAL_PRIORITY";

        }

        $shipment_request = [
            "labelResponseOptions" => "LABEL",
            "requestedShipment" => [
                "shipper" => [
                    "contact" => [
                        "personName" => $this->fields['shipper_personName'],
                        "phoneNumber" => $this->fields['shipper_phoneNumber'],
                        "companyName" => $this->fields['shipper_companyName']
                    ],
                    "address" => [
                        "streetLines" => [
                            $this->fields['shipper_addressline1'],
                            $this->fields['shipper_addressline2']
                        ],
                        "city" => $this->fields['shipper_city'],
                        "stateOrProvinceCode" => $this->fields['shipper_stateprovincecode'],
                        "postalCode" => $this->fields['shipper_postalcode'],
                        "countryCode" => $this->fields['shipper_countrycode']
                    ],
                ],
                "recipients" => [
                    [
                        "contact" => [
                            "personName" => $this->fields['ShipTo_Name'],
                            "phoneNumber" => $this->fields['ShipTo_phone'],
                            "companyName" => $this->fields['ShipTo_Name']
                        ],
                        "address" => [
                            "streetLines" => $this->fields['ShipTo_AddressLine'],
                            "city" => $this->fields['ShipTo_City'],
                            "stateOrProvinceCode" => $this->fields['ShipTo_StateProvinceCode'],
                            "postalCode" => $this->fields['ShipTo_PostalCode'],
                            "countryCode" => $this->fields['ShipTo_CountryCode']
                        ],
                    ],
                ],
                "shipDatestamp" => $date_stamp,
                "serviceType" => $service_type,
                "packagingType" => "YOUR_PACKAGING",
		"pickupType" => "DROPOFF_AT_FEDEX_LOCATION",
		"preferredCurrency" => $this->CI->config->item('default_currency_code'),
                "blockInsightVisibility" => false,
                "shippingChargesPayment" => [
                    "paymentType" => "SENDER"
                ],
                "labelSpecification" => [
                    "imageType" => "PNG",
                    "labelStockType" => "PAPER_4X6"
                ],
                "requestedPackageLineItems" => $package_all,
                "customsClearanceDetail" => [
                    "dutiesPayment" => [
                        "paymentType" => "SENDER"
                    ],
                    "totalCustomsValue"=> [
                        "amount"=> 1,
                        "currency"=> $this->CI->config->item('default_currency_code')
                    ],
                    "isDocumentOnly" => false,
                    "commodities" => $commodities_all,
                ],
                "shippingDocumentSpecification" => [
                    "shippingDocumentTypes" => [
                        "COMMERCIAL_INVOICE"
                    ],
                    "commercialInvoiceDetail" => [
                        "documentFormat" => [
                            "docType" => "PDF",
                            "stockType" => "PAPER_LETTER"
                        ],
                    ],
                ]                
            ],
            "accountNumber" => [
                "value" => $this->fields['accountNumber']
            ]
        ];        
        
        // $shipment_request = '{
        //     "labelResponseOptions": "LABEL",
        //     "requestedShipment": {
        //       "shipper": {
        //         "contact": {
        //           "personName": "SHIPPER NAME",
        //           "phoneNumber": 1234567890,
        //           "companyName": "Shipper Company Name"
        //         },
        //         "address": {
        //           "streetLines": [
        //             "SHIPPER STREET LINE 1"
        //           ],
        //           "city": "Memphis",
        //           "stateOrProvinceCode": "TN",
        //           "postalCode": 38116,
        //           "countryCode": "US"
        //         }
        //       },
        //       "recipients": [
        //         {
        //           "contact": {
        //             "personName": "RECIPIENT NAME",
        //             "phoneNumber": 1234567890,
        //             "companyName": "Recipient Company Name"
        //           },
        //           "address": {
        //             "streetLines": [
        //               "RECIPIENT STREET LINE 1",
        //               "RECIPIENT STREET LINE 2",
        //               "RECIPIENT STREET LINE 3"
        //             ],
        //             "city": "RICHMOND",
        //             "stateOrProvinceCode": "BC",
        //             "postalCode": "V7C4V7",
        //             "countryCode": "CA"
        //           }
        //         }
        //       ],
        //       "shipDatestamp": "2020-07-03",
        //       "serviceType": "INTERNATIONAL_PRIORITY",
        //       "packagingType": "YOUR_PACKAGING",
        //       "pickupType": "USE_SCHEDULED_PICKUP",
        //       "blockInsightVisibility": false,
        //       "shippingChargesPayment": {
        //         "paymentType": "SENDER"
        //       },
        //       "labelSpecification": {
        //         "imageType": "PDF",
        //         "labelStockType": "PAPER_85X11_TOP_HALF_LABEL"
        //       },
        //       "customsClearanceDetail": {
        //         "dutiesPayment": {
        //           "paymentType": "SENDER"
        //         },
        //         "isDocumentOnly": false,
        //         "commodities": [
        //           {
        //             "description": "Commodity description",
        //             "countryOfManufacture": "US",
        //             "quantity": 3,
        //             "quantityUnits": "PCS",
        //             "unitPrice": {
        //               "amount": 100,
        //               "currency": "USD"
        //             },
        //             "customsValue": {
        //               "amount": 300,
        //               "currency": "USD"
        //             },
        //             "weight": {
        //               "units": "LB",
        //               "value": 20
        //             }
        //           }
        //         ]
        //       },
        //       "shippingDocumentSpecification": {
        //         "shippingDocumentTypes": [
        //           "COMMERCIAL_INVOICE"
        //         ],
        //         "commercialInvoiceDetail": {
        //           "documentFormat": {
        //             "docType": "PDF",
        //             "stockType": "PAPER_LETTER"
        //           }
        //         }
        //       },
        //       "requestedPackageLineItems": [
        //         {
        //           "groupPackageCount": 1,
        //           "weight": {
        //             "value": 10,
        //             "units": "LB"
        //           },
        //           "declaredValue": {
        //             "amount": 100,
        //             "currency": "USD"
        //           }
        //         },
        //         {
        //           "groupPackageCount": 2,
        //           "weight": {
        //             "value": 5,
        //             "units": "LB"
        //           },
        //           "declaredValue": {
        //             "amount": 100,
        //             "currency": "USD"
        //           }
        //         }
        //       ]
        //     },
        //     "accountNumber": {
        //       "value": "740561073"
        //     }
        //   }';

        return $shipment_request;
    }

    /* used for package shipment where Dimensions is greater than  total constraint of 165 inches (length + girth, where girth is 2 x width plus 2 x height) */
    public function processfreightRate()
    {
        try {
            $version = "v1";
            if ($this->CI->config->item('shipping_mode') == "1") {
                $end_url = "https://apis.fedex.com/rate/v1/freight/rates/quotes";
            } else {
                $end_url = "https://apis-sandbox.fedex.com/rate/v1/freight/rates/quotes";
            }
            $access_token = $this->generatetoken();
            if ($access_token['status'] == "approved") {
                $rateData = $this->getfreightsample();
                // echo "<pre>";
                // print_r($rateData);
                /* Curl start to call UPS rating API */
                $shipping_mode = $this->CI->config->item('shipping_mode');
                if (empty($shipping_mode)) {
                    $shipping_mode = 0;
                }

                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Bearer " . $access_token['access_token'],
                        "Content-Type: application/json",
                        "transId: string",
                        "transactionSrc: testing",
                    ],
                    CURLOPT_POSTFIELDS => $rateData,
                    CURLOPT_URL => $end_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                ]);

                $response = curl_exec($curl);
                $error = curl_error($curl);
                curl_close($curl);
  //              echo "<pre>";
                $ups_response = json_decode($response);
//                print_r($ups_response);
                //exit;

                if ($ups_response->FreightRateResponse->Response->ResponseStatus->Description == "Success") {
                    return array("status" => "success", "rates" => $ups_response->FreightRateResponse);
                } else {
                    return array("status" => "fail", "error" => $ups_response);
                }
                return $ups_response;

            } else {
                return array("status" => "fail");

            }
        } catch (Exception $ex) {
            return array("status" => "fail");
        }
    }

    /* used for package shipment where Dimensions is greater than  total constraint of 165 inches (length + girth, where girth is 2 x width plus 2 x height) */

    private function getfreightraterequest()
    {

        $package_all = array();
        $total_weight = 0;

        foreach ($this->fields['dimensions_freight'] as $dimension) {

            // Set package dimension
            $volume_unit = $this->CI->config->item('volume_unit');

            if ($volume_unit == "CM") {
                $length = $dimension['length'] / 2.54;
                $width = $dimension['width'] / 2.54;
                $height = $dimension['height'] / 2.54;
            } else {
                $length = $dimension['length'];
                $width = $dimension['width'];
                $height = $dimension['height'];
            }

            // Set Package Weight
            $weight = $dimension['weight'];
            $weight_unit = $this->CI->config->item('weight_unit');
            if ($weight_unit == "KG") {
                $weight = $weight / 2.205;
            }
            $total_weight += $weight;

            // $package = array(
            //     "PackagingType" => array(
            //       "Code" => "02",
            //       "Description" => "Packaging"
            //     ),
            //     "Dimensions" => array(
            //       "UnitOfMeasurement" => array(
            //         "Code" => "IN",
            //         "Description" => "IN"
            //       ),
            //       "Length" => (string)round($length,2),
            //       "Width" => (string)round($width,2),
            //       "Height" => (string)round($height,2)
            //     ),
            //     "PackageWeight" => array(
            //       "UnitOfMeasurement" => array(
            //         "Code" => "LBS",
            //         "Description" => "LBS"
            //       ),
            //       "Weight" => (string)round($weight,2)
            //     )
            //     );

            $package = array(
                "Description" => "FRS-Freight",
                "Weight" => array(
                    "UnitOfMeasurement" => array(
                        "Code" => "LBS",
                    ),
                    "Value" => (string) round($weight, 2),
                ),
                "Dimensions" => array(
                    "UnitOfMeasurement" => array(
                        "Code" => "IN",
                        "Description" => " ",
                    ),
                    "Length" => (string) round($length, 2),
                    "Width" => (string) round($width, 2),
                    "Height" => (string) round($height, 2),
                ),
                "NumberOfPieces" => "1",
                "PackagingType" => array(
                    "Code" => "PKG",
                ),
                "FreightClass" => "60",
            );

            array_push($package_all, $package);
        }

        $payload = array(
            "FreightRateRequest" => array(
                "ShipFrom" => array(
                    "Name" => $this->fields['shipper_name'],
                    "Address" => array(
                        "AddressLine" => $this->fields['shipper_addressline1'] . "" . $this->fields['shipper_addressline2'],
                        "City" => $this->fields['shipper_city'],
                        "StateProvinceCode" => $this->fields['shipper_stateprovincecode'],
                        "PostalCode" => $this->fields['shipper_postalcode'],
                        "CountryCode" => $this->fields['shipper_countrycode'],
                        "ResidentialAddressIndicator" => "",
                    ),
                    "AttentionName" => $this->fields['shipper_attentionname'],
                    "Phone" => array(
                        "Number" => $this->fields['shipper_number'],
                        "Extension" => "1",
                    ),
                    "EMailAddress" => $this->fields["access"],
                ),
                "ShipperNumber" => $this->fields['shipperNumber'],
                "ShipTo" => array(
                    "Name" => $this->fields['ShipTo_Name'],
                    "Address" => array(
                        "AddressLine" => $this->fields['ShipTo_AddressLine'],
                        "City" => $this->fields['ShipTo_City'],
                        "StateProvinceCode" => $this->fields['ShipTo_StateProvinceCode'],
                        "PostalCode" => $this->fields['ShipTo_PostalCode'],
                        "CountryCode" => $this->fields['ShipTo_CountryCode'],
                    ),
                    "AttentionName" => $this->fields['ShipTo_Name'],
                    "Phone" => array(
                        "Number" => $this->fields['ShipTo_phone'],
                    ),
                ),
                "PaymentInformation" => array(
                    "Payer" => array(
                        "Name" => $this->fields['shipper_name'],
                        "Address" => array(
                            "AddressLine" => $this->fields['shipper_addressline1'] . "" . $this->fields['shipper_addressline2'],
                            "City" => $this->fields['shipper_city'],
                            "StateProvinceCode" => $this->fields['shipper_stateprovincecode'],
                            "PostalCode" => $this->fields['shipper_postalcode'],
                            "CountryCode" => $this->fields['shipper_countrycode'],
                        ),
                        "ShipperNumber" => $this->fields['shipperNumber'],
                        "AccountType" => "1",
                        "AttentionName" => $this->fields['shipper_attentionname'],
                        "Phone" => array(
                            "Number" => $this->fields['shipper_number'],
                            "Extension" => "1",
                        ),
                        "EMailAddress" => $this->fields["access"],
                    ),
                    "ShipmentBillingOption" => array(
                        "Code" => "10",
                    ),
                ),
                "Service" => array(
                    "Code" => "308",
                ),
                "Commodity" => $package_all,
                "DensityEligibleIndicator" => "",
                "AlternateRateOptions" => array(
                    "Code" => "3",
                ),
                "PickupRequest" => array(
                    "PickupDate" => date('Ymd', strtotime(date("ymd") . ' + ' . $this->fields['pickup_days'] . ' days')),
                ),
                "GFPOptions" => array(
                    "GPFAccesorialRateIndicator" => "",
                ),
                "TimeInTransitIndicator" => "",
            ),
        );

        return $payload;
    }

    private function getfreightsample()
    {

        $freight_request = '{
            "rateRequestControlParameters": {
              "returnTransitTimes": true
            },
            "accountNumber": {
              "value": "740561073"
            },
            "freightRequestedShipment": {
              "serviceType": "FEDEX_FREIGHT_PRIORITY",
              "shipper": {
                "address": {
                  "city": "HARRISON",
                  "stateOrProvinceCode": "AR",
                  "postalCode": "726016353",
                  "countryCode": "US"
                }
              },
              "recipient": {
                "address": {
                  "city": "MIAMI",
                  "stateOrProvinceCode": "FL",
                  "postalCode": "331662829",
                  "countryCode": "US"
                }
              },
              "shippingChargesPayment": {
                "paymentType": "SENDER",
                "payor": {
                  "responsibleParty": {
                    "accountNumber": {
                      "value": "740561073"
                    }
                  }
                }
              },
              "freightShipmentDetail": {
                "role": "SHIPPER",
                "accountNumber": {
                  "value": "740561073"
                },
                "fedExFreightBillingContactAndAddress": {
                  "address": {
                    "streetLines": [
                      "1202 CHALET LN"
                    ],
                    "city": "HARRISON",
                    "stateOrProvinceCode": "AR",
                    "postalCode": "726016353",
                    "countryCode": "US"
                  }
                },
                "lineItem": [
                  {
                    "freightClass": "CLASS_050",
                    "handlingUnits": "1",
                    "pieces": 1,
                    "subPackagingType": "BUNDLE",
                    "id": "books",
                    "weight": {
                      "units": "KG",
                      "value": "150.00"
                    }
                  }
                ]
              },
              "rateRequestType": [
                "LIST"
              ],
              "requestedPackageLineItems": [
                {
                  "associatedFreightLineItems": [
                    {
                      "id": "books"
                    }
                  ],
                  "weight": {
                    "units": "KG",
                    "value": "150.00"
                  },
                  "subPackagingType": "BUNDLE"
                }
              ]
            }
          }';

        return $freight_request;
    }

    public function processsfreighthipment()
    {
        try {
            $version = "v1";

            if ($this->CI->config->item('shipping_mode') == "1") {
                $end_url = "https://apis-sandbox.fedex.com/ship/v1/freight/shipments";
            } else {
                $end_url = "https://apis-sandbox.fedex.com/ship/v1/freight/shipments";
            }
            $access_token = $this->generatetoken();
            if ($access_token['status'] == "approved") {
                $rateData = $this->getfreightshippingsample();

                // echo "<pre>";
                // print_r($rateData);
                // exit;
                /* Curl start to call UPS rating API */
                $shipping_mode = $this->CI->config->item('shipping_mode');
                if (empty($shipping_mode)) {
                    $shipping_mode = 0;
                }

                //    echo $access_token['access_token'];

                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Bearer " . $access_token['access_token'],
                        "Content-Type: application/json",
                    ],
                    CURLOPT_POSTFIELDS => $rateData,
                    CURLOPT_URL => $end_url,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_FAILONERROR => false,
                    CURLOPT_HTTP200ALIASES => (array) 400,
                ]);

                $response = curl_exec($curl);
                $error = curl_error($curl);

                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

                if ($httpCode >= 400) {
                    // The request did not succeed, but we got a HTTP response
                    echo 'HTTP error: ' . $httpCode . ' with message: ';
                    $ups_response = json_decode($response);

                    var_dump($response);
                }

                curl_close($curl);

                // echo "<pre>";
                // print_r($error);
                // $ups_response = json_decode($response);
                // print_r($ups_response);
                // exit;

                if ($ups_response->FreightRateResponse->Response->ResponseStatus->Description == "Success") {
                    return array("status" => "success", "rates" => $ups_response->FreightRateResponse);
                } else {
                    return array("status" => "fail", "error" => $ups_response);
                }
                return $ups_response;

            } else {
                return array("status" => "fail");

            }
        } catch (Exception $ex) {
            return array("status" => "fail");
        }
    }

    private function getfreightshippingsample()
    {

        $shipment_request = '{
          "labelResponseOptions": "LABEL",
          "oneLabelAtATime": false,
          "freightRequestedShipment": {
              "shipper": {
                  "address": {
                      "streetLines": [
                          "1202 CHALET LN"
                      ],
                      "city": "HARRISON",
                      "stateOrProvinceCode": "AR",
                      "postalCode": 726016353,
                      "countryCode": "US"
                  },
                  "contact": {
                      "personName": "Shipper Name",
                      "phoneNumber": 1231231231,
                      "companyName": "Shipper Company Name"
                  }
              },
              "recipient": {
                  "address": {
                      "streetLines": [
                          "Recipient Address 1",
                          "Recipient Address 2"
                      ],
                      "city": "Toronto",
                      "countryCode": "CA",
                      "postalCode": "m1m1m1",
                      "stateOrProvinceCode": "ON",
                      "residential": false
                  },
                  "contact": {
                      "personName": "Recipient name",
                      "companyName": "Recipient Company Name",
                      "phoneNumber": 1234567890
                  }
              },
              "shipDatestamp": "2023-08-30",
              "serviceType": "FEDEX_FREIGHT_ECONOMY",
              "packagingType": "YOUR_PACKAGING",
              "pickupType": "CONTACT_FEDEX_TO_SCHEDULE",
              "rateRequestType": [
                  "LIST"
              ],
              "shippingChargesPayment": {
                  "payor": {
                      "responsibleParty": {
                          "accountNumber": {
                              "value": "740561073"
                          }
                      }
                  },
                  "paymentType": "SENDER"
              },
              "freightShipmentDetail": {
                  "role": "SHIPPER",
                  "collectTermsType": "STANDARD",
                  "declaredValueUnits": "USD",
                  "totalHandlingUnits": 3,
                  "lineItem": [{
                          "pieces": 1,
                          "handlingUnits": 1,
                          "freightClass": "CLASS_060",
                          "subPackagingType": "BASKET",
                          "description": "books autograph",
                          "weight": {
                              "units": "LB",
                              "value": 10
                          },
                          "id": 1
                      },
                      {
                          "pieces": 1,
                          "handlingUnits": 1,
                          "freightClass": "CLASS_060",
                          "subPackagingType": "BASKET",
                          "description": "books autograph",
                          "weight": {
                              "units": "LB",
                              "value": 10
                          },
                          "id": 2
                      },
                      {
                          "pieces": 1,
                          "handlingUnits": 1,
                          "freightClass": "CLASS_060",
                          "subPackagingType": "BASKET",
                          "description": "books autograph",
                          "weight": {
                              "units": "LB",
                              "value": 10
                          },
                          "id": 3
                      }
                  ],
                  "fedExFreightBillingContactAndAddress": {
                      "address": {
                          "streetLines": [
                              "1202 CHALET LN"
                          ],
                          "city": "HARRISON",
                          "stateOrProvinceCode": "AR",
                          "postalCode": 726016353,
                          "countryCode": "US"
                      },
                      "contact": {
                          "personName": "GREG PEARSON",
                          "companyName": "CSP FREIGHT TESTING"
                      }
                  },
                  "fedExFreightAccountNumber": {
                      "value": "740561073"
                  }
              },
              "customsClearanceDetail": {
                  "totalCustomsValue": {
                      "amount": 300,
                      "currency": "USD"
                  },
                  "commodities": [{
                      "description": "DSLR Camera",
                      "countryOfManufacture": "US",
                      "numberOfPieces": 3,
                      "weight": {
                          "value": 30,
                          "units": "LB"
                      },
                      "quantity": 3,
                      "quantityUnits": "PCS",
                      "unitPrice": {
                          "amount": 100,
                          "currency": "USD"
                      },
                      "customsValue": {
                          "amount": 100,
                          "currency": "USD"
                      }
                  }]
              },
              "labelSpecification": {
                  "imageType": "PNG",
                  "labelFormatType": "COMMON2D",
                  "labelStockType": "PAPER_4X6"
              },
              "blockInsightVisibility": false,
              "shippingDocumentSpecification": {
                  "shippingDocumentTypes": [
                      "FEDEX_FREIGHT_STRAIGHT_BILL_OF_LADING"
                  ],
                  "freightBillOfLadingDetail": {
                      "format": {
                          "stockType": "PAPER_LETTER",
                          "docType": "PDF"
                      }
                  }
              },
              "totalPackageCount": 3,
              "requestedPackageLineItems": [{
                      "subPackagingType": "BASKET",
                      "weight": {
                          "units": "LB",
                          "value": 10
                      },
                      "associatedFreightLineItems": [{
                          "id": 1
                      }],
                      "customerReferences": [{
                          "customerReferenceType": "P_O_NUMBER",
                          "value": "PONumber11XX"
                      }]
                  },
                  {
                      "subPackagingType": "BASKET",
                      "weight": {
                          "units": "LB",
                          "value": 10
                      },
                      "associatedFreightLineItems": [{
                          "id": 2
                      }],
                      "customerReferences": [{
                          "customerReferenceType": "P_O_NUMBER",
                          "value": "PONumber11XX"
                      }]
                  },
                  {
                      "subPackagingType": "BASKET",
                      "weight": {
                          "units": "LB",
                          "value": 10
                      },
                      "associatedFreightLineItems": [{
                          "id": 3
                      }],
                      "customerReferences": [{
                          "customerReferenceType": "P_O_NUMBER",
                          "value": "PONumber11XX"
                      }]
                  }
              ]
          },
          "accountNumber": {
              "value": "740561073"
          }
      }';

        return $shipment_request;
    }

}
