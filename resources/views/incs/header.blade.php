<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <meta http-equiv="X-UA-Compatible" content="ie=edge" />
   <meta name="description" content="" />
   <title>Pure Happilife</title>
   <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico" />
   @include('incs.header_file')
</head>
<body>

     <!-- offcanvas-overlay start -->
     <div class="offcanvas-overlay"></div>
   <!-- offcanvas-overlay end -->
   <!-- offcanvas-mobile-menu start -->
   <div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
      <div class="border-bottom mb-4 pb-4 text-right">
         <button class="offcanvas-close">×</button>
      </div>

      <div class="offcanvas-head mb-4 pb-2">
         <div class="static-info py-3 px-2 text-center">
            <p class="text-dark">Welcome you to Drama store!</p>
         </div>
         <nav class="offcanvas-top-nav">
          
         </nav>
      </div>
      <nav class="offcanvas-menu">
        <ul>
            <li><a href="/"><span class="menu-text">Home</span></a></li>
            <li><a href="#"><span class="menu-text">Shop</span></a></li>
            <li><a href="#"><span class="menu-text">Blog</span></a></li>
            <li><a href="#"><span class="menu-text">Contact Us</span></a></li>
        </ul>
      </nav>
      <div class="offcanvas-social mt-30">
         <ul>
            <li>
               <a href="#"><i class="icon-social-facebook"></i></a>
            </li>
            <li>
               <a href="#"><i class="icon-social-twitter"></i></a>
            </li>
            <li>
               <a href="#"><i class="icon-social-instagram"></i></a>
            </li>
            <li>
               <a href="#"><i class="icon-social-google"></i></a>
            </li>
            <li>
               <a href="#"><i class="icon-social-instagram"></i></a>
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
                     <p class="text-dark">Welcome you to Pure Happilife!</p>
                  </div>
               </div>
               <div class="col-lg-8">
                  <nav class="header-top-nav">
                     <ul class="d-flex justify-content-end align-items-center">
                        <li>
                           <a href="wishlist.html">
                              <i class="ion-android-favorite-outline"></i> Wishlist <span>(0)</span></a>
                           <span class="separator">|</span>
                        </li>
                        <li class="english">
                           <a href="#" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="ion-ios-contact-outline"></i><strong> Welcome, </strong> Guest  <i class="ion ion-ios-arrow-down"></i></a>
                              <ul class="topnav-submenu dropdown-menu" aria-labelledby="dropdown1">
                                <li><a href="/login">Login</a></li>
                                <li><a href="/register">Sign up</a></li>
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
                        <li class="mr-4"> <a href="#" id="dropdown4" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false"><i class="ion-ios-contact"></i></a>
                           <ul class="topnav-submenu dropdown-menu" aria-labelledby="dropdown4">
                              <li><a href="myaccount.html">My account</a></li>
                              <li><a href="checkout.html">Checkout</a></li>
                              <li><a href="login.html">Sign out</a></li>
                           </ul>
                        </li>
                     </ul>
                     <div class="cart-block position-relative">
                        <a href="/cart">
                           <span class="position-relative">
                              <i class="ion-bag"></i>
                              <span class="badge badge-light cb1">3</span>
                           </span>
                        </a>
                        <div class="small-cart">
                           <div class="small-cart-item">
                              <div class="single-item">
                                 <div class="image">
                                    <a href="single-product.html">
                                       <img src="assets/img/cart-img/1.jpg" class="img-fluid" alt="">
                                    </a>
                                    <span class="badge badge-primary cb2">2x</span>
                                 </div>
                                 <div class="cart-content">
                                    <p class="cart-name"><a href="single-product.html">New Balance Fresh Foam Kaymin</a>
                                    </p>
                                    <p class="cart-quantity">$18.90</p>
                                    <p class="cart-color">color: <span>white</span></p>
                                 </div>
                                 <a href="#" class="remove-icon"><i class="ion-close-round"></i></a>
                              </div>
                           </div>
                           <div class="cart-table">
                              <table class="table m-0">
                                 <tbody>
                                    <tr>
                                       <td class="text-left">Subtotal:</td>
                                       <td class="text-right"><span>$129.00</span></td>
                                    </tr>
                                    <tr>
                                       <td class="text-left">Shipping:</td>
                                       <td class="text-right"><span>$4.00</span></td>
                                    </tr>
                                    <tr>
                                       <td class="text-left">Taxes:</td>
                                       <td class="text-right"><span>$25.80</span></td>
                                    </tr>
                                    <tr>
                                       <td class="text-left">Total:</td>
                                       <td class="text-right"><span>$158.80</span></td>
                                    </tr>
                                 </tbody>
                              </table>
                              <div class="cart-buttons pt-5">
                                 <a href="checkout.html" class="btn btn-primary btn-block rounded">Checkout</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </nav>
               </div>
               <div class="col-4 text-center">
                  <div class="logo mt-3 mb-2rem">
                     <a href="index.html"><img src="assets/img/logo/logo-dark.jpg" alt="logo"></a>
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
                     <a href="index.html"><img src="assets/img/logo/logo-dark.jpg" alt="logo"></a>
                  </div>
               </div>
               <div class="col-lg-9">
                  <div
                     class="search-form-wrapper mb-2rem mb-lg-0 pl-lg-5 d-flex align-items-center justify-content-between">
                     <div class="search-form search-form-res">
                        <form class="form-inline position-relative">
                           <input class="form-control border-blue" type="search"
                              placeholder="Enter your search key ...">
                           <button class="btn bg-primary search-btn" type="submit"><i
                                 class="ion-ios-search-strong"></i></button>
                           <div class="search-form-select">
                              <select class="select">
                                 <option value="0">All categories</option>
                                 <option value="12"> Women’s Clothing </option>
                              </select>
                           </div>
                        </form>
                     </div>
                     <!-- search-form end -->
                     <div class="media static-media d-none d-lg-flex">
                        <img class="mr-3" src="assets/img/icon/6.png" alt="icon">
                        <div class="media-body">
                           <div class="phone">
                              <strong class="text-dark">Call us:</strong>
                              <a href="tel:+1(123)8889999" class="text-primary">+1(123)8889999</a>
                           </div>
                           <div class="email">
                              <a href="mailto:demo@hasthemes.com" class="text-dark">demo@hasthemes.com</a>
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
      <nav id="sticky" class="header-bottom nav-style1 bg-primary d-none d-lg-block">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-12 d-flex flex-wrap align-items-center">
                  <ul class="main-menu d-flex">
                     <li class="active ml-0">
                        <a href="/">Home</a>
                     </li>
                     <li class="position-static">
                        <a href=" #">Shop</a>
                     </li>
                     <li>
                        <a href="#">Blog </a>
                     </li>
                     <li><a href="contact.html">contact Us</a></li>
                  </ul>
                  <div class="cart-block position-relative text-right ml-auto">
                     <a href="/cart">
                        <span class="position-relative">
                           <i class="ion-bag"></i>
                           <span class="badge badge-light cb1">1</span>
                        </span> $0.00
                     </a>
                     <div class="small-cart">
                        <div class="small-cart-item">
                           <div class="single-item">
                              <div class="image">
                                 <a href="single-product.html">
                                    <img src="assets/img/cart-img/1.jpg" class="img-fluid" alt="">
                                 </a>
                                 <span class="badge badge-primary cb2">2x</span>
                              </div>
                              <div class="cart-content">
                                 <p class="cart-name"><a href="single-product.html">New Balance Fresh Foam Kaymin</a>
                                 </p>
                                 <p class="cart-quantity">$18.90</p>
                                 <p class="cart-color">color: <span>white</span></p>
                              </div>
                              <a href="#" class="remove-icon"><i class="ion-close-round"></i></a>
                           </div>
                        </div>
                        <div class="cart-table">
                           <table class="table m-0">
                              <tbody>
                                 <tr>
                                    <td class="text-left">Subtotal:</td>
                                    <td class="text-right"><span>$129.00</span></td>
                                 </tr>
                                 <tr>
                                    <td class="text-left">Shipping:</td>
                                    <td class="text-right"><span>$4.00</span></td>
                                 </tr>
                                 <tr>
                                    <td class="text-left">Taxes:</td>
                                    <td class="text-right"><span>$25.80</span></td>
                                 </tr>
                                 <tr>
                                    <td class="text-left">Total:</td>
                                    <td class="text-right"><span>$158.80</span></td>
                                 </tr>
                              </tbody>
                           </table>
                           <div class="cart-buttons pt-5">
                              <a href="checkout.html" class="btn btn-primary btn-block rounded">Checkout</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- cart block end -->
               </div>
            </div>
         </div>
      </nav>
      <!-- header bottom end -->
   </header>