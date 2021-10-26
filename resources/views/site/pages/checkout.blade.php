@extends('site.layout.default')
@section('title',$title)
@section('content')
    <div class="page-content-wrapper">
        <div class="container">
            <!-- Checkout Wrapper-->
            <div class="checkout-wrapper-area py-3">
                <!-- Billing Address-->
                <div class="billing-information-card mb-3">
                    <div class="card billing-information-title-card bg-danger">
                        <div class="card-body">
                            <h6 class="text-center mb-0 text-white">Billing Information</h6>
                        </div>
                    </div>
                    <div class="card user-data-card">
                        <div class="card-body">
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center"><i class="lni lni-user"></i><span>Full Name</span></div>
                                <div class="data-content">{{$user->name}}</div>
                            </div>
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center"><i class="lni lni-envelope"></i><span>Email Address</span></div>
                                <div class="data-content">{{$user->email}}</div>
                            </div>
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center"><i class="lni lni-phone"></i><span>Phone</span></div>
                                <div class="data-content">{{$user->phone}}</div>
                            </div>
                            <!-- Edit Address--><a class="btn btn-danger w-100" href="{{route('edit_profile')}}">Edit Billing Information</a>
                        </div>
                    </div>

                </div>

                <div class="billing-information-card mb-3">
                    <div class="card billing-information-title-card bg-danger">
                        <div class="card-body">
                            <h6 class="text-center mb-0 text-white">Add Address and Building info</h6>
                        </div>
                    </div>
                    <div class="card user-data-card">
                        <div class="card-body">
                                <div class="form-group text-left mb-4"><span>Address</span>
                                    <label for="address"><i class="lni lni-lock"></i></label>
                                    <input class="form-control"  id="pac-input" type="text" placeholder="Enter Address">
                                </div>
                                <input type="hidden" name="address" id="address">
                                <div class="form-group text-left mb-4"><span>Buidling info</span>
                                    <label for="building_info"><i class="lni lni-lock"></i></label>
                                    <input class="form-control" name="building_info" id="building_info" type="text" placeholder="Enter Building info">
                                </div>
                        </div>
                    </div>

                </div>

                <!-- Shipping Method Choose-->
                <div class="shipping-method-choose mb-3">
                    <div class="card shipping-method-choose-title-card bg-success">
                        <div class="card-body">
                            <h6 class="text-center mb-0 text-white">Shipping Method Choose</h6>
                        </div>
                    </div>
                    <div class="card shipping-method-choose-card">
                        <div class="card-body">
                            <div class="shipping-method-choose">
                                <ul>
                                    <li>
                                        <input id="fastShipping" type="radio" name="selector"  value="fastshipping">
                                        <label for="fastShipping">Fast Shipping<span>1 days delivary for $1</span></label>
                                        <div class="check"></div>
                                    </li>
                                    <li>
                                        <input id="normalShipping" type="radio" name="selector" checked value="normalShipping">
                                        <label for="normalShipping">Reguler<span>3-7 days delivary for $0.4</span></label>
                                        <div class="check"></div>
                                    </li>
                                    <li>
                                        <input id="courier" type="radio" name="selector" value="courier">
                                        <label for="courier">Courier<span>5-8 days delivary for $0.3</span></label>
                                        <div class="check"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Cart Amount Area-->
                <div class="card cart-amount-area">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <h5 class="total-price mb-0">$<span class="counter">{{$price}}</span></h5>
                        <a class="btn btn-warning" href="" onclick="checkout_payment();">Confirm &amp; Pay</a>
                        <input type="hidden" name="price" value="{{$price}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLR_rl5ubFeXO416DX1CVq3avkGpTj3Qs&libraries=places"></script>

    <script>
        google.maps.event.addDomListener(window, 'load', initAutocomplete);
        function initAutocomplete() {
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            let markers = [];
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();
                //console.log(places.geometry.location);

                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {

                    console.log(place.formatted_address);
                    $('#address').val(place.formatted_address);

                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }

                });

            });

        }
    </script>
    <script>
        function checkout_payment(){
            event.preventDefault();
            let shift_method = $("input[name=selector]:checked").val();
            let price = $("input[name=price]").val();
            let address = $("input[name=address]").val();
            let buildingInfo = $("input[name=building_info]").val();

            if(address == "" || buildingInfo ==""){
                alert('address and building info needed')
            }else{
                $.ajax({
                    url: "checkout-payment",
                    type:"GET",
                    data:{
                        shift_method:shift_method,
                        price:price,
                        address:address,
                        buildingInfo:buildingInfo,
                        _token: "{{ csrf_token() }}"
                    },
                    success:function(response){
                        if(response) {
                            window.location.href = "payment-methods";
                        }
                    },
                });
            }

        }
    </script>

@endsection
