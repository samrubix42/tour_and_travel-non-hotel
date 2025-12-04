<div class="container-xl">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">Banner Management</h2>

       
    </div>


    <!-- Banner Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ti ti-photo-up me-1"></i>
                {{ $editId ? 'Edit Banner' : 'Create Banner' }}
            </h3>
        </div>

        <div class="card-body">

            <form wire:submit.prevent="save" >

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" wire:model.defer="title" class="form-control" placeholder="Banner title">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Subtitle</label>
                        <input type="text" wire:model.defer="subtitle" class="form-control" placeholder="Banner subtitle">
                        @error('subtitle') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" wire:model.defer="button_text" class="form-control" placeholder="Example: Learn More">
                        @error('button_text') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" wire:model.defer="button_url" class="form-control" placeholder="https://example.com">
                        @error('button_url') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select wire:model.defer="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" wire:model="image" class="form-control">
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        <div wire:loading wire:target="image" class="mt-2">
                            <span class="spinner-border spinner-border-sm text-primary"></span> Uploading image...
                        </div>
                        <div class="mt-3">
                            @if($image)
                                <img src="{{ $image->temporaryUrl() }}" class="rounded border" style="width:120px;">
                            @elseif($image_url)
                                <img src="{{ $image_url }}" class="rounded border" style="width:120px;">
                            @endif
                        </div>
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                        <span wire:loading wire:target="save">{{ $editId ? 'Updating...' : 'Adding...' }}</span>
                        <span wire:loading.remove wire:target="save">{{ $editId ? 'Update Banner' : 'Create Banner' }}</span>
                    </button>

                    @if($editId)
                        <button type="button" wire:click="resetForm" class="btn btn-secondary ms-2" wire:loading.attr="disabled">
                            Cancel
                        </button>
                    @endif
                </div>

            </form>

        </div>
    </div>


    <!-- Banner Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="ti ti-list-details me-1"></i>Banner List</h3>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter card-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Banner</th>
                        <th>Details</th>
                        <th>Button</th>
                        <th>Status</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>

                <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>

                        <td>
                            <span class="avatar avatar-md" 
                                  style="background-image:url('{{ $banner->image_url }}'); border-radius:6px;">
                            </span>
                        </td>

                        <td>
                            <div class="fw-bold">{{ $banner->title }}</div>
                            <div class="text-muted small">{{ $banner->subtitle }}</div>
                        </td>

                        <td>
                            @if($banner->button_text)
                                <a href="{{ $banner->button_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    {{ $banner->button_text }}
                                </a>
                            @endif
                        </td>

                        <td>
                            <span class="badge {{ $banner->status ? 'bg-green-lt' : 'bg-red-lt' }}">
                                {{ $banner->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td class="text-end d-flex justify-content-end">
                            <button wire:click="edit({{ $banner->id }})" class="btn btn-sm btn-warning me-1" wire:loading.attr="disabled">
                                <span wire:loading wire:target="edit({{ $banner->id }})" class="spinner-border spinner-border-sm me-1"></span>
                                <i class="ti ti-edit"></i>
                            </button>

                            <button wire:click="confirmDelete({{ $banner->id }})" class="btn btn-sm btn-danger" wire:loading.attr="disabled">
                                <span wire:loading wire:target="confirmDelete({{ $banner->id }})" class="spinner-border spinner-border-sm me-1"></span>
                                <i class="ti ti-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Delete Modal -->
                    @if($deleteId === $banner->id)
                        <div class="modal fade show" style="display:block; background:rgba(0,0,0,0.5);">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Banner</h5>
                                    </div>

                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this banner?</p>
                                    </div>

                                    <div class="modal-footer">
                                        <button wire:click="delete" class="btn btn-danger" wire:loading.attr="disabled">
                                            <span wire:loading wire:target="delete" class="spinner-border spinner-border-sm me-1"></span>
                                            <span wire:loading wire:target="delete">Deleting...</span>
                                            <span wire:loading.remove wire:target="delete">Delete</span>
                                        </button>
                                        <button wire:click="$set('deleteId', null)" class="btn btn-secondary" wire:loading.attr="disabled">Cancel</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
