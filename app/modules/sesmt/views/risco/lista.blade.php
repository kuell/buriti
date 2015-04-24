<div class="panel panel-body">
	<div class="panel-boxy">
		<table class="table">
		    <thead>
		        <tr>
		            <th>Posto de Trabaho</th>
		            <th>Tipo do Risco</th>
		            <th>Descrição do Risco</th>
		            <th></th>
		        </tr>
		    </thead>
		    <tbody>
		        @foreach($riscos as $risco)
		        <tr>
		            <td>{{ $risco->postoTrabalho->descricao }}</td>
		            <td>{{ $risco->tipo }}</td>
		            <td>{{ $risco->descricao }}</td>
		            <td>
		                {{ link_to_route('sesmt.risco.destroy', 'excluir', $risco->id , ['class'=>'btn btn-danger']) }}
		            </td>
		        </tr>
		        @endforeach
		    </tbody>
		</table>
	</div>
</div>

