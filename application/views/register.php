


<div class="content">
	
    <div class="h1" style="margin-top:20px;margin-bottom:20px;">Register</div>
	<div class="box-tab">
    	<ul>
        	<li id="btn-city" class="active"><div class="icon-city"></div><div class="title-tab"><div>STEP 1</div>Select a City</div></li>
            <li id="btn-date"><div class="icon-date"></div><div class="title-tab"><div>STEP 2</div>Find Test Date</div></li>
            <li id="btn-tos"><div class="icon-tos"></div><div class="title-tab"><div>STEP 3</div>Term & Conditions</div></li>
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
                        <p style="margin-top:10px;">Chose Your City from the list below :</p>

                        <select id="selectCity" name="city" class="chosen-select" style="width:320px;">
                        <option value="">select city available</option>
                        	<?php foreach ($city as $row1 ) { ?>
                            <option value="<?php echo $row1->city ?>" ><?php echo $row1->city ?></option>
                            <?php } ?>
                        </select>

                </div>
                
                
                <div class="right">
                    <div class="h3" style="width:200px;float:left;margin-top:0px;margin-bottom:10px;">LIST BY CITY LOCATION EXAM</div>
                        <div class="statloc" style="float:right;width:120px;font-size:18px;margin-top:10px;"></div>
                          
                          <div class="table-city" style="width:100%;height:200px;overflow:auto;">	
                            <table class="table table-striped">
                            	<tr>
                                	<th style="width:30%;border-top:none;">Location Name</th>
                                    <th style="width:40%;border-top:none;">Address</th>
                                    <th style="width:20%;border-top:none;">Available</th>
                                    <th style="width:10%;border-top:none;">Select</th>
                                </tr>

                                <?php foreach ($schedule as $row ) { ?>
                                <?php $available = $this->listexams->getAvailable($this->listexams->getIdbranche($row->branchname ));

                                    if($available > 0 ) {
                                        $return = ''.$available.' Exam Date ';
                                    } else {
                                        $return = 'Not Available';
                                    }

                                ?>
                                <tr>
                                	<td style="color:#333;"><?php echo $row->branchname ?></td>
                                    <td><?php $this->listexams->getaddr($row->branchname ); ?></td>
                                    <td ><p class="font1" style="font-size:12px;color:#00a2c8;"><?php echo $return ?></p></td>
                                    <td><input class="locations-test" style="margin-top:15px;" value="<?php echo $this->listexams->getIdbranches($row->branchname); ?>" type="radio" name="location-test" /></td>
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

                          <div class="table-date" style="width:100%;height:200px;overflow:auto;">    
                            
                          </div>
                          <div style="width:40px;float:left;display:none;" class="codeidschedules"></div>
                        <img class="load" style="margin-left:280px;"  src="<?php echo base_url() ?>assets/pic/load1.gif" width="30">
                    <div id="next-date"  style="float:right;margin-top:10px;margin-right:-60px;"class="btn btn-warning">Continue</div>

                </div>
            </div>
            




            <!-- Content Tab Select Terms On Conditions -->
            <div id="sec-tos" class="contents" style="padding-top:30px;">
            
            <div class="h2">Terms And Conditions</div>
            <div class="box-tos">	
            <h4>You must...</h4>
            <ul>
              <li>provide proof of your identity (passport or national identity card) at
                  registration. This identity document must contain a number, a signature, a
                  date of birth and a photograph. You should contact your test centre who will
                  tell you which type of identity document they accept. Candidates taking the
                  test outside their own country must produce a passport.</li>
              <li>provide two recent identical passport-sized photographs on registration.
                  (See page iv for guidance on photograph requirements.)</li>
              <li>inform the test centre of any changes to your identity document before the
                  test date. If you do not do this you will not be allowed to take the test and you
                  will not be eligible for a refund or transfer</li>
              <li>bring the same identity document on the test day as the one recorded on
                  your Application Form. If you do not do this you will not be allowed to take
                  the test and you will not be eligible for a refund or transfer. </li>
              <li>arrive at the test centre before the scheduled test start time. If you arrive late:
                  – you will not be admitted to the test room.<br/>
                  – you will not be allowed to take any of the test components.<br/>
                  – you will not be eligible for a refund or transfer.</li>
              <li>leave personal belongings outside the test room. The following items may
                  not be taken into the test room: bags, correction fluid, highlighter pens
                  and electronic devices such as mobile phones, pagers, recorders and
                  dictionaries. Candidates must ensure that mobile phones and pagers which
                  are left outside the test room are switched off. Any candidate who does not
                  switch off their phone or pager, or takes any electronic device into the test
                  room, will not be allowed to complete the test and will not receive an IELTS
                  test result or be eligible for a refund or transfer. Candidates must not bring
                  valuables to the test centre as the test centre cannot be responsible for these.</li>
              <li>consent for your identity to be verified either at test registration or on test
                  day. This may include<br/>
                  – having your photograph taken.<br/>
                  You will be required to temporarily remove any covering from your
                  face. Any candidate who refuses to have a photograph taken will not
                  be permitted to sit the test and will not be entitled to a refund. This
                  photograph taken by the test centre will appear on your Test Report Form.
                  – providing a sample of your signature.<br/>
                  – having your finger-scan taken.</li>
              <li>keep only the following items on your desk: your identity document, pen(s),
                  pencil(s) and eraser(s). </li>

              <li>
                  tell the test supervisor or invigilator at once:<br/>
                  – if you think you have not been given the correct question paper.<br/>
                  – if the question paper is incomplete or illegible.  
              </li>
              <li>raise your hand to attract attention if you are in doubt about what you should
                  do. An invigilator will come to your assistance. Candidates may not ask for,
                  and will not be given, any explanation of the test questions</li>
              <li>inform the test supervisor or invigilator on the day of the test, if you believe
                  that your performance may be affected by ill health, by the way in which
                  the test is delivered at the centre or for any other reason. If you have a
                  complaint relating to the delivery of the test, you must submit your complaint
                  to the test centre before your results have been issued. The IELTS Test
                  Partners will not accept complaints relating to the delivery of the test after
                  results have been issued</li>
              <li>when leaving the test room at the end of the test, leave behind all test
                  materials. The test materials include, but are not limited to, question papers,
                  Speaking tasks, answer sheets/booklets and any paper used for rough work.
                  Any candidate who attempts to remove test materials from the test room will
                  be disqualified and will not receive an IELTS test result.</li>

              <h4>You must not ...</h4>
              <ul>
                <li>talk to or disturb other candidates once the test has started.</li>
                <li>lend anything to, or borrow anything from, another candidate during the test.</li>
                <li>eat or smoke in the test room</li>
                <li>leave the test room without the permission of the test supervisor or invigilator.</li>
                <li>leave your seat until all test materials have been collected and you have been told you can leave</li>
                <li>engage in any form of malpractice which may damage the integrity and security of the IELTS test. Malpractice includes, but is not limited to:</li>
                <li>-attempting to cheat in any way.
                    – impersonating another candidate or having another personimpersonate you.
                    – copying the work of another candidate.
                    – disrupting the test in any way.
                    – reproducing any part of the test in any medium.
                    – attempting to alter the data on the Test Report Form.
                </li>
                <li>Candidates engaging in malpractice will not be allowed to complete the
                    test and will not receive an IELTS test result. Candidates who are found to
                    have engaged in malpractice on test day after their result has been issued
                    will have their result can</li>
              </ul>


              <div class="h3" style="margin-top:30px;">Your IELTS test result</div>

              <ul>
                <li>Results are issued by test centres, usually 13 days after the test</li>
                <li>You will receive only one copy of your Test Report Form. The test centre is
                    not permitted to issue a replacement copy in the event of loss or damage.</li>
                <li>The Test Report Form will be issued in your name as it appears on the identity
                    document used at registration. If you find that your personal details are
                    incorrect on the Test Report Form, please contact the centre where you took
                    the test to request changes. Documentation must be provided to verify the
                    correct details. If the centre is unable to assist with your request for a change
                    to your personal details please contact either IDP (ielts@idp.com) or British
                    Council (ielts@britishcouncil.org) for further advice</li>
                <li>If you change your name after receiving your Test Report Form, the name
                    will not be changed on the Test Report Form. In the unusual event that
                    a replacement Test Report Form is approved centrally by the IELTS Test
                    Partners, it will be issued with the name provided on the original Test Report
                    Form.</li>
                <li>Your result may not be issued 13 days after the test if any of the IELTS Test
                    Partners deem it necessary to review any matter associated with your test.
                    In exceptional circumstances you may be required to re-take one or more
                    IELTS components.</li>
                <li>The Test Report Form may be cancelled after it has been issued if any
                    irregularity is identified. You may be required to re-take one or more IELTS
                    components</li>
                <li>Your result will be disclosed by the IELTS Test Partners to the Recognising
                    Organisations which you nominated on your Application Form, for the
                    purpose of allowing those organisations to verify the result or to carry out
                    any enquiries in relation to suspected malpractice. </li>
                <li>f any of the data on the Test Report Form provided by you or your agent to
                    Recognising Organisations has been altered in any way, your original test
                    result will be cancelled by the IELTS Test Partners. </li>
                <li>You will not be permitted access to the work you produce in the IELTS test.
                    The IELTS Test Partners will retain the work you produce to assess your test
                    performance, and it may be used for quality control purposes and research
                    activities.</li>
              </ul>


              <div class="h3" style="margin-top:30px;">Cancelling your IELTS test or requesting a transfer</div>

              <ul>
                <li>If you cancel your test or request a transfer five weeks or more before the
                    test date, the test centre will charge an administration fee of up to 25% of
                    the total test fee. </li>
                <li>If you cancel your test within five weeks of the test date for any reason apart
                    from medical ones, you will not be eligible to receive a refund. If you cancel
                    your test or request a transfer within five weeks of the test date for medical
                    reasons, you must provide supporting medical evidence within five working
                    days of the test date. Only evidence of serious illness will be considered.
                    Only original medical certificates will be accepted and must state inability to
                    appear for the test on the scheduled test date. </li>
              </ul>

              <div class="h3" style="margin-top:30px;">How IELTS uses your information</div>

              <ul>
                <li>The IELTS Test Partners recognise and support the right of genuine IELTS
                    test candidates to privacy</li>
                <li>Test Report Forms will only be sent to those Recognising Organisations
                    nominated by the IELTS candidate on their Application Form or at the
                    request of the candidate after the issue of results.</li>
                <li>The IELTS Test Partners or their authorised representatives may share
                    candidate personal data including without limitation test performance or
                    score data or photographs taken by the IELTS test centre with educational
                    institutions, governments (including visa processing authorities),
                    professional bodies and commercial organisations that recognise IELTS
                    scores (‘Recognising Organisations’) or law enforcement agencies where
                    required for verification purposes or other purposes to protect the IELTS
                    test and its stakeholders against any form of malpractice. Finger-scan data,
                    where obtained, will not be disclosed to any entity except the IELTS Test
                    Partners.</li>
                <li>The IELTS Test Partners may use IELTS test score data and test responses,
                    in an anonymous form, for informational, research, statistical or training
                    purposes.</li>
              </ul>
            </ul>
            <div class="box-termconditions">
              <input type="radio" name="combo-tos" style="float:left;" class="combo-tos">
              <p style="width:200px;float:left;color:#802222;margin-left:10px;">I agree to these terms</p>
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
            	<div class="left"></div>
                <div class="right"></div>
            </div>
            




        </div>
    </div>


</div>

