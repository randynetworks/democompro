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
        Schema::create('whistleblowings', function (Blueprint $table) {
            $table->id();            
            $table->string('nama_pelapor');
            $table->string('no_tlp_pelapor');
            $table->string('email_pelapor');
            $table->text('tindakan_yang_dilaporkan');
            $table->text('tindakan_yang_dilaporkan_lainnya')->nullable();
            $table->string('lampiran');
            $table->string('nama_terlapor');
            $table->string('jabatan_terlapor');
            $table->string('waktu');
            $table->text('lokasi');
            $table->longText('kronologis');
            $table->string('nominal');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whistleblowings');
    }
};
