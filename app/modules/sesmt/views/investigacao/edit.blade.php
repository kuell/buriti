@extends('layouts.modulo')

@section('content')
    <section>
        <h3>Investigação de Ocorrencia: {{ $investigacao->ocorrencia_id }}</h3>
        {{ Form::model($investigacao, ['method' => 'PATCH','route'=>['sesmt.investigacao.update', $investigacao->id, 'pg'=>$pg]]) }}
            @include('sesmt::investigacao.partials.'.$pg)
        {{ Form::close() }}
    </section>
@stop