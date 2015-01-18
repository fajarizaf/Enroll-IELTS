<?php ob_start() ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<?php


class Partner extends CI_Controller {


    public function  __construct() {
        parent::__construct();
        $this->load->model('partner_model');
        $this->load->model('user_model');
        $this->load->model('app_model');
        $this->load->helper(array('form','url'));
        $this->load->library(array('table','form_validation'));
        $this->load->library('pagination');
        $this->load->library('showuser');
        $this->load->library('encrypt');
        $this->load->helper('text');      
    }



    public function index($offset = NULL) {

            $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(3);}

            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'partner/page/';
            $config['total_rows'] = $this->partner_model->count_partner();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';



      if($this->session->userdata('login') == 'true') {
        // cek user previliages
        $checkroles = $this->user_model->cek_roles($this->uri->segment(1));

            if($checkroles == 1) {
                $idroles = $this->session->userdata('statususer');
                $where['partnerstatus'] = 1;
                $data['partner'] = $this->app_model->getSelectedData('partners',$where);
                $data['menuadmin'] = $this->user_model->menuadmin($idroles);
                $data['datapartner'] = $this->partner_model->getPartner($limit,$offset);
                $this->pagination->initialize($config);

                $this->load->view('global/header', $data);
                $this->load->view('partner',$data);
                $this->load->view('widget/addpartner',$data);
                $this->load->view('widget/editpartner');
                $this->load->view('global/footer');

           } else {
           redirect('register'); 
           }


      } else {
        redirect('register');
      }

    }



     public function page($offset = NULL) {

            $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(3);}

            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'partner/page/';
            $config['total_rows'] = $this->partner_model->count_partner();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';


                $data['datapartner'] = $this->partner_model->getPartner($limit,$offset);
                $this->pagination->initialize($config);

                $this->load->view('refresh',$data);
    }


    public function getTestschedule() {
      $this->schedule_model->getTestschedule();
    }


    public function addpartner() {
        $this->partner_model->addpartner();
    }

    public function refreshList($offset = NULL) {
      $limit = 10;
       if( is_null ($offset)) { $offset = 0; } else {$offset = $this->uri->segment(3);}

            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'partner/page/';
            $config['total_rows'] = $this->partner_model->count_partner();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';
      
      $data['datapartner'] = $this->partner_model->getPartner($limit,$offset);
      $this->pagination->initialize($config);
      $this->load->view('refresh',$data);
    }




    function getUpdateTest() {
      $query = $this->test_model->getupdatetest(); ?>

     <?php 
      $i = 1;  
      foreach ( $query as $row ) { ?>   
      
        <td><?php echo $row->branchname ?></td>
        <td><?php echo $row->branchphone ?></td>
        <td><?php echo $row->branchaddr ?></td>
        <td><div url="<?php echo base_url() ?>test/edittest/<?php echo $row->idbranches; ?>" href="#edittest" data-toggle="modal" class="iconedit"></div></td>
        <td><div value="<?php echo $row->idbranches; ?>"  class="icondelete"></div></td>

          <?php $i++ ?>
     <?php } ?>

     <?php
    }



    function edittest() {
        $data['datatest'] = $this->test_model->getedittest();
        $wheres['partnerstatus'] = 1;
        $data['partner'] = $this->app_model->getSelectedData('partners',$wheres);
        $this->load->view('edittest',$data);

    }

    function updatepartner() {
        $this->partner_model->updatepartner();
    }

    function deletepartner() {
        $this->partner_model->deletepartner();
    }





}


?>