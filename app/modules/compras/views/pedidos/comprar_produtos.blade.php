@extends('compras::pedidos.index')

@section('form')
	<table class="table table-hover" id="produtos" data-page-lenght="100">
		<caption>Listagem de Produtos para Compra</caption>
		<thead>
			<tr>
				<th>#</th>
				<th>Descrição do Produto</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($produtos as $produto)
			<tr>
				<td>{{ $produto->pedido_id }}</td>
				<td>{{ $produto->produto->descricao }}</td>
				<td>{{ $produto->prioridade }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<script type="text/javascript">
		$(function() {
			$('#produtos').dataTable({
				"bPaginate": false
			})
		})
	</script>

@stop