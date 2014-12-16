@extends('dashboard.index')

@section('main')

  		{{ HTML::head('Atestados', 'controla os atestados') }}
  		{{ HTML::boxhead('Editar atestado: '.$atestado->id) }}

  	<div class="box-body">

    	{{ Form::model($atestado, array('method' => 'PATCH',
                                                     'route' => array('farmacia.atestados.update', $atestado->id) ,
                                                     'rule'=>'form'))
                                                     }}
    		@include('farmacia.atestados.form')
    	{{ Form::close() }}
    </div>

@endsection