@extends('layouts.modulo')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">Relatorio Anual do PCMSO</h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="col-md-3">
					{{ Form::label('Ano: ') }}
					{{ Form::text('ano', null, ['class'=>'form-control']) }}
				</div>
			</div>
		</div>
		<div class="panel-footer">
			{{ Form::button('Colaborador / Exames',  ['class'=>'btn btn-primary', 'id'=>'colaborador']) }}
			{{ Form::button('PCMSO Exames',  ['class'=>'btn btn-info', 'id'=>'exames']) }}
			{{ Form::button('PCMSO Queixas',  ['class'=>'btn btn-warning', 'id'=>'queixas']) }}
		</div>
	</div>

	<script type="text/javascript">
	$(function(){
		$('#colaborador').bind('click', function(){
			window.open('/farmacia/relatorios/colaborador_exames', 'Print', 'channelmode=yes');
		})
		$('#exames').bind('click', function(){
			window.open('/farmacia/relatorios/exames/'+$('input[name=ano]').val(), 'Print', 'channelmode=yes');
		})
		$('#queixas').bind('click', function(){
			window.open('/farmacia/relatorios/ocorrencia/queixa/'+$('input[name=ano]').val(), 'Print', 'channelmode=yes');
		})
	})
	</script>

@stop