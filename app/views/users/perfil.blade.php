@extends('dashboard.index')

@section('main')

	<section class="content">
	@include('users.topo')
                <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Perfil</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            {{ Form::model($usuario, array('method' => 'PATCH',
                                                 'route' => array('users.users.update', $usuario->id) ,
                                                 'rule'=>'form'))
                                                 }}
                <div class="box-body">

                @include('dashboard.partials._alerts')

	                <div class="col-md-12">
	                    <div class="form-group">
	                        <label for="exampleInputEmail1">Nome Completo</label>
	                        {{ Form::text('nome', null, array('class'=>'form-control')) }}
	                    </div>

		                <div class="col-md-6">
		                    <div class="form-group">
		                        <label for="exampleInputPassword1">Ramal</label>
		                      {{ Form::text('ramal', null, array('class'=>'form-control')) }}
		                    </div>
		                </div>
		                <div class="col-md-6">
		                    <div class="form-group">
		                        <label for="exampleInputPassword1">Contato: </label>
		                      {{ Form::text('cel', null, array('class'=>'form-control')) }}
		                    </div>
		                </div>

		                <div class="form-group">
	                        <label for="exampleInputEmail1">E-mail: </label>
	                        {{ Form::text('email', null, array('class'=>'form-control')) }}
	                    </div>

	                    <div class="box-header">
			                <h3 class="box-title">Acesso ao sistema</h3>
			            </div>

		                <div class="col-md-6">
		                    <div class="form-group">
		                        <label for="exampleInputPassword1">Usuario: </label>
		                      {{ Form::text('user', null, array('class'=>'form-control', 'disabled')) }}
		                    </div>
		                </div>
		                <div class="col-md-6">
		                    <div class="form-group">
		                        <label for="exampleInputPassword1">Senha: </label>
		                      {{ Form::password('password', array('class'=>'form-control')) }}
		                    </div>
		                </div>
	                </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Gravar</button>
                </div>
            {{ Form::close() }}
        </div><!-- /.box -->
    </section><!-- /.content -->
@endsection