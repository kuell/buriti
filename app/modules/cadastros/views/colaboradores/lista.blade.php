@if($colaboradores->count())

<style type="text/css">
	*{
		font-size: 11px;
	}

</style>

	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Setor</th>
				<th>Função</th>
				<th>Interno</th>
				<th>Matricula</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($colaboradores as $colaborador)
				<tr>
					<td>{{{ $colaborador->id }}}</td>
					<td>{{{ $colaborador->nome }}}</td>
					<td>{{{ $colaborador->setor->descricao or "Não Definido"}}}</td>
					<td>{{{ $colaborador->funcao }}}</td>
					<td>{{{ $colaborador->interno }}}</td>
					<td>{{{ $colaborador->codigo_interno }}}</td>
					<td>{{ link_to_route('colaboradors.edit', 'Editar', $colaborador->id, array('class'=>'btn btn-primary')) }}</td>
				</tr>

			@endforeach

		</tbody>

	</table>
@endif