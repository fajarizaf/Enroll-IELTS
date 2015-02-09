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

                        sizephotoKB = (Math.round(sizephoto * 100) / 100 ) +' KB';
                        var nameimage = $('.uploadidcard1')[0].files[0];
                        $('.resultphoto').html('<p style="color:orangered">'+nameimage.name+'<br/><span style="font-weight:bold;color:#666;">'+sizephotoKB+'</span></p>');
                        $('#imageid').attr('src', ''+base_url+'upload/'+nameimage.name+'');
                        $('.uploadfile').val(nameimage.name);
                        
                    

                   
                   
                 }
                counter--;
              }, 500);
        });


    
     });    

</script>
 <div class="register-new-account" style="width:960px;margin:0px auto;margin-top:40px;">
    <div style="width:920px;padding:10px;border:1px solid #ccc;-moz-border-radius:4px 4px 4px;-webkit-border-radius:4px 4px 4px;border-radius:4px 4px 4px;">
    sorry you can not afford to edit profile, due to schedule a test that you take a paid status, if you want there is a change of data, <b style="color:#1ca3de;">contact ieltsindonesia</b>.
    </div>
 </div>



