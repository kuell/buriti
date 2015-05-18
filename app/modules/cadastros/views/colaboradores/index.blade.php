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

		{{-- Inicio Formulario filtro por data --}}
		<div>
			{{ Form::open(['class'=>'navbar-form navbar-left well']) }}

			{{ Form::label('Periodo: ', null, ['class'=>'nav-brand'])}}

			<div class="form-group">

					{{ Form::text('datai', null, ['class'=>'form-control col-xs-3 data', 'placeholder'=>'Data inicial']) }}
			</div>
			<div class="form-group">
				{{ Form::text('dataf', null, ['class'=>'form-control col-xs-3 data', 'placeholder'=>'Data Final']) }}
			</div>
			<div class="form-group">
				{{ Form::select('colaborador_id', [''=>'Selecione ...']+Colaborador::all()->lists('nome', 'id'), null, ['class'=>'form-control']) }}
			</div>
				{{ Form::button('Gerar', ['class'=>'btn btn-primary', 'id'=>'gerar_relatorio']) }}

			</div>

			{{ Form::close() }}
		</div>
		{{-- Fim formulario filtro por data --}}

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
        $("table").dataTable();
		$('#gerar_relatorio').bind('click', function() {
			datai = $('input[name=datai]').val()
			dataf = $('input[name=dataf]').val()
			colaborador_id = $('select[name=colaborador_id]').val()


			window.open("/colaboradors/"+colaborador_id+"?datai="+datai+"&dataf="+dataf, 'Print', 'channelmode=yes')
		});
		$('select[name=colaborador_id]').chosen()

    })
</script>
@stop