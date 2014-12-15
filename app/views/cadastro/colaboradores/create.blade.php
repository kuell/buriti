@extends('dashboard.index')

@section('main')

  		{{ HTML::head('Colaboradores', 'controla os colaboradores') }}
  		{{ HTML::boxhead('Criar um novo colaborador') }}

  	<div class="box-body">
		{{ Form::open(array('route' => 'cadastro.colaborador.store', 'rule'=>'form')) }}
			@include('cadastro.colaboradores.form')
		{{ Form::close() }}
	</div>

@endsection