@extends('layouts.modulo')

@section('content')
   <div class="panel panel-info">

   		<div class="panel-heading">
   			<h4 class="panel-title">Investigação de Acidente</h4>
   		</div>
   		<div class="panel-body">
         {{ Form::model($investigacao, ['method' => 'PATCH','route'=>['sesmt.investigacao.update', $investigacao->id], 'class'=>'form form-horizontal']) }}
   			@include('sesmt::investigacao.form')
   		</div>
   		<div class="panel-footer">

            {{ Form::submit('Gravar', ['class'=>'btn btn-success btn-sm']) }}
               {{ link_to_route('sesmt.investigacao.index', 'Voltar', null, ['class'=>'btn btn-danger btn-sm']) }}
     		</div>
   {{ Form::close() }}
   </div>

   <script type="text/javascript">
   $(function(){
      $('select').chosen()
   })
   </script>
@stop