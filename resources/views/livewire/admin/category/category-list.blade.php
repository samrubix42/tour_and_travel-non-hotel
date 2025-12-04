<div>
    <div class="container mt-4">
        <div class="category-panel mx-auto">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h1 class="h1 mb-0">Categories</h1>
                    <p class="text-muted mb-0 small">Manage categories — add, edit, upload images and toggle status.</p>
                </div>
                <div class="text-end">
                    <button wire:click="create" class="btn btn-primary btn-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        &nbsp;New Category
                    </button>
                </div>
            </div>

            <!-- Search & perPage -->
            <div class="row mb-3">
                <div class="col-md-6 d-flex gap-2">
                    <input wire:model.debounce.live.300ms="search" type="text" class="form-control" placeholder="Search categories...">
                    <select wire:model.live="perPage" class="form-select" style="width:70px;">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                </div>
            </div>

            <!-- Flash Message -->
            @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif


            <!-- Table -->
            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th class="text-center">Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <!-- Image column -->
                                <td>
                                    @if(\Illuminate\Support\Str::startsWith($category->category_image, ['http://','https://']))
                                    <img src="{{ $category->category_image }}" alt="Category" class="img-thumbnail" style="height:50px; width:50px; object-fit:cover;">
                                    @elseif(!$category->storage_path && !$category->category_image)
                                    <div class="bg-secondary rounded" style="height:50px; width:50px;"></div>
                                    @else
                                    <img src="{{ asset('storage/' . $category->storage_path) }}" alt="Category" class="img-thumbnail" style="height:50px; width:50px; object-fit:cover;">
                                    @endif

                                </td>

                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>

                                <!-- Status toggle switch -->
                                <td class="text-center">
                                    <div class="form-check form-switch d-inline-block">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            id="statusSwitch{{ $category->id }}"
                                            wire:click="toggleActive({{ $category->id }})"
                                            @if($category->status) checked @endif
                                        wire:loading.attr="disabled">
                                        <label class="form-check-label" for="statusSwitch{{ $category->id }}"></label>
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="text-end">
                                    <button wire:click="edit({{ $category->id }})" class="btn btn-sm btn-outline-primary">Edit</button>
                                    <button wire:click="confirmDelete({{ $category->id }})" class="btn btn-sm btn-outline-danger">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No categories found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} entries</p>
                    <ul class="pagination m-0 ms-auto">
                        {{ $categories->links() }}
                    </ul>
                </div>
            </div>



            <!-- Modal: Create/Edit -->
            @if($showModal)
            <div class="modal fade show d-block" style="background: rgba(0,0,0,0.45);">
                <div class="modal-dialog modal-lg" style="margin-top:5vh; z-index:1060;">
                    <div class="modal-content shadow-sm">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $categoryId ? 'Edit Category' : 'New Category' }}</h5>
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

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea wire:model.defer="description" class="form-control" rows="3"></textarea>
                                </div>

                                <div class="form-check mb-3">
                                    <input wire:model.defer="status" class="form-check-input" type="checkbox" id="isActive">
                                    <label class="form-check-label" for="isActive">Active</label>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Image (optional)</label>
                                    <input wire:model="imageFile" type="file" class="form-control @error('imageFile') is-invalid @enderror">
                                    @error('imageFile') <div class="invalid-feedback">{{ $message }}</div> @enderror

                                    <div wire:loading wire:target="imageFile" class="mt-2 small text-muted">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Uploading image...
                                    </div>

                                    @if ($imageFile)
                                    <div class="mt-2">
                                        <img src="{{ $imageFile->temporaryUrl() }}" alt="Preview" class="img-thumbnail" style="max-height:150px;">
                                    </div>
                                    @elseif ($category_image)
                                    <div class="mt-2">
                                        @if(\Illuminate\Support\Str::startsWith($category_image, ['http://','https://']))
                                        <img src="{{ $category_image }}" alt="Current" class="img-thumbnail" style="max-height:150px;">
                                        @else
                                        <img src="{{ asset('storage/' . $category_image) }}" alt="Current" class="img-thumbnail" style="max-height:150px;">
                                        @endif
                                    </div>
                                    @endif
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
                            <p>Are you sure you want to delete this category? This action cannot be undone.</p>
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
    </div>
</div>