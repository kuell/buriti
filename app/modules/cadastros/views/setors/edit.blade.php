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

		<div class="col-md-12">
		<div class="box box-warning">
			<div class="box box-header">
				<h3>Funções do setor</h3>
			</div>
			<div class="box">
				<iframe src="/setors/funcaos/{{ $setor->id }}" class="col-md-12" style="border: 1px"></iframe>

			</div>
		</div>


		</div>

	</div>



</div>



@endsection
