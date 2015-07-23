@extends('dashboard.index')

@section('main')

    <section class="content PermissaoCtrl">
        <div class="box" ng-app="App" ng-controller="PermissaoCtrl">
            <div class="box-header">
                <h3 class="box-title">Permissões do Sistema<br />
                    <small>Usuario: {{ $usuario->user }}</small>
                </h3>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-bordered table-hover">
                    @foreach($menus as $menu)
                    <tr>
                        <th>{{ $menu->descricao  }}</th>

                        <th>{{ Form::checkbox('menu', $menu->id, $menu->permite($usuario),array('class'=>'form-controll')) }}</th>
                    </tr>

                        @foreach($menu->subMenus as $sub)
                        <tr>
                            <td>{{ $sub->descricao }}</td>
                            <td>{{ Form::checkbox('menu', $sub->id, $sub->permite($usuario) ,array('class'=>'form-controll')) }}</td>
                         </tr>
                        @endforeach

                    @endforeach

                </table>
            </div><!-- /.box-body -->

            <div class="well">

                {{ link_to_route('users.edit','Voltar', $usuario->id, array('class'=>'btn btn-danger')) }}
            </div>
        </div><!-- /.box -->

    </section><!-- /.content -->

@endsection

@section('scripts')
<script>
    $(function(){
        $('input[name=menu]').bind('click', function(){
            $.post('/users/permissao', {usuario_id: {{ $usuario->id }}, menu_id: $(this).val() }, function(data){
                console.log(data)
            })
        })
    })
</script>
@stop