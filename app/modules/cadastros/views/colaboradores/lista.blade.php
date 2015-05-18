@if($colaboradores->count())
<div class="row">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Setor</th>
				<th>Função</th>
				<th>Interno</th>
				<th>Matricula</th>
				<th>Situação</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($colaboradores as $colaborador)
				<tr>
					<td>{{{ $colaborador->codigo_interno }}}</td>
					<td>{{{ $colaborador->nome }}}</td>
					<td>{{{ $colaborador->setor->descricao or "Não Definido"}}}</td>
					<td>{{{ $colaborador->funcao }}}</td>
					<td>{{{ $colaborador->interno }}}</td>
					<td>{{{ $colaborador->codigo_interno }}}</td>
					<td>{{{ $colaborador->situacao or 'Ativo' }}}</td>
					<td>
						{{ link_to_route('colaboradors.edit', ' ', $colaborador->id, array('class'=>'btn btn-primary glyphicon glyphicon-pencil')) }}
						{{ link_to_route('colaboradors.show', ' ', [$colaborador->id, 'f'=>1], ['class'=>'btn btn-warning glyphicon glyphicon-print', 'target'=> '_new']) }}
					</td>
				</tr>

			@endforeach

		</tbody>

	</table>
</div>
@endif
