<?php ob_start() ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<?php


class Profile extends CI_Controller {


    public function  __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('profile_model');
        $this->load->model('app_model');
        $this->load->helper(array('form','url'));
        $this->load->library(array('table','form_validation'));
        $this->load->library('pagination');
        $this->load->library('showuser');
        $this->load->library('encrypt');
        $this->load->helper('text');      
    }



    public function index() {
      if($this->session->userdata('login') == 'true') {

        $cekHasRegistrations = $this->profile_model->cekhasregistrations($this->session->userdata('idusers'));

        if($cekHasRegistrations != 1 ) {
                $idroles = $this->session->userdata('statususer');
                $idusers['idusers'] = $this->session->userdata('idusers');
                $data['menuadmin'] = $this->user_model->menuadmin($idroles);
                $data['dataprofile'] = $this->app_model->getSelectedData('users',$idusers);
                $this->load->view('global/header', $data);
                $this->load->view('profile',$data);
                $this->load->view('global/footer');
                $this->load->view('widget/editprofile');

                          $data['country'] = $this->app_model->get_data('city');
                          $data['language'] = $this->app_model->get_data('language');
                          $data['sector'] = $this->app_model->get_data('sector');
                          $data['level'] = $this->app_model->get_data('level');
                          $data['question'] = $this->app_model->get_data('question'); 
                         $this->load->view('modal/list-city', $data);
                         $this->load->view('modal/list-state', $data);
                         $this->load->view('modal/list-language', $data);
                         $this->load->view('modal/ocupation-sector', $data);
                         $this->load->view('modal/ocupation-level', $data);      
                         $this->load->view('modal/question', $data); 
      } else {
                $idroles = $this->session->userdata('statususer');
                $data['menuadmin'] = $this->user_model->menuadmin($idroles);
                $this->load->view('global/header', $data);
                $this->load->view('disableprofile');
                $this->load->view('global/footer'); 
      }
      
    }
  }


    public function edit() {
      if($this->session->userdata('login') == 'true') {
        // cek user previliages
        $checkroles = $this->user_model->cek_roles($this->uri->segment(1));

          $idrule = $this->session->userdata('statususer');

          if($idrule == 1) {  
            if($checkroles == 1) {
                $idroles = $this->session->userdata('statususer');
                $idusers['idusers'] = $this->uri->segment(3);
                $data['menuadmin'] = $this->user_model->menuadmin($idroles);
                $data['dataprofile'] = $this->app_model->getSelectedData('users',$idusers);
                $this->load->view('global/header', $data);
                $this->load->view('profile',$data);
                $this->load->view('global/footer');
                $this->load->view('widget/editprofile');

                          $data['country'] = $this->app_model->get_data('city');
                          $data['language'] = $this->app_model->get_data('language');
                          $data['sector'] = $this->app_model->get_data('sector');
                          $data['level'] = $this->app_model->get_data('level');
                          $data['question'] = $this->app_model->get_data('question'); 
                         $this->load->view('modal/list-city', $data);
                         $this->load->view('modal/list-state', $data);
                         $this->load->view('modal/list-language', $data);
                         $this->load->view('modal/ocupation-sector', $data);
                         $this->load->view('modal/ocupation-level', $data);      
                         $this->load->view('modal/question', $data); 
           } else {
           redirect('register'); 
           }
        } else {
           redirect('register'); 
        }



      } else {
        redirect('register');
      }
    }


    public function updateprofile() {
      $this->profile_model->updateprofile();
    }




}


?>