@if(empty($queixa))
	{{ Form::open(array('route' => 'farmacia.queixas.store', 'rule'=>'form')) }}
@else
	{{ Form::model($queixa, ['route'=>['farmacia.queixas.update', $queixa->id], 'method'=>'PATCH', 'rule'=>'form']) }}
@endif
	<div class="form-group">
		{{ Form::label('descricao', 'Descrição: ', ['class'=>'form-label']) }}
		{{ Form::text('descricao', null, ['class'=>'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::submit('Gravar', ['class'=>'btn btn-success']) }}
		{{ link_to_route('farmacia.queixas.index', 'Cancelar', null, ['class'=>'btn btn-danger']) }}
	</div>

{{ Form::close() }}
