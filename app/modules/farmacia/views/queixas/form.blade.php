@if(empty($queixa))
	{{ Form::open(array('route' => 'farmacia.queixas.store', 'class'=>'form form-horizontal')) }}
@else
	{{ Form::model($queixa, ['route'=>['farmacia.queixas.update', $queixa->id], 'method'=>'PATCH', 'class'=>'form form-horizontal']) }}
@endif
	<div class="form-group">
		<div class="col-md-9">
			{{ Form::label('descricao', 'Descrição: ', ['class'=>'form-label']) }}
			{{ Form::text('descricao', null, ['class'=>'form-control']) }}
		</div>
		<div class="col-md-3">
			{{ Form::label('pcmso', 'Entra no Relatorio PCMSO: ', ['class'=>'form-label']) }}
			{{ Form::select('pcmso',['NÃO', 'SIM'] ,null, ['class'=>'form-control']) }}
		</div>

	</div>
	<div class="form-group">
		{{ Form::submit('Gravar', ['class'=>'btn btn-success']) }}
		{{ link_to_route('farmacia.queixas.index', 'Cancelar', null, ['class'=>'btn btn-danger']) }}
	</div>

{{ Form::close() }}
