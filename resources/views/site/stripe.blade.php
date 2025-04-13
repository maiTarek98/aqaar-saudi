<html>
    <head>
            <script src="https://js.stripe.com/v3/"></script>

    </head>
    <body>
        <!-- payment.blade.php -->
    <form id="payment-form">
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>
        <input type="hidden" id="sell_car_id" name="sell_car_id" value="1">
        <button id="submit">Pay 200 SAR</button>
    
        <div id="error-message" role="alert"></div>
    </form>
    
    <script>
        var stripe = Stripe("{{ env('STRIPE_KEY') }}"); // Publishable key
        var elements = stripe.elements();
    
        // Create an instance of the card Element.
        var card = elements.create("card");
        var sell_car_id = document.getElementById("sell_car_id").value;
        // Add an instance of the card Element into the `card-element` div.
        card.mount("#card-element");
    
        var form = document.getElementById("payment-form");
        var errorMessage = document.getElementById("error-message");
    
        form.addEventListener("submit", function(event) {
            event.preventDefault();
    
            // Call the backend to create a PaymentIntent
            fetch("{{url('/')}}/create-payment-intent", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF Token
                },
                body: JSON.stringify({
                    sell_car_id : sell_car_id,
                    amount: 20000,  // Amount in cents (200 SAR)
                }),
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                var clientSecret = data.clientSecret;
    
                // Confirm the payment with the clientSecret
                stripe.confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: "Customer Name",
                        },
                    },
                })
                .then(function(result) {
                    if (result.error) {
                        // Show error to your customer
                        errorMessage.textContent = result.error.message;
                    } else {
                        // Payment succeeded
                        if (result.paymentIntent.status === "succeeded") {
                            alert("Payment Successful");
                        }
                    }
                });
            });
        });
    </script>
    

    </body>
</html>