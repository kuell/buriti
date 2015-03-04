@if($colaboradores->count())
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Setor</th>
				<th>Interno</th>
				<th>Código Interno</th>
				<th>Teste</th>
			</tr>
		</thead>
		<tbody>
			@foreach($colaboradores as $colaborador)
				<tr>
					<td>{{{ $colaborador->id }}}</td>
					<td>{{{ $colaborador->nome }}}</td>
					<td>{{{ $colaborador->setor->descricao or "Não Definido"}}}</td>
					<td>{{{ $colaborador->interno }}}</td>
					<td>{{{ $colaborador->codigo_interno }}}</td>
					<td>{{ link_to_route('colaboradors.edit', 'Editar', $colaborador->id, array('class'=>'btn btn-primary')) }}</td>
				</tr>
			@endforeach

		</tbody>

	</table>
@endif