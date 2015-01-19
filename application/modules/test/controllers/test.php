<?php ob_start() ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<?php


class Test extends CI_Controller {


    public function  __construct() {
        parent::__construct();
        $this->load->model('test_model');
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
            $config['base_url'] = base_url().'test/page/';
            $config['total_rows'] = $this->test_model->count_test();
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
                $data['test'] = $this->test_model->getTest($limit,$offset);
                $data['city'] = $this->app_model->get_data_desc('citybranches');
                $this->pagination->initialize($config);

                $this->load->view('global/header', $data);
                $this->load->view('test',$data);
                $this->load->view('widget/addtest',$data);
                $this->load->view('widget/edittest');
                $this->load->view('widget/filtercity',$data);
                $this->load->view('global/footer');

           } else {
           redirect('register'); 
           }


      } else {
        redirect('register');
      }

    }


    public function addcity() {
        $this->test_model->addcity();
    }

    public function updatecity() {
        $this->test_model->updatecity();
    }



     public function page($offset = NULL) {

            $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(3);}

            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'test/page/';
            $config['total_rows'] = $this->test_model->count_test();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';


                $data['test'] = $this->test_model->getTest($limit,$offset);
                $this->pagination->initialize($config);

                $this->load->view('refresh',$data);
    }


    public function getTestschedule() {
      $this->schedule_model->getTestschedule();
    }


    public function addtest() {
        $this->test_model->addtest();
    }

    

    public function refreshList($offset = NULL) {
      $limit = 10;
       if( is_null ($offset)) { $offset = 0; } else {$offset = $this->uri->segment(3);}

            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'test/page/';
            $config['total_rows'] = $this->test_model->count_test();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';
      
      $data['test'] = $this->test_model->getTest($limit,$offset);
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
        <td><?php echo $row->cityname ?></td>
        <td><div url="<?php echo base_url() ?>test/edittest/<?php echo $row->idbranches; ?>" href="#edittest" data-toggle="modal" class="iconedit"></div></td>
        <td><div value="<?php echo $row->idbranches; ?>"  class="icondelete"></div></td>

          <?php $i++ ?>
     <?php } ?>

     <?php
    }



    function edittest() {
        $data['datatest'] = $this->test_model->getedittest();
        $data['city'] = $this->app_model->get_data_desc('citybranches');
        $wheres['partnerstatus'] = 1;
        $data['partner'] = $this->app_model->getSelectedData('partners',$wheres);
        $this->load->view('edittest',$data);

    }

    function updatetest() {
        $this->test_model->updatetest();
    }

    function deletetest() {
        $this->test_model->deletetest();
    }

    function deletecity() {
        $this->test_model->deletecity();
    }

    function filterbypartner($offset = NULL) {
         $limit = 2;
       if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
       $date = $this->input->post('partner');

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'test/pagepartner/'.$date.'';
            $config['total_rows'] = $this->test_model->count_testpartner($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';


       $data['test'] = $this->test_model->filterbypartner($date,$limit,$offset);
       $this->pagination->initialize($config);
       $this->load->view('refresh',$data);
    }



    function filterbycity($offset = NULL) {
         $limit = 2;
       if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
       $date = $this->input->post('city');

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'test/pagecity/'.$date.'';
            $config['total_rows'] = $this->test_model->count_testcity($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';


       $data['test'] = $this->test_model->filterbycity($date,$limit,$offset);
       $this->pagination->initialize($config);
       $this->load->view('refresh',$data);
    }


    public function pagecity($offset = NULL) {

            $limit = 2;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
            $date = $this->uri->segment(3);

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'test/pagecity/'.$date.'';
            $config['total_rows'] = $this->test_model->count_testcity($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';

                $data['test'] = $this->test_model->filterbycity($date,$limit,$offset);
                $this->pagination->initialize($config);
                $this->load->view('refresh',$data);
    }


    public function pagepartner($offset = NULL) {

            $limit = 2;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
            $date = $this->uri->segment(3);

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'test/pagepartner/'.$date.'';
            $config['total_rows'] = $this->test_model->count_testpartner($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';

                $data['test'] = $this->test_model->filterbypartner($date,$limit,$offset);
                $this->pagination->initialize($config);
                $this->load->view('refresh',$data);
    }








}


?>