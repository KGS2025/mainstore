<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Adminrole_model
 * This Class handle all functions related to admin_roles and admin_role_access  tables.
 */
class Adminrole_model extends CI_Model {
    
    /**
     * Method __construct
     * All models  those we need to use in the model are initialized in the constructor.
     * @return void
     */
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Method search_admin_role_data
     * This Function return rows of admin_roles table  according to offset and pagination.
     * @param $key $key [This parameter is the name of the role.]
     * @param $per_page $per_page [This Parameter is the limit  the pagination.]
     * @param $offset $offset [This Parameter is the offset of the pagination.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function search_admin_role_data($key, $per_page, $offset, $lang_id) {
        $this->db->select('a.*, ac.lang_role');
        if ($key != "") {
            $this->db->like('a.role', $key);
        }
        $this->db->from('admin_roles as a');
        $this->db->join('admin_roles_country as ac','a.id = ac.lang_id AND ac.country_id = '.$lang_id, 'LEFT');
        $this->db->limit($per_page, $offset);
        return $this->db->get()->result_array();
    }
        
    /**
     * Method getLanagugeAdminRoles
     * This Function return all admin roles with language data as per the key.
     * @param $key $key [This parameter is the name of the role.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    function getLanagugeAdminRoles($key, $lang_id) {
        $this->db->select('a.*, ac.lang_role');
        $this->db->like('ac.lang_role', $key);
        $this->db->from('admin_roles as a');
        $this->db->join('admin_roles_country as ac','a.id = ac.lang_id AND ac.country_id = '.$lang_id, 'LEFT');
        return $this->db->get()->result_array();
    }
        
    /**
     * Method getAdminRoleById
     * This Function return single  role with language data.
     * @param $table $table [This parameter is the  name of the table.] 
     * @param $id $id [This parameter is the role id.]
     * @param $lang_id $lang_id [This parameter is the country id for language data.]
     *
     * @return void
     */
    public function getAdminRoleById($table, $id, $lang_id) {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        $res = $query->row_array();
        $array = array();
        $r = $this->db->query("SELECT c.lang_role FROM admin_roles as a, admin_roles_country as c WHERE a.id=c.lang_id  AND a.id = '" . $res['id']."' AND c.country_id = '" . $lang_id."' ")->row_array();
        $array = array_merge($res, $r);
        return $array;
    }
    
    /**
     * Method deleteAllAdminRoles
     * This Function delete all roles and their related access and users.
     * @return void
     */
    function deleteAllAdminRoles() {
        $this->db->select('group_concat(id) as roleIds');
        $this->db->where('role !=', 'Administrator');
        $result = $this->db->get('admin_roles')->row_array();
        $roleIds = $result['roleIds'] ? array_filter(explode(',', $result['roleIds'])) : array();
        if(count($roleIds) > 0){
            $this->db->where_in('role_id',$roleIds);
            $this->db->delete('admin_users');

            $this->db->where_in('role_id',$roleIds);
            $this->db->delete('admin_role_access');

            $this->db->where_in('id',$roleIds);
            $this->db->delete('admin_roles');
        }
    }
    
    /**
     * Method deleteSelectedAdminRole
     * This Function delete single role and their related access and users. 
     * @param $id $id [This parameter is the role id.]
     *
     * @return bool
     */
    function deleteSelectedAdminRole($id) {
        $this->db->delete('admin_roles', array('id' => $id));
        $this->db->delete('admin_users', array('role_id' => $id));
        $this->db->delete('admin_role_access', array('role_id' => $id));
        return TRUE;
    }
    
    /**
     * Method getRoles
     * This Function return all rows of admin_roles table.
     * @return void
     */
    function getRoles() {
        $query = $this->db->get('admin_roles');
        return $query->result_array();
    }
    
    /**
     * Method updatePageAccess
     * This Function add access related to role id.
     * @param $postdata $postdata [This paramter is the array of post data.]
     * @param $id $id [This parameter is the role id.]
     * @param $action $action [This parameter is the action.]
     *
     * @return void
     */
    function updatePageAccess($postdata, $id, $action='add') {
        if(count($postdata) > 0){
            if($action == 'edit'){
                $this->db->delete('admin_role_access', array('role_id' => $id));
            }

            $insertData = array();
            foreach ($postdata as $d) {
                // this function iterate each post variable and accoring to condition make data to inser in the database
                $data = array();
                $data['role_id']  = $id;
                $data['page']     = $d['page'];
                $data['pagename'] = $d['pagename'];

                if (isset($d['page_access']) && $d['page_access'] == 1) {
                    $data['page_access'] = 1;
                } else {
                    $data['page_access'] = 0;
                }

                if (isset($d['page_add']) && $d['page_add'] == 1) {
                    $data['page_add'] = 1;
                } else {
                    $data['page_add'] = 0;
                }

                if (isset($d['page_edit']) && $d['page_edit'] == 1) {
                    $data['page_edit'] = 1;
                } else {
                    $data['page_edit'] = 0;
                }

                if (isset($d['page_delete']) && $d['page_delete'] == 1) {
                    $data['page_delete'] = 1;
                } else {
                    $data['page_delete'] = 0;
                }

                $insertData[] = $data;
            }

            if(count($insertData) > 0){
                // this function add role access in admin_role_access table
                $this->db->insert_batch('admin_role_access', $insertData);
            }
        }
    }
    
    /**
     * Method getRoleAccess
     * This Fuinction return all role access as per the role id.
     * @param $id $id [This parameter is the role id.]
     *
     * @return void
     */
    function getRoleAccess($id) {
        $this->db->order_by('pagename','ASC');
        $q = $this->db->get_where('admin_role_access', array('role_id' => $id));
        return $q->result_array();
    }

    /**
     * Method getalladminroles
     *
     * @param $lang_id $lang_id [explicite description]
     *
     * @return void
     */
    function getalladminroles($lang_id) {
        $this->db->select('a.*, ac.lang_role');
        $this->db->from('admin_roles as a');
        $this->db->join('admin_roles_country as ac','a.id = ac.lang_id AND ac.country_id = '.$lang_id, 'LEFT');
        return $this->db->get()->result_array();
    }

}