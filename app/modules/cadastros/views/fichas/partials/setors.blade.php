@extends('layouts.frame')

@section('frame')

{{ Form::open(array('url' => 'fichas/setors/'.$ficha->id, 'rule'=>'form')) }}
        <div class='form-group'>
        	{{ Form::label('setor', 'Setor: ') }}
       		{{ Form::select('setor_id', array('' => 'Selecione ...') + Setor::all()->lists('descricao', 'id'), null, array('class'=>'form-control')) }}
       	</div>
		<div class="form-group">
        	{{ Form::label('cargo', 'Cargo pretendido: ') }}
        	{{ Form::text('cargo', null, array('class'=>'form-control', 'placeholder'=>'Cargo pretendido')) }}
        </div>

 	    <div class    ="form-actions">
            {{ Form::submit('Gravar', array('class' => 'btn btn-info')) }}
        </div>

{{ Form::close() }}

@if (count($ficha->setors))
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Ficha_id</th>
				<th>Setor</th>
				<th>Cargo</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($ficha->setors as $setor)
				<tr>
					<td>{{{ $setor->setor->descricao }}}</td>
					<td>{{{ $setor->cargo }}}</td>
                    <td>
                    	<a href="/fichas/setors/{{ $setor->id}}/delete" class="glyphicon glyphicon-trash">
                    	</a>
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else

@endif

<script type="text/javascript">
	$(function(){
		$('select[name=setor_id]').chosen()
	})
</script>

@stop