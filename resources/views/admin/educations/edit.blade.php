<x-app-layout>
    <x-slot name="header"><h2 class="section-title mb-0">Modifier la formation</h2></x-slot>
    @include('admin._partials.alert')
    <form method="POST" action="{{ route('admin.educations.update', $education) }}">
        @csrf @method('PUT')
    <div class="admin-card p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Diplome / Titre <span class="text-danger">*</span></label>
                <input type="text" name="degree" value="{{ old('degree', $education->degree ?? '') }}" class="form-control @error('degree') is-invalid @enderror" required>
                @error('degree')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Etablissement <span class="text-danger">*</span></label>
                <input type="text" name="school" value="{{ old('school', $education->school ?? '') }}" class="form-control @error('school') is-invalid @enderror" required>
                @error('school')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Ville</label>
                <input type="text" name="city" value="{{ old('city', $education->city ?? '') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Annee (affichage)</label>
                <input type="text" name="year" value="{{ old('year', $education->year ?? '') }}" class="form-control" placeholder="2023 ou 2021-2023">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Mention</label>
                <input type="text" name="mention" value="{{ old('mention', $education->mention ?? '') }}" class="form-control" placeholder="Tres bien, Bien...">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Date de debut</label>
                <input type="date" name="start_date" value="{{ old('start_date', optional($education->start_date ?? null)->format('Y-m-d')) }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Date de fin</label>
                <input type="date" name="end_date" value="{{ old('end_date', optional($education->end_date ?? null)->format('Y-m-d')) }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" rows="3" class="form-control">{{ old('description', $education->description ?? '') }}</textarea>
            </div>
        </div>
    </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
            <a href="{{ route('admin.educations.index') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
        </div>
    </form>
</x-app-layout>
