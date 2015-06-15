@if($setors->count())
<table class="table table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Descrição</th>
			<th>Agrupamento</th>
			<th>Ativo</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($setors as $setor)
		<tr>
			<td>{{{ $setor->id }}}</td>
			<td>{{{ $setor->descricao }}}</td>
			<td>{{{ $setor->agrupamento }}}</td>
			<td>{{{ $setor->situacao == 1 ? 'ativo' : 'inativo' }}}</td>
			<td>
				{{ link_to_route('setors.edit', '', $setor->id, array('class'=>'btn glyphicon glyphicon-pencil', 'title'=>'alterar')) }}
				{{ link_to('#', ' ', array('class'=>'btn glyphicon glyphicon-print', 'title'=>'print',
							'onclick'=>"window.open('".URL::route('setors.show', $setor->id)."', 'print', 'channelmode=yes')")) }}
			</td>
		</tr>
		@endforeach

	</tbody>

</table>
@endif

@section('scripts')
{{ HTML::script('js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('js/plugins/datatables/dataTables.bootstrap.js') }}

<script type="text/javascript">
	$(function() {
		$("table").dataTable();
	})
</script>
@stop