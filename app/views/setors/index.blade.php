@extends('dashboard.index')

@section('main')
	<section class="content">
    {{ HTML::head('Setores', 'controla os setores') }}
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Setores</h3>
                    <div class="box-footer clearfix no-border">
                        {{ Form::adicionar('/cadastro/setor/create') }}
                </div>
             </div><!-- /.box-header -->
             <div class="box-body">
                @include('setors.lista')
             </div>
@endsection