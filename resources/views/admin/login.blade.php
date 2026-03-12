<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice - Casas D'Este</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('imagens/favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
</head>

<body class="admin-body">
    <div class="admin-login">
        <div class="admin-login__card">
            <div class="admin-login__header">
                <img class="admin-login__logo" src="{{ asset('imagens/logo1.svg') }}" alt="Logo Casas D'Este">
                <p class="admin-login__subtitle">Backoffice</p>
            </div>

            @if ($errors->any())
                <div class="admin-alert admin-alert--error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="/admin/login" class="admin-login__form">
                @csrf
                <div class="admin-form-group">
                    <label class="admin-label" for="username">Username</label>
                    <input class="admin-input" type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
                </div>
                <div class="admin-form-group">
                    <label class="admin-label" for="password">Password</label>
                    <input class="admin-input" type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                <button id="login-btn" type="submit" class="admin-btn admin-btn--primary admin-btn--full">
                    <span id="login-text">Entrar</span>
                    <span id="login-spinner" style="display: none">
                        <x-lucide-loader class="animate-spin size-5"/>
                    </span>
                </button>
            </form>
            <a href="/" class="admin-btn admin-btn--block admin-login__back">← Voltar ao site</a>
        </div>
    </div>

    <script>
       document.getElementsByClassName("admin-login__form")[0].addEventListener('submit',() => {
            document.getElementById("login-btn").disabled = true;
            document.getElementById("login-text").style.display = "none";
            document.getElementById("login-spinner").style.display = "inline";            
       })
    </script>
</body>
</html>
