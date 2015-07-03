@extends('dashboard.index')

@section('main')
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                Controle de Fichas de Emprego
            </h3>

        </div>

        <div class="panel-body">
        <div class="form-group">
            {{ link_to_route('fichas.create', 'Nova Ficha', null, ['class'=>'btn btn-success']) }}
        </div>
            @include('cadastros::fichas.lista')
        </div>

    </div>
@endsection