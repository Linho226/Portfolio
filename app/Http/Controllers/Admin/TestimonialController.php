<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index() {
        $testimonials = Testimonial::orderByDesc('testimonial_date')->paginate(12);
        return view('admin.testimonials.index', compact('testimonials'));
    }
    public function create() { return view('admin.testimonials.create'); }
    public function store(Request $request) {
        Testimonial::create($this->validated($request));
        return redirect()->route('admin.testimonials.index')->with('success', 'Temoignage cree.');
    }
    public function edit(Testimonial $testimonial) { return view('admin.testimonials.edit', compact('testimonial')); }
    public function update(Request $request, Testimonial $testimonial) {
        $testimonial->update($this->validated($request));
        return redirect()->route('admin.testimonials.index')->with('success', 'Temoignage mis a jour.');
    }
    public function destroy(Testimonial $testimonial) {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Temoignage supprime.');
    }
    private function validated(Request $request): array {
        $data = $request->validate([
            'name'             => 'required|string|max:150',
            'profession'       => 'nullable|string|max:150',
            'company'          => 'nullable|string|max:150',
            'comment'          => 'required|string',
            'rating'           => 'required|integer|min:1|max:5',
            'testimonial_date' => 'nullable|date',
            'is_active'        => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
