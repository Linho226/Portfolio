<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->paginate(15);
        return view('admin.services.index', compact('services'));
    }
    public function create() { return view('admin.services.create'); }
    public function store(Request $request)
    {
        Service::create($this->validated($request));
        return redirect()->route('admin.services.index')->with('success', 'Service cree.');
    }
    public function edit(Service $service) { return view('admin.services.edit', compact('service')); }
    public function update(Request $request, Service $service)
    {
        $service->update($this->validated($request, $service));
        return redirect()->route('admin.services.index')->with('success', 'Service mis a jour.');
    }
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service supprime.');
    }
    private function validated(Request $request, ?Service $service = null): array
    {
        $data = $request->validate([
            'title'       => 'required|string|max:150',
            'icon'        => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'sort_order'  => 'integer',
            'is_active'   => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
