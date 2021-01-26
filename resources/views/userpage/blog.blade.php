@include('incs.header')

@yield('section')

  <!-- bread crumb start -->
  <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Our Blogs</li>
                    </ol>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-success btn-donate-button" data-toggle="modal" data-target="#donate-modal">Donate for a cause</button>
                </div>
            </div>
        </div>
    </nav>
    <!-- bread crumb end -->
    <!-- blog-section start -->
    <section class="blog-section pb-5">
        <div class="container">
            <div class="border-bottom cbb1 mb-3rem">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title pb-4 pb-md-4 position-relative">
                            <h2 class="title">From Our Blog </h2>
                            <p class="text">The latest news, videos, and discussion topics</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($blogs->count() == 0)
                    <div class="col-lg-12 text-center">
                        No blog available
                    </div>
                @endif
                @if($blogs->count() != 0)
                    @foreach($blogs as $blog)
                        <div class="col-12 col-md-6 col-xl-4 mb-3rem">
                            <div class="single-blog text-left">
                                <a class="blog-thumb zoom-in d-block overflow-hidden" href="
                                    @if(auth::check())
                                        {{ config('app.url') }}/home/single-blog/{{ $blog->id }}
                                    @endif
                                    @if(!auth::check())
                                        {{ config('app.url') }}/single-blog/{{ $blog->id }}
                                    @endif
                                ">
                                    <img src="{{ config('app.api_url') }}{{ $blog->image_url }}" alt="blog-thumb-naile">
                                </a>
                                <div class="blog-post-content">
                                    <h5 class="sub-title"> Posted by <a class="blog-link" href="
                                    @if(auth::check())
                                        {{ config('app.url') }}/home/single-blog/{{ $blog->id }}
                                    @endif
                                    @if(!auth::check())
                                        {{ config('app.url') }}/single-blog/{{ $blog->id }}
                                    @endif
                                    ">Pure PH</a> <span class="separator">/</span>{{ $blog->created_at->diffForHumans() }}<span class="separator"></h5>
                                    <h3 class="title"><a href="
                                    @if(auth::check())
                                        {{ config('app.url') }}/home/single-blog/{{ $blog->id }}
                                    @endif
                                    @if(!auth::check())
                                        {{ config('app.url') }}/single-blog/{{ $blog->id }}
                                    @endif
                                    ">{{ $blog->subject }}</a></h3>
                                    <p class="text">
                                        {!! \Illuminate\Support\Str::limit(html_entity_decode($blog->description), 50, $end='...') !!}
                                    </p>
                                    <a class="read-more" href="
                                    @if(auth::check())
                                        {{ config('app.url') }}/home/single-blog/{{ $blog->id }}
                                    @endif
                                    @if(!auth::check())
                                        {{ config('app.url') }}/single-blog/{{ $blog->id }}
                                    @endif
                                    ">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach          
                @endif    
            </div>
        </div>
    </section>
    <!-- blog-section end -->
    @include('incs.footer')
	<!-- first modal -->
	<div class="modal fade" id="donate-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-body text-center">
                <h4 class="sub-title">Donating to help people in the Philippines</h4>
                <div class="col-lg-12">
                    <label><strong>Bank Information:</strong> <br> (BDO) 006781079084 | Rodel N. Tabunot</label>
                </div>
                <!--<div class="row">
                    <div class="col-lg-12" style="margin-top:10px;">
                        <input type="number" id="txtDonation" class="form-control">
                    </div>
                    <div class="col-lg-12"  style="margin-top:10px;">
                        <div id="paypal-button-donation"></div>
                    </div>
                </div>-->

            </div>
         </div>
      </div>
   </div>


   <script>
   
        //var totalPrice = $('#txtTotalPrice').val() / 52;
        paypal.Buttons({
            createOrder: function(data, actions) {
              // This function sets up the details of the transaction, including the amount and line item details.
              return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: $('#txtDonation').val()
                  }
                }]
              });
    
            },
            onApprove: function(data, actions) {
              // This function captures the funds from the transaction.
              return actions.order.capture().then(function(details) {
                alert(details);
                /*Swal.fire({
                    icon: data.success == true ? 'success' : 'warning',
                    text: data.messages,
                });*/
              });
            }
          }).render('#paypal-button-donation');
          //This function displays Smart Payment Buttons on your web page.
    
   </script>