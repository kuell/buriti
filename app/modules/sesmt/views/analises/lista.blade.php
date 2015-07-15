<table class="table table-hover" id="analises">
	<thead>
		<tr>
			<th>#</th>
			<th>Data Hora</th>
			<th>Colaborador</th>
			<th>Setor</th>
		</tr>
	</thead>
	<tbody>
		@foreach($analises as $analise)
		<tr>
			<td>{{ $analise->id }}</td>
			<td>{{ $analise->data_hora }}</td>
			<td>{{ $analise->colaborador->nome }}</td>
			<td>{{ $analise->colaborador->setor->descricao }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script type="text/javascript">
	$(function(){
		$('#analises').dataTable()
	})
</script>