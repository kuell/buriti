<div class="form-group">
	<div class="col-md-3">
		{{ Form::label('Data Nascimento: ')}}
		{{ Form::text('colaborador_data_nascimento', $aso->colaborador_data_nascimento, ['class'=>'form-control data', 'disabled'])}}
	</div>
	<div class="col-md-3">
		{{ Form::label('Sexo: ')}}
		{{ Form::select('colaborador_sexo',['1'=>'Masculino', '0'=>'Feminino'], $aso->colaborador_sexo, ['class'=>'form-control','disabled'])}}
	</div>
	<div class="col-md-3">
		{{ Form::label('RG: ')}}
		{{ Form::text('colaborador_rg', $aso->colaborador_rg, ['class'=>'form-control  numero', 'required'])}}
	</div>
	<div class="col-md-3">
		{{ Form::label('Orgão Emissor: ')}}
		{{ Form::text('colaborador_orgao_emissor', $aso->colaborador_orgao_emissor, ['class'=>'form-control emissor', 'required'])}}
	</div>
</div>

<div class="form-group">
	<div class="col-md-4">
		{{ Form::label('Setor: ')}}
		{{ Form::select('colaborador_setor_id', [''=>'Selecione ....']+Setor::ativos()->lists('descricao', 'id'),$aso->colaborador_setor_id, ['class'=>'form-control', 'disabled'])}}
	</div>
	<div class="col-md-4">
		{{ Form::label('Função: ')}}
		{{ Form::select('colaborador_funcao_id', [], null, ['class'=>'form-control', 'disabled'])}}
	</div>
	<div class="col-md-4">
		{{ Form::label('Posto de Trabalho: ')}}
		{{ Form::select('posto_id', [], null, ['class'=>'form-control', 'disabled'])}}
	</div>
</div>

<div class="form-group">
	<div class="col-md-6">
		{{ Form::label('Médico: ')}}
		{{ Form::text('medico', $aso->medico, ['class'=>'form-control', 'required'])}}
	</div>
	<div class="col-md-3">
		{{ Form::label('Data de Admissão: ')}}
		{{ Form::text('colaborador_data_admissao', $aso->colaborador_data_admissao, ['class'=>'form-control data', 'disabled'])}}
	</div>
</div>

<div class="form-group">
	<div class="col-md-12">
		{{ Form::label('Observações: ')}}
		{{ Form::textArea('obs', null, ['class'=>'form-control'])}}
	</div>
</div>

@include('dashboard.partials._scripts_js')
@include('farmacia::aso.partials._js')

@if(!empty($aso->colaborador_rg))
<script type="text/javascript">
	$(function(){
		$('input[name=colaborador_rg]').attr('disabled', 'true');
	})
</script>
@endif

@if(!empty($aso->colaborador_orgao_emissor))
<script type="text/javascript">
	$(function(){
		$('input[name=colaborador_orgao_emissor]').attr('disabled', 'true');
	})
</script>
@endif