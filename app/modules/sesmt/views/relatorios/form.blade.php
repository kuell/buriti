@extends('layouts.modulo')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">Relatorio Anual do PCMSO</h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="col-md-3">
					{{ Form::label('Periodo: ') }}
					{{ Form::text('periodo', null, ['class'=>'form-control periodo']) }}
				</div>
				<div class="col-md-3">
					{{ Form::label('Setor: ') }}
					{{ Form::select('setor', ['Selecione ...']+Setor::ativos()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
				</div>
			</div>
		</div>
		<div class="panel-footer">
			{{ Form::button('Colaborador / Monitoramento Pressão Arterial',  ['class'=>'btn btn-primary', 'id'=>'colaborador']) }}
		</div>
	</div>

	<script type="text/javascript">
	$(function(){
		$('select[name=setor]').chosen();
		$('#colaborador').bind('click', function(){
			window.open('/sesmt/relatorios/colaborador_monitoramento?setor='+$('select[name=setor]').val()+'&periodo='+$('input[name=periodo]').val(), 'Print', 'channelmode=yes');
		})
	})
	</script>

@stop