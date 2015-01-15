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
        $this->load->library('showuser');
        $this->load->library('encrypt');
        $this->load->helper('text');      
    }



    public function index($offset = NULL) {

            $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(3);}

            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'user/page/';
            $config['total_rows'] = $this->useradmin_model->count_user();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';



      if($this->session->userdata('login') == 'true') {
        // cek user previliages
        $checkroles = $this->user_model->cek_roles($this->uri->segment(1));

            if($checkroles == 1) {
                $idroles = $this->session->userdata('statususer');
                $idusers = $this->session->userdata('idusers');
                $data['menuadmin'] = $this->user_model->menuadmin($idroles);
                $data['user'] = $this->useradmin_model->getUser($idusers,$limit,$offset);
                $this->pagination->initialize($config);

                $this->load->view('global/header', $data);
                $this->load->view('user',$data);
                $this->load->view('global/footer');
                $this->load->view('widget/adduser');
                $this->load->view('widget/edituser');

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
            $config['base_url'] = base_url().'user/page/';
            $config['total_rows'] = $this->useradmin_model->count_user();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';


                $idusers = $this->session->userdata('idusers');
                $data['refreshlist'] = $this->useradmin_model->getUser($idusers,$limit,$offset);
                $this->pagination->initialize($config);

                $this->load->view('refresh',$data);
    }


    public function pageroles($offset = NULL) {

            $limit = 10;
            if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
            $roles = $this->uri->segment(3);

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'user/pageroles/'.$roles.'';
            $config['total_rows'] = $this->useradmin_model->count_users($roles);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';


                $data['refreshlist'] = $this->useradmin_model->filterByRolesPage($limit,$offset);
                $this->pagination->initialize($config);

                $this->load->view('refresh',$data);
    }

    


    public function adduser() {
      $this->useradmin_model->adduser();
    }

    function getNewUser() {
      $query = $this->useradmin_model->getnewuser(); ?>

     <?php 
      $i = 1;  
      foreach ( $query as $row ) { ?>
         
         <tr atr="<?php echo $row->idusers ?>">
          <td style="color:#4a0707;background:#fff5cd">IELTS<?php echo substr("00000" . $row->idusers, -6); ?></td>
          <td style="color:#4a0707;background:#fff5cd"><?php echo $this->generated_tanggal->ubahtanggal($row->created); ?></td>
          <td style="color:#4a0707;background:#fff5cd"><?php echo $row->userfirstname.' '.$row->userfamilyname ?></td>
          <td style="color:#4a0707;background:#fff5cd"><?php echo $this->showuser->getStatusUser($row->idroles) ?></td>
          <td style="width:40px;color:#4a0707;background:#fff5cd"><?php echo $row->useremail ?></td>
          <td style="color:#4a0707;background:#fff5cd"><?php echo $this->showuser->getNameUser($row->createdby); ?></td>
          <td style="color:#4a0707;background:#fff5cd"><div show="show_edit<?php echo $row->idusers; ?>" value="<?php echo $row->idusers; ?>" class="iconedit"></div></td>
          <td style="color:#4a0707;background:#fff5cd"><div value="<?php echo $row->idusers; ?>"  class="icondelete"></div></td>
        </tr>

          <?php $i++ ?>
     <?php } ?>

     <?php
    }



    public function filterByRoles($offset = NULL) {
       $limit = 10;
       if( is_null ($offset)) { $offset = 0; }else {$offset = $this->uri->segment(4);}
       $roles = $this->input->post('selectroles');

            $config['uri_segment'] = 4;
            $config['base_url'] = base_url().'user/pageroles/'.$roles.'';
            $config['total_rows'] = $this->useradmin_model->count_users($roles);
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';

       $data['filter'] = $this->useradmin_model->filterByRoles($limit,$offset);
       $this->pagination->initialize($config);
       $this->load->view('filterRoles',$data);

    }




    public function filter() {
      $data['filter'] = $this->useradmin_model->filter();
      $this->load->view('filter',$data);
    }





    public function refreshList($offset = NULL) {
      $limit = 10;
       if( is_null ($offset)) { $offset = 0; } else {$offset = $this->uri->segment(3);}

            $config['uri_segment'] = 3;
            $config['base_url'] = base_url().'user/page/';
            $config['total_rows'] = $this->useradmin_model->count_user();
            $config['per_page'] = $limit;
            $config['num_link'] = 1;
            $config['next_page'] = '&laquo;';
            $config['prev_page'] = '&raquo;';

      $idusers = $this->session->userdata('idusers');      
      $data['refreshlist'] = $this->useradmin_model->getUser($idusers,$limit,$offset);
      $this->pagination->initialize($config);
      $this->load->view('refresh',$data);
    }





    public function edituser($offset = NULL) {
      $idroles = $this->uri->segment(3);
      $idusers = $this->uri->segment(4);

      $data['datauser'] = $this->useradmin_model->getedituser($idusers);
    
     

        if($idroles == '2') {
        $this->load->view('edituser_regcenter',$data);
        } elseif($idroles == '3') {
        $this->load->view('edituser_candidate',$data);
        } elseif($idroles == '9999') {
        $this->load->view('edituser_regcenter',$data);
        }

    }


    public function createpdf() {
      ini_set('memory_limit', '128M');
      $idusers = $this->uri->segment(3);
      $where['idusers'] = $this->uri->segment(3);
      $data['datauser'] = $this->useradmin_model->getedituser($idusers);
      $nameuser = $this->app_model->getSelectedData('users',$where);
      $html = $this->load->view('candidate_pdf',$data, true);
      $this->load->helper(array('dompdf', 'file'));    

      foreach ($nameuser as $row) {
            pdf_create($html, $row->userfirstname.' '.$row->userfamilyname);  
      } 

    }

    public function createpdfs() {
      $idusers = $this->uri->segment(3);
      $data['datauser'] = $this->useradmin_model->getedituser($idusers);
      $html = $this->load->view('candidate_pdf',$data);


    }






}


?>