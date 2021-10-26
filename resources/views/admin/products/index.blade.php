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
        <h3 class="card-label">Product List</h3>
          <div class="d-flex align-items-center" style="margin-left:20px;">
              <a class="btn btn-primary font-weight-bolder"  data-toggle="modal" data-target="#exampleModal"> <i class="la la-book"></i>Import</a>
          </div>
          <div class="d-flex align-items-center" style="margin-left:20px;">
              <a class="btn btn-secondary font-weight-bolder"  data-toggle="modal" data-target="#exampleModal2"> <i class="la la-book"></i>Import Images</a>
          </div>
      </div>
      <div class="card-toolbar">

        <!--begin::Button-->
        <a href="{{ route('products.create') }}" class="btn btn-primary font-weight-bolder">
            <span class="svg-icon svg-icon-md">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <circle fill="#000000" cx="9" cy="15" r="6" />
                        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>New Record</a>
        <!--end::Button-->
      </div>
    </div>
    <div class="card-body">
	    @include('admin.partials._messages')
      <div>

      <!--begin: Datatable-->
      <table class="table table-bordered table-hover table-checkable" id="clients" style="margin-top: 13px !important">
        <thead>
        <tr>
	        <th>
		        <label class="checkbox checkbox-outline checkbox-success"><input type="checkbox"><span></span></label>

	        </th>

          <th>Name</th>
          <th>Category</th>
          <th>Style</th>
          <th>Price</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
        </thead>
      </table>
      <!--end: Datatable-->
    </div>
    </div>
	  <!-- Modal-->
	  <div class="modal fade" id="clientModel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			  <div class="modal-content">
				  <div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					  <h4 class="modal-title" id="myModalLabel">Product Detail</h4> </div>
				  <div class="modal-body"></div>
				  <div class="modal-footer">
					  <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
				  </div>
			  </div>
		  </div>
	  </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Upload CSV file</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
              <div class="modal-body">
                  <!--begin::Form-->

                  <div class="row">
                      <div class="col-xl-2"></div>
                      <p style="margin-left: 15px;">This is a sample .csv file for Products.<a href="{{route('import-products-sample')}}">click</a></p>
                  </div>
                  <form action="{{route('import-products')}}" method="POST" id="image-upload" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                          <div class="col-xl-2"></div>
                          <div class="col-xl-8">
                              <div class="my-5">
                                  <div class="form-group">
                                      <div class="custom-file">
                                          <input type="file" name="csv" class="custom-file-input" id="customFile">
                                          <label class="custom-file-label" for="customFile">Choose .csv file</label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                  <a href="javascript:void(0);"  onclick="event.preventDefault();document.getElementById('image-upload').submit();" id="kt_btn" class="btn btn-primary font-weight-bolder">
                      <i class="ki ki-check icon-sm"></i>save</a>
              </div>
          </div>
      </div>
  </div>
  <!--end::Modal-->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Upload multiple images</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
              <div class="modal-body">
                  <!--begin::Form-->

                  <div class="row">
                      <div class="col-xl-2"></div>
                      <p style="margin-left: 15px;">Select multiple images of products with  <kbd>Ctrl</kbd></p>

                  </div>
                  <form action="{{route('import-images')}}" method="POST" id="image-upload2" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                          <div class="col-xl-2"></div>
                          <div class="col-xl-8">
                              <div class="my-5">
                                  <div class="form-group">
                                      <div class="custom-file">
                                          <input type="file" name="images[]" class="custom-file-input" id="customFile" multiple>
                                          <label class="custom-file-label" for="customFile">select multiple images</label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                  <a href="javascript:void(0);"  onclick="event.preventDefault();document.getElementById('image-upload2').submit();" id="kt_btn" class="btn btn-primary font-weight-bolder">
                      <i class="ki ki-check icon-sm"></i>save</a>
              </div>
          </div>
      </div>
  </div>
  <!--end::Modal-->
  <!--end::Card-->
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

      $(document).on('click', 'th input:checkbox', function () {

          var that = this;
          $(this).closest('table').find('tr > td:first-child input:checkbox')
              .each(function () {
                  this.checked = that.checked;
                  $(this).closest('tr').toggleClass('selected');
              });
      });
      var clients = $('#clients').DataTable( {
          "order": [
              [1, 'asc']
          ],
          "processing": true,
          "serverSide": true,
          "searchDelay": 500,
          "responsive": true,
          "ajax": {
              "url":"{{ route('admin.getProducts') }}",
              "dataType":"json",
              "type":"POST",
              "data":{"_token":"<?php echo csrf_token() ?>"}
          },
          "columns":[
              {"data":"id","searchable":false,"orderable":false},
              {"data":"name"},
              {"data":"category"},
              {"data":"style_id"},
              {"data":"price"},
              {"data":"created_at"},
              {"data":"action","searchable":false,"orderable":false}
          ]
      } );
      function viewInfo(id) {

          var CSRF_TOKEN = '{{ csrf_token() }}';
          $.post("{{ route('product_detail') }}", {_token: CSRF_TOKEN, id: id}).done(function (response) {
              $('.modal-body').html(response);
              $('#clientModel').modal('show');

          });
      }
      function del(id){
          Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
          icon: "warning",
              showCancelButton: true,
              confirmButtonText: "Yes, delete it!"
      }).then(function(result) {
              if (result.value) {
                  Swal.fire(
                      "Deleted!",
                      "Your product has been deleted.",
                      "success"
                  );
                  var APP_URL = {!! json_encode(url('/')) !!}
                  window.location.href = APP_URL+"/admin/product/delete/"+id;
              }
          });
      }
      function del_selected(){
          Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonText: "Yes, delete it!"
          }).then(function(result) {
              if (result.value) {
                  Swal.fire(
                      "Deleted!",
                      "Your products has been deleted.",
                      "success"
                  );
                  $("#client_form").submit();
              }
          });
      }

  </script>
@endsection
