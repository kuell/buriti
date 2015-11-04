<script type="text/javascript" charset="utf-8">
	$(function(){
		$('#finaliza').bind('click', function() {
			$.post('/sesmt/investigacao/{{ $investigacao->id }}/finalizar', function(data){
				if(data == 0){
					alert('Investigação finalizada com sucesso!');
					location.reload()
				}
				else{
					alert(data)
				}
			})
		});
	})
</script>

<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Finalizar Investigação - {{ $investigacao->id }}
			</h4>
		</div>

		<div class="modal-body">
			<div>

			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#ocorrencia" aria-controls="ocorrencia" role="tab" data-toggle="tab">Ocorrencia</a></li>
			    <li role="presentation"><a href="#investigacao" aria-controls="investigacao" role="tab" data-toggle="tab">Investigação</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="ocorrencia">
			    	@include('farmacia::ocorrencias.show')
			    </div>
			    <div role="tabpanel" class="tab-pane" id="investigacao">
			    	@include('sesmt::investigacao.show')
			    </div>
			  </div>

			</div>

		</div>
		<div class="modal-footer">
			{{ Form::button('Finalizar', ['class'=>'btn btn-success', 'id'=>'finaliza']) }}
			{{ link_to_route('sesmt.investigacao.edit', 'Editar Investigação', $investigacao->id, ['class'=>'btn btn-primary']) }}
		</div>
	</div>
</div>
