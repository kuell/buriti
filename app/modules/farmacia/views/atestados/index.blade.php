@extends('dashboard.index')

@section('main')
<section class="content">
    {{ HTML::head('Atestados', 'controla os atestados') }}
    <div class="box box-info box-solid">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Atestados</h3>

            <div class="box-tools pull-right">
                {{ Form::adicionar('/farmacia/atestados/create') }}
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                  <i class="fa fa-list-alt"></i> Relatorios</a>
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
        $("table").dataTable();
        $("#rh").click(function(event) {
            window.open('/farmacia/atestados/rel_rh?'+$('form[name=relatorio]').serialize(), 'print', 'channel-mooe=yes')
        });

        $("#operacoes").click(function(event) {
            window.open('/farmacia/atestados/rel_operacoes?'+$('form[name=relatorio]').serialize(), 'print', 'width=100, height=100')
        });
    })
</script>
@stop