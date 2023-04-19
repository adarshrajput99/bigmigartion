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
        DB::statement("
        CREATE VIEW resource_merger AS
        SELECT watchdogs.order_id ,watchdogs.message ,watchdogs.rhid ,resources.resource_id , resources.ip_address , resources.created  
        FROM watchdogs
        JOIN resources ON watchdogs.resource_id = resources.resource_id
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
