<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>::: {{ ucfirst(Request::segment(1)) }} :::</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-theme.min.css') }}
	{{ HTML::style('css/bootstrap-chosen/bootstrap-chosen.css') }}
	{{ HTML::style('css/daterangepicker/daterangepicker-bs3.css') }}
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    {{ HTML::style('css/styles.css') }}

    @include('dashboard.partials._scripts_js')

    @yield('scripts')

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top col-md-12" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Modulo: {{ ucfirst(Request::segment(1)) }}</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="glyphicon glyphicon-user"></i> {{ Auth::user()->nome }}</a> </li>
                <li><a href="#" id="ajuda"><i class="glyphicon glyphicon-question-sign"></i> Precisa de ajuda?</a> </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid col-md-12">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-sm-3 col-md-2 sidebar" id="sidebar" role="navigation">
            <ul class="nav nav-sidebar">
                <li class="well-sm">Menu</li>
                @foreach(Session::get('menus')->first()->menu->subMenus as $menu)
					@if(UsuarioPermissao::where('menu_id', $menu->id)->where('usuario_id', Auth::user()->id)->count() != 0)

                    <li>
                        <a href="{{ Session::get('menus')->first()->menu->url. '/'. $menu->url }}" >
                            <i class="{{ $menu->icone }}"></i>
                            <span>{{ $menu->descricao  }}</span>
                        </a>
                    </li>
					@endif
                @endforeach
                    <li><a href="/">Sair</a></li>
            </ul>

        </div><!--/span-->

        <div class="col-sm-9 col-md-10 main">

            <!--toggle sidebar button-->
            <p class="visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">
                    <i class="glyphicon glyphicon-chevron-left"></i></button>
            </p>
			@include('layouts.erros')
            @yield('content')

        </div><!--/row-->
    </div>
</div><!--/.container-->

<footer>
    <p class="pull-right"></p>
</footer>

<!-- script references -->

@include('dashboard.partials._modal_suporte')

<script type="text/javascript">
    $(function(){
        $('#ajuda').click(function() {
             window.open('http://10.1.1.248:81', 'Ajuda', 'width=400px, height=390px')
        });
    })
</script>

</body>
</html>