
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <div>
                <h3 class="h4 mb-0">Experiences</h3>
                <p class="text-muted mb-0 small">Manage experiences — add, edit, search, and delete.</p>
            </div>
            <button wire:click="create" class="btn btn-primary btn-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                &nbsp;New Experience
            </button>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 d-flex gap-2">
                    <input wire:model.debounce.live.300ms="search" type="text" class="form-control" placeholder="Search experiences...">
                    <select wire:model.live="perPage" class="form-select" style="width:70px;">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                </div>
            </div>

            @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle text-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th class="text-center">Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($experiences as $experience)
                        <tr>
                            <td>
                                @if($experience->image)
                                <img src="{{ $experience->image }}" alt="{{ $experience->name }}" class="rounded" style="width:56px;height:56px;object-fit:cover;">
                                @else
                                <div class="bg-light rounded d-inline-block" style="width:56px;height:56px;"></div>
                                @endif
                            </td>
                            <td>{{ $experience->name }}</td>
                            <td>{{ $experience->slug }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $experience->status ? 'success-lt' : 'secondary-lt' }}">{{ $experience->status ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td class="text-end">
                                <button wire:click="edit({{ $experience->id }})" class="btn btn-sm btn-outline-primary">Edit</button>
                                <button wire:click="confirmDelete({{ $experience->id }})" class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No experiences found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-muted">Showing {{ $experiences->firstItem() ?? 0 }} to {{ $experiences->lastItem() ?? 0 }} of {{ $experiences->total() }} entries</p>
            <ul class="pagination m-0 ms-auto">
                {{ $experiences->links() }}
            </ul>
        </div>
    </div>

    <!-- Modal: Create/Edit -->
    @if($showModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.45);">
        <div class="modal-dialog" style="margin-top:5vh; z-index:1060;">
            <div class="modal-content shadow-sm">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $experienceId ? 'Edit Experience' : 'New Experience' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input wire:model.live="name" type="text" class="form-control @error('name') is-invalid @enderror">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input wire:model.defer="slug" type="text" class="form-control @error('slug') is-invalid @enderror">
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-check mb-3">
                            <input wire:model.defer="status" class="form-check-input" type="checkbox" id="isActive">
                            <label class="form-check-label" for="isActive">Active</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" wire:model="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="mt-2">
                                @if (isset($image) && $image)
                                    <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="rounded" style="width:120px;height:120px;object-fit:cover;">
                                @elseif(!empty($currentImageUrl))
                                    <img src="{{ $currentImageUrl }}" alt="Current Image" class="rounded" style="width:120px;height:120px;object-fit:cover;">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="save">Save</span>
                            <span wire:loading wire:target="save">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                &nbsp;Saving...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Delete Modal -->
    @if($showDeleteModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.45);">
        <div class="modal-dialog" style="margin-top:20vh; z-index:1060;">
            <div class="modal-content shadow-sm">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" wire:click="cancelDelete"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this experience? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cancelDelete">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
