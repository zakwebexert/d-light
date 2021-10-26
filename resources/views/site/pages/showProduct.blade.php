@extends('site.layout.default')
@section('title',$title)
@section('content')
    <div class="page-content-wrapper">
        <!-- Product Slides-->
        <div class="product-slides owl-carousel">

            @if (count($product->images) > 0)
            <!-- Hero Slides-->
            <div class="hero-slides owl-carousel">
                <!-- Single Hero Slide-->
                @foreach($product->images as $image)
                <div class="single-hero-slide" style="background-image: url('{{ asset('productImage/'.$image->image) }}')">
                    <div class="slide-content h-100 d-flex align-items-center">
                        <div class="container">
                            <div style=">
                                <img src="{{asset('productImage/'.$image->image)}}">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
           </div>
           @else
           <div class="no-carousel">
               <div class="slide-content h-100 d-flex align-items-center">
                    <div class="container">
                        <div style="">
                            <img src="{{asset('productImage/'.$product->image)}}">
                        </div>
                    </div>
                </div>
           </div>
           @endif

            <!-- Single Hero Slide-->
            <!--<div class="single-product-slide">-->
            <!--    <div style=" position: absolute;left: 34%;width: 500px;height: 500px;">-->
            <!--        <img src="{{asset('productImage/'.$product->image)}}">-->
            <!--    </div>-->


            <!--    </div>-->
            <!--<div>-->
            <!--@foreach($product->images as $image)-->
            <!--    <div style="width: 500px;height: 500px;">-->
            <!--        <img src="{{asset('productImage/'.$image->image)}}">-->
            <!--    </div>-->
            <!--@endforeach-->
            <!--</div>-->
            <!-- Single Hero Slide-->
          </div>
        <div class="product-description pb-3">
            <!-- Product Title & Meta Data-->
            <div class="product-title-meta-data bg-white mb-3 py-3">
                <div class="container d-flex justify-content-between">
                    <div class="p-title-price">
                        <h6 class="mb-1">{{$product->name}}</h6>
                        <p class="sale-price mb-0">${{$product->price}}</p>
                    </div>
                    <div class="p-wishlist-share"><a href="#"><i class="lni lni-heart"></i></a></div>
                </div>
                <!-- Ratings-->
            </div>
            <!-- Selection Panel-->
            <!-- Add To Cart-->
            <div class="cart-form-wrapper bg-white mb-3 py-3">
                <div class="container">
                    <form class="cart-form" action="{{route('storeCartItem')}}" id="addtocartform" onsubmit="event.preventDefault();">
                        @csrf
                        <input type="hidden" value="{{$product['id']}}" name="product_id">
                        @foreach($product['choices'] as $choice)
                            @if($choice['choice_title'] == 'colors' || $choice['choice_title'] == 'color'||$choice['choice_title'] == 'Colors' || $choice['choice_title'] == 'Color')
                                <select id="inputState" class="form-control" name="{{$choice['choice_title']}}">
                                    <option value="" selected disabled>{{$choice['choice_title']}}</option>
                                    @foreach($choice['options'] as $option)
                                        <option style="background-color:{{$option['option_title']}}" value="{{$option['option_title']}}">{{$option['option_title']}}</option>
                                    @endforeach
                                </select>
                                @else
                                <select id="inputState" class="form-control" name="{{$choice['choice_title']}}">
                                    <option value="" selected disabled>{{$choice['choice_title']}}</option>
                                    @foreach($choice['options'] as $option)
                                        <option value="{{$option['option_title']}}">{{$option['option_title']}}</option>
                                    @endforeach
                                </select>
                            @endif

                        @endforeach

                        <input class="form-control" type="number" name="quantity" min="1" placeholder="Quantity" value="1">
{{--                        <a class="btn btn-danger mr-2" href="checkout.html">Buy Now</a>--}}
                        <button class="btn btn-warning" type="submit">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
        $(document).ready(function(){
            // Get value on button click and show alert
            $(".color").click(function(){
                var color = $(".color").val();
            });

            $(".size").click(function(){
                var size = $(".size").val();
                alert(size);
            });
            $("#addtocartform").on('submit', function(e) {
               let cartformdata = $("#addtocartform").serializeArray();
               // console.log(cartformdata);
               // console.log(cartformdata[1].value);
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
                                type:'GET',
                                url:"{{ route('storeCartItemSingle') }}",
                                data:{"_token": "{{ csrf_token() }}","data":cartformdata,"product_id":cartformdata[1].value,"quantity":cartformdata[2].value},
                                success:function(data){
                                    Swal.fire(
                                        "ADDED!",
                                        "Your item has been add to Cart.",
                                        "success"
                                    );

                                    console.log(data);
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



            });
        });



    </script>
@endsection
