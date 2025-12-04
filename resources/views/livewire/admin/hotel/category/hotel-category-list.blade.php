<div>
    <div class="container mt-3">
        <div class="panel mx-auto hotel-category-panel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="h1 mb-0">Hotel Categories</h3>
                    <p class="text-muted mb-0 small">Manage hotel categories — create, edit, search and paginate.</p>
                </div>
                <div class="text-end">
                    <button wire:click="create" class="btn btn-primary btn-sm">New Category</button>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <div class="col-md-6 d-flex">
                    <div class="d-flex col-8 gap-1">
                        <input wire:model.debounce.live.300ms="search" type="text" class="form-control" placeholder="Search categories...">
                        <select wire:model="perPage" class="form-select" style="width:70px;">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>
            </div>

            @if(session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th class="text-center" style="width:120px">Status</th>
                                <th class="text-end" style="width:150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $c)
                                <tr>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->slug }}</td>
                                    <td class="text-center">
                                        <label class="form-check form-switch d-inline-block" for="statusSwitch{{ $c->id }}">
                                            <input class="form-check-input" type="checkbox" id="statusSwitch{{ $c->id }}" wire:click="toggleStatus({{ $c->id }})" @if($c->status) checked @endif wire:loading.attr="disabled">
                                            <span class="form-check-label"></span>
                                        </label>
                                    </td>
                                    <td class="text-end">
                                        <button wire:click="edit({{ $c->id }})" class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                        <button wire:click="confirmDelete({{ $c->id }})" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} entries</p>
                    <div class="ms-auto">{{ $categories->links() }}</div>
                </div>
            </div>

            {{-- Modal --}}
            @if($showModal)
                <div class="modal fade show d-block" tabindex="-1" role="dialog" style="display:block; background: rgba(0,0,0,0.45);">
                    <div class="modal-dialog" role="document" style="z-index:1060; margin-top:5vh;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $hotelCategoryId ? 'Edit Category' : 'New Category' }}</h5>
                                <button type="button" class="btn-close" aria-label="Close" wire:click="closeModal"></button>
                            </div>
                            <form wire:submit.prevent="save">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror">
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <input wire:model.defer="slug" type="text" class="form-control @error('slug') is-invalid @enderror">
                                        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea wire:model.defer="description" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input wire:model="status" value="1" class="form-check-input" type="checkbox" id="isActive" @if($status) checked @endif>
                                        <label class="form-check-label" for="isActive">Active</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link link-secondary" wire:click="closeModal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Delete confirm --}}
            @if($showDeleteModal)
                <div class="modal fade show d-block" tabindex="-1" role="dialog" style="display:block; background: rgba(0,0,0,0.45);">
                    <div class="modal-dialog" role="document" style="z-index:1060; margin-top:20vh;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Deletion</h5>
                                <button type="button" class="btn-close" aria-label="Close" wire:click="cancelDelete"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this hotel category?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link link-secondary" wire:click="cancelDelete">Cancel</button>
                                <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>


</div>
