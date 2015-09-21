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

<script type="text/javascript">
    $(function() {
        $("#asos").dataTable();
    })
</script>

@stop