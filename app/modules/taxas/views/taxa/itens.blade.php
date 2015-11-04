@extends('layouts.frame')

@section('frame')

	@if (Session::has('message'))
		<script type="text/javascript">
			alert("{{ implode($errors->all(), '\n') }}");
		</script>
	@endif

	@if(!empty(Input::get('item')))
		{{ Form::model($item, ['route'=>['taxa.taxas.itens', $item->id, 'item'=>$item->id],'class'=>'form form-horizontal well']) }}
	@else
		{{ Form::open(['class'=>'form form-horizontal well', 'route'=>['taxa.taxas.itens', $taxa->id]]) }}
	@endif



		<div class="form-group">
			<div class="col-xs-4">
				{{ Form::label('item', 'Item: ', ['class'=>'form-label']) }}
				{{ Form::select('item_id', [''=>'Selecione ...']+Item::all()->lists('descricao', 'id'), null, ['class'=>'form-control', 'autofocus']) }}
			</div>
			<div class="col-xs-2">
				{{ Form::label('qtd', 'Qtd: ', ['class'=>'form-label']) }}
				{{ Form::text('qtd', null, ['class'=>'form-control quantidade_null']) }}
			</div>
			<div class="col-xs-2">
				{{ Form::label('peso', 'peso: ', ['class'=>'form-label']) }}
				{{ Form::text('peso', null, ['class'=>'form-control quantidade']) }}
			</div>
			<div class="col-xs-2">
				{{ Form::label('valor', 'Valor: ', ['class'=>'form-label']) }}
				{{ Form::text('valor', null, ['class'=>'form-control valor']) }}
			</div>
			<div class="col-xs-2">
				{{ Form::label('tipo', 'tipo: ', ['class'=>'form-label']) }}
				{{ Form::select('tipo', ['Informativo', 'a Pagar', 'a Receber'], null, ['class'=>'form-control']) }}
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
			<caption class="well well-sm">Itens da Taxa</caption>
			<thead>
				<tr>
					<th>#</th>
					<th>Item</th>
					<th>Qtde</th>
					<th>Peso</th>
					<th>Valor</th>
					<th>Tipo</th>
				</tr>
			</thead>
			<tbody>
				@foreach($taxa->itens as $item)
				<tr>
					<td>{{ $item->item_id }}</td>
					<td>{{ $item->descricao }}</td>
					<td>{{ Format::valorView($item->qtd) }}</td>
					<td>{{ Format::valorView($item->peso, 2) }}</td>
					<td>R$ {{ Format::valorView($item->valor) }}</td>
					<td>{{ $item->tipo_descricao }}</td>
					<td>
					{{ Form::button(' ', ['class'=>'btn btn-danger btn-sm glyphicon glyphicon-remove', 'name'=>'delete', 'value'=>$item->id]) }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

<script type="text/javascript">
	$(function(){
		$('select[name=item_id]').chosen({width: '100%'});
		$('button[name=delete]').bind('click', function(){

			if(confirm('Deseja excluir o item?')){

				$.post('/taxa/taxas/itens/{{ $taxa->id }}/delete', {item_id: $(this).val()},function(data){
					location = '/taxa/taxas/itens/{{ $taxa->id }}';
				})
			}
		})
	})
</script>

@stop