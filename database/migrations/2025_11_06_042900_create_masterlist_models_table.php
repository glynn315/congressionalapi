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
        Schema::create('masterlist_information', function (Blueprint $table) {
            $table->id('personel_id');
            $table->string('name');
            $table->bigInteger('contact_number');
            $table->string('affiliate')->nullable();
            $table->string('type');
            $table->unsignedBigInteger('parallel_id')->nullable();
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('created_by');
            $table->boolean('is_active')->default(true);
            $table->date('date_created');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masterlist_models');
    }
};
