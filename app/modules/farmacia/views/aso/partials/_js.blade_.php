@section('scripts')

	<script type="text/javascript">

		$(function(){
			$('input[name=colaborador_orgao_emissor]').mask('aaa/aa')
			$('input[name=colaborador_matricula]').bind('blur', function(){
				if($(this).val() != ''){
					$.get('/colaboradors/find/'+$(this).val(), function(data) {
						if(data){
							console.log(data)
							alert('Matricula ja cadastrada!\nNome: '+data.nome+'\nData de Admissão: '+data.data_admissao)
							$('input[name=colaborador_matricula]').focus()
						}
					});
				}
			})

			$('select[name=colaborador_setor_id]').chosen().change(function() {
				$.getJSON('/setors/find/'+$(this).val()+'/postoTrabalho', function(data){

					if(data.length > 0){
						var options = "<option>Selecione ...</option>";

						$.each(data, function(key, val){
							options += '<option value="' + val.id + '">' + val.descricao + '</option>';
						})

						$("select[name=posto_id]").append(options);
						$('select[name=posto_id]').chosen()

						}


					})
				})


			$('.colaborador').html('{{ Form::text('colaborador_nome', null, ['class'=>'form-control', 'placeholder'=>'Nome do Colaborador', 'required'])}}')

			$('#tipo_aso').focus().bind('change blur', function(){
				if($(this).val() != 'admissional'){
					$('.colaborador').html('{{ Form::select('colaborador_id', [''=>'Selecione o colaborador']+Colaborador::ativos()->lists('nome', 'id'), null, ['class'=>'form-control', 'id'=>'colaborador_id', 'required'])}}')
					$('input[name=colaborador_data_nascimento], select[name=colaborador_sexo], select[name=colaborador_setor_id]').attr('disabled', 'disabled');



					$('select[name=colaborador_id]').chosen().change(function() {
							$.get('/colaboradors/find/'+$(this).val(), {}, function(data){
								console.log(data.setor_id);
								$('input[name=colaborador_data_nascimento]').val(data.data_nascimento)
								$('input[name=colaborador_sexo]').val(data.sexo)
								$('select[name=colaborador_setor_id]').val(data.setor_id).trigger('chosen:updated');

								$.getJSON('/setors/find/'+data.setor_id+'/postoTrabalho', function(d){
									console.log(d)
									if(d.length > 0){
										var options = "<option>Selecione ...</option>";

										$.each(d, function(key, val){
											options += '<option value="' + val.id + '">' + val.descricao + '</option>';
										})

										$("select[name=posto_id]").append(options);
										$('select[name=posto_id]').val().chosen()

										}
								})
						});
					//$('select[name=colaborador_setor_id]').prop('disabled', true).trigger("chosen:updated");

					})
				}
				else{
					$('.colaborador').html('{{ Form::text('colaborador_nome', null, ['class'=>'form-control', 'placeholder'=>'Nome do Colaborador'], 'required')}}')
					$('input[name=colaborador_data_nascimento], select[name=colaborador_sexo], select[name=colaborador_setor_id]').removeAttr('disabled');
					$('select[name=colaborador_setor_id]').prop('disabled', false).trigger("chosen:updated");
				}
			});
		});
	</script>

	@if(!empty($aso))


	<script type="text/javascript">
		$(function(){

			@if(!empty($aso->colaborador_id))
				$('select[name=colaborador_setor_id]').prop('disabled', true).trigger("chosen:updated");
				$('#colaborador_id').prop('disabled', true).trigger("chosen:updated");
				$('input[name=colaborador_nome], input[name=colaborador_data_nascimento], select[name=colaborador_sexo], select[name=colaborador_setor_id]').attr('disabled', 'disabled');
			@endif

			$('#tipo_aso, input[name=medico] ').attr('disabled', 'disabled');
			$("input[name=risco]").click(function() {
					tipo = $(this).prop('checked');

					$.post('/farmacia/aso/risco/'+tipo, {aso_id: {{ $aso->id }}, risco_id: $(this).val() }, function(data){
						console.log(data)
					})

				});

			$.getJSON('/setors/find/{{ $aso->colaborador_setor_id }}/postoTrabalho', function(data){

					if(data.length > 0){
						var options = "<option value='0'>Selecione ...</option>";

						$.each(data, function(key, val){

							options += '<option value="' + val.id + '">' + val.descricao + '</option>';
						})

						$("select[name=posto_id]").html(options).val({{ $aso->posto_id }});
						}
					})

			$.getJSON('/setors/find/{{ $aso->colaborador_setor_id }}/funcao', function(data){

					if(data.length > 0){
						var options = "<option value='0'>Selecione ...</option>";

						$.each(data, function(key, val){

							options += '<option value="' + val.id + '">' + val.descricao + '</option>';
						})

						$("select[name=colaborador_funcao_id]").html(options).val({{ $aso->colaborador_funcao_id }});
						}
					})


})
	</script>

	@else

		<script type="text/javascript">

		</script>

	@endif

@stop