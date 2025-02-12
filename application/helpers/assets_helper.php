<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function global_img_link($fileName, $place) {
    return base_url() . 'assets/' . $place . $fileName;
}

function global_fevicon_img_link() {
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('home_page');
    $CI->db->where('id', 1);
    $query = $CI->db->get();
    $result = $query->row_array();
    if (isset($result['fevicon']) && $result['fevicon'] != '') {
        $logo = global_img_link($result['fevicon'], 'uploads/logo/thumbnails/');
        return '<link rel="icon" href="' . $logo . '" type="image/png" />';
    } else {
        $logo = base_url('favicon.ico');
        return '<link rel="icon" href="' . $logo . '" type="image/x-icon" />';
    }
}

function get_file_lang($path, $name, $lang, $type) {
    if (file_exists(FCPATH . $path . $lang . '_' . $name)) {
        $url = asset_url() . $path . $lang . '_' . $name;
        if ($type == 'css')
            return '<link rel="stylesheet" type="text/css" href="' . $url . '">';
        if ($type == 'js')
            return '<script type="text/javascript" src="' . $url . '"></script>';
    }
}

//to define dynamic url based on local or cdn
function asset_url($url='') {
    /*
    Check for config var obfuscation.
    pleease add your filename to $notAffectedJS if you don't want to load obfuscated file
    */
    $ci = get_instance();
    $asset_url  = $ci->config->item('asset_url');
    $obfuscated = $ci->config->item('obfuscation');
    $notAffectedJS = array("jquery",".min.","bootstrap", "wos","datepicker","flipclock","jssor.slider-22.1.8.mini");
    if(stristr($url,"js") == True && $obfuscated == TRUE) {
        if (strlen(str_replace($notAffectedJS, '', $url)) == strlen($url)){
            $url=str_replace(".js",".obfuscated.js",$url);
        }
    }

    if(!empty($asset_url)) {
        return $asset_url.$url;
    } else {
        return $url;
    }
}
