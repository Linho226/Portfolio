<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Faq;
use App\Models\LearningResource;
use App\Models\PageVisit;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Technology;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Compteurs de modules ──────────────────────────────────────────
        $counts = [
            'projects'     => Schema::hasTable('projects')     ? Project::count()     : 0,
            'skills'       => Schema::hasTable('skills')       ? Skill::count()       : 0,
            'services'     => Schema::hasTable('services')     ? Service::count()     : 0,
            'technologies' => Schema::hasTable('technologies') ? Technology::count()  : 0,
            'resources'    => Schema::hasTable('learning_resources') ? LearningResource::count() : 0,
            'experiences'  => Schema::hasTable('experiences')  ? Experience::count()  : 0,
            'educations'   => Schema::hasTable('educations')   ? Education::count()   : 0,
            'testimonials' => Schema::hasTable('testimonials') ? Testimonial::count() : 0,
            'faqs'         => Schema::hasTable('faqs')         ? Faq::count()         : 0,
            'messages'     => Schema::hasTable('contacts')     ? Contact::count()     : 0,
            'unread'       => Schema::hasTable('contacts')     ? Contact::where('is_read', false)->count() : 0,
            'articles'     => Schema::hasTable('blogs')        ? Blog::count()        : 0,
        ];

        // ── Statistiques de visites ───────────────────────────────────────
        $todayVisits      = PageVisit::where('visited_date', today())->value('total_views')     ?? 0;
        $todayUnique      = PageVisit::where('visited_date', today())->value('unique_visitors') ?? 0;
        $weekVisits       = PageVisit::whereBetween('visited_date', [now()->startOfWeek(), now()->endOfWeek()])->sum('total_views');
        $monthVisits      = PageVisit::whereMonth('visited_date', now()->month)->whereYear('visited_date', now()->year)->sum('total_views');
        $allTimeViews     = PageVisit::sum('total_views');
        $allTimeUnique    = PageVisit::sum('unique_visitors');

        // ── Chart : 30 derniers jours ─────────────────────────────────────
        $last30 = collect(range(29, 0))->map(fn($i) => now()->subDays($i)->toDateString());

        $visitRows = PageVisit::whereIn('visited_date', $last30)->get()->keyBy(fn($r) => $r->visited_date->toDateString());

        $chartLabels = $last30->map(fn($d) => Carbon::parse($d)->format('d/m'))->values();
        $chartViews  = $last30->map(fn($d) => $visitRows->get($d)?->total_views  ?? 0)->values();
        $chartUnique = $last30->map(fn($d) => $visitRows->get($d)?->unique_visitors ?? 0)->values();

        // ── Messages récents ──────────────────────────────────────────────
        $recentContacts = Schema::hasTable('contacts')
            ? Contact::latest('sent_at')->limit(5)->get()
            : collect();

        return view('admin.dashboard', compact(
            'counts',
            'todayVisits', 'todayUnique',
            'weekVisits', 'monthVisits',
            'allTimeViews', 'allTimeUnique',
            'chartLabels', 'chartViews', 'chartUnique',
            'recentContacts'
        ));
    }
}
