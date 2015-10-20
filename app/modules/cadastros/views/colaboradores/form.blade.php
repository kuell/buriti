@include('dashboard.partials._alerts')

	<div class="form-group">
		<div class="col-md-12">
  			{{ Form::label('nome', 'Nome do Colaborador: ') }}
  			{{ Form::text('nome', null, array('class'=>'form-control', 'required') ) }}
  		</div>
	</div>
    <div class="form-group">
      	<div class="col-md-3">
        	{{ Form::label('sexo', 'Sexo: ') }}
        	{{ Form::select('sexo', array('1'=>'Masculino','0'=>'Feminino'),null, array('class'=>'form-control', 'required') ) }}
      	</div>

      	<div class="col-md-2">
        	{{ Form::label('data_nascimento', 'Data de Nascimento: ') }}
        	{{ Form::text('data_nascimento', null, array('class'=>'form-control data') ) }}
      	</div>
		<div class="col-md-3">
        	{{ Form::label('contato', 'Contato: ') }}
        	{{ Form::text('contato', null, array('class'=>'form-control') ) }}
      	</div>
    	<div class="col-md-4">
	        {{ Form::label('bairro', 'Bairro: ') }}
	        {{ Form::text('bairro', null, array('class'=>'form-control') ) }}
	    </div>

    </div>

    <div class="form-group">
    	<div class="col-md-12">
      		{{ Form::label('endereco', 'Endereço: ') }}
      		{{ Form::text('endereco', null, array('class'=>'form-control') ) }}
    	</div>
    </div>

    <div class="form-group">
	    <div class="col-md-12">
			<h3>Informações Adicionais</h3>
	    </div>
	</div>


    <div class="form-group">
      	<div class="col-md-4">
        	{{ Form::label('setor', 'Setor: ') }}
        	{{ Form::select('setor_id', array(""=>'Selecione ...')+Setor::all()->lists('descricao','id'), null, array('class'=>'form-control', 'required') ) }}
      	</div>

      	<div class="col-md-4">
        	{{ Form::label('posto_id', 'Posto de Trabalho: ') }}
        	{{ Form::select('posto_id', [], null, array('class'=>'form-control', 'required') ) }}
      	</div>

      	<div class="col-md-4">
        	{{ Form::label('funcao', 'Função: ') }}
        	{{ Form::select('funcao_id', [],null, array('class'=>'form-control') ) }}
      	</div>
	</div>

  	<div class="form-group">
      	<div class="col-md-3">
        	{{ Form::label('interno', 'O Colaborador é Interno? ') }}
        	{{ Form::select('interno', array('0'=>'NÃO', '1'=>'SIM'), null, array('class'=>'form-control', 'required') ) }}
      	</div>

      	<div class="col-md-2">
        	{{ Form::label('codigo_interno', 'Matricula: ') }}
        	{{ Form::text('codigo_interno', null, array('class'=>'form-control', 'required') ) }}
      	</div>
      	<div class="col-md-2">
            {{ Form::label('data_admissao', 'Data de Admissão: ') }}
            {{ Form::text('data_admissao', null, array('class'=>'form-control data') ) }}
       	</div>
       	<div class="col-md-3">
            {{ Form::label('situacao', 'Situação: ') }}
            {{ Form::select('situacao', ['ativo'=>'Ativo', 'demitido'=>'Demitido'], null, array('class'=>'form-control') ) }}
       	</div>
       	<div class="col-md-2">
       		{{ Form::label('data_demissao', 'Data de Demissão: ') }}
            {{ Form::text('data_demissao', null, array('class'=>'form-control data', 'disabled') ) }}
       	</div>
    </div>

	<div class="form-group">
		<div class="col-md-12">
		  <button type="submit" class="btn btn-primary">Gravar</button>
		  {{ link_to_route('colaboradors.index', 'Cancelar', null, array('class'=>'btn btn-danger')) }}
		</div>
	</div>

@section('scripts')
	@if($colaborador->situacao == 'demitido')
		<script type="text/javascript">
			$(function(){
				$('input[name=data_demissao]').removeAttr('disabled');
			});
		</script>
	@endif

	<script type="text/javascript">
		$(function(){
		$('select[name=setor_id]').chosen()
		$('select[name=posto_id]').chosen()

		$('select[name=situacao]').bind('change click blur', function(){
			if($(this).val() == "demitido"){
				$('input[name=data_demissao]').removeAttr('disabled');
			}
		});

		$('select[name=setor_id]').chosen().change(function() {
				$.getJSON('/setors/find/'+$(this).val()+'/postoTrabalho', function(data){
					$("select[name=posto_id]").empty().trigger("chosen:updated");

					if(data.length > 0){
						options += '<option value=""> Selecione ... </option>';
						$.each(data, function(key, val){
							options += '<option value="' + val.id + '">' + val.descricao + '</option>';
						})

						$("select[name=posto_id]").append(options);
						$('select[name=posto_id]').chosen().trigger("chosen:updated")


						}
						else{

							var options = "<option>Nenhum posto retornado </option>";
							$("select[name=posto_id]").append(options);
							$('select[name=posto_id]').chosen().trigger("chosen:updated")
						}
					})

				$.getJSON('/setors/find/'+$(this).val()+'/funcao', function(data){
					$("select[name=funcao_id]").empty().trigger("chosen:updated");

					if(data.length > 0){
						options += '<option value=""> Selecione ... </option>';
						$.each(data, function(key, val){
							options += '<option value="' + val.id + '">' + val.descricao + '</option>';
						})

						$("select[name=funcao_id]").append(options);
						$('select[name=funcao_id]').chosen().trigger("chosen:updated")


						}
						else{

							var options = "<option>Nenhum posto retornado </option>";
							$("select[name=funcao_id]").append(options);
							$('select[name=funcao_id]').chosen().trigger("chosen:updated")
						}
					})

				})

			@if(!empty($colaborador))
				$.getJSON('/setors/find/'+{{ $colaborador->setor_id }}+'/postoTrabalho', function(data){
					$("select[name=posto_id]").empty().trigger("chosen:updated");

					if(data.length > 0){
					options += '<option value=""> Selecione ... </option>';

						$.each(data, function(key, val){
							if(val.id == '{{ $colaborador->posto_id }}'){
								options += '<option value="' + val.id + '" selected >' + val.descricao + '</option>';
							}
							else{
								options += '<option value="' + val.id + '">' + val.descricao + '</option>';
							}


						})

						$("select[name=posto_id]").append(options);
						$('select[name=posto_id]').chosen().trigger("chosen:updated")


						}
						else{

							var options = "<option>Nenhum posto retornado </option>";
							$("select[name=posto_id]").append(options);
							$('select[name=posto_id]').chosen().trigger("chosen:updated")
						}
					})

				$.getJSON('/setors/find/'+{{ $colaborador->setor_id }}+'/funcao', function(data){
					$("select[name=funcao_id]").empty().trigger("chosen:updated");

					if(data.length > 0){
					options += '<option value=""> Selecione ... </option>';

						$.each(data, function(key, val){
							if(val.id == '{{ $colaborador->funcao_id }}'){
								options += '<option value="' + val.id + '" selected >' + val.descricao + '</option>';
							}
							else{
								options += '<option value="' + val.id + '">' + val.descricao + '</option>';
							}


						})

						$("select[name=funcao_id]").append(options);
						$('select[name=funcao_id]').chosen().trigger("chosen:updated")


						}
						else{

							var options = "<option>Nenhum posto retornado </option>";
							$("select[name=funcao_id]").append(options);
							$('select[name=funcao_id]').chosen().trigger("chosen:updated")
						}
					})


			@endif

			})
	</script>
@stop