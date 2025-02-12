<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UpsShipping
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

	public function processShipAccept()
	{
		try {

			if($this->CI->config->item('shipping_mode')=="1"){
			$endurl = "https://onlinetools.ups.com";
			} else {
			$endurl = "https://wwwcie.ups.com";
			}
			$curl = curl_init();
			$version = "v1";
			$requestoption = "Shop";
			$access_token = $this->generatetoken();
			if($access_token['status']=="approved"){
			$shipmentData = $this->getshipmentrequest();
			// echo "<pre>";
			// print_r($shipmentData);
			/* Curl start to call UPS shipping API */
			$shipping_mode = $this->CI->config->item('shipping_mode');
			if (empty($shipping_mode)) {
				$shipping_mode = 0;
			}
			$shipping_mode = ($shipping_mode == 1) ? 'production' : 'test';
			curl_setopt_array($curl, [
			CURLOPT_HTTPHEADER => [
			"Authorization: Bearer ".$access_token['access_token'],
            "Content-Type: application/json",
			"transId: string",
			"transactionSrc: testing"
			],
			CURLOPT_POSTFIELDS => json_encode($shipmentData),
			CURLOPT_URL => $endurl."/api/shipments/" . $version . "/ship?" . http_build_query($requestoption),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "POST",
			]);
			$response = curl_exec($curl);
			$error = curl_error($curl);
			curl_close($curl);
			/* Curl End */

			$ups_response = json_decode($response);
			if($ups_response->ShipmentResponse->Response->ResponseStatus->Description=="Success") {
			return array("status"=>"success","ups_response"=>$ups_response);
			} else {
			return array("status"=>"fail","error"=>$ups_response);
			}


		} else {
			return array("status"=>"fail");


		}
		
		} catch (Exception $ex) {
			return array("status"=>"fail");
		}
	}

	public function process_frieght_ShipAccept()
	{
		try {

			if($this->CI->config->item('shipping_mode')=="1"){
			$endurl = "https://onlinetools.ups.com";
			} else {
			$endurl = "https://wwwcie.ups.com";
			}
			$curl = curl_init();
			$version = "v1";
			$requestoption = $this->fields['freight_service_type'];
			$access_token = $this->generatetoken();
			if($access_token['status']=="approved"){
			$shipmentData = $this->get_freight_shipmentrequest();
			// echo "<pre>";
			// print_r($shipmentData);
			/* Curl start to call UPS shipping API */

			// echo $endurl."/api/freight/" . $version . "/shipments/" .$requestoption;
		
			curl_setopt_array($curl, [
			CURLOPT_HTTPHEADER => [
			"Authorization: Bearer ".$access_token['access_token'],
            "Content-Type: application/json",
			"transId: string",
			"transactionSrc: testing"
			],
			CURLOPT_POSTFIELDS => json_encode($shipmentData),
			CURLOPT_URL => $endurl."/api/freight/" . $version . "/shipments/" .$requestoption,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "POST",
			]);
			$response = curl_exec($curl);
			$error = curl_error($curl);
			curl_close($curl);
			/* Curl End */

			$ups_response = json_decode($response);

			if($ups_response->FreightShipResponse->Response->ResponseStatus->Description=="Success") {
			return array("status"=>"success","ups_response"=>$ups_response);
			} else {
			return array("status"=>"fail","error"=>$ups_response);
			}


		} else {
			return array("status"=>"fail");


		}
		
		} catch (Exception $ex) {
			return array("status"=>"fail");
		}
	}

    public function getshipmentrequest()
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
				"Description" => " ",
				"Packaging" => array(
				  "Code" => "02",
				  "Description" => "Packaging"
				),
				"Dimensions" => array(
				  "UnitOfMeasurement" => array(
					"Code" => "IN",
					"Description" => "IN"
				  ),
				  "Length" => (string)round($length,2),
				  "Width" => (string)round($width,2),
				  "Height" => (string)round($height,2)
				),
				"PackageWeight" => array(
				  "UnitOfMeasurement" => array(
					"Code" => "LBS",
					"Description" => "LBS"
				  ),
				  "Weight" => (string)round($weight,2)
				)
				);

			array_push($package_all,$package);
		}

		
		$payload = array(
			"ShipmentRequest" => array(
			  "Request" => array(
				"SubVersion" => "1801",
				"RequestOption" => "nonvalidate",
				"TransactionReference" => array(
				  "CustomerContext" => ""
				)
			  ),
			  "Shipment" => array(
				"Description" => $this->fields['shipper_description'],
				"Shipper" => array(
				  "Name" => $this->fields['shipper_name'],
				  "AttentionName" => $this->fields['shipper_name'],
				  "TaxIdentificationNumber" => "123456",
				  "Phone" => array(
					"Number" => $this->fields["shipper_number"],
					"Extension" => " "
				  ),
				  "ShipperNumber" => $this->fields['shipperNumber'],
				  "FaxNumber" => $this->fields["shipper_number"],
				  "Address" => array(
					"AddressLine" => $this->fields['shipper_addressline1']."".$this->fields['shipper_addressline2'],
					"City" => $this->fields['shipper_city'],
					"StateProvinceCode" => $this->fields['shipper_stateprovincecode'],
					"PostalCode" => $this->fields['shipper_postalcode'],
					"CountryCode" => $this->fields['shipper_countrycode']
				  )
				),
				"ShipTo" => array(
					"Name" => $this->fields['ShipTo_Name'],
					"Phone" => array(
						"Number" => $this->fields['ShipTo_phone']
					),
					"Address" => array(
					  "AddressLine" => $this->fields['ShipTo_AddressLine'],
					  "City" => $this->fields['ShipTo_City'],
					  "StateProvinceCode" => $this->fields['ShipTo_StateProvinceCode'],
					  "PostalCode" => $this->fields['ShipTo_PostalCode'],
					  "CountryCode" => $this->fields['ShipTo_CountryCode']
					)
				  ),
				"ShipFrom" => array(
					"Name" => $this->fields['shipper_name'],
					"Address" => array(
					  "AddressLine" =>$this->fields['shipper_addressline1']." ".$this->fields['shipper_addressline2'],
					  "City" => $this->fields['shipper_city'],
					  "StateProvinceCode" => $this->fields['shipper_stateprovincecode'],
					  "PostalCode" => $this->fields['shipper_postalcode'],
					  "CountryCode" => $this->fields['shipper_countrycode']
					)
				),
				"PaymentInformation" => array(
				  "ShipmentCharge" => array(
					"Type" => "01",
					"BillShipper" => array(
					  "AccountNumber" => $this->fields['shipperNumber']
					)
				  )
				),
				"Service" => array(
				  "Code" => $this->fields['Service_Code'],
				  "Description" => "Express"
				),
				"Package" => $package_all
			  ),
			  "LabelSpecification" => array(
				"LabelImageFormat" => array(
				  "Code" => "GIF",
				  "Description" => "GIF"
				),
				"HTTPUserAgent" => "Mozilla/4.5"
			  )
			)
		  );
		  
		  return  $payload;
	}

	public function get_freight_shipmentrequest()
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


				$package = array(
					"Description" => "Goods",
					"Weight" => array(
					  "UnitOfMeasurement" => array(
						"Code" => "LBS"
					  ),
					  "Value" => (string)round($weight,2)
					),
					"Dimensions" => array(
					  "UnitOfMeasurement" => array(
						"Code" => "IN"
					  ),
					  "Length" => (string)round($length,2),
					  "Width" => (string)round($width,2),
					  "Height" => (string)round($height,2)
					),
					"NumberOfPieces" => "1",
					"PackagingType" => array(
					  "Code" => "PKG"
					),
					"FreightClass" => "60"
				);







			array_push($package_all,$package);
		}

		
	        $payload = array(
			"FreightShipRequest" => array(
			  "Shipment" => array(
				"ShipFrom" => array(
					"Name" => $this->fields['shipper_name'],
					"Address" => array(
						"AddressLine" => $this->fields['shipper_addressline1']."".$this->fields['shipper_addressline2'],
						"City" => $this->fields['shipper_city'],
						"StateProvinceCode" => $this->fields['shipper_stateprovincecode'],
						"PostalCode" => $this->fields['shipper_postalcode'],
						"CountryCode" => $this->fields['shipper_countrycode'],
						"ResidentialAddressIndicator" => ""
					),
					"AttentionName" => $this->fields['shipper_attentionname'],
					"Phone" => array(
					"Number" => $this->fields['shipper_number'],
					"Extension" => "1"
					),
					"EMailAddress" => $this->fields["access"]
				),
				"ShipperNumber" => $this->fields['shipperNumber'],
				"ShipTo" => array(
					"Name" => $this->fields['ShipTo_Name'],
					"Address" => array(
					  "AddressLine" => $this->fields['ShipTo_AddressLine'],
					  "City" => $this->fields['ShipTo_City'],
					  "StateProvinceCode" => $this->fields['ShipTo_StateProvinceCode'],
					  "PostalCode" => $this->fields['ShipTo_PostalCode'],
					  "CountryCode" => $this->fields['ShipTo_CountryCode']
					),
					"AttentionName" => $this->fields['ShipTo_Name'],
					"Phone" => array(
					  "Number" => $this->fields['ShipTo_phone']
					)
				  ),
				"PaymentInformation" => array(
				  "Payer" => array(
					"Name" => $this->fields['shipper_name'],
					"Address" => array(
					  "AddressLine" => $this->fields['shipper_addressline1']."".$this->fields['shipper_addressline2'],
					  "City" => $this->fields['shipper_city'],
					  "StateProvinceCode" => $this->fields['shipper_stateprovincecode'],
					  "PostalCode" => $this->fields['shipper_postalcode'],
					  "CountryCode" => $this->fields['shipper_countrycode']
					),
					"ShipperNumber" => $this->fields['shipperNumber'],
					"AccountType" => "1",
					"AttentionName" => $this->fields['shipper_attentionname'],
					"Phone" => array(
					  "Number" => $this->fields['shipper_number']
					)
				  ),
				  "ShipmentBillingOption" => array(
					"Code" => "10"
				  )
				),
				"Service" => array(
				  "Code" => "308"
				),
				"HandlingUnitOne" => array(
					"Quantity" => "1",
					"Type" => array(
					  "Code" => "PLT"
					)
				 ),
				"Commodity" =>$package_all,
				"TimeInTransitIndicator" => ""
			  ),
			  "Miscellaneous" => array(
				"WSVersion" => "21.0.11",
				"ReleaseID" => "07.12.2008"
			  )
			)
		    );
		 
		  
		  return  $payload;
	}

	public function generatetoken()
	{
			try {	
			$curl = curl_init();
			$payload = "grant_type=client_credentials";
			if($this->CI->config->item('shipping_mode')=="1"){
			$url = "https://onlinetools.ups.com/security/v1/oauth/token";
			} else {
			$url = "https://wwwcie.ups.com/security/v1/oauth/token";
			}

			$keys = $this->fields['userid'].":".$this->fields['passwd'];
			curl_setopt_array($curl, [
			CURLOPT_HTTPHEADER => [
			"Content-Type: application/x-www-form-urlencoded",
			"x-merchant-id: string",
			"Authorization: Basic " . base64_encode($keys)
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
			if($ups_response->status=="approved") {
			  return array("status"=>$ups_response->status,"access_token"=>$ups_response->access_token);
			  $expire_time = date("m/d/Y h:i:s a", time() + $ups_response->expires_in);
			  
			  $this->session->set_userdata('ups_token_expires_in',$expire_time);
			  $this->session->set_userdata('ups_access_token',$ups_response->access_token);

			} else {
			  return array("status"=>"fail","error"=>$ups_response);
			}
			} catch (Exception $ex) {
				return array("status"=>"fail");
			}
	}
	
}
