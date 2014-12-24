<script type="text/javascript" src="<?php echo base_url();?>assets/js/post-register-candidate.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".select").selecter();



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

        <?php foreach ($datausers as $row) { ?>

                <table class="table table-striped">

                
                  <tr>
                    <td style="width:400px">Username*</td>
                    <td style="width:10px">:</td>
                    <td><?php echo $row->username ?></td>
                  </tr>
                  

                  <tr>
                    <td>Last Name (family name/surname)*</td>
                    <td>:</td>
                   <td><?php echo $row->userfamilyname ?></td>
                  </tr>

                  <tr>
                    <td>First (given) name(s)*</td>
                    <td>:</td>
                    <td><?php echo $row->userfirstname ?></td>
                  </tr>

                  <tr>
                    <td>User Gender*</td>
                    <td>:</td>
                    <td><?php if ($row->usergender == 'F') { echo 'Female'; } else { echo 'Male'; } ?></td>
                  </tr>

                  <tr>
                    <td>Phone Number*</td>
                    <td>:</td>
                    <td><?php echo $row->userphone ?></td>
                  </tr>

                  <tr>
                    <td>Email Address*</td>
                    <td>:</td>
                    <td><?php echo $row->useremail ?></td>
                  </tr>


                  <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?php echo $row->useraddr1 ?></td>
                  </tr>

                  <tr>
                    <td>City*</td>
                    <td>:</td>
                    <td><?php echo $row->useraddr3 ?></td>
                  </tr>
                  <tr>
                    <td>Zipcode*</td>
                    <td>:</td>
                    <td><?php echo $row->useraddr4 ?></td>
                  </tr>
                  <tr>
                    <td>Country*</td>
                    <td>:</td>
                    <td><div class="label" style="width:20px;float:left;"><?php echo  $row->useraddr2 ?></div>&nbsp;&nbsp;<?php $this->showuser->getnameaditionalinfo('city', $row->useraddr2 ) ?></td>
                  </tr>
                  <tr>
                    <td>Date Of Birth</td>
                    <td>:</td>
                     <td><?php echo $row->userdob ?></td>
                  </tr>
                 
                </table>

                <div class="h3" style="margin-top:40px;margin-bottom:20px;">Detail Info</div>

                <table class="table table-striped">
                  <tr>
                    <td style="width:400px;">Identity Document</td>
                    <td style="width:10px">:</td>
                    <td><?php echo $row->useridcard ?></td>
                  </tr>
                  <tr>
                    <td>Pasport/NIC Number*</td>
                    <td>:</td>
                    <td><?php echo $row->useridnumber ?></td>
                  </tr>
                  <tr>
                    <td>Country or region of origin *</td>
                    <td>:</td>
                    <td><div class="label" style="width:20px;float:left;"><?php echo $row->usercountryorigin ?></div>&nbsp;&nbsp;<?php $this->showuser->getnameaditionalinfo('city',$row->usercountryorigin) ?></td>
                  </tr>
                  <tr>
                    <td>First Language*</td>
                    <td>:</td>
                    <td><div class="label" style="width:20px;float:left;"><?php echo $row->userfirstlanguage ?></div>&nbsp;&nbsp;<?php $this->showuser->getnameaditionalinfo('language',$row->userfirstlanguage) ?></td>
                  </tr>
                  <tr>
                    <td>Occupation (sector)*</td>
                    <td>:</td>
                    <td>
                      <div class="label" style="width:20px;float:left;"><?php echo $row->useroccupationsector ?></div>&nbsp;&nbsp;<?php $this->showuser->getnameaditionalinfo('sector',$row->useroccupationsector) ?>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>Occupation (level)*</td>
                    <td>:</td>
                    <td>
                      <div class="label" style="width:20px;float:left;"><?php echo $row->useroccupationlevel ?></div>&nbsp;&nbsp;<?php $this->showuser->getnameaditionalinfo('level',$row->useroccupationlevel) ?>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>Why are you taking the test?*</td>
                    <td>:</td>
                    <td>
                      <div class="label" style="width:20px;float:left;"><?php echo $row->userwhytaketest ?></div>&nbsp;&nbsp;<?php $this->showuser->getnameaditionalinfo('question',$row->userwhytaketest) ?>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>Which country are you applying/intending to go to?*</td>
                    <td>:</td>
                    <td>
                     <?php if($row->usertargetcountry == 'AUS') {
                              echo 'Australia';
                            } elseif($row->usertargetcountry == 'CAN') {
                              echo 'Canada';
                            } elseif ($row->usertargetcountry == 'NZ') {
                              echo 'New Zealand';
                            } elseif($row->usertargetcountry == 'EIR') {
                              echo 'Republic Of Ireland';
                            } elseif($row->usertargetcountry == 'UK') {
                              echo 'United Kingdom';
                            } elseif($row->usertargetcountry == 'USA') {
                              echo 'United States Of America';
                            } elseif($row->usertargetcountry == '000') {
                              echo 'Other';
                            } ?>
                    </td>
                  </tr>
                
                  <tr>
                    <td>Where are you currently studying English (if applicable)?</td>
                    <td>:</td>
                    <td><?php echo $row->userwherestudyingeng ?></td>
                  </tr>
                  <tr>
                    <td>What level of education have you completed?*</td>
                    <td>:</td>
                    <td>
                    <?php  if($row->userlevelofeducation == '1') {
                              echo 'Secondary 16 to 19 years';
                            } elseif($row->userlevelofeducation == '2') {
                              echo 'Degree or equivalent';
                            } elseif ($row->userlevelofeducation == '3') {
                              echo 'Post graduate';
                            } elseif($row->userlevelofeducation == '000') {
                              echo 'other';
                              } ?>
                    </td>
                  </tr>
                  <tr>
                    <td>How many years have you been studying English?*</td>
                    <td>:</td>
                    <td>
                     <?php echo $row->useryearsofenglishstudy ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Do you have any special needs due to ill health/medical conditions?*</td>
                    <td>:</td>
                    <td>
                      <?php if($row->userspecialcondition != '') { echo 'Y'; } else { echo 'N'; } ?>
                    </td>
                  </tr>

                  <tr>
                    <td>Descriptions</td>
                    <td>:</td>
                    <td>
                      <?php echo $row->userspecialcondition ?>
                    </td>
                  </tr>

                  <tr>
                    <td>notes</td>
                    <td>:</td>
                    <td>
                      <?php echo $row->usernotes ?>
                    </td>
                  </tr>
                  


                 

                 


                  <tr>
                    <td colspan="3">
                      <input type="submit" name="Register" id="SubmitRegister" style="float:right;width:200px;" class="btn btn-warning"  value="Register">
                    </td>
                  </tr>


                <table>
          <?php } ?>
        <?php echo form_close(); ?>

                </div>




  <script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script> 
        <script>
          $(document).ready(function() {

                          $('#SubmitRegister').click(function() { 

                            var idschedules = $('input[name=date-test]:checked').val();

                              $.ajax({
                                  type  : "POST",
                                  url: ""+base_url+"register/proses_register/"+idschedules+"",
                                  success : function(data){
                     
                                     
                                          
                                  }
                              });
                          });
            });
        </script>
