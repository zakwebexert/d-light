@extends('admin.layouts.master')
@section('title',$title)
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader" kt-hidden-height="54" style="">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item text-muted">
                                <a href="" class="text-muted">Manage Products</a>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="" class="text-muted">Add Product</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom card-sticky" id="kt_page_sticky_card">
                    <div class="card-header" style="">
                        <div class="card-title">
                            <h3 class="card-label">Product Add Form
                                <i class="mr-2"></i>
                                <small class="">try to scroll the page</small></h3>

                        </div>
                        <div class="card-toolbar">

                            <a href="{{ route('products.index') }}" class="btn btn-light-primary
              font-weight-bolder mr-2">
                                <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>

                            <div class="btn-group">
                                <a href="{{ route('products.store') }}"  onclick="event.preventDefault(); document.getElementById('client_add_form').submit();" id="kt_btn" class="btn btn-primary font-weight-bolder">
                                    <i class="ki ki-check icon-sm"></i>Save</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    @include('admin.partials._messages')
                    <!--begin::Form-->
                        {{ Form::open([ 'route' => 'products.store','class'=>'form' ,"id"=>"client_add_form", 'enctype'=>'multipart/form-data']) }}
                        @csrf
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">
                                <div class="my-5">
                                    <h3 class="text-dark font-weight-bold mb-10">Product Info: </h3>

                                    <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label class="col-3">Name</label>
                                        <div class="col-9">
                                            {{ Form::text('name', null, ['class' => 'form-control form-control-solid','id'=>'name','placeholder'=>'Enter Name','required'=>'true']) }}
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row {{ $errors->has('desc') ? 'has-error' : '' }}">
                                        <label class="col-3">Description
                                        </label>
                                        <div class="col-9">
                                            {{ Form::text('desc', null, ['class' => 'form-control form-control-solid','id'=>'name','placeholder'=>'Enter Description','required'=>'true']) }}
                                            <span class="text-danger">{{ $errors->first('desc') }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row {{ $errors->has('category') ? 'has-error' : '' }}">
                                        <label class="col-3">Select Category</label>
                                        <div class="col-9">
                                            <select class="form-control category" id="kt_select2_1" name="category" required='true'>
                                                @foreach ($categories as $category)
                                                    <option></option>
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('category') }}</span>
                                        </div>
                                    </div>


                                    <div class="form-group row {{ $errors->has('style') ? 'has-error' : '' }}">
                                        <label class="col-3">Select Style</label>
                                        <div class="col-9">
                                            <select class="form-control styles" name="style_id" required='true'>
                                                <option value="">Select style</option>
                                                @foreach($styles as $style)
                                                    <option value="{{$style->id}}">{{$style->style_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('style') }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row {{ $errors->has('image') ? 'has-error' : '' }}">
                                        <label class="col-3">Image
                                        </label>
                                        <div class="col-9">
                                            {{ Form::file('image', null, ['class' => 'form-control form-control-solid','id'=>'image','placeholder'=>'Enter Description','required'=>'true']) }}
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row {{ $errors->has('price') ? 'has-error' : '' }}">
                                        <label class="col-3">Price</label>
                                        <div class="col-9">
                                            {{ Form::text('price', null, ['class' => 'form-control form-control-solid','id'=>'price','placeholder'=>'Enter Price','required'=>'true']) }}
                                            <span class="text-danger">{{ $errors->first('price') }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-3">Multiple Images(optional)</label>
                                        <div class="col-9">
                                            <input type="file" name="images[]" class="form-control form-control-solid" multiple>
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div class="col-xl-2"></div>
                        </div>
                    {{Form::close()}}
                    <!--end::Form-->
                    </div>
                </div>
                <!--end::Card-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@section('scripts')

        <script>
            $('#kt_select2_1').select2({
                placeholder: 'Select Category'
            });
        </script>
        <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>


{{--        <script>--}}
{{--            $('.category').on('change', function() {--}}
{{--                $.ajax({--}}
{{--                    type:'POST',--}}
{{--                    url:"{{ route('admin.category_styles') }}",--}}
{{--                    data:{"_token": "{{ csrf_token() }}","id":this.value},--}}
{{--                    success:function(data){--}}
{{--                        var options = $(".styles");--}}
{{--                        $.each(data, function() {--}}
{{--                            options.append($("<option />").val(this.id).text(this.style_name));--}}
{{--                        });--}}
{{--                    }--}}
{{--                });--}}

{{--                    // $('#category').append(--}}
{{--                    //     `<option value="Accounting">Accounting</option><option value="Bank">Bank</option><option value="Gate">Gate</option>   <option value="Generator">Generator</option>   <option value="Insurance">Insurance</option>   <option value="Internet - Phone">Internet - Phone</option>   <option value="Landscaping">Landscaping</option>   <option value="Legal">Legal</option>   <option value="Lighting">Lighting</option>   <option value="Mailboxes">Mailboxes</option>   <option value="Mangrove Mitigation">Mangrove Mitigation</option>   <option value="Other">Other</option>   <option value="Pest Control">Pest Control</option>   <option value="Property Management">Property Management</option>   <option value="Roadway">Roadway</option>   <option value="Sewer Plant">Sewer Plant</option>   <option value="Tree Trimming">Tree Trimming</option><option value="website">Website</option>`--}}
{{--                    // );--}}
{{--            });--}}
{{--        </script>--}}

@endsection
@stop

