<div class="panel panel-body">
	<div class="panel-boxy">
		<table class="table">
		    <thead>
		        <tr>
		            <th>Posto de Trabaho</th>
		            <th>Tipo do Risco</th>
		            <th>Descrição do Risco</th>
					<th>Situação</th>
		            <th></th>
		        </tr>
		    </thead>
		    <tbody>
		        @foreach($riscos as $risco)
		        <tr>
		            <td>{{ $risco->postoTrabalho->descricao }}</td>
		            <td>{{ $risco->tipo }}</td>
		            <td>{{ $risco->descricao }}</td>
					<td>{{ $risco->situacao }}</td>
		            <td>
					{{ Form::open(array('route' => array('sesmt.risco.destroy', $risco->id), 'method' => 'delete')) }}
				        <button type="submit" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>
				    {{ Form::close() }}
		            </td>
		        </tr>
		        @endforeach
		    </tbody>
		</table>
	</div>
</div>

