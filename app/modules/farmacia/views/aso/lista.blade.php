@if($asos->count())
<table class="table table-hover" id="asos">
	<thead>
		<tr>
			<th>#</th>
			<th>Data</th>
			<th>Colaborador</th>
			<th>Tipo de Aso</th>
			<th>Status</th>
			<th>Situação</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($asos as $aso)

			@if($aso->ajuste)
				<tr style="background: red;">
			@else
				<tr>
			@endif

			<td>{{ link_to_route('farmacia.aso.edit', $aso->id, $aso->id,null) }}</td>
			<td>{{{ Format::viewDate($aso->data) }}}</td>
			<td>{{{ $aso->colaborador_nome }}}</td>
			<td>{{{ $aso->tipo }}}</td>
			<td>{{{ $aso->status }}}</td>
			<td>{{{ $aso->situacao }}}</td>
			<td>
				<div class="btn-group" role="group">

					<a href="#" onclick="window.open('/farmacia/aso/{{ $aso->id }}', 'Print', 'channelmode=yes')" class="btn btn-sm btn-warning ">
						<i class="glyphicon glyphicon-print"></i>
					</a>

					<button class="btn btn-sm btn-success" value="{{{ $aso->id }}}" id="finalizar" name="finalizar" title="Classificar e finalizar Ficha ASO">
						<i class="glyphicon glyphicon-ok"></i>
					</button>
				</div>
			</td>
		</tr>
		@endforeach

	</tbody>
</table>


<div class="modal fade" id="modalFinalizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

@endif

<script type="text/javascript">
	$(function(){
		$('button[name=finalizar]').bind('click', function(){
			$('#modalFinalizar').modal({
				remote: '/farmacia/aso/finalizar/'+$(this).val()
			})
		})

		$('#modalFinalizar').on('hidden.bs.modal', function(){
            location.reload()
        })
	})
</script>

@stop