@if($setors->count())
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Descrição</th>
				<th>Encarregado</th>
				<th>Ativo</th>
			</tr>
		</thead>
		<tbody>
			@foreach($setors as $setor)
				<tr>
					<td>{{{ $setor->id }}}</td>
					<td>{{{ $setor->descricao }}}</td>
					<td>{{{ $setor->encarregado}}}</td>
					<td>{{{ $setor->situacao == 1 ? 'ativo' : 'inativo' }}}</td>
					<td></td>
					<td>{{ link_to_route('cadastro.setor.edit', 'Editar', $setor->id, array('class'=>'btn btn-primary')) }}</td>
				</tr>
			@endforeach

		</tbody>

	</table>
@endif