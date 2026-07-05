<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting->site_name ?? 'Portfolio' }}</title>
    <meta name="description" content="{{ $setting->seo_meta_description ?? 'Portfolio professionnel' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="pf-body">

{{-- BARRE DE PROGRESSION SCROLL --}}
<div id="pf-scroll-bar"></div>

{{-- NAVBAR --}}
<header class="pf-nav" id="pf-nav">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between" style="height:68px;">

            {{-- LOGO --}}
            <a href="#hero" class="pf-nav__brand" style="text-decoration:none;">
                <span class="pf-nav__logo">{{ mb_strtoupper(mb_substr($about->name ?? $setting->site_name ?? 'P', 0, 1)) }}{{ mb_strtoupper(mb_substr(strstr($about->name ?? $setting->site_name ?? 'PF', ' ') ?: 'F', 1, 1)) }}</span>
                <span class="pf-nav__brand-text">{{ $setting->site_name ?? ($about->name ?? 'Portfolio') }}</span>
            </a>

            {{-- LIENS DESKTOP --}}
            <nav class="d-none d-lg-flex align-items-center gap-1" id="pf-nav-links">
                <a href="#about"      class="pf-nav__link" data-section="about">A propos</a>
                <a href="#skills"     class="pf-nav__link" data-section="skills">Competences</a>
                <a href="#projects"   class="pf-nav__link" data-section="projects">Projets</a>
                <a href="#experience" class="pf-nav__link" data-section="experience">Experience</a>
                <a href="#resources"  class="pf-nav__link" data-section="resources">Ressources</a>
                <a href="#contact" class="pf-nav__cta ms-3">Contactez-moi</a>
            </nav>

            {{-- HAMBURGER MOBILE --}}
            <button class="pf-hamburger d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

{{-- MENU MOBILE --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" style="background:var(--pf-offcanvas-bg);border-left:1px solid var(--pf-border);max-width:300px;">
    <div class="offcanvas-header py-4 px-4" style="border-bottom:1px solid var(--pf-border);">
        <div class="d-flex align-items-center gap-2">
            <span class="pf-nav__logo" style="width:34px;height:34px;font-size:.75rem;">{{ mb_strtoupper(mb_substr($about->name ?? 'P', 0, 1)) }}{{ mb_strtoupper(mb_substr(strstr($about->name ?? 'PF', ' ') ?: 'F', 1, 1)) }}</span>
            <span class="fw-bold" style="color:var(--pf-heading);font-size:.95rem;">{{ $about->name ?? 'Portfolio' }}</span>
        </div>
        <button type="button" class="pf-offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Fermer">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M15 5L5 15M5 5l10 10" stroke="#94a3b8" stroke-width="1.8" stroke-linecap="round"/></svg>
        </button>
    </div>
    <div class="offcanvas-body px-4 py-4">
        <nav class="d-flex flex-column gap-1">
            <a href="#about"      class="pf-mob-link" data-bs-dismiss="offcanvas">A propos</a>
            <a href="#skills"     class="pf-mob-link" data-bs-dismiss="offcanvas">Competences</a>
            <a href="#projects"   class="pf-mob-link" data-bs-dismiss="offcanvas">Projets</a>
            <a href="#experience" class="pf-mob-link" data-bs-dismiss="offcanvas">Experience</a>
            <a href="#resources"  class="pf-mob-link" data-bs-dismiss="offcanvas">Ressources</a>
        </nav>
        <a href="#contact" class="pf-nav__cta d-block text-center mt-4" data-bs-dismiss="offcanvas">Contactez-moi</a>
        @if($about)
        <div class="mt-5 pt-4" style="border-top:1px solid var(--pf-border);">
            <p class="mb-2" style="color:var(--pf-text);font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;">Contact</p>
            @if($about->email)<a href="mailto:{{ $about->email }}" class="d-block mb-1" style="color:var(--pf-text);font-size:.8rem;text-decoration:none;">📧 {{ $about->email }}</a>@endif
            @if($about->phone)<span class="d-block" style="color:var(--pf-text);font-size:.8rem;">📞 {{ $about->phone }}</span>@endif
        </div>
        @endif
    </div>
</div>

<main>

{{-- HERO --}}
<section id="hero" class="pf-hero">
    <div class="pf-hero__glow"></div>
    <div class="container" style="min-height:92vh;display:flex;align-items:center;padding-top:3rem;padding-bottom:3rem;">
        <div class="row align-items-center g-5 w-100">
            <div class="col-lg-7 reveal">
                <div class="d-flex align-items-center gap-4 mb-4">
                    @if($about?->photo)
                        <img src="{{ asset('storage/'.$about->photo) }}" alt="{{ $about->name }}"
                             class="pf-hero__avatar" loading="eager">
                    @else
                        <div class="pf-hero__avatar-fallback">{{ mb_strtoupper(mb_substr($about->name ?? 'P', 0, 1)) }}</div>
                    @endif
                    <span class="pf-badge">Portfolio professionnel</span>
                </div>
                <h1 class="pf-hero__name">{{ $about->name ?? 'Votre Nom' }}</h1>
                <p class="pf-hero__role">{{ $about->profession ?? 'Developpeur Full Stack' }}</p>
                <p class="pf-hero__desc">{{ $about->short_description ?? 'Je concois des applications web performantes et des experiences utilisateur soignees.' }}</p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="#projects" class="pf-btn pf-btn--primary">Voir mes projets</a>
                    <a href="#contact" class="pf-btn pf-btn--outline">Me contacter</a>
                    @if($about?->cv_path)
                        <a href="{{ asset('storage/'.$about->cv_path) }}" download class="pf-btn pf-btn--ghost">Telecharger CV</a>
                    @endif
                </div>
                <div class="d-flex flex-wrap gap-4 mt-5 pf-hero__socials">
                    @if($socialLinks?->github)<a href="{{ $socialLinks->github }}" target="_blank" rel="noreferrer">GitHub</a>@endif
                    @if($socialLinks?->linkedin)<a href="{{ $socialLinks->linkedin }}" target="_blank" rel="noreferrer">LinkedIn</a>@endif
                    @if($socialLinks?->twitter)<a href="{{ $socialLinks->twitter }}" target="_blank" rel="noreferrer">Twitter</a>@endif
                </div>
            </div>
            <div class="col-lg-5 reveal reveal--delay">
                <div class="pf-stats-card">
                    <div class="pf-stats-card__title">Statistiques</div>
                    <div class="row g-3 mt-1">
                        <div class="col-6"><div class="pf-stat"><span class="pf-stat__num">{{ $projects->count() }}</span><span class="pf-stat__label">Projets</span></div></div>
                        <div class="col-6"><div class="pf-stat"><span class="pf-stat__num">{{ $skills->flatten()->count() }}</span><span class="pf-stat__label">Competences</span></div></div>
                        <div class="col-6"><div class="pf-stat"><span class="pf-stat__num">{{ $services->count() }}</span><span class="pf-stat__label">Services</span></div></div>
                        <div class="col-6"><div class="pf-stat"><span class="pf-stat__num">{{ $experiences->count() }}</span><span class="pf-stat__label">Experiences</span></div></div>
                    </div>
                    @if($about)
                    <div class="mt-4 pt-3" style="border-top:1px solid var(--pf-border);display:flex;gap:1rem;align-items:center;flex-wrap:wrap;">
                        <span class="pf-avail {{ $about->is_available ? 'pf-avail--open' : 'pf-avail--closed' }}">
                            {{ $about->is_available ? 'Disponible' : 'Indisponible' }}
                        </span>
                        @if($about->location)<span style="color:var(--pf-text);font-size:.8rem;">📍 {{ $about->location }}</span>@endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- A PROPOS --}}
<section id="about" class="pf-section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 reveal">
                <span class="pf-section__label">A propos</span>
                <h2 class="pf-section__title">Qui suis-je ?</h2>
                @if($about?->photo)
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="{{ asset('storage/'.$about->photo) }}" alt="{{ $about->name }}" class="pf-about__photo">
                        <div>
                            <div class="fw-bold" style="color:var(--pf-heading);">{{ $about->name }}</div>
                            <div style="color:var(--pf-accent);font-size:.85rem;">{{ $about->profession }}</div>
                        </div>
                    </div>
                @endif
                <p class="pf-section__text">{{ $about->biography ?? $about->short_description ?? 'Ajoutez votre biographie dans le module admin A propos.' }}</p>
                @if($about)
                <ul class="list-unstyled mt-4 d-flex flex-column gap-2">
                    @if($about->email)<li class="pf-info-item">📧 {{ $about->email }}</li>@endif
                    @if($about->phone)<li class="pf-info-item">📞 {{ $about->phone }}</li>@endif
                    @if($about->address)<li class="pf-info-item">📍 {{ $about->address }}</li>@endif
                </ul>
                @endif
            </div>
            <div class="col-lg-6 reveal reveal--delay">
                <div class="pf-about-card">
                    <h3 class="fw-semibold mb-4" style="color:var(--pf-heading);">Ce que je fais</h3>
                    <div class="d-flex flex-column gap-3">
                        @forelse($services->take(4) as $service)
                            <div class="pf-service-mini">
                                <div class="pf-service-mini__icon">{{ mb_substr($service->title, 0, 1) }}</div>
                                <div>
                                    <div class="fw-semibold small" style="color:var(--pf-heading);">{{ $service->title }}</div>
                                    <div class="pf-section__text small mt-1">{{ Str::limit($service->description, 80) }}</div>
                                </div>
                            </div>
                        @empty
                            <p class="pf-section__text">Ajoutez vos services depuis l'administration.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- COMPETENCES --}}
<section id="skills" class="pf-section pf-section--alt">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="pf-section__label">Expertise</span>
            <h2 class="pf-section__title">Mes competences</h2>
        </div>
        <div class="row g-4">
            @forelse($skills as $category => $items)
                <div class="col-md-6 reveal">
                    <div class="pf-card h-100">
                        <div class="pf-card__category">{{ $category }}</div>
                        <ul class="list-unstyled mt-4 d-flex flex-column gap-3">
                            @foreach($items as $item)
                                <li>
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small fw-medium" style="color:var(--pf-heading);">{{ $item->name }}</span>
                                        <span class="pf-pct-badge">{{ $item->percentage }}%</span>
                                    </div>
                                    <div class="pf-progress">
                                        <div class="pf-progress__bar skill-bar" data-width="{{ $item->percentage }}"
                                             style="background: {{ $item->color ?? 'var(--pf-accent)' }};"></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center pf-section__text">Ajoutez vos competences depuis l'administration.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- SERVICES --}}
<section id="services" class="pf-section">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="pf-section__label">Ce que je propose</span>
            <h2 class="pf-section__title">Mes services</h2>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse($services as $service)
                <div class="col-md-6 col-lg-4 reveal">
                    <div class="pf-service-card h-100">
                        <div class="pf-service-card__icon">{{ $service->icon ?? '⚡' }}</div>
                        <h3 class="pf-service-card__title">{{ $service->title }}</h3>
                        <p class="pf-section__text small mt-2">{{ $service->description }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center pf-section__text">Aucun service publie pour le moment.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- PROJETS --}}
<section id="projects" class="pf-section pf-section--alt">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="pf-section__label">Realisations</span>
            <h2 class="pf-section__title">Mes projets</h2>
        </div>
        <div class="row g-4">
            @forelse($projects as $project)
                <div class="col-md-6 col-lg-4 reveal">
                    <article class="pf-project-card h-100">
                        @if($project->is_featured)
                            <span class="pf-project-card__badge">Mis en avant</span>
                        @endif
                        <span class="pf-project-card__cat">{{ $project->category ?? 'Projet' }}</span>
                        <h3 class="pf-project-card__title">{{ $project->title }}</h3>
                        <p class="pf-project-card__desc">{{ $project->short_description }}</p>
                        @if($project->technologies)
                            <div class="d-flex flex-wrap gap-1 mt-3">
                                @foreach(array_slice((array)$project->technologies, 0, 4) as $tech)
                                    <span class="pf-tech-tag">{{ $tech }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="mt-auto pt-3 d-flex gap-3">
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noreferrer" class="pf-project-card__link">GitHub →</a>
                            @endif
                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" rel="noreferrer" class="pf-project-card__link">Demo →</a>
                            @endif
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center pf-section__text">Aucun projet pour le moment.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- EXPERIENCE + FORMATION --}}
<section id="experience" class="pf-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 reveal">
                <span class="pf-section__label">Parcours</span>
                <h2 class="pf-section__title">Experience</h2>
                <div class="pf-timeline mt-4">
                    @forelse($experiences as $exp)
                        <div class="pf-timeline__item">
                            <div class="pf-timeline__dot"></div>
                            <div class="pf-timeline__content">
                                <div class="pf-timeline__period">
                                    {{ optional($exp->start_date)->format('Y') }}
                                    — {{ $exp->is_current ? "Aujourd'hui" : optional($exp->end_date)->format('Y') }}
                                </div>
                                <h4 class="pf-timeline__title">{{ $exp->role }}</h4>
                                <p class="pf-timeline__sub">{{ $exp->company }} — {{ $exp->city }}{{ $exp->country ? ', '.$exp->country : '' }}</p>
                                @if($exp->description)<p class="pf-section__text small mt-2">{{ $exp->description }}</p>@endif
                            </div>
                        </div>
                    @empty
                        <p class="pf-section__text">Aucune experience enregistree.</p>
                    @endforelse
                </div>
            </div>
            <div class="col-lg-6 reveal reveal--delay">
                <span class="pf-section__label">Diplomes</span>
                <h2 class="pf-section__title">Formation</h2>
                <div class="pf-timeline mt-4">
                    @forelse($educations as $edu)
                        <div class="pf-timeline__item">
                            <div class="pf-timeline__dot pf-timeline__dot--edu"></div>
                            <div class="pf-timeline__content">
                                <div class="pf-timeline__period">{{ $edu->year ?? optional($edu->start_date)->format('Y') }}</div>
                                <h4 class="pf-timeline__title">{{ $edu->degree }}</h4>
                                <p class="pf-timeline__sub">{{ $edu->school }}{{ $edu->city ? ' — '.$edu->city : '' }}</p>
                                @if($edu->mention)<span class="pf-tech-tag mt-1 d-inline-block">{{ $edu->mention }}</span>@endif
                                @if($edu->description)<p class="pf-section__text small mt-2">{{ $edu->description }}</p>@endif
                            </div>
                        </div>
                    @empty
                        <p class="pf-section__text">Aucune formation enregistree.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TECHNOLOGIES --}}
<section class="pf-section pf-section--alt">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="pf-section__label">Ecosysteme</span>
            <h2 class="pf-section__title">Technologies</h2>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 reveal">
            @forelse($technologies as $tech)
                <div class="pf-tech-pill">
                    <span class="fw-semibold">{{ $tech->name }}</span>
                    @if($tech->version)<span style="color:rgba(148,163,184,.5);font-size:.75rem;">v{{ $tech->version }}</span>@endif
                </div>
            @empty
                <p class="pf-section__text">Aucune technologie enregistree.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- TEMOIGNAGES --}}
@if($testimonials->isNotEmpty())
<section class="pf-section">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="pf-section__label">Avis clients</span>
            <h2 class="pf-section__title">Temoignages</h2>
        </div>
        <div class="row g-4">
            @foreach($testimonials as $testimonial)
                <div class="col-md-6 col-lg-4 reveal">
                    <div class="pf-testimonial h-100">
                        <div class="pf-testimonial__stars">
                            @for($i = 1; $i <= 5; $i++)
                                <span style="color:{{ $i <= ($testimonial->rating ?? 5) ? '#f59e0b' : '#334155' }}">★</span>
                            @endfor
                        </div>
                        <p class="pf-testimonial__text">"{{ $testimonial->comment }}"</p>
                        <div class="mt-auto d-flex align-items-center gap-3 pt-3" style="border-top:1px solid var(--pf-border);">
                            <div class="pf-testimonial__avatar">{{ mb_substr($testimonial->name, 0, 1) }}</div>
                            <div>
                                <div class="fw-semibold small" style="color:var(--pf-heading);">{{ $testimonial->name }}</div>
                                <div style="color:var(--pf-text);font-size:.75rem;">{{ $testimonial->profession }}@if($testimonial->company) — {{ $testimonial->company }}@endif</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- RESSOURCES --}}
<section id="resources" class="pf-section pf-section--alt">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="pf-section__label">Apprentissage</span>
            <h2 class="pf-section__title">Ressources qui m'ont aidé</h2>
            <p class="pf-section__text mx-auto mt-2" style="max-width:620px;">
                Sites, vidéos, documentations et formations qui ont contribué à mon évolution en développement.
            </p>
        </div>
        <div class="row g-4">
            @forelse($learningResources as $resource)
                <div class="col-md-4 reveal">
                    <article class="pf-resource-card h-100">
                        <div class="pf-resource-card__top">
                            <span class="pf-resource-card__icon">
                                @switch($resource->type)
                                    @case('video') ▶ @break
                                    @case('documentation') DOC @break
                                    @case('formation') EDU @break
                                    @case('outil') APP @break
                                    @default WEB
                                @endswitch
                            </span>
                            <span class="pf-resource-card__type">{{ ucfirst($resource->type) }}</span>
                        </div>
                        <h3 class="pf-resource-card__title">{{ $resource->title }}</h3>
                        @if($resource->description)
                            <p class="pf-section__text small mt-2">{{ $resource->description }}</p>
                        @else
                            <p class="pf-section__text small mt-2">Une ressource utile dans mon parcours de développeur.</p>
                        @endif
                        <a href="{{ $resource->url }}" target="_blank" rel="noreferrer" class="pf-resource-card__link">
                            Consulter la ressource
                        </a>
                    </article>
                </div>
            @empty
                <div class="col-12 reveal">
                    <div class="pf-resource-empty">
                        <span class="pf-resource-empty__icon">📚</span>
                        <h3 class="pf-resource-empty__title">Aucune ressource ajoutée pour le moment</h3>
                        <p class="pf-section__text mb-0">Ajoutez vos sites, vidéos ou documentations depuis l'administration.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- FAQ --}}
@if($faqs->isNotEmpty())
<section class="pf-section">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="pf-section__label">Questions</span>
            <h2 class="pf-section__title">FAQ</h2>
        </div>
        <div class="row justify-content-center reveal">
            <div class="col-lg-8">
                <div id="faqAccordion">
                    @foreach($faqs as $i => $faq)
                        <div class="pf-faq-item">
                            <button class="pf-faq-btn {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq{{ $i }}">
                                {{ $faq->question }}
                                <span class="pf-faq-btn__icon">+</span>
                            </button>
                            <div id="faq{{ $i }}" class="collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                <div class="pf-faq-body">{{ $faq->answer }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- CONTACT --}}
<section id="contact" class="pf-contact-section">
    {{-- glow decoratif --}}
    <div class="pf-contact-glow"></div>

    <div class="container" style="position:relative;z-index:1;">

        {{-- TITRE --}}
        <div class="text-center mb-5 reveal">
            <span class="pf-section__label">Parlons-en</span>
            <h2 class="pf-section__title">Me contacter</h2>
            <p class="pf-section__text mx-auto mt-2" style="max-width:500px;">Vous avez un projet, une opportunite ou une question ? Je suis disponible et je repondrai sous 24h.</p>
        </div>

        <div class="row g-5 align-items-start">

            {{-- COLONNE GAUCHE --}}
            <div class="col-lg-5 reveal">

                {{-- Badge dispo --}}
                @if($about)
                <div class="pf-dispo-card mb-4">
                    <div class="pf-dispo-card__dot {{ $about->is_available ? 'pf-dispo-card__dot--on' : 'pf-dispo-card__dot--off' }}"></div>
                    <div>
                        <div class="fw-semibold" style="color:var(--pf-heading);font-size:.9rem;">
                            {{ $about->is_available ? 'Disponible pour de nouvelles missions' : 'Actuellement indisponible' }}
                        </div>
                        <div style="color:var(--pf-text);font-size:.78rem;margin-top:.15rem;">Reponse sous 24h en general</div>
                    </div>
                </div>
                @endif

                {{-- Cartes info --}}
                <div class="d-flex flex-column gap-3">
                    @if($about?->email)
                    <a href="mailto:{{ $about->email }}" class="pf-cinfo-card">
                        <div class="pf-cinfo-card__icon" style="background:rgba(20,184,166,.12);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#14b8a6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div>
                            <div class="pf-cinfo-card__label">Email</div>
                            <div class="pf-cinfo-card__value">{{ $about->email }}</div>
                        </div>
                        <svg class="ms-auto flex-shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(148,163,184,.4)" stroke-width="2" stroke-linecap="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    @endif

                    @if($about?->phone)
                    <div class="pf-cinfo-card">
                        <div class="pf-cinfo-card__icon" style="background:rgba(99,102,241,.12);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#818cf8" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.63 1.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.91a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 16.92z"/></svg>
                        </div>
                        <div>
                            <div class="pf-cinfo-card__label">Telephone</div>
                            <div class="pf-cinfo-card__value">{{ $about->phone }}</div>
                        </div>
                    </div>
                    @endif

                    @if($about?->location)
                    <div class="pf-cinfo-card">
                        <div class="pf-cinfo-card__icon" style="background:rgba(245,158,11,.1);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <div class="pf-cinfo-card__label">Localisation</div>
                            <div class="pf-cinfo-card__value">{{ $about->location }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Reseaux sociaux --}}
                @if($socialLinks?->github || $socialLinks?->linkedin || $socialLinks?->twitter)
                <div class="mt-4 pt-4" style="border-top:1px solid var(--pf-border);">
                    <p style="color:var(--pf-text);font-size:.72rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;margin-bottom:.85rem;">Me retrouver sur</p>
                    <div class="d-flex flex-wrap gap-2">
                        @if($socialLinks?->github)
                        <a href="{{ $socialLinks->github }}" target="_blank" rel="noreferrer" class="pf-social-pill">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                            GitHub
                        </a>
                        @endif
                        @if($socialLinks?->linkedin)
                        <a href="{{ $socialLinks->linkedin }}" target="_blank" rel="noreferrer" class="pf-social-pill">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            LinkedIn
                        </a>
                        @endif
                        @if($socialLinks?->twitter)
                        <a href="{{ $socialLinks->twitter }}" target="_blank" rel="noreferrer" class="pf-social-pill">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            Twitter / X
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            {{-- COLONNE DROITE : FORMULAIRE --}}
            <div class="col-lg-7 reveal reveal--delay">
                <div class="pf-contact-form">
                    <div class="pf-contact-form__header">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--pf-accent)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <span>Envoyer un message</span>
                    </div>

                    @if(session('status'))
                        <div class="pf-alert pf-alert--success mb-4">{{ session('status') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="pf-alert pf-alert--error mb-4">Veuillez corriger les champs en rouge.</div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="pf-form__label">Votre nom <span class="pf-required">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Jean Dupont" class="pf-form__input @error('name') is-error @enderror" required>
                                @error('name')<span class="pf-form__error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="pf-form__label">Adresse email <span class="pf-required">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="jean@exemple.com" class="pf-form__input @error('email') is-error @enderror" required>
                                @error('email')<span class="pf-form__error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-sm-8">
                                <label class="pf-form__label">Sujet <span class="pf-required">*</span></label>
                                <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Proposition de projet..." class="pf-form__input @error('subject') is-error @enderror" required>
                                @error('subject')<span class="pf-form__error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-sm-4">
                                <label class="pf-form__label">Telephone</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+33 6 00 00 00 00" class="pf-form__input">
                            </div>
                            <div class="col-12">
                                <label class="pf-form__label">Message <span class="pf-required">*</span></label>
                                <textarea name="message" rows="6" placeholder="Decrivez votre projet, vos besoins ou votre question..." class="pf-form__input @error('message') is-error @enderror" required>{{ old('message') }}</textarea>
                                @error('message')<span class="pf-form__error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="pf-submit-btn">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                                    Envoyer le message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</main>

{{-- FOOTER --}}
<footer class="pf-footer">
    <div class="container">

        {{-- CONTENU PRINCIPAL --}}
        <div class="row g-5 py-5">

            {{-- Brand --}}
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="pf-nav__logo" style="width:38px;height:38px;font-size:.8rem;">
                        {{ mb_strtoupper(mb_substr($about->name ?? 'P', 0, 1)) }}{{ mb_strtoupper(mb_substr(strstr($about->name ?? 'PF', ' ') ?: 'F', 1, 1)) }}
                    </span>
                    <span style="font-size:1rem;font-weight:700;color:var(--pf-heading);">{{ $setting->site_name ?? ($about->name ?? 'Portfolio') }}</span>
                </div>
                <p style="color:var(--pf-text);font-size:.85rem;line-height:1.7;max-width:300px;">{{ $about->short_description ?? 'Developpeur passione, je cree des applications web modernes et performantes.' }}</p>
                @if($about?->is_available)
                <div class="d-inline-flex align-items-center gap-2 mt-3" style="background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.2);border-radius:999px;padding:.3rem .85rem;">
                    <span style="width:7px;height:7px;border-radius:50%;background:#10b981;flex-shrink:0;animation:pulse 1.5s infinite;"></span>
                    <span style="font-size:.75rem;font-weight:600;color:#10b981;">Disponible pour de nouveaux projets</span>
                </div>
                @endif
            </div>

            {{-- Navigation --}}
            <div class="col-6 col-lg-2">
                <p class="pf-footer__heading">Navigation</p>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    <li><a href="#about" class="pf-footer__link">A propos</a></li>
                    <li><a href="#skills" class="pf-footer__link">Competences</a></li>
                    <li><a href="#projects" class="pf-footer__link">Projets</a></li>
                    <li><a href="#experience" class="pf-footer__link">Experience</a></li>
                    <li><a href="#resources" class="pf-footer__link">Ressources</a></li>
                    <li><a href="#contact" class="pf-footer__link">Contact</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-6 col-lg-3">
                <p class="pf-footer__heading">Contact</p>
                <ul class="list-unstyled d-flex flex-column gap-2">
                    @if($about?->email)
                        <li><a href="mailto:{{ $about->email }}" class="pf-footer__link" style="font-size:.82rem;">{{ $about->email }}</a></li>
                    @endif
                    @if($about?->phone)
                        <li><span class="pf-footer__link" style="font-size:.82rem;">{{ $about->phone }}</span></li>
                    @endif
                    @if($about?->location)
                        <li><span class="pf-footer__link" style="font-size:.82rem;">📍 {{ $about->location }}</span></li>
                    @endif
                </ul>
            </div>

            {{-- Reseaux --}}
            <div class="col-lg-3">
                <p class="pf-footer__heading">Me suivre</p>
                <div class="d-flex flex-column gap-2">
                    @if($socialLinks?->github)
                    <a href="{{ $socialLinks->github }}" target="_blank" rel="noreferrer" class="pf-footer__social">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                        GitHub
                    </a>
                    @endif
                    @if($socialLinks?->linkedin)
                    <a href="{{ $socialLinks->linkedin }}" target="_blank" rel="noreferrer" class="pf-footer__social">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        LinkedIn
                    </a>
                    @endif
                    @if($socialLinks?->twitter)
                    <a href="{{ $socialLinks->twitter }}" target="_blank" rel="noreferrer" class="pf-footer__social">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        Twitter / X
                    </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- BARRE BAS --}}
        <div class="pf-footer__bottom">
            <p style="color:#475569;font-size:.78rem;margin:0;">© {{ now()->year }} {{ $about->name ?? 'Portfolio' }} — Tous droits reserves</p>
            <a href="#hero" class="pf-footer__totop" title="Retour en haut">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 15l-6-6-6 6"/></svg>
                Haut de page
            </a>
        </div>

    </div>
</footer>

{{-- CHATBOT IA - squelette prêt à brancher sur une API --}}
<section class="pf-chatbot" id="pf-chatbot" aria-live="polite">
    <button class="pf-chatbot__toggle" id="pf-chatbot-toggle" type="button" aria-label="Ouvrir l'assistant IA">
        <span class="pf-chatbot__pulse"></span>
        <span class="pf-chatbot__icon">IA</span>
    </button>

    <div class="pf-chatbot__panel" id="pf-chatbot-panel" aria-hidden="true">
        <div class="pf-chatbot__header">
            <div class="d-flex align-items-center gap-2">
                <span class="pf-chatbot__avatar">IA</span>
                <div>
                    <div class="pf-chatbot__title">Assistant portfolio</div>
                    <div class="pf-chatbot__status">Disponible pour vous renseigner</div>
                </div>
            </div>
            <button class="pf-chatbot__close" id="pf-chatbot-close" type="button" aria-label="Fermer l'assistant">×</button>
        </div>

        <div class="pf-chatbot__messages" id="pf-chatbot-messages">
            <div class="pf-chatbot__message pf-chatbot__message--bot">
                Bonjour ! Je peux vous parler de {{ $about->name ?? 'ce portfolio' }}, de ses compétences, de ses projets et des solutions web/mobile qu'il peut réaliser.
            </div>
        </div>

        <div class="pf-chatbot__suggestions" id="pf-chatbot-suggestions">
            <button type="button" data-question="Que peux-tu me dire sur ce profil ?">Profil</button>
            <button type="button" data-question="Quelles solutions peut-il développer ?">Solutions</button>
            <button type="button" data-question="Quelles sont ses compétences ?">Compétences</button>
        </div>

        <form class="pf-chatbot__form" id="pf-chatbot-form">
            <input id="pf-chatbot-input" type="text" autocomplete="off" placeholder="Posez une question..." aria-label="Votre question">
            <button type="submit">Envoyer</button>
        </form>
    </div>
</section>

<style>
/* ══════════════════════════════════════════════════════════
   MODE CLAIR — dégradé bleu-ciel / indigo doux
══════════════════════════════════════════════════════════ */
:root {
    --pf-bg:            #f4f7ff;
    --pf-bg-alt:        #edf2ff;
    --pf-border:        rgba(79,70,229,.1);
    --pf-text:          #475569;
    --pf-heading:       #0f172a;
    --pf-accent:        #0d9488;
    --pf-accent2:       #4f46e5;
    --pf-card:          rgba(255,255,255,.75);
    --pf-glass:         rgba(255,255,255,.82);
    --pf-hover-bg:      rgba(0,0,0,.03);
    --pf-nav-scrolled:  rgba(244,247,255,.95);
    --pf-hero-bg:       linear-gradient(135deg,#e8f0fe 0%,#f4f7ff 55%,#e0fdf4 100%);
    --pf-footer-bg:     #0f172a;
    --pf-offcanvas-bg:  #ffffff;
    --pf-radius:        16px;
    --pf-radius-sm:     10px;
}

/* ══════════════════════════════════════════════════════════
   MODE SOMBRE — thème actuel
══════════════════════════════════════════════════════════ */
@media (prefers-color-scheme: dark) {
    :root {
        --pf-bg:            #0b1120;
        --pf-bg-alt:        #0f172a;
        --pf-border:        rgba(255,255,255,.07);
        --pf-text:          #94a3b8;
        --pf-heading:       #f1f5f9;
        --pf-accent:        #14b8a6;
        --pf-accent2:       #6366f1;
        --pf-card:          rgba(255,255,255,.03);
        --pf-glass:         rgba(255,255,255,.04);
        --pf-hover-bg:      rgba(255,255,255,.04);
        --pf-nav-scrolled:  rgba(11,17,32,.94);
        --pf-hero-bg:       linear-gradient(135deg,#060d1a 0%,#0b1a2a 60%,#05140f 100%);
        --pf-footer-bg:     #060d1a;
        --pf-offcanvas-bg:  #0f172a;
    }
}

.pf-body { background:var(--pf-bg); color:var(--pf-text); font-family:'Figtree',sans-serif; scroll-behavior:smooth; transition:background .3s,color .3s; }

/* Barre scroll */
#pf-scroll-bar { position:fixed; top:0; left:0; height:3px; width:0%; background:linear-gradient(90deg,var(--pf-accent),var(--pf-accent2)); z-index:9999; transition:width .1s linear; border-radius:0 2px 2px 0; }

/* Navbar */
.pf-nav { position:sticky; top:0; z-index:999; background:transparent; -webkit-backdrop-filter:blur(0); backdrop-filter:blur(0); border-bottom:1px solid transparent; transition:background .35s,border-color .35s,-webkit-backdrop-filter .35s,backdrop-filter .35s; }
.pf-nav.pf-nav--scrolled { background:var(--pf-nav-scrolled); -webkit-backdrop-filter:blur(18px); backdrop-filter:blur(18px); border-bottom-color:var(--pf-border); }

/* Logo */
.pf-nav__logo { display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:10px; background:linear-gradient(135deg,var(--pf-accent) 0%,var(--pf-accent2) 100%); color:#fff; font-size:.8rem; font-weight:800; letter-spacing:.03em; flex-shrink:0; }
.pf-nav__brand { display:inline-flex; align-items:center; gap:.65rem; }
.pf-nav__brand-text { font-size:1rem; font-weight:700; color:var(--pf-heading); letter-spacing:.02em; }

/* Liens nav */
.pf-nav__link { position:relative; color:var(--pf-text); text-decoration:none; font-size:.82rem; font-weight:500; padding:.45rem .75rem; border-radius:8px; transition:color .2s,background .2s; letter-spacing:.01em; }
.pf-nav__link::after { content:''; position:absolute; bottom:2px; left:50%; right:50%; height:2px; background:var(--pf-accent); border-radius:999px; transition:left .25s,right .25s; }
.pf-nav__link:hover { color:var(--pf-heading); background:var(--pf-hover-bg); }
.pf-nav__link:hover::after,.pf-nav__link.active::after { left:20%; right:20%; }
.pf-nav__link.active { color:var(--pf-accent); }

/* CTA nav */
.pf-nav__cta { display:inline-flex; align-items:center; padding:.48rem 1.15rem; background:var(--pf-accent); color:#fff!important; font-size:.82rem; font-weight:700; border-radius:999px; text-decoration:none; letter-spacing:.02em; transition:background .2s,transform .2s,box-shadow .2s; white-space:nowrap; }
.pf-nav__cta:hover { opacity:.88; transform:translateY(-1px); box-shadow:0 6px 20px rgba(13,148,136,.35); color:#fff!important; }

/* Hamburger */
.pf-hamburger { display:flex; flex-direction:column; justify-content:center; gap:5px; width:38px; height:38px; background:var(--pf-hover-bg); border:1px solid var(--pf-border); border-radius:9px; cursor:pointer; padding:0 9px; }
.pf-hamburger span { display:block; height:1.5px; background:var(--pf-text); border-radius:999px; transition:all .3s; }
@media (min-width: 992px) {
    .pf-hamburger { display:none!important; }
}

/* Menu mobile public.
   Ces regles protegent le menu si un style global ou un build CSS ecrase
   les styles Bootstrap offcanvas. */
#mobileMenu.offcanvas {
    position:fixed;
    top:0;
    right:0;
    bottom:0;
    left:auto;
    z-index:1045;
    display:flex;
    flex-direction:column;
    width:300px;
    max-width:85vw;
    transform:translateX(100%);
    visibility:hidden;
    transition:transform .3s ease-in-out, visibility .3s ease-in-out;
}
#mobileMenu.offcanvas.show {
    transform:none;
    visibility:visible;
}

/* Menu mobile liens */
.pf-mob-link { display:flex; align-items:center; gap:.75rem; padding:.85rem 1rem; border-radius:10px; color:var(--pf-text); text-decoration:none; font-size:.9rem; font-weight:500; transition:background .2s,color .2s; }
.pf-mob-link::before { content:''; width:5px; height:5px; border-radius:50%; background:var(--pf-accent); opacity:0; transition:opacity .2s; flex-shrink:0; }
.pf-mob-link:hover { background:var(--pf-hover-bg); color:var(--pf-heading); }
.pf-mob-link:hover::before { opacity:1; }

/* Bouton fermer offcanvas */
.pf-offcanvas-close { width:32px; height:32px; background:var(--pf-hover-bg); border:1px solid var(--pf-border); border-radius:8px; cursor:pointer; display:flex; align-items:center; justify-content:center; padding:0; transition:background .2s; }
.pf-offcanvas-close:hover { background:var(--pf-border); }

/* Hero */
.pf-hero { position:relative; overflow:hidden; background:var(--pf-hero-bg); }
.pf-hero__avatar { width:72px; height:72px; border-radius:50%; object-fit:cover; border:3px solid var(--pf-accent); flex-shrink:0; }
.pf-hero__avatar-fallback { width:72px; height:72px; border-radius:50%; background:linear-gradient(135deg,var(--pf-accent),var(--pf-accent2)); display:flex; align-items:center; justify-content:center; font-size:1.6rem; font-weight:800; color:#fff; flex-shrink:0; border:3px solid rgba(13,148,136,.4); }
.pf-about__photo { width:80px; height:80px; border-radius:50%; object-fit:cover; border:3px solid rgba(13,148,136,.4); flex-shrink:0; }
.pf-hero__name { font-size:clamp(2.2rem,6vw,4rem); font-weight:800; color:var(--pf-heading); line-height:1.1; }
.pf-hero__role { font-size:1.1rem; color:var(--pf-accent); font-weight:600; margin-top:.5rem; }
.pf-hero__desc { color:var(--pf-text); max-width:500px; line-height:1.8; margin-top:1rem; }
.pf-hero__socials a { color:var(--pf-text); text-decoration:none; font-size:.875rem; font-weight:500; transition:color .2s; }
.pf-hero__socials a:hover { color:var(--pf-accent); }
.pf-badge { display:inline-block; padding:.3rem .9rem; background:rgba(13,148,136,.12); color:var(--pf-accent); border:1px solid rgba(13,148,136,.25); border-radius:999px; font-size:.7rem; font-weight:700; letter-spacing:.14em; text-transform:uppercase; }
.pf-stats-card { background:var(--pf-glass); border:1px solid var(--pf-border); border-radius:var(--pf-radius); padding:1.75rem; -webkit-backdrop-filter:blur(8px); backdrop-filter:blur(8px); box-shadow:0 4px 20px rgba(0,0,0,.06); }
.pf-stats-card__title { font-size:.7rem; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:var(--pf-accent); }
.pf-stat { background:var(--pf-hover-bg); border:1px solid var(--pf-border); border-radius:var(--pf-radius-sm); padding:1rem; }
.pf-stat__num { display:block; font-size:2rem; font-weight:800; color:var(--pf-heading); line-height:1; }
.pf-stat__label { display:block; font-size:.75rem; color:var(--pf-text); margin-top:.2rem; }
.pf-avail { display:inline-flex; align-items:center; gap:.4rem; font-size:.75rem; font-weight:600; padding:.3rem .8rem; border-radius:999px; }
.pf-avail::before { content:''; width:8px; height:8px; border-radius:50%; flex-shrink:0; }
.pf-avail--open { background:rgba(16,185,129,.15); color:#059669; }
.pf-avail--open::before { background:#10b981; animation:pulse 1.5s infinite; }
.pf-avail--closed { background:rgba(239,68,68,.12); color:#ef4444; }
.pf-avail--closed::before { background:#ef4444; }
@media (prefers-color-scheme: dark) {
    .pf-avail--open { color:#10b981; }
}
@keyframes pulse { 0%,100%{opacity:1}50%{opacity:.3} }

/* Boutons */
.pf-btn { display:inline-flex; align-items:center; gap:.4rem; padding:.7rem 1.6rem; border-radius:var(--pf-radius-sm); font-size:.875rem; font-weight:600; text-decoration:none; cursor:pointer; border:none; transition:all .2s; }
.pf-btn--primary { background:var(--pf-accent); color:#fff; }
.pf-btn--primary:hover { opacity:.88; color:#fff; transform:translateY(-2px); box-shadow:0 8px 24px rgba(13,148,136,.3); }
.pf-btn--outline { background:transparent; color:var(--pf-heading); border:1.5px solid var(--pf-border); }
.pf-btn--outline:hover { border-color:var(--pf-accent); color:var(--pf-accent); }
.pf-btn--ghost { background:var(--pf-hover-bg); color:var(--pf-text); }
.pf-btn--ghost:hover { background:var(--pf-border); color:var(--pf-heading); }

/* Sections */
.pf-section { padding:6rem 0; }
.pf-section--alt { background:var(--pf-bg-alt); }
.pf-section__label { font-size:.7rem; font-weight:700; letter-spacing:.2em; text-transform:uppercase; color:var(--pf-accent); }
.pf-section__title { font-size:clamp(1.6rem,3vw,2.4rem); font-weight:800; color:var(--pf-heading); margin-top:.4rem; }
.pf-section__text { color:var(--pf-text); line-height:1.8; }

/* Cards génériques */
.pf-card { background:var(--pf-card); border:1px solid var(--pf-border); border-radius:var(--pf-radius); padding:1.75rem; transition:border-color .25s,transform .25s,box-shadow .25s; box-shadow:0 2px 12px rgba(0,0,0,.04); }
.pf-card:hover { border-color:rgba(13,148,136,.35); transform:translateY(-3px); box-shadow:0 10px 30px rgba(0,0,0,.08); }
.pf-card__category { font-size:.7rem; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:var(--pf-accent); }

/* Compétences */
.pf-progress { height:7px; background:var(--pf-hover-bg); border-radius:999px; overflow:hidden; }
.pf-progress__bar { height:100%; width:0; border-radius:999px; transition:width 1.2s cubic-bezier(.4,0,.2,1); }
.pf-pct-badge { font-size:.7rem; font-weight:700; color:var(--pf-accent); background:rgba(13,148,136,.1); padding:.15rem .5rem; border-radius:999px; }

/* À propos */
.pf-about-card { background:var(--pf-card); border:1px solid var(--pf-border); border-radius:var(--pf-radius); padding:2rem; box-shadow:0 2px 12px rgba(0,0,0,.04); }
.pf-service-mini { display:flex; gap:1rem; align-items:flex-start; padding:.75rem; border-radius:var(--pf-radius-sm); background:var(--pf-hover-bg); border:1px solid var(--pf-border); transition:border-color .2s; }
.pf-service-mini:hover { border-color:rgba(13,148,136,.25); }
.pf-service-mini__icon { width:40px; height:40px; border-radius:10px; background:rgba(13,148,136,.12); color:var(--pf-accent); display:flex; align-items:center; justify-content:center; font-size:1rem; font-weight:800; flex-shrink:0; }
.pf-info-item { color:var(--pf-text); font-size:.9rem; }

/* Services */
.pf-service-card { background:var(--pf-card); border:1px solid var(--pf-border); border-radius:var(--pf-radius); padding:2rem; text-align:center; transition:all .25s; box-shadow:0 2px 12px rgba(0,0,0,.04); }
.pf-service-card:hover { border-color:rgba(79,70,229,.35); transform:translateY(-4px); box-shadow:0 16px 40px rgba(0,0,0,.1); }
.pf-service-card__icon { font-size:2rem; margin-bottom:.75rem; }

.pf-service-card__title { font-size:1.05rem; font-weight:700; color:var(--pf-heading); }

/* Projets */
.pf-project-card { display:flex; flex-direction:column; position:relative; background:var(--pf-card); border:1px solid var(--pf-border); border-radius:var(--pf-radius); padding:1.75rem; transition:all .25s; box-shadow:0 2px 12px rgba(0,0,0,.04); }
.pf-project-card:hover { border-color:rgba(13,148,136,.35); transform:translateY(-4px); box-shadow:0 20px 40px rgba(0,0,0,.12); }
.pf-project-card__badge { position:absolute; top:1rem; right:1rem; font-size:.65rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; background:rgba(13,148,136,.12); color:var(--pf-accent); padding:.25rem .6rem; border-radius:999px; border:1px solid rgba(13,148,136,.25); }
.pf-project-card__cat { font-size:.68rem; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:var(--pf-accent2); }
.pf-project-card__title { font-size:1.1rem; font-weight:700; color:var(--pf-heading); margin-top:.4rem; }
.pf-project-card__desc { font-size:.875rem; color:var(--pf-text); margin-top:.6rem; flex:1; }
.pf-project-card__link { font-size:.8rem; font-weight:600; color:var(--pf-accent); text-decoration:none; transition:color .2s; }
.pf-project-card__link:hover { opacity:.8; }
.pf-tech-tag { font-size:.68rem; font-weight:600; background:rgba(79,70,229,.1); color:var(--pf-accent2); border:1px solid rgba(79,70,229,.18); padding:.2rem .55rem; border-radius:999px; }

/* Timeline */
.pf-timeline { position:relative; padding-left:1.75rem; }
.pf-timeline::before { content:''; position:absolute; left:5px; top:0; bottom:0; width:2px; background:var(--pf-border); }
.pf-timeline__item { position:relative; padding-bottom:2rem; }
.pf-timeline__dot { position:absolute; left:-1.6rem; top:5px; width:13px; height:13px; border-radius:50%; background:var(--pf-accent); border:2px solid var(--pf-bg); }
.pf-timeline__dot--edu { background:var(--pf-accent2); }
.pf-timeline__period { font-size:.7rem; font-weight:700; letter-spacing:.1em; color:var(--pf-accent); text-transform:uppercase; }
.pf-timeline__title { font-size:1rem; font-weight:700; color:var(--pf-heading); margin-top:.2rem; }
.pf-timeline__sub { font-size:.8rem; color:var(--pf-text); margin-top:.15rem; }

/* Technologies */
.pf-tech-pill { background:var(--pf-card); border:1px solid var(--pf-border); border-radius:999px; padding:.5rem 1.2rem; font-size:.8rem; color:var(--pf-heading); display:flex; gap:.4rem; align-items:center; transition:all .2s; box-shadow:0 1px 4px rgba(0,0,0,.04); }
.pf-tech-pill:hover { border-color:rgba(13,148,136,.4); color:var(--pf-accent); }

/* Témoignages */
.pf-testimonial { background:var(--pf-card); border:1px solid var(--pf-border); border-radius:var(--pf-radius); padding:1.75rem; display:flex; flex-direction:column; gap:.75rem; transition:border-color .25s,box-shadow .25s; box-shadow:0 2px 12px rgba(0,0,0,.04); }
.pf-testimonial:hover { border-color:rgba(13,148,136,.3); box-shadow:0 8px 24px rgba(0,0,0,.08); }
.pf-testimonial__stars { font-size:1rem; letter-spacing:.1rem; }
.pf-testimonial__text { font-size:.875rem; color:var(--pf-text); line-height:1.8; font-style:italic; flex:1; }
.pf-testimonial__avatar { width:40px; height:40px; border-radius:50%; background:linear-gradient(135deg,var(--pf-accent),var(--pf-accent2)); display:flex; align-items:center; justify-content:center; font-weight:800; font-size:.9rem; flex-shrink:0; color:#fff; }

/* Blog */
.pf-blog-card { background:var(--pf-card); border:1px solid var(--pf-border); border-radius:var(--pf-radius); overflow:hidden; transition:all .25s; box-shadow:0 2px 12px rgba(0,0,0,.04); }
.pf-blog-card:hover { border-color:rgba(13,148,136,.3); transform:translateY(-3px); box-shadow:0 10px 28px rgba(0,0,0,.08); }
.pf-blog-card__img { height:180px; background-size:cover; background-position:center; }
.pf-blog-card__img-placeholder { height:120px; background:linear-gradient(135deg,rgba(13,148,136,.15),rgba(79,70,229,.15)); display:flex; align-items:center; justify-content:center; font-size:2.5rem; font-weight:800; color:var(--pf-accent); }
.pf-blog-card__body { padding:1.25rem; }
.pf-blog-card__date { color:var(--pf-text); }
.pf-blog-card__title { font-size:1rem; font-weight:700; color:var(--pf-heading); margin-top:.3rem; }

/* Ressources */
.pf-resource-card { background:var(--pf-card); border:1px solid var(--pf-border); border-radius:var(--pf-radius); padding:1.35rem; display:flex; flex-direction:column; gap:.8rem; transition:all .25s; box-shadow:0 2px 12px rgba(0,0,0,.04); }
.pf-resource-card:hover { border-color:rgba(13,148,136,.35); transform:translateY(-3px); box-shadow:0 10px 28px rgba(0,0,0,.08); }
.pf-resource-card__top { display:flex; align-items:center; justify-content:space-between; gap:1rem; }
.pf-resource-card__icon { width:42px; height:42px; border-radius:12px; background:linear-gradient(135deg,var(--pf-accent),var(--pf-primary)); color:#fff; display:flex; align-items:center; justify-content:center; font-size:.75rem; font-weight:800; letter-spacing:.04em; flex-shrink:0; }
.pf-resource-card__type { font-size:.68rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; color:var(--pf-accent); background:rgba(13,148,136,.08); border:1px solid rgba(13,148,136,.18); border-radius:999px; padding:.25rem .65rem; }
.pf-resource-card__title { color:var(--pf-heading); font-size:1.05rem; font-weight:800; margin:0; line-height:1.35; }
.pf-resource-card__link { margin-top:auto; color:var(--pf-accent); font-size:.82rem; font-weight:800; text-decoration:none; display:inline-flex; align-items:center; gap:.35rem; }
.pf-resource-card__link::after { content:"↗"; font-size:.8rem; }
.pf-resource-card__link:hover { color:var(--pf-primary); }
.pf-resource-empty { background:var(--pf-card); border:1px dashed rgba(13,148,136,.35); border-radius:var(--pf-radius); padding:2rem; text-align:center; }
.pf-resource-empty__icon { display:inline-flex; width:48px; height:48px; border-radius:14px; align-items:center; justify-content:center; background:rgba(13,148,136,.08); margin-bottom:1rem; }
.pf-resource-empty__title { color:var(--pf-heading); font-size:1.05rem; font-weight:800; margin-bottom:.4rem; }

/* FAQ */
.pf-faq-item { border:1px solid var(--pf-border); border-radius:var(--pf-radius-sm); margin-bottom:.75rem; overflow:hidden; }
.pf-faq-btn { width:100%; text-align:left; background:var(--pf-card); color:var(--pf-heading); padding:1.1rem 1.25rem; border:none; cursor:pointer; font-size:.9rem; font-weight:600; display:flex; justify-content:space-between; align-items:center; transition:background .2s; }
.pf-faq-btn:hover { background:var(--pf-hover-bg); }
.pf-faq-btn__icon { font-size:1.3rem; color:var(--pf-accent); line-height:1; transition:transform .3s; }
.pf-faq-btn:not(.collapsed) .pf-faq-btn__icon { transform:rotate(45deg); }
.pf-faq-body { padding:1rem 1.25rem; font-size:.875rem; color:var(--pf-text); line-height:1.8; background:var(--pf-hover-bg); border-top:1px solid var(--pf-border); }

/* ── Section Contact ── */
.pf-contact-section { position:relative; padding:6rem 0; background:var(--pf-bg-alt); overflow:hidden; }
.pf-contact-glow { position:absolute; bottom:-200px; right:-100px; width:500px; height:500px; background:radial-gradient(circle,rgba(79,70,229,.1) 0%,transparent 65%); pointer-events:none; }

/* Carte dispo */
.pf-dispo-card { display:flex; align-items:flex-start; gap:.9rem; background:var(--pf-card); border:1px solid var(--pf-border); border-radius:var(--pf-radius-sm); padding:1rem 1.2rem; box-shadow:0 1px 6px rgba(0,0,0,.04); }
.pf-dispo-card__dot { width:10px; height:10px; border-radius:50%; flex-shrink:0; margin-top:4px; }
.pf-dispo-card__dot--on { background:#10b981; animation:pulse 1.5s infinite; }
.pf-dispo-card__dot--off { background:#ef4444; }

/* Cartes info contact */
.pf-cinfo-card { display:flex; align-items:center; gap:.9rem; background:var(--pf-card); border:1px solid var(--pf-border); border-radius:var(--pf-radius-sm); padding:.9rem 1.1rem; text-decoration:none; transition:border-color .2s,background .2s,box-shadow .2s; box-shadow:0 1px 6px rgba(0,0,0,.04); }
.pf-cinfo-card:hover { border-color:rgba(13,148,136,.35); box-shadow:0 6px 18px rgba(0,0,0,.08); }
.pf-cinfo-card__icon { width:40px; height:40px; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.pf-cinfo-card__label { font-size:.68rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--pf-text); }
.pf-cinfo-card__value { font-size:.85rem; font-weight:500; color:var(--pf-heading); margin-top:.1rem; }

/* Boutons sociaux */
.pf-social-pill { display:inline-flex; align-items:center; gap:.5rem; padding:.45rem 1rem; border:1px solid var(--pf-border); border-radius:999px; color:var(--pf-text); text-decoration:none; font-size:.78rem; font-weight:600; background:var(--pf-card); transition:all .2s; }
.pf-social-pill:hover { border-color:var(--pf-accent); color:var(--pf-accent); background:rgba(13,148,136,.06); }

/* Formulaire contact */
.pf-contact-form { background:var(--pf-glass); border:1px solid var(--pf-border); border-radius:var(--pf-radius); padding:2rem; box-shadow:0 4px 20px rgba(0,0,0,.06); }
.pf-contact-form__header { display:flex; align-items:center; gap:.6rem; font-size:.9rem; font-weight:700; color:var(--pf-heading); padding-bottom:1.25rem; margin-bottom:1.5rem; border-bottom:1px solid var(--pf-border); }
.pf-required { color:var(--pf-accent); }
.pf-form__label { display:block; font-size:.75rem; font-weight:600; color:var(--pf-text); margin-bottom:.4rem; letter-spacing:.03em; }
.pf-form__input { width:100%; background:var(--pf-hover-bg); border:1.5px solid var(--pf-border); border-radius:var(--pf-radius-sm); color:var(--pf-heading); padding:.75rem 1rem; font-size:.875rem; outline:none; transition:border-color .2s,box-shadow .2s; font-family:inherit; resize:vertical; }
.pf-form__input::placeholder { color:var(--pf-text); opacity:.45; }
.pf-form__input:focus { border-color:var(--pf-accent); box-shadow:0 0 0 3px rgba(13,148,136,.12); }
.pf-form__input.is-error { border-color:#ef4444; }
.pf-form__error { font-size:.73rem; color:#f87171; margin-top:.3rem; display:block; }
.pf-submit-btn { display:flex; align-items:center; justify-content:center; gap:.6rem; width:100%; padding:.85rem 1.5rem; background:linear-gradient(135deg,var(--pf-accent) 0%,var(--pf-accent2) 100%); color:#fff; font-size:.9rem; font-weight:700; border:none; border-radius:var(--pf-radius-sm); cursor:pointer; transition:all .25s; letter-spacing:.02em; }
.pf-submit-btn:hover { transform:translateY(-2px); box-shadow:0 10px 28px rgba(13,148,136,.3); }
.pf-alert { padding:.9rem 1.2rem; border-radius:var(--pf-radius-sm); font-size:.875rem; }
.pf-alert--success { background:rgba(16,185,129,.1); border:1px solid rgba(16,185,129,.3); color:#059669; }
.pf-alert--error { background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); color:#dc2626; }
@media (prefers-color-scheme: dark) {
    .pf-alert--success { color:#6ee7b7; }
    .pf-alert--error { color:#fca5a5; }
}

/* ── Footer ── */
.pf-footer { background:var(--pf-footer-bg); border-top:1px solid var(--pf-border); }
.pf-footer__heading { font-size:.68rem; font-weight:700; letter-spacing:.15em; text-transform:uppercase; color:var(--pf-accent); margin-bottom:.9rem; }
.pf-footer__link { color:#64748b; text-decoration:none; font-size:.85rem; transition:color .2s; }
.pf-footer__link:hover { color:#94a3b8; }
.pf-footer__social { display:inline-flex; align-items:center; gap:.5rem; color:#64748b; text-decoration:none; font-size:.82rem; font-weight:500; transition:color .2s; padding:.2rem 0; }
.pf-footer__social:hover { color:var(--pf-accent); }
.pf-footer__bottom { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem; padding:1.25rem 0; border-top:1px solid rgba(255,255,255,.06); }
.pf-footer__totop { display:inline-flex; align-items:center; gap:.4rem; font-size:.75rem; font-weight:600; color:#475569; text-decoration:none; background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.08); border-radius:999px; padding:.35rem .9rem; transition:all .2s; }
.pf-footer__totop:hover { color:var(--pf-accent); border-color:rgba(13,148,136,.3); background:rgba(13,148,136,.06); }

/* Chatbot IA */
.pf-chatbot { position:fixed; right:1.25rem; bottom:1.25rem; z-index:1100; font-family:inherit; }
.pf-chatbot__toggle { position:relative; width:58px; height:58px; border:0; border-radius:18px; background:linear-gradient(135deg,var(--pf-accent),var(--pf-accent2)); color:#fff; box-shadow:0 18px 45px rgba(13,148,136,.28); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:transform .2s, box-shadow .2s; }
.pf-chatbot__toggle:hover { transform:translateY(-2px); box-shadow:0 22px 55px rgba(79,70,229,.3); }
.pf-chatbot__icon { position:relative; z-index:1; font-weight:900; font-size:.85rem; letter-spacing:.08em; }
.pf-chatbot__pulse { position:absolute; inset:-5px; border-radius:22px; border:1px solid rgba(13,148,136,.35); animation:chatPulse 1.8s infinite; }
.pf-chatbot__panel { position:absolute; right:0; bottom:74px; width:min(360px, calc(100vw - 2.5rem)); max-height:min(640px, calc(100vh - 7rem)); display:flex; flex-direction:column; overflow:hidden; background:var(--pf-glass); border:1px solid var(--pf-border); border-radius:18px; box-shadow:0 24px 70px rgba(15,23,42,.18); -webkit-backdrop-filter:blur(18px); backdrop-filter:blur(18px); opacity:0; transform:translateY(14px) scale(.98); pointer-events:none; transition:opacity .22s, transform .22s; }
.pf-chatbot.is-open .pf-chatbot__panel { opacity:1; transform:none; pointer-events:auto; }
.pf-chatbot__header { display:flex; align-items:center; justify-content:space-between; gap:1rem; padding:1rem; border-bottom:1px solid var(--pf-border); background:rgba(255,255,255,.36); }
.pf-chatbot__avatar { width:38px; height:38px; border-radius:12px; display:inline-flex; align-items:center; justify-content:center; color:#fff; font-size:.76rem; font-weight:900; letter-spacing:.08em; background:linear-gradient(135deg,var(--pf-accent),var(--pf-accent2)); flex-shrink:0; }
.pf-chatbot__title { color:var(--pf-heading); font-size:.9rem; font-weight:800; }
.pf-chatbot__status { color:var(--pf-text); font-size:.72rem; margin-top:.1rem; }
.pf-chatbot__close { width:32px; height:32px; border:1px solid var(--pf-border); border-radius:10px; background:var(--pf-hover-bg); color:var(--pf-text); font-size:1.3rem; line-height:1; cursor:pointer; }
.pf-chatbot__messages { display:flex; flex-direction:column; gap:.7rem; padding:1rem; overflow-y:auto; min-height:230px; max-height:350px; scrollbar-width:thin; }
.pf-chatbot__message { max-width:88%; padding:.72rem .85rem; border-radius:14px; font-size:.84rem; line-height:1.6; white-space:pre-line; }
.pf-chatbot__message--bot { align-self:flex-start; background:var(--pf-hover-bg); color:var(--pf-text); border:1px solid var(--pf-border); border-bottom-left-radius:4px; }
.pf-chatbot__message--user { align-self:flex-end; background:linear-gradient(135deg,var(--pf-accent),var(--pf-accent2)); color:#fff; border-bottom-right-radius:4px; }
.pf-chatbot__suggestions { display:flex; gap:.5rem; padding:0 1rem 1rem; overflow-x:auto; }
.pf-chatbot__suggestions button { border:1px solid rgba(13,148,136,.28); background:rgba(13,148,136,.08); color:var(--pf-accent); border-radius:999px; padding:.38rem .75rem; font-size:.72rem; font-weight:800; white-space:nowrap; cursor:pointer; }
.pf-chatbot__form { display:flex; gap:.55rem; padding:1rem; border-top:1px solid var(--pf-border); background:rgba(255,255,255,.28); }
.pf-chatbot__form input { flex:1; min-width:0; border:1.5px solid var(--pf-border); background:var(--pf-hover-bg); color:var(--pf-heading); border-radius:12px; padding:.72rem .85rem; font-size:.84rem; outline:none; }
.pf-chatbot__form input:focus { border-color:var(--pf-accent); box-shadow:0 0 0 3px rgba(13,148,136,.12); }
.pf-chatbot__form button { border:0; border-radius:12px; padding:.72rem .9rem; background:var(--pf-accent); color:#fff; font-size:.78rem; font-weight:800; cursor:pointer; }
@keyframes chatPulse { 0%{opacity:.75;transform:scale(.95)} 70%,100%{opacity:0;transform:scale(1.2)} }

@media (max-width: 575.98px) {
    .pf-chatbot { right:1rem; bottom:1rem; }
    .pf-chatbot__panel { right:-.25rem; bottom:70px; width:calc(100vw - 1.5rem); }
    .pf-chatbot__toggle { width:54px; height:54px; border-radius:16px; }
}

@media (prefers-color-scheme: dark) {
    .pf-chatbot__header, .pf-chatbot__form { background:rgba(15,23,42,.55); }
}

/* Animations reveal */
.reveal { opacity:0; transform:translateY(28px); transition:opacity .7s cubic-bezier(.4,0,.2,1),transform .7s cubic-bezier(.4,0,.2,1); }
.reveal--delay { transition-delay:.18s; }
.reveal.is-visible { opacity:1; transform:none; }
</style>

<script>
(function () {
    var portfolioContext = {
        name: @json($about->name ?? $setting->site_name ?? 'ce développeur'),
        profession: @json($about->profession ?? 'développeur full stack'),
        description: @json($about->short_description ?? $about->description ?? 'Il conçoit des solutions web et mobiles adaptées aux besoins des utilisateurs.'),
        location: @json($about->location ?? null),
        available: @json((bool) ($about->is_available ?? false)),
        skills: @json($skills->flatten()->pluck('name')->filter()->values()->take(12)),
        services: @json($services->pluck('title')->filter()->values()->take(8)),
        projects: @json($projects->pluck('title')->filter()->values()->take(6)),
        technologies: @json($technologies->pluck('name')->filter()->values()->take(12)),
        resources: @json($learningResources->pluck('title')->filter()->values()->take(8)),
    };

    // Reveal au scroll
    var io = new IntersectionObserver(function(entries) {
        entries.forEach(function(e) {
            if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(function(el) { io.observe(el); });

    // Barres de competences animees
    var barIO = new IntersectionObserver(function(entries) {
        entries.forEach(function(e) {
            if (e.isIntersecting) { e.target.style.width = e.target.dataset.width + '%'; barIO.unobserve(e.target); }
        });
    }, { threshold: 0.3 });
    document.querySelectorAll('.skill-bar').forEach(function(b) { barIO.observe(b); });

    // Navbar : scroll transparent → opaque + barre progression + liens actifs
    var nav = document.getElementById('pf-nav');
    var scrollBar = document.getElementById('pf-scroll-bar');
    var navLinks = document.querySelectorAll('.pf-nav__link[data-section]');
    var sections = Array.from(navLinks).map(function(l) { return document.getElementById(l.dataset.section); }).filter(Boolean);
    window.addEventListener('scroll', function() {
        var scrollY = window.scrollY;
        var docH = document.documentElement.scrollHeight - window.innerHeight;
        // Navbar opaque
        if (scrollY > 40) { nav.classList.add('pf-nav--scrolled'); } else { nav.classList.remove('pf-nav--scrolled'); }
        // Barre progression
        scrollBar.style.width = (docH > 0 ? (scrollY / docH * 100) : 0) + '%';
        // Lien actif
        var pos = scrollY + 120;
        sections.forEach(function(sec, i) {
            if (sec.offsetTop <= pos && sec.offsetTop + sec.offsetHeight > pos) {
                navLinks.forEach(function(l) { l.classList.remove('active'); });
                navLinks[i].classList.add('active');
            }
        });
    }, { passive: true });

    // Chatbot IA : squelette local, pret a remplacer par un appel API.
    var chatbot = document.getElementById('pf-chatbot');
    var chatToggle = document.getElementById('pf-chatbot-toggle');
    var chatClose = document.getElementById('pf-chatbot-close');
    var chatPanel = document.getElementById('pf-chatbot-panel');
    var chatForm = document.getElementById('pf-chatbot-form');
    var chatInput = document.getElementById('pf-chatbot-input');
    var chatMessages = document.getElementById('pf-chatbot-messages');
    var chatSuggestions = document.getElementById('pf-chatbot-suggestions');

    function setChatOpen(open) {
        chatbot.classList.toggle('is-open', open);
        chatPanel.setAttribute('aria-hidden', open ? 'false' : 'true');
        if (open) { setTimeout(function() { chatInput.focus(); }, 120); }
    }

    function appendMessage(text, type) {
        var message = document.createElement('div');
        message.className = 'pf-chatbot__message pf-chatbot__message--' + type;
        message.textContent = text;
        chatMessages.appendChild(message);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function formatList(items, fallback) {
        return items && items.length ? items.join(', ') : fallback;
    }

    function localPortfolioReply(question) {
        var q = question.toLowerCase();

        if (q.includes('competence') || q.includes('compétence') || q.includes('technologie') || q.includes('stack')) {
            return portfolioContext.name + ' travaille notamment avec : ' + formatList(portfolioContext.skills.concat(portfolioContext.technologies).slice(0, 12), 'des technologies web et mobiles modernes') + '.';
        }

        if (q.includes('projet') || q.includes('realisation') || q.includes('réalisation')) {
            return 'Voici quelques réalisations à explorer : ' + formatList(portfolioContext.projects, 'les projets seront ajoutés progressivement dans le portfolio') + '.';
        }

        if (q.includes('ressource') || q.includes('site') || q.includes('video') || q.includes('vidéo') || q.includes('formation') || q.includes('documentation')) {
            return 'Quelques ressources qui ont aidé son apprentissage : ' + formatList(portfolioContext.resources, 'elles seront ajoutées progressivement dans la section Ressources') + '.';
        }

        if (q.includes('mobile') || q.includes('web') || q.includes('solution') || q.includes('application')) {
            return portfolioContext.name + ' peut aider à concevoir des applications web, des interfaces d’administration, des portfolios, des sites vitrines, des APIs et des solutions mobiles selon les besoins du projet.';
        }

        if (q.includes('contact') || q.includes('mission') || q.includes('disponible')) {
            return portfolioContext.available
                ? portfolioContext.name + ' est disponible pour discuter d’une mission. Vous pouvez utiliser le formulaire de contact plus bas sur la page.'
                : 'Vous pouvez quand même envoyer un message via le formulaire de contact pour présenter votre besoin.';
        }

        return portfolioContext.name + ' est ' + portfolioContext.profession + '. ' + portfolioContext.description + ' Je peux aussi répondre à des questions sur ses compétences, ses projets ou les solutions informatiques qu’il peut développer.';
    }

    function handleQuestion(question) {
        if (!question.trim()) { return; }
        appendMessage(question, 'user');
        chatInput.value = '';

        setTimeout(function() {
            // Plus tard : remplacer cette ligne par fetch('/api/chatbot', ...)
            appendMessage(localPortfolioReply(question), 'bot');
        }, 350);
    }

    if (chatbot && chatToggle && chatForm) {
        chatToggle.addEventListener('click', function() { setChatOpen(!chatbot.classList.contains('is-open')); });
        chatClose.addEventListener('click', function() { setChatOpen(false); });
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleQuestion(chatInput.value);
        });
        chatSuggestions.addEventListener('click', function(e) {
            if (e.target.matches('button[data-question]')) {
                handleQuestion(e.target.dataset.question);
            }
        });
    }
})();
</script>

</body>
</html>
