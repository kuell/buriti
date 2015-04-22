<div class="row">

    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left">Informações da Lesão</h4>
            <div class="btn-group pull-right">

            </div>
        </div>
	    <div class="panel-body">
	    	<div class="form-horizontal">
				{{ Form::open()}}
					{{ Form::label('Natureza da Lesão: ')}}
					{{ Form::select('motivo1', [''=>'Selecione ...']+InvestigacaoElemento::all()->lists('descricao', 'id'), null, ['class'=>'form-control']) }}
				{{ Form::close()}}
			</div>
	    <div class="panel-footer">
			{{ Form::submit('Proximo >>', ['class'=>'btn btn-success btn-sm']) }}
	    </div>
	</div>
</div>