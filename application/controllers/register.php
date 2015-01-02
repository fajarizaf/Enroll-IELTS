<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

        public function  __construct() {
        parent::__construct();
        $this->load->model('register_model');
        $this->load->model('app_model');
        $this->load->model('user_model');  
        $this->load->library('listexams');
        $this->load->library('showuser');
        $this->load->library('generated_tanggal');
        $this->load->helper('form','url','html');
        }
    
    
        
        
        
	public function index()
	{

        $where["schstatus"] = "1";
        $where["schdate >"] = date("Y-m-d H:i:s");

        $data['city'] = $this->register_model->getCityschedule();
        $data['schedule'] = $this->register_model->getAll($where);

        if($this->session->userdata('login') == 'true') {
            $idroles = $this->session->userdata('statususer');
            $data['menuadmin'] = $this->user_model->menuadmin($idroles);
        }

        $this->load->view('global/header', $data);
        $this->load->view('register', $data);
        $this->load->view('global/footer', $data);
    }


    public function formlogin() {

        if($this->session->userdata('login') == 'true') {
            redirect('register');
        } else {

        $this->load->view('global/header');
        $this->load->view('login');
        $this->load->view('global/footer');


        }


        
            
    }








                public function form_candidate() {
                    $data['country'] = $this->app_model->get_data('city');
                    $data['language'] = $this->app_model->get_data('language');
                    $data['sector'] = $this->app_model->get_data('sector');
                    $data['level'] = $this->app_model->get_data('level');
                    $data['question'] = $this->app_model->get_data('question');

                        $this->load->view('form_candidate');
                         
                         $this->load->view('modal/list-city', $data);
                         $this->load->view('modal/list-language', $data);
                         $this->load->view('modal/ocupation-sector', $data);
                         $this->load->view('modal/ocupation-level', $data);      
                         $this->load->view('modal/question', $data); 
                }

                public function form_candidate_login() {
                    $data['country'] = $this->app_model->get_data('city');
                    $data['language'] = $this->app_model->get_data('language');
                    $data['sector'] = $this->app_model->get_data('sector');
                    $data['level'] = $this->app_model->get_data('level');
                    $data['question'] = $this->app_model->get_data('question');


                            $where['idusers'] = $this->session->userdata('idusers');
                            $data['datausers'] = $this->app_model->getSelectedData('users', $where ); 
                            $this->load->view('form_candidate_login',$data);


                         $this->load->view('modal/list-city', $data);
                         $this->load->view('modal/list-language', $data);
                         $this->load->view('modal/ocupation-sector', $data);
                         $this->load->view('modal/ocupation-level', $data);      
                         $this->load->view('modal/question', $data); 
                }


                public function form_register_center() {
 
                            $this->load->view('form_register_center');
         
                }


    public function regcenter_existing_user() {
        $data['user_regcenter'] = $this->user_model->getDataNotRegistered();
        $where['idschedules'] = $this->uri->segment(3);
        $data['kuotaAvailable'] = $this->app_model->getSelectedData('schedules', $where);
        $this->load->view('regcenter_existing_user',$data);
    }

    public function getschedules() {
        $this->register_model->getschedules();
    }


    public function proses_register() {
        
        $this->register_model->proses_register();
    }


    public function proses_register_center() {
        
        $this->register_model->proses_register_center();
    }


    public function uploadphotos() {
        $store_path = "upload/";
        move_uploaded_file($_FILES["uploadidcard"]["tmp_name"], $store_path . $_FILES["uploadidcard"]["name"]);
    }

    public function cekemailavailable() {
        $cekemail = $this->register_model->cekemailavailable();
        if($cekemail) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function login() { 
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->user_model->login($username,$password);          
    }


    public function menuadmin() {
        $idroles = $this->session->userdata('statususer');
        $data = $this->user_model->menuadmin($idroles);

            foreach ($data as $row) { ?>
                 <li <?php if($this->uri->segment(1) == $row->controllers ) { ?>  class="active" <?php } ?>  style="border-top:5px solid #<?php echo $row->color  ?>;"><a href="#"><?php echo $row->name ?></a></li>    
    <?php   }
    }

    public function showstatus() {
        $where['idusers'] = $this->session->userdata('idusers');
        $data = $this->app_model->getSelectedData('users',$where);

        foreach ($data as $row) { ?>
            <div class="stat_photo">
            <img <?php if( $row->userphoto == '') { ?> src="<?php echo base_url() ?>assets/pic/default.jpg"  <?php } else { ?>  src="<?php echo base_url() ?>upload/<?php echo $row->userphoto ?>"  <?php } ?> width="105%">
            </div>
            <div class="stat"><span style="font-weight:bold;">Welcome</span><br/><?php echo $row->userfamilyname; ?></div>    
    <?php   }

    }

  


        public function filterbycity() {        
                $this->register_model->filterbycity();
        }

        public function filterbyuser() {        
                $this->register_model->filterbyuser();
        }

        public function filterbydate() {
        $where["schstatus"] = "1";
        
        $this->register_model->filterbydate();
        }

        public function filterbymodule() {
        $where["schstatus"] = "1";
        $where["schdate >"] = date("Y-m-d H:i:s");
        $this->register_model->filterbymodule($where);
        }

        public function filterbylocation() {
        $where["schstatus"] = "1";
        $where["schdate >"] = date("Y-m-d H:i:s");
                
                $this->register_model->filterbylocation($where);
        }

        public function getavailabledate() {
        $where["schstatus"] = "1";
        $where["schdate >"] = date("Y-m-d H:i:s");
                
                $this->register_model->getavailabledate($where);        
        }


        public function getlocationbranchname() {
            $query  =  $this->register_model->getlocation();
            foreach ($query as $row) {
                $addr = $row->branchname;
            }
            echo $addr;
        }

        public function getlocationcity() {
            $query  =  $this->register_model->getlocation();
            foreach ($query as $row) {
                $addr = $row->city;
            }
            echo $addr;
        }


        public function filtercountry() {
            $keyword = $this->input->post('keyword');
            $query = $this->app_model->search('city','name', $keyword);

            if($query) {
            foreach ($query as $row) { ?>
           
                 <ul value="<?php echo $row->name ?>" valuecode="<?php echo $row->code ?>" class="list-country">
                   <li style="width:30px;"><?php echo $row->no ?></li>
                   <li style="width:410px;"><?php echo $row->name ?></li>
                   <li style="width:60px;"><?php echo $row->code ?></li>
                 </ul>

            <?php }

            } else { ?>
                <div style="width:150px;color:red;margin:0px auto;margin-top:10px;" ">Result Not Found</div>     
      <?php }

        }




        public function filterlanguage() {
            $keyword = $this->input->post('keyword');
            $query = $this->app_model->search('language','name', $keyword);

            if($query) {
            foreach ($query as $row) { ?>
           
                 <ul value="<?php echo $row->name ?>" valuecode="<?php echo $row->code ?>" class="list-country">
                   <li style="width:30px;"><?php echo $row->no ?></li>
                   <li style="width:410px;"><?php echo $row->name ?></li>
                   <li style="width:60px;"><?php echo $row->code ?></li>
                 </ul>

            <?php }

            } else { ?>
                <div style="width:150px;color:red;margin:0px auto;margin-top:10px;" ">Result Not Found</div>     
      <?php }

        }




        public function filtersector() {
            $keyword = $this->input->post('keyword');
            $query = $this->app_model->search('sector','name', $keyword);

            if($query) {
            foreach ($query as $row) { ?>
           
                <ul value="<?php echo $row->name ?>" valuecode="<?php echo $row->code ?>" class="list-country">
                   <li style="width:30px;"><?php echo $row->no ?></li>
                   <li style="width:410px;"><?php echo $row->name ?></li>
                   <li style="width:60px;"><?php echo $row->code ?></li>
                 </ul>

            <?php }

            } else { ?>
                <div style="width:150px;color:red;margin:0px auto;margin-top:10px;" ">Result Not Found</div>     
      <?php }

        }


        public function filterlevel() {
            $keyword = $this->input->post('keyword');
            $query = $this->app_model->search('level','name', $keyword);

            if($query) {
            foreach ($query as $row) { ?>
           
                <ul value="<?php echo $row->name ?>" valuecode="<?php echo $row->code ?>" class="list-country">
                   <li style="width:30px;"><?php echo $row->no ?></li>
                   <li style="width:410px;"><?php echo $row->name ?></li>
                   <li style="width:60px;"><?php echo $row->code ?></li>
                 </ul>

            <?php }

            } else { ?>
                <div style="width:150px;color:red;margin:0px auto;margin-top:10px;" ">Result Not Found</div>     
      <?php }

        }



        public function filterquestion() {
            $keyword = $this->input->post('keyword');
            $query = $this->app_model->search('question','name', $keyword);

            if($query) {
            foreach ($query as $row) { ?>
           
                 <ul value="<?php echo $row->name ?>" valuecode="<?php echo $row->code ?>" class="list-country">
                   <li style="width:30px;"><?php echo $row->no ?></li>
                   <li style="width:410px;"><?php echo $row->name ?></li>
                   <li style="width:60px;"><?php echo $row->code ?></li>
                 </ul>

            <?php }

            } else { ?>
                <div style="width:150px;color:red;margin:0px auto;margin-top:10px;" ">Result Not Found</div>     
      <?php }

        }




        public function filtercountrycode() {
            $keyword = $this->input->post('keyword');
            $query = $this->register_model->searchcountrycode('city','code', $keyword);

            foreach ($query as $row) { ?>
           
               <?php  echo $row->name; ?>

            <?php      }

        }


        public function filterlangcode() {
            $keyword = $this->input->post('keyword');
            $query = $this->register_model->searchcountrycode('language','code', $keyword);

            foreach ($query as $row) { ?>
           
               <?php  echo $row->name; ?>

            <?php      }

        }



        public function filtersectorcode() {
            $keyword = $this->input->post('keyword');
            $query = $this->register_model->searchcountrycode('sector','code', $keyword);

            foreach ($query as $row) { ?>
           
               <?php  echo $row->name; ?>

            <?php      }

        }



        public function filterlevelcode() {
            $keyword = $this->input->post('keyword');
            $query = $this->register_model->searchcountrycode('level','code', $keyword);

            foreach ($query as $row) { ?>
           
               <?php  echo $row->name; ?>

            <?php      }

        }


        public function filterquestioncode() {
            $keyword = $this->input->post('keyword');
            $query = $this->register_model->searchcountrycode('question','code', $keyword);

            foreach ($query as $row) { ?>
           
               <?php  echo $row->name; ?>

            <?php      }

        }





      
        
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */