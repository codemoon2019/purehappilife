    
     <section class="news-letter-section bg-primary pt-3rem pb-2rem">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 col-md-6 col-lg-auto mb-3">
                <div class="nletter-title">
                    <h2 class="title">Sign Up For Newsletters</h2>
                    <p class="text">Be the First to Know. Sign up for newsletter today !</p>
                </div>
                </div>
                <div class="col-12 col-md-6 col-lg-auto mb-3">
                <div class="nletter-form">
                    <form id="signup-email" class="form-inline position-relative"

                        @if(auth::check())
                           action="/home/signup-email"
                        @else
                           action="/signup-email"
                        @endif

                        target="_blank" method="post">
                        <input class="form-control" type="email" id="txtSignupEmail" name="txtSignupEmail"  placeholder="Your email address" required>
                        <button class="btn btn-dark nletter-btn" type="submit">Subscribe</button>
                    </form>
                </div>
                </div>
                <div class="col-12 col-md-6 col-lg-auto mb-3">
                <div class="social-network">
                    <ul class="d-flex">
                        <li><a href="https://www.facebook.com/" target="_blank"><span
                                class="ion-social-facebook"></span></a></li>
                        <li><a href="https://www.youtube.com/" target="_blank"><span class="ion-social-youtube"></span></a>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
     </section>
     <footer>
     <div class="footer-bottom pb-5 bg-white">
         <!-- address start -->
      <div class="address py-6rem bg-white">
         <div class="container">
            <div class="row">
               <div class="col-12 col-sm-7 col-md-4 my-3">
                  <div class="address-widget">
                     <div class="media">
                        <span class="address-icon">
                           <i class="ion-ios-location-outline"></i>
                        </span>
                        <div class="media-body">
                           <h4 class="title">Bario San Roque, Tala Caloocan City</h4>
                           <p class="text">Contact Info!</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-5 col-md-4 my-3">
                  <div class="address-widget">
                     <div class="media">
                        <span class="address-icon">
                           <i class="ion-ios-email-outline"></i>
                        </span>
                        <div class="media-body">
                           <h4 class="title"><a href="mailto:HasThemes.com">cs@cartsygallery.ph</a></h4>
                           <p class="text">Orders Support!</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-6 col-md-4 my-3">
                  <div class="address-widget">
                     <div class="media">
                        <span class="address-icon">
                           <i class="ion-ios-telephone-outline"></i>
                        </span>
                        <div class="media-body">
                           <h4 class="title"><a href="tel:+1(123)8889999">(+639) 23 447 6552</a></h4>
                           <p class="text">Free support line!</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- address end -->
         <div class="container">
            <div class="row">
               <div class="col-12 col-sm-6 col-lg-3 mb-5">
                  <div class="footer-widget">
                     <div class="border-bottom cbb1 mb-3rem">
                        <div class="section-title pb-4 pb-md-4 position-relative">
                           <h2 class="title">Information</h2>
                        </div>
                     </div>
                     <ul class="footer-menu">
                        <li><a href="about-us.html">About us</a></li>
                        <li><a href="contact.html">Contact us</a></li>
                     </ul>
                  </div>
               </div>
               
               <div class="col-12 col-sm-6 col-lg-3 mb-5">
                  <div class="footer-widget">
                     <div class="border-bottom cbb1 mb-3rem">
                        <div class="section-title pb-4 pb-md-4 position-relative">
                           <h2 class="title">Products</h2>
                        </div>
                     </div>
                     <ul class="footer-menu">
                        <li><a href="login.html">Login</a></li>
                        <li><a href="myaccount.html">My account</a></li>
                     </ul>
                  </div>
               </div>

               <div class="col-12 col-sm-6 col-lg-3 mb-5">
                  <div class="footer-widget">
                     <div class="border-bottom cbb1 mb-3rem">
                        <div class="section-title pb-4 pb-md-4 position-relative">
                           <h2 class="title">My Account</h2>
                        </div>
                     </div>
                     <ul class="footer-menu">
                        <li><a href="#">Personal info</a></li>
                        <li><a href="#">Orders</a></li>
                     </ul>
                  </div>
               </div>

               <div class="col-12 col-sm-6 col-lg-3 mb-5">
                  <div class="footer-widget">
                     <div class="border-bottom cbb1 mb-3rem">
                        <div class="section-title pb-4 pb-md-4 position-relative">
                           <h2 class="title">Useful Links</h2>
                        </div>
                     </div>
                     <ul class="footer-menu">
                        <li><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                     </ul>
                  </div>
               </div>

            </div>
         </div>
      </div>
      <div class="coppy-right pt-2rem pb-2rem bg-light">
         <div class="container">
            <div class="row">
               <div class="col-12 col-md-6">
                  <div class="text-center text-md-left">
                     <p class="mb-3 mb-md-0">Copyright &copy; <a href="https://hasthemes.com/">Cartsy Gallery</a>. All Rights
                        Reserved</p>
                  </div>
               </div>
               <div class="col-12 col-md-6">
               </div>
            </div>
         </div>
      </div>
   </footer>
   @include('incs.footer_file')
</body>
</html>

<script>
   $('#signup-email').submit(function(e){

      e.preventDefault();
      var formData = new FormData(this);
      var form = $(this);
      var url = form.attr('action');
      $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
                type: "POST",
                url: url,
                data: formData, // serializes the form's elements.\
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){

                    Swal.fire({
                        html: 'Please wait while registering your email ...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                          Swal.showLoading()
                        },
                    })

                },
                success:function(data)
                {
                  if(data.message == 'success'){
                     Swal.fire({
                        icon: 'success',
                        text: 'Subscribed successfully!',
                    })
                  }else{
                     Swal.fire({
                        icon: 'warning',
                        text: 'You are already a subscriber!',
                    })
                  }

                }
              });


   });
</script>