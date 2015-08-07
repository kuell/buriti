<!-- Modal -->
{{ Form::open(['name'=>'relatorio', 'method'=>'GET', 'target'=>'_new', 'route'=>'farmacia.ocorrencias.report']) }}

<div class="modal fade" id="relatorioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Relatorio das Ocorrencias</h4>
      </div>
      <div class="modal-body">

          <div class="form-group">
            <div class="col-xs-12">
              {{ Form::label('Periodo: ', null, ['class'=>'form-label']) }}
              {{ Form::text('periodo', null, ['class'=>'form-control periodo','placeholder'=>'Data Inicial e Data Final']) }}
            </div>
          </div>
          <div class="form-group">
          {{ Form::label('Tipo de Relatorio: ', null, ['class'=>'form-label']) }}
            <div class="col-xs-12">
              {{ Form::select('tipo', ['atestados'=>'Atestados', 'ocorrencia'=>'Ocorrencias'], null, ['class'=>'form-control', 'id'=>'tipo'])}}
            </div>
          </div>


		  </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-info" data-demiss="modal">Gerar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

{{ Form::close() }}
