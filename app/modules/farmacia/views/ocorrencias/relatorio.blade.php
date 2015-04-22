<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Relatorio de Ocorrencias</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          {{ Form::open(['name'=>'relatorio']) }}
          <div class="form-group col-md-12">
            <div class="col-md-6">
              {{ Form::label('Periodo: ') }}
              {{ Form::text('datai', null, ['class'=>'form-control data', 'placeholder'=>'Data Inicial']) }}
            </div>
            <div class="col-md-6">
              {{ Form::label('a', 'a') }}
              {{ Form::text('dataf', null, ['class'=>'form-control data', 'placeholder'=>'Data Final']) }}
            </div>
          </div>
        </div>
        {{ Form::close() }}
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" onclick="getRelatorio('ocorrencias/relatorioOcorrencias', $('form[name=relatorio]').serialize())">Gerar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

