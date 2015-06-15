@extends('dashboard.index')

@section('main')
<div class="box box-info">
	{{ HTML::head('Colaboradores', 'controla os colaboradores') }}
	{{ HTML::boxhead('Criar um novo colaborador') }}

	<div class="box-body">
		{{ Form::open(array('route' => 'colaboradors.store', 'rule'=>'form')) }}
			@include('cadastros::colaboradores.form')
		{{ Form::close() }}
	</div>
</div>
@endsection