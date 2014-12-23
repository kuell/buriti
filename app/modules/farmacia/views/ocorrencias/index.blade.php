@extends('dashboard.index')

@section('main')
<section class="content">
    {{ HTML::head('Ocorrencia', 'controla as ocorrencias') }}
    <div class="box box-primary">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Ocorrencias</h3>
            <div class="box-footer clearfix no-border">
                {{ Form::adicionar('/farmacia/ocorrencias/create') }}
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('farmacia::ocorrencias.lista')
        </div>
        @endsection

        @section('scripts')
        {{ HTML::script('js/plugins/datatables/jquery.dataTables.js') }}
        {{ HTML::script('js/plugins/datatables/dataTables.bootstrap.js') }}
        
        <script type="text/javascript">
            $(function() {
                $("table").dataTable();
            })
        </script>
        @stop