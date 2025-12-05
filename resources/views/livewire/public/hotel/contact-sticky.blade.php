<div>
    <style>
        :root{ --accent: #c19052; }
        .form-label-accent{ color:#333; font-weight:600; margin-bottom:6px; display:block; }
        .required-star{ color:#d63200; margin-left:4px; font-weight:700; }
        .contact-sticky{ position: fixed !important; right: 20px !important; bottom: 20px !important; z-index: 99999 !important; visibility: visible !important; }
        .contact-button{ background: linear-gradient(180deg,var(--accent),#a56f3f); color:#fff; border-radius:50%; width:64px; height:64px; display:flex; align-items:center; justify-content:center; box-shadow:0 12px 36px rgba(0,0,0,0.18); border:0; cursor:pointer; }
        .contact-button:hover{ transform:translateY(-3px); }
        .enquire-bubble{ position:absolute; right:76px; bottom:6px; display:flex; align-items:center; gap:8px; }
        .enquire-bubble .pill{ background:#fff; color:#2b2b2b; padding:8px 14px; border-radius:999px; box-shadow:0 6px 18px rgba(0,0,0,0.08); }
        .contact-modal .modal-content{ border-radius:12px; overflow:hidden; }
        .small-muted{ color:#6b6b6b; }
    </style>

    <div class="contact-sticky">
        <button type="button" class="contact-button" wire:click="open" title="Contact">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
        </button>

        <div class="d-none d-md-block enquire-bubble">
        </div>
    </div>

    <!-- Form Modal -->
    @if($show)
        <div class="modal-backdrop fade show"></div>
        <div class="modal d-block contact-modal" tabindex="-1" role="dialog" style="display:block;">
            <div class="modal-dialog modal-dialog-centered" role="document"  style="max-width:900px;width:100%;">
                <div class="modal-content rounded shadow-sm" style="width:720px;margin:auto; overflow:hidden;">
                    <div class="modal-header d-flex align-items-center" style="background:var(--accent);color:#fff;border-bottom:0;padding:18px 20px;">
                        <div style="width:44px;height:44px;background:#fff;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-right:12px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" style="color:var(--accent)"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        </div>
                        <h5 class="modal-title mb-0">Request Reservation</h5>
                        <button type="button" class="btn btn-sm ms-auto" wire:click="close" style="background:transparent;border:0;color:#fff;font-size:16px;">✕</button>
                    </div>
                    <div class="modal-body">
                        @if($errors->any())
                            <div class="alert alert-danger small mb-3">Please fix the highlighted fields below.</div>
                        @endif
                        <form wire:submit.prevent="promptConfirm">
                            <div class="mb-3 small-muted">Fill in the details below and we'll get back to you shortly.</div>

                            <div class="row g-2 align-items-start mb-2">
                                <div class="col-md-12">
                                    <label class="form-label-accent">Your name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your full name" wire:model.defer="name">
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                            </div>
                            <div class="mb-2">
                                <label class="small mb-1">Mobile</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Mobile" wire:model.defer="phone">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-2">
                                <label class="small mb-1">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" wire:model.defer="email">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-2">
                                <label class="form-label-accent">Category <small class="text-muted">(optional)</small></label>
                                <select class="form-select @error('category_id') is-invalid @enderror" wire:model.defer="category_id">
                                    <option value="">Choose category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-2">
                                <label class="form-label-accent">Number of guests</label>
                                <input type="number" min="1" class="form-control @error('no_of_persons') is-invalid @enderror" placeholder="e.g. 2" wire:model.defer="no_of_persons">
                                @error('no_of_persons') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <label class="form-label-accent">Check in</label>
                                    <input type="date" class="form-control @error('check_in') is-invalid @enderror" wire:model.defer="check_in">
                                    @error('check_in') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label-accent">Check out</label>
                                    <input type="date" class="form-control @error('check_out') is-invalid @enderror" wire:model.defer="check_out">
                                    @error('check_out') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <!-- Contact inputs moved to top contact row to keep layout compact -->
                            <div class="mb-2">
                                <label class="form-label-accent">Message</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" rows="3" placeholder="Any special requests or questions" wire:model.defer="message"></textarea>
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

    <!-- Confirmation Modal -->
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
                        <div class="mb-2"><strong>Category:</strong> {{ optional($categories->firstWhere('id',$category_id))->name ?? '-' }}</div>
                        <div class="mb-2"><strong>Guests:</strong> {{ $no_of_persons ?? '-' }}</div>
                        <div class="mb-2"><strong>Check In:</strong> {{ $check_in ?? '-' }} &nbsp; <strong>Check Out:</strong> {{ $check_out ?? '-' }}</div>
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

    <!-- Thank-you Modal -->
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
