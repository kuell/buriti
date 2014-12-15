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
<?php $p = false;?>
<tr>
                            @foreach($usuario->menus as $usuarioMenu)
                                @if($usuarioMenu->menu->id == $menu->id)
<?php $p = true?>
@endif

                            @endforeach
                            <th>{{ $menu->descricao  }}</th>
                            <th>{{ Form::checkbox('menu', $menu->id, $p ,array('class'=>'form-controll',
                                                                               'ng-click'=>'save('.$menu->id.')')) }}</th>
                         </tr>
                         @if(count($menu->subMenus))
                            @foreach($menu->subMenus as $sub)
                            <tr>
<?php $ps = false;?>
@foreach($usuario->menus as $usuarioMenu)
                                    @if($usuarioMenu->menu->id == $sub->id)
<?php $ps = true;?>
                                    @endif
                                @endforeach
                                <td>{{ $sub->descricao }}</td>
                                <td>{{ Form::checkbox('menu', $menu->id, $ps ,array('class'=>'form-controll', 'ng-click'=>'save('.$sub->id.')')) }}</td>
                             </tr>
                            @endforeach
                         @endif
                    @endforeach

                </table>
            </div><!-- /.box-body -->

            <div class="well">

                {{ link_to_route('acesso.user.edit','Voltar', $usuario->id, array('class'=>'btn btn-danger')) }}
            </div>
        </div><!-- /.box -->

    </section><!-- /.content -->

@endsection

@section('scripts')
   {{ HTML::script('js/angular.min.js') }}
    <script>
        var App = angular.module('App',[]);
        App.config(function($interpolateProvider) {
              $interpolateProvider.startSymbol('<%');
              $interpolateProvider.endSymbol('%>');
        });

        function PermissaoCtrl($scope, $http, $window){
            $scope.save = function(menu_id){
                $scope.obj.menu_id = menu_id;
                $http.post('/acesso/user/menu/', $scope.obj)
                    .success(function(data){
                        $window.console.log(data);
                        });

            }

                var init = function(){
                    $scope.obj = {menu_id: 0, usuario_id: {{ $usuario->id }} }
                };

                init();
        };
      </script>
@stop