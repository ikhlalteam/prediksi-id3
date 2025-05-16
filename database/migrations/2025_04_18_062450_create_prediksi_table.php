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
    Schema::create('prediksis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->enum('luas_lahan', ['Kecil','Sedang','Luas']);
        $table->enum('jenis_lahan', ['Kering','Pasir']);
        $table->enum('jenis_bibit', ['Bagus','Sedang','Kurang']);
        $table->enum('cuaca', ['Hujan','Normal']);
        $table->enum('lama_bertani', ['Baru','Sedang','Lama']);
        $table->enum('hasil_prediksi', ['Naik','Turun','Tetap']);
        $table->timestamps();
    });
    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediksi');
    }
};
