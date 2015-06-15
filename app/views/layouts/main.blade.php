<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>SIG | Frizelo Frigorificos Ltda.</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    {{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-chosen/bootstrap-chosen.css') }}
    <!-- font Awesome -->
    {{ HTML::style('css/font-awesome.min.css') }}
    <!-- Ionicons -->
    {{ HTML::style('css/ionicons.min.css') }}
    <!-- Theme style -->
    {{ HTML::style('css/AdminLTE.css') }}
	{{ HTML::style('css/styles.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->
      </head>
      <body class="skin-black">

        <!-- header logo: style can be found in header.less -->
        <header class="header">
                @include('dashboard.partials._menu_topo')
        </header>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                @include('dashboard.partials._menu_lateral')
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <section class="content-header">
                    <h1>S.I.G.
                        <small>
                            Sistemas Integrados para Gerenciamento.
                        </small>
                    </h1>
                </section>
                <section class="content">
                    <div class="row">
                        @foreach(Auth::user()->menus as $menu)
                            @if(!$menu->menu->menu_pai)
                             <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-{{ $menu->menu->color }}">
                                    <div class="inner">
                                        <h4>
                                        {{ $menu->menu->descricao }}
                                        </h4>
                                        <p class="lead">
                                            {{ $menu->menu->indice }}
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="{{ $menu->menu->icone }}"></i>
                                    </div>
                                    <a href="{{ $menu->menu->url }}" class="small-box-footer">
                                        Entrar <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div><!-- ./col -->
                            @endif
                        @endforeach

                        @yield('main')
                    </div>
                </section>

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        @include('dashboard.partials._modal_suporte')

        @include('dashboard.partials._scripts_js')
        <section class="content">
            @yield('scripts')
        </section>
        <script type="text/javascript">
            $(function(){
                $('.data').mask('99/99/9999');
            })
        </script>

    </body>
    </html>
