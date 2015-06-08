<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Data Ocorrencia</th>
            <th>Colaborador</th>
            <th>Setor</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($ocorrencias as $ocorrencia)
        <tr>
            <td>{{ $ocorrencia->id }}</td>
            <td>{{ $ocorrencia->data_hora }}</td>
            <td>{{ $ocorrencia->colaborador->nome }}</td>
            <td>{{ $ocorrencia->colaborador->setor->descricao or 'Não Informado' }}</td>
            <td>
                {{ link_to('#', ' ', ['class'=>'btn btn-primary glyphicon glyphicon-list', 'onclick'=>'print("'.URL::route('sesmt.investigacao.show', $ocorrencia->id).'")']) }}
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Data Ocorrencia</th>
            <th>Colaborador</th>
            <th>Setor</th>
        </tr>
    </tfoot>
</table>

