@extends('site.layout.default')
@section('title',$title)
@section('content')
    <div class="page-content-wrapper">
        <div class="container">
            <!-- Checkout Wrapper-->
            <!-- Preloader-->
{{--            <div class="preloader" id="preloader">--}}
{{--                <div class="spinner-grow text-secondary" role="status">--}}
{{--                    <div class="sr-only">Loading...</div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- Order/Payment Success-->

            <div class="order-success-wrapper">
                <div class="content"><i class="lni lni-checkmark-circle"></i>
                    <h5>Payment Done</h5>
                    <p>We will notify you of all the details via email. Thank you!</p>
                    <div style="width: auto; margin-top: 30px;">
                        <table class="table" style="background:rgba(255,255,255,0.3) !important; color: #fff; margin: 20px auto; background: green; width:90%">
                            <thead>
                            <tr>
                                <th scope="col">Shiffing method</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$order->shiffing_method}}</td>
                                <td>{{$order->total}} USD</td>
                                <td>{{$order->status}}</td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="table" class="table" style="background:rgba(255,255,255,0.3) !important; color: #fff; margin: 20px auto; background: green; width: 90%;">
                            <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Product Choices</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}} USD</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->choices}}</td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- All JavaScript Files-->
        </div>
    </div>
@endsection
