<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
class Showuser  {

    
    function  __construct() {
        $CI =& get_instance();
	      $this->instan = $CI;
        $CI->load->library('encrypt');
    }
   


    
  function getAddr($param) {
      $CI =& get_instance();
      $CI->load->model('register_model');

        $query =  $CI->register_model->getAddrs($param);
        foreach ($query as $row ) {
          echo $row->branchaddr;
        }

  }


  function getnameaditionalinfo($table,$code) {
      $CI =& get_instance();
      $CI->load->model('app_model');

        $data['code'] = $code;
        $query =  $CI->app_model->getSelectedData($table, $data);
        
        if($query) {
          foreach ($query as $row ) {
            echo $row->name;
          }
        } else {
          echo '-';
        }
  }


  function getStatusUser($code) {
    $CI =& get_instance();
      $CI->load->model('app_model');

        $data['idroles'] = $code;
        $query =  $CI->app_model->getSelectedData('roles', $data);
        
        if($query) {
          foreach ($query as $row ) {
            echo $row->rolesname;
          }
        } else {
          echo '-';
        }
  }

  function getUsername($code) {
    $CI =& get_instance();
      $CI->load->model('app_model');

        $data['idusers'] = $code;
        $query =  $CI->app_model->getSelectedData('users', $data);
        
        if($query) {
          foreach ($query as $row ) {
            echo $row->userfirstname;
          }
        }
  }


  function getRolesss($code) {
    $CI =& get_instance();
      $CI->load->model('app_model');

        $data['idusers'] = $code;
        $query =  $CI->app_model->getSelectedData('users', $data);
        
      
          foreach ($query as $row ) {
            $roles =  $row->idroles;
            return $roles;
          }
    
  }


  function getNameUser($code) {
    $CI =& get_instance();
      $CI->load->model('app_model');

        $data['idusers'] = $code;
        $query =  $CI->app_model->getSelectedData('users', $data);
        
        if($query) {
          foreach ($query as $row ) {
            echo $row->userfirstname;
          }
        } else {
          echo '-';
        }
  }

  function decode($value) {
    $CI =& get_instance();
      $pass = $CI->encrypt->decode($value);
      echo $pass;
  }


  function getCountBooked($idschedules) {
      $CI =& get_instance();
      $CI->load->model('app_model');
        $query =  $CI->app_model->getCountBooked($idschedules);
        echo $query;
  }


  




}
?>