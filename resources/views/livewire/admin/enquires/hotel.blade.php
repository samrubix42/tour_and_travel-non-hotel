<div>
    <style>
        .enquiry-row:hover { background: rgba(18, 26, 33, 0.02); }
        .avatar-circle { width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center; border-radius:50%; background:#f1f3f5; color:#222; font-weight:700; }
        .small-muted { font-size:0.85rem; color:#6c757d; }
        .action-dropdown .dropdown-menu { min-width:160px; }
    </style>
    <div class="d-flex mb-3 align-items-center">
        <h3 class="me-auto">Hotel Enquiries</h3>
        <div class="ms-3 me-3">
            <div class="input-icon">
                <input type="text" class="form-control" placeholder="Search name, email or phone" wire:model.debounce.500ms="search">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"></circle><path d="M21 21l-4.35-4.35"></path></svg>
                </span>
            </div>
        </div>
       
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $c)
                            <tr class="enquiry-row">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-3">{{ strtoupper(substr($c->name,0,1)) }}</div>
                                        <div>
                                            <div class="fw-600">{{ $c->name }}</div>
                                            <div class="small-muted">{{ $c->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-600">{{ $c->phone ?? '-' }}</div>
                                    <div class="small-muted">{{ $c->no_of_persons ?? '—' }} guests</div>
                                </td>
                                <td class="small-muted">{{ $c->created_at->diffForHumans() }}<div class="small-muted">{{ $c->created_at->toDayDateTimeString() }}</div></td>
                                <td>
                                    @if(is_null($c->status) || $c->status === '' || $c->status === 'pending' || $c->status == 0)
                                        <span class="badge bg-yellow-lt">Pending</span>
                                    @elseif($c->status === 'handled' || $c->status == 1)
                                        <span class="badge bg-green-lt">Handled</span>
                                    @else
                                        <span class="badge bg-secondary-lt">{{ $c->status }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="dropdown action-dropdown d-inline-block">
                                        <button class="btn btn-sm btn-icon btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#" wire:click.prevent="viewContact({{ $c->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M15 12a3 3 0 10-6 0 3 3 0 006 0z"></path><path d="M2.05 12A9.95 9.95 0 0112 2.05 9.95 9.95 0 0121.95 12"></path></svg>View
                                            </a>
                                            <a class="dropdown-item" href="#" wire:click.prevent="toggleStatus({{ $c->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20l9-5-9-5-9 5 9 5z"></path><path d="M12 12l9-5-9-5-9 5 9 5z"></path></svg>Toggle Status
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#" wire:click.prevent="confirmDelete({{ $c->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M8 6v14a2 2 0 002 2h4a2 2 0 002-2V6"></path><path d="M10 11v6"></path><path d="M14 11v6"></path><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"></path></svg>Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No enquiries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex align-items-center">
            <div class="me-auto text-muted">Showing {{ $contacts->firstItem() ?? 0 }} to {{ $contacts->lastItem() ?? 0 }} of {{ $contacts->total() ?? 0 }} entries</div>
            <div>
                {{ $contacts->links() }}
            </div>
        </div>
    </div>

    <!-- View Modal -->
    @if($showModal && $selectedContact)
        <div class="modal-backdrop fade show"></div>
        <div class="modal d-block" tabindex="-1" role="dialog" style="display:block; z-index:200000;">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h5 class="modal-title">Enquiry from {{ $selectedContact->name }}</h5>
                            <div class="small-muted">{{ $selectedContact->email ?? '-' }} · {{ $selectedContact->phone ?? '-' }}</div>
                        </div>
                        <div class="ms-3">
                            @if($selectedContact->destination_name)
                                <span class="badge bg-info">{{ $selectedContact->destination_name }}</span>
                            @endif
                            @if(is_null($selectedContact->status) || $selectedContact->status === '' || $selectedContact->status === 'pending' || $selectedContact->status == 0)
                                <span class="badge bg-yellow-lt ms-2">Pending</span>
                            @elseif($selectedContact->status === 'handled' || $selectedContact->status == 1)
                                <span class="badge bg-green-lt ms-2">Handled</span>
                            @else
                                <span class="badge bg-secondary-lt ms-2">{{ $selectedContact->status }}</span>
                            @endif
                        </div>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Guests</strong>
                                <div class="small-muted">{{ $selectedContact->no_of_persons ?? '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Check In / Out</strong>
                                <div class="small-muted">{{ $selectedContact->check_in ?? '-' }} / {{ $selectedContact->check_out ?? '-' }}</div>
                            </div>
                        </div>
                        <hr />
                        <div>
                            <strong>Message</strong>
                            <p class="small-muted mt-2">{!! nl2br(e($selectedContact->message ?? '-')) !!}</p>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-6">
                                <strong>IP</strong>
                                <div class="small-muted">{{ $selectedContact->ip ?? '-' }}</div>
                            </div>
                            <div class="col-md-6 text-end">
                                <strong>Received</strong>
                                <div class="small-muted">{{ $selectedContact->created_at->toDayDateTimeString() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary" wire:click="closeModal">Close</button>
                        <button class="btn btn-success" wire:click.prevent="toggleStatus({{ $selectedContact->id }})">Toggle Status</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Confirm -->
    @if($showDeleteConfirm && $confirmDeleteId)
        <div class="modal-backdrop fade show"></div>
        <div class="modal d-block" tabindex="-1" role="dialog" style="display:block; z-index:200001;">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center p-4">
                        <h5>Delete enquiry?</h5>
                        <p class="text-muted">This action cannot be undone. Deleting will remove the record permanently.</p>
                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-outline-secondary me-2" wire:click.prevent="$set('showDeleteConfirm', false)">Cancel</button>
                            <button class="btn btn-danger" wire:click.prevent="deleteConfirmed">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
