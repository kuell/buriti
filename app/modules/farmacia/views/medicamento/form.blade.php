@if(!empty($medicamento))
	{{ Form::model($medicamento, array('method' => 'PATCH',
	   'route' => array('farmacia.medicamentos.update', $medicamento->id) ,
	   'rule'=>'form', 'class'=>'navbar-form navbar-left ol-md-12'))
 	}}
@else
	{{ Form::open(['route'=>'farmacia.medicamentos.store', 'class'=>'navbar-form navbar-left ol-md-12']) }}
@endif
	{{ Form::label('Descricao', null, ['class'=>'nav-brand']) }}
	<div class="form-group">
		{{ Form::text('descricao', null, ['class'=>'form-control', 'size'=>50,'placeholder'=>'Descrição do Medicamento'] ) }}
	</div>
		{{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}
{{ Form::close() }}