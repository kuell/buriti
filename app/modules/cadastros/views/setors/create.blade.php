@extends('dashboard.index')

@section('main')
<div class="box box-primary">
	<div class="box-header">
		<h4 class="box-title">
			Inclusão de um novo setor
		</h4>
	</div>

	<div class="box-body">
	{{ Form::open(array('route' => 'setors.store', 'class'=>'form form-horizontal')) }}

		@include('cadastros::setors.form')

		<div class="form-group">
			<div class="col-md-12">
		    	<button type="submit" class="btn btn-primary">Gravar</button>
		    	{{ link_to_route('setors.index', 'Cancelar', null, array('class'=>'btn btn-danger')) }}
			</div>
		</div>

	{{ Form::close() }}
	</div>
</div>

@endsection