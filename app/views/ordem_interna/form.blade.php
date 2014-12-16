
<div class="col-md-12"> 
	<div class="col-md-3 form-group"> 
		{{ Form::label('data', 'Data : ')}}
		{{ Form::text('data', date('d/m/Y'), ['class'=>'form-control', 'id'=>'data'])}}
	</div>

	<div class="col-md-9">
		{{ Form::label('requisitante', 'Requisitante: ') }}
		{{ Form::text('requisitante', null, ['class'=>'form-control']) }}
	</div>
</div>
<div class="col-md-12">
	<div class="col-md-6">
		{{ Form::label('setor_responsavel_id', 'Setor responsável pelo serviço: ') }}
		{{ Form::select('setor_responsavel_id', array(''=>'Selecione ...')+Setor::all()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
	</div>

	<div class="col-md-6">
		{{ Form::label('setor_requisitado_id', 'Setor de realização do serviço: ') }}
		{{ Form::select('setor_requisitante_id', array(''=>'Selecione ...')+Setor::all()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-5">
		{{ Form::label('equipamento', 'Equipamento: ') }}
		{{ Form::text('equipamento_id', null, ['class'=>'form-control', 'id'=>'equipamento']) }}
	</div>
</div>


<div class="col-md-12">
	<div class="col-md-12">
		{{ Form::label('descricao', 'Descrição da Ordem de Serviço: ') }}
		{{ Form::textarea('obs', null, ['class'=>'form-control']) }}
	</div>
</div>

<script>
$( "#equipamento" ).autocomplete({
		source: [ 	@foreach (Equipamento::all() as $e)
						'{{ $e->descricao }}',
				  	@endforeach ]
	});


	$( "#data" ).datepicker({ 
						dateFormat: 'dd/mm/yy'
					});
	$('#data').mask('99/99/9999');
	$('.valor').maskMoney({
					showSymbol:false, 
					decimal:",", 
					thousands:"."});

    $(function(){
        $(".numero").bind("keyup blur focus", function(e) {
            e.preventDefault();
            var expre = /[^0-9]/g;
            // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
            if ($(this).val().match(expre))
                $(this).val($(this).val().replace(expre,''));
        });
     });		
	
</script>