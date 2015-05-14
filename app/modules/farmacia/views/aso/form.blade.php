<fieldset>

	<h4>Informações do Colaborador</h4>
	<div class="col-md-12">
		<div class="form-group col-md-4">
			{{ Form::label('Tipo de A.S.O.: ')}}
			{{ Form::select('tipo', ['admissional'=>'Admissional', 'periodico'=>'Periodico', 'demissional'=>'Demissional', 'mudanca de funcao'=>'Mudança de Função', 'retorno ao trabalho'=>'Retorno ao Trabalho'], null, ['class'=>'form-control', 'id'=>'tipo_aso'])}}
		</div>
		<div class="form-group">
			<div class="form-group col-md-6">
				{{ Form::label('Médico: ')}}
				{{ Form::text('medico', null, ['class'=>'form-control'])}}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<div class="col-md-12">
				{{ Form::label('Matricula / Nome do Colaborador: ')}}
			</div>
			<div class="col-md-2">
				{{ Form::text('codigo_interno', null, ['class'=>'form-control', 'disabled'=>'disabled'])}}
			</div>
			<div class="col-md-10">
				{{ Form::text('nome', null, ['class'=>'form-control'])}}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group col-md-2">
			{{ Form::label('Data Nascimento: ')}}
			{{ Form::text('data_nascimento', null, ['class'=>'form-control data'])}}
		</div>
		<div class="form-group col-md-2">
			{{ Form::label('Sexo: ')}}
			{{ Form::select('sexo',['1'=>'Masculino', '0'=>'Feminino'], null, ['class'=>'form-control'])}}
		</div>
		<div class="form-group col-md-4">
			{{ Form::label('Setor: ')}}
			{{ Form::select('setor_id', [''=>'Selecione ....']+Setor::all()->lists('descricao', 'id'),null, ['class'=>'form-control'])}}
		</div>
		<div class="form-group col-md-4">
			{{ Form::label('Posto de Trabalho: ')}}
			{{ Form::select('posto_id', ['0'=>'Selecione ....'], null, ['class'=>'form-control'])}}
		</div>
	</div>
</fieldset>


@include('farmacia::aso.partials._js')