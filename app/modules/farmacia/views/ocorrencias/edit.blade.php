@extends('layouts.modulo')

@section('content')

{{ Form::model($ocorrencia, array('method' => 'PATCH',
   'route' => array('farmacia.ocorrencias.update', $ocorrencia->id) ,
   'rule'=>'form'))
 }}
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Alterar Ocorrencia: {{ $ocorrencia->id }}</h3>
		</div>
		<div class="panel-body">
	 		@include('farmacia::ocorrencias.form')

			<div class="col-md-12">
				<div class="col-md-12">Conduta / Medicamentos: </div>
				<iframe class="col-md-12" height="400" style="border:1 solid;" src="{{ URL::route('farmacia.ocorrencias.medicamentos', $ocorrencia->id) }}"></iframe>
			</div>
		</div>

		<div class="panel-footer">
		    <button type="submit" class="btn btn-primary">Gravar</button>
		    {{ link_to_route('farmacia.ocorrencias.index', 'Voltar', null, array('class'=>'btn btn-danger')) }}
		</div>
	</div>
{{ Form::close() }}
@endsection