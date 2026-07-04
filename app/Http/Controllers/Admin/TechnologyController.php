<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function index() {
        $technologies = Technology::orderBy('name')->paginate(20);
        return view('admin.technologies.index', compact('technologies'));
    }
    public function create() { return view('admin.technologies.create'); }
    public function store(Request $request) {
        Technology::create($this->validated($request));
        return redirect()->route('admin.technologies.index')->with('success', 'Technologie creee.');
    }
    public function edit(Technology $technology) { return view('admin.technologies.edit', compact('technology')); }
    public function update(Request $request, Technology $technology) {
        $technology->update($this->validated($request));
        return redirect()->route('admin.technologies.index')->with('success', 'Technologie mise a jour.');
    }
    public function destroy(Technology $technology) {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'Technologie supprimee.');
    }
    private function validated(Request $request): array {
        return $request->validate([
            'name'              => 'required|string|max:100',
            'version'           => 'nullable|string|max:50',
            'category'          => 'nullable|string|max:100',
            'documentation_url' => 'nullable|url|max:255',
        ]);
    }
}
