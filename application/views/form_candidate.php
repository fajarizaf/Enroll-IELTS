<script type="text/javascript" src="<?php echo base_url();?>assets/js/post-register-candidate.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".select").selecter();
    $(".box-selectdate .selecter").remove();
    $("input[type=hidden]").val('');
    $("textarea").val('');
    $("select").prop('selectedIndex',0);
    $('.register-new-account input[type=radio]').attr('checked', false);


         $('.box-list-country').slimScroll({
             width: '534px',
             height:'300px'
         });

         $('.box-list-language').slimScroll({
             width: '534px',
             height:'300px'
         });

         $('.box-list-question').slimScroll({
             width: '534px',
             height:'300px'
         });

         $('.box-list-level').slimScroll({
             width: '534px',
             height:'300px'
         });

         $('.box-list-sector').slimScroll({
             width: '534px',
             height:'300px'
         });



         $('.selecboxstyle').click(function() {
                  $(this).attr('selection','active');
                });

                $('.specialneeds').click(function() {
                    var specialneeds = $(this).val();
                      if(specialneeds == 'YES') {
                        $('.listspecialneeds').fadeIn('slow');
                        $('.specialneedsdesc').val('');
                        $('.notes').val(''); 
                        $('.specialneedsdesc').focus();
                      } else {
                        $('.listspecialneeds').fadeOut('slow');
                        $('.notes').val('-');
                        $('.specialneedsdesc').val('-');
                      }
                });


                $( "#date_of_birth" ).datepicker({
                    showOn: "button",
                    buttonImage: "<?php echo base_url(); ?>assets/pic/calendar.jpg",
                    buttonImageOnly: true,
                    dateFormat: "yy-m-d",

                  }); 

                $('#country_applying').change(function() {
                    $('#country_applying').valid();
                });
                
                $('#many_years').change(function() {
                    $('#many_years').valid();
                });

                $('.gender').change(function() {
                    if($(this).is(':checked')) {
                        $('.gender').valid();
                    }
                });

                $('.identity').change(function() {
                    if($(this).is(':checked')) {
                        $('.identity').valid();
                    }
                });

                $('#level_of_education').change(function() {
                    $('#level_of_education').valid();
                });

    
     });   

</script>
 <div class="register-new-account">
                
                <div class="h3" style="margin-bottom:20px;">Basic Info</div>

        <?php $atributes = array ('id' => 'myformRegister'); ?> 
        <?php echo form_open_multipart ('member/proses_register', $atributes); ?>

                <table class="table table-striped">

                  <tr>
                    <td style="width:300px;">Title*</td>
                    <td>:</td>
                    <td>
                    <select class="select" id="title" name="title">
                        <option value="Mr">Mr</option> 
                        <option value="Mrs">Mrs</option>
                        <option value="Ms">Ms</option> 
                        <option value="Miss">Miss</option>
                        <option value="Dr">Dr</option>
                        <option value="Other">Other</option> 
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Username*</td>
                    <td>:</td>
                    <td><input type="text" id="username" name="username"></td>
                  </tr>
                  <tr>
                    <td>Password*</td>
                    <td>:</td>
                    <td><input type="password" id="password" name="password"></td>
                  </tr>
                  <tr>
                    <td>Retype Password*</td>
                    <td>:</td>
                    <td><input type="password" id="retype_password" name="retype_password"></td>
                  </tr>

                  <tr>
                    <td>Last Name (family name/surname)*</td>
                    <td>:</td>
                    <td><input type="text" id="last_name" name="last_name"></td>
                  </tr>

                  <tr>
                    <td>First (given) name(s)*</td>
                    <td>:</td>
                    <td><input type="text" class="first_name" name="first_name"></td>
                  </tr>

                  <tr>
                    <td>User Gender*</td>
                    <td>:</td>
                    <td>
                      <input type="radio" class="gender" name="gender" value="M" style="float:left;"><div style="float:left;width:50px;">Male</div>
                      <input type="radio" class="gender" name="gender" value="F" ><div style="float:left;width:50px;">Female</div>
                    </td>
                  </tr>

                  <tr>
                    <td>Phone Number*</td>
                    <td>:</td>
                    <td><input type="text" id="phone_number" name="phone_number"></td>
                  </tr>

                  <tr>
                    <td>Email Address*</td>
                    <td>:</td>
                    <td>
                    <input type="text" id="email_address" style="float:left;" name="email_address" >
                    <div class="resultemail" style="display:none;margin-left:10px;-moz-border-radius:3px 3px 3px;-webkit-border-radius:3px 3px 3px;border-radius:3px 3px 3px;float:left;padding:5px;background:#fff5d4;border:1px solid #ffa500;width:170px;height:20px;color:#d37700;margin-top:4px;"></div>
                    <img src="<?php echo base_url(); ?>assets/pic/load1.gif" style="margin-top:5px;margin-left:5px;float:left;margin-right:10px;" class="load">
                    </td>
                  </tr>

                  <tr>
                    <td>Confirm Email*</td>
                    <td>:</td>
                    <td><input type="text" id="confirm_email" name="confirm_email"></td>
                  </tr>

                  <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><textarea id="address" name="address" ></textarea></td>
                  </tr>

                  <tr>
                    <td>City*</td>
                    <td>:</td>
                    <td><input type="text" id="city" name="city"></td>
                  </tr>
                  <tr>
                    <td>Zipcode*</td>
                    <td>:</td>
                    <td><input type="text" id="zipcode" name="zipcode"></td>
                  </tr>
                  <tr>
                    <td>Country*</td>
                    <td>:</td>
                    <td>
                       <div href="#listcity" data-toggle="modal" id="namecountry" class="selecboxstyle"></div>
                       <input type="hidden"  id="country" name="country">
                       <input type="text" name="codecity" class="codecity">
                    </td>
                  </tr>
                  <tr>
                    <td>Date Of Birth*</td>
                    <td>:</td>
                    <td><input type="text" id="date_of_birth" name="date_of_birth"></td>
                  </tr>
                </table>

                <div class="h3" style="margin-top:40px;margin-bottom:20px;">Detail Info</div>

                <table class="table table-striped">
                  <tr>
                    <td style="width:300px;">Identity Document</td>
                    <td></td>
                    <td>
                      <input type="radio" style="float:left;" class="identity" name="identity" value="passport" style="float:left;"><div style="float:left;width:100px;margin-left:10px;">Passport</div>
                      <input type="radio" style="float:left;" class="identity" name="identity" value="nic" ><div style="float:left;width:150px;margin-left:10px;">Number Identity Card</div>
                    </td>
                  </tr>
                  <tr>
                    <td>Pasport/NIC Number*</td>
                    <td>:</td>
                    <td><input type="text" id="number_identity" name="number_identity"></td>
                  </tr>
                  <tr>
                    <td>Country or region of origin *</td>
                    <td>:</td>
                    <td>
                      
                      <div href="#listcity" data-toggle="modal" id="countryorigin" class="selecboxstyle"></div>
                      <input type="hidden" id="country_origin" name="country_origin">
                      <input type="text" name="codecountryorigin" class="codecountryorigin">  
                    </td>
                  </tr>
                  <tr>
                    <td>First Language*</td>
                    <td>:</td>
                    <td>
                      <div href="#listlanguage" data-toggle="modal" id="namelanguage" class="selecboxstyle"></div>
                       <input type="hidden" id="language" name="language">
                       <input type="text" name="codelang" class="codelang">
                    </td>
                  </tr>
                  <tr>
                    <td>Occupation (sector)*</td>
                    <td>:</td>
                    <td>
                      <div href="#sector" data-toggle="modal" id="namesector" class="selecboxstyle"></div>
                       <input type="hidden" id="sectors" name="sectors">
                       <input type="text" name="codesector" class="codesector">
                    </td>
                  </tr>
                  <tr class="sector_other">
                    <td style="background:#fff5d4;color:#D37700;border:none;">If other please specify**</td>
                    <td style="background:#fff5d4;border:none;color:#D37700;">:</td>
                    <td style="background:#fff5d4;border:none;"><input style="border-color:orange" type="text" id="sector_other" name="sector_other"></td>
                  </tr>
                  <tr>
                    <td>Occupation (level)*</td>
                    <td>:</td>
                    <td>
                      <div href="#levels" data-toggle="modal" id="namelevel" class="selecboxstyle"></div>
                       <input type="hidden" id="levelss" name="level">
                       <input type="text" name="codelevel" class="codelevel">
                    </td>
                  </tr>
                  <tr class="level_other">
                    <td style="background:#fff5d4;color:#D37700;border:none;" >If other please specify**</td>
                    <td style="background:#fff5d4;border:none;color:#D37700;">:</td>
                    <td style="background:#fff5d4;border:none;"><input style="border-color:orange" type="text" id="level_other" name="level_other"></td>
                  </tr>
                  <tr>
                    <td>Why are you taking the test?*</td>
                    <td>:</td>
                    <td>
                      <div href="#question" data-toggle="modal" id="namequestion" class="selecboxstyle"></div>
                       <input type="hidden" id="taking_test" name="taking_test">
                       <input type="text" name="codequestion" class="codequestion">
                    </td>
                  </tr>
                  <tr class="question_other">
                    <td  style="background:#fff5d4;color:#D37700;border:none;">If other please specify**</td>
                    <td  style="background:#fff5d4;color:#D37700;border:none;">:</td>
                    <td  style="background:#fff5d4;color:orangered;border:none;"><input type="text" id="other_taking_test" name="other_taking_test"></td>
                  </tr>
                  <tr>
                    <td>Which country are you applying/intending to go to?*</td>
                    <td>:</td>
                    <td>
                      <select class="select" name="country_applying" id="country_applying">
                                                            <option value="">Select</option>
                                                            <option value="AUS">Australia</option>
                                                            <option value="CAN">Canada</option>
                                                            <option value="NZ">New Zealand</option>
                                                            <option value="EIR">Republic of Ireland</option>
                                                            <option value="UK">United Kingdom</option>
                                                            <option value="USA">United States of America</option>
                                                            <option value="000">Other</option>
                    </select>
                    </td>
                  </tr>
                  <tr class="other_applying">
                    <td style="color:#D37700;border:none;">If other please specify**</td>
                    <td>:</td>
                    <td><input type="text" id="other_country_applying" name="other_country_applying"></td>
                  </tr>
                  <tr>
                    <td>Where are you currently studying English (if applicable)?</td>
                    <td>:</td>
                    <td><input type="text" id="studying_English" name="studying_English"></td>
                  </tr>
                  <tr>
                    <td>What level of education have you completed?*</td>
                    <td>:</td>
                    <td>
                    <select class="select" name="level_of_education" id="level_of_education">
                                                            <option value="">Select</option>
                                                            <option value="0" selected="selected">Secondary up to 16 years</option>
                                                            <option value="1">Secondary 16 to 19 years</option>
                                                            <option value="2">Degree or equivalent</option>
                                                            <option value="3">Post graduate</option>
                                                            <option value="000">Other</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td>How many years have you been studying English?*</td>
                    <td>:</td>
                    <td>
                      <select class="select" name="many_years" id="many_years">
                                                                <option value="">Select</option>
                                                                <option value="Less than 1 year">Less than 1 year</option>
                                                                <option value="2 years">2 years</option>
                                                                <option value="3 years">3 years</option>
                                                                <option value="4 years">4 years</option>
                                                                <option value="5 years">5 years</option>
                                                                <option value="6 years">6 years</option>
                                                                <option value="7 years">7 years</option>
                                                                <option value="8 years">8 years</option>
                                                                <option value="9 years or more">9 years or more</option>
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td>Do you have any special needs due to ill health/medical conditions?*</td>
                    <td>:</td>
                    <td >
                      <input type="radio" class="specialneeds" name="specialneeds" value="YES" style="float:left;"><div style="float:left;width:20px;margin-left:10px;" class="label label-warning">YES</div>
                      <input type="radio" checked class="specialneeds" name="specialneeds" value="NO" style="float:left;margin-left:10px;" ><div style="float:left;width:20px;margin-left:10px;" class="label label-warning">NO</div>
                    </td>
                  </tr>
                  <tr class="listspecialneeds">
                    <td style="background:#f9edbe;border-color:#f9edbe;color:orange;" colspan="3">If yes, please specify your requirements below. You must attach supporting medical evidence to this form. Requests for modified test materials must be submitted at least 3 months before the test.</td>
                  </tr>
                  <tr  class="listspecialneeds">
                    <td style="background:#f9edbe;border-color:#f9edbe;color:orangered;" colspan="3">
                    <p>Please Specify**</p>
                    <textarea style="width:100%;-moz-border-radius:2px 2px 2px;-webkit-border-radius:2px 2px 2px;border-radius:2px 2px 2px" class="specialneedsdesc" name="specialneedsdesc"></textarea></td>
                  </tr>
                  <tr  class="listspecialneeds">
                  <td style="background:#f9edbe;border-color:#f9edbe;" colspan="3">
                    <p>Notes**</p>
                    <textarea style="height:40px;width:100%;-moz-border-radius:2px 2px 2px;-webkit-border-radius:2px 2px 2px;border-radius:2px 2px 2px" class="notes" name="notes"></textarea></td>
                  </tr>

                  <tr>
                    <td colspan="2" ><span style="font-weight:bold;">Please click 'Browse' to upload ID Card</span><br/>
                        Browse to image</td>
                    <td>
                     <input type="file" onChange="JavaScript:AjaxUploads.UploadsFile();" name="uploadidcard[]" id="uploadidcard" style="display:none;" class="uploadidcard">
                     <input type="hidden" name="uploadfile" class="uploadfile"> 
                     <div name="upload" style="float:right;" class="btn btn-warning" id="uploadidcard1" value="Upload">Upload</div>
                     <img src="<?php echo base_url(); ?>assets/pic/load1.gif" style="margin-top:5px;margin-left:5px;float:right;margin-right:10px;" class="load">
                     <div class="resultphoto" style="float:right;margin-right:10px;"></div>
                    </td>
                  </tr>

                  <tr>
                    <td colspan="3" >
                      List of academic institutions/government agencies/professional bodies/employer:
                      Please give details below of academic institutions/government agencies/professional bodies/employers you would like your result sent to. Add your file/case number if known. Results may be sent either electronically or by post to these organisations. The centre may charge a postal fee for results sent internationally or by courier. The Test Report Form will not be sent to migration or education agents. Please note that organisations you have listed below may access your results before you have received them by mail.
                      
                    </td>
                  </tr>

                  <tr class="recognizing-organizations">
                    <td colspan="3" >
                     <table>
                       <tr style="border:none;">
                        <td style="border:none;background:none;">Name of person/department</td>
                        <td style="border:none;background:none;">:</td>
                        <td style="border:none;background:none;"><input type="text" name="name-person" class="name-person"></td>
                       </tr>

                       <tr style="border:none">
                        <td style="border:none;background:none;">Name of institution</td>
                        <td style="border:none;background:none;">:</td>
                        <td style="border:none;background:none;"><input type="text" name="name-institusi" class="name-institusi"></td>
                       </tr>

                       <tr style="border:none">
                        <td style="border:none;background:none;">File/case number</td>
                        <td style="border:none;background:none;">:</td>
                        <td style="border:none;background:none;"><input type="text" name="case-number" class="case-number"></td>
                       </tr>

                       <tr style="border:none">
                        <td style="border:none;background:none;">Address</td>
                        <td style="border:none;background:none;">:</td>
                        <td style="border:none;background:none;">
                          <textarea class="addr" name="addr"></textarea>
                        </td>
                       </tr>
                     </table>
                    </td>
                  </tr>

                  <tr>
                    <td colspan="3">
                      <button name="upload" style="float:left;margin-top:0px;" class="btn" value="Upload">Add Recognising Organisations</button>
                    </td>
                  </tr>


                  <tr>
                    <td colspan="3">
                      <input type="submit" name="Register" id="SubmitRegister" style="float:right;width:200px;" class="btn btn-warning"  value="Register">
                    </td>
                  </tr>


                <table>

        <?php echo form_close(); ?>

                </div>




<script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script> 
        <script>
            
            jQuery.validator.setDefaults({
              ignore: '',
              success: "valid",
              submitHandler: function(form) { 
                $('#parentloading').fadeIn('slow');
                $("html, body").animate({ scrollTop: 0 }, "slow");
                var idschedules = $('.codeidschedules').html();

                
                var counter=2;
                              var countdown = setInterval(function(){
                                if (counter == 0) {
                                clearInterval(countdown);
                                $('#parentloading').fadeOut('slow');

                                  if($('input[name=date-test]').is(':checked')) {
                                      $.ajax({
                                      type  : "POST",
                                      url: ""+base_url+"register/proses_register/"+idschedules+"",
                                      data: $("#myformRegister").serialize(),
                                      dataType: "json",
                                      success : function(response){

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


                           
              }
            });
            
            
            $( "#myformRegister" ).validate({
              rules: {
                username: {
                  required: true
                },
                password: {
                  required: true
                },
                retype_password: {
                      required: true,
                      equalTo: '#password'
                    },
                last_name: {
                  required: true
                },
                first_name: {
                  required: true
                },
                gender: {
                  required: true
                },
                phone_number: {
                  required: true
                },
                email_address: {
                  required: true
                },
                confirm_email: {
                      required: true,
                      equalTo: '#email_address'
                    },
                address: {
                  required: true
                },
                city: {
                  required: true
                },
                zipcode: {
                  required: true
                },
                codecity: {
                  required: true
                },
                date_of_birth: {
                  required: true
                },
                identity: {
                  required: true
                },
                number_identity: {
                  required: true
                },
                codecountryorigin: {
                  required: true
                },
                codelang: {
                  required: true
                },
                codesector: {
                  required: true
                },
                sector_other: {
                  required: true
                },
                codelevel: {
                  required: true
                },
                level_other: {
                  required: true
                },
                codequestion: {
                  required: true
                },
                other_taking_test: {
                  required: true
                },
                country_applying: {
                  required: true
                },
                other_country_applying: {
                  required: true
                },
                studying_English: {
                  required: true
                },
                level_of_education: {
                  required: true
                },
                many_years: {
                  required: true
                },
                specialneedsdesc: {
                  required: true
                },
                notes: {
                  required: true
                },
                uploadfile: {
                  required: true
                }
              }

              
              
              
            });
        </script>
