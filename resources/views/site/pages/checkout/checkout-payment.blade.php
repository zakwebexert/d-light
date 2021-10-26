@extends('site.layout.default')
@section('title',$title)
@section('content')
    <div class="page-content-wrapper">
        <div class="container">
            <!-- Checkout Wrapper-->
            <div class="checkout-wrapper-area pt-3">
                <!-- Choose Payment Method-->
                <div class="choose-payment-method">
                    <h6 class="mb-3 text-center">Choose Payment Method</h6>
                    <div class="row justify-content-center">
                        <!-- Single Payment Method-->
                        <div class="col-6 col-md-5">
                            <div class="single-payment-method"><a class="credit-card" href="{{route('credit_card')}}"><i class="lni lni-credit-cards"></i>
                                    <h6>Credit Card</h6></a></div>
                        </div>
                        <!-- Single Payment Method-->
                        <!-- Single Payment Method-->
                        <div class="col-6 col-md-5">
                            <div class="single-payment-method"><a class="paypal" href="{{route('paypal')}}"><i class="lni lni-paypal"></i>
                                    <h6>PayPal</h6></a></div>
                        </div>
                        <!-- Single Payment Method-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
