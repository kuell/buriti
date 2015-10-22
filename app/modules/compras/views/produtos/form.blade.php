<div class="form-group">
	<div class="col-md-3">
		{{ Form::label('codigo_interno', 'Código Interno: ', ['class'=>'form-label']) }}
		{{ Form::text('codigo_interno', null, ['class'=>'form-control']) }}
	</div>
	<div class="col-md-9">
		{{ Form::label('descricao', 'Descrição: ', ['class'=>'form-label']) }}
		{{ Form::text('descricao', null, ['class'=>'form-control']) }}
	</div>
</div>

<div class="form-group">
	<div class="col-md-4">
		{{ Form::label('agrupamento', 'Agrupamento: ', ['class'=>'form-label']) }}
		{{ Form::select('agrupamento', ['Selecione ...', 'Geral'], null, ['class'=>'form-control']) }}
	</div>

	<div class="col-md-4">
		{{ Form::label('unidade_medida', 'Unidade de Medida: ', ['class'=>'form-label']) }}
		{{ Form::text('unidade_medida', null, ['class'=>'form-control']) }}
	</div>

	<div class="col-md-4">
		{{ Form::label('situacao', 'Situação: ', ['class'=>'form-label']) }}
		{{ Form::select('situacao', ['ativo'=>'Ativo', 'inativo'=>'Inativo'], null, ['class'=>'form-control']) }}
	</div>
</div>
<div class="form-group">
	<div class="col-md-9">
		{{ Form::label('Imagem', 'Imagem do Produto: ', ['class'=>'form-label']) }}
		{{ Form::file('img', ['class'=>'form-control']) }}
	</div>
	<div class="col-md-3">
		@if(!empty($produto))
			{{ HTML::image($produto->img, null, ['width'=>200]) }}
		@endif
	</div>
</div>