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
        DB::unprepared('
        CREATE TRIGGER insert_trigger AFTER INSERT ON rules
        FOR EACH ROW
        BEGIN
            INSERT INTO laravel.rule_statuses (id, event_type, event_duration, occurence,frequency,last_executed,created_at,updated_at)
            VALUES (NEW.id ,NEW.event_type,NEW.event_duration,NEW.occurence,NEW.frequency,NOW(), NOW(), NOW());
        END
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
