@if($asos->count())
<table class="table table-hover">
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
		<tr>
			<td>{{{ $aso->id }}}</td>
			<td>{{{ Format::viewDate($aso->data) }}}</td>
			<td>{{{ $aso->colaborador_nome }}}</td>
			<td>{{{ $aso->tipo }}}</td>
			<td>{{{ $aso->status }}}</td>
			<td>{{{ $aso->situacao }}}</td>
			<td>
				@if($aso->situacao != 'fechado')
					{{ Form::button('Finalizar', ['class'=>'btn btn-success btn-sm', 'name'=>'finalizar', 'value'=>$aso->id]) }}
				@endif
			</td>
		</tr>
		@endforeach

	</tbody>
</table>

<script type="text/javascript">
	$(function(){
		$('button[name=finalizar]').click(function() {
			if(confirm('Deseja realmente finalizar esta ASO?')){
				$.ajax({
					url: '/farmacia/aso_ajustes/'+$(this).val(),
					type: 'patch'
				})
				.always(function() {
					location.reload()
				});

			}
		});
	})
</script>

@endif