@extends('layouts.modulo')

@section('content')
<section class="content">
    {{ HTML::head('Ocorrencia', 'controla as ocorrencias') }}
    <div class="box box-info box-solid">
         <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Ocorrencias</h3>

            <div class="box-tools pull-right">
                {{ Form::adicionar('/farmacia/ocorrencias/create') }}
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    Relatorios
                </button>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalElementos">
                    <i class="glyphicon glyphicon-plus-sign"></i>
                    	Natureza da Lesão
                </button>

            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
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
			<!-- Fim Modal -->

        </div>
    </div>
</section>
@endsection

@section('scripts')
{{ HTML::script('js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('js/plugins/datatables/dataTables.bootstrap.js') }}

<script type="text/javascript">
    $(function() {
        $("table").dataTable();
    })

    function getRelatorio(rota, parametro){
        window.open(rota+'?'+parametro, 'Print', 'channelmode=yes');
    }
</script>
@stop
