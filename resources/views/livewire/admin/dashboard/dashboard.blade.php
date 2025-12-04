<div>
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
        @php
            $badgeClasses = ['bg-primary','bg-success','bg-warning','bg-info','bg-danger','bg-secondary','bg-indigo','bg-pink','bg-teal'];
        @endphp
        @foreach($counts as $key => $value)
            <div class="col-12 col-sm-6 col-lg-2">
                <div class="card p-3 shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            @php $color = $badgeClasses[$loop->index % count($badgeClasses)]; @endphp
                            <span class="{{ $color }} text-white rounded p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7v10a2 2 0 0 0 2 2h14"></path><path d="M7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2"></path></svg>
                            </span>
                        </div>
                        <div>
                            <div class="text-muted small">{{ $labels[$key] ?? ucwords(str_replace('_',' ',$key)) }}</div>
                            <div class="h4 m-0">{{ $value ?? 0 }}</div>
                            <div class="small text-muted mt-1">Quick overview</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">Activity (Last 6 months)</div>
                <div class="card-body">
                    <canvas id="contentChart" height="120"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">Top Stats</div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="small text-muted">Total Hotels</div>
                            <div class="fw-bold">{{ $counts['hotels'] ?? 0 }}</div>
                        </div>
                        <div class="progress mt-2" style="height:6px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ min(100, ($counts['hotels'] / max(1, array_sum($counts)))*100) }}%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="small text-muted">Total Tours</div>
                            <div class="fw-bold">{{ $counts['tour_packages'] ?? 0 }}</div>
                        </div>
                        <div class="progress mt-2" style="height:6px">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ min(100, ($counts['tour_packages'] / max(1, array_sum($counts)))*100) }}%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between">
                            <div class="small text-muted">Total Posts</div>
                            <div class="fw-bold">{{ $counts['posts'] ?? 0 }}</div>
                        </div>
                        <div class="progress mt-2" style="height:6px">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ min(100, ($counts['posts'] / max(1, array_sum($counts)))*100) }}%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">Recent Hotel Contacts</div>
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
                            @forelse($recentHotelContacts as $c)
                                <tr>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->email ?? '-' }}</td>
                                    <td>{{ $c->phone ?? '-' }}</td>
                                    <td class="text-muted">{{ $c->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-muted small">No recent hotel contacts</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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
                                    <td>{{ $c->name }}</td>
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

    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">Recent Hotels</div>
                <div class="card-body p-0">
                    <table class="table card-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>When</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentHotels as $h)
                                <tr>
                                    <td>{{ $h->name ?? ($h->title ?? '-') }}</td>
                                    <td>{{ $h->category?->name ?? '-' }}</td>
                                    <td class="text-muted">{{ $h->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-muted small">No recent hotels</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">Recent Tour Packages</div>
                <div class="card-body p-0">
                    <table class="table card-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th>When</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTours as $t)
                                <tr>
                                    <td>{{ $t->name ?? ($t->title ?? '-') }}</td>
                                    <td>{{ $t->price ?? '-' }}</td>
                                    <td class="text-muted">{{ $t->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-muted small">No recent tour packages</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">Recent Destinations</div>
                <div class="card-body p-0">
                    <table class="table card-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Region</th>
                                <th>When</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentDestinations as $d)
                                <tr>
                                    <td>{{ $d->name ?? ($d->title ?? '-') }}</td>
                                    <td>{{ $d->region ?? '-' }}</td>
                                    <td class="text-muted">{{ $d->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-muted small">No recent destinations</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">Recent Posts</div>
                <div class="card-body p-0">
                    <table class="table card-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>When</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPosts as $p)
                                <tr>
                                    <td>{{ $p->title ?? $p->name ?? '-' }}</td>
                                    <td>{{ $p->author?->name ?? $p->user?->name ?? '-' }}</td>
                                    <td class="text-muted">{{ $p->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-muted small">No recent posts</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
