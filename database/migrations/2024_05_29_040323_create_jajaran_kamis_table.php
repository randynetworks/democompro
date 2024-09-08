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
        Schema::create('jajaran_kamis', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('nama')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->longText('deskripsi_en')->nullable();
            $table->string('id_jabatan_fk');
            $table->string('tagline');
            $table->string('tagline_en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jajaran_kamis');
    }
};
