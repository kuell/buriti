<div>
	<table class="table table-hover" id="planos">
		<thead>
			<tr>
				<th>#</th>
				<th>Descrição</th>
				<th>Data de Criação</th>
				<th>Queixa</th>
				<th>Diagnostico</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($ocorrencias as $ocorrencia)
			<tr>
				<td>{{ $ocorrencia->id }}</td>
				<td>{{ $ocorrencia->colaborador->nome }}</td>
				<td>{{ date('d/m/Y', strtotime($ocorrencia->created_at)) }}</td>
				<td>{{ $ocorrencia->queixa->descricao or null }}</td>
				<td>{{ $ocorrencia->diagnostico }}</td>
				<td>
					{{ Form::button('Plano de Ação', ['class'=>'btn btn-sm btn-primary', 'name'=>'plano_acao', 'value'=>$ocorrencia->id]) }}
					{{ Form::button('Baixar', ['class'=>'btn btn-sm btn-warning', 'name'=>'baixar', 'value'=>$ocorrencia->id]) }}

				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>

<div class="modal fade" id="plano_acao_modal">

</div><!-- /.modal -->

<script type="text/javascript">
	$(function(){
		$('button[name=baixar]').bind('click', function() {
			if(confirm('Deseja realmente baixar esta ocorrencia?')){
				$.post('/sesmt/plano_acao/'+$(this).val()+'/baixar', null, function(data){
					alert(data);
					location.reload()
				})
			}

		});

		$('button[name=plano_acao]').bind('click',  function() {
			$('#plano_acao_modal').modal({
				remote: '/sesmt/plano_acao/'+$(this).val()+'/edit'
			});
		});

		$('#plano_acao_modal').on('hidden.bs.modal', function(e){
			location.reload()
		})

		$('#planos').dataTable();
	})
</script>