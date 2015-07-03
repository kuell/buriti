@extends('layouts.modulo')

@section('content')

{{ Form::model($ocorrencia, array('method' => 'PATCH',
   'route' => array('farmacia.ocorrencias.update', $ocorrencia->id) ,
   'rule'=>'form'))
 }}
	<div class="panel panel-primary">
		<div class="panel-heading ">
			<h3 class="panel-title">Alterar Ocorrencia: {{ $ocorrencia->id }}</h3>
		</div>
		<div class="panel-body">
	 		@include('farmacia::ocorrencias.form')
		</div>

		<div class="panel-footer">
		    <button type="submit" class="btn btn-primary">Gravar</button>
		    <button type="button" name="modal" class="btn btn-info" value="medicamento" data-toggle="modal" data-target="#informacoes">Informaçoes Adicionais</button>
		    {{ link_to_route('farmacia.ocorrencias.create', 'Nova Ocorrencia', null, array('class'=>'btn btn-success')) }}
			{{ link_to_route('farmacia.ocorrencias.index', 'Voltar', null, array('class'=>'btn btn-danger')) }}
		</div>
	</div>
{{ Form::close() }}

<!-- Modal Medicaçao-->
<div class="modal fade" id="informacoes" tabindex="" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
        		<h3 class="modal-title">Informaçoes Adicionais</h3>
	      	</div>
		    <div class="modal-body">

		      	<div>
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#medicacao" aria-controls="medicacao" role="tab" data-toggle="tab">Medicacao</a></li>
					    <li role="presentation"><a href="#atestados" aria-controls="atestados" role="tab" data-toggle="tab">Atestados</a></li>
					</ul>

				  <!-- Tab panes -->
				  	<div class="tab-content">
				    	<div role="tabpanel" class="tab-pane active" id="medicacao">
				    		<iframe src="/farmacia/ocorrencias/{{ $ocorrencia->id }}/medicamentos" style="width: 100%; height:400px; border:0;"></iframe>
				    	</div>
				    	<div role="tabpanel" class="tab-pane" id="atestados">
				    		<iframe src="/farmacia/ocorrencias/{{ $ocorrencia->id }}/atestados?lista=sim" style="width: 100%; height:400px; border:0;"></iframe>
				    	</div>
				 	</div>
				</div>
		    </div>
		    <div class="modal-footer">
		    	<button type="button" name="tela" value="atestados" data-dismiss="modal" class="btn btn-info">Fechar</button>
		    	{{ link_to_route('farmacia.ocorrencias.create', 'Nova Ocorrencia', null, array('class'=>'btn btn-success')) }}
		    </div>
    	</div>
  	</div>
</div>
<!-- Fim Modal -->

<script type="text/javascript">
	$('#informacoes').modal()

</script>

@endsection