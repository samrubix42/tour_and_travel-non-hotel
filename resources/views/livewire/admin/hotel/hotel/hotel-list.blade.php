
<div>
    <div class="container mt-4">
        <div class="category-panel mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h1 class="h1 mb-0">Hotels</h1>
                    <p class="text-muted mb-0 small">Manage hotels — add, edit, and toggle status.</p>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.hotel.create') }}" class="btn btn-primary btn-md">Add Hotel</a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 d-flex gap-2">
                    <input wire:model.debounce.live.300ms="search" type="text" class="form-control" placeholder="Search hotels...">
                    <select wire:model="perPage" class="form-select" style="width:70px;">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                </div>
            </div>

            @if(session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Destination</th>
                                <th class="text-center">Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hotels as $hotel)
                            <tr>
                                <td><img src="{{ $hotel->image_url ?? 'http://via.placeholder.com/100x60' }}" alt="{{ $hotel->name }}" style="width: 100px; max-height: 60px; object-fit: cover;"></td>
                                <td>{{ $hotel->name }}</td>
                                <td>{{ $hotel->category?->name }}</td>
                                <td>{{ $hotel->destination?->name }}</td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $hotel->status ? 'success-lt' : 'secondary-lt' }}">{{ $hotel->status ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.hotel.edit', $hotel->id) }}" class="btn btn-sm btn-outline-secondary ms-1">Edit</a>
                                    <button wire:click="confirmDelete({{ $hotel->id }})" class="btn btn-sm btn-outline-danger ms-1">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No hotels found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing {{ $hotels->firstItem() ?? 0 }} to {{ $hotels->lastItem() ?? 0 }} of {{ $hotels->total() }} entries</p>
                    <ul class="pagination m-0 ms-auto">
                        {{ $hotels->links() }}
                    </ul>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div wire:ignore.self class="modal modal-blur fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center py-4">
                            <h3 class="mb-1">Confirm Delete</h3>
                            <p class="text-muted">Are you sure you want to delete this hotel?</p>
                            <div class="mt-3">
                                <button type="button" wire:click="$dispatch('closeDeleteModal')" class="btn btn-link link-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" wire:click="deleteHotel" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var deleteModalEl = document.getElementById('confirmDeleteModal');
                    if (!deleteModalEl) return;
                    var deleteModal = new bootstrap.Modal(deleteModalEl);
                    Livewire.on('openDeleteModal', function () {
                        deleteModal.show();
                    });
                    Livewire.on('closeDeleteModal', function () {
                        deleteModal.hide();
                    });
                });
            </script>
        </div>
    </div>
</div>