<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::first() ?? new About();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:150',
            'profession'        => 'required|string|max:150',
            'short_description' => 'nullable|string|max:500',
            'biography'         => 'nullable|string',
            'phone'             => 'nullable|string|max:30',
            'email'             => 'nullable|email|max:150',
            'address'           => 'nullable|string|max:255',
            'location'          => 'nullable|string|max:150',
            'is_available'      => 'boolean',
            'photo'             => 'nullable|image|max:2048',
            'cv'                => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $about = About::first() ?? new About();

        // Retirer les champs fichiers de $data (on les gère manuellement)
        unset($data['photo'], $data['cv']);

        if ($request->hasFile('photo')) {
            if ($about->photo) Storage::disk('public')->delete($about->photo);
            $data['photo'] = $request->file('photo')->store('about', 'public');
        }
        if ($request->hasFile('cv')) {
            if ($about->cv_path) Storage::disk('public')->delete($about->cv_path);
            $data['cv_path'] = $request->file('cv')->store('cv', 'public');
        }

        $data['is_available'] = $request->boolean('is_available');

        $about->fill($data)->save();

        return redirect()->route('admin.about.edit')->with('success', 'Informations mises a jour.');
    }
}
