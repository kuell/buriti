<table class="table" id="investigacaos">
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
            <td>
                <button name="visualizar" class="btn btn-primary btn-sm" value="{{ $investigacao->ocorrencia->id }}">{{ $investigacao->ocorrencia->id }}</button>
            </td>
            <td>{{ $investigacao->ocorrencia->data_hora }}</td>
            <td>{{ $investigacao->ocorrencia->colaborador->nome }}</td>
            <td>{{ $investigacao->ocorrencia->colaborador->setor->descricao or 'Não Informado' }}</td>
            <td>{{ $investigacao->situacao }}</td>
            <td>
                {{ Form::button(' ', ['class'=>'btn btn-primary btn-sm glyphicon glyphicon-search','title'=>'Investigar' , 'name'=>'investigar', 'value'=>$investigacao->id]) }}
                {{ link_to_route('sesmt.investigacao.edit', ' ', $investigacao->id, ['class'=>'btn btn-sm btn-info glyphicon glyphicon-pencil']) }}

                {{ Form::button(' ', ['class'=>'btn btn-success btn-sm glyphicon glyphicon-ok', 'name'=>'finalizar', 'value'=>$investigacao->id]) }}

            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

</div>
<script type="text/javascript">

    $(function(){
        $('button[name=finalizar]').bind('click', function(event) {
            $('#myModal').modal({
                remote: '/sesmt/investigacao/'+$(this).val()+'/finalizar'
            })
        });

        $('button[name=visualizar]').bind('click', function(){
            $('#myModal').modal({
                remote:'/sesmt/investigacao/'+$(this).val()+'/redirecionar'
            })
        })
        $('#myModal').on('hidden.bs.modal', function(e){
            location.reload()
        })

        $('button[name=investigar]').bind('click', function(){
            window.open('/sesmt/investigacao/'+$(this).val()+'/print', 'Investigar', 'channelmode=yes')
        })

        $("#investigacaos").dataTable();
    });
</script>