@extends('dashboard.index')

@section('main')
<div class="box box-info">
	{{ HTML::head('Setores', 'controla os setores') }}
	{{ HTML::boxhead('Editar setor: '.$setor->descricao) }}

	<div class="box-body">

		{{ Form::model($setor, array('method' => 'PATCH',
			'route' => array('setors.update', $setor->id) ,
			'rule'=>'form'))
		}}

		@include('cadastros::setors.form')

		{{ Form::close() }}
	</div>
</div>
@endsection