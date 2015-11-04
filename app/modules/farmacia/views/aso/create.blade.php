@extends('layouts.modulo')

@section('content')

{{ Form::model($aso, array('route' => 'farmacia.aso.store', 'rule'=>'form')) }}
<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">
			Nova ficha ASO
		</h3>
	</div>
	<div class="panel-body">

		<div class="form-group">
			<div class="col-md-3">
				{{ Form::label('tipo', 'Tipo de A.S.O: ', ['class'=>'form-label']) }}
				{{ Form::select('tipo', [''=>'Selecione ...']+Aso::tipo('admissional'), Input::get('tipo'), ['class'=>'form-control', 'autofocus']) }}
			</div>
			<div class="col-md-2">
				{{ Form::label('Matricula: ')}}
				{{ Form::text('colaborador_matricula', null, ['class'=>'form-control'], 'required') }}
			</div>
			<div class="col-md-6">
				{{ Form::label('colaborador_id', 'Nome do Colaborador: ', ['class'=>'form-label']) }}
				{{ Form::select('colaborador_id', [''=>'Selecione ...']+Colaborador::ativos()->lists('nome', 'id'), Input::get('tipo'), ['class'=>'form-control']) }}
			</div>
		</div>

		<div id="form">

		</div>

		@if(!empty(Input::get('tipo')) && !empty(Input::get('colaborador_id')))
			@include('farmacia::aso.form')
		@endif

	</div>
	<div class="panel-footer disabled">
		{{ Form::submit('Gravar e Gerar', ['class'=>'btn btn-primary disabled']) }}
		{{ link_to_route('farmacia.aso.index', 'Cancelar', null, ['class'=>'btn btn-danger']) }}
	</div>
</div>
{{ Form::close() }}

<script type="text/javascript">
	$(function(){

		$('select[name=colaborador_id]').on('blur', function(){

			if($(this).val() != '' && $('select[name=tipo]').val() != ''){
				$.get('/farmacia/aso/create?tipo='+$('select[name=tipo]').val()+'&colaborador_id='+$(this).val(), function(pagina){
					$('#form').html(pagina)
					$('input[type=submit]').removeClass('disabled')
				})
			}
			else{
				alert('\t :( \n Este campo deve ser preenchido!')
				$('select[name=tipo]').focus()
			}

		})


		$('input[name=colaborador_matricula]').bind('blur', function(){
			if($(this).val() != 0){
				$.get('/colaboradors/find/'+$(this).val(), function(data) {
					if(data.id != null){
						$('select[name=colaborador_id]').val(data.id)
					}
				});
			}
		})

		$('select[name=colaborador_id]').bind('blur', function(){
			if($(this).val() != 0){
				$.get('/colaboradors/find/'+$(this).val()+'/id', function(data) {
					if(data.id != null){
						$('input[name=colaborador_matricula]').val(data.codigo_interno);
					}
				});
			}
		})

	})
</script>

@endsection