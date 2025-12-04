<div>

    <!-- Header -->
    <div class="card mb-4 shadow-sm border-0 rounded-3">
            <div class="card-body d-flex justify-content-between align-items-center">
            <h2 class="page-title m-0 fw-bold">Page Management</h2>
            <a href="{{ route('admin.page.create') }}" class="btn btn-primary btn-md">
                <i class="ti ti-plus"></i> Add Page
            </a>
        </div>
    </div>

    <!-- Search -->
    <div class="card shadow-sm border-0 rounded-3 mb-3 p-3">
        <div class="input-icon">
            <span class="input-icon-addon"><i class="ti ti-search"></i></span>
            <input type="text" class="form-control" wire:model.debounce.live.300ms="search" placeholder="Search pages...">
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="table-responsive p-2">
            <table class="table table-vcenter table-hover">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Page Title</th>
                        <th>Slug</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td>{{ $page->id }}</td>
                            <td class="fw-semibold">{{ $page->page_title }}</td>
                            <td><span class="badge bg-blue-lt">{{ $page->slug }}</span></td>
                            <td class="text-end">
                                <a class="btn btn-warning btn-sm" href="{{ route('admin.page.edit', $page->id) }}"><i class="ti ti-edit"></i></a>
                                <button class="btn btn-danger btn-sm" wire:click="confirmDelete({{ $page->id }})"><i class="ti ti-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No pages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="my-3">{{ $pages->links() }}</div>

    {{-- Tabler-style confirmation modal --}}
    @if($confirmingDelete)
        <div class="modal modal-blur fade show d-block" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 9v2m0 4v.01"></path>
                            <path d="M10 3h4l1 6h-6z"></path>
                            <path d="M5 6l1 14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-14"></path>
                        </svg>
                        <h3 class="modal-title">Are you sure?</h3>
                        <div class="text-muted">This action will permanently delete the page.</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100 d-flex justify-content-center gap-2">
                            <button class="btn btn-link" wire:click="cancelDelete">Cancel</button>
                            <button class="btn btn-danger" wire:click="performDelete">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
