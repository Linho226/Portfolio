<x-app-layout>
    <x-slot name="header"><h2 class="section-title mb-0">Reseaux sociaux</h2></x-slot>
    @include('admin._partials.alert')
    <form method="POST" action="{{ route('admin.social.update') }}">
        @csrf @method('PUT')
        <div class="admin-card p-4">
            <div class="row g-3">
                @foreach(['github' => 'GitHub', 'linkedin' => 'LinkedIn', 'twitter' => 'Twitter / X', 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'youtube' => 'YouTube', 'tiktok' => 'TikTok'] as $key => $label)
                <div class="col-md-6">
                    <label class="form-label fw-semibold">{{ $label }}</label>
                    <input type="url" name="{{ $key }}" value="{{ old($key, $social->$key ?? '') }}" class="form-control" placeholder="https://...">
                </div>
                @endforeach
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
        </div>
    </form>
</x-app-layout>
