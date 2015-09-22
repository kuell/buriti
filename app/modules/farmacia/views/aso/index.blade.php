@extends('layouts.modulo')

@section('content')

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">ASO
      <small>controle de A.S.Os</small>
    </h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      {{ link_to_route('farmacia.aso.create', 'Nova Ficha Aso', null, ['class'=>'btn btn-success btn-sm']) }}
    </div>

    @include('farmacia::aso.lista')
  </div>
</div>

@stop