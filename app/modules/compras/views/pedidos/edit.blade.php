@extends('compras::pedidos.index')

@section('form')
	{{ Form::model($pedido, ['route'=>['compras.pedidos.update', $pedido->id], 'class'=>'form form-horizontal', 'method'=>'patch', 'files'=>true]) }}
		<div class="form-group">
			<div class="col-md-2">
				{{ Form::label('id', 'Codigo do Pedido: ', ['class'=>'form-label']) }}
				{{ Form::label('id', $pedido->id, ['class'=>'form-control']) }}
			</div>
			<div class="col-md-2">
				{{ Form::label('user_create', 'Usuario de Criação: ', ['class'=>'form-label']) }}
				{{ Form::label('user_created', strtoupper($pedido->user_created), ['class'=>'form-control']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('data_criacao', 'Data de Criação: ', ['class'=>'form-label']) }}
				{{ Form::label('data_criacao', date('d/m/Y H:i', strtotime($pedido->created_at)), ['class'=>'form-control']) }}
			</div>
			<div class="col-md-2">
				{{ Form::label('user_updated', 'Usuario de Atualização: ', ['class'=>'form-label']) }}
				{{ Form::label('user_updated', strtoupper($pedido->user_updated), ['class'=>'form-control']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('data_update', 'Data de Atualização: ', ['class'=>'form-label']) }}
				{{ Form::label('data_update', date('d/m/Y H:i', strtotime($pedido->updated_at)), ['class'=>'form-control']) }}
			</div>

		</div>
		@include('compras::pedidos.form')

	<div class="form-group">
		<div class="col-md-12">
			{{ Form::submit('Gravar', ['class'=>'btn btn-sm btn-success']) }}
			{{ Form::button('Incluir Produtos', ['class'=>'btn btn-primary btn-sm', 'id'=>'itens']) }}
			{{ link_to_route('compras.pedidos.index','Voltar', null, ['class'=>'btn btn-sm btn-danger']) }}
		</div>
	</div>

	{{ Form::close() }}

<div class="modal fade" id="itens_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Inclusão de Produtos no Pedido - {{ $pedido->id }}</h4>
			</div>
			<div class="modal-body">
				<iframe src="{{ URL::route('compras.pedidos.produtos', $pedido->id) }}" width="100%" height="600px" class="frame" style="border:0;"></iframe>
			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>

@stop

@section('scripts')
	<script type="text/javascript">
		$(function(){
			$('#itens').bind('click', function(){
				$('#itens_modal').modal()
			})
		})
	</script>
@stop