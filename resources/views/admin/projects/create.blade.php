<x-app-layout>
    <x-slot name="header"><h2 class="section-title mb-0">Nouveau projet</h2></x-slot>
    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
        @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card p-4">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}" class="form-control @error('title') is-invalid @enderror" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Description courte</label>
                        <input type="text" name="short_description" value="{{ old('short_description', $project->short_description ?? '') }}" class="form-control" placeholder="Resume en une ligne...">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Description complete</label>
                        <textarea name="full_description" rows="6" class="form-control">{{ old('full_description', $project->full_description ?? '') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Categorie</label>
                        <input type="text" name="category" value="{{ old('category', $project->category ?? '') }}" class="form-control" placeholder="Web, Mobile, API...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Client</label>
                        <input type="text" name="client" value="{{ old('client', $project->client ?? '') }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Technologies <small class="text-muted">(separees par virgule)</small></label>
                        <input type="text" name="technologies" value="{{ old('technologies', is_array($project->technologies ?? null) ? implode(', ', $project->technologies) : '') }}" class="form-control" placeholder="Laravel, Vue.js, MySQL, Docker">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">URL GitHub</label>
                        <input type="url" name="github_url" value="{{ old('github_url', $project->github_url ?? '') }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">URL Demo</label>
                        <input type="url" name="demo_url" value="{{ old('demo_url', $project->demo_url ?? '') }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Date du projet</label>
                        <input type="date" name="project_date" value="{{ old('project_date', optional($project->project_date ?? null)->format('Y-m-d')) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Statut</label>
                        <select name="status" class="form-select">
                            <option value="termine" {{ old('status', $project->status ?? '') == 'termine' ? 'selected' : '' }}>Termine</option>
                            <option value="en_cours" {{ old('status', $project->status ?? '') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="admin-card p-4 mb-4">
                <h5 class="fw-semibold mb-3">Image de couverture</h5>
                @if(!empty($project->cover_image))
                    <img src="{{ asset('storage/'.$project->cover_image) }}" class="img-fluid rounded mb-3">
                @endif
                <input type="file" name="cover_image" class="form-control" accept="image/*">
            </div>
            <div class="admin-card p-4">
                <h5 class="fw-semibold mb-3">Options</h5>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_featured">Mettre a la une</label>
                </div>
                <div class="mt-3">
                    <label class="form-label fw-semibold">Ordre</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" class="form-control">
                </div>
            </div>
        </div>
    </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Creer</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
        </div>
    </form>
</x-app-layout>
