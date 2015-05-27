<div class="box-body" ng-app="App" ng-controller="AtestadoCtrl">
  <div class="form-group col-md-12">
    {{ Form::label('local_atendimento', 'Local de Atendimento: ') }}
    {{ Form::text('local_atendimento', null, array('class'=>'form-control') ) }}
  </div>

  <div class="form-group col-md-12">
    <div class="col-md-12">
      {{ Form::label('colaborador_id', 'Nome do Colaborador: ') }}
      {{ Form::select('colaborador_id', array(''=>'Selecione ...')+Colaborador::whereRaw("situacao is null or situacao = 'ativo'")->orderBy('nome')->lists('nome','id'), null, array('class'=>'form-control') ) }}
    </div>
  </div>

  <div class="form-group col-md-12">
    <div class="col-md-3">
      {{ Form::label('tipo_atestado', 'Tipo de Atestado: ') }}
      {{ Form::select('tipo_atestado', array('consulta','acompanhamento'), null, array('class'=>'form-control') ) }}
    </div>
    <div class="col-md-3">
      {{ Form::label('periodo_dispensa', 'Periodo da Dispensa: ') }}
      {{ Form::select('periodo_dispensa', array(''=>'Selecione ...', 'manha', 'tarde', 'noite', 'todos'), null, array('class'=>'form-control') ) }}
    </div>

    <div class="form-group col-md-6">
      <div class="col-md-12">
        {{ Form::label('periodo_afastamento', 'Periodo do afastamento: ') }}
      </div>
      <div class="col-md-6">
        {{ Form::text('inicio_afastamento', null, array('class'=>'form-control data', 'placeholder'=>'Inicio do Afastamento') ) }}
      </div>
      <div class="col-md-6">
        {{ Form::text('fim_afastamento', null, array('class'=>'form-control data', 'placeholder'=>'Fim do Afastamento') ) }}
      </div>
    </div>
  </div>

  <div class="form-group col-md-12">
    <div class="col-md-4">
      {{ Form::label('doenca', 'O Colaborador esta doente? ') }}
      {{ Form::select('doenca', array('1'=>'Sim', '0'=>'Não'), null, array('class'=>'form-control', 'rows'=>4) ) }}
    </div>
    <div class="col-md-4">
      {{ Form::label('acidente_trabalho', 'É um acidente de Trabalho? ') }}
      {{ Form::select('acidente_trabalho', array('1'=>'Sim', '0'=>'Não'), null, array('class'=>'form-control', 'rows'=>4) ) }}
    </div>
  </div>

  <div class="form-group col-md-12">
    <div class="col-md-2">
      {{ Form::label('cid', 'Codigo do C.I.D.: ') }}
      {{ Form::text('cid', null, array('class'=>'form-control', 'ng-blur'=>'busca_cid(this.value())') ) }}
    </div>
    <div class="col-md-10">
      {{ Form::label('cid_descricao', 'Descrição do CID: ') }}
      {{ Form::text('cid_descricao', null, array('class'=>'form-control', 'disabled'=>'disabled') ) }}
    </div>
  </div>

  <div class="form-group col-md-12">
    <div class="col-md-3">
      {{ Form::label('cat', 'Numero da CAT: ') }}
      {{ Form::text('cat', null, array('class'=>'form-control')) }}
    </div>

    <div class="col-md-5">
      {{ Form::label('profissional', 'Profissional: ') }}
      {{ Form::text('profissional', null, array('class'=>'form-control') ) }}
    </div>
  </div>
  <div class="form-group col-md-12">
    {{ Form::label('obs', 'Observação: ') }}
    {{ Form::textarea('obs', null, ['class'=>'form-control','rows'=>'3']) }}
  </div>
</div>

<div class="box-footer">
  <button type="submit" class="btn btn-primary">Gravar</button>
  {{ link_to_route('farmacia.atestados.index', 'Cancelar', null, array('class'=>'btn btn-danger')) }}

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

  var AtestadoCtrl = function ($scope, $http, $window){
    $scope.cod_interno = {{ $atestado->colaborador->codigo_interno or null }}

    $scope.busca_cid = function(){
      cod_cid = $('input[name=cid]').val();

      if(cod_cid == ''){
        $('input[name=cid_descricao]').val('');
      }

      $http.get('/restfull/cid/'+cod_cid.toUpperCase())
      .success(function(data){
        if(data == 0){
          alert('Cid não encontradao, \n Verifique se o código informado esta correto!')
          $('input[name=cid]').val('');
        }
        else{
          $('input[name=cid_descricao]').val(data[0].descricao)
        }
      })
    }

    $scope.busca = function(obj){
      codInterno = obj.cod_interno;

      $http.get('/colaboradors/find/'+codInterno).success(function(data){
        if(data == 0){
          $('input[name=codigo_interno]').val('')
          $('select[name=colaborador_id]').val('')
          $scope.info = '' ;
        }
        else{
          $('select[name=colaborador_id]').val(data.id)
        }
      });
    };
  };

	$(function(){
		$('select[name=colaborador_id]').chosen()

	})

</script>

@stop