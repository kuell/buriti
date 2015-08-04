{{  Form::model($ficha, ['route'=>['fichas.selecionar', $ficha->id, ]])  }}
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Selecionar Ficha</h4>
		</div>
		<div class="modal-body">
			<div class="form-group">
				Nome: {{ $ficha->nome }}
			</div>

			<div class="form-group">
				{{ HTML::image($ficha->foto, null,['width'=>'90','class'=>'img-reponsive']) }}
				Observação: {{ $ficha->obs }}
			</div>
			<div class="form-group">
				{{ Form::label('setor', 'Setor:', ['class'=>'form-label']) }}
				{{ Form::select('setor_id', ['0'=>'Selecione ...']+Setor::orderBy('descricao')->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('funcao', 'Função:', ['class'=>'form-label']) }}
				{{ Form::select('funcao_id', [], null, ['class'=>'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('posto_id', 'Posto de Trabalho:', ['class'=>'form-label']) }}
				{{ Form::select('posto_id', [], null, ['class'=>'form-control']) }}
			</div>
		</div>
		<div class="modal-footer">
			{{  Form::submit('Selecionar', ['class'=>'btn btn-primary']) }}
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>

{{ Form::close() }}

<script type="text/javascript">
	$(function(){
		$('select[name=setor_id]').chosen({width: "100%"});

		$('select[name=setor_id]').bind('change', function(){
			//Busca Posto //
			$.get('setors/find/'+$(this).val()+'/postoTrabalho ', function(data) {

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

			$.get('setors/find/'+$(this).val()+'/funcao ', function(data) {
				$("select[name=funcao_id] option").remove();

				if(data.length > 0){

					var options = "<option>Selecione ...</option>";

					$.each(data, function(key, val){
						options += '<option value="' + val.id + '">' + val.descricao + '</option>';
					})

					$("select[name=funcao_id]").append(options);
					$("select[name=funcao_id]").removeAttr('disabled', 'disabled');
				}
				else{
					$("select[name=funcao_id]").append('<option>Nenhum Informado ...</option>');
					$("select[name=funcao_id]").attr('disabled', 'disabled');
				}
			});
		})
	})
</script>