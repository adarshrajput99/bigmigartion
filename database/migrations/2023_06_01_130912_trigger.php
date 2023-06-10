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
            INSERT INTO laravel.rule_statuses (id, event_type,title, event_duration,event_from,event_to, occurence,frequency,last_executed,created_at,updated_at,frequency_check,From_freq,To_freq)
            VALUES (NEW.id ,NEW.event_type,NEW.title,NEW.event_duration,NEW.event_from,New.event_to,NEW.occurence,NEW.frequency,NOW(), NOW(), NOW(),NEW.frequency_check,NEW.From_freq,NEW.To_freq);
        END
    ');
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
