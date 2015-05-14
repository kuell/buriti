
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

</head>
<body>
	@yield('modal')

<!-- script references -->
{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/jquery.maskedinput.js') }}
{{ HTML::script('js/scripts.js') }}
{{ HTML::script('js/conf.js') }}

@yield('scripts')

</body>
</html>