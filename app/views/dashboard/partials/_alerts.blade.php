@if (Session::has('message'))
	<div class="alert alert-danger alert-dismissable">
	    <i class="fa fa-ban"></i>
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    <b>{{ Session::get('message') }}</b>
	    	@if ($errors->any())
				<ul>
					{{ implode('', $errors->all('<li class="error">:message</li>')) }}
				</ul>
			@endif
	</div>
@endif