$("document").ready(function() {
$("#select-date").removeAttr('class');
$(".box-selectdate .selecter").remove();


 

$(".select").selecter();
$("input[type=text]").val('');
$("input[type=hidden]").val('');
$("textarea").val('');
$("select").prop('selectedIndex',0);
$('input[type=radio]').attr('checked', false);



   
	
});
