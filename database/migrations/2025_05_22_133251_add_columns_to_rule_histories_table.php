<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('rule_histories', function (Blueprint $table) {
        $table->json('rules_json')->nullable();
        $table->json('entropy_gain')->nullable();
    });
}

public function down()
{
    Schema::table('rule_histories', function (Blueprint $table) {
        $table->dropColumn(['rules_json', 'entropy_gain']);
    });
}

};
