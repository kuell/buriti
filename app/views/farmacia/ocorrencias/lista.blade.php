@if($ocorrencias->count())
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Data/Hora</th>
				<th>Colaborador</th>
				<th>Setor</th>
				<th>Conduta</th>
			</tr>
		</thead>
		<tbody>
			@foreach($ocorrencias as $ocorrencia)
				<tr>
					<td>{{{ $ocorrencia->data_hora }}}</td>
					<td>{{{ $ocorrencia->colaborador->nome }}}</td>
					<td>{{{ $ocorrencia->colaborador->setor->descricao }}}</td>
					<td>{{{ $ocorrencia->conduta }}}</td>
					<td></td>
					<td>{{ link_to_route('farmacia.ocorrencias.edit', 'Editar', $ocorrencia->id, array('class'=>'btn btn-primary')) }}</td>
				</tr>
			@endforeach

		</tbody>

	</table>
@endif