@extends('dashboard.index')

@section('main')

    <div class="box box-primary">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Colaboradores</h3>
            <div class="box-footer clearfix no-border">

            </div>
        </div><!-- /.box-header -->
        <div class="box-body">

			{{-- Inicio Formulario filtro por data --}}
			{{ Form::open(['class'=>'form form-horizontal']) }}

				<div class="form-group">
					<div class="col-md-3">
						{{ Form::label('Periodo: ', null, ['class'=>'nav-brand'])}}
						{{ Form::text('periodo', null, ['class'=>'form-control periodo', 'size'=>'30', 'placeholder'=>'Periodo']) }}
					</div>
					<div class="col-md-6">
						{{ Form::label('colaborador', 'Selecione um Colaborador: ', ['class'=>'form-label']) }}
						{{ Form::select('colaborador_id', [''=>'Selecione ...']+Colaborador::all()->lists('nome', 'id'), null, ['class'=>'form-control']) }}

					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						{{ Form::button('Gerar', ['class'=>'btn btn-primary', 'id'=>'gerar_relatorio']) }}
						{{ Form::button('Colaborador Por Posto de Trabalho', ['class'=>'btn btn-info','id'=>'por_posto']) }}
					</div>
				</div>

			{{ Form::close() }}

        	<div class="form-group">
                <div class="col-md-12">
                    <a href="/colaboradors/create" class="btn btn-default pull-right"><i class="glyphicon glyphicon-plus"></i> Adicionar</a>
                 </div>
             </div>
			{{-- Fim formulario filtro por data --}}
			</div>

            @include('cadastros::colaboradores.lista')
		</div>
    </div>


@endsection

@section('scripts')

<script type="text/javascript">
    $(function() {
    	$("#colaboradors").dataTable();
    	$('#por_posto').bind('click', function() {
    		window.open('/colaboradors/reports/por_posto', 'Report')
    	});

		$('#gerar_relatorio').bind('click', function() {
			periodo = $('input[name=periodo]').val()
			colaborador_id = $('select[name=colaborador_id]').val()

			if(periodo == '' || colaborador_id == ''){
				alert("Periodo e Colaborador devem ser informados!")
				return false;
			}

			window.open("/colaboradors/"+colaborador_id+"?periodo="+periodo, 'Print', 'channelmode=yes')
		});
		$('select[name=colaborador_id]').chosen()
    })
</script>
@stop