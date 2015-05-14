<!DOCTYPE html>
<html>
<head>
	<title></title>
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-theme.min.css') }}
	{{ HTML::style('css/styles.css') }}
	</head>
<body>
	@yield('frame')


{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/jquery.maskedinput.js') }}
{{ HTML::script('js/scripts.js') }}
{{ HTML::script('js/conf.js') }}

@yield('scripts')
</body>
</html>

