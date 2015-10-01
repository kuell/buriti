<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			Atestados
		</h4>
	</div>
	<div class="panel-body">
	<table class="table">
		<thead>
			<tr>
				<th>Local de Atendimento</th>
				<th>Data Inicio</th>
				<th>Data Fim</th>
				<th>Total de Dias</th>
			</tr>
		</thead>
		<tbody>

			@foreach($ocorrencia->atestados as $atestado)
				<tr>
					<td>{{ $atestado->local }}</td>
					<td>{{ Format::viewDate($atestado->inicio_afastamento) }}</td>
					<td>{{ Format::viewDate($atestado->fim_afastamento) }}</td>
					<td>{{ $atestado->dias_afastamento }}</td>
				</tr>
			@endforeach

		</tbody>
	</table>
	</div>
</div>