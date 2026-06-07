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
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('nama_event');
        $table->string('draft_proposal');
        $table->string('status')->default('Pending Sekjur');
        $table->text('catatan')->nullable();
        
        // TAMBAHKAN DUA BARIS BARU INI UNTUK LHK:
        $table->string('file_lhk')->nullable(); // Menyimpan file LHK dari HIMA
        $table->string('status_lhk')->nullable(); // Status: Pending LHK / Direvisi / Diterima
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};