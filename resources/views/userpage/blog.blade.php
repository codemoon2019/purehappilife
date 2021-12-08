@include('incs.header')

@yield('section')

  <!-- bread crumb start -->
  <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Our Gallery</li>
                    </ol>
                </div>
                <div class="col-6 text-right">
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
                    <div class="col-6">
                        <div class="section-title pb-4 pb-md-4 position-relative">
                            <h2 class="title">From Our Gallery </h2>
                            <p class="text">The latest post topics</p>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Post</button>
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
                                    <img src="{{ $blog->image_url }}" alt="blog-thumb-naile">
                                </a>
                                <div class="blog-post-content">
                                    <h5 class="sub-title"> Posted by <a class="blog-link" href="
                                    @if(auth::check())
                                        {{ config('app.url') }}/home/single-blog/{{ $blog->id }}
                                    @endif
                                    @if(!auth::check())
                                        {{ config('app.url') }}/single-blog/{{ $blog->id }}
                                    @endif
                                    ">Art Gallery</a> <span class="separator">/</span>{{ $blog->created_at->diffForHumans() }}<span class="separator"></h5>
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

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <form action="/home/create-website-blog" id="create-blog" method="POST" enctype="multipart/form-data">
													<div class="row">
														<div class="col-lg-12">
															<label>Subject:</label>
															<input type="text" class="form-control validate-field" error-message="First name is required" name="txtSubject" id="txtSubject">
															<span class="error-message text-center"></span>
														</div>
														<div class="col-lg-12">
															<label>Primary Image:</label>
															<input type="file" class="form-control validate-field" error-message="Last name is required" name="txtFile" id="txtFile">
															<span class="error-message text-center"></span>
														</div>
													</div>

													<div class="row">
														<div class="col-lg-12">
															<label>Subject:</label>
															<textarea class="form-control ckeditor" id="txtBlogDescription" name="txtBlogDescription" placeholder="Message" rows="10" cols="10"></textarea>
														</div>
													</div>
											
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
													<button type="submit" class="btn btn-primary btn-create-blog">Create</button>
												</div>
												</form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

          
          $(document).ready(function(){

                let ckEditor = CKEDITOR;
                var blogDescription = ckEditor.instances['txtBlogDescription'];

                $('#create-blog').submit(function(event){
                        event.preventDefault();
                        submit = true;
                        var form = $(this);
                        var formData = new FormData(this);
                        formData.append('txtDescription', blogDescription.getData());
                        var url = form.attr('action');
                        if(validateFields() == 0){
                        $.ajaxSetup({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: formData,
                            cache:false,
                            contentType: false,
                            processData: false,
                            beforeSend:function(){

                                Swal.fire({
                                    html: 'Please wait while creating new product ...',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    willOpen: () => {
                                    Swal.showLoading()
                                    },
                                })

                            },
                            success:function(data)
                            {

                                $('#create-blog')[0].reset();
                                blogDescription.setData('');
                                Swal.fire({
                                    icon: 'success',
                                    text: data.internalMessage,
                                })
                                location.reload();

                            }
                        });
                    }else{
                        return false;
                    }
                });

                    
                $(document).on('keyup change', '.validate-field', function(){
                    if(submit != false){
                        validateFields();
                    }
                })


                function validateFields(){

                    for(var i = 0, countError = 0, inputFieldsCount = $('.validate-field').length; i < inputFieldsCount; i++){
                        
                        var errorMessage = document.getElementsByClassName("validate-field")[i].getAttribute("error-message");
                        if(document.getElementsByClassName("validate-field")[i].value == ""){
                            countError += 1;
                            document.getElementsByClassName("validate-field")[i].style.border = "1px solid red";
                            document.getElementsByClassName("error-message")[i].textContent = errorMessage;
                        }else{
                            document.getElementsByClassName("validate-field")[i].style.border = "1px solid #e3e3e3";
                            document.getElementsByClassName("error-message")[i].textContent = "";
                        }
                        
                    }

                    return countError;

                }


        });
            
   </script>