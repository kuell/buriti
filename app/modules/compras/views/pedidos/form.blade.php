<div class="form-group">
	<div class="col-md-6">
		{{ Form::label('setor', 'Setor: ', ['class'=>'form-label']) }}
		{{ Form::select('setor_id', ['Selecione um setor ...']+Setor::ativos()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
	</div>

	<div class="col-md-6">
		{{ Form::label('solicitante', 'Solicitante: ', ['class'=>'form-label']) }}
		{{ Form::text('solicitante',  null, ['class'=>'form-control']) }}
	</div>
</div>

<div class="form-group">
	<div class="col-md-3">
		{{ Form::label('osi_id', 'Código da Ordem Interna: ', ['class'=>'form-label']) }}
		{{ Form::text('osi_id', null, ['class'=>'form-control numero']) }}
	</div>
</div>

<div class="form-group">
	<div class="col-md-12">
		{{ Form::label('obs', 'Observações: ', ['class'=>'form-label']) }}
		{{ Form::textarea('obs', null, ['class'=>'form-control']) }}
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$('select[name=setor_id]').chosen()
	})
</script>