<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="section-title mb-0">Services</h2>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">+ Ajouter</a>
        </div>
    </x-slot>
    @include('admin._partials.alert')
    <div class="admin-card p-0 overflow-hidden">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>Service</th><th>Visuel</th><th>Icone</th><th>Ordre</th><th>Statut</th><th></th></tr></thead>
            <tbody>
                @forelse($services as $s)
                <tr>
                    <td class="fw-semibold align-middle">{{ $s->title }}</td>
                    <td class="align-middle">
                        @if($s->image)
                            <img src="{{ asset('storage/'.$s->image) }}" alt="{{ $s->title }}" style="width:54px;height:38px;object-fit:cover;border-radius:8px;border:1px solid var(--adm-divider);">
                        @else
                            <span class="text-muted small">Aucune</span>
                        @endif
                    </td>
                    <td class="align-middle">{{ $s->icon }}</td>
                    <td class="align-middle">{{ $s->sort_order }}</td>
                    <td class="align-middle"><span class="badge {{ $s->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $s->is_active ? 'Actif' : 'Inactif' }}</span></td>
                    <td class="align-middle text-end">
                        <a href="{{ route('admin.services.edit', $s) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form method="POST" action="{{ route('admin.services.destroy', $s) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Aucun service. <a href="{{ route('admin.services.create') }}">Ajouter</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $services->links() }}</div>
</x-app-layout>
