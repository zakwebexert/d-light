@extends('site.layout.default')
@section('title','all flash sale')
@section('content')
    <div class="page-content-wrapper">
        <!-- Top Products-->
        <div class="top-products-area pt-3">
            <div class="container">
                <div class="section-heading d-flex align-items-center justify-content-between">
                    <h6 class="ml-1">Your Wishlist ({{count($list)}})</h6>
                    <!-- Layout Options-->
                    <div class="layout-options"><a class="active" href="{{route('my_wish_list')}}"><i class="lni lni-grid-alt"></i></a>
                        <a href="{{route('wishlist_list')}}"><i class="lni lni-radio-button"></i></a></div>
                </div>
                <div class="row">
                    <!-- Single Top Product Card-->
                    @foreach($list as $list_item)
                        <div class="col-6 col-sm-4 col-lg-3">
                            <div class="card top-product-card mb-3" style="position: relative;height: 260px !important;z-index: 1;">
                                <div class="card-body"><a class="product-thumbnail d-block" href="{{route('product.show',$list_item->item->name)}}"><img style="height:170px;background-size: contain;" class="mb-2" src="{{ asset('productImage/'.$list_item->item->image)}}" alt=""></a><a class="product-title d-block" href="{{route('product.show',$list_item->item->name)}}">{{$list_item->item->name}}</a>
                                    <p class="sale-price">${{$list_item->item->price}}</p>
                                </div>
                            </div>
                        </div>

                @endforeach
                    <div class="col-12">
                                <div class="select-all-products-btn mb-3"><a class="btn btn-danger w-100" href="javascript:cart();">Add All To Cart</a></div>
                    </div>
                <!-- Single Top Product Card-->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script>

        function cart() {
            //console.log({{json_encode($ids)}})
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
                        url:"{{ route('wishlist_cart') }}",
                        data:{"_token": "{{ csrf_token() }}","ids":{{json_encode($ids)}}},
                        success:function(data){
                            console.log(data);
                            Swal.fire(
                                "ADDED!",
                                "Your items has been add to Cart.",
                                "success"
                            );
                            location.reload();
                        }
                    });

                    {{--var APP_URL = {!! json_encode(url('/')) !!}--}}
                    {{--    window.location.href = APP_URL+"/site/remove/"+id;--}}
                }
            });
        }

    </script>
@endsection
