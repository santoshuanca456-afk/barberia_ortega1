<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Nueva Reserva de Mesa</title>
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
        <h1>Notificación de Nueva Reserva de Mesa</h1>

        <!-- Detalles de la Reserva -->
        <p>Estimado Administrador,</p>
        <p>Se ha realizado una nueva reserva de mesa:</p>
        <ul>
            <li><strong>Nombre:</strong> {{ $booking->name }}</li>
            <li><strong>Email:</strong> {{ $booking->email }}</li>
            <li><strong>Teléfono:</strong> {{ $booking->phone }}</li>
            <li><strong>Fecha:</strong> {{ $booking->date }}</li>
            <li><strong>Hora:</strong> {{ $booking->time }}</li>
            <li><strong>Personas:</strong> {{ $booking->persons }}</li>
        </ul>
        <p>Por favor, inicie sesión en el panel de administración para ver más detalles.</p>

        <!-- Pie de página -->
        <div class="footer">
            <hr>
            <p>Saludos cordiales,<br>{{ config('site.name') }}</p>
        </div>
    </div>
</body>
</html>