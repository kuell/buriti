@extends('dashboard.index')

@section('main')
{{ Form::model($ficha, array('route' => ['fichas.update', $ficha->id], 'method'=>'patch', 'rule'=>'form', 'files'=>true)) }}

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Alterar ficha <small>{{ $ficha->id }} - {{ $ficha->nome  }}</small></h3>
	</div>

	<div class="panel-body">
		{{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}
		{{ Form::button('Informações Adicionais', ['class'=>'btn btn-info', 'id'=>'info']) }}
		{{ Form::button('Print', ['class'=>'btn btn-warning', 'name'=>'print', 'value'=>$ficha->id]) }}
		{{ link_to_route('fichas.index', 'Voltar', null, ['class'=>'btn btn-danger']) }}

		<div class="form-group">
			<div class="col-md-3">
				{{ Form::label('situacao ', 'Situação da Ficha: ', ['class'=>'form-label']) }}
				{{ Form::select('situacao', [1=>'Normal', 3=>'Indisponivel Pelo RH'], $ficha->situacao, ['class'=>'form-control']) }}
			</div>
		</div>


		@include('cadastros::fichas.form')
	</div>
</div>
{{ Form::close() }}


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Informações adicionais da ficha</h4>
			</div>
			<div class="modal-body">
				<div>
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#instrucao" aria-controls="instrucao" role="tab" data-toggle="tab">Nivel de Instrucao</a></li>
						<li role="presentation"><a href="#curso" aria-controls="curso" role="tab" data-toggle="tab">Cursos Extra</a></li>
						<li role="presentation"><a href="#emprego" aria-controls="emprego" role="tab" data-toggle="tab">Empregos Anteriores</a></li>
						<li role="presentation"><a href="#parente" aria-controls="parente" role="tab" data-toggle="tab">Familiares</a></li>
						<li role="presentation"><a href="#setor" aria-controls="setor" role="tab" data-toggle="tab">Pretensões</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="instrucao">
							<iframe src="/fichas/instrucao/{{ $ficha->id }}" style="width: 100%; height:500px ; border:0px; "></iframe>
						</div>
						<div role="tabpanel" class="tab-pane" id="curso">
							<iframe src="/fichas/cursos/{{ $ficha->id }}" style="width: 100%; height:500px ; border:0px; "></iframe>
						</div>
						<div role="tabpanel" class="tab-pane" id="emprego">
							<iframe src="/fichas/empregos/{{ $ficha->id }}" style="width: 100%; height:500px ; border:0px; "></iframe>
						</div>
						<div role="tabpanel" class="tab-pane" id="parente">
							<iframe src="/fichas/parentes/{{ $ficha->id }}" style="width: 100%; height:500px ; border:0px; "></iframe>
						</div>
						<div role="tabpanel" class="tab-pane" id="setor">
							<iframe src="/fichas/setors/{{ $ficha->id }}" style="width: 100%; height:500px ; border:0px; "></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(function() {
		$('#info').bind('click', function() {
			$('#myModal').modal()
		});

		$('button[name=print]').bind('click', function(){
			window.open('/fichas/'+$(this).val(), 'Print', 'channelmode=yes')
		})
	})
</script>

@endsection