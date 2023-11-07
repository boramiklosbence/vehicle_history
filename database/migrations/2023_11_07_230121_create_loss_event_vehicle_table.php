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
        Schema::create('loss_event_vehicle', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('loss_event_id');

            $table->unique(['vehicle_id','loss_event_id']);
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('loss_event_id')->references('id')->on('loss_events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loss_event_vehicle');
    }
};
