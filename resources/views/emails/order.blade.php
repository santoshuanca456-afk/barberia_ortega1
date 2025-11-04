<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Tu Pedido</title>
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
        <h1>Hola, {{ $customerName }},</h1>
        <p>¡Gracias por tu pedido! A continuación se detallan los datos de tu pedido.</p>

        <h3>Número de Pedido: {{ $orderNo }}</h3>

        <table class="order-table">
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Subtotal</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderItems as $item)
                    <tr>
                        <td>{{ $item['menu_name'] }}</td>
                        <td>{!! $site_settings->currency_symbol !!}{{ number_format($item['subtotal'], 2) }}</td>
                        <td>{{ $item['quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Subtotal:</strong> {!! $site_settings->currency_symbol !!}{{ number_format($totalPrice, 2) }}</p>
        <p><strong>Gastos de Envío:</strong> {!! $site_settings->currency_symbol !!}{{ number_format($deliveryFee, 2) }}</p>
        <p><strong>Precio Total Pagado:</strong> {!! $site_settings->currency_symbol !!}{{ number_format($totalPrice + $deliveryFee, 2) }}</p>

        <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos:</p>
        <p><strong>Información de Contacto:</strong></p>
        <p>Email: {{ $companyEmail }}</p>
        <p>Teléfono: {{ $companyPhone ? $companyPhone : 'No disponible' }}</p>

        <p>¡Gracias por tu pedido!</p>

        <!-- Pie de página -->
        <div class="footer">
            <hr>
            <p>Si crees que este correo electrónico no está destinado a ti, por favor ignóralo o contáctanos en <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>.</p>
            <p>Saludos cordiales,<br>{{ config('site.name') }}</p>
        </div>
    </div>

</body>
</html>