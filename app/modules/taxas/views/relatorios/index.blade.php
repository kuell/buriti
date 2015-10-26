@extends('layouts.modulo')

@section('content')

	<div class="panel panel-primary">
		<div class="panel-heading clearfix">
			<h4 class="panel-title pull-left">
				Relatorio de Taxas
			</h4>
		</div>
		<div class="panel-body">

			{{ Form::open(['class'=>'form form-horizontal']) }}
				<div class="form-group">
					<div class="col-md-3">
						{{ Form::label('periodo', 'Periodo', ['class'=>'form-label']) }}
						{{ Form::text('periodo', null,['class'=>'form-control periodo']) }}
					</div>

					<div class="col-md-3">
						{{ Form::label('corretor', 'Corretor', ['class'=>'form-label']) }}
						{{ Form::select('corretor_id', ['Todos']+Corretor::all()->lists('nome', 'id'), null, ['class'=>'form-control']) }}
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						{{ Form::button('Taxa', ['class'=>'btn btn-primary btn-sm', 'name'=>'taxa']) }}
					</div>
				</div>
			{{ Form::close() }}

		</div>
	</div>

	<script type="text/javascript">
	$(function(){
		$('select[name=corretor_id]').chosen();

		$('button[name=taxa]').bind('click', function(){
			open('/taxa/relatorios/taxa?periodo='+$('input[name=periodo]').val()+'&corretor_id='+$('select[name=corretor_id').val(), 'Print', 'channelmode=yes')
		})
	})
	</script>
@stop