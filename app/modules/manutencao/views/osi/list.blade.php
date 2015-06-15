<table class="table table-hover" id="dataTables-example">
	<thead>
		<tr>
			<th>#</th>
			<th>Data</th>
			<th>Setor Responsavel</th>
			<th>Requisitante</th>
			<th>Setor Requisitante</th>
			<th>Equipamento</th>
		<th>
				{{ link_to_route('manutencao.osi.create', 'Adicionar', null, ['class'=>'btn btn-success']) }}
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($osis as $ordem_interna)
		<tr>
			<td>{{ $ordem_interna->id }}</td>
			<td>{{ $ordem_interna->data }}</td>
			<td>{{ $ordem_interna->setorResponsavel->descricao }}</td>
			<td>{{ $ordem_interna->requisitante }}</td>
			<td>{{ $ordem_interna->setorRequisitante->descricao }}</td>
			<td>{{ $ordem_interna->equipamento_id }}</td>
			<td>
				<div class="btn-group btn-group-xs" role="group" aria-label="...">
					<a href="/manutencao/osi/{{ $ordem_interna->id }}/edit " class="btn btn-info">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>

				  	<a href="#" class="btn btn-primary" onclick="open('/manutencao/osi/{{ $ordem_interna->id }} ','Print','channelmode=true')">
				  		<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
				  	</a>

				  	<a href="/manutencao/osi/encaminhar/{{ $ordem_interna->id }}" class="btn btn-warning disabledrms">
				  		<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
				  	</a>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>