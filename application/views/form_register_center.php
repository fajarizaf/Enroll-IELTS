<script> 
$(document).ready(function() {




                $('#btnnewaccount').click(function() {
                     $('#parentloading').fadeIn('slow');
                     var counter=2;
                      var countdown = setInterval(function(){
                        if (counter == 0) {
                        clearInterval(countdown);
                             $('#parentloading').fadeOut('slow');
                             $('.switch').fadeOut('fast');
                             $('.register-or-login').load(''+base_url+'register/form_candidate/').hide().fadeIn('slow');
                             $('#sticky').sticky('<span style="color:#802222;">please fill out a form below to complete</span>');
                         }
                        counter--;
                      }, 500);                
                 });




                $('#btnexistingaccount').click(function() {
                     $('#parentloading').fadeIn('slow');

                     var idschedules = $('.codeidschedules').html();
                     var counter=2;
                      var countdown = setInterval(function(){
                        if (counter == 0) {
                        clearInterval(countdown);
                             $('#parentloading').fadeOut('slow');
                             $('.switch').fadeOut('fast');
                             $('.register-or-login').load(''+base_url+'register/regcenter_existing_user/'+idschedules+'').hide().fadeIn('slow');
                             $('#sticky').sticky('<span style="color:#802222;">please select the users who will be in the registration</span>');
                         }
                        counter--;
                      }, 500);                
                 });
});

</script>

<div class="switch">
  <div class="left" style="margin-top:20px;width:450px;border-right:1px dashed #ccc;">
                        <div class="h3" style="padding:20px;border-bottom:1px dashed #ccc;">Register with existing account</div>
                        <p style="margin-left:20px;margin-top:20px;">If you are new to the IELTS online registration system, please create a new 
                          account and register here:</p>
                          <div id="btnexistingaccount"  style="float:left;margin-top:10px;margin-left:20px;"class="btn btn-warning">Continue</div>
  </div>

  <div class="right" style="width:430px;padding-left:10px;">
                        <div class="h3" style="padding:20px;border-bottom:1px dashed #ccc;">Register with a new account</div> 
                        <p style="margin-left:20px;margin-top:20px;">If you are new to the IELTS online registration system, please create a new 
                        account and register here:</p>
                        <div id="btnnewaccount"  style="float:left;margin-top:10px;margin-left:20px;"class="btn btn-warning">Continue</div>
  </div>
</div>

<div class="register-or-login" style="padding-top:30px;">

</div>