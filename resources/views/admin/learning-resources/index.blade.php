<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="section-title mb-0">Ressources</h2>
            <a href="{{ route('admin.learning-resources.create') }}" class="btn btn-primary">+ Ajouter</a>
        </div>
    </x-slot>

    @include('admin._partials.alert')

    <div class="admin-card p-0 overflow-hidden">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Lien</th>
                    <th>Ordre</th>
                    <th>Statut</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($resources as $resource)
                    <tr>
                        <td class="fw-semibold align-middle">{{ $resource->title }}</td>
                        <td class="align-middle">{{ ucfirst($resource->type) }}</td>
                        <td class="align-middle">
                            <a href="{{ $resource->url }}" target="_blank" rel="noreferrer" class="text-decoration-none">
                                Ouvrir
                            </a>
                        </td>
                        <td class="align-middle">{{ $resource->sort_order }}</td>
                        <td class="align-middle">
                            <span class="badge {{ $resource->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $resource->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td class="align-middle text-end">
                            <a href="{{ route('admin.learning-resources.edit', $resource) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                            <form method="POST" action="{{ route('admin.learning-resources.destroy', $resource) }}" class="d-inline" onsubmit="return confirm('Supprimer cette ressource ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Aucune ressource. <a href="{{ route('admin.learning-resources.create') }}">Ajouter</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $resources->links() }}</div>
</x-app-layout>
