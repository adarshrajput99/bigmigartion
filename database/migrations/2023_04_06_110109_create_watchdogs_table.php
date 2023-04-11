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
        Schema::connection('mysql2')->create('watchdogs', function (Blueprint $table) {
            $table->id();
            $table->integer('wid')->nullable(true);
            $table->integer('uid')->nullable(true);
            $table->string('type',64)->nullable(true);
            $table->longText('message')->nullable(true);
            $table->binary('variables',4294967295)->nullable(true);
            $table->unsignedTinyInteger('severity')->default(0)->nullable(true);
            $table->string('link',255)->nullable(true);
            $table->text('location')->nullable(true);
            $table->text('referer')->nullable(true);
            $table->string('hostname',128)->nullable(true);
            $table->integer('timestamp')->default(0)->nullable(true);
            $table->integer('Processed')->default(0)->nullable(true);
            $table->integer('order_id')->default(0)->nullable(true);

            $table->integer('rhid')->default(0)->nullable(true);
            $table->unsignedBigInteger('profile_id')->default(0)->nullable(true);
            #$table->unsignedBigInteger('uid');
            $table->unsignedBigInteger('entity_id')->default(0)->nullable(true);
            #$table->string('type', 32);
            #$table->text('message');
            $table->unsignedInteger('created')->default(0)->nullable(true);
            $table->string('log_type', 255)->default(0)->nullable(true);
            #$table->unsignedInteger('log_severity');
            #$table->unsignedBigInteger('order_id');
            $table->string('service_type', 255)->default(0)->nullable(true);
            #$table->timestamps();

            #$table->index('entity_id');
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
