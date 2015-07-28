@if($ocorrencias->count())
<table class="table table-hover" id="ocorrencias">
	<thead>
		<tr>
			<th>#</th>
			<th>Data/Hora</th>
			<th>Colaborador</th>
			<th>Setor</th>
			<th>Monitoramento</th>
			<th>SESMT</th>
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
			<td>{{{ $ocorrencia->monitoramento }}}</td>
			<td>{{{ $ocorrencia->sesmt }}}</td>
			<td>
				{{ link_to_route('farmacia.ocorrencias.edit', ' Editar', $ocorrencia->id, array('class'=>'btn btn-primary')) }}
				<button class="btn btn-info" name="print" value="{{ $ocorrencia->id }}"><i class="glyphicon glyphicon-print"></i> Ver</button>
			</td>
		</tr>
		@endforeach

	</tbody>
</table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

</div>
@endif