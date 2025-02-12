<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Cutom Logging Class
 * This class handle custom logs for the application. This will be used only for application level debugging.
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Logging
 * @author		Kondarsoft Dev Team
 * 
 */

class CustomLog
{

    var $CI;
    var $api_error;

    /**
     * Method __construct
     * This function called the the codeginter make instance.
     * @return void
     */
    function __construct()
    {

        $this->CI = &get_instance();
    }


    /**
     * Method write_log
     * This Function create log file and apped the string mention in the first paramter.
     * @param $msg $msg [This is the string that we need to add in the log file.]
     * @param $directory $directory [This is the name of the module like cron,payment etc.]
     *
     * @return void
     */
    public function write_log($msg, $directory = "cron")
    {


        // define the path of the file
        $file =  APPPATH . 'logs/' . date('Y') . '/' . date('m') . '/' . date('d') . "/" . $directory . "/" . $directory . '.log';


        // Below code create directories to create the new file 
        if (!file_exists(APPPATH . 'logs/')) {
            mkdir(APPPATH . 'logs/', 0777, true);
        }

        if (!file_exists(APPPATH . 'logs/' . date('Y'))) {
            mkdir(APPPATH . 'logs/' . date('Y'), 0777, true);
        }

        if (!file_exists(APPPATH . 'logs/' . date('Y') . '/' . date('m'))) {
            mkdir(APPPATH . 'logs/' . date('Y') . '/' . date('m'), 0777, true);
        }


        if (!file_exists(APPPATH . 'logs/' . date('Y') . '/' . date('m') . '/' . date('d'))) {
            mkdir(APPPATH . 'logs/' . date('Y') . '/' . date('m') . '/' . date('d'), 0777, true);
        }

        if (!file_exists(APPPATH . 'logs/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $directory)) {
            mkdir(APPPATH . 'logs/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $directory, 0777, true);
        }

        // Below code create the new file or read the existing file 
        if (!$fp = @fopen($file, FOPEN_WRITE_CREATE)) {
            return FALSE;
        }
        $message  = '';
        $message .= $msg . "\n";
        // below code append the string passed in the log file
        flock($fp, LOCK_EX);
        fwrite($fp, $message);
        flock($fp, LOCK_UN);
        fclose($fp);
        @chmod($file, FILE_WRITE_MODE);
        return $file;
    }
}
