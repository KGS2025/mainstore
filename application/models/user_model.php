<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * User_model
 *  This Class handle all functions related to api used in the system. Following tables are used users.
 */
class User_model extends CI_Model
{

    /**
     * Method __construct
     * All models  those we need to use in the model are initialized in the constructor.
     * @return void
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Method checkUserExist
     * This Function will check if user exist or not in users table.
     * @return void
     */
    function checkUserExist($postData)
    {
        $this->db->where('email', $postData['email']);
        $this->db->or_where("(telephone = " . $postData['telephone'] . " AND country_code = " . $postData['country_code'] . ")", NULL, FALSE);
        $this->db->from('users');
        return $this->db->get()->num_rows();
    }



    /**
     * Method emailphoneExist
     * This Function will check if user exist or not in users table.
     * @return void
     */
    function emailphoneExist($postData)
    {
        $this->db->where('email', $postData['email']);
        $this->db->where("(telephone = " . $postData['telephone'] . " AND country_code = " . $postData['country_code'] . ")", NULL, FALSE);
        if ($postData['user_id']) {
            $this->db->where('id !=',$postData['user_id']);
        }
        $this->db->from('users');
        return $this->db->get()->num_rows();
    }


    /**
     * Method checkRefferalExist
     * This Function will check if Refferal users exist or not in users table.
     * @return void
     */
    function checkRefferalExist($postData)
    {
        $this->db->where('email', $postData['email']);
        $this->db->or_where("(telephone = " . $postData['telephone'] . " AND country_code = " . $postData['country_code'] . ")", NULL, FALSE);
        $this->db->from('refferal_users');
        return $this->db->get()->num_rows();
    }
}
