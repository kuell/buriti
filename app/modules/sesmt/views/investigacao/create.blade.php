@extends('layouts.modulo')

@section('content')
    <section>
        <h3>Investigação de Ocorrencia {{ Input::get('ocorrencia') }}</h3>
        {{ Form::open(['route'=>'sesmt.investigacao.store']) }}
            @include('sesmt::investigacao.form_colaborador')
        {{ Form::close() }}
    </section>
@stop