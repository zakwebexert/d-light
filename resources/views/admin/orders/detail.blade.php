@extends('admin.layouts.master')
@section('title',$title)
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
					<span class="card-icon">
						<i class="flaticon-users text-primary"></i>
					</span>
                <h3 class="card-label">Order detail</h3>


            </div>
        </div>
        <div class="card-body">
            @include('admin.partials._messages')
            <div class="table-responsive">
                <!--begin: Datatable-->
                <div class="container">
                    <!-- Checkout Wrapper-->
                    <table class="table border border-primary">
                        <thead>
                        <tr>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Building info</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$order['user']->name}}</td>
                            <td>{{$order['user']->email}}</td>
                            <td>{{$order['user']->phone}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->building_Info}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table border border-primary">
                        <thead>
                        <tr>
                            <th scope="col">Shiffing method</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$order->shiffing_method}}</td>
                            <td>{{$order->total}} USD</td>
                            <td>{{$order->status}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table border border-primary">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Product Choices</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><img style="height:130px;width: 130px;" src="{{ asset('productImage/'.$product['image'])}}" alt=""></td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}} USD</td>
                                <td>{{$product->quantity}}</td>

                                <td style="width: 300px">
                                    @foreach($product->choices as $choice)
                                        @if($choice[0] == 'colors')
{{--                                            <div>--}}
{{--                                            <p style="float: left;width: 60px;">{{$choice[0]}} :</p>--}}
{{--                                            <p style="float: right; height:40px;width:130px;background-color: {{$choice[1]}}"></p>--}}
{{--                                            </div>--}}
                                            <table>
                                                <tr>
                                                    <td>{{$choice[0]}} :</td>
                                                    <td style="background-color: {{$choice[1]}}">{{$choice[1]}}</td>
                                                </tr>
                                            </table>
                                        @else
                                            <table>
                                                <tr>
                                                    <td>{{$choice[0]}} :</td>
                                                    <td>{{$choice[1]}}</td>
                                                </tr>
                                            </table>
                                        @endif
                                    @endforeach
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <button class="btn btn-primary" onclick="change({{$order->id}})">Processed</button>
                </div> <!--end: Datatable-->
            </div>
        </div>
@endsection
@section('stylesheets')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
          type="text/css" />
    <!--end::Page Vendors Styles-->
@endsection
@section('scripts')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <script>
        function change(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "success",
                showCancelButton: true,
                confirmButtonText: "Yes, processed it!"
            }).then(function(result) {
                if (result.value) {
                    Swal.fire(
                        "Processed!",
                        "Your order has been processed.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL+"/admin/change_order_status/"+id;
                }
            });
        }


    </script>
@endsection
