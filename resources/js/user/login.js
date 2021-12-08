var submit = false;

$('#reload').click(function () {
    $.ajax({
        type: 'GET',
        url: '/reload-captcha',
        success: function (data) {
            $(".captcha span").html(data.captcha);
        }
    });
});

$(document).on('click','.btn-login', function(e){
    
    e.preventDefault();
    submit = true;
    if(validateFields() == 0){
        $.ajax({
            url: '/authenticate',
            method:'POST',
            data:{
                _token:  $('meta[name="csrf-token"]').attr('content'),
                email: $('#txtEmail').val(),
                password: $('#txtPassword').val(),
            },
            beforeSend:function(){
                Swal.fire({
                    text: 'Please wait while registering your account in Cartsy Gallery ...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                    Swal.showLoading()
                    }
                })
            },
            success:function(response){
                if(response.success == true){
                    Swal.fire({
                        icon: 'success',
                        text: response.userMessage,
                    })
                    location.reload();
                }
                if(response.success == false){
                    Swal.fire({
                        icon: 'error',
                        text: response.userMessage,
                    })
                }
            }
        });
    }
    
});


$(document).on('keyup', '.validate-field', function(){
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