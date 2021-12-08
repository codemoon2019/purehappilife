@include('incs.header')

@yield('section')
 <!-- bread crumb start -->
 <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">contact us</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- bread crumb end -->
    <!-- contact-section start -->
    <section class="contact-section pt-6rem pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 mb-5">
                    <!--  contact page side content  -->
                    <div class="contact-page-side-content">
                        <h3 class="contact-page-title">Contact Us</h3>
                        <p class="contact-page-message mb-30">Dont hesitate to send us a message if you have a concern or question to us out support are online 24/7.</p>
                        <!--  single contact block  -->

                        <div class="single-contact-block">
                            <h4><i class="fa fa-fax"></i> Address</h4>
                            <p>Bario San Roque, Tala Caloocan City</p>
                        </div>

                        <!--  End of single contact block -->

                        <!--  single contact block -->

                        <div class="single-contact-block">
                            <h4><i class="fa fa-phone"></i> Phone</h4>
                            <p>
                                <a href="tel:123456789">Mobile: (+639) 23 447 6552</a>
                            </p>
                        </div>

                        <!-- End of single contact block -->

                        <!--  single contact block -->

                        <div class="single-contact-block">
                            <h4><i class="fas fa-envelope"></i> Email</h4>
                            <p>
                                <a href="mailto:yourmail@domain.com">cs@cartsygallery.ph</a>
                            </p>
                        </div>

                        <!--=======  End of single contact block  =======-->
                    </div>

                    <!--=======  End of contact page side content  =======-->

                </div>
                <div class="col-lg-6 col-12 mb-5">
                    <!--  contact form content -->
                    <div class="contact-form-content">
                        <h3 class="contact-page-title">Tell Us Your Message</h3>
                        <div class="contact-form">
                            <form id="contact-form" action="/home/send-email" method="post">
                                <div class="form-group">
                                    <label>Your Name <span class="required">*</span></label>
                                    <input type="text" id="txtCustomerName" name="txtCustomerName" required="">
                                </div>
                                <div class="form-group">
                                    <label>Your Email <span class="required">*</span></label>
                                    <input type="email" id="txtEmail" name="txtEmail" required="">
                                </div>
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" id="txtSubject" name="txtSubject" required="">
                                </div>
                                <div class="form-group">
                                    <label>Your Message</label>
                                    <textarea id="txtMessage" name="txtMessage" required=""></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" value="submit" id="submit" class="btn btn-dark3" name="submit">submit</button>
                                </div>
                            </form>
                        </div>
                        <p class="form-messege pt-10 pb-10 mt-10 mb-10"></p>
                    </div>
                    <!-- End of contact -->
                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->
@include('incs.footer')
<script>
    $(document).on('submit', '#contact-form', function(e){
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
                        html: 'Please wait while sending your message ...',
                        willOpen: () => {
                          Swal.showLoading()
                        },
                    })

                },
                success:function(data)
                {

                    $('#contact-form')[0].reset();
                    Swal.fire({
                        icon: 'success',
                        text: 'Message sent successfully!',
                    })
                  

                }
              });
    })
</script>