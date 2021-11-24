$(document).ready(function () {

    $('.radio-group .radio').click(function () {
        $('.radio').addClass('gray');
        $(this).removeClass('gray');
    });

    $('.plus-minus .plus').click(function () {
        var count = $(this).parent().prev().text();
        $(this).parent().prev().html(Number(count) + 1);
    });

    $('.plus-minus .minus').click(function () {
        var count = $(this).parent().prev().text();
        $(this).parent().prev().html(Number(count) - 1);
    });

});

//remove alert box
let alert = document.querySelector('.alert');
if (alert) {
    setInterval(() => {
        alert.remove();
    }, 8000);
}

const className = document.querySelectorAll('.quantity');
if (className) {
    Array.from(className).forEach(function (element) {
        element.addEventListener('change', () => {
            // console.log(element);
            const id = element.getAttribute('data-id');
            const productQuantity = element.getAttribute('data-productQuantity');

            axios.patch(`/cart/${id}`, {
                    quantity: element.value,
                    productQuantity: productQuantity
                })
                .then(function (response) {
                    // console.log(response);
                    window.location.href = 'https://laravelshopping.ir/cart';
                })
                .catch(function (error) {
                    // console.log(error);
                    window.location.href = 'https://laravelshopping.ir/cart';
                });
        })
    })
}


let credit_card = document.getElementById('credit-card');
let credit = document.getElementById('credit');
let cash = document.getElementById('cash');
if (credit) {
    credit.addEventListener('click', () => {
        credit_card.style.display = 'inline';
    })
}
if (cash) {
    cash.addEventListener('click', () => {
        credit_card.style.display = 'none';
    })
}



if (cash) {
    var secret_key = 'pk_test_51J91eBEkEPvflCzVlSHMTo1TcaAkOAE1yg4md48ce47dS4ahhzyN3aG4MAuSAnsTNWEC0NwRIx7dQiB04kOyllj100vOnDBcXb';
    // Create a Stripe client
    var stripe = Stripe(secret_key);

    // Create an instance of Elements
    var elements = stripe.elements();
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    // Create an instance of the card Element
    var card = elements.create('card', {
        style: style,
        hidePostalCode: true
    });
    // Add an instance of the card Element into the `card-element` <div>
    card.mount('#card-element');
    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        if (credit.checked) {
            event.preventDefault();
        }

        // Disable the submit button to prevent repeated clicks
        document.getElementById('complete-order').disabled = true;
        var options = {
            // name: document.getElementById('name_on_card').value,
            address_line1: document.getElementById('address').value,
            address_city: document.getElementById('city').value,
            address_state: document.getElementById('province').value,
            address_zip: document.getElementById('zip').value
        }
        stripe.createToken(card, options).then(function (result) {
            if (result.error) {
                // Inform the user if there was an error
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                // Enable the submit button
                document.getElementById('complete-order').disabled = false;
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        // Submit the form
        form.submit();
    }
}
