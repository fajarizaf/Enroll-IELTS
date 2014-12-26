$("document").ready(function() {
$("#select-date").removeAttr('class');
$(".box-selectdate .selecter").remove();
$('.content-tab').animate({ scrollLeft:'0px' });

 

$(".select").selecter();
$("input[type=text]").val('');
$("input[type=hidden]").val('');
$("textarea").val('');
$("select").prop('selectedIndex',0);
$('input[type=radio]').attr('checked', false);



    		$('#btn-city').click(function(){
    			if( $(this).attr('class') == 'visited' && $(this).attr('action') != 'disabled' ) {
    				$('.content-tab').animate({ scrollLeft:'0px' });
    				$("#select-date").removeAttr('class');
    				$(".box-selectdate .selecter").remove();
    			};        
        });



        $('#btn-date').click(function(){

          if( $(this).attr('class') != 'active' ) {
              $("#select-date").removeAttr('class');
              $(".box-selectdate .selecter").remove();
          }  

        	if( $(this).attr('class') == 'visited' && $(this).attr('action') != 'disabled' ) {
           		$('.content-tab').animate({ scrollLeft:'960px' });

           			var location = $('input[name=location-test]:checked').val(); 
                    var dataString = 'location=' + location; 
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
            };
        });


		
		$('#btn-tos').click(function(){
			if( $(this).attr('class') == 'visited' && $(this).attr('action') != 'disabled' ) {
           		$('.content-tab').animate({ scrollLeft:'1920px' });
           	};
        });

        $('#btn-candidate').click(function(){
			if( $(this).attr('class') == 'visited' && $(this).attr('action') != 'disabled' ) {
           		$('.content-tab').animate({ scrollLeft:'2880px' });
           	};
        });

      $('#btn-finish').click(function(){
      if( $(this).attr('class') == 'visited' && $(this).attr('action') != 'disabled' ) {
              $('.content-tab').animate({ scrollLeft:'3840px' });
            };
        });    


		
		$('.box-tab ul li').click(function(){
			if( $(this).attr('class') == 'visited' && $(this).attr('action') != 'disabled' ) {
				var visited = $('.box-tab ul .active').attr('id');
				var gb = '#'+visited;
				$(''+gb+'').attr('class','visited');	
				$(this).attr('class','active');
			};	
		}); 
	
});
