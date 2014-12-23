@extends('dashboard.index')

@section('main')
<section class="content">
    {{ HTML::head('Colaboradores', 'controla os colaboradores') }}
    <div class="box box-primary">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Colaboradores</h3>
            <div class="box-footer clearfix no-border">
                {{ Form::adicionar('/cadastro/colaborador/create') }}
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            @include('cadastros::colaboradores.lista')
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
</script>
@stop