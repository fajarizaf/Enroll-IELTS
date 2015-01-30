$("document").ready(function() {
$("#select-date").removeAttr('class');
$(".box-selectdate .selecter").remove();
$('.content-tab').animate({ scrollLeft:'0px' });

 

$(".select").selecter();
$("textarea").val('');
$("select").prop('selectedIndex',0);




   
	
});
