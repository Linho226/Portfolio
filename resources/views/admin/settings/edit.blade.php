<x-app-layout>
    <x-slot name="header"><h2 class="section-title mb-0">Parametres du site</h2></x-slot>
    @include('admin._partials.alert')
    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf @method('PUT')
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="admin-card p-4">
                    <h5 class="fw-semibold mb-4 text-primary">Informations generales</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Nom du site <span class="text-danger">*</span></label>
                            <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}" class="form-control @error('site_name') is-invalid @enderror" required>
                            @error('site_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" rows="3" class="form-control">{{ old('description', $setting->description) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email de contact</label>
                            <input type="email" name="email" value="{{ old('email', $setting->email) }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Telephone</label>
                            <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Adresse</label>
                            <input type="text" name="address" value="{{ old('address', $setting->address) }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="admin-card p-4">
                    <h5 class="fw-semibold mb-4 text-primary">SEO</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Meta titre</label>
                            <input type="text" name="seo_meta_title" value="{{ old('seo_meta_title', $setting->seo_meta_title) }}" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Meta description</label>
                            <textarea name="seo_meta_description" rows="3" class="form-control">{{ old('seo_meta_description', $setting->seo_meta_description) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Google Analytics ID</label>
                            <input type="text" name="google_analytics_id" value="{{ old('google_analytics_id', $setting->google_analytics_id) }}" class="form-control" placeholder="G-XXXXXXXXXX">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
        </div>
    </form>
</x-app-layout>
