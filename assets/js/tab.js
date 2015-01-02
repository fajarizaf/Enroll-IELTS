$("document").ready(function() {
$("#select-date").removeAttr('class');
$(".box-selectdate .selecter").remove();


 

$(".select").selecter();
$("textarea").val('');
$("select").prop('selectedIndex',0);
$('input[type=radio]').attr('checked', false);



   
	
});
