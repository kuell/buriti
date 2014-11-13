$(function(){
	$('input[type=text], textarea').blur(function(){
		var texto = $(this).val().toUpperCase()
		$(this).val(texto);
	});
})