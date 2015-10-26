@extends('layouts.modulo')

@section('content')

	<div class="panel panel-primary">
		<div class="panel-heading clearfix">
			<h4 class="panel-title pull-left">
				Controle de Taxas
			</h4>
			<div class="pull-right">
				{{ link_to_route('taxa.taxas.create', 'Adicionar', null, ['class'=>'btn btn-sm btn-success']) }}
			</div>
		</div>
		<div class="panel-body">
			@if(!Request::segment(3))
			{{ Form::open(['class'=>'form form-horizontal well well-sm', 'method'=>'GET' ,'route'=>'taxa.taxas.index']) }}
				<div class="form-group">
					<div class="col-md-3">
						{{ Form::label('periodo', 'Periodo: ', ['class'=>'form-label']) }}
						{{ Form::text('periodo', Input::get('periodo', date('d/m/Y').' - '.date('d/m/Y')), ['class'=>'form-control periodo']) }}
					</div>
					<div class="col-md-3">
						{{ Form::label('corretor', 'Corretor: ', ['class'=>'form-label']) }}
						{{ Form::select('corretor_id', [''=>'Selecione ...']+Corretor::all()->lists('nome', 'id'), Input::get('corretor_id', null), ['class'=>'form-control']) }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						{{ Form::submit('Buscar', ['class'=>'btn btn-primary btn-sm']) }}
					</div>
				</div>
			{{ Form::close() }}


				@include('taxas::taxa.list')

			@else

				@yield('form')

			@endif


		</div>
		<div class="panel-footer">

		</div>
	</div>

<div class="modal fade" id="itens_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Inclusão de Itens na Taxa</h4>
			</div>
			<div class="modal-body">
				<iframe src="" width="100%" height="600px" class="frame" style="border:0;"></iframe>
			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>

<script type="text/javascript" >
	$(function(){
		$('button[name=taxa]').click(function() {
			$('.frame').attr('src', '/taxa/taxas/itens/'+$(this).val());
			$('#itens_modal').modal();
		});

		$('select[name=corretor_id]').chosen();

		$('#itens_modal').on('hidden.bs.modal', function(){
            location.reload()
        })
	});
</script>
@stop