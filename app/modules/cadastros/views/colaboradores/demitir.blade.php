<div class="modal-dialog" role="document">
	<div class="modal-content">
	 	<div class="modal-header">
	    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    	<h4 class="modal-title" id="myModalLabel">Demitir Funcionario</h4> {{ $colaborador->nome }}
	  	</div>
	  	<div class="modal-body">
	  		{{ Form::model($colaborador, ['method' => 'PATCH', 'route' => ['colaboradors.update', $colaborador->id] , 'rule'=>'form'])}}

	    	<div class="form-group">
	    		<h4>Motivo da Demissão: </h4>
	    		{{ Form::textarea('demissao_motivo', null, ['class'=>'form-control']) }}
	    	</div>

	    	<div class="form-group">
	    		{{ Form::submit('Demitir', ['class'=>'btn btn-primary']) }}
	    		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
	    	</div>

	    	{{ Form::close() }}
	  	</div>
	</div>
</div>
