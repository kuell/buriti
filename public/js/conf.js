$(function(){
	$('input[type=text], textarea').blur(function(){
		var texto = $(this).val().toUpperCase()
		$(this).val(texto);
	});
	$('.data').mask('99/99/9999');
	$('.data_hora').mask('99/99/9999 99:99')
	$('.hora').mask('99:99');
})