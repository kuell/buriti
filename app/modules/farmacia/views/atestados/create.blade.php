@extends('dashboard.index')

@section('main')

{{ HTML::head('Atestados', 'controla os atestados') }}
{{ HTML::boxhead('Registra um novo atestado') }}

<div class="box-body">
	{{ Form::open(array('route' => 'farmacia.atestados.store', 'rule'=>'form')) }}
	@include('farmacia::atestados.form')
	{{ Form::close() }}
</div>
@endsection