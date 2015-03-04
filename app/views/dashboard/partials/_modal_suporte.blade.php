<!-- Modal -->
<div class="modal fade" id="suporteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Envio de Pedido / Duvidas / Sugestões</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          {{ Form::open(['url'=>'/suporte']) }}
          <div class="form-group col-md-12">
            {{ Form::label('Tipo de Mensagem: ') }}
            {{ Form::select('tipo', array('suporte'=>'Suporte', 'duvida'=>'Dúvida', 'sugestão'=>'Sugestão'), null, ['class'=>'form-control']) }}
            <br />
            {{ Form::label('Descrição: ') }}
            {{ Form::textarea('descricao', null, ['class'=>'form-control']) }}
          </div>
          
        </div>
        <div class="modal-footer">
          {{ Form::submit('Enviar', ['class'=>'btn btn-info']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>

