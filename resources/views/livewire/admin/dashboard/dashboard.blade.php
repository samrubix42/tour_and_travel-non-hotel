<div>
    <style>
        .dash-quick-link { transition: all .18s ease; border: 1px solid var(--tblr-border-color); }
        .dash-quick-link:hover { transform: translateY(-2px); box-shadow: 0 .5rem 1rem rgba(32, 38, 45, .08); }
        .dash-stat-icon { width: 40px; height: 40px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; }
        .dash-section-title { font-size: .8rem; letter-spacing: .04em; text-transform: uppercase; color: var(--tblr-muted); font-weight: 700; }
    </style>

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Admin Dashboard</h3>
            <div class="text-muted small">Overview of your site's content and activity</div>
        </div>
        <div class="text-end">
            <div class="small text-muted">Welcome back, Admin</div>
            <div class="h5 m-0">Updated: {{ now()->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <a href="{{ route('admin.blog.post.create') }}" class="card card-link dash-quick-link text-decoration-none">
                <div class="card-body d-flex align-items-center">
                    <span class="avatar avatar-sm bg-primary-lt me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 5h16" />
                            <path d="M4 12h16" />
                            <path d="M4 19h10" />
                            <path d="M18 18v3" />
                            <path d="M16.5 19.5h3" />
                        </svg>
                    </span>
                    <div class="flex-fill">
                        <div class="fw-semibold text-dark">Add Blog</div>
                        <div class="text-muted small">Create a new post</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-4">
            <a href="{{ route('admin.tour.package.create') }}" class="card card-link dash-quick-link text-decoration-none">
                <div class="card-body d-flex align-items-center">
                    <span class="avatar avatar-sm bg-success-lt me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 3l7 4v5c0 5 -3.5 9 -7 9s-7 -4 -7 -9v-5l7 -4z" />
                            <path d="M9 12l2 2l4 -4" />
                        </svg>
                    </span>
                    <div class="flex-fill">
                        <div class="fw-semibold text-dark">Add Tour</div>
                        <div class="text-muted small">Create tour package</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-4">
            <a href="{{ route('admin.tour.destination.list') }}" class="card card-link dash-quick-link text-decoration-none">
                <div class="card-body d-flex align-items-center">
                    <span class="avatar avatar-sm bg-info-lt me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 21s-6 -4.35 -6 -10a6 6 0 1 1 12 0c0 5.65 -6 10 -6 10z" />
                            <circle cx="12" cy="11" r="2" />
                        </svg>
                    </span>
                    <div class="flex-fill">
                        <div class="fw-semibold text-dark">Add Destination</div>
                        <div class="text-muted small">Manage destinations</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="dash-section-title mb-2">Snapshot</div>
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body d-flex align-items-center">
                    <span class="dash-stat-icon bg-success-lt text-success me-3">
                        <i class="ti ti-route-2"></i>
                    </span>
                    <div>
                        <div class="text-muted small">Tour Packages</div>
                        <div class="h2 m-0">{{ $counts['tour_packages'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body d-flex align-items-center">
                    <span class="dash-stat-icon bg-primary-lt text-primary me-3">
                        <i class="ti ti-news"></i>
                    </span>
                    <div>
                        <div class="text-muted small">Posts</div>
                        <div class="h2 m-0">{{ $counts['posts'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body d-flex align-items-center">
                    <span class="dash-stat-icon bg-info-lt text-info me-3">
                        <i class="ti ti-map-pin"></i>
                    </span>
                    <div>
                        <div class="text-muted small">Destinations</div>
                        <div class="h2 m-0">{{ $counts['destinations'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body d-flex align-items-center">
                    <span class="dash-stat-icon bg-warning-lt text-warning me-3">
                        <i class="ti ti-phone-call"></i>
                    </span>
                    <div>
                        <div class="text-muted small">Tour Enquiries</div>
                        <div class="h2 m-0">{{ $counts['tour_contacts'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dash-section-title mb-2">Activity</div>
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Activity (Last 6 months)</div>
                <div class="card-body">
                    <canvas id="contentChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="dash-section-title mb-2">Recent Updates</div>
    <div class="row g-3">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">Recent Tour Contacts</div>
                <div class="card-body p-0">
                    <table class="table card-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>When</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTourContacts as $c)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-xs me-2">{{ strtoupper(substr($c->name ?? 'A',0,1)) }}</span>
                                            <span>{{ $c->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $c->email ?? '-' }}</td>
                                    <td>{{ $c->phone ?? '-' }}</td>
                                    <td class="text-muted">{{ $c->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-muted small">No recent tour contacts</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">Recent Content</div>
                <div class="card-body p-0">
                    <table class="table card-table">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Title</th>
                                <th>When</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTours as $t)
                                <tr>
                                    <td><span class="badge bg-success-lt">Tour</span></td>
                                    <td>{{ $t->name ?? ($t->title ?? '-') }}</td>
                                    <td class="text-muted">{{ $t->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-muted small">No recent tours</td></tr>
                            @endforelse
                            @forelse($recentDestinations->take(3) as $d)
                                <tr>
                                    <td><span class="badge bg-info-lt">Destination</span></td>
                                    <td>{{ $d->name ?? ($d->title ?? '-') }}</td>
                                    <td class="text-muted">{{ $d->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                            @endforelse
                            @forelse($recentPosts->take(3) as $p)
                                <tr>
                                    <td><span class="badge bg-primary-lt">Post</span></td>
                                    <td>{{ $p->title ?? $p->name ?? '-' }}</td>
                                    <td class="text-muted">{{ $p->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function(){
            const labels = @json($chartLabels ?? []);
            const datasets = @json($chartDatasets ?? []);
            if (!document.getElementById('contentChart')) return;
            const ctx = document.getElementById('contentChart').getContext('2d');
            const chartDatasets = datasets.map(ds => ({
                label: ds.label,
                data: ds.data,
                borderColor: ds.borderColor,
                backgroundColor: ds.backgroundColor,
                fill: true,
                tension: ds.tension ?? 0.3,
                pointRadius: 3,
            }));

            new Chart(ctx, {
                type: 'line',
                data: { labels: labels, datasets: chartDatasets },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'top' } },
                    scales: { y: { beginAtZero: true, ticks: { precision:0 } } }
                }
            });
        })();
    </script>

</div>
