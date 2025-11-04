<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <div class="d-flex sidebar-profile">
                <div class="sidebar-profile-image">
                    <img src=" {{ $loggedInUser && $loggedInUser->profile_picture ? asset('storage/profile-picture/' . $loggedInUser->profile_picture) : asset('assets/images/user-icon.png') }}" alt="image">
                    <span class="sidebar-status-indicator"></span>
                </div>
                <div class="sidebar-profile-name">
                    <p class="sidebar-name">
                        {{ $loggedInUser->first_name }}
                    </p>
                    <p class="sidebar-designation">
                        Administrador
                    </p>
                </div>
            </div>
        </li>

        <li class="nav-item {{ request()->route()->named('admin.dashboard') ? 'active-nav' : '' }} ">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fa fa-desktop menu-icon"></i>
                <span class="menu-title">Panel de Control</span>
            </a>
        </li>
        
        <li class="nav-item {{ request()->route()->named('admin.pos.index') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.pos.index') }}">
                <i class="fa fa-shopping-cart menu-icon" ></i>
                <span class="menu-title">Punto de Venta</span>
            </a>
        </li>
        
        <li class="nav-item {{ Request::is('admin/order*') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                <i class="fa fa-file menu-icon"></i>
                <span class="menu-title">Gestionar Pedidos</span>
            </a>
        </li>
        
        <li class="nav-item {{ request()->route()->named('admin.table-bookings') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.table-bookings') }}">
                <i class="fa fa-folder-open menu-icon"></i>
                <span class="menu-title">Gestionar Reservas</span>
            </a>
        </li>        
        
        <li class="nav-item {{ Request::is('admin/blog*') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.blog.index') }}">
                <i class="far fa-newspaper menu-icon"></i>
                <span class="menu-title">Gestionar Blog</span>
            </a>
        </li>

        @if ($loggedInUser->role == "global_admin")
        <li class="nav-item {{ request()->route()->named('admin.users.index') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fa fa-users menu-icon"></i>
                <span class="menu-title">Gestionar Administradores</span>
            </a>
        </li>
            
        <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#site-settings" aria-expanded="false" aria-controls="site-settings">
                <i class="fa fa-cog menu-icon"></i>
                <span class="menu-title">Configuración del Sitio</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="site-settings" style="">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.menus.index') }}">Menú</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.categories.index') }}">Categoría</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.testimonies.index') }}">Testimonio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.terms.edit') }}">Términos y Condiciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.privacy-policy.edit') }}">Política de Privacidad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.general-settings') }}">Configuración General</a>
                    </li>
                </ul>
            </div>
        </li>
        @endif

        <li class="nav-item {{ request()->route()->named('admin.view.myprofile') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.view.myprofile') }}">
                <i class="fa fa-user menu-icon"></i>
                <span class="menu-title">Mi Perfil</span>
            </a>
        </li>

        <li class="nav-item {{ request()->route()->named('change.password.form') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('change.password.form') }}">
                <i class="fa fa-lock menu-icon"></i>
                <span class="menu-title">Cambiar Contraseña</span>
            </a>
        </li>     

        <li class="nav-item">
            <a target="_blank" class="nav-link" href="{{ route('home') }}">
                <i class="fa fa-globe menu-icon"></i>
                <span class="menu-title">Sitio Web Principal</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="fa fa-power-off menu-icon"></i>
                <span class="menu-title">Cerrar Sesión</span>
            </a>
        </li>
    </ul>
</nav>