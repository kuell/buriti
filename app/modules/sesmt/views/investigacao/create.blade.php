@extends('layouts.modulo')

@section('content')
    <section>
        <h3>Investigação de Ocorrencia</h3>
        {{ Form::open(['route'=>'sesmt.investigacao.create']) }}
            @include('sesmt::investigacao.form')
        {{ Form::close() }}
    </section>
@stop