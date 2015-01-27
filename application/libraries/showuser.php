<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
class Showuser  {

    
    function  __construct() {
        $CI =& get_instance();
	      $this->instan = $CI;
        $CI->load->library('encrypt');
    }
   


function ubahtanggal($parameter) {
 $filter = explode(' ', $parameter);   
 $datadate = explode('-', $filter[0]);       
 $date = $datadate[1];
 
 switch ($date) {
     case "01": $dateid = "januari";
         break;
     case "02": $dateid = "Februari";
         break;
     case "03": $dateid = "Maret";
         break;
     case "04": $dateid = "April";
         break;
     case "05": $dateid = "Mei";
         break;
     case "06": $dateid = "Juni";
         break;
     case "07": $dateid = "Juli";
         break;
     case "08": $dateid = "Agustus";
         break;
     case "09": $dateid = "September";
         break;
     case "10": $dateid = "Oktober";
         break;
     case "11": $dateid = "November";
         break;
     case "12": $dateid = "Desember";
         break;
 } 
 
 $datadateid = array (  "tanggal" => $datadate[2],
                        "bulan" => $dateid,
                        "tahun" => $datadate[0],
     
                        );
 $datadategb = implode('-', $datadateid);
 
 
 $datadategb1 = explode('-', $datadategb);
 $datadategb2 = implode(' ', $datadategb1);
 
 return $datadategb2;
 
 
 
}




function ubahtanggaltime($parameter) {
 $filter = explode(' ', $parameter);         
 return $filter[1];
}



function ubahtanggal2($parameter) {
 $datadate = explode('/', $parameter);       
 $date = $datadate[1];
 
 switch ($date) {
     case "01": $dateid = "januari";
         break;
     case "02": $dateid = "Februari";
         break;
     case "03": $dateid = "Maret";
         break;
     case "04": $dateid = "April";
         break;
     case "05": $dateid = "Mei";
         break;
     case "06": $dateid = "Juni";
         break;
     case "07": $dateid = "Juli";
         break;
     case "08": $dateid = "Agustus";
         break;
     case "09": $dateid = "September";
         break;
     case "10": $dateid = "Oktober";
         break;
     case "11": $dateid = "November";
         break;
     case "12": $dateid = "Desember";
         break;
 } 
 
 $datadateid = array (  "tanggal" => $datadate[0],
                        "bulan" => $dateid,
                        "tahun" => $datadate[2],
     
                        );
 $datadategb = implode('-', $datadateid);
 
 
 $datadategb1 = explode('-', $datadategb);
 $datadategb2 = implode(' ', $datadategb1);
 
 return $datadategb2;
 
 
 
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


  function getEmailuser($code) {
    $CI =& get_instance();
      $CI->load->model('app_model');

        $data['idusers'] = $code;
        $query =  $CI->app_model->getSelectedData('users', $data);
        
        if($query) {
          foreach ($query as $row ) {
            return $row->useremail;
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


  function getNameUserfile($code) {
    $CI =& get_instance();
      $CI->load->model('app_model');

        $data['idusers'] = $code;
        $query =  $CI->app_model->getSelectedData('users', $data);
        
        if($query) {
          foreach ($query as $row ) {
            $v = $row->userfirstname;
            $ex = explode(' ', $v);
            $im = implode('-', $ex);
            return $im;
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


  function getUserregistered($idschedules) {
    $CI =& get_instance();
      $CI->load->model('user_model');

        $query =  $CI->user_model->getUserregistered($idschedules);        
  }


  function getDateRegisteredUser($idregistrations) {

    $CI =& get_instance();
      $CI->load->model('app_model');
        $where['idregistrations'] = $idregistrations;
        $query =  $CI->app_model->getSelectedData('registrations',$where);

        foreach ($query as $row) { ?>

             <?php echo $this->ubahtanggal($row->created); ?> </span> 
           
         <?php  }   

  }

  function getDateRegisteredUsertime($idregistrations) {

    $CI =& get_instance();
      $CI->load->model('app_model');
        $where['idregistrations'] = $idregistrations;
        $query =  $CI->app_model->getSelectedData('registrations',$where);

        foreach ($query as $row) { ?>

             <span style="margin-left:10px;" class="label"><?php echo $this->ubahtanggaltime($row->created); ?></span> 
           
         <?php  }   

  }


  function getidUsers($idregistrations) {
    $CI =& get_instance();
      $CI->load->model('app_model');
        $where['idregistrations'] = $idregistrations;
        $query =  $CI->app_model->getSelectedData('registrations',$where);

        foreach ($query as $row) {
            echo $row->idusers;
        }
  }


  function countvenue($idcity) {
     $CI =& get_instance();
      $CI->load->model('test_model');
        $query =  $CI->test_model->countvenue($idcity);

  }

  function getvenue($code) {
    $CI =& get_instance();
      $CI->load->model('app_model');

        $data['idbranches'] = $code;
        $query =  $CI->app_model->getSelectedData('branches', $data);
        
        if($query) {
          foreach ($query as $row ) {
            return $row->branchname;
          }
        }
  }



  




}
?>