 <div class="col-md-12">
    <div class="form-group">
        <label for="nome">Nome Completo</label>
        {{ Form::text('nome', null, array('class'=>'form-control', 'required')) }}
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="ramal">Ramal</label>
          {{ Form::text('ramal', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="cal">Contato: </label>
          {{ Form::text('cel', null, array('class'=>'form-control fone')) }}
        </div>
    </div>

    <div class="form-group">
        <label for="email">E-mail: </label>
        {{ Form::text('email', null, array('class'=>'form-control minusculo')) }}
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <label for="avatar">Foto de avatar: </label>
            {{ Form::file('avatar', array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">
       <!-- <img src="/img/users/{{ $user->avatar or 'no_image.jpg'}}" width="100" height="100"> -->

        </div>
    </div>

    <div class="col-md-12">
        <div class="box-header">
            <h3 class="box-title">Acesso ao sistema</h3>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputPassword1">Usuario: </label>
            @if(!empty($user))
                {{ Form::text('user', null, array('class'=>'form-control minusculo', 'disabled')) }}
            @else
                {{ Form::text('user', null, array('class'=>'form-control minusculo')) }}
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputPassword1">Senha: </label>
          {{ Form::password('password', array('class'=>'form-control')) }}
        </div>
    </div>
</div>
<div class="box-footer">
    {{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}
	@if(!empty($user))
		{{ link_to('/users/permissao/'.$user->id, 'Permissao', array('class'=>'btn btn-info')) }}
	@endif
    {{ link_to_route('users.index', 'Voltar', null, array('class'=>'btn btn-danger')) }}
</div>