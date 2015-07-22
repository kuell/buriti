@extends('layouts.modulo')

@section('content')
<section class="content">
{{ Form::open( array('route' => 'farmacia.aso.store', 'rule'=>'form')) }}
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">
				Nova ficha ASO
			</h3>
		</div>
		<div class="panel-body">

				@include('farmacia::aso.form')

		</div>
		<div class="panel-footer">
			{{ Form::submit('Gravar e Gerar', ['class'=>'btn btn-primary']) }}
			{{ link_to_route('farmacia.aso.index', 'Cancelar', null, ['class'=>'btn btn-danger']) }}
		</div>

	</div>
{{ Form::close() }}
</section>
@endsection