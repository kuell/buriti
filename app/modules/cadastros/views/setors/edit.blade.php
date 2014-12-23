@extends('dashboard.index')

@section('main')

{{ HTML::head('Setores', 'controla os setores') }}
{{ HTML::boxhead('Editar setor: '.$setor->descricao) }}

<div class="box-body">

	{{ Form::model($setor, array('method' => 'PATCH',
		'route' => array('cadastro.setors.update', $setor->id) ,
		'rule'=>'form'))
	}}
	
	@include('cadastros::setors.form')
	
	{{ Form::close() }}
</div>

@endsection