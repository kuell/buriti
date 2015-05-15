$(document).ready(function() {
	$('[data-toggle=offcanvas]').click(function() {
		$('.row-offcanvas').toggleClass('active');
	});
	
	$('select[name=setor_id]').chosen();
	$('select[name=colaborador_id]').chosen({
		allow_single_deselect: false,
		no_results_text: "Nenhum resultado encontrado!<br /> Você digitou: ",
		placeholder_text_single: "Selecione ou busque um colaborador ..."
	});
});