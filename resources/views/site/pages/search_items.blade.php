@extends('site.layout.default')
@section('title','all flash sale')
@section('content')

    <div class="page-content-wrapper">
        <!-- Top Products-->
        <div class="top-products-area pt-3">
            <div class="container">
                <div class="section-heading d-flex align-items-center justify-content-between">
                    <h6 class="ml-1">{{count($items)}} Products Found</h6>
                    <!-- Layout Options-->
                    </div>
                <div class="row">
                    <!-- Single Weekly Product Card-->
                    @foreach($items as $item)
                        <div class="col-12 col-md-6">
                            <div class="card weekly-product-card mb-3">
                                <div class="card-body d-flex align-items-center">
                                    <div class="product-thumbnail-side"><a class="wishlist-btn" href="javascript:remove({{$item->id}});"><i class="lni lni-heart"></i></a><a class="product-thumbnail d-block" href="{{route('product.show',$item->name)}}"><img src="{{ asset('productImage/'.$item->image)}}" alt=""></a></div>
                                    <div class="product-description"><a class="product-title d-block" href="{{route('product.show',$item->name)}}">{{$item->name}}</a>
                                        <p class="sale-price"><i class="lni lni-dollar"></i>${{$item->price}}</p>
                                        <a class="btn btn-success btn-sm add2cart-notify" href="javascript:cart({{$item->id}});"><i class="mr-1 lni lni-cart"></i>Buy Now</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
                <!-- Single Weekly Product Card-->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script>
        function remove(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "Add to Wishlist!",
                icon: "success",
                showCancelButton: true,
                confirmButtonText: "Yes, add it!"
            }).then(function(result) {
                if (result.value) {
                    Swal.fire(
                        "ADDED!",
                        "Your item has been add to wishlist.",
                        "success"
                    );
                    {{--var APP_URL = {!! json_encode(url('/')) !!}--}}
                    {{--    window.location.href = APP_URL+"/site/remove/"+id;--}}
                }
            });
        }

        function cart(id) {
                    $.ajax({
                        type:'POST',
                        url:"{{ route('storeCartItem') }}",
                        data:{"_token": "{{ csrf_token() }}","product_id":id,"quantity":1},
                        success:function(data){
                            Swal.fire(
                                "ADDED!",
                                "Your item has been add to Cart.",
                                "success"
                            );
                        }
                    });

                    {{--var APP_URL = {!! json_encode(url('/')) !!}--}}
                    {{--    window.location.href = APP_URL+"/site/remove/"+id;--}}


        }

    </script>
@endsection
