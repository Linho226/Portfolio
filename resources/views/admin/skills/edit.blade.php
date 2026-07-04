<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 section-title">
            Modifier la competence
        </h2>
    </x-slot>

    <div class="admin-card p-4 p-md-5">
        <form action="{{ route('admin.competences.update', $skill) }}" method="POST">
            @method('PUT')
            @include('admin.skills._form', ['submitLabel' => 'Mettre a jour'])
        </form>
    </div>
</x-app-layout>
