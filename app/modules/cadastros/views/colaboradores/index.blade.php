@extends('dashboard.index')

@section('main')
<section class="content">
    {{ HTML::head('Colaboradores', 'controla os colaboradores') }}
    <div class="box box-primary">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Colaboradores</h3>
            <div class="box-footer clearfix no-border">
                {{ Form::adicionar('/colaboradors/create') }}
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
        	<div class="well col-md-12">
			{{-- Inicio Formulario filtro por data --}}
			<div>
				{{ Form::open(['class'=>'navbar-form navbar-left']) }}

				{{ Form::label('Periodo: ', null, ['class'=>'nav-brand'])}}

				<div class="form-group">
						{{ Form::text('periodo', null, ['class'=>'form-control periodo', 'size'=>'30', 'placeholder'=>'Periodo']) }}
				</div>
				<div class="form-group">
					{{ Form::select('colaborador_id', [''=>'Selecione ...']+Colaborador::all()->lists('nome', 'id'), null, ['class'=>'form-control']) }}
				</div>
					{{ Form::button('Gerar', ['class'=>'btn btn-primary', 'id'=>'gerar_relatorio']) }}

				</div>

				{{ Form::close() }}

			{{-- Fim formulario filtro por data --}}
			</div>

            @include('cadastros::colaboradores.lista')
		</div>
    </div>
</section>
@endsection

@section('scripts')
{{ HTML::script('js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('js/plugins/datatables/dataTables.bootstrap.js') }}

<script type="text/javascript">
    $(function() {
        $("#colaboradors").dataTable();
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