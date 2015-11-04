@extends('dashboard.index')

@section('main')
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h4 class="box-title">Setores</h4>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <div class="col-md-12">
                    <a href="/setors/create" class="btn btn-default pull-right"><i class="glyphicon glyphicon-plus"></i> Adicionar</a>
                 </div>
             </div>
            @include('cadastros::setors.lista')
        </div>
    </div>
</section>
@endsection