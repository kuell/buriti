@extends('dashboard.index')

@section('main')

{{ HTML::head('Ocorrencias', 'controla os setores') }}
{{ HTML::boxhead('Editar ocorrencia: '.$ocorrencia->id) }}

<div class="box-body">

	{{ Form::model($ocorrencia, array('method' => 'PATCH',
   'route' => array('farmacia.ocorrencias.update', $ocorrencia->id) ,
   'rule'=>'form'))
 }}
 @include('farmacia::ocorrencias.form')
 {{ Form::close() }}
</div>

@endsection