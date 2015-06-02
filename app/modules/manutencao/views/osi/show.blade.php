<!DOCTYPE html>
	<html>
		<head>
			<title>Ordem Interna</title>
			{{ HTML::style('css/bootstrap.css') }}
		</head>
		<body>
			<div class="col-md-10">
				<div class="well">
					<h3 class="text-center">Frizelo Frigorificos Ltda.</h3>
				</div>
				<table class="table table-bordered">
						<tr>
							<th class="well">Numero da Ordem Interna</th>
							<td>{{ $osi->id }}</td>

							<th class="well">Equipamento:</th>
							<td>{{ $osi->equipamento_id }}</td>
						</tr>
						<tr>
							<th class="well">Data: </th>
							<td>{{ $osi->data }}</td>

							<th class="well">Requisitante: </th>
							<td>{{ $osi->requisitante }}</td>
						</tr>

						<tr>
							<th class="well">Setor Requisitante: </th>
							<td>{{ $osi->setorRequisitante->descricao }}</td>
							<th class="well">Setor Responsavel: </th>
							<td>{{ $osi->setorResponsavel->descricao }}</td>
						</tr>
						<tr>
							<th colspan="4" class="well text-center">Descrição do Serviço</th>
						</tr>
						<tr>
							<td colspan="4">{{ $osi->obs }}</td>
						</tr>
						<tr>
							<td colspan="4">
									<table class="table">
											<thead>
												<tr>
													<th>Serviço</th>
													<th>Prazo</th>
												</tr>
											</thead>
											<tbody>
												@foreach($osi->servicos as $servico)
												<tr>
													<td>{{ $servico->descricao }}</td>
													<td>{{ OrdemInternaServico::prazo($servico->id, true) }}</td>
												</tr>
												@endforeach
											</tbody>
										</table>

							</td>
						</tr>
				</table>
				<div class="col-md-12">
					<div class="col-md-4">
						<p>__________________________________<br>
							{{ $osi->requisitante }}
						</p>

					</div>
					<div class="col-md-4">
						<p>__________________________________<br>
								{{ $osi->setorResponsavel->descricao }}
						</p>
					</div>
				</div>
			</div>
		</body>
	</html>