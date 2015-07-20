@extends('layouts.modulo')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading clearfix">
		<div class="panel-title pull-left">
			<h3>Analise de Ocorrencias</h3>
		</div>
	</div>
	<div class="panel-body">
		<div class="well">
			{{ Form::open(['route'=>'sesmt.analise.index', 'method'=>'get', 'class'=>'form form-horizontal']) }}
			<div class="form-group">
				<div class="col-md-4 col-sm-4">
					{{ Form::label('Periodo: ') }}
					{{ Form::text('periodo', Input::get('periodo'), ['class'=>'form-control periodo']) }}
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12">
					{{ Form::submit('Buscar', ['class'=>'btn btn-primary btn-sm']) }}
				</div>
			</div>

			{{ Form::close() }}
		</div>


		@include('sesmt::analises.lista')
	</div>
</div>

@stop