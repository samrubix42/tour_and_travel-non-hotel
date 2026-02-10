<div>
    <style>
        :root {
            --accent: #e45b15;
        }

        .contact-sticky {
            position: fixed !important;
            right: 20px !important;
            bottom: 20px !important;
            z-index: 99999 !important;
            visibility: visible !important;
        }

        .contact-button {
            background: linear-gradient(180deg, #e45b15, #c74a10);
            color: #fff;
            border-radius: 50%;
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.18);
            border: 0;
            cursor: pointer;
        }

        .contact-button:hover {
            transform: translateY(-3px);
        }

        .contact-modal .modal-content {
            border-radius: 12px;
            overflow: hidden;
        }

        .small-muted {
            color: #6b6b6b;
        }

        /* custom checkbox */
        .custom-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .custom-checkbox input[type="checkbox"] {
            display: none;
        }

        .custom-checkbox .check {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 2px solid rgba(0, 0, 0, 0.06);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            transition: all .18s cubic-bezier(.2, .9, .2, 1);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
        }

        .custom-checkbox .check svg {
            width: 14px;
            height: 14px;
            fill: none;
            stroke: #fff;
            stroke-width: 2.2px;
            opacity: 0;
            transform: scale(0.8);
            transition: opacity .16s, transform .16s;
        }

        .custom-checkbox input[type="checkbox"]:checked+.check {
            background: var(--accent);
            border-color: var(--accent);
            box-shadow: 0 10px 30px rgba(228, 91, 21, 0.18);
            transform: translateY(-1px) scale(1.02);
        }

        .custom-checkbox input[type="checkbox"]:checked+.check svg {
            opacity: 1;
            transform: scale(1);
        }

        .custom-checkbox .text {
            font-size: 13px;
            color: #333;
            line-height: 1.25;
        }

        .custom-checkbox .text {
            font-size: 13px;
            color: #333;
        }
    </style>

    <div class="contact-sticky">
        <button type="button" class="contact-button" wire:click="open" title="Contact">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
        </button>
    </div>

    @if($show)
    <div class="modal-backdrop fade show"></div>
    <div class="modal d-block contact-modal" tabindex="-1" role="dialog" style="display:block;">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:900px;width:100%;">
            <div class="modal-content rounded shadow-sm" style="width:800px;margin:auto; overflow:hidden;">
                <div class="modal-header d-flex align-items-center" style="background:var(--accent);color:#fff;border-bottom:0;padding:18px 20px;">
                    <div style="width:44px;height:44px;background:#fff;border-radius:8px;display:flex;align-items:center;justify-content:center;margin-right:12px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" style="color:var(--accent)">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </div>
                    <h5 class="modal-title mb-0">Hotel Enquiry</h5>
                    <button type="button" class="btn btn-sm ms-auto" wire:click="close" style="background:transparent;border:0;color:#fff;font-size:16px;">✕</button>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                    <div class="alert alert-danger small mb-3">Please fix the highlighted fields below.</div>
                    @endif
                    <form wire:submit.prevent="promptConfirm">
                        <div class="mb-2">
                            <label class="small mb-1">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name" wire:model.defer="name">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-2">
                            <label class="small mb-1">Destination</label>
                            <select class="form-select @error('destination_id') is-invalid @enderror" wire:model.defer="destination_id">
                                <option value="">- Select Destination -</option>
                                @foreach($destinations as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                            @error('destination_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            <input type="hidden" wire:model.defer="tour_id">
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6 mb-2">
                                <label class="small mb-1">Mobile</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Mobile" wire:model.defer="phone">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="small mb-1">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" wire:model.defer="email">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <label class="small mb-1">Check In Date</label>
                                <input type="date" class="form-control @error('check_in_date') is-invalid @enderror" wire:model.defer="check_in_date" placeholder="mm/dd/yyyy">
                                @error('check_in_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Check Out Date</label>
                                <input type="date" class="form-control @error('check_out_date') is-invalid @enderror" wire:model.defer="check_out_date" placeholder="mm/dd/yyyy">
                                @error('check_out_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <label class="small mb-1">No of Adult</label>
                                <select class="form-select @error('no_of_adults') is-invalid @enderror" wire:model.defer="no_of_adults">
                                    <option value="">- Select -</option>
                                    @for($i=1;$i<=6;$i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                </select>
                                @error('no_of_adults') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Children</label>
                                <input type="text" class="form-control @error('children') is-invalid @enderror" placeholder="Children (5 - 12 Yrs)" wire:model.defer="children">
                                @error('children') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- removed category select as requested --}}

                        <div class="mb-2">
                            <label class="small mb-1">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" rows="3" placeholder="Message" wire:model.defer="message"></textarea>
                            @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="custom-checkbox" for="consentCheck">
                                <input class="@error('consent') is-invalid @enderror" type="checkbox" wire:model.defer="consent" id="consentCheck">
                                <span class="check" aria-hidden>
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <polyline points="20 6 9 17 4 12" style="fill:none;stroke:#fff;stroke-width:2.4;stroke-linecap:round;stroke-linejoin:round" />
                                    </svg>
                                </span>
                                <span class="text">I authorize Swan Tours & its representatives to Call, SMS & Email me with reference to my Travel Enquiry.</span>
                            </label>
                            @error('consent') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary me-2" wire:click="close">Cancel</button>
                            <button type="submit" class="btn" style="background:var(--accent); color:#fff;">Send Enquiry</button>
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
                    <div class="mb-2"><strong>Mobile:</strong> {{ $phone ?? '-' }}</div>
                    <div class="mb-2"><strong>Email:</strong> {{ $email ?? '-' }}</div>
                    <div class="mb-2"><strong>Check In:</strong> {{ $check_in_date ?? '-' }}</div>
                    <div class="mb-2"><strong>Check Out:</strong> {{ $check_out_date ?? '-' }}</div>
                    <div class="mb-2"><strong>No of Adult:</strong> {{ $no_of_adults ?? '-' }}</div>
                    <div class="mb-2"><strong>Children:</strong> {{ $children ?? '-' }}</div>
                    <div class="mb-2"><strong>Destination:</strong> {{ optional($destinations->firstWhere('id',$destination_id))->name ?? '-' }}</div>
                    <div class="mb-2"><strong>Message:</strong>
                        <div class="small text-muted">{!! $message ? nl2br(e($message)) : '-' !!}</div>
                    </div>
                    <div class="mb-2"><strong>Consent:</strong> {{ $consent ? 'Yes' : 'No' }}</div>

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
        (function() {
            window.addEventListener('notify', function(e) {
                const msg = e?.detail?.message || 'Saved';
                const root = document.getElementById('contact-toast-root');
                const toast = document.createElement('div');
                toast.style.position = 'fixed';
                toast.style.right = '20px';
                toast.style.bottom = '100px';
                toast.style.zIndex = 200000;
                toast.style.background = 'linear-gradient(90deg, rgba(228,91,21,0.95), rgba(199,74,16,0.95))';
                toast.style.color = '#fff';
                toast.style.padding = '10px 14px';
                toast.style.borderRadius = '8px';
                toast.style.boxShadow = '0 12px 36px rgba(0,0,0,0.18)';
                toast.innerText = msg;
                root.appendChild(toast);
                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(6px)';
                }, 2800);
                setTimeout(() => {
                    try {
                        root.removeChild(toast);
                    } catch (err) {}
                }, 3400);
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