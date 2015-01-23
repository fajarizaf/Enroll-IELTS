<script type="text/javascript">
  $(document).ready(function() {
    $('.box-editpayment').on('click','#idcard', function() {    
      $('.box-idcard').toggle();
    });
  });
</script>


<style>
  .table tr td {
    padding:4px;
  }

   .table tr th {
    padding:4px;
  }

  table {
    width:100%;
  }

  .label {
    font-weight:normal;
  }


</style>
      


<?php foreach ($datauser as $row) { ?>
        <?php $atributes = array ('id' => 'formupdateuser'); ?> 
        <?php echo form_open('user/updateuser', $atributes); ?>    

          <table class="table" style="margin-left:5px;" >

          <tr style="border:none;margin-top:-10px;padding-bottom:20px;">
            <td colspan="3" style="border:none;">
              <div class="box-editpayment" style="margin-left:-5px;margin-bottom:10px;color:#fff;padding:10px;width:98%;height:40px;-moz-border-radius:5px 5px 5px;-webkit-border-radius:5px 5px 5px;border-radius:5px 5px 5px;background:orange;">
                <div style="width:auto;float:left;color:#fff">
                <h3 style="margin-top:-5px;"><?php echo $row->userfirstname.' '.$row->userfamilyname  ?></h3>
                Candidate
                </div>
                <div id="idcard" class="label label-warning" style="float:left;margin-left:20px;padding:8px;margin-top:3px;cursor:pointer">Id Card</div>
                  <a style="float:right;" href="<?php echo base_url() ?>user/createpdf/<?php echo $row->idusers ?>"><img src="<?php echo base_url() ?>assets/pic/pdficon.png" width="42px" height="40px"></a>
              </div>
            </td>
          </tr>

                  <tr class="box-idcard">
                    <th colspan="3"><img style="width:740px;" src="<?php echo base_url(); ?>upload/<?php echo $row->useridfile ?>"></th>
                  </tr>  

                  <tr>
                    <td colspan="3" style="width:470px;padding:10px;padding-left:0px;background:#efefef;"><div class="h3" style="font-size:14px;">Basic Info</div></td>
                  </tr>
                  <tr>
                    <th style="width:470px;">User ID</th>
                    <th style="width:5px">:</th>
                    <th style="width:300px;">IELTS<?php echo substr("00000" . $row->idusers, -6); ?></th>
                  </tr>


                
                  <tr>
                    <td >Username</td>
                    <td >:</td>
                    <td><?php echo $row->username ?></td>
                  </tr>
                  

                  <tr>
                    <td>Last Name (family name/surname)</td>
                    <td>:</td>
                   <td><?php echo $row->userfamilyname ?></td>
                  </tr>

                  <tr>
                    <td>First (given) name(s)</td>
                    <td>:</td>
                    <td><?php echo $row->userfirstname ?></td>
                  </tr>

                  <tr>
                    <td>User Gender</td>
                    <td>:</td>
                    <td><?php if ($row->usergender == 'F') { echo 'Female'; } else { echo 'Male'; } ?></td>
                  </tr>

                  <tr>
                    <td>Phone Number</td>
                    <td>:</td>
                    <td><?php echo $row->userphone ?></td>
                  </tr>

                  <tr>
                    <td>Email Address</td>
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
                    <td>Zipcode</td>
                    <td>:</td>
                    <td><?php echo $row->useraddr4 ?></td>
                  </tr>
                  <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><div class="label" style="width:auto;float:left;"><?php echo  $row->useraddr2 ?></div>&nbsp;&nbsp;<?php $this->showuser->getnameaditionalinfo('city', $row->useraddr2 ) ?></td>
                  </tr>
                  <tr>
                    <td>Date Of Birth</td>
                    <td>:</td>
                     <td><?php echo $row->userdob ?></td>
                  </tr>
      

                  <tr>
                    <td colspan="3" style="width:470px;padding:10px;padding-left:0px;background:#efefef;"><div class="h3" style="font-size:14px;">Detail Info</div></td>
                  </tr>


                  <tr>
                    <td style="width:470px;">Identity Document</td>
                    <td style="width:5px">:</td>
                    <td style="width:300px;"><?php echo $row->useridcard ?></td>
                  </tr>
                  <tr>
                    <td>Pasport/NIC Number</td>
                    <td>:</td>
                    <td><?php echo $row->useridnumber ?></td>
                  </tr>
                  <tr>
                    <td>Country or region of origin </td>
                    <td>:</td>
                    <td><div class="label" style="width:auto;float:left;"><?php echo $row->usercountryorigin ?></div>&nbsp;&nbsp;<?php $this->showuser->getnameaditionalinfo('city',$row->usercountryorigin) ?></td>
                  </tr>
                  <tr>
                    <td>First Language</td>
                    <td>:</td>
                    <td><div class="label" style="width:auto;float:left;"><?php echo $row->userfirstlanguage ?></div>&nbsp;&nbsp;<?php $this->showuser->getnameaditionalinfo('language',$row->userfirstlanguage) ?></td>
                  </tr>
                  <tr>
                    <td>Occupation (sector)</td>
                    <td>:</td>
                    <td>
                      <div class="label" style="width:auto;float:left;"><?php echo $row->useroccupationsector ?></div>&nbsp;&nbsp;<?php $this->showuser->getnameaditionalinfo('sector',$row->useroccupationsector) ?>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>Occupation (level)</td>
                    <td>:</td>
                    <td>
                      <div class="label" style="width:auto;float:left;"><?php echo $row->useroccupationlevel ?></div>&nbsp;&nbsp;<?php $this->showuser->getnameaditionalinfo('level',$row->useroccupationlevel) ?>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>Why are you taking the test?</td>
                    <td>:</td>
                    <td>
                      <div class="label" style="width:auto;float:left;"><?php echo $row->userwhytaketest ?></div>&nbsp;&nbsp;<?php $this->showuser->getnameaditionalinfo('question',$row->userwhytaketest) ?>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>Which country are you applying/intending to go to?</td>
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
                    <td>What level of education have you completed?</td>
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
                    <td>How many years have you been studying English?</td>
                    <td>:</td>
                    <td>
                     <?php echo $row->useryearsofenglishstudy ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Do you have any special needs due to ill health/medical conditions?</td>
                    <td>:</td>
                    <td>
                      <?php if($row->usertakenielts == 'Y') { echo 'Ya'; } else { echo 'No'; } ?>
                    </td>
                  </tr>
          


                <?php if($row->usertakenielts == 'Y') { ?>

                  <tr>
                    <td colspan="3" style="width:470px;padding:10px;padding-left:0px;background:#efefef;"><div class="h3" style="font-size:14px;">Explanation special needs</div></td>
                  </tr>
                  <tr>
                    <td style="width:470px" valign="top">Descriptions</td>
                    <td style="width:5px;">:</td>
                    <td style="width:300px;">
                    <p style="width:250px;font-size:13px;">
                      <?php echo $row->userspecialcondition ?>
                    </p>  
                    </td>
                  </tr>

                  <tr>
                    <td valign="top">notes</td>
                    <td>:</td>
                    <td>
                      <p style="width:250px;font-size:13px;">
                      <?php echo $row->usernotes ?>
                      </p>
                    </td>
                  </tr>

                <?php } ?>


                  <?php if($akademik) { ?>
                    <tr>
                    <td colspan="3" style="width:470px;padding:10px;padding-left:0px;"><div class="h3" style="font-size:14px;background:#efefef;">Recognising Organisations</div></td>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($akademik as $rew ) { ?>
     
                      <tr>
                        <td style="width:480px;color:#333;">Name Of Person / Departement</td>
                        <td style="width:5px;color:#333;">:</td>
                        <td style="width:290px;color:#333;">
                          <?php echo $rew->nop ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="color:#333;">Name of institution</td>
                        <td style="color:#333;">:</td>
                        <td style="color:#333;">
                          <?php echo $rew->noi ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="color:#333;">File/case number</td>
                        <td style="color:#333;">:</td>
                        <td style="color:#333;">
                          <?php echo $rew->files ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="color:#333;">Address</td>
                        <td style="color:#333;">:</td>
                        <td style="color:#333;">
                          <?php echo $rew->addr ?>
                        </td>
                      </tr>
                    
                      <?php $i++; ?>
                      <?php } ?>
                  <?php } ?>
                </table>

<?php echo form_close(); ?> 


<?php } ?>   

