<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <h2 class="h4 mb-0 section-title">
                Gestion des competences
            </h2>
            <a href="{{ route('admin.competences.create') }}" class="btn btn-primary">
                Nouvelle competence
            </a>
        </div>
    </x-slot>

    <div class="vstack gap-4">
        <div class="admin-card text-bg-primary p-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <p class="mb-0">Ajoute rapidement une competence a ton portfolio.</p>
                <a href="{{ route('admin.competences.create') }}" class="btn btn-light btn-sm">Ajouter une competence</a>
            </div>
        </div>

        @if(session('status'))
            <div class="alert alert-success mb-0" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="admin-card p-4">
            <form method="GET" action="{{ route('admin.competences.index') }}" class="row g-3 align-items-end">
                <div class="col-12 col-md-5">
                    <label class="form-label">Recherche</label>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nom, categorie, niveau"
                        class="form-control"
                    >
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label">Categorie</label>
                    <select name="category" class="form-select">
                        <option value="">Toutes les categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-3 d-flex gap-2">
                    <button class="btn btn-dark w-100">Filtrer</button>
                    <a href="{{ route('admin.competences.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            </form>
        </div>

        <div class="admin-card overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Categorie</th>
                            <th>Niveau</th>
                            <th>Pourcentage</th>
                            <th>Ordre</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skills as $skill)
                            <tr>
                                <td class="fw-semibold">{{ $skill->name }}</td>
                                <td>{{ $skill->category }}</td>
                                <td>{{ $skill->level ?? '-' }}</td>
                                <td>
                                    <span class="badge text-bg-primary">{{ $skill->percentage }}%</span>
                                </td>
                                <td>{{ $skill->sort_order }}</td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.competences.edit', $skill) }}" class="btn btn-outline-primary">Modifier</a>
                                        <form action="{{ route('admin.competences.destroy', $skill) }}" method="POST" onsubmit="return confirm('Supprimer cette competence ?');" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <p class="text-muted mb-3">Aucune competence enregistree.</p>
                                    <a href="{{ route('admin.competences.create') }}" class="btn btn-primary">Ajouter la premiere competence</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-top p-3">
                {{ $skills->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
