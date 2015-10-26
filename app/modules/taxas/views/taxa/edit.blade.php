@extends('taxas::taxa.index')

@section('form')
	{{ Form::model($taxa, ['route'=>['taxa.itens.update', $taxa->id], 'method'=>'patch','class'=>'form form-horizontal', 'files'=>true]) }}

		@include('taxas::taxa.form')

	<div class="form-group">
		<div class="col-md-12">
			{{ Form::submit('Gravar', ['class'=>'btn btn-sm btn-success']) }}
			{{ Form::button('Incluir Itens', ['class'=>'btn btn-sm btn-warning', 'name'=>'taxa', 'value'=>$taxa->id]) }}
			{{ link_to_route('taxa.taxas.index','Voltar', null, ['class'=>'btn btn-sm btn-danger']) }}
		</div>
	</div>

	{{ Form::close() }}

@stop