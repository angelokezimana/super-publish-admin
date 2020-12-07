<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="logo-pro">
                <a href="index.html"><img class="main-logo" src="" alt="" /></a>
            </div>
        </div>
    </div>
</div>
<div class="header-advance-area">
    <div class="header-top-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="header-top-wraper">
                        <div class="row">
                            <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                <div class="menu-switcher-pro">
                                    <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                        <i class=" fa fa-align-justify color_i"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">

                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <div class="header-right-info">
                                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                        <li class="nav-item dropdown">
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                <img src="img/product/pro4.jpg" alt="" />
                                                <span class="admin-name">
                                                    Bienvenue {{ Auth::user()->username }}
                                                </span>
                                                <i class="fa fa-angle-down edu-icon edu-down-arrow color_i"></i>
                                            </a>
                                            <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                <li><a href="{{ route('users.profile') }}"><span class="fa fa-user"></span>&nbsp; Mon Profil</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        D&eacute;connexion
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="nav-item nav-setting-open">
                                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a data-toggle="collapse" data-target="#Charts" href="#"><i class="fa fa-home"></i>&nbsp Tableau de bord<span class=""></span></a>
                                </li>
                                <li><a href="#"><i class="fa fa-clone"></i>&nbsp Publication</a></li>
                                <li><a data-toggle="collapse" data-target="#demoevent" href="#"><i class="fa fa-cogs"></i>&nbsp Paramètre <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                    <ul id="demoevent" class="collapse dropdown-header-top">
                                        <li><a href="{{url('categories')}}"><i class="fa fa-list-alt"></i>&nbsp Categories</a>
                                        </li>

                                    </ul>
                                </li>
                                <li><a herf="{{ route('users.index') }}" data-toggle="collapse" data-target="#demopro" href="#"><i class="fa fa-users"></i>&nbsp Utilisateurs <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>

                                </li>
                                <li><a href="" data-toggle="collapse" data-target="#democrou" href="#"><i class="fa fa-bar-chart"></i>&nbsp Rapports <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                </li>
                                <li><a data-toggle="collapse" data-target="#demoevent" href="#"><i class="fa fa-trash-o"></i>&nbsp Corbeille <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                    <ul id="demoevent" class="collapse dropdown-header-top">
                                        <li><a href="#"><i class="fa fa-clone"></i>&nbsp Publications</a>
                                        </li>
                                        <li><a href="{{ url('/users_suppr') }}"><i class="fa fa-users"></i>&nbsp Utilisateurs</a>
                                        </li>
                                        <li><a href="{{ url('/categories_suppr')}}"><i class="fa fa-list-alt"></i>&nbsp Categories</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>