@extends('site.layout.default')
@section('title',$title)
@section('content')
<div class="page-content-wrapper">
    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('success_message') }}
        </div>
    @endif
    @if(Session::has('error_message'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('error_message') }}
        </div>
@endif
    <!-- Hero Slides-->
    <div class="hero-slides owl-carousel">
        <!-- Single Hero Slide-->
        @foreach($data['slide_items'] as $item)
        <div class="single-hero-slide border border-1" style="background-image: url('{{ asset('productImage/'.$item['products']->image) }}')">
            <div class="slide-content h-100 d-flex align-items-center">
                <div class="container">
                    <h4 class="text-white mb-0" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">{{$item['products']->name}}</h4>
                    <p class="text-white" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">{{$item->comment}}</p>
                    <a class="btn btn-primary btn-sm" href="{{route('product.show',$item['products']->name)}}" data-animation="fadeInUp" data-delay="800ms" data-wow-duration="1000ms">Buy Now</a>
                </div>
            </div>
        </div>
        @endforeach
       </div>
    <!-- Product Catagories-->
    <div class="product-catagories-wrapper pt-3">
        <div class="container">
            <div class="section-heading">
                <h6 class="ml-1">Product Category</h6>
            </div>
            <div class="product-catagory-wrap">
                <div class="row">
                    <!-- Single Catagory Card-->
                    @foreach($categories as $category)
                    <div id="xcol">
                        <div class="card mb-3 catagory-card" style="background:none;box-shadow:none;display:flex;flex-direction:column;align-item:center;justify-content:center">
                            <a href="{{route('category_product',$category->id)}}">
                            <img src="{{asset('productImage/'.$category->image)}}" style="width:100px;height:100px;border-radius:50%;margin:0 auto;">
                            <div class="card-body"><span style="font-size:0.7rem">{{$category->name}}</span></a></div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Flash Sale Slide-->
    <div class="flash-sale-wrapper pb-3">
        <div class="container">
            <div class="section-heading d-flex align-items-center justify-content-between">
                <h6 class="ml-1">Flash Sale</h6><a class="btn btn-primary btn-sm" href="{{route('all_flash_items',[2,'Flash Items'])}}">View All</a>
            </div>
            <!-- Flash Sale Slide-->
            <div class="flash-sale-slide owl-carousel">
                <!-- Single Flash Sale Card-->
                @foreach($data['flash_items'] as $flash_item)
                <div class="card flash-sale-card" style="position: relative;height: 230px !important;z-index: 1;">
                    <div class="card-body"><a href="{{route('product.show',$flash_item['products']->name)}}"><img style="height:55%;background-size: contain;" class="item__img" src="{{ asset('productImage/'.$flash_item['products']->image)}}" alt=""><span class="product-title">{{$flash_item['products']->name}}</span>
                            <p class="sale-price">${{$flash_item['products']->price}}</p>

                            <!-- Progress Bar-->
                        </a>
                        <div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
                            <a class="wishlist-btn" style="position:relative;top:0;left:0;margin-top:3px;color:#ea4c62" href="javascript:remove({{$flash_item['products']->id}});"><i class="lni lni-heart"></i></a>
                            <a class="btn btn-success btn-sm add2cart-notify" style="padding: 0;padding-top:5px;border-radius:30px; width:30px; height: 30px;" href="javascript:cart({{$flash_item['products']->id}});"><i class="lni lni-plus"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Single Flash Sale Card-->
            </div>
        </div>
    </div>
    <!-- Top Products-->
    <div class="top-products-area clearfix">
        <div class="container">
            <div class="section-heading d-flex align-items-center justify-content-between">
                <h6 class="ml-1">Top Products</h6><a class="btn btn-danger btn-sm" href="{{route('shop_grid',3)}}">View All</a>
            </div>
            <div class="row">
                <!-- Single Top Product Card-->
                @foreach($data['top_items'] as $top_item)
                <div class="col-6 col-sm-4 col-lg-3">
                    <div class="card top-product-card mb-3" style="position: relative;height: 260px !important;z-index: 1;">
                        <div class="card-body">

                            <span class="badge badge-success">{{$top_item['comment']}}</span>
                            <a class="product-thumbnail d-block" href="{{route('product.show',$top_item['products']->name)}}">
                                <img style="height:170px;background-size: contain;" class="mb-2" src="{{ asset('productImage/'.$top_item['products']->image)}}" alt="">
                            </a>

                            <div style="display: flex; flex-direction: column">
                                <div><a class="product-title d-block" style="font-size: 0.8rem;" href="{{route('product.show',$top_item['products']->name)}}">{{$top_item['products']->name}}</a></div>
                                <div style="display: flex; flex-direction: row; justify-content: space-between;">
                                    <div><p class="sale-price">${{$top_item['products']->price}}</p></div>
                                    <div style="width: 60px">
                                        <a class="wishlist-btn" style="position: relative;top:0;left:0;margin-top:3px;" href="javascript:remove({{$top_item['products']->id}});"><i class="lni lni-heart"></i></a>
                                        <a class="btn btn-success btn-sm add2cart-notify" href="javascript:cart({{$top_item['products']->id}});"><i class="lni lni-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Single Top Product Card-->
            </div>
        </div>
    </div>

    <!-- Weekly Best Sellers-->
    <div class="weekly-best-seller-area pt-3">
        <div class="container">
            <div class="section-heading d-flex align-items-center justify-content-between">
                <h6 class="pl-1">Weekly Best Sellers</h6><a class="btn btn-success btn-sm" href="{{route('shop_grid',4)}}">View All</a>
            </div>
            <div class="row">
                <!-- Single Weekly Product Card-->
                @foreach($data['best_seller'] as $best_item)
                <div class="col-12 col-md-6">
                    <div class="card weekly-product-card mb-3">
                        <div class="card-body d-flex align-items-center">
                            <div class="product-thumbnail-side"><span class="badge badge-success">{{$best_item['comment']}}</span><a class="wishlist-btn" href="javascript:remove({{$best_item['products']->id}});"><i class="lni lni-heart"></i></a><a class="product-thumbnail d-block" href="{{route('product.show',$best_item['products']->name)}}"><img src="{{ asset('productImage/'.$best_item['products']->image)}}" alt=""></a></div>
                            <div class="product-description"><a class="product-title d-block" href="{{route('product.show',$best_item['products']->name)}}">{{$best_item['products']->name}}</a>
                                <p class="sale-price"><i class="lni lni-dollar"></i>${{$best_item['products']->price}}</p>
                                <a class="btn btn-success btn-sm add2cart-notify" href="javascript:cart({{$best_item['products']->id}});"><i class="mr-1 lni lni-cart"></i>Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Single Weekly Product Card-->
            </div>
        </div>
    </div>
    <!-- Featured Products Wrapper-->
    <div class="featured-products-wrapper mt-3">
        <div class="container">
            <div class="section-heading d-flex align-items-center justify-content-between">
                <h6 class="pl-1">Featured Products</h6><a class="btn btn-warning btn-sm" href="{{route('all_flash_items',[5,'Featured Items'])}}">View All</a>
            </div>
            <div class="row">
                <!-- Featured Product Card-->
                @foreach($data['featured_items'] as $feature_item)
                <div class="col-6 col-sm-4 col-lg-3">
                    <div class="card featured-product-card mb-3" style="position: relative;height: auto !important;z-index: 1;">
                        <div class="card-body">
                            <div class="product-thumbnail-side">
                                <a class="wishlist-btn" style="position: absolute; top: 3px; right: 8px;" href="javascript:remove({{$feature_item['products']->id}});">
                                    <i id="xiconheart" class="lni lni-heart"></i>
                                </a>
                                <a class="product-thumbnail d-block" href="{{route('product.show',$feature_item['products']->name)}}">
                                    <img style="height:130px;background-size: contain;" src="{{ asset('productImage/'.$feature_item['products']->image)}}" alt="">
                                </a>
                            </div>
                            <div class="product-description" style="font-size: 0.75rem !important;"><a class="product-title d-block" href="{{route('product.show',$feature_item['products']->name)}}">{{$feature_item['products']->name}}</a>
                            <div style="width: 100%;display: flex; flex-direction: row; justify-content: space-between;">
                                <p class="sale-price">${{$feature_item['products']->price}}</p>
                                <a class="btn btn-success btn-sm add2cart-notify" style="padding: 0;padding-top:5px;border-radius:30px; width:30px; height: 30px;" href="javascript:cart({{$flash_item['products']->id}});"><i class="lni lni-plus"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Featured Product Card-->
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
    if(screen.width < 500) {
        document.getElementById('xximg').src = "{{ asset('site/img/core-img/light _ico.png') }}"
        document.getElementById('xxicons').style.display = "none"
        document.getElementById('xcol').setAttribute("style", "col-4")
    }
    if(screen.width > 500) {
        document.getElementById('xximg').src = "{{ asset('site/img/core-img/logo-small.png') }}"
        document.getElementById('xxicons').style.display = "flex"
        document.getElementById('xcol').setAttribute("style", "col-2")
    }
</script>

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
            var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
            if(AuthUser){
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
            });
        }

    </script>

    <script>
        function add_to_cart(id){
                 $.ajax({
                     url: "site/storeCartItem",
                     type:"POST",
                     data:{
                         product_id:id,
                         _token: "{{ csrf_token() }}"
                     },
                     success:function(response){
                         if(response) {
                             $("body").append("<div class='add2cart-notification animated fadeIn'>Added to cart successfully!</div>");
                             $(".add2cart-notification").delay(2000).fadeOut();
                         }
                     },
                 });


        }
    </script>
@endsection
