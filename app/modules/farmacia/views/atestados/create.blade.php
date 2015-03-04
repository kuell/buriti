@extends('layouts.modulo')

@section('content')
<section class="content">
	{{ HTML::head('Atestados', 'controla os atestados') }}
	<div class="row">
		<div class="box box-primary box-solid">
			<div class="box-header">
				<h3 class="box-title">
					Novo Lançamento de Atestado
				</h3>			
			</div>

			{{ Form::open(array('route' => 'farmacia.atestados.store', 'rule'=>'form')) }}
			@include('farmacia::atestados.form')
			{{ Form::close() }}
		</div>
	</div>
</section>
@endsection