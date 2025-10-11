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
        Schema::create('request_forms', function (Blueprint $table) {
            $table->uuid('request_form_id')->primary();
            $table->bigInteger('control_number');
            $table->string('patients_name');
            $table->string('representative_name');
            $table->string('address');
            $table->bigInteger('contact_number');
            $table->integer('provider_id');
            $table->integer('amount');
            $table->boolean('is_active');
            $table->unsignedBigInteger('account_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_forms');
    }
};
