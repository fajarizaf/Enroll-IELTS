



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

        <?php $atributes = array ('id' => 'formresetpassword'); ?> 
        <?php echo form_open('register/prosesresetpassword', $atributes); ?> 


                      <div class="box-login" style="text-align:center;width:350px;">
                      
                          <table style="margin-top:-20px;width:320px;margin-left:20px;width:350px;">
                              <tr>
                                <td class="box-alert" style="margin-bottom:0px;padding-bottom:0px;">
                                  <div class="alert alert-warning" role="alert" style="padding:10px;font-size:14px;">
                                  Login Failed
                                  <button style="MARGIN-RIGHT:12px;line-height:22px;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="color:#c39d5a;padding:8px;" aria-hidden="true">X</span></button>
                                  </div>
                                  <img class="load" src="<?php echo base_url() ?>assets/pic/load1.gif" style="margin-top:0px;margin:0px auto;float:left;" wisth="30">
                                  <div class="redorect" style="width:40px;float:left;margin-left:7px;margin-top:5px;">Redirect</div>
                                </td>
                              </tr>
                                <input type="hidden" name="email" value="<?php echo $this->uri->segment(3);  ?>">
                              
                              <tr>
                                <td style="width:200px;"><input placeholder="Input new password" id="password" type="password" style="width:300px;" name="password"></td>
                              </tr>
                              <tr>
                                <td><input placeholder="Confirm Password" id="confirmpassword" type="password" style="width:300px;"  name="confirmpassword"></td>
                              </tr>
                              <tr>
                                <td><input type="submit" id="buttonressetpassword" value="Change Password"  style="width:300px;background:#00a6e0;margin-top:7px;" class="btn btn-warning"></td>
                              </tr>
                          </table>
                          
                      </div> 

        <?php echo form_close(); ?>




<script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script> 
        <script>
            
            jQuery.validator.setDefaults({
              ignore: '',
              success: "valid",
              submitHandler: function(form) { 
                $('#parentloading').fadeIn('slow');
                
                            var counter=2;
                              var countdown = setInterval(function(){
                                if (counter == 0) {
                                clearInterval(countdown);
                                $('#parentloading').fadeOut('slow');

                                      $.ajax({
                                      type  : "POST",
                                      url: ""+base_url+"register/prosesresetpassword",
                                      data: $("#formresetpassword").serialize(),
                                      dataType: "json",
                                      success : function(response){

                                              $.each( response , function(key,val) {

                                                  if( val.status == 'sukses') {
                                                    $('.box-alert').html('<div class="alert alert-warning" role="alert" style="padding:10px;font-size:14px;">Your password is successfully changed<button style="MARGIN-RIGHT:12px;line-height:22px;" type="button" class="close" data-dismiss="alert" aria-label="Close"></button></div>');
                                                    $('.alert').fadeIn('fast');  
                                                  } else if( val.status == 'regcenter') {
                                                    $('.box-alert').html('<div class="alert alert-warning" role="alert" style="padding:10px;font-size:14px;">failed password changed<button style="MARGIN-RIGHT:12px;line-height:22px;" type="button" class="close" data-dismiss="alert" aria-label="Close"></button></div>');
                                                    $('.alert').fadeIn('fast'); 
                                                  } 
                                              });
                                                  

                                           

                                          }
                                      });


                                }
                              counter--;
                            }, 500);


                           
              }
            });
            
            
            $( "#formresetpassword" ).validate({
              rules: {
                password: {
                  required: true
                },
                confirmpassword: {
                      required: true,
                      equalTo: '#password'
                    },
              }

              
              
              
            });
        </script>                         




