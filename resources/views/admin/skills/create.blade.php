<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 section-title">
            Ajouter une competence
        </h2>
    </x-slot>

    <div class="admin-card p-4 p-md-5">
        <form action="{{ route('admin.competences.store') }}" method="POST">
            @include('admin.skills._form', ['submitLabel' => 'Creer'])
        </form>
    </div>
</x-app-layout>
