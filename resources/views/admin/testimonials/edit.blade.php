<x-app-layout>
    <x-slot name="header"><h2 class="section-title mb-0">Modifier le temoignage</h2></x-slot>
    @include('admin._partials.alert')
    <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}">
        @csrf @method('PUT')
    <div class="admin-card p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ old('name', $testimonial->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Profession</label>
                <input type="text" name="profession" value="{{ old('profession', $testimonial->profession ?? '') }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Entreprise</label>
                <input type="text" name="company" value="{{ old('company', $testimonial->company ?? '') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Note (1-5)</label>
                <select name="rating" class="form-select">
                    @for($i=5;$i>=1;$i--)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>{{ str_repeat('★', $i) }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Date</label>
                <input type="date" name="testimonial_date" value="{{ old('testimonial_date', optional($testimonial->testimonial_date ?? null)->format('Y-m-d')) }}" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Commentaire <span class="text-danger">*</span></label>
                <textarea name="comment" rows="4" class="form-control @error('comment') is-invalid @enderror" required>{{ old('comment', $testimonial->comment ?? '') }}</textarea>
                @error('comment')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_active">Afficher sur le site</label>
                </div>
            </div>
        </div>
    </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
        </div>
    </form>
</x-app-layout>
