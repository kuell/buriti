<table class="table" id="analises">
	<thead>
		<tr>
			<th>#</th>
			<th>Data Hora</th>
			<th>Colaborador</th>
			<th>Setor</th>
			<th>Queixa</th>
			<th>Diagnóstico</th>
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
			<td>
				<button name="analisar" class="btn btn-sm btn-primary" value="{{ $analise->id }}"><i class="glyphicon glyphicon-refresh"></i> Analizar</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

</div>

<script type="text/javascript">
	$(function(){

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