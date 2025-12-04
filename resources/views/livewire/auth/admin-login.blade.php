
<div class="auth-page">
    <div class="container d-flex align-items-center justify-content-center" style="min-height:90vh">
        <div class="card shadow-lg border-0" style="max-width:420px; width:100%; border-radius:12px;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <div class="mx-auto mb-3" style="width:72px;height:72px;border-radius:12px;background:#f7f5f0;display:flex;align-items:center;justify-content:center;">
                        <img src="" alt="Logo" style="height:40px;" onerror="this.style.display='none'">
                        <span style="color:#c19052;font-weight:700;font-size:20px;">T</span>
                    </div>
                    <h3 class="fw-bold mb-1" style="letter-spacing:1px;color:#222;">Admin Login</h3>
                    <p class="text-muted mb-0 small">Sign in to your admin panel</p>
                </div>

                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form wire:submit.prevent="login">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input wire:model.defer="email" type="email" class="form-control rounded-pill px-3 py-2 @error('email') is-invalid @enderror" placeholder="you@example.com" autofocus>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input wire:model.defer="password" type="password" class="form-control rounded-pill px-3 py-2 @error('password') is-invalid @enderror" placeholder="Your password">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input wire:model="remember" class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="small" style="color:#c19052;">Forgot password?</a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn  btn-lg rounded-pill shadow-sm" style="background-color:#c19052; color:#fff; font-weight:600; letter-spacing:1px;">Sign in</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center small text-muted" style="background:transparent; border:0;">© {{ date('Y') }} Your Company</div>
        </div>
    </div>

    <style>
        :root{ --accent: #c19052; }
        body{ background: linear-gradient(180deg,#fbfbfb,#f2f2f2); }
        .auth-page{ min-height:100vh; }
        .card{ border:0; border-radius:12px; }
        .card-body{ background: #fff; border-radius:12px; }
        .btn-primary{ background: var(--accent); border:0; color:#fff; box-shadow:0 6px 18px rgba(193,144,82,0.12); }
        .btn-primary:hover{ background: #b07f47; }
        .form-control:focus{ box-shadow:0 0 0 4px rgba(193,144,82,0.08); border-color: var(--accent); }
        .form-control{ background:#f7f7f6; border-radius:50px; border:1px solid #ecebea; height:44px; }
        .invalid-feedback{ font-size:13px; }
        .card-footer{ font-size:13px; color:#666; }
        @media (max-width:576px){ .card{ margin:20px; } }
    </style>
</div>
