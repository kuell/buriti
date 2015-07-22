@extends('dashboard.index')

@section('main')
{{ Form::model($ficha, array('route' => 'fichas.store', 'rule'=>'form', 'files'=>true)) }}

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Criar uma nova ficha</h3>
		</div>

		<div class="panel-body">
			@if (Session::has('message'))
				@if($errors->all())

				<div class="alert alert-danger fade in">
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
			@endif


			@include('cadastros::fichas.form')
		</div>
		<div class="panel-footer">
			{{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}
			{{ link_to_route('fichas.index', 'Voltar', null, ['class'=>'btn btn-danger']) }}
		</div>
	</div>
	{{ Form::close() }}


<script type="text/javascript">
	$(function() {
		$('button[name=print]').bind('click', function(){
			window.open('/fichas/'+$(this).val(), 'Print', 'channelmode=yes')
		})
	})
</script>
@endsection