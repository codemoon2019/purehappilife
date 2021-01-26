var submit = false;
var submitConfirmation = false;

$(document).on('click', '.btn-register-user', function(e){
    e.preventDefault();
    submit = true;
    if(validateFields() == 0){
        $.ajax({
            url: '/register-user',
            method: 'POST',
            data:{
                _token: $('meta[name="csrf-token"]').attr('content'),
                firstName : $('#txtFirstName').val(),
                lastName : $('#txtLastName').val(),
                middleName : $('#txtMiddleName').val(),
                email : $('#txtEmail').val(),
                mobilePhone : $('#txtMobilePhone').val(),
                password : $('#txtPassword').val(),
                retypePassword : $('#txtRetypePassword').val(),
                ref_link: $('#txtRefLink').val()
            },
            beforeSend:function(){
                Swal.fire({
                    text: 'Please wait while registering your account in Pure Happilife ...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                    Swal.showLoading()
                    }
                })
            },
            success:function(response){
                if(response.success == true){
                    $('#register-successfully').removeClass("hide");
                    $('#registration-form-content').hide("fast");
                    $('.btn-resend-password').hide("fast");
                    var timeleft = 90;
                    var downloadTimer = setInterval(function(){
                    if(timeleft <= 0){
                        clearInterval(downloadTimer);
                        document.getElementById("countdown").innerHTML = "Did'nt receive the code even you check your spam email ? Try to resend a new password.";
                        $('.btn-resend-password').show("fast");
                    } else {
                        document.getElementById("countdown").innerHTML = "If you did'nt again receive the code try again in "+timeleft + " seconds remaining";
                    }
                    timeleft -= 1;
                    }, 1000);
                    Swal.fire({
                        icon: 'success',
                        text: response.userMessage,
                    })
                }
                if(response.success == false){
                    Swal.fire({
                        icon: 'error',
                        text: response.userMessage,
                    })
                }
            },
            error:function(){
                Swal.fire({
                    icon: 'success',
                    text: 'Something went wrong!',
                })
            }
        })
    }
})


$(document).on('click', '.btn-continue-authentication', function(e){
    e.preventDefault();
    validateConfirmationFields();
    
    submitConfirmation = true;
    if(validateFields() == 0){
        $.ajax({
            url: '/authenticate',
            method:'POST',
            data:{
                _token:  $('meta[name="csrf-token"]').attr('content'),
                email: $('#txtEmail').val(),
                password: $('#txtConfirmationCode').val(),
            },
            beforeSend:function(){
                Swal.fire({
                    text: 'Please wait while registering your account in Pure Happilife ...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    showConfirmButton:false,
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

$(document).on('click', '.btn-resend-password', function(e){
    e.preventDefault();
    $.ajax({
        url: '/reset-passcode',
        method:'POST',
        data:{
            _token:  $('meta[name="csrf-token"]').attr('content'),
            email: $('#txtEmail').val(),
        },
        beforeSend:function(){
            Swal.fire({
                text: 'Please wait while sending the new password to your email ...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                Swal.showLoading()
                }
            })
        },
        success:function(response){
            if(response.success == true){
                $('.btn-resend-password').hide("fast");
                var timeleft = 90;
                var downloadTimer = setInterval(function(){
                if(timeleft <= 0){
                    clearInterval(downloadTimer);
                    document.getElementById("countdown").innerHTML = "Did'nt receive the code even you check your spam email ? Try to resend a new password.";
                    $('.btn-resend-password').show("fast");
                } else {
                    document.getElementById("countdown").innerHTML = "If you did'nt again receive the code try again in "+timeleft + " seconds remaining";
                }
                timeleft -= 1;
                }, 1000);
                Swal.fire({
                    icon: 'success',
                    text: response.userMessage,
                })
            }
            if(response.success == false){
                Swal.fire({
                    icon: 'error',
                    text: response.userMessage,
                })
            }
        }
    });

});



$(document).on('keyup', '.validate-field-confirmation', function(){
    if(submit != false){
        validateConfirmationFields();
    }
})

$(document).on('keyup', '.validate-field-confirmation', function(){
    if(submitConfirmation != false){
        validateConfirmationFields();
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


function validateConfirmationFields(){

    for(var i = 0, countError = 0, inputFieldsCount = $('.validate-field-confirmation').length; i < inputFieldsCount; i++){
        
        var errorMessage = document.getElementsByClassName("validate-field-confirmation")[i].getAttribute("error-message-confirmation");
        if(document.getElementsByClassName("validate-field-confirmation")[i].value == ""){
            countError += 1;
            document.getElementsByClassName("validate-field-confirmation")[i].style.border = "1px solid red";
            document.getElementsByClassName("error-message-confirmation")[i].textContent = errorMessage;
        }else{
            document.getElementsByClassName("validate-field-confirmation")[i].style.border = "1px solid #e3e3e3";
            document.getElementsByClassName("error-message-confirmation")[i].textContent = "";
        }
        
    }

    return countError;

}