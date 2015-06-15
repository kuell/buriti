@extends('dashboard.index')

@section('main')
<section class="content">
    {{ HTML::head('Setores', 'controla os setores') }}
    <div class="box box-primary">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h4 class="box-title">Setores</h4>
            <div class="clearfix no-border">
                   {{ Form::adicionar('/setors/create') }}
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('cadastros::setors.lista')
        </div>
    </div>
</section>
@endsection