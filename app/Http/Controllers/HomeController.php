<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Faq;
use App\Models\LearningResource;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\Technology;
use App\Models\Testimonial;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $about = Schema::hasTable('abouts') ? About::query()->first() : null;
        $setting = Schema::hasTable('settings') ? Setting::query()->first() : null;
        $socialLinks = Schema::hasTable('social_links') ? SocialLink::query()->first() : null;

        $skills = Schema::hasTable('skills')
            ? Skill::query()
            ->orderBy('sort_order', 'asc')
            ->get()
            ->groupBy('category')
            : collect();

        $services = Schema::hasTable('services')
            ? Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            : $this->emptyCollection();

        $projects = Schema::hasTable('projects')
            ? Project::query()
            ->orderByDesc('is_featured')
            ->orderByDesc('project_date')
            ->limit(6)
            ->get()
            : $this->emptyCollection();

        $experiences = Schema::hasTable('experiences')
            ? Experience::query()
            ->orderByDesc('start_date')
            ->get()
            : $this->emptyCollection();

        $educations = Schema::hasTable('educations')
            ? Education::query()
            ->orderByDesc('start_date')
            ->get()
            : $this->emptyCollection();

        $technologies = Schema::hasTable('technologies')
            ? Technology::query()
            ->orderBy('name', 'asc')
            ->get()
            : $this->emptyCollection();

        $testimonials = Schema::hasTable('testimonials')
            ? Testimonial::query()
            ->where('is_active', true)
            ->orderByDesc('testimonial_date')
            ->limit(6)
            ->get()
            : $this->emptyCollection();

        $blogs = Schema::hasTable('blogs')
            ? Blog::query()
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get()
            : $this->emptyCollection();

        $learningResources = Schema::hasTable('learning_resources')
            ? LearningResource::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get()
            : $this->emptyCollection();

        $faqs = Schema::hasTable('faqs')
            ? Faq::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit(8)
            ->get()
            : $this->emptyCollection();

        return view('public.home', compact(
            'about',
            'setting',
            'socialLinks',
            'skills',
            'services',
            'projects',
            'experiences',
            'educations',
            'technologies',
            'testimonials',
            'blogs',
            'learningResources',
            'faqs',
        ));
    }

    protected function emptyCollection(): Collection
    {
        return collect();
    }
}
