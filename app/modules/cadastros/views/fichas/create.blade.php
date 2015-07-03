@extends('dashboard.index')

@section('main')
<div class="box box-info">
		{{ HTML::head('Nova Ficha', null) }}

	<div class="box-body">
		{{ Form::open(array('route' => 'fichas.store', 'rule'=>'form')) }}
		@include('cadastros::fichas.form')
		{{ Form::close() }}
	</div>
</div>

@endsection