{{ Form::model($aso, ['class'=>'form form-horizontal', 'name'=>'finaliza']) }}
{{ Form::hidden('aso_id', $aso->id) }}

@if($aso->tipo != 'admissional')
	<script type="text/javascript">
		$(function(){
			$('input[name=colaborador_data_admissao], input[name=colaborador_matricula]').attr('disabled', 'disabled');
		})
	</script>
@endif

<script type="text/javascript">
	$(function(){
		$('.data').mask('99/99/9999');
		$('#finaliza').bind('click', function(){
			data_admissao = $('input[name=colaborador_data_admissao]').val();
			matricula = $('input[name=colaborador_matricula]').val();
			status = $('select[name=status]').val();
			aso = $('input[name=aso_id]').val();

			$.post("/farmacia/aso/finalizar/{{ $aso->id }}", {
					colaborador_data_admissao: data_admissao,
					colaborador_matricula: matricula,
					status: status,
					id:aso
			},  function(data){
				alert(data);
			})
		})
	})
</script>



	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Finalizar ASO - {{ $aso->id }}
				</h4>
			</div>

			<div class="modal-body">

				<div class="form-group">
					<div class="col-xs-6">
						<span class="form-label">Nome: </span>
						<span class="form-control">{{ $aso->colaborador_nome }}</span>
					</div>

					<div class="col-xs-3">
						<span class="form-label">Idade: </span>
						<span class="form-control">{{ $aso->colaborador_idade }} anos</span>
					</div>
					<div class="col-xs-3">
						<span class="form-label">Tipo: </span>
						<span class="form-control">{{ strtoupper($aso->tipo) }}</span>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-4">
							{{ Form::label('Data de Admissão', null, ['class'=>'form-label']) }}
							{{ Form::text('colaborador_data_admissao', null, ['class'=>'form-control data']) }}
					</div>

					<div class="col-xs-4">
							{{ Form::label('Matrícula / Codigo Interno:', null, ['class'=>'form-label']) }}
							{{ Form::text('colaborador_matricula', null, ['class'=>'form-control numero']) }}
					</div>

					<div class="col-xs-4">
						{{ Form::label('Apto?', null, ['class'=>'form-label']) }}
						{{ Form::select('status', ['apto'=>'apto','inapto'=>'inapto'], null, ['class'=>'form-control']) }}
					</div>

				</div>
				{{ Form::close() }}

				<div class="form-group">
					<table class="table table-border">
						<caption>Exames</caption>
						<thead>
							<tr>
								<th>Descrição</th>
								<th>Data Realização</th>
								<th>Validade</th>
							</tr>
						</thead>
						<tbody>
							@foreach($aso->exames as $exame)
							<tr>
								<td>{{ $exame->descricao }}</td>
								<td>{{ Format::viewDate($exame->data) }}</td>
								<td>{{ $exame->validade }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</div>
			<div class="modal-footer">
				{{ Form::button('Finalizar', ['class'=>'btn btn-primary', 'id'=>'finaliza']) }}
				{{ link_to_route('farmacia.aso.edit', 'Editar ASO', $aso->id, ['class'=>'btn btn-info']) }}
			</div>

		</div>
	</div>
{{ Form::close() }}
