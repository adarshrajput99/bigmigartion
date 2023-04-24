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
        Schema::connection('mysql')->table('watchdogs',function(Blueprint $table){
            $table->text('lid')->default('0')->change();
  
            $table->integer('location_id')->default(0)->change();
         
            $table->string('type_key', 64)->default('0')->change();
            $table->integer('event_type')->nullable()->change();
            $table->text('rec_id')->default('0')->change();
            //$table->string('type');
            $table->longText('data')->default('0')->change();
            $table->integer('date_updated')->default('0')->change();
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
