@extends('dashboard.index')

@section('main')
	<div class="box box-primary">
	    <div class="box-header">
	        <i class="ion ion-clipboard"></i>
	        <h3 class="box-title">Novo Colaborador</h3>
	        <div class="box-footer clearfix no-border">

	        </div>
	    </div><!-- /.box-header -->

		<div class="box-body">
			{{ Form::open(array('route' => 'colaboradors.store', 'rule'=>'form')) }}
				@include('cadastros::colaboradores.form')

				<div class="form-group">
					<div class="col-md-12">
					  <button type="submit" class="btn btn-primary">Gravar</button>
					  {{ link_to_route('colaboradors.index', 'Cancelar', null, array('class'=>'btn btn-danger')) }}
					</div>
				</div>

			{{ Form::close() }}
		</div>
	</div>

@endsection