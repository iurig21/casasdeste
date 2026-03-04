<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice - Casas D'Este</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>

<body class="admin-body">
    <nav class="admin-nav">
        <div class="admin-nav__container">
            <div class="admin-nav__brand">
                <h1 class="admin-nav__title">Casas D'Este</h1>
                <span class="admin-nav__badge">Backoffice</span>
            </div>
            <a href="/admin/logout" class="admin-btn admin-btn--outline admin-btn--sm">Sair</a>
        </div>
    </nav>

    <main class="admin-main">
        <div class="admin-container">
            <div class="admin-header">
                <h2 class="admin-header__title">Downloads da Brochura</h2>
                <span class="admin-header__count">{{ $downloads->total() }} registos</span>
            </div>

            @if (session('success'))
                <div id="showSuccess" class="admin-alert admin-alert--success">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="admin-toolbar">
                <form method="GET" action="/admin/dashboard" class="admin-search">
                    <input class="admin-input admin-search__input" type="text" name="search" value="{{ $search }}" placeholder="Pesquisar por nome, email ou telefone...">
                    <button type="submit" class="admin-btn admin-btn--primary">Pesquisar</button>
                    @if ($search)
                        <a href="/admin/dashboard" class="admin-btn admin-btn--outline">Limpar</a>
                    @endif
                </form>
            </div>

            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($downloads as $download)
                            <tr>
                                <td>{{ $download->nome }}</td>
                                <td>{{ $download->email }}</td>
                                <td>{{ $download->telefone }}</td>
                                <td>{{ $download->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <form method="POST" action="/admin/downloads/{{ $download->id }}" onsubmit="return confirm('Tem a certeza que deseja eliminar este registo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn admin-btn--danger admin-btn--sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="admin-table__empty">
                                    Nenhum registo encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($downloads->hasPages())
                <div class="admin-pagination">
                    {{ $downloads->links() }}
                </div>
            @endif
        </div>
    </main>

    <script>
      const successAlert = document.getElementById('showSuccess');
      setTimeout(() => {
        if(successAlert){
            successAlert.style.display = 'none';
        }
      }, 3000);
    </script>
</body>
</html>
