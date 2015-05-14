<!-- BEGIN CONTENT -->
@if (Session::has('message'))
		@if(!$errors->all())
<?php
$tipo = 'success';
?>
@else
<?php
$tipo = 'warning';
?>
@endif
	<div class="alert alert-{{ $tipo }} fade in">
		<button type="button" class="btn close" data-dismiss="alert" aria-hidden="true">
			×
		</button>
		<strong>
			{{ Session::get('message') }}
		</strong>
		@if ($errors->any())
			<ul>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</ul>
		@endif
	</div>
@endif
<!-- END CONTENT -->
