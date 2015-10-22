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

	    <div class="form-group">
			<div class="col-md-12">
			  <button type="submit" class="btn btn-primary">Gravar</button>
			  {{ link_to_route('colaboradors.index', 'Cancelar', null, array('class'=>'btn btn-danger')) }}
			  @if(!empty(Input::get('pg')))
				@if(Input::get('pg') == 'aso')
			  		{{ link_to_route('farmacia.aso.index', 'Voltar', null, ['class'=>'btn btn-info']) }}
			  	@endif
			  @endif
			</div>
		</div>

	    {{ Form::close() }}

    </div>
</div>
@endsection