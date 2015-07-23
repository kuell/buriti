@extends('dashboard.index')

@section('main')
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                Controle de Fichas de Emprego
            </h3>

        </div>

        <div class="panel-body">
        <div class="form-group">
            {{ link_to_route('fichas.create', 'Nova Ficha', null, ['class'=>'btn btn-success']) }}
        </div>
            @include('cadastros::fichas.lista')
        </div>

    </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
</div>

<script type="text/javascript">
    $(function(){

        $('#fichas').dataTable();

        $('button[name=print]').bind('click', function(){
            window.open('/fichas/'+$(this).val(), 'Print', 'channelmode=yes');
        })
        $('button[name=selecionar]').bind('click',  function() {
            $('#myModal').modal({
                remote: '/fichas/'+$(this).val()+'/selecionar'
            })
        });
    });

</script>


@endsection
