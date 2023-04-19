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
        Schema::connection('mysql')->create('ip_track',function (Blueprint $table){

            $table->id();
            $table->string('ip');
            $table->integer('oid');
            $table->integer('First seen');
            $table->integer('last seen');
            $table->boolean('Processed');            
            $table->timestamps();

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
