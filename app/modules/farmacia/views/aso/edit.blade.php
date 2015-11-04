@extends('layouts.modulo')

@section('content')
 {{ Form::model($aso, array('method' => 'PATCH', 'route' => array('farmacia.aso.update', $aso->id) , 'id'=>'form_aso')) }}
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">
				Editar ficha ASO
			</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<div class="col-md-3">
					{{ Form::label('tipo', 'Tipo de A.S.O: ', ['class'=>'form-label']) }}
					{{ Form::select('tipo', [''=>'Selecione ...']+Aso::tipo(), Input::get('tipo'), ['class'=>'form-control', 'disabled']) }}
				</div>
				<div class="col-md-2">
					{{ Form::label('Matricula: ')}}
					{{ Form::text('colaborador_matricula', null, ['class'=>'form-control numero', 'disabled']) }}
				</div>
				<div class="col-md-7">
					{{ Form::label('colaborador_id', 'Nome do Colaborador: ', ['class'=>'form-label']) }}
					@if($aso->tipo != 'admissional')
						{{ Form::select('colaborador_id', [''=>'Selecione ...']+Colaborador::ativos()->lists('nome', 'id'), Input::get('tipo'), ['class'=>'form-control', 'disabled']) }}
					@else
						{{ Form::text('colaborador_nome', null, ['class'=>'form-control']) }}
					@endif
				</div>
			</div>


			@include('farmacia::aso.form')
		</div>

			<div class="panel-footer">
				@if($aso->ajuste != true && $aso->situacao != 'fechado')
					{{ Form::submit('Atualizar', ['class'=>'btn btn-primary btn-sm']) }}
					{{ Form::button('Informações Adicionais', ['class'=>'btn btn-info btn-sm', 'id'=>'info']) }}

					{{ Form::button('Excluir', ['class'=>'btn btn-danger btn-sm', 'id'=>'delete', 'value'=>$aso->id]) }}

					{{ link_to_route('farmacia.aso.index', 'Cancelar', null, ['class'=>'btn btn-warning btn-sm']) }}
				@else
					{{ Form::button('Informações Adicionais', ['class'=>'btn btn-warning btn-sm', 'id'=>'info']) }}
					{{ link_to_route('farmacia.aso.index', 'Cancelar', null, ['class'=>'btn btn-danger btn-sm']) }}
				@endif
			</div>
	</div>
 {{ Form::close() }}

@include('farmacia::aso.informacoes')


<script type="text/javascript">
	$(function(){
		$('#info').bind('click', function() {
			$('#informacoes').modal();
		});
		$('#delete').bind('click',  function() {

			motivo = prompt('Qual o motivo da exclusão da ficha aso? ')

			$.ajax({
				url: "/farmacia/aso/"+$(this).val(),
				type: 'DELETE',
				data: {id: $(this).val(), descricao: motivo}
			})
			.done(function(data) {

				console.log("success"+data);
			})
			.fail(function(data) {
				console.log("error"+data);
			})
			.always(function(data) {
				alert(data);
			});

			location = "{{ URL::route('farmacia.aso.index') }}"

		});
	})
</script>


@if($aso->tipo == 'admissional')
	<script type="text/javascript">
		$(function(){
			$('input[name=colaborador_matricula], input[name=colaborador_data_admissao]').removeAttr('disabled');

			$('input[name=colaborador_matricula]').bind('blur', function(){
				if($(this).val() != 0){
					$.get('/colaboradors/find/'+$(this).val(), function(data) {
						if(data.id != null){
							alert('Matrícula ja cadastrada!\n Colaborador: '+data.nome)
							$('input[name=colaborador_matricula]').focus()
						}
					});
				}
			})

		})
	</script>
@endif



@if(!empty($aso->colaborador_rg))
	<script type="text/javascript">
		$(function(){
			$('input[name=colaborador_rg]').prop('disabled', 'true');
		})
	</script>
@endif

@if(!empty($aso->colaborador_orgao_emissor))
	<script type="text/javascript">
		$(function(){
			$('input[name=colaborador_orgao_emissor]').prop('disabled', 'true');
		})
	</script>
@endif

@endsection