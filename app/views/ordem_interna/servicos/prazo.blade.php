<html>
	<head>
		{{ HTML::style('css/bootstrap.min.css') }}
	</head>
	<body>
	{{ Form::open(['method'=>'PATCH', 'route'=>['osi.osi.servicos.update', $servico->id]]) }}
		<div class="col-md-12"> 
			<div class="col-md-3 form-group"> 
				<h4>Descrição do Serviço: </h4>
				<p class="well">{{ $servico->descricao }}</p>
			</div>
			<div class="col-md-3 form-group"> 
				{{ Form::label('prazo', 'Prazo de realização do Serviço (dias): ') }}
				{{ Form::text('prazo', null, ['class'=>'form-control'])}}
			</div>

			<div class="col-md-3 form-group"> 
				{{ Form::label('justificativa', 'Justificativa: ') }}
				{{ Form::text('justificativa', null, ['class'=>'form-control'])}}
			</div>
			
			
			<div class="col-md-12">
				{{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}
				{{ link_to_route('osi.osi.servicos.show', 'Voltar', $servico->ordem_interna_id, ['class'=>'btn btn-danger']) }}

			</div>
		</div>
	{{ Form::close() }}	
	
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>Prazo</th>
					<th>Justificativa</th>
				</tr>
			</thead>
			<tbody>
				@foreach($servico->prazos as $prazo)
				<tr>
					<td>{{ $prazo->prazo }} - dias</td>
					<td>{{ $prazo->justificativa }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>


	</body>

</html>