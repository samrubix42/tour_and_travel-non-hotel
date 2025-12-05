<div class="container-xl">
    <div class="card mt-3">
        <div class="card-header d-flex align-items-center">
            <div class="me-auto">
                <h3 class="card-title">Testimonials</h3>
            </div>
            <div class="d-flex gap-2 col-6">
                <input wire:model.debounce..live.500ms="search" type="text" class="form-control" placeholder="Search name or feedback">
                <select wire:model.live="perPage" class="form-select" style="width: 20px;">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <button wire:click="openCreateModal" class="btn btn-primary btn-md">Add</button>
            </div>
        </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Feedback</th>
                            <th>Rating</th>
                            <th>Created</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $t)
                            <tr>
                                <td>{{ $t->name }}</td>
                                <td>{{ Str::limit($t->feedback, 80) }}</td>
                                <td>{{ $t->rating ?? '-' }}</td>
                                <td>{{ $t->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="btn-list">
                                        <button wire:click="openEditModal({{ $t->id }})" class="btn btn-sm btn-secondary">Edit</button>
                                        <button wire:click="confirmDelete({{ $t->id }})" class="btn btn-sm btn-danger">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No testimonials found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Showing {{ $testimonials->firstItem() ?? 0 }} to {{ $testimonials->lastItem() ?? 0 }} of {{ $testimonials->total() }}
                </div>
                <div>
                    {{ $testimonials->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Create / Edit Modal --}}
    @if($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.4);">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $testimonialId ? 'Edit' : 'Create' }} Testimonial</h5>
                        <button type="button" class="btn-close" aria-label="Close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input wire:model.defer="name" type="text" class="form-control">
                            @error('name') <div class="form-text text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Feedback</label>
                            <textarea wire:model.defer="feedback" class="form-control" rows="4"></textarea>
                            @error('feedback') <div class="form-text text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <input wire:model.defer="rating" type="number" min="0" max="5" class="form-control">
                            @error('rating') <div class="form-text text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" wire:click="closeModal">Cancel</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent="save">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Delete Confirmation Modal --}}
    @if($confirmingDeleteId)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.4);">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this testimonial?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-link" wire:click="$set('confirmingDeleteId', null)">Cancel</button>
                        <button class="btn btn-danger" wire:click="delete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
