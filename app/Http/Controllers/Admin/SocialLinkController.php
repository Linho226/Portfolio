<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function edit() {
        $social = SocialLink::first() ?? new SocialLink();
        return view('admin.social.edit', compact('social'));
    }
    public function update(Request $request) {
        $data = $request->validate([
            'github'    => 'nullable|url|max:255',
            'linkedin'  => 'nullable|url|max:255',
            'twitter'   => 'nullable|url|max:255',
            'facebook'  => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube'   => 'nullable|url|max:255',
            'tiktok'    => 'nullable|url|max:255',
        ]);
        $social = SocialLink::first() ?? new SocialLink();
        $social->fill($data)->save();
        return redirect()->route('admin.social.edit')->with('success', 'Reseaux sociaux mis a jour.');
    }
}
