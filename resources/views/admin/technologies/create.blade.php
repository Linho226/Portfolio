<x-app-layout>
    <x-slot name="header"><h2 class="section-title mb-0">Nouvelle technologie</h2></x-slot>
    <form method="POST" action="{{ route('admin.technologies.store') }}">
        @csrf
    <div class="admin-card p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ old('name', $technology->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Version</label>
                <input type="text" name="version" value="{{ old('version', $technology->version ?? '') }}" class="form-control" placeholder="8.x">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Categorie</label>
                <input type="text" name="category" value="{{ old('category', $technology->category ?? '') }}" class="form-control" placeholder="Frontend, Backend...">
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">URL Documentation</label>
                <input type="url" name="documentation_url" value="{{ old('documentation_url', $technology->documentation_url ?? '') }}" class="form-control" placeholder="https://...">
            </div>
        </div>
    </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Creer</button>
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
        </div>
    </form>
</x-app-layout>
