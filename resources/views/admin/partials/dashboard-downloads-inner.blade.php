<div class="admin-header">
    <h2 class="admin-header__title">Downloads da Brochura</h2>
    <span class="admin-header__count">{{ $downloads->total() }} registos</span>
</div>

<div class="admin-toolbar">
    <form method="GET" action="{{ route('admin.dashboard') }}" class="admin-search">
        <input class="admin-input admin-search__input" type="text" name="search" value="{{ $search }}" placeholder="Pesquisar por nome, email ou telefone...">
        <div class="admin-search__dates">
            <label class="admin-search__date-field">
                <span class="admin-search__date-label">Desde</span>
                <input class="admin-input admin-search__date" type="date" name="date_from" value="{{ $dateFrom }}">
            </label>
            <label class="admin-search__date-field">
                <span class="admin-search__date-label">Até</span>
                <input class="admin-input admin-search__date" type="date" name="date_to" value="{{ $dateTo }}">
            </label>
        </div>
        <button type="submit" class="admin-btn admin-btn--primary">
            <x-lucide-search/>
            Pesquisar</button>
        @if ($search || $dateFrom || $dateTo)
            <a href="{{ route('admin.dashboard') }}" class="admin-btn admin-btn--outline admin-btn--clear">Limpar</a>
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
                <th>Data e hora</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($downloads as $download)
                <tr>
                    <td>{{ $download->nome }}</td>
                    <td>{{ $download->email }}</td>
                    <td>{{ $download->telefone }}</td>
                    <td>{{ $download->created_at->copy()->timezone('Europe/Lisbon')->format('d/m/Y H:i') }}</td>
                    <td>
                        <button type="button" class="admin-btn admin-btn--danger admin-btn--sm" onclick="openDeleteModal('{{ route('admin.downloads.destroy', $download->id) }}', @js($download->nome))">
                            <x-lucide-trash-2 class="shrink-0" aria-hidden="true" />
                            Eliminar
                        </button>
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
