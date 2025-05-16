<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rule_histories', function (Blueprint $table) {
            $table->id();
            $table->text('raw_data')->nullable(); // data mentah dari Excel
            $table->longText('calculation_result'); // hasil perhitungan ID3
            $table->longText('decision_tree'); // visualisasi tree
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rule_histories');
    }
};

