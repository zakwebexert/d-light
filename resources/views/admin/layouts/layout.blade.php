
<!--begin::Main-->
@include('admin.partials._header-mobile')
		<!--[html-partial:include:{"file":"partials/_header-mobile.html"}]/-->
		<div class="d-flex flex-column flex-root">

			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				@include('admin.partials._aside')
				<!--[html-partial:include:{"file":"partials/_aside.html"}]/-->

				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					@include('admin.partials._header')
					<!--[html-partial:include:{"file":"partials/_header.html"}]/-->

					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						@include('admin.partials._subheader.subheader-v1')
						<!--[html-partial:include:{"file":"partials/_subheader/subheader-v1.html"}]/-->
             @yield('content')
						<!--Content area here-->
					</div>

					<!--end::Content-->
					@include('admin.partials._footer')
					<!--[html-partial:include:{"file":"partials/_footer.html"}]/-->
				</div>

				<!--end::Wrapper-->
			</div>

			<!--end::Page-->
		</div>

		<!--end::Main-->