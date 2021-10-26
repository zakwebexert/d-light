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
                                <a href="" class="text-muted">Manage Front page</a>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="" class="text-muted">Add Products to Slide show</a>
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
                            <i class="mr-2"></i>
                            <small class="">try to scroll the page</small></h3>
                        </div>
                    </div>
                    <div class="card-body">
                    @include('admin.partials._messages')
                        <!--begin::Form-->
                        {{ Form::open([ 'route' => 'store-slide-form','class'=>'form' ,"id"=>"client_add_form", 'enctype'=>'multipart/form-data']) }}
                        @csrf
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">
                                <div class="my-5">
                                    <h3 class="text-dark font-weight-bold mb-10">Add items to slide show </h3>

                                    <div id="items_container">

                                        @if(count($slide_items) == 0)
                                            <div class="form-group row">
                                                <div class="col-6">
                                                    <select class="form-control items_class kt_select2_2" name="item_ids[]" required='true'>
                                                        @foreach ($items as $item)
                                                            <option></option>
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input type="hidden" name="num" value="{{$num}}">

                                                <div class="col-6">
                                                    <input type="text" class="form-control form-control-solid" name="items_comments[]" value="" placeholder="Enter Comment" required="true">
                                                </div>
                                            </div>
                                        @endif


                                        @foreach($slide_items as $sitem)
                                            <div class="form-group row">
                                                <div class="col-6">
                                                    <select class="form-control items_class kt_select2_2" name="item_ids[]" required='true'>
                                                        <option value="{{$sitem->product_id}}">{{$sitem->products->name}}</option>
                                                        @foreach ($items as $item)
                                                            <option></option>
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input type="hidden" name="num" value="{{$num}}">

                                                <div class="col-5">
                                                    <input type="text" class="form-control form-control-solid" name="items_comments[]" value="{{$sitem->comment}}" placeholder="Enter Comment" required="true">
                                                </div>
                                                <div class="col-1">
                                                    <a  href="javascript:void(0);" style="margin-left:5px;" class="input-group-append close2 btn btn-icon  btn-circle btn-sm mr-2"><i style="color:red;" class="flaticon2-delete"></i></a>
                                                </div>
                                                </div>
                                        @endforeach
                                    </div>

                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-9">
                                            <a onclick="myFunction()" href="javascript:void(0);" class="btn btn-icon btn-light-success btn-circle btn-sm mr-2">
                                                <i class="flaticon2-plus"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-3">
                                        </label>
                                        <div class="col-9">
                                            <a href=""  onclick="event.preventDefault(); document.getElementById('client_add_form').submit();" id="kt_btn" class="btn btn-primary float-right font-weight-bolder">
                                                <i class="ki ki-check icon-sm"></i>Save</a>
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
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script>
        $('.kt_select2_2, .kt_select2_2_validate').select2({
            placeholder: 'Select items'
        });
        var id = 2;
        function myFunction() {

            var comment = "<input type=\"comment\" name=\"items_comments[]\" id=q"+id+" class=\"form-control form-control-solid\" placeholder=\"Enter Comment\">";
            var html = '  <div class="form-group row">\n' +
                '                                            <div class="col-6">\n' +
                '                                                <select class="form-control kt_select2_2" name="item_ids[]" required=\'true\'>\n' +
                '                                                    @foreach ($items as $item)\n' +
                '                                                        <option></option>\n' +
                '                                                        <option value="{{$item->id}}">{{$item->name}}</option>\n' +
                '                                                    @endforeach\n' +
                '                                                </select>\n' +
                '                                            </div>\n' +
                '                                            <div class="col-5">\n' +
                comment+
                '                                            </div>\n' +
                '                                               \n' +
                '                                              <a  href="javascript:void(0);" style="margin-left:5px;" class="input-group-append close btn btn-icon  btn-circle btn-sm mr-2"><i style="color:red;" class="flaticon2-delete"></i></a> '+
                '                                        </div>';


            id++;

            $('#items_container').append(html);
            $('.kt_select2_2, .kt_select2_2_validate').select2({
                placeholder: 'Select items'
            });

        }

        $("body").on("click",".close",function(){
            $(this).parent().remove();
        });

        $("body").on("click",".close2",function(){
            $(this).parent().parent().remove();
        });
    </script>

@endsection
@stop

