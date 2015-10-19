<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title">Planos de Ação</h4>
	      	</div>
	      	<div class="modal-body">
	        	<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#ocorrencia" aria-expanded="true" aria-controls="collapseOne">
						         	Ocorrencia - {{ $ocorrencia->id }}
						        </a>
							</h4>
						</div>

						<div id="ocorrencia" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">

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

								@if(count($ocorrencia->atestados))
									@include('farmacia::ocorrencias.show_atestados');
								@endif
					    </div>
					</div>

					<div class="panel panel-info">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#plano_acao" aria-expanded="true" aria-controls="collapseOne">
						         	Investigação - {{ $ocorrencia->investigacao->id }}
						        </a>
							</h4>
						</div>
						<div id="plano_acao" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
							<div class="form-group">

								<div class="col-xs-3">
									<span>Tipo de Acidente:</span> {{ $ocorrencia->investigacao->tipo_ocorrencia_descricao }}

								</div>

								<div class="col-xs-3">
									<span>Data do Acidente:</span> {{ Format::viewDate($ocorrencia->investigacao->data_acidente) }}
								</div>

								<div class="col-xs-3">
									<span>Houve afastamento?</span> {{ $ocorrencia->investigacao->com_afastamento }}
								</div>

								<div class="col-xs-3">
									Local de Assistência Médica: {{ $ocorrencia->investigacao->local_assistencia_medica }}
								</div>

							</div>


							<div class="form-group">
								<div class="col-xs-6">
									Local do Acidente: {{ $ocorrencia->investigacao->local_acidente }}
								</div>

								<div class="col-xs-6">
									Descrição do Acidente: {{ $ocorrencia->investigacao->descricao_acidente }}
								</div>

							</div>
						</div>
					</div>


					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#plano_acao" aria-expanded="true" aria-controls="collapseOne">
						         	Planos de Ação para a Ocorrencia - {{ $ocorrencia->id }}
						        </a>
							</h4>
						</div>
						<div id="plano_acao" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<iframe src="/sesmt/plano_acao/create?id={{ $ocorrencia->id }}" width="100%" height="400px" class="frame"></iframe>
						</div>
					</div>


				</div>
	      	</div>
	    </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
