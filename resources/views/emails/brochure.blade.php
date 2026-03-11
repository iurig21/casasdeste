<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brochura Casas D'Este</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            background: #f8f4ed;
            font-family: Arial, sans-serif;
            color: #1a1a1a;
        }
        .container {
            max-width: 640px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #eadfce;
            border-radius: 10px;
            overflow: hidden;
        }
        .header {
            background: #f3ede4;
            color: #8a6f4b;
            padding: 22px 28px;
            text-align: center;
            border-bottom: 1px solid #eadfce;
        }
        .header img {
            display: block;
            margin: 0 auto 12px auto;
            width: 168px;
            max-width: 100%;
            height: auto;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
        }
        .body {
            padding: 28px;
            line-height: 1.6;
            font-size: 16px;
        }
        .highlight {
            color: #8a6f4b;
            font-weight: bold;
        }
        .footer {
            background: #fbf8f3;
            color: #9a835f;
            padding: 14px 28px;
            font-size: 13px;
            border-top: 1px solid #eadfce;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $message->embed($logoPath) }}" alt="Casas D'Este logo">
        </div>
        <div class="body">
            <p>Olá, <b>{{ $nome }}</b>.</p>
            <p>Obrigado pelo seu interesse no projeto <span class="highlight">Casas D'Este</span>.</p>
            <p>A brochura em PDF segue em anexo neste email para consulta.</p>
            <p>Se tiver alguma questão, estamos à disposição para ajudar.</p>
        </div>
        <div class="footer">
            Equipa Casas D'Este
        </div>
    </div>
</body>
</html>
