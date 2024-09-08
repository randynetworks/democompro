<div class="position-relative">
    <div class="shape overflow-hidden text-footer ">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="rgb(14, 54, 86)"></path>
        </svg>
    </div>
</div>
<!-- Footer Start -->
<footer class="footer" style="background-color: rgb(14, 54, 86)">
    <section class="section">
        <div class="container">
            <div class="row ">
                <style>
                @media (max-width: 767.98px) {
                    .custom-margin {
                        margin-top: 3rem !important; 
                    }
                }
                </style>
                <div class="col-lg-5 col-md-6 order-2 order-md-1 custom-margin">
                    <h5 class="footer-head">@lang('layout.logo_ojk')</h5>
                    <a href="https://www.ojk.go.id/id/Default.aspx" class="logo-footer" target="blank">
                        <img src="{{ asset('landric/images/logo-ojk.png') }}" style="width: auto; height: 67px;"
                            alt="" class="mt-4 mb-4">
                    </a>

                    <h5 class="footer-head mt-4">@lang('layout.logo_indo_re')</h5>
                    </p>
                    <a href="https://www.indonesiare.co.id/" class="logo-footer" target="blank">
                        <img src="{{ asset('images/indo_re.svg') }}" style="width: 124px; height: 67px;"
                            alt="" class="mt-4">
                    </a>
                </div><!--end col-->

                <div class="col-lg-7 col-md-6 order-1 order-md-2 ">
                    <h5 class="footer-head">@lang('layout.detail_kontak')</h5>
                    <!-- <p class="text-muted">Start working with <span class="text-primary fw-bold">Landrick</span>
                        that can provide everything you need to generate awareness, drive traffic, connect.</p> -->
                    <div class="d-flex contact-detail align-items-center mt-3">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-mail fea icon-m-md text-dark me-3">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div class="flex-1 content">
                            <h6 class="title fw-bold mb-0">Email</h6>
                            <a href="mailto:{{ $kontak[0]->email ?? '' }}"
                                class="text-muted">{{ $kontak[0]->email ?? '' }}</a>
                        </div>
                    </div>

                    <div class="d-flex contact-detail align-items-center mt-3">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-phone fea icon-m-md text-dark me-3">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1 content">
                            <h6 class="title fw-bold mb-0">@lang('layout.tlp')</h6>
                            <a href="#" class="text-muted">{{ $kontak[0]->phone ?? '' }}</a>
                        </div>
                    </div>

                    <div class="d-flex contact-detail align-items-center mt-3">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-map-pin fea icon-m-md text-dark me-3">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div class="flex-1 content">
                            <h6 class="title fw-bold mb-0">@lang('layout.lokasi')</h6>
                            <a href="{{$kontak[0]->maps}}" target="_blank"
                                class="video-play-icon text-muted lightbox">
                                <pre>{{ $kontak[0]->location ?? '' }}</pre>
                            </a>
                        </div>
                    </div>

                    <div class="d-flex contact-detail align-items-center mt-3">
                        <div class="icon">
                            <ul class="list-unstyled social-icon foot-social-icon me-3">
                                <li class="list-inline-item"><i data-feather="instagram"></i></li>
                            </ul>
                        </div>
                        <div class="flex-1 content">
                            <h6 class="title fw-bold mb-0">Instagram</h6>
                            <a href="{{ $kontak[0]->url_instagram }}"
                                class="rounded me-2 text-muted" target="_blank">{{ $kontak[0]->instagram ?? '' }}
                            </a>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </section>

    <div class="position-relative">
        <div class="shape overflow-hidden text-footer ">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="#46A748"></path>
            </svg>
        </div>
    </div>
    <!-- <div class="footer-py-30 footer-bar bg-hijau">
        <div class="container text-center">{{ config('app.version') }}
            <p class="text-foot fw-bolder text-white mb-0">
                @lang('layout.hak_cipta')
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script> ReIndo Syariah
            </p>
        </div>
    </div> -->
    <div class="footer-py-30 footer-bar bg-hijau">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <p class="text-foot fw-bolder text-white mb-0">
                    @lang('layout.hak_cipta')
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> ReIndo Syariah
                </p>
            </div>
            <div class="col-md-6 text-center">
                <p class="text-foot fw-bolder text-white mb-0">
                    v{{ config('app.version') }}
                </p>
            </div>
        </div>
    </div>
</div>


</footer>
<!-- Back to top -->
<a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fs-5"><i data-feather="arrow-up"
        class="fea icon-sm icons align-middle"></i></a>

<!-- FLOATING BUTTON -->
<style>
/* Floating Button Styles */
.floating-button {
    position: fixed;
    bottom: 80px;
    right: 23px;
    background-color: #1C74BC;
    color: white;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

/* Submenu Floating Buttons Styles */
.submenu-buttons {
    position: fixed;
    bottom: 130px;
    right: 20px;
    display: none;
    flex-direction: column;
    align-items: flex-end;
    z-index: 999;
}

.submenu-buttons .submenu-navigation {
    background: white;
    border: 1px solid #ddd;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

.submenu-buttons .submenu-navigation li {
    list-style: none;
}

.submenu-buttons .submenu-navigation a {
    display: block;
    padding: 10px 15px;
    color: #333;
    text-decoration: none;
    transition: background-color 0.3s;
}

.submenu-buttons .submenu-navigation a:hover {
    background-color: #f0f0f0;
}

/* Hide navbar and show floating button on small screens */
@media (max-width: 991px) {
    /* #navigation {
        display: none;
    } */
    .floating-button {
        display: flex;
    }
}

/* Hide floating button on larger screens */
@media (min-width: 992px) {
    .floating-button {
        display: none;
    }
}

/* Hide submenus by default */
.submenu-f {
    display: none;
}

</style>

<!-- Floating Button -->
<div id="floating-button" class="floating-button">
    <i class="bi bi-list"></i>
</div>

<!-- Submenu Floating Buttons -->
<div id="submenu-buttons" class="submenu-buttons">
    <div class="submenu-navigation">
        <li class="hover-black"><a href="{{ route('home') }}"
                class="sub-menu-item maven-pro hover-black @if ($active == 'home') text-primary @else text-black @endif">@lang('layout.profil.beranda')</a>
        </li>
        <li class="has-submenu parent-menu-item maven-pro">
            <a href="javascript:void(0)"
                class="@if ($active == 'about_us') text-primary @else text-black @endif parent-link">@lang('layout.perusahaan_kami.perusahaan_kami')</a>
            <ul class="submenu-f">
                <li class="hover-black"><a href="{{ route('tentang.kami') }}#about-us"
                        class="sub-menu-item maven-pro hover-black">@lang('layout.perusahaan_kami.profil')</a></li>
                <li class="hover-black"><a href="{{ route('tentang.kami') }}#struktur-organisasi"
                        class="sub-menu-item maven-pro hover-black">@lang('layout.perusahaan_kami.struktur_organisasi')</a></li>
                <li class="hover-black"><a href="{{ route('tentang.kami') }}#top-manajemen"
                        class="sub-menu-item maven-pro hover-black">@lang('layout.perusahaan_kami.top_manajemen')</a></li>
                <li class="hover-black"><a href="{{ route('tentang.kami') }}#kepala-divisi"
                        class="sub-menu-item maven-pro hover-black">@lang('layout.perusahaan_kami.kadiv')</a></li>
                <li class="hover-black"><a href="{{ route('tentang.kami') }}#laporan-keuangan"
                        class="sub-menu-item maven-pro hover-black">@lang('layout.perusahaan_kami.laporan_keuangan')</a></li>
            </ul>
        </li>
        <li class="hover-black"><a href="{{ route('solusi') }}"
                class="sub-menu-item maven-pro hover-black @if ($active == 'solusi') text-primary @else text-black @endif">@lang('layout.profil.solusi')</a>
        </li>
        <li class="has-submenu parent-menu-item maven-pro">
            @php
                $currentRoute = Route::currentRouteName();
            @endphp
            <a href="javascript:void(0)"
                class="@if ($active == 'media') text-primary @else text-black @endif parent-link">@lang('layout.media.media_info')</a>
            <ul class="submenu-f">
                <li class="hover-black"><a href="{{ route('berita') }}"
                        class="sub-menu-item maven-pro hover-black" style="{{ $currentRoute == 'berita' ? 'color: #1C74BC !important;' : '' }}">@lang('layout.media.berita')</a></li>
                <li class="hover-black"><a href="{{ route('artikel') }}"
                        class="sub-menu-item maven-pro hover-black" style="{{ $currentRoute == 'artikel' ? 'color: #1C74BC !important;' : '' }}">@lang('layout.media.artikel')</a></li>
                <li class="hover-black"><a href="{{ route('sertifikasi') }}"
                        class="sub-menu-item maven-pro hover-black" style="{{ $currentRoute == 'sertifikasi' ? 'color: #1C74BC !important;' : '' }}">@lang('layout.media.sertifikasi')</a></li>
                <li class="hover-black"><a href="{{ route('penghargaan') }}"
                        class="sub-menu-item maven-pro hover-black" style="{{ $currentRoute == 'penghargaan' ? 'color: #1C74BC !important;' : '' }}">@lang('layout.media.award')</a></li>
                <li class="hover-black"><a href="{{ route('kegiatan') }}"
                        class="sub-menu-item maven-pro hover-black" style="{{ $currentRoute == 'kegiatan' ? 'color: #1C74BC !important;' : '' }}">@lang('layout.media.dokumentasi')</a></li>
                <li class="hover-black"><a href="{{ route('videos') }}"
                        class="sub-menu-item maven-pro hover-black" style="{{ $currentRoute == 'videos' ? 'color: #1C74BC !important;' : '' }}">@lang('layout.media.podcast')</a></li>
                <li class="hover-black"><a href="{{ route('karir') }}"
                        class="sub-menu-item maven-pro hover-black" style="{{ $currentRoute == 'karir' ? 'color: #1C74BC !important;' : '' }}">@lang('layout.karir.nav')</a></li>
            </ul>
        </li>
        <li class="has-submenu parent-menu-item maven-pro">
            <a href="javascript:void(0)"
                class="@if ($active == 'kontak') text-primary @else text-black @endif parent-link">@lang('layout.profil.kontak_kami')</a>
            <ul class="submenu-f">
                <li class="hover-black"><a href="{{ route('pengaduan.konsumen') }}"
                        class="sub-menu-item maven-pro hover-black">@lang('layout.profil.pengaduan')</a></li>
                <li class="hover-black"><a href="{{ route('whistleblowing') }}"
                        class="sub-menu-item maven-pro hover-black">@lang('layout.profil.whistleblowing')</a></li>
            </ul>
        </li>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#floating-button').click(function() {
            $('#submenu-buttons').toggle();
        });

        $('.parent-link').click(function() {
            $(this).siblings('.submenu-f').toggle();
        });
    });
</script>