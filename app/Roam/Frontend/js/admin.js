$(document).ready(function() {
	// datepicker
	$.datepicker.setDefaults({ dateFormat: 'yy-mm-dd', beforeShowDay: $.datepicker.noWeekends });
	$(function() { $(".datepicker").datepicker(); });
	
	// setup the dropdown nav
	$('ul#dropDownNav').dropnav();
});
