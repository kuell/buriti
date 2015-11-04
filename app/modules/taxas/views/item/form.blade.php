<div class="form-group">
	<div class="col-md-12">
		{{ Form::label('descricao', 'Descrição: ', ['class'=>'form-label']) }}
		{{ Form::text('descricao', null, ['class'=>'form-control']) }}
	</div>
</div>

<div class="form-group">
	<div class="col-md-3">
		{{ Form::label('grupo', 'Grupo: ', ['class'=>'form-label']) }}
		{{ Form::select('grupo', ['Taxa', 'Item', 'Romaneio'], null, ['class'=>'form-control']) }}
	</div>
	<div class="col-md-3">
		{{ Form::label('fiscal', 'Fiscal: ', ['class'=>'form-label']) }}
		{{ Form::select('fiscal', ['Sim', 'Não'], null, ['class'=>'form-control']) }}
	</div>
	<div class="col-md-3">
		{{ Form::label('genero', 'Genero: ', ['class'=>'form-label']) }}
		{{ Form::select('genero', ['Femea', 'Macho','Ambos'], null, ['class'=>'form-control']) }}
	</div>
	<div class="col-md-3">
		{{ Form::label('situacao', 'Situação: ', ['class'=>'form-label']) }}
		{{ Form::select('situacao', ['Ativo', 'Inativo'], null, ['class'=>'form-control']) }}
	</div>
</div>
