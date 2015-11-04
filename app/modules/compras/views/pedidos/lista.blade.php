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
				{{ Form::button(' ', ['class'=>'btn btn-warning btn-sm glyphicon glyphicon-print', 'name'=>'view', 'value'=>$pedido->id]) }}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="modal fade" id="view_pedido_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<iframe width="100%" height="600px" class="frame" id="frame" style="border:0;"></iframe>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(function(){
		$('#pedidos').dataTable();

		$('button[name=view]').bind('click', function() {
			var remote = '/compras/pedidos/'+$(this).val();

			$('#frame').attr('src', remote);
			$('#view_pedido_modal').modal();
		});

	});
</script>