<?php ob_start() ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<?php


class User extends CI_Controller {


    public function  __construct() {
        parent::__construct();
        $this->load->model('useradmin_model');
        $this->load->model('user_model');
        $this->load->model('app_model');
        $this->load->helper(array('form','url'));
        $this->load->library(array('table','form_validation'));
        $this->load->library('pagination');
        $this->load->helper('text');      
    }



    public function index() {

      if($this->session->userdata('login') == 'true') {

        // cek user previliages
        $checkroles = $this->user_model->cek_roles($this->uri->segment(1));

            if($checkroles == 1) {
                $idroles = $this->session->userdata('statususer');
                $where['createdby'] = $this->session->userdata('idusers');
                $data['menuadmin'] = $this->user_model->menuadmin($idroles);
                $data['user'] = $this->app_model->getSelectedData('users',$where);

                $this->load->view('global/header', $data);
                $this->load->view('user',$data);
                $this->load->view('global/footer');
                $this->load->view('widget/adduser');

           } else {
           redirect('register'); 
           }


      } else {
        redirect('register');
      }

    }



    public function filterByRoles() {
       $data['filter'] = $this->useradmin_model->filterByRoles();
       $this->load->view('filterRoles',$data);

    }



}


?>