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
                                    <button type="button" class="admin-btn admin-btn--danger admin-btn--sm" onclick="openDeleteModal('/admin/downloads/{{ $download->id }}', '{{ $download->nome }}')">Eliminar</button>
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

    <div id="deleteModal" class="admin-modal-overlay">
        <div class="admin-modal">
            <div class="admin-modal__header">
                <h3 class="admin-modal__title">Confirmar eliminação</h3>
            </div>
            <div class="admin-modal__body">
                <p>Tem a certeza que deseja eliminar o registo de <strong id="deleteModalName"></strong>?</p>
                <p class="admin-modal__warning">Esta ação não pode ser revertida.</p>
            </div>
            <div class="admin-modal__footer">
                <button type="button" class="admin-btn admin-btn--outline admin-btn--sm" onclick="closeDeleteModal()">Cancelar</button>
                <form id="deleteModalForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="admin-btn admin-btn--danger admin-btn--sm">Eliminar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
      const successAlert = document.getElementById('showSuccess');
      setTimeout(() => {
        if(successAlert){
            successAlert.style.display = 'none';
        }
      }, 3000);

      function openDeleteModal(action, name) {
        document.getElementById('deleteModalForm').action = action;
        document.getElementById('deleteModalName').textContent = name;
        document.getElementById('deleteModal').classList.add('is-open');
      }

      function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('is-open');
      }

      document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
      });

      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDeleteModal();
      });
    </script>
</body>
</html>
