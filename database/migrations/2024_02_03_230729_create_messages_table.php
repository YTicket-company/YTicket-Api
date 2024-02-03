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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ticket_id")->nullable(false);
            $table->unsignedBigInteger("client_id")->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->longText("message");
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete("cascade");
            $table->foreign('client_id')->references('id')->on('clients')->onDelete("cascade");
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
