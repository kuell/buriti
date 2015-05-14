<div class="panel panel-default">
	@foreach(SesmtPostoRisco::all()->groupBy('tipo') as $tipo=>$val)
		<div class="col-md-3">
			<h5>{{ $tipo }} </h5>
			@foreach(SesmtPostoRisco::where('tipo', $tipo)->get() as $risco)
				<div class="font-sm">
					@if(SesmtPostoRisco::where('posto_id', $aso->posto_id)->count())
							<small>{{ Form::checkbox('risco', $risco->id , 1, ['disabled'=>'disabled']) }} {{ $risco->descricao}}</small>
					@else

						@if(AsoRisco::where('aso_id', $aso->id)->where('risco_id', $risco->id)->count() > 0 )
							<small>{{ Form::checkbox('risco', $risco->id , 1) }} {{ $risco->descricao}}</small>
						@else
							<small>{{ Form::checkbox('risco', $risco->id , 0) }} {{ $risco->descricao}}</small>
						@endif
					@endif
				</div>
			@endforeach
		</div>
	@endforeach
</div>