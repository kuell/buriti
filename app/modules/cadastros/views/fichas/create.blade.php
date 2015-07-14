@extends('dashboard.index')

@section('main')
<div class="box box-info">
	{{ HTML::head('Fichas', 'controla as fichas de solicitação de emprego') }}
	{{ HTML::boxhead('Criar uma nova ficha') }}

	<div class="box-body">
		{{ Form::open(array('route' => 'fichas.store', 'rule'=>'form')) }}
			@include('cadastros::fichas.form')
			{{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}
		{{ Form::close() }}
	</div>
</div>

@endsection