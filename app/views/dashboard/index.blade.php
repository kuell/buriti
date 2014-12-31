<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>SIG | Frizelo Frigorificos Ltda.</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    {{ HTML::style('css/bootstrap.min.css') }}
    <!-- font Awesome -->
    {{ HTML::style('css/font-awesome.min.css') }}
    <!-- Ionicons -->
    {{ HTML::style('css/ionicons.min.css') }}
    <!-- Theme style -->
    {{ HTML::style('css/AdminLTE.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->
      </head>
      <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->

        @include('dashboard.partials._menu_topo')

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            @include('dashboard.partials._menu_lateral')

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <div class="col-md-12">
                    @yield('main')
                </div>

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        @include('dashboard.partials._scripts_js')

        @yield('scripts')

        <script type="text/javascript">
            $(function(){
                $('.data').mask('99/99/9999');
            })
        </script>

    </body>
    </html>
