
	$(document).ready(function() {
		 
         $('.table-city').slimScroll({
             width: '520px',
             height:'340px'
         });

         $('.table-date').slimScroll({
             width: '600px',
             height:'340px'
         });

         $('.box-tos').slimScroll({
             width: '935px',
             height:'300px'
         });

         

         

         // event combobox city di pilih
         $('#selectCity').change(function() {
            var city = $(this).val(); 
            var dataString = 'city=' + city; 


            $('#parentloading').fadeIn('slow');
            $('.load').fadeIn('slow');
            $('.table-city').css({'opacity':'0.5'});

            var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);

                    $('#parentloading').fadeOut('fast');
                    $('.load').fadeOut('fast');
                    $('.table-city').css({'opacity':'1'});
                    $('.statloc').html(city); 

                            $.ajax({
                            type  : "POST",
                            url: ""+base_url+"register/filterbycity",
                            data: dataString,
                            success : function(data){
               
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
                $('#parentloading').fadeOut('fast');

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
                   
                                   $(".table-date").html(data);

                                        
                                }
                            });

                        $('.content-tab').animate({ scrollLeft:'960px' });

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
           $('#parentloading').fadeIn('slow');
           $("html, body").animate({ scrollTop: 0 }, "slow");

            var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                $('#parentloading').fadeOut('fast');

                    if ( $('.combo-tos').is(':checked') ) {
                        $('#btn-city').attr('class','visited');
                        $('#btn-date').attr('class','visited');
                        $('#btn-tos').attr('class','visited');
                        $('#btn-candidate').attr('class','active');
                        
                        $('.content-tab').animate({ scrollLeft:'2880px' });
                    } else {
                        $('#sticky').sticky('<span style="color:#802222;">you must select I agree to these terms</span>');
                    }

                 }
                counter--;
              }, 500); 

            
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

                                    $.each( data, function(key,val) {
                                        if( val != 'gagal') {
                                          $('.load').fadeOut('slow');
                                          
                                        // status login sebagai candidate
                                          if(val == '3') { 
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


                                        } else {
                                          $('.load').fadeOut('slow');
                                          $('.register-or-login').css({'opacity':'1'}); 
                                          $('.username').val('');
                                          $('.password').val('');
                                          $('.username').focus(); 
                                          $('#sticky').sticky('<span style="color:#802222;">Login Failed</span>');

                                        }
                                    });

                                }
                            });
                    

                 }
                counter--;
              }, 500); 
        });



        
  



         



	});
