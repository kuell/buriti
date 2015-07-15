@if($ocorrencias->count())
<table class="table table-hover" id="ocorrencias">
	<thead>
		<tr>
			<th>#</th>
			<th>Data/Hora</th>
			<th>Colaborador</th>
			<th>Setor</th>
			<th>Tipo</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($ocorrencias as $ocorrencia)
		<tr>
			<td>{{{ $ocorrencia->id }}}</td>
			<td>{{{ $ocorrencia->data_hora }}}</td>
			<td>{{{ $ocorrencia->colaborador->nome }}}</td>
			<td>{{{ $ocorrencia->colaborador->setor->descricao or "Não Identificado"}}}</td>
			<td>{{{ print_r($ocorrencia->tipo) }}}</td>
			<td>
				{{ link_to_route('farmacia.ocorrencias.edit', 'Editar', $ocorrencia->id, array('class'=>'btn btn-primary')) }}
			</td>
		</tr>
		@endforeach

	</tbody>
</table>

<div class="modal js-loading-bar" id="progress">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h4>Atualizando Registro ...</h4>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	.progress-bar.animate {
		width: 100%;
	}
</style>

<script type="text/javascript">
	function definir(ocorrencia, tipo, colaborador){
		$(this).attr('disabled', 'disabled');
		$('#progress').find('progress-bar').addClass('animate');
		$('#progress').modal('show');

		$.ajax({
			url: '/farmacia/ocorrencias/'+ocorrencia,
			type: 'PATCH',
			data: {id: ocorrencia, 'tipo': tipo, 'colaborador_id': colaborador},
		})
		.done(function(data) {
			location.reload()
		})
		.fail(function() {
			location.reload()
		})
		.always(function(data) {
			console.log(data);
		});

	}
</script>

@endif