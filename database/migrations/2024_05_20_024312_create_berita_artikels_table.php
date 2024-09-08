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
        Schema::create('berita_artikels', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->string('judul');
            $table->string('judul_en');
            $table->text('isi_berita');
            $table->text('isi_berita_en');
            $table->integer('total_kunjung')->default(0);
            $table->dateTime('waktu');
            $table->string('kategori');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_artikels');
    }
};
