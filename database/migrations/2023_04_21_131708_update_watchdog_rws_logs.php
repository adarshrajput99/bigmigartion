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
            $table->text('lid');
            //$table->integer('profile_id');
            $table->integer('location_id');
       
            $table->string('type_key', 64);
            $table->tinyInteger('event_type');
            //$table->longText('message');
            //$table->text('location');
            //$table->string('hostname', 128);
            //$table->integer('timestamp');
            //$table->timestamps();

            //$table->text('profile_id');
            //$table->text('location_id');
            //$table->text('entity_id');
            //$table->text('type');
            //$table->text('type_key');
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
