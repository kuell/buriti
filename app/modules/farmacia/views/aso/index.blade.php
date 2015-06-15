@extends('layouts.modulo')

@section('content')
<section class="content">
    {{ HTML::head('Aso', 'controle de A.S.O.') }}
    <div class="box box-info box-solid">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <div class="box-tools pull-right">
                {{ Form::adicionar('/farmacia/aso/create') }}
          </div>
      </div><!-- /.box-header -->
      <div class="box-body">
            @include('farmacia::aso.lista')
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
            window.open('/farmacia/aso/rel_rh?'+$('form[name=relatorio]').serialize(), 'print', 'channel-mooe=yes,scrollbars=yes')
        });

        $("#operacoes").click(function(event) {
            window.open('/farmacia/aso/rel_operacoes?'+$('form[name=relatorio]').serialize(), 'print', 'width=100, height=100')
        });
    })
</script>
@stop