
	$(document).ready(function() {
		 
      $('#email_address').change(function() {
        $('.load').fadeIn('fast');
          var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                $('#parentloading').fadeOut('fast');

                            var email = $('#email_address').val(); 
                            var dataString = 'email=' + email; 

                             $.ajax({
                                type  : "POST",
                                url: ""+base_url+"register/cekemailavailable",
                                data: dataString,
                                success : function(data){
                                 $('.load').fadeOut('fast');

                                   if(data == 1) {
                                      $('.resultemail').fadeIn('fast');
                                      $('.resultemail').html('email is already registered');
                                      $('#email_address').val('');
                                      $('#email_address').css({'border-color':'orange','color':'orange'});
                                      $('#email_address').attr('placeholder','Please Input Other Email');
                                      $('#email_address').focus();
                                   } else {
                                      $('.resultemail').fadeIn('fast');
                                      $('.resultemail').html('email available');
                                   }
                                        
                                }
                            });

                }
                counter--;
              }, 500); 
      });



// button upload di click
        $('#uploadidcard1').click(function() {
           $('.uploadidcard').click();      
        });


        $('.uploadidcard').change(function() {
              $('#parentloading').fadeIn('slow');
              $('.load').fadeIn('fast');
              var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                $('#parentloading').fadeOut('fast');
                $('.load').fadeOut('fast');

                  var namephoto = $('.uploadidcard').val();
                  var sizephoto = ($(".uploadidcard")[0].files[0].size / 1024);
                    if(sizephoto / 1024 > 1) {
                        alert = '<div style="color:orange;margin-top:7px;">Maximum Upload File Size 1Mb</div>';  
                        $('.resultphoto').html(alert);

                    } else {

                        AjaxUploads.UploadsReady(
                          evt = function(){
                            AjaxUploads.UploadsConfig = {
                              actToUploads   : 'register/uploadphotos',    // nama file php untuk prosess uploads dflt: upload.php
                              methodUploads  : 'POST',      // mthod action /post/get dflt:POST
                              fileToUploads  : 'uploadidcard',  // nama id pada type file input dflt : fileToupload
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
                        $('.resultphoto').html('<p style="color:orangered">'+namephoto+'<br/><span style="font-weight:bold;color:#666;">'+sizephotoKB+'</span></p>');
                        $('.uploadfile').val(namephoto);
                        $('.uploadfile').valid();
                    }

                   
                   
                 }
                counter--;
              }, 500);
        });



	});
