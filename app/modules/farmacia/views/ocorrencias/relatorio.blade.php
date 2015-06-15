<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Relatorio de Ocorrencias</h4>
      </div>
      <div class="modal-body">
		<div class="panel">
	        {{ Form::open(['name'=>'relatorio', 'class'=>'navbar-form navbar-left']) }}
		        {{ Form::label('Periodo: ', null, ['class'=>'nav-brand']) }}
				<div class="form-group">
	              	{{ Form::text('periodo', null, ['class'=>'form-control periodo', "id"=>'periodo', 'placeholder'=>'Data Inicial']) }}
	            </div>
				{{ Form::label('Tipo: ', null, ['class'=>'nav-brand']) }}
				<div class="form-group">
					{{ Form::select('tipo', ['s'=>'Por Setor', 'c'=>'Por Colaborador', 'sc'=>'Por Setor / Colaborador'], null, ['class'=>'form-control', 'id'=>'tipo'])}}
				</div>

	        {{ Form::close() }}
		</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" id="gerar">Gerar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

