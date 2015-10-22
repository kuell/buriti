<table class="table table-hover" id="pedidos">
	<caption>Pedidos de Compra em Aberto</caption>
	<thead>
		<tr>
			<th>#</th>
			<th>Setor</th>
			<th>Solicitante</th>
			<th>Data Criação</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($pedidos as $pedido)
		<tr>
			<td>{{ $pedido->id }}</td>
			<td>{{ $pedido->setor->descricao }}</td>
			<td>{{ $pedido->solicitante }}</td>
			<td>{{ date('d/m/Y', strtotime($pedido->created_at)) }}</td>
			<td>
				{{ link_to_route('compras.pedidos.edit', ' ', $pedido->id, ['class'=>'btn btn-primary btn-sm glyphicon glyphicon-pencil']) }}
				{{ Form::button(' ', ['class'=>'btn btn-warning btn-sm glyphicon glyphicon-print']) }}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script type="text/javascript">
	$(function(){
		$('#pedidos').dataTable();
	});
</script>