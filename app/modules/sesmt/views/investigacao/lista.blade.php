<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cod. Ocorrencia</th>
            <th>Data Ocorrencia</th>
            <th>Colaborador</th>
            <th>Setor</th>
            <th>Situação</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($investigacaos as $investigacao)
        <tr>
            <td>{{ $investigacao->id }}</td>
            <td>{{ $investigacao->ocorrencia->id }}</td>
            <td>{{ $investigacao->ocorrencia->data_hora }}</td>
            <td>{{ $investigacao->ocorrencia->colaborador->nome }}</td>
            <td>{{ $investigacao->ocorrencia->colaborador->setor->descricao or 'Não Informado' }}</td>
            <td>{{ $investigacao->situacao }}</td>
            <td>
                {{ link_to('#', ' ', ['class'=>'btn btn-primary glyphicon glyphicon-list', 'onclick'=>'print("'.URL::route('sesmt.investigacao.show', $investigacao->id).'", "Print", "channelmode=yes")']) }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

