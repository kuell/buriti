@include('dashboard.partials._alerts')

<fieldset>
    <div class="form-group col-md-12">
      {{ Form::label('nome', 'Nome do Colaborador: ') }}
      {{ Form::text('nome', null, array('class'=>'form-control') ) }}
    </div>
    <div class="form-group col-md-12">
      <div class="form-group col-md-3">
        {{ Form::label('sexo', 'Sexo: ') }}
        {{ Form::select('sexo', array('1'=>'Masculino','0'=>'Feminino'),null, array('class'=>'form-control') ) }}
      </div>

      <div class="form-group col-md-3">
        {{ Form::label('data_nascimento', 'Data de Nascimento: ') }}
        {{ Form::text('data_nascimento', null, array('class'=>'form-control data') ) }}
      </div>

      <div class="form-group col-md-3">
        {{ Form::label('contato', 'Contato: ') }}
        {{ Form::text('contato', null, array('class'=>'form-control') ) }}
      </div>
    </div>
    <div class="form-group col-md-12">
      {{ Form::label('endereco', 'Endereço: ') }}
      {{ Form::text('endereco', null, array('class'=>'form-control') ) }}
    </div>
     <div class="form-group col-md-5">
        {{ Form::label('bairro', 'Bairro: ') }}
        {{ Form::text('bairro', null, array('class'=>'form-control') ) }}
      </div>



    <div class="form-group col-md-12"> <h3>Informações Adicionais</h3></div>


    <div class="form-group col-md-12">
      <div class="form-group col-md-4">
        {{ Form::label('setor', 'Setor: ') }}
        {{ Form::select('setor_id', array(""=>'Selecione ...')+Setor::all()->lists('descricao','id'), null, array('class'=>'form-control') ) }}
      </div>

      <div class="form-group col-md-3">
        {{ Form::label('interno', 'O Colaborador é Interno? ') }}
        {{ Form::select('interno', array('0'=>'NÃO', '1'=>'SIM'), null, array('class'=>'form-control') ) }}
      </div>

      <div class="form-group col-md-5">
        {{ Form::label('codigo_interno', 'Matricula: ') }}
        {{ Form::text('codigo_interno', null, array('class'=>'form-control') ) }}
      </div>
      <div class="form-group col-md-3">
            {{ Form::label('data_admissao', 'Data de Admissão: ') }}
            {{ Form::text('data_admissao', null, array('class'=>'form-control data') ) }}
        </div>
    </div>

<div class="col-md-9">
  <button type="submit" class="btn btn-primary">Gravar</button>
  {{ link_to_route('colaboradors.index', 'Cancelar', null, array('class'=>'btn btn-danger')) }}

  </fieldset>
</div>