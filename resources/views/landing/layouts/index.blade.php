<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>{{ $tagmeta->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $tagmeta->deskripsi }}">
    <meta name="keywords" content="{{ $tagmeta->keyword }}">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <meta name="google-site-verification" content="BS9Qz9PjGjz-upjlxFhekXH7JMdCAF86m9vTCqjRwU0" />

    @stack('meta')

    <!-- favicon -->
    {{-- <link rel="shortcut icon" href="{{ asset('landric/images/favicon.ico') }}" /> --}}
    <!-- Css -->
    <link href="{{ asset('landric/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
    <!-- Bootstrap Css -->
    <link href="{{ asset('landric/css/bootstrap.min.css') }}" id="bootstrap-style" class="theme-opt" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('landric/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('landric/libs/@iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet" />
    <!-- Style Css-->
    <link href="{{ asset('landric/css/style.min.css') }}" id="color-opt" class="theme-opt" rel="stylesheet"
        type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Maven+Pro" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">




    <style>
        /* maven pro */
        h1 {
            font-family: "Maven Pro" !important;
            font-size: 24px;
            font-style: normal;
            font-variant: normal;
            font-weight: 700;
            line-height: 26.4px;
        }

        h3 {
            font-family: "Maven Pro" !important;
            font-size: 14px;
            font-style: normal;
            font-variant: normal;
            font-weight: 700;
            line-height: 15.4px;
        }

        h4 {
            font-family: "Maven Pro" !important;
            font-size: 18px;
            font-style: normal;
            font-variant: normal;
            font-weight: 700;
            line-height: 19.8px;
        }

        h5 {
            font-family: "Maven Pro" !important;
            font-size: 16px;
            font-style: normal;
            font-variant: normal;
            font-weight: 700;
            line-height: 17.6px;
        }

        span {
            font-family: "Maven Pro" !important;
        }

        a {
            font-family: "Maven Pro" !important;

        }

        p {
            font-family: "Maven Pro" !important;
            font-size: 14px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 20px;
        }

        label {
            font-family: "Maven Pro" !important;
            font-size: 14px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 20px;
        }

        blockquote {
            font-family: "Maven Pro";
            font-size: 21px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 30px;
        }

        pre {
            font-family: "Maven Pro";
            font-size: 13px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 18.5714px;
        }


        @media (min-width: 1200px) {
            .container-custom {
                max-width: 1240px;
            }
        }
        @media (min-width: 992px) {
            #topnav .navigation-menu.nav-light>li>a {
                color: black
            }
        }
        @media (min-width: 370px) {
            /* #topnav .navigation-menu.nav-light>li>a {
                color: black
            } */

            .text-menu {
                color: black
            }

            .bg-biru {
                background-color: #1C75BC;
            }

            .bg-biru-1 {
                background-color: #194E83;
            }

            .bg-biru-2 {
                background-color: #d4e1f4;
            }

            .bg-hijau {
                background-color: #46A748;
            }

            .bg-hitam::before {
                background-color: rgba(59, 66, 75, 0.7);
            }

            .text-biru {
                color: #1C75BC;
            }


            .text-biru-1 {
                color: #194E83;
            }

            #calendar {
                height: 100vh;
                width: 100%;
            }

			.maven-pro {
				font-family: 'Maven Pro', sans-serif !important;
			}

            .required {
                &:after {
                    content: "*";
                    position: relative;
                    font-size: inherit;
                    color: red;
                    padding-left: 0.25rem;
                    font-weight: bold;
                }
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    @include('landing.layouts.header')

    @yield('content')

    @include('landing.layouts.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('landric/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landric/libs/tiny-slider/min/tiny-slider.js') }}"></script>
    <script src="{{ asset('landric/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('landric/js/plugins.init.js') }}"></script>
    <script src="{{ asset('landric/js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="{{ asset('metronic/src/plugins/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('metronic/src/plugins/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('metronic/src/plugins/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swal_success = '{{ session("success") }}';
            const swal_error = '{{ session("swal_error") }}';

            if (swal_success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            if (swal_error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                showConfirmButton: false,
                timer: 2000
            });
        }

        });
    </script>
    @stack('modal')
    @yield('scripts')
</body>

</html>
