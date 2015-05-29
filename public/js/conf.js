$(function(){
	$('form').formValidation();

	$('input[type=text], textarea').blur(function(){
		var texto = $(this).val().toUpperCase()
		$(this).val(texto);
	});
	$('.data').mask('99/99/9999');
	$('.data_hora').mask('99/99/9999 99:99')
	$('.hora').mask('99:99');

	$('.periodo').daterangepicker({
		ranges:{
			'Hoje':[moment(), moment()],
			'Ontem': [moment().subtract('days', 1), moment().subtract('days', 1)],
			'Ultimos 7 Dias': [moment().subtract('days', 6), moment()],
            'Ultimos 30 Dias': [moment().subtract('days', 29), moment()],
			'Este Mês': [moment().startOf('month'), moment().endOf('month')],
            'Mês Anterior': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]

			},
		locale: {
			customRangeLabel: 'Personalizar',
			fromLabel: 'De: ',
			toLabel: 'Até',
			daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex','Sab'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
			applyLabel: 'Aplicar',
			cancelLabel: 'Cancelar',
		},
		format: 'DD/MM/YYYY',
		buttonClasses: ['btn', 'btn-sm'],
		cancelClass: 'btn-danger btn-sm',
		separator: ' - ',
	

	}).mask('99/99/9999 - 99/99/9999');
})