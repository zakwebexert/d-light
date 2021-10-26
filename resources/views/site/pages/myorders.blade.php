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
                            @foreach($orders as $order)
                                <tr>
                                    <td><p>{{$order['address']}}</p></td>
                                    <td><p>{{$order['building_Info']}}</p></td>
    `                               <td>
                                    @foreach($order['orderitems'] as $item)
                                        {{$item['product']->name}}
                                        {{$item['quantity']}}
                                        @endforeach
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
                        <h5 class="total-price mb-0">Total : $<span class="counter">131313</span></h5>
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
