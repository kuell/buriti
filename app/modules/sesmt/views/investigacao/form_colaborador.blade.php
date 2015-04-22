<div class="row">

<div class="panel panel-success">
    <div class="panel-heading clearfix">
         <h3 class="panel-title pull-left">Dados do Colaborador</h3>
        <div class="pull-right">
            {{ Form::button('Atualizar Informações',['class'=>'btn btn-primary btn-sm', 'id'=>'colaborador']) }}
        </div>
    </div>
    <div class="panel-body">
            {{ Form::hidden('ocorrencia_id', $ocorrencia->id)}}
        <div class="col-md-12">
            <div class="col-md-9">
                Nome: {{ Form::label('nome', $ocorrencia->colaborador->nome, ['class'=>'form-control', 'disabled'=>'disabled']) }}
            </div>
            <div class="col-md-3">
                Matricula:
                {{ Form::label('codigo_interno', $ocorrencia->colaborador->codigo_interno, ['class'=>'form-control', 'disabled'=>'disabled']) }}
            </div>
            <div class="col-md-3">
                Data Nascimento:
                    {{ Form::label('', $ocorrencia->colaborador->data_nascimento, ['class'=>'form-control data']) }}
            </div>
            <div class="col-md-3">
                Sexo:
                    {{ Form::label('sexo', $ocorrencia->colaborador->sexoDescricao, ['class'=>'form-control']) }}

            </div>
            <div class="col-md-12">
                Endereço:
                {{ Form::label('endereco', $ocorrencia->colaborador->endereco, ['class'=>'form-control']) }}
            </div>
            <div class="col-md-3">
                Setor:
                {{ Form::label('setor', $ocorrencia->colaborador->setor->descricao, ['class'=>'form-control']) }}
            </div>
            <div class="col-md-4">
                Data Admissão: {{ Form::label('', $ocorrencia->colaborador->data_nascimento, ['class'=>'form-control data' ]) }}
            </div>
             <div class="col-md-4">
                Funcao: {{ Form::label('', $ocorrencia->colaborador->funcao, ['class'=>'form-control']) }} <br />
            </div>
        </div>
    </div>
    <div class="panel-footer">
        {{ Form::submit('Proximo >>',['class'=>'btn btn-success  btn-sm', 'id'=>'colaborador']) }}
    </div>
</div>