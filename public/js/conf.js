$(function(){
	$('form').formValidation();
	$(".valor").maskMoney({
		thousands: '.',
		decimal:',',
		prefix: 'R$ ',
		affixesStay: false
	});

	$('input[type=text], textarea').blur(function(){
		var texto = $(this).val().toUpperCase()
		$(this).val(texto);
	});
	$('.data').mask('99/99/9999');
	$('.data_hora').mask('99/99/9999 99:99')
	$('.hora').mask('99:99');
	$('.emissor').mask('aaa/aa');
    $('.cpf').mask('999.999.999/99');
    $('.cep').mask('99.999-999');
    $('.fone').mask('(99) 9999-9999');
    $('.numero').bind("keyup blur focus", function(e) {
                e.preventDefault();
                var expre = /[^0-9]/g;
                // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
                if ($(this).val().match(expre))
                    $(this).val($(this).val().replace(expre,''));
            });

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
