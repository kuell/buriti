@extends('layouts.modulo')

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Controle de Causas / Queixas</h3>
		</div>
		<div class="panel-body">
		<div class="col-md-12 col-sm-12">
			@include('farmacia::queixas.form')
		</div>

			<div class="col-md-12 col-sm-12">
				<table class="table table-hover" id="queixas">
					<thead>
						<tr>
							<th>#</th>
							<th>Descrição da Causa / Queixa</th>
							<th>Entra no PCMSO</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($queixas as $q)
						@if(!empty($queixa) && $queixa->id == $q->id)
							<tr class="well">
						@else
							<tr>
						@endif

							<td>{{ $q->id }}</td>
							<td>{{ $q->descricao }}</td>
							<td>{{ $q->pcmso }}</td>
							<td>
								{{ link_to_route('farmacia.queixas.edit', ' ', $q->id, ['class'=> 'btn btn-sm btn-info glyphicon glyphicon-pencil']) }}
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
		$('#queixas').dataTable()
	})
</script>


@stop