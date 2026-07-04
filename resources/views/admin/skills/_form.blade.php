@csrf

<div class="row g-3">
    <div class="col-12 col-md-6">
        <label class="form-label">Nom</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $skill->name) }}"
            class="form-control"
            required
        >
        @error('name')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Categorie</label>
        <select
            name="category"
            class="form-select"
            required
        >
            <option value="">Selectionner</option>
            @foreach($categories as $category)
                <option value="{{ $category }}" @selected(old('category', $skill->category) === $category)>{{ $category }}</option>
            @endforeach
        </select>
        @error('category')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Icone</label>
        <input
            type="text"
            name="icon"
            value="{{ old('icon', $skill->icon) }}"
            class="form-control"
            placeholder="ex: fab fa-laravel"
        >
        @error('icon')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Niveau</label>
        <input
            type="text"
            name="level"
            value="{{ old('level', $skill->level) }}"
            class="form-control"
            placeholder="Debutant, Intermediaire, Expert"
        >
        @error('level')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Pourcentage</label>
        <input
            type="number"
            name="percentage"
            min="0"
            max="100"
            value="{{ old('percentage', $skill->percentage ?? 0) }}"
            class="form-control"
            required
        >
        @error('percentage')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Couleur</label>
        <input
            type="text"
            name="color"
            value="{{ old('color', $skill->color) }}"
            class="form-control"
            placeholder="#14b8a6"
        >
        @error('color')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Ordre</label>
        <input
            type="number"
            name="sort_order"
            min="0"
            value="{{ old('sort_order', $skill->sort_order ?? 0) }}"
            class="form-control"
            required
        >
        @error('sort_order')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mt-4 d-flex flex-wrap align-items-center gap-2">
    <button class="btn btn-primary">
        {{ $submitLabel }}
    </button>
    <a href="{{ route('admin.competences.index') }}" class="btn btn-outline-secondary">Annuler</a>
</div>
