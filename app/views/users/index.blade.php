@extends('dashboard.index')

@section('main')
<section class="content">
    <div class="box box-info">
            {{ HTML::head('Usuarios ', 'controla usuarios!') }}
            {{ HTML::boxhead('Lista', '/users/user/create') }}

            <div class="box-body">
                <ul class="todo-list">
                @foreach($usuarios as $user)
                    <li>
                        <!-- drag handle -->
                        <span class="handle">
                            <i class="fa fa-user"></i>
                        </span>
                        <!-- todo text -->
                        <span class="text">{{ $user->nome }}</span>
                        <!-- Emphasis label -->
                        <small class="label label-danger">Login: {{ $user->user }}</small>
                        <!-- General tools such as edit or delete-->
                        <div class="tools">
                            <a href="/users/{{ $user->id }}/edit"><i class="fa fa-edit"></i></a>
                        </div>
                    </li>
                @endforeach
                </ul>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
</section>

@endsection