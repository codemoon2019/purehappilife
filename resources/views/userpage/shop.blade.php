@include('incs.header')

@yield('section')
 <!-- bread crumb start -->
 <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">shop</li>
                    </ol>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal"> Add Product to Sell Art </button>
                </div>
            </div>
        </div>
    </nav>
    <!-- bread crumb end -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sell Your Art</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          @include('incs.sell-product-form')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>

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

    
$(document).ready(function(){

let ckEditor = CKEDITOR;
var submit = false;
var productDescription = ckEditor.instances['txtProductDescription'];
    
$('.single-select').select2({
    theme: 'bootstrap4',
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
    allowClear: Boolean($(this).data('allow-clear')),
});

$('#create-product').submit(function(event){
    event.preventDefault();
    submit = true;
    var form = $(this);
    var formData = new FormData(this);
    formData.append('description', productDescription.getData());
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
            data: formData, // serializes the form's elements.\
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
                if(data.success == true){
                    
                    $('#create-product')[0].reset();
                    productDescription.setData('');
                    Swal.fire({
                        icon: 'success',
                        text: data.internalMessage,
                    })
                    window.location = '/home/shop';
                    
                }else{

                    Swal.fire({
                        icon: 'error',
                        text: data.internalMessage,
                    });

                }
              

            }
          });
    }else{
        return false;
    }
})

$(document).on('keyup change', '.validate-field', function(){
    if(submit != false){
        validateFields();
    }
})


});

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
</script>