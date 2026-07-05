<x-app-layout>
    <x-slot name="header">
        <h2 class="section-title mb-0">Nouvelle ressource</h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.learning-resources.store') }}">
        @csrf
        @include('admin.learning-resources._form')

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Creer</button>
            <a href="{{ route('admin.learning-resources.index') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
        </div>
    </form>
</x-app-layout>
