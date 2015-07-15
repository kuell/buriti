
{{--@if($ocorrencia->elemento)
	@if(count($ocorrencia->elemento->pai->first()->pai->first()->pai))
		<label class="label label-default">
			{{ $ocorrencia->elemento->pai->first()->pai->first()->pai->first()->descricao }}
		</label>
	@endif

	@if(count($ocorrencia->elemento->pai->first()->pai->first()->pai))
		<label class="label label-default">
			{{ $ocorrencia->elemento->pai->first()->pai->first()->descricao }}
		</label>
	@endif

	@if(count($ocorrencia->elemento->pai))
		<label class="label label-default">
			{{ $ocorrencia->elemento->pai->first()->descricao }}
		</label>
	@endif

	@if($ocorrencia->elemento)
		<label class="label label-default">
			{{ $ocorrencia->elemento->descricao }}
		</label>
	@endif

@endif --}}

<fieldset>
	<div class="form-group">
		<div class="col-md-12">
			{{ Form::label('Natureza da Lesão: ') }}
		</div>
		<div class="col-md-3 col-sm-3">
			{{ Form::select('elemento_id', [''=>'Selecione ...']+FarmaciaElemento::whereNull('elemento_pai')->lists('descricao', 'id'), null, ['class'=>'form-control', 'id'=>'elemento1'] ) }}
		</div>
		<div class="col-md-3 col-sm-3">
			{{ Form::select('elemento', [], null, ['class'=>'form-control hidden', 'id'=>'elemento2'])}}
		</div>
		<div class="col-md-3 col-sm-3">
			{{ Form::select('elemento', [], null, ['class'=>'form-control hidden', 'id'=>'elemento3'])}}
		</div>
		<div class="col-md-3 col-sm-3">
			{{ Form::select('elemento', [], null, ['class'=>'form-control hidden', 'id'=>'elemento4'])}}
		</div>
		<div class="col-md-12 col-sm-12">
			{{ Form::button('Limpa Seleção', ['class'=>'btn btn-success', 'id'=>'limpa_select'])}}
		</div>
		{{ Form::hidden('elemento_id', null)}}
		{{ Form::hidden('conduta', null)}}

	</div>

	<div class="form-group">
	     <div class="col-md-3 col-sm-3">
	      {{ Form::label('data', 'Data e Hora: ') }}
	      {{ Form::text('data_hora', date('d/m/Y H:i:s'), array('class'=>'form-control data_hora', 'required') ) }}
	    </div>
	    <div class="col-md-2 col-sm-2">
	      {{ Form::label('monitoramento', 'Monitoramento?') }}
	      {{ Form::select('monitoramento', ['Não', 'Sim'], null, array('class'=>'form-control', 'required') ) }}
	    </div>
	    <div class="col-md-3 col-sm-3">
	      {{ Form::label('sesmt', 'Encaminhar para SESMT?') }}
	      {{ Form::select('sesmt', ['Não', 'Sim'], null, array('class'=>'form-control', 'required') ) }}
	    </div>
	</div>

	<div class="form-group">
	    <div class="col-md-12 col-sm-12">
	      {{ Form::label('colaborador_id', 'Matrícula - Nome do Colaborador: ') }}
	      {{ Form::select('colaborador_id', array(''=>'Selecione ...')+Colaborador::ativos()->lists('nome','id'), null, array('class'=>'form-control', 'required') ) }}
	    </div>
	</div>


  	<div class="form-group">
    	<div class="col-md-6 col-sm-6">
      		{{ Form::label('relato', 'Relato da ocorrencia: ') }}
      		{{ Form::textarea('relato', null, array('class'=>'form-control', 'rows'=>4) ) }}
    	</div>
    	<div class="col-md-6 col-sm-6">
      		{{ Form::label('diagnostico', 'Diagnóstico: ') }}
      		{{ Form::textarea('diagnostico', null, array('class'=>'form-control', 'rows'=>4) ) }}
    	</div>
  	</div>

  	<div class="form-group">
	    <div class="col-md-6 col-sm-6">
	      {{ Form::label('destino', 'Destino: ') }}
	      {{ Form::text('encaminhamento', null, array('class'=>'form-control', 'rows'=>4) ) }}
	    </div>
		<div class="col-md- col-sm-6">
			{{ Form::label('profissional', 'Profissional: ') }}
			{{ Form::text('profissional', null, array('class'=>'form-control', 'required') ) }}
		</div>
  	</div>
  </fieldset>

@section('scripts')

<script type="text/javascript">
$(function(){
	$("select[name=colaborador_id]").prop('required', true).chosen()
	$("select[name=tipo]").prop('required', true).chosen()

	$('#limpa_select').click(function(event) {
		$('#elemento1, #elemento2, #elemento3, #elemento4').val("");
		$('#elemento2, #elemento3, #elemento4').addClass('hidden').removeAttr('disabled');
		$('#elemento1').removeAttr('disabled')
	});

	$('#elemento1, #elemento2, #elemento3, #elemento4').change(function() {
		if($(this)[0].id == 'elemento1'){
			elemento = '#elemento2';
		}
		if($(this)[0].id == 'elemento2'){
			elemento = '#elemento3';
		}
		if($(this)[0].id == 'elemento3'){
			elemento = '#elemento4';
		}

		$.getJSON("/farmacia/ocorrencias/elemento/"+$(this).val(), null, function(data) {
			options = '<option value="">Selecione ...</option>';

			if(data.length != 0){
				for (var i = 0; i < data.length; i++) {
						options += '<option value="' + data[i].id + '">' + data[i].descricao + '</option>';
					}

				$('#'+$(this)[0].id).attr('disabled','disabled');
				$(elemento).html(options).removeClass('hidden')
			}
		});

		$('#'+$(this)[0].id).attr('disabled', 'disabled');
		$("input[name=elemento_id]").val($(this).val())


	});

});
</script>

@stop