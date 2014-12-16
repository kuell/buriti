@extends('dashboard.index')

@section('main')

            {{ HTML::head('Usuarios ', 'controla usuarios!') }}
            {{ HTML::boxhead('Lista', '/acesso/user/create') }}

            <div class="box-body">
                <ul class="todo-list">
                @foreach($usuarios as $user)
                    <li>
                        <!-- drag handle -->
                        <span class="handle">
                            <i class="fa  fa-user"></i>
                        </span>
                        <!-- todo text -->
                        <span class="text">{{ $user->nome }}</span>
                        <!-- Emphasis label -->
                        <small class="label label-danger">Login: {{ $user->user }}</small>
                        <!-- General tools such as edit or delete-->
                        <div class="tools">
                            <a href="/acesso/user/{{ $user->id }}/edit"><i class="fa fa-edit"></i></a>
                        </div>
                    </li>
                @endforeach
                </ul>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

@endsection