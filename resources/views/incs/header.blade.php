<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <meta http-equiv="X-UA-Compatible" content="ie=edge" />
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <meta name="app_url" content="{{ config('app.url') }}">
   <meta name="shop_url" content="{{ Auth::check() == true ? config('app.url').'/home/shop/shop-list' : config('app.url').'/shop-list' }}">
   @if(Auth::check())
   <meta name="site_visitor_number" content="{{ auth()->user()->id }}">
   @endif
   <title>{{ 'Cartsy Gallery' }}</title>
   <meta name="description" content="" />
   <link rel="shortcut icon" type="image/x-icon" href="{{ config('app.url') }}/assets/img/logo/logo.png" />
   @include('incs.header_file')


</head>
<body>

      <div id="fb-root"></div>
      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution="setup_tool"
        page_id="104247884474180">
      </div>

   <div class="offcanvas-overlay"></div>
   <div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
      <div class="border-bottom mb-4 pb-4 text-right">
         <button class="offcanvas-close">×</button>
      </div>

      <div class="offcanvas-head mb-4 pb-2">
         <div class="static-info py-3 px-2 text-center">
            <p class="text-dark">Welcome you to Pure store!</p>
         </div>
         <nav class="offcanvas-top-nav">
          
         </nav>
      </div>
      <nav class="offcanvas-menu">
      @if(Auth::check())
        <ul>
            <li><a href="/home"><span class="menu-text">Home</span></a></li>
            <li><a href="/home/shop"><span class="menu-text">Shop</span></a></li>
            <li><a href="/home/blog"><span class="menu-text">Blog</span></a></li>
            <li><a href="/home/contactus"><span class="menu-text">Contact Us</span></a></li>
            <li><a href="/home/about"><span class="menu-text">About Us</span></a></li>
        </ul>
      @endif
      @if(!Auth::check())
        <ul>
            <li><a href="/"><span class="menu-text">Home</span></a></li>
            <li><a href="/shop"><span class="menu-text">Shop</span></a></li>
            <li><a href="/blog"><span class="menu-text">Blog</span></a></li>
            <li><a href="/contactus"><span class="menu-text">Contact Us</span></a></li>
            <li><a href="/about"><span class="menu-text">About Us</span></a></li>
            <li><a href="/login"><span class="menu-text">Sign in</span></a></li>
            <li><a href="/register"><span class="menu-text">Register</span></a></li>
        </ul>
      @endif
      </nav>
      <div class="offcanvas-social mt-30">
         <ul>
            <li>
               <a href="#"><i class="icon-social-facebook"></i></a>
            </li>
         </ul>
      </div>
   </div>
   <!-- offcanvas-mobile-menu end -->
   <!-- header start -->
   <header>
      <!-- header top start -->
      <div class="header-top border-bottom ht-nav-br-bottom bg-light py-10 d-none d-lg-block">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-4">
                  <div class="static-info">
                     <p class="text-dark">Welcome you to Cartsy Gallery!</p>
                  </div>
               </div>
               <div class="col-lg-8">
                  <nav class="header-top-nav">
                     <ul class="d-flex justify-content-end align-items-center">
                        @if(Auth::check())
                        <li>
                           <a href="/chatify" target="_blank">
                           <i class="fa fa-comments"></i> Messenger</a>
                        <span class="separator">|</span>
                        </li>
                        @endif
                        @if(Auth::check() && auth()->user()->type != 'Artist')
                        <li>
                           <a href="/home/wishlist">
                              <i class="ion-android-favorite-outline"></i> Wishlist <span id="total-wishlist">({{ auth()->user()->userWishlist->count() }})</span></a>
                           <span class="separator">|</span>
                        </li>
                        @endif
                        @if(Auth::check() && auth()->user()->type != 'Artist')
                        <li>
                           <a href="/home/my-orders">
                              <i class="ion-android-cart"></i> My Orders</a>
                           <span class="separator">|</span>
                        </li>
                        @endif
                        <li class="english">
                           <a href="#" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="ion-ios-contact-outline"></i><strong> Welcome, </strong> 
                              @if(!Auth::check())
                                 Guest  
                              @endif
                              @if(Auth::check())
                                 {{ auth()->user()->first_name }}
                              @endif
                              <i class="ion ion-ios-arrow-down"></i></a>
                              <ul class="topnav-submenu dropdown-menu" aria-labelledby="dropdown1">
                              @if(!Auth::check())
                                <li><a href="/login">Login</a></li>
                                <li><a href="/register">Sign up</a></li>
                              @endif
                              @if(Auth::check())
                                 <li><a href="/home/my-profile">My Profile</a></li>
                                 <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a></li>
                              @endif
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 {{ csrf_field() }}
                              </form>
                              </ul>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <!-- header top end -->
      <!-- header-middle satrt -->
      <div class="header-middle py-3rem">
         <div class="container">
            <div class="row align-items-center d-lg-none">
               <div class="col-4">
                  <nav class="header-top-nav d-flex align-items-center">
                     <ul>
                        @if(Auth::check())
                        <li class="mr-4"> <a href="#" id="dropdown4" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false"><i class="ion-ios-contact"></i></a>
                           <ul class="topnav-submenu dropdown-menu" aria-labelledby="dropdown4">
                              <li><a href="/home/my-profile">My Profile</a></li>
                              <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a></li>
                           </ul>
                        </li>
                        @endif
                     </ul>
                     <div class="cart-block position-relative">
                        @if(!Auth::check())
                        <a href="#">
                           <span class="position-relative">
                              <i class="ion-bag"></i>
                              <span class="badge badge-light cb1 total-cart-item">{{ number_format( \App\Models\GuestCart::where('guest_id', request()->cookie('purehappilife_session') )->sum('quantity') ) }}</span>
                           </span>
                        </a>
                        @endif
                        @if(!Auth::check())
                        <div class="small-cart">
                           <div class="small-cart-item">

                              <div class="cart-item-list">
                              </div>

                           </div>
                        </div>
                        @endif
                        @if(Auth::check())
                        <a href="#">
                           <span class="position-relative">
                              <i class="ion-bag"></i>
                              <span class="badge badge-light cb1 total-cart-item">{{ number_format(auth()->user()->userCart->sum('quantity')) }}</span>
                           </span>
                        </a>
                        @endif
                        @if(Auth::check())
                        <div class="small-cart">
                           <div class="small-cart-item">

                              <div class="cart-item-list">
                              </div>

                           </div>
                        </div>
                        @endif
                     </div>
                  </nav>
               </div>
               <div class="col-4 text-center">
                  <div class="logo mt-3 mb-2rem">
                     <a href="/"><img src="{{ config('app.url') }}/assets/img/logo/logo.png" alt="logo"></a>
                  </div>
               </div>
               <!-- mobile-menu-toggle start -->
               <div class="col-4 text-right">
                  <div class="mobile-menu-toggle">
                     <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                        <svg viewBox="0 0 800 600">
                           <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                              id="top"></path>
                           <path d="M300,320 L540,320" id="middle"></path>
                           <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                              id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                        </svg>
                     </a>
                  </div>
               </div>
               <!-- mobile-menu-toggle end -->
            </div>
            <div class="row align-items-center">
               <div class="col-lg-3 d-none d-lg-block">
                  <div class="logo">
                     <a href="/"><img src="{{ config('app.url') }}/assets/img/logo/logo.png" alt="logo"></a>
                  </div>
               </div>
               <div class="col-lg-9">
                  <div
                     class="search-form-wrapper mb-2rem mb-lg-0 pl-lg-5 d-flex align-items-center justify-content-between">
                     <div class="search-form search-form-res">
                        <form class="form-inline position-relative" action="{{ Auth::check() == true ? config('app.url').'/home/shop/shop' : config('app.url').'/shop' }}" method="GET">
                           <input class="form-control border-blue" type="search" name="search"
                              placeholder="Search a product ..."
                              
                              @isset($search)
                                 value='{{ $search }}'
                              @endisset
                              
                              >
                           <button class="btn bg-primary search-btn" type="submit"><i
                                 class="ion-ios-search-strong"></i></button>
                        </form>
                     </div>
                     <!-- search-form end -->
                     <div class="media static-media d-none d-lg-flex">
                        <img class="mr-3" src="{{ config('app.url') }}/assets/img/icon/6.png" alt="icon">
                        <div class="media-body">
                           <div class="phone">
                              <strong class="text-dark">Call us:</strong>
                              <a href="#" class="text-primary">cs@cartsygallery.ph</a>
                           </div>
                           <div class="email">
                              <a href="#" class="text-dark">(+639) 23 447 6552</a>
                           </div>
                        </div>
                     </div>
                     <!-- static-media end -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- header-middle end -->
      <!-- header bottom start -->
      <nav class="header-bottom nav-style1 bg-primary d-none d-lg-block">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-12 d-flex flex-wrap align-items-center">
                  <ul class="main-menu d-flex">
                     @if(Auth::check())
                     <li class="@if(Illuminate\Support\Str::contains(Request::url(), ['shop', 'blog', 'contactus', 'about']) == false) active @endif ml-0">
                           <a href="/home">Home</a>
                     </li>
                     @endif
                     @if(!Auth::check())
                     <li class="@if(Illuminate\Support\Str::contains(Request::url(), ['shop', 'blog', 'contactus', 'about']) == false) active @endif ml-0">
                           <a href="/">Home</a>
                     </li>
                     @endif
                     @if(Auth::check())
                     <li class="@if(Illuminate\Support\Str::contains(Request::url(), ['shop'])) active @endif">
                        <a href="/home/shop">Shop</a>
                     </li>
                     @endif
                     @if(!Auth::check())
                     <li class="@if(Illuminate\Support\Str::contains(Request::url(), ['shop'])) active @endif">
                        <a href="/shop">Shop</a>
                     </li>
                     @endif
                     @if(Auth::check() && auth()->user()->type == 'Artist')
                     <li class="@if(Illuminate\Support\Str::contains(Request::url(), ['blog'])) active @endif">
                        <a href="/home/blog">Gallery </a>
                     </li>
                     @endif
                     @if(Auth::check())
                     <li class="@if(Illuminate\Support\Str::contains(Request::url(), ['contactus'])) active @endif">
                        <a href="/home/contactus">contact Us</a>
                     </li>
                     @endif
                     @if(!Auth::check())
                     <li class="@if(Illuminate\Support\Str::contains(Request::url(), ['contactus'])) active @endif">
                        <a href="/contactus">contact Us</a>
                     </li>
                     @endif
                     @if(Auth::check())
                     <li class="@if(Illuminate\Support\Str::contains(Request::url(), ['about'])) active @endif">
                        <a href="/home/about">about Us</a>
                     </li>
                     @endif
                     @if(!Auth::check())
                     <li class="@if(Illuminate\Support\Str::contains(Request::url(), ['about'])) active @endif">
                        <a href="/about">about Us</a>
                     </li>
                     @endif
                  </ul>
                  <div class="cart-block position-relative text-right ml-auto">
                     
                     @if(!Auth::check())
                        <a href="#">
                           <span class="position-relative">
                              <i class="ion-bag"></i>
                              <span class="badge badge-light cb1 total-cart-item" id="total-cart-item">{{ number_format( \App\Models\GuestCart::where('guest_id', request()->cookie('purehappilife_session') )->sum('quantity') ) }}</span>
                           </span> 
                           <span class="cart-total-price">₱ {{ number_format(\App\Models\GuestCart::where('guest_id', request()->cookie('purehappilife_session') )->sum('total_price')) }}</span>
                        </a>
                     @endif
                     @if(Auth::check())
                        <a href="#">
                           <span class="position-relative">
                              <i class="ion-bag"></i>
                              <span class="badge badge-light cb1 total-cart-item" id="total-cart-item">{{ number_format(auth()->user()->userCart->sum('quantity')) }}</span>
                           </span> 
                           <span class="cart-total-price">₱ {{ number_format(auth()->user()->userCart->sum('total_price')) }}</span>
                        </a>
                     @endif
                     <div class="small-cart">
                              <div class="small-cart-item">
                                 <div class="cart-item-list">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </nav>
                  </div>
                  </div>
                  <!-- cart block end -->
               </div>
            </div>
         </div>
      </nav>
      <!-- header bottom end -->
   </header>