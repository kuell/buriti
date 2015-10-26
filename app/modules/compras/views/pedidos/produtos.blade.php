@extends('layouts.frame')

@section('frame')

	@if (Session::has('message'))
		<script type="text/javascript">
			alert("{{ implode($errors->all(), '\n') }}");
		</script>
	@endif

	@if(!empty(Input::get('produto')))
		{{ Form::model($produto, ['route'=>['compras.pedidos.produtos', $pedido->id, 'produto'=>$produto->id],'class'=>'form form-horizontal well']) }}
	@else
		{{ Form::open(['class'=>'form form-horizontal well']) }}
	@endif



		<div class="form-group">
			<div class="col-xs-5">
				{{ Form::label('produto', 'Produtos: ', ['class'=>'form-label']) }}
				{{ Form::select('produto_id', [''=>'Selecione ...']+Produto::ativos()->lists('descricao', 'id'), null, ['class'=>'form-control', 'autofocus']) }}
			</div>
			<div class="col-xs-2">
				{{ Form::label('qtd', 'Qtd: ', ['class'=>'form-label']) }}
				{{ Form::text('qtd', null, ['class'=>'form-control quantidade_null']) }}
			</div>
			<div class="col-xs-2">
				{{ Form::label('estoque', 'Estoque: ', ['class'=>'form-label']) }}
				{{ Form::text('estoque', null, ['class'=>'form-control quantidade']) }}
			</div>
			<div class="col-xs-3">
				{{ Form::label('prioridade', 'prioridade: ', ['class'=>'form-label']) }}
				{{ Form::select('prioridade',['Baixa','Média', 'Alta'] , null, ['class'=>'form-control']) }}
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				{{ Form::submit('Gravar', ['class'=>'btn btn-success btn-sm']) }}
			</div>
		</div>
	{{ Form::close() }}

	<div class="form-group">
		<table class="table table-hover table-bordered">
			<caption class="well well-sm">Produtos do Pedido</caption>
			<thead>
				<tr>
					<th>#</th>
					<th>Descrição</th>
					<th>Qtde</th>
					<th>Estoque</th>
					<th>Prioridade</th>
					<th>Foto</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pedido->produtos as $produto)
				<tr>
					<td>{{ link_to_route('compras.pedidos.produtos', $produto->id, [$pedido->id, 'produto'=>$produto->id]) }}</td>
					<td>{{ link_to_route('compras.pedidos.produtos', $produto->descricao, [$pedido->id, 'produto'=>$produto->id]) }}</td>
					<td>{{ Format::valorView($produto->qtd) }}</td>
					<td>{{ Format::valorView($produto->estoque) }}</td>
					<td>{{ $produto->prioridade }}</td>
					<td>{{ HTML::image($produto->foto, 'alt', ['width'=>50]) }}</td>
					<td>
						{{ Form::button(' ', ['class'=>'btn btn-danger btn-sm glyphicon glyphicon-trash', 'value'=>$produto->id, 'name'=>'delete']) }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>


	<script type="text/javascript">
		$(function(){
			$('select[name=produto_id]').chosen({width:'100%'})
			$('select[name=produto_id]').on('change', function() {
				$.get('/compras/produtos/find/'+$(this).val()+'/pedidos', null, function(data){
					if(data != 0){
						alert(data)
					}
				})
			});

			$('button[name=delete]').bind('click', function() {
				if(confirm('Deseja realmente excluir o produto do pedido? ')){
					$.post('/compras/pedidos/{{ $pedido->id }}/produtos/delete', {produto_id: $(this).val()}, function(data){
						location = '/compras/pedidos/{{ $pedido->id }}/produtos';
					});
				}
			});
		})
	</script>

@stop