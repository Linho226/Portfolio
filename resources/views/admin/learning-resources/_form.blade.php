@php
    $resource = $resource ?? null;
    $types = [
        'site' => 'Site web',
        'video' => 'Video',
        'documentation' => 'Documentation',
        'formation' => 'Formation',
        'outil' => 'Outil',
        'autre' => 'Autre',
    ];
@endphp

<div class="admin-card p-4">
    <div class="row g-3">
        <div class="col-md-8">
            <label class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
            <input type="text" name="title" value="{{ old('title', $resource->title ?? '') }}" class="form-control @error('title') is-invalid @enderror" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4">
            <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
            <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                @foreach($types as $value => $label)
                    <option value="{{ $value }}" @selected(old('type', $resource->type ?? 'site') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-12">
            <label class="form-label fw-semibold">Lien <span class="text-danger">*</span></label>
            <input type="url" name="url" value="{{ old('url', $resource->url ?? '') }}" class="form-control @error('url') is-invalid @enderror" placeholder="https://..." required>
            @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-12">
            <label class="form-label fw-semibold">Pourquoi cette ressource t'a aide ?</label>
            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Explique ce que tu as appris grace a cette ressource.">{{ old('description', $resource->description ?? '') }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-4">
            <label class="form-label fw-semibold">Ordre d'affichage</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $resource->sort_order ?? 0) }}" min="0" class="form-control">
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $resource->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="is_active">Afficher sur le site</label>
            </div>
        </div>
    </div>
</div>
