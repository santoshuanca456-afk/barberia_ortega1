<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Cambio de Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
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
            color: #0056b3;
            text-align: left;
        }

        .alert {
            background-color: #cc2900;
            color: white;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
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
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ config('site.url').'assets/images/logo_light.png' }}" alt="Logo">
        </div>

        <!-- Saludo -->
        <h1>Hola {{ $user->first_name }},</h1>

        <!-- Introducción -->
        <p><strong>{{ config('site.name') }} - Notificación de Cambio de Contraseña</strong></p>
        <p>Tu contraseña ha sido cambiada exitosamente.</p>

        <!-- Alerta -->
        <div class="alert">Si no realizaste este cambio, por favor contacta a nuestro equipo de soporte inmediatamente.</div>

        <p><strong>Email de Soporte:</strong> <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></p>

        <!-- Pie de página -->
        <div class="footer">
            <hr>
            <p>Saludos cordiales,<br>{{ config('site.name') }}</p>
        </div>
    </div>
</body>
</html>