@extends('dashboard.index')

@section('main')
<div class="box box-info">
		{{ HTML::head('Setores', 'controla os setores') }}
		{{ HTML::boxhead('Criar um novo setor') }}

	<div class="box-body">
		{{ Form::open(array('route' => 'setors.store', 'rule'=>'form')) }}
		@include('cadastros::setors.form')
		{{ Form::close() }}
	</div>
</div>

@endsection