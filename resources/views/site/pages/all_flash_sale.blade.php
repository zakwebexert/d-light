@extends('site.layout.default')
@section('title','all flash sale')
@section('content')

    <div class="page-content-wrapper">
        <!-- Top Products-->
        <div class="top-products-area pt-3">
            <div class="container">
                <div class="section-heading d-flex align-items-center justify-content-between">
                    <h6 class="ml-1">All Products</h6>
                </div>
                <div class="row">
                    <!-- Single Flash Sale Card-->
                    @foreach($all_flash_sale as $flash_item)
                        <div class="col-6 col-sm-4 col-md-3">
                            <div class="card flash-sale-card mb-3" style="position: relative;height: 280px !important;z-index: 1;">
                                <div class="card-body"><a class="wishlist-btn" style="color: #ea4c62;" href="javascript:remove({{$flash_item['products']->id}});"><i class="lni lni-heart"></i></a><a href="{{route('product.show',$flash_item['products']->name)}}"><img style="height:170px;background-size: contain;" src="{{asset('productImage/'.$flash_item['products']->image)}}" alt=""><span class="product-title">{{$flash_item['products']->name}}</span>

                                    </a>
                                    <div style="width: 100%;display: flex; flex-direction: row; justify-content: space-between;">
                                <p class="sale-price">${{$flash_item['products']->price}}</p>
                                <a class="btn btn-success btn-sm add2cart-notify" style="padding: 0;padding-top:5px;border-radius:30px; width:30px; height: 30px;" href="javascript:cart({{$flash_item['products']->id}});"><i class="lni lni-plus"></i></a>
                                </div>
                                    </div>
                            </div>
                        </div>
                @endforeach
                <!-- Single Flash Sale Card-->
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

    </script>
     <script>
        $("document").ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#upload").change(function() {
                //console.log( $(this).val() );
                var formData = new FormData($("#image-upload")[0]);
                $.ajax({
                    type:'POST',
                    url: "{{ url('site/change-profile-pic')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        alert('File has been uploaded successfully');
                        console.log(data);
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
