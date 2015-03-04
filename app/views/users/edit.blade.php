@extends('dashboard.index')


@section('main')
    <div class="box box-info">
        {{ HTML::head('Fornecedores ', 'controla fornecedores!') }}
        {{ HTML::boxhead('Altera Usuario '.$user->id) }}

         <div class="box-body">
            {{ link_to('/users/user/permissao/'.$user->id, 'Permissao', array('class'=>'btn btn-primary')) }}
            {{ Form::model($user, array('method' => 'PATCH',
                                                 'route' => array('users.user.update', $user->id) ,
                                                 'rule'=>'form',
                                                 'enctype'=>'multipart/form-data'))
                                                 }}
                @include('users.form')
            {{ Form::close() }}
         </div>
    </div>

@stop
