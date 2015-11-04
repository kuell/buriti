<table class="table table-hover">
	<caption>Lista de Itens</caption>
	<thead>
		<tr>
			<th>#</th>
			<th>Descrição</th>
			<th>Grupo</th>
			<th>Fiscal</th>
			<th>Genero</th>
			<th>Situação</th>
		</tr>
	</thead>
	<tbody>
		@foreach($itens as $item)
		<tr>
			<td>{{ link_to_route('taxa.itens.edit', $item->id, $item->id) }}</td>
			<td>{{ $item->descricao }}</td>
			<td>{{ $item->grupo }}</td>
			<td>{{ $item->fiscal_descricao }}</td>
			<td>{{ $item->genero_descricao }}</td>
			<td>{{ $item->situacao_descricao }}</td>
			<td>

			</td>
		</tr>
		@endforeach
	</tbody>
</table>