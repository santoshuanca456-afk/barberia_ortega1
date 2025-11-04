<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activa Tu Cuenta</title>
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
        }

        p {
            margin-bottom: 20px;
        }

        a.button {
            background-color: #ff6347;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        a.button:hover {
            background-color: #5a1105;
        }

        .link-text {
            font-family: monospace, sans-serif;
            color: #333;
            font-size: 14px;
            word-wrap: break-word;
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            display: block;
            margin-top: 20px;
            word-break: break-all;
        }

        .footer {
            font-size: 12px;
            text-align: center;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
         <!-- Logo -->
         <div class="logo">
            <img src="{{ config('site.url') . 'assets/images/logo_light.png' }}" alt="Logo">
        </div>       

        <h1>Activa Tu Cuenta</h1>
        <p>Hola {{ $user->first_name }},</p>
        <p>Gracias por registrarte con nosotros. Para activar tu cuenta y acceder al panel de administración, haz clic en el siguiente botón:</p>
        
        <a href="{{ $activationLink }}" class="button">Activar Cuenta</a>
        
        <p>Si tienes problemas para hacer clic en el botón, puedes copiar el siguiente enlace y pegarlo en tu navegador:</p>
        
        <p class="link-text">{{ $activationLink }}</p>

        <p>Si no solicitaste este correo electrónico, por favor ignóralo o contacta a nuestro equipo de soporte.</p>
    </div>

    <div class="footer">
        <p>Saludos cordiales,<br>{{ config('site.name') }}</p>
        <p>Para cualquier problema, contáctanos en <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></p>
    </div>

</body>
</html>