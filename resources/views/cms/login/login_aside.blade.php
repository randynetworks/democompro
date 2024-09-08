<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<title>{{ $tagmeta->title }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="{{ $tagmeta->deskripsi }}">
		<meta name="keywords" content="{{ $tagmeta->keyword }}">
		
		{{-- <link rel="shortcut icon" href="{{ asset('metronic/dist/assets/media/logos/favicon.ico') }}" /> --}}
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}">
        <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/mstile-150x150.png') }}">

		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset ('/metronic/dist/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset ('/metronic/dist/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-column justify-content-center align-items-center w-xl-600px position-relative " style="background-color: rgba(28, 116, 188, 1); height: 100vh; background: url('{{asset('/images/frame-3.png')}}'); background-size: contain;">
                    <div class="d-flex flex-column text-center p-10 pt-lg-20">
                        <!-- <img alt="Logo" src="{{ asset('/images/logo_reindo_web.png') }}" class="h-200px"  style="-webkit-filter: drop-shadow(5px 5px 5px #222); filter: drop-shadow(5px 5px 5px #222);"/> -->
                        <img alt="Logo" src="{{ asset('/images/logo_reindo_white_p.png') }}" class="h-200px"  style="filter: drop-shadow(5px 5px 5px #222);"/>
                    </div>
                </div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form class="form w-100" id="login_form" action="{{url('proses_login')}}" method="POST">
							@csrf		
							<div class="text-center mb-10">		
								<h1 class="text-dark mb-3">LOGIN</h1>

								<!--begin::Alert-->
								@if ($message = Session::get('gagal'))									
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<strong>{{ $message }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
								@endif
								<!--end::Alert-->
							</div>	
							<div class="row">
								<div class="col-12">							
									<!-- <div class="fv-row mb-10">	 -->
									<div class="col-md-12">
										<label class="form-label fs-6 fw-bolder text-dark required">Username</label>
										<input class="form-control form-control-lg form-control-solid mb-4" type="text" name="username" id="username" autocomplete="off" />
									</div>
									<!-- </div>	 -->
									<!-- <div class="fv-row mb-10"> -->
									<div class="col-md-12">
										<div class="d-flex flex-stack mb-2 mt-2">	
											<label class="form-label fw-bolder text-dark fs-6 mb-0 required">Password</label>
										</div>	
										<input class="form-control form-control-lg form-control-solid mb-4" type="password" name="password" id="password" autocomplete="off" />
									</div>
									<!-- </div>	 -->
								</div>
							</div>
						</form>
						
							<div class="text-center mt-4">	
								<button type="submit" id="btn-submit-login" class="btn btn-lg btn-primary w-100 mb-5 mt-2">
									<span class="indicator-label">Login</span>
								</button>
							</div>
						
							<a class="btn btn-link btn-sm" href="{{ route('home') }}">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
									fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
									stroke-linejoin="round" class="feather feather-arrow-left">
									<line x1="19" y1="12" x2="5" y2="12"></line>
									<polyline points="12 19 5 12 12 5"></polyline>
								</svg>

								<span class="ms-1">Kembali</span>
							</a>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
						<!--begin::Links-->
						<div class="d-flex flex-center fw-bold fs-6">
								<span class="text-muted fw-bold me-1">2024©</span>
								<a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Reindo Syariah</a>
						</div>
						<!--end::Links-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ asset('/metronic/dist/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{ asset('/metronic/dist/assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{ asset('/metronic/dist/assets/js/custom/authentication/sign-in/general.js')}}"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>


<script src="{{ asset('metronic/src/plugins/formvalidation/dist/js/FormValidation.min.js') }}"></script>
<script src="{{ asset('metronic/src/plugins/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
<script src="{{ asset('metronic/src/plugins/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
<script>    
    $(function() {
        validasi();

		var keycode;
            $('#username').keypress(function (event) {
            keycode = (event.charCode) ? event.charCode : ((event.which) ? event.which : event.keyCode);
                if (keycode == 32) {
                    return false
                };
            });
    });

    // validasi inputan kosong
    function validasi() {
        const form = document.getElementById('login_form');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'username': {
                        validators: {
                            notEmpty: {
                                message: 'Username harus diisi.'
                            },
                        }
                    },					
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'Password harus diisi.'
                            },
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    bootstrap: new FormValidation.plugins.Bootstrap5()
                }
            }
        );

        // Submit button handler
        const submitButton = document.getElementById('btn-submit-login');
        submitButton.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function(status) {

                    if (status == 'Valid') {
                        // block_ui();
                        form.submit(); // Submit form
                    }
                });
            }
        });
    }
</script>