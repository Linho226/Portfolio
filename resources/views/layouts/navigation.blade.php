@php
function nav_active(string|array $patterns): string {
    return request()->routeIs($patterns) ? 'active' : '';
}
$unreadCount = \App\Models\Contact::where('is_read', false)->count();
@endphp

{{-- TOPBAR MOBILE --}}
<div class="admin-mobile-topbar d-lg-none sticky-top">
    <div class="container-fluid d-flex align-items-center justify-content-between py-2 px-3">
        <a class="d-flex align-items-center gap-2 text-decoration-none" href="{{ route('admin.dashboard') }}" style="color:var(--adm-text)">
            <span class="admin-brand-mark">PA</span>
            <span class="fw-semibold" style="font-size:.9rem;">Admin Portfolio</span>
        </a>
        <button class="btn btn-sm" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#adminSidebarMobile"
                style="border:1px solid var(--adm-divider);color:var(--adm-text);border-radius:8px;padding:.3rem .7rem;">
            ☰ Menu
            @if($unreadCount > 0)<span class="badge bg-danger ms-1" style="font-size:.65rem;">{{ $unreadCount }}</span>@endif
        </button>
    </div>
</div>

{{-- SIDEBAR DESKTOP --}}
<aside class="admin-sidebar d-none d-lg-flex flex-column p-3">

    {{-- Brand --}}
    <a class="d-flex align-items-center gap-2 text-decoration-none mb-4 mt-1" href="{{ route('admin.dashboard') }}" style="color:var(--adm-text)">
        <span class="admin-brand-mark">PA</span>
        <span class="fw-bold" style="font-size:.92rem;letter-spacing:-.01em;">Admin Portfolio</span>
    </a>

    {{-- GÉNÉRAL --}}
    <span class="sidebar-group-label">Général</span>
    <nav class="nav nav-pills flex-column gap-1 mb-3">
        <a class="nav-link {{ nav_active(['admin.dashboard']) }}" href="{{ route('admin.dashboard') }}">
            <span class="me-2">📊</span>Tableau de bord
        </a>
        <a class="nav-link {{ nav_active('admin.about.*') }}" href="{{ route('admin.about.edit') }}">
            <span class="me-2">👤</span>À propos
        </a>
        <a class="nav-link {{ nav_active('admin.social.*') }}" href="{{ route('admin.social.edit') }}">
            <span class="me-2">🔗</span>Réseaux sociaux
        </a>
        <a class="nav-link {{ nav_active('admin.settings.*') }}" href="{{ route('admin.settings.edit') }}">
            <span class="me-2">⚙️</span>Paramètres
        </a>
    </nav>

    {{-- CONTENU --}}
    <span class="sidebar-group-label">Contenu</span>
    <nav class="nav nav-pills flex-column gap-1 mb-3">
        <a class="nav-link {{ nav_active(['admin.skills.*', 'admin.competences.*']) }}" href="{{ route('admin.competences.index') }}">
            <span class="me-2">🎯</span>Compétences
        </a>
        <a class="nav-link {{ nav_active('admin.services.*') }}" href="{{ route('admin.services.index') }}">
            <span class="me-2">🛠️</span>Services
        </a>
        <a class="nav-link {{ nav_active('admin.projects.*') }}" href="{{ route('admin.projects.index') }}">
            <span class="me-2">💼</span>Projets
        </a>
        <a class="nav-link {{ nav_active('admin.technologies.*') }}" href="{{ route('admin.technologies.index') }}">
            <span class="me-2">💡</span>Technologies
        </a>
    </nav>

    {{-- PARCOURS --}}
    <span class="sidebar-group-label">Parcours</span>
    <nav class="nav nav-pills flex-column gap-1 mb-3">
        <a class="nav-link {{ nav_active('admin.experiences.*') }}" href="{{ route('admin.experiences.index') }}">
            <span class="me-2">📅</span>Expériences
        </a>
        <a class="nav-link {{ nav_active('admin.educations.*') }}" href="{{ route('admin.educations.index') }}">
            <span class="me-2">🎓</span>Formations
        </a>
    </nav>

    {{-- COMMUNICATION --}}
    <span class="sidebar-group-label">Communication</span>
    <nav class="nav nav-pills flex-column gap-1 mb-3">
        <a class="nav-link {{ nav_active('admin.testimonials.*') }}" href="{{ route('admin.testimonials.index') }}">
            <span class="me-2">⭐</span>Témoignages
        </a>
        <a class="nav-link {{ nav_active('admin.faqs.*') }}" href="{{ route('admin.faqs.index') }}">
            <span class="me-2">❓</span>FAQ
        </a>
        <a class="nav-link {{ nav_active('admin.messages.*') }}" href="{{ route('admin.messages.index') }}">
            <span class="me-2">✉️</span>Messages
            @if($unreadCount > 0)<span class="badge bg-danger ms-auto">{{ $unreadCount }}</span>@endif
        </a>
    </nav>

    {{-- PIED DE SIDEBAR --}}
    <div class="mt-auto pt-3" style="border-top:1px solid var(--adm-divider);">
        <div class="d-flex align-items-center gap-2 mb-3">
            <div style="width:34px;height:34px;border-radius:50%;background:var(--adm-active-bg);display:flex;align-items:center;justify-content:center;font-size:.8rem;color:#fff;font-weight:700;flex-shrink:0;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div style="min-width:0;">
                <div class="fw-semibold" style="font-size:.8rem;color:var(--adm-text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::user()->name }}</div>
                <div style="font-size:.7rem;color:var(--adm-text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <div class="d-grid gap-2">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('profile.edit') }}">Profil</a>
            <a class="btn btn-outline-primary btn-sm" href="{{ route('home') }}" target="_blank">↗ Voir le site</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm w-100">Déconnexion</button>
            </form>
        </div>
    </div>
</aside>

{{-- SIDEBAR MOBILE OFFCANVAS --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="adminSidebarMobile">
    <div class="offcanvas-header" style="border-bottom:1px solid var(--adm-divider);">
        <div class="d-flex align-items-center gap-2">
            <span class="admin-brand-mark">PA</span>
            <span class="fw-bold" style="font-size:.92rem;color:var(--adm-text);">Admin Portfolio</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column p-3">

        <span class="sidebar-group-label">Général</span>
        <nav class="nav nav-pills flex-column gap-1 mb-3">
            <a class="nav-link {{ nav_active(['admin.dashboard']) }}" href="{{ route('admin.dashboard') }}" data-bs-dismiss="offcanvas">📊 Tableau de bord</a>
            <a class="nav-link {{ nav_active('admin.about.*') }}" href="{{ route('admin.about.edit') }}" data-bs-dismiss="offcanvas">👤 À propos</a>
            <a class="nav-link {{ nav_active('admin.social.*') }}" href="{{ route('admin.social.edit') }}" data-bs-dismiss="offcanvas">🔗 Réseaux sociaux</a>
            <a class="nav-link {{ nav_active('admin.settings.*') }}" href="{{ route('admin.settings.edit') }}" data-bs-dismiss="offcanvas">⚙️ Paramètres</a>
        </nav>

        <span class="sidebar-group-label">Contenu</span>
        <nav class="nav nav-pills flex-column gap-1 mb-3">
            <a class="nav-link {{ nav_active(['admin.skills.*', 'admin.competences.*']) }}" href="{{ route('admin.competences.index') }}" data-bs-dismiss="offcanvas">🎯 Compétences</a>
            <a class="nav-link {{ nav_active('admin.services.*') }}" href="{{ route('admin.services.index') }}" data-bs-dismiss="offcanvas">🛠️ Services</a>
            <a class="nav-link {{ nav_active('admin.projects.*') }}" href="{{ route('admin.projects.index') }}" data-bs-dismiss="offcanvas">💼 Projets</a>
            <a class="nav-link {{ nav_active('admin.technologies.*') }}" href="{{ route('admin.technologies.index') }}" data-bs-dismiss="offcanvas">💡 Technologies</a>
        </nav>

        <span class="sidebar-group-label">Parcours</span>
        <nav class="nav nav-pills flex-column gap-1 mb-3">
            <a class="nav-link {{ nav_active('admin.experiences.*') }}" href="{{ route('admin.experiences.index') }}" data-bs-dismiss="offcanvas">📅 Expériences</a>
            <a class="nav-link {{ nav_active('admin.educations.*') }}" href="{{ route('admin.educations.index') }}" data-bs-dismiss="offcanvas">🎓 Formations</a>
        </nav>

        <span class="sidebar-group-label">Communication</span>
        <nav class="nav nav-pills flex-column gap-1 mb-3">
            <a class="nav-link {{ nav_active('admin.testimonials.*') }}" href="{{ route('admin.testimonials.index') }}" data-bs-dismiss="offcanvas">⭐ Témoignages</a>
            <a class="nav-link {{ nav_active('admin.faqs.*') }}" href="{{ route('admin.faqs.index') }}" data-bs-dismiss="offcanvas">❓ FAQ</a>
            <a class="nav-link {{ nav_active('admin.messages.*') }}" href="{{ route('admin.messages.index') }}" data-bs-dismiss="offcanvas">
                ✉️ Messages
                @if($unreadCount > 0)<span class="badge bg-danger ms-2">{{ $unreadCount }}</span>@endif
            </a>
        </nav>

        <div class="mt-auto pt-3" style="border-top:1px solid var(--adm-divider);">
            <div class="fw-semibold mb-1" style="font-size:.82rem;color:var(--adm-text);">{{ Auth::user()->name }}</div>
            <div class="mb-3" style="font-size:.73rem;color:var(--adm-text-muted);">{{ Auth::user()->email }}</div>
            <a class="btn btn-outline-primary btn-sm w-100 mb-2" href="{{ route('home') }}" target="_blank">↗ Voir le site</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm w-100">Déconnexion</button>
            </form>
        </div>
    </div>
</div>

