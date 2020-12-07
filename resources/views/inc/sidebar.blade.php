<div class="left-sidebar-pro">
        <nav id="sidebar" class="">
             <div class="image_div">
                <a> <img class="main-logo image_responsive" src="{{ asset('img/logo/logo.jpg') }}" alt="" /></a>
                <!-- <strong><a href="#"><img src="{{ asset('img/logo/logo.jpg') }}" alt="" /></a></strong>  -->
            </div> 
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">              
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                            <a title="tableau de bord ">
								   
								   <span class="fa fa-home"></span><span class="mini-click-non">Tableau de bord</span>
                            </a>
                        </li>
                        <li>
                            <a title="Publications" href="#" aria-expanded="false"><span class="fa fa-clone"></span> <span class="mini-click-non">Publications</span></a>
                        </li>
                        <li>
                            <a title="Paramètres"class="has-arrow" href="#" aria-expanded="false"><span class="fa fa-cogs"></span> <span class="mini-click-non">Paramètres</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="categories" href="{{url('categories')}}"><span class="mini-sub-pro"><i class="fa fa-list-alt"></i>&nbsp Categories</span></a></li>
                                
                            </ul>
                        </li>
                        <li>
                            <a title="Rapports" class="" href="#" aria-expanded="false"><span class="fa fa-bar-chart"></span> <span class="mini-click-non">Rapports</span></a>
                            
                        </li>
                        <li>
                            <a title="utilisateurs"  href="{{ route('users.index') }}" aria-expanded="false"><span class="fa fa-users"></span>  <span class="mini-click-non">Utilisateurs</span></a>                            
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><span class="fa fa-trash-o"></span>  <span class="mini-click-non">Corbeilles</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Publications supprimées" href="#"><span class="mini-sub-pro"><i class="fa fa-clone"></i>&nbsp Publications</span></a></li>
                                <li><a title="Utilisateurs supprimés" href="{{ url('/users_suppr') }}"><span class="mini-sub-pro"><i class="fa fa-users"></i>&nbsp Utilisateurs</span></a></li>
                                <li><a title="Categories supprimés" href="{{ url('/categories_suppr')}}"><span class="mini-sub-pro"><i class="fa fa-list-alt"></i>&nbsp Categories</span></a></li>
                            </ul>
                        </li>        
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    