<x-app-layout>
    <x-slot name="header"><h2 class="section-title mb-0">Nouveau service</h2></x-slot>
    <form method="POST" action="{{ route('admin.services.store') }}">
        @csrf
    <div class="admin-card p-4">
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
                <input type="text" name="title" value="{{ old('title', $service->title ?? '') }}" class="form-control @error('title') is-invalid @enderror" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Icone <small class="text-muted">(emoji ou classe)</small></label>
                <input type="text" name="icon" value="{{ old('icon', $service->icon ?? '') }}" class="form-control" placeholder="⚡ ou fas fa-code">
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $service->description ?? '') }}</textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Ordre d'affichage</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_active">Actif</label>
                </div>
            </div>
        </div>
    </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Creer</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
        </div>
    </form>
</x-app-layout>
