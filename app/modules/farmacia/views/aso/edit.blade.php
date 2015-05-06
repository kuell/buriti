@extends('layouts.modulo')

@section('content')
 {{ Form::model($aso, array('method' => 'PATCH', 'route' => array('farmacia.aso.update', $aso->id) )) }}
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">
				Editar ficha ASO
			</h3>
		</div>
		<div class="panel-body">
			@include('farmacia::aso.form')
		</div>
		<div class="panel-footer">
			{{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}
			{{ link_to_route('farmacia.aso.index', 'Cancelar', null, ['class'=>'btn btn-danger']) }}
		</div>

	</div>
 {{ Form::close() }}

@endsection