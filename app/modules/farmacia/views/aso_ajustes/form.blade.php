<div class="panel panel-info">
	<div class="panel-heading">
		<h4 class="panel-title">Informações do Colaborador</h4>
	</div>
	<div class="panel-body">

	{{ Form::hidden('ajuste', true) }}

		<div class="form-group">
			<div class="col-md-3">
				{{ Form::label('Tipo Aso: ')}}
				{{ Form::select('tipo', [''=>'Selecione ...']+Aso::tipo(), null, ['class'=>'form-control', 'required', 'id'=>'tipo'])}}
			</div>

			<div class="col-md-6">
				{{ Form::label('Colaborador: ')}}
				{{ Form::select('colaborador_id', [''=>'Selecione o Colaborador']+Colaborador::ativos()->lists('nome', 'id'), null, ['class'=>'form-control', 'required'])}}
			</div>
			<div class="col-md-3">
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

			if($('#tipo').val() == 'admissional' || $('#tipo').val() == 'demissional'){

				$.get('/farmacia/aso/find/'+$(this).val()+'/'+$('#tipo').val(), null, function(data){
					if(data != 0){
						alert('Aso '+$('#tipo').val()+' ja cadastrada para este Colaborador!\n '+data[0].id);
						if(confirm('Deseja abrir a Ficha Aso '+$('#tipo').val()+' deste colaborador?')){
							location = '/farmacia/aso/'+data[0].id+'/edit'
						}
					}

				})

			}



			$.get('/colaboradors/find/'+$(this).val()+'/id', null, function(data){
				$('input[name=colaborador_data_admissao]').val(data.data_admissao)
			})

		})
	})
</script>