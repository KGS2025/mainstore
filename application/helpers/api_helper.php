<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function getAramexShippingRate($cart_users_data, $package, $apiData)
{

	$ci = &get_instance();
	$totalWeight = array_sum(array_column($package, 'weight'));
	$weight_unit = $ci->config->item('weight_unit');

	if(strtoupper($cart_users_data['ship_country_flag']) =="TN") {
	$service = "DOM";
	$P_type = "ONP";
	} else {
	$service = "EXP";
	$P_type = "PPX";
	}
	$params = array(
		'ClientInfo'  => array(
			'AccountCountryCode'	=> $apiData['account_country_code'],
			'AccountEntity'		 	=> $apiData['account_entity'],
			'AccountNumber'		 	=> $apiData['account_number'],
			'AccountPin'		 	=> $apiData['account_pin'],
			'UserName'			 	=> $apiData['user_name'],
			'Password'			 	=> $apiData['password'],
			'Version'			 	=> $apiData['version']
		),

		'Transaction' => array(
			'Reference1' => '001'
		),

		'OriginAddress' => array(
			'City'					=> $apiData['shipper_city'],
			'StateOrProvinceCode'	=> $apiData['shipper_stateprovincecode'],
			'PostCode'				=> $apiData['shipper_postalcode'],
			'CountryCode'			=> $apiData['shipper_countrycode']
		),

		'DestinationAddress' => array(
			'City'					=> $cart_users_data['ship_city'],
			'StateOrProvinceCode'	=> $cart_users_data['ship_state'],
			'PostCode'				=> str_replace(" ","",$cart_users_data['ship_zip']),
			'CountryCode'			=> strtoupper($cart_users_data['ship_country_flag']) 
		),

		'ShipmentDetails'	=> array(
			'PaymentType'		=> 'P', // Postpaid shipment for Tunsia (Pay after service is done). Global = P and C (Prepaid (Cash) pau efore the service done)
			'ProductGroup'		=> $service, // for within Tunisia we have only "DOM". For the rest we have ONLY "EXP"
			'ProductType'		=> $P_type, //ONP (Overnight parcel) ,FIX (TBA),BLK (TBA) this valus used in tunisia. It will be as per the contarct signed between Aramex and the end user. 
			'ActualWeight' 		=> array('Value' => $totalWeight, 'Unit' => $weight_unit), // the actual weight  for the shipment (either 1 or n boxes)
			'ChargeableWeight' 	=> array('Value' => $totalWeight, 'Unit' => $weight_unit), // This would be automatically caluclated
			'NumberOfPieces'	=> count($package) // number of boxes (either 1 or n boxes)
		)
	);

	//echo '<pre>';print_r($params);echo '</pre>';
	
	$shipping_mode = $ci->config->item('shipping_mode');
	if (empty($shipping_mode)) {
	$shipping_mode = 0;
	}
	if($shipping_mode == 1) {
		$soapClient = new SoapClient('https://ws.aramex.net/ShippingAPI.V2/RateCalculator/Service_1_0.svc?wsdl', array('trace' => 1));
	} else {
		$soapClient = new SoapClient('https://ws.dev.aramex.net/ShippingAPI.V2/RateCalculator/Service_1_0.svc?wsdl', array('trace' => 1));
	}

	
	 // LIVE DEL .DEV
	try {
		$auth_call = $soapClient->CalculateRate($params);
		return $auth_call;
	} catch (SoapFault $fault) {
		$errors = array('HasErrors' => 1, 'Notifications' => array('Code' => '1234', 'Message' => 'Api service url is failed to load.'));
		return (object)$errors;
	}
}

function exchangeRage($value,$curr1,$curr2){

	$ci = &get_instance();
	// Your Open Exchange Rates API key
	$apiKey = $ci->config->item('open_exchange_rate_api_key');

	// API endpoint for the latest exchange rates
	$apiUrl = "https://openexchangerates.org/api/latest.json?app_id=".$apiKey;

	// Initialize cURL session
	$ch = curl_init();

	// Set the URL and other options for the cURL session
	curl_setopt($ch, CURLOPT_URL, $apiUrl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	// Execute the cURL session and get the response
	$response = curl_exec($ch);
	$new_amount = 0;
	// Check for cURL errors
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	} else {
		// Decode the JSON response
		$exchangeRates = json_decode($response, true);

		// Check if the response contains the rates
		if (isset($exchangeRates['rates'])) {
			if($curr1!="USD" && $curr2=="USD"){
				$new_amount = $value/$exchangeRates['rates'][$curr1];
			}else if ($curr1 == $curr2){
				$new_amount = $value;
			}else{
				$new_amount = $value*$exchangeRates['rates'][$curr2]/$exchangeRates['rates'][$curr1];
			}
			// echo "Exchange rates fetched successfully:\n";
			// print_r($exchangeRates['rates']);
		} else {
			// echo "Exchange rate error";
		}
	}

	// Close the cURL session
	curl_close($ch);
	return $new_amount;
}

function cancelShippmentForAramex($tracking_number,$apiData){
	$ci = &get_instance();

	$params = array(
		'ClientInfo'  			=> array(
			'AccountCountryCode'	=> $apiData['account_country_code'],
			'AccountEntity'		 	=> $apiData['account_entity'],
			'AccountNumber'		 	=> $apiData['account_number'],
			'AccountPin'		 	=> $apiData['account_pin'],
			'UserName'			 	=> $apiData['user_name'],
			'Password'			 	=> $apiData['password'],
			'Version'			 	=> $apiData['version']
		),

		'Transaction' 			=> array(
			'Reference1'			=> '001',
			'Reference2'			=> '',
			'Reference3'			=> '',
			'Reference4'			=> '',
			'Reference5'			=> '',
		),
		'ShipmentHolds'				=> array(
			array(
				'ShipmentNumber'	=> $tracking_number,
				'Comment'			=> 'Cancel Order'
			)
		)
	);
	$shipping_mode = $ci->config->item('shipping_mode');
	if($shipping_mode == 1) {
		$soapClient = new SoapClient('https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc?wsdl');
	} else {
		$soapClient = new SoapClient('https://ws.dev.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc?wsdl');
	}

	try {
		//echo '<pre>';print_r($params);echo '<pre>';
		$auth_call = $soapClient->HoldShipments($params);

		// echo "respoce <br><pre>";
		// print_r($auth_call);
		// die();
		return $auth_call;
	} catch (SoapFault $fault) {
		$errors = array('HasErrors' => 1, 'Notifications' => array('Code' => '1234', 'Message' => 'Api service url is failed to load.'));
		return (object)$errors;
		//die('Error : ' . $fault->faultstring);
	}
}

function createShippmentForAramex($cart_users_data, $packages, $apiData)
{
	$ci = &get_instance();
	$volume_unit = $ci->config->item('volume_unit');
	$weight_unit = $ci->config->item('weight_unit');
	$dimension = array();
	

	$shipping_currency = getDefaultCurrencyCode();


	if(strtoupper($cart_users_data['ship_country_flag']) =="TN") {
		$service = "DOM";
		$P_type = "ONP";
		} else {
		$service = "EXP";
		$P_type = "PPX";
		}

	foreach ($packages as $package) {


		$length = $package['length'];
		$width = $package['width'];
		$height = $package['height'];

		if ($volume_unit == "INCH") {

			$length = $package['length'] * 2.54;
			$width = $package['width'] * 2.54;
			$height = $package['height'] * 2.54;
		}

		$dimension[] = array(
			'Length'				=> $length,
			'Width'					=> $width,
			'Height'				=> $height,
			'Unit'					=> "CM",

		);
	}
	// $length = $dimensions['length'];
	// $width = $dimensions['width'];
	// $height = $dimensions['height'];

	// if ($volume_unit == "INCH") {

	// 	$length = $dimensions['length'] * 2.54;
	// 	$width = $dimensions['width'] * 2.54;
	// 	$height = $dimensions['height'] * 2.54;
	// }
	$totalWeight = array_sum(array_column($packages, 'weight'));


	$params = array(
		'Shipments' => array(
			'Shipment' => array(
				'Shipper'	=> array(
					'Reference1' 	=> 'Ref 111111',
					'Reference2' 	=> 'Ref 222222',
					'AccountNumber' => $apiData['account_number'],
					'PartyAddress'	=> array(
						'Line1'					=> $apiData['shipper_addressline1'],
						'Line2' 				=> $apiData['shipper_addressline2'],
						'Line3' 				=> '',
						'City'					=> $apiData['shipper_city'],
						'StateOrProvinceCode'	=> $apiData['shipper_stateprovincecode'],
						'PostCode'				=> $apiData['shipper_postalcode'],
						'CountryCode'			=> $apiData['shipper_countrycode']
					),
					'Contact'		=> array(
						'Department'			=> $apiData['shipper_department'],
						'PersonName'			=> $apiData['shipper_name'],
						'Title'					=> $apiData['shipper_title'],
						'CompanyName'			=> $apiData['shipper_company_name'],
						'PhoneNumber1'			=> $apiData['shipper_phone1'],
						'PhoneNumber1Ext'		=> $apiData['shipper_phone1_ext'],
						'PhoneNumber2'			=> $apiData['shipper_phone2'],
						'PhoneNumber2Ext'		=> $apiData['shipper_phone2_ext'],
						'FaxNumber'				=> $apiData['shipper_fax_number'],
						'CellPhone'				=> $apiData['shipper_number'],
						'EmailAddress'			=> $apiData['shipper_email_id'],
						'Type'					=> ''
					),
				),

				'Consignee'	=> array(
					'Reference1'	=> 'Ref 333333',
					'Reference2'	=> 'Ref 444444',
					'AccountNumber' => '',
					'PartyAddress'	=> array(
						'Line1'					=> $cart_users_data['ship_address_1'],
						'Line2'					=> $cart_users_data['ship_address_2'],
						'Line3'					=> $cart_users_data['ship_address_3'],
						'City'					=> $cart_users_data['ship_city'],
						'StateOrProvinceCode'	=> $cart_users_data['ship_state'],
						'PostCode'				=> str_replace(" ","",$cart_users_data['ship_zip']),
						'CountryCode'			=> strtoupper($cart_users_data['ship_country_shortcode']) // 'TN' 
					),
					'Contact'		=> array(
						'Department'			=> '',
						'PersonName'			=> $cart_users_data['ship_surname'],
						'Title'					=> $cart_users_data['ship_title'],
						'CompanyName'			=> $cart_users_data['company'] ? $cart_users_data['company'] : 'test',
						'PhoneNumber1'			=> $cart_users_data['country_code'] . $cart_users_data['telephone'],
						'PhoneNumber1Ext'		=> '',
						'PhoneNumber2'			=> '',
						'PhoneNumber2Ext'		=> '',
						'FaxNumber'				=> '',
						'CellPhone'				=> $cart_users_data['country_code'] . $cart_users_data['telephone'],
						'EmailAddress'			=> $cart_users_data['email'],
						'Type'					=> ''
					),
				),

				'ThirdParty' => array(
					'Reference1' 	=> '',
					'Reference2' 	=> '',
					'AccountNumber' => '',
					'PartyAddress'	=> array(
						'Line1'					=> '',
						'Line2'					=> '',
						'Line3'					=> '',
						'City'					=> '',
						'StateOrProvinceCode'	=> '',
						'PostCode'				=> '',
						'CountryCode'			=> ''
					),
					'Contact'		=> array(
						'Department'			=> '',
						'PersonName'			=> '',
						'Title'					=> '',
						'CompanyName'			=> '',
						'PhoneNumber1'			=> '',
						'PhoneNumber1Ext'		=> '',
						'PhoneNumber2'			=> '',
						'PhoneNumber2Ext'		=> '',
						'FaxNumber'				=> '',
						'CellPhone'				=> '',
						'EmailAddress'			=> '',
						'Type'					=> ''
					),
				),

				'Reference1' 				=> 'Shpt 0001',
				'Reference2' 				=> '',
				'Reference3' 				=> '',
				'ForeignHAWB'				=> '',
				'TransportType'				=> 0,
				'ShippingDateTime' 			=> time(),
				'DueDate'					=> time(),
				'PickupLocation'			=> 'Reception',
				'PickupGUID'				=> '',
				'Comments'					=> 'Shpt 0001',
				'AccountingInstrcutions' 	=> '',
				'OperationsInstructions'	=> '',

				'Details' => array(
					'ActualWeight' => array(
						'Value'					=> $totalWeight,
						'Unit'					=> $weight_unit
					),
					'ProductGroup' 			=> $service,
					'ProductType'			=> $P_type,
					'PaymentType'			=> 'P',
					'PaymentOptions' 		=> '',
					'Services'				=> '',
					'NumberOfPieces'		=> count($packages),
					'DescriptionOfGoods' 	=> ' Products',
					'GoodsOriginCountry' 	=> $apiData['shipper_countrycode'],
					'CashOnDeliveryAmount' 	=> array(
						'Value'					=> 0,
						'CurrencyCode'			=> ''
					),
					'InsuranceAmount'		=> array(
						'Value'					=> 0,
						'CurrencyCode'			=> ''
					),
					'CollectAmount'			=> array(
						'Value'					=> 0,
						'CurrencyCode'			=> ''
					),
					'CashAdditionalAmount'	=> array(
						'Value'					=> 0,
						'CurrencyCode'			=> ''
					),
					'CashAdditionalAmountDescription' => '',
					'CustomsValueAmount' => array(
						'Value'					=> $cart_users_data['amount'],
						'CurrencyCode'			=> strtoupper($shipping_currency)
					),
					'Items' => array()
				),
			),
		),

		'ClientInfo'  			=> array(
			'AccountCountryCode'	=> $apiData['account_country_code'],
			'AccountEntity'		 	=> $apiData['account_entity'],
			'AccountNumber'		 	=> $apiData['account_number'],
			'AccountPin'		 	=> $apiData['account_pin'],
			'UserName'			 	=> $apiData['user_name'],
			'Password'			 	=> $apiData['password'],
			'Version'			 	=> $apiData['version']
		),

		'Transaction' 			=> array(
			'Reference1'			=> '001',
			'Reference2'			=> '',
			'Reference3'			=> '',
			'Reference4'			=> '',
			'Reference5'			=> '',
		),
		'LabelInfo'				=> array(
			'ReportID' 				=> 9732,
			'ReportType'			=> 'URL',
		),
	);



	$items = array();
	$additionalProperties = array(
		array(
			"CategoryName" => "CustomsClearance",
			"Name" => "InvoiceNumber",
			"Value" => $cart_users_data['order_number']
		),
		array(
			"CategoryName" => "CustomsClearance",
			"Name" => "InvoiceDate",
			"Value" => Date("d/m/Y")
		),
		array(
			"CategoryName" => "CustomsClearance",
			"Name" => "ShipperTaxIdVATEINNumber",
			"Value" => $ci->config->item('shipper_tax_vat_id')
		),
		array(
			"CategoryName" => "CustomsClearance",
			"Name" => "ExporterType",
			"Value" => "UT"
		)
	);
	$item_count = 0;
	foreach ($packages as $singlePackage) {
		$item_count++;
		$single_item = array(
			'PackageType' 	=> 'Box',
			'Quantity'		=> 1,
			'Weight'		=> array(
				'Value'		=> $singlePackage['weight'],
				'Unit'		=> $weight_unit,
			),
			'Comments'		=> $singlePackage['package_name'],
			'Reference'		=> $singlePackage['package_name'],
			'GoodsDescription' => $item_count.'-'.$singlePackage['package_name'],
			"CommodityCode" => $item_count.'-'.$singlePackage['package_name']
		);

		$items[] = $single_item;
	}
	$params['Shipments']['Shipment']['Details']['Items'] = $items;
	$params['Shipments']['Shipment']['Details']['AdditionalProperties'] = $additionalProperties;


	$shipping_mode = $ci->config->item('shipping_mode');
	if (empty($shipping_mode)) {
	$shipping_mode = 0;
	}

	if($shipping_mode == 1) {
		$soapClient = new SoapClient('https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc?wsdl');
	} else {
		$soapClient = new SoapClient('https://ws.dev.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc?wsdl');
	}


	try {
		$auth_call = $soapClient->CreateShipments($params);

		// echo "respoce <br>";
		// print_r($auth_call);
		// die();
		return $auth_call;
	} catch (SoapFault $fault) {
		$errors = array('HasErrors' => 1, 'Notifications' => array('Code' => '1234', 'Message' => 'Api service url is failed to load.'));
		return (object)$errors;
		//die('Error : ' . $fault->faultstring);
	}
}
