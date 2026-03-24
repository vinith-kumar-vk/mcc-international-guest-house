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
        $columns = [
            'nationality' => "ALTER TABLE bookings ADD COLUMN nationality TEXT DEFAULT 'Indian'",
            'user_type' => "ALTER TABLE bookings ADD COLUMN user_type TEXT",
            'stream' => "ALTER TABLE bookings ADD COLUMN stream TEXT",
            'level' => "ALTER TABLE bookings ADD COLUMN level TEXT",
            'department' => "ALTER TABLE bookings ADD COLUMN department TEXT",
            'primary_guest_name' => "ALTER TABLE bookings ADD COLUMN primary_guest_name TEXT",
            'no_of_persons' => "ALTER TABLE bookings ADD COLUMN no_of_persons INTEGER DEFAULT 1",
            'passport_number' => "ALTER TABLE bookings ADD COLUMN passport_number TEXT",
        ];

        foreach ($columns as $name => $sql) {
            try {
                DB::statement($sql);
            } catch (\Exception $e) {
                // Ignore if column already exists
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'nationality', 'user_type', 'stream', 'level', 'department', 
                'primary_guest_name', 'no_of_persons', 'passport_number'
            ]);
        });
    }
};
