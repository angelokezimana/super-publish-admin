<!-- Sidebar -->
<ul class="navbar-nav bg-gray-200 sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->routeIs('home')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Accueil</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Tableau de bord</span>
    </div>

    @if(auth()->user()->hasAnyPermission(['Voir Publications','Modifier Publications','Creer Publications','Supprimer Publications']))
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-clone"></i><span>Publications</span>
        </a>
    </li>
    @endif

    @if(auth()->user()->hasAnyPermission(['Voir Categories','Modifier Categories','Creer Categories','Supprimer Categories']))
    <li class="nav-item">
        <a class="nav-link" href="{{url('categories')}}">
            <i class="fas fa-fw fa-list-alt"></i><span>Categories</span>
        </a>
    </li>
    @endif
    
    @if(auth()->user()->hasAnyPermission(['Voir Utilisateurs','Creer Utilisateurs','Modifier Utilisateurs','Supprimer
    Utilisateurs']))
    <li class="nav-item {{ request()->routeIs('users*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-users"></i><span>Utilisateurs</span>
        </a>
    </li>
    @endif

    @if(auth()->user()->hasAnyPermission(['Voir Roles','Creer Roles','Modifier Roles','Supprimer Roles']))
    <li class="nav-item {{ request()->routeIs('roles*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="fas fa-fw fa-tasks"></i><span>R&ocirc;les</span>
        </a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        <i class="fas fa-tools"></i>
        <span>Outils</span>
    </div>

    @if(auth()->user()->hasAnyPermission(['Voir Rapports']))
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-chart-bar"></i><span>Rapports</span>
        </a>
    </li>
    @endif

    @if(auth()->user()->hasAnyPermission(['Corbeille']))
    <li class="nav-item {{ request()->routeIs('recycleBin*') ? 'active' : '' }}">
        <a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseDeletedData"
            aria-expanded="true" aria-controls="collapseDeletedData">
            <i class="fas fa-fw fa-trash-alt"></i>
            <span>Corbeilles</span>
        </a>

        <div id="collapseDeletedData" class="collapse" aria-labelledby="headingDeletedData"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Corbeilles:</h6>

                <a class="collapse-item" href="#">Publications</a>

                <a class="collapse-item" href="{{ url('/users_suppr') }}">Utilisateurs</a>

                <a class="collapse-item" href="{{ url('/categories_suppr')}}">Categories</a>

            </div>
        </div>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
