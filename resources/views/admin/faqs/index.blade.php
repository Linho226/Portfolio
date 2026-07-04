<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="section-title mb-0">FAQ</h2>
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">+ Ajouter</a>
        </div>
    </x-slot>
    @include('admin._partials.alert')
    <div class="admin-card p-0 overflow-hidden">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>Question</th><th>Ordre</th><th>Actif</th><th></th></tr></thead>
            <tbody>
                @forelse($faqs as $f)
                <tr>
                    <td class="align-middle">{{ Str::limit($f->question, 80) }}</td>
                    <td class="align-middle">{{ $f->sort_order }}</td>
                    <td class="align-middle"><span class="badge {{ $f->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $f->is_active ? 'Oui' : 'Non' }}</span></td>
                    <td class="align-middle text-end">
                        <a href="{{ route('admin.faqs.edit', $f) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form method="POST" action="{{ route('admin.faqs.destroy', $f) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-4">Aucune question.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $faqs->links() }}</div>
</x-app-layout>
