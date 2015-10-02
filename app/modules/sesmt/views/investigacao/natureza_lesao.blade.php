@extends('layouts.frame')

@section('frame')
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				Natureza da Lesão
			</h4>
		</div>
		<div class="panel-body">
			{{ Form::open(['route'=>['sesmt.investigacao.lesao', $investigacao->id], 'class'=>'form form-inline well']) }}
			<div class="form-group">
				<div class="col-md-12">
					{{ Form::label('Natureza da Lesão: ') }}
					{{ Form::select('natureza_lesao_id', ['Selecione ...']+NaturezaLesao::all()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
					{{ Form::submit('Gravar', ['class'=>'btn btn-success btn-sm']) }}
				</div>
			</div>
			{{ Form::close() }}
			<div class="col-xs-12">
				<table>
					<thead>
						<tr>
							<th>Descrição</th>
						</tr>
					</thead>
					<tbody>
					@foreach($investigacao->natureza_lesaos as $lesao)
						<tr>
							<td>{{ $lesao->descricao }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>


	</div>
@stop