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
				{{ Form::button(' ',  ['class'=>'btn btn-warning glyphicon glyphicon-print', 'id'=>'print', 'value'=>$ficha->id]) }}
			</td>

		</tr>
		@endforeach
	</tbody>
</table>

@section('scripts')
    <script type="text/javascript">
        $(function(){
            $('#fichas').dataTable();
            $('#print').bind('click', function(){
            	window.open('/fichas/'+$(this).val(), 'Print', 'channelmode=yes');
            })
        });

    </script>
@stop