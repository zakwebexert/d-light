@extends('site.layout.default')
@section('title',$title)
@section('content')
    <div class="page-content-wrapper">
        <div class="container">
            <!-- Profile Wrapper-->
            <div class="profile-wrapper-area py-3">

                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
                <!-- User Information-->

                <!-- User Meta Data-->
                <div class="card user-data-card">
                    <div class="card-body">
                        <form action="{{route('update_profile')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="title mb-2"><i class="lni lni-user"></i><span>Username</span></div>
                                <input class="form-control" name="name" type="text" value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <div class="title mb-2"><i class="lni lni-phone"></i><span>Phone</span></div>
                                <input class="form-control" name="phone" type="text" value="{{$user->phone}}">
                            </div>
                            <div class="form-group">
                                <div class="title mb-2"><i class="lni lni-envelope"></i><span>Email Address</span></div>
                                <input class="form-control" name="email" type="email" value="{{$user->email}}">
                            </div>
                            <button class="btn btn-success w-100" type="submit">Save All Changes</button>
                        </form>
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
