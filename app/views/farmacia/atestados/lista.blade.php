@if($atestados->count())
	<table class="table table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Data - Fim</th>
				<th>Colaborador</th>
				<th>Local do Atendimento</th>
				<th>C.I.D. / Descrição</th>
				<th>Profissional</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($atestados as $atestado)
				<tr>
					<td>{{{ $atestado->id }}}</td>
					<td>{{{ $atestado->inicio_afastamento }}} - {{{ $atestado->fim_afastamento }}}</td>
					<td>{{{ $atestado->colaborador->nome or null }}} / {{{ $atestado->colaborador->setor->descricao or null }}}</td>
					<td>{{{ $atestado->local_atendimento }}}</td>
					<td>{{{ $atestado->cid }}}</td>
					<td>{{{ $atestado->profissional }}}</td>
					<td>{{ link_to_route('farmacia.atestados.edit', 'Editar', $atestado->id, array('class'=>'btn btn-primary')) }}</td>
				</tr>
			@endforeach

		</tbody>

	</table>
@endif