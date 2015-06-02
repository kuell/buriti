@extends('layouts.modulo')

@section('content')
 {{ Form::model($osi, array('method' => 'PATCH', 'route' => array('manutencao.osi.update', $osi->id) , 'id'=>'form_aso')) }}
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">
				Editar ficha ASO
			</h3>
		</div>
		<div class="panel-body">
			@include('manutencao::osi.form')
		</div>
		<div class="panel-footer">
			{{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}
			{{ link_to_route('manutencao.osi.index', 'Voltar', null, ['class'=>'btn btn-danger']) }}
		</div>
	</div>
{{ Form::close() }}

@stop