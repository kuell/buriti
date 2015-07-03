@extends('layouts.modulo')

@section('content')
<section class="content">

    <div class="panel panel-default">
         <div class="panel-heading clearfix">
			<h3 class="panel-title pull-left">Ocorrencias <small>Listagem das Ocorrencias</small></h3>
				<div class="btn-group pull-right">

					<!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalElementos">
	                    <i class="glyphicon glyphicon-plus-sign"></i>
	                    	Natureza da Lesão
	                </button -->
				</div>

        </div><!-- /.box-header -->
        <div class="panel-body">
        <div class="well">
        	{{ Form::open(['route'=>'farmacia.ocorrencias.index', 'method'=>'get', 'class'=>'form form-horizontal']) }}
        		<div class="form-group">
        			<div class="col-md-2 col-sm-2">
        				{{ Form::label('Id: ') }}
        				{{ Form::text('id', Input::get('id'), ['class'=>'form-control']) }}
        			</div>
        			<div class="col-md-4 col-sm-4">
        				{{ Form::label('Periodo: ') }}
        				{{ Form::text('periodo', Input::get('periodo'), ['class'=>'form-control periodo']) }}
        			</div>
        			<div class="col-md-8 col-sm-8">
        				{{ Form::label('Colaborador: ') }}
        				{{ Form::select('colaborador_id', ['Selecione o Colaborador']+Colaborador::whereNull('situacao')->lists('nome', 'id'), Input::get('colaborador_id'), ['class'=>'form-control']) }}

        			</div>
        		</div>

        		<div class="form-group">
        			<div class="col-md-12">
	        			{{ Form::submit('Buscar', ['class'=>'btn btn-primary btn-sm']) }}

	        			<a href="{{ URL::route('farmacia.ocorrencias.create') }}" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Nova Ocorrencia</a>

		                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
		                    <i class="glyphicon glyphicon-list-alt"></i>
		                    Relatorios
		                </button>
	                </div>
        		</div>

        	{{ Form::close() }}

        </div>

            @include('farmacia::ocorrencias.lista')
            @include('farmacia::ocorrencias.relatorio')

			<!-- Modal -->
	<div class="modal fade" id="modalElementos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title" id="myModalLabel">Natureza da Lesão</h4>
		    	</div>
			    <div class="modal-body">
					<iframe src="/farmacia/ocorrencias/elementos" class="col-md-12 bordered" height="500px"></iframe>
			    </div>
			    <div class="modal-footer">
			        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			    </div>
			</div>
		</div>
	</div>
</div>
</div>
</section>
@endsection

@section('scripts')
{{ HTML::script('js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('js/plugins/datatables/dataTables.bootstrap.js') }}

<script type="text/javascript">
    $(function() {
        $("#ocorrencias").dataTable( {
			"order": [ 0, "desc" ]
			} );

        $('select[name=colaborador_id]').chosen()

		$('#gerar').click(function() {
			periodo = $('#periodo').val()
			tipo = $('#tipo').val()

			window.open("/farmacia/ocorrencias/relatorioOcorrencias?periodo="+periodo, 'Print', 'channelmode=yes')
		});
    })
</script>
@stop
