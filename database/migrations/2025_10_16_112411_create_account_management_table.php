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
        Schema::create('account_management', function (Blueprint $table) {
            $table->id('account_id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('province');
            $table->string('municipality');
            $table->string('barangay');
            $table->string('username');
            $table->string('password');
            $table->string('role');
            $table->unsignedBigInteger('created_by');
            $table->boolean('is_active')->default(true);
            $table->date('date_created');
            $table->boolean('is_newaccount')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_management');
    }
};
