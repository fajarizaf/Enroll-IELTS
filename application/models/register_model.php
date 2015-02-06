<?php

class register_model extends CI_Model {
	function __construct() {
        parent::__construct();
        $this->tableName = "schedules";
    }


    function getmaxuser_schedule($idschedule) {
        $query = $this->db->query('select * from schedules where idschedules="'.$idschedule.'"');
        foreach ($query->result() as $row) {
            $newmaxuser =  $row->maxuser - 1;
        }

                            if( $newmaxuser == '0') {
                                    $dataupdate = array(
                                        "schstatus" => '2'
                                    );
                                    $this->db->where('idschedules', $idschedule);
                                    $this->db->update('schedules', $dataupdate);
                             }

        return $newmaxuser;
    }


    function getbranch($idbranches) {
        $query = $this->db->query('select * from branches where idbranches="'.$idbranches.'"');
            foreach ($query->result() as $rew ) {
                return $rew->branchname;
            }
    }


    function getbranches($idschedules) {       
        $this->db->where('schedules.idschedules', $idschedules);
        $q = $this->db->get('schedules');
        foreach ($q->result() as $row) {
            $this->getbranch($row->idbranches);
        }
    }


    
    function readable_random_string($length = 6){
        $conso=array("b","c","d","f","g","h","j","k","l",
        "m","n","p","r","s","t","v","w","x","y","z");
        $vocal=array("a","e","i","o","u");
        $password="";
        srand ((double)microtime()*1000000);
        $max = $length/2;
        for($i=1; $i<=$max; $i++)
        {
        $password.=$conso[rand(0,19)];
        $password.=$vocal[rand(0,4)];
        }
        return $password;
    }



    function proses_register() {

// jika sudah login dan sudah member
        if($this->session->userdata('statususer')) {



//apabila dia login sebagai candidate
            if($this->session->userdata('statususer') == '3') {
           
                            $iduser = $this->session->userdata('idusers');
                            $cekRegistrasion = $this->db->query('select * from registrations where idschedules="'.$this->uri->segment(3).'" and idusers="'.$iduser.'"');
                            $cek = $cekRegistrasion->num_rows();

                            if($cek == 0) {
                                    $idroles = $this->session->userdata('statususer');
                                    $reg = array(
                                                "idschedules" => $this->uri->segment(3),
                                                "idusers" => $this->session->userdata('idusers'),
                                                "registrationspayment" => 'unpaid',
                                                "status" => '0',
                                                "created" => date("Y-m-d H:i:s"),
                                                "createdbys" => $this->session->userdata('idusers'),
                                            );

                                    $query1 = $this->db->insert("registrations",$reg);

                                         //proses pengurangan kuota schedule test date
                                         $dataupdate = array(
                                                "maxuser" => $this->getmaxuser_schedule($this->uri->segment(3))
                                            );
                                            $this->db->where('idschedules', $this->uri->segment(3));
                                            $this->db->update('schedules', $dataupdate);


                                    $selectSchedules = $this->db->query('select * from schedules where idschedules="'.$this->uri->segment(3).'"');
                                    foreach ($selectSchedules->result() as $row) {

                                    if($row->idexams == '4') {
                                        $module = 'Academic';
                                    } else {
                                        $module = 'General Training';
                                    }
                                         
                                        $result = array(
                                            'testdate' => $this->generated_tanggal->ubahtanggal($row->schdate),
                                            'rupiah' => number_format($row->rupiah,2,',','.'),
                                            'dollar' => $row->dollar,
                                            'gbp' => $row->gbp,
                                            'module' => $module,
                                            'status' => 'success'
                                        );

                                        echo '{"result":'.json_encode($result).'}';
                                  }

                            } else {
                             
                                     $selectSchedules = $this->db->query('select * from schedules where idschedules="'.$this->uri->segment(3).'"');
                                     foreach ($selectSchedules->result() as $row) {

                                        if($row->idexams == '4') {
                                            $module = 'Academic';
                                        } else {
                                            $module = 'General Training';
                                        }
                                             
                                            $result = array(
                                                'testdate' => $this->generated_tanggal->ubahtanggal($row->schdate),
                                                'rupiah' => number_format($row->rupiah,2,',','.'),
                                                'dollar' => $row->dollar,
                                                'gbp' => $row->gbp,
                                                'module' => $module,
                                                'status' => 'registered'
                                            );

                                            echo '{"result":'.json_encode($result).'}';
                                     }   

                                      

                            }

    //apabila dia login sebagai reg center
            } else {

                    $idroles = '3';
                    $title = $this->input->post('title');
                    $last_name = $this->input->post('last_name');
                    $first_name = $this->input->post('first_name');
                    $gender = $this->input->post('gender');
                    $phone_number = $this->input->post('phone_number');
                    $email_address = $this->input->post('email_address');
                    $address = $this->input->post('address');
                    $city = $this->input->post('city');
                    $zipcode = $this->input->post('zipcode');
                    $country = $this->input->post('country');
                    $date = $this->input->post('date_of_birth');
                    $identity = $this->input->post('identity');
                    $number_identity = $this->input->post('number_identity');
                    $codecountryorigin = $this->input->post('codecountryorigin');
                    $codelang = $this->input->post('codelang');
                    $codesector = $this->input->post('codesector');
                    $codelevel = $this->input->post('codelevel');
                    $codequestion = $this->input->post('codequestion');
                    $country_applying = $this->input->post('country_applying');
                    $studying_english = $this->input->post('studying_English');
                    $level_of_education = $this->input->post('level_of_education');
                    $many_years = $this->input->post('many_years');
                    $specialneeds = $this->input->post('specialneeds');
                    $notes = $this->input->post('notes');
                    $userphoto = $this->input->post('uploadfile');

         

                    if($codesector == '00') {
                        $codesector_other = $this->input->post('sector_other');
                    }  else {
                        $codesector_other =  '-';
                    }


                    if($codelevel == '0') {
                        $codelevel_other =  $this->input->post('level_other');
                    } else {
                        $codelevel_other =  '-';
                    }


                    if($codequestion == '0' ) {
                        $codequestion_other = $this->input->post('other_taking_test');
                    }  else {
                        $codequestion_other =  '-';
                    }


                    if($country_applying == '0') {
                        $country_applying_other = $this->input->post('other_country_applying');
                    }  else {
                        $country_applying_other =  '-';
                    }


                    if($specialneeds == 'YES') {
                        $specialneedsdesc = $this->input->post('specialneedsdesc');
                    } else if ($specialneeds == 'NO') {
                        $specialneedsdesc = '-';
                    }


                    $pass = $this->readable_random_string(15);
                    $enpass = md5($pass);

                    $dt = array(
                        "idroles" => $idroles,
                        "usertitle" => $title,
                        "username" => $this->readable_random_string(11),
                        "userpass" => $enpass,
                        "userfamilyname" => $last_name,
                        "userfirstname" => $first_name,
                        "userothername" => 'x',
                        "usergender" => $gender,
                        "userphone" => $phone_number,
                        "useremail" => $email_address,
                        "useraddr1" => $address,
                        "useraddr2" => $country,
                        "useraddr3" => $city,
                        "useraddr4" => $zipcode,
                        "userdob" => $date,
                        "useridcard" => $identity,
                        "useridnumber" => $number_identity,
                        "usercountryorigin" => $codecountryorigin,
                        "userfirstlanguage" => $codelang,
                        "useroccupationsector" => $codesector,
                        "sector_other" => $codesector_other,
                        "useroccupationlevel" => $codelevel,
                        "level_other" => $codelevel_other,
                        "userwhytaketest" => $codequestion,
                        "userwhytaketest_other" => $codequestion_other,
                        "usertargetcountry" => $country_applying,
                        "usertargetcountry_other" => $country_applying_other,
                        "usertakenielts" => $specialneeds,
                        "userwherestudyingeng" => $studying_english,
                        "userlevelofeducation" => $level_of_education,
                        "useryearsofenglishstudy" => $many_years,
                        "userspecialcondition" => $specialneedsdesc,
                        "usernotes" => $notes,
                        "userstatus" => '1',
                        "useridfile" => $userphoto,
                        "created" => date("Y-m-d H:i:s"),
                        "updated" => date("Y-m-d H:i:s"),
                        "createdby" => $this->session->userdata('idusers'),
                        );
                
                    $query =  $this->db->insert("users", $dt);


                    $getiduser = $this->db->query('select * from users where useremail="'.$email_address.'"');

                    foreach ($getiduser->result() as $row) {
                        $iduser = $row->idusers;
                        $username = $row->username;
                        $userpass = $row->userpass;
                        $useremail = $row->useremail;

                        $reg = array(
                                        "idschedules" => $this->uri->segment(3),
                                        "idusers" => $iduser,
                                        "registrationspayment" => 'unpaid',
                                        "status" => '0',
                                        "created" => date("Y-m-d H:i:s"),
                                        "createdbys" => $this->session->userdata('idusers'),
                                    );
                         $query1 = $this->db->insert("registrations",$reg);



                              //proses pengurangan kuota schedule test date
                                    $dataupdate = array(
                                        "maxuser" => $this->getmaxuser_schedule($this->uri->segment(3))
                                    );
                                    $this->db->where('idschedules', $this->uri->segment(3));
                                    $this->db->update('schedules', $dataupdate);


                              // input other option akademik
                                $nameperson = $this->input->post('name-person');
                                if($nameperson) {
                                    $nameinstitusi = $this->input->post('name-institusi');
                                    $casenumber = $this->input->post('case-number');
                                    $addr = $this->input->post('addr');  

                                        foreach( $nameperson as $key => $n ) {
                                          
                                            $data = array(
                                                    'userid' => $iduser,
                                                    'nop' => $nameperson[$key],
                                                    'noi' => $nameinstitusi[$key],
                                                    'files' => $casenumber[$key],
                                                    'addr' => $addr[$key]
                                                );

                                            $this->db->insert('academic',$data);

                                        }          
                                }                                    

                               
                             $selectSchedules = $this->db->query('select * from schedules where idschedules="'.$this->uri->segment(3).'"');
                             foreach ($selectSchedules->result() as $row) {

                                if($row->idexams == '4') {
                                    $module = 'Academic';
                                } else {
                                    $module = 'General Training';
                                }
                                     
                                    $result = array(
                                        'testdate' => $this->generated_tanggal->ubahtanggal($row->schdate),
                                        'rupiah' => number_format($row->rupiah,2,',','.'),
                                        'dollar' => $row->dollar,
                                        'gbp' => $row->gbp,
                                        'module' => $module,
                                        'status' => 'regcenter'
                                    );

                                    echo '{"result":'.json_encode($result).'}';

                                                                         // -- EMAIL CONFIRMATION -- //
                                                                $config = Array(
                                                                   'protocol' => 'mail',
                                                                   'smtp_host' => 'mail.webdev.dlanet.com',
                                                                   'smtp_port' => 25,
                                                                   'smtp_user' => 'register@webdev.dlanet.com',
                                                                   'smtp_pass' => 'rahasia123',
                                                                   'mailtype'  => 'html',
                                                                   'charset'   => 'iso-8859-1',
                                                                   'wordwrap'  => TRUE
                                                                );

                                                                $this->load->library('email', $config);
                                                                $this->email->from('register@webdev.dlanet.com', 'IELTS Indonesia');
                                                                
                                                                $this->email->to($useremail);
                                                                $this->email->subject('Activation Account');
                                                                

                                                                foreach ($selectSchedules->result() as $row) {
                                                                $message = '
                                                            
                                                                <div style="font-size: 18px; font-weight: bold; padding: 5px;height:68px;border-bottom:2px solid red;">
                                                                       <img src="'.base_url().'assets/pic/utclogo.png" style="float:left;width:40px;margin-right:15px;margin-top:7px;" />
                                                                       <img src="'.base_url().'assets/pic/bc-logo1.png" style="float:left;width:220px;margin-right:15px;margin-top:7px;" />
                                                                       <img src="'.base_url().'assets/pic/ielts-logo.png" style="float:left;margin-right:5px;margin-top:7px;" />
                                                                </div>

                                                                <div style="margin-top:12px;margin-bottom:12px;width:100%;padding:8px;background:#faedc1;color:#ed4b1a;-moz-border-radius:3px 3px 3px;-webkit-border-radius:3px 3px 3px;border-radius:3px 3px 3px;border:1px solid #f4c375;">
                                                                <span style="color:#c0322f;font-weight:bold;">Register Successful</span>&nbsp;Thank you registering for our ieltsindonesia as candidate IELTS test
                                                                </div>

                                                                <div style="width:330px;float:left;">
                                                                <div style="color:#626262;font-weight:bold;margin-top:7px;">The following test schedule that you choose :</div>

                                                                <table style="margin-top:10px;">
                                                                <tr>
                                                                <td style="color:#626262">Test Date</td>
                                                                <td style="color:#626262">:</td>
                                                                <td style="color:#626262">'.$this->generated_tanggal->ubahtanggal($row->schdate).'</td>
                                                                </tr>

                                                                <tr>
                                                                <td style="color:#626262">Test Venue</td>
                                                                <td style="color:#626262">:</td>
                                                                <td style="color:#626262">'.$this->showuser->getvenue($row->idbranches).'</td>
                                                                </tr>

                                                                <tr>
                                                                <td style="color:#626262">Test Module</td>
                                                                <td style="color:#626262">:</td>
                                                                <td style="color:#626262">'.$module.'</td>
                                                                </tr>

                                                                <tr>
                                                                <td style="color:#626262">Make Your Payment</td>
                                                                <td style="color:#626262">:</td>
                                                                <td style="color:#626262">IDR '.number_format($row->rupiah,2,',','.').' / USD.'.$row->dollar.' / GBP.'.$row->gbp.'</td>
                                                                </tr>
                                                                </table>
                                                                </div>


                                                                <div style="width:300px;float:left;">
                                                                <div style="color:#626262;font-weight:bold;margin-top:7px;">Your login information is as follows :</div>

                                                                <table style="margin-top:10px;">
                                                                <tr>
                                                                <td style="color:#626262">username</td>
                                                                <td style="color:#626262">:</td>
                                                                <td style="color:#626262">'.$username.'</td>
                                                                </tr>

                                                                <tr>
                                                                <td style="color:#626262">password</td>
                                                                <td style="color:#626262">:</td>
                                                                <td style="color:#626262">'.$pass.'</td>
                                                                </tr>

                                                                
                                                                </table>
                                                                </div>

                                                                <div style="clear:both;"></div>
                                                                <div style="color:#626262;margin-top:12px;">After payment,please login To <b style="color:#00a6e0;">confirm payment</b> your registration status and payment information,and upload proof of payment at the time of confirmation</div>
                                                                <div style="color:#626262;width:100%;height:20px;border-top:1px solid #ccc;padding-top:7px;margin-top:12px;">
                                                                &copy;  2015  ieltsindonesia.co.id. All Rights Reserved
                                                                </div>


                                                        '; }

                                                        $this->email->message($message);
                                                        $this->email->send();


                             }

                    }

            }              


// kondisi register baru             
        } else {
            $idroles = '3';
            $title = $this->input->post('title');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $last_name = $this->input->post('last_name');
            $first_name = $this->input->post('first_name');
            $gender = $this->input->post('gender');
            $phone_number = $this->input->post('phone_number');
            $email_address = $this->input->post('email_address');
            $address = $this->input->post('address');
            $city = $this->input->post('city');
            $zipcode = $this->input->post('zipcode');
            $country = $this->input->post('country');
            $date = $this->input->post('date_of_birth');
            $identity = $this->input->post('identity');
            $number_identity = $this->input->post('number_identity');
            $codecountryorigin = $this->input->post('codecountryorigin');
            $codelang = $this->input->post('codelang');
            $codesector = $this->input->post('codesector');
            $codelevel = $this->input->post('codelevel');
            $codequestion = $this->input->post('codequestion');
            $country_applying = $this->input->post('country_applying');
            $studying_english = $this->input->post('studying_English');
            $level_of_education = $this->input->post('level_of_education');
            $many_years = $this->input->post('many_years');
            $specialneeds = $this->input->post('specialneeds');
            $notes = $this->input->post('notes');
            $userphoto = $this->input->post('uploadfile');

 

            if($codesector == '00') {
                $codesector_other = $this->input->post('sector_other');
            }  else {
                $codesector_other =  '-';
            }


            if($codelevel == '0') {
                $codelevel_other =  $this->input->post('level_other');
            } else {
                $codelevel_other =  '-';
            }


            if($codequestion == '0' ) {
                $codequestion_other = $this->input->post('other_taking_test');
            }  else {
                $codequestion_other =  '-';
            }


            if($country_applying == '0') {
                $country_applying_other = $this->input->post('other_country_applying');
            }  else {
                $country_applying_other =  '-';
            }


            if($specialneeds == 'YES') {
                $specialneedsdesc = $this->input->post('specialneedsdesc');
            } else if ($specialneeds == 'NO') {
                $specialneedsdesc = '-';
            }



            $dt = array(
                "idroles" => $idroles,
                "usertitle" => $title,
                "username" => $username,
                "userpass" => md5($password),
                "userfamilyname" => $last_name,
                "userfirstname" => $first_name,
                "userothername" => 'x',
                "usergender" => $gender,
                "userphone" => $phone_number,
                "useremail" => $email_address,
                "useraddr1" => $address,
                "useraddr2" => $country,
                "useraddr3" => $city,
                "useraddr4" => $zipcode,
                "userdob" => $date,
                "useridcard" => $identity,
                "useridnumber" => $number_identity,
                "usercountryorigin" => $codecountryorigin,
                "userfirstlanguage" => $codelang,
                "useroccupationsector" => $codesector,
                "sector_other" => $codesector_other,
                "useroccupationlevel" => $codelevel,
                "level_other" => $codelevel_other,
                "userwhytaketest" => $codequestion,
                "userwhytaketest_other" => $codequestion_other,
                "usertargetcountry" => $country_applying,
                "usertargetcountry_other" => $country_applying_other,
                "usertakenielts" => $specialneeds,
                "userwherestudyingeng" => $studying_english,
                "userlevelofeducation" => $level_of_education,
                "useryearsofenglishstudy" => $many_years,
                "userspecialcondition" => $specialneedsdesc,
                "usernotes" => $notes,
                "userstatus" => '0',
                "useridfile" => $userphoto,
                "created" => date("Y-m-d H:i:s"),
                "updated" => date("Y-m-d H:i:s"),
                );
        
            $query =  $this->db->insert("users", $dt);


            $getiduser = $this->db->query('select * from users where useremail="'.$email_address.'"');

            foreach ($getiduser->result() as $row) {
                $iduser = $row->idusers;
                $username = $row->username;
                $userpass = $row->userpass;
                $usermail = $row->useremail;

                $reg = array(
                                "idschedules" => $this->uri->segment(3),
                                "idusers" => $iduser,
                                "registrationspayment" => 'unpaid',
                                "status" => '0',
                                "created" => date("Y-m-d H:i:s"),
                                "createdbys" => $iduser,
                            );
                 $query1 = $this->db->insert("registrations",$reg);



                            //proses pengurangan kuota schedule test date
                            $dataupdate = array(
                                "maxuser" => $this->getmaxuser_schedule($this->uri->segment(3))
                            );
                            $this->db->where('idschedules', $this->uri->segment(3));
                            $this->db->update('schedules', $dataupdate);


                // input other option akademik
                $nameperson = $this->input->post('name-person');
                if($nameperson) {
                    $nameinstitusi = $this->input->post('name-institusi');
                    $casenumber = $this->input->post('case-number');
                    $addr = $this->input->post('addr');  

                        foreach( $nameperson as $key => $n ) {
                          
                            $data = array(
                                    'userid' => $iduser,
                                    'nop' => $nameperson[$key],
                                    'noi' => $nameinstitusi[$key],
                                    'files' => $casenumber[$key],
                                    'addr' => $addr[$key]
                                );

                            $this->db->insert('academic',$data);

                        }
                }            
                        

                       
                     $selectSchedules = $this->db->query('select * from schedules where idschedules="'.$this->uri->segment(3).'"');
                     foreach ($selectSchedules->result() as $row) {

                        if($row->idexams == '4') {
                            $module = 'Academic';
                        } else {
                            $module = 'General Training';
                        }
                             
                            $result = array(
                                'testdate' => $this->generated_tanggal->ubahtanggal($row->schdate),
                                'rupiah' => number_format($row->rupiah,2,',','.'),
                                'dollar' => $row->dollar,
                                'gbp' => $row->gbp,
                                'module' => $module,
                                'status' => 'success'
                            );

                            echo '{"result":'.json_encode($result).'}';
                     }



                                                                 // -- EMAIL CONFIRMATION -- //
                                                                    $config = Array(
                                                                       'protocol' => 'mail',
                                                                       'smtp_host' => 'mail.webdev.dlanet.com',
                                                                       'smtp_port' => 25,
                                                                       'smtp_user' => 'register@webdev.dlanet.com',
                                                                       'smtp_pass' => 'rahasia123',
                                                                       'mailtype'  => 'html',
                                                                       'charset'   => 'iso-8859-1',
                                                                       'wordwrap'  => TRUE
                                                                    );

                                                            $this->load->library('email', $config);
                                                            $this->email->from('register@webdev.dlanet.com', 'IELTS Indonesia');
                                                            
                                                            $this->email->to($usermail);
                                                            $this->email->subject('Activation Account');
                                                            

                                                            foreach ($selectSchedules->result() as $row) {
                                                            $message = '
                                                                
                                                                    <div style="font-size: 18px; font-weight: bold; padding: 5px;height:68px;border-bottom:2px solid red;">
                                                                           <img src="'.base_url().'assets/pic/utclogo.png" style="float:left;width:40px;margin-right:15px;margin-top:7px;" />
                                                                           <img src="'.base_url().'assets/pic/bc-logo1.png" style="float:left;width:220px;margin-right:15px;margin-top:7px;" />
                                                                           <img src="'.base_url().'assets/pic/ielts-logo.png" style="float:left;margin-right:5px;margin-top:7px;" />
                                                                    </div>

                                                                    <div style="margin-top:12px;margin-bottom:12px;width:100%;padding:8px;background:#faedc1;color:#ed4b1a;-moz-border-radius:3px 3px 3px;-webkit-border-radius:3px 3px 3px;border-radius:3px 3px 3px;border:1px solid #f4c375;">
                                                                    <span style="color:#c0322f;font-weight:bold;">Register Successful</span>&nbsp;Thank you registering for our ieltsindonesia as candidate IELTS test
                                                                    </div>

                                                                    <div style="width:330px;float:left;">
                                                                    <div style="color:#626262;font-weight:bold;margin-top:7px;">The following test schedule that you choose :</div>

                                                                    <table style="margin-top:10px;">
                                                                    <tr>
                                                                    <td style="color:#626262">Test Date</td>
                                                                    <td style="color:#626262">:</td>
                                                                    <td style="color:#626262">'.$this->generated_tanggal->ubahtanggal($row->schdate).'</td>
                                                                    </tr>

                                                                    <tr>
                                                                    <td style="color:#626262">Test Venue</td>
                                                                    <td style="color:#626262">:</td>
                                                                    <td style="color:#626262">'.$this->showuser->getvenue($row->idbranches).'</td>
                                                                    </tr>

                                                                    <tr>
                                                                    <td style="color:#626262">Test Module</td>
                                                                    <td style="color:#626262">:</td>
                                                                    <td style="color:#626262">'.$module.'</td>
                                                                    </tr>

                                                                    <tr>
                                                                    <td style="color:#626262">Make Your Payment</td>
                                                                    <td style="color:#626262">:</td>
                                                                    <td style="color:#626262">IDR '.number_format($row->rupiah,2,',','.').' / USD.'.$row->dollar.' / GBP.'.$row->gbp.'</td>
                                                                    </tr>
                                                                    </table>
                                                                    </div>


                                                                    <div style="width:300px;float:left;">
                                                                    <div style="color:#626262;font-weight:bold;margin-top:7px;">Your login information is as follows :</div>

                                                                    <table style="margin-top:10px;">
                                                                    <tr>
                                                                    <td style="color:#626262">username</td>
                                                                    <td style="color:#626262">:</td>
                                                                    <td style="color:#626262">'.$username.'</td>
                                                                    </tr>

                                                                    <tr>
                                                                    <td style="color:#626262">password</td>
                                                                    <td style="color:#626262">:</td>
                                                                    <td style="color:#626262">'.$password.'</td>
                                                                    </tr>

                                                                    
                                                                    </table>
                                                                    </div>

                                                                    <div style="clear:both;"></div>

                                                                    <div style="color:#626262;margin-top:12px;">In order to activate your account,please follow the link bellow</div>
                                                                    <a style="text-decoration:none;" href="'.base_url().'register/activeaccount/'.$iduser.'"><div style="margin-top:7px;background:#00a6e0;padding:6px;width:120px;color:#fff;-moz-border-radius:4px 4px 4px;-webkit-border-radius:4px 4px 4px;border-radius:4px 4px 4px;">Activation Account</div></a>

                                                                    <div style="color:#626262;margin-top:7px;">Thanks You,</div>
                                                                    <div style="color:#626262;text-decoration:none;">Ieltsindonesia.co.id</div>

                                                                    <div style="color:#626262;width:100%;height:20px;border-top:1px solid #ccc;padding-top:7px;margin-top:12px;">
                                                                    &copy;  2015  ieltsindonesia.co.id. All Rights Reserved
                                                                    </div>


                                                            '; }

                                                            $this->email->message($message);
                                                            $this->email->send();


            }

                
        }
   
    }


// ambil informasi schedules
    function getschedules() {
            $selectSchedules = $this->db->query('select * from schedules where idschedules="'.$this->uri->segment(3).'"');
                     foreach ($selectSchedules->result() as $row) {

                        if($row->idexams == '4') {
                            $module = 'Academic';
                        } else {
                            $module = 'General Training';
                        }
                             
                            $result = array(
                                'testdate' => $this->generated_tanggal->ubahtanggal($row->schdate),
                                'rupiah' => number_format($row->rupiah,2,',','.'),
                                'dollar' => $row->dollar,
                                'gbp' => $row->gbp,
                                'module' => $module,
                                'status' => 'success'
                            );

                            echo '{"result":'.json_encode($result).'}';
                     }
    }




// memproses register dengan user yang sudah ada dari reg center

    function proses_register_center() {
        $idusers = $this->input->post('idusers');
        $idschedules = $this->input->post('idschedules');

        $ex_user = explode(',' , $idusers);

        foreach ($ex_user as $raw) {

            if($raw != '') {
           $data = array (
                "idschedules" => $idschedules,
                "idusers" => $raw,
                "registrationspayment" => 'unpaid',
                "status" => 0,
                "created" => date("Y-m-d H:i:s"),
                "createdbys" => $this->session->userdata('idusers')
            );

           $this->db->insert('registrations', $data);

                            //proses pengurangan kuota schedule test date
                            $dataupdate = array(
                                "maxuser" => $this->getmaxuser_schedule($idschedules)
                            );
                            $this->db->where('idschedules', $idschedules);
                            $this->db->update('schedules', $dataupdate);


                    $selectSchedules = $this->db->query('select * from schedules where idschedules="'.$idschedules.'"');
                    foreach ($selectSchedules->result() as $row) {

                        if($row->idexams == '4') {
                            $module = 'Academic';
                        } else {
                            $module = 'General Training';
                        }
                             
                            $result = array(
                                'testdate' => $this->generated_tanggal->ubahtanggal($row->schdate),
                                'rupiah' => number_format($row->rupiah,2,',','.'),
                                'dollar' => $row->dollar,
                                'gbp' => $row->gbp,
                                'module' => $module,
                                'status' => 'success'
                            );

                            echo '{"result":'.json_encode($result).'}';
                     
                                  $getiduser = $this->db->query('select * from users where idusers="'.$raw.'"');
                                  foreach ($getiduser->result() as $reww) {



                                                                         // -- EMAIL CONFIRMATION -- //
                                                                            $config = Array(
                                                                               'protocol' => 'mail',
                                                                               'smtp_host' => 'mail.webdev.dlanet.com',
                                                                               'smtp_port' => 25,
                                                                               'smtp_user' => 'register@webdev.dlanet.com',
                                                                               'smtp_pass' => 'rahasia123',
                                                                               'mailtype'  => 'html',
                                                                               'charset'   => 'iso-8859-1',
                                                                               'wordwrap'  => TRUE
                                                                            );

                                                                            $this->load->library('email', $config);
                                                                            $this->email->from('register@webdev.dlanet.com', 'IELTS Indonesia');
                                                                            
                                                                            $this->email->to($reww->useremail);
                                                                            $this->email->subject('Activation Account');

                                                                            
                                                                                $iduser = $reww->idusers;
                                                                                $username = $reww->username;
                                                                                $userpass = $reww->userpass;
                                                                            
                                                                            $message = '
                                                                                
                                                                                    <div style="font-size: 18px; font-weight: bold; padding: 5px;height:68px;border-bottom:2px solid red;">
                                                                                           <img src="'.base_url().'assets/pic/utclogo.png" style="float:left;width:40px;margin-right:15px;margin-top:7px;" />
                                                                                           <img src="'.base_url().'assets/pic/bc-logo1.png" style="float:left;width:220px;margin-right:15px;margin-top:7px;" />
                                                                                           <img src="'.base_url().'assets/pic/ielts-logo.png" style="float:left;margin-right:5px;margin-top:7px;" />
                                                                                    </div>

                                                                                    <div style="margin-top:12px;margin-bottom:12px;width:100%;padding:8px;background:#faedc1;color:#ed4b1a;-moz-border-radius:3px 3px 3px;-webkit-border-radius:3px 3px 3px;border-radius:3px 3px 3px;border:1px solid #f4c375;">
                                                                                    <span style="color:#c0322f;font-weight:bold;">Register Successful</span>&nbsp;Thank you registering for our ieltsindonesia as candidate IELTS test
                                                                                    </div>

                                                                                    <div style="width:330px;float:left;">
                                                                                    <div style="color:#626262;font-weight:bold;margin-top:7px;">The following test schedule that you choose :</div>

                                                                                    <table style="margin-top:10px;">
                                                                                    <tr>
                                                                                    <td style="color:#626262">Test Date</td>
                                                                                    <td style="color:#626262">:</td>
                                                                                    <td style="color:#626262">'.$this->generated_tanggal->ubahtanggal($row->schdate).'</td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                    <td style="color:#626262">Test Venue</td>
                                                                                    <td style="color:#626262">:</td>
                                                                                    <td style="color:#626262">'.$this->showuser->getvenue($row->idbranches).'</td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                    <td style="color:#626262">Test Module</td>
                                                                                    <td style="color:#626262">:</td>
                                                                                    <td style="color:#626262">'.$module.'</td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                    <td style="color:#626262">Make Your Payment</td>
                                                                                    <td style="color:#626262">:</td>
                                                                                    <td style="color:#626262">IDR '.number_format($row->rupiah,2,',','.').' / USD.'.$row->dollar.' / GBP.'.$row->gbp.'</td>
                                                                                    </tr>
                                                                                    </table>
                                                                                    </div>

                                                                                    <div style="clear:both;"></div>
                                                                                    <div style="color:#626262;margin-top:12px;">After payment,please login To <b style="color:#00a6e0;">confirm payment</b> your registration status and payment information,and upload proof of payment at the time of confirmation</div>
                                                                                    <div style="color:#626262;width:100%;height:20px;border-top:1px solid #ccc;padding-top:7px;margin-top:12px;">
                                                                                    &copy;  2015  ieltsindonesia.co.id. All Rights Reserved
                                                                                    </div>


                                                                            '; 
                                                                         }   

                                                            }

                                                    $this->email->message($message);
                                                    $this->email->send();


        }
        }

    }
	


    function cekemailavailable() {
        $email = $this->input->post('email');
        $this->db->where('useremail',$email);
        $query = $this->db->get('users');
        return $query->num_rows();
    }



    function getAll($where = "") {
        if ($where != "")
        $this->db->where($where);
        $this->db->distinct(); 
        $this->db->select('branches.branchname');
        $this->db->join('exams', 'exams.idexams = schedules.idexams');
        $this->db->join('branches', 'branches.idbranches = schedules.idbranches');
        $this->db->join('users', 'branches.idusers = users.idusers');
		
        return $this->db->get("schedules")->result();
    }



    function getAllCount($where = "") {
        $this->db->select("COUNT(*) JUMLAH");
        $this->db->from("schedules");
        if ($where != "")
            $this->db->where($where);
        return $this->db->get()->row()->JUMLAH;
    }
    
    function getById($idschedules,$where = ""){
        $this->db->select("exams.examname, branches.branchname, schedules.idschedules, schedules.idbranches, schedules.idexams, schedules.schdate, schedules.schsubmitentry, schedules.schclosingreg, schedules.appformreceive, schedules.rupiah, schedules.dollar, schedules.gbp, users.userfirstname, schedules.maxuser, (select count(*) from registrations where idschedules = schedules.idschedules and registrationspayment='paid' and status='1') registered");
        $this->db->from("schedules");
        $this->db->join("branches","schedules.idbranches = branches.idbranches");
        $this->db->join("exams","schedules.idexams = exams.idexams");
        $this->db->join("users","branches.idusers = users.idusers");
        if ($where != "")
            $this->db->where($where);
        $this->db->where("idschedules",$idschedules);
        return $this->db->get()->row();
    }

    function getCityschedule() {
    $this->db->join('branches', 'branches.idbranches = schedules.idbranches');  
    $this->db->distinct();
    $this->db->select('branches.city');
    $this->db->where('schstatus', '1');
    $this->db->where('schdate >', date("Y-m-d H:i:s"));
    return $this->db->get("schedules")->result();    
    }




    function getAddr($param) {
        $this->db->where('branchname', $param);
        $query = $this->db->get('branches');

        foreach ($query->result() as $row ) {
            echo $row->branchaddr;
        }
    }

    function getIdbranches($param) {
        $this->db->where('branchname', $param);
        $query = $this->db->get('branches');

        foreach ($query->result() as $row ) {
            $idbranches = $row->idbranches;
        }
        return $idbranches;
    }

    function getIdbranche($param) {
        $this->db->where('branchname', $param);
        $query = $this->db->get('branches');

        foreach ($query->result() as $row ) {
            $idbranches =  $row->idbranches;
        }
        return $idbranches;
    }

        function getAddrs($param) {
            $this->db->where('branchname', $param);
            $query = $this->db->get('branches');
            return $query->result();
           
        }

        function getAvailable($param) {
            $this->db->where('idbranches', $param);
            $this->db->where('schstatus', '1');
            $this->db->where('schdate >', date("Y-m-d H:i:s"));
            $query = $this->db->get('schedules');
            return $query->num_rows();
        }


        function getAvailables($param) {
            $this->db->where('idbranches', $param);
            $this->db->where('schstatus', '1');
            $this->db->where('schdate >', date("Y-m-d H:i:s"));
            $query = $this->db->get('schedules');
            echo $query->num_rows();
        }

        function getavailabledate($where = "") {
                $location = $this->input->post('location');

                if ($where != "")
                $this->db->where($where);
                $this->db->where('idbranches', $location);
                $this->db->group_by('MONTH(schdate)');
                $query = $this->db->get('schedules'); 

                  ?>
                    <option value="">select month available</option>
                <?php foreach ($query->result() as $row ) { ?>
                    <option value="<?php $mydate = $row->schdate; echo date("m",strtotime($mydate)); ?>"><?php $mydate = $row->schdate; echo $this->generated_tanggal->getmonth(date("m",strtotime($mydate))); ?></option>
                <?php } ?>


     <?php    }



        function getexams($param) {
            $this->db->where('idexams', $param);
            $query = $this->db->get('exams');

            foreach ($query->result() as $row) {
                $examname = $row->examname;
            }
            return $examname;

        }



    function filterbycity() {
        $city = $this->input->post('city');
        $query = $this->db->query('select DISTINCT  branches.branchname from schedules, branches where branches.city="'.$city.'" and schedules.schstatus="1" and schedules.schdate > "'.date("Y-m-d H:i:s").'" ');
        ?>

            <table class="table table-striped">
                
            <?php foreach ($query->result() as $row ) { ?>
                        <?php $available = $this->getAvailable($this->getIdbranche($row->branchname ));

                            if($available > 0 ) {
                                $return = '<div class="label" style="color:#fff;background:#00a2c8;">'.$available.' Exam Date </label>';
                            } else {
                                $return = '<p class="font1" style="font-size:12px;color:#ccc;">Not Available</p>';
                            }

                         ?>
                <tr>
                    <td style="color:#333;"><?php echo $row->branchname ?></td>
                    <td><?php $this->getAddr($row->branchname ); ?></td>
                    <td ><?php echo $return ?></td>
                    <td><input <?php if($available > 0 ) { echo 'enabled'; } else { echo 'disabled'; } ?> class="locations-test" style="margin-top:15px;" value="<?php echo $this->getIdbranches($row->branchname ); ?>" type="radio" name="location-test" /></td>
                </tr>                
            <?php }  ?>


        </table>
    <?php }


    function filterbyuser() {
           $userd = $this->input->post('user');
           $idusers = $this->session->userdata('idusers');
           $idschedules = $this->input->post('idschedules');

           $getUserRegistered = $this->db->query('select * from registrations where idschedules="'.$idschedules.'"');
           $cekuser = $this->db->query('select * from registrations where idusers="'.$userd.'" and idschedules="'.$idschedules.'"');


           if($cekuser->num_rows()) {
               ?>

                <ul class="list-country">
                           <li style="width:30px;">
                              
                           </li>
                           <li style="width:120px;">Not Found</li>
                           <li style="width:150px;"></li>
                           <li style="width:280px;"></li>
                         </ul> 


                <?php

           } else {
               $q = $this->db->query('select * from users where createdby="'.$idusers.'" and idusers like '.$userd.' ');
               if($q->result()) {
                $query = $this->db->query('select * from users where createdby="'.$idusers.'" and idusers like '.$userd.' ');
               } else {

                if($getUserRegistered->result()) {
                       foreach ($getUserRegistered->result() as $row) {
                           $user[] = $row->idusers;
                           $im_user = implode(',',$user);
                       } 
                    $query = $this->db->query('select * from users where createdby="'.$idusers.'" and idusers not in ('.$im_user.')');
                } else {
                    $query = $this->db->query('select * from users where createdby="'.$idusers.'"');    
                }

                
               } 
?>


                    <?php foreach ($query->result() as $row ) { ?>
                        <ul value="<?php echo $row->idusers ?>" valuecode="<?php echo $row->idusers ?>" class="list-country">
                           <li style="width:30px;">
                              <input type="checkbox" name="listuser"  value="<?php echo $row->idusers; ?>" id="<?php echo $row->idusers; ?>" class="css-checkbox lrg" />
                              <label for="<?php echo $row->idusers; ?>" tgl="<?php echo $this->generated_tanggal->ubahtanggal($row->created); ?>" famname="<?php echo $row->userfamilyname; ?>" name="checkbox67_lbl" class="css-label lrg web-two-style"></label>
                           </li>
                           <li style="width:120px;">IDIELTS<?php echo $row->idusers ?></li>
                           <li style="width:150px;"><?php echo $this->generated_tanggal->ubahtanggal($row->created); ?></li>
                           <li style="width:280px;"><?php echo $row->userfamilyname ?></li>
                         </ul> 


                    <?php }  


           }

 }


    function filterbydate($where = "") {
        $module = $this->input->post('module');


        if($module) {
                $date = $this->input->post('date');
                $location = $this->input->post('location');

                if ($where != "")
                $this->db->where($where);
                $this->db->where('MONTH(schdate)', $date);
                $this->db->where("schdate >", date("Y-m-d H:i:s") );
                $this->db->where('schedules.idbranches', $location);
                $this->db->where('exams.idexams', $module);
                $this->db->join('exams', 'exams.idexams = schedules.idexams');
                $this->db->join('branches', 'branches.idbranches = schedules.idbranches');           
                $query =  $this->db->get("schedules"); 

         } else {    

                $date = $this->input->post('date');
                $location = $this->input->post('location');
                $query = $this->db->query('select * from schedules where idbranches="'.$location.'" and schstatus="1" and schdate > "'.date("Y-m-d H:i:s").'" and MONTH(schdate)= '.$date.' ');



         }   ?>
                 <?php if($query->result()) { ?>  
                    <table class="table table-striped">
                       
                         
                     <?php foreach ($query->result() as $row ) { ?>
                        <tr>
                            <td style="color:#333;"><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
                            <td>
                                <table>
                                    <tr>
                                        <td style="border-top: none;padding:1px; ">IDR.</td>
                                        <td style="border-top: none;padding:1px; "><?php echo  number_format( $row->rupiah , 2 , ',', '.' ) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: none;padding:1px; ">USD.</td>
                                        <td style="border-top: none;padding:1px; "><?php echo $row->dollar ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: none;padding:1px; ">GBP</td>
                                        <td style="border-top: none;padding:1px; "><?php echo $row->gbp ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td><?php echo $this->getexams($row->idexams); ?></td>
                            <td><input class="date-test" style="margin-top:15px;" value="<?php echo $row->idschedules ?>" type="radio" name="date-test" /></td>
                        </tr>                
                    <?php }  ?>
                    </table>
                     <?php } else { ?>

                     <div style="width:250px;height:100px;margin:0px auto;text-align:center;margin-top:90px;border:1px dashed #ccc;padding:20px;"> 
                        <img style="float:left;" src="<?php echo base_url() ?>assets/pic/notification.png" width="90px">
                        <div style="color:#bfbfbf;width:150px;font-size:16px;margin-top:17px;float:left;">No schedule of tests in <span style="color:orange;font-size:16px;"><?php echo $this->generated_tanggal->getmonth($date); ?></span></div>
                     </div>
          <?php } ?>
          


    <?php }




    function filterbymodule($where = "") {
        $date = $this->input->post('date');

        if($date) {
            $location = $this->input->post('location');
            $module = $this->input->post('module');

            if ($where != "")
            $this->db->where($where);
            $this->db->where('MONTH(schdate)', $date);
            $this->db->where('exams.idexams', $module);
            $this->db->where('schedules.idbranches', $location);
            $this->db->join('exams', 'exams.idexams = schedules.idexams');
            $this->db->join('branches', 'branches.idbranches = schedules.idbranches');
            
            $query =  $this->db->get("schedules"); 

        } else {

            $location = $this->input->post('location');
            $module = $this->input->post('module');
            $query = $this->db->query('select * from schedules where idbranches="'.$location.'" and idexams="'.$module.'" and schstatus="1" and schdate > "'.date("Y-m-d H:i:s").'"  ');



        }


        ?>

         <?php if($query->result()) { ?>  
            <table class="table table-striped">
                  
                 
             <?php foreach ($query->result() as $row ) { ?>
                <tr>
                    <td style="color:#333;"><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
                    <td>
                        <table>
                            <tr>
                                <td style="border-top: none;padding:1px; ">IDR.</td>
                                <td style="border-top: none;padding:1px; "><?php echo  number_format( $row->rupiah , 2 , ',', '.' ) ?></td>
                            </tr>
                            <tr>
                                <td style="border-top: none;padding:1px; ">USD.</td>
                                <td style="border-top: none;padding:1px; "><?php echo $row->dollar ?></td>
                            </tr>
                            <tr>
                                <td style="border-top: none;padding:1px; ">GBP</td>
                                <td style="border-top: none;padding:1px; "><?php echo $row->gbp ?></td>
                            </tr>
                        </table>
                    </td>
                    <td><?php echo $this->getexams($row->idexams); ?></td>
                    <td><input class="date-test" style="margin-top:15px;" value="<?php echo $row->idschedules ?>" type="radio" name="date-test" /></td>
                </tr>                
            <?php }  ?>
            </table>
             <?php } else { ?>

             <div style="width:250px;height:100px;margin:0px auto;text-align:center;margin-top:90px;border:1px dashed #ccc;padding:20px;"> 
                <img style="float:left;" src="<?php echo base_url() ?>assets/pic/notification.png" width="90px">
                <div style="color:#bfbfbf;width:150px;font-size:16px;margin-top:17px;float:left;">No schedule of tests</div>
             </div>
          <?php } ?>


    <?php }





    function filterbylocation($where = "") {
       $location = $this->input->post('location');     

        if ($where != "")
        $this->db->where($where);
        $this->db->where('schedules.idbranches', $location);
        $this->db->join('exams', 'exams.idexams = schedules.idexams');
        $this->db->join('branches', 'branches.idbranches = schedules.idbranches');
        
        $query =  $this->db->get("schedules"); ?>
    

            <table class="table table-striped">
                    

             <?php foreach ($query->result() as $row ) { ?>
               <?php if( $row->schclosingreg < date("Y-m-d H:i:s") ) { ?>
                 
              <?php } else { ?>

                <tr>
                    <td style="color:#333;"><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
                    <td>
                        <table>
                            <tr>
                                <td style="border-top: none;padding:1px; ">IDR.</td>
                                <td style="border-top: none;padding:1px; "><?php echo  number_format( $row->rupiah , 2 , ',', '.' ) ?></td>
                            </tr>
                            <tr>
                                <td style="border-top: none;padding:1px; ">USD.</td>
                                <td style="border-top: none;padding:1px; "><?php echo $row->dollar ?></td>
                            </tr>
                            <tr>
                                <td style="border-top: none;padding:1px; ">GBP</td>
                                <td style="border-top: none;padding:1px; "><?php echo $row->gbp ?></td>
                            </tr>
                        </table>
                    </td>
                    <td><?php echo $row->examname ?></td>
                    <td><input class="date-test" style="margin-top:15px;" value="<?php echo $row->idschedules ?>" type="radio" name="date-test" /></td>
                </tr>

              <?php } ?>                    
            <?php }  ?>

            </table>


    <?php }

    function getlocation() {
            $location = $this->input->post('location'); 
            $this->db->where('idbranches', $location);
            $query = $this->db->get('branches');
            return $query->result();
        }

    function searchcountrycode($table,$field,$keyword) {
            $this->db->limit(1);
            $this->db->like($field,$keyword);
            $data1 = $this->db->get($table);
            return $data1->result();
        } 


    function testemail() {
          // -- EMAIL CONFIRMATION -- //
                        $config = Array(
                           'protocol' => 'mail',
                           'smtp_host' => 'mail.webdev.dlanet.com',
                           'smtp_port' => 25,
                           'smtp_user' => 'register@webdev.dlanet.com',
                           'smtp_pass' => 'rahasia123',
                           'mailtype'  => 'html',
                           'charset'   => 'iso-8859-1',
                           'wordwrap'  => TRUE
                        );

                $this->load->library('email', $config);
                $this->email->from('register@webdev.dlanet.com', 'IELTS Indonesia');
                
                $this->email->to('fajarizaf@gmail.com');
                $this->email->subject('Activation Account');
                
                $message = '
                    
                        <div style="font-size: 18px; font-weight: bold; padding: 5px;height:68px;border-bottom:2px solid red;">
                               <img src="'.base_url().'/assets/pic/utclogo.png" style="float:left;margin-right:5px;" />
                               <img src="'.base_url().'/assets/pic/bc-logo.png" style="float:left;margin-right:5px;" />
                               <img src="'.base_url().'/assets/pic/ielts-logo.png" style="float:left;margin-right:5px;" />
                        </div>

                        <div style="margin-top:7px;width:100%;padding:8px;background:#faedc1;color:#ed4b1a;-moz-border-radius:3px 3px 3px;-webkit-border-radius:3px 3px 3px;border-radius:3px 3px 3px;border:1px solid #f4c375;">
                        <span style="color:#c0322f;font-weight:bold;">Register Successful</span>&nbsp;Thank you registering for our ieltsindonesia as candidate IELTS test
                        </div>

                        <div style="color:#626262;font-weight:bold;margin-top:7px;">The following test schedule that you choose :</div>

                        <table style="margin-top:10px;">
                        <tr>
                        <td style="color:#626262">Test Date</td>
                        <td style="color:#626262">:</td>
                        <td style="color:#626262">29 januari 2015</td>
                        </tr>

                        <tr>
                        <td style="color:#626262">Test Venue</td>
                        <td style="color:#626262">:</td>
                        <td style="color:#626262">UTC</td>
                        </tr>

                        <tr>
                        <td style="color:#626262">Test Module</td>
                        <td style="color:#626262">:</td>
                        <td style="color:#626262">Akademik</td>
                        </tr>

                        <tr>
                        <td style="color:#626262">Make Your Payment</td>
                        <td style="color:#626262">:</td>
                        <td style="color:#626262">IDR 2.400.000,00 / USD.190 / GBP.120</td>
                        </tr>

                        </table>

                        <div style="color:#626262;margin-top:7px;">In order to activate your account,please follow the link bellow</div>
                        <a style="text-decoration:none;" href="'.base_url().'register/activeaccount/"><div style="margin-top:7px;background:#00a6e0;padding:6px;width:120px;color:#fff;-moz-border-radius:4px 4px 4px;-webkit-border-radius:4px 4px 4px;border-radius:4px 4px 4px;">Activation Account</div></a>

                        <div style="color:#626262;margin-top:7px;">Thanks You,</div>
                        <div style="color:#626262;text-decoration:none;">Ieltsindonesia.co.id</div>

                        <div style="color:#626262;width:100%;height:20px;border-top:1px solid #ccc;padding-top:7px;margin-top:12px;">
                        &copy;  2015  ieltsindonesia.co.id. All Rights Reserved
                        </div>


                ';
                $this->email->message($message);
                $this->email->send();
            
    } 


    function activeaccount($iduser) {
        $data = array(
            'userstatus' => '1'
            );

        $this->db->where('idusers',$iduser);
        $q = $this->db->update('users',$data);

        if($q) {
            redirect('register/activesucces');
        }
    }

    function cekuser($email) {
        $this->db->where('useremail',$email);
        $q = $this->db->get('users');
        return $q->num_rows();
    }



    function prosesresetpassword() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $data = array(
            'userpass' => md5($password),
            );
        $this->db->where('useremail',$email);
        $q = $this->db->update('users',$data);
        if($q) {
            $response = array('status' => 'sukses');
            echo '{"status":'.json_encode($response).'}';   
        }
    }



    function resetpassword() {
        $email = $this->input->post('email');
        // -- EMAIL CONFIRMATION -- //
                                                                            $config = Array(
                                                                               'protocol' => 'mail',
                                                                               'smtp_host' => 'mail.webdev.dlanet.com',
                                                                               'smtp_port' => 25,
                                                                               'smtp_user' => 'register@webdev.dlanet.com',
                                                                               'smtp_pass' => 'rahasia123',
                                                                               'mailtype'  => 'html',
                                                                               'charset'   => 'iso-8859-1',
                                                                               'wordwrap'  => TRUE
                                                                            );

                                                                            $this->load->library('email', $config);
                                                                            $this->email->from('register@webdev.dlanet.com', 'IELTS Indonesia');
                                                                            
                                                                            $this->email->to($email);
                                                                            $this->email->subject('Resset Password');

                                                                            
                                                                            $message = '
                                                                                
                                                                                     <div style="font-size: 18px; font-weight: bold; padding: 5px;height:68px;border-bottom:2px solid red;">
                                                                                           <img src="'.base_url().'assets/pic/utclogo.png" style="float:left;width:40px;margin-right:15px;margin-top:7px;" />
                                                                                           <img src="'.base_url().'assets/pic/bc-logo1.png" style="float:left;width:220px;margin-right:15px;margin-top:7px;" />
                                                                                           <img src="'.base_url().'assets/pic/ielts-logo.png" style="float:left;margin-right:5px;margin-top:7px;" />
                                                                                    </div>

                                                                                

                                                                                    <div style="width:330px;float:left;">
                                                                                    <div style="color:#626262;font-weight:bold;margin-top:7px;">We Received a request to change your password:</div>
                                                                                    <p>Click the link bellow to set a new password :</p>
                                                                                    
                                                                                    <a href="'.base_url().'register/resetpassword/'.$email.'">'.base_url().'register/resetpassword/</a>

                                                                                    
                                                                                    <div style="color:#626262;margin-top:12px;">if you don"t want to change your password,you can ignore this email.</div>
                                                                                    <div style="color:#626262;width:100%;height:20px;border-top:1px solid #ccc;padding-top:7px;margin-top:12px;">
                                                                                    &copy;  2015  ieltsindonesia.co.id. All Rights Reserved
                                                                                    </div>


                                                                            '; 
                                                         

                                                    $this->email->message($message);
                                                    $qe = $this->email->send();

                                                    if($qe) {
                                                        $response = array('status' => 'sukses');
                                                        echo '{"status":'.json_encode($response).'}';
                                                    } else {
                                                        $response = array('status' => 'gagal');
                                                        echo '{"status":'.json_encode($response).'}';
                                                    }


    }


    function getlistschedule($month) {
        $query = $this->db->query('select * from schedules where MONTH(schdate)="'.$month.'" and schstatus="1" and schdate > NOW() ');
        return $query->result();
    }


    function selectmonthavailable() { 
    $q = $this->db->query('select distinct MONTH(schdate) as "vbn" from schedules where schstatus="1" and schdate > NOW() order by MONTH(schdate) ASC');
    return $q->result();    
    }


    function getregisteredregcenter($idusers) {

        $this->db->join("schedules","registrations.idschedules = schedules.idschedules");
        $this->db->join("branches","schedules.idbranches = branches.idbranches");
        $this->db->join("exams","schedules.idexams = exams.idexams");
        $this->db->join("users","registrations.idusers = users.idusers");
        $this->db->where('schedules.schclosingreg > ', date("Y-m-d H:i:s"));
        $this->db->where('registrations.createdbys',$idusers);
        $q =  $this->db->get("registrations");
        return $q->num_rows();
    }  


}

?>