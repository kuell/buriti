<div class="panel-group">
	@foreach($taxas as $taxa)
	<div class="panel">
		<div class="panel-heading">
			<div class="form-group">
				<div class="col-md-1">
					{{ link_to_route('taxa.taxas.edit', $taxa->id, $taxa->id) }}
				</div>
				<div class="col-md-3">
					{{ Format::viewDate($taxa->data) }}
				</div>
				<div class="col-md-6">
					{{ $taxa->corretor_descricao }}
				</div>
				<div class="col-md-2">
					<a role="button" data-toggle="collapse" class="btn btn-info btn-sm" data-parent="#accordion" href="#{{ $taxa->id }}" aria-expanded="true" aria-controls="collapseOne">
						ver
					</a>
					{{ Form::button('Itens', ['class'=>'btn btn-sm btn-warning', 'name'=>'taxa', 'value'=>$taxa->id]) }}
				</div>

			</div>
		</div>

		<div id="{{ $taxa->id }}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
			<div class="form-group">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Item</th>
							<th>Qtde</th>
							<th>Peso</th>
							<th>Valor</th>
							<th>Tipo</th>
						</tr>
					</thead>
					<tbody>
						@foreach($taxa->itens as $item)
						<tr>
							<td>{{ $item->item_id }}</td>
							<td>{{ $item->descricao }}</td>
							<td>{{ Format::valorView($item->qtd) }}</td>
							<td>{{ Format::valorView($item->peso, 2) }}</td>
							<td>R$ {{ Format::valorView($item->valor) }}</td>
							<td>{{ $item->tipo_descricao }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endforeach
</div>

{{--
<table class="table table-hover">
	<caption>Lista Taxas</caption>
	<thead>
		<tr>
			<th>#</th>
			<th>Data</th>
			<th>Corretor</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td></td>
			<td>{{ $taxa->corretor_descricao }}</td>
			<td>
				{{ Form::button('Taxa', ['class'=>'btn btn-primary btn-sm', 'name'=>'taxa', 'value'=>$taxa->id]) }}
			</td>
		</tr>
	</tbody>
</table>
 --}}
