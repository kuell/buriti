<table class="table" id="fichas">
	<thead>
		<tr>
			<th>Foto</th>
			<th>Nome</th>
			<th>Idade</th>
			<th>Setores Pretendidos</th>
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
			<td>
				{{ link_to_route('fichas.edit', ' ', $ficha->id, ['class'=>'btn btn-info glyphicon glyphicon-pencil']) }}
				{{ Form::button(' ',  ['class'=>'btn btn-warning glyphicon glyphicon-print', 'name'=>'print', 'value'=>$ficha->id]) }}
				{{ Form::button(' ', ['class'=>'btn btn-success glyphicon glyphicon-ok', 'name'=>'selecionar', 'value'=>$ficha->id]) }}
			</td>

		</tr>
		@endforeach
	</tbody>
</table>