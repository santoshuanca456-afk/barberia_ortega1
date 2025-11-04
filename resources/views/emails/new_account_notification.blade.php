<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Nueva Cuenta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
            background-color: #000; /* Asegurar un fondo contrastante */
            padding: 10px;
            border-radius: 5px;
        }

        .logo img {
            max-width: 150px;
        }

        h1 {
            color: #0073e6;
            font-size: 22px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 15px;
        }

        .alert {
            background-color: #ff6347;
            color: white;
            padding: 10px 15px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        table td {
            background-color: #ffffff;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #666;
        }

        .footer hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ config('site.url') . 'assets/images/logo_light.png' }}" alt="Logo">
        </div>

        <!-- Saludo -->
        <h1>Bienvenido/a, {{ $user->first_name }},</h1>

        <!-- Introducción -->
        <p><strong>{{ config('site.name') }} - Tu Nueva Cuenta</strong></p>
        <p>Se ha creado una cuenta para ti en {{ config('site.name') }}.</p>

        <!-- Alerta -->
        <div class="alert">Por favor, utiliza las siguientes credenciales para iniciar sesión</div>

        <!-- Credenciales -->
        <table>
            <tr>
                <th>Correo Electrónico</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Contraseña</th>
                <td>{{ $password }}</td>
            </tr>
            <tr>
                <th>Enlace de Inicio de Sesión</th>
                <td><a href="{{ route('admin.login') }}">{{ route('admin.login') }}</a></td>
            </tr>
        </table>

        <p><strong>Importante:</strong> Se te enviará un código de confirmación cuando intentes iniciar sesión por primera vez. Utiliza esta contraseña de un solo uso para cambiar tu contraseña y acceder al panel de administración.</p>

        <!-- Pie de página -->
        <div class="footer">
            <hr>
            <p>Si crees que este correo electrónico no está destinado a ti, por favor ignóralo o contáctanos en <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>.</p>
            <p>Saludos cordiales,<br>{{ config('site.name') }}</p>
        </div>
    </div>

</body>
</html>