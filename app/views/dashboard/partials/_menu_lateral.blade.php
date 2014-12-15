            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            {{ HTML::image('img/users/'.Auth::user()->avatar, null, array('class'=>'img-circle')) }}
                        </div>
                        <div class="pull-left info">
                            <p>Ola, {{ Auth::user()->nome }}</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="/">
                                <i class="fa fa-home"></i> <span>Pagina Inicial</span>
                            </a>
                        </li>
                            @foreach (Auth::user()->menus as $menu)
                                @if(!$menu->menu->menu_pai)
                                    <li class="treeview">
                                        <a href="#">
                                            <i class="fa {{ $menu->menu->icone  }}"></i>
                                            <span>{{ $menu->menu->descricao }}</span>
                                            <span>{{ $menu->menu->menu_pai }}</span>
                                            <i class="fa fa-angle-left pull-right"></i>

                                            <ul class="treeview-menu">
                                                @foreach($menu->menu->subMenus as $sub)
                                                        <li><a href="{{ $sub->url }}"><i class="fa {{ $sub->icone  }}"></i> {{ $sub->descricao }}</a></li>
                                                @endforeach
                                            </ul>
                                        </a>
                                @endif
                            </li>
                            @endforeach
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>