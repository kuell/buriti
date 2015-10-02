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
            {{ Form::button('Informações', ['class'=>'btn btn-info btn-sm', 'id'=>'info']) }}
            {{ link_to_route('sesmt.investigacao.index', 'Voltar', null, ['class'=>'btn btn-danger btn-sm']) }}
     		</div>
   {{ Form::close() }}
   </div>

<div class="modal fade" id="informacoes" tabindex="" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title">Informaçoes Adicionais</h3>
            </div>
          <div class="modal-body">

            <!-- Nav tabs -->
               <ul class="nav nav-tabs" role="tablist">
                   <li role="presentation" class="active"><a href="#lesao" aria-controls="lesao" role="tab" data-toggle="tab">Natureza da Lesão</a></li>
                   <li role="presentation"><a href="#corpo" aria-controls="corpo" role="tab" data-toggle="tab">Parte do Corpo</a></li>
               </ul>

              <!-- Tab panes -->
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="lesao">
                     <iframe src="/sesmt/investigacao/lesao/{{ $investigacao->id }}" style="width: 100%; height:400px; border:0;"></iframe>
                  </div>
                   <div role="tabpanel" class="tab-pane" id="corpo">
                     <iframe src="" style="width: 100%; height:400px; border:0;"></iframe>
                  </div>
               </div>

          </div>
      </div>
   </div>
</div>

   <script type="text/javascript">
      $(function(){
         $('#info').bind('click', function() {
            $('#informacoes').modal();
         });

         $('select').chosen()
      })
   </script>
@stop