@extends('farmacia::ocorrencias.show')

@section('analise')

{{ Form::model($ocorrencia, ['route'=>['sesmt.analise.update', $ocorrencia->id], 'method'=>'PATCH', 'class'=>'form']) }}

<div class="panel panel-info">
	<div class="panel-heading">
		<h4 class="panel-title">Analisar ocorrencia {{ $ocorrencia->id }}</h4>
	</div>
	<div class="panel-body">

		<div class="form-group">
			<div class="col-sm-5">
				{{ Form::label('Tipo de Ocorrencia: ') }}
				{{ Form::select('tipo_id', [''=>'Selecione ...']+AnaliseOcorrencia::tiposOcorrencia(), null, ['class'=>'form-control']) }}
			</div>

			<div class="col-sm-7">
				{{ Form::label('Tipo de Ocorrencia: ') }}
				{{ Form::select('sub_tipo_id', [], null, ['class'=>'form-control']) }}
			</div>

		</div>

		<div class="form-group">
			<div class="col-sm-3">
				{{ Form::label('Gravidade', null, ['class'=>'form-label']) }}
				{{ Form::select('gravidade', ['Baixa', 'Média', 'Alta', 'Gave'], null, ['class'=>'form-control']) }}
			</div>
			<div class="col-sm-6">
				{{ Form::label('Causa ou Queixa: ') }}
				{{ Form::select('queixa_id', ['0'=>'Selecione ...']+Queixa::all()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
			</div>

		</div>

		<div class="form-group">
			<div class="col-sm-12">
				{{ Form::label('Observações: ') }}
				{{ Form::textarea('obs', null, ['class'=>'form-control', 'rows'=>3]) }}
			</div>
		</div>
		</div>
		<div class="panel-footer">
			<div class='form-group'>
				{{ Form::submit('Avaliar', ['class'=>'btn btn-primary']) }}
			</div>
		</div>

	</div>
</div>

{{ Form::close() }}

<script type="text/javascript">
	$(function(){
		$('select[name=queixa_id], select[name=tipo_id]').chosen({width: "100%"})

		$('select[name=tipo_id]').bind('change', function() {
			$.get('/farmacia/tipo_ocorrencia/find/'+$(this).val()+'/subtipo', function(data) {
				$("select[name=sub_tipo_id] option").remove();
				if(data.length == 0){
					$("select[name=sub_tipo_id]").append('<option value="0">Nenhum Informado ...</option>');
				}
				else{
					var options = "<option>Selecione ...</option>";

					$.each(data, function(key, val){
						options += '<option value="' + val.id + '">' + val.descricao + '</option>';
					})

					$("select[name=sub_tipo_id]").append(options);
				}
			});
		});
	})
</script>

@if(!empty($ocorrencia->tipo_id) or $ocorrencia->tipo_id <> 0)
	<script type="text/javascript">
	$(function(){
		$.get('/farmacia/tipo_ocorrencia/find/{{ $ocorrencia->tipo_id }}/subtipo', function(data) {
			$("select[name=sub_tipo_id] option").remove();
			if(data.length == 0){
				$("select[name=sub_tipo_id]").append('<option value="0">Nenhum Informado ...</option>');
			}
			else{
				var options = "<option>Selecione ...</option>";

				$.each(data, function(key, val){
					options += '<option value="' + val.id + '">' + val.descricao + '</option>';
				})

				$("select[name=sub_tipo_id]").append(options);
			}
		});
		$("select[name=sub_tipo_id]").val({{ $ocorrencia->sub_tipo_id }})
	})

	</script>
@endif

@stop