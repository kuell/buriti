@extends('layouts.frame')

@section('frame')

<style type="text/css" media="screen">
	*{
		font-size: 10px;
	}
</style>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title">
				Informações da CAT
			</h4>
		</div>
		<div class="panel-body">

			@if (Session::has('message'))
				<div class="alert alert-danger alert-dismissable">
				    <i class="fa fa-ban"></i>
				    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				    <b>{{ Session::get('message') }}</b>
				    	@if ($errors->any())
							<ul>
								{{ implode('', $errors->all('<li class="error">:message</li>')) }}
							</ul>
						@endif
				</div>
			@endif

			@if($investigacao->cat()->count())
				{{ Form::model($investigacao->cat, ['route'=>['sesmt.investigacao.cat', $investigacao->id, 'cat'=>$investigacao->cat->id], 'class'=>'form form-horizontal']) }}
			@else
				{{ Form::open(['route'=>['sesmt.investigacao.cat', $investigacao->id], 'class'=>'form form-horizontal']) }}
			@endif

			<div class="form-group">
				<div class="col-xs-6">
					{{ Form::label('Numero da CAT: ', null, ['class'=>'form-label']) }}
					{{ Form::text('numero_cat', null, ['class'=>'form-control']) }}
				</div>
			</div>

			<h4 class="well well-sm">Informações do Colaborador</h4>
				<div class="form-group">
					<div class="col-xs-6">
						{{ Form::label('Nome: ', null, ['class'=>'form-label']) }}
						{{ Form::label(null, $investigacao->ocorrencia->colaborador->nome, ['class'=>'form-control']) }}
					</div>
					<div class="col-xs-2">
						{{ Form::label('Data Nascimento: ', null, ['class'=>'form-label']) }}
						{{ Form::label($investigacao->ocorrencia->colaborador->data_nascimento, null, ['class'=>'form-control']) }}
					</div>
					<div class="col-xs-2">
						{{ Form::label('Sexo: ', null, ['class'=>'form-label']) }}
						{{ Form::label($investigacao->ocorrencia->colaborador->sexo_descricao, null, ['class'=>'form-control']) }}
					</div>
					<div class="col-xs-2">
						{{ Form::label('Setor: ', null, ['class'=>'form-label']) }}
						{{ Form::label($investigacao->ocorrencia->colaborador->setor_descricao, null, ['class'=>'form-control']) }}
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-5">
						{{ Form::label('Grau de Instrução: ', null, ['class'=>'form-label']) }}
						{{ Form::text('grau_instrucao', $investigacao->ocorrencia->colaborador->grau_instrucao, ['class'=>'form-control']) }}
					</div>
					<div class="col-xs-5">
						{{ Form::label('CBO: ', null, ['class'=>'form-label']) }}
						{{ Form::text('cbo', $investigacao->ocorrencia->colaborador->cbo, ['class'=>'form-control']) }}
					</div>
					<div class="col-xs-2">
						{{ Form::label('Remuneração: ', null, ['class'=>'form-label']) }}
						{{ Form::text('remuneracao', $investigacao->ocorrencia->colaborador->remuneracao, ['class'=>'form-control valor']) }}
					</div>
				</div>

				<h4 class="well well-sm">Informações do Acidente</h4>
				<div class="form-group">
					<div class="col-xs-6">
						{{ Form::label('Agente Causador: ', null, ['class'=>'form-label']) }}
						{{ Form::text('agente_causador', null, ['class'=>'form-control']) }}
					</div>
					<div class="col-xs-6">
						{{ Form::label('Situação Geradora: ', null, ['class'=>'form-label']) }}
						{{ Form::text('situacao_geradora', null, ['class'=>'form-control']) }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						{{ Form::submit('Gravar', ['class'=>'btn btn-sm btn-success']) }}
					</div>
				</div>

			{{ Form::close() }}
		</div>
	</div>

@stop