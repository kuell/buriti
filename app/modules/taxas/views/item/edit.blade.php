@extends('taxas::item.index')

@section('form')
	{{ Form::model($item, ['route'=>['taxa.itens.update', $item->id], 'method'=>'patch','class'=>'form form-horizontal', 'files'=>true]) }}

		@include('taxas::item.form')

	<div class="form-group">
		<div class="col-md-12">
			{{ Form::submit('Gravar', ['class'=>'btn btn-sm btn-success']) }}
			{{ link_to_route('taxa.itens.index','Voltar', null, ['class'=>'btn btn-sm btn-danger']) }}
		</div>
	</div>

	{{ Form::close() }}

@stop