@extends('layouts.modulo')

@section('content')
    <section class="content">
        {{ HTML::head('Investigação de Ocorrencias', '') }}

        @include('sesmt::investigacao.lista')

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