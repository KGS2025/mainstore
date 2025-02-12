<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define('BASE_IMG_PATH',	$_SERVER['DOCUMENT_ROOT']);
define('KGT_REFERENCE_NUMBER',	'kgt_ref_number');
define('VEHICLE_CATEGORY',	'vehicle_category_id');
define('MAKER',	'maker_id');
define('MODEL',	'model_id');
define('PRODUCT_TYPE',	'product_type_id');
define('DRAWING_PHOTO',	'drawing_photo');
define('PRODUCT_PHOTO',	'product_photo');
define('VEHICLE_PHOTO',	'vehicle_photo');
define('VEHICLE_BRAND_LOGO', 'vehicle_brand_logo');
define('VEHICLE_CATEGORY_GENERIC_PHOTO', 'vehicle_category_photo');
define('PRODUCT_TYPE_GENERIC_PHOTO', 'product_type_photo');
define('KNECT',	'knect');
define('FILTRON',	'filtron');
define('PURFLUX',	'purflux');
define('MANN',	'mann');
define('MECAFILTER',	'mecafilter');
define('OEM_PART_NUMBER',	'oem_part_number');
define('APPLICATION',	'application');
define('FLEET',	'fleet');
define('BALDWIN',	'baldwin');
define('OTHERS',	'others');
define('FMSI_REFERENCE_NUMBER',	'fmsi_ref_number');
define('YEAR',	'year');
define('FRONT_REAR',	'front_rear');
define('DESIGNATION',	'designation');
define('WVA',	'wva');
define('QTY',	'qty');
define('DIAMETER',	'diameter');
define('WIDTH',	'width');
define('HOLES_NO',	'holes_no');
define('PAGINATION_LIMIT',	3);
define('PAGINATION_LIMIT_PRODUCT_LIST',	100);
define('PAGINATION_LIMIT_PRODUCT_LIST_FIRST_PAGE',	200);