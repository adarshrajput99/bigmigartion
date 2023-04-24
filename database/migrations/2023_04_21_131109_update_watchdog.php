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
            $table->text('rec_id');
            //$table->string('type');
            $table->longText('data');
            $table->integer('date_updated');
          //  $table->timestamp(date_updated);
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
