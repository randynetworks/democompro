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
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('embed')->nullable();
            $table->text('youtube_link')->nullable();
            $table->text('youtube_link_embed')->nullable();
            $table->text('video_file')->nullable();
            $table->string('judul')->nullable();
            $table->string('judul_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcasts');
    }
};
