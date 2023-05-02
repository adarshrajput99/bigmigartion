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
            $table->date('event_duration')->change()->nullable()->default(null);


        });
        Schema::connection('mysql')->table('rule_statuses',function(Blueprint $table){
            $table->date('event_duration')->change()->nullable()->default(null);



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
