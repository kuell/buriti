@section('scripts')
	<script type="text/javascript">
		$(function(){
			$('#tipo_aso').bind('change blur', function(){
				if($(this).val() != 'admissional'){
					$('input[name=codigo_interno').removeAttr('disabled', 'disabled');
					$('input[name=nome').attr('disabled', 'disabled').val('');
				}
				else{
					$('input[name=codigo_interno').attr('disabled', 'disabled').val('');
					$('input[name=nome').removeAttr('disabled', 'disabled').val('');
					$('input[name=data_nascimento').removeAttr('disabled', 'disabled').val('');
				}
			});
			$('select[name=setor_id]').bind('change load', function(){
				setor_id = $(this).val();

				$.getJSON('/farmacia/aso/postos/'+setor_id, null, function(data) {
						options = '<option value="">Selecione ...</option>';
						if(data.length != 0){
							for (var i = 0; i < data.length; i++) {
									options += '<option value="' + data[i].id + '">' + data[i].descricao + '</option>';
								}
							$('select[name=posto_id]').html(options)
						}
						else{
							$('select[name=posto_id]').html(options)
						}
						});
				});

		});
	</script>

	@if(!empty($aso))


	<script type="text/javascript">
		$(function(){

			$('#tipo_aso, input[name=medico], input[name=nome]').attr('disabled', 'disabled');
			$("input[name=risco]").click(function() {
					tipo = $(this).prop('checked');

					$.post('/farmacia/aso/risco/'+tipo, {aso_id: {{ $aso->id }}, risco_id: $(this).val() }, function(data){
						console.log(data)
					})

				});

			@if($aso->tipo == 'admissional')

				$('input[name=codigo_interno]').removeAttr('disabled');
			@else
				$('input[name=nome]').attr('disabled', 'disabled');
				$('input[name=codigo_interno]').attr('disabled', 'disabled');
			@endif

			$('input[name=codigo_interno]').blur(function(event) {
				if($(this).val() != null && $(this).val() != 0){
					$.get('/colaboradors/find/'+$(this).val(), null, function(data){
						if(data.id != null){
							console.log(data)
								alert('Código ja utilizado!')
								$('input[name=codigo_interno]').focus();
							}
					})
				}
			}).val({{ $ocorrencia->colaborador->codigo_interno or null }});


			$.getJSON('/farmacia/aso/postos/'+{{ $aso->setor_id }}, null, function(data) {
						options = '<option value="">Selecione ...</option>';
							if(data.length != 0){
								for (var i = 0; i < data.length; i++) {
										options += '<option value="' + data[i].id + '">' + data[i].descricao + '</option>';
									}
								$('select[name=posto_id]').html(options)
							}
							else{
								$('select[name=posto_id]').html(options)
							}

						$('select[name=posto_id]').val({{ $aso->posto_id }})

						});

})
	</script>

	@else

		<script type="text/javascript">
			$(function(){

				$('input[name=codigo_interno]').blur(function(event) {
					if($(this).val() != null){
						$.get('/colaboradors/find/'+$(this).val(), null, function(data){
							if(data.id == null){
								$('input[name=codigo_interno]').val('');
								$('input[name=nome]').val('');

								alert("Código interno do colaborador não encontrado!")
							}
							else{
								$('input[name=nome]').val(data.nome).attr('disabled', 'disabled');
								$('input[name=data_nascimento]').val(data.data_nascimento)
								$('select[name=sexo]').val(data.sexo);
								$('select[name=setor_id]').val(data.setor_id);
								$('select[name=posto_id]').val(data.postoTrabalho)
							}
						})
					}
				}).val({{ $ocorrencia->colaborador->codigo_interno or null }});
			})

		</script>

	@endif

@stop