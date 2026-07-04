<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm">← Retour</a>
            <h2 class="section-title mb-0">Message de {{ $message->name }}</h2>
        </div>
    </x-slot>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card p-4">
                <p class="text-muted small mb-1">Sujet</p>
                <h5 class="fw-bold mb-4">{{ $message->subject }}</h5>
                <div style="white-space:pre-wrap;line-height:1.8;">{{ $message->message }}</div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="admin-card p-4">
                <p class="text-muted small mb-1">Expéditeur</p>
                <p class="fw-semibold mb-0">{{ $message->name }}</p>
                <a href="mailto:{{ $message->email }}" class="text-primary">{{ $message->email }}</a>
                @if($message->phone)<p class="mt-2 mb-0">{{ $message->phone }}</p>@endif
                <hr>
                <p class="text-muted small mb-1">Recu le</p>
                <p class="mb-0">{{ $message->created_at->format('d/m/Y à H:i') }}</p>
                <div class="mt-3">
                    <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary w-100">Repondre par email</a>
                </div>
                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="mt-2" onsubmit="return confirm('Supprimer ?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger w-100">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
