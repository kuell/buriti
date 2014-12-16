@extends('dashboard.index')

@section('main')
		{{ HTML::head('Ordem Interna', 'controla as ordens internas de serviço!') }}
  		{{ HTML::boxhead('Registrar nova Ordem Interna') }}

  	<div class="box-body">
		{{ Form::open(array('route'=>'osi.osi.store', 'rule'=>'form')) }}
			@include('ordem_interna.form')
			
			<div class="col-md-12">
				{{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}
				{{ link_to_route('osi.osi.index', 'Voltar', null, ['class'=>'btn btn-danger']) }}
			</div>
		{{ Form::close() }}
	</div>
@stop