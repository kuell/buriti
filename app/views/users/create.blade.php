@extends('dashboard.index')

@section('main')

	<section class="content">
	{{ HTML::head('Usuario ', 'controla usuarios!') }}
    {{ HTML::boxhead('Novo Usuario') }}
    <div>
            {{ Form::open(array('route' => 'acesso.user.store',
                                                 'rule'=>'form'))
                                                 }}
                <div class="box-body">

                @include('dashboard.partials._alerts')
                @include('users.form')
                </div><!-- /.box-body -->
            {{ Form::close() }}
        </div><!-- /.box -->
    </section><!-- /.content -->
@endsection