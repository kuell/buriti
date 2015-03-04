@extends('layouts.modulo')

@section('content')
<section class="content">
    {{ HTML::head('Atestados', 'controla os atestados') }}
    <div class="box box-info box-solid">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <div class="box-tools pull-right">
                {{ Form::adicionar('/farmacia/atestados/create') }}
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-list-alt"></i>
                    Relatorios
                </button>
          </div>
      </div><!-- /.box-header -->
      <div class="box-body">
            @include('farmacia::atestados.lista')
            @include('farmacia::atestados.relatorios')
      </div>
</div>
</section>
@endsection

@section('scripts')
{{ HTML::script('js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('js/plugins/datatables/dataTables.bootstrap.js') }}

<script type="text/javascript">
    $(function() {
        $('table tfoot th').each( function () {
            var title = $('table thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );

        $("table").dataTable();

        $("#rh").click(function(event) {
            window.open('/farmacia/atestados/rel_rh?'+$('form[name=relatorio]').serialize(), 'print', 'channel-mooe=yes,scrollbars=yes')
        });

        $("#operacoes").click(function(event) {
            window.open('/farmacia/atestados/rel_operacoes?'+$('form[name=relatorio]').serialize(), 'print', 'width=100, height=100')
        });
    })
</script>
@stop