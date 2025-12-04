<div class="p-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="h3 mb-0">Tour Packages</h2>
        <a href="{{ route('admin.tour.package.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 5v14" />
                <path d="M5 12h14" />
            </svg>
            Add Package
        </a>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 text-green-600">{{ session('message') }}</div>
    @endif

    <div class="mb-3">
        <input type="text" wire:model.debounce.live.300ms="search" placeholder="Search..." class="form-control" />
    </div>

    <div class="mb-3 d-flex gap-2">
        <div style="min-width:180px">
            <select class="form-select" wire:model.live="filter_status">
                <option value="all">Status: All</option>
                <option value="active">Status: Active</option>
                <option value="hidden">Status: Hidden</option>
            </select>
        </div>

        <div style="min-width:200px">
            <select class="form-select" wire:model.live="filter_featured">
                <option value="all">Featured: All</option>
                <option value="featured">Only Featured</option>
                <option value="not_featured">Not Featured</option>
            </select>
        </div>

        <div class="ms-auto">
            <select class="form-select" wire:model.live="perPage">
                <option value="5">5 / page</option>
                <option value="10">10 / page</option>
                <option value="25">25 / page</option>
            </select>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width:90px">Image</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th class="text-end">Price</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $p)
                    <tr>
                        <td>
                            <div style="width:84px;height:56px;overflow:hidden;border-radius:6px;background:#f8f9fa;display:flex;align-items:center;justify-content:center">
                                @if(!empty($p->featured_image))
                                    <img src="{{ $p->featured_image }}" alt="thumb" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <span class="text-muted small">No image</span>
                                @endif
                            </div>
                        </td>

                        <td>
                            <div class="fw-bold">{{ $p->title }}</div>
                            <div class="small text-muted">ID: {{ $p->id }} • {{ $p->created_at ? $p->created_at->format('Y-m-d') : '' }}</div>
                        </td>

                        <td class="small text-muted">{{ $p->slug }}</td>

                        <td class="text-end fw-semibold">{{ $p->price ? '₹' . number_format($p->price,2) : '—' }}</td>

                        <td>
                            <span class="badge bg-{{ $p->status ? 'success-lt' : 'secondary-lt' }}">{{ $p->status ? 'Active' : 'Hidden' }}</span>
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.tour.package.edit', $p->id) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                            <button wire:click="delete({{ $p->id }})" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this package?')">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No packages found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $packages->links() }}</div>
</div>
