
       <!-- Preloader Starts -->
       <div class="preloader" id="preloader">
           <div class="preloader-inner">
               <div class="spinner">
                   <div class="bounce1"></div>
                   <div class="bounce2"></div>
                   <div class="bounce3"></div>
               </div>
           </div>
       </div>  

       <!-- header -->
       <header>
           <div class="header-area">
               <!-- info bar -->
               <div class="info-bar d-none d-md-block">
                   <div class="container">
                       <div class="row align-items-center">
                           <div class="col-lg-9">
                               <div class="contact-box">
                                   <span><i class="fas fa-phone-alt"></i> +91 8130495476</span>
                                   <span class="separator">|</span>
                                   <span><i class="icofont-envelope"></i> turtlemaarks@gmail.com</span>
                                   <span class="separator">|</span>
                                   <span><i class="icofont-location-pin"></i> Greater Noida West, Gautam Buddha Nagar, UP-201306</span>
                               </div>
                           </div>
                           <div class="col-lg-3">
                               <div class="lan_wrapper">
                                   <div class="btn-box d-flex align-items-center">
                                       <a class="btn1" href="#" data-toggle="modal" data-target="#bookingModal">Make Appointment</a>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <!-- header-top -->
               <div class="header-top">
                   <div class="container">
                       <div class="container-wrapper">
                           <div class="row align-items-center">
                               <div class="col-lg-2 col-xl-2 col-md-3 col-4">
                                   <div class="logo">
                                       <a href="{{ route('home') }}"> <img src="{{ asset('assets/images/logo.png') }}" style="width:100px;" alt=""></a>
                                   </div>
                               </div>
                               <div class="col-lg-10 col-xl-10 d-none d-lg-block">
                                   <nav id="main-menu">
                                       <ul class="main-menu">
                                           <li><a href="{{ route('home') }}">Home</a> </li>
                                           <li><a href="{{ route('about-us') }}">About us</a></li>
                                           <li class="has-submenu"><a href="javascript:void(0)">Diagnostic Services</a>
                                               <ul class="submenu">
                                                   <li><a href="{{ route('pta-pure-tone-audiometry') }}">PTA (Pure Tone Audiometry)</a></li>
                                                   <li><a href="{{ route('tymp-tympanometry') }}">Tymp (Tympanometry)</a></li>
                                                   <li><a href="{{ route('bera-brain-evoked-response-audiometry') }}">BERA (Brain Evoked Response Audiometry)</a></li>
                                                   <li><a href="{{ route('oae-oto-acoustic-emission') }}">OAE (Oto Acoustic Emission)</a></li>
                                               </ul>
                                           </li>
                                           <li><a href="{{ route('products') }}">Products</a></li>
                                           <li><a href="{{ route('repair') }}">Repair</a></li>
                                           <li><a href="{{ route('gallery') }}">Gallery</a></li>
                                           <li><a href="{{ route('contact-us') }}">Contact us</a></li>
                                       </ul>
                                   </nav>
                               </div>
                           </div>
                           <!-- mobile-menu -->
                           <div class="mobile-menu"></div>
                       </div>
                   </div>
               </div>
           </div>
       </header>