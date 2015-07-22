<h3 class="form-section">Imagem</h3>
<div class="form-group">
    <div class='col-md-6'>
        {{ Form::label('foto', 'Foto: ', array('class'=>'control-label')) }}
        {{ Form::file('foto', array('class'=>'form-control')) }}
    </div>
    <div class="col-md-6">
        <img src="{{ $ficha->foto }}" width="113px" height="120px" align="top" alt=""/>
    </div>
</div>

<h3 class="form-section">Documentação</h3>
<div class="form-group">
    <div class='col-md-3'>
        {{ Form::label('rg', 'Rg:', array('class'=>'control-label')) }}
        {{ Form::text('rg', null, array('class'=>'form-control validaRg numero', 'autofocus')) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('emissao', 'Orgão Emissor:', array('class'=>'control-label')) }}
        {{ Form::text('emissao', 'SSP/MS', array('class'=>'form-control emissor')) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('cpf', 'Cpf:', array('class'=>'control-label')) }}
        {{ Form::text('cpf', null, array('class'=>'form-control cpf')) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('titulo_eleitor', 'Titulo de Eleitor:', array('class'=>'control-label')) }}
        {{ Form::text('titulo_eleitor', null, array('class'=>'form-control')) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {{ Form::label('reservista', 'Reservista:', array('class'=>'control-label')) }}
        {{ Form::text('reservista', null, array('class'=>'form-control numero')) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('ctps', 'Ctps:', array('class'=>'control-label')) }}
        {{ Form::text('ctps', null, array('class'=>'form-control')) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('pis', 'Pis:', array('class'=>'control-label')) }}
        {{ Form::text('pis', null, array('class'=>'form-control')) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('pretencao', 'Pretenção Salarial:', array('class'=>'control-label')) }}
        {{ Form::text('pretencao', null, array('class'=>'form-control valor')) }}
    </div>
</div>

<h3 class="form-section">Identificação</h3>

<div class="form-group">
    <div class="col-md-12">
        {{ Form::label('nome', 'Nome:', array('class'=>'control-label')) }}
        {{ Form::text('nome', null, array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    <div class    ="col-md-2">
		{{ Form::label('sexo', 'Sexo:', array('class'=>'control-label')) }}
		{{ Form::select('sexo',array('0'=>'Masculino','1'=>'Feminino'), null, array('class'=>'form-control')) }}
	</div>
    <div class    ="col-md-2">
    	{{ Form::label('data_nascimento', 'Data nascimento:', array('class'=>'control-label')) }}
    	{{ Form::text('data_nascimento', null, array('class'=>'form-control data')) }}
	</div>
    <div class='col-md-3'>
        {{ Form::label('naturalidade', 'Naturalidade:', array('class'=>'control-label')) }}
        {{ Form::text('naturalidade', null, array('class'=>'form-control')) }}
    </div>
    <div class="col-md-3">
        {{ Form::label('nacionalidade', 'Nacionalidade:', array('class'=>'control-label')) }}
        {{ Form::text('nacionalidade', $ficha->nacionalidade  ? $ficha->nacionalidade :  'BRASILEIRO', array('class'=>'form-control')) }}
    </div>
    <div class='col-md-2'>
        {{ Form::label('estado_civil', 'Estado Civil:', array('class'=>'control-label')) }}
        {{ Form::select('estado_civil',
        array("Solteiro(a)", "Casado(a)", "Viuvo(a)", "Amasiado(a)", "Divorciado(a)", "Disquitado(a)"), $ficha->estado_civil , array('class'=>'form-control')) }}
    </div>
</div>

<div class    ="form-group">

    <div class="col-md-2">
        {{ Form::label('filhos', 'Filhos:', array('class'=>'control-label')) }}
        {{ Form::input('number', 'filhos', null, array('class'=>'form-control numero')) }}
    </div>
    <div class="col-md-2">
        {{ Form::label('fone', 'Fone:', array('class'=>'control-label')) }}
        {{ Form::text('fone', null, array('class'=>'form-control fone')) }}
    </div>
    <div class    ="col-md-2">
        {{ Form::label('cel', 'Cel:', array('class'=>'control-label')) }}
        {{ Form::text('cel', null, array('class'=>'form-control fone')) }}
    </div>

</div>

<div class="form-group">
    <div class='col-md-12'>
        {{ Form::label('endereco', 'Endereco:', array('class'=>'control-label')) }}
        {{ Form::text('endereco', null, array('class'=>'form-control')) }}
    </div>
</div>

<div class='form-group'>
    <div class="col-md-6">
        {{ Form::label('bairro', 'Bairro:', array('class'=>'control-label')) }}
        {{ Form::text('bairro', null, array('class'=>'form-control')) }}
    </div>
    <div class="col-md-4">
        {{ Form::label('cidade', 'Cidade:', array('class'=>'control-label')) }}
        {{ Form::text('cidade', $ficha->cidade ? $ficha->cidade : "TERENOS", array('class'=>'form-control')) }}
    </div>
    <div class="col-md-2">
        {{ Form::label('cep', 'Cep:', array('class'=>'control-label')) }}
        {{ Form::text('cep', $ficha->cep ? $ficha->cep : '79.190-000', array('class'=>'form-control cep')) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        {{ Form::label('pai', 'Nome do Pai:', array('class'=>'control-label')) }}
        {{ Form::text('pai', null, array('class'=>'form-control')) }}
    </div>
    <div class="col-md-6">
        {{ Form::label('mae', 'Nome da Mãe:', array('class'=>'control-label')) }}
        {{ Form::text('mae', null, array('class'=>'form-control')) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        {{ Form::label('obs', 'Obs: ', ['class'=>'form-label']) }}
        {{ Form::textarea('obs', null, ['class'=>'form-control']) }}
    </div>
</div>


@if($ficha->id)
    <script type="text/javascript">
        $(function(){
            $('input[name=rg]').attr('disabled', 'disabled');
        })
    </script>
@else
    <script type="text/javascript">
        $(function(){
            $('input[name=rg]').bind('blur', function(){
                if($(this).val() != ''){
                    $.get('/fichas/find/'+$(this).val()+'/rg', function(data){
                        if(data.length != 0){
                            alert('Ficha ja cadastrada!')
                            window.location = '/fichas/'+data[0].id+'/edit'
                        }
                    })
                }
            })

        })
    </script>
@endif

