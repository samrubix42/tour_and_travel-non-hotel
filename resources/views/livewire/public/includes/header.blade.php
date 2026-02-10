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
                                                           <strong class="fs-14" style="font-size:14px;">{{ $pkg->title }}</strong>
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
                   <div class="col-auto col-lg-2 text-end d-none d-sm-flex">
                       <div class="header-icon">
                           <div class="header-search-icon icon">
                               <a href="#" class="search-form-icon header-search-form"><i class="feather icon-feather-phone"></i></a>

                           </div>

                       </div>

                   </div>
               </div>
           </div>
       </nav>
   </header>