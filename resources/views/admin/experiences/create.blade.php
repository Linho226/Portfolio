<x-app-layout>
    <x-slot name="header"><h2 class="section-title mb-0">Nouvelle experience</h2></x-slot>
    <form method="POST" action="{{ route('admin.experiences.store') }}">
        @csrf
    <div class="admin-card p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Poste / Role <span class="text-danger">*</span></label>
                <input type="text" name="role" value="{{ old('role', $experience->role ?? '') }}" class="form-control @error('role') is-invalid @enderror" required>
                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Entreprise <span class="text-danger">*</span></label>
                <input type="text" name="company" value="{{ old('company', $experience->company ?? '') }}" class="form-control @error('company') is-invalid @enderror" required>
                @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Ville</label>
                <input type="text" name="city" value="{{ old('city', $experience->city ?? '') }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Pays</label>
                <input type="text" name="country" value="{{ old('country', $experience->country ?? '') }}" class="form-control">
            </div>
            <div class="col-md-5">
                <label class="form-label fw-semibold">Date de debut <span class="text-danger">*</span></label>
                <input type="date" name="start_date" value="{{ old('start_date', optional($experience->start_date ?? null)->format('Y-m-d')) }}" class="form-control @error('start_date') is-invalid @enderror" required>
            </div>
            <div class="col-md-5">
                <label class="form-label fw-semibold">Date de fin</label>
                <input type="date" name="end_date" value="{{ old('end_date', optional($experience->end_date ?? null)->format('Y-m-d')) }}" class="form-control" id="end_date_field">
            </div>
            <div class="col-md-2 d-flex align-items-end pb-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_current" id="is_current" value="1" {{ old('is_current', $experience->is_current ?? false) ? 'checked' : '' }} onchange="document.getElementById('end_date_field').disabled=this.checked">
                    <label class="form-check-label fw-semibold" for="is_current">En cours</label>
                </div>
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" rows="4" class="form-control" placeholder="Vos missions, responsabilites...">{{ old('description', $experience->description ?? '') }}</textarea>
            </div>
        </div>
    </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Creer</button>
            <a href="{{ route('admin.experiences.index') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
        </div>
    </form>
</x-app-layout>
