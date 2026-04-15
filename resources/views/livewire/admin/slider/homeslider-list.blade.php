<div
    class="container py-4"
    x-data="{ previewUrl: null }"
    x-on:slider-uploaded.window="previewUrl = null; if ($refs.fileInput) { $refs.fileInput.value = ''; }">

    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div>
                <h3 class="card-title mb-0">Home Slider Manager</h3>
                <p class="text-secondary mb-0">Upload and manage homepage slider images.</p>
            </div>
            <span class="badge bg-primary-lt text-primary">Max 4MB</span>
        </div>

        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <label class="form-label">Select Image</label>
                        <input
                            x-ref="fileInput"
                            type="file"
                            class="form-control"
                            wire:model.live="image"
                            accept="image/*"
                            @change="const file = $event.target.files[0]; previewUrl = file ? URL.createObjectURL(file) : null">
                        <small class="form-hint">Allowed formats: JPG, PNG, WEBP</small>
                        @error('image')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="image,save">
                                <span wire:loading.remove wire:target="image,save">Upload Slider</span>
                                <span
                                    class="d-none align-items-center gap-2"
                                    wire:loading.class.remove="d-none"
                                    wire:loading.class.add="d-inline-flex"
                                    wire:target="image,save">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Saving...
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card bg-light border h-100">
                            <div class="card-body d-flex align-items-center justify-content-center p-2 position-relative" style="min-height: 250px;">
                                <template x-if="previewUrl">
                                    <img :src="previewUrl" alt="Selected image preview" style="width:100%;height:250px;object-fit:cover;border-radius:8px;">
                                </template>
                                <template x-if="!previewUrl">
                                    <div class="text-center text-secondary px-3">
                                        <div class="fw-semibold mb-1">Image Preview</div>
                                        <small>Selected image will appear here before upload.</small>
                                    </div>
                                </template>

                                <div
                                    class="position-absolute top-0 start-0 w-100 h-100 d-none align-items-center justify-content-center bg-white"
                                    style="opacity:0.8; border-radius:8px;"
                                    wire:loading.class.remove="d-none"
                                    wire:loading.class.add="d-flex"
                                    wire:target="image,save">
                                    <div class="text-center">
                                        <div class="spinner-border text-primary" role="status" aria-hidden="true"></div>
                                        <div class="mt-2 fw-semibold text-dark">Uploading...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="card-title mb-0">Uploaded Slider Images</h3>
        <span class="badge bg-azure-lt text-azure">Total: {{ $sliders->count() }}</span>
    </div>

    @if($editingId)
        <div class="card mb-3">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Slider #{{ $editingId }}</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="update" class="d-flex flex-wrap align-items-center gap-2">
                    <input type="file" class="form-control" style="max-width: 320px;" wire:model.live="editImage" accept="image/*">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="editImage,update">
                        <span wire:loading.remove wire:target="editImage,update">Update Image</span>
                        <span class="d-none" wire:loading.class.remove="d-none" wire:target="editImage,update">Updating...</span>
                    </button>
                    <button type="button" class="btn btn-secondary" wire:click="cancelEdit">Cancel</button>
                </form>
                @error('editImage')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
    @endif

    @if($sliders->count())
        <div class="row row-cards">
            @foreach($sliders as $slide)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card">
                        <img src="{{ $slide->image_url }}" alt="Home slider image" class="card-img-top" style="height:220px;object-fit:cover;">
                        <div class="card-body py-2 d-flex justify-content-between align-items-center">
                            <small class="text-secondary">ID: {{ $slide->id }}</small>
                            <small class="text-secondary">{{ $slide->created_at?->format('d M, Y') }}</small>
                        </div>
                        <div class="card-footer d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-primary" wire:click="startEdit({{ $slide->id }})">Edit</button>
                            <button
                                type="button"
                                class="btn btn-sm btn-outline-danger"
                                wire:click="openDeleteModal({{ $slide->id }})"
                                wire:loading.attr="disabled"
                                wire:target="openDeleteModal({{ $slide->id }})">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty border rounded p-4">
            <p class="empty-title mb-1">No sliders found</p>
            <p class="empty-subtitle text-secondary mb-0">Upload your first slider image to see it here.</p>
        </div>
    @endif

    @if($showDeleteModal)
        <div class="modal modal-blur fade show d-block" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" aria-label="Close" wire:click="closeDeleteModal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this slider image?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" wire:click="closeDeleteModal">Cancel</button>
                        <button type="button" class="btn btn-danger" wire:click="confirmDelete" wire:loading.attr="disabled" wire:target="confirmDelete">
                            <span wire:loading.remove wire:target="confirmDelete">Delete</span>
                            <span class="d-none" wire:loading.class.remove="d-none" wire:target="confirmDelete">Deleting...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
