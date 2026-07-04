<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="section-title mb-0">Temoignages</h2>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">+ Ajouter</a>
        </div>
    </x-slot>
    @include('admin._partials.alert')
    <div class="admin-card p-0 overflow-hidden">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>Nom</th><th>Entreprise</th><th>Note</th><th>Actif</th><th></th></tr></thead>
            <tbody>
                @forelse($testimonials as $t)
                <tr>
                    <td class="fw-semibold align-middle">{{ $t->name }} <small class="text-muted">{{ $t->profession }}</small></td>
                    <td class="align-middle">{{ $t->company }}</td>
                    <td class="align-middle">{{ str_repeat('★', $t->rating ?? 5) }}</td>
                    <td class="align-middle"><span class="badge {{ $t->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $t->is_active ? 'Oui' : 'Non' }}</span></td>
                    <td class="align-middle text-end">
                        <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Aucun temoignage.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $testimonials->links() }}</div>
</x-app-layout>
