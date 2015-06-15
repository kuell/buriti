@extends('layouts.modulo')

@section('content')
<section class="content">
	<div class="panel panel-success">
		<div class="panel-heading">
        {{ HTML::head('Investigação de Ocorrencias', '') }}
		</div>
		<div class="panel-body">
		 	@include('sesmt::investigacao.lista')
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