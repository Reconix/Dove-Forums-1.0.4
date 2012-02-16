$(function() {     $('img[data-hover]').hover(function() {         $(this).attr('tmp', $(this).attr('src')).attr('src', $(this).attr('data-hover')).attr('data-hover', $(this).attr('tmp')).removeAttr('tmp');     }).each(function() {         $('<img />').attr('src', $(this).attr('data-hover'));     });; });     



$(document).ready(function() {

	

	// Expand Panel

	$("#open").click(function(){

		$("div#panel").slideDown("slow");

	

	});	

	

	// Collapse Panel

	$("#close").click(function(){

		$("div#panel").slideUp("slow");	

	});		

	

	// Switch buttons from "Log In | Register" to "Close Panel" on click

	$("#toggle_panel a").click(function () {

		$("#toggle_panel a").toggle();

	});	



	// Removed message boxes

	$("#errorBox").fadeOut(15000);

	$("#successBox").fadeOut(15000);

	$("#infoMessage").fadeOut(15000);	

		

});



