
@extends('layouts.frame')


@section('frame')

	@if(!$ocorrencia->planoAcaos()->where('situacao', '<>', 'Finalizado')->count())

	<div class="well well-sm">
		{{ Form::open(['route'=>['sesmt.plano_acao.store', 'ocorrencia_id'=>$ocorrencia->id], 'class'=>'form']) }}
			<div class="form-group">
				{{ Form::label('descricao ', 'Descrição do Plano de Ação: ', ['class'=>'form-label']) }}
				{{ Form::textarea('descricao', null, ['class'=>'form-control', 'rows'=>'3']) }}
			</div>
			<div class="form-group">
				{{ Form::submit('Gravar', ['class'=>'btn btn-success']) }}
			</div>
		{{ Form::close() }}

	@endif

	</div>
<div class="col-md-12">

	<div class="panel-group">
		@foreach($ocorrencia->plano_acaos as $plano)
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{ $plano->id }}" aria-expanded="true" aria-controls="collapseOne">
						>> {{ $plano->descricao }}
					</a>
					<button class="badge btn-danger btn-sm pull-right" name="delete_filho" value="{{ $plano->id }}">delete</button>
				</h4>
			</div>
		</div>
		<div id="{{ $plano->id }}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">

			@if(count($plano->filhos))
			<ul class="list-group">
				@foreach($plano->filhos as $filho)
					<li class="list-group-item">{{ $filho->descricao }}
						<button class="badge badge-info" name="delete_filho" value="{{ $filho->id }}">delete</button>
					</li>
				@endforeach
			</ul>
			@endif

			@if($plano->situacao != 'Finalizado')

			{{ Form::open(['route'=>['sesmt.plano_acao.update', $plano->id], 'class'=>'form form-horizontal', 'method'=>'patch']) }}

				<div class="form-group">
					<div class="col-xs-12">
					{{ Form::label('', 'Retorno da Ação: ', ['class'=>'form-label']) }}
					{{ Form::textarea('descricao', null, ['class'=>'form-control', 'rows'=>3]) }}
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12">
						{{ Form::submit('Adicionar', ['class'=>'btn btn-sm btn-success', 'name'=>'method', 'value'=>'adicionar']) }}
						{{ Form::submit('Finalizar', ['class'=>'btn btn-sm btn-info', 'name'=>'method', 'value'=>'finalizar']) }}
					</div>
				</div>
			{{ Form::close() }}

			@endif

		</div>
		@endforeach
	</div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
	$(function(){
		$('button[name=delete_filho]').bind('click', function() {
			$.post('/sesmt/plano_acao/'+$(this).val(), {_method:'DELETE'}, function(data){
			});

			location.reload()
		});
	})
</script>
@stop