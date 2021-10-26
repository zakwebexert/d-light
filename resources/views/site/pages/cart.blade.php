@extends('site.layout.default')
@section('title',$title)
@section('content')
    <div class="page-content-wrapper">
        <div class="container">
            <!-- Cart Wrapper-->
            <div class="cart-wrapper-area py-3">
                <div class="cart-table card mb-3">
                    <div class="table-responsive card-body">
                        <table class="table mb-0">
                            <tbody>
                            @include('admin.partials._messages')
                            @foreach($items as $item)
                            <tr>
                                <th scope="row"><a class="remove-product" href="javascript:remove({{$item['id']}});"><i class="lni lni-close"></i></a></th>
                                <td><img src="{{ asset('productImage/'.$item['product']->image) }}" alt=""></td>
                                <td><a href="{{route('product.show',$item['product']->name)}}">{{$item['product']->name}}<span>{{$item['product']->price}} × {{$item['quantity']}}</span></a></td>
                                <td>
                                    <div class="quantity">
                                        <input class="qty-text" type="text" value="{{$item['quantity']}}" disabled>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Cart Amount Area-->
                <div class="card cart-amount-area">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <h5 class="total-price mb-0">$<span class="counter">{{$price}}</span></h5><a class="btn btn-warning" href="{{route('checkout')}}">Checkout Now</a>
                    </div>
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
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, remove it!"
                }).then(function(result) {
                    if (result.value) {
                        Swal.fire(
                            "Deleted!",
                            "Your item has been removed.",
                            "success"
                        );
                        var APP_URL = {!! json_encode(url('/')) !!}
                            window.location.href = APP_URL+"/site/remove/"+id;
                    }
                });
        }

    </script>
@endsection
