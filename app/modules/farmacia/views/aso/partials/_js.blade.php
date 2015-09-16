
{{-- Carrega os campos referente ao colaborador --}}
	@if(!empty($aso->colaborador_setor_id))

	<script type="text/javascript">
		//Busca Posto //
		$.get('/setors/find/'+{{ $aso->colaborador_setor_id }}+'/postoTrabalho ', function(data) {

			$("select[name=posto_id] option").remove();

			if(data.length > 0){

				var options = "<option>Selecione ...</option>";

				$.each(data, function(key, val){
					options += '<option value="' + val.id + '">' + val.descricao + '</option>';
				})

				$("select[name=posto_id]").append(options);
				$("select[name=posto_id]").val({{ $aso->posto_id }});
			}
			else{
				$("select[name=posto_id]").append('<option>Nenhum Informado ...</option>');
				$("select[name=posto_id]").attr('disabled', 'disabled');
			}
		});

		//Buscar Função pelo //

		$.get('/setors/find/'+{{ $aso->colaborador_setor_id }}+'/funcao ', function(data) {
			$("select[name=colaborador_funcao_id] option").remove();

			if(data.length > 0){

				var options = "<option>Selecione ...</option>";

				$.each(data, function(key, val){
					options += '<option value="' + val.id + '">' + val.descricao + '</option>';
				})

				$("select[name=colaborador_funcao_id]").append(options);
				$("select[name=colaborador_funcao_id]").val({{ $aso->colaborador_funcao_id }});
			}
			else{
				$("select[name=colaborador_funcao_id]").append('<option>Nenhum Informado ...</option>');
				$("select[name=colaborador_funcao_id]").attr('disabled', 'disabled');
			}
		});

		$('select[name=colaborador_setor_id').val( {{ $aso->colaborador_setor_id }})

	</script>
	@endif
{{-- FIM Carrega os campos referente ao colaborador --}}


{{--  Configuração geral do formulario --}}

	<script type="text/javascript">
		$(function(){
			$('select[name=colaborador_setor_id]').bind('change blur', function() {
							//Busca Posto //
				$.get('/setors/find/'+$(this).val()+'/postoTrabalho ', function(data) {

					$("select[name=posto_id] option").remove();

					if(data.length > 0){

						var options = "<option>Selecione ...</option>";

						$.each(data, function(key, val){
							options += '<option value="' + val.id + '">' + val.descricao + '</option>';
						})

						$("select[name=posto_id]").append(options);
						$("select[name=posto_id]").removeAttr('disabled', 'disabled');
					}
					else{
						$("select[name=posto_id]").append('<option>Nenhum Informado ...</option>');
						$("select[name=posto_id]").attr('disabled', 'disabled');
					}
				});

				//Buscar Função pelo //

				$.get('/setors/find/'+$(this).val()+'/funcao ', function(data) {
					$("select[name=colaborador_funcao_id] option").remove();

					if(data.length > 0){

						var options = "<option>Selecione ...</option>";

						$.each(data, function(key, val){
							options += '<option value="' + val.id + '">' + val.descricao + '</option>';
						})

						$("select[name=colaborador_funcao_id]").append(options);
						$("select[name=colaborador_funcao_id]").removeAttr('disabled', 'disabled');
					}
					else{
						$("select[name=colaborador_funcao_id]").append('<option>Nenhum Informado ...</option>');
						$("select[name=colaborador_funcao_id]").attr('disabled', 'disabled');
					}
				});

			});
		})
	</script>

{{--  Fim Configuração geral do formulario --}}

{{-- Se a Aso for Mudança de Função --}}

@if($aso->tipo == 'mudanca de funcao')

<script type="text/javascript">
	$(function(){
		$('select[name=colaborador_setor_id], select[name=colaborador_funcao_id], select[name=posto_id] ').removeAttr('disabled')
	})


</script>

@endif
{{-- Fim Mudança de Função --}}