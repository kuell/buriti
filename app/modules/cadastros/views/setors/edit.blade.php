@extends('dashboard.index')

@section('main')
<div class="box box-info">
	{{ HTML::head('Setores', 'controla os setores') }}
	{{ HTML::boxhead('Editar setor: '.$setor->descricao) }}

	<div class="box-body">
		{{ Form::model($setor, array('method' => 'PATCH',
			'route' => array('setors.update', $setor->id) ,
			'rule'=>'form'))
		}}

		@include('cadastros::setors.form')
		{{ Form::close() }}

		<div role="tabpanel">

			  <!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#funcao" aria-controls="funcao" role="tab" data-toggle="tab">
						<h5>Funções do setor</h5>
					</a>
				</li>

			    <li role="presentation">
					<a href="#posto" aria-controls="posto" role="tab" data-toggle="tab">
						<h5>Posto de Trabalho</h5>
					</a>
				</li>
			</ul>

			  <!-- Tab panes -->
		  	<div class="tab-content">
		    	<div role="tabpanel" class="tab-pane active" id="funcao">
					<iframe src="/setors/funcaos/{{ $setor->id }}" class="col-md-12" style="border: 1px" height="350px"></iframe>
				</div>
				<div role="tabpanel" class="tab-pane" id='posto'>
					<iframe src="/setors/posto/{{ $setor->id }}" class="col-md-12" style="border: 1px" height="350px"></iframe>
				</div>
			</div>
		</div>

	</div>



</div>



@endsection
