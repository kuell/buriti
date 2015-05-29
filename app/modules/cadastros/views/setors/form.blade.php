
@include('dashboard.partials._alerts')

<fieldset>
  	<div class="form-group col-md-9">
    	<div class="col-md-6">
      		{{ Form::label('descricao', 'Descrição do Setor: ') }}
      		{{ Form::text('descricao', null, array('class'=>'form-control', 'required') ) }}
    	</div>
		<div class="form-group col-md-3">
	    	{{ Form::label('agrupamento', 'Agrupamento: ') }}
	    	{{ Form::select('agrupamento', Setor::agrupamentos(), null, array('class'=>'form-control', 'required') ) }}
	  	</div>
  	</div>

  	<div class="form-group col-md-8">
    	{{ Form::label('encarregado', 'Encarregado ou Responsavel: ') }}
    	{{ Form::text('encarregado', null, array('class'=>'form-control') ) }}
  	</div>

  	<div class="form-group col-md-5">
    	{{ Form::label('situacao', 'Situação do setor: ') }}
    	{{ Form::select('situacao', array(1=>'ativo', 0=>'inativo'), null, array('class'=>'form-control') ) }}
  	</div>

  	<div class="form-group col-md-2">
    	{{ Form::label('padrao_horatrabalho', 'Padrão de Horas Trabalhadas: ') }}
    	{{ Form::text('padrao_horatrabalho', null, array('class'=>'form-control hora') ) }}
 	</div>


  	<div class="col-md-9">
    	<button type="submit" class="btn btn-primary">Gravar</button>
    	{{ link_to_route('setors.index', 'Cancelar', null, array('class'=>'btn btn-danger')) }}
	</div>
  </fieldset>