<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderByDesc('is_featured')->orderByDesc('project_date')->paginate(12);
        return view('admin.projects.index', compact('projects'));
    }
    public function create() { return view('admin.projects.create'); }
    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('cover_image'))
            $data['cover_image'] = $request->file('cover_image')->store('projects', 'public');
        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Projet cree.');
    }
    public function edit(Project $project) { return view('admin.projects.edit', compact('project')); }
    public function update(Request $request, Project $project)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) Storage::disk('public')->delete($project->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('projects', 'public');
        }
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Projet mis a jour.');
    }
    public function destroy(Project $project)
    {
        if ($project->cover_image) Storage::disk('public')->delete($project->cover_image);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Projet supprime.');
    }
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title'             => 'required|string|max:200',
            'short_description' => 'nullable|string|max:500',
            'full_description'  => 'nullable|string',
            'technologies'      => 'nullable|string',
            'category'          => 'nullable|string|max:100',
            'github_url'        => 'nullable|url|max:255',
            'demo_url'          => 'nullable|url|max:255',
            'client'            => 'nullable|string|max:150',
            'project_date'      => 'nullable|date',
            'status'            => 'nullable|string|max:50',
            'is_featured'       => 'boolean',
            'sort_order'        => 'integer',
            'cover_image'       => 'nullable|image|max:4096',
        ]);
        $data['is_featured'] = $request->boolean('is_featured');
        if (!empty($data['technologies']))
            $data['technologies'] = array_filter(array_map('trim', explode(',', $data['technologies'])));
        return $data;
    }
}
