@extends('site.layout.default')
@section('title','all flash sale')
@section('content')

    <div class="page-content-wrapper">
        <!-- Top Products-->
        <div class="top-products-area pt-3">
            <div class="container">
                <div class="section-heading d-flex align-items-center justify-content-between">
                    <h6 class="ml-1">All Products</h6>
                    <!-- Layout Options-->
                    <div class="layout-options"><a href="{{route('shop_grid',3)}}"><i class="lni lni-grid-alt"></i></a><a class="active" href="{{route('shop_list',3)}}"><i class="lni lni-radio-button"></i></a></div>
                </div>
                <div class="row">
                    <!-- Single Weekly Product Card-->
                    @foreach($top_items as $top_item)
                        <div class="col-12 col-md-6">
                            <div class="card weekly-product-card mb-3">
                                <div class="card-body d-flex align-items-center">
                                    <div class="product-thumbnail-side"><span class="badge badge-success">{{$top_item['comment']}}</span><a class="wishlist-btn" href="javascript:remove({{$top_item['products']->id}});"><i class="lni lni-heart"></i></a><a class="product-thumbnail d-block" href="{{route('product.show',$top_item['products']->name)}}"><img src="{{ asset('productImage/'.$top_item['products']->image)}}" alt=""></a></div>
                                    <div class="product-description"><a class="product-title d-block" href="{{route('product.show',$top_item['products']->name)}}">{{$top_item['products']->name}}</a>
                                        <p class="sale-price"><i class="lni lni-dollar"></i>${{$top_item['products']->price}}</p>
                                        <a class="btn btn-success btn-sm add2cart-notify" href="javascript:cart({{$top_item['products']->id}});"><i class="mr-1 lni lni-cart"></i>Buy Now</a>

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

                    var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
                    if(AuthUser){
                        $.ajax({
                            type:'POST',
                            url:"{{ route('wishlist') }}",
                            data:{"_token": "{{ csrf_token() }}","product_id":id},
                            success:function(data){
                                Swal.fire(
                                    "ADDED!",
                                    data.success,
                                    "success"
                                );
                            }
                        });
                    }else{
                        Swal.fire(
                            "UnAuthorize!",
                            "You must login first.",
                            "danger"
                        );
                    }


                    {{--var APP_URL = {!! json_encode(url('/')) !!}--}}
                    {{--    window.location.href = APP_URL+"/site/remove/"+id;--}}

        }

        function cart(id) {
            Swal.fire({
                // text: "Are you sure?",
                title: "Add to Cart!",
                icon: "success",
                showCancelButton: true,
                confirmButtonText: "Yes, add it!"
            }).then(function(result) {
                if (result.value) {
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
            });
        }

    </script>
@endsection
