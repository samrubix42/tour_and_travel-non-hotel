<div class="page-wrapper">
    <div class="page-body">
        <div class="container-xl">

            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="page-title">Site Contact & Social</h2>
                    <p class="text-muted mb-0">Manage your public contact details, social links, and branding assets.</p>
                </div>
                <div>
                    <button wire:click="loadSettings" class="btn btn-outline-secondary me-2">
                        <i class="ti ti-refresh"></i> Reload
                    </button>
                    <a href="/" target="_blank" class="btn btn-primary">
                        <i class="ti ti-world"></i> View Site
                    </a>
                </div>
            </div>

            <div class="row g-4">

                <!-- Left Section -->
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Contact & Social Information</h3>
                        </div>
                        <div class="card-body">

                            <form wire:submit.prevent="saveCommon" class="row g-3">

                                <!-- Address -->
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text bg-white"><i class="ti ti-map-pin"></i></span>
                                        <input wire:model.defer="common.address"
                                               class="form-control"
                                               placeholder="123 Main Street, City, Country">
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text bg-white"><i class="ti ti-phone"></i></span>
                                        <input wire:model.defer="common.phone"
                                               class="form-control"
                                               placeholder="+1 555 1234">
                                    </div>
                                </div>

                                <!-- Phone 2 -->
                                <div class="col-md-6">
                                    <label class="form-label">Phone (alternate)</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text bg-white"><i class="ti ti-phone"></i></span>
                                        <input wire:model.defer="common.phone_2"
                                               class="form-control"
                                               placeholder="+1 555 5678">
                                    </div>
                                </div>

                                <!-- Map Link -->
                                <div class="col-md-6">
                                    <label class="form-label">Map Location URL</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text bg-white"><i class="ti ti-map"></i></span>
                                        <input wire:model.defer="common.map_link"
                                               class="form-control"
                                               placeholder="https://maps.google.com/...">
                                    </div>
                                </div>

                                <!-- Instagram -->
                                <div class="col-md-6">
                                    <label class="form-label">Instagram</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text bg-white"><i class="ti ti-brand-instagram"></i></span>
                                        <input wire:model.defer="common.instagram"
                                               class="form-control"
                                               placeholder="@yourhandle or URL">
                                    </div>
                                </div>

                                <!-- Dribbble -->
                                <div class="col-md-6">
                                    <label class="form-label">Dribbble</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text bg-white"><i class="ti ti-brand-dribbble"></i></span>
                                        <input wire:model.defer="common.dribbble"
                                               class="form-control"
                                               placeholder="https://dribbble.com/yourprofile">
                                    </div>
                                </div>

                                <!-- Facebook -->
                                <div class="col-md-6">
                                    <label class="form-label">Facebook</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text bg-white"><i class="ti ti-brand-facebook"></i></span>
                                        <input wire:model.defer="common.facebook"
                                               class="form-control"
                                               placeholder="https://facebook.com/yourpage">
                                    </div>
                                </div>

                                <!-- Twitter -->
                                <div class="col-md-6">
                                    <label class="form-label">Twitter</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text bg-white"><i class="ti ti-brand-twitter"></i></span>
                                        <input wire:model.defer="common.twitter"
                                               class="form-control"
                                               placeholder="@yourhandle">
                                    </div>
                                </div>

                                <!-- LinkedIn -->
                                <div class="col-md-6">
                                    <label class="form-label">LinkedIn</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text bg-white"><i class="ti ti-brand-linkedin"></i></span>
                                        <input wire:model.defer="common.linkedin"
                                               class="form-control"
                                               placeholder="https://linkedin.com/company/...">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label class="form-label">Primary Email</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text bg-white"><i class="ti ti-mail"></i></span>
                                        <input wire:model.defer="common.email"
                                               class="form-control"
                                               placeholder="info@yourdomain.com">
                                    </div>
                                </div>

                                <!-- Email HR -->
                                <div class="col-md-6">
                                    <label class="form-label">HR Email</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text bg-white"><i class="ti ti-mail"></i></span>
                                        <input wire:model.defer="common.email_hr"
                                               class="form-control"
                                               placeholder="hr@yourdomain.com">
                                    </div>
                                </div>

                                <!-- YouTube -->
                                <div class="col-12">
                                    <label class="form-label">YouTube</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text bg-white"><i class="ti ti-brand-youtube"></i></span>
                                        <input wire:model.defer="common.youtube"
                                               class="form-control"
                                               placeholder="YouTube channel link">
                                    </div>
                                </div>

                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="ti ti-device-floppy"></i> Save Settings
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Branding Section -->
                <div class="col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <h3 class="card-title">Branding</h3>
                        </div>

                        <div class="card-body">

                            <!-- Logo -->
                            <label class="form-label">Logo</label>
                            <input type="file" wire:model="logo" accept="image/*" class="form-control mb-2">

                            @if($logo)
                                <img src="{{ $logo->temporaryUrl() }}" class="img-fluid rounded mb-3 border p-2">
                            @elseif(!empty($settings['logo']))
                                <img src="{{ asset($settings['logo']) }}" class="img-fluid rounded mb-3 border p-2">
                            @else
                                <div class="placeholder placeholder-wave rounded p-4 mb-3 bg-light text-center">
                                    <i class="ti ti-file-image text-muted"></i>
                                    <div>No logo uploaded</div>
                                </div>
                            @endif

                            <!-- Favicon -->
                            <label class="form-label">Favicon</label>
                            <input type="file" wire:model="favicon" accept="image/*" class="form-control mb-2">

                            @if($favicon)
                                <img src="{{ $favicon->temporaryUrl() }}" class="img-fluid rounded mb-3" style="max-width:48px;">
                            @elseif(!empty($settings['favicon']))
                                <img src="{{ asset($settings['favicon']) }}" class="img-fluid rounded mb-3" style="max-width:48px;">
                            @else
                                <div class="bg-light border rounded p-3 text-center text-muted" style="width:48px;">
                                    –
                                </div>
                            @endif

                            <hr>

                            <h4 class="subheader">Quick Actions</h4>
                            <div class="d-grid gap-2">
                                <button wire:click="loadSettings" class="btn btn-outline-secondary">
                                    <i class="ti ti-refresh"></i> Reload Settings
                                </button>
                                <a href="/" target="_blank" class="btn btn-outline-primary">
                                    <i class="ti ti-external-link"></i> Open Website
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    window.addEventListener('notify', event => {
        const { type, message } = event.detail || {};

        if (window.Tabler && Tabler.Toast) {
            Tabler.Toast.create({
                message,
                title: type,
                placement: "top-end",
                duration: 3000
            }).show();
        } else {
            alert(message);
        }
    });
</script>
