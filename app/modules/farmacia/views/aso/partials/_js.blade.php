@section('scripts')
	<script type="text/javascript">
		$(function(){

			$('select[name=colaborador_setor_id]').chosen().change(function() {
				$.getJSON('/setors/find/'+$(this).val()+'/postoTrabalho', function(data){

					if(data.length > 0){
						var options = "<option>Selecione ...</option>";

						$.each(data, function(key, val){
						console.log(val);
							options += '<option value="' + val.id + '">' + val.descricao + '</option>';
						})

						$("select[name=posto_id]").html(options);
						}


					})
				})


			$('.colaborador').html('{{ Form::text('colaborador_nome', null, ['class'=>'form-control', 'placeholder'=>'Nome do Colaborador'])}}')

			$('#tipo_aso').focus().bind('change blur', function(){
				if($(this).val() != 'admissional'){
					$('.colaborador').html('{{ Form::select('colaborador_id', [''=>'Selecione o colaborador']+Colaborador::all()->lists('nome', 'id'), null, ['class'=>'form-control'])}}')
					$('input[name=colaborador_data_nascimento], select[name=colaborador_sexo], select[name=colaborador_setor_id]').attr('disabled', 'disabled');
					$('select[name=colaborador_setor_id]').prop('disabled', true).trigger("chosen:updated");


				$('select[name=colaborador_id]').chosen().change(function() {
						$.get('/colaboradors/find/'+$(this).val(), {}, function(data){
							$('input[name=colaborador_data_nascimento]').val(data.data_nascimento)
							$('input[name=colaborador_sexo]').val(data.sexo)
							$('input[name=colaborador_setor_id]').val(data.setor_id)
						})
					});

				}
				else{
					$('.colaborador').html('{{ Form::text('colaborador_nome', null, ['class'=>'form-control', 'placeholder'=>'Nome do Colaborador'])}}')
					$('input[name=colaborador_data_nascimento], select[name=colaborador_sexo], select[name=colaborador_setor_id]').removeAttr('disabled');
					$('select[name=colaborador_setor_id]').prop('disabled', false).trigger("chosen:updated");
				}
			});
		});
	</script>

	@if(!empty($aso))


	<script type="text/javascript">
		$(function(){
			$('.confirma').bind('click', function() {
					aso = {{ $aso->id }}
					matricula = $('input[name=colaborador_matricula').val()

					$.post("{{ URL::route('farmacia.aso.confirma', $aso->id) }}", {aso:aso, matricula:matricula, classifica:$(this).val()},
						function(data) {
							$('#progress').find('progress-bar').addClass('animate');
							$('#progress').modal('show')
							window.location = "{{ URL::route('farmacia.aso.index') }}"
						});
				});

			@if(!empty($aso->colaborador_id))
				$('select[name=colaborador_setor_id]').prop('disabled', true).trigger("chosen:updated");
				$('select[name=colaborador_id]').prop('disabled', true).trigger("chosen:updated");
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


})
	</script>

	@else

		<script type="text/javascript">

		</script>

	@endif

@stop