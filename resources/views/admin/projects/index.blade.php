<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="section-title mb-0">Projets</h2>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ Ajouter</a>
        </div>
    </x-slot>
    @include('admin._partials.alert')
    <div class="admin-card p-0 overflow-hidden">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>Titre</th><th>Categorie</th><th>Date</th><th>A la une</th><th></th></tr></thead>
            <tbody>
                @forelse($projects as $p)
                <tr>
                    <td class="fw-semibold align-middle">{{ $p->title }}</td>
                    <td class="align-middle">{{ $p->category }}</td>
                    <td class="align-middle">{{ optional($p->project_date)->format('M Y') }}</td>
                    <td class="align-middle"><span class="badge {{ $p->is_featured ? 'bg-warning text-dark' : 'bg-light text-dark' }}">{{ $p->is_featured ? 'Oui' : 'Non' }}</span></td>
                    <td class="align-middle text-end">
                        <a href="{{ route('admin.projects.edit', $p) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $p) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Aucun projet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $projects->links() }}</div>
</x-app-layout>
