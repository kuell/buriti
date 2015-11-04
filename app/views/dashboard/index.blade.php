<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>SIG | Buriti Carnes.</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    {{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-chosen/bootstrap-chosen.css') }}

    <!-- font Awesome -->
    {{ HTML::style('css/font-awesome.min.css') }}
    <!-- Ionicons -->
    {{ HTML::style('css/ionicons.min.css') }}
    <!-- Theme style -->
	{{ HTML::style('css/daterangepicker/daterangepicker-bs3.css') }}

    {{ HTML::style('css/AdminLTE.css') }}


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->

@include('dashboard.partials._scripts_js')

@yield('scripts')

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

            <aside class="right-side col-md-10 col-sm-10 col-xs-10">

                @if(Request::segment(1) == 'dashboard')
                    @include('dashboard.partials._menu_body')
                @else
                    @yield('main')
                @endif
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        @include('dashboard.partials._modal_suporte')


        <script type="text/javascript">
            $(function(){
                $('.data').mask('99/99/9999');
            })

        </script>

    </body>
    </html>
