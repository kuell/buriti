<html>
	<head>
		{{ HTML::style('css/bootstrap.min.css') }}
	</head>
	<body>
	{{ Form::open(['route'=>'osi.osi.servicos.store']) }}
		<div class="col-md-12"> 
			<div class="col-md-3 form-group"> 
				{{ Form::hidden('ordem_interna_id', $ordem_interna->id) }}
				{{ Form::label('descricao', 'Descrição do Serviço : ') }}
				{{ Form::textarea('descricao', null, ['class'=>'form-control', 'rows'=>'3'])}}
			</div>
			<div class="col-md-3 form-group"> 
				{{ Form::label('prazp', 'Prazo de realização do Serviço (dias): ') }}
				{{ Form::text('prazo', null, ['class'=>'form-control'])}}
			</div>
			
			<div class="col-md-12">
				{{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}

			</div>
		</div>
	{{ Form::close() }}
	
	<div class="col-md-12">
		<table class="table">
			<thead>	
				<tr>
					<th>Descrição do serviço</th>
					<th>Ultimo Prazo</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($ordem_interna->servicos as $servico)
				<tr>
					<td>{{ $servico->descricao }}</td>
					<td>
						<a href="/osi/osi/servicos/{{ $servico->id }}/edit" title="Gerenciar Prazos">
							{{ OrdemInternaServico::prazo($servico->id) }}
						</a>
					</td>
					<td>
						{{ Form::open(array('route' => array('osi.osi.servicos.destroy', $servico->id), 'method' => 'delete')) }}
					        <button type="submit" class="btn btn-danger btn-xs">
					        	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					        </button>
					    {{ Form::close() }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	
	</body>

</html>