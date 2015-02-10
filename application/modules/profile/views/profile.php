<script type="text/javascript" src="<?php echo base_url();?>assets/js/post-register-candidate.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
    $(".select").selecter();
    $(".box-selectdate .selecter").remove();
    $("input[type=hidden]").val('');
    $("textarea").val('');
    $('#declarations').css({'width':'985px','margin-left':'-495px'});


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

                $('#btnaddrecog').click(function() {
                  var n = $(".recognizing-organizations").length;
                  if(n >= 5 ) {
                  } else { 
                    $('.btnaddrecognizing').before('<tr class="recognizing-organizations"><td colspan="3" ><table><tr style="border:none;"><td style="border:none;background:none;">Name of person/department</td><td style="border:none;background:none;">:</td><td style="border:none;background:none;"><input type="text" name="name-person[]" class="name-person"></td></tr><tr style="border:none"><td style="border:none;background:none;">Name of institution</td><td style="border:none;background:none;">:</td><td style="border:none;background:none;"><input type="text" name="name-institusi[]" class="name-institusi"></td></tr><tr style="border:none"><td style="border:none;background:none;">File/case number</td><td style="border:none;background:none;">:</td><td style="border:none;background:none;"><input type="text" name="case-number[]" class="case-number"></td></tr><tr style="border:none"><td style="border:none;background:none;">Address</td><td style="border:none;background:none;">:</td><td style="border:none;background:none;"><textarea class="addr" name="addr[]"></textarea></td></tr></table></td></tr>');
                  }
               
                });


// button upload di click
            $('body').on('click','#uploadidcard2', function() {
               $('.uploadidcard3').click();      
            });

            // button upload di click
            $('body').on('click','#uploadidcard', function() {
               $('.uploadidcard1').click();      
            });


 //proses upload file photo profile

              $('body').on('change','.uploadidcard3', function() {   
              $('#parentloading').fadeIn('slow');
              $('.load').fadeIn('fast');
              var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                $('#parentloading').fadeOut('fast');
                $('.load').fadeOut('fast');

                  var namephoto = $('.uploadidcard3').val();
                  var sizephoto = ($(".uploadidcard3")[0].files[0].size / 1024);
                
                      
                        AjaxUploads.UploadsReady(
                          evt = function(){
                            AjaxUploads.UploadsConfig = {
                              actToUploads   : ''+base_url+'register/uploadphotos',    // nama file php untuk prosess uploads dflt: upload.php
                              methodUploads  : 'POST',      // mthod action /post/get dflt:POST
                              fileToUploads  : 'uploadidcard3',  // nama id pada type file input dflt : fileToupload
                              numberProgress : 'progressNumber',  // progress bar id dalam percent  dflt ::  progressNumber
                              innerProgress  : 'prog',      // progress bar id   dflt ::  prog
                              
                              fileInfoUploads  : {
                                  fileName :'fileName',       // nama id untuk informasi nama file   dflt ::  fileName
                                  fileType :'fileType',       // nama id untuk informasi type file   dflt ::  fileType
                                  fileSize :'fileSize'        // nama id untuk informasi Ukuran file  dflt ::  fileType
                              }
                            }
                          },
                          evt()
                        );

                        sizephotoKB = (Math.round(sizephoto * 100) / 100 ) +' KB';
                        var nameimage = $('.uploadidcard3')[0].files[0];
                        $('.resultphoto').html('<p style="color:orangered">'+nameimage.name+'<br/><span style="font-weight:bold;color:#666;">'+sizephotoKB+'</span></p>');
                        $('.photoprofile img').attr('src', ''+base_url+'upload/'+nameimage.name+'');
                        $('.uploadfile3').val(nameimage.name);
                        $('.uploadfile3').valid();
                        
                    

                   
                   
                 }
                counter--;
              }, 500);
        });




//proses upload idcard

              $('body').on('change','.uploadidcard1', function() {   
              $('#parentloading').fadeIn('slow');
              $('.load').fadeIn('fast');
              var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                $('#parentloading').fadeOut('fast');
                $('.load').fadeOut('fast');

                  var namephoto = $('.uploadidcard1').val();
                  var sizephoto = ($(".uploadidcard1")[0].files[0].size / 1024);
                
                      
                        AjaxUploads.UploadsReady(
                          evt = function(){
                            AjaxUploads.UploadsConfig = {
                              actToUploads   : ''+base_url+'register/uploadphotos',    // nama file php untuk prosess uploads dflt: upload.php
                              methodUploads  : 'POST',      // mthod action /post/get dflt:POST
                              fileToUploads  : 'uploadidcard1',  // nama id pada type file input dflt : fileToupload
                              numberProgress : 'progressNumber',  // progress bar id dalam percent  dflt ::  progressNumber
                              innerProgress  : 'prog',      // progress bar id   dflt ::  prog
                              
                              fileInfoUploads  : {
                                  fileName :'fileName',       // nama id untuk informasi nama file   dflt ::  fileName
                                  fileType :'fileType',       // nama id untuk informasi type file   dflt ::  fileType
                                  fileSize :'fileSize'        // nama id untuk informasi Ukuran file  dflt ::  fileType
                              }
                            }
                          },
                          evt()
                        );

                        function loadImage(path, width, target) {
                          $('<img src="'+ path +'">').load(function() {
                            $(this).width(width).appendTo(target);
                          });
                        }

                        sizephotoKB = (Math.round(sizephoto * 100) / 100 ) +' KB';
                        var nameimage = $('.uploadidcard1')[0].files[0];
                        $('.resultphoto').html('<p style="color:orangered">'+nameimage.name+'<br/><span style="font-weight:bold;color:#666;">'+sizephotoKB+'</span></p>');
                        var imgPaht =  ''+base_url+'upload/'+nameimage.name+'';
                        loadImage(imgPaht, 800,'.photosid');
                        $('#imageid').attr('src', ''+base_url+'upload/'+nameimage.name+'');
                        $('.uploadfile').val(nameimage.name);
                        
                    

                   
                   
                 }
                counter--;
              }, 500);
        });


    
     });    

</script>
 <div class="register-new-account" style="width:960px;margin:0px auto;margin-top:40px;">
                
                <div class="h3" style="margin-bottom:20px;">Basic Info</div>
  <?php $atributes = array ('id' => 'myformUpdate'); ?> 
        <?php echo form_open_multipart ('profile/updateprofile', $atributes); ?>

        <?php foreach ($dataprofile as $row) { ?>
                <input type="text" style="display:none;" name="idusers" value="<?php echo $this->uri->segment(3); ?>">
                <table class="table table-striped" style="margin-bottom:130px;">

                  <tr>
                    <td >Title*</td>
                    <td>:</td>
                    <td>
                    <select class="select" id="title" name="title">
                        <option value="Mr">Mr</option> 
                        <option value="Mrs">Mrs</option>
                        <option value="Ms">Ms</option> 
                        <option value="Miss">Miss</option>
                        <option value="Dr">Dr</option>
                    </select>
                    </td>
                    <td>
                    <div class="photoprofile" style="margin-bottom:6px;">
                    <?php if($row->userphoto == '') { ?>
                    <img src="<?php echo base_url() ?>assets/pic/default.jpg" style="width:70px;height:70px;">
                    <?php } else {  ?>
                    <img src="<?php echo base_url() ?>upload/<?php echo $row->userphoto; ?>" style="width:70px;height:70px;">
                    <?php  } ?>
                    </div>
                    <input type="file" onChange="JavaScript:AjaxUploads.UploadsFile();" name="uploadidcard3[]" id="uploadidcard3" style="display:none;" class="uploadidcard3">
                     <input type="text" style="display:none;" name="uploadfile3" class="uploadfile3" value="<?php echo $row->userphoto; ?>"> 
                     <div name="upload" style="" class="btn btn-warning" id="uploadidcard2" style="margin-left:-50px;margin-top:16px;" value="Upload">Change</div>
                    </td>
                  </tr>

                  <tr>
                    <td>Last Name (family name/surname)*</td>
                    <td>:</td>
                    <td colspan="2"><input type="text" id="last_name" name="last_name" value="<?php echo $row->userfamilyname ?>"></td>
                  </tr>

                  <tr>
                    <td>First (given) name(s)*</td>
                    <td>:</td>
                    <td colspan="2"><input type="text" class="first_name" name="first_name" value="<?php echo $row->userfirstname ?>"></td>
                  </tr>

                  <tr>
                    <td>User Gender*</td>
                    <td>:</td>
                    <td colspan="2">
                      <input type="radio" class="gender" <?php if($row->usergender == 'M' ) { echo 'checked'; } ?> name="gender" value="M" style="float:left;"><div style="float:left;width:50px;margin-left:7px;">Male</div>
                      <input type="radio" class="gender" <?php if($row->usergender == 'F' ) { echo 'checked'; } ?> name="gender" value="F" style="float:left;"><div style="float:left;width:50px;margin-left:7px;">Female</div>
                    </td>
                  </tr>

                  <tr>
                    <td>Phone Number*</td>
                    <td>:</td>
                    <td colspan="2"><input type="text" id="phone_number" name="phone_number" value="<?php echo $row->userphone ?>"></td>
                  </tr>

                  <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td colspan="2"><input type="text" name="address" value="<?php echo $row->useraddr1 ?>" style="width:400px;"></td>
                  </tr>

                  <tr>
                    <td>City*</td>
                    <td>:</td>
                    <td colspan="2"><input type="text" id="city" name="city" value="<?php echo $row->useraddr3 ?>"></td>
                  </tr>
                  <tr>
                    <td>Zipcode*</td>
                    <td>:</td>
                    <td colspan="2"><input type="text" id="zipcode" name="zipcode" value="<?php echo $row->useraddr4 ?>"></td>
                  </tr>
                  <tr>
                    <td>Country or region*</td>
                    <td>:</td>
                    <td colspan="2">
                       <div href="#liststate" data-toggle="modal" id="namecountry" class="selecboxstyle"><?php echo $row->useraddr2 ?></div>
                       <input type="text" value="<?php echo $row->useraddr2 ?>" style="display:none;"  id="country" name="country">
                       <input type="text" name="codecity" style="display:none;" value="<?php echo $row->useraddr2 ?>" class="codecity">
                    </td>
                  </tr>
                  <tr>
                    <td>Date Of Birth*</td>
                    <td>:</td>
                    <td colspan="2"><input value="<?php echo $row->userdob ?>" type="text" id="date_of_birth" name="date_of_birth"></td>
                  </tr>

                  <tr>
                    <td style="width:400px;">Identity Document</td>
                    <td></td>
                    <td colspan="2">
                      <input type="radio" <?php if($row->useridcard == 'passport' ) { echo 'checked'; } ?> style="float:left;" class="identity" name="identity" value="passport" style="float:left;"><div style="float:left;width:100px;margin-left:10px;">Passport</div>
                      <input type="radio" <?php if($row->useridcard == 'nic' ) { echo 'checked'; } ?> style="float:left;" class="identity" name="identity" value="nic" ><div style="float:left;width:150px;margin-left:10px;">Number Identity Card</div>
                    </td>
                  </tr>
                  <tr>
                    <td>Pasport/NIC Number*</td>
                    <td>:</td>
                    <td colspan="2"><input type="text" id="number_identity" name="number_identity" value="<?php echo $row->useridnumber ?>"></td>
                  </tr>
                  
                  <tr>
                    <td>Do you have any special needs due to ill health/medical conditions?*</td>
                    <td>:</td>
                    <td colspan="2" >
                      <input type="radio" class="specialneeds" name="specialneeds" value="YES" style="float:left;"><div style="float:left;width:20px;margin-left:10px;" class="label label-warning">YES</div>
                      <input type="radio" checked class="specialneeds" name="specialneeds" value="NO" style="float:left;margin-left:10px;" ><div style="float:left;width:20px;margin-left:10px;" class="label label-warning">NO</div>
                    </td>
                  </tr>
                  <tr class="listspecialneeds">
                    <td style="background:#f9edbe;border-color:#f9edbe;color:orange;" colspan="4">If yes, please specify your requirements below. You must attach supporting medical evidence to this form. Requests for modified test materials must be submitted at least 3 months before the test.</td>
                  </tr>
                  <tr class="listspecialneeds">
                    <td style="background:#f9edbe;border-color:#f9edbe;color:orangered;" colspan="4">
                    <p>Please Specify**</p>
                    <textarea style="width:100%;-moz-border-radius:2px 2px 2px;-webkit-border-radius:2px 2px 2px;border-radius:2px 2px 2px" class="specialneedsdesc" name="specialneedsdesc"></textarea></td>
                  </tr>
                  <tr  class="listspecialneeds">
                  <td style="background:#f9edbe;border-color:#f9edbe;" colspan="4">
                    <p>Notes**</p>
                    <textarea style="height:40px;width:100%;-moz-border-radius:2px 2px 2px;-webkit-border-radius:2px 2px 2px;border-radius:2px 2px 2px" class="notes" name="notes"></textarea></td>
                  </tr>

                  <tr>
                    <td><span style="font-weight:bold;">ID Card</span></td>
                    <td></td>
                    <td colspan="2">
                    
                    <div class="photosid">
                      <?php if($row->useridfile == '') { ?>
                      <img id="imageid" src="<?php echo base_url() ?>assets/pic/noimaages.png"  style="width:auto;">
                      <?php } else { ?>
                      <img id="imageid" src="<?php echo base_url() ?>upload/<?php echo $row->useridfile; ?>"  style="width:auto;">
                      <?php } ?>
                    </div>

                    <div style="clear:both;"></div>

                     <input type="file" onChange="JavaScript:AjaxUploads.UploadsFile();" name="uploadidcard1[]" id="uploadidcard1" style="display:none;" class="uploadidcard1">
                     <input type="text" style="display:none;" name="uploadfile" class="uploadfile" value="<?php echo $row->useridfile; ?>"> 
                     <div name="upload" style="margin-top:7px;float:left;margin-right:10px;" class="btn btn-warning" id="uploadidcard" value="Upload">Change</div>
                     <img src="<?php echo base_url(); ?>assets/pic/load1.gif" style="margin-top:9px;margin-left:5px;float:left;margin-right:10px;" class="load">
                     <div class="resultphoto" style="float:left;margin-right:10px;margin-top:7px;"></div>
                    </td>
                  </tr>

                  <tr>
                    <td><input type="submit" name="Register" id="SubmitRegister" style="float:left;width:200px;" class="btn btn-success"  value="Update"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>


                </table>


          <?php } ?>
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

                
                            var counter=2;
                              var countdown = setInterval(function(){
                                if (counter == 0) {
                                clearInterval(countdown);
                                
                                      $.ajax({
                                      type  : "POST",
                                      url: ""+base_url+"profile/updateprofile/",
                                      data: $("#myformUpdate").serialize(),
                                      dataType: "json",
                                      success : function(response){

                                        $.each( response , function(key,val) {
                                              if(val == 'sukses') {
                                                $('#parentloading').fadeOut('slow');
                                                $('#sticky').sticky('<span style="color:#802222;">Profile Succesfully Updated</span>');
                                              }
                                         });      
                                        
                                        }
                                      });
                                                           

                            }
                              counter--;
                            }, 500);


              }
            });
            
            
            $( "#myformUpdate" ).validate({
              rules: {
                username: {
                  required: true
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
                  required: true,
                  number: true
                },
                email_address: {
                  required: true,
                  email: true
                },
                address: {
                  required: true
                },
                city: {
                  required: true
                },
                zipcode: {
                  required: true,
                  number: true
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
                }
              }

              
              
              
            });
        </script>

