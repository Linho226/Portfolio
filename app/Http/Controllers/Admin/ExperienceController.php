<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index() {
        $experiences = Experience::orderByDesc('start_date')->paginate(12);
        return view('admin.experiences.index', compact('experiences'));
    }
    public function create() { return view('admin.experiences.create'); }
    public function store(Request $request) {
        Experience::create($this->validated($request));
        return redirect()->route('admin.experiences.index')->with('success', 'Experience creee.');
    }
    public function edit(Experience $experience) { return view('admin.experiences.edit', compact('experience')); }
    public function update(Request $request, Experience $experience) {
        $experience->update($this->validated($request));
        return redirect()->route('admin.experiences.index')->with('success', 'Experience mise a jour.');
    }
    public function destroy(Experience $experience) {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Experience supprimee.');
    }
    private function validated(Request $request): array {
        $data = $request->validate([
            'company'    => 'required|string|max:150',
            'role'       => 'required|string|max:150',
            'description'=> 'nullable|string',
            'city'       => 'nullable|string|max:100',
            'country'    => 'nullable|string|max:100',
            'start_date' => 'required|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
        ]);
        $data['is_current'] = $request->boolean('is_current');
        if ($data['is_current']) $data['end_date'] = null;
        return $data;
    }
}
