
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            {{ HTML::image('img/users/'.Auth::user()->avatar, null, array('class'=>'img-circle')) }}
                        </div>
                        <div class="pull-left info">
                            <p>Ola, {{ strtoupper(Auth::user()->user) }}</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <!--input type="text" name="q" class="form-control" placeholder="Search..."/-->
                            <span class="input-group-btn">
                                <!--button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button-->
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="/">
                                <i class="fa fa-plus-circle"></i> <span>Inicio</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="ajuda"><span>Precisa de ajuda?</span></a>
                        </li>

                        @foreach (Auth::user()->menus()->where('menu_id', 2)->get() as $menu)
                            @foreach($menu->menu->subMenus as $sub)
                            @if($sub->permite(Auth::user()))
                            <li class="active">
                                <a href="{{ $sub->url }}">
                                    <i class="fa {{ $sub->icone  }}"></i>
                                    <span>{{ $sub->descricao }}</span>
                                    <span>{{ $menu->menu->menu_pai }}</span>

                                </a>
                            </li>
                            @endif
                            @endforeach
                        @endforeach
                    </ul>
                </section>
                <!-- /.sidebar -->






                <script type="text/javascript">
                $(function(){
                    $('#ajuda').bind('click', function() {
                        $('#chatModal').modal()
                    });
                })

                </script>