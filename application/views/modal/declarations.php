<script type="text/javascript">
    $(document).ready(function() {
        $('#registernow').click(function() {
          $('#declarations').modal('hide');
             $('#parentloading').fadeIn('slow');
                $("html, body").animate({ scrollTop: 0 }, "slow");
                var idschedules = $('.codeidschedules').html();

                
                            var counter=2;
                              var countdown = setInterval(function(){
                                if (counter == 0) {
                                clearInterval(countdown);
                                

                                  if($('input[name=date-test]').is(':checked')) {
                                      $.ajax({
                                      type  : "POST",
                                      url: ""+base_url+"register/proses_register/"+idschedules+"",
                                      data: $("#myformRegister").serialize(),
                                      dataType: "json",
                                      success : function(response){
                                      $('#parentloading').fadeOut('slow');  
                                               $('#btn-city').attr('class','visited');
                                               $('#btn-date').attr('class','visited');
                                               $('#btn-tos').attr('class','visited');
                                               $('#btn-tos').attr('class','visited');
                                               $('#btn-candidate').attr('class','visited');
                                               $('#btn-finish').attr('class','active');

                                              var testvenue = $('.displaylocation').html();

                                              $.each( response , function(key,val) {

                                                $('.result-Test-date').html(val.testdate);
                                                $('.result-Test-venue').html(testvenue);
                                                $('.result-Test-module').html(val.module);
                                                $('.idr').html(val.rupiah);
                                                $('.dollar').html(val.dollar);
                                                $('.gbp').html(val.gbp);



                                                  if( val.status == 'success') {
                                                     $('.box-results').html('<b class="font1" style="color:#802222;">Register successful.</b>  <span style="color:#e44b00;"> -   <b style="color:#cd4204">Email Address Verification  needed.</b>Before you can login , please check your email to activate your user account.</span>');
                                                     $('.content-tab').animate({ scrollLeft:'3840px' });
                                                     $('#sticky').sticky('<span style="color:#802222;">Register successful.</span>');
                                                     $('.box-tab ul li').attr('action','disabled');
                                                  } else if( val.status == 'regcenter') {
                                                     $('.box-results').html('<b class="font1" style="color:#802222;">Register successful.</b>  <span style="color:#e44b00;"> -   <b style="color:#cd4204">By Register Center</b> -  Here are the details:</span>');
                                                     $('.content-tab').animate({ scrollLeft:'3840px' });
                                                     $('#sticky').sticky('<span style="color:#802222;">Register successful.</span>');
                                                     $('.box-tab ul li').attr('action','disabled');
                                                  } 
                                              });
                                                  

                                           

                                          }
                                      });

                                    } else {
                                      $('#sticky').sticky('<span style="color:#802222;">date of the test must be selected</span>');
                                  }

                            }
                              counter--;
                            }, 500);
        });
    });
</script>

<style>
  #declarations ul li {
    border-bottom:1px solid #ececec;
    padding-top:7px;
    padding-bottom: 7px;
  }
</style>

<div id="declarations" class="modal hide fade in" style="display: none;margin-top:-300px; ">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h3>Declarations</h3>
            </div>
            <div class="modal-body">
              <ul style="list-style:number;">
                <li>I acknowledge that the IELTS test is jointly managed by British Council, IDP: IELTS Australia and Cambridge ESOL, collectively referred to as the
IELTS Test Partners.</li>
<li>I certify that the information on this Application Form is complete, true and accurate.</li>
<li>I understand that the personal data on this Application Form is collected for the purposes of the IELTS test, and I consent for this data to be
disclosed to, processed and stored by the IELTS Test Partners for the purpose of such administration. I further consent for this data and my
test result to be disclosed by the IELTS Test Partners to those Recognising Organisations to which I apply, for the purpose of allowing these
organisations to verify my test result or to carry out enquiries in relation to suspected malpractice. If the IELTS Test Partners discover that a false or
altered Test Report Form has been provided to any of these Recognising Organisations I further consent that the IELTS Test Partners may inform the
same and provide them with my personal data and any relevant details relating to the work I produce as part of my test taking.</li>
<li>I understand that my personal data may be processed in an anonymous form for statistical and research purposes for the development of Cambridge
ESOL examinations. Cambridge ESOL and the centre administering the test confirm that they will not disclose personal information about candidates to
others except as stated in this Declaration or to the extent permitted by law.</li>
<li>I understand that I may view a copy of my personal data contained in the Application Form by contacting ielts@cambridgeesol.org. I understand that
a fee will be charged for access to this information.</li>
<li>I understand that if I want a copy of my finger scan it can only be provided as a Binary Large Object (BLOB) and the request must be made to
ielts@idp.com or ielts@britishcouncil.org. I understand a fee will be charged for access to this information.</li>
<li>I understand that if the details on this form are not completed my application may not be processed. I further understand that completing and
submitting this Application Form does not guarantee enrolment on my preferred test date or at my preferred test location. I understand that my
enrolment will be confirmed in writing from the test centre.</li>
<li>I understand that any personal data collected during the identity verification process by the centre either at test registration or on test day will be
processed and securely stored by the IELTS Test Partners for the purpose of the IELTS test. I acknowledge that the photograph taken of me by the
centre will be provided upon request to any Recognising Organisations to which I apply for the purposes of allowing these organisations to verify my
test results or to carry out enquiries in relation to possible malpractice or test integrity issues. I understand that where finger-scan data is obtained it
will not be disclosed to any entity except the IELTS Test Partners.</li>
<li>I understand that I will have my photograph taken by the test centre to allow the Test Report Form to be released. If I have not had my photograph
taken by the test centre no result will be issued.</li>
<li>I acknowledge that I have read the IELTS Notice to Candidates contained on page i of this document and agree to abide by the rules and regulations
contained therein.</li>
<li>I understand there may be local terms and conditions I must comply with and that the test centre will provide details of these on request.</li>
<li>I understand that the IELTS Test Partners have a responsibility to all candidates and Recognising Organisations to ensure the highest confidence
in the accuracy and integrity of test results and that the IELTS Test Partners therefore reserve the right to withhold test results temporarily or
permanently, or to cancel test results which have been issued, if they consider those results to be unreliable for reasons of suspected malpractice or
any other irregularity in the test process.</li>
<li>I understand that my result may not be issued 13 days after the test if any of the IELTS Test Partners deem it necessary to review any matter
associated with my test, including making enquiries as to whether any rules or regulations have been breached, as outlined in the IELTS Notice to
Candidates. I understand that in exceptional circumstances I may be required to re-take one or more IELTS components.</li>
<li>I understand that if I engage in any form of malpractice, or do anything that might damage the integrity and security of IELTS, I will not receive a
test result, my test fee will not be refunded and I may be prohibited from taking the IELTS test in the future. Despite and without limiting any of the
terms of this Declaration, I understand that details of any malpractice (including evidence of suspected malpractice) that has been established,
is suspected, or is being formally investigated may be provided to Recognising Organisations, including visa processing authorities, or otherwise
disclosed in accordance with the law, where required for verification purposes or other purposes to protect the IELTS test and its stakeholders
against any form of malpractice. I further understand that suspected malpractice will be reported centrally to the IELTS Test Partners and to any
relevant test centre by the centre where the suspected malpractice occurred.</li>
<li>I understand that if any other person attempts to take the IELTS test in my place (i.e. in place of the person whose details appear on this form), both I and
such person will be liable to prosecution. Details relating to the situation may be provided to the relevant authorities, including visa processing authorities.</li>
<li>I understand that the work I produce as part of the IELTS test remains the property of the IELTS Test Partners. Under no circumstances will it be
released to candidates or to institutions or organisations, except in the investigation of suspected malpractice whereby the work I produce as part of
the IELTS test may be provided to relevant authorities.</li>
<li>I agree that an observer may attend my Speaking test as part of the monitoring process.</li>
<li>I understand that I will be charged the full test fee if I cancel my test or request a transfer within five weeks of the test date, unless I provide
appropriate medical evidence, within five days of the test date, to support the cancellation or transfer.</li>
<li>I acknowledge that I have read the IELTS Information for Candidates booklet.</li>
<li></li>
</ul> 

<div style="margin-top:8px;">
  Disclaimer: The International English Language Testing System (IELTS) is designed to be one of many factors used by academic institutions, government
agencies, professional bodies and employers in determining whether a test taker can be admitted as a student or be considered for employment or for
citizenship purposes. IELTS is not designed to be the sole method of determining admission or employment for the test taker. IELTS is made available
worldwide to all persons, regardless of age, gender, race, nationality or religion, but it is not recommended to persons under 16 years of age.
</div>

<div style="margin-top:8px;">
 British Council, IDP: IELTS Australia and Cambridge ESOL and any other party involved in creating, producing, or delivering IELTS shall not be liable for
any direct, incidental, consequential, indirect, special, punitive, or similar damages arising out of access to, use of, acceptance by, or interpretation of the
results by any third party, or any errors or omissions in the content thereof. 
</div>


            </div>
            <div class="modal-footer">
             <div id="registernow"  style="float:right;margin-top:10px;"class="btn btn-success"data-dismiss="modal">Register</div>
            </div>
           
          </div>

