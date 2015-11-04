@if($colaboradores->count())

	<table class="table table-hover" id="colaboradors">
		<thead>
			<tr>
				<th>Matricula</th>
				<th>Nome</th>
				<th>Setor</th>
				<th>Posto de Trabalho</th>
				<th>Função</th>
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
					<td>{{{ $colaborador->posto_trabalho->descricao or null }}}</td>
					<td>{{{ $colaborador->funcao->descricao or null }}}</td>
					<td>{{{ $colaborador->situacao or 'Ativo' }}}</td>
					<td>
						{{ link_to_route('colaboradors.edit', ' ', $colaborador->id, array('class'=>'btn btn-sm btn-primary glyphicon glyphicon-pencil')) }}
						{{ link_to_route('colaboradors.show', ' ', [$colaborador->id, 'f'=>1], ['class'=>'btn btn-sm btn-warning glyphicon glyphicon-print', 'target'=> 'blank']) }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endif