<!DOCTYPE html>
<html>
<head>
	<title></title>
	{{ HTML::style('css/bootstrap.min.css')}}
</head>
<body>
<div>
	<table class="table">
		<thead>
			<tr>
				<th>Descrição da função</th>
			</tr>
		</thead>
		<tbody>
			@foreach($funcaos as $funcao)
			<tr>
				<td>{{{ $funcao->descricao }}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>


</body>
</html>