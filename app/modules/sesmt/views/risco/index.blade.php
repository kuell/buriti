@extends('layouts.modulo')

@section('content')
<section class="content">
	<div class="panel panel-info">
		<div class="panel-heading clearfix">
			<div class="panel-title pull-left">
				<h3>Controle de Riscos por Posto de Trabalho</h3>
			</div>
		</div>
		<div class="panel-body">
			<div class="col-md-12 well ">
				{{ Form::open(['route'=>['sesmt.risco.store']]) }}
					<div class="form-group col-md-3">
						{{ Form::label('Posto de Trabalho: ')}}
						{{ Form::select('posto_id', [''=>'Selecione ...'] + SetorPosto::all()->lists('descricao', 'id'), null, ['class'=>'form-control'] )}}
					</div>

					<div class="form-group col-md-3">
						{{ Form::label('Tipo de Risco: ')}}
						{{ Form::select('tipo', [''=>'Selecione ...']+$tipo_risco, null, ['class'=>'form-control'] )}}
					</div>

					<div class="form-group col-md-6">
						{{ Form::label('Descrição do Risco: ')}}
						{{ Form::text('descricao', null, ['class'=>'form-control'] )}}
					</div>

					{{ Form::submit('gravar', ['class'=>'btn btn-success pull-right'])}}

				{{ Form::close() }}
			</div>
			 @include('sesmt::risco.lista')
		</div>
	</div>
</section>

@stop

@section('scripts')
    {{ HTML::script('js/plugins/datatables/jquery.dataTables.js') }}
    {{ HTML::script('js/plugins/datatables/dataTables.bootstrap.js') }}

    <script type="text/javascript">
        $(function() {
            $("table").dataTable();
        })
    </script>
@stop