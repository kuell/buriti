@extends('dashboard.index')

@section('main')
	<section class="content">
    {{ HTML::head('Atestados', 'controla os atestados') }}
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Atestados</h3>
                    <div class="box-footer clearfix no-border">

						@include('ordem_interna.lista')		
			 		</div>
				</div>
			</div>
	</section>
	<script>
    	$(document).ready(function() {
        	$('#dataTables-example').dataTable();
    	});
    </script>

@stop