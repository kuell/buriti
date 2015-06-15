
<!DOCTYPE html>
<html>
<head>
	<title></title>
	{{ HTML::style('css/bootstrap.css')}}
	{{ HTML::script('js/jquery.min.js')}}
</head>
<body>

<div class="row">
	{{ Form::open(['name'=>'elementos', 'class'=>'form'])}}
	<div class="col-md-12">
		<div class="col-md-1">
			<label class="form-label">Elemento: </label>
		</div>
		<div class="form-group col-md-3">
			{{ Form::select('elemento[]', ['0'=>'Selecione ...']+FarmaciaElemento::whereNull('elemento_pai')->lists('descricao', 'id'), 0, ['class'=>'form-control', 'id'=>'elemento1'] ) }}
		</div>
		<div class="col-md-3">
			{{ Form::select('elemento[]', [], null, ['class'=>'form-control hidden', 'id'=>'elemento2']) }}
		</div>
		<div class="col-md-3">
			{{ Form::select('elemento[]', [], null, ['class'=>'form-control hidden', 'id'=>'elemento3']) }}
		</div>
		<div class="col-md-3">
			{{ Form::select('elemento[]', [], null, ['class'=>'form-control hidden', 'id'=>'elemento4']) }}
		</div>

		<div class="col-md-3 hidden" id="elemento_add">
			<div class="col-md-12">
				{{ Form::text('elemento_add',  null, ['class'=>'form-control']) }}
				{{ Form::button('Inclui', ['class'=>'btn btn-primary btn-sm', 'id'=>'incluir'])}}
			</div>
		</div>
	</div>
	{{ Form::close() }}

	<div class="col-md-12">
		<ul>
		@foreach($elementos as $elemento)
			<li>{{ $elemento->descricao }} </li>
		@endforeach
		</ul>

	</div>

</div>

<script type="text/javascript">
	$(function(){
		$('#incluir').click(function() {
			form = $('form[name=elementos]').serializeArray()

			$.post('/farmacia/ocorrencias/elementos', {form}, function(data){
				console.log(data)
			});
		});

		$('#elemento1, #elemento2, #elemento3, #elemento4').change(function() {
		if($(this).val() == ''){
			$("#elemento_add").removeClass('hidden')
		}

		if($(this)[0].id == 'elemento1'){
			elemento = '#elemento2';
		}
		if($(this)[0].id == 'elemento2'){
			elemento = '#elemento3';
		}
		if($(this)[0].id == 'elemento3'){
			elemento = '#elemento4';
		}

		options = '<option value="0"> Selecione ...</option> <option value=""> + Novo</option>';

		$.getJSON("/farmacia/ocorrencias/elemento/"+$(this).val(), null, function(data) {


			if(data.length != 0){
				for (var i = 0; i < data.length; i++) {
						options += '<option value="' + data[i].id + '">' + data[i].descricao + '</option>';
					}
				$(elemento).html(options).removeClass('hidden')
			}
			else{
				$("#elemento_add").removeClass('hidden')
			}
		});
	})
})
</script>
</body>
</html>