<section class="content-header">
    <h1>S.I.G.
        <small>
            Sistemas Integrados para Gerenciamento.
        </small>
    </h1>
</section>
<section class="content">
    <div class="row">

@foreach(Auth::user()->menus()->where('menu_id', '<>', 2)->get() as $menu)
    @if(!$menu->menu->menu_pai)
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-{{ $menu->menu->color }}">
                <div class="inner">
                    <h3>
                        {{ $menu->menu->descricao }}
                    </h3>
                    <p class="lead">
                        .{{ $menu->menu->indice }}
                    </p>
                </div>
                <div class="icon">
                    <i class="{{ $menu->menu->icone }}"></i>
                </div>
                <a href="{{ $menu->menu->url }}" class="small-box-footer">
                    Entrar <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
                <!-- ./col -->
    @endif
@endforeach
</div>
</section>