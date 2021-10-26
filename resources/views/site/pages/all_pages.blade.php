@extends('site.layout.default')
@section('title',$title)
@section('content')

    <div class="page-content-wrapper pt-3 pb-2">
        <div class="container">
            <h6 class="ml-1 mb-2">All Pages</h6>
            <ul class="page-nav">
                <li><a href="{{route('site.home')}}">Home<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="shop-grid.html">Shop Grid<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="shop-list.html">Shop List<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="catagory.html">Catagory<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="wishlist-grid.html">Wishlist Grid<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="wishlist-list.html">Wishlist List<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="{{route('cart')}}">Cart<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="checkout-bank.html">Checkout Bank<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="checkout-cash.html">Checkout Cash<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="checkout-credit-card.html">Checkout Credit Card<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="checkout-payment.html">Checkout Payment<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="checkout-paypal.html">Checkout PayPal<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="{{route('checkout')}}">Checkout<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="change-password.html">Change Password<i class="lni lni-chevron-right">                   </i></a></li>
                <li><a href="edit-profile.html">Edit Profile<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="flash-sale.html">Flash Sale<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="featured-products.html">Featured Products<span class="badge badge-danger ml-2">New</span><i class="lni lni-chevron-right"></i></a></li>
                <li><a href="{{route('login')}}">Login<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="{{route('register')}}">Register<i class="lni lni-chevron-right"></i></a></li>
                <li><a href="{{route('client-profile')}}">Profile<i class="lni lni-chevron-right"></i></a></li>
            </ul>
        </div>
    </div>
@endsection
