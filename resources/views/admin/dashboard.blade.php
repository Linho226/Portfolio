<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="h4 mb-0 section-title">Tableau de bord</h1>
            <p class="mb-0 mt-1" style="color:var(--adm-text-muted);font-size:.82rem;">Vue d'ensemble de votre portfolio</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-primary btn-sm">↗ Voir le site</a>
    </x-slot>

    {{-- ════════════════════════════════════════════════
         ROW 1 : KPIs Visites
    ═══════════════════════════════════════════════════ --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 h-100 text-center position-relative overflow-hidden">
                <div style="position:absolute;top:-10px;right:-10px;font-size:3.5rem;opacity:.06;pointer-events:none;">👁</div>
                <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--adm-text-muted);" class="mb-1">Aujourd'hui</div>
                <div class="metric-value text-primary">{{ number_format($todayVisits) }}</div>
                <div style="font-size:.72rem;color:var(--adm-text-muted);">{{ $todayUnique }} unique{{ $todayUnique > 1 ? 's' : '' }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 h-100 text-center position-relative overflow-hidden">
                <div style="position:absolute;top:-10px;right:-10px;font-size:3.5rem;opacity:.06;pointer-events:none;">📅</div>
                <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--adm-text-muted);" class="mb-1">Cette semaine</div>
                <div class="metric-value" style="color:var(--adm-text);">{{ number_format($weekVisits) }}</div>
                <div style="font-size:.72rem;color:var(--adm-text-muted);">vues</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 h-100 text-center position-relative overflow-hidden">
                <div style="position:absolute;top:-10px;right:-10px;font-size:3.5rem;opacity:.06;pointer-events:none;">🗓</div>
                <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--adm-text-muted);" class="mb-1">Ce mois</div>
                <div class="metric-value text-success">{{ number_format($monthVisits) }}</div>
                <div style="font-size:.72rem;color:var(--adm-text-muted);">vues</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 h-100 text-center position-relative overflow-hidden">
                <div style="position:absolute;top:-10px;right:-10px;font-size:3.5rem;opacity:.06;pointer-events:none;">🌐</div>
                <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--adm-text-muted);" class="mb-1">Total</div>
                <div class="metric-value text-warning">{{ number_format($allTimeViews) }}</div>
                <div style="font-size:.72rem;color:var(--adm-text-muted);">{{ number_format($allTimeUnique) }} visiteurs uniques</div>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════
         ROW 2 : Graphe visites 30 jours + Modules
    ═══════════════════════════════════════════════════ --}}
    <div class="row g-3 mb-3">
        {{-- Graphe ligne --}}
        <div class="col-12 col-xl-8">
            <div class="admin-card p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h3 class="h6 fw-bold mb-0" style="color:var(--adm-text);">Visites — 30 derniers jours</h3>
                        <span style="font-size:.75rem;color:var(--adm-text-muted);">Vues totales &amp; visiteurs uniques</span>
                    </div>
                    <span class="badge" style="background:var(--adm-link-hover);color:var(--adm-accent);font-size:.7rem;">Temps réel</span>
                </div>
                <div style="position:relative;height:220px;">
                    <canvas id="visitsChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Modules --}}
        <div class="col-12 col-xl-4">
            <div class="admin-card p-4 h-100">
                <h3 class="h6 fw-bold mb-3" style="color:var(--adm-text);">Contenu du portfolio</h3>
                <div style="position:relative;height:220px;">
                    <canvas id="contentChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════
         ROW 3 : Compteurs modules détaillés
    ═══════════════════════════════════════════════════ --}}
    <div class="row g-3 mb-3">
        @php
        $modules = [
            ['label' => 'Projets',       'count' => $counts['projects'],     'icon' => '💼', 'route' => 'admin.projects.index',     'color' => '#3b82f6'],
            ['label' => 'Compétences',   'count' => $counts['skills'],       'icon' => '🎯', 'route' => 'admin.competences.index',  'color' => '#8b5cf6'],
            ['label' => 'Services',      'count' => $counts['services'],     'icon' => '🛠️', 'route' => 'admin.services.index',     'color' => '#06b6d4'],
            ['label' => 'Technologies',  'count' => $counts['technologies'], 'icon' => '💡', 'route' => 'admin.technologies.index', 'color' => '#f59e0b'],
            ['label' => 'Ressources',    'count' => $counts['resources'],    'icon' => '📚', 'route' => 'admin.learning-resources.index', 'color' => '#0d9488'],
            ['label' => 'Expériences',   'count' => $counts['experiences'],  'icon' => '📅', 'route' => 'admin.experiences.index',  'color' => '#10b981'],
            ['label' => 'Formations',    'count' => $counts['educations'],   'icon' => '🎓', 'route' => 'admin.educations.index',   'color' => '#14b8a6'],
            ['label' => 'Témoignages',   'count' => $counts['testimonials'], 'icon' => '⭐', 'route' => 'admin.testimonials.index', 'color' => '#f43f5e'],
            ['label' => 'FAQ',           'count' => $counts['faqs'],         'icon' => '❓', 'route' => 'admin.faqs.index',         'color' => '#64748b'],
        ];
        @endphp
        @foreach($modules as $mod)
        <div class="col-6 col-md-3 col-xl-3">
            <a href="{{ route($mod['route']) }}" class="admin-card p-3 d-flex align-items-center gap-3 text-decoration-none" style="transition:transform .15s;">
                <div style="width:42px;height:42px;border-radius:12px;background:{{ $mod['color'] }}18;display:flex;align-items:center;justify-content:center;font-size:1.15rem;flex-shrink:0;">{{ $mod['icon'] }}</div>
                <div>
                    <div class="metric-value" style="font-size:1.4rem;color:{{ $mod['color'] }};">{{ $mod['count'] }}</div>
                    <div style="font-size:.72rem;color:var(--adm-text-muted);font-weight:600;">{{ $mod['label'] }}</div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{-- ════════════════════════════════════════════════
         ROW 4 : Messages + Messages non lus
    ═══════════════════════════════════════════════════ --}}
    <div class="row g-3">
        <div class="col-12 col-md-6">
            <div class="admin-card p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3 class="h6 fw-bold mb-0" style="color:var(--adm-text);">✉️ Messages récents</h3>
                    <div class="d-flex align-items-center gap-2">
                        @if($counts['unread'] > 0)
                            <span class="badge bg-danger">{{ $counts['unread'] }} non lu{{ $counts['unread'] > 1 ? 's' : '' }}</span>
                        @endif
                        <a href="{{ route('admin.messages.index') }}" style="font-size:.75rem;color:var(--adm-accent);">Tout voir →</a>
                    </div>
                </div>
                @forelse($recentContacts as $c)
                    <a href="{{ route('admin.messages.show', $c) }}" class="d-flex align-items-start gap-3 p-2 rounded mb-1 text-decoration-none" style="background:var(--adm-table-hover);transition:background .12s;">
                        <div style="width:32px;height:32px;border-radius:50%;background:var(--adm-active-bg);display:flex;align-items:center;justify-content:center;font-size:.75rem;color:#fff;font-weight:700;flex-shrink:0;">
                            {{ strtoupper(substr($c->name, 0, 1)) }}
                        </div>
                        <div style="min-width:0;flex:1;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-semibold" style="font-size:.82rem;color:var(--adm-text);">{{ $c->name }}</span>
                                @if(!$c->is_read)<span style="width:7px;height:7px;border-radius:50%;background:#ef4444;display:inline-block;flex-shrink:0;"></span>@endif
                            </div>
                            <div style="font-size:.75rem;color:var(--adm-text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $c->subject }}</div>
                            <div style="font-size:.7rem;color:var(--adm-text-label);">{{ optional($c->sent_at)->diffForHumans() }}</div>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-4" style="color:var(--adm-text-muted);font-size:.85rem;">Aucun message reçu</div>
                @endforelse
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="admin-card p-4 h-100">
                <h3 class="h6 fw-bold mb-3" style="color:var(--adm-text);">⚡ Actions rapides</h3>
                <div class="row g-2">
                    <div class="col-6"><a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary btn-sm w-100">+ Projet</a></div>
                    <div class="col-6"><a href="{{ route('admin.competences.create') }}" class="btn btn-outline-primary btn-sm w-100">+ Compétence</a></div>
                    <div class="col-6"><a href="{{ route('admin.services.create') }}" class="btn btn-outline-primary btn-sm w-100">+ Service</a></div>
                    <div class="col-6"><a href="{{ route('admin.technologies.create') }}" class="btn btn-outline-primary btn-sm w-100">+ Technologie</a></div>
                    <div class="col-6"><a href="{{ route('admin.learning-resources.create') }}" class="btn btn-outline-primary btn-sm w-100">+ Ressource</a></div>
                    <div class="col-6"><a href="{{ route('admin.experiences.create') }}" class="btn btn-outline-primary btn-sm w-100">+ Expérience</a></div>
                    <div class="col-6"><a href="{{ route('admin.educations.create') }}" class="btn btn-outline-primary btn-sm w-100">+ Formation</a></div>
                    <div class="col-6"><a href="{{ route('admin.testimonials.create') }}" class="btn btn-outline-primary btn-sm w-100">+ Témoignage</a></div>
                    <div class="col-6"><a href="{{ route('admin.faqs.create') }}" class="btn btn-outline-primary btn-sm w-100">+ FAQ</a></div>
                </div>

                <hr style="border-color:var(--adm-divider);margin:1rem 0;">

                <h3 class="h6 fw-bold mb-2" style="color:var(--adm-text);">📊 Résumé</h3>
                <div class="d-flex justify-content-between" style="font-size:.82rem;color:var(--adm-text-muted);">
                    <span>Messages totaux</span><span class="fw-semibold" style="color:var(--adm-text);">{{ $counts['messages'] }}</span>
                </div>
                <div class="d-flex justify-content-between mt-1" style="font-size:.82rem;color:var(--adm-text-muted);">
                    <span>Articles de blog</span><span class="fw-semibold" style="color:var(--adm-text);">{{ $counts['articles'] }}</span>
                </div>
                <div class="d-flex justify-content-between mt-1" style="font-size:.82rem;color:var(--adm-text-muted);">
                    <span>Visiteurs uniques (total)</span><span class="fw-semibold" style="color:var(--adm-text);">{{ number_format($allTimeUnique) }}</span>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
(function() {
    const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const gridColor   = isDark ? 'rgba(99,130,246,.1)'  : 'rgba(0,0,0,.06)';
    const textColor   = isDark ? '#94a3b8' : '#64748b';
    const tooltipBg   = isDark ? '#0d1a30' : '#ffffff';
    const tooltipText = isDark ? '#e2e8f0' : '#1e293b';

    Chart.defaults.color = textColor;
    Chart.defaults.font.family = 'Figtree, sans-serif';
    Chart.defaults.font.size   = 11;

    // ── Graphe visites ────────────────────────────────────────────────────
    const labels = @json($chartLabels);
    const views  = @json($chartViews);
    const unique = @json($chartUnique);

    new Chart(document.getElementById('visitsChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Vues totales',
                    data: views,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,.12)',
                    borderWidth: 2,
                    tension: .4,
                    fill: true,
                    pointRadius: 0,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: '#3b82f6',
                },
                {
                    label: 'Visiteurs uniques',
                    data: unique,
                    borderColor: '#8b5cf6',
                    backgroundColor: 'rgba(139,92,246,.08)',
                    borderWidth: 2,
                    tension: .4,
                    fill: true,
                    pointRadius: 0,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: '#8b5cf6',
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: true, position: 'top', labels: { boxWidth: 10, padding: 12 } },
                tooltip: {
                    backgroundColor: tooltipBg,
                    titleColor: tooltipText,
                    bodyColor: tooltipText,
                    borderColor: gridColor,
                    borderWidth: 1,
                    padding: 10,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: { grid: { color: gridColor }, ticks: { maxTicksLimit: 8 } },
                y: { grid: { color: gridColor }, beginAtZero: true, ticks: { precision: 0 } }
            }
        }
    });

    // ── Graphe contenu (doughnut) ─────────────────────────────────────────
    new Chart(document.getElementById('contentChart'), {
        type: 'doughnut',
        data: {
            labels: ['Projets', 'Compétences', 'Services', 'Technologies', 'Ressources', 'Expériences', 'Formations'],
            datasets: [{
                data: [
                    {{ $counts['projects'] }},
                    {{ $counts['skills'] }},
                    {{ $counts['services'] }},
                    {{ $counts['technologies'] }},
                    {{ $counts['resources'] }},
                    {{ $counts['experiences'] }},
                    {{ $counts['educations'] }}
                ],
                backgroundColor: ['#3b82f6','#8b5cf6','#06b6d4','#f59e0b','#0d9488','#10b981','#14b8a6'],
                borderWidth: 0,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'right',
                    labels: { boxWidth: 10, padding: 8, font: { size: 11 } }
                },
                tooltip: {
                    backgroundColor: tooltipBg,
                    titleColor: tooltipText,
                    bodyColor: tooltipText,
                    borderColor: gridColor,
                    borderWidth: 1,
                    cornerRadius: 8,
                }
            }
        }
    });
})();
</script>
@endpush
</x-app-layout>

