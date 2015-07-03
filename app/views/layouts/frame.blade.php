<!DOCTYPE html>
<html>
<head>
	<title></title>
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap-theme.min.css') }}
	{{ HTML::style('css/bootstrap-chosen/bootstrap-chosen.css') }}
	{{ HTML::style('css/daterangepicker/daterangepicker-bs3.css') }}


	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	{{ HTML::script('js/jquery.maskedinput.js') }}
	{{ HTML::script('js/plugins/daterangepicker/daterangepicker.js') }}
	{{ HTML::script('css/bootstrap-chosen/chosen.jquery.js') }}
	{{ HTML::script('js/scripts.js') }}
	{{ HTML::script('js/conf.js') }}
	{{ HTML::script('js/plugins/formValidation/js/formValidation.js') }}
	{{ HTML::script('js/plugins/formValidation/js/framework/bootstrap.js') }}

	@yield('scripts')

	</head>

	<body>
		@yield('frame')
	</body>

</html>

