@extends('site.layout.default')
@section('title','all flash sale')
@section('content')
    <div class="page-content-wrapper">
        <!-- Catagory Single Image-->
        <div class="catagory-single-img" style="background-image: url('{{ asset('site/img/bg-img/4.jpg') }}')"></div>
        <!-- Product Catagories-->

        <!-- Top Products-->
        <div class="top-products-area mt-3">
            <div class="container">
                <div class="section-heading d-flex align-items-center justify-content-between">
                    <h6 class="ml-1">{{$styles->style_name}} Products</h6>
                </div>
                <div class="row">
                @foreach($styles['products'] as $product)
                    <!-- Single Top Product Card-->
                        <div class="col-6 col-sm-4 col-lg-3">
                            <div class="card top-product-card mb-3" style="position: relative;height: 260px !important;z-index: 1;">
                                <div class="card-body">
                                    <a class="wishlist-btn" href="{{route('product.show',$product->name)}}">
                                    </a>
                                    <a class="product-thumbnail d-block" href="{{route('product.show',$product->name)}}">
                                        <img style="height:170px;background-size: contain;" class="mb-2" src="{{ asset('productImage/'.$product->image) }}" alt=""></a>
                                    <a class="product-title d-block" href="{{route('product.show',$product->name)}}">{{$product->name}}</a>
                                    <p class="sale-price">${{$product->price}}</p>
                                    <form action="{{route('storeCartItem')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="btn btn-success btn-sm add2cart-notify" type="submit"><i class="lni lni-plus"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                @endforeach
                <!-- Single Top Product Card-->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
