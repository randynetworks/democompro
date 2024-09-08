<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('nama_pic');
            $table->text('alamat_perusahaan');
            $table->string('no_tlp_perusahaan');
            $table->string('no_hp_pic');
            $table->string('email');
            $table->string('lampiran');
            $table->string('jenis_layanan');
            $table->string('jenis_layanan_lainnya')->nullable();
            $table->string('kategori');
            $table->longText('uraian');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
