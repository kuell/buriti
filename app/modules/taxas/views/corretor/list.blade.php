<table class="table table-hover">
	<caption>Lista de Corretores</caption>
	<thead>
		<tr>
			<th>#</th>
			<th>Codigo Interno</th>
			<th>Nome</th>
			<th>e-mail</th>
			<th>Situação</th>
		</tr>
	</thead>
	<tbody>
		@foreach($corretors as $corretor)
		<tr>
			<td>{{ link_to_route('taxa.corretors.edit', $corretor->id, $corretor->id) }}</td>
			<td>{{ $corretor->codigo_interno }}</td>
			<td>{{ $corretor->nome }}</td>
			<td>{{ $corretor->email }}</td>
			<td>{{ $corretor->situacao }}</td>
			<td>

			</td>
		</tr>
		@endforeach
	</tbody>
</table>