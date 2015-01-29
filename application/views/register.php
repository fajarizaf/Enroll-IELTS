
<script type="text/javascript">
  $(document).ready(function() {
      /** Membuat Waktu Mulai Hitung Mundur Dengan 
                   * var detik = 0,
                   * var menit = 1,
                   * var jam = 1
                   */
                   var detik = 0;
                   var menit = 30;
             
                  /**
                   * Membuat function hitung() sebagai Penghitungan Waktu
                   */
                   function hitung() {
                      /** setTimout(hitung, 1000) digunakan untuk 
                 *  mengulang atau merefresh halaman selama 1000 (1 detik) */
                 setTimeout(hitung,1000);
             
                /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
                 $('#timer').html( '' + menit + ':' + detik + '');
             
                /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
                 detik --;
             
                /** Jika var detik < 0
                 *  var detik akan dikembalikan ke 59
                 *  Menit akan Berkurang 1
                 */
                 if(detik < 0) {
                    detik = 59;
                    menit --;
             
                    /** Jika menit < 0
                     *  Maka menit akan dikembali ke 59
                     *  Jam akan Berkurang 1
                     */
                     if(menit < 0) {
                  menit = 59;
                      clearInterval();
                      window.location = ""+base_url+"";
                  
                     }
                 }    
                    }
              /** Menjalankan Function Hitung Waktu Mundur */
                    hitung(); 
  });
</script>

<div class="content">
	
    <div class="h1" style="margin-top:20px;margin-bottom:20px;float:left;">Register</div>
    <div class="label label-info" style="width:130px;float:right;background:#1ba4dd;padding:5px;margin-top:20px;"><div style="width:80px;float:left;margin-right:11px;color:#fff;">Time Remains :</div><div id="timer" style="color:#fff;width:30px;float:left;margin-left:7px;"></div></div>
	
  <div style="clear:both;"></div>
  <div class="box-tab">
    	<ul>
        	<li id="btn-city" style="width:160px;"  class="active"><div class="icon-city"></div><div class="title-tab" style="width:90px;"><div>STEP 1</div>Select a City</div></li>
            <li id="btn-date"><div class="icon-date"></div><div class="title-tab"><div>STEP 2</div>Find Test Date</div></li>
            <li id="btn-tos" style="width:202px;"><div class="icon-tos"></div><div class="title-tab" style="width:130px;"><div>STEP 3</div>Registration Checklist</div></li>
            <li id="btn-candidate"><div class="icon-candidate"></div><div class="title-tab"><div>STEP 4</div>Candidate Details</div></li>
            <li id="btn-finish"><div class="icon-finish"></div><div class="title-tab"><div>STEP 5</div>Finish</div></li>
        </ul>
    </div>
    
    <div class="content-tab">
    	<div class="long">





        	<!-- Content Tab Select City -->
        	<div class="contents">

            	<div class="left">
                    	<div style="margin-top:20px;margin-bottom:10px;" class="h3">WELCOME</div>
                        <div style="margin-bottom:20px;">IELTS is the International English Language Testing System. It is the world's most popular English language test for higher education and global migration, with over 2 million IELTS tests taken in the last year. The British Council offers IELTS tests and preparation courses in our centres throughout the world.</div>
                        <div class="h3">Apply Now</div>
                        <p style="margin-top:10px;">Choose Your City from the list below :</p>

                        <select id="selectCity" name="city" class="chosen-select" style="width:320px;">
                        <option value="">select city available</option>
                        	<?php foreach ($city as $row1 ) { ?>
                            <option value="<?php echo $row1->city ?>" ><?php echo $this->showuser->cityname($row1->city); ?></option>
                            <?php } ?>
                        </select>

                </div>
                
                
                <div class="right" style="padding-right:0px;float:right;">
                    <div class="h3" style="width:200px;float:left;margin-top:0px;margin-bottom:10px;">LIST BY CITY LOCATION EXAM</div>
                        <div class="statloc" style="float:right;width:120px;font-size:18px;margin-top:10px;"></div>
                          
                        <table class="table talbe-striped" style="margin-bottom:0px;">
                                <tr>
                                  <th style="width:30%;border-top:none;">Location Name</th>
                                    <th style="width:40%;border-top:none;">Address</th>
                                    <th style="width:20%;border-top:none;">Available</th>
                                    <th style="width:10%;border-top:none;">Select</th>
                                </tr>
                        </table>

                          <div class="table-city" style="width:100%;height:200px;overflow:auto;">	
                            <table class="table table-striped">
                            	  

                                <?php foreach ($schedule as $row ) { ?>
                                <?php $available = $this->listexams->getAvailable($this->listexams->getIdbranche($row->branchname ));

                                    if($available > 0 ) {
                                        $return = ''.$available.' Exam Date ';
                                    } else {
                                        $return = 'Not Available';
                                    }

                                ?>
                                <tr>
                                	<td style="color:#333;width:30%;"><?php echo $row->branchname ?></td>
                                    <td style="width:40%;"><?php $this->listexams->getaddr($row->branchname ); ?></td>
                                    <td style="width:20%;"><p class="font1" style="font-size:12px;color:#00a2c8;"><?php echo $return ?></p></td>
                                    <td style="width:10%;"><input class="locations-test" style="margin-top:15px;" value="<?php echo $this->listexams->getIdbranches($row->branchname); ?>" type="radio" name="location-test" /></td>
                                </tr>
                                
                                <?php } ?>
                               
                            </table>
                          </div>
                        <img class="load" src="<?php echo base_url() ?>assets/pic/load1.gif" wisth="30">
                    <div id="next-city"  style="float:right;margin-top:10px;"class="btn btn-warning">Continue</div>
                </div>

            </div>
            





            <!-- Content Tab Select Date -->
            <div class="contents">
            	<div class="left">

                    <div class="box-select">
                        <div style="width:100%;border-bottom:1px solid #ccc;height:48px;" >
                        <div style="padding:15px;width:250px;float:left;" class="h3">Find Test Dates</div>
                        <img style="float:left;margin-top:20px;" src="<?php echo base_url() ?>assets/pic/pan.png" width="14px" height="9px" >
                        </div>
                        <table style="margin-left:10px;">
                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td class="displaycity">Jakarta</td>
                            </tr>
                            <tr>
                                <td>Test Venue</td>
                                <td>:</td>
                                <td class="displaylocation">BPPT</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                        <div class="box-selectdate" style="width:200px;float:left;margin-left:7px;margin-top:0px;">
                            <select class="select"  id="select-date">
                                <option value="">Select Date</option>
                            </select>
                        </div>
                        <div style="width:200px;float:left;margin-left:15px;margin-top:0px;">
                        Module
                        </div>
                        <div style="width:200px;float:left;margin-left:7px;margin-top:0px;">
                            <select class="select" id="select-module">
                                <option value="">Select Module</option>
                                <option value="4">Akademic</option>
                                <option value="3">General Training</option> 
                            </select>
                        </div>
                    </div> 

                </div>

                <div class="right" style="padding-left:20px;">
                        <div class="h3" style="width:200px;float:left;margin-top:0px;margin-bottom:10px;">Test Date Available</div>
                        <div class="statloc" style="float:right;width:180px;font-size:18px;margin-top:0px;text-align:right;"></div>

                          <table class="table table-striped" style="margin-bottom:0px">
                              <tr>
                                 <th style="width:30%;border-top:none;">Date</th>
                                 <th style="width:40%;border-top:none;">Test Fee</th>
                                 <th style="width:20%;border-top:none;">Module</th>
                                  <th style="width:10%;border-top:none;">Availability</th>
                              </tr>
                          </table>  

                          <div class="table-date" style="width:100%;height:200px;overflow:auto;padding-top:-2px;">    
                            
                          </div>
                          <div style="width:40px;float:left;display:none;" class="codeidschedules"></div>
                        <img class="load" style="margin-left:280px;"  src="<?php echo base_url() ?>assets/pic/load1.gif" width="30">
                    <div id="next-date"  style="float:right;margin-top:10px;margin-right:-60px;"class="btn btn-warning">Continue</div>

                </div>
            </div>
            




            <!-- Content Tab Select Terms On Conditions -->
            <div id="sec-tos" class="contents" style="padding-top:30px;">

            <div class="box-tos">	
            <h3 style="color:#333;margin-top:17px;margin-bottom:7px;">Registration Checklist</h3>
            <b>Before proceeding to registration, please have the following contents available</b><br/>
    
            <ul style="list-style:number;width:850px;">
              <li>A valid ID document or passport. On the test day, you must bring the same form of ID document that you indicate on your application form. NOTE: Student's Pass, Employment Pass and Work Permit are not allowed.</li>
              <li>A copy of your previous IELTS test report if you have taken IELTS before.</li>
              <li>Soft copy of an image of your ID document or passport. [ Sample and specifications ]</li>
            </ul>


              <h3 style="color:#333;margin-top:7px;margin-bottom:7px;">Important Notes</h3>
              <ul style="list-style:number;width:850px;">
                <li>Your have to complete the whole registration process including online payment within 30 minutes. The time slot you hold will be automatically released after 30 minutes if we cannot receive your payment.</li>
                <li> IELTS test fee for test dates from 2015 is IDR 2.400.000.</li>
                <li>Places are reserved on a first-come, first-served basis.</li>
                <li>The application will only be processed with all the necessary contents.</li>
                <li>No refund will be made for cancellation of examinations under any circumstances.</li>
                <li>IELTS is not recommended for candidates under the age of 16.</li>
              </ul>


              <h3  style="color:#333;margin-top:7px;margin-bottom:7px;">Changes Of Test Date</h3>

              <div style="margin-top:10px;width:850px;">
                You should inform the ieltsindonesia Exams Services no later than five weeks before the date of exam if you want to change the exam date. This also applies to registrations made within 5 weeks of the test date. A transfer fee of S$80.00 (inclusive of GST) is applicable for any change of date.
              </div>


              <h3  style="color:#333;margin-top:7px;margin-bottom:7px;">Special Circumstances</h3>

              <div style="width:850px;list-style:none;">
                <p style="margin-top:8px;">If you cancel your test or request a transfer five weeks or more before the
                    test date, the test centre will charge an administration fee of up to 25% of
                    the total test fee. </p>
                <p style="margin-top:8px;">If you cancel your test within five weeks of the test date for any reason apart
                    from medical ones, you will not be eligible to receive a refund. If you cancel
                    your test or request a transfer within five weeks of the test date for medical
                    reasons, you must provide supporting medical evidence within five working
                    days of the test date. Only evidence of serious illness will be considered.
                    Only original medical certificates will be accepted and must state inability to
                    appear for the test on the scheduled test date. </p>
              </div>

             
         
            <div class="box-termconditions" style="width:870px">
              <input type="checkbox" name="combo-tos" style="float:left;" class="combo-tos">
              <p style="width:500px;float:left;color:#802222;margin-left:10px;">I do not need any special arrangement for the test</p>
            </div>
            </div>

            <div id="next-tos"  style="float:right;margin-top:10px;"class="btn btn-warning">Continue</div>

            </div>
            






            <!-- Content Tab Candidate Details -->
            <div class="contents">

            <?php if($this->session->userdata('login') == 'true') { ?>    
                 <div class="sudahlogin" style="padding-top:30px;">

                 </div>
            <?php } else { ?>
                 <div class="register-or-login" style="padding-top:30px;">
                    <div class="left" style="margin-top:20px;width:450px;border-right:1px dashed #ccc;">
                      <div class="h3" style="padding:20px;border-bottom:1px dashed #ccc;">Register with existing account</div>
                      <p style="margin-left:20px;margin-top:20px;">If you are new to the IELTS online registration system, please create a new 
                        account and register here:</p>
                          <table style="margin-top:20px;width:400px;margin-left:20px;">
                              <tr>
                                <td class="box-alert" colspan="3">
                                  <div class="alert alert-warning" role="alert" style="padding:10px;font-size:14px;">
                                  Login Failed
                                  <button style="MARGIN-RIGHT:12px;line-height:22px;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="color:#c39d5a;padding:8px;" aria-hidden="true">X</span></button>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width:70px;">Username</td>
                                <td style="width:10px;">:</td>
                                <td style="width:200px;"><input class="username" type="text" style="width:100%;" name="username"></td>
                              </tr>
                              <tr>
                                <td>Password</td>
                                <td>:</td>
                                <td><input class="password" type="password" style="width:100%;"  name="password"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" id="buttonLogin" value="Sign In"  style="width:100%;" class="btn btn-warning"></td>
                              </tr>
                          </table> 
                    </div>

                    <div class="right" style="width:430px;padding-left:10px;">
                      <div class="h3" style="padding:20px;border-bottom:1px dashed #ccc;">Register with a new account</div> 
                      <p style="margin-left:20px;margin-top:20px;">If you are new to the IELTS online registration system, please create a new 
                      account and register here:</p>
                      <div id="btnnew-registers"  style="float:right;margin-top:10px;"class="btn btn-warning">Continue</div>    
                    </div>

                </div>
                <img class="load" src="<?php echo base_url() ?>assets/pic/load1.gif" style="margin-left:455px;margin-top:-530px;" wisth="30">
            <?php } ?>

            </div>
            







            <!-- Content Tab Finish -->
            <div class="contents">
            	
              <div class="h3" style="margin-top:10px;">Payment Information</div>

              <div style="margin-top:10px;" class="box-results"></div>


              <table style="margin-top:10px;margin-bottom:30px;" cellpadding="0px">
                <tr>
                  <td style="padding:1px;width:180px;">Test Date</td>
                  <td style="padding:1px;">:</td>
                  <td style="padding:1px;" class="result-Test-date"></td>
                </tr>
                <tr>
                  <td style="padding:1px;">Test Venue</td>
                  <td style="padding:1px;">:</td>
                  <td style="padding:1px;" class="result-Test-venue"></td>
                </tr>
                <tr>
                  <td style="padding:1px;">Test Module</td>
                  <td style="padding:1px;">:</td>
                  <td style="padding:1px;" class="result-Test-module"></td>
                </tr>
                <tr>
                  <td style="padding:1px;">Make Your Payment</td>
                  <td style="padding:1px;">:</td>
                  <td style="padding:1px;" class="result-payment">IDR&nbsp;<span class="idr"></span>&nbsp;/&nbsp;USD.<span class="dollar"></span>&nbsp;/&nbsp;GBP.<span class="gbp"></span></td>
                </tr>
              </table>

              <div class="box-step-results">
                <b style="color:#333">IDR Account</b>
                <P>
                  Lembaga Pendidikan UniShaduGuna<br/>
                  CIMB Niaga<br/>
                  Cabang Sudirman - Jakarta Selatan<br/>
                  Acct. No : 064.01.64515.006<br/>
                </P>
                <b style="color:#333">USD Account</b>
                <p>
                  Lembaga Pendidikan UniShaduGuna<br/>
                  ANZ Panin Bank<br/>
                  Jl. Jend. Sudirman ( Senayan ), Jakarta<br/>
                  Acct. No : 098509.02.00012<br/>
                </p>
              </div>
              <img class="panss" src="<?php echo base_url() ?>assets/pic/pans.png" style="float:left;margin-top:120px;margin-right:23px;">
                <div class="box-step-results">
                  <img src="<?php echo base_url() ?>assets/pic/imagepaymentconfirm.png" style="text-align:center;margin-left:20px;margin-top:20px;">
                  <div class="btn-confirmations">Payment Confirmations</div>
                  <div style="width:170px;margin:0px auto;margin-top:7px;"> 
                          upload proof of payment, <br/>
                          at the time of confirmation
                  </div>
                </div>
               <img class="panss" src="<?php echo base_url() ?>assets/pic/pans.png" style="float:left;margin-top:120px;margin-right:23px;">
                <div class="box-step-results">
                  <img src="<?php echo base_url() ?>assets/pic/notif-messages.png" style="text-align:center;margin-left:60px;margin-top:30px;">
                  <div style="width:170px;margin:0px auto;margin-top:7px;"> 
                                    After confirmation, you will get an email 
                  confirmation that we have received the 
                  payment process
                  </div>
                </div>

                <div class="important" style="margin-top:8px;">
                <img style="float:left;" width="30px" src="<?php echo base_url() ?>assets/pic/important.png">
                <p style="color:red;width:120px;float:left;font-weight:bold;margin-top:5px;margin-left:10px;" class="font1">Important</p>
                <div style="clear:both;"></div>
                    your Payment receipt must be uploaded before 16.00 WIB at (http://www.ieltsindonesia.co.id/registeronline/status). You will receive the confirmation of your IELTS Test Application within 1 hour after payment has been received. Late payments will not be processed and applications will need to be resubmitted in the following business day. Seats will also not be secured until payment is received. Thank you, IELTS INDONESIA
                </div>
              
            </div>
            




        </div>
    </div>


</div>

