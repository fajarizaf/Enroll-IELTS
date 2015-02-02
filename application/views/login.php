<script type="text/javascript">
  $(document).ready(function() {
       $('#buttonLoginform').click(function() {
            $('#parentloading').fadeIn('slow');
            $('.box-login').css({'opacity':'0.5'});
            var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                $('#parentloading').fadeOut('fast');
                $('.box-login').css({'opacity':'1'});

                    var username = $('.username').val();
                    var password = $('.password').val();

                    if(!$('.username').val()) {
                        $('.username').focus();
                        $('.box-alert').html('<div  class="alert alert-warning" role="alert" style="padding:10px;font-size:14px;">Username can not be empty<button style="MARGIN-RIGHT:12px;line-height:22px;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="color:#c39d5a;padding:8px;" aria-hidden="true">X</span></button></div>');
                        $('.alert').fadeIn('fast');
                    } else if(!$('.password').val()) {
                        $('.password').focus();
                        $('.box-alert').html('<div  class="alert alert-warning" role="alert" style="padding:10px;font-size:14px;">Password can not be empty<button style="MARGIN-RIGHT:12px;line-height:22px;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="color:#c39d5a;padding:8px;" aria-hidden="true">X</span></button></div>');
                        $('.alert').fadeIn('fast');
                    } else {


                        var dataString = '&username=' + username +'&password=' + password; 
                            $.ajax({
                                type  : "POST",
                                url: ""+base_url+"register/login",
                                data: dataString,
                                dataType: "json",
                                success : function(data){
                                  

                                    $.each( data, function(key,val) {
                                        if( val.status == 'sukses') {
                                        $('.load').fadeIn('slow');
                                        $('.redorect').fadeIn('slow');
                                           var counter=2;
                                            var countdown = setInterval(function(){
                                              if (counter == 0) {
                                              clearInterval(countdown);                                      
                                                window.location.href = ""+base_url+"payment/";
                                              }
                                              counter--;
                                            }, 500); 

                                        } else if( val.status == 'gagal') {
                                        $('.box-alert').html('<div class="alert alert-warning" role="alert" style="padding:10px;font-size:14px;">Login Failed<button style="MARGIN-RIGHT:12px;line-height:22px;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="color:#c39d5a;padding:8px;" aria-hidden="true">X</span></button></div>');
                                        $('.alert').fadeIn('fast');  
                                        } else  if( val.status = 'notactivated') {
                                            $('.box-alert').html('<div class="alert alert-warning" role="alert" style="padding:10px;font-size:14px;">The user must perform activation<button style="MARGIN-RIGHT:12px;line-height:22px;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="color:#c39d5a;padding:8px;" aria-hidden="true">X</span></button></div>');
                                            $('.alert').fadeIn('fast'); 
                                        }
                                    });

                                }
                            });


                    }
                    

                 }
                counter--;
              }, 500); 
        });
  });
</script>



<style>

input[type=text] {
  box-shadow:0px 0px 7px #d9d9d9 inset;
  height: 45px;
}

input[type=password] {
  box-shadow:0px 0px 7px #d9d9d9 inset;
  height: 45px;
}

input[type=submit] {
  height: 45px;
}

.box-login {
  width: 320px;
height: auto;
padding: 10px 10px 3px;
margin: 100px auto 0px;
background: none repeat scroll 0% 0% #FFF;
border-radius: 4px;
}

</style>  




                      <div class="box-login" style="text-align:center;height:400px;">
                      
                          <table style="margin-top:-20px;width:320px;margin-left:20px;">
                              <tr>
                                <td class="box-alert" style="margin-bottom:0px;padding-bottom:0px;color:red">
                                  <?php if($this->session->flashdata('errorreset')) { ?>
                                  
                                  <?php echo $this->session->flashdata('errorreset') ?>
                                 
                                  <?php } ?>
                                  <img class="load" src="<?php echo base_url() ?>assets/pic/load1.gif" style="margin-top:0px;margin:0px auto;float:left;" wisth="30">
                                  <div class="redorect" style="width:40px;float:left;margin-left:7px;margin-top:5px;">Redirect</div>
                                </td>
                              </tr>
                              <tr>
                                <td style="width:200px;"><input placeholder="Username" class="username" type="text" style="width:100%;" name="username"></td>
                              </tr>
                              <tr>
                                <td><input placeholder="Password" class="password" type="password" style="width:100%;"  name="password"></td>
                              </tr>
                              <tr>
                                <td><input type="submit" id="buttonLoginform" value="Sign In"  style="width:100%;" class="btn btn-warning"></td>
                              </tr>
                          </table>
                          <a style="margin-left:27px;margin-top:27px;" href="<?php echo base_url(); ?>register/forgotpassword">Forgot Your Password?</a>
                      </div>    
