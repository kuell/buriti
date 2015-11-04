
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>::: {{ ucfirst(Request::segment(1)) }} :::</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    {{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/styles.css') }}

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


<!-- script references -->

<!-- jQuery 2.0.2 -->
    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('css/bootstrap-chosen/chosen.jquery.js') }}
    {{ HTML::script('js/jquery.maskMoney.js') }}
    {{ HTML::script('js/jquery.maskedinput.js') }}

 <!-- Bootstrap -->
    {{ HTML::script('js/bootstrap.min.js') }}
 <!-- AdminLTE App -->
    {{ HTML::script('js/AdminLTE/app.js') }}
 <!-- AdminLTE for demo purposes -->
    {{-- HTML::script('js/AdminLTE/demo.js') --}}
    {{ HTML::script('js/plugins/daterangepicker/daterangepicker.js') }}
    {{ HTML::script('js/plugins/formValidation/js/formValidation.js') }}
    {{ HTML::script('js/plugins/formValidation/js/framework/bootstrap.js') }}

    {{ HTML::script('js/plugins/datatables/jquery.dataTables.js') }}
    {{ HTML::script('js/plugins/datatables/dataTables.bootstrap.js') }}
<!-- Configuração -->
    {{ HTML::script('js/conf.js') }}

<!-- end script references -->

@yield('scripts')

</head>
<body>
    @yield('modal')
</body>
</html>