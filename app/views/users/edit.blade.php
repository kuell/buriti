@extends('dashboard.index')


@section('main')
    {{ HTML::head('Fornecedores ', 'controla fornecedores!') }}
    {{ HTML::boxhead('Altera Usuario '.$user->id) }}

     <div class="box-body">
        {{ link_to('/acesso/user/menu/'.$user->id, 'Permissao', array('class'=>'btn btn-primary')) }}
            {{ Form::model($user, array('method' => 'PATCH',
                                                 'route' => array('acesso.user.update', $user->id) ,
                                                 'rule'=>'form',
                                                 'enctype'=>'multipart/form-data'))
                                                 }}
                @include('users.form')
            {{ Form::close() }}
     </div>

@stop
