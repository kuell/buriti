<div class="form-group">
	<div class="col-md-12">
		{{ Form::label('nome', 'Nome: ', ['class'=>'form-label']) }}
		{{ Form::text('nome', null, ['class'=>'form-control']) }}
	</div>
</div>

<div class="form-group">
	<div class="col-md-3">
		{{ Form::label('codigo_interno', 'Codigo Interno: ', ['class'=>'form-label']) }}
		{{ Form::text('codigo_interno', null, ['class'=>'form-control']) }}
	</div>
	<div class="col-md-5">
		{{ Form::label('email', 'E-mail: ', ['class'=>'form-label']) }}
		{{ Form::text('email', null, ['class'=>'form-control email']) }}
	</div>
	<div class="col-md-3">
		{{ Form::label('situacao', 'Situação: ', ['class'=>'form-label']) }}
		{{ Form::select('situacao',['Ativo', 'Inativo'], null, ['class'=>'form-control']) }}
	</div>
</div>
