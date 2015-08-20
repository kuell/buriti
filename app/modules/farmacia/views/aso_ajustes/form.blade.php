<div class="panel panel-info">
	<div class="panel-heading">
		<h4 class="panel-title">Informações do Colaborador</h4>
	</div>
	<div class="panel-body">

	{{ Form::hidden('tipo', 'admissional') }}
	{{ Form::hidden('ajuste', true) }}

		<div class="form-group">
			<div class="col-md-8">
				{{ Form::label('Colaborador: ')}}
				{{ Form::select('colaborador_id', [''=>'Selecione o Colaborador']+Colaborador::ativos()->lists('nome', 'id'), null, ['class'=>'form-control', 'required'])}}
			</div>
			<div class="col-md-4">
				{{ Form::label('Data de Admissão: ') }}
				{{ Form::text('colaborador_data_admissao', null, ['class'=>'form-control data']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				{{ Form::label('Médico: ')}}
				{{ Form::text('medico', empty($aso->medico)? 'DR PEDRO LUIZ GOMES': $aso->medico, ['class'=>'form-control', 'required'])}}
			</div>
			<div class="col-md-6">
				{{ Form::label('Data de Realização: ') }}
				{{ Form::text('data', null, ['class'=>'form-control data']) }}
			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	$(function(){
		$('select[name=colaborador_id]').chosen().on('change', function(){
			$.get('/farmacia/aso/find/'+$(this).val()+'/admissional', null, function(data){
				if(data != 0){
					alert('Aso ADMISSIONAL ja cadastrada para este Colaborador!\n '+data[0].id);
				}

			})

			$.get('/colaboradors/find/'+$(this).val()+'/id', null, function(data){
				$('input[name=colaborador_data_admissao]').val(data.data_admissao)
			})

		})
	})
</script>