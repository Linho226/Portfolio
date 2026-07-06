<x-app-layout>
    <x-slot name="header"><h2 class="section-title mb-0">Modifier le service</h2></x-slot>
    @include('admin._partials.alert')
    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
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
            <div class="col-md-6">
                <label class="form-label fw-semibold">Image <small class="text-muted">(facultatif)</small></label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                <div class="form-text">Choisir une nouvelle image remplacera l'image actuelle.</div>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror

                @if($service->image)
                    <div class="mt-3 d-flex align-items-center gap-3">
                        <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->title }}" style="width:88px;height:64px;object-fit:cover;border-radius:10px;border:1px solid var(--adm-divider);">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                            <label class="form-check-label" for="remove_image">Supprimer l'image actuelle</label>
                        </div>
                    </div>
                @endif
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
            <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
        </div>
    </form>
</x-app-layout>
