<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('settings.brand_name', 'Panel') }} | {{ $title ?? (trim($__env->yieldContent('title')) ?: 'Page Title') }} </title>

    @php $tablerVersion = config('settings.tabler_version'); @endphp 

    <!-- Tabler CSS -->
    <link href="{{ asset('tabler/theme/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/theme/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/theme/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/theme/css/tabler-vendors.min.css') }}" rel="stylesheet" />

    <!-- Tabler Icons -->
     <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('tabler/theme/style.css') . '?v=' . $tablerVersion }}">
    <link rel="stylesheet" href="{{ asset('tabler/theme/loaders.css') . '?v=' . $tablerVersion }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('tabler/theme/img/favicon.ico') . '?v=' . $tablerVersion }}" type="image/x-icon">

    <!-- SweetAlert2 & Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @livewireStyles
    @stack('styles')

    <style>
        /* Tabler-style Toastr */
        #toast-container > .toast { border-radius: 0.5rem; padding: 1rem 1.2rem; font-size: 0.95rem; box-shadow: 0 4px 10px rgba(0,0,0,0.1); color: #fff; }
        #toast-container > .toast-success { background-color: #37b24d; }
        #toast-container > .toast-error { background-color: #f03e3e; }
        #toast-container > .toast-warning { background-color: #f59f00; color: #212529; }
        #toast-container > .toast-info { background-color: #228be6; }
        #toast-container > .toast .toast-title { font-weight: 600; margin-bottom: 0.2rem; }
        #toast-container > .toast-close-button { color: #fff; opacity: 0.9; }
    </style>
</head>
<body class="layout-fluid">

    <!-- Sidebar -->
    <x-admin.sidebar :currentRoute="Route::currentRouteName()" />

    <div class="page">
        <!-- Header -->
        @php
            $resolvedTitle = $title ?? (trim($__env->yieldContent('title')) ?: 'Dashboard');
        @endphp
        <x-admin.header :title="$resolvedTitle"/>

        <!-- Page Content -->
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logoutPost" action="#" method="POST" style="display:none;">
        @csrf
    </form>

    <!-- Scripts -->
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tabler JS -->
    <script src="{{ asset('tabler/theme/js/tabler.min.js') }}"></script>
    <script src="{{ asset('tabler/theme/js/demo-theme.min.js') }}"></script>
    <script src="{{ asset('tabler/theme/prefs.js') }}"></script>

    <!-- Toastr JS -->
     <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @livewireScripts


    <script>
            toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };

        document.addEventListener('livewire:load', () => {
            Livewire.on('success', message => toastr.success(message));
            Livewire.on('error', message => toastr.error(message));
            Livewire.on('warning', message => toastr.warning(message));
        });

        // ==========================
        // SweetAlert2 Toast Integration
        // ==========================
        const toastSuccess = Swal.mixin({
            toast: true,
            icon: 'success',
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        const toastError = Swal.mixin({
            toast: true,
            icon: 'error',
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        const toastWarning = Swal.mixin({
            toast: true,
            icon: 'warning',
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('success', message => toastSuccess.fire({ title: message }));
            Livewire.on('error', message => toastError.fire({ title: message }));
            Livewire.on('warning', message => toastWarning.fire({ title: message }));
        });
        // ==========================
        // Tabler Components Init
        // ==========================
        function initTablerComponents() {
            if(window.Tabler) Tabler.init();

            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                if (!el._tooltip) new bootstrap.Tooltip(el);
            });

            document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(el => {
                if (!el._dropdown) new bootstrap.Dropdown(el);
            });
        }

        document.addEventListener("DOMContentLoaded", initTablerComponents);
        document.addEventListener("livewire:navigated", initTablerComponents);

        // ==========================
        // Dark Mode Toggle
        // ==========================
        document.addEventListener('DOMContentLoaded', () => {
            const html = document.documentElement;
            const toggle = document.getElementById('darkModeToggle');

            if(localStorage.getItem('theme') === 'dark'){
                html.setAttribute('data-theme', 'dark');
            }

            if(toggle){
                toggle.addEventListener('click', () => {
                    if(html.getAttribute('data-theme') === 'dark'){
                        html.removeAttribute('data-theme');
                        localStorage.setItem('theme', 'light');
                    } else {
                        html.setAttribute('data-theme', 'dark');
                        localStorage.setItem('theme', 'dark');
                    }
                });
            }
        });
        // main.js

const MainComponent = (() => {

  // Initialize Tabler components
  const initComponents = () => {
    // Dropdowns
    document.querySelectorAll('[data-toggle="dropdown"]').forEach(dropdown => {
      if (dropdown._dropdownInstance) dropdown._dropdownInstance.dispose();
      dropdown._dropdownInstance = new bootstrap.Dropdown(dropdown);
    });

    // Tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(tooltip => {
      if (tooltip._tooltipInstance) tooltip._tooltipInstance.dispose();
      tooltip._tooltipInstance = new bootstrap.Tooltip(tooltip);
    });

    // Modals
    document.querySelectorAll('.modal').forEach(modalEl => {
      if (modalEl._modalInstance) modalEl._modalInstance.dispose();
      modalEl._modalInstance = new bootstrap.Modal(modalEl);
    });
  };

  return {
    init: () => {
      initComponents();
      console.log("MainComponent initialized.");
    },
    refresh: () => {
      initComponents();
      console.log("MainComponent refreshed.");
    }
  };

})();

// Initial load
document.addEventListener('DOMContentLoaded', () => {
  MainComponent.init();
});

// Refresh automatically on Livewire updates
if (window.Livewire) {
  window.Livewire.hook('message.processed', () => {
    MainComponent.refresh();
  });
}

    // Listen for component-dispatched events to show/hide Bootstrap modals
    document.addEventListener('open-faq-modal', () => {
        const modalEl = document.getElementById('faqModal');
        if (modalEl) {
            const instance = bootstrap.Modal.getOrCreateInstance(modalEl);
            instance.show();
        }
    });

    document.addEventListener('close-faq-modal', () => {
        const modalEl = document.getElementById('faqModal');
        if (modalEl) {
            const instance = bootstrap.Modal.getOrCreateInstance(modalEl);
            instance.hide();
        }
    });

    </script>

    @stack('scripts')
</body>
</html>
