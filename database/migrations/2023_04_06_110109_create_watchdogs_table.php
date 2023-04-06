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
        Schema::connection('mysql')->create('watchdogs', function (Blueprint $table) {
            $table->integer('wid')->primary()->nullable(false)->autoIncrement();
            $table->integer('uid')->default(0)->nullable(false);
            $table->string('type',64)->nullable(false);
            $table->longText('message')->nullable(false);
            $table->binary('variables',4294967295)->nullable(false);
            $table->unsignedTinyInteger('severity')->default(0)->nullable(false);
            $table->string('link',255);
            $table->text('location')->nullable(false);
            $table->text('referer');
            $table->string('hostname',128)->nullable(false);
            $table->integer('timestamp')->default(0)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watchdogs');
    }
};
