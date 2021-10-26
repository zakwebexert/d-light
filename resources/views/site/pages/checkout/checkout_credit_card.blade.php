@extends('site.layout.default')
@section('title',$title)
@section('content')
    <div class="page-content-wrapper">
        <div class="container">
            <!-- Checkout Wrapper-->
            <div class="checkout-wrapper-area py-3">
                <!-- Credit Card Info-->
                <div class="credit-card-info-wrapper"><img class="d-block mb-4" src="{{asset('site/img/bg-img/12.png')}}" alt="">
                    <div class="pay-credit-card-form">
                        @if(Session::has('success-message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success-message') }}</p>
                        @endif

                        @if(Session::has('fail-message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('fail-message') }}</p>
                        @endif
                            <hr>
                        <form accept-charset="UTF-8" action="{{route('str')}}" class="require-validation"
                              data-cc-on-file="false"
                              data-stripe-publishable-key="pk_test_51JVrOGFuaXaPZq5rlmczzBV19WXos1fqscwhHGVnoeUo71NSTmiVtAWo2HGbVDgCtvkkwIUAjQsZgPlqfTN78bZO00tEgECjew"
                              id="payment-form" method="post">
                            {{ csrf_field() }}
                            <div class="form-group card">
                                <label>Credit Card Number</label>
                                <input autocomplete='off' class="form-control card-number" type="text" placeholder="1234 ×××× ×××× ××××" size='20'>
                            </div>
                            <div class="form-group">
                                <label for="cardholder">Cardholder Name</label>
                                <input class="form-control" type="text" id="cardholder" placeholder="SUHA JANNAT" value="">
                            </div>
                            <div class="form-group cvc">
                                <label>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group expiration">
                                        <label>Expiration Month</label>
                                        <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group expiration">
                                        <label>Expiration Year</label>
                                        <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="price" value="{{$price}}">
                            <input type="hidden" name="description" value="{{$customerName}}">

                            <div class="form-group">
                                <div class='form-control total btn btn-info'>
                                    Total: <span class='amount'>{{$price}}</span>
                                </div>
                            </div>
                            <button class="btn btn-warning btn-lg w-100" type="submit">Pay Now</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(function() {
            $('form.require-validation').bind('submit', function(e) {
                var $form         = $(e.target).closest('form'),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs       = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid         = true;

                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault(); // cancel on first error
                    }
                });
            });
        });

        $(function() {
            var $form = $("#payment-form");

            $form.on('submit', function(e) {
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripe_token' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        })
    </script>
@endsection
