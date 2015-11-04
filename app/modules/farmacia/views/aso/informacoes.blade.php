<div class="modal fade" id="informacoes" tabindex="" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	      		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h3 class="modal-title">Informaçoes Adicionais</h3>
	      	</div>
		    <div class="modal-body">
		    	<div>
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#riscos" aria-controls="riscos" role="tab" data-toggle="tab">Riscos</a></li>
					    <li role="presentation"><a href="#exames" aria-controls="exames" role="tab" data-toggle="tab">Exames</a></li>
					</ul>

					<!-- Tab panes -->
				  	<div class="tab-content">
				    	<div role="tabpanel" class="tab-pane active" id="riscos">
				    		@include('farmacia::aso.partials._riscos')
				    	</div>
				    	<div role="tabpanel" class="tab-pane" id="exames">
				    		<iframe src="/farmacia/aso/{{ $aso->id }}/exames" style="width: 100%; height:400px; border:0;"></iframe>
				    	</div>
				    </div>
				</div>

		    </div>
		    <div class="modal-footer">

		    </div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$("input[name=risco]").click(function() {
			tipo = $(this).prop('checked');

			$.post('/farmacia/aso/risco/'+tipo, {aso_id: {{ $aso->id }}, risco_id: $(this).val() }, function(data){

			})

		});
	})

</script>