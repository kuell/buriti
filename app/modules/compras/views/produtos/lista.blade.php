<table class="table" id="produtos">
	<caption>Listagem de Produtos</caption>
	<thead>
		<tr>
			<th>#</th>
			<th>Cód Interno</th>
			<th>Descrição</th>
			<th>Agrupamento</th>
			<th>Situação</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($produtos as $produto)
		<tr>
			<td>{{{ $produto->id }}}</td>
			<td>{{{ $produto->codigo_interno }}}</td>
			<td>{{{ $produto->descricao }}}</td>
			<td>{{{ $produto->agrupamento }}}</td>
			<td>{{{ $produto->situacao }}}</td>
			<td>
				{{ link_to_route('compras.produtos.edit', ' ', $produto->id, ['class'=>'btn btn-sm btn-primary glyphicon glyphicon-pencil']) }}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script type="text/javascript">
	$(function(){
		$('#produtos').dataTable()
	})
</script>