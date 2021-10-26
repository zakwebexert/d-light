@extends('site.layout.default')
@section('title',$title)
@section('content')
    <div class="page-content-wrapper">
        <div class="container">
            <!-- Checkout Wrapper-->
            <div class="checkout-wrapper-area py-3">
                <div class="credit-card-info-wrapper"><img class="d-block mb-4" src="{{asset('site/img/bg-img/12.png')}}" alt="">
                    <div class="pay-credit-card-form">
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                            <small class="ml-1"><i class="fa fa-lock mr-1"></i>Secure online payments at the speed of want.<a class="ml-1" >Learn More</a></small>
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="business" value="donovanwts@gmail.com">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="amount" value="{{$price}}">

                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input class="form-control" type="text" id="amount" name ="amount" value="{{$price}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" id="name" value="{{$user->name}}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="paypalEmail">Email Address</label>
                                <input class="form-control" type="email" id="email" value="{{$user->email}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="address1">Address</label>
                                <input class="form-control" type="text" id="address1" name="address1" value="{{$order_detail->address}}" disabled>
                            </div>

                            <input type="hidden" name="return" value="{{url('site/paypal/success')}}">
                            <input type="hidden" name="cancel_return" value="{{url('site/paypal/fail')}}">

                            <button class="btn btn-warning btn-lg w-100" type="submit">Pay Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
