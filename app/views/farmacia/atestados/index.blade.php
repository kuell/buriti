@extends('dashboard.index')

@section('main')
	<section class="content">
    {{ HTML::head('Atestados', 'controla os atestados') }}
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Atestados</h3>
                    <div class="box-footer clearfix no-border">
                        {{ Form::adicionar('/farmacia/atestados/create') }}
                </div>
             </div><!-- /.box-header -->
             <div class="box-body">
                @include('farmacia.atestados.lista')
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