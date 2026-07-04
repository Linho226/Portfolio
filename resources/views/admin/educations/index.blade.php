<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="section-title mb-0">Formations</h2>
            <a href="{{ route('admin.educations.create') }}" class="btn btn-primary">+ Ajouter</a>
        </div>
    </x-slot>
    @include('admin._partials.alert')
    <div class="admin-card p-0 overflow-hidden">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>Diplome</th><th>Etablissement</th><th>Annee</th><th>Mention</th><th></th></tr></thead>
            <tbody>
                @forelse($educations as $e)
                <tr>
                    <td class="fw-semibold align-middle">{{ $e->degree }}</td>
                    <td class="align-middle">{{ $e->school }}</td>
                    <td class="align-middle">{{ $e->year ?? optional($e->end_date)->format('Y') }}</td>
                    <td class="align-middle">{{ $e->mention }}</td>
                    <td class="align-middle text-end">
                        <a href="{{ route('admin.educations.edit', $e) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form method="POST" action="{{ route('admin.educations.destroy', $e) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Aucune formation.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $educations->links() }}</div>
</x-app-layout>
