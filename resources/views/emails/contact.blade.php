<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova mensagem de contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #f3ede4;
            color: #fff;
            padding: 20px 30px;
            text-align: center;
        }
        .header img {
            display: block;
            margin: 0 auto;
            width: 168px;
            max-width: 100%;
            height: auto;
        }
        .body {
            padding: 30px;
        }
        .field {
            margin-bottom: 20px;
        }
        .field-label {
            font-weight: bold;
            color: #555;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .field-value {
            font-size: 16px;
            color: #333;
            line-height: 1.5;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 15px 30px;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $message->embed($logoPath) }}" alt="Casas D'Este logo">
        </div>
        <div class="body">
            <div class="field">
                <div class="field-label">Nome</div>
                <div class="field-value">{{ $nome }}</div>
            </div>
            <div class="field">
                <div class="field-label">E-mail</div>
                <div class="field-value">{{ $email }}</div>
            </div>
            <div class="field">
                <div class="field-label">Contacto</div>
                <div class="field-value">{{ $contacto }}</div>
            </div>
            <div class="field">
                <div class="field-label">Mensagem</div>
                <div class="field-value">{{ $mensagem }}</div>
            </div>
        </div>
        <div class="footer">
            Enviado através do formulário de contacto do website {{ config('app.name') }}.
        </div>
    </div>
</body>
</html>
