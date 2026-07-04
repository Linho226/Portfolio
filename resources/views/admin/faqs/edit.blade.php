<x-app-layout>
    <x-slot name="header"><h2 class="section-title mb-0">Modifier la question</h2></x-slot>
    @include('admin._partials.alert')
    <form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
        @csrf @method('PUT')
    <div class="admin-card p-4">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-semibold">Question <span class="text-danger">*</span></label>
                <input type="text" name="question" value="{{ old('question', $faq->question ?? '') }}" class="form-control @error('question') is-invalid @enderror" required>
                @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label fw-semibold">Reponse <span class="text-danger">*</span></label>
                <textarea name="answer" rows="5" class="form-control @error('answer') is-invalid @enderror" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                @error('answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Ordre</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}" class="form-control">
            </div>
            <div class="col-md-8 d-flex align-items-end pb-1">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_active">Afficher sur le site</label>
                </div>
            </div>
        </div>
    </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
        </div>
    </form>
</x-app-layout>
