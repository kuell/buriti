@extends('dashboard.index')

@section('main')

{{ HTML::head('Ocorrenciaes', 'controla os ocorrenciaes') }}
{{ HTML::boxhead('Criar uma nova ocorrencia') }}

<div class="box-body">
	{{ Form::open(array('route' => 'farmacia.ocorrencias.store', 'rule'=>'form')) }}
	@include('farmacia::ocorrencias.form')
	{{ Form::close() }}
</div>

@endsection