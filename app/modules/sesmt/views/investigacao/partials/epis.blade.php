<div class="row">

    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left">Uso de Proteção Individual</h4>
            <div class="btn-group pull-right">
                {{-- Form::submit('Proximo >>', ['class'=>'btn btn-success btn-sm']) --}}
            </div>
        </div>
    <div class="panel-body">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="col-md-3">
                    O Colaborador usava E.P.I. ?
                </div>
                <div class="col-md-6">
                    {{ Form::select('usava_epi', ['nao', 'sim'], $investigacao->usava_epi , ['class'=>'form-control col-md-4']) }}
                </div>
            </div>

            @if($investigacao->usava_epi)
            <div class="col-md-12">
                <div class="col-md-12">
                    <h3>E.P.I. utilizados</h3>
                </div>
                    <iframe style="border:0;" height="500" class="col-md-12" src="/sesmt/investigacao/{{ $investigacao->id }}/epi"></iframe>
            </div>
            @elseif(!$investigacao->usava_epi)
            <div class="col-md-12">
                <div class="col-md-12">
                    Motivo pelo qual não utilizava E.P.I.
                </div>
                <div class="col-md-12">
                    {{ Form::textarea('motivo_epi', $investigacao->motivo_epi, ['class'=>'form-control'])}}
                </div>
            </div>
            @endif

        </div>
    </div>

    <div class="panel-footer">
        {{ Form::submit('Proximo >>', ['class'=>'btn btn-success btn-sm'])}}
    </div>

    </div>
    </div>

@section('scripts')
    <script type="text/javascript">
        $(function(){
            // Epis
            $('select[name=usava_epi').change(function(event) {
                if($(this).val() == 1){
                    $('#epi_descricao').addClass('invisible')

                    $('#myModal').on('show', function(){
                        $('#janela').attr('src', '/sesmt/investigacao/{{ $investigacao->id }}/epi');
                    })

                    $('#myModal').modal({
                        show: true,
                        keyboard: false
                    })
                    $('#myModal').on('hide.bs.modal', function(){
                        alert('Ola');
                        window.location = '/sesmt/investigacao/{{ $investigacao->id }}/edit?pg=organizacao';
                    })
                }
                else if($(this).val() == 0){
                    $('#epi_descricao').removeClass('invisible');
                    $('#epis').addClass('invisible')
                }
                else{
                    $('#epi_descricao').addClass('invisible');
                    $('#epis').addClass('invisible')
                }
            });
    // -- Fim Epi
        })
    </script>


@stop