@include('incs.header')

@yield('section')

  <!-- bread crumb start -->
  <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About us</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- bread crumb end -->
  <section class="about-section pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <div class="about-content">
                        <h2 class="title">Why Pure Ionic Magnesium Spray?</h2>
                        <p class="mb-4">
                        Pure ionic magnesium spray delivers superior performance by delivering significant amounts of magnesium chloride and organic sulfur made from israel.
                        </p>
                        <p>
                        Healing of the Water (2kings 2:19-22) Pure Ionic Magnesium Spray was based from the BIBLE that it can heal a lot of lives and keep healthy.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="about-left-image mb-4">
                        <img src="{{ config('app.url') }}/assets/img/slider/11.png" style="height:220px;" alt="img" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-5">
                    <div class="about-info">
                        <h4 class="title">19 The people of the city said to Elisha</h4>
                        <p>
                        "Look, our lord, this town is well situated, as you can see, but the water is bad and the land is unproductive."
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="about-info">
                        <h4 class="title">"Bring me a new bowl."</h4>
                        <p>
                        he said, "and put salt in it." So they brought it to him. <br>
                        21 Then he went out to the spring and threw the salt into it. saying, "This is what the lord says. 'I have healed  this water. Never again will it cause death or make the land unproductive.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="about-info">
                        <h4 class="title">And the water </h4>
                        <p>
                        has remained pure to this day, according to word Elisha had spoken.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->


@include('incs.footer')