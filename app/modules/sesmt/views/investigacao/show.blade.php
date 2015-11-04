<div class="panel panel-default">
	<div class="panel-heading">

	</div>
	<div class="panel-body">

		<div class="form-group">

			<div class="col-xs-3">
				<span>Tipo de Acidente:</span> {{ $investigacao->tipo_ocorrencia_descricao }}

			</div>

			<div class="col-xs-3">
				<span>Data do Acidente:</span> {{ Format::viewDate($investigacao->data_acidente) }}
			</div>

			<div class="col-xs-3">
				<span>Houve afastamento?</span> {{ $investigacao->com_afastamento }}
			</div>

			<div class="col-xs-3">
				Local de Assistência Médica: {{ $investigacao->local_assistencia_medica }}
			</div>

		</div>


		<div class="form-group">
			<div class="col-xs-6">
				Local do Acidente: {{ $investigacao->local_acidente }}
			</div>

			<div class="col-xs-6">
				Descrição do Acidente: {{ $investigacao->descricao_acidente }}
			</div>

		</div>
	</div>
</div>