@extends('layouts.modal')

@section('modal')

    {{ Form::open(['route'=>['sesmt.investigacao.epi.add', $investigacao->id],'class'=>'form-inline well'])}}
      {{ Form::hidden('investigacao_id', $investigacao->id)}}
          <div class="form-group">
            {{ Form::label('Descricao')}}
            {{ Form::text('descricao', null, ['class'=>' form-control','placeholder'=>'Descrição do E.P.I.'])}}
          </div>
      <div class="form-group">
        {{ Form::label('C.A.')}}
        {{ Form::text('ca', null, ['class'=>' form-control', 'placeholder'=>'Certificado de Aprovação'])}}
      </div>
      <div class="form-group">
        {{ Form::label('Validade')}}
        {{ Form::text('validade', null, ['class'=>' form-control data', 'placeholder'=>'Data de Validade'])}}
      </div>

      <button type="submit" class="btn btn-success">Gravar</button>
    {{ Form::close() }}

  <div class="col-md-12 well well-sm">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Descrição</th>
          <th>C.A.</th>
          <th>Validade</th>
        </tr>
      </thead>
      <tbody>
        @foreach($investigacao->epis as $epi)
        <tr>
          <td>{{ $epi->descricao }}</td>
          <td>{{ $epi->ca }}</td>
          <td>{{ $epi->validade }}</td>
          <td>
            {{ link_to_route('sesmt.investigacao.epi.delete', 'delete', $epi->id, ['class', 'btn btn-sm']) }}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@stop
