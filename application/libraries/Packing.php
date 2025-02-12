<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Packing
 * This Class is used for the packing api. https://www.3dbinpacking.com
 */
class Packing
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
	 * Method processAPI
	 * This Function hit the api and return the result accordingly. 
	 * @return void
	 */
	public function processAPI()
	{
		try {			
					
			
			
			$packData = $this->getPackData();
			// $packData['bins'] = $packData2['bins'];
			// $packData['items'] = $packData2['items'];
			// echo "<pre>";
			// print_r($packData);
			// echo "</pre>";
			
			$packData = json_encode($packData);
			//echo $packData;
			/* Curl start to call UPS rating API */
			$url = "http://global-api.3dbinpacking.com/packer/packIntoMany";
			$prepared_query = 'query=' . $packData;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $prepared_query);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$resp = curl_exec($ch);

			if (!($resp = curl_exec($ch))) {
				die(date('[Y-m-d H:i e] ') . "Got " . curl_error($ch) . " when processing data");
				curl_close($ch);
				exit;
			}
			curl_close($ch);		

			$response = json_decode($resp, true);
			// echo "<pre>";
			// print_r($response);
			// exit;

			if ($response['response']['status'] > -1) {
				return array($response, 200);
			} else {
				return array($response, 403);
			}
		} catch (Exception $ex) {
			return array($ex, 403);
		}
	}

	/**
	 * Method getPackData
	 * This Function return all request parameters.
	 * @return void
	 */
	private function getPackData()
	{
		$data = array(
			'bins' => $this->fields['boxes'],
			'items' => $this->fields['items'],
			'username' => $this->fields['username'],
			'api_key' => $this->fields['api_key'],
			'params' => array(
				'images_background_color' => '255,255,255',
				'images_bin_border_color' => '59,59,59',
				'images_bin_fill_color' => '230,230,230',
				'images_item_border_color' => '214,79,79',
				'images_item_fill_color' => $this->fields['images_item_fill_color'],
				'images_item_back_border_color' => '215,103,103',
				'images_sbs_last_item_fill_color' => '99,93,93',
				'images_sbs_last_item_border_color' => '145,133,133',
				'images_width' => '100',
				'images_height' => '100',
				'images_source' => 'file',
				'images_sbs' => '1',
				'stats' => '1',
				'item_coordinates' => '1',
				'images_complete' => '1',
				'images_separated' => '1'
			)
		);
		return $data;
	}

	
	/**
	 * Method hex2rgb
	 * This Function convert Hex color to the rgb.
	 * @param $colour $colour [Hexa color code]
	 *
	 * @return void
	 */
	public function  hex2rgb($colour)
	{
		if ($colour[0] == '#') {
			$colour = substr($colour, 1);
		}
		if (strlen($colour) == 6) {
			list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
		} elseif (strlen($colour) == 3) {
			list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
		} else {
			return false;
		}
		$r = hexdec($r);
		$g = hexdec($g);
		$b = hexdec($b);
		return $r.",".$g.",".$b;
	}
}
