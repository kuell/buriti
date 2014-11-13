@if($atestados->count())
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Data</th>
				<th>Colaborador</th>
				<th>Local do Atendimento</th>
				<th>C.I.D. / Descrição</th>
				<th>Profissional</th>
			</tr>
		</thead>
		<tbody>
			@foreach($atestados as $atestado)
				<tr>
					<td>{{{ $atestado->id }}}</td>
					<td>{{{ $atestado->data_hora }}}</td>
					<td>{{{ $atestado->colaborador->nome }}} / {{{ $atestado->colaborador->setor->descricao }}}</td>
					<td>Local Atendimento</td>
					<td>{{{ $atestado->cid_id }}}</td>
					<td>{{{ $atestado->profissional_id }}}</td>
					<td></td>
					<td>{{ link_to_route('farmacia.atestados.edit', 'Editar', $atestado->id, array('class'=>'btn btn-primary')) }}</td>
				</tr>
			@endforeach

		</tbody>

	</table>
@endif