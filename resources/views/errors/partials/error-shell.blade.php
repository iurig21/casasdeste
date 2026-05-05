{{--
    Expects: $pageTitle, $code, $headline, $errorDescription
    Optional: $ctaHref (default /), $ctaLabel (default "Voltar ao início")
--}}
@php
    $ctaHref = $ctaHref ?? url('/');
    $ctaLabel = $ctaLabel ?? 'Voltar ao início';
@endphp
<!DOCTYPE html>
<html lang="pt-br" data-theme="lofi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }} — Casas D'Este</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('imagens/favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="error-page-body">
    <header>
        <nav class="site-nav" aria-label="Principal">
            <div class="site-nav__container">
                    <img src="{{ asset('imagens/logo1.svg') }}" alt="Casas D'Este" class="site-nav__brand-symbol" width="120" height="46">
            </div>
        </nav>
    </header>

    <main class="error-page">
        <div class="error-page__inner">
            <p class="error-page__code" aria-hidden="true">{{ $code }}</p>
            <h1 class="error-page__headline">{{ $headline }}</h1>
            <p class="error-page__message">{{ $errorDescription }}</p>
            @if ($code !== '503')
                 <a href="{{ $ctaHref }}" class="error-page__cta">{{ $ctaLabel }}</a>
            @endif
        </div>
    </main>
</body>

</html>
