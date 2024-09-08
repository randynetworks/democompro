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
        Schema::create('solusis', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->string('kategori_en');
            $table->timestamps();
        });

        Schema::create('solusi_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solusi_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->string('judul_en');
            $table->text('deskripsi');
            $table->text('deskripsi_en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solusis');
        Schema::dropIfExists('solusi_details');

    }
};
