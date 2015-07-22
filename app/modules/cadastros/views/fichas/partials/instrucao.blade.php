@extends('layouts.frame')

@section('frame')
{{ Form::open(array('route'=>['fichas.instrucao', $ficha->id] ,'rule'=>'form')) }}
<div class="form-group">
    {{ Form::label('descricao', 'Descrição: ') }}
    {{ Form::select('descricao',[   ''    =>'Selecione ...',
        'ENSINO FUNDAMENTAL'    => 'ENSINO FUNDAMENTAL',
        'ENSINO MEDIO'          => 'ENSINO MÉDIO',
        'ENSINO SUPERIOR'       => 'ENSINO SUPERIOR',
        'POS GRADUACAO'         => 'POS GRADUAÇÃP'],
        NULL,
        ['class' => 'form-control col-md-5',
        'placeholder' => 'Descrição do grau de ensino']) }}
    </div>
    <div class="form-group">
        {{ Form::label('instituicao', 'Instituição de ensino: ') }}
        {{ Form::text('instituicao', null, array('ng-model'=>'instituicao', 'class'=>'form-control', 'placeholder'=>'Instituição')) }}
    </div>
    <div class="form-group">

        {{ Form::label('ano', 'Ano: ') }}
        {{ Form::text('ano', null, array('class'=>'form-control numero', 'placeholder'=>'Ano')) }}

        {{ Form::label('concluido', 'Concluido: ') }}
        {{ Form::select('concluido', ['Não', 'Sim'], 1, ['class'=>'form-control']) }}

    </div>
    <div class="form-group">
        {{ Form::input('submit', null, 'Gravar',  array('class' => 'btn btn-info')) }}
        {{ Form::close() }}
    </div>


    @if(count($ficha->instrucaos))
    <div class="form-group">
        <table class="table table-hover" ng-controller="InstrucaoCtrl">
            <thead>
                <tr>
                    <th>Descricao</th>
                    <th>Instituicao</th>
                    <th>Ano</th>
                    <th>Concluido</th>
                </tr>
            </thead>

            <tbody>
                @foreach($ficha->instrucaos as $instrucao)
                <tr ng-repeat="obj in obts">
                    <td>{{ $instrucao->descricao }}</td>
                    <td>{{ $instrucao->instituicao }}</td>
                    <td>{{ $instrucao->ano }}</td>
                    <td>{{ $instrucao->concluido }}</td>
                    <td>
                        <a href="/fichas/instrucao/{{ $instrucao->id }}/delete" class="glyphicon glyphicon-trash">
                        </a>
                    </td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @stop
