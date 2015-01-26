$("document").ready(function() {
	$(window).load(function(){
		$('.slider').flexslider({
			start: function(slider) { slider.removeClass('loading');},
			animation: "slide",              //String: Select your animation type, "fade" or "slide"
		    slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
		    slideshow: true,                //Boolean: Animate slider automatically
		    slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
		    animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
		    directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
		    controlNav: false,
		    controlsContainer: ".pager"
		});
	});

	//Semantic Accordion
    $('#accorcontainer').show();
	$('.content-left .nav-left ul ul').hide();
	$('.content-left .nav-left ul li a').on("click", function (e) {
		e.preventDefault();
		if( $(this).next().is(':hidden') ) {
			$(this).toggleClass('active').next().slideDown();
		} else {
			$(this).removeClass('active').next().slideUp();
		}

		return true;
	});
        
        $('.btnmultiple-search').click(function(){
           $('.nav-photos').animate({ top:'40px' });
           $('.btnmultiple-search').animate({ top:'80px' });
        });
        
	
});
