@extends('dashboard.index')

@section('main')
	<section class="content">
    {{ HTML::head('Colaboradores', 'controla os colaboradores') }}
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Colaboradores</h3>
                    <div class="box-footer clearfix no-border">
                        {{ Form::adicionar('/cadastro/colaborador/create') }}
                </div>
             </div><!-- /.box-header -->
             <div class="box-body">
                @include('cadastro.colaboradores.lista')
             </div>
@endsection