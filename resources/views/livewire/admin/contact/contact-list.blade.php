<div>
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <div>
                <h3 class="card-title">Contacts</h3>
                <div class="text-muted">Manage incoming messages</div>
            </div>
            <div class="ms-auto d-flex align-items-center" style="width: 300px; gap: 10px;">
                <input wire:model.debounce.live.500ms="search" type="search" class="form-control form-control-sm" placeholder="Search name, email, phone or message">
                <select wire:model.live="perPage" class="form-select form-select-sm" style="width: 20px;">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th class="w-25">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($contact->message, 80) }}</td>
                                <td>
                                    @if($contact->is_read)
                                        <span class="badge lt">Read</span>
                                    @else
                                        <span class="badge lt">New</span>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click="view({{ $contact->id }})" class="btn btn-sm btn-primary">View</button>
                                    <button wire:click="toggleRead({{ $contact->id }})" class="btn btn-sm btn-outline-secondary">{{ $contact->is_read ? 'Mark unread' : 'Mark read' }}</button>
                                    <button wire:click="confirmDelete({{ $contact->id }})" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No contacts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">Showing {{ $contacts->firstItem() ?: 0 }} to {{ $contacts->lastItem() ?: 0 }} of {{ $contacts->total() }} contacts</div>
                <div>
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>

                        @if($selectedContact)
        <div class="modal d-block" tabindex="-1" style="background: rgba(0,0,0,.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Message from {{ $selectedContact->name }}</h5>
                        <button type="button" class="btn-close" aria-label="Close" wire:click="closeView"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Email:</strong> {{ $selectedContact->email }}</p>
                        <p><strong>Phone:</strong> {{ $selectedContact->phone }}</p>
                        <hr>
                        <p style="white-space:pre-wrap;">{{ $selectedContact->message }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeView">Close</button>
                        <button type="button" class="btn btn-danger" wire:click="confirmDelete({{ $selectedContact->id }})">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($confirmingDelete)
        <div class="modal d-block" tabindex="-1" style="background: rgba(0,0,0,.5);">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" aria-label="Close" wire:click="cancelDelete"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this contact? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancelDelete">Cancel</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteConfirmed">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
