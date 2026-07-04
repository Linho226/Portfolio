<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit() {
        $setting = Setting::first() ?? new Setting();
        return view('admin.settings.edit', compact('setting'));
    }
    public function update(Request $request) {
        $data = $request->validate([
            'site_name'           => 'required|string|max:150',
            'description'         => 'nullable|string|max:500',
            'email'               => 'nullable|email|max:150',
            'phone'               => 'nullable|string|max:30',
            'address'             => 'nullable|string|max:255',
            'seo_meta_title'      => 'nullable|string|max:200',
            'seo_meta_description'=> 'nullable|string|max:300',
            'google_analytics_id' => 'nullable|string|max:50',
        ]);
        $setting = Setting::first() ?? new Setting();
        $setting->fill($data)->save();
        return redirect()->route('admin.settings.edit')->with('success', 'Parametres mis a jour.');
    }
}
