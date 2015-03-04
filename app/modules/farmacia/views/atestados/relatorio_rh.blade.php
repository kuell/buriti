<html>
<header>
	<title>Relatorio de Cesta Basica</title>
	{{ HTML::style('css/bootstrap.css') }}
</header>
<body>
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th colspan="3">
						<h3>Relatorio de Cesta Básica</h3>
						<span>Periodo de: </span> {{ Input::get('datai') }} <span> a </span>{{ Input::get('dataf') }}
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($dados as $d)
				<tr>
					<th>Matricula</th>
					<th>Nome</th>
					<th>Setor</th>
				</tr>
				<tr>
					<td>{{ $d['matricula'] }}</td>
					<td>{{ $d['nome'] }}</td>
					<td>{{ $d['setor'] }}</td>
				</tr>
				<tr>
					<td colspan="3" class="well">
						<table class="table">
							<tr>
								<th>Data</th>
								<th>Tipo Atestado</th>
								<th>Obs</th>
								<th>Total Dias</th>
							</tr>
							@foreach($d['atestados'][0] as $atestado)
							<tr>
								<td>{{ $atestado->inicio_afastamento }}</td>
								<td>{{ $atestado->descricao($atestado->id) }}</td>
								<td>{{ $atestado->obs }}</td>
								<td>{{ ($atestado->fim_afastamento - $atestado->inicio_afastamento) }}</td>
							</tr>
							@endforeach
						</table>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>