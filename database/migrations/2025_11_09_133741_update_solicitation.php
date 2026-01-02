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
        Schema::table('invitations_information', function (Blueprint $table) {
            $table->string('event_address')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->bigInteger('contact_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations_information', function (Blueprint $table) {
            //
        });
    }
};
