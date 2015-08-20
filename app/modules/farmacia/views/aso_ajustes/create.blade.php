@extends('layouts.modulo')

@section('content')
<section class="content">
{{ Form::open( array('route' => 'farmacia.aso_ajustes.store', 'rule'=>'form')) }}
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">
				Nova ficha ASO AJUSTE
			</h3>
		</div>
		<div class="panel-body">

				@include('farmacia::aso_ajustes.form')

		</div>
		<div class="panel-footer">
			{{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}
			{{ link_to_route('farmacia.aso_ajustes.index', 'Cancelar', null, ['class'=>'btn btn-danger']) }}
		</div>

	</div>
{{ Form::close() }}
</section>
@endsection