<?php ob_start() ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<?php


class Payment extends CI_Controller {


    public function  __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('payment_model');
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
            $config['base_url'] = base_url().'payment/page/';
            $config['total_rows'] = $this->payment_model->count_payment();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';



      if($this->session->userdata('login') == 'true') {
        // cek user previliages
        $checkroles = $this->user_model->cek_roles($this->uri->segment(1));

            if($checkroles == 1) {
                $idroles = $this->session->userdata('statususer');
                $data['menuadmin'] = $this->user_model->menuadmin($idroles);
                $data['payment'] = $this->payment_model->getPayment($limit,$offset);
                $data['venuetest'] = $this->app_model->get_data('branches');
                $this->pagination->initialize($config);

                $this->load->view('global/header', $data);
                $this->load->view('payment',$data);
                $this->load->view('widget/addpayment',$data);
                $this->load->view('widget/editpayment',$data);
                $this->load->view('widget/confirmpayment',$data);
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
            $config['base_url'] = base_url().'payment/page/';
            $config['total_rows'] = $this->payment_model->count_payment();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';


                $idusers = $this->session->userdata('idusers');
                $data['refresh'] = $this->payment_model->getPayment($limit,$offset);
                $this->pagination->initialize($config);

                $this->load->view('refresh',$data);
    }


    public function getTestschedule() {
      $this->schedule_model->getTestschedule();
    }


    public function addschedule() {
        $this->schedule_model->addschedule();
    }

    public function refreshList($offset = NULL) {
      $limit = 10;
       if( is_null ($offset)) { $offset = 0; } else {$offset = $this->uri->segment(3);}

            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'schedule/page/';
            $config['total_rows'] = $this->schedule_model->count_schedule();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';
      
      $data['schedule'] = $this->schedule_model->getSchedule($limit,$offset);
      $this->pagination->initialize($config);
      $this->load->view('refresh',$data);
    }


    function getNewSchedule() {
      $query = $this->schedule_model->getnewschedule(); ?>

     <?php 
      $i = 1;  
      foreach ( $query as $row ) { ?>
         
      <tr <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="background:#efefef;"  <?php  }  ?>>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->examname; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $this->generated_tanggal->getDay($row->schdate); ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->branchname; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><span class="label label-warning" style="padding-left:10px;padding-right:10px;"><?php echo $this->showuser->getCountBooked($row->idschedules); ?></span></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->maxuser; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><div url="<?php echo base_url() ?>schedule/editschedules/<?php echo $row->idschedules; ?>" href="#editschedule" data-toggle="modal" class="iconedit"></div></td>
      </tr>

          <?php $i++ ?>
     <?php } ?>

     <?php
    }


    function getUpdatePayment() {
      $query = $this->payment_model->getupdatepayment(); ?>

     <?php 
      $i = 1;  
      foreach ( $query as $row ) { ?>
         
      
        <td >REG<?php echo substr("00000" . $row->idregistrations, -6); ?></td>
        <td style="border-left:none;" ><h4 style="color:#333;padding-left:15px;"><?php echo $row->branchname ?></h4><p style="margin-left:15px;"><?php echo $row->examname ?></p></td>
        <td style="border-left:none;"><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
        <?php if($this->session->userdata('statususer') == 3) { ?>
          <?php if($row->paymentreceipt == '') { ?>
            <td style="border-left:none"><?php echo $this->generated_tanggal->ubahtanggal($row->created); ?> <span style="margin-left:10px;" class="label label-info"><?php echo $this->generated_tanggal->ubahtanggaltime($row->created); ?></span></td>
            <td style="border-left:none;"><div style="margin-top:10px;" url="<?php echo base_url() ?>payment/editpayment/<?php echo $row->idregistrations; ?>/" href="#editregistrations" data-toggle="modal" class="iconedit"></div></td>
            <td style="border-left:none;"><input href="#confirmpayment" data-toggle="modal" types="btnconfirm"  atrs="<?php echo $row->idregistrations;  ?>" atr="REG<?php echo substr("00000" . $row->idregistrations, -6); ?>" type="button" class="btn btn-warning" value="Confirm"></td>
          <?php } else { ?>
            <td style="border-left:none"><?php echo $this->generated_tanggal->ubahtanggal($row->created); ?> <span style="margin-left:10px;" class="label label-info"><?php echo $this->generated_tanggal->ubahtanggaltime($row->created); ?></span></td>
            <td style="border-left:none;"><div style="margin-top:10px;" url="<?php echo base_url() ?>payment/editpayment/<?php echo $row->idregistrations; ?>/" href="#editregistrations" data-toggle="modal" class="iconedit"></div></td>  
            <td style="border-left:none;"><input  style="opacity:0.4"  type="button"  class="btn" value="Confirmed"></td>
          <?php } ?>
        <?php } else { ?>
        <td style="border-left:none;"><h4 style="color:orangered;"><?php echo $row->userfirstname.' '.$row->userfamilyname  ?></h4><p>IELTS<?php echo substr("00000" . $row->idusers, -6); ?></p></td>
        <td style="border-left:none;"><div style="margin-top:10px;" url="<?php echo base_url() ?>payment/editpayment/<?php echo $row->idregistrations; ?>/" href="#editregistrations" data-toggle="modal" class="iconedit"></div></td>
        <td style="border-left:none;"><?php $receipt =  $row->paymentreceipt; if($receipt != '') { ?><div style="margin-top:15px;" class="label label-warning">Uploaded</div><?php } else {?>n/a<?php } ?></td>
        <?php } ?>


          <?php $i++ ?>
     <?php } ?>

     <?php
    }



    function editpayment() {
        $idroles = $this->session->userdata('statususer');
        $idpayment = $this->uri->segment(3);
        $data['datapayment'] = $this->payment_model->geteditpayment($idpayment);
        $where1['userid'] = $this->uri->segment(4);
        $data['akademik'] = $this->app_model->getSelectedData('academic',$where1);
        if($idroles == 3 ) {
        $this->load->view('editpaymentcandidate',$data);
        } else {
        $this->load->view('editpayment',$data);
        }
    }

    function updateschedule() {
        $this->schedule_model->updateschedule();
    }


    function filterbyvenue($offset = NULL) {
         $limit = 2;
       if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
       $venue = $this->input->post('venue');

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'payment/pagevenue/'.$venue.'';
            $config['total_rows'] = $this->payment_model->count_paymentvenue($venue);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';


       $data['refresh'] = $this->payment_model->filterbyvenue($venue,$limit,$offset);
       $this->pagination->initialize($config);
       $this->load->view('refresh',$data);
    }


     public function pagevenue($offset = NULL) {

            $limit = 2;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
            $date = $this->uri->segment(3);

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'payment/pagevenue/'.$date.'';
            $config['total_rows'] = $this->payment_model->count_paymentvenue($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';

                $data['refresh'] = $this->payment_model->filterbyvenue($date,$limit,$offset);
                $this->pagination->initialize($config);
                $this->load->view('refresh',$data);
    }


     function filterbydate($offset = NULL) {
         $limit = 2;
       if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
       $venue = $this->input->post('date');

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'payment/pagedate/'.$venue.'';
            $config['total_rows'] = $this->payment_model->count_paymentdate($venue);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';


       $data['refresh'] = $this->payment_model->filterbydate($venue,$limit,$offset);
       $this->pagination->initialize($config);
       $this->load->view('refresh',$data);
    }

    public function pagedate($offset = NULL) {

            $limit = 2;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
            $date = $this->uri->segment(3);

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'payment/pagedate/'.$date.'';
            $config['total_rows'] = $this->payment_model->count_paymentdate($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';

                $data['refresh'] = $this->payment_model->filterbydate($date,$limit,$offset);
                $this->pagination->initialize($config);
                $this->load->view('refresh',$data);
    }


    public function confirmpayment() {
      $this->payment_model->confirmpayment();

    }

    public function paid() {
        $this->payment_model->paid();
    }

    public function delpaymentunpaid() {
      $this->payment_model->delpaymentunpaid();
    }





}


?>