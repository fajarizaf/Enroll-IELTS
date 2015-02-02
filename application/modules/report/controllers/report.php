<?php ob_start() ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
class Report extends CI_Controller {
    public function  __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('report_model');
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
            $config['base_url'] = base_url().'report/page/';
            $config['total_rows'] = $this->report_model->count_report();
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
                $data['report'] = $this->report_model->getReport($limit,$offset);
                $data['venuetest'] = $this->app_model->get_data('branches');
                $this->pagination->initialize($config);
                $this->load->view('global/header', $data);
                $this->load->view('report',$data);
                $this->load->view('widget/editreport',$data);
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
            $config['base_url'] = base_url().'report/page/';
            $config['total_rows'] = $this->report_model->count_report();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';
                $idusers = $this->session->userdata('idusers');
                $data['refresh'] = $this->report_model->getreport($limit,$offset);
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


    function getUpdateSchedule() {
      $query = $this->schedule_model->getupdateschedule(); ?>
     <?php 
      $i = 1;  
      foreach ( $query as $row ) { ?>  
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->examname; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $this->generated_tanggal->getDay($row->schdate); ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->branchname; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><span class="label label-warning" style="padding-left:10px;padding-right:10px;"><?php echo $this->showuser->getCountBooked($row->idschedules); ?></span></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->maxuser; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><div url="<?php echo base_url() ?>schedule/editschedules/<?php echo $row->idschedules; ?>" href="#editschedule" data-toggle="modal" class="iconedit"></div></td>
          <?php $i++ ?>
     <?php } ?>

     <?php
    }



    function editreport() {
        $idreport = $this->uri->segment(3);
        $data['dataschedule'] = $this->report_model->getSchedules($idreport);
        $data['editreport'] = $this->report_model->geteditreport($idreport);
        $data['idreg'] = $this->report_model->getidreg($idreport);
        $this->load->view('editreport',$data);
    }

    public function createpdf() {
      ini_set('memory_limit', '128M');
      $idusers = $this->uri->segment(3);
      $idregistrations = $this->uri->segment(4);
      $where['idusers'] = $this->uri->segment(3);
      $data['datareport'] = $this->report_model->getdatareport($idusers);
      $where1['userid'] = $this->uri->segment(3);
      $data['akademik'] = $this->app_model->getSelectedData('academic',$where1);
      $data['branches'] = $this->report_model->getBranches($idregistrations);
      $where2['idusers'] = $this->uri->segment(3);
      $data['proof'] = $this->app_model->getSelectedData('registrations', $where2);
      $nameuser = $this->app_model->getSelectedData('users',$where);
      $html = $this->load->view('report_pdf',$data, true);
      $this->load->helper(array('dompdf', 'file')); 
      foreach ($nameuser as $row) {
            pdf_create($html, $row->userfirstname.' '.$row->userfamilyname);  
      }   
    }



    public function createpdfs() {
      ini_set('memory_limit', '128M');
      $idusers = $this->uri->segment(3);
      $where['idusers'] = $this->uri->segment(3);
      $data['datareport'] = $this->report_model->getdatareport($idusers);
      $where1['userid'] = $this->uri->segment(3);
      $data['akademik'] = $this->app_model->getSelectedData('academic',$where1);
      $nameuser = $this->app_model->getSelectedData('users',$where);
    $this->load->view('report_pdf',$data);
    }


    function filterByVenue($offset = NULL) {
      $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(3);}
            $idbranches = $this->input->post('selectvenues');
            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'report/pagevenue/'.$idbranches.'';
            $config['total_rows'] = $this->report_model->count_reportvenue($idbranches);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';    
                $data['refresh'] = $this->report_model->filterByVenues($idbranches,$limit,$offset);
                $this->pagination->initialize($config);
                $this->load->view('refresh',$data);
    }

    public function pagevenue($offset = NULL) {
            $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
            $date = $this->uri->segment(3);
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'report/pagevenue/'.$date.'';
            $config['total_rows'] = $this->report_model->count_reportvenue($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';
                $data['refresh'] = $this->report_model->filterByVenues($date,$limit,$offset);
                $this->pagination->initialize($config);
                $this->load->view('refresh',$data);
    }



    function filterByDate($offset = NULL) {
            $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(3);}
            $date = $this->input->post('date');
            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'report/pagedate/'.$date.'';
            $config['total_rows'] = $this->report_model->count_reportdate($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';   
                $data['refresh'] = $this->report_model->filterByDate($date,$limit,$offset);
                $this->pagination->initialize($config);
                $this->load->view('refresh',$data);
    }


    function pagedate($offset = NULL) {
            $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
            $date = $this->uri->segment(3);
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'report/pagedate/'.$date.'';
            $config['total_rows'] = $this->report_model->count_reportdate($date);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';   
                $data['refresh'] = $this->report_model->filterByDate($date,$limit,$offset);
                $this->pagination->initialize($config);
                $this->load->view('refresh',$data);
    }
}
?>