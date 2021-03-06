<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Visualizar Ocorrencia {{ $ocorrencia->id }}</h4>
		</div>
		<div class="modal-body">
			<table class="table table-bordered">
				<tr>
					<th>Colaborador:</th>
					<td colspan="4">{{$ocorrencia->colaborador->nome}}</td>
				</tr>
				<tr>
					<th>Setor: </th>
					<td>{{ $ocorrencia->colaborador->setor->descricao }}</td>
					<th>Posto de Trabalho: </th>
					<td>{{ $ocorrencia->colaborador->postoTrabalho->descricao or null }}</td>
				</tr>
				<tr>
					<th>Data da Ocorrencia: </th>
					<td>{{ $ocorrencia->data_hora }}</td>
					<th>Destino: </th>
					<td>{{ $ocorrencia->destino }}</td>
				</tr>
				<tr>
					<th colspan="4" class="well">Relato da Ocorrencia: </th>
				</tr>
				<tr>
					<td colspan="4">
						{{ $ocorrencia->relato }}
					</td>
				</tr>
				<tr>
					<th colspan="4" class="well">Diagnostico</th>
				</tr>
				<tr>
					<td colspan="4">{{ $ocorrencia->diagnostico }}</td>
				</tr>

				<tr>
					<th colspan="4" class="well">Conduta</th>
				</tr>
				<tr>
					<td colspan="4">{{ $ocorrencia->conduta }}</td>
				</tr>

				<tr>
					<th>Profissional: </th>
					<td colspan="3">{{ $ocorrencia->profissional }}</td>
				</tr>
			</table>

			@yield('analise')
		</div>

		@if(count($ocorrencia->atestados))
			@include('farmacia::ocorrencias.show_atestados');
		@endif

	</div>
</div>