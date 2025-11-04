<div class="account_box">
    <div class="account_box_header">
        <h3>
            @auth
                Hola, {{ Auth::user()->first_name }}
            @else
                Cuenta
            @endauth
        </h3>
    </div>
    <hr/>
    <div class="account_box_body">
        @guest
            <ul class="cart_list">
                <li><a href="{{ route('auth.login') }}">Iniciar Sesión</a></li>
                <li><a href="{{ route('customer.account.create') }}">Registrarse</a></li>
                <li><a href="{{ route('home') }}">Inicio</a></li>
            </ul>
        @else
            <ul class="cart_list">
                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'global_admin')
                    <li><a href="{{ route('admin.dashboard') }}">Panel de Control</a></li>
                @elseif (Auth::user()->role === 'customer')
                    <li><a href="{{ route('customer.dashboard') }}">Panel de Control</a></li>
                @endif
                <li><a href="{{ route('auth.logout') }}">Cerrar Sesión</a></li>
                <li><a href="{{ route('home') }}">Inicio</a></li>
            </ul>
        @endauth
    </div>
</div>