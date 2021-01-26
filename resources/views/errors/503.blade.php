@include('incs.header')

@yield('section')
  <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                </div>
            </div>
        </div>
    </nav>
    <div class="my-account pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3" style="margin-bottom: 75px;">
                    <a href="#">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <span class="icon">
                                        <ion-icon name="alert-circle-outline"></ion-icon>
                                </span>
                                <h4 class="sub-title">
                                    503 Service Unavailable
                                </h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@include('incs.footer')
