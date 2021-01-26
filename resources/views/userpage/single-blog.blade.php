@include('incs.header')

@yield('section')
 <!-- bread crumb start -->
 <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">shop</li>
                    </ol>
                </div>
            </div>
        </div>
</nav>
<!-- bread crumb end -->

 <!-- blog-section start -->
 <section class="blog-section pb-6rem">
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
                <div class="col-12">
                    <div class="single-blog text-left">
                        <a class="blog-thumb zoom-in d-block overflow-hidden" href="blog-grid-left-sidebar.html">
                            <img class="object-fit-none" src="{{ config('app.api_url') }}{{  $singleBlog->image_url }}" alt="blog-thumb-naile">
                        </a>
                        <div class="blog-post-content pt-5">
                            <h3 class="title"><a href="
                            @if(auth::check())
                                {{ config('app.url') }}/home/single-blog/{{ $singleBlog->id }}
                            @endif
                            @if(!auth::check())
                                {{ config('app.url') }}/single-blog/{{ $singleBlog->id }}
                            @endif
                            ">{{ $singleBlog->subject }}</a></h3>
                            <h5 class="sub-title font-style-normal"> Posted by <a class="blog-link" href="{{ config('app.url') }}">Pure PH</a></h5>
                            <p class="text">
                                {!! html_entity_decode($singleBlog->description) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog-section end -->


@include('incs.footer')