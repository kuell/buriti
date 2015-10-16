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
				<div class="btn-group">
					{{ link_to_route('setors.edit', ' ', $setor->id, array('class'=>'btn btn-info btn-sm glyphicon glyphicon-pencil', 'title'=>'alterar')) }}
					{{ link_to('#', ' ', array('class'=>'btn btn btn-warning btn-sm glyphicon glyphicon-print', 'title'=>'print',
								'onclick'=>"window.open('".URL::route('setors.show', $setor->id)."', 'print', 'channelmode=yes')")) }}
				</div>
			</td>
		</tr>
		@endforeach

	</tbody>

</table>
@endif

@section('scripts')
<script type="text/javascript">
	$(function() {
		$("table").dataTable();
	})
</script>
@stop