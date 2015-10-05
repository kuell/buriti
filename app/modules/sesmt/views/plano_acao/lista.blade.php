<div>
	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Descrição</th>
			</tr>
		</thead>
		<tbody>
		@foreach($investigacao->natureza_lesaos as $natureza)
			<tr>
				<td>{{ $natureza->id }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>