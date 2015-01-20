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

                      if($row->userstatus == '0') {
                        $response = array('status' => 'notactivated');
                        echo '{"status":'.json_encode($response).'}';
                      } else {

                        $session_data = array (
                            'idusers' => $row->idusers,
                            'statususer' => $row->idroles,
                            'username' => $row->userfamilyname,
                            'images' => $row->userphoto,
                            'login' => 'true'
                        );
                        $this->session->set_userdata($session_data);

                        $response = array('status' => 'sukses','idroles' => $row->idroles);
                        echo '{"status":'.json_encode($response).'}';

                      }
                    }    

        } else {
                $response = array('status' => 'gagal');
                echo '{"status":'.json_encode($response).'}';
        }    
    }




    public function menuadmin($idroles) {
        $this->db->where('privileges.idroles', $idroles);
        $this->db->join('menus', 'menus.idmenu = privileges.idmenu');
        $this->db->group_by('seq');        
        return $this->db->get("privileges")->result();
    }


    public function getDataNotRegistered() {
       $idusers = $this->session->userdata('idusers');
       $idschedules = $this->uri->segment(3);


       $getUserRegistered = $this->db->query('select * from registrations where idschedules="'.$idschedules.'"');

       if($getUserRegistered->result()) {
           foreach ($getUserRegistered->result() as $row) {
               $user[] = $row->idusers;
               $im_user = implode(',',$user);
           }

           $getUserNotRegistered = $this->db->query('select * from users where createdby="'.$idusers.'" and idusers not in ('.$im_user.')'); 
           return $getUserNotRegistered->result();
       } else {
           $getUserNotRegistered = $this->db->query('select * from users where createdby="'.$idusers.'" '); 
           return $getUserNotRegistered->result();
       }
    }

    public function cek_roles($url) {

      $idroles =$this->session->userdata('statususer');

      $idmenu = $this->db->query('select * from menus where controllers="'.$url.'"');
      foreach ($idmenu->result() as $row) {
       $idmenus = $row->idmenu;

       $privileges = $this->db->query('select * from privileges where idroles="'.$idroles.'" and idmenu="'.$idmenus.'"');
       $result = $privileges->num_rows();
       return $result;
      }

    }

    public function getUserregistered($idschedules) {
        $this->db->where('idschedules', $idschedules);
        $query = $this->db->get('registrations');
        $count = $query->num_rows();
        echo $count;
    }

    
}

?>