<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UpsRating
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

    /* used for package shipment where Dimensions is less than  total constraint of 165 inches (length + girth, where girth is 2 x width plus 2 x height) */
    public function processRate()
    {
        try {

            if ($this->CI->config->item('shipping_mode') == "1") {
                $url = "https://onlinetools.ups.com/api/rating/";
            } else {
                $url = "https://wwwcie.ups.com/api/rating/";
            }
            $access_token = $this->generatetoken();
            if ($access_token['status'] == "approved") {
                $rateData = $this->getraterequest();
                // echo "<pre>";
                // print_r($rateData);

                /* Curl start to call UPS rating API */
                $shipping_mode = $this->CI->config->item('shipping_mode');
                if (empty($shipping_mode)) {
                    $shipping_mode = 0;
                }

                $version = "v1";
                $requestoption = "Shop";

                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Bearer " . $access_token['access_token'],
                        "Content-Type: application/json",
                        "transId: string",
                        "transactionSrc: testing",
                    ],
                    CURLOPT_POSTFIELDS => json_encode($rateData),
                    CURLOPT_URL => $url . $version . "/" . $requestoption,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                ]);

                $response = curl_exec($curl);
                $error = curl_error($curl);
                curl_close($curl);

                $ups_response = json_decode($response);
                if ($ups_response->RateResponse->Response->ResponseStatus->Description == "Success") {
                    return array("status" => "success", "rates" => $ups_response->RateResponse->RatedShipment);
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
    /* used for package shipment where Dimensions is less than  total constraint of 165 inches (length + girth, where girth is 2 x width plus 2 x height) */

    private function getraterequest()
    {

        $package_all = array();
        $total_weight = 0;
        foreach ($this->fields['dimensions'] as $dimension) {

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

            $package = array(
                "PackagingType" => array(
                    "Code" => "02",
                    "Description" => "Packaging",
                ),
                "Dimensions" => array(
                    "UnitOfMeasurement" => array(
                        "Code" => "IN",
                        "Description" => "IN",
                    ),
                    "Length" => (string) round($length, 2),
                    "Width" => (string) round($width, 2),
                    "Height" => (string) round($height, 2),
                ),
                "PackageWeight" => array(
                    "UnitOfMeasurement" => array(
                        "Code" => "LBS",
                        "Description" => "LBS",
                    ),
                    "Weight" => (string) round($weight, 2),
                ),
            );

            array_push($package_all, $package);
        }

        if ($this->fields['shipper_countrycode'] == "CA") {
            $service = array(
                "Code" => "02",
                "Description" => "Ground",
            );
        } else {

            $service = array(
                "Code" => "03",
                "Description" => "Ground",
            );
        }
        $payload = array(
            "RateRequest" => array(
                "Request" => array(
                    "RequestOption" => "Rate",
                    "SubVersion" => "1601",
                    "TransactionReference" => array(
                        "CustomerContext" => "CustomerContext",
                        "TransactionIdentifier" => "TransactionIdentifier",
                    ),
                ),
                "Shipment" => array(
                    "Shipper" => array(
                        "Name" => $this->fields['shipper_name'],
                        "ShipperNumber" => $this->fields['shipperNumber'],
                        "Address" => array(
                            "AddressLine" => $this->fields['shipper_addressline1'] . "" . $this->fields['shipper_addressline2'],
                            "City" => $this->fields['shipper_city'],
                            "StateProvinceCode" => $this->fields['shipper_stateprovincecode'],
                            "PostalCode" => $this->fields['shipper_postalcode'],
                            "CountryCode" => $this->fields['shipper_countrycode'],
                        ),
                    ),
                    "ShipTo" => array(
                        "Name" => $this->fields['ShipTo_Name'],
                        "Address" => array(
                            "AddressLine" => $this->fields['ShipTo_AddressLine'],
                            "City" => $this->fields['ShipTo_City'],
                            "StateProvinceCode" => $this->fields['ShipTo_StateProvinceCode'],
                            "PostalCode" => $this->fields['ShipTo_PostalCode'],
                            "CountryCode" => $this->fields['ShipTo_CountryCode'],
                        ),
                    ),
                    "ShipFrom" => array(
                        "Name" => $this->fields['shipper_name'],
                        "Address" => array(
                            "AddressLine" => $this->fields['shipper_addressline1'] . " " . $this->fields['shipper_addressline2'],
                            "City" => $this->fields['shipper_city'],
                            "StateProvinceCode" => $this->fields['shipper_stateprovincecode'],
                            "PostalCode" => $this->fields['shipper_postalcode'],
                            "CountryCode" => $this->fields['shipper_countrycode'],
                        ),
                    ),
                    "PaymentDetails" => array(
                        "ShipmentCharge" => array(
                            "Type" => "01",
                            "BillShipper" => array(
                                "AccountNumber" => $this->fields['shipperNumber'],
                            ),
                        ),
                    ),
                    "Service" => $service,
                    "ShipmentTotalWeight" => array(
                        "UnitOfMeasurement" => array(
                            "Code" => "LBS",
                            "Description" => "LBS",
                        ),
                        "Weight" => (string) round($total_weight, 2),
                    ),
                    "NumOfPieces" => $this->fields['NumOfPieces'],
                    "Package" => $package_all,
                ),
            ),
        );

        return $payload;
    }

    /* used for package shipment where Dimensions is greater than  total constraint of 165 inches (length + girth, where girth is 2 x width plus 2 x height) */

    public function processfreightRate($requestoption = "ground")
    {
        try {
            $version = "v1";

            if ($this->CI->config->item('shipping_mode') == "1") {
                $end_url = "https://onlinetools.ups.com/api/freight/" . $version . "/rating/" . $requestoption;
            } else {
                $end_url = "https://wwwcie.ups.com/api/freight/" . $version . "/rating/" . $requestoption;
            }
            $access_token = $this->generatetoken();
            if ($access_token['status'] == "approved") {
                $rateData = $this->getfreightraterequest();
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
                    CURLOPT_POSTFIELDS => json_encode($rateData),
                    CURLOPT_URL => $end_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                ]);

                $response = curl_exec($curl);
                $error = curl_error($curl);
                curl_close($curl);

                $ups_response = json_decode($response);

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

    public function generatetoken()
    {
        try {
            $curl = curl_init();
            $payload = "grant_type=client_credentials";
            if ($this->CI->config->item('shipping_mode') == "1") {
                $url = "https://onlinetools.ups.com/security/v1/oauth/token";
            } else {
                $url = "https://wwwcie.ups.com/security/v1/oauth/token";
            }

            $keys = $this->fields['userid'] . ":" . $this->fields['passwd'];
            curl_setopt_array($curl, [
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/x-www-form-urlencoded",
                    "x-merchant-id: string",
                    "Authorization: Basic " . base64_encode($keys),
                ],
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
            ]);
            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);
            $ups_response = json_decode($response);
            if ($ups_response->status == "approved") {
                return array("status" => $ups_response->status, "access_token" => $ups_response->access_token);
                $expire_time = date("m/d/Y h:i:s a", time() + $ups_response->expires_in);

                $this->session->set_userdata('ups_token_expires_in', $expire_time);
                $this->session->set_userdata('ups_access_token', $ups_response->access_token);

            } else {
                return array("status" => "fail", "error" => $ups_response);
            }
        } catch (Exception $ex) {
            return array("status" => "fail");
        }
    }

}
