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
        Schema::create('rule_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');
            $table->integer('event_duration');
            $table->integer('occurence');
            $table->integer('frequency');
            $table->timestamp('last_executed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_statuses');
    }
};
