@extends('dashboard.index')

@section('main')

  		{{ HTML::head('Setores', 'controla os setores') }}
  		{{ HTML::boxhead('Criar um novo setor') }}

  	<div class="box-body">
		{{ Form::open(array('route' => 'cadastro.setor.store', 'rule'=>'form')) }}
			@include('setors.form')
		{{ Form::close() }}
	</div>

@endsection