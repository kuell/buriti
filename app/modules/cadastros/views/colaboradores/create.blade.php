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
			{{ Form::close() }}
		</div>
	</div>

@endsection