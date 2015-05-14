@extends('layouts.modulo')

@section('content')
 {{ Form::model($aso, array('method' => 'PATCH', 'route' => array('farmacia.aso.update', $aso->id) )) }}
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">
				Editar ficha ASO
			</h3>
		</div>
		<div class="panel-body">
			{{ Form::hidden('colaborador_id', $aso->colaborador_id) }}
			@include('farmacia::aso.form')
		</div>
		<div class="panel-footer">
			{{ Form::submit('Atualizar', ['class'=>'btn btn-primary']) }}
			{{ link_to_route('farmacia.aso.index', 'Cancelar', null, ['class'=>'btn btn-danger']) }}
		</div>

	</div>
 {{ Form::close() }}

<div class="panel panel-primary">
	<div class="panel-heading">
		<h4 class="panel-title">Informações Complementares</h4>
	</div>
	<div class="panel-body">
		<div role="tabpanel">

			  <!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#riscos" aria-controls="riscos" role="tab" data-toggle="tab">
						<h5>Riscos</h5>
					</a>
				</li>

			    <li role="presentation">
					<a href="#exame" aria-controls="exame" role="tab" data-toggle="tab">
						<h5>Exames Médicos</h5>
					</a>
				</li>
			</ul>

			  <!-- Tab panes -->
		  	<div class="tab-content">
		    	<div role="tabpanel" class="tab-pane active" id="riscos">
					@include('farmacia::aso.partials._riscos')
				</div>
				<div role="tabpanel" class="tab-pane" id='exame'>
					<iframe src="/farmacia/aso/{{ $aso->id }}/exames" style="border: 1px" class="col-md-12" height="350px"></iframe>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection