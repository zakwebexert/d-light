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
        <!-- Product Catagories-->
        <div class="product-catagories-wrapper pt-3">
            <div class="container">
                <div class="section-heading">
                    <h6 class="ml-1">Product Categories</h6>
                </div>
                <div class="product-catagory-wrap">
                    <div class="row">
                        <!-- Single Catagory Card-->
                        @foreach($categories as $category)
                            <div class="col-4">
                                <div class="card mb-3 catagory-card" style="background:none;box-shadow:none;display:flex;flex-direction:column;align-item:center;justify-content:center">
                                    <a href="{{route('category_product',$category->id)}}">
                                        <img src="{{asset('productImage/'.$category->image)}}" style="width:100px;height:100px;border-radius:50%;margin:0 auto;">
                                        <div class="card-body"><span>{{$category->name}}</span></a></div>
                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

@endsection
