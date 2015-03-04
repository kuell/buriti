$(function(){
	$('input[type=text], textarea').blur(function(){
		var texto = $(this).val().toUpperCase()
		$(this).val(texto);
	});
	$('.data').mask('99/99/9999');
})