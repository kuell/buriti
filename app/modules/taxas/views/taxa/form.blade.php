<div class="form-group">
	<div class="col-md-3">
		{{ Form::label('data', 'Data: ', ['class'=>'form-label']) }}
		{{ Form::text('data', null, ['class'=>'form-control data']) }}
	</div>
	<div class="col-md-6">
		{{ Form::label('corretor', 'Corretor: ', ['class'=>'form-label']) }}
		{{ Form::select('corretor_id', [''=>'Selecione ...']+Corretor::ativos()->lists('nome', 'id'), null, ['class'=>'form-control']) }}
	</div>
</div>

<div class="form-group">
	<div class="col-md-12">
		{{ Form::label('obs', 'Observação: ', ['class'=>'form-label']) }}
		{{ Form::textarea('obs', null, ['class'=>'form-control']) }}
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$('select[name=corretor_id]').chosen();
	})
</script>