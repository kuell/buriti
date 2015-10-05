@extends('layouts.frame')

@section('frame')
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				Parte do Corpo atingida
			</h4>
		</div>
		<div class="panel-body">
			{{ Form::open(['route'=>['sesmt.investigacao.corpo', $investigacao->id], 'class'=>'form form-inline well']) }}
			<div class="form-group">
				<div class="col-md-12">
					{{ Form::label('Parte do Corpo: ') }}
					{{ Form::select('parte_corpo_id', ['Selecione ...']+ParteCorpo::all()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
					{{ Form::submit('Gravar', ['class'=>'btn btn-success btn-sm']) }}
				</div>
			</div>
			{{ Form::close() }}
			<div class="col-xs-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Descrição</th>
						</tr>
					</thead>
					<tbody>
					@foreach($investigacao->partesCorpo as $parte)
						<tr>
							<td>{{ $parte->id }}</td>
							<td>{{ $parte->parte_corpo->descricao or null }}</td>
							<td>
								{{ link_to_route('sesmt.investigacao.corpo.destroy',' ', $parte->id, ['class'=>'btn btn-danger btn-sm glyphicon glyphicon-remove']) }}
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
	$(function(){
		$('select[name=parte_corpo_id]').chosen({width:'100%'})
	})
	</script>
@stop