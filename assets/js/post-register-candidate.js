
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






	});
