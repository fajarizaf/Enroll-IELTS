<?php ob_start(); ?><?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?><?phpclass Profile_model extends CI_Model {    function  __construct() {        parent::__construct();        $this->load->helper('form');        $this->load->library('showuser');        $this->load->library('generated_tanggal');    }    function adduser() {      $roles = $this->input->post('selectroles');      $title = $this->input->post('titleuser');      $username = $this->input->post('usernameuser');      $password = $this->input->post('passworduser');      $lastname = $this->input->post('lastnameuser');      $firstname = $this->input->post('firstnameuser');      $phonenumber = $this->input->post('phonenumberuser');      $emailaddress = $this->input->post('emailaddressuser');      $address = $this->input->post('address');      $city = $this->input->post('city');      $photo = $this->input->post('uploadfile');      $data = array(            'idroles' => $roles,            'usertitle' => $title,            'username' => $username,            'userpass' => $password,            'userfamilyname' => $lastname,            'userfirstname' => $firstname,            'userphone' => $phonenumber,            'useremail' => $emailaddress,            'useraddr1' => $address,            'useraddr3' => $city,            'userphoto' => $photo,            'created' => date("Y-m-d H:i:s"),            'userstatus' => '1',            'createdby' => $this->session->userdata('idusers')        );      $query = $this->db->insert('users', $data);      if($query) {        $result = array('status' => 'success');        echo '{"result":'.json_encode($result).'}';      }    }    function getUser($idusers,$limit,$offset)    {      $idroles = $this->session->userdata('statususer');        if($idroles == 1) {        $q = $this->db->query('select * from users  Order By idusers Desc LIMIT '.$offset.','.$limit.'');        return $q->result();        } else {        $q = $this->db->query('select * from users where createdby="'.$idusers.'" Order By idusers Desc LIMIT '.$offset.','.$limit.'');        return $q->result();          }    }    function getnewuser() {        $this->db->limit(1);        $this->db->order_by('idusers', 'DESC');        $query = $this->db->get('users');        return $query->result();    }    function filterByRoles($limit,$offset) {      $idusers = $this->session->userdata('idusers');      $roles = $this->input->post('selectroles');      $q = $this->db->query('select * from users where createdby="'.$idusers.'" and idroles="'.$roles.'" Order By idusers Desc LIMIT '.$offset.','.$limit.'');      return $q->result();    }    function filterByRolesPage($limit,$offset) {      $idusers = $this->session->userdata('idusers');      $roles = $this->uri->segment(3);      $q = $this->db->query('select * from users where createdby="'.$idusers.'" and idroles="'.$roles.'" Order By idusers Desc LIMIT '.$offset.','.$limit.'');      return $q->result();    }    public function count_users($idroles) {            $idusers = $this->session->userdata('idusers');            $query = $this->db->query('select * from users where createdby="'.$idusers.'" and idroles="'.$idroles.'"  ');             return $query->num_rows();     }    public function count_user() {            $idroles = $this->session->userdata('statususer');            $idusers = $this->session->userdata('idusers');            if($idroles == 1) {            $q = $this->db->query('select * from users');            return $q->num_rows();            } else {            $q = $this->db->query('select * from users where createdby="'.$idusers.'"');            return $q->num_rows();              }    }    public function filter() {            $search = $this->input->post('search');      $filterby = $this->input->post('searchby');      $idusers = $this->session->userdata('idusers');              if($this->session->userdata('statususer') == '1') {          $idroles = $this->input->post('idroles');        } elseif($this->session->userdata('statususer') == '2') {          $idroles = 'all';          }       if($filterby == 'idusers') {          if($idroles == 'all') {            $query = $this->db->query('select * from users where createdby="'.$idusers.'" and  '.$filterby.'="'.$search.'"');             return $query->result();          } else {            $query1 = $this->db->query('select * from users where createdby="'.$idusers.'" and idroles="'.$idroles.'" and '.$filterby.'="'.$search.'"');            return $query1->result();          }                    } else if($filterby == 'userfamilyname') {          if($idroles == 'all') {            $query2 = $this->db->query('select * from users where createdby="'.$idusers.'" and userfirstname like  "%'.$search.'" ');             return $query2->result();          } else {            $query3 = $this->db->query('select * from users where createdby="'.$idusers.'" and idroles="'.$idroles.'" and userfirstname like  "%'.$search.'" ');             return $query3->result();          }      }    }    function getedituser($idusers) {        $query = $this->db->query('select * from users where idusers="'.$idusers.'"');        return $query->result();    }    }?>