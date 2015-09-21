{{ Form::open(['class'=>'form form-horizontal']) }}

<script type="text/javascript">
	$(function(){
		$('#finaliza').bind('click', function(){
			var apto = $('#status').val();

			$.post("/farmacia/aso/finalizar/{{ $aso->id }}", {status: apto}, function(data){
				if(data == 0){
					alert('Aso finalizada com sucesso !')
				}
				else{
					alert('Problemas na finalização da ficha ASO.')
				}

				location.reload()
			})
		})
	})
</script>

	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Finalizar ASO - {{ $aso->id }}
				</h4>
			</div>

			<div class="modal-body">

				<div class="form-group">
					<div class="col-xs-6">
						<span class="form-label">Nome: </span>
						<span class="form-control">{{ $aso->colaborador_nome }}</span>
					</div>

					<div class="col-xs-3">
						<span class="form-label">Idade: </span>
						<span class="form-control">{{ $aso->colaborador_idade }} anos</span>
					</div>
					<div class="col-xs-3">
						<span class="form-label">Tipo: </span>
						<span class="form-control">{{ strtoupper($aso->tipo) }}</span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-6">
						{{ Form::label('Apto?', null, ['class'=>'form-label']) }}
						{{ Form::select('status', ['apto'=>'apto','inapto'=>'inapto'], null, ['class'=>'form-control']) }}
					</div>
				</div>
				{{ Form::close() }}

			</div>
			<div class="modal-footer">
				{{ Form::button('Finalizar', ['class'=>'btn btn-primary', 'id'=>'finaliza']) }}
				{{ link_to_route('farmacia.aso.edit', 'Editar ASO', $aso->id, ['class'=>'btn btn-info']) }}
			</div>

		</div>
	</div>
{{ Form::close() }}
