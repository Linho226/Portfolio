<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="section-title mb-0">Experiences</h2>
            <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary">+ Ajouter</a>
        </div>
    </x-slot>
    @include('admin._partials.alert')
    <div class="admin-card p-0 overflow-hidden">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>Poste</th><th>Entreprise</th><th>Periode</th><th>En cours</th><th></th></tr></thead>
            <tbody>
                @forelse($experiences as $e)
                <tr>
                    <td class="fw-semibold align-middle">{{ $e->role }}</td>
                    <td class="align-middle">{{ $e->company }}</td>
                    <td class="align-middle">{{ optional($e->start_date)->format('M Y') }} — {{ $e->is_current ? "Aujourd'hui" : optional($e->end_date)->format('M Y') }}</td>
                    <td class="align-middle"><span class="badge {{ $e->is_current ? 'bg-success' : 'bg-secondary' }}">{{ $e->is_current ? 'Oui' : 'Non' }}</span></td>
                    <td class="align-middle text-end">
                        <a href="{{ route('admin.experiences.edit', $e) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form method="POST" action="{{ route('admin.experiences.destroy', $e) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Aucune experience.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $experiences->links() }}</div>
</x-app-layout>
