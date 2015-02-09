
	$(document).ready(function() {
		 
         $('.table-city').slimScroll({
             width: '520px',
             height:'340px'
         });

         $('.table-date').slimScroll({
             width: '600px',
             height:'340px'
         });

      

         

         

         

         // event combobox city di pilih
         $('#selectCity').change(function() {

            var city = $(this).val().split('/');
            var dataString = 'city=' + city[0];
 

            $('#parentloading').fadeIn('slow');
            $('.load').fadeIn('slow');
            $('.table-city').css({'opacity':'0.5'});

            var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);

                     

                            $.ajax({
                            type  : "POST",
                            url: ""+base_url+"register/filterbycity",
                            data: dataString,
                            success : function(data){

                              $('#parentloading').fadeOut('fast');
                              $('.load').fadeOut('fast');
                              $('.table-city').css({'opacity':'1'});
                              $('.statloc').html(city[1]);
               
                               $(".table-city").html(data);
                                    
                            }
                            });

                 }
                counter--;
              }, 500); 

         });



        // event combobox date di pilih
         $('#select-date').change(function() {
            var module = $('#select-module').val();


            if(module != '') {
                var date = $(this).val(); 
                var location = $('input[name=location-test]:checked').val();
                var dataString = 'date=' + date + '&location=' + location + '&module=' + module; 

                $('#parentloading').fadeIn('slow');
                $('.load').fadeIn('slow');
                $('.table-date').css({'opacity':'0.5'});

                var counter=2;
                  var countdown = setInterval(function(){
                    if (counter == 0) {
                    clearInterval(countdown);

                       

                                $.ajax({
                                type  : "POST",
                                url: ""+base_url+"register/filterbydate",
                                data: dataString,
                                success : function(data){

                                    $('#parentloading').fadeOut('fast');
                                    $('.load').fadeOut('fast');
                                    $('.table-date').css({'opacity':'1'}); 
                   
                                   $(".table-date").html(data);
                                        
                                }
                                });

                     }
                    counter--;
                  }, 500); 

             } else {

                var date = $(this).val(); 
                var location = $('input[name=location-test]:checked').val();
                var dataString = 'date=' + date + '&location=' + location; 

                $('#parentloading').fadeIn('slow');
                $('.load').fadeIn('slow');
                $('.table-date').css({'opacity':'0.5'});

                var counter=2;
                  var countdown = setInterval(function(){
                    if (counter == 0) {
                    clearInterval(countdown);

                        $('#parentloading').fadeOut('fast');
                        $('.load').fadeOut('fast');
                        $('.table-date').css({'opacity':'1'}); 

                                $.ajax({
                                type  : "POST",
                                url: ""+base_url+"register/filterbydate",
                                data: dataString,
                                success : function(data){
                   
                                   $(".table-date").html(data);
                                        
                                }
                                });

                     }
                    counter--;
                  }, 500); 

             } 


         });


        // event combobox module di pilih
         $('#select-module').change(function() {
            var date = $('#select-date').val(); 

                $('#parentloading').fadeIn('slow');
                $('.load').fadeIn('slow');
                $('.table-date').css({'opacity':'0.5'});
           
            if(date != '' ) {
                var location = $('input[name=location-test]:checked').val();
                var module = $(this).val();
                var dataString = 'date=' + date + '&location=' + location +'&module=' + module; 

                var counter=2;
                  var countdown = setInterval(function(){
                    if (counter == 0) {
                    clearInterval(countdown);

                        

                                $.ajax({
                                type  : "POST",
                                url: ""+base_url+"register/filterbymodule",
                                data: dataString,
                                success : function(data){
                   
                                    $('#parentloading').fadeOut('fast');
                                    $('.load').fadeOut('fast');
                                    $('.table-date').css({'opacity':'1'});
                                    
                                   $(".table-date").html(data);
                                        
                                }
                                });

                     }
                    counter--;
                  }, 500); 


            } else {

                  var location = $('input[name=location-test]:checked').val();
                  var module = $(this).val();
                  var dataString = '&location=' + location +'&module=' + module; 

                  var counter=2;
                  var countdown = setInterval(function(){
                    if (counter == 0) {
                    clearInterval(countdown);

                        $('#parentloading').fadeOut('fast');
                        $('.load').fadeOut('fast');
                        $('.table-date').css({'opacity':'1'}); 

                                $.ajax({
                                type  : "POST",
                                url: ""+base_url+"register/filterbymodule",
                                data: dataString,
                                success : function(data){
                   
                                   $(".table-date").html(data);
                                        
                                }
                                });

                     }
                    counter--;
                  }, 500); 
            }
            

         });




        // button next di city di click
        $('#next-city').click(function() {
           $('#parentloading').fadeIn('slow');
           $("html, body").animate({ scrollTop: 0 }, "slow");

            var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                

                    if ( $('.locations-test').is(':checked') ) {
                        $('#btn-city').attr('class','visited');
                        $('#btn-date').attr('class','active');

                            var location = $('input[name=location-test]:checked').val(); 
                            var dataString = 'location=' + location; 

                            $.ajax({
                                type  : "POST",
                                url: ""+base_url+"register/filterbylocation",
                                data: dataString,
                                success : function(data){
                                   $('#parentloading').fadeOut('fast');
                                   $(".table-date").html(data);
                                   $('.content-tab').animate({ scrollLeft:'960px' });
                                        
                                }
                            });

                        

                    } else {
                        $('#sticky').sticky('<span style="color:#802222;">choice must be in select locations</span>');
                    }

                 }
                counter--;
              }, 500); 

            
        });



         // button next di city di click
        $('#next-city').click(function() {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);

                    if ( $('.locations-test').is(':checked') ) {

                            var location = $('input[name=location-test]:checked').val(); 
                            var dataString = 'location=' + location; 

                            $.ajax({
                                type  : "POST",
                                url: ""+base_url+"register/getlocationbranchname",
                                data: dataString,
                                success : function(data){
                   
                                   $(".displaylocation").html(data);
                                        
                                }
                            });

                            $.ajax({
                                type  : "POST",
                                url: ""+base_url+"register/getlocationcity",
                                data: dataString,
                                success : function(data){
                   
                                   $(".displaycity").html(data);
                                        
                                }
                            });

                            $.ajax({
                                type  : "POST",
                                url: ""+base_url+"register/getavailabledate",
                                data: dataString,
                                success : function(data){
                   
                                   $("#select-date").html(data);
                                   $("#select-date").attr('class','select');
                                   $(".select").selecter();
                                        
                                }
                            });

                    }

                 }
                counter--;
              }, 500);   
        });




        // button next di city di click
        $('#next-date').click(function() {
           $('#parentloading').fadeIn('slow');
           $('.content-tab').css({'height':'900px'});
           $("html, body").animate({ scrollTop: 0 }, "slow");

            var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                $('#parentloading').fadeOut('fast');

                    if ( $('.date-test').is(':checked') ) {
                        $('#btn-city').attr('class','visited');
                        $('#btn-date').attr('class','visited');
                        $('#btn-tos').attr('class','active');

                            


                        $('.content-tab').animate({ scrollLeft:'1920px' });
                    } else {
                        $('#sticky').sticky('<span style="color:#802222;">choice must be in select Test Dates</span>');
                    }

                 }
                counter--;
              }, 500); 

            
        });


        // button next di city di click
        $('#next-tos').click(function() {
                $('#parentloading').fadeOut('fast');
                $('.content-tab').css({'height':'1600px'}); 
                    if ( $('.combo-tos').is(':checked') ) {
                      $('#parentloading').fadeIn('slow');
                      $("html, body").animate({ scrollTop: 0 }, "slow");
                      var counter=2;
                      var countdown = setInterval(function(){
                        if (counter == 0) {
                        clearInterval(countdown);
                        $('#parentloading').fadeOut('slow');
                        $('#btn-city').attr('class','visited');
                        $('#btn-date').attr('class','visited');
                        $('#btn-tos').attr('class','visited');
                        $('#btn-candidate').attr('class','active');
                        $('.content-tab').animate({ scrollLeft:'2880px' });

                        }
                        counter--;
                      }, 500); 
                    } else {
                        $('#circumtances').modal('show');
                    }

     

            
        });

        $('#buttonLogin').click(function() {
            $('.load').fadeIn('slow');
            $('.register-or-login').css({'opacity':'0.5'});
            var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                $('#parentloading').fadeOut('fast');

                    var username = $('.username').val();
                    var password = $('.password').val();

                        var dataString = '&username=' + username +'&password=' + password; 
                            $.ajax({
                                type  : "POST",
                                url: ""+base_url+"register/login",
                                data: dataString,
                                dataType: "json",
                                success : function(data){

                                    $.each( data , function(key,val) {
                                     
                                        if( val.status == 'sukses') {
                                          $('.load').fadeOut('slow');
                                          
                                        // status login sebagai candidate
                                          if(val.idroles == '3') { 
                                              $('#sticky').sticky('<span style="color:#802222;">Login Success</span>');  
                                              $('.register-or-login').load(''+base_url+'register/form_candidate_login/');
                                              $('.menu ul').load(''+base_url+'register/menuadmin/');
                                              $('.stat_members').load(''+base_url+'register/showstatus/');
                                              $('.register-or-login').css({'opacity':'1'}); 
                                        // status login sebagai regcenter
                                          } else {
                                              $('#sticky').sticky('<span style="color:#802222;">Login Success</span>');  
                                              $('.register-or-login').load(''+base_url+'register/form_register_center/');
                                              $('.menu ul').load(''+base_url+'register/menuadmin/');
                                              $('.stat_members').load(''+base_url+'register/showstatus/');
                                              $('.register-or-login').css({'opacity':'1'}); 
                                          }


                                        } else if( val.status == 'gagal') {
                                          $('.load').fadeOut('slow');
                                          $('.register-or-login').css({'opacity':'1'}); 
                                          $('.username').val('');
                                          $('.password').val('');
                                          $('.username').focus(); 
                                          $('#sticky').sticky('<span style="color:#802222;">Login Failed</span>');

                                        } else if(val.status == 'notactivated') {
                                            $('.register-or-login').css({'opacity':'1'});
                                            $('.load').fadeOut('slow');
                                            $('.box-alert').html('<div class="alert alert-warning" role="alert" style="padding:10px;font-size:14px;">The user must perform activation<button style="MARGIN-RIGHT:12px;line-height:22px;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="color:#c39d5a;padding:8px;" aria-hidden="true">X</span></button></div>');
                                            $('.alert').fadeIn('fast');
                                             $('.username').val('');
                                             $('.password').val('');
                                             $('.username').focus();
                                        }
                                    });

                                }
                            });
                    

                 }
                counter--;
              }, 500); 
        });



        
  



         



	});
