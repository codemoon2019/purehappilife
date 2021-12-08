const clientKey = 'pub.v2.8016052800121276.aHR0cDovLzEyNy4wLjAuMTo5MDkw.mAizqOx6DiMIPhcQyADxFCzWcBHlhNyCzJQo0EObKO0';
const type = 'gcash';
var submit = false;

$('.radio-group-payment-method').click(function () {
        
    submit = true;

    if(validateFields() == 0){

        if(this.value == 'paypal'){
            $('#paypal-button-container').show('fast');
            $('#btn-cod').hide('fast');
            $('#validation-message').hide('fast');
            $('#gcash').hide('fast');
            $('#paymaya').hide('fast');
            $('#btn-happipoints').hide('fast');
            $('#manual-form').hide('fast');
            topFunction()
        }

        if(this.value == 'cod'){
            $('#paypal-button-container').hide('fast');
            $('#btn-cod').show('fast');
            $('#validation-message').hide('fast');
            $('#gcash').hide('fast');
            $('#paymaya').hide('fast');
            $('#btn-happipoints').hide('fast');
            $('#manual-form').hide('fast');
            topFunction()
        }

        if(this.value == 'gcash'){
            $('#paypal-button-container').hide('fast');
            $('#btn-cod').hide('fast');
            $('#validation-message').hide('fast');
            $('#gcash').show('fast');
            $('#paymaya').hide('fast');
            $('#btn-happipoints').hide('fast');
            $('#manual-form').hide('fast');
            topFunction()
        }

        if(this.value == 'paymaya'){
            $('#paypal-button-container').hide('fast');
            $('#btn-cod').hide('fast');
            $('#validation-message').hide('fast');
            $('#gcash').hide('fast');
            $('#paymaya').show('fast');
            $('#btn-happipoints').hide('fast');
            $('#manual-form').hide('fast');
            topFunction()
        }

        if(this.value == 'happipoints'){
            $('#paypal-button-container').hide('fast');
            $('#btn-cod').hide('fast');
            $('#validation-message').hide('fast');
            $('#gcash').hide('fast');
            $('#paymaya').hide('fast');
            $('#btn-happipoints').show('fast');
            $('#manual-form').hide('fast');
            topFunction()
        }

        if(this.value == 'manual'){
          $('#paypal-button-container').hide('fast');
          $('#btn-cod').hide('fast');
          $('#validation-message').hide('fast');
          $('#gcash').hide('fast');
          $('#paymaya').hide('fast');
          $('#btn-happipoints').hide('fast');
          $('#manual-form').show('fast');
          topFunction()
        }



    }else{
        $('#paypal-button-container').hide('fast');
        $('#btn-cod').hide('fast');
        $('#validation-message').show('fast');
        $('#gcash').hide('fast');
        $('#paymaya').hide('fast');
        $('#btn-happipoints').hide('fast');
        $('#manual-form').hide('fast');
    }
    
});
/*
async function initCheckoutGcash() {
  try {
    const paymentMethodsResponse = await callServer("/api/get-payment-method");
    const configuration = {
      paymentMethodsResponse: filterUnimplemented(paymentMethodsResponse),
      clientKey,
      environment: "test",
      showPayButton: true,
      onSubmit: (state, component) => {
        if (state.isValid) {
          handleSubmission(state, component, "/api/initiate-payment?type=gcash&address1="+$('#txtAddress1').val()+"&address2="+$('#txtAddress2').val()+"&city="+$('#txtState').val()+"&zip="+$('#txtZipCode').val()+"&country="+$('#txtCountry').val()+"&id="+ $('meta[name="site_visitor_number"]').attr('content'));
        }
      },
      onAdditionalDetails: (state, component) => {
        handleSubmission(state, component, "/api/submit-additional-details?type=gcash");
      },
    };

    const checkout = new AdyenCheckout(configuration);

    checkout.create('gcash').mount(document.getElementById('gcash'));

  } catch (error) {
    console.error(error);
    alert("Error occurred. Look at console for details");
  }
}

async function initCheckoutPaymaya() {
    try {
      const paymentMethodsResponse = await callServer("/api/get-payment-method");
      const configuration = {
        paymentMethodsResponse: filterUnimplemented(paymentMethodsResponse),
        clientKey,
        environment: "test",
        showPayButton: true,
        onSubmit: (state, component) => {
          if (state.isValid) {
            handleSubmission(state, component, "/api/initiate-payment?type=paymaya&address1="+$('#txtAddress1').val()+"&address2="+$('#txtAddress2').val()+"&city="+$('#txtState').val()+"&zip="+$('#txtZipCode').val()+"&country="+$('#txtCountry').val()+"&id="+ $('meta[name="site_visitor_number"]').attr('content'));
          }
        },
        onAdditionalDetails: (state, component) => {
          handleSubmission(state, component, "/api/submit-additional-details?type=paymaya");
        },
      };
  
      const checkout = new AdyenCheckout(configuration);
  
      checkout.create('paymaya_wallet').mount(document.getElementById('paymaya'));
  
    } catch (error) {
      console.error(error);
      alert("Error occurred. Look at console for details");
    }
  }*/

function filterUnimplemented(pm) {
  pm.paymentMethods = pm.paymentMethods.filter((it) =>
    [
      "scheme",
      "ideal",
      "dotpay",
      "giropay",
      "sepadirectdebit",
      "directEbanking",
      "ach",
      "alipay",
      "gcash",
      "paymaya_wallet"
    ].includes(it.type)
  );
  return pm;
}

// Event handlers called when the shopper selects the pay button,
// or when additional information is required to complete the payment
async function handleSubmission(state, component, url) {
  try {
    const res = await callServer(url, state.data);
    handleServerResponse(res, component);
  } catch (error) {
    console.error(error);
    alert("Error occurred. Look at console for details");
  }
}

// Calls your server endpoints
async function callServer(url, data) {
  const res = await fetch(url, {
    method: "POST",
    body: data ? JSON.stringify(data) : "",
    headers: {
      "Content-Type": "application/json",
    },
  });

  return await res.json();
}


// Handles responses sent from your server to the client
function handleServerResponse(res, component) {
  if (res.action) {
    component.handleAction(res.action);
  } else {
    switch (res.resultCode) {
      case "Authorised":
        window.location.href = "/result/success";
        break;
      case "Pending":
      case "Received":
        window.location.href = "/result/pending";
        break;
      case "Refused":
        window.location.href = "/result/failed";
        break;
      default:
        window.location.href = "/result/error";
        break;
    }
  }
}

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


function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}



initCheckoutPaymaya();
initCheckoutGcash();
  