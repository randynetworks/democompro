<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaArtikelController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\dokumentasiController;
use App\Http\Controllers\dynamicController;
use App\Http\Controllers\fileTataKelolaController;
use App\Http\Controllers\headerPictureController;
use App\Http\Controllers\jadwalController;
use App\Http\Controllers\jajarankamiController;
use App\Http\Controllers\joblistController;
use App\Http\Controllers\kontakController;
use App\Http\Controllers\Landing\MainController;
use App\Http\Controllers\landingController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\lowonganController;
use App\Http\Controllers\masterjabaranController;
use App\Http\Controllers\nilaiController;
use App\Http\Controllers\profilController;
use App\Http\Controllers\sertifikatController;
use App\Http\Controllers\SolusiController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\tatakelolaController;
use App\Http\Controllers\tujuanController;
use App\Http\Controllers\ucapanController;
use App\Http\Controllers\visimisiController;
use App\Http\Controllers\Landing\TentangkamiController;
use App\Http\Controllers\Landing\SertifikasiController;
use App\Http\Controllers\Landing\BeritadanartikelController;
use App\Http\Controllers\Landing\dokumentasiController as LandingDokumentasiController;
use App\Http\Controllers\Landing\karirController;
use App\Http\Controllers\Landing\PodcastMediaController;
use App\Http\Controllers\laporanTahunanController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\manajemenPodcastController;
use App\Http\Controllers\ManajemenSolusiController;
use App\Http\Controllers\pengaduanController;
use App\Http\Controllers\TagMetaController;
use App\Http\Controllers\WhistleblowingController;
use Illuminate\Support\Facades\Route;


// AUTH
Route::get('/admin/access', [AuthController::class, 'index'])->name('login');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// kunjungan berita artikel
Route::post('/berita-artikel/kunjungan_berita/{id}', [BeritaArtikelController::class, 'kunjungan_berita'])->name('berita-artikel.kunjungan_berita');

// localstorage
Route::post('/save-switch-status', [LocaleController::class, 'store'])->name('store.locale');
Route::post('/update-locale', [LocaleController::class, 'updateLocale'])->name('update.locale');

Route::group(['middleware' => ['auth']], function () {
    //  ------------------------ DASHBOARD ----------------------------
    Route::controller(dashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::prefix('/dashboard')->group(function () {
            Route::name('dashboard.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/chartTotalTahunan', 'chartTotalTahunan')->name('chartTotalTahunan');
                Route::get('/chartTotalKunjung', 'chartTotalKunjung')->name('chartTotalKunjung');
            });
        });
    });

    // ----------------------- MANAJEMEN BERANDA --------------------------
    // manajemen landing page
    Route::controller(landingController::class)->group(function () {
        Route::get('/manajemen-landing-page', 'index')->name('manajemen-landing-page');
        Route::prefix('/manajemen-landing-page')->group(function () {
            Route::name('manajemen-landing-page.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
            });
        });
    });
    // manajemen nilai
    Route::controller(nilaiController::class)->group(function () {
        Route::get('/manajemen-nilai', 'index')->name('manajemen-nilai');
        Route::prefix('/manajemen-nilai')->group(function () {
            Route::name('manajemen-nilai.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
                Route::get('/gambar', 'index_gambar')->name('index_gambar');
                Route::post('/gambar_update/{id}', 'update_gambar')->name('update_gambar');
            });
        });
    });
    // manajemen ucapan
    Route::controller(ucapanController::class)->group(function () {
        Route::get('/manajemen-ucapan', 'index')->name('manajemen-ucapan');
        Route::prefix('/manajemen-ucapan')->group(function () {
            Route::name('manajemen-ucapan.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
            });
        });
    });
    // manajemen tata kelola
    Route::controller(tatakelolaController::class)->group(function () {
        Route::get('/manajemen-tata-kelola', 'index')->name('manajemen-tata-kelola');
        Route::prefix('/manajemen-tata-kelola')->group(function () {
            Route::name('manajemen-tata-kelola.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
            });
        });
    });
    // file tata kelola
    Route::controller(fileTataKelolaController::class)->group(function () {
        Route::get('/file-tata-kelola', 'index')->name('file-tata-kelola');
        Route::prefix('/file-tata-kelola')->group(function () {
            Route::name('file-tata-kelola.')->group(function () {
                Route::get('/edit-tatakelola/{id}', 'edit_tatakelola')->name('edit_tatakelola');
                Route::post('/update-tatakelola/{id}', 'update_tatakelola')->name('update_tatakelola');
                Route::get('/edit-risiko/{id}', 'edit_risiko')->name('edit_risiko');
                Route::post('/update-risiko/{id}', 'update_risiko')->name('update_risiko');
            });
        });
    });
    // manajemen info lowongan
    Route::controller(lowonganController::class)->group(function () {
        Route::get('/manajemen-karir', 'index')->name('manajemen-karir');
        Route::prefix('/manajemen-karir')->group(function () {
            Route::name('manajemen-karir.')->group(function () {
                Route::post('/update/{id}', 'update')->name('update');
            });
        });
    });
    // manajemen daftar lowongan
    Route::controller(joblistController::class)->group(function () {
        Route::get('/manajemen-daftar-lowongan', 'index')->name('manajemen-daftar-lowongan');
        Route::prefix('/manajemen-daftar-lowongan')->group(function () {
            Route::name('manajemen-daftar-lowongan.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
            });
        });
    });
    // manajemen kegiatan
    // dokumentasis
    Route::controller(dokumentasiController::class)->group(function () {
        Route::get('/dokumentasi', 'index')->name('dokumentasi');
        Route::prefix('/dokumentasi')->group(function () {
            Route::name('dokumentasi.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
            });
        });
    });
    // jadwal
    Route::controller(jadwalController::class)->group(function () {
        Route::get('/jadwal', 'index')->name('jadwal');
        Route::prefix('/jadwal')->group(function () {
            Route::name('jadwal.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
            });
        });
    });
    // -------------------------- MANAJEMEN TENTANG KAMI -------------------
    // profil perusahaan
    Route::controller(profilController::class)->group(function () {
        Route::get('/profil-perusahaan', 'index')->name('profil-perusahaan');
        Route::prefix('/profil-perusahaan')->group(function () {
            Route::name('profil-perusahaan.')->group(function () {
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::post('/updateStatus/{id}', 'updateStatus')->name('updateStatus');
            });
        });
    });
    // visi misi
    Route::controller(visimisiController::class)->group(function () {
        Route::get('/visi-misi', 'index')->name('visi-misi');
        Route::prefix('/visi-misi')->group(function () {
            Route::name('visi-misi.')->group(function () {
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
            });
        });
    });
    // tujuan perusahaan
    Route::controller(tujuanController::class)->group(function () {
        Route::get('/tujuan-perusahaan', 'index')->name('tujuan-perusahaan');
        Route::prefix('/tujuan-perusahaan')->group(function () {
            Route::name('tujuan-perusahaan.')->group(function () {
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
            });
        });
    });
    //  jajaran kami
    Route::controller(jajarankamiController::class)->group(function () {
        Route::get('/struktur_organisasi', 'index')->name('struktur_organisasi');
        Route::prefix('/struktur_organisasi')->group(function () {
            Route::name('struktur_organisasi.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::post('/uploadImage', 'uploadImage')->name('uploadImage');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
            });
        });
    });
    //  laporan keuangan bulanan
    Route::controller(laporanController::class)->group(function () {
        Route::get('/laporan-keuangan-bulanan', 'index')->name('laporan-keuangan-bulanan');
        Route::prefix('/laporan-keuangan-bulanan')->group(function () {
            Route::name('laporan-keuangan-bulanan.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/chartLaporan', 'chartLaporan')->name('chartLaporan');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
                Route::get('/cekBulan', 'cekBulan')->name('cekBulan');
            });
        });
    });
    //  laporan keuangan tahunan
    Route::controller(laporanTahunanController::class)->group(function () {
        Route::get('/laporan-keuangan-tahunan', 'index')->name('laporan-keuangan-tahunan');
        Route::prefix('/laporan-keuangan-tahunan')->group(function () {
            Route::name('laporan-keuangan-tahunan.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/chartLaporan', 'chartLaporan')->name('chartLaporan');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
                Route::get('/cekBulan', 'cekBulan')->name('cekBulan');
            });
        });
    });
    // ------------------------- Penghargaan --------------------
    Route::controller(sertifikatController::class)->group(function () {
        Route::get('/sertifikat-prestasi', 'index')->name('sertifikat-prestasi');
        Route::prefix('/sertifikat-prestasi')->group(function () {
            Route::name('sertifikat-prestasi.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
            });
        });
    });
    // ------------------------- BERITA & ARTIKEL --------------------------------
    Route::controller(BeritaArtikelController::class)->group(function () {
        Route::get('/berita-artikel', 'index')->name('berita-artikel');
        Route::prefix('/berita-artikel')->group(function () {
            Route::name('berita-artikel.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
                // Route::post('/kunjungan_berita/{id}', 'kunjungan_berita')->name('kunjungan_berita');
            });
        });
    });
    // ------------------------- KONTAK KAMI --------------------------------
    Route::controller(kontakController::class)->group(function () {
        Route::get('/kontak-kami', 'index')->name('kontak-kami');
        Route::prefix('/kontak-kami')->group(function () {
            Route::name('kontak-kami.')->group(function () {
                Route::post('/update/{id}', 'update')->name('update');
            });
        });
    });

    // ------------------------- MASTER JABATAN --------------------------------
    Route::controller(masterjabaranController::class)->group(function () {
        Route::get('/master-jabatan', 'index')->name('master-jabatan');
        Route::prefix('/master-jabatan')->group(function () {
            Route::name('master-jabatan.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
                Route::get('/cekJabatan', 'cekJabatan')->name('cekJabatan');
                Route::get('/cekJabatanEn', 'cekJabatanEn')->name('cekJabatanEn');
                Route::post('/updateStatus/{id}', 'updateStatus')->name('updateStatus');
            });
        });
    });

    // ------------------------- MANAJEMEN TAG META --------------------------------
    Route::controller(TagMetaController::class)->group(function () {
        Route::get('/manajemen-meta', 'index')->name('manajemen-meta');
        Route::prefix('/manajemen-meta')->group(function () {
            Route::name('manajemen-meta.')->group(function () {
                Route::post('/update/{id}', 'update')->name('update');
            });
        });
    });


    // ------------------------- KONTAK KAMI - LAYANAN PENGADUAN KONSUMEN--------------------------------
    Route::controller(pengaduanController::class)->group(function () {
        Route::get('/layanan-pengaduan-konsumen', 'index')->name('layanan-pengaduan-konsumen');
        Route::prefix('/layanan-pengaduan-konsumen')->group(function () {
            Route::name('layanan-pengaduan-konsumen.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/chartTotalPengaduan', 'chartTotalPengaduan')->name('chartTotalPengaduan');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
                Route::get('/download/{id}', 'download')->name('download');
            });
        });
    });
    Route::controller(WhistleblowingController::class)->group(function () {
        Route::get('/layanan-whistleblowing', 'index')->name('layanan-whistleblowing');
        Route::prefix('/layanan-whistleblowing')->group(function () {
            Route::name('layanan-whistleblowing.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/chartTotalWhistleblowing', 'chartTotalWhistleblowing')->name('chartTotalWhistleblowing');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/download/{id}', 'download')->name('download');
            });
        });
    });

    Route::controller(dynamicController::class)->group(function () {
        Route::get('/menu-dinamis', 'index')->name('menu-dinamis');
        Route::prefix('/menu-dinamis')->group(function () {
            Route::name('menu-dinamis.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
            });
        });
    });

    Route::controller(ManajemenSolusiController::class)->group(function () {
        Route::get('/manajemen-solusi', 'index')->name('manajemen-solusi');
        Route::prefix('/manajemen-solusi')->group(function () {
            Route::name('manajemen-solusi.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
            });
        });
    });

    Route::controller(headerPictureController::class)->group(function () {
        Route::get('/manajemen-image-header', 'index')->name('manajemen-image-header');
        Route::prefix('/manajemen-image-header')->group(function () {
            Route::name('manajemen-image-header.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
            });
        });
    });

    Route::controller(manajemenPodcastController::class)->group(function () {
        Route::get('/video', 'index')->name('video');
        Route::prefix('/video')->group(function () {
            Route::name('video.')->group(function () {
                Route::post('/getDataJson', 'getDataJson')->name('getDataJson');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
            });
        });
    });

    Route::post('/translate', [landingController::class, 'translate'])->name('translate');
    Route::post('/update-nilai-status', [landingController::class, 'update_nilai_status'])->name('update_nilai_status');
    Route::post('/update-status-calendar', [landingController::class, 'update_nilai_calendar'])->name('update_nilai_calendar');
});


// LANDING - Depan
Route::get('/berita', [BeritadanartikelController::class, 'index_berita'])->name('berita');
Route::get('/artikel', [BeritadanartikelController::class, 'index_artikel'])->name('artikel');
Route::get('/berita-json', [BeritadanartikelController::class, 'indexJson_berita'])->name('berita.artikel.json.berita');
Route::get('/artikel-json', [BeritadanartikelController::class, 'indexJson_artikel'])->name('berita.artikel.json.artikel');
Route::post('/berita-dan-artikel-blade', [BeritadanartikelController::class, 'indexBlade'])->name('berita.artikel.blade');
Route::post('/berita-kunjung/{id}', [BeritadanartikelController::class, 'kunjung_detail_berita'])->name('berita.kunjung');

Route::get('/layanan-kontak-kami/pengaduan-konsumen', [pengaduanController::class, 'index_landing'])->name('pengaduan.konsumen');
Route::post('/pengaduan/store', [pengaduanController::class, 'store'])->name('pengaduan.store');

Route::get('/layanan-kontak-kami/whistleblowing', [WhistleblowingController::class, 'index_landing'])->name('whistleblowing');
Route::post('/whistleblowing/store', [WhistleblowingController::class, 'store'])->name('whistleblowing.store');


// Route::get('/karir', [BeritadanartikelController::class, 'index_karir'])->name('karir');
// karir
Route::get('/karir', [karirController::class, 'index'])->name('karir');
Route::get('/karir-json', [karirController::class, 'indexJson_karir'])->name('karir.json');
Route::post('/karir-blade', [karirController::class, 'indexBlade'])->name('karir.blade');
Route::get('/karir/{slug}', [karirController::class, 'show'])->name('karir.detail');

// Todo with slash id
Route::get('/berita-dan-artikel/{slug}', [BeritadanartikelController::class, 'show'])->name('berita.artikel.defail');
Route::get('/tentang-kami', [TentangkamiController::class, 'index'])->name('tentang.kami');

Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('struktur.organisasi');

Route::get('/sertifikasi', [SertifikasiController::class, 'index_sertifikasi'])->name('sertifikasi');
Route::get('/penghargaan', [SertifikasiController::class, 'index_penghargaan'])->name('penghargaan');
Route::get('/sertifikasi-json', [SertifikasiController::class, 'indexJson_sertifikasi'])->name('sertifikasi.json.sertifikasi');
Route::get('/penghargaan-json', [SertifikasiController::class, 'indexJson_penghargaan'])->name('sertifikasi.json.penghargaan');
Route::post('/sertifikasi-blade', [SertifikasiController::class, 'indexBlade'])->name('sertifikasi.blade');

Route::get('/videos', [PodcastMediaController::class, 'index'])->name('videos');
Route::get('/video-json', [PodcastMediaController::class, 'indexJson'])->name('video.json.video');
Route::post('/video-blade', [PodcastMediaController::class, 'indexBlade'])->name('video.blade');

Route::get('/kegiatan', [LandingDokumentasiController::class, 'index'])->name('kegiatan');
Route::get('/dokumentasi-json', [LandingDokumentasiController::class, 'indexJson'])->name('dokumentasi.json');
Route::post('/dokumentasi-blade', [LandingDokumentasiController::class, 'indexBlade'])->name('dokumentasi.blade');

 /* Landing Ajax */
// profile
// TODO with slash id
Route::post('/landing/profile/{id}',[MainController::class,'profile'])->name('profile');
Route::get('/landing/dynamicMenuJson',[MainController::class,'dynamicMenuJson'])->name('dynamicMenuJson');
Route::get('/landing/dynamic-content/{id}', [MainController::class, 'getDynamicContent'])->name('getDynamicContent');

// keuangan
Route::post('landing/chart/keuangan',[TentangkamiController::class,'Allchart'])->name('landing.chart.keuangan');
Route::post('landing/list/keuangan',[TentangkamiController::class,'listData'])->name('landing.list.keuangan');
// TODO with slash id
Route::get('landing/list/keuangan/{id}/{tipe}',[TentangkamiController::class,'download'])->name('landing.download.keuangan');
// Tata Kelola
Route::post('tata-kelola/download',[MainController::class,'downloadTataKelola'])->name('landing.download.tatakelola');
Route::get('tata-kelola/download/{kategori}',[MainController::class,'download'])->name('landing.download.tatakelola.file');
// calendar
Route::post('jadwal/chart',[MainController::class,'jadwalChart'])->name('landing.chart.jadwal');
Route::post('jadwal/list',[MainController::class,'jadwalList'])->name('landing.list.jadwal');
// sertifikat
Route::post('landing/sertifkat/{encrypted_id}',[SertifikasiController::class,'show'])->name('sertifikat.detail');
Route::get('landing/sertifkat/dowload/{id}',[SertifikasiController::class,'download'])->name('sertifikat.download');
// dokumentasi
Route::post('landing/dokumentasi/{id}',[dokumentasiController::class,'show'])->name('dokumentasi.detail');
Route::get('landing/dokumentasi/dowload/{id}',[dokumentasiController::class,'download'])->name('dokumentasi.download');

// soulusi
Route::get('solusi',[SolusiController::class,'index'])->name('solusi');

Route::get('/', [MainController::class, 'index'])->name('home');


