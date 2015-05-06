<fieldset>
	{{ Form::open(['route'=>'farmacia.aso.store', 'class'=>'form', 'name'=>'criar']) }}
	<h4>Informações do Colaborador</h4>
	<div class="col-md-12">
		<div class="form-group col-md-4">
			{{ Form::label('Tipo de A.S.O.: ')}}
			{{ Form::select('tipo', ['admissional'=>'Admissional', 'periodico'=>'Periodico', 'demissional'=>'Demissional', 'mudanca de funcao'=>'Mudança de Função', 'retorno ao trabalho'=>'Retorno ao Trabalho'], null, ['class'=>'form-control', 'id'=>'tipo_aso'])}}
		</div>
		<div class="form-group">
			<div class="form-group col-md-6">
				{{ Form::label('Médico: ')}}
				{{ Form::text('medico', null, ['class'=>'form-control'])}}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<div class="col-md-12">
				{{ Form::label('Matricula / Nome do Colaborador: ')}}
			</div>
			<div class="col-md-2">
				{{ Form::text('codigo_interno', null, ['class'=>'form-control', 'disabled'=>'disabled'])}}
			</div>
			<div class="col-md-10">
				{{ Form::text('nome', null, ['class'=>'form-control'])}}
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group col-md-2">
			{{ Form::label('Data Nascimento: ')}}
			{{ Form::text('data_nascimento', null, ['class'=>'form-control data'])}}
		</div>
		<div class="form-group col-md-2">
			{{ Form::label('Sexo: ')}}
			{{ Form::select('sexo',['1'=>'Masculino', '0'=>'Feminino'], null, ['class'=>'form-control'])}}
		</div>
		<div class="form-group col-md-4">
			{{ Form::label('Setor: ')}}
			{{ Form::select('setor_id', [''=>'Selecione ....']+Setor::all()->lists('descricao', 'id'),null, ['class'=>'form-control'])}}
		</div>
		<div class="form-group col-md-4">
			{{ Form::label('Posto de Trabalho: ')}}
			{{ Form::select('posto_id', ['0'=>'Selecione ....'], null, ['class'=>'form-control'])}}
		</div>
	</div>

	{{ Form::close() }}

</fieldset>

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
			$('input[name=codigo_interno]').removeAttr('disabled');
			$('input[name=nome]').attr('disabled', 'disabled');

			$('input[name=codigo_interno]').blur(function(event) {
				if($(this).val() != null){
					$.get('/colaboradors/'+$(this).val(), null, function(data){
						if(data && $('input[name=codigo_interno]') != 0 ){
							alert('Código ja utilizado!')
							$('input[name=codigo_interno]').val().focus();
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