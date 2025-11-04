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
                <i class="fa fa-tachometer-alt menu-icon"></i>
                <span class="menu-title">Panel</span>
            </a>
        </li>

        <li class="nav-item nav-category">
            <span class="nav-link">Gestión de Servicios</span>
        </li>
        
        <li class="nav-item {{ request()->route()->named('admin.menus.index') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.menus.index') }}">
                <i class="fa fa-concierge-bell menu-icon"></i> 
                <span class="menu-title">Servicios</span>
            </a>
        </li>

        <li class="nav-item {{ request()->route()->named('admin.categories.index') ? 'active-nav' : '' }}">
             <a class="nav-link" href="{{ route('admin.categories.index') }}">
                <i class="fa fa-layer-group menu-icon"></i> 
                <span class="menu-title">Categoría</span>
            </a>
        </li>

        <li class="nav-item nav-category">
            <span class="nav-link">Operaciones Diarias</span>
        </li>

        <li class="nav-item {{ Request::is('admin/pos/index') || Request::is('admin/order*') ? 'active-nav' : '' }}">
            <a class="nav-link collapsed" data-toggle="collapse" href="#gestion-pagos" aria-expanded="false" aria-controls="gestion-pagos">
                <i class="fa fa-cash-register menu-icon"></i>
                <span class="menu-title">Gestión de Pagos</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/pos/index') || Request::is('admin/order*') ? 'show' : '' }}" id="gestion-pagos">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->route()->named('admin.pos.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.pos.index') }}">Crear Pago</a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/order*') && !request()->route()->named('admin.pos.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.orders.index') }}">Ver Pago</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{ request()->route()->named('admin.table-bookings') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.table-bookings') }}">
                <i class="fa fa-calendar-check menu-icon"></i>
                <span class="menu-title">Reservas</span>
            </a>
        </li>

        <li class="nav-item nav-category">
            <span class="nav-link">Gestión de Personal</span>
        </li>

        <li class="nav-item nav-category">
            <span class="nav-link">Gestión Empresarial</span>
        </li>
        
        <li class="nav-item">
            <a target="_blank" class="nav-link" href="{{ route('home') }}">
                <i class="fa fa-store menu-icon"></i>
                <span class="menu-title">Revista</span>
            </a>
        </li>

        <li class="nav-item {{ Request::is('admin/blog*') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.blog.index') }}">
                <i class="fa fa-percent menu-icon"></i>
                <span class="menu-title">Gestión de Ofertas</span>
            </a>
        </li>

        @if ($loggedInUser->role == "global_admin")
        <li class="nav-item {{ Request::is('admin/terms/edit') || Request::is('admin/privacy-policy/edit') || Request::is('admin/general-settings') ? 'active-nav' : '' }}">
            <a class="nav-link collapsed" data-toggle="collapse" href="#revista-footer" aria-expanded="false" aria-controls="revista-footer">
                <i class="fa fa-cogs menu-icon"></i>
                <span class="menu-title">Pie de Revista</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/terms/edit') || Request::is('admin/privacy-policy/edit') || Request::is('admin/general-settings') ? 'show' : '' }}" id="revista-footer">
                <ul class="nav flex-column sub-menu">
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
        
        <li class="nav-item {{ request()->route()->named('admin.users.index') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fa fa-user-friends menu-icon"></i>
                <span class="menu-title">Gestionar Usuarios</span>
            </a>
        </li>
        @endif

        <li class="nav-item nav-category">
            <span class="nav-link">Configuración</span>
        </li>
        
        <li class="nav-item {{ request()->route()->named('admin.view.myprofile') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('admin.view.myprofile') }}">
                <i class="fa fa-id-card menu-icon"></i>
                <span class="menu-title">Configurar Perfil</span>
            </a>
        </li>

        <li class="nav-item {{ request()->route()->named('change.password.form') ? 'active-nav' : '' }}">
            <a class="nav-link" href="{{ route('change.password.form') }}">
                <i class="fa fa-key menu-icon"></i>
                <span class="menu-title">Cambiar Contraseña</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="fa fa-sign-out-alt menu-icon"></i>
                <span class="menu-title">Cerrar Sesión</span>
            </a>
        </li>
    </ul>
</nav>