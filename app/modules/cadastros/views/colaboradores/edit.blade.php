@extends('dashboard.index')

@section('main')

{{ HTML::head('Colaboradores', 'controla os colaboradores') }}
{{ HTML::boxhead('Editar Colaborador: '.$colaborador->nome) }}

<div class="box-body">

	{{ Form::model($colaborador, array('method' => 'PATCH',
   'route' => array('cadastro.colaborador.update', $colaborador->id) ,
   'rule'=>'form'))
 }}
 @include('cadastros::colaboradores.form')
 {{ Form::close() }}
</div>

@endsection