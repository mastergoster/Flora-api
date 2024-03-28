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
        Schema::create('booking_slots', function (Blueprint $table) {
            $table->id();
            // TODO: Vérifier nommage des colonnes
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('NO ACTION');
            $table->unsignedBigInteger('reservable_item_id');
            $table->foreign('reservable_item_id')->references('id')->on('reservable_items')->onDelete('CASCADE')->onUpdate('NO ACTION');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_slots');
    }
};
