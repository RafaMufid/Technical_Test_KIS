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
        Schema::create('tbl_participant_reason', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('id_peserta')->constrained('tbl_participant')->onDelete('cascade');
            $table->string('status');
            $table->string('catatan')->nullable();
            $table->string('alasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_participant_reason');
    }
};
