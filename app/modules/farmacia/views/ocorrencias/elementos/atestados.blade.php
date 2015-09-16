@extends('layouts.frame')

@section('frame')

@if($lista)

{{ Form::model($atestado, ['route'=>['farmacia.ocorrencias.atestados', $ocorrencia->id, 'atestado_id'=>$atestado->id], 'class'=>'form form-horizontal']) }}

<div class="form-group">
  	<div class="col-sm-11">
		{{ Form::label('local_atendimento', 'Local de Atendimento: ', ['class'=>'form-label']) }}
    	{{ Form::text('local', null, array('class'=>'form-control', 'required') ) }}
  	</div>
</div>

<div class="from-group">
    <div class="col-sm-5">
      	{{ Form::label('tipo_atestado', 'Tipo de Atestado: ') }}
      	{{ Form::select('tipo', array('consulta','acompanhamento'), null, array('class'=>'form-control', 'required') ) }}
    </div>

    <div class="col-sm-5">
      	{{ Form::label('periodo_dispensa', 'Periodo da Dispensa: ') }}
      	{{ Form::select('periodo', array(''=>'Selecione ...', 'manha', 'tarde', 'noite', 'todos'), null, array('class'=>'form-control', 'required') ) }}
    </div>
</div>

<div class="form-group">
	<div class="col-sm-4">
    	{{ Form::label('periodo_afastamento', 'Periodo do afastamento: ') }}
    	{{ Form::text('periodo_afastamento', null, array('class'=>'form-control periodo', 'placeholder'=>'Inicio do Afastamento', 'required') ) }}
	</div>
	<div class="col-sm-3">
      	{{ Form::label('doenca', 'O Colaborador esta doente? ') }}
      	{{ Form::select('doente', array('1'=>'Sim', '0'=>'Não'), null, array('class'=>'form-control', 'required') ) }}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2">
      	{{ Form::label('cid', 'CID.: ') }}
      	{{ Form::text('cid', null, array('class'=>'form-control', 'required') ) }}
    </div>
    <div class="col-sm-9">
      {{ Form::label('cid_descricao', 'Descrição do CID: ') }}
      {{ Form::text('cid_descricao', null, array('class'=>'form-control', 'disabled'=>'disabled', 'required') ) }}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-11">
      {{ Form::label('profissional', 'Profissional: ') }}
      {{ Form::text('profissional', null, array('class'=>'form-control', 'required') ) }}
    </div>
</div>

<div class="form-group">
	<div class="col-sm-11">
    	{{ Form::label('obs', 'Observação: ') }}
    	{{ Form::textarea('obs', null, ['class'=>'form-control','rows'=>'3', 'required']) }}
    </div>
</div>

<div class="form-group">
	<div class="col-md-12">
  		<button type="submit" class="btn btn-primary">Gravar</button>
  		{{ link_to_route('farmacia.ocorrencias.atestados', 'Listar Atestados', [$ocorrencia->id, 'lista'=>'sim'], array('class'=>'btn btn-warning')) }}
	</div>
</div>
{{ Form::close() }}
@else
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Local</th>
        <th>Periodo de Afastamento</th>
        <th>Dias de Afastamento</th>
        <th>Profissional</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($ocorrencia->atestados()->orderBy('id')->get() as $atestado)
      <tr>
        <td>{{ $atestado->local }}</td>
        <td>{{ $atestado->periodo_afastamento }}</td>
        <td>{{ $atestado->dias_afastamento }}</td>
        <td>{{ $atestado->profissional }}</td>
        <td>
          <a href="{{ Request::url() }}?id={{ $atestado->id }}">
            <i class="glyphicon glyphicon-pencil"></i>
          </a>
          <a href="">
            <i class="glyphicon glyphicon-trash"></i>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

{{ link_to_route('farmacia.ocorrencias.atestados', 'Novo Atestado', $ocorrencia->id, array('class'=>'btn btn-primary')) }}
@endif

<script type="text/javascript">
  $(function(){
    $('#cid').bind('blur', function(){
      $.get('/farmacia/'+$(this).val()+'/cid', null, function(data){
        if(data == 0){
          alert('Codigo CID nao encontrado!')
        }
        else{
          $('#cid_descricao').val(data[0].descricao)
        }

      })
    })
  })

</script>

@stop