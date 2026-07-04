<x-app-layout>
    <x-slot name="header"><h2 class="section-title mb-0">Messages recus</h2></x-slot>
    @include('admin._partials.alert')
    <div class="admin-card p-0 overflow-hidden">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>Nom</th><th>Sujet</th><th>Date</th><th>Lu</th><th></th></tr></thead>
            <tbody>
                @forelse($messages as $m)
                <tr class="{{ !$m->is_read ? 'fw-semibold' : '' }}">
                    <td class="align-middle">{{ $m->name }} <br><small class="text-muted fw-normal">{{ $m->email }}</small></td>
                    <td class="align-middle">{{ Str::limit($m->subject, 50) }}</td>
                    <td class="align-middle small">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                    <td class="align-middle"><span class="badge {{ $m->is_read ? 'bg-secondary' : 'bg-primary' }}">{{ $m->is_read ? 'Lu' : 'Nouveau' }}</span></td>
                    <td class="align-middle text-end">
                        <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-sm btn-outline-primary">Lire</a>
                        <form method="POST" action="{{ route('admin.messages.destroy', $m) }}" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Aucun message.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $messages->links() }}</div>
</x-app-layout>
