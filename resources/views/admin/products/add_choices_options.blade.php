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
                                <a href="" class="text-muted">Add Choices and options</a>
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
                            <h3 class="card-label">ADD CHOICES AND OPTIONS
                                <i class="mr-2"></i>
                                <small class="">try to scroll the page</small></h3>

                        </div>
                        <div class="card-toolbar">

                            <a href="{{ route('products.index') }}" class="btn btn-light-primary
              font-weight-bolder mr-2">
                                <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>

                            <div class="btn-group">
                                <a href="{{ route('products.addOptions') }}"  onclick="event.preventDefault(); document.getElementById('client_add_form').submit();" id="kt_btn" class="btn btn-primary font-weight-bolder">
                                    <i class="ki ki-check icon-sm"></i>Save</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    @include('admin.partials._messages')
                    <!--begin::Form-->
                        {{ Form::open([ 'route' => 'products.addOptions','method'=>'post','class'=>'form' ,"id"=>"client_add_form", 'enctype'=>'multipart/form-data']) }}
                        @csrf
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">
                                <div class="my-5">
                                    <h3 class="text-dark font-weight-bold mb-10">Add Choice: </h3>
                                    <input type="hidden" name ="product_id" value="{{$product_id}}">
                                    <div id="colorContainer">
                                        <div class="form-group row {{ $errors->has('choice') ? 'has-error' : '' }}">
                                            <label class="col-3">Choice Title</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control form-control-solid" id="choiceId" name="choice">
                                                <span class="text-danger">{{ $errors->first('choice') }}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div>
                                            <div class="optionclass">
                                                <div class="form-group row">
                                                    <label class="col-3"></label>
                                                    <label class="col-3">Option Title</label>
                                                    <div class="col-6 optionInput">
                                                        <input type="text" class="form-control form-control-solid" id="optionId" name="option[]">
                                                        <span class="text-danger">{{ $errors->first('option') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <a style="margin-left: 650px; margin-top: 20px;" href="javascript:void(0);" class="btn btn-icon btn-light-success btn-circle btn-sm mr-2 btnoption"><i class="flaticon2-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
{{--                                    <div class="form-group row">--}}
{{--                                        <div class="col-9">--}}
{{--                                            <a onclick="addChoice()" href="javascript:void(0);" class="btn btn-icon btn-light-success btn-circle btn-sm mr-2">--}}
{{--                                                <i class="flaticon2-plus"></i>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
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
    <script>
        var letter = 2;
        function addChoice() {

            var html = '                                   <div>' +
                '                                           <div class="form-group row">\n' +
                '                                            <label class="col-3">Choice '+letter+'</label>\n' +
                '                                            <div class="col-8">\n' +
                '                                                <input type="text" class="form-control form-control-solid" name="choice[]">\n' +
                '                                                <span class="text-danger"></span>\n' +
                '                                            </div>\n' +
                '<a  href="javascript:void(0);" style="margin-left:5px;" class="input-group-append close btn btn-icon  btn-circle btn-sm mr-2"><i style="color:red;" class="flaticon2-delete"></i></a> '+
                '                                        </div>' +
                '<hr>\n' +
                '                                        <div>\n' +
                '                                        <div class="optionclass">\n' +
                '                                            <div class="form-group row">\n' +
                '                                                <label class="col-3"></label>\n' +
                '                                                <label class="col-3">Option</label>\n' +
                '                                                <div class="col-6">\n' +
                '                                                    <input type="text" class="form-control form-control-solid" id="optionId" name="option[]">\n' +
                '                                                </div>\n' +
                '                                         </div>\n' +
                '                                         </div>\n' +
                '                                                <div class="form-group row">\n' +
                '                                                    <div class="col-12">\n' +
                '                                                        <a style="margin-left: 650px; margin-top: 20px;" href="javascript:void(0);" class="btn btn-icon btn-light-success btn-circle btn-sm mr-2 btnoption">\n' +
                '                                                            <i class="flaticon2-plus"></i>\n' +
                '                                                        </a>\n' +
                '                                                    </div>\n' +
                '                                                </div>\n' +
                '                                            </div>\n' +
                '                                        </div>' +
                '                                       </div>';


            $('#colorContainer').append(html);
            letter++;
        }

        $("body").on("click",".btnoption",function(){

            // var optioninput = $(this).parent().parent().parent().find('.optionclass').html();
            // console.log(optioninput);
            var html = '<div class="form-group row">\n' +
                '           <label class="col-3"></label>\n' +
                '           <label class="col-3">Option</label>\n' +
                '                <div class="col-5">\n' +
                '                    <input type="text" class="form-control form-control-solid" id="optionId" name="option[]">\n' +
                '                </div>\n' +
                '<a  href="javascript:void(0);" style="margin-left:5px;" class="input-group-append closeop btn btn-icon  btn-circle btn-sm mr-2"><i style="color:red;" class="flaticon2-delete"></i></a> '+
                '           </div>' +
                '       </div>';
            $(this).parent().parent().parent().find('.optionclass').append(html);

        });

        $("body").on("click",".close",function(){
            $(this).parent().parent().remove();
        });
        $("body").on("click",".closeop",function(){
            $(this).parent().remove();
        });
    </script>

@endsection
@stop

