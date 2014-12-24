<?php ob_start(); ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

class   User_model extends CI_Model {


    function  __construct() {
        parent::__construct();
        $this->load->helper('form');
    }


    public function login ($username, $password) {
        $this->db->select('*');
        $this->db->where('username', $username);
        $this->db->where('userpass', $password);
        $query = $this->db->get('users');
        
                        
        if($query->num_rows() == 1) {

                    foreach ($query->result() as $row) {
                        $session_data = array (
                            'idusers' => $row->idusers,
                            'statususer' => $row->idroles,
                            'username' => $row->userfamilyname,
                            'images' => $row->userphoto,
                            'login' => 'true'
                        );
                        $this->session->set_userdata($session_data);
                        
                        $response = array('status' => $row->idroles);
                        echo json_encode($response);
                    }    

        } else {
                $response = array('status' => 'gagal');
                echo json_encode($response);
        }    
    }




    public function menuadmin($idroles) {
        $this->db->where('privileges.idroles', $idroles);
        $this->db->join('menus', 'menus.idmenu = privileges.idmenu');
        $this->db->group_by('seq');        
        return $this->db->get("privileges")->result();
    }


    
}

?>