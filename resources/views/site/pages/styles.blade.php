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
            @foreach($slide_items as $item)
                <div class="single-hero-slide" style="background-image: url('{{ asset('productImage/'.$item['products']->image) }}')">
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
                    <h6 class="ml-1">Category Styles</h6>
                </div>
                <div class="product-catagory-wrap">
                    <div class="row">
                        <!-- Single Catagory Card-->
                        <!--@foreach($styles as $style)-->
                        <!--    <div class="col-4">-->
                                <!--<div class="card mb-3 catagory-card">-->
                                <!--    <div class="card-body"><a href="{{route('styles_products',$style->id)}}">-->
                                <!--            <span>{{$style->style_name}}</span></a></div>-->
                                <!--</div>-->

                        <!--        <div class="card mb-3 catagory-card" style="background:none;box-shadow:none;display:flex;flex-direction:column;align-item:center;justify-content:center">-->
                        <!--            <a href="{{route('styles_products',$style->id)}}">-->
                        <!--            <img src="1651402839images.jpg" style="width:100px;height:100px;border-radius:50%;margin:0 auto;">-->
                        <!--            <div class="card-body"><span>{{$style->style_name}}</span></a>-->
                        <!--        </div>-->

                        <!--    </div>-->
                        <!--@endforeach-->
                        @foreach($styles as $style)
                        <div class="col-4">
                            <div class="card mb-3 catagory-card" style="background:none;box-shadow:none;display:flex;flex-direction:column;align-item:center;justify-content:center">
                                <a href="{{route('styles_products',$style->id)}}">
                                <img src="{{asset('styleImages/'.$style->image)}}" style="width:100px;height:100px;border-radius:50%;margin:0 auto;">
                                <div class="card-body"><span>{{$style->style_name}}</span></a></div>

                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <!-- Single Flash Sale Card-->
                        @foreach($products as $product)
                            <div class="col-6 col-sm-4 col-md-3">
                                <div class="card flash-sale-card mb-3" style="position: relative;height: 280px !important;z-index: 1;">
                                    <div class="card-body"><div style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
                            <a class="wishlist-btn" style="position:relative;top:0;left:0;margin-top:3px;color:#ea4c62" href="javascript:remove({{$product->id}});"><i class="lni lni-heart"></i></a>
                            <a class="btn btn-success btn-sm add2cart-notify" style="padding: 0;padding-top:5px;border-radius:30px; width:30px; height: 30px;" href="javascript:cart({{$product->id}});"><i class="lni lni-plus"></i></a>
                        </div><a href="{{route('product.show',$product->name)}}"><img style="height:170px;background-size: contain;" src="{{asset('productImage/'.$product->image)}}" alt=""><span class="product-title">{{$product->name}}</span>
                                            <p class="sale-price">${{$product->price}}</p>
                                        </a></div>

                                </div>
                            </div>
                    @endforeach
                    <!-- Single Flash Sale Card-->
                    </div>
                </div>
            </div>
        </div>


        <!-- Flash Sale Slide-->
    </div>

@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script>


        function remove(id) {
            Swal.fire({
                // text: "Are you sure?",
                title: "Add to Wishlist!",
                icon: "success",
                showCancelButton: true,
                confirmButtonText: "Yes, add it!"
            }).then(function(result) {
                if (result.value) {
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
                }});
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
