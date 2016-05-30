$( document ).ready(function(){
	$(".button-collapse").sideNav();
	$('ul.tabs').tabs();
	$('select').material_select();
	$('.button-collapse').sideNav();
	$('.datepicker').pickadate({
    selectMonths: true, 
    selectYears: 12 ,
	});
    $('.carousel').carousel({dist:30});
	$('.modal-trigger').leanModal();
	$('.materialboxed').materialbox();
});
