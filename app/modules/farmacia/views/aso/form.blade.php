<div class="panel panel-info">
	<div class="panel-heading">
		<h4 class="panel-title">Informações do Colaborador</h4>
	</div>
	<div class="panel-body">

			<div class="form-group col-md-4">
				{{ Form::label('Tipo de A.S.O.: ')}}
				{{ Form::select('tipo', ['admissional'=>'Admissional', 'periodico'=>'Periodico', 'demissional'=>'Demissional', 'mudanca de funcao'=>'Mudança de Função', 'retorno ao trabalho'=>'Retorno ao Trabalho'], null, ['class'=>'form-control', 'id'=>'tipo_aso'])}}
			</div >
			<div class="form-group">
				<div class="form-group col-md-6">
					{{ Form::label('Médico: ')}}
					{{ Form::text('medico', empty($aso->medico)? 'DR PEDRO LUIZ GOMES': $aso->medico, ['class'=>'form-control'])}}
				</div>
			</div>

		<div class="col-md-12">
			<div class="form-group">

				@if(!empty($aso) && $aso->tipo == 'admissional')
				<div class="col-md-2">
					{{ Form::label('Matricula / Código Interno: ')}}
					{{ Form::text('colaborador_matricula', null, ['class'=>'form-control'], 'required') }}
				</div>
				@endif
				<div class="col-md-9">
					{{ Form::label('Nome do Colaborador: ')}}
					<div class="col-md-12 colaborador">

					</div>
				</div>

			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group col-md-2">
				{{ Form::label('Data Nascimento: ')}}
				{{ Form::text('colaborador_data_nascimento', null, ['class'=>'form-control data'])}}
			</div>
			<div class="form-group col-md-2">
				{{ Form::label('Sexo: ')}}
				{{ Form::select('colaborador_sexo',['1'=>'Masculino', '0'=>'Feminino'], null, ['class'=>'form-control'])}}
			</div>
			<div class="form-group col-md-4">
				{{ Form::label('Setor: ')}}
				{{ Form::select('colaborador_setor_id', [''=>'Selecione ....']+Setor::all()->lists('descricao', 'id'),null, ['class'=>'form-control'])}}
			</div>
			<div class="form-group col-md-4">
				{{ Form::label('Posto de Trabalho: ')}}
				{{ Form::select('posto_id', [], null, ['class'=>'form-control'])}}
			</div>
		</div>
		@if(!empty($aso))
			<div class="col-md-12 well">
				<div class="form-group col-md-2">
					{{ Form::label('Data Admissão  ')}}
					@if(!empty($aso) && $aso->tipo == 'admissional')
						{{ Form::text('colaborador_data_admissao', null, ['class'=>'form-control data'])}}
					@else
						{{ Form::text('colaborador_data_admissao', null, ['class'=>'form-control data', 'disabled'])}}
					@endif
				</div>
				<div class="form-group col-md-4">
					{{ Form::label('Apto?  ')}}
					{{ Form::select('status', ['apto'=>'Apto', 'inapto'=>'Inapto'], null, ['class'=>'form-control'])}}
				</div>
				<div class="col-md-4">
				{{ Form::label('Situação da Ficha Aso: ', null) }}
				{{ Form::select('situacao', [ 'andamento'=>'Em Andamento', 'fechado'=>'Finalizado'], $aso->situacao, ['class'=>'form-control'])}}
			</div>
			</div>
		@endif
		<div class="col-md-12">
			{{ Form::label('Observações: ')}}
			{{ Form::textArea('obs', null, ['class'=>'form-control'])}}
		</div>
	</div>
</div>


@include('farmacia::aso.partials._js')