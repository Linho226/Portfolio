<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearningResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearningResourceController extends Controller
{
    public function index(): View
    {
        $resources = LearningResource::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->paginate(15);

        return view('admin.learning-resources.index', compact('resources'));
    }

    public function create(): View
    {
        return view('admin.learning-resources.create');
    }

    public function store(Request $request): RedirectResponse
    {
        LearningResource::create($this->validated($request));

        return redirect()
            ->route('admin.learning-resources.index')
            ->with('success', 'Ressource ajoutee.');
    }

    public function edit(LearningResource $learningResource): View
    {
        return view('admin.learning-resources.edit', [
            'resource' => $learningResource,
        ]);
    }

    public function update(Request $request, LearningResource $learningResource): RedirectResponse
    {
        $learningResource->update($this->validated($request));

        return redirect()
            ->route('admin.learning-resources.index')
            ->with('success', 'Ressource mise a jour.');
    }

    public function destroy(LearningResource $learningResource): RedirectResponse
    {
        $learningResource->delete();

        return redirect()
            ->route('admin.learning-resources.index')
            ->with('success', 'Ressource supprimee.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'type' => ['required', 'string', 'max:40'],
            'url' => ['required', 'url', 'max:2000'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
