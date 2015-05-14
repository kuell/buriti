@extends('dashboard.index')

@section('main')
<div class="box box-info">
    {{ HTML::head('Colaboradores', 'controla os colaboradores') }}
    {{ HTML::boxhead('Editar Colaborador: '.$colaborador->nome) }}

    <div class="box-body">

        {{ Form::model($colaborador, array('method' => 'PATCH',
       'route' => array('colaboradors.update', $colaborador->id) ,
       'rule'=>'form'))
     }}
     @include('cadastros::colaboradores.form')
     {{ Form::close() }}
    </div>
</div>
@endsection