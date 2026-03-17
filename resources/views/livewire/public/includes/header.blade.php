   <header style="width: 100%;">
       <!-- start navigation -->
       <nav class="navbar navbar-expand-lg bg-transparent  border-radius-6px md-border-radius-0px">
           <div class="container-fluid">
               <div class="col-lg-2 me-lg-0 me-auto " style="width">
                   <a class="" href="{{ route('home') }}" style="width: 100%;">

                       <img src="{{ asset('asset/image/1000400474-removebg-preview.png') }}"
                           alt="Logo"
                           class="home-logo">
                       <style>
                           .home-logo {
                               height: 90px;
                               width: auto;
                               object-fit: contain;
                           }

                           @media (max-width: 768px) {
                               .home-logo {
                                   height: 70px;
                               }
                           }

                           @media (max-width: 480px) {
                               .home-logo {
                                   height: 55px;
                               }
                           }
                       </style>
                   </a>
               </div>
               <div class="col-auto col-xxl-6 col-lg-8 menu-order">
                   <button class="navbar-toggler float-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                       <span class="navbar-toggler-line"></span>
                       <span class="navbar-toggler-line"></span>
                       <span class="navbar-toggler-line"></span>
                       <span class="navbar-toggler-line"></span>
                   </button>
                   <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                       <ul class="navbar-nav navbar-left justify-content-end" style="display:flex; flex-wrap:nowrap; white-space:nowrap;">
                           <li class="nav-item">
                               <a href="{{ route('home') }}" class="nav-link">Home</a>
                           </li>
                           {{--
                             <li class="nav-item dropdown submenu">
                               <a href="{{ route('destination') }}" class="nav-link">Destination</a>
                           <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink1" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                           <div class="dropdown-menu submenu-content" aria-labelledby="navbarDropdownMenuLink1">
                               <div class="d-lg-flex mega-menu m-auto flex-column">
                                   <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 mb-40px md-mb-25px xs-mb-15px">
                                       @foreach($destinations->chunk(8) as $chunk)
                                       @foreach($chunk as $dest)
                                       <div class="col">
                                           <a href="{{ route('tour') }}?slug={{ $dest->slug }}" class="text-decoration-none text-dark d-block py-2">
                                               <div class="d-flex align-items-center justify-content-between">
                                                   <div>
                                                       <strong class="fs-14" style="font-size:14px;">{{ $dest->name }}</strong>
                                                   </div>
                                                   <i class="fa-solid fa-angle-right text-muted small"></i>
                                               </div>
                                           </a>
                                       </div>
                                       @endforeach
                                       @endforeach
                                   </div>

                               </div>
                           </div>
                           </li>
                           <li class="nav-item dropdown submenu">
                               <a href="{{ route('experience') }}" class="nav-link">Experiences</a>
                               <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLinkExp" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                               <div class="dropdown-menu submenu-content" aria-labelledby="navbarDropdownMenuLinkExp">
                                   <div class="d-lg-flex mega-menu m-auto flex-column">
                                       <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 mb-40px md-mb-25px xs-mb-15px">
                                           @foreach($experiences->chunk(8) as $chunk)
                                           @foreach($chunk as $exp)
                                           <div class="col">
                                               <a href="{{ route('tour') }}?experience={{ $exp->slug }}" class="text-decoration-none text-dark d-block py-2">
                                                   <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                           <strong class="fs-14" style="font-size:14px;">{{ $exp->name }}</strong>
                                                           <div class="text-muted small" style="font-size:12px;">View packages</div>
                                                       </div>
                                                       <i class="fa-solid fa-angle-right text-muted small"></i>
                                                   </div>
                                               </a>
                                           </div>
                                           @endforeach
                                           @endforeach
                                       </div>
                                   </div>
                               </div>
                           </li>
                           --}}
                           <li class="nav-item dropdown submenu">
                               <a href="{{ route('destination') }}" class="nav-link">Yatra</a>
                               <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink1" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                               <div class="dropdown-menu submenu-content" aria-labelledby="navbarDropdownMenuLink1">
                                   <div class="d-lg-flex mega-menu m-auto flex-column">
                                       <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 mb-40px md-mb-25px xs-mb-15px">
                                           @foreach(($yatraDestinations ?? collect())->chunk(8) as $chunk)
                                           @foreach($chunk as $dest)
                                           <div class="col">
                                               <a href="{{ route('tour') }}?slug={{ $dest->slug }}" class="text-decoration-none text-dark d-block py-2">
                                                   <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                           <strong class="fs-14" style="font-size:10px;">{{ $dest->name }}</strong>
                                                       </div>
                                                       <i class="fa-solid fa-angle-right text-muted small"></i>
                                                   </div>
                                               </a>
                                           </div>
                                           @endforeach
                                           @endforeach
                                       </div>

                                   </div>
                               </div>
                           </li>
                           <li class="nav-item dropdown submenu">
                               <a href="{{ route('destination') }}" class="nav-link">Tours In India</a>
                               <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink1" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                               <div class="dropdown-menu submenu-content" aria-labelledby="navbarDropdownMenuLink1">
                                   <div class="d-lg-flex mega-menu m-auto flex-column">
                                       <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 mb-40px md-mb-25px xs-mb-15px">
                                           @foreach($destinations->chunk(8) as $chunk)
                                           @foreach($chunk as $dest)
                                           <div class="col">
                                               <a href="{{ route('tour') }}?slug={{ $dest->slug }}" class="text-decoration-none text-dark d-block py-2">
                                                   <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                           <strong class="fs-14" style="font-size:14px;">{{ $dest->name }}</strong>
                                                       </div>
                                                       <i class="fa-solid fa-angle-right text-muted small"></i>
                                                   </div>
                                               </a>
                                           </div>
                                           @endforeach
                                           @endforeach
                                       </div>

                                   </div>
                               </div>
                           </li>
                           <li class="nav-item dropdown submenu">
                               <a href="{{ route('tour')}}" class="nav-link">International Tours</a>
                               <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownIntl" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                               <div class="dropdown-menu submenu-content" aria-labelledby="navbarDropdownIntl">
                                   <div class="d-lg-flex mega-menu m-auto flex-column">
                                       <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 mb-40px md-mb-25px xs-mb-15px">
                                           @foreach($internationalPackages->chunk(8) as $chunk)
                                           @foreach($chunk as $pkg)
                                           <div class="col">
                                               <a href="{{ route('tour.view', ['slug' => $pkg->slug]) }}" class="text-decoration-none text-dark d-block py-2">
                                                   <div class="d-flex align-items-center justify-content-between">
                                                       <div>
                                                           <strong class="fs-14" style="font-size:10px;">{{ $pkg->title }}</strong>
                                                       </div>
                                                       <i class="fa-solid fa-angle-right text-muted small"></i>
                                                   </div>
                                               </a>
                                           </div>
                                           @endforeach
                                           @endforeach
                                       </div>
                                   </div>
                               </div>
                           </li>


                           <li class="nav-item">
                               <a href="{{ route('blog') }}" class="nav-link">Blogs</a>
                           </li>
                           <li class="nav-item">
                               <a href="{{ route('about') }}" class="nav-link">About Us</a>
                           </li>



                           <li class="nav-item">
                               <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                           </li>

                       </ul>
                   </div>
               </div>
               <div class="col-auto text-end">
                   <div class="col-auto col-lg-2 text-end position-relative">
                       <div class="header-icon d-flex align-items-center justify-content-end">

                           <!-- SEARCH ICON -->
                           <div class="header-search-icon icon me-3">
                               <a href="#" class="header-search-form" wire:click.prevent="toggleDestinationSearch">
                                   <i class="feather icon-feather-search"></i>
                               </a>

                               @if($showDestinationSearch)
                               <div class="search-overlay">

                                   <!-- Close Button -->
                                   <button type="button" class="search-close-btn" wire:click.prevent="toggleDestinationSearch">
                                       &times;
                                   </button>

                                   <!-- Search Box -->
                                   <div class="search-container">

                                       <h2 class="search-title">Find Destination Packages</h2>

                                       <!-- Input -->
                                       <div class="search-input-wrapper">
                                           <i class="feather icon-feather-search"></i>
                                           <input
                                               type="text"
                                               placeholder="Search destinations like Goa, Manali..."
                                               wire:model.live.debounce.300ms="destinationSearch"
                                               class="search-input"
                                               autocomplete="off">
                                       </div>

                                       <!-- Results -->
                                       <div class="search-results">
                                           @if(strlen(trim($destinationSearch)) >= 2 && count($destinationPackages))
                                           @foreach($destinationPackages as $pkg)
                                           <a href="{{ route('tour.view', ['slug' => $pkg->slug]) }}" class="search-item">
                                               <div>
                                                   <div class="search-item-title">{{ $pkg->title }}</div>
                                               </div>
                                               <i class="feather icon-feather-arrow-right"></i>
                                           </a>
                                           @endforeach

                                           @elseif(strlen(trim($destinationSearch)) >= 2)
                                           <div class="no-result">No packages found.</div>
                                           @endif
                                       </div>

                                   </div>
                               </div>
                               @endif
                           </div>

                           <!-- PHONE -->
                           <div class="header-search-icon icon">
                               <a href="tel:02228899900">
                                   <i class="feather icon-feather-phone"></i>
                               </a>
                           </div>

                       </div>
                   </div>
               </div>
           </div>
       </nav>

       <style>
           /* Overlay Background */
           .search-overlay {
               position: fixed;
               inset: 0;
               background: rgba(0, 0, 0, 0.6);
               backdrop-filter: blur(6px);
               z-index: 9999;
               display: flex;
               align-items: center;
               justify-content: center;
               overflow-y: auto;
               padding: 20px;
           }

           /* Container */
           .search-container {
               width: 100%;
               max-width: 600px;
               background: #fff;
               border-radius: 12px;
               padding: 30px;
               box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
               animation: fadeIn 0.3s ease;
           }

           /* Title */
           .search-title {
               text-align: center;
               font-weight: 600;
               margin-bottom: 20px;
           }

           /* Input */
           .search-input-wrapper {
               position: relative;
           }

           .search-input-wrapper i {
               position: absolute;
               left: 15px;
               top: 50%;
               transform: translateY(-50%);
               color: #888;
           }

           .search-input {
               width: 100%;
               padding: 12px 15px 12px 40px;
               border-radius: 8px;
               border: 1px solid #ddd;
               outline: none;
               transition: 0.2s;
           }

           .search-input:focus {
               border-color: #000;
           }

           /* Results */
           .search-results {
               margin-top: 15px;
               max-height: 300px;
               overflow-y: auto;
           }

           /* Item */
           .search-item {
               display: flex;
               justify-content: space-between;
               align-items: center;
               padding: 12px;
               border-radius: 8px;
               text-decoration: none;
               color: #333;
               transition: 0.2s;
           }

           .search-item:hover {
               background: #f5f5f5;
           }

           /* Title */
           .search-item-title {
               font-weight: 500;
           }

           /* Sub */
           .search-item-sub {
               font-size: 12px;
               color: #888;
           }

           /* No Result */
           .no-result {
               padding: 12px;
               text-align: center;
               color: #999;
           }

           /* Close Button */
           .search-close-btn {
               position: fixed;
               top: 30px;
               right: 40px;
               font-size: 30px;
               color: #fff;
               background: none;
               border: none;
               cursor: pointer;
           }

           body.search-open {
               overflow: hidden !important;
           }

           /* Animation */
           @keyframes fadeIn {
               from {
                   opacity: 0;
                   transform: translateY(20px);
               }

               to {
                   opacity: 1;
                   transform: translateY(0);
               }
           }
       </style>

       @if($showDestinationSearch)
           <script>document.body.classList.add('search-open');</script>
       @else
           <script>document.body.classList.remove('search-open');</script>
       @endif
   </header>
