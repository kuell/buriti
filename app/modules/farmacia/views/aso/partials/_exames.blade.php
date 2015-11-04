@extends('layouts.frame')

@section('frame')
{{ Form::open(['route'=>['farmacia.aso.exames',$aso->id]]) }}
<div class="panel panel-default">
	<div class="panel-body">
		<div class="form-group">
			<div class="col-xs-3">
				{{ Form::label('Descrição do Exame: ') }}
			{{ Form::select('exame_id', [''=>'Selecione ...']+Exame::all()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
			</div>
			<div class="col-md-3 col-xs-3">
				{{ Form::label('Data de realização: ') }}
				{{ Form::text('data', null, ['class'=>'form-control data input-sm']) }}
			</div>
			<div class="col-md-6 col-xs-6">
				{{ Form::label('Médico Responsavel pela Realização: ') }}
				{{ Form::text('medico', null, ['class'=>'form-control', 'placeholder'=>'Médico responsavel pelo exame']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-5 col-xs-5">
				{{ Form::label('Local de Realização: ') }}
				{{ Form::text('local_realizacao', null, ['class'=>'form-control', 'placeholder'=>'Local de realização do exame']) }}
			</div>
			<div class="col-md-4 col-xs-4">
				{{ Form::label('Resultado: ') }}
				{{ Form::select('resultado', [''=>'Selecione ...','normal'=> 'Normal','alterado'=>'Alterado'] ,null, ['class'=>'form-control', 'placeholder'=>'Resultado do Exame']) }}
			</div>
			<div class="col-md-3 col-xs-3">
				{{ Form::label('Validade: ') }}
				{{ Form::text('validade', null, ['class'=>'form-control numero', 'placeholder'=>'Em meses']) }}
			</div>
		</div>
	</div>

	<div class="panel-footer">
		{{ Form::submit('Grava',['class'=>'btn btn-success']) }}
	</div>

	<div>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Data</th>
					<th>Descrição do Exame</th>
					<th>Local de Realização</th>
					<th>Validade</th>
					<th>Resultado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($aso->exames as $exame)
				<tr>
					<td>{{{ Format::viewDate($exame->data) }}}</td>
					<td>{{{ $exame->descricao }}}</td>
					<td>{{{ $exame->local_realizacao }}}</td>
					<td>{{{ $exame->validade }}} - meses</td>
					<td>{{{ $exame->resultado }}}</td>
					<td>
						<a href="/farmacia/aso/{{ $exame->id }}/exames/delete">
							<i class="glyphicon glyphicon-sm glyphicon-trash"></i>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>
{{ Form::close() }}
@stop