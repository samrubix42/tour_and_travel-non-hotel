<div>
    <style>
        :root{ --accent: #c19052; }
        .contact-sticky{ position: fixed !important; right: 20px !important; bottom: 20px !important; z-index: 99999 !important; visibility: visible !important; }
        .contact-button{ background: linear-gradient(180deg,var(--accent),#a56f3f); color:#fff; border-radius:50%; width:64px; height:64px; display:flex; align-items:center; justify-content:center; box-shadow:0 12px 36px rgba(0,0,0,0.18); border:0; cursor:pointer; }
        .contact-button:hover{ transform:translateY(-3px); }
        .contact-modal .modal-content{ border-radius:12px; overflow:hidden; }
        .small-muted{ color:#6b6b6b; }
    </style>

    <div class="contact-sticky">
        <button type="button" class="contact-button" wire:click="open" title="Contact">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
        </button>
    </div>

    @if($show)
        <div class="modal-backdrop fade show"></div>
        <div class="modal d-block contact-modal" tabindex="-1" role="dialog" style="display:block;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded shadow-sm" style="max-width:560px;margin:auto;">
                    <div class="modal-header" style="border-bottom:0;">
                        <h5 class="modal-title">Enquire about a Tour</h5>
                        <button type="button" class="btn-close" wire:click="close"></button>
                    </div>
                    <div class="modal-body">
                        @if($errors->any())
                            <div class="alert alert-danger small mb-3">Please fix the highlighted fields below.</div>
                        @endif
                        <form wire:submit.prevent="promptConfirm">
                            <div class="mb-2">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your name" wire:model.defer="name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-2">
                                <select class="form-select @error('destination_id') is-invalid @enderror" wire:model.defer="destination_id">
                                    <option value="">Choose destination (optional)</option>
                                    @foreach($destinations as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                                @error('destination_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-2">
                                <input type="number" min="1" class="form-control @error('no_of_persons') is-invalid @enderror" placeholder="Number of guests" wire:model.defer="no_of_persons">
                                @error('no_of_persons') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-12">
                                    <input type="date" class="form-control @error('travel_date') is-invalid @enderror" wire:model.defer="travel_date">
                                    @error('travel_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="mb-2">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email (optional)" wire:model.defer="email">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone (optional)" wire:model.defer="phone">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-2">
                                <textarea class="form-control @error('message') is-invalid @enderror" rows="3" placeholder="Message" wire:model.defer="message"></textarea>
                                @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-secondary me-2" wire:click="close">Cancel</button>
                                <button type="submit" class="btn" style="background:var(--accent); color:#fff;">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($confirming)
        <div class="modal-backdrop fade show"></div>
        <div class="modal d-block contact-modal" tabindex="-1" role="dialog" style="display:block; z-index:200001;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded shadow-sm" style="max-width:520px;margin:auto;">
                    <div class="modal-header" style="border-bottom:0;">
                        <h5 class="modal-title">Confirm your request</h5>
                        <button type="button" class="btn-close" wire:click="$set('confirming', false)"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2"><strong>Name:</strong> {{ $name }}</div>
                        <div class="mb-2"><strong>Destination:</strong> {{ optional($destinations->firstWhere('id',$destination_id))->name ?? '-' }}</div>
                        <div class="mb-2"><strong>Guests:</strong> {{ $no_of_persons ?? '-' }}</div>
                        <div class="mb-2"><strong>Travel Date:</strong> {{ $travel_date ?? '-' }}</div>
                        <div class="mb-2"><strong>Email:</strong> {{ $email ?? '-' }}</div>
                        <div class="mb-2"><strong>Phone:</strong> {{ $phone ?? '-' }}</div>
                        <div class="mb-2"><strong>Message:</strong><div class="small text-muted">{!! $message ? nl2br(e($message)) : '-' !!}</div></div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-outline-secondary me-2" wire:click="$set('confirming', false)">Back</button>
                            <button type="button" class="btn" style="background:var(--accent); color:#fff;" wire:click="save">Confirm & Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div id="contact-toast-root"></div>

    <script>
        (function(){
            window.addEventListener('notify', function(e){
                const msg = e?.detail?.message || 'Saved';
                const root = document.getElementById('contact-toast-root');
                const toast = document.createElement('div');
                toast.style.position = 'fixed';
                toast.style.right = '20px';
                toast.style.bottom = '100px';
                toast.style.zIndex = 200000;
                toast.style.background = 'linear-gradient(90deg, rgba(193,144,82,0.95), rgba(165,111,63,0.95))';
                toast.style.color = '#fff';
                toast.style.padding = '10px 14px';
                toast.style.borderRadius = '8px';
                toast.style.boxShadow = '0 12px 36px rgba(0,0,0,0.18)';
                toast.innerText = msg;
                root.appendChild(toast);
                setTimeout(()=>{ toast.style.opacity = '0'; toast.style.transform='translateY(6px)'; }, 2800);
                setTimeout(()=>{ try{ root.removeChild(toast);}catch(err){} }, 3400);
            });
        })();
    </script>

    @if($submitted)
        <div class="modal-backdrop fade show"></div>
        <div class="modal d-block contact-modal" tabindex="-1" role="dialog" style="display:block; z-index:200002;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded shadow-sm" style="max-width:480px;margin:auto;">
                    <div class="modal-body text-center p-4">
                        <div style="font-size:36px; color:var(--accent);">✓</div>
                        <h5 class="mt-2">Thank you</h5>
                        <p class="small-muted">Thank you for the details — we will contact you shortly.</p>
                        <div class="mt-3">
                            <button type="button" class="btn btn-accent" wire:click="closeThanks">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
