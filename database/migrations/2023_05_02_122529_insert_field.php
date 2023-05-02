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
        Schema::connection('mysql')->table('rules',function(Blueprint $table){
            $table->boolean('frequency_check')->nullable()->default(null);
            $table->integer('From_freq')->nullable()->default(null);
            $table->integer('To_freq')->nullable()->default(null);


        });
        Schema::connection('mysql')->table('rule_statuses',function(Blueprint $table){
            $table->boolean('frequency_check')->nullable()->default(null);
            $table->integer('From_freq')->nullable()->default(null);
            $table->integer('To_freq')->nullable()->default(null);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
