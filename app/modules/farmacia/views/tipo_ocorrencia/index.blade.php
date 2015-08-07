@extends('layouts.modulo')

@section('content')

<div class="panel panel-default">

	<div class="panel-heading">
		<h4 class="panel-title">
			Controle das Classificações das Ocorrencias
		</h4>
	</div>
	<div class="panel-body">
		<div class="well">
			@include('farmacia::tipo_ocorrencia.form')
		</div>
		<div>
			<table class="table table-hover" id="tipos">
				<thead>
					<tr>
						<th>#</th>
						<th>Descrição</th>
						<th>Agrupado em</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($tipos as $tipo)
					<tr>
						<td>{{ $tipo->id }}</td>
						<td>{{ $tipo->descricao }}</td>
						<td>{{ $tipo->agrupamento }}</td>
						<td>
							{{ link_to_route('farmacia.tipo_ocorrencia.edit', 'Editar', $tipo->id, ['class'=>'btn btn-primary btn-sm']) }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>


</div>


<script type="text/javascript">
	$(function(){
		$('#tipos').dataTable();
	})
</script>
@stop