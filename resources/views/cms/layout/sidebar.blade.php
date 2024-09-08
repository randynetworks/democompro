<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
        data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="true">

            <!-- DASHBOARD -->
            <div class="menu-item {{ Request::is('dashboard') || Request::is('dashboard/*') ? 'show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                    fill="currentColor" />
                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                    fill="currentColor" />
                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                    fill="currentColor" />
                            </svg>
                        </span>
                    </span>
                    <a class="menu-title " href="{{ route('dashboard') }}">Dashboards</a>
                </span>
            </div>

            <!-- MANAJEMEN META TAG -->
            <div class="menu-item {{ Request::is('manajemen-meta') || Request::is('manajemen-meta/*') ? 'show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M0 0h1v15h15v1H0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5" />
                            </svg>
                        </span>
                    </span>
                    <a class="menu-title" href="{{ route('manajemen-meta') }}">Manajemen Tag Meta</a>
                </span>
            </div>


            <!-- MANAJEMEN IMAGE HEADER -->
            <div
                class="menu-item {{ Request::is('manajemen-image-header') || Request::is('manajemen-image-header/*') ? 'show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                <path
                                    d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z" />
                            </svg>
                        </span>
                    </span>
                    <a class="menu-title" href="{{ route('manajemen-image-header') }}">Manajemen Image Header</a>
                </span>
            </div>


            <!-- MANAJEMEN BERANDA -->
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ Request::is('manajemen-landing-page/*') || Request::is('manajemen-nilai/*') || Request::is('manajemen-ucapan/*') || Request::is('manajemen-tata-kelola/*') || Request::is('manajemen-karir/*') || Request::is('jadwal/*') || Request::is('manajemen-daftar-lowongan/*') ? 'show' : '' }}">
                <span
                    class="menu-link {{ Request::is('manajemen-landing-page') || Request::is('manajemen-ucapan') || Request::is('manajemen-tata-kelola') || Request::is('manajemen-karir') || Request::is('manajemen-daftar-lowongan/*') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-house-gear" viewBox="0 0 16 16">
                                <path
                                    d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708z" />
                                <path
                                    d="M11.886 9.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.044c-.613-.181-.613-1.049 0-1.23l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                            </svg>
                        </span>
                    </span>
                    <span class="menu-title">Manajemen Beranda</span>
                    <span class="menu-arrow"></span>
                </span>
                <div
                    class="menu-sub menu-sub-accordion {{ Request::is('manajemen-landing-page') || Request::is('manajemen-nilai') || Request::is('manajemen-ucapan') || Request::is('manajemen-tata-kelola') || Request::is('manajemen-karir') || Request::is('dokumentasi') || Request::is('jadwal') || Request::is('manajemen-daftar-lowongan') ? 'show' : '' }}">
                    <div
                        class="menu-item {{ Request::is('manajemen-landing-page') || Request::is('manajemen-landing-page/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('manajemen-landing-page') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Landing page</span>
                        </a>
                    </div>
                    <div
                        class="menu-item {{ Request::is('manajemen-nilai') || Request::is('manajemen-nilai/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('manajemen-nilai') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Nilai</span>
                        </a>
                    </div>
                    <div
                        class="menu-item {{ Request::is('manajemen-ucapan') || Request::is('manajemen-ucapan/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('manajemen-ucapan') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Sambutan</span>
                        </a>
                    </div>
                    {{-- <div
                        class="menu-item {{ Request::is('manajemen-tata-kelola') || Request::is('manajemen-tata-kelola/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('manajemen-tata-kelola') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Tata Kelola</span>
                        </a>
                    </div> --}}
                    <div class="menu-item {{ Request::is('manajemen-karir') || Request::is('manajemen-karir/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('manajemen-karir') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Karir</span>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::is('manajemen-daftar-lowongan') || Request::is('manajemen-daftar-lowongan/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('manajemen-daftar-lowongan') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Daftar Lowongan</span>
                        </a>
                    </div>
                    <!-- <div class="menu-item {{ Request::is('jadwal') || Request::is('jadwal/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('manajemen-karir') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Jadwal Acara</span>
                        </a>
                    </div> -->
                    {{-- <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ Request::is('dokumentasi') || Request::is('dokumentasi/*') || Request::is('jadwal') || Request::is('jadwal/*') ? 'show' : '' }}">
                        <span class="menu-link">
                            <span class="menu-bullet ">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Kegiatan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            <div
                                class="menu-item {{ Request::is('dokumentasi') || Request::is('dokumentasi/*') ? 'show' : '' }}">
                                <a class="menu-link" href="{{ route('dokumentasi') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Dokumentasi</span>
                                </a>
                            </div>
                            <div
                                class="menu-item {{ Request::is('jadwal') || Request::is('jadwal/*') ? 'show' : '' }}">
                                <a class="menu-link" href="{{ route('jadwal') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Jadwal Acara</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>

            <!-- MANAJEMEN TENTANG KAMI-->
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ Request::is('profil-perusahaan/*') || Request::is('visi-misi/*') || Request::is('tujuan-perusahaan/*') || Request::is('struktur_organisasi/*') || Request::is('struktur-organisasi/*') || Request::is('laporan-keuangan-bulanan/*') || Request::is('laporan-keuangan-tahunan/*') || Request::is('profil-perusahaan') || Request::is('visi-misi') || Request::is('tujuan-perusahaan') || Request::is('struktur_organisasi') || Request::is('struktur-organisasi') || Request::is('laporan-keuangan-bulanan') || Request::is('laporan-keuangan-tahunan') ? 'show' : '' }}">
                <span
                    class="menu-link {{ Request::is('tujuan-perusahaan') || Request::is('visi-misi') || Request::is('profil-perusahaan') || Request::is('laporan-keuangan-bulanan') || Request::is('laporan-keuangan-tahunan') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                <path
                                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                            </svg>
                        </span>
                    </span>
                    <span class="menu-title">Manajemen Perusahaan</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div
                        class="menu-item {{ Request::is('profil-perusahaan') || Request::is('profil-perusahaan/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('profil-perusahaan') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Profil</span>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::is('visi-misi') || Request::is('visi-misi/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('visi-misi') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Visi & Misi</span>
                        </a>
                    </div>
                    <div
                        class="menu-item {{ Request::is('tujuan-perusahaan') || Request::is('tujuan-perusahaan/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('tujuan-perusahaan') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Tujuan</span>
                        </a>
                    </div>
                    <div
                        class="menu-item {{ Request::is('struktur_organisasi') || Request::is('struktur_organisasi/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('struktur_organisasi') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Struktur Organisasi</span>
                        </a>
                    </div>
                    <div
                        class="menu-item {{ Request::is('laporan-keuangan-bulanan') || Request::is('laporan-keuangan-bulanan/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('laporan-keuangan-bulanan') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Laporan Keuangan Bulanan</span>
                        </a>
                    </div>
                    <div
                        class="menu-item {{ Request::is('laporan-keuangan-tahunan') || Request::is('laporan-keuangan-tahunan/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('laporan-keuangan-tahunan') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Laporan Keuangan Tahunan</span>
                        </a>
                    </div>
                </div>
            </div>



            <!-- MANAJEMEN SOLUSI -->
            <div
                class="menu-item {{ Request::is('manajemen-solusi') || Request::is('manajemen-solusi/*') ? 'show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-patch-question" viewBox="0 0 16 16">
                                <path
                                    d="M8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.7 1.7 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745" />
                                <path
                                    d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911z" />
                                <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0" />
                            </svg>
                        </span>
                    </span>
                    <a class="menu-title" href="{{ route('manajemen-solusi') }}">Manajemen Solusi</a>
                </span>
            </div>

            <!-- MANAJEMEN BERITA & ARTIKEL -->
            <div
                class="menu-item {{ Request::is('berita-artikel') || Request::is('berita-artikel/*') ? 'show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                                <path
                                    d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z" />
                                <path
                                    d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm0 2h4v1H2zm5-6h2v1H7zm3 0h2v1h-2zM7 8h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2z" />
                            </svg>
                        </span>
                    </span>
                    <a class="menu-title" href="{{ route('berita-artikel') }}">Berita & Artikel</a>
                </span>
            </div>

            <!-- MANAJEMEN PENGHARGAAN -->
            <div
                class="menu-item {{ Request::is('sertifikat-prestasi') || Request::is('sertifikat-prestasi/*') ? 'show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-trophy" viewBox="0 0 16 16">
                                <path
                                    d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z" />
                            </svg>
                        </span>
                    </span>
                    <a class="menu-title" href="{{ route('sertifikat-prestasi') }}">Sertifikasi & Penghargaan</a>
                </span>
            </div>

            <div class="menu-item {{ Request::is('dokumentasi') || Request::is('dokumentasi/*') ? 'show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                            <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                            <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                        </svg>
                        </span>
                    </span>
                    <a class="menu-title" href="{{ route('dokumentasi') }}">Dokumentasi</a>
                </span>
            </div>

            <!-- MANAJEMEN PODCAST -->
            <div class="menu-item {{ Request::is('video') || Request::is('video/*') ? 'show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-camera-reels" viewBox="0 0 16 16">
                                <path d="M6 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0M1 3a2 2 0 1 0 4 0 2 2 0 0 0-4 0" />
                                <path
                                    d="M9 6h.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2zm6 8.73V7.27l-3.5 1.555v4.35zM1 8v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1" />
                                <path d="M9 6a3 3 0 1 0 0-6 3 3 0 0 0 0 6M7 3a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                            </svg>
                        </span>
                    </span>
                    <a class="menu-title" href="{{ route('video') }}">Video</a>
                </span>
            </div>

            <!-- MANAJEMEN KONTAK KAMI -->
            <div class="menu-item {{ Request::is('kontak-kami') || Request::is('kontak-kami/*') ? 'show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-telephone-plus" viewBox="0 0 16 16">
                                <path
                                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                                <path fill-rule="evenodd"
                                    d="M12.5 1a.5.5 0 0 1 .5.5V3h1.5a.5.5 0 0 1 0 1H13v1.5a.5.5 0 0 1-1 0V4h-1.5a.5.5 0 0 1 0-1H12V1.5a.5.5 0 0 1 .5-.5" />
                            </svg>
                        </span>
                    </span>
                    <a class="menu-title" href="{{ route('kontak-kami') }}">Kontak Kami</a>
                </span>
            </div>

            <!-- KONTAK KAMI - LAYANAN -->
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ Request::is('layanan') || Request::is('layanan-pengaduan-konsumen') || Request::is('layanan-pengaduan-konsumen/*') ? 'show' : '' }}">
                <span class="menu-link {{ Request::is('layanan') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-envelope-check" viewBox="0 0 16 16">
                                <path
                                    d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z" />
                                <path
                                    d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686" />
                            </svg>
                        </span>
                    </span>
                    <span class="menu-title">Form Layanan</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div
                        class="menu-item {{ Request::is('layanan-pengaduan-konsumen') || Request::is('layanan-pengaduan-konsumen/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('layanan-pengaduan-konsumen') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Layanan Pengaduan Konsumen</span>
                        </a>
                    </div>
                </div>
                <div class="menu-sub menu-sub-accordion">
                    <div
                        class="menu-item {{ Request::is('layanan-whistleblowing') || Request::is('layanan-whistleblowing/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('layanan-whistleblowing') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Whistleblowing</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- MANAJEMEN DATA MASTER-->
            {{-- <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion {{ Request::is('data-master') || Request::is('master-jabatan') || Request::is('master-jabatan/*') ? 'show' : '' }}">
                <span class="menu-link {{ Request::is('data-master') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-database-gear" viewBox="0 0 16 16">
                                <path
                                    d="M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4" />
                                <path
                                    d="M11.886 9.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            </svg>
                        </span>
                    </span>
                    <span class="menu-title">Data Master</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div
                        class="menu-item {{ Request::is('master-jabatan') || Request::is('master-jabatan/*') ? 'show' : '' }}">
                        <a class="menu-link" href="{{ route('master-jabatan') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Jabatan</span>
                        </a>
                    </div>
                </div>
            </div> --}}

            <!-- MANAJEMEN DYNAMIC MENU -->
            {{-- <div class="menu-item {{ Request::is('menu-dinamis') || Request::is('menu-dinamis/*') ? 'show' : '' }}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-menu-button-wide-fill" viewBox="0 0 16 16">
                                <path
                                    d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                            </svg>
                        </span>
                    </span>
                    <a class="menu-title" href="{{ route('menu-dinamis') }}">Manajemen Menu Lainnya</a>
                </span>
            </div> --}}
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Aside Menu-->
</div>
