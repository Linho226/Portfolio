<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LearningResourceController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\TrackPageVisit;

Route::middleware([TrackPageVisit::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Competences (alias français)
    Route::resource('skills', SkillController::class)->except('show');
    Route::prefix('competences')->name('competences.')->group(function () {
        Route::get('/', [SkillController::class, 'index'])->name('index');
        Route::get('/create', [SkillController::class, 'create'])->name('create');
        Route::post('/', [SkillController::class, 'store'])->name('store');
        Route::get('/{skill}/edit', [SkillController::class, 'edit'])->name('edit');
        Route::put('/{skill}', [SkillController::class, 'update'])->name('update');
        Route::patch('/{skill}', [SkillController::class, 'update']);
        Route::delete('/{skill}', [SkillController::class, 'destroy'])->name('destroy');
    });

    // A propos (singleton)
    Route::get('/about', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about', [AboutController::class, 'update'])->name('about.update');

    // Services
    Route::resource('services', ServiceController::class)->except('show');

    // Projets
    Route::resource('projects', ProjectController::class)->except('show');

    // Experiences
    Route::resource('experiences', ExperienceController::class)->except('show');

    // Formations
    Route::resource('educations', EducationController::class)->except('show');

    // Technologies
    Route::resource('technologies', TechnologyController::class)->except('show');

    // Ressources utiles : sites, videos, documentations, formations
    Route::resource('learning-resources', LearningResourceController::class)->except('show');

    // Temoignages
    Route::resource('testimonials', TestimonialController::class)->except('show');

    // FAQ
    Route::resource('faqs', FaqController::class)->except('show');

    // Reseaux sociaux (singleton)
    Route::get('/social', [SocialLinkController::class, 'edit'])->name('social.edit');
    Route::put('/social', [SocialLinkController::class, 'update'])->name('social.update');

    // Parametres (singleton)
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Messages recus
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});

Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
