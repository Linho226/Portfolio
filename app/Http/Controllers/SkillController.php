<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SkillController extends Controller
{
    private const CATEGORIES = [
        'Frontend',
        'Backend',
        'Framework',
        'ERP',
        'Base de donnees',
        'DevOps',
        'Cloud',
        'Autres',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Skill::query()
            ->orderBy('category', 'asc')
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc');

        if ($request->filled('search')) {
            $search = (string) $request->string('search');
            $query->where(function ($builder) use ($search): void {
                $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('level', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->string('category')->toString());
        }

        $skills = $query->paginate(10)->withQueryString();

        return view('admin.skills.index', [
            'skills' => $skills,
            'categories' => self::CATEGORIES,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.skills.create', [
            'skill' => new Skill(),
            'categories' => self::CATEGORIES,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);

        Skill::query()->create($validated);

        return redirect()
            ->route('admin.competences.index')
            ->with('status', 'Competence creee avec succes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill): View
    {
        return view('admin.skills.edit', [
            'skill' => $skill,
            'categories' => self::CATEGORIES,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $this->validateData($request);

        $skill->update($validated);

        return redirect()
            ->route('admin.competences.index')
            ->with('status', 'Competence mise a jour avec succes.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        Skill::query()->whereKey($skill->id)->delete($skill->id);

        return redirect()
            ->route('admin.competences.index')
            ->with('status', 'Competence supprimee avec succes.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'in:'.implode(',', self::CATEGORIES)],
            'icon' => ['nullable', 'string', 'max:120'],
            'level' => ['nullable', 'string', 'max:80'],
            'percentage' => ['required', 'integer', 'min:0', 'max:100'],
            'color' => ['nullable', 'string', 'max:40'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);
    }
}