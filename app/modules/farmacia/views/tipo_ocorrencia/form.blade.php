

@if(empty($tipo->id))
	{{ Form::open(['route'=>'farmacia.tipo_ocorrencia.store']) }}
@else
	{{ Form::model($tipo, ['route'=>['farmacia.tipo_ocorrencia.update', $tipo->id], 'method'=>'PATCH']) }}
@endif


	<div class="form-group">
		{{ Form::label('Agrupamento: ', null, ['class'=>'form-label']) }}
		{{ Form::select('pai_id', ['0'=>'Nenhum']+TipoOcorrencia::all()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
	</div>
	<div class="form-group">
		{{ Form::label('Descrição: ', null, ['class'=>'form-label']) }}
		{{ Form::text('descricao', null, ['class'=>'form-control']) }}
	</div>

	<div>
		{{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}
		{{ link_to_route('farmacia.tipo_ocorrencia.index', 'Cancelar', null, ['class'=>'btn btn-danger']) }}
	</div>



{{ Form::close() }}