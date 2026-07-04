<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index() {
        $educations = Education::orderByDesc('start_date')->paginate(12);
        return view('admin.educations.index', compact('educations'));
    }
    public function create() { return view('admin.educations.create'); }
    public function store(Request $request) {
        Education::create($this->validated($request));
        return redirect()->route('admin.educations.index')->with('success', 'Formation creee.');
    }
    public function edit(Education $education) { return view('admin.educations.edit', compact('education')); }
    public function update(Request $request, Education $education) {
        $education->update($this->validated($request));
        return redirect()->route('admin.educations.index')->with('success', 'Formation mise a jour.');
    }
    public function destroy(Education $education) {
        $education->delete();
        return redirect()->route('admin.educations.index')->with('success', 'Formation supprimee.');
    }
    private function validated(Request $request): array {
        return $request->validate([
            'school'      => 'required|string|max:200',
            'degree'      => 'required|string|max:200',
            'description' => 'nullable|string',
            'city'        => 'nullable|string|max:100',
            'year'        => 'nullable|string|max:10',
            'mention'     => 'nullable|string|max:100',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date',
        ]);
    }
}
