<!-- Navbar Start -->
<header id="topnav" class="defaultscroll sticky" style="background-color: white !important; border-bottom: 2px solid #f1f1f1;">
    {{-- <style>
        #topnav .navigation-menu>li>a {
            letter-spacing: 0px !important;
        }
    </style> --}}
    <div class="container">
        {{-- <div class="ps-5 pe-5"> --}}
        <!-- Logo container-->
        <a class="logo" href="{{url('/')}}">
            <span class="logo-light-mode">
                <img src="{{ asset('images/logo-reindo-header.png') }}" class="l-dark py-2" alt="logo"
                    style="width: 190px">
                <img src="{{ asset('images/logo-reindo-header.png') }}" class="l-light py-2 mt-1" alt="logo"
                    style="width: 190px">
            </span>
            <img src="{{ asset('images/logo-reindo-header.png') }}" class="logo-dark-mode py-2 mt-1" alt="logo"
                style="width: 190px">
        </a>
        <!-- End Logo container-->

        <!-- <div class="menu-extras">
            <div class="menu-item">
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </div>
        </div> -->

        <!-- Login button Start -->
        <ul class="buy-button list-inline mb-0">
            <style>
                .text-menu {
                    color: black !important;
                }

                .sub-menu-item.active {
                    color: #1C74BC !important;
                }

                .hover-black:hover {
                    color: black !important;
                }

                @media (max-width: 990px) {
                    .label-white {
                        color: black;
                    }

                    @media only screen and (max-width: 1024px) {
                        .hide-on-mobile {
                            display: none !important;
                        }
                    }
                }
            </style>
            <li class="list-inline-item mb-0">
                <div class="d-flex align-items-center">
                    <label class="text-menu label-white fw-bold">ID</label>
                    <div class="form-check form-switch m-0 p-0 mx-2">
                        <input class="form-check-input m-0" type="checkbox" id="flexSwitchCheckDefault">
                    </div>
                    <label class="text-menu label-white fw-bold">ENG</label>
                </div>
            </li>
        </ul>
        <!-- Login button End -->

        <div id="navigation">
            {{-- <style>
                #topnav .navigation-menu>li>a {
                    letter-spacing: 0px !important;
                }

                #topnav .navigation-menu>li {
                    margin: 0px;
                }
            </style> --}}
            <!-- Navigation Menu -->
            <ul class="navigation-menu ">
                {{-- Beranda --}}
                <li class="hover-black"><a href="{{ route('home') }}"
                        class="sub-menu-item maven-pro hover-black @if ($active == 'home') text-primary @else text-black @endif">@lang('layout.profil.beranda')</a>
                </li>
                {{-- Tentang Kami --}}
                {{-- <li class="hover-black"><a href="{{ route('tentang.kami') }}"
                        class="sub-menu-item maven-pro hover-black @if ($active == 'about_us') text-primary @else text-black @endif">@lang('layout.profil.tentang_kami')</a>
                </li> --}}
                <li class="has-submenu parent-menu-item maven-pro ">
                    <a href="javascript:void(0)"
                        class="@if ($active == 'about_us') text-primary @else text-black @endif">@lang('layout.perusahaan_kami.perusahaan_kami')</a><span class="menu-arrow"></span>
                    <ul class="submenu" onclick="scrollTo()">
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
                {{-- Solusi --}}
                <li class="hover-black"><a href="{{ route('solusi') }}"
                        class="sub-menu-item maven-pro hover-black @if ($active == 'solusi') text-primary @else text-black @endif">@lang('layout.profil.solusi')</a>
                </li>
                {{-- Informasi & Media --}}
                <li class="has-submenu parent-menu-item maven-pro ">
                    <a href="javascript:void(0)"
                        class="@if ($active == 'media') text-primary @else text-black @endif">@lang('layout.media.media_info')</a><span class="menu-arrow"></span>
                    <ul class="submenu">
                    @php
                        $currentRoute = Route::currentRouteName();
                    @endphp
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
                {{-- Struktur Organisasi --}}
                {{-- <li class="hover-black"><a href="{{ route('struktur.organisasi') }}"
                        class="sub-menu-item maven-pro hover-black @if ($active == 'structure_organization') text-primary @else text-black @endif">@lang('layout.profil.struktur_organisasi')</a>
                </li> --}}
                {{-- Berita & Artikel --}}
                {{-- <li class="hover-black"><a href="{{ route('berita.artikel') }}"
                        class="sub-menu-item maven-pro hover-black @if ($active == 'berita-artikel') text-primary @else text-black @endif">@lang('layout.profil.berita_artikel')</a>
                </li> --}}
                {{-- Penghargaan --}}
                {{-- <li class="hover-black"><a href="{{ route('sertifikasi') }}"
                        class="sub-menu-item maven-pro hover-black @if ($active == 'sertifikasi') text-primary @else text-black @endif">@lang('layout.profil.sertifikasi')</a>
                </li> --}}
                {{-- Kontak Kami --}}
                <li class="has-submenu parent-menu-item maven-pro ">
                    <a href="javascript:void(0)"
                        class="@if ($active == 'kontak') text-primary @else text-black @endif">@lang('layout.profil.kontak_kami')</a><span
                        class="menu-arrow"></span>
                    <ul class="submenu">
                        <li class="hover-black"><a href="{{ route('pengaduan.konsumen') }}"
                                class="sub-menu-item maven-pro hover-black">@lang('layout.profil.pengaduan')</a></li>
                        <li class="hover-black"><a href="{{ route('whistleblowing') }}"
                                class="sub-menu-item maven-pro hover-black">@lang('layout.profil.whistleblowing')</a></li>
                    </ul>
                </li>
                {{-- <li class="has-submenu parent-menu-item maven-pro @if ($active == 'home') text-primary @endif" id="dynamic-menu">
                    <a href="javascript:void(0)">@lang('layout.dynamic.other')</a><span class="menu-arrow"></span>
                    <ul class="submenu">
                    </ul>
                </li> --}}
            </ul>
        </div>

    </div>
    {{-- Submenu --}}
    {{-- @if ($submenu != null)
        <div class="d-flex flex-row bg-primary justify-content-center hide-on-mobile">
            @foreach ($submenu as $sbm)
                @if (App::getLocale() == 'id')
                    <div class="welcome py-2 px-4">
                        <a href="#{{ $sbm['url'] }}" class="text-white"
                            style="font-family: Maven Pro">{{ $sbm['nama'] }}</a>
                    </div>
                @elseif(App::getLocale() == 'en')
                    <div class="welcome py-2 px-4">
                        <a href="#{{ $sbm['url'] }}" class="text-white"
                            style="font-family: Maven Pro">{{ $sbm['nama_en'] }}</a>
                    </div>
                @endif
            @endforeach
        </div>
    @endif --}}
</header>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Ambil status terakhir dari localStorage saat halaman dimuat
    window.addEventListener('DOMContentLoaded', (event) => {
        const switchElem = document.querySelector('#flexSwitchCheckDefault');
        // var locale = '{{ App::getLocale() }}';
        var locale = '{{ session()->get('locale', App::getLocale()) }}';

        // Cek apakah ada status sebelumnya di localStorage
        if (localStorage.getItem('switchStatus') === 'true') {
            switchElem.checked = true;
            setLocalization('en');
        } else if (localStorage.getItem('switchStatus') === 'false') {
            switchElem.checked = false;
            setLocalization('id');
        } else {
            if (locale === 'en') {
                switchElem.checked = true;
            } else if (locale === 'id') {
                switchElem.checked = false;
            }
        }

        // Tambahkan event listener untuk perubahan pada switch
        switchElem.addEventListener('change', function() {
            if (this.checked) {
                localStorage.setItem('switchStatus', 'true');
                setLocalization('en');
                // Simpan ke server menggunakan AJAX / Axios jika perlu
                saveSwitchStatus(true);
            } else {
                localStorage.setItem('switchStatus', 'false');
                setLocalization('id');
                // Simpan ke server menggunakan AJAX / Axios jika perlu
                saveSwitchStatus(false);
            }
        });

        // Fungsi untuk menyimpan status switch ke server menggunakan AJAX / Axios
        const storeLocaleUrl = `{{ route('store.locale') }}`;

        function saveSwitchStatus(status) {
            // Kirim request ke Laravel untuk menyimpan status
            axios.post(storeLocaleUrl, {
                    status: status
                })
                .then(response => {
                    // Update locale di sisi server
                    updateLocale(response.data.locale);
                })
                .catch(error => {
                    console.error(error);
                });
        }

        // Fungsi untuk mengatur localization
        function setLocalization(lang) {
            // Simpan preferensi bahasa di localStorage jika perlu
            localStorage.setItem('lang', lang);

            // Contoh pengaturan sesuai dengan preferensi bahasa
            const idElements = document.querySelectorAll('.text-menu-id');
            idElements.forEach(el => {
                if (lang === 'id') {
                    el.style.display = 'inline';
                } else {
                    el.style.display = 'none';
                }
            });

            const enElements = document.querySelectorAll('.text-menu-en');
            enElements.forEach(el => {
                if (lang === 'en') {
                    el.style.display = 'inline';
                } else {
                    el.style.display = 'none';
                }
            });
        }

        // Fungsi untuk memperbarui locale di sisi server
        const updateLocaleUrl = `{{ route('update.locale') }}`;

        function updateLocale(locale) {
            axios.post(updateLocaleUrl, {
                    locale: locale
                })
                .then(response => {
                    console.log(response.data);
                    // Refresh halaman agar perubahan bahasa segera terlihat
                    window.location.reload();
                })
                .catch(error => {
                    console.error(error);
                });
        }

        $(document).ready(function() {
            $.ajax({
                url: "{{ route('dynamicMenuJson') }}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var submenu = $('#dynamic-menu').find('.submenu');
                    submenu.empty();
                    if (response.dynamic_menu.length > 0) {
                        response.dynamic_menu.forEach(menu => {
                            var li = $('<li class="hover-black">');
                            var routeUrl =
                                '{{ route('getDynamicContent', ':id') }}'.replace(
                                    ':id', menu.id);
                            var a = $('<a>').attr('href', routeUrl)
                                .addClass('sub-menu-item maven-pro')
                                .text(menu.navbar);
                            li.append(a);
                            submenu.append(li);
                        });
                        $('#dynamic-menu').show();
                    } else {
                        $('#dynamic-menu').hide();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        });
    });
</script>
