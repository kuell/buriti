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

			@if($aso->ajuste)
				<tr style="background: red;">
			@else
				<tr>
			@endif

			<td>{{{ $aso->id }}}</td>
			<td>{{{ Format::viewDate($aso->data) }}}</td>
			<td>{{{ $aso->colaborador_nome }}}</td>
			<td>{{{ $aso->tipo }}}</td>
			<td>{{{ $aso->status }}}</td>
			<td>{{{ $aso->situacao }}}</td>
			<td>
				<div class="btn-group" role="group">
					@if($aso->situacao != 'fechado')
					<a href="/farmacia/aso/{{ $aso->id }}/edit" class="btn btn-sm btn-info ">
						<i class="glyphicon glyphicon-pencil"></i>
					</a>
					@endif


					<a href="#" onclick="window.open('/farmacia/aso/{{ $aso->id }}', 'Print', 'channelmode=yes')" class="btn btn-sm btn-warning ">
						<i class="glyphicon glyphicon-print"></i>
					</a>
					@if($aso->tipo == 'admissional' && $aso->ajuste == false)
					{{ Form::open(array('route' => array('farmacia.aso.destroy', $aso->id), 'id'=>$aso->id, 'method' => 'delete', 'name'=>'delete')) }}
				    	<button type="submit"  title="Reprovado nos Exames Médicos" class="btn btn-sm btn-danger">
							<i class="glyphicon glyphicon-remove"></i>
						</button>
				    {{ Form::close() }}
				    @endif
				</div>
			</td>
		</tr>
		@endforeach

	</tbody>
</table>

@endif

@section('scripts_local')

<script type="text/javascript">
	$(function(){
		$('form[name=delete]').submit(function(){

			if(confirm('Deseja realmente reprovar esta ficha aso? ')){
				return true;
			}
			else{
				return false;
			}
		});
	})
</script>

@stop