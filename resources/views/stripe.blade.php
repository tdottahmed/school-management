<!DOCTYPE html>
<html>
<head>

    <title>Stripe Payment Forms</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

</head>

<body> 
<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <h2 class="panel-title">Stripe Payment Forms</h2>
                </div>

                <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    <form id='stripe-form' method='post' action="{{ route('payment.stripe.process') }}">
                        @csrf

                        <input type='hidden' name='stripeToken' id='stripe-token'>

                        <input type="hidden" name="fee_id" value="11">

                        <div id="stripe-card-element" class="form-control"></div>

                        <button id='stripe-pay-btn' class="btn btn-success mt-3" type="button" style="margin-top: 20px; width: 100%;padding: 7px;" onclick="createToken()">
                            PAY
                        </button>
                    </form>

                </div>
            </div>        
        </div>
    </div>

</div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">

    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card', {hidePostalCode: true});
    cardElement.mount('#stripe-card-element');

    /*------------------------------------------
    --------------------------------------------
    Create Token Code
    --------------------------------------------
    --------------------------------------------*/
    function createToken() {

        document.getElementById("stripe-pay-btn").disabled = true;

        stripe.createToken(cardElement).then(function(result) {
            if(typeof result.error != 'undefined') {
                document.getElementById("stripe-pay-btn").disabled = false;
                alert(result.error.message);
            }

            /* creating token success */
            if(typeof result.token != 'undefined') {
                document.getElementById("stripe-token").value = result.token.id;
                document.getElementById('stripe-form').submit();
            }
        });
    }
</script>
</html>