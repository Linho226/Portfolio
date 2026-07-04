<x-app-layout>
    <x-slot name="header"><h2 class="section-title mb-0">A propos</h2></x-slot>
    @include('admin._partials.alert')
    <form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="admin-card p-4">
                    <h5 class="fw-semibold mb-4 text-primary">Informations personnelles</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nom complet <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $about->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Profession <span class="text-danger">*</span></label>
                            <input type="text" name="profession" value="{{ old('profession', $about->profession) }}" class="form-control @error('profession') is-invalid @enderror" placeholder="Developpeur Full Stack" required>
                            @error('profession')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description courte</label>
                            <input type="text" name="short_description" value="{{ old('short_description', $about->short_description) }}" class="form-control" placeholder="Une phrase qui vous decrit...">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Biographie</label>
                            <textarea name="biography" rows="6" class="form-control" placeholder="Votre parcours, vos passions...">{{ old('biography', $about->biography) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" value="{{ old('email', $about->email) }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Telephone</label>
                            <input type="text" name="phone" value="{{ old('phone', $about->phone) }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Adresse</label>
                            <input type="text" name="address" value="{{ old('address', $about->address) }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Localisation (courte)</label>
                            <input type="text" name="location" value="{{ old('location', $about->location) }}" class="form-control" placeholder="Paris, France">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="admin-card p-4 mb-4">
                    <h5 class="fw-semibold mb-3 text-primary">Photo de profil</h5>
                    @if($about->photo)
                        <img src="{{ asset('storage/'.$about->photo) }}" class="img-fluid rounded-3 mb-3" style="max-height:180px;object-fit:cover;">
                    @endif
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>
                <div class="admin-card p-4 mb-4">
                    <h5 class="fw-semibold mb-3 text-primary">CV (PDF)</h5>
                    @if($about->cv_path)
                        <a href="{{ asset('storage/'.$about->cv_path) }}" target="_blank" class="btn btn-sm btn-outline-primary mb-3">Voir le CV actuel</a>
                    @endif
                    <input type="file" name="cv" class="form-control" accept=".pdf">
                </div>
                <div class="admin-card p-4">
                    <h5 class="fw-semibold mb-3 text-primary">Disponibilite</h5>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', $about->is_available) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_available">Disponible pour de nouvelles missions</label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
            </div>
        </div>
    </form>
</x-app-layout>
