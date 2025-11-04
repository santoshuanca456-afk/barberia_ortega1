@extends('layouts.auth')  

@section('title', 'Admin - Activar Cuenta')

@section('content')
    <h4>¡Hola, {{ session('user_name') }}!</h4>
    <p>Por favor cambia tu contraseña para activar tu cuenta y acceder al panel de administración.</p>

    <!-- Incluir el message bag para mostrar errores de validación o mensajes de éxito -->
    @include('partials.message-bag')

    <form class="pt-3" method="POST" action="{{ route('admin.process.activate.account') }}">
        @csrf

        <!-- Campo de Contraseña Anterior -->
        <div class="form-group">
            <input type="password" name="old_password" class="form-control form-control-lg" id="oldPassword" placeholder="Contraseña Anterior" required>
        </div>

        <!-- Campo de Nueva Contraseña -->
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" id="newPassword" placeholder="Nueva Contraseña" required>
        </div>

        <!-- Campo de Confirmar Nueva Contraseña -->
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control form-control-lg" id="confirmPassword" placeholder="Confirmar Nueva Contraseña" required>
        </div>

        <div class="mt-3 mb-2">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Cambiar Contraseña</button>
        </div>

        <div class="mb-2">
            <a class="btn btn-block btn-warning auth-form-btn" href="{{ route('auth.password.request') }}">¿Olvidaste tu contraseña?</a>
        </div>

        <div class="mb-2">
            <a class="btn btn-block btn-secondary auth-form-btn" href="{{ route('home') }}">Ir al Sitio Web Principal</a>
        </div>


    </form>
@endsection