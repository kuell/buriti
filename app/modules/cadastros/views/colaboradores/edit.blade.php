@extends('dashboard.index')

@section('main')
<div class="box box-primary">
	<div class="box-header">
		<h4 class="box-title">
			Alteração do setor - {{ $colaborador->nome }}
		</h4>
	</div>


	<div class="box-body">

		{{ Form::model($colaborador, array('method' => 'PATCH', 'route' => array('colaboradors.update', $colaborador->id) , 'class'=>'form form-horizontal')) }}
	    	@include('cadastros::colaboradores.form')
	    {{ Form::close() }}

    </div>
</div>
@endsection