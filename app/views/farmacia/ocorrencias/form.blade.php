<fieldset ng-app="App">
  <div class="form-group col-md-12" ng-controller="OcorrenciaCtrl">
    <div class="form-group col-md-2">
      {{ Form::label('codigo_interno', 'Matrícula: ') }}
      {{ Form::text('codigo_interno', null, array('class'=>'form-control', 'ng-model'=>'cod_interno', 'ng-blur'=>'busca(this)') ) }}
    </div>

    <div class="form-group col-md-8">
      {{ Form::label('colaborador_id', 'Nome do Colaborador: ') }}
      {{ Form::select('colaborador_id', array(''=>'Selecione ...')+Colaborador::orderBy('nome')->lists('nome','id'), null, array('class'=>'form-control') ) }}
    </div>
    <div class="form-group col-md-2">
      {{ Form::label('data', 'Data e Hora: ') }}
      {{ Form::text('data_hora', date('d/m/Y H:i'), array('class'=>'form-control') ) }}
    </div>
    
  </div>


  <div class="col-md-12">
    <div class="form-group col-md-6">
      {{ Form::label('relato', 'Relato do Acidente: ') }}
      {{ Form::textarea('relato', null, array('class'=>'form-control', 'rows'=>4) ) }}
    </div>
    <div class="form-group col-md-6">
      {{ Form::label('diagnostico', 'Diagnóstico: ') }}
      {{ Form::textarea('diagnostico', null, array('class'=>'form-control', 'rows'=>4) ) }}
    </div>
  </div>

  <div class="form-group col-md-12">
    <div class="form-group col-md-6">
      {{ Form::label('conduta', 'Conduta: ') }}
      {{ Form::textarea('conduta', null, array('class'=>'form-control', 'rows'=>4) ) }}
    </div>
    <div class="form-group col-md-6">
      {{ Form::label('destino', 'Destino: ') }}
      {{ Form::textarea('encaminhamento', null, array('class'=>'form-control', 'rows'=>4) ) }}
    </div>
  </div>
  <div class="form-group col-md-5">
    {{ Form::label('profissional', 'Profissional: ') }}
    {{ Form::text('profissional', null, array('class'=>'form-control') ) }}
  </div>


  <div class="col-md-9">
    <button type="submit" class="btn btn-primary">Gravar</button>
    {{ link_to_route('farmacia.ocorrencias.index', 'Cancelar', null, array('class'=>'btn btn-danger')) }}

  </fieldset>
</div>

@section('scripts')
{{ HTML::script('js/angular.min.js') }}
<script type="text/javascript">
  $('select[name=colaborador_id]').change(function(){
    $('input[name=codigo_interno]').val('')
  });


  var App = angular.module('App',[]);
  App.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
  });

  var OcorrenciaCtrl = function ($scope, $http, $window){
    $scope.cod_interno = {{ $ocorrencia->colaborador->codigo_interno or 0 }}

    $scope.busca = function(obj){
      codInterno = obj.cod_interno;

      $http.get('/restfull/colaborador/'+codInterno).success(function(data){
        if(data == 0){
          alert("Colaborador não encontrado!")
          $('input[name=codigo_interno]').val('')
          $('select[name=colaborador_id]').val('')
        }
        else{
          $window.console.log(data.colaborador[0]);
          $('select[name=colaborador_id]').val(data.colaborador[0].id)
        }
      });
    };
  };
</script>

@stop