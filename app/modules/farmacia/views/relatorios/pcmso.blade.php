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
			{{ Form::button('Gerar',  ['class'=>'btn btn-primary', 'id'=>'pcmso']) }}
		</div>
	</div>

	<script type="text/javascript">
	$(function(){
		$('#pcmso').bind('click', function(){
			window.open('/farmacia/relatorios/pcmso/'+$('input[name=ano]').val(), 'Print', 'channelmode=yes');
		})
	})
	</script>

@stop