@if(!empty($medicamentos))
<table class="table table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Descricao</th>
		</tr>
	</thead>
	<tbody>
		@foreach($medicamentos as $medicamento)
		<tr>
			<td>{{{ $medicamento->id }}}</td>
			<td>{{{ $medicamento->descricao }}}</td>
			<td>{{ link_to_route('farmacia.medicamentos.edit', 'Editar', $medicamento->id, array('class'=>'btn btn-primary')) }}</td>
		</tr>
		@endforeach

	</tbody>
</table>
@endif