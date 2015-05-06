@if($asos->count())
<table class="table table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Data</th>
			<th>Colaborador</th>
			<th>Posto de Trabalho</th>
			<th>Tipo de Aso</th>
			<th>Situação</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($asos as $aso)
		<tr>
			<td>{{{ $aso->id }}}</td>
			<td>{{{ $aso->data }}}</td>
			<td>{{{ $aso->colaborador->nome }}}</td>
			<td>{{{ $aso->postoTrabalho->descricao or null }}}</td>
			<td>{{{ $aso->tipo }}}</td>
			<td>{{{ $aso->situacao }}}</td>
			<td>
				{{ link_to_route('farmacia.aso.edit', 'Editar', $aso->id, array('class'=>'btn btn-primary')) }}
				<a href="#" onclick="window.open('/farmacia/aso/{{ $aso->id }}', 'Print', 'channelmode=yes')" class="btn btn-warning">Emitir</a>
			</td>
		</tr>
		@endforeach

	</tbody>
</table>
@endif