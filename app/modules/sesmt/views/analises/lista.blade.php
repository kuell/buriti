<table class="table table-hover" id="analises">
	<thead>
		<tr>
			<th>#</th>
			<th>Data Hora</th>
			<th>Colaborador</th>
			<th>Setor</th>
			<th>Queixa</th>
			<th>Diagnóstico</th>
			<th>Situação</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($analises as $analise)
		<tr>
			<td>{{ $analise->id }}</td>
			<td>{{ $analise->data_hora }}</td>
			<td>{{ $analise->colaborador->nome }}</td>
			<td>{{ $analise->colaborador->setor->descricao or null }}</td>
			<td>{{ $analise->queixa->descricao or null }}</td>
			<td>{{ $analise->diagnostico }}</td>
			<td>{{ $analise->situacao }}</td>
			<td>
				<div class="btn-group" role="group">

					@if($analise->situacao != 'finalizada')
						@if(count($analise->investigacao) == 0)
						<button rule="group" title="Analizar ocorrência" name="analisar" class="btn btn-sm btn-primary" value="{{ $analise->id }}"><i class="glyphicon glyphicon-refresh"></i> </button>

						<button name="finalizar" title="Finalizar Ocorrencia" rule="group" class="btn btn-sm btn-warning" value="{{ $analise->id }}"><i class="glyphicon glyphicon-ok"></i> </button>
						@else
							Em Investigação
						@endif
					@endif
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

</div>

<script type="text/javascript">
	$(function(){

		$('button[name=finalizar]').bind('click', function(){
			if(confirm('Tem certeza que deseja finalizar da Ocorrencia?')){
				$.post('/sesmt/analise/'+$(this).val()+'/finalizar',{'situacao':'finalizada'}, function(data){
					if(data.situacao == 'aberto'){
						alert(':( \n Infelizmente foi impossivel finalizar esta ocorrencia\n Verifique os campos TIPO, SUBTIPO e QUEIXA depois volte a tentar!')

							//Abre Modal
							$('#myModal').modal({
								remote: '/sesmt/analise/'+data.id+'/edit'
							})


					}else{
						location.reload()
					}

				})
			}
		})

		$('button[name=analisar]').bind('click', function(){
			$('#myModal').modal({
				remote: '/sesmt/analise/'+$(this).val()+'/edit'
			})
		})
		$('#myModal').on('hidden.bs.modal', function(e){
			location.reload()
		})

		$("#analises").dataTable();
	})
</script>