@extends('layouts.modulo')

@section('content')
<section class="content">
    {{ HTML::head('Aso', 'controle de A.S.O.') }}
    <div class="box box-info box-solid">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <div class="box-tools pull-right">
                {{ Form::adicionar('/farmacia/aso_ajustes/create') }}
          </div>
      </div><!-- /.box-header -->
      <div class="box-body">
            @include('farmacia::aso_ajustes.lista')
      </div>
</div>
</section>
@endsection
