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
        Schema::table('masterlist_information', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('extension')->nullable();
            $table->date('birthday')->nullable();
            $table->string('sex')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('purok')->nullable();
            $table->string('municipality_city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('masterlist_information', function (Blueprint $table) {
            //
        });
    }
};
