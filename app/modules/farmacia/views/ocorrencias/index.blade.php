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
                    <i class="fa fa-list-alt"></i>
                    Relatorios
                </button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('farmacia::ocorrencias.lista')
            @include('farmacia::ocorrencias.relatorio')
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
