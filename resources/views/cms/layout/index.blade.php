<!DOCTYPE html>
<html lang="en">
	<head><base href="../">
		<title>ReIndo Syariah CMS</title>
		<meta name="description" content="ReIndo Syariah CMS" />
		<meta name="keywords" content="Reindo, Reasuransi, Asuransi, Asuransi Syariah, asuransi takaful, perlindungan syariah, produk asuransi syariah, pengelolaan dana syariah, tabarru', mudharabah, murabahah, musyarakah, wakalah, manfaat asuransi, kepatuhan syariah, jaminan syariah, keadilan finansial, perlindungan keluarga, investasi syariah">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		{{-- <link rel="shortcut icon" href="{{ asset('metronic/dist/assets/media/logos/favicon.ico') }}" /> --}}
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="{{ asset('metronic/dist/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('metronic/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('metronic/dist/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!-- flaticon -->
		<!--end::Global Stylesheets Bundle-->

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}">
        <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/mstile-150x150.png') }}">
        <meta name="theme-color" content="#ffffff">
		
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Maven+Pro" />
    	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;700&display=swap">

		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<!-- style custom -->
		<style>
			.fixed-w-150px {
				width: 150px !important;
			}
			.fixed-w-125px {
				width: 125px !important;
			}
			.fixed-w-250px {
				width: 250px !important;
			}
			.readonly-input {
				cursor: not-allowed; /* Mengubah kursor menjadi not allowed */
			}
			.maven-pro {
				font-family: 'Maven Pro', sans-serif; /* mengubah jenis font menjadi maven pro */
			}
		</style>
		@yield('css')
	</head>
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div id="kt_aside" class="aside aside-light aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
					<div class="aside-logo flex-column-auto" id="kt_aside_logo">
						<a href="{{ route('dashboard') }}">
							<img alt="Logo" src="{{ asset('images/logo-reindo-header.png') }}"  class="h-40px logo" />
						</a>
						<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
							<span class="svg-icon svg-icon-1 rotate-180">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
									<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
								</svg>
							</span>
						</div>
					</div>

					@include('cms.layout.sidebar')
				</div>
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					@include('cms.layout.header')

					<!-- session untuk mmebuat alert -->
    				<div id="kt_content_container" class="container-xxl">
						@if ($message = Session::get('sukses'))
							<div id="alertSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>{{ $message }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@elseif($message = Session::get('gagal'))
							<div id="alertDanger" class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>{{ $message }}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
					</div>
					
					@yield('content')

					@include('cms.layout.footer')
				</div>
			</div>
		</div>
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
				</svg>
			</span>
		</div>


		<script>
			// Delay closing the success alert after 2 seconds
			document.addEventListener('DOMContentLoaded', function() {
				setTimeout(function() {
					var alertSuccess = document.getElementById('alertSuccess');
					if (alertSuccess) {
						alertSuccess.style.display = 'none';
					}
				}, 3500);
				setTimeout(function() {
					var alertDanger = document.getElementById('alertDanger');
					if (alertDanger) {
						alertDanger.style.display = 'none';
					}
				}, 3500);
			});
		</script>
		<script>var hostUrl = "{{ asset('metronic/dist/assets/') }}";</script>
		<script src="{{ asset('metronic/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('metronic/dist/assets/js/scripts.bundle.js') }}"></script>
		<script src="{{ asset('metronic/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<script src="{{ asset('metronic/dist/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="{{ asset('metronic/dist/assets/js/widgets.bundle.js') }}"></script>
		<script src="{{ asset('metronic/dist/assets/js/custom/widgets.js') }}"></script>
		<script src="{{ asset('metronic/dist/assets/js/custom/apps/chat/chat.js') }}"></script>
		<script src="{{ asset('metronic/dist/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
		<script src="{{ asset('metronic/dist/assets/js/custom/utilities/modals/users-search.js') }}"></script>

		<script src="{{ asset('metronic/src/plugins/formvalidation/dist/js/FormValidation.min.js') }}"></script>
		<script src="{{ asset('metronic/src/plugins/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
		<script src="{{ asset('metronic/src/plugins/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    	<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>


		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;700&display=swap">

		<script src="https://cdn.ckeditor.com/4.20.1/full-all/ckeditor.js"></script>

		<script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.4/dayjs.min.js"></script>

		@yield('js')
    	@stack('js')
	</body>
</html>
