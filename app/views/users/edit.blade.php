@extends('dashboard.index')


@section('main')

    <div class="box box-info">
        {{ HTML::head('Usuarios ', 'controla usuarios do sistema!') }}
        {{ HTML::boxhead('Altera Usuario '.$user->id) }}

         <div class="box-body">
            {{ Form::model($user, array('method' => 'PATCH',
                                                'route' => array('users.update', $user->id) ,

                                                'enctype'=>'multipart/form-data',
												'id'=>'user' ))
                                                 }}
                @include('users.form')
            {{ Form::close() }}
         </div>
    </div>

@stop

@section('scripts')

@stop
