
@include('dashboard.partials._alerts')

  	<div class="form-group">
    	<div class="col-md-7">
      		{{ Form::label('descricao', 'Descrição do Setor: ') }}
      		{{ Form::text('descricao', null, array('class'=>'form-control', 'required') ) }}
    	</div>
  		<div class="col-md-5">
  	    	{{ Form::label('agrupamento', 'Agrupamento: ') }}
  	    	{{ Form::select('agrupamento', Setor::agrupamentos(), null, array('class'=>'form-control', 'required') ) }}
  	  	</div>
    </div>

    <div class="form-group">
      <div class="col-md-5">
        {{ Form::label('encarregado', 'Encarregado ou Responsavel: ') }}
        {{ Form::text('encarregado', null, array('class'=>'form-control') ) }}
      </div>
      <div class="col-md-3">
        {{ Form::label('situacao', 'Situação do setor: ') }}
        {{ Form::select('situacao', array(1=>'ativo', 0=>'inativo'), null, array('class'=>'form-control') ) }}
      </div>
      <div class="col-md-4">
          {{ Form::label('padrao_horatrabalho', 'Padrão de Horas Trabalhadas: ') }}
          {{ Form::text('padrao_horatrabalho', null, array('class'=>'form-control hora') ) }}
        </div>
    </div>
    <div class="form-group">
      <div class="col-md-4">
        {{ Form::label('usuario_alteracao', 'Usuario de Alteração: ', ['class'=>'form-label']) }}
        {{ Form::text('usuario_alteracao', null, ['class'=>'form-control', 'disabled']) }}
      </div>
      <div class="col-md-4">
        {{ Form::label('ultima_alteração', 'Ultima Alteração: ', ['class'=>'form-label']) }}
        {{ Form::text('ultima_atualizacao', null, ['class'=>'form-control', 'disabled']) }}
      </div>
    </div>