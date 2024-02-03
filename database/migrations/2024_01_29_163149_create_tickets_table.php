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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(false);
            $table->unsignedBigInteger("status_id")->nullable();
            $table->unsignedBigInteger("client_id");
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
