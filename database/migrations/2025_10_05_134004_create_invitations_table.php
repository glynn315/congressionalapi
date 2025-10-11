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
        Schema::create('invitations_information', function (Blueprint $table) {
            $table->id();
            $table->string('name_inviter');
            $table->date('dateInvitation');
            $table->string('purpose');
            $table->date('dateCreated');
            $table->integer('reveivedBy');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
