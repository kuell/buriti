<div class="panel panel-body">
	<div class="panel-boxy">
		<table class="table">
		    <thead>
		        <tr>
		            <th>Setor</th>
					<th>Posto de Trabaho</th>
		            <th>Tipo do Risco</th>
		            <th>Descrição do Risco</th>
					<th>Situação</th>
		            <th></th>
		        </tr>
		    </thead>
		    <tbody>
		        @foreach($riscos as $risco)
				@if($risco->situacao == 'inativo')
			        <tr class="danger">
				@else
					<tr>
				@endif
			            <td>{{ $risco->postoTrabalho->setor->descricao }}</td>
						<td>{{ $risco->postoTrabalho->descricao }}</td>
			            <td>{{ $risco->tipo }}</td>
			            <td>{{ $risco->descricao }}</td>
						<td>{{ $risco->situacao }}</td>
			            <td>
					@if($risco->situacao == 'inativo')
						{{ Form::model($risco, array('route' => array('sesmt.risco.update', $risco->id), 'method' => 'patch')) }}
					        <button type="submit" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-ok"></i></button>
					    {{ Form::close() }}
					@else
						{{ Form::open(array('route' => array('sesmt.risco.destroy', $risco->id), 'method' => 'delete')) }}
					        <button type="submit" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-remove"></i></button>
					    {{ Form::close() }}
					@endif

			            </td>
			        </tr>

		        @endforeach
		    </tbody>
		</table>
	</div>
</div>

