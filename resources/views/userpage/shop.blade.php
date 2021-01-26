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
    <!-- product tab start -->
    <div class="product-tab bg-white pb-5">
        <div class="container">
            <div class="grid-nav-wraper bg-light mb-5">
                <div class="row align-items-center">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <nav class="shop-grid-nav">
                            <ul class="nav nav-pills align-items-center" id="pills-tab" role="tablist">
                                <li class="nav-item mr-0">
                                    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="ion-android-menu"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="shop-grid-button d-flex align-items-center">
                            <span class="sort-by">Search:</span>
                            <input class="form-control txtProductSearch" type="text" placeholder="Search product keyword ...">
                            </button>
            
                        </div>
                    </div>
                </div>
            </div>
            <!-- product-tab-nav end -->
            <div class="tab-content" id="pills-tabContent">
              
                <!-- second tab-pane -->
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="grid-list-wrapper">
                        <div class="row" id="shop-loader">
                            <div class="col-lg-12 text-center">
                                <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only" style="margin:auto;">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div id="shop-list">

                        </div>                
                        
                        
                        <nav class="pagination-section bg-light my-5">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6 text-center text-sm-left  mb-3 mb-sm-0">
                                </div>
                                <div class="col-12 col-sm-6">

                                         {!! $data->links() !!}

                                </div>
                            </div>
                        </nav>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- product tab end -->


@include('incs.footer')

<script>
    var page = 1;
    var search = '{{ $search }}'
    getData(page, search);

    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                page = page;
                getData(page,'');
            }
        }
    });

    $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var myurl = $(this).attr('href');
        var page=$(this).attr('href').split('page=')[1];
        page = page;
        getData(page,'');
    });

    $(document).on('keyup', '.txtProductSearch', function(){
        getData(page, this.value);
    })
    
    function getData(page, search){
        $.ajax({
            url: $('meta[name="shop_url"]').attr('content')+'?page='+page+'&search='+search,
            type: "GET",
            datatype: "html"
        }).done(function(data){
            $('#shop-loader').fadeOut('fast');
            $("#shop-list").empty().html(data);
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            // alert('No response from server');
        });
    }
</script>