<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
class Listexams  {

    
    function  __construct() {
        $CI =& get_instance();
	      $this->instan = $CI;
    }
   


    
  function getAddr($param) {
      $CI =& get_instance();
      $CI->load->model('register_model');

        $query =  $CI->register_model->getAddrs($param);
        foreach ($query as $row ) {
          echo $row->branchaddr;
        }

  }

  function getIdbranches($param) {
      $CI =& get_instance();
      $CI->load->model('register_model');

        $query =  $CI->register_model->getAddrs($param);
        foreach ($query as $row ) {
          $idbrand = $row->idbranches;
        }
        return $idbrand;

  }


  function getIdbranche($param) {
      $CI =& get_instance();
      $CI->load->model('register_model');

        $query =  $CI->register_model->getAddrs($param);
        foreach ($query as $row ) {
          $idbrand =  $row->idbranches;
        }

        return $idbrand;

  }

  function getAvailable($param) {
      $CI =& get_instance();
      $CI->load->model('register_model');

        $query =  $CI->register_model->getAvailable($param);
        return $query;
  }





















}
?>