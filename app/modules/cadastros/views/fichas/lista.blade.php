<table class="table" id="fichas">
	<thead>
		<tr>
			<th>Foto</th>
			<th>Nome</th>
			<th>Idade</th>
			<th>Setores Pretendidos</th>
			<th>Data Criação</th>
			<th>Situacao</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($fichas as $ficha)
		<tr>
			<td>{{ HTML::image($ficha->foto, null,['width'=>50]) }}</td>
			<td>{{ $ficha->nome }}</td>
			<td>{{ $ficha->idade }}</td>
			<td>{{ implode(', ', $ficha->setores)}}</td>
			<td>{{ date('d/m/Y', strtotime($ficha->created_at)) }}</td>
			<td>{{ $ficha->situacao }}</td>
			<td>

				{{ Form::button(' ',  ['class'=>'btn btn-warning glyphicon glyphicon-print', 'name'=>'print', 'value'=>$ficha->id]) }}
				@if($ficha->situacao == 'Disponivel')
					{{ Form::button(' ', ['class'=>'btn btn-success glyphicon glyphicon-ok', 'name'=>'selecionar', 'value'=>$ficha->id]) }}
					{{ link_to_route('fichas.edit', ' ', $ficha->id, ['class'=>'btn btn-info glyphicon glyphicon-pencil']) }}
				@endif
			</td>

		</tr>
		@endforeach
	</tbody>
</table>
