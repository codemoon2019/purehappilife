$(document).ready(function() {        
    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".file-upload").on('change', function(){
        readURL(this);
    });

});

$('#update-profile-form').submit(function(e){
    e.preventDefault();
    submit = true;
    var form = $(this);
    var formData = new FormData(this);
    var url = form.attr('action');

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
                    html: 'Please wait while updating your profile picture ...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                      Swal.showLoading()
                    },
                })

            },
            success:function(data){

                Swal.fire({
                    icon: 'success',
                    text: 'Profile picture update successfully!',
                })

            }
          });
  
});

$('#update-basic-info-form').submit(function(e){
    e.preventDefault();
    submit = true;
    var form = $(this);
    var formData = new FormData(this);
    var url = form.attr('action');

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
                    html: 'Please wait while updating your basic info ...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                      Swal.showLoading()
                    },
                })

            },
            success:function(data){

                Swal.fire({
                    icon: data.success ? 'success' : 'warning',
                    text: data.internalMessage,
                })

            }
          });
})

$('#update-user-password').submit(function(e){
    e.preventDefault();
    submit = true;
    var form = $(this);
    var formData = new FormData(this);
    var url = form.attr('action');

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
                    html: 'Please wait while updating your password ...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                      Swal.showLoading()
                    },
                })

            },
            success:function(data){

                Swal.fire({
                    icon: data.success ? 'success' : 'warning',
                    text: data.message,
                })

            }
          });
})


$('#update-address-info').submit(function(e){
    e.preventDefault();
    submit = true;
    var form = $(this);
    var formData = new FormData(this);
    var url = form.attr('action');

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
                    html: 'Please wait while updating your address information ...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                      Swal.showLoading()
                    },
                })

            },
            success:function(data){

                Swal.fire({
                    icon: data.success ? 'success' : 'warning',
                    text: data.internalMessage,
                })

            }
          });
})