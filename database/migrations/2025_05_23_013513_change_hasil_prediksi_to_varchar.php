<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('prediksis', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->string('hasil_prediksi', 100)->change();
    });
}

public function down()
{
    Schema::table('prediksis', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->enum('hasil_prediksi', ['Naik', 'Turun', 'Tetap'])->change();
    });
}

};
