
@if($ocorrencia->elemento)
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

@endif

<fieldset ng-app="App">
	<div class="form-group col-md-12">
		<div class="col-md-12">
			{{ Form::label('Natureza da Lesão: ') }}
		</div>
		<div class="form-group col-md-3">
			{{ Form::select('elemento_id', [''=>'Selecione ...']+FarmaciaElemento::whereNull('elemento_pai')->lists('descricao', 'id'), null, ['class'=>'form-control', 'id'=>'elemento1'] ) }}
		</div>
		<div class="col-md-3">
			{{ Form::select('elemento', [], null, ['class'=>'form-control hidden', 'id'=>'elemento2'])}}
		</div>
		<div class="col-md-3">
			{{ Form::select('elemento', [], null, ['class'=>'form-control hidden', 'id'=>'elemento3'])}}
		</div>
		<div class="col-md-3">
			{{ Form::select('elemento', [], null, ['class'=>'form-control hidden', 'id'=>'elemento4'])}}
		</div>
		<div class="col-md-12">
			{{ Form::button('Limpa Seleção', ['class'=>'btn btn-success', 'id'=>'limpa_select'])}}
		</div>
		{{ Form::hidden('elemento_id', null)}}

	</div>

	<div class="form-group col-md-12" ng-controller="OcorrenciaCtrl">
	    <div class="form-group col-md-2">
	      {{ Form::label('codigo_interno', 'Matrícula: ') }}
	      {{ Form::text('codigo_interno', null, array('class'=>'form-control', 'ng-model'=>'cod_interno', 'ng-blur'=>'busca(this)') ) }}
	    </div>

	    <div class="form-group col-md-8">
	      {{ Form::label('colaborador_id', 'Nome do Colaborador: ') }}
	      {{ Form::select('colaborador_id', array('0'=>'Selecione ...')+Colaborador::orderBy('nome')->lists('nome','id'), null, array('class'=>'form-control') ) }}
	    </div>
	    <div class="form-group col-md-2">
	      {{ Form::label('data', 'Data e Hora: ') }}
	      {{ Form::text('data_hora', date('d/m/Y H:i'), array('class'=>'form-control') ) }}
	    </div>
	</div>


  <div class="col-md-12">
    <div class="form-group col-md-6">
      {{ Form::label('relato', 'Relato do Acidente: ') }}
      {{ Form::textarea('relato', null, array('class'=>'form-control', 'rows'=>4) ) }}
    </div>
    <div class="form-group col-md-6">
      {{ Form::label('diagnostico', 'Diagnóstico: ') }}
      {{ Form::textarea('diagnostico', null, array('class'=>'form-control', 'rows'=>4) ) }}
    </div>
  </div>

  <div class="form-group col-md-12">
    <div class="form-group col-md-6">
      {{ Form::label('conduta', 'Conduta: ') }}
      {{ Form::textarea('conduta', null, array('class'=>'form-control', 'rows'=>4) ) }}
    </div>
    <div class="form-group col-md-6">
      {{ Form::label('destino', 'Destino: ') }}
      {{ Form::textarea('encaminhamento', null, array('class'=>'form-control', 'rows'=>4) ) }}
    </div>
  </div>

  <div class="form-group col-md-5">
    {{ Form::label('profissional', 'Profissional: ') }}
    {{ Form::text('profissional', null, array('class'=>'form-control') ) }}
  </div>


  <div class="col-md-9">
    <button type="submit" class="btn btn-primary">Gravar</button>
    {{ link_to_route('farmacia.ocorrencias.index', 'Cancelar', null, array('class'=>'btn btn-danger')) }}

  </fieldset>
</div>

@section('scripts')

<script type="text/javascript">
$(function(){
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


	$('select[name=colaborador_id]').bind('change blur', function(){
	    $.get('/colaboradors/'+$(this).val(), {id:$(this).val()}, function(data){
			$('input[name=codigo_interno]').val(data.codigo_interno);
		})
	});

	$('input[name=codigo_interno]').blur(function(event) {
		if($(this).val() != null){
			$.get('/colaboradors/'+$(this).val(), null, function(data){
				if(data.id == null){
					$('input[name=codigo_interno]').val('');
					$('select[name=colaborador_id]').val(0);

					alert("Código interno do colaborador não encontrado!")
				}
				else{
					$('select[name=colaborador_id]').val(data.id)
				}
			})
		}
	}).val({{ $ocorrencia->colaborador->codigo_interno or null }});
});
</script>

@stop