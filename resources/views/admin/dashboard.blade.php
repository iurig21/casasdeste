<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        (function () {
            try {
                var t = localStorage.getItem('adminTheme');
                document.documentElement.setAttribute('data-admin-theme', t === 'light' ? 'light' : 'dark');
            } catch (e) {
                document.documentElement.setAttribute('data-admin-theme', 'dark');
            }
        })();
    </script>
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
            <div class="admin-nav__end">
                <button type="button" id="adminThemeToggle" class="admin-theme-toggle" role="switch" aria-checked="false" aria-label="Ativar modo claro">
                    <span class="admin-theme-toggle__track">
                        <span class="admin-theme-toggle__bg" aria-hidden="true">
                            <span class="admin-theme-toggle__cell"><x-lucide-sun class="admin-theme-toggle__bg-icon" /></span>
                            <span class="admin-theme-toggle__cell"><x-lucide-moon class="admin-theme-toggle__bg-icon" /></span>
                        </span>
                        <span class="admin-theme-toggle__thumb" aria-hidden="true">
                            <x-lucide-sun class="admin-theme-toggle__thumb-icon admin-theme-toggle__thumb-icon--sun" />
                            <x-lucide-moon class="admin-theme-toggle__thumb-icon admin-theme-toggle__thumb-icon--moon" />
                        </span>
                    </span>
                </button>
                <a href="{{ route('admin.logout') }}" class="admin-nav__logout">Sair</a>
            </div>
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
                @include('admin.partials.dashboard-downloads-inner', compact('downloads', 'search', 'dateFrom', 'dateTo'))
            </div>
        </div>

    </main>

    <div id="deleteModal" class="admin-modal-overlay" hidden>
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
      (function () {
        var btn = document.getElementById('adminThemeToggle');
        if (!btn) return;
        function apply(theme) {
          document.documentElement.setAttribute('data-admin-theme', theme);
          try { localStorage.setItem('adminTheme', theme); } catch (e) {}
          var light = theme === 'light';
          btn.setAttribute('aria-checked', light ? 'true' : 'false');
          btn.classList.toggle('admin-theme-toggle--light', light);
          btn.setAttribute('aria-label', light ? 'Ativar modo escuro' : 'Ativar modo claro');
        }
        apply(document.documentElement.getAttribute('data-admin-theme') || 'dark');
        btn.addEventListener('click', function () {
          var next = document.documentElement.getAttribute('data-admin-theme') === 'light' ? 'dark' : 'light';
          apply(next);
        });
      })();

      function removeDashboardFeedbackEls() {
        ['showSuccess', 'ajaxDeleteSuccess', 'dashboardFeedback'].forEach((id) => {
          const el = document.getElementById(id);
          if (el) el.remove();
        });
      }

      function showDashboardFeedback(message, variant, brochureStyle = false) {
        const pane = document.querySelector('[data-admin-dashboard-pane]');
        if (!pane || !pane.parentNode) return;
        removeDashboardFeedbackEls();
        const div = document.createElement('div');
        div.id = variant === 'success' ? 'ajaxDeleteSuccess' : 'dashboardFeedback';
        if (variant === 'success') {
          div.className = 'admin-alert admin-alert--success animate-fade-out';
        } else {
          div.className = brochureStyle
            ? 'admin-alert admin-alert--brochure-error animate-fade-out'
            : 'admin-alert admin-alert--error animate-fade-out';
        }
        const p = document.createElement('p');
        p.textContent = message;
        div.appendChild(p);
        pane.parentNode.insertBefore(div, pane);
        setTimeout(() => div.remove(), 4000);
      }

      const successAlert = document.getElementById('showSuccess');
      setTimeout(() => {
        if (successAlert) {
          successAlert.remove();
        }
      }, 4000);

      function openDeleteModal(action, name) {
        const overlay = document.getElementById('deleteModal');
        if (!overlay) return;
        document.getElementById('deleteModalForm').action = action;
        document.getElementById('deleteModalName').textContent = name;
        overlay.hidden = false;
        overlay.classList.add('is-open');
      }

      function closeDeleteModal() {
        const overlay = document.getElementById('deleteModal');
        if (!overlay) return;
        overlay.classList.remove('is-open');
        overlay.hidden = true;
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

        async function loadDashboard(
          url,
          { skipHistory = false, loadErrorMessage = null } = {},
        ) {
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
            return true;
          } catch (err) {
            console.error(err);
            showDashboardFeedback(
              loadErrorMessage || 'Não foi possível carregar os registos.',
              'error',
              Boolean(loadErrorMessage),
            );
            return false;
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
                  showDashboardFeedback('Sessão expirada. Atualize a página.', 'error', false);
                } else {
                  showDashboardFeedback('Erro ao eliminar registo.', 'error', true);
                }
                return;
              }

              closeDeleteModal();

              let data = {};
              try {
                data = await res.json();
              } catch (_) {}

              const reloaded = await loadDashboard(window.location.href, {
                skipHistory: true,
                loadErrorMessage: 'Erro ao eliminar registo.',
              });
              if (reloaded) {
                showDashboardFeedback(
                  data.message || 'Registo eliminado com sucesso.',
                  'success',
                );
              }
            } catch (err) {
              console.error(err);
              showDashboardFeedback('Erro ao eliminar registo.', 'error', true);
            } finally {
              closeDeleteModal();
              pane.classList.remove('admin-dashboard-pane--loading');
              if (submitBtn) submitBtn.disabled = false;
            }
          });
        }
      })();
    </script>
</body>
</html>
