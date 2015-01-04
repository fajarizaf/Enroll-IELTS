<?php ob_start() ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<?php


class Module extends CI_Controller {


    public function  __construct() {
        parent::__construct();
        $this->load->model('module_model');
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
                $data['menuadmin'] = $this->user_model->menuadmin($idroles);
                $data['module'] = $this->app_model->get_data('exams');

                $this->load->view('global/header', $data);
                $this->load->view('module',$data);
                $this->load->view('global/footer');
                $this->load->view('widget/addmodule');

           } else {
           redirect('register'); 
           }


      } else {
        redirect('register');
      }

    }

    public function addmodule() {
      $this->module_model->addmodule();
    }

    public function updatemodule() {
      $this->module_model->updatemodule();
    }

    public function deletemodule() {
      $this->module_model->deletemodule();
    }



    function getNewModule() {
      $query = $this->module_model->getnewmodule(); ?>

     <?php 
      $i = 1;  
      foreach ( $query as $row ) { ?>
          <tr atr="<?php echo $row->idexams ?>">
            <td><?php echo $row->examname ?></td>
            <td><?php echo $row->examstatus ?></td>
            <td><div show="show_edit<?php echo $row->idexams; ?>" value="<?php echo $row->idexams; ?>" class="iconedit"></div></td>
            <td><div value="<?php echo $row->idexams; ?>" class="icondelete"></div></td>
          </tr>

          <?php $i++ ?>
     <?php } ?>

     <?php
    }

    function getNewsubModule() {
      $query = $this->module_model->getnewmodule(); ?>

     <?php 
    
      foreach ( $query as $row ) { ?>

          <tr class="down-detail" id="show_edit<?php echo $row->idexams; ?>"  >
            <td colspan="4" >
              <table>
                <tr>
                  <td style="padding-top:14px;">Module Name</td>
                  <td colspan="2"><input type="text" name="modulename" value="<?php echo $row->examname ?>" class="shownamemodule"></input></td>
                </tr>
                  <tr>
                    <td style="padding-top:14px;">Status</td>
                    <td>
                    <input type="checkbox" name="isactive" <?php if($row->examstatus == 1) {echo 'checked';} ?> value="<?php echo $row->examstatus; ?>" id="isactives<?php echo $row->idexams; ?>"  class="css-checkbox lrg" />
                    <label style="margin-top:4px;" for="isactives<?php echo $row->idexams; ?>"  name="checkbox67_lbl" class="css-label lrg web-two-style"></label>
                    &nbsp;Is Active  
                    </td>
                    <td><input type="submit" name="proses" class="btn btn-success btnupdate" style="float:right;" value="Update"></input></td>
                  </tr>
              </table>
            </td>
        </tr> 

        
     <?php } ?>

     <?php
    }















































}


?>