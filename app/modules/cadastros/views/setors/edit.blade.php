@extends('dashboard.index')

@section('main')
<div class="box box-primary">
	<div class="box-header">
		<h4 class="box-title">
			Alteração do setor - {{ $setor->descricao }}
		</h4>
	</div>


	<div class="box-body">
		{{ Form::model($setor, array('method' => 'PATCH',
			'route' => array('setors.update', $setor->id) ,
			'class'=>'form form-horizontal'))
		}}

		@include('cadastros::setors.form')

		<div class="form-group">
			<div class="col-md-12">
		    	<button type="submit" class="btn btn-primary">Gravar</button>
		    	{{ Form::button('Informações Adicionais', ['class'=>'btn btn-success', 'id'=>'info']) }}
		    	{{ link_to_route('setors.index', 'Cancelar', null, array('class'=>'btn btn-danger')) }}
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>

	<div class="modal fade" id="info_modal">
		<div class="modal-dialog">
			<div class="modal-content modal-lg">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Setor - {{ $setor->descricao }}</h4>
				</div>
				<div class="modal-body">

					<div class="col-md-12">
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
									<iframe src="/setors/funcao/{{ $setor->id }}" style="border: 1px" height="350px" width="100%"></iframe>
								</div>
								<div role="tabpanel" class="tab-pane" id='posto'>
									<iframe src="/setors/posto/{{ $setor->id }}" style="border: 1px" height="350px" width="100%"></iframe>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="modal-footer">

				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$(function() {
		$('#info').bind('click', function(){
			$('#info_modal').modal()
		});
	})
</script>

@endsection