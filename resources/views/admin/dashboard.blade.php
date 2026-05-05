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
                <a href="{{ route('admin.dashboard') }}">
                    <img class="admin-nav__logo" src="{{ asset('imagens/logo1.svg') }}" alt="Logo Casas D'Este">
                </a>
                <span class="admin-nav__badge">Backoffice</span>
            </div>
            <a href="{{ route('admin.logout') }}" class="font-display font-bold border-2 border-[#c4aa85] text-[#c4aa85] px-8 py-2 rounded-lg hover:bg-[#c4aa85] hover:text-white">Sair</a>
        </div>
    </nav>

    <main class="admin-main">
        <div class="admin-container">
            @if (session('success'))
                <div id="showSuccess" class="admin-alert admin-alert--success animate-fade-out">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div id="admin-dashboard-pane" class="admin-dashboard-pane" data-admin-dashboard-pane data-dashboard-url="{{ route('admin.dashboard') }}">
                @include('admin.partials.dashboard-downloads-inner', compact('downloads', 'search'))
            </div>
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
                    <button type="submit" class="admin-btn admin-btn--danger admin-btn--sm">
                        <x-lucide-trash-2 class="shrink-0" aria-hidden="true" />
                        Eliminar</button>
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
      }, 4000);

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

      (function () {
        const pane = document.querySelector('[data-admin-dashboard-pane]');
        if (!pane) return;

        async function loadDashboard(url, { skipHistory = false } = {}) {
          pane.classList.add('admin-dashboard-pane--loading');
          try {
            const res = await fetch(url, {
              headers: {
                'X-Requested-With': 'XMLHttpRequest',
                Accept: 'text/html',
              },
              credentials: 'same-origin',
            });

            if (!res.ok) {
              throw new Error('Request failed');
            }

            pane.innerHTML = await res.text();

            if (!skipHistory && typeof history !== 'undefined' && history.pushState) {
              const next = new URL(url, window.location.origin);
              history.pushState({ adminDashboardPane: true }, '', next.pathname + next.search + next.hash);
            }
          } catch (err) {
            console.error(err);
            window.alert('Não foi possível carregar os registos.');
          } finally {
            pane.classList.remove('admin-dashboard-pane--loading');
          }
        }

        pane.addEventListener('click', (e) => {
          const pagLink = e.target.closest('.admin-pagination a[href]');
          if (pagLink) {
            e.preventDefault();
            loadDashboard(pagLink.href);
            return;
          }

          const clearLink = e.target.closest('a.admin-btn--clear[href]');
          if (clearLink) {
            e.preventDefault();
            loadDashboard(clearLink.href);
          }
        });

        pane.addEventListener('submit', (e) => {
          const form = e.target.closest('form.admin-search');
          if (!form || form.method.toUpperCase() !== 'GET') return;
          e.preventDefault();

          const action = form.getAttribute('action') || pane.dataset.dashboardUrl || window.location.pathname;
          const params = new URLSearchParams(new FormData(form)).toString();
          const qs = params ? `?${params}` : '';
          loadDashboard(action + qs);
        });

        window.addEventListener('popstate', () => {
          loadDashboard(window.location.href, { skipHistory: true });
        });

        function showAjaxSuccess(message) {
          const oldEl = document.getElementById('ajaxDeleteSuccess');
          if (oldEl) oldEl.remove();
          const div = document.createElement('div');
          div.id = 'ajaxDeleteSuccess';
          div.className = 'admin-alert admin-alert--success animate-fade-out';
          const p = document.createElement('p');
          p.textContent = message;
          div.appendChild(p);
          pane.parentNode.insertBefore(div, pane);
          setTimeout(() => div.remove(), 4000);
        }

        const deleteModalForm = document.getElementById('deleteModalForm');
        if (deleteModalForm) {
          deleteModalForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const action = deleteModalForm.getAttribute('action');
            if (!action) return;

            const submitBtn = deleteModalForm.querySelector('button[type="submit"]');
            const fd = new FormData(deleteModalForm);

            pane.classList.add('admin-dashboard-pane--loading');
            if (submitBtn) submitBtn.disabled = true;

            try {
              const res = await fetch(action, {
                method: 'POST',
                headers: {
                  'X-Requested-With': 'XMLHttpRequest',
                  Accept: 'application/json',
                  'X-CSRF-TOKEN': fd.get('_token'),
                },
                body: fd,
                credentials: 'same-origin',
              });

              if (!res.ok) {
                if (res.status === 419 || res.status === 401) {
                  window.alert('Sessão expirada. Atualize a página.');
                } else {
                  window.alert('Não foi possível eliminar o registo.');
                }
                return;
              }

              let data = {};
              try {
                data = await res.json();
              } catch (_) {}
              closeDeleteModal();
              await loadDashboard(window.location.href, { skipHistory: true });
              showAjaxSuccess(data.message || 'Registo eliminado com sucesso.');
            } catch (err) {
              console.error(err);
              window.alert('Não foi possível eliminar o registo.');
            } finally {
              pane.classList.remove('admin-dashboard-pane--loading');
              if (submitBtn) submitBtn.disabled = false;
            }
          });
        }
      })();
    </script>
</body>
</html>
