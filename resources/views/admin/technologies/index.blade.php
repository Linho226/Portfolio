<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="section-title mb-0">Technologies</h2>
            <a href="{{ route('admin.technologies.create') }}" class="btn btn-primary">+ Ajouter</a>
        </div>
    </x-slot>
    @include('admin._partials.alert')
    <div class="admin-card p-0 overflow-hidden">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>Nom</th><th>Version</th><th>Categorie</th><th>Doc</th><th></th></tr></thead>
            <tbody>
                @forelse($technologies as $t)
                <tr>
                    <td class="fw-semibold align-middle">{{ $t->name }}</td>
                    <td class="align-middle">{{ $t->version }}</td>
                    <td class="align-middle">{{ $t->category }}</td>
                    <td class="align-middle">@if($t->documentation_url)<a href="{{ $t->documentation_url }}" target="_blank" class="btn btn-sm btn-link p-0">Voir</a>@endif</td>
                    <td class="align-middle text-end">
                        <a href="{{ route('admin.technologies.edit', $t) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form method="POST" action="{{ route('admin.technologies.destroy', $t) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Aucune technologie.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $technologies->links() }}</div>
</x-app-layout>
